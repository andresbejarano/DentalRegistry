<?php
include('dbhandler.php');
include('functions.php');
$success = true;

//La fecha es obligatoria y con el formato mm/dd/aaaa
$date = trim($_POST['date']); 
if(strlen($date) < 1){
	if($success) $success = false;
	echo '<p>Debe ingresar la fecha de la cita</p>';
}
else{
	$array = splitDate($date);
	if(!(sizeof($array) == 3 && is_numeric($array[0]) && is_numeric($array[1]) && is_numeric($array[2]))){
		if($success) $success = false;
		echo '<p>Formato inv&aacute;lido de la fecha de la cita</p>';
	}
	else{
		if(!checkdate($array[0],$array[1],$array[2])){
			if($success) $success = false;
			echo '<p>La fecha ingresada no existe</p>';
		}
	}
}
if($success) echo $success;
?>