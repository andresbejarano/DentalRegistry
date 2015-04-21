<?php
session_start();
include('modules/dbhandler.php');
include('modules/functions.php');
if(isset($_SESSION['id'])){
	$handler = new DBHandler();
	$userdata = $handler->getUserDataById($_SESSION['id']);
}
else{
	header('Location:index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Dental: Ver Datos Personales</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/showpersonaldata.js"></script>
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
				if($userdata != null){
					?>
					<legend>Datos Personales: <?php echo $userdata['firstname'] . ' ' . $userdata['firstlastname'] . ' ' . $userdata['secondlastname'];?></legend>
					<form action="#">
						<p class="form">
							<label for="id">Id Usuario</label>
							<input id="id" name="id" type="text" style="width:10%;" value="<?php echo $userdata['id'];?>" />
						</p>
						<p class="form">
							<label for="documenttype">Tipo de Identificaci&oacute;n</label>
							<input id="documenttype" name="documenttype" type="text" value="<?php echo getDocumenttype($userdata['documenttype']);?>" />
						</p>
						<p class="form">
							<label for="documentnumber">No. Identificaci&oacute;n</label>
							<input id="documentnumber" name="documentnumber" type="text" style="width:10%;" value="<?php echo $userdata['documentnumber'];?>" />
						</p>
						<p class="form">
							<label for="firstname">Primer Nombre</label>
							<input id="firstname" name="firstname" type="text" value="<?php echo $userdata['firstname'];?>" />
						</p>
						<p class="form">
							<label for="middlename">Segundo Nombre</label>
							<input id="middlename" name="middlename" type="text" value="<?php echo $userdata['middlename'];?>" />
						</p>
						<p class="form">
							<label for="firstlastname">Primer Apellido</label>
							<input id="firstlastname" name="firstlastname" type="text" value="<?php echo $userdata['firstlastname'];?>" />
						</p>
						<p class="form">
							<label for="secondlastname">Segundo Apellido</label>
							<input id="secondlastname" name="secondlastname" type="text" value="<?php echo $userdata['secondlastname'];?>" />
						</p>
						<p class="form">
							<label for="sex">Sexo</label>
							<input id="sex" name="sex" style="width:10%;" type="text" value="<?php echo getSex($userdata['sex']);?>" />
						</p>
						<p class="form">
							<label for="birthdate">Fecha de Nacimiento</label>
							<input id="birthdate" name="birthdate" type="text" style="width:10%;" value="<?php echo toFormDate($userdata['birthdate']);?>" />
							<span style="font-style:italic;">mm/dd/aaaa</span>
						</p>
						<p class="form">
							<label for="bloodtype">R.H.</label>
							<input id="bloodtype" name="bloodtype" style="width:10%;" type="text" value="<?php echo getBloodtype($userdata['bloodtype']);?>" />
						</p>
						<p class="form">
							<label for="address">Direcci&oacute;n</label>
							<input id="address" name="address" type="text" value="<?php echo $userdata['address'];?>" />
						</p>
						<p class="form">
							<label for="phonehome">Tel&eacute;fono fijo</label>
							<input id="phonehome" name="phonehome" type="text" style="width:10%;" value="<?php echo $userdata['phonehome'];?>" />
						</p>
						<p class="form">
							<label for="phoneoffice">Tel&eacute;fono oficina</label>
							<input id="phoneoffice" name="phoneoffice" type="text" style="width:10%;" value="<?php echo $userdata['phoneoffice'];?>" />
						</p>
						<p class="form">
							<label for="cellnumber">Celular</label>
							<input id="cellnumber" name="cellnumber" type="text" style="width:10%;" value="<?php echo $userdata['cellnumber'];?>" />
						</p>
						<p class="form">
							<label for="email">Correo Electr&oacute;nico</label>
							<input id="email" name="email" type="text" value="<?php echo $userdata['email'];?>" />
						</p>
						<p class="form">
							<label for="maritalstatus">Estado Civil</label>
							<input id="maritalstatus" name="maritalstatus" type="text" value="<?php echo getMaritalStatus($userdata['maritalstatus']);?>" />
						</p>
						<p class="form">
							<label for="dentist">Dentista</label>
							<input id="dentist" name="dentist" type="text" style="width:10%;" value="<?php echo getDentist($userdata['dentist']);?>" />
						</p>
						<p class="form">
							<label for="specialty">Especialidad</label>
							<input id="specialty" name="specialty" type="text" style="width:10%;" value="<?php echo $handler->getSpecialtyName($userdata['specialty']);?>" />
						</p>
						<p class="form">
							<label for="username">Nombre de usuario</label>
							<input id="username" name="username" style="width:10%;" type="text" value="<?php echo $userdata['username'];?>" />
						</p>
						<p class="form">
							<label for="privileges">Privilegios</label>
							<input id="privileges" name="privileges" style="width:10%;" type="text" value="<?php echo getPrivileges($userdata['privileges']);?>" />
						</p>
					</form>
					<?php
				}
		    else{
					?>
					<legend>Usuario no encontrado</legend>
					<p class="center">Usuario no encontrado</p>
					<?php
				}
			?>
			</fieldset>
			<div id="message" style="display:none;"></div>
		</div>
	</body>
</html>