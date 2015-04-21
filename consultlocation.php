<?php
session_start();
include('modules/dbhandler.php');
include('modules/functions.php');
if(isset($_SESSION['id'])){
	if(!($_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web')){
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
		<title>Dental: Consultar Ubicaci&oacute;n Oral</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/consultlocation.js"></script>
	</head>
	<body>
		<div id="header">
			<div class="center"><a href="menu.php"><img alt="logo" src="images/logo.png" /></a></div>
			<ul class="innerlinks">
				<li><a href="addlocation.php">Agregar Ubicaci&oacute;n Oral</a></li>
				<li><a href="consultlocation.php">Consultar Ubicaci&oacute;n Oral</a></li>
				<li><a href="modifylocation.php">Modificar Ubicaci&oacute;n Oral</a></li>
			</ul>
			<div class="usersession">
				<img alt="user" src="images/user.png" />
				Registrado como <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['firstlastname'] . ' ' . $_SESSION['secondlastname'];?> | 
				<a href="logout.php" class="session">Cerrar Sesi&oacute;n</a>
			</div>
		</div>
		<div id="outer-wrapper">
			<fieldset>
				<legend>Consultar Ubicaci&oacute;n Oral</legend>
				<form action="#" id="searchform">
					<p class="form">
						<label for="typeid">Nombre</label>
						<select id="typeid" name="id"><?php writeLocationList();?></select>
					</p>
					<p class="form center">
						<img alt="loader" id="searchloader" src="images/loader.gif" style="display:none;" />
						<input id="searchbutton" type="button" value="Buscar Ubicaci&oacute;n Oral" />
					</p>
				</form>
			</fieldset>
			<fieldset id="modifycontainer" style="display:none;">
				<legend>Datos Ubicaci&oacute;n Oral</legend>
				<form action="#" id="modifyform">
					<p class="form">
						<label for="id">Id Ubicaci&oacute;n</label>
						<input id="id" name="id" readonly="readonly" type="text" style="width:10%;" />
					</p>
					<p class="form">
						<label for="code">*C&oacute;digo</label>
						<input id="code" name="code" readonly="readonly" type="text" />
					</p>
					<p class="form">
						<label for="name">Nombre</label>
						<input id="name" name="name" readonly="readonly" type="text" />
					</p>
					<p class="form">
						<label for="description">Descripci&oacute;n</label>
						<textarea id="description" name="description" readonly="readonly" rows="120" cols="120"></textarea>
					</p>
				</form>
			</fieldset>
			<div id="message" style="display:none;"></div>
		</div>
	</body>
</html>