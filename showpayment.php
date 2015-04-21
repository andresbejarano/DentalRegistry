<?php
session_start();
include('modules/dbhandler.php');
include('modules/functions.php');
if(isset($_SESSION['id'])){
	if($_SESSION['privileges'] == 'sec' || $_SESSION['privileges'] == 'aux' || $_SESSION['privileges'] == 'den' || $_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web'){
		if(isset($_GET['id'])){
			$handler = new DBHandler();
			$paymentdata = $handler->getPaymentDataById($_GET['id']);
			if($paymentdata != null){
				$patientdata = $handler->getPatientDataById($paymentdata['patient']);
				$userdata = $handler->getUserDataById($paymentdata['user']);
			}
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
		<title>Dental: Mostrar Recaudo</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/showpayment.js"></script>
	</head>
	<body style="overflow:hidden">
		<div class="report">
			<p class="center intro"><img alt="logo" src="images/logo.png" /></p>
			<p class="center intro">Centro Odontol&oacute;gico ABRAHAM</p>
			<p class="center intro">Calle 30 No. 1-245 L1-2</p>
			<p class="center intro">En la sede de Golden Group E.P.S.</p>
			<p class="center intro">Tel.: 3340499 - Cel.:3015671906</p>
			<p class="center intro">E-mail:ceodab@hotmail.com</p>
			<hr />
			<h2>Recibo de Caja</h2>
			<?php
			if($paymentdata != null){
				?>
				<p class="report"><span class="report">Id Recaudo: </span><?php echo $paymentdata['id'];?></p>
				<p class="report"><span class="report">Paciente: </span><?php echo $patientdata['firstname'] . ' ' . $patientdata['firstlastname'] . ' ' . $patientdata['secondlastname'];?></p>
				<p class="report"><span class="report">Recibido por: </span><?php echo $userdata['firstname'] . ' ' . $userdata['firstlastname'] . ' ' . $userdata['secondlastname'];?></p>
				<p class="report"><span class="report">Fecha: </span><?php echo toFormDate($paymentdata['date']);?></p>
				<p class="report"><span class="report">Valor: </span>$<?php echo number_format($paymentdata['value']);?></p>
				<p class="report"><span class="report">Forma de recaudo: </span><?php echo getPaymenttypeName($paymentdata['paymenttype']);?></p>
				<?php
				if($paymentdata['number'] != null){
					?>
					<p class="report"><span class="report">N&uacute;mero: </span><?php echo $paymentdata['number'];?></p>
					<?php
				}
				else{
					?>
					<p class="report"><span class="report">N&uacute;mero: </span>---</p>
					<?php
				}
				?>
				<p class="report"><span class="report">Banco: </span><?php echo $handler->getBankName($paymentdata['bank']);?></p>
				<?php
				if($paymentdata['description'] != null){
					?>
					<p class="report"><span class="report">Descripci&oacute;n: </span><?php echo $paymentdata['description'];?></p>
					<?php
				}
				?>
				<form action="#">
					<p class="form center">
						<input type="button" value="Imprimir Recibo" />
					</p>
				</form>
				<?php
			}
			else{
				?>
				<p class="center warning">Recaudo no encontrado</p>
				<?php
			}
			?>
		</div>
	</body>
</html>