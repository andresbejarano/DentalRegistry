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
				$budgetinfocount = $handler->getBudgetInfoCount($_GET['id']);
				$budgetinfolist = $handler->getBudgetInfoList($_GET['id']);
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
		<title>Dental: Modificar Presupuesto</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/modifybudget.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				<?php
				for($i = 0;$i < $budgetinfocount;$i += 1){
					?>
					$('#procedure<?php echo ($i + 1);?>').val('<?php echo $budgetinfolist[$i][2];?>');
					$('#location<?php echo ($i + 1);?>').val('<?php echo $budgetinfolist[$i][3];?>');
					<?php
				}
				?>
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
		        <?php
		        if($budgetdata != null && $patientdata != null){
					?>
					<legend>Modificar Presupuesto: <a href="patient.php?id=<?php echo $patientdata['id'];?>"><?php echo $patientdata['firstname'] . ' ' . $patientdata['firstlastname'] . ' ' . $patientdata['secondlastname'];?></a></legend>
					<?php
					if($patientdata['active'] == 1){
						?>
						<form action="#">
							<p class="form">
								<label for="id">Id Presupuesto</label>
								<input id="id" name="id" readonly="readonly" style="width:10%;" type="text" value="<?php echo $budgetdata['id'];?>" />
							</p>
							<p class="form">
								<label for="code">C&oacute;digo Presupuesto</label>
								<input id="code" name="code" readonly="readonly" style="width:10%;" type="text" value="<?php echo $budgetdata['code'];?>" />
							</p>
							<p class="form">
								<label for="patient">Id Paciente</label>
								<input id="patient" name="patient" readonly="readonly" style="width:10%;" type="text" value="<?php echo $budgetdata['patient'];?>" />
							</p>
							<p class="form">
								<label for="user">Id Usuario</label>
								<input id="user" name="user" readonly="readonly" style="width:10%;" type="text" value="<?php echo $budgetdata['user'];?>" />
							</p>
							<p class="form">
								<label for="username">Nombre Usuario</label>
								<input id="username" name="username" readonly="readonly" type="text" value="<?php echo $_SESSION['name'];?>" />
							</p>
							<p class="form">
								<label for="date">Fecha</label>
								<input id="date" name="date" style="width:10%;" readonly="readonly" type="text" value="<?php echo toFormDate($budgetdata['date']);?>" />
							</p>
							<?php
							$procedurelist = getProcedureList();
							$locationlist = getLocationList();
							for($i = 1;$i <= 20;$i += 1){
								?>
								<p class="form">
									<label for="procedure<?php echo $i;?>">Procedimiento <?php echo $i;?></label>
									<select id="procedure<?php echo $i;?>" name="procedure<?php echo $i;?>"><?php echo $procedurelist;?></select>
								</p>
								<p class="form">
									<label for="location<?php echo $i;?>">Ubicaci&oacute;n <?php echo $i;?></label>
									<select id="location<?php echo $i;?>" name="location<?php echo $i;?>"><?php echo $locationlist;?></select>
								</p>
								<?php
							}
							?>
							<p class="form">
								<label for="discount">Descuento</label>
								<input id="discount" name="discount" style="width:10%;" type="text" value="<?php echo $budgetdata['discount'];?>" />
								<span style="font-style:italic;">Formato decimal: 0.5</span>
							</p>
							<p class="form">
								<label for="description">Descripci&oacute;n</label>
								<textarea id="description" name="description" rows="10" cols="20"><?php echo $budgetdata['description'];?></textarea>
							</p>
							<p class="form center">
								<img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
								<input type="button" value="Modificar Presupuesto" />
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
	</body>
</html>