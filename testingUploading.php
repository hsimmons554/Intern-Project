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
				$id = get_last_person_id();
				$fname = $_POST['first_name']; //filter_input(INPUT_POST, 'first_name');
				$lname = $_POST['last_name']; //filter_input(INPUT_POST, 'last_name');
				$food = $_POST['favorite_food']; //filter_input(INPUT_POST, 'favorite_food');

				if ($id == NULL || $id == FALSE || $fname == NULL ||
						$lname == NULL || $food == NULL) {
							echo 'Error reading inputs. Try again';
							die();
						}
				insert_person($id, $fname, $lname, $food);

			 	$array['name'] = $fname . ' ' . $lname;
				$array['id'] = $id['MAX(id)'];

				echo json_encode($array);
			break;

			case 'visits':
				$vis_id = get_last_visit_id();
				$prs_id = $_POST['prs_id'];
				$ste_id = $_POST['ste_id'];

				if($vis_id == NULL || $vis_id == FALSE || $prs_id == NULL ||
						$prs_id == FALSE || $ste_id == NULL || $ste_id == FALSE) {
							echo 'Error reading inputs. Try again.';
							die();
						}
				insert_visits($vis_id, $prs_id, $ste_id);
				$array['vis_id'] = $vis_id;
				$array['prs_id'] = $prs_id;
				$array['ste_id'] = $ste_id;
				echo json_encode($array);
			break;
		}
	}
?>
