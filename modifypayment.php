<?php
session_start();
include('modules/dbhandler.php');
include('modules/functions.php');
if(isset($_SESSION['id'])){
	if($_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web'){
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
		<title>Dental: Modificar Recaudo</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/modifypayment.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('select[name="user"]').val(<?php echo $paymentdata['user'];?>);
				$('select[name="paymenttype"]').val(<?php echo $paymentdata['paymenttype'];?>);
				$('select[name="bank"]').val(<?php echo $paymentdata['bank'];?>);
			});
		</script>
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
				<legend>Modificar Recaudo: <a href="patient.php?id=<?php echo $patientdata['id'];?>"><?php echo $patientdata['firstname'] . ' ' . $patientdata['firstlastname'] . ' ' . $patientdata['secondlastname'];?></a></legend>
				<?php
				if($paymentdata != null){
					?>
					<form action="#">
						<p class="form">
							<label for="id">Id Recaudo</label>
							<input id="id" name="id" readonly="readonly" style="width:10%;" type="text" value="<?php echo $paymentdata['id'];?>" />
						</p>
						<p class="form">
							<label for="patient">Id Paciente</label>
							<input id="patient" name="patient" readonly="readonly" style="width:10%;" type="text" value="<?php echo $paymentdata['patient'];?>" />
						</p>
						<p class="form">
							<label for="user">Id Usuario</label>
							<input id="user" name="user" readonly="readonly" style="width:10%;" type="text" value="<?php echo $paymentdata['user'];?>" />
						</p>
						<p class="form">
							<label for="username">Nombre Usuario</label>
							<input id="username" name="username" readonly="readonly" type="text" value="<?php echo $userdata['firstname'] . ' ' . $userdata['firstlastname'] . ' ' . $userdata['secondlastname'];?>" />
						</p>
						<p class="form">
							<label for="date">*Fecha</label>
							<input id="date" name="date" readonly="readonly" style="width:10%;" type="text" value="<?php echo toFormDate($paymentdata['date']);?>" />
						</p>
						<p class="form">
							<label for="value">*Valor ($)</label>
							<input id="value" name="value" style="width:10%;" type="text" value="<?php echo $paymentdata['value'];?>" />
						</p>
						<p class="form">
							<label for="paymenttype">*Forma de Pago</label>
							<select id="paymenttype" name="paymenttype"><?php writePaymenttypeList();?></select>
						</p>
						<p class="form">
							<label for="number">N&uacute;mero (Tarjeta o Cheque)</label>
							<input id="number" name="number" style="width:10%;" type="text" value="<?php echo $paymentdata['number'];?>" />
						</p>
						<p class="form">
							<label for="bank">Banco</label>
							<select id="bank" name="bank"><?php writeBankList();?></select>
						</p>
						<p class="form">
							<label for="description">Descripci&oacute;n</label>
							<textarea id="description" name="description" rows="120" cols="120"><?php echo $paymentdata['description'];?></textarea>
						</p>
						<p class="form center">
							<img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
							<input type="button" value="Modificar Recaudo" />
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
			</fieldset>
			<div id="message" style="display:none;"></div>
		</div>
	</body>
</html>