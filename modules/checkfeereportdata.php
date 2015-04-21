<?php
include('dbhandler.php');
include('functions.php');
$success = true;

//La fecha de inicio es obligatoria y con el formato mm/dd/aaaa
$date = trim($_POST['dateinit']); 
if(strlen($date) < 1){
	if($success) $success = false;
	echo '<p>Debe ingresar la fecha de inicio</p>';
}
else{
	$array = splitDate($date);
	if(!(sizeof($array) == 3 && is_numeric($array[0]) && is_numeric($array[1]) && is_numeric($array[2]))){
		if($success) $success = false;
		echo '<p>Formato inv&aacute;lido de la fecha de inicio</p>';
	}
	else{
		if(!checkdate($array[0],$array[1],$array[2])){
			if($success) $success = false;
			echo '<p>La fecha de inicio no existe</p>';
		}
	}
}

//La fecha de finalizacion es obligatoria y con el formato mm/dd/aaaa
$date = trim($_POST['dateend']); 
if(strlen($date) < 1){
	if($success) $success = false;
	echo '<p>Debe ingresar la fecha de finalizaci&oacute;n</p>';
}
else{
	$array = splitDate($date);
	if(!(sizeof($array) == 3 && is_numeric($array[0]) && is_numeric($array[1]) && is_numeric($array[2]))){
		if($success) $success = false;
		echo '<p>Formato inv&aacute;lido de la fecha de finalizaci&oacute;n</p>';
	}
	else{
		if(!checkdate($array[0],$array[1],$array[2])){
			if($success) $success = false;
			echo '<p>La fecha de finalizaci&oacute;n no existe</p>';
		}
	}
}

if($success){
	$arrayinit = splitDate(trim($_POST['dateinit']));
	$arrayend = splitDate(trim($_POST['dateend']));
	$init = strtotime($arrayinit[2] . '-' . $arrayinit[0] . '-' . $arrayinit[1]);
	$end = strtotime($arrayend[2] . '-' . $arrayend[0] . '-' . $arrayend[1]);
	if($init > $end){
		$success = false;
		echo '<p>La fecha de inicio no puede ser posterior a la de finalizaci&oacute;n</p>';
	}
}

if($success) echo $success;
?>