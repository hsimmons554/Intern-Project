<?php
require_once('init.php');
$db;
connect_database();
//check_add_people_table();

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
  if ($action == NULL) {
    $action = 'show_people_list';
  }
}

switch($action) {
  case 'show_people_list':
    $persons = get_people();
    include('./view/show_person_list.php');
  break;
  case 'show_person_stats':
    $persons = get_people();
    $person_id = filter_input(INPUT_GET, 'person_id', FILTER_VALIDATE_INT);
    $person_stats = get_indiv_stats($person_id);
    $flag = TRUE;
    include('./view/show_person_list.php');
    break;
    case 'add_person':
    $fname = filter_input(INPUT_GET, 'first_name');
    $lname = filter_input(INPUT_GET, 'last_name');
    $food = filter_input(INPUT_GET, 'fav_food');
    if($fname == NULL || $lname == NULL || $food == NULL) {
      echo 'Incorrect values in the text boxes' . $fname;
    } else {
    $id_num = get_last_person_id();
    add_person($id_num['MAX(id)'], $fname, $lname, $food);
    header('Location: .');
  }
    break;
    case 'show_add_person':
    include('./view/add_person_form.php');
    break;
    case 'show_add_visit':
    break;
}

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
 ?>
