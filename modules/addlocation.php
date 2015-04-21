<?php
include('dbhandler.php');

$insert = 'INSERT INTO `dental`.`location`(';
$values = 'VALUES(';

//Codigo
$insert .= '`code`';
$values .= '"' . $_POST['code'] . '"';

//Nombre
$insert .= ',`name`';
$values .= ',"' . $_POST['name'] . '"';

//Descripcion
$description = trim($_POST['description']);
if(strlen($description) > 0){
   $insert .= ',`description`';
   $values .= ',"' . $description . '"';
}

$query = $insert . ') ' . $values . ')';
$handler = new DBHandler();
$success = $handler->executeQuery($query);
if($success)
	echo $success;
else
	echo $query;
?>