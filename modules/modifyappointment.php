<?php
include('dbhandler.php');
include('functions.php');

$update = 'UPDATE `dental`.`appointment` SET ';

$update .= '`dentist` = ' . $_POST['dentist'] . '';

$date = splitDate(trim($_POST['date']));
$update .= ',`date` = "' . $date[2] . '-' . $date[0] . '-' . $date[1] . '"';

$update .= ',`init` = ' . $_POST['init'] . '';

$update .= ',`end` = ' . $_POST['end'] . '';

$update .= ',`type` = ' . $_POST['type'] . '';

$update .= ',`subprocedure` = ' . $_POST['subprocedure'] . '';

$update .= ',`location` = ' . $_POST['location'] . '';

$update .= ',`status` = ' . $_POST['status'] . '';

$description = trim($_POST['description']);
if(strlen($description) > 0){
   $update .= ',`description` =  "' . trim($_POST['description']) . '"';
}
else{
   $update .= ',`description` =  NULL';
}

$update .= ' WHERE `id` = ' . $_POST['id'];
$handler = new DBHandler();
$success = $handler->executeQuery($update);
if($success) echo $success;
else echo $update;
?>