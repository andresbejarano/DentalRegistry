<?php
include('dbhandler.php');
include('functions.php');
$success = true;

//La fecha es obligatoria y con el formato mm/dd/aaaa
$date = trim($_POST['date']); 
if(strlen($date) < 1){
	if($success) $success = false;
	echo "<p>Debe ingresar la fecha del recaudo</p>";
}
else{
	$array = splitDate($date);
	if(!(sizeof($array) == 3 && is_numeric($array[0]) && is_numeric($array[1]) && is_numeric($array[2]))){
		if($success) $success = false;
		echo '<p>Formato inv&aacute;lido de la fecha del recaudo</p>';
	}
	else{
		if(!checkdate($array[0],$array[1],$array[2])){
			if($success) $success = false;
			echo '<p>La fecha ingresada no existe</p>';
		}
	}
}

//El valor es obligatorio y debe ser numerico
$value = trim($_POST['value']);
if(strlen($value) < 1){
	if($success) $success = false;
	echo "<p>Debe ingresar el valor del recaudo</p>";
}
else{
	if(!is_numeric($value)){
		if($success) $success = false;
		echo "<p>El valor del recaudo debe ser num&eacute;rico</p>";
	}
}

//La forma de pago es obligatoria
if($_POST['paymenttype'] == 0){
	if($success) $success = false;
	echo '<p>Debe ingresar la forma de pago</p>';
}

//La descripcion debe ser menor de 2000 caracteres
if(strlen(trim($_POST['description'])) > 2000){
	if($success) $success = false;
	echo '<p>La descripci&oacute;n debe ser menor de 2000 caracteres</p>';
}

if($success) echo $success;
?>