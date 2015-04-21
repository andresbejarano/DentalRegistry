<?php
include('dbhandler.php');
include('functions.php');
$success = true;

//El numero del documento de identidad es obligatorio y debe ser numerico
$documentnumber = trim($_POST['documentnumber']); 
if(strlen($documentnumber) < 1){
	if($success) $success = false;
	echo "<p>Debe ingresar el n&uacute;mero del documento de identificaci&oacute;n</p>";
}
else{
	if(!is_numeric($documentnumber)){
		if($success) $success = false;
		echo "<p>Valor del n&uacute;mero del documento de identificaci&oacute;n inv&aacute;lido</p>";
	}
	else{
		$handler = new DBHandler();
		$id = $handler->getPatientId($_POST['documenttype'],$documentnumber);
		if(isset($_POST['id'])){ //Se esta modificando el paciente
			if($id != 0 && $id != $_POST['id']){
				$success = false;
				echo '<p>Ya se encuentra registrado el documento de identidad</p>';
			}
		}
		else{ //Se esta agregando un nuevo paciente
			if($id != 0){
				if($success) $success = false;
				echo '<p>Ya se encuentra registrado el documento de identidad</p>';
			}
		}
	}
}

//El primer nombre es obligatorio
if(strlen(trim($_POST['firstname'])) < 1){
	if($success) $success = false;
	echo "<p>Debe ingresar el primer nombre</p>";
}

//El primer apellido es obligatorio
if(strlen(trim($_POST['firstlastname'])) < 1){
	if($success) $success = false;
	echo "<p>Debe ingresar el primer apellido</p>";
}

//El segundo apellido es obligatorio
if(strlen(trim($_POST['secondlastname'])) < 1){
	if($success) $success = false;
	echo "<p>Debe ingresar el segundo apellido</p>";
}

//La fecha es obligatoria y con el formato mm/dd/aaaa
$date = trim($_POST['birthdate']); 
if(strlen($date) < 1){
	if($success) $success = false;
	echo "<p>Debe ingresar la fecha de nacimiento</p>";
}
else{
	$array = splitDate($date);
	if(!(sizeof($array) == 3 && is_numeric($array[0]) && is_numeric($array[1]) && is_numeric($array[2]))){
		if($success) $success = false;
		echo '<p>Formato inv&aacute;lido de la fecha de nacimiento</p>';
	}
	else{
		if(!checkdate($array[0],$array[1],$array[2])){
			if($success) $success = false;
			echo '<p>La fecha ingresada no existe</p>';
		}
	}
}

//La direccion es obligatoria
if(strlen(trim($_POST['address'])) < 1){
	if($success) $success = false;
	echo "<p>Debe ingresar la direcci&oacute;n</p>";
}

//El telefono de la casa es obligatorio
if(strlen(trim($_POST['phonehome'])) < 1){
	if($success) $success = false;
	echo "<p>Debe ingresar el tel&eacute;fono</p>";
}

if($success) echo $success;
?>