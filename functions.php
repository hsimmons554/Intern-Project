<?php
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

function insert_person($fname, $lname, $food){
  global $db;
  $query = 'INSERT INTO people
          (first_name, last_name, favorite_food) VALUES
          (:fname, :lname, :food)';
  $stm = $db->prepare($query);
  $stm->bindValue(':fname', $fname);
  $stm->bindValue(':lname', $lname);
  $stm->bindValue(':food', $food);
  $stm->execute();
  $stm->closeCursor();
}

function insert_visits($prs_id, $ste_id) {
  global $db;
  $query = 'INSERT INTO visits
          (person_id, state_id) VALUES
          (:prs_id, :ste_id)';
  $stm = $db->prepare($query);
  $stm->bindValue(':prs_id', $prs_id);
  $stm->bindValue(':ste_id', $ste_id);
  $stm->execute();
  $stm->closeCursor();
}

 ?>
