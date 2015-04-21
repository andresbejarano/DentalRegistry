<?php
include('dbhandler.php');
include('functions.php');
$Handler = new DBHandler();

$update = 'UPDATE `dental`.`user` SET ';

//Tipo de documento de identidad
$update .= '`documenttype` = ' . $_POST['documenttype'];

//Numero de documento de identidad
$update .= ',`documentnumber` = ' . trim($_POST['documentnumber']);

//Primer nombre
$update .= ',`firstname` =  "' . trim($_POST['firstname']) . '"';

//Segundo nombre
if(strlen(trim($_POST['middlename'])) > 0){
   $update .= ',`middlename` =  "' . trim($_POST['middlename']) . '"';
}
else{
   $update .= ',`middlename` =  NULL';
}

//Primer apellido
$update .= ',`firstlastname` =  "' . trim($_POST['firstlastname']) . '"';

//Segundo apellido
$update .= ',`secondlastname` =  "' . trim($_POST['secondlastname']) . '"';

//Numero de documento de identidad
$update .= ',`sex` = ' . $_POST['sex'];

//Fecha de nacimiento
$date = splitDate(trim($_POST['birthdate']));
$update .= ',`birthdate` = "' . $date[2] . '-' . $date[0] . '-' . $date[1] . '"';

//Tipo de sangre
$update .= ',`bloodtype` = ' . $_POST['bloodtype'];

//Direccion
$update .= ',`address` = "' . trim($_POST['address']) . '"';

//Telefono fijo
$update .= ',`phonehome` = "' . trim($_POST['phonehome']) . '"';

//Telefono oficina
if(strlen(trim($_POST['phoneoffice'])) > 0){
   $update .= ',`phoneoffice` = "' . trim($_POST['phoneoffice']) . '"';
}
else{
   $update .= ',`phoneoffice` =  NULL';
}

//Celular
if(strlen(trim($_POST['cellnumber'])) > 0){
   $update .= ',`cellnumber` = "' . trim($_POST['cellnumber']) . '"';
}
else{
   $update .= ',`cellnumber` =  NULL';
}

//Correo electronico
if(strlen(trim($_POST['email'])) > 0){
   $update .= ',`email` = "' . trim($_POST['email']) . '"';
}
else{
   $update .= ',`email` =  NULL';
}

//Estado civil
$update .= ',`maritalstatus` = ' . $_POST['maritalstatus'];

//Dentista
$update .= ',`dentist` = ' . $_POST['dentist'];

//Especialidad
if($_POST['dentist'] == 1){
   $update .= ',`specialty` = ' . $_POST['specialty'];
}
else{
   $update .= ',`specialty` = NULL';
}

//Nombre de usuario
$update .= ',`username` = "' . trim($_POST['username']) . '"';

//Privilegios
$update .= ',`privileges` = ' . $_POST['privileges'];

$update .= ' WHERE id = ' . $_POST['id'];

$success = $Handler->executeQuery($update);
echo $success;
?>