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
		<title>Dental: Registrar Recaudo</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/addpayment.js"></script>
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
					<legend>Registrar Recaudo: <a href="patient.php?id=<?php echo $patientdata['id'];?>"><?php echo $patientdata['firstname'] . ' ' . $patientdata['firstlastname'] . ' ' . $patientdata['secondlastname'];?></a></legend>
					<?php
					if($patientdata['active'] == 1){
						?>
						<form action="#">
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
							<p class="form">
								<label for="date">*Fecha</label>
								<input id="date" name="date" readonly="readonly" type="text" style="width:10%;" value="<?php echo date("m/d/Y");?>" />
								<span style="font-style:italic;">mm/dd/aaaa</span>
							</p>
							<p class="form">
								<label for="value">*Valor($)</label>
								<input id="value" name="value" type="text" style="width:10%;" />
							</p>
							<p class="form">
								<label for="paymenttype">*Forma de Pago</label>
								<select id="paymenttype" name="paymenttype"><?php writePaymenttypeList();?></select>
							</p>
							<p class="form">
								<label for="number">N&uacute;mero (Tarjeta o Cheque)</label>
								<input id="number" name="number" style="width:10%;" type="text" />
							</p>
							<p class="form">
								<label for="bank">Banco</label>
								<select id="bank" name="bank"><?php writeBankList();?></select>
							</p>
							<p class="form">
								<label for="description">Descripci&oacute;n</label>
								<textarea id="description" name="description" rows="120" cols="120"></textarea>
							</p>
							<p class="form center">
								<img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
								<input type="button" value="Registrar Recaudo" />
							</p>
						</form>
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
		<!-- Fin Contenedor Principal -->
	</body>
</html>