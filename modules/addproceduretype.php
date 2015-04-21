<?php
include('dbhandler.php');
$Handler = new DBHandler();
$sucess = 0;

$insert = 'INSERT INTO `dental`.`proceduretype`(';
$values = 'VALUES(';

//Nombre
$insert .= '`name`';
$values .= '"' . $_POST['name'] . '"';

//Description
$description = trim($_POST['description']);
if(strlen($description) > 0){
   $insert .= ',`description`';
   $values .= ',"' . $description . '"';
}

$query = $insert . ') ' . $values . ')';
$success = $Handler->executeQuery($query);

echo $success;
?>