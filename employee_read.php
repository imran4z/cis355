<?php 
error_reporting(E_ALL);
	require 'database.php';
	
    $id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: employee_list.html");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM employees where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
?>

<div style="margin-top: 5%; margin-bottom: 5%; margin-left: 3%; margin-right: 3%;">
    <h3>Imran's Office: Employee Details</h3>
    <p>
        <a href="imr_office.html" class="btn btn-primary">Home</a>
    </p>
    <div class="form-horizontal" >
        <div class="control-group">
            <label class="control-label">fullname</label>
            <div class="controls">
                <label class="checkbox">
                    <?php echo $data['fullname']; ?>
                </label>
            </div>
        </div>
    </div>
    <div class="form-horizontal" >
        <div class="control-group">
            <label class="control-label">designation</label>
            <div class="controls">
                <label class="checkbox">
                    <?php echo $data['designation']; ?>
                </label>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <a class="btn" href="employee_list.html">Back</a>
    </div>
</div>