<?php
include('dbhandler.php');
include('functions.php');
$success = true;

//La descripcion debe ser menor de 2000 caracteres
if(strlen(trim($_POST['description'])) > 2000){
	if($success) $success = false;
	echo '<p>La descripci&oacute;n debe ser menor de 2000 caracteres</p>';
}

if($success) echo $success;
?>