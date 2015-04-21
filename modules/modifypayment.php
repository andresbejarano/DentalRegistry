<?php
include('dbhandler.php');
include('functions.php');

$update = 'UPDATE `dental`.`payment` SET ';

//Fecha
$date = splitDate(trim($_POST['date']));
$update .= '`date` = "' . $date[2] . '-' . $date[0] . '-' . $date[1] . '"';

//Valor
$update .= ',`value` = ' . trim($_POST['value']) . '';

//Forma de pago
$update .= ',`paymenttype` =  ' . $_POST['paymenttype'] . '';

//Numero
if(strlen(trim($_POST['number'])) > 0){
   $update .= ',`number` =  "' . trim($_POST['number']) . '"';
}
else{
   $update .= ',`number` =  NULL';
}

//Banco
if($_POST['bank'] > 0){
   $update .= ',`bank` =  ' . $_POST['bank'] . '';
}
else{
   $update .= ',`bank` =  NULL';
}

//Descripcion
$description = trim($_POST['description']);
if(strlen($description) > 0){
   $update .= ',`description` =  "' . trim($_POST['description']) . '"';
}
else{
   $update .= ',`description` =  NULL';
}

$update .= ' WHERE id = ' . $_POST['id'];
$handler = new DBHandler();
$success = $handler->executeQuery($update);
if($success)echo $success;
else echo $update;
?>