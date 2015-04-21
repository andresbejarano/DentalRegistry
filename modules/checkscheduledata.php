<?php
include('dbhandler.php');
include('functions.php');
$success = true;

//La fecha de inicio es obligatoria y con el formato mm/dd/aaaa
$dateinit = trim($_POST['dateinit']); 
if(strlen($dateinit) < 1){
   if($success) $success = false;
   echo "<p>Debe ingresar la fecha de inicio</p>";
}
else{
   $array = splitDate($dateinit);
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

//Revision del lunes
if($_POST['monday'] == 1){
   if($_POST['mondayinit'] == 0){
      if($success) $success = false;
      echo '<p>Debe ingresar la hora de inicio del lunes</p>';
   }
   if($_POST['mondayend'] == 0){
      if($success) $success = false;
      echo '<p>Debe ingresar la hora de finalizaci&oacute;n del lunes</p>';
   }
   if($_POST['mondayinit'] > 0 && $_POST['mondayend'] > 0 && $_POST['mondayinit'] >= $_POST['mondayend']){
      if($success) $success = false;
      echo '<p>La hora de inicio del lunes no puede ser posterior a la hora de finalizaci&oacute;n</p>';
   }
}

//Revision del martes
if($_POST['tuesday'] == 1){
   if($_POST['tuesdayinit'] == 0){
      if($success) $success = false;
      echo '<p>Debe ingresar la hora de inicio del martes</p>';
   }
   if($_POST['tuesdayend'] == 0){
      if($success) $success = false;
      echo '<p>Debe ingresar la hora de finalizaci&oacute;n del martes</p>';
   }
   if($_POST['tuesdayinit'] > 0 && $_POST['tuesdayend'] > 0 && $_POST['tuesdayinit'] >= $_POST['tuesdayend']){
      if($success) $success = false;
      echo '<p>La hora de inicio del martes no puede ser posterior a la hora de finalizaci&oacute;n</p>';
   }
}

//Revision del miercoles
if($_POST['wednesday'] == 1){
   if($_POST['wednesdayinit'] == 0){
      if($success) $success = false;
      echo '<p>Debe ingresar la hora de inicio del mi&eacute;rcoles</p>';
   }
   if($_POST['wednesdayend'] == 0){
      if($success) $success = false;
      echo '<p>Debe ingresar la hora de finalizaci&oacute;n del mi&eacute;rcoles</p>';
   }
   if($_POST['wednesdayinit'] > 0 && $_POST['wednesdayend'] > 0 && $_POST['wednesdayinit'] >= $_POST['wednesdayend']){
      if($success) $success = false;
      echo '<p>La hora de inicio del mi&eacute;rcoles no puede ser posterior a la hora de finalizaci&oacute;n</p>';
   }
}

//Revision del jueves
if($_POST['thursday'] == 1){
   if($_POST['thursdayinit'] == 0){
      if($success) $success = false;
      echo '<p>Debe ingresar la hora de inicio del jueves</p>';
   }
   if($_POST['thursdayend'] == 0){
      if($success) $success = false;
      echo '<p>Debe ingresar la hora de finalizaci&oacute;n del jueves</p>';
   }
   if($_POST['thursdayinit'] > 0 && $_POST['thursdayend'] > 0 && $_POST['thursdayinit'] >= $_POST['thursdayend']){
      if($success) $success = false;
      echo '<p>La hora de inicio del jueves no puede ser posterior a la hora de finalizaci&oacute;n</p>';
   }
}

//Revision del viernes
if($_POST['friday'] == 1){
   if($_POST['fridayinit'] == 0){
      if($success) $success = false;
      echo '<p>Debe ingresar la hora de inicio del viernes</p>';
   }
   if($_POST['fridayend'] == 0){
      if($success) $success = false;
      echo '<p>Debe ingresar la hora de finalizaci&oacute;n del viernes</p>';
   }
   if($_POST['fridayinit'] > 0 && $_POST['fridayend'] > 0 && $_POST['fridayinit'] >= $_POST['fridayend']){
      if($success) $success = false;
      echo '<p>La hora de inicio del viernes no puede ser posterior a la hora de finalizaci&oacute;n</p>';
   }
}

//Revision del sabado
if($_POST['saturday'] == 1){
   if($_POST['saturdayinit'] == 0){
      if($success) $success = false;
      echo '<p>Debe ingresar la hora de inicio del s&aacute;bado</p>';
   }
   if($_POST['saturdayend'] == 0){
      if($success) $success = false;
      echo '<p>Debe ingresar la hora de finalizaci&oacute;n del s&aacute;bado</p>';
   }
   if($_POST['saturdayinit'] > 0 && $_POST['saturdayend'] > 0 && $_POST['saturdayinit'] >= $_POST['saturdayend']){
      if($success) $success = false;
      echo '<p>La hora de inicio del s&aacute;bado no puede ser posterior a la hora de finalizaci&oacute;n</p>';
   }
}

//Revision del domingo
if($_POST['sunday'] == 1){
   if($_POST['sundayinit'] == 0){
      if($success) $success = false;
      echo '<p>Debe ingresar la hora de inicio del domingo</p>';
   }
   if($_POST['sundayend'] == 0){
      if($success) $success = false;
      echo '<p>Debe ingresar la hora de finalizaci&oacute;n del domingo</p>';
   }
   if($_POST['sundayinit'] > 0 && $_POST['sundayend'] > 0 && $_POST['sundayinit'] >= $_POST['sundayend']){
      if($success) $success = false;
      echo '<p>La hora de inicio del domingo no puede ser posterior a la hora de finalizaci&oacute;n</p>';
   }
}

//La descripcion debe ser menor de 300 caracteres
if(strlen(trim($_POST['description'])) > 300){
   if($success) $success = false;
   echo '<p>La descripci&oacute;n debe ser menor de 300 caracteres</p>';
}

//Al menos debe haber un dia de trabajo
if($success && $_POST['monday'] == 0 && $_POST['tuesday'] == 0 && $_POST['wednesday'] == 0 && $_POST['thursday'] == 0 && $_POST['friday'] == 0 && $_POST['saturday'] == 0 && $_POST['sunday'] == 0){
	$success = false;
	echo '<p>Debe trabajar al menos un d&iacute;a</p>';
}

if($success) echo $success;
?>