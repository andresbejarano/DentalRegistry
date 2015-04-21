<?php
include('dbhandler.php');
$handler = new DBHandler();
$array = trim($_POST['date']); 
$date = $array[2] . '-' . $array[0] . '-' . $array[1]; //Formato "yyyy-mm-dd" para la base de datos
$schedule = $handler->getSchedule($_POST['dentist'],$date);
if($schedule != null){
	$time = mktime(0,0,0,$array[0],$array[1],$array[2]);
	$day = strtolower(date('l',$time));
	if($schedule[$day] == true){
		$hour = $init = $schedule[$day . 'init'];
		$end = $schedule[$day . 'end'];
		
		for($i = 0;$i <= ($end - $init);$i += 1){
			$table[$i][0] = $handler->getHour($hour);
			$hour += 1;
		}
		
		$appointmentcount = $handler->getAppointmentCount($date);
	}
	else{
		echo '<p>El dentista no atiende el d&iacute;a solicitado</p>';
	}
}
else{
	echo '<p>El dentista no tiene horario programado para la fecha solicitada</p>';
}
?>