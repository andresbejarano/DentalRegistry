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
		<title>Dental: Lista de Pacientes</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<link rel="stylesheet" type="text/css" href="css/tablesorter.css" />
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
		<script type="text/javascript" src="js/patientslist.js"></script>
	</head>
	<body>
		<div id="header">
			<div class="center"><a href="menu.php"><img alt="logo" src="images/logo.png" /></a></div>
			<ul class="innerlinks">
				<li><a href="addpatient.php">Agregar Paciente</a></li>
				<li><a href="loadpatient.php">Cargar Paciente</a></li>
				<li><a href="patientslist.php">Lista de Pacientes</a></li>
			</ul>
			<div class="usersession">
				<img alt="user" src="images/user.png" />
				Registrado como <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['firstlastname'] . ' ' . $_SESSION['secondlastname'];?> | 
				<a href="logout.php" class="session">Cerrar Sesi&oacute;n</a>
			</div>
		</div>
		<div id="outer-wrapper">
			<fieldset>
				<legend>B&uacute;squeda de pacientes</legend>
				<form action="#" class="center">
					<table class="searcher">
						<thead>
							<tr>
								<th>Primer Nombre</th>
								<th>Primer Apellido</th>
								<th>Segundo Apellido</th>
								<th>Sexo</th>
								<th>Documento de Identidad</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<select id="firstname" name="firstname">
										<option value="0">---</option>
										<option value="A">A</option>
										<option value="B">B</option>
										<option value="C">C</option>
										<option value="D">D</option>
										<option value="E">E</option>
										<option value="F">F</option>
										<option value="G">G</option>
										<option value="H">H</option>
										<option value="I">I</option>
										<option value="J">J</option>
										<option value="K">K</option>
										<option value="L">L</option>
										<option value="M">M</option>
										<option value="N">N</option>
										<option value="Ñ">&Ntilde;</option>
										<option value="O">O</option>
										<option value="P">P</option>
										<option value="Q">Q</option>
										<option value="R">R</option>
										<option value="S">S</option>
										<option value="T">T</option>
										<option value="U">U</option>
										<option value="V">V</option>
										<option value="W">W</option>
										<option value="X">X</option>
										<option value="Y">Y</option>
										<option value="Z">Z</option>
									</select>
								</td>
								<td>
									<select id="firstlastname" name="firstlastname">
										<option value="0">---</option>
										<option value="A">A</option>
										<option value="B">B</option>
										<option value="C">C</option>
										<option value="D">D</option>
										<option value="E">E</option>
										<option value="F">F</option>
										<option value="G">G</option>
										<option value="H">H</option>
										<option value="I">I</option>
										<option value="J">J</option>
										<option value="K">K</option>
										<option value="L">L</option>
										<option value="M">M</option>
										<option value="N">N</option>
										<option value="Ñ">&Ntilde;</option>
										<option value="O">O</option>
										<option value="P">P</option>
										<option value="Q">Q</option>
										<option value="R">R</option>
										<option value="S">S</option>
										<option value="T">T</option>
										<option value="U">U</option>
										<option value="V">V</option>
										<option value="W">W</option>
										<option value="X">X</option>
										<option value="Y">Y</option>
										<option value="Z">Z</option>
									</select>
								</td>
								<td>
									<select id="secondlastname" name="secondlastname">
										<option value="0">---</option>
										<option value="A">A</option>
										<option value="B">B</option>
										<option value="C">C</option>
										<option value="D">D</option>
										<option value="E">E</option>
										<option value="F">F</option>
										<option value="G">G</option>
										<option value="H">H</option>
										<option value="I">I</option>
										<option value="J">J</option>
										<option value="K">K</option>
										<option value="L">L</option>
										<option value="M">M</option>
										<option value="N">N</option>
										<option value="Ñ">&Ntilde;</option>
										<option value="O">O</option>
										<option value="P">P</option>
										<option value="Q">Q</option>
										<option value="R">R</option>
										<option value="S">S</option>
										<option value="T">T</option>
										<option value="U">U</option>
										<option value="V">V</option>
										<option value="W">W</option>
										<option value="X">X</option>
										<option value="Y">Y</option>
										<option value="Z">Z</option>
									</select>
								</td>
								<td>
									<select id="sex" name="sex">
										<option value="0">---</option>
										<option value="1">Masculino</option>
										<option value="2">Femenino</option>
									</select>
								</td>
								<td>
									<select id="documenttype" name="documenttype">
										<option value="0">---</option>
										<option value="1">C&eacute;dula de Ciudadan&iacute;a</option>
										<option value="2">Tarjeta de Identidad</option>
										<option value="3">Registro Civil</option>
										<option value="4">Pasaporte</option>
										<option value="5">C&eacute;dula de Extranjer&iacute;a</option>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
					<div>
						<input id="search" type="button" value="Buscar Pacientes" />
						<img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
					</div>
				</form>
			</fieldset>
			<div id="patients" style="display:none;"></div>
        </div>
	</body>
</html>