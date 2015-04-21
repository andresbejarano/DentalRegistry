<?php
include('dbhandler.php');
include('functions.php');

$insert = 'INSERT INTO `dental`.`user`(';
$values = 'VALUES(';

//Tipo de documento de identidad
$insert .= '`documenttype`';
$values .= $_POST['documenttype'];

//Numero de documento de identidad
$insert .= ',`documentnumber`';
$values .= ',' . trim($_POST['documentnumber']);

//Primer nombre
$insert .= ',`firstname`';
$values .= ',' . '"' . trim($_POST['firstname']) . '"';

//Segundo nombre
if(strlen(trim($_POST['middlename'])) > 0){
   $insert .= ',`middlename`';
   $values .= ',' . '"' . trim($_POST['middlename']) . '"';
}

//Primer apellido
$insert .= ',`firstlastname`';
$values .= ',' . '"' . trim($_POST['firstlastname']) . '"';

//Segundo apellido
$insert .= ',`secondlastname`';
$values .= ',' . '"' . trim($_POST['secondlastname']) . '"';

//Numero de documento de identidad
$insert .= ',`sex`';
$values .= ',' . $_POST['sex'];

//Fecha de nacimiento
$date = splitDate(trim($_POST['birthdate']));
$insert .= ',`birthdate`';
$values .= ',' . '"' . $date[2] . '-' . $date[0] . '-' . $date[1] . '"';

//Tipo de sangre
$insert .= ',`bloodtype`';
$values .= ',' . $_POST['bloodtype'];

//Direccion
$insert .= ',`address`';
$values .= ',' . '"' . trim($_POST['address']) . '"';

//Telefono fijo
$insert .= ',`phonehome`';
$values .= ',' . '"' . trim($_POST['phonehome']) . '"';

//Telefono oficina
if(strlen(trim($_POST['phoneoffice'])) > 0){
   $insert .= ',`phoneoffice`';
   $values .= ',' . '"' . trim($_POST['phoneoffice']) . '"';
}

//Celular
if(strlen(trim($_POST['cellnumber'])) > 0){
   $insert .= ',`cellnumber`';
   $values .= ',' . '"' . trim($_POST['cellnumber']) . '"';
}

//Correo electronico
if(strlen(trim($_POST['email'])) > 0){
   $insert .= ',`email`';
   $values .= ',' . '"' . trim($_POST['email']) . '"';
}

//Estado civil
$insert .= ',`maritalstatus`';
$values .= ',' . $_POST['maritalstatus'];

//Dentista
$insert .= ',`dentist`';
$values .= ',' . $_POST['dentist'];

//Especialidad
if($_POST['dentist'] == 1){
   $insert .= ',`specialty`';
   $values .= ',' . $_POST['specialty'];
}

//Nombre de usuario
$insert .= ',`username`';
$values .= ',' . '"' . trim($_POST['username']) . '"';

//Contrasena
$insert .= ',`password`';
$values .= ',' . 'MD5("12345.' . trim($_POST['username']) . '")';

//Privilegios
$insert .= ',`privileges`';
$values .= ',' . $_POST['privileges'];

//Usuario activo
$insert .= ',`active`';
$values .= ',true';

$query = $insert . ') ' . $values . ')';
$handler = new DBHandler();
$success = $handler->executeQuery($query);
echo $success;
?>