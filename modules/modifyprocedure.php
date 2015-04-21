<?php
include('dbhandler.php');

$update = 'UPDATE `dental`.`procedure` SET ';

//Codigo
$update .= '`code` = "' . trim($_POST['code']) . '"';

//Nombre
$update .= ',`name` = "' . trim($_POST['name']) . '"';

//Precio
$update .= ',`price` = ' . trim($_POST['price']) . '';

//Tipo de procedimiento
$update .= ',`proceduretype` = ' . $_POST['proceduretype'] . '';

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