<?php
session_start();
if(!isset($_SESSION['id'])){
	header("Location:index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Dental: Men&uacute; Principal</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/menu.js"></script>
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
        
		    <div class="accordion">
				<h3><a href="#">Gesti&oacute;n de Pacientes</a></h3>
		        <div>
					<ul class="innerlinks">
						<?php
						if($_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web' || $_SESSION['privileges'] == 'sec'){
							?>
							<li><a href="addpatient.php">Agregar Paciente</a></li>
							<?php
						}
						?>
						<li><a href="loadpatient.php">Cargar Paciente</a></li>
						<li><a href="patientslist.php">Lista de Pacientes</a></li>
					</ul>
		        </div>
		        <?php
		        if($_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web'){
					?>
					<h3><a href="#">Gesti&oacute;n de Usuarios</a></h3>
					<div>
						<ul class="innerlinks">
							<li><a href="adduser.php">Agregar Usuario</a></li>
							<li><a href="loaduser.php">Cargar Usuario</a></li>
							<li><a href="userslist.php">Lista de Usuarios</a></li>
						</ul>
					</div>
					<?php
				}
		        ?>
		        <?php
		        if($_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web'){
					?>
					<h3><a href="#">Opciones del Sistema</a></h3>
					<div>
						<div class="accordion">
							<h3><a href="#">Especialidades</a></h3>
							<div>
								<ul class="innerlinks">
									<li><a href="addspecialty.php">Agregar</a></li>
									<li><a href="consultspecialty.php">Consultar</a></li>
									<li><a href="modifyspecialty.php">Modificar</a></li>
								</ul>
							</div>
							<h3><a href="#">Gesti&oacute;n de Procedimientos</a></h3>
							<div>
								<div class="accordion">
									<h3><a href="#">Tipos de Procedimiento</a></h3>
									<div>
										<ul class="innerlinks">
											<li><a href="addproceduretype.php">Agregar</a></li>
											<li><a href="consultproceduretype.php">Consultar</a></li>
											<li><a href="modifyproceduretype.php">Modificar</a></li>
										</ul>
									</div>
									<h3><a href="#">Procedimientos</a></h3>
									<div>
										<ul class="innerlinks">
											<li><a href="addprocedure.php">Agregar</a></li>
											<li><a href="consultprocedure.php">Consultar</a></li>
											<li><a href="modifyprocedure.php">Modificar</a></li>
										</ul>
									</div>
									<h3><a href="#">Sub Procedimientos</a></h3>
									<div>
										<ul class="innerlinks">
											<li><a href="addsubprocedure.php">Agregar</a></li>
											<li><a href="consultsubprocedure.php">Consultar</a></li>
											<li><a href="modifysubprocedure.php">Modificar</a></li>
										</ul>
									</div>
								</div>
							</div>
							<h3><a href="#">Formas de Pago</a></h3>
							<div>
								<ul class="innerlinks">
									<li><a href="addpaymenttype.php">Agregar</a></li>
									<li><a href="consultpaymenttype.php">Consultar</a></li>
									<li><a href="modifypaymenttype.php">Modificar</a></li>
								</ul>
							</div>
							<h3><a href="#">Lista de Bancos</a></h3>
							<div>
								<ul class="innerlinks">
									<li><a href="addbank.php">Agregar</a></li>
									<li><a href="consultbank.php">Consultar</a></li>
									<li><a href="modifybank.php">Modificar</a></li>
								</ul>
							</div>
							<h3><a href="#">Ubicaci&oacute;n Oral</a></h3>
							<div>
								<ul class="innerlinks">
									<li><a href="addlocation.php">Agregar</a></li>
									<li><a href="consultlocation.php">Consultar</a></li>
									<li><a href="modifylocation.php">Modificar</a></li>
								</ul>
							</div>
						</div>
					</div>
					<?php
				} 
				?>
				<?php
				if($_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web' || $_SESSION['privileges'] == 'sec'){
					?>
					<h3><a href="#">Reportes (Citas, Honorarios, Recaudos)</a></h3>
					<div>
						<ul class="innerlinks">
							<li><a href="appointmentreport.php">Reporte de Citas</a></li>
							<li><a href="feereport.php">Reporte de Honorarios</a></li>
							<li><a href="paymentreport.php">Reporte de Recaudos</a></li>
						</ul>
					</div>
					<?php
				}
				?>
				<h3><a href="#">Datos Personales</a></h3>
		        <div>
					<ul class="innerlinks">
						<li><a href="showpersonaldata.php">Ver Datos Personales</a></li>
						<li><a href="modifypassword.php">Cambiar Contrase&ntilde;a</a></li>
					</ul>
		        </div>
		    </div>
		    <!-- Fin Contenido -->
		</div>
		<!-- Fin Contenedor Principal -->
	</body>
</html>