<?php
include('dbhandler.php');
include('functions.php');

$insert = 'INSERT INTO `dental`.`history`(';
$values = 'VALUES(';

//Paciente
$insert .= '`patient`';
$values .= $_POST['patient'] . '';

//Usuario (Dentista)
$insert .= ',`user`';
$values .= ',' . $_POST['user'] . '';

//Fecha
$date = splitDate(trim($_POST['date']));
$insert .= ',`date`';
$values .= ',' . '"' . $date[2] . '-' . $date[0] . '-' . $date[1] . '"';

//Antecedentes
$insert .= ',`history`';
$values .= ',"' . $_POST['history1'] . $_POST['history2'] . $_POST['history3']
				. $_POST['history4'] . $_POST['history5'] . $_POST['history6']
				. $_POST['history7'] . $_POST['history8'] . $_POST['history9']
				. $_POST['history10'] . $_POST['history11'] . $_POST['history12']
				. $_POST['history13'] . $_POST['history14'] . $_POST['history15']
				. $_POST['history16'] . $_POST['history17'] . $_POST['history18']
				. $_POST['history19'] . '"';

for($i = 1;$i <= 19;$i += 1){
	$insert .= ',`historydesc' . $i . '`';
	$values .= ',"' . trim($_POST['historydesc' . $i]) . '"';
}

//Examenes
$insert .= ',`test`';
$values .= ',"' . $_POST['test1'] . $_POST['test2'] . $_POST['test3']
				. $_POST['test4'] . $_POST['test5'] . $_POST['test6']
				. $_POST['test7'] . $_POST['test8'] . $_POST['test9']
				. $_POST['test10'] . $_POST['test11'] . $_POST['test12']
				. $_POST['test13'] . $_POST['test14'] . $_POST['test15']
				. $_POST['test16'] . $_POST['test17'] . $_POST['test18']
				. $_POST['test19'] . $_POST['test20'] . $_POST['test21']
				. '"';

for($i = 1;$i <= 21;$i += 1){
	$insert .= ',`testdesc' . $i . '`';
	$values .= ',"' . trim($_POST['testdesc' . $i]) . '"';
}
				
//placa bacteriana
$insert .= ',`plaque`';
$values .= ',"' . trim($_POST['plaque']) . '"';

//Motivo de la consulta
$insert .= ',`lastvisit`';
$values .= ',"' . trim($_POST['lastvisit']) . '"';
$insert .= ',`origin`';
$values .= ',' . $_POST['origin'] . '';
$insert .= ',`originhistory`';
$values .= ',"' . trim($_POST['originhistory']) . '"';
$insert .= ',`background`';
$values .= ',"' . trim($_POST['background']) . '"';

$query = $insert . ') ' . $values . ')';
$handler = new DBHandler();
$success = $handler->executeQuery($query);
if($success) echo $success;
else echo $query;
?>