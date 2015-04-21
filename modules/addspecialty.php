<?php
include('dbhandler.php');
$Handler = new DBHandler();
$sucess = 0;

$insert = 'INSERT INTO `dental`.`specialty`(';
$values = 'VALUES(';

//Nombre
$insert .= '`name`';
$values .= '"' . trim($_POST['name']) . '"';

//Honorario
$insert .= ',`fee`';
$values .= ',' . trim($_POST['fee']);

//Descripcion
if(strlen(trim($_POST['description'])) > 0){
   $insert .= ',`description`';
   $values .= ',' . '"' . trim($_POST['description']) . '"';
}

$query = $insert . ') ' . $values . ')';
$success = $Handler->executeQuery($query);

echo $success;
?>