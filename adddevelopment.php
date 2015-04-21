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
		<title>Dental: Ingreso de Evoluci&oacute;n</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<link rel="stylesheet" type="text/css" href="css/tablesorter.css" />
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/adddevelopment.js"></script>
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
					<legend><a href="medicalrecord.php?id=<?php echo $patientdata['id'];?>">Historia Cl&iacute;nica</a> &rarr; Evoluci&oacute;n: <a href="patient.php?id=<?php echo $patientdata['id'];?>"><?php echo $patientdata['firstname'] . ' ' . $patientdata['firstlastname'] . ' ' . $patientdata['secondlastname'];?></a></legend>
					<?php
					if($patientdata['active'] == 1){
						?>
						<form action="#" id="development" method="post">
							<h1>Informaci&oacute;n Inicial (Autom&aacute;tico)</h1>
							<hr />
							<p class="form">
								<label for="patient">Id Paciente</label>
								<input id="patient" name="patient" readonly="readonly" style="width:10%;" type="text" value="<?php echo $patientdata['id'];?>" />
							</p>
							<p class="form">
								<label for="user">Id Usuario</label>
								<input id="user" name="user" readonly="readonly" style="width:10%;" type="text" value="<?php echo $_SESSION['id'];?>" />
							</p>
							<p class="form">
								<label for="username">Nombre Usuario</label>
								<input id="username" name="username" readonly="readonly" type="text" value="<?php echo $_SESSION['name'];?>" />
							</p>
							<h1>Registro de Evoluci&oacute;n</h1>
							<hr />
							<p class="form">
								<label for="date">Fecha</label>
								<input id="date" name="date" style="width:10%;" readonly="readonly" type="text" value="<?php echo date('m/d/Y');?>" />
							</p>
							<p class="form">
								<label for="pregnant">Esta embarazada</label>
								<select id="pregnant" name="pregnant">
									<option value="0">No</option><option value="1">Si</option>
								</select>
								<select id="months" name="months" disabled="disabled">
									<option value="1">1 semana</option>
									<?php
									for($i = 2;$i <= 42;$i += 1){
										?>
										<option value="<?php echo $i;?>"><?php echo $i;?> semanas</option>
										<?php
									}
									?>
								</select>
							</p>
							<p class="form">
								<label for="plaque">% placa bacteriana</label>
								<select id="plaque" name="plaque">
									<?php
									for($i = 0;$i <= 100;$i += 1){
										?>
										<option value="<?php echo $i;?>"><?php echo $i;?>%</option>
										<?php
									}
									?>
								</select>
							</p>
							<p class="form">
								<label for="description">Descripci&oacute;n</label>
								<textarea id="description" name="description" cols="120" rows="120"></textarea>
							</p>
							
							<p class="form center">
								<img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
								<input type="button" value="Agregar Evoluci&oacute;n" />
							</p>
						</form>
						<h1>Entradas Anteriores</h1>
						<hr />
						<div class="section">
							<?php
								$total = $handler->getDevelopmentCount($patientdata['id']);
								if($total > 0){
									$list = $handler->getDevelopmentList($patientdata['id']);
									?>
									<table class="tablesorter">
										<thead>
											<tr>
												<th>Fecha</th>
												<th>Usuario</th>
												<th>Embarazo</th>
												<th>Placa (%)</th>
												<th>Descripci&oacute;n</th>
											</tr>
										</thead>
										<tbody>
										<?php
										for($i = $total - 1;$i >= 0;$i -= 1){
											?>
											<tr>
												<td><?php echo toFormDate($list[$i][3]);?></td>
												<td><a href="user.php?id=<?php echo $list[$i][2];?>"><?php echo $handler->getUserName($list[$i][2]);?></a></td>
												<td><?php if($list[$i][4]) echo 'Si - ' . $list[$i][5] . ' semanas'; else echo 'No';?></td>
												<td><?php echo $list[$i][6];?>%</td>
												<td><?php echo $list[$i][7];?></td>
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
									<p>No hay entradas registradas</p>
									<?php
								}
							?>
						</div>
						<?php
					}
					else{
						?>
						<p class="center warning">El paciente se encuentra inactivo<br />Consulte a gerencia para el proceso de activaci&oacute;n</p>
						<?php
					}
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