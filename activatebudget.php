<?php
session_start();
include('modules/dbhandler.php');
include('modules/functions.php');
if(isset($_SESSION['id'])){
	if($_SESSION['privileges'] == 'sec' || $_SESSION['privileges'] == 'aux' || $_SESSION['privileges'] == 'den' || $_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web'){
		if(isset($_GET['id'])){
			$handler = new DBHandler();
			$budgetdata = $handler->getBudgetDataById($_GET['id']);
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
		<title>Dental: Activar Presupuesto</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/activatebudget.js"></script>
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
		    if($budgetdata != null){
					$patientdata = $handler->getPatientDataById($budgetdata['patient']);
					if($patientdata != null){
						?>
						<legend>Activar Presupuesto: <a href="patient.php?id=<?php echo $budgetdata['patient'];?>"><?php echo $patientdata['firstname'] . ' ' . $patientdata['firstlastname'] . ' ' . $patientdata['secondlastname'];?></a></legend>
						<?php
						if($patientdata['active'] == 1){
							?>
							<form action="#">
								<p class="form">
									<label for="id">Id Presupuesto</label>
									<input id="id" name="id" style="width:10%;" type="text" value="<?php echo $budgetdata['id'];?>" />
								</p>
								<p class="form">
									<label for="code">C&oacute;digo Presupuesto</label>
									<input id="code" name="code" style="width:10%;" type="text" value="<?php echo $budgetdata['code'];?>" />
								</p>
								<p class="form">
									<label for="patient">Id Paciente</label>
									<input id="patient" name="patient" style="width:10%;" type="text" value="<?php echo $budgetdata['patient'];?>" />
								</p>
								<p class="form">
									<label for="user">Id Usuario</label>
									<input id="user" name="user" style="width:10%;" type="text" value="<?php echo $budgetdata['user'];?>" />
								</p>
								<p class="form">
									<label for="username">Nombre Usuario</label>
									<input id="username" name="username" type="text" value="<?php echo $handler->getUserName($budgetdata['user']);?>" />
								</p>
								<p class="form">
									<label for="budgetdate">Fecha Elaboraci&oacute;n</label>
									<input id="budgetdate" name="budgetdate" style="width:10%;" type="text" value="<?php echo toFormDate($budgetdata['date']);?>" />
									<span style="font-style:italic;">mm/dd/aaaa</span>
								</p>
								<p class="form">
									<label for="activatedate">Fecha Activaci&oacute;n</label>
									<input id="activatedate" name="activatedate" style="width:10%;" type="text" value="<?php echo date('m/d/Y');?>" />
									<span style="font-style:italic;">mm/dd/aaaa</span>
								</p>
								<?php
									$value = $handler->getBudgetPrice($budgetdata['id']);
									$discount = $budgetdata['discount'];
									$total = $value - ($value * $discount);
								?>
								<p class="form">
									<label for="value">Valor Presupuesto</label>
									<input id="value" name="value" style="width:10%;" type="text" value="$<?php echo number_format($value);?>" />
								</p>
								<p class="form">
									<label for="discount">Descuento</label>
									<input id="discount" name="discount" style="width:10%;" type="text" value="<?php echo ($discount * 100);?>%" />
								</p>
								<p class="form">
									<label for="total">Valor Total Presupuesto</label>
									<input id="total" name="total" style="width:10%;" type="text" value="$<?php echo number_format($total);?>" />
								</p>
								<p class="center warning">Una vez activado el presupuesto, este aparecer&aacute; como una deuda adquirida por el paciente y aparecer&aacute; registrada en el reporte de recaudos como una deuda</p>
								<p class="form center">
									<img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
									<input type="button" value="Activar Presupuesto" />
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
				}
				else{
					?>
					<legend>Presupuesto no encontrado</legend>
					<p class="center warning">Presupuesto no encontrado</p>
					<?php
				}
				?>
			</fieldset>
			<div id="message" style="display:none;"></div>
		</div>
	</body>
</html>