<?php
session_start();
include('modules/dbhandler.php');
include('modules/functions.php');
if(isset($_SESSION['id'])){
	if($_SESSION['privileges'] == 'sec' || $_SESSION['privileges'] == 'aux' || $_SESSION['privileges'] == 'den' || $_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web'){
		if(isset($_GET['id'])){
			$handler = new DBHandler();
			$budgetdata = $handler->getBudgetDataById($_GET['id']);
			if($budgetdata != null){
				$patientdata = $handler->getPatientDataById($budgetdata['patient']);
				$userdata = $handler->getUserDataById($budgetdata['user']);
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
		<title>Dental: Presupuesto</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/showbudget.js"></script>
	</head>
	<body>
		<div id="budget">
			<p class="center intro"><img alt="logo" src="images/logo.png" /></p>
			<p class="center intro">Cra 52 No. 72-152 - Tel:368 8080</p>
			<p class="center intro">E-mail:info@sonriplan.com.co</p>
			<p class="center intro">www.sonriplan.com.co</p>
			<p class="center intro">Barranquilla - Colombia</p>
			<hr />
			<?php
			if($budgetdata != null){
				?>
				<p class="budgetinfo"><span style="font-style:normal;font-weight:bold;">Paciente: </span><?php echo $patientdata['firstname'] . ' ' . $patientdata['firstlastname'] . ' ' . $patientdata['secondlastname'];?></p>
				<p class="budgetinfo"><span style="font-style:normal;font-weight:bold;">Usuario: </span><?php echo $userdata['firstname'] . ' ' . $userdata['firstlastname'] . ' ' . $userdata['secondlastname'];?></p>
				<p class="budgetinfo"><span style="font-style:normal;font-weight:bold;">C&oacute;digo Presupuesto: </span><?php echo $budgetdata['code'];?></p>
				<p class="budgetinfo"><span style="font-style:normal;font-weight:bold;">Fecha: </span><?php echo toFormDate($budgetdata['date']);?></p>
				<?php
				$total = $handler->getBudgetInfoCount($budgetdata['id']);
				if($total > 0){
					$list = $handler->getBudgetInfoList($budgetdata['id']);
					$totalprice = 0;
					?>
					<table class="budget">
						<thead>
							<tr>
								<th>Procedimiento</th>
								<th>Ubicaci&oacute;n</th>
								<th>Precio</th>
							</tr>
						</thead>
						<tbody>
							<?php
							for($i = 0;$i < $total;$i += 1){
								$procedure = $handler->getProcedureData($list[$i][2]);
								$totalprice += $procedure['price'];
								?>
								<tr>
									<td style="width:70%;">
										<?php
										echo $procedure['code'] . ' - ' . $procedure['name'];
										if($procedure['description'] != null){
											?>
											<br />
											<p style="font-style:italic;"><?php echo $procedure['description'];?></p>
											<?php
										}
										?>
									</td>
									<td style="width:15%;"><?php echo $handler->getLocationName($list[$i][3]);?></td>
									<td style="text-align:right;width:15%;">$<?php echo number_format($procedure['price']);?></td>
								</tr>
								<?php
							}
							?>
							<tr style="border-color:#ffffff;">
								<td colspan="2" style="font-weight:bold;text-align:center;">--- Total ---</td>
								<td style="font-weight:bold;text-align:right;">$<?php echo number_format($totalprice);?></td>
							</tr>
							<?php
							if($budgetdata['discount'] > 0){
								$applied = $totalprice - ($totalprice * $budgetdata['discount']);
								?>
								<tr style="border-color:#ffffff;">
									<td colspan="2" style="font-weight:bold;text-align:center;">--- Total (Descuento Aplicado = <?php echo ($budgetdata['discount'] * 100) . '%';?>) ---</td>
									<td style="font-weight:bold;text-align:right;">$<?php echo number_format($applied);?></td>
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
					<p class="center warning">El presupuesto no tiene procedimientos</p>
					<?php
				}
				?>
				
				<?php
				if($budgetdata['description'] != null){
					?>
					<p class="budgetinfo">Observaciones: <?php echo $budgetdata['description'];?></p>
					<?php
				}
				?>
				<form action="#">
					<p class="form center">
						<input type="button" value="Imprimir Presupuesto" />
					</p>
				</form>
				<?php
			}
			else{
				?>
				<p class="center warning">Presupuesto no encontrado</p>
				<?php
			}
			?>
		</div>
	</body>
</html>