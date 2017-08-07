<?php
define('PEOPLE', 'people');
define('STATES', 'states');
define('VISITS', 'visits');

//$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$paths = parse_url($uri);
$uri_path = explode('/', $paths['path']);

$apiVars = [];
$req_info = [];

$i = 2;
while($i < count($uri_path)) {
  if($uri_path[$i+1]) {
    $apiVars[$uri_path[$i]] = $uri_path[$i + 1];
    $i += 2;
  } else {
    $apiVars[$uri_path[$i]] = null;
    $i++;
  }
}

//Establish database connection
$db = new PDO('mysql:host=localhost;dbname=Intern_Project1', 'root', 'root');
$prev_key = '';
$prev_id = '';
$sections = count($apiVars);

switch($sections) {
  case 1:
  try {
      foreach ($apiVars as $key => $id) {
        $req_info = get_json_table($prev_key, $prev_id, $key, $id);
        $req_info = encode_in_json($req_info);
    }
  } catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
  }
  break;

  // ends with /api/TABLE_NAME/id_num/Col_name
  case 2:
  $isFirst = true;
  foreach ($apiVars as $key => $id) {
    if(!$isFirst){
      $array = get_json_table($prev_key, $prev_id, $key, $id);
      $req_info = $array;
    }

    $prev_key = $key;
    $prev_id = $id;
    $isFirst = false;
  }
  $req_info = encode_in_json($req_info);
  break;
}

header('application/json');
echo($req_info);
die();

//Functions
function get_json_table($outer_table = '', $outer_id = '', $table, $id = '') {
  if (isset($id) && strcasecmp($table, VISITS) == 0 &&
      strcasecmp($outer_table, PEOPLE) == 0 && isset($outer_id)) {
        if(!is_numeric($id)) {
          echo 'Incorrect ID value. Please enter a number or leave blank.';
          die();
        }
        $array = query_visits_by_person($outer_id);
        $array = remove_digit_elements($array);
        return $array;
  } else if (isset($outer_id) && strcasecmp($table, VISITS) == 0 &&
              strcasecmp($outer_table, PEOPLE) == 0) {
    $array = query_visits_by_person($outer_id);
    $array = remove_digit_elements($array);
    return $array;
  } else if (isset($outer_id) && strcasecmp($table, PEOPLE) == 0 &&
              strcasecmp($outer_table, STATES) == 0) {
    $array = query_visits_by_state($outer_id);
    $array = remove_digit_elements($array);
    return $array;
  } else if (isset($outer_id) && strcasecmp($table, STATES) == 0 &&
              strcasecmp($outer_table, PEOPLE) == 0) {
    $array = query_states_by_person($outer_id);
    $array = remove_digit_elements($array);
    return $array;
  } else if (isset($id) && strcasecmp($table, PEOPLE) == 0) {
    if(!is_numeric($id)) {
      echo 'Incorrect ID value. Please enter a number or leave blank.';
      die();
    }
    $array = query_people_id_table($id);
    $array = remove_digit_elements($array);
    return $array;
  } else if (!isset($id) && strcasecmp($table, PEOPLE) == 0) {
    $array = query_people_table();
    $array = remove_digit_elements($array);
    return $array;
  } else if (isset($id) && strcasecmp($table, STATES) == 0) {
    if(!is_numeric($id)) {
      echo 'Incorrect ID value. Please enter a number or leave blank.';
      die();
    }
    $array = query_states_id_table($id);
    $array = remove_digit_elements($array);
    return $array;
  } else if (!isset($id) && strcasecmp($table, STATES) == 0) {
    $array = query_states_table();
    $array = remove_digit_elements($array);
    return $array;
  } else if (isset($id) && strcasecmp($table, VISITS) == 0) {
    if(!is_numeric($id)) {
      echo 'Incorrect ID value. Please enter a number or leave blank.';
      die();
    }
    $array = query_visits_id_table($id);
    $array = remove_digit_elements($array);
    return $array;
  } else if (strcasecmp($table, VISITS) == 0) {
    $array = query_visits_table();
    $array = remove_digit_elements($array);
    return $array;
  }
}

