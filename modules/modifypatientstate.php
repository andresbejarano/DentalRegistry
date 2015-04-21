<?php
include('dbhandler.php');
$update = 'UPDATE `dental`.`patient` SET ';
$update .= '`active` = ' . $_POST['active'];
$update .= ' WHERE id = ' . $_POST['id'];
$handler = new DBHandler();
$success = $handler->executeQuery($update);
if($success) echo $success;
else echo $update;
?>