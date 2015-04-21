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
		<title>Dental: Reporte de Recaudos</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<link rel="stylesheet" type="text/css" href="css/tablesorter.css" />
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/showpaymentreport.js"></script>
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
			<?php
			if($patientdata != null){
				?>
				<p class="report"><span class="report">Paciente: </span><?php echo $patientdata['firstname'] . ' ' . $patientdata['firstlastname'] . ' ' . $patientdata['secondlastname'];?></p>
				<p class="report"><span class="report">Usuario: </span><?php echo $handler->getUserName($_SESSION['id']);?></p>
				<p class="report"><span class="report">Fecha Reporte: </span><?php echo date('m/d/Y');?></p>
				<h1 style="text-align:center;">Recaudos del Paciente</h1>
				<hr />
				<?php
				$paymentcount = $handler->getPaymentCount($patientdata['id']);
				if($paymentcount > 0){
					$paymentlist = $handler->getPaymentList($patientdata['id']);
					$totalpayment = 0;
					?>
					<table class="tablesorter">
						<thead>
							<tr><th>Id</th><th>Usuario</th><th>Fecha</th><th>Valor</th><th>Forma</th><th>N&uacute;mero</th><th>Banco</th></tr>
						</thead>
						<tbody>
							<?php
							for($i = 0;$i < $paymentcount;$i += 1){
								$totalpayment += $paymentlist[$i][4];
								?>
								<tr>
									<td style="text-align:center;"><?php echo $paymentlist[$i][0];?></td>
									<td><?php echo $handler->getUserName($paymentlist[$i][2]);?></td>
									<td><?php echo toFormDate($paymentlist[$i][3]);?></td>
									<td style="text-align:right;">$<?php echo number_format($paymentlist[$i][4]);?></td>
									<td><?php echo $handler->getPaymenttypeName($paymentlist[$i][5]);?></td>
									<?php
										if($paymentlist[$i][6] != ''){
											?>
											<td style="text-align:center;"><?php echo $paymentlist[$i][6];?></td>
											<?php
										}
										else{
											?>
											<td style="text-align:center;">---</td>
											<?php
										}
									?>
									<td style="text-align:center;"><?php echo $handler->getBankName($paymentlist[$i][7]);?></td>
								</tr>
								<?php
							}
							?>
						</tbody>
					</table>
					<p class="report"><span class="report">Total recaudos: </span>$<?php echo number_format($totalpayment);?></p>
					<?php
				}
				else{
					?>
					<p class="simplereport">El paciente no ha realizado recaudos</p>
					<?php
				}
			}
			else{
				?>
				<p class="center warning">Paciente no encontrado</p>
				<?php
			}
			?>
			<form action="#">
					<p class="form center">
						<input type="button" value="Imprimir Recibo" />
					</p>
				</form>
		</div>
	</body>
</html>