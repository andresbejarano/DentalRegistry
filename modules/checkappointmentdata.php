<?php
include('dbhandler.php');
include('functions.php');
$success = true;

//El dentista es obligatorio
if($_POST['dentist'] == 0){
    if($success) $success = false;
    echo '<p>Debe ingresar el dentista</p>';
}

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

//La hora de inicio es obligatoria
if($_POST['init'] == 0){
    if($success) $success = false;
    echo '<p>Debe ingresar la hora de inicio</p>';
}

//La hora de finalizacion es obligatoria
if($_POST['end'] == 0){
    if($success) $success = false;
    echo '<p>Debe ingresar la hora de finalizaci&oacute;n</p>';
}

//La hora de inicio debe ser anterior a la hora de finalizacion
if($_POST['init'] > 0 && $_POST['end'] > 0 && $_POST['init'] >= $_POST['end']){
    if($success) $success = false;
    echo '<p>La hora de inicio de la cita no puede ser igual o posterior a la hora de finalizaci&oacute;n</p>';
}

//El tipo de cita es obligatorio
if($_POST['type'] == 0){
    if($success) $success = false;
    echo '<p>Debe ingresar el tipo de cita</p>';
}

//El subprocedimiento es obligatorio
if($_POST['subprocedure'] == 0){
    if($success) $success = false;
    echo '<p>Debe ingresar el subprocedimiento a realizar</p>';
}

//La ubicacion oral es obligatoria
if($_POST['location'] == 0){
    if($success) $success = false;
    echo '<p>Debe ingresar la ubicaci&oacute;n oral</p>';
}

//La descripcion debe ser menor de 2000 caracteres
if(strlen(trim($_POST['description'])) > 2000){
   if($success) $success = false;
   echo '<p>La descripci&oacute;n debe ser menor de 2000 caracteres</p>';
}

if($success){
    $handler = new DBHandler();
    $date = $array[2] . '-' . $array[0] . '-' . $array[1]; //Formato "yyyy-mm-dd" para la base de datos
    $schedule = $handler->getSchedule($_POST['dentist'],$date);
    
    //Si existe el horario
    if($schedule != null){
        $time = mktime(0,0,0,$array[0],$array[1],$array[2]);
        $day = strtolower(date('l',$time));
        
        //Si el dentista atiende el dia indicado
        if($schedule[$day] == true){
            $c_init = $_POST['init'];
			$c_end = $_POST['end'];
			$t_init = $schedule[$day . 'init'];
			$t_end = $schedule[$day . 'end'];
			
			//Si la cita se encuentra dentro del horario del dentista
			if($c_init >= $t_init && $c_end <= $t_end){
				$appointmentcount = $handler->getAppointmentCountByDateAndDentist($date,$_POST['dentist']);
				
				//Si hay citas registradas para ese dia
				if($appointmentcount > 0){
					$appointmentlist = $handler->getAppointmentListByDateAndDentist($date,$_POST['dentist']);
					
					//Si se esta modificando la cita
					if(isset($_POST['id'])){
						$i = 0;
						while($success && $i < $appointmentcount){
							$t_init = $appointmentlist[$i][4];
							$t_end = $appointmentlist[$i][5];
							if($_POST['id'] != $appointmentlist[$i][0] && !($c_end <= $t_init || $c_init >= $t_end)){
								if($appointmentlist[$i][9] != 'can'){
									$success = false;
									echo '<p>La cita se cruza con otra ya programada</p>';
								}
							}
							$i += 1;
						}
					}
					else{ //La cia es nueva
						$i = 0;
						while($success && $i < $appointmentcount){
							$t_init = $appointmentlist[$i][4];
							$t_end = $appointmentlist[$i][5];
							if(!($c_end <= $t_init || $c_init >= $t_end)){
								if($appointmentlist[$i][9] != 'can'){
									$success = false;
									echo '<p>La cita se cruza con otra ya programada</p>';
								}
							}
							$i += 1;
						}
					}
				}
				//Si no hay citas se puede asignar como se ha solicitado
			}
			else{
				if($success) $success = false;
				echo '<p>El dentista no atiende en el horario solicitado</p>';
			}
        }
        else{
            if($success) $success = false;
            echo '<p>El dentista no atiende el d&iacute;a solicitado</p>';
        }
    }
    else{
        if($success) $success = false;
        echo '<p>El dentista no tiene horario programado para la fecha solicitada</p>';
    }
}
if($success) echo $success;
?>