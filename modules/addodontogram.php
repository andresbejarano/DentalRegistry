<?php
include('dbhandler.php');
include('functions.php');

$insert = 'INSERT INTO `dental`.`odontogram`(';
$values = 'VALUES(';

//Paciente
$insert .= '`patient`';
$values .= '' . $_POST['patient'] . '';

//Usuario
$insert .= ',`user`';
$values .= ',' . $_POST['user'] . '';

//Fecha
$date = splitDate(trim($_POST['date']));
$insert .= ',`date`';
$values .= ',' . '"' . $date[2] . '-' . $date[0] . '-' . $date[1] . '"';

for($i = 8;$i >= 1;$i -= 1){
	$tooth = 'd1' . $i;
	$insert .= ',`' . $tooth . '`';
	$values .= ',"' . $_POST[$tooth] . '"';
}

for($i = 1;$i <= 8;$i += 1){
	$tooth = 'd2' . $i;
	$insert .= ',`' . $tooth . '`';
	$values .= ',"' . $_POST[$tooth] . '"';
}

for($i = 5;$i >= 1;$i -= 1){
	$tooth = 'd5' . $i;
	$insert .= ',`' . $tooth . '`';
	$values .= ',"' . $_POST[$tooth] . '"';
}

for($i = 1;$i <= 5;$i += 1){
	$tooth = 'd6' . $i;
	$insert .= ',`' . $tooth . '`';
	$values .= ',"' . $_POST[$tooth] . '"';
}

for($i = 5;$i >= 1;$i -= 1){
	$tooth = 'd8' . $i;
	$insert .= ',`' . $tooth . '`';
	$values .= ',"' . $_POST[$tooth] . '"';
}

for($i = 1;$i <= 5;$i += 1){
	$tooth = 'd7' . $i;
	$insert .= ',`' . $tooth . '`';
	$values .= ',"' . $_POST[$tooth] . '"';
}

for($i = 8;$i >= 1;$i -= 1){
	$tooth = 'd4' . $i;
	$insert .= ',`' . $tooth . '`';
	$values .= ',"' . $_POST[$tooth] . '"';
}

for($i = 1;$i <= 8;$i += 1){
	$tooth = 'd3' . $i;
	$insert .= ',`' . $tooth . '`';
	$values .= ',"' . $_POST[$tooth] . '"';
}

//Descripcion
$description = trim($_POST['description']);
if(strlen($description) > 0){
   $insert .= ',`description`';
   $values .= ',"' . $description . '"';
}

$query = $insert . ') ' . $values . ')';
$handler = new DBHandler();
$success = $handler->executeQuery($query);
if($success) echo $success;
else echo $query;
?>