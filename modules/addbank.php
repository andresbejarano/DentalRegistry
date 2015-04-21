<?php
include('dbhandler.php');
$Handler = new DBHandler();
$sucess = 0;

$insert = 'INSERT INTO `dental`.`bank`(';
$values = 'VALUES(';

//Nombre
$insert .= '`name`';
$values .= '"' . $_POST['name'] . '"';

//Descripcion
$description = trim($_POST['description']);
if(strlen($description) > 0){
   $insert .= ',`description`';
   $values .= ',"' . $description . '"';
}

$query = $insert . ') ' . $values . ')';
$success = $Handler->executeQuery($query);

echo $success;
?>