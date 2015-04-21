<?php
include('dbhandler.php');
$update = 'UPDATE `dental`.`location` SET ';
$update .= '`code` = ' . trim($_POST['code']) . '';
$update .= ',`name` = "' . trim($_POST['name']) . '"';

//Descripcion
$description = trim($_POST['description']);
if(strlen($description) > 0){
   $update .= ',`description` =  "' . trim($_POST['description']) . '"';
}
else{
   $update .= ',`description` =  NULL';
}

$update .= ' WHERE id = ' . $_POST['id'];
$handler = new DBHandler();
$success = $handler->executeQuery($update);
if($success)
	echo $success;
else
	echo $update;
?>