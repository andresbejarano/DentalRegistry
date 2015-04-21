<?php
session_start();
include('modules/dbhandler.php');
include('modules/functions.php');
if(isset($_SESSION['id'])){
    if($_SESSION['privileges'] == 'sec' || $_SESSION['privileges'] == 'aux' || $_SESSION['privileges'] == 'den' || $_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web'){
        if(isset($_GET['id'])){
			$handler = new DBHandler();
            $appointmentdata = $handler->getAppointmentData($_GET['id']);
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
		<title>Dental: Modificar Cita</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="styles/reset.css" />
		<link rel="stylesheet" type="text/css" href="styles/default.css" />
		<link rel="stylesheet" type="text/css" href="cupertino/jquery-ui-1.8.10.custom.css" />
		<script type="text/javascript" src="javascript/jquery-1.5.min.js"></script>
		<script type="text/javascript" src="cupertino/jquery-ui-1.8.10.custom.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#date').datepicker();
				var $message = $('#message');
				$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
				$('select[name="dentist"]').val(<?php echo $appointmentdata['dentist'];?>);
				$('select[name="init"]').val(<?php echo $appointmentdata['init'];?>);
				$('select[name="end"]').val(<?php echo $appointmentdata['end'];?>);
				$('select[name="type"]').val(<?php echo getAppointmentTypeCode($appointmentdata['type']);?>);
				$('select[name="subprocedure"]').val(<?php echo $appointmentdata['subprocedure'];?>);
				$('select[name="location"]').val(<?php echo $appointmentdata['location'];?>);
				$('select[name="status"]').val(<?php echo getAppointmentStatusCode($appointmentdata['status']);?>);
				
				$('input:button').button().click(function(){
					var $formdata = $('form').serialize();
					$('input:button').hide();
					$('#loader').show();
					$.post('modules/checkappointmentdata.php',$formdata,function(value){
						if(value == '1'){
							$.post('modules/modifyappointment.php',$formdata,function(data){
								if(data == '1'){
									$message.html('Cita modificada satisfactoriamente');
									$message.dialog({
										title:'<img alt="success" src="images/success.png" /> Modificaci&oacute;n satisfactoria',
										buttons:{
											'Volver al Paciente':function(){window.location = 'patient.php?id=<?php echo $appointmentdata['patient'];?>';},
											'Menu Principal':function(){window.location = 'menu.php';}
										}
									});
								}
								else{
									$message.html(data);
									$message.dialog({
										title:'<img alt="warning" src="images/warning.png" /> Error de datos',
										buttons:{'Aceptar':function(){$(this).dialog('close');}}
									});
								}
								$message.dialog('open');
							});
						}
						else{
							$message.html(value);
							$message.dialog({
								title:'<img alt="warning" src="images/warning.png" /> Error de datos',
								buttons:{'Aceptar':function(){$(this).dialog('close');}}
							});
							$message.dialog('open');
						}
						$('input:button').show();
						$('#loader').hide();
					});
				});
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
				if($appointmentdata != null){
					$patientdata = $handler->getPatientDataById($appointmentdata['patient']);
					if($patientdata != null){
						?>
						<legend>Modificar Cita: <a href="patient.php?id=<?php echo $patientdata['id'];?>"><?php echo $patientdata['firstname'] . ' ' . $patientdata['firstlastname'] . ' ' . $patientdata['secondlastname'];?></a></legend>
						<?php
						if($patientdata['active'] == 1){
							?>
							<form>
								<p class="form">
									<label for="id">Id Cita</label>
									<input id="id" name="id" readonly="readonly" style="width:10%;" type="text" value="<?php echo $appointmentdata['id'];?>" />
								</p>
								<p class="form">
									<label for="patient">Id Paciente</label>
									<input id="patient" name="patient" readonly="readonly" style="width:10%;" type="text" value="<?php echo $appointmentdata['patient'];?>" />
								</p>
								<p class="form">
									<label for="dentist">Dentista</label>
									<select id="dentist" name="dentist"><?php writeDentistList();?></select>
								</p>
								<p class="form">
									<label for="date">Fecha</label>
									<input id="date" name="date" readonly="readonly" style="width:10%;" type="text" value="<?php echo toFormDate($appointmentdata['date']);?>" />
									<span style="font-style:italic;">mm/dd/aaaa</span>
								</p>
								<p class="form">
									<label for="init">Hora de Inicio</label>
									<select id="init" name="init"><?php echo writeTimeList();?></select>
								</p>
								<p class="form">
									<label for="end">Hora de Finalizaci&oacute;n</label>
									<select id="end" name="end"><?php echo writeTimeList();?></select>
								</p>
								<p class="form">
									<label for="type">Tipo de Cita</label>
									<select id="type" name="type">
										<option value="0">---</option>
										<option value="1">Valoraci&oacute;n</option>
										<option value="2">Tratamiento</option>
										<option value="3">Control</option>
									</select>
								</p>
								<p class="form">
									<label for="subprocedure">Subprocedimiento</label>
									<select id="subprocedure" name="subprocedure"><?php writeSubprocedureList();?></select>
								</p>
								<p class="form">
									<label for="location">Ubicaci&oacute;n Oral</label>
									<select id="location" name="location"><?php echo writeLocationList();?></select>
								</p>
								<p class="form">
									<label for="status">Estado</label>
									<select id="status" name="status">
										<option value="1">Solicitada</option>
										<option value="2">Confirmada</option>
										<option value="3">Cumplida</option>
										<option value="4">Incumplida</option>
										<option value="5">Cancelada</option>
									</select>
								</p>
								<p class="form">
									<label for="description">Descripci&oacute;n</label>
									<textarea id="description" name="description"><?php echo $appointmentdata['description'];?></textarea>
								</p>
								<p class="form center">
									<img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
									<input type="button" value="Modificar Cita" />
								</p>
							</form>
							<?php
						}
						else{
							?>
							<p class="center warning">El paciente se encuentra inactivo<br />Consulte a gerencia para el proceso de activaci&oacute;n</p>
							<?php
						}
					}
					else{
						?>
						<legend>Paciente no encontrado</legend>
						<p class="center warning">Paciente no encontrado</p>
						<?php
					}
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