function remove_digit_elements($arrays) {
  for($i = 0; $i < count($arrays); $i++) {
    foreach ($arrays[$i] as $key=> $info) {
      if (is_int($key)){
        unset($arrays[$i][$key]);
      }
    }
  }
  return $arrays;
}

function encode_in_json($array) {
  $array_en = json_encode($array);
  return $array_en;
}

function query_people_table(){
  global $db;
  $query = 'SELECT * FROM people';
  $stm = $db->prepare($query);
  $stm->execute();
  $array = $stm->fetchAll();
  $stm->closeCursor();
  return $array;
}

function query_people_id_table($id) {
  global $db;
  $query = 'SELECT * FROM people
             WHERE id = :id';
  $stm = $db->prepare($query);
  $stm->bindValue(':id', $id);
  $stm->execute();
  $array = $stm->fetchAll();
  $stm->closeCursor();
  return $array;
}

function query_states_table(){
  global $db;
  $query = 'SELECT * FROM states';
  $stm = $db->prepare($query);
  $stm->execute();
  $array = $stm->fetchAll();
  $stm->closeCursor();
  return $array;
}

function query_states_id_table($id) {
  global $db;
  $query = 'SELECT * FROM states
             WHERE id = :id';
  $stm = $db->prepare($query);
  $stm->bindValue(':id', $id);
  $stm->execute();
  $array = $stm->fetchAll();
  $stm->closeCursor();
  return $array;
}

function query_states_by_person($id) {
  global $db;
  $query = 'SELECT states.state_name, states.state_abbreviation
            FROM states INNER JOIN visits ON states.id = visits.state_id
            INNER JOIN people ON visits.person_id = people.id
            WHERE people.id = :id';
  $stm = $db->prepare($query);
  $stm->bindValue(':id', $id);
  $stm->execute();
  $array = $stm->fetchAll();
  $stm->closeCursor();
  return $array;
}

function query_visits_table(){
  global $db;
  $query = 'SELECT visits.id, CONCAT(people.first_name, " ", people.last_name) AS Name,
            states.state_name
            FROM visits INNER JOIN people
            ON visits.person_id = people.id INNER JOIN states
            ON visits.state_id = states.id';
  $stm = $db->prepare($query);
  $stm->execute();
  $array = $stm->fetchAll();
  $stm->closeCursor();
  return $array;
}

function query_visits_id_table($id) {
  global $db;
  $query = 'SELECT visits.id, CONCAT(people.first_name, " ", people.last_name) AS Name,
            states.state_name
            FROM visits INNER JOIN people
            ON visits.person_id = people.id INNER JOIN states
            ON visits.state_id = states.id
            WHERE visits.id = :id';
  $stm = $db->prepare($query);
  $stm->bindValue(':id', $id);
  $stm->execute();
  $array = $stm->fetchAll();
  $stm->closeCursor();
  return $array;
}

function query_visits_by_person($person_id) {
  global $db;
  $query = 'SELECT visits.id, states.state_name
            FROM visits INNER JOIN people
            ON visits.person_id = people.id INNER JOIN states
            ON visits.state_id = states.id
            WHERE visits.person_id = :id';
  $stm = $db->prepare($query);
  $stm->bindValue(':id', $person_id);
  $stm->execute();
  $array = $stm->fetchAll();
  $stm->closeCursor();
  return $array;
}

function query_visits_by_state($id) {
  global $db;
  $query = 'SELECT people.id, CONCAT(people.first_name, " ", people.last_name)
            AS Name, people.favorite_food FROM states
            INNER JOIN visits ON states.id = visits.state_id
            INNER JOIN people ON visits.person_id = people.id
            WHERE states.id = :id';
  $stm = $db->prepare($query);
  $stm->bindValue(':id', $id);
  $stm->execute();
  $array = $stm->fetchAll();
  $stm->closeCursor();
  return $array;
}
?>
