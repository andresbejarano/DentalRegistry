<?php
include('dbhandler.php');
$handler = new DBHandler();
$userdata = $handler->getUserDataById($_POST['id']);
$success = true;

//Verificacion de la contrasena antigua
if(strlen(trim($_POST['oldpassword'])) == 0){
	$success = false;
	echo '<p>Debe ingresar la contrase&ntilde;a antigua</p>';
}

if($success && $userdata['password'] != MD5($_POST['oldpassword'])){
	$success = false;
	echo '<p>La contrase&ntilde;a antigua no corresponde con la original</p>';
}

//Verificacion de la contrasena nueva
if(strlen(trim($_POST['newpassword'])) == 0){
	if($success) $success = false;
	echo '<p>Debe ingresar la contrase&ntilde;a nueva</p>';
}

if(strlen(trim($_POST['confirmedpassword'])) == 0){
	if($success) $success = false;
	echo '<p>Debe confirmar la contrase&ntilde;a nueva</p>';
}

if($success && strlen(($_POST['newpassword'])) < 5){
	$success = false;
	echo '<p>La nueva contrase&ntilde;a debe tener como m&iacute;nimo 5 caracteres</p>';
}

if($success && $_POST['newpassword'] != $_POST['confirmedpassword']){
	$success = false;
	echo '<p>La nueva contrase&ntilde;a no corresponde con la confirmada</p>';
}

if($success) echo $success;
?>