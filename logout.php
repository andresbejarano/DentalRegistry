<?php
session_start();
if(isset($_SESSION['id'])){
	$destroyed = session_destroy();
}
else{
	header("Location:index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Dental: Salida del Sistema</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
	</head>
	<body>
		<div id="header">
		   <div class="center"><a href="index.php"><img alt="logo" src="images/logo.png" /></a></div>
		</div>
		<div id="outer-wrapper">
			<div class="center">
				<?php
				if($destroyed){
					?>
					<img alt="success" src="images/success.png" />
					<p class="center success">Sesi&oacute;n finalizada satisfactoriamente<br />Haga clic <a href="index.php">aqui</a> para volver a ingresar al sistema</p>
					<?php
				}
				else{
					?>
					<img alt="warning" src="images/warning.png" />
					<p class="center warning">Error al finalizar la sesi&oacute;n</p>
					<p>Regrese al <a href="menu.php">men&uacute; principal</a> e intente salir de nuevo del sistema</p>
					<p>Si el problema persiste comun&iacute;quese con el administrador del sistema</p>
					<?php
				}
				?>
			</div>
		</div>
	</body>
</html>