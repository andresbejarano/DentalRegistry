<?php
include('dbhandler.php');
$Handler = new DBHandler();
$sucess = 0;

$insert = 'INSERT INTO `dental`.`procedure`(';
$values = 'VALUES(';

//Codigo
$insert .= '`code`';
$values .= '"' . trim($_POST['code']) . '"';

//Nombre
$insert .= ',`name`';
$values .= ',"' . trim($_POST['name']) . '"';

//Precio
$insert .= ',`price`';
$values .= ',"' . trim($_POST['price']) . '"';

//Tipo de procedimiento
$insert .= ',`proceduretype`';
$values .= ',' . $_POST['proceduretype'] . '';

//Descripcion
$description = trim($_POST['description']);
if(strlen($description) > 0){
   $insert .= ',`description`';
   $values .= ',"' . $description . '"';
}

$query = $insert . ') ' . $values . ')';
$success = $Handler->executeQuery($query);
if($success)
   echo $success;
else
   echo $query;
?>