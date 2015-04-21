<?php
include('dbhandler.php');
include('functions.php');
$Handler = new DBHandler();

$insert = 'INSERT INTO `dental`.`schedule`(';
$values = 'VALUES(';

//Usuario
$insert .= '`dentist`';
$values .= $_POST['dentist'];

//Fecha de inicio
$date = splitDate(trim($_POST['dateinit']));
$insert .= ',`dateinit`';
$values .= ',' . '"' . $date[2] . '-' . $date[0] . '-' . $date[1] . '"';

//Lunes
if($_POST['monday'] == 1){
   $insert .= ',`monday`';
   $values .= ',1';
   $insert .= ',`mondayinit`';
   $values .= ',' . $_POST['mondayinit'] . '';
   $insert .= ',`mondayend`';
   $values .= ',' . $_POST['mondayend'] . '';
}

//Martes
if($_POST['tuesday'] == 1){
   $insert .= ',`tuesday`';
   $values .= ',1';
   $insert .= ',`tuesdayinit`';
   $values .= ',' . $_POST['tuesdayinit'] . '';
   $insert .= ',`tuesdayend`';
   $values .= ',' . $_POST['tuesdayend'] . '';
}

//Miercoles
if($_POST['wednesday'] == 1){
   $insert .= ',`wednesday`';
   $values .= ',1';
   $insert .= ',`wednesdayinit`';
   $values .= ',' . $_POST['wednesdayinit'] . '';
   $insert .= ',`wednesdayend`';
   $values .= ',' . $_POST['wednesdayend'] . '';
}

//Jueves
if($_POST['thursday'] == 1){
   $insert .= ',`thursday`';
   $values .= ',1';
   $insert .= ',`thursdayinit`';
   $values .= ',' . $_POST['thursdayinit'] . '';
   $insert .= ',`thursdayend`';
   $values .= ',' . $_POST['thursdayend'] . '';
}

//Viernes
if($_POST['friday'] == 1){
   $insert .= ',`friday`';
   $values .= ',1';
   $insert .= ',`fridayinit`';
   $values .= ',' . $_POST['fridayinit'] . '';
   $insert .= ',`fridayend`';
   $values .= ',' . $_POST['fridayend'] . '';
}

//Sabado
if($_POST['saturday'] == 1){
   $insert .= ',`saturday`';
   $values .= ',1';
   $insert .= ',`saturdayinit`';
   $values .= ',' . $_POST['saturdayinit'] . '';
   $insert .= ',`saturdayend`';
   $values .= ',' . $_POST['saturdayend'] . '';
}

//Domingo
if($_POST['sunday'] == 1){
   $insert .= ',`sunday`';
   $values .= ',1';
   $insert .= ',`sundayinit`';
   $values .= ',' . $_POST['sundayinit'] . '';
   $insert .= ',`sundayend`';
   $values .= ',' . $_POST['sundayend'] . '';
}

//Descripcion
$description = trim($_POST['description']);
if(strlen($description) > 0){
   $insert .= ',`description`';
   $values .= ',"' . $description . '"';
}

$query = $insert . ') ' . $values . ')';

$success = $Handler->executeQuery($query);
if($success == 1)
   echo $success;
else
   echo $query;
?>