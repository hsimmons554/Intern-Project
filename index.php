<!-- Project 2 -->
<?php

//$db;
//connect_database();

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
  if ($action == NULL) {
    $action = 'show_people_list';
  }
}

switch($action) {
  case 'show_people_list':
    //$persons = get_people();
    include('./view/show_person_list.php');
  break;
  case 'show_person_stats':
    //$persons = get_people();
    //$person_id = filter_input(INPUT_GET, 'person_id', FILTER_VALIDATE_INT);
    //$person_stats = get_indiv_stats($person_id);
    //$visits = get_persons_visits($person_id);
    //$flag = TRUE;
    include('./view/show_person_list.php');
    break;
    case 'add_person':
    //$fname = filter_input(INPUT_GET, 'first_name');
    //$lname = filter_input(INPUT_GET, 'last_name');
    //$food = filter_input(INPUT_GET, 'fav_food');
  //  if($fname == NULL || $lname == NULL || $food == NULL) {
  //    echo 'Incorrect values in the text boxes' . $fname;
  //  } else {
  //  $id_num = get_last_person_id();
  //  add_person($id_num['MAX(id)'], $fname, $lname, $food);
    header('Location: index.php');
//  }
    break;
    case 'show_add_person':
    include('./view/add_person_form.php');
    break;
    case 'show_add_visit':
    //$persons = get_people();
    //$states = get_states();
    include('./view/add_visit_form.php');
    break;
    case 'add_visit':
  // $person_id = filter_input(INPUT_GET, 'person_id', FILTER_VALIDATE_INT);
  //  $state_id = filter_input(INPUT_GET, 'state_id', FILTER_VALIDATE_INT);

  //  if ($person_id == NULL || $person_id == FALSE || $state_id == NULL || $state_id == FALSE) {
  //    echo 'Something went wrong sending selections to index file.';
  //  } else {
  //    $id_num = get_last_visit_id();
  //    add_visit($id_num['MAX(id)'], $person_id, $state_id);
      header('Location: index.php');
  //  }
    break;
}
/*
// Functions
function add_person($id, $first_name, $last_name, $fav_food) {
    global $db;
    $id = $id + 1;
    $query = 'INSERT INTO people
              VALUES (:id, :fname, :lname, :food)';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':fname', $first_name);
    $statement->bindValue(':lname', $last_name);
    $statement->bindValue(':food', $fav_food);
    $statement->execute();
    $statement->closeCursor();
}

function add_visit($id, $person, $state) {
  global $db;
  $id = $id + 1;
  $query = 'INSERT INTO visits VALUES (:id, :person, :state)';
  $stm = $db->prepare($query);
  $stm->bindValue(':id', $id);
  $stm->bindValue(':person', $person);
  $stm->bindValue(':state', $state);
  $stm->execute();
  $stm->closeCursor();
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
}

function get_indiv_stats($id) {
  global $db;
  $query = 'SELECT * FROM people
            WHERE id = :id';
  $statement = $db->prepare($query);
  $statement->bindValue(':id', $id);
  $statement->execute();
  $array = $statement->fetch();
  $statement->closeCursor();
  return $array;
}

function get_last_person_id() {
  global $db;
  $query = 'SELECT MAX(id) FROM people';
  $statement = $db->prepare($query);
  $statement->execute();
  $id = $statement->fetch();
  $statement->closeCursor();
  return $id;
}

function get_last_visit_id() {
  global $db;
  $query = 'SELECT MAX(id) FROM visits';
  $statement = $db->prepare($query);
  $statement->execute();
  $id = $statement->fetch();
  $statement->closeCursor();
  return $id;
}
function connect_database () {
	global $db;
	$db = new PDO('mysql:host=localhost;dbname=Intern_Project1', 'root', 'root');
}*/
 ?>
