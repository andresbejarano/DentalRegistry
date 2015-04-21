<?php
session_start();
include('modules/dbhandler.php');
include('modules/functions.php');
if(isset($_SESSION['id'])){
	if($_SESSION['privileges'] == 'sec' || $_SESSION['privileges'] == 'aux' || $_SESSION['privileges'] == 'den' || $_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web'){
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
		<title>Dental: Modificar Datos</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/modifypatient.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('select[name="documenttype"]').val(<?php echo getDocumentTypeCode($patientdata['documenttype']);?>);
				$('select[name="sex"]').val(<?php echo getSexCode($patientdata['sex']);?>);
				$('select[name="bloodtype"]').val(<?php echo getBloodtypeCode($patientdata['bloodtype']);?>);
				$('select[name="maritalstatus"]').val(<?php echo getMaritalstatusCode($patientdata['maritalstatus']);?>);
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
					<legend>Modificar Datos: <a href="patient.php?id=<?php echo $patientdata['id'];?>"><?php echo $patientdata['firstname'] . ' ' . $patientdata['firstlastname'] . ' ' . $patientdata['secondlastname'];?></a></legend>
					<?php
					if($patientdata['active'] == 1){
						?>
						<form action="#">
							<p class="form">
								<label for="id">Id Paciente</label>
								<input id="id" name="id" readonly="readonly" type="text" style="width:10%;" value="<?php echo $patientdata['id'];?>" />
							</p>
							<p class="form">
								<label for="documenttype">Tipo de Identificaci&oacute;n</label>
								<select id="documenttype" name="documenttype">
									<option value="1">C&eacute;dula de Ciudadan&iacute;a</option>
									<option value="2">Tarjeta de Identidad</option>
									<option value="3">Registro Civil</option>
									<option value="4">Pasaporte</option>
									<option value="5">C&eacute;dula de Extranjer&iacute;a</option>
								</select>
							</p>
							<p class="form">
								<label for="documentnumber">*No. Identificaci&oacute;n</label>
								<input id="documentnumber" name="documentnumber" type="text" style="width:10%;" value="<?php echo $patientdata['documentnumber'];?>" />
							</p>
							<p class="form">
								<label for="firstname">*Primer Nombre</label>
								<input id="firstname" name="firstname" type="text" value="<?php echo $patientdata['firstname'];?>" />
							</p>
							<p class="form">
								<label for="middlename">Segundo Nombre</label>
								<input id="middlename" name="middlename" type="text" value="<?php echo $patientdata['middlename'];?>" />
							</p>
							<p class="form">
								<label for="firstlastname">*Primer Apellido</label>
								<input id="firstlastname" name="firstlastname" type="text" value="<?php echo $patientdata['firstlastname'];?>" />
							</p>
							<p class="form">
								<label for="secondlastname">*Segundo Apellido</label>
								<input id="secondlastname" name="secondlastname" type="text" value="<?php echo $patientdata['secondlastname'];?>" />
							</p>
							<p class="form">
								<label for="sex">Sexo</label>
								<select id="sex" name="sex">
									<option value="1">Masculino</option>
									<option value="2">Femenino</option>
								</select>
							</p>
							<p class="form">
								<label for="birthdate">*Fecha de Nacimiento</label>
								<input id="birthdate" name="birthdate" type="text" style="width:10%;" value="<?php echo toFormDate($patientdata['birthdate']);?>" />
								<span style="font-style:italic;">mm/dd/aaaa</span>
							</p>
							<p class="form">
								<label for="bloodtype">R.H.</label>
								<select id="bloodtype" name="bloodtype">
									<option value="1">O-</option>
									<option value="2">O+</option>
									<option value="3">A-</option>
									<option value="4">A+</option>
									<option value="5">B-</option>
									<option value="6">B+</option>
									<option value="7">AB-</option>
									<option value="8">AB+</option>
								</select>
							</p>
							<p class="form">
								<label for="address">*Direcci&oacute;n</label>
								<input id="address" name="address" type="text" value="<?php echo $patientdata['address'];?>" />
							</p>
							<p class="form">
								<label for="phonehome">*Tel&eacute;fono fijo</label>
								<input id="phonehome" name="phonehome" type="text" style="width:10%;" value="<?php echo $patientdata['phonehome'];?>" />
							</p>
							<p class="form">
								<label for="phoneoffice">Tel&eacute;fono oficina</label>
								<input id="phoneoffice" name="phoneoffice" type="text" style="width:10%;" value="<?php echo $patientdata['phoneoffice'];?>" />
							</p>
							<p class="form">
								<label for="cellnumber">Celular</label>
								<input id="cellnumber" name="cellnumber" type="text" style="width:10%;" value="<?php echo $patientdata['cellnumber'];?>" />
							</p>
							<p class="form">
								<label for="email">Correo Electr&oacute;nico</label>
								<input id="email" name="email" type="text" value="<?php echo $patientdata['email'];?>" />
							</p>
							<p class="form">
								<label for="maritalstatus">Estado Civil</label>
								<select id="maritalstatus" name="maritalstatus">
									<option value="1">Soltero</option>
									<option value="2">Casado</option>
									<option value="3">Uni&oacute;n Libre</option>
									<option value="4">Separado</option>
									<option value="5">Divorciado</option>
									<option value="6">Viudo</option>
								</select>
							</p>
							<p class="form">
								<label for="occupation">Ocupaci&oacute;n</label>
								<input id="occupation" name="occupation" type="text" value="<?php echo $patientdata['occupation'];?>" />
							</p>
							
							<p class="form">
								<label for="contact">Acudiente</label>
								<input id="contact" name="contact" type="text" value="<?php echo $patientdata['contact'];?>" />
							</p>
							<p class="form">
								<label for="contactnumber">N&uacute;mero Acudiente</label>
								<input id="contactnumber" name="contactnumber" type="text" value="<?php echo $patientdata['contactnumber'];?>" />
							</p>
							
							
							<p class="form center">
								<img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
								<input type="button" value="Modificar Paciente" />
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
		        ?>
			</fieldset>
		    <div id="message" style="display:none;"></div>
        </div>
	</body>
</html>