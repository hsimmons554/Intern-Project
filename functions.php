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

function insert_person($id, $fname, $lname, $food){
  global $db;
  $query = 'INSERT INTO people VALUES
          (:id, :fname, :lname, :food)';
  $stm = $db->prepare($query);
  $stm->bindValue(':id', $id);
  $stm->bindValue(':fname', $fname);
  $stm->bindValue(':lname', $lname);
  $stm->bindValue(':food', $food);
  $stm->execute();
  $stm->closeCursor();
}

function insert_visits($vis_id, $prs_id, $ste_id) {
  global $db;
  $query = 'INSERT INTO visits VALUES
          (:vis_id, :prs_id, :ste_id)';
  $stm = $db->prepare($query);
  $stm->bindValue(':vis_id', $vis_id);
  $stm->bindValue(':prs_id', $prs_id);
  $stm->bindValue(':ste_id', $ste_id);
  $stm->execute();
  $stm->closeCursor();
}

 ?>
