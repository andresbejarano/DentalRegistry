<?php
session_start();
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
		<title>Dental: Lista de Usuarios</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/loaduser.js"></script>
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
		        <legend>Cargar Usuario</legend>
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
		            <p class="form center">
		                <img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
		                <input type="button" value="Buscar Usuario" />
		            </p>
		        </form>
		    </fieldset>
		    <div id="message" style="display:none;"></div>
		</div>
	</body>
</html>