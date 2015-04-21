<?php
include('dbhandler.php');
$Handler = new DBHandler();

$update = 'UPDATE `dental`.`user` SET ';

//Activo
$update .= '`active` = ' . $_POST['active'];

$update .= ' WHERE id = ' . $_POST['id'];
$success = $Handler->executeQuery($update);
echo $success;
?>