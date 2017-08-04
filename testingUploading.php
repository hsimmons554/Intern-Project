<?php
require_once('functions.php');

	$db = new PDO('mysql:host=localhost;dbname=Intern_Project1', 'root', 'root');

  //$table = filter_input(INPUT_POST, 'table');
  //$id = $_POST['id']; //filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
  $id = get_last_person_id();
  $fname = $_POST['first_name']; //filter_input(INPUT_POST, 'first_name');
  $lname = $_POST['last_name']; //filter_input(INPUT_POST, 'last_name');
  $food = $_POST['favorite_food']; //filter_input(INPUT_POST, 'favorite_food');

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

  $array['name'] = $fname . ' ' . $lname;
  $array['id'] = $id['MAX(id)'];

  echo json_encode($array);
?>
