<div style="margin-top: 5%; margin-bottom: 5%; margin-left: 3%; margin-right: 3%;">
    <div style="font-weight: bold; font-size: 2em; margin-bottom: 3%;">
        This is Imran's Office: Employees List
    </div>
    <div style="font-size: 1em;">
        <a href="employee_create.html" class="btn btn-success">Create</a>
        <a href="imr_office.html" class="btn btn-primary">Home</a>
        <table class="table table-striped table-bordered" style="margin-top: 2%">
            <thead>
                <tr>
                    <th>Fullname</th>
                    <th>Designation</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tbody">
<?php 
    include 'database.php';
    $pdo = Database::connect();
    $sql = 'SELECT * FROM employees ORDER BY fullname ASC';
    foreach ($pdo->query($sql) as $row) {
        echo '<tr>';
        echo '<td width="20%">'. $row['fullname'] . '</td>';
        echo '<td width="30%">'. $row['designation'] . '</td>';
        echo '<td width="50%">';
        echo '<a class="btn" href="employee_read.html?id='.$row['id'].'">Read</a>';
        echo '&nbsp;';
        echo '<a class="btn btn-success" href="employee_update.html?id='.$row['id'].'">Update</a>';
        echo '&nbsp;';
        echo '<a class="btn btn-danger" href="employee_delete.html?id='.$row['id'].'">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }
    Database::disconnect();
?>
            </tbody>
        </table>
    </div>
</div>