<?php
$success = true;

if($_POST['patient'] <= 0 && $_POST['user'] <= 0){
   if($success) $success = false;
   echo '<p>Error en los datos del paciente y/o usuario</p>';
}

//Revision de cada uno de los procedimientos
$total = 0;
for($i = 1;$i <= 20;$i += 1){
   $procedure = 'procedure' . $i;
   $location = 'location' . $i;
   if($_POST[$procedure] > 0 && $_POST[$location] == 0){
      if($success) $success = false;
      echo '<p>Debe ingresar la ubicaci&oacute;n en el procedimiento ' . $i . '</p>';
   }
   else{
      if($_POST[$procedure] == 0 && $_POST[$location] > 0){
         if($success) $success = false;
         echo '<p>Debe ingresar el procedimiento en la ubicaci&oacute;n ' . $i . '</p>';
      }
      else{
         if($_POST[$procedure] > 0 && $_POST[$location] > 0){
            $total += 1;
         }
      }
   }
}
if($success && $total == 0){
   $success = false;
   echo '<p>Debe ingresar al menos un procedimiento</p>';
}

$discount = trim($_POST['discount']);
if(!is_numeric($discount)){
	if($success) $success = false;
	echo '<p>El valor del descuento no es v&aacute;lido</p>';
}
else{
	if($discount < 0 || $discount > 1){
		if($success) $success = false;
		echo '<p>El valor del descuento debe estar entre 0 y 1</p>';
	}
}

//La descripcion debe ser menor de 2000 caracteres
if(strlen(trim($_POST['description'])) > 2000){
   if($success) $success = false;
   echo '<p>La descripci&oacute;n debe ser menor de 2000 caracteres</p>';
}

if($success) echo $success;
?>