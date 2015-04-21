<?php
session_start();
include('modules/dbhandler.php');
include('modules/functions.php');
if(isset($_SESSION['id'])){
	if(!($_SESSION['privileges'] == 'sec' || $_SESSION['privileges'] == 'aux' || $_SESSION['privileges'] == 'den' || $_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web')){
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
		<title>Dental: Agregar Usuario</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/adduser.js"></script>
	</head>
	<body>

		<div id="header">
			<div class="center"><a href="menu.php"><img alt="logo" src="images/logo.png" /></a></div>
			<ul class="innerlinks">
				<li><a href="adduser.php">Agregar Usuario</a></li>
				<li><a href="loaduser.php">Cargar Usuario</a></li>
				<li><a href="userslist.php">Lista de Usuarios</a></li>
			</ul>
			<div class="usersession">
				<img alt="user" src="images/user.png" />
				Registrado como <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['firstlastname'] . ' ' . $_SESSION['secondlastname'];?> | 
				<a href="logout.php" class="session">Cerrar Sesi&oacute;n</a>
			</div>
		</div>

		<div id="outer-wrapper">
			<fieldset>
				<legend>Agregar Usuario</legend>
				<form action="#">
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
		                <input id="documentnumber" name="documentnumber" type="text" style="width:10%;" />
		            </p>
		            <p class="form">
		                <label for="firstname">*Primer Nombre</label>
		                <input id="firstname" name="firstname" type="text" />
		            </p>
		            <p class="form">
		                <label for="middlename">Segundo Nombre</label>
		                <input id="middlename" name="middlename" type="text" />
		            </p>
		            <p class="form">
		                <label for="firstlastname">*Primer Apellido</label>
		                <input id="firstlastname" name="firstlastname" type="text" />
		            </p>
		            <p class="form">
		                <label for="secondlastname">*Segundo Apellido</label>
		                <input id="secondlastname" name="secondlastname" type="text" />
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
		                <input id="birthdate" name="birthdate" type="text" style="width:10%;" />
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
		                <input id="address" name="address" type="text" />
		            </p>
		            <p class="form">
		                <label for="phonehome">*Tel&eacute;fono fijo</label>
		                <input id="phonehome" name="phonehome" type="text" style="width:10%;" />
		            </p>
		            <p class="form">
		                <label for="phoneoffice">Tel&eacute;fono oficina</label>
		                <input id="phoneoffice" name="phoneoffice" type="text" style="width:10%;" />
		            </p>
		            <p class="form">
		                <label for="cellnumber">Celular</label>
		                <input id="cellnumber" name="cellnumber" type="text" style="width:10%;" />
		            </p>
		            <p class="form">
		                <label for="email">Correo Electr&oacute;nico</label>
		                <input id="email" name="email" type="text" />
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
		                <label for="dentist">&iquest;Activar como dentista?</label>
		                <select id="dentist" name="dentist">
		                    <option value="0">No</option>
		                    <option value="1">Si</option>
		                </select>
		            </p>
		            <p class="form">
		                <label for="specialty">*Especialidad (solo si es dentista)</label>
		                <select disabled="disabled" id="specialty" name="specialty"><?php writeSpecialtyList();?></select>
		            </p>
		            <p class="form">
		                <label for="username">*Nombre de usuario</label>
		                <input id="username" name="username" type="text" style="width:10%;" />
		            </p>
		            <p class="form">
		                <label for="privileges">Privilegios</label>
		                <select id="privileges" name="privileges">
		                    <option value="1">Secretar&iacute;a</option>
		                    <option value="2">Auxiliar</option>
		                    <option value="3">Dentista</option>
		                    <option value="4">Gerente</option>
		                    <option value="5">Webmaster</option>
		                </select>
		            </p>
		            <p class="form center">
		                <img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
		                <input type="button" value="Ingresar Nuevo Usuario" />
		            </p>
		        </form>
			</fieldset>
			<div id="message" style="display:none;"></div>
		</div>

	</body>
</html>