<?php 
	error_reporting(E_ALL);
	require 'database.php';
	// if values were passed, validate and insert
	if (isset($_POST['insert'])) {			
		// get values
        $id = $_POST['id'];
		$fullname = $_POST['fullname'];
		$designation = $_POST['designation'];
		$password_hash = $_POST['password_hash'];
        
		//echo "Id: ".$id;
		//echo "<br>name: ".$fullname;
		//echo "<br>designation: ". $designation;
		//echo "<br>Pass: ".$password_hash;
		
		$valid = true;
		if (empty($fullname) || empty($designation) || empty($password_hash)) {
			$valid = false;
		} 
		echo "<br>Valid: ".$valid;
		// insert record
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO employees (fullname, designation, password_hash) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($fullname, $designation, $password_hash));
			Database::disconnect();
		}
	}
?>