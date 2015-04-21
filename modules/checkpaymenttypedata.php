<?php
include('dbhandler.php');
$Handler = new DBHandler();
$success = true;

//El nombre es obligatorio
if(strlen(trim($_POST['name'])) < 1){
   if($success) $success = false;
   echo "<p>Debe ingresar el nombre</p>";
}

//La descripcion debe ser menor de 300 caracteres
if(strlen(trim($_POST['description'])) > 300){
   if($success) $success = false;
   echo '<p>La descripci&oacute;n debe ser menor de 300 caracteres</p>';
}

if($success) echo $success;
?>