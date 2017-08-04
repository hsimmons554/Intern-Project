<?php
	$db = new PDO('mysql:host=localhost;dbname=Intern_Project1', 'root', 'root');

  //$table = filter_input(INPUT_POST, 'table');
  $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
  $fname = filter_input(INPUT_POST, 'first_name');
  $lname = filter_input(INPUT_POST, 'last_name');
  $food = filter_input(INPUT_POST, 'food');

  if (/*$table == NULL ||*/ $id == NULL || $id == FALSE || $fname == NULL ||
      $lname == NULL || $food == NULL) {
        echo 'Error reading inputs. Try again';
        die();
      }

  $query = 'INSERT INTO people VALUES
           (:id, :fname, :lname, :food)';
  $stm = $db->prepare($query);
  $stm->bindValue(':id', $id);
  $stm->bindValue(':fname', $fname);
  $stm->bindValue(':lname', $lname);
  $stm->bindValue(':food', $food);
  $stm->execute();
  $stm->closeCursor();
?>
