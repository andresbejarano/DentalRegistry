<?php
include('dbhandler.php');
$update = 'UPDATE `dental`.`user` SET ';
$update .= '`password` = MD5("' . $_POST['newpassword'] . '") ';
$update .= 'WHERE `id` = ' . $_POST['id'] . '';
$handler = new DBHandler();
$success = $handler->executeQuery($update);
if($success) echo $success;
else echo $update;
?>