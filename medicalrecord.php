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
		<title>Dental: Historia Cl&iacute;nica</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<link rel="stylesheet" type="text/css" href="css/tablesorter.css" />
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/medicalrecord.js"></script>
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
				<?php
				if($patientdata != null){
					?>
					<legend>Historia Cl&iacute;nica: <a href="patient.php?id=<?php echo $patientdata['id'];?>"><?php echo $patientdata['firstname'] . ' ' . $patientdata['firstlastname'] . ' ' . $patientdata['secondlastname'];?></a></legend>
					<div class="accordion section">
						<h3><a href="#">Historia Cl&iacute;nica</a></h3>
						<div>
							<?php
							$history = $handler->getHistoryByPatient($patientdata['id']);
							if($history == null){
								?>
								<ul class="innerlinks">
									<li><a href="addhistory.php?id=<?php echo $patientdata['id'];?>">Agregar Historia</a></li>
								</ul>
								<?php
							}
							else{
								?>
								<ul class="innerlinks">
									<li><a href="consulthistory.php?id=<?php echo $history['id'];?>">Ver Historia</a></li>
									<li><a href="modifyhistory.php?id=<?php echo $history['id'];?>">Modificar Historia</a></li>
								</ul>
								<?php
							}
							?>
						</div>
						<h3><a href="#">Odontograma</a></h3>
						<div>
							<ul class="innerlinks">
								<li><a href="addodontogram.php?id=<?php echo $patientdata['id'];?>">Agregar Odontograma</a></li>
							</ul>
							<?php
							$count = $handler->getOdontogramCount($patientdata['id']);
							if($count > 0){
								$list = $handler->getOdontogramList($patientdata['id']);
								?>
								<table class="tablesorter">
									<thead>
										<tr>
											<th>#</th>
											<th>Usuario</th>
											<th>Fecha</th>
											<th>Acci&oacute;n</th>
										</tr>
									</thead>
									<tbody>
									<?php
									for($i = 0;$i < $count;$i += 1){
										?>
										<tr>
											<td><?php echo $list[$i][0];?></td>
											<td><a href="user.php?id=<?php echo $list[$i][1];?>"><?php echo $handler->getUserName($list[$i][1]);?></a></td>
											<td><?php echo toFormDate($list[$i][2]);?></td>
											<td><a href="consultodontogram.php?id=<?php echo $list[$i][0];?>">Ver</a></td>
										</tr>
										<?php
									}
									?>
									</tbody>
								</table>
								<?php
							}
							?>
						</div>
						<h3><a href="#">Evoluci&oacute;n</a></h3>
						<div>
							<ul class="innerlinks">
								<li><a href="adddevelopment.php?id=<?php echo $patientdata['id'];?>">Agregar Evoluci&oacute;n</a></li>
							</ul>
						</div>
					</div>
					<?php
				}
				else{
					?>
					<legend>Paciente no encontrado</legend>
					<p class="center warning">Paciente no encontrado</p>
					<?php
				}
				?>
			</fieldset>
			<div id="message" style="display:none;"></div>
		</div>
	</body>
</html>