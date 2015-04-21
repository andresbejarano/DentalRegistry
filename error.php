<?php
session_start();
if(!isset($_SESSION['id'])){
	header('Location:index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Dental: Error de Acceso</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="styles/reset.css" />
		<link rel="stylesheet" type="text/css" href="styles/default.css" />
		<link rel="stylesheet" type="text/css" href="cupertino/jquery-ui-1.8.10.custom.css" />
		<script type="text/javascript" src="javascript/jquery-1.5.min.js"></script>
		<script type="text/javascript" src="cupertino/jquery-ui-1.8.10.custom.min.js"></script>
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
			<div class="center">
				<p class="center warning">Se present&oacute; un error de p&aacute;gina
				<br />
				Consulte a gerencia para mayor informaci&oacute;n</p>
			</div>
		</div>
	</body>
</html>