<?php
include('dbhandler.php');
$success = true;

//El codigo es obligatorio y no debe estar en la base de datos
$code = trim($_POST['code']);
if(strlen($code) < 1){
	if($success) $success = false;
	echo "<p>Debe ingresar el c&oacute;digo</p>";
}
else{
	$handler = new DBHandler();
	$id = $handler->getLocationId($code);
	if(isset($_POST['id'])){//Se esta modificando el procedimiento
		if($id != 0 && $id != $_POST['id']){
			$success = false;
			echo '<p>Ya se encuentra registrado el c&oacute;digo</p>';
		}
	}
	else{//Se esta agregando el procedimiento
		if($id != 0){
			if($success) $success = false;
			echo '<p>Ya se encuentra registrado el c&oacute;digo</p>';
		}
	}
}

//La descripcion debe ser menor de 2000 caracteres
if(strlen(trim($_POST['description'])) > 2000){
   if($success) $success = false;
   echo '<p>La descripci&oacute;n debe ser menor de 2000 caracteres</p>';
}

if($success) echo $success;
?>