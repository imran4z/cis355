<?php 
	require 'database.php';
	
    $id = null;
	if (!empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
    
	// if data was entered by the user
	if (isset($_POST['update'])) {	
		// get values
        $id = $_POST['id'];
		$fullname = $_POST['fullname'];
		$designation = $_POST['designation'];
		$password_hash = $_POST['password_hash'];
		
		$valid = true;
		if (empty($fullname) || empty($designation) || empty($password_hash)) {
			$valid = false;
		} 
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE employees  set fullname = ?, designation = ?, password_hash = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$password_hash = MD5($password_hash);
			$q->execute(array($fullname,$designation,$password_hash,$id));
			Database::disconnect();
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// do not select * because we do not want the server to SEND password
		$sql = "SELECT id,fullname,designation FROM employees where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$fullname = $data['fullname'];
		$designation = $data['designation'];
		$password_hash = $data['password_hash'];
		Database::disconnect();
	}
?>

<h3>Imran's Office: Update Employee p</h3>
<p><a href="imr_office.html" class="btn btn-primary">Home</a></p>
<div class="control-group">
    <label class="control-label">fullname</label>
    <div class="controls">
        <input id="fullname" type="text"  placeholder="fullname" value="<?php echo !empty($fullname)?$fullname:'';?>" required>
    </div>
</div>
<div class="control-group">
    <label class="control-label">designation</label>
    <div class="controls">
        <input id="designation" type="text"  placeholder="designation" value="<?php echo !empty($designation)?$designation:'';?>" required>
    </div>
</div>
<div class="control-group">
    <label class="control-label">password_hash</label>
    <div class="controls">
        <input id="password_hash" type="password" placeholder="password_hash" value="<?php echo !empty($password_hash)?$password_hash:'';?>" required>
    </div>
</div>