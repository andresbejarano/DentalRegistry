<?php
session_start();
include('modules/dbhandler.php');
include('modules/functions.php');
if(isset($_SESSION['id'])){
	if($_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web'){
		if(isset($_GET['id'])){
			$handler = new DBHandler();
			$patientdata = $handler->getPatientDataById($_GET['id']);
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
		<title>Dental: Estado del Paciente</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/statepatient.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('select[name="active"]').val(<?php echo $patientdata['active'];?>);
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
				if($patientdata != null){
					?>
					<legend>Estado de Paciente: <a href="patient.php?id=<?php echo $patientdata['id'];?>"><?php echo $patientdata['firstname'] . ' ' . $patientdata['firstlastname'] . ' ' . $patientdata['secondlastname'];?></a></legend>
					<form action="#">
						<p class="form">
							<label for="id">Id Paciente</label>
							<input id="id" name="id" readonly="readonly" style="width:10%;" type="text" value="<?php echo $patientdata['id'];?>" />
						</p>
						<p class="form">
							<label for="active">Estado</label>
							<select id="active" name="active">
								<option value="0">Inactivo</option>
								<option value="1">Activo</option>
							</select>
						</p>
						<p class="form center">
							<img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
							<input type="button" value="Activar/Inactivar Paciente" />
						</p>
					</form>
					<?php
				}
				else{
					?>
					<legend>Paciente no encontrado</legend>
					<p class="center warning">Paciente no encontrado</p>
					<?php
				}
				?>
			</fieldset>
			<div id="message" style="display:none;"></div>
		</div>
	</body>
</html>