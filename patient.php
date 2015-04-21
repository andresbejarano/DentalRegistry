<?php
session_start();
include('modules/dbhandler.php');
include('modules/functions.php');
if(isset($_SESSION['id'])){
    if($_SESSION['privileges'] == 'sec' || $_SESSION['privileges'] == 'aux' || $_SESSION['privileges'] == 'den' || $_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web'){
	    if(isset($_GET['id'])){
			$handler = new DBHandler();
		    $patientdata = $handler->getPatientDataById($_GET['id']);
		}
		else{
			header('Location:error.php');
		}
	}
	else{
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
		<title>Dental: <?php echo $patientdata['firstname'] . ' ' . $patientdata['firstlastname'] . ' ' . $patientdata['secondlastname'];?></title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<link rel="stylesheet" type="text/css" href="css/tablesorter.css" />
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
		<script type="text/javascript" src="js/patient.js"></script>
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
                <?php
                if($patientdata != null){
                    ?>
					<legend>Paciente: <?php echo $patientdata['firstname'] . ' ' . $patientdata['firstlastname'] . ' ' . $patientdata['secondlastname'];?></legend>
					<div>
						<div class="persondata">
							<p class="persondatafield">Id: <span class="clear"><?php echo $patientdata['id'];?></span></p>
							<hr />
							<p class="persondatafield">Primer Nombre: <span class="clear"><?php echo $patientdata['firstname'];?></span></p>
							<p class="persondatafield">Segundo Nombre: <span class="clear"><?php echo $patientdata['middlename'];?></span></p>
							<p class="persondatafield">Primer Apellido: <span class="clear"><?php echo $patientdata['firstlastname'];?></span></p>
							<p class="persondatafield">Segundo Apellido: <span class="clear"><?php echo $patientdata['secondlastname'];?></span></p>
							<p class="persondatafield">Sexo: <span class="clear"><?php echo getSex($patientdata['sex']);?></span></p>
							<p class="persondatafield">Tipo de Documento: <span class="clear"><?php echo getDocumentType($patientdata['documenttype']);?></span></p>
							<p class="persondatafield">N&uacute;mero de Documento: <span class="clear"><?php echo $patientdata['documentnumber'];?></span></p>
							<p class="persondatafield">Fecha de Nacimiento: <span class="clear"><?php echo toFormDate($patientdata['birthdate']);?></span></p>
							<p class="persondatafield">Tipo de Sangre: <span class="clear"><?php echo getBloodtype($patientdata['bloodtype']);?></span></p>
							<p class="persondatafield">Direcci&oacute;n: <span class="clear"><?php echo $patientdata['address'];?></span></p>
							<p class="persondatafield">Tel&eacute;fono: <span class="clear"><?php echo $patientdata['phonehome'];?></span></p>
							<p class="persondatafield">Tel&eacute;fono Oficina: <span class="clear"><?php echo $patientdata['phoneoffice'];?></span></p>
							<p class="persondatafield">Celular: <span class="clear"><?php echo $patientdata['cellnumber'];?></span></p>
							<p class="persondatafield">Correo Electr&oacute;nico: <span class="clear"><?php echo $patientdata['email'];?></span></p>
							<p class="persondatafield">Estado Civil: <span class="clear"><?php echo getMaritalstatus($patientdata['maritalstatus']);?></span></p>
							<p class="persondatafield">Ocupaci&oacute;n: <span class="clear"><?php echo $patientdata['occupation'];?></span></p>
							<hr />
							<p class="persondatafield">Acudiente: <span class="clear"><?php echo $patientdata['contact'];?></span></p>
							<p class="persondatafield">N&uacute;mero Acudiente: <span class="clear"><?php echo $patientdata['contactnumber'];?></span></p>
							<hr />
							<p class="persondatafield">Activo: <span class="clear"><?php echo getState($patientdata['active']);?></span></p>
						</div>
					</div>
					<ul class="innerlinks">
						<li><a href="medicalrecord.php?id=<?php echo $patientdata['id'];?>">Historia Cl&iacute;nica</a></li>
						<li><a href="addbudget.php?id=<?php echo $patientdata['id'];?>">Generar Presupuesto</a></li>
						<?php
						if($_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web' || $_SESSION['privileges'] == 'sec'){
							?>
							<li><a href="addappointment.php?id=<?php echo $patientdata['id'];?>">Agendar Cita</a></li>
							<li><a href="addpayment.php?id=<?php echo $patientdata['id'];?>">Registrar Recaudo</a></li>
							<?php
						}
						?>
					</ul>
					<?php
					if($_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web' || $_SESSION['privileges'] == 'sec'){
						?>
						<ul class="innerlinks">
							<li><a href="modifypatient.php?id=<?php echo $patientdata['id'];?>">Modificar Datos</a></li>
							<li><a href="statepatient.php?id=<?php echo $patientdata['id'];?>"><?php if($patientdata['active'] == 1) echo 'Inactivar'; else echo 'Activar';?></a></li>
						</ul>
						<?php
					}
					?>
					
					<?php
					if($_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web' || $_SESSION['privileges'] == 'sec'){
						?>
						<!-- Lista de recaudos -->
						<h1>Recaudos</h1>
						<hr />
						<div class="section">
							<?php
							$total = $handler->getPaymentCount($patientdata['id']);
							if($total > 0){
								$list = $handler->getPaymentList($patientdata['id']);
								?>
								<table class="tablesorter">
									<thead>
										<tr><th>Id</th><th>Usuario</th><th>Fecha</th><th>Valor</th><th>Modificar</th><th>Ver</th></tr>
									</thead>
									<tbody>
									<?php
									for($i = 0;$i < $total;$i += 1){
										?>
										<tr>
											<td style="text-align:center;"><?php echo $list[$i][0];?></td>
											<td><a href="user.php?id=<?php echo $list[$i][2];?>"><?php echo $handler->getUserName($list[$i][2]);?></a></td>
											<td style="text-align:center;"><?php echo toFormDate($list[$i][3]);?></td>
											<td style="text-align:right;">$<?php echo number_format($list[$i][4]);?></td>
											<td style="text-align:center;"><a href="modifypayment.php?id=<?php echo $list[$i][0];?>"><img alt="modificar" src="images/edit.png" title="modificar" /></a></td>
											<td style="text-align:center;"><a href="showpayment.php?id=<?php echo $list[$i][0];?>" rel="external"><img alt="ver" src="images/look.png" title="ver" /></a></td>
										</tr>
										<?php
									}
									?>
									</tbody>
								</table>
								<p class="center"><a href="showpaymentreport.php?id=<?php echo $patientdata['id'];?>" rel="external">Ver Reporte de Recaudos</a></p>
								<?php
							}
							else{
								?>
								<p class="center">El paciente no ha realizado recaudos</p>
								<?php
							}
							?>
						</div>
						<?php
					}
					?>
					
					
					<br />
					
					<h1>Citas</h1>
					<hr />
					<div class="section">
						<?php
						$total = $handler->getAppointmentCountByPatient($patientdata['id']);
						if($total > 0){
							$list = $handler->getAppointmentListByPatient($patientdata['id']);
							?>
							<table class="tablesorter">
								<thead>
									<tr><th>Id</th><th>Dentista</th><th>Fecha</th><th>Hora Inicio</th><th>Hora Fin</th><th>Tipo</th><th>Estado</th><th>Modificar</th></tr>
								</thead>
								<tbody>
								<?php
								for($i = 0;$i < $total;$i += 1){
									?>
									<tr>
										<td><?php echo $list[$i][0];?></td>
										<td><a href="user.php?id=<?php echo $list[$i][2];?>"><?php echo $handler->getUserName($list[$i][2]);?></a></td>
										<td><?php echo toFormDate($list[$i][3]);?></td>
										<td><?php echo $handler->getHour($list[$i][4]);?></td>
										<td><?php echo $handler->getHour($list[$i][5]);?></td>
										<td><?php echo getAppointmentType($list[$i][6]);?></td>
										<td><a href="stateappointment.php?id=<?php echo $list[$i][0];?>"><?php echo getAppointmentStatus($list[$i][9]);?></a></td>
										<td style="text-align:center;"><a href="modifyappointment.php?id=<?php echo $list[$i][0]; ?>"><img alt="modificar" src="images/edit.png" title="modificar" /></a></td>
									</tr>
									<?php
								}
								?>
								</tbody>
							</table>
							<?php
						}
						else{
							?>
							<p class="center">El paciente no tiene citas agendadas</p>
							<?php
						}
						?>
					</div>
					
					<br />
					
					<h1>Presupuestos</h1>
					<hr />
					<div class="section">
						<?php
						$total = $handler->getBudgetCount($patientdata['id']);
						if($total > 0){
							$list = $handler->getBudgetList($patientdata['id']);
							?>
							<table class="tablesorter">
								<thead>
									<tr><th>Id</th><th>C&oacute;digo</th><th>Usuario</th><th>Fecha</th><th>Valor</th><th>Descuento</th><th>Total</th><th>Activo</th><th>Opci&oacute;n</th><th>Modificar</th><th>Ver</th></tr>
								</thead>
								<tbody>
								<?php
								for($i = 0;$i < $total;$i += 1){
									$active = false;
									$price = $handler->getBudgetPrice($list[$i][0]);
									$applied = $price - ($price * $list[$i][5]);
									?>
									<tr>
										<td><?php echo $list[$i][0];?></td>
										<td><?php echo $list[$i][1];?></td>
										<td><a href="user.php?id=<?php echo $list[$i][3];?>"><?php echo $handler->getUserName($list[$i][3]);?></a></td>
										<td><?php echo toFormDate($list[$i][4]);?></td>
										<td style="text-align:right;">$<?php echo number_format($price);?></td>
										<td style="text-align:right;"><?php echo ($list[$i][5] * 100) . '%';?></td>
										<td style="text-align:right;">$<?php echo number_format($applied);?></td>
										<?php
										if($list[$i][6] == 1){
											?>
											<td>Si</td>
											<td style="text-align:center;"><a href="updatebudget.php?id=<?php echo $list[$i][0];?>"><img alt="actualizar" src="images/reload.png" title="actualizar" /></a></td>
											<td style="text-align:center;">---</td>
											<?php
										}
										else{
											?>
											<td>No</td>
											<td style="text-align:center;"><a href="activatebudget.php?id=<?php echo $list[$i][0];?>"><img alt="activar" src="images/success.png" title="activar" /></a></td>
											<td style="text-align:center;"><a href="modifybudget.php?id=<?php echo $list[$i][0];?>"><img alt="modificar" src="images/edit.png" title="modificar" /></a></td>
											<?php
										}
										?>
										<td style="text-align:center;"><a href="showbudget.php?id=<?php echo $list[$i][0];?>" rel="external"><img alt="ver" src="images/look.png" title="ver" /></a></td>
									</tr>
									<?php
								}
								?>
								</tbody>
							</table>
							<p class="center"><a href="showbudgetreport.php?id=<?php echo $patientdata['id'];?>" rel="external">Ver Reporte de Presupuestos</a></p>
							<?php
						}
						else{
							?>
							<p class="center">El paciente no tiene presupuestos</p>
							<?php
						}
						?>
					</div>
					<!-- Fin lista de Presupuestos -->
					
					<?php
				}
				else{
					?>
					<legend>Paciente no encontrado</legend>
					<p class="center">Paciente no encontrado</p>
					<?php
				}
				?>
			</fieldset>
		</div>
		<!-- Fin Contenedor Principal -->
		
	</body>
</html>