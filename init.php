<?php
$db;

connect_database();
check_add_people_table();
check_add_states_table();
check_add_visits_table();

//Functions
function connect_database () {
	global $db;
	try {
			$db = new PDO('mysql:host=localhost;dbname=Intern_Project1', 'root', 'root');
		}
	catch(PDOException $e)
		{
			echo "No database: <br>" . $e->getMessage();
			$conn = new mysqli("localhost", "root", "root");
			if(!$conn){
				echo 'failed to connect';
			} else {
				$sql = 'CREATE DATABASE Intern_Project1';
				if ($conn->query($sql) === TRUE) {echo 'Database Created successfully';}
				$db = new PDO('mysql:host=localhost;dbname=Intern_Project1', 'root', 'root');
			}
		}
  }

function check_add_people_table () {
		global $db;
	$query = 'SELECT id FROM people LIMIT 1';
	$statement = $db->prepare($query);
	$statement->execute();
	$array = $statement->fetch();

	if(array_key_exists('id', $array))
	{
		//table exists
		echo 'The people table already exists<br>';
		$statement->closeCursor();
	} else
	{
		//table does not exist
		$statement->closeCursor();
		$query = 'CREATE TABLE people (
				id int NOT NULL AUTO_INCREMENT,
				first_name varchar(60),
				last_name varchar(60),
				favorite_food varchar(200),
				PRIMARY KEY (id)
			)';
		$statement2 = $db->prepare($query);
		$statement2->execute();
		$statement2->closeCursor();
	}
}

function check_add_states_table () {
	global $db;
	$query = 'SELECT id FROM states
			LIMIT 1';
	$statement = $db->prepare($query);
	$statement->execute();
	$array = $statement->fetch();

	if (array_key_exists('id', $array)) {
		echo 'The states table already exists<br>';
		$statement->closeCursor();
	} else {
		$statement->closeCursor();
		$query = 'CREATE TABLE states (
				id int NOT NULL AUTO_INCREMENT,
				state_name varchar(60),
				state_abbreviation varchar(2),
				PRIMARY KEY (id)
		)';
		$query2 = "INSERT INTO states
							 VALUES (1, 'Louisiana', 'LA'),
							 (2, 'Texas', 'TX'),
							 (3, 'California', 'CA'),
							 (4, 'Mississippi', 'MS'),
					 		 (5, 'Main', 'ME'),
					 		 (6, 'Missouri', 'MO'),
					 		 (7, 'Arkansas', 'AR'),
					 		 (8, 'New Jersey', 'NJ'),
					  	 (9, 'New York', 'NY'),
					 		 (10, 'Ohio', 'OH')";

	$statement2 = $db->prepare($query);
	$statement2->execute();
	$statement2->closeCursor();
	$statement3 = $db->prepare($query2);
	$statement3->execute();
	$statement3->closeCursor();

	}
}

	function check_add_visits_table () {

	global $db;
	$query = 'SELECT id FROM visits
		  LIMIT 1';
	$statement = $db->prepare($query);
	$statement->execute();
	$array = $statement->fetch();

	if(array_key_exists('id', $array))
	{
		//table exists
		echo 'The visits table already exists<br>';
		$statement->closeCursor();
	} else
	{
		//table does not exist
		$statement->closeCursor();
		$query = 'CREATE TABLE visits (
				id int NOT NULL AUTO_INCREMENT,
				person_id int NOT NULL,
				state_id int NOT NULL,
				PRIMARY KEY (id),
				FOREIGN KEY (person_id) REFERENCES people(id),
				FOREIGN KEY (state_id) REFERENCES states(id)
			)';
		$statement2 = $db->prepare($query);
		$statement2->execute();
		$statement2->closeCursor();
	}
}
?>
