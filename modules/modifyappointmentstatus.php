<?php
include('dbhandler.php');
$handler = new DBHandler();
if($_POST['current'] == 'Cancelada'){
	echo '<p>Las citas canceladas no pueden ser reprogramadas</p>';
	echo '<p>Vuelva a crear la cita en la opci&oacute;n de <a href="addappointment.php?id=' . $_POST['patient'] . '">Agendar Citas</a></p>';
}
else{
	$update = 'UPDATE `dental`.`appointment` SET ';
	$update .= '`status` = ' . $_POST['status'];
	$update .= ' WHERE `id` = ' . $_POST['id'];
	$success = $handler->executeQuery($update);
	if($success) echo $success;
	else echo $update;
}
?>