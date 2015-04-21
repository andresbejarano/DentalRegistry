<?php
include('dbhandler.php');
include('functions.php');
$Handler = new DBHandler();

$insert = 'INSERT INTO `dental`.`patient`(';
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

//Ocupacion
if(strlen(trim($_POST['occupation'])) > 0){
   $insert .= ',`occupation`';
   $values .= ',' . '"' . trim($_POST['occupation']) . '"';
}

//Acudiente
if(strlen(trim($_POST['contact'])) > 0){
   $insert .= ',`contact`';
   $values .= ',' . '"' . trim($_POST['contact']) . '"';
}

//Numero acudiente
if(strlen(trim($_POST['contactnumber'])) > 0){
   $insert .= ',`contactnumber`';
   $values .= ',' . '"' . trim($_POST['contactnumber']) . '"';
}

//Usuario activo
$insert .= ',`active`';
$values .= ',true';

$query = $insert . ') ' . $values . ')';

$success = $Handler->executeQuery($query);
echo $success;
?>