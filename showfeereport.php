<?php
session_start();
include('modules/dbhandler.php');
include('modules/functions.php');
if(isset($_SESSION['id'])){
	if($_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web'){
		if(isset($_GET['dateinit']) && isset($_GET['dateend']) && isset($_GET['dentist'])){
			$arrayinit = splitDate(trim($_GET['dateinit']));
			$arrayend = splitDate(trim($_GET['dateend']));
			$init = $arrayinit[2] . '-' . $arrayinit[0] . '-' . $arrayinit[1];
			$end = $arrayend[2] . '-' . $arrayend[0] . '-' . $arrayend[1];
			$handler = new DBHandler();
			$dentistdata = $handler->getUserDataById($_GET['dentist']);
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
		<title>Dental: Reporte de Honorarios</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<link rel="stylesheet" type="text/css" href="css/tablesorter.css" />
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('table').tablesorter();
			});
		</script>
	</head>
	<body>
		
		<!-- Inicio cabecera -->
		<div id="header">
			<div class="center"><a href="menu.php"><img alt="logo" src="images/logo.png" /></a></div>
			<!-- Barra de sesion -->
			<div class="usersession">
				<img alt="user" src="images/user.png" />
				Registrado como <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['firstlastname'] . ' ' . $_SESSION['secondlastname'];?> | 
				<a href="logout.php" class="session">Cerrar Sesi&oacute;n</a>
			</div>
			<!-- Barra de sesion -->
		</div>
		<!-- Fin cabecera -->
		
		<!-- Contenedor Principal -->
		<div id="outer-wrapper">
			<fieldset>
				<?php
				if($dentistdata != null){
					$specialty = $handler->getSpecialtyData($dentistdata['specialty']);
					$percent = $specialty['fee'];
					$proceduretotal = 0;
					$feetotal = 0;
					?>
					<legend>Reporte Honorarios: <a href="user.php?id=<?php echo $dentistdata['id'];?>"><?php echo $dentistdata['firstname'] . ' ' . $dentistdata['firstlastname'] . ' ' . $dentistdata['secondlastname'];?></a></legend>
					<form>
						<p class="form">
							<label for="dateinit">Fecha inicio</label>
							<input id="dateinit" name="dateinit" readonly="readonly" style="width:10%;" type="text" value="<?php echo $_GET['dateinit'];?>" />
						</p>
						<p class="form">
							<label for="dateend">Fecha finalizaci&oacute;n</label>
							<input id="dateend" name="dateend" readonly="readonly" style="width:10%;" type="text" value="<?php echo $_GET['dateend'];?>" />
						</p>
						<p class="form">
							<label for="fee">Porcentaje honorarios</label>
							<input id="fee" name="fee" readonly="readonly" style="width:10%;" type="text" value="<?php echo ($specialty['fee'] * 100);?>%" />
						</p>
						<?php
						$count = $handler->getFeeCount($init,$end,$_GET['dentist']);
						if($count > 0){
							$list = $handler->getFeeList($init,$end,$_GET['dentist']);
							?>
							<div style="margin-left:auto;margin-right:auto;width:90%;">
								<table class="tablesorter">
									<thead>
										<tr>
											<th>Fecha</th>
											<th>Paciente</th>
											<th>C&oacute;digo</th>
											<th>Valor</th>
											<th>Honorario</th>
										</tr>
									</thead>
									<tbody>
										<?php
										for($i = 0;$i < $count;$i += 1){
											$budgetdata = $handler->getBudgetDataById($list[$i][1]);
											$proceduredata = $handler->getProcedureData($list[$i][2]);
											$proceduretotal += $proceduredata['price'];
											$feetotal += $proceduredata['price'] * $percent;
											?>
											<tr>
												<td><?php echo toFormDate($list[$i][6]);?></td>
												<td><a href="patient.php?id=<?php echo $list[$i][1];?>"><?php echo $handler->getPatientName($list[$i][1]);?></a></td>
												<td><?php echo $proceduredata['code'];?></td>
												<td style="text-align:right;">$<?php echo number_format($proceduredata['price']);?></td>
												<td style="text-align:right;">$<?php echo number_format($proceduredata['price'] * $percent);?></td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
							<p class="form">
								<label for="proctotal">Total Procedimientos</label>
								<input id="proctotal" name="proctotal" readonly="readonly" style="width:10%;" type="text" value="$<?php echo number_format($proceduretotal);?>" />
							</p>
							<p class="form">
								<label for="feetotal">Total Honorarios</label>
								<input id="feetotal" name="feetotal" readonly="readonly" style="width:10%;" type="text" value="$<?php echo number_format($feetotal);?>" />
							</p>
							<?php
						}
						else{
							?>
							<p class="message">El dentista no tiene registrado procedimientos realizados durante las fechas indicadas</p>
							<?php
						}
						?>
					</form>
					<?php
				}
				else{
					?>
					<p class="center warning">Dentista no encontrado</p>
					<?php
				}
				?>
				
				
			</fieldset>
		</div>
		<!-- Fin Contenedor Principal -->
	</body>
</html>