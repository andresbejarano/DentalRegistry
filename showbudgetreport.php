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
		<title>Dental: Reporte de Presupuestos</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<link rel="stylesheet" type="text/css" href="css/tablesorter.css" />
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/showbudgetreport.js"></script>
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
				<h1 style="text-align:center;">Presupuestos Activos del Paciente</h1>
				<hr />
				<?php
				$budgetcount = $handler->getActiveBudgetCount($patientdata['id']);
				if($budgetcount > 0){
					$budgetlist = $handler->getActiveBudgetList($patientdata['id']);
					$totaldebt = 0;
					?>
					<table class="tablesorter">
						<thead>
							<tr><th>Id</th><th>C&oacute;digo</th><th>Usuario</th><th>Valor</th><th>Descuento</th><th>Total</th></tr>
						</thead>
						<tbody>
							<?php
							for($i = 0;$i < $budgetcount;$i += 1){
								$value = $handler->getBudgetPrice($budgetlist[$i][0]);
								$applied = $value - ($value * $budgetlist[$i][5]);
								$totaldebt += $applied;
								?>
								<tr>
									<td><?php echo $budgetlist[$i][0];?></td>
									<td><?php echo $budgetlist[$i][1];?></td>
									<td><?php echo $handler->getUserName($budgetlist[$i][3]);?></td>
									<td style="text-align:right;">$<?php echo number_format($value);?></td>
									<td style="text-align:right;"><?php echo ($budgetlist[$i][5] * 100) . '%';?></td>
									<td style="text-align:right;">$<?php echo number_format($applied);?></td>
								</tr>
								<?php
							}
							?>
						</tbody>
					</table>
					<p class="report"><span class="report">Total presupuestos: </span>$<?php echo number_format($totaldebt);?></p>
					<?php
				}
				else{
					?>
					<p class="simplereport">El paciente no tiene presupuestos activos</p>
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