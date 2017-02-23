<?php 
	error_reporting (E_ALL);
	require 'database.php';

	// if values were passed, validate and insert
	if (isset($_POST['insert'])) {
		// get values
		$id = $_POST['id'];
		$event_date = $_POST['event_date'];
		$event_time = $_POST['event_time'];
		$event_location = $_POST['event_location'];
		$event_description = $_POST['event_description'];
		
		$valid = true;
		if (empty($event_date) || empty($event_time) || empty($event_location) || empty($event_description)) {
			$valid = false; } 
         echo "<br>Valid: ".$valid;
		// insert record
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO event (event_date, event_time, event_location, event_description) values(?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($event_date, $event_time, $event_location, $event_description));
			Database::disconnect();
		}
	}
?>