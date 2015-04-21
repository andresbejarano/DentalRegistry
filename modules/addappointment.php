<?php
include('dbhandler.php');
include('functions.php');

$insert = 'INSERT INTO `dental`.`appointment`(';
$values = 'VALUES(';

//Id del paciente
$insert .= '`patient`';
$values .= $_POST['patient'];

//Id del dentista
$insert .= ',`dentist`';
$values .= ',' . $_POST['dentist'];

//Fecha
$date = splitDate(trim($_POST['date']));
$insert .= ',`date`';
$values .= ',' . '"' . $date[2] . '-' . $date[0] . '-' . $date[1] . '"';

//Hora de inicio
$insert .= ',`init`';
$values .= ',' . $_POST['init'];

//Hora de finalizacion
$insert .= ',`end`';
$values .= ',' . $_POST['end'];

//Tipo de cita
$insert .= ',`type`';
$values .= ',' . $_POST['type'];

//Subprocedimiento
$insert .= ',`subprocedure`';
$values .= ',' . $_POST['subprocedure'];

//Ubicacion oral
$insert .= ',`location`';
$values .= ',' . $_POST['location'];

//Estado de la cita(toda cita creada comienza como solicitada)
$insert .= ',`status`';
$values .= ',1';

//Descripcion
$description = trim($_POST['description']);
if(strlen($description) > 0){
   $insert .= ',`description`';
   $values .= ',"' . $description . '"';
}

$query = $insert . ') ' . $values . ')';

$handler = new DBHandler();
$success = $handler->executeQuery($query);

if($success)
    echo $success;
else
    echo $query;
?>