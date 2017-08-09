<?php
require_once('functions.php');

	$db = new PDO('mysql:host=localhost;dbname=Intern_Project1', 'root', 'root');

  $table = $_POST['table'];

	if ($table == NULL) {
		echo 'Error reading Table Name input. Try Again.';
		die();
	} else {
		switch ($table) {
			case 'people':

				$fname = $_POST['first_name']; //filter_input(INPUT_POST, 'first_name');
				$lname = $_POST['last_name']; //filter_input(INPUT_POST, 'last_name');
				$food = $_POST['favorite_food']; //filter_input(INPUT_POST, 'favorite_food');

				if ($fname == NULL || $lname == NULL || $food == NULL) {
							echo 'Error reading inputs. Try again';
							die();
						}
				insert_person($fname, $lname, $food);
				$id = get_last_person_id();
			 	$array['name'] = $fname . ' ' . $lname;
				$array['id'] = $id['MAX(id)'];

				echo json_encode($array);
			break;

			case 'visits':
				$prs_id = $_POST['prs_id'];
				$ste_id = $_POST['ste_id'];

				if( $prs_id == NULL || $prs_id == FALSE || $ste_id == NULL ||
						$ste_id == FALSE) {
							echo 'Error reading inputs. Try again.';
							die();
						}
				insert_visits($prs_id, $ste_id);
				$vis_id = get_last_visit_id();
				$array['vis_id'] = $vis_id['MAX(id)'];
				$array['prs_id'] = $prs_id;
				$array['ste_id'] = $ste_id;
				echo json_encode($array);
			break;
		}
	}
?>
