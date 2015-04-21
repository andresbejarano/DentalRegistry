<?php
session_start();
include('modules/dbhandler.php');
include('modules/functions.php');
if(isset($_SESSION['id'])){
	if($_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web'){
		if(isset($_GET['id'])){
			$handler = new DBHandler();
			$data = $handler->getAppointmentData($_GET['id']);
			if($data != null){
				$patientname = $handler->getPatientName($data['patient']);
				$username = $handler->getUserName($data['dentist']);
			}
		}
		else{
			header('Location:error.php');
		}
	}
	else{
		header('Location:denied.php');
	}
}
else{
	header('Location:index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Dental: Estado de Cita</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/stateappointment.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('select[name="status"]').val(<?php echo getAppointmentStatusCode($data['status']);?>);
			});
		</script>
    </head>
    <body>
		<div id="header">
		    <div class="center"><a href="menu.php"><img alt="logo" src="images/logo.png" /></a></div>
			<div class="usersession">
		        <img alt="user" src="images/user.png" />
		        Registrado como <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['firstlastname'] . ' ' . $_SESSION['secondlastname'];?> | 
		        <a href="logout.php" class="session">Cerrar Sesi&oacute;n</a>
		    </div>
		</div>
        <div id="outer-wrapper">
			<fieldset>
				<?php
				if($data != null){
					?>
					<legend>Estado de Cita: <a href="patient.php?id=<?php echo $data['patient'];?>"><?php echo $patientname;?></a></legend>
					<form action="#">
						<p class="form">
							<label for="id">Id</label>
							<input id="id" name="id" readonly="readonly" style="width:10%;" type="text" value="<?php echo $data['id'];?>" />
						</p>
						<p class="form">
							<label for="patient">Id Paciente</label>
							<input id="patient" name="patient" readonly="readonly" style="width:10%;" type="text" value="<?php echo $data['patient'];?>" />
						</p>
						<p class="form">
							<label for="dentistname">Dentista</label>
							<input id="dentistname" name="dentistname" readonly="readonly" type="text" value="<?php echo $username;?>" />
						</p>
						<p class="form">
							<label for="date">Fecha</label>
							<input id="date" name="date" readonly="readonly" style="width:10%;" type="text" value="<?php echo toFormDate($data['date']);?>" />
						</p>
						<p class="form">
							<label for="init">Hora de Inicio</label>
							<input id="init" name="init" readonly="readonly" style="width:10%;" type="text" value="<?php echo $handler->getHour($data['init']);?>" />
						</p>
						<p class="form">
							<label for="end">Hora de Finalizaci&oacute;n</label>
							<input id="end" name="end" readonly="readonly" style="width:10%;" type="text" value="<?php echo $handler->getHour($data['end']);?>" />
						</p>
						<p class="form">
							<label for="type">Tipo</label>
							<input id="type" name="type" readonly="readonly" style="width:10%;" type="text" value="<?php echo getAppointmentType($data['type']);?>" />
						</p>
						<p class="form">
							<label for="current">Estado actual</label>
							<input id="current" name="current" readonly="readonly" style="width:10%;" type="text" value="<?php echo getAppointmentStatus($data['status']);?>" />
						</p>
						<p class="form">
							<label for="status">Cambiar a</label>
							<select id="status" name="status">
								<option value="1">Solicitada</option>
								<option value="2">Confirmada</option>
								<option value="3">Cumplida</option>
								<option value="4">Incumplida</option>
								<option value="5">Cancelada</option>
							</select>
						</p>
						<p class="form center">
							<img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
							<input type="button" value="Cambiar Estado de Cita" />
						</p>
					</form>
					<?php
				}
				else{
					?>
					<legend>Cita no encontrada</legend>
					<p class="center warning">Cita no encontrada</p>
					<?php
				}
				?>
			</fieldset>
			<div id="message" style="display:none;"></div>
		</div>
	</body>
</html>