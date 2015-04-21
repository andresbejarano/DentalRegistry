<?php
include('dbhandler.php');
include('functions.php');

$insert = 'INSERT INTO `dental`.`development`(';
$values = 'VALUES(';

//Paciente
$insert .= '`patient`';
$values .= $_POST['patient'] . '';

//Usuario
$insert .= ',`user`';
$values .= ',' . $_POST['user'] . '';

//Fecha
$date = splitDate(trim($_POST['date']));
$insert .= ',`date`';
$values .= ',' . '"' . $date[2] . '-' . $date[0] . '-' . $date[1] . '"';

//Embarazo
$insert .= ',`pregnant`';
$values .= ',' . $_POST['pregnant'] . '';

//Meses
if(isset($_POST['months'])){
	$insert .= ',`months`';
	$values .= ',' . $_POST['months'] . '';
}

//Placa
$insert .= ',`plaque`';
$values .= ',' . $_POST['plaque'] . '';

//Descripcion
$insert .= ',`description`';
$values .= ',"' . trim($_POST['description']) . '"';

$query = $insert . ') ' . $values . ')';
$handler = new DBHandler();
$success = $handler->executeQuery($query);
if($success) echo $success;
else echo $query;
?>