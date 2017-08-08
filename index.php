<!-- Project 3 -->
<?php
include('./view/show_person_list.php');

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
