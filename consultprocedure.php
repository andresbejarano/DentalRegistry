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
		<title>Dental: Consultar Procedimiento</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/consultprocedure.js"></script>
	</head>
	<body>
		<div id="header">
			<div class="center"><a href="menu.php"><img alt="logo" src="images/logo.png" /></a></div>
			<ul class="innerlinks">
				<li><a href="addprocedure.php">Agregar Procedimiento</a></li>
				<li><a href="consultprocedure.php">Consultar Procedimiento</a></li>
				<li><a href="modifyprocedure.php">Modificar Procedimiento</a></li>
			</ul>
			<div class="usersession">
				<img alt="user" src="images/user.png" />
				Registrado como <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['firstlastname'] . ' ' . $_SESSION['secondlastname'];?> | 
				<a href="logout.php" class="session">Cerrar Sesi&oacute;n</a>
			</div>
		</div>
		<div id="outer-wrapper">
			<fieldset>
				<legend>Seleccionar Procedimiento</legend>
				<form action="#" id="searchform">
		            <p class="form">
		                <label for="searchid">Nombre</label>
		                <select id="searchid" name="id"><?php writeProcedureList();?></select>
		            </p>
		            <p class="form center">
		                <img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
		                <input type="button" value="Buscar Procedimiento" />
		            </p>
		        </form>
		    </fieldset>
		    <fieldset id="modifycontainer" style="display:none;">
		        <legend>Datos del Procedimiento</legend>
		        <form action="#" id="modifyform">
		            <p class="form">
		                <label for="id">Id Procedimiento</label>
		                <input id="id" name="id" readonly="readonly" type="text" style="width:10%;" />
		            </p>
		            <p class="form">
		                <label for="code">*C&oacute;digo</label>
		                <input id="code" name="code" readonly="readonly" type="text" />
		            </p>
		            <p class="form">
		                <label for="name">*Nombre</label>
		                <input id="name" name="name" readonly="readonly" type="text" />
		            </p>
		            <p class="form">
		                <label for="price">*Precio($)</label>
		                <input id="price" name="price" readonly="readonly" style="width:10%;" type="text" />
		            </p>
		            <p class="form">
		                <label for="proceduretype">*Tipo de procedimiento</label>
		                <select id="proceduretype" name="proceduretype"><?php writeProceduretypeList();?></select>
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