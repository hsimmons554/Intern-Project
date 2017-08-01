<?php
function connect_database () {
	try {/*
	    $db = new PDO('mysql:host=localhost;dbname=InternProject1', 'root', 'root');
	    // set the PDO error mode to exception
	    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $query = 'CREATE DATABASE InternProject1';
	    // use exec() because no results are returned
	    //$db->exec($query);
			$db->prepare($query);
			$db->execute();
	    echo "Database created successfully<br>";
	    }
	catch(PDOException $e)
	    {
	    echo $query . "<br>" . $e->getMessage();
	    }

*/
global $db;
	$db = new PDO('mysql:host=localhost;dbname=InternProject1', 'root', 'root');
	//$db = new PDO('mysql:host=localhost' 'root', 'root');
	// set the PDO error mode to exception
	//$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//$query = 'CREATE DATABASE InternProject1';
	// use exec() because no results are returned
	//$db->exec($query);
	//$db->prepare($query);
	//$db->execute();
	//echo "Database created successfully<br>";
	//echo 'Created PDO successfully';
	}
catch(PDOException $e)
	{
	echo $query . "<br>" . $e->getMessage();
	}
  }

function check_add_people_table () {
//echo 'entered check people function';
global $db;
//echo 'set global db variable';
$query = 'SELECT id FROM people LIMIT 1';
//$query = 'SELECT * FROM information_schema WHERE TABLE_NAME = people';
$statement = $db->prepare($query);
$statement->execute();
$array = $statement->fetch();
//val = msql_query('select 1 from people LIMIT 1');
if($array['first_name'] !== FALSE)
//if($val !== FALSE)
{

	//table exists
	echo 'The people table already exists';
	print_r($statement);
	//$statement->closeCursor();
} else
{
	//$statement->closeCursor();
	//table does not exist
	$query = 'CREATE TABLE people (
			id int NOT NULL,
			first_name varchar(60),
			last_name varchar(60),
			favorite_food varchar(200),
			PRIMARY KEY (id)
		)';
	$statement2 = $db->prepare($query);
	$statement2->execute();
	$statement2->closeCursor();
	echo 'finished adding table';
}
}

function check_add_states_table () {
	global $db;
	$query = 'SELECT 1 FROM states
			LIMIT 1';
	$statement = $db->prepare($query);
	$statement->execute();

	if ($statement !== FALSE) {
		echo 'The states table already exists';
		$statement->closeCursor();
	} else {
		$statement->closeCursor();
		$query = 'CREATE TABLE states (
				id int NOT NULL,
				state_name varchar(60),
				state_abbreviation varchar(2),
				PRIMARY KEY (id)
		)';
		$query2 = "INSERT INTO states
							 VALUES (1, 'Louisiana', 'LA');
							 INSERT INTO states
							 VALUES (2, 'Texas', 'TX');
							 INSERT INTO states
							 VALUES (3, 'California', 'CA');
							 INSERT INTO states
							 VALUES (4, 'Mississippi', 'MS');
							 INSERT INTO states
					 		 VALUES (5, 'Main', 'ME');
					 		 INSERT INTO states
					 		 VALUES (6, 'Missouri', 'MO');
					 		 INSERT INTO states
					 		 VALUES (7, 'Arkansas', 'AR');
					 		 INSERT INTO states
					 		 VALUES (8, 'New Jersey', 'NJ');
							 INSERT INTO states
					  	 VALUES (9, 'New York', 'NY');
					   	 INSERT INTO states
					 		 VALUES (10, 'Ohio', 'OH')";

	$statement2 = $db->prepare($query);
	$statement2->execute();
	$statement2->prepare($query2);
	$statement2->execute();
	$statement2->closeCursor();
	}
}

	function check_add_visits_table () {
	global $db;
	$query = 'SELECT 1 FROM visits
		  LIMIT 1';
	$statement = $db->prepare($query);
	$statement->execute();

	if($statement !== FALSE)
	{
		//table exists
		echo 'The visits table already exists';
		$statement->closeCursor();
	} else
	{
		$statement->closeCursor();
		//table does not exist
		$query = 'CREATE TABLE visits (
				id int NOT NULL,
				person_id int NOT NULL,
				state_id int NOT NULL,
				PRIMARY KEY (id)
				FOREIGN KEY (person_id) REFERENCES people(id),
				FOREIGN KEY (state_id) REFERENCES states(id)
			)';
		$statement2 = $db->prepare($query);
		$statement2->execute();
		$statement2->closeCursor();
	}
}
?>
