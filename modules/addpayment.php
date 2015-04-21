<?php
include('dbhandler.php');
include('functions.php');
$Handler = new DBHandler();

$insert = 'INSERT INTO `dental`.`payment`(';
$values = 'VALUES(';

//Paciente
$insert .= '`patient`';
$values .= '' . $_POST['patient'] . '';

//Usuario
$insert .= ',`user`';
$values .= ',' . $_POST['user'] . '';

//Fecha
$date = splitDate($_POST['date']);
$insert .= ',`date`';
$values .= ',' . '"' . $date[2] . '-' . $date[0] . '-' . $date[1] . '"';

//Valor
$insert .= ',`value`';
$values .= ',' . trim($_POST['value']) . '';

//Forma de pago
$insert .= ',`paymenttype`';
$values .= ',' . $_POST['paymenttype'] . '';

//Numero
$number = trim($_POST['number']);
if(strlen($number) > 0){
   $insert .= ',`number`';
   $values .= ',"' . $number . '"';
}

//Banco
if($_POST['bank'] > 0){
   $insert .= ',`bank`';
   $values .= ',' . $_POST['bank'] . '';
}

//Descripcion
$description = trim($_POST['description']);
if(strlen($description) > 0){
   $insert .= ',`description`';
   $values .= ',"' . $description . '"';
}

$query = $insert . ') ' . $values . ')';

$success = $Handler->executeQuery($query);
echo $success;
?>