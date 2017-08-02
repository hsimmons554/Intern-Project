<?php
class api {
  //Properties
  private $db;

  //Constructor - establishes connection to database
  function __constructor($i) {
    $db = new PDO('mysql:host=localhost;dbname=Intern_Project1', 'root', 'root');

    // determine HTTP method and URI
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = $i;//$_SERVER['REQUEST_URI'];

    // explode URL into Array and remove initial blank element
    $paths = explode('/', $this->paths($uri));
    $table = array_shift($paths);
    $id = array_shift($paths);

    //check if id is Empty
    if (empty($id)) {
      //Call method to retrieve data about given table
      echo $this->get_table_data($table);
    } else {
      //Call method to retrieve data about given table and id
      $this->get_table_plus_id_data($table, $id);
    }
  }

  //Methods
  public function paths($url) {
    $paths = parse_url($url);
    return $paths['path'];
  }

  public function get_table_data($table) {
    global $db;
    $query = 'SELECT * FROM :table';
    $stm = $db->prepare($query);
    $stm->bindValue(':table', $table);
    $stm->execute();
    $data = $stm->fetchAll();
    $stm->closeCursor();
    for($i = 0; $i < count($data); $i++) {
      foreach ($data[$i] as $key=> $info) {
        if (is_int($key)){
          unset($data[$i][$key]);
        }
      }
    }
    $data_json = json_encode($data);
    return $data_json;
  }
}
/*
$db;
connect_database();
echo get_json_of_people() . "\n\n";
echo get_json_of_states() . "\n\n";
echo get_json_of_visits() . "\n\n";

//Functions
function get_json_of_people(){
  $people = get_people();
  for($i = 0; $i < count($people); $i++) {
    foreach ($people[$i] as $key=> $person) {
      if (is_int($key)){
        unset($people[$i][$key]);
      }
    }
  }
  $people_json = json_encode($people);
  return $people_json;
}

function get_json_of_states(){
  $states = get_states();
  for($i = 0; $i < count($states); $i++) {
    foreach ($states[$i] as $key=> $state) {
      if (is_int($key)){
        unset($states[$i][$key]);
      }
    }
  }
  $states_json = json_encode($states);
  return $states_json;
}

function get_json_of_visits() {
    $visits = get_visits();
    for($i = 0; $i < count($visits); $i++) {
      foreach ($visits[$i] as $key=> $visit) {
        if (is_int($key)){
          unset($visits[$i][$key]);
        }
      }
    }
    $visits_json = json_encode($visits);
    return $visits_json;
}

function connect_database () {
	global $db;
	$db = new PDO('mysql:host=localhost;dbname=Intern_Project1', 'root', 'root');
  }

function get_people() {
    try {
      global $db;
      $query = 'SELECT * FROM people';
      $statement = $db->prepare($query);
      $statement->execute();
      $people = $statement->fetchAll();
      $statement->closeCursor();
      return $people;
    } catch(\Exception $e) {
      echo $e->getMessage();
    }
  }

function get_states() {
    global $db;
    $query = 'SELECT * FROM states';
    $stm = $db->prepare($query);
    $stm->execute();
    $states = $stm->fetchAll();
    $stm->closeCursor();
    return $states;
  }

function get_visits() {
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

function get_persons_visits($person_id) {
    global $db;
    $query = 'SELECT visits.id, people.id, states.state_name
              FROM visits INNER JOIN people
              ON visits.person_id = people.id INNER JOIN states
              ON visits.state_id = states.id
              WHERE people.id = :person';
    $stm = $db->prepare($query);
    $stm->bindValue(':person', $person_id);
    $stm->execute();
    $visits = $stm->fetchAll();
    $stm->closeCursor();
    return $visits;
  }*/
  $i = '/people';
  $api = new api($i);
?>
