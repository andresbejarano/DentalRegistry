<?php
include('dbhandler.php');
$Handler = new DBHandler();
$sucess = 0;

$update = 'UPDATE `dental`.`paymenttype` SET ';

//Nombre
$update .= '`name` = "' . trim($_POST['name']) . '"';

//Descripcion
$description = trim($_POST['description']);
if(strlen($description) > 0){
   $update .= ',`description` =  "' . trim($_POST['description']) . '"';
}
else{
   $update .= ',`description` =  NULL';
}

$update .= ' WHERE id = ' . $_POST['id'];

$success = $Handler->executeQuery($update);

echo $success;
?>