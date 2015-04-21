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
		<title>Dental: Reporte de Citas</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<link rel="stylesheet" type="text/css" href="css/tablesorter.css" />
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
		<script type="text/javascript" src="js/appointmentreport.js"></script>
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
				<legend>Reporte de Citas</legend>
				<form action="#">
					<p class="form">
						<label for="date">Fecha</label>
						<input id="date" name="date" readonly="readonly" style="width:10%;" type="text" value="<?php echo date('m/d/Y');?>" />
						<span style="font-style:italic;">mm/dd/aaaa</span>
					</p>
					<p class="form">
						<label for="dentist">Dentista</label>
						<select id="dentist" name="dentist"><?php writeDentistList();?></select>
					</p>
					<p class="form center">
						<input type="button" value="Ver Reporte" />
						<img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
					</p>
				</form>
			</fieldset>
			<div id="data" style="display:none;"></div>
			<div id="message" style="display:none;"></div>
		</div>
	</body>
</html>