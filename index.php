<?php
session_start();
if(isset($_SESSION['id'])){
    header('Location:menu.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Dental: Ingreso al Sistema</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/index.js"></script>
	</head>
	<body>
		
		<div id="header">
			<div class="center"><a href="menu.php"><img alt="logo" src="images/logo.png" /></a></div>
		</div>

		<div id="outer-wrapper">
			<fieldset>
			    <legend>Ingreso de Usuario</legend>
		        <form action="#" id="loginform" method="post">
		            <p class="form">
		                <label for="username">Usuario</label>
		                <input id="username" name="username" type="text" />
		            </p>
		            <p class="form">
		                <label for="password">Contrase&ntilde;a</label>
		                <input id="password" name="password" type="password" />
		            </p>
		            <p class="form center">
		                <img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
		                <input id="button" type="button" value="Ingresar" />
		            </p>
		        </form>
		    </fieldset>
		    <div id="message" style="display:none;"></div>
        </div>
	
	</body>
</html>