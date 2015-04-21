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
				$budgetinfocount = $handler->getBudgetInfoCount($_GET['id']);
				$budgetinfolist = $handler->getBudgetInfoList($_GET['id']);
				$patientdata = $handler->getPatientDataById($budgetdata['patient']);
				$count = $handler->getBudgetEvolveCount($budgetdata['id']);
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
		<title>Dental: Actualizar Presupuesto</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/updatebudget.js"></script>
		<?php
		if($count > 0){
			$list = $handler->getBudgetEvolveList($budgetdata['id']);
			?>
			<script type="text/javascript">
				$(document).ready(function(){
					<?php
					for($i = 0;$i < $count;$i += 1){
						if($list[$i][5] == 1){
							?>
							$(<?php echo "'#done" . ($i + 1) . "'";?>).val(<?php echo $list[$i][5];?>);
							$(<?php echo "'#done" . ($i + 1) . "'";?>).attr('disabled','disabled');
							$(<?php echo "'#user" . ($i + 1) . "'";?>).val(<?php echo $list[$i][6];?>);
							$(<?php echo "'#user" . ($i + 1) . "'";?>).attr('disabled','disabled');
							$(<?php echo "'#date" . ($i + 1) . "'";?>).attr('disabled','disabled');
							$(<?php echo "'#description" . ($i + 1) . "'";?>).attr('disabled','disabled');
							<?php
						}
					}
					?>
				});
			</script>
			<?php
		}
		?>
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
					<legend>Evolucionar Presupuesto: <a href="patient.php?id=<?php echo $patientdata['id'];?>"><?php echo $patientdata['firstname'] . ' ' . $patientdata['firstlastname'] . ' ' . $patientdata['secondlastname'];?></a></legend>
					<?php
					if($patientdata['active'] == 1){
						if($budgetdata['active'] == 1){
							?>
							<form action="#">
								<p class="form">
									<label for="patient">Id Paciente</label>
									<input id="patient" name="patient" style="width:10%;" type="text" value="<?php echo $budgetdata['patient'];?>" />
								</p>
								<p class="form">
									<label for="id">Id Presupuesto</label>
									<input id="id" name="id" style="width:10%;" type="text" value="<?php echo $budgetdata['id'];?>" />
								</p>
								<p class="form">
									<label for="code">C&oacute;digo Presupuesto</label>
									<input id="code" name="code" style="width:10%;" type="text" value="<?php echo $budgetdata['code'];?>" />
								</p>
								<p class="form">
									<label for="user">Id Usuario</label>
									<input id="user" name="user" style="width:10%;" type="text" value="<?php echo $budgetdata['user'];?>" />
								</p>
								<p class="form">
									<label for="username">Nombre Usuario</label>
									<input id="username" name="username" type="text" value="<?php echo $_SESSION['name'];?>" />
								</p>
								<p class="form">
									<label for="date">Fecha</label>
									<input id="date" name="date" style="width:10%;" type="text" value="<?php echo toFormDate($budgetdata['date']);?>" />
								</p>
								<p class="form">
									<label for="discount">Descuento</label>
									<input id="discount" name="discount" style="width:10%;" type="text" value="<?php echo ($budgetdata['discount'] * 100) . '%';?>" />
								</p>
								<?php
								if($count > 0){
									?>
									<h1>Subprocedimientos</h1>
									<?php
									$locationlist = getLocationList();
									$dentistlist = getDentistList();
									for($i = 0;$i < $count;$i += 1){
										?>
										<hr />
										<p class="form">
											<label for="id<?php echo ($i + 1);?>">Id Subprocedimiento</label>
											<input id="id<?php echo ($i + 1);?>" name="id<?php echo ($i + 1);?>" style="width:10%;" type="text" value="<?php echo $list[$i][0];?>" />
										</p>
										<p class="form">
											<label for="procedure<?php echo ($i + 1);?>">Procedimiento</label>
											<input id="procedure<?php echo ($i + 1);?>" name="procedure<?php echo ($i + 1);?>" type="text" value="<?php echo $handler->getProcedureName($list[$i][3]);?>" />
										</p>
										<p class="form">
											<label for="subprocedure<?php echo ($i + 1);?>">Subprocedimiento</label>
											<input id="subprocedure<?php echo ($i + 1);?>" name="subprocedure<?php echo ($i + 1);?>" type="text" value="<?php echo $handler->getSubProcedureName($list[$i][4]);?>" />
										</p>
										<p class="form">
											<label for="location<?php echo ($i + 1);?>">Ubicaci&oacute;n</label>
											<input id="location<?php echo ($i + 1);?>" name="location<?php echo ($i + 1);?>" style="width:10%;" type="text" value="<?php echo $handler->getLocationName($list[$i][8]);?>" />
										</p>
										<p class="form">
											<label for="done<?php echo ($i + 1);?>">Finalizado</label>
											<select id="done<?php echo ($i + 1);?>" name="done<?php echo ($i + 1);?>"><option value="0">No</option><option value="1">Si</option></select>
										</p>
										<p class="form">
											<label for="user<?php echo ($i + 1);?>">Dentista</label>
											<select id="user<?php echo ($i + 1);?>" name="user<?php echo ($i + 1);?>"><?php echo $dentistlist;?></select>
										</p>
										<p class="form">
											<label for="date<?php echo ($i + 1);?>">Fecha</label>
											<input class="date" id="date<?php echo ($i + 1);?>" name="date<?php echo ($i + 1);?>" style="width:10%;" type="text" value="<?php if($list[$i][7] != null) echo toFormDate($list[$i][7]);?>" />
										</p>
										<p class="form">
											<label for="description<?php echo ($i + 1);?>">Descripci&oacute;n</label>
											<textarea id="description<?php echo ($i + 1);?>" name="description<?php echo ($i + 1);?>" rows="120" cols="120"><?php echo $list[$i][9] ;?></textarea>
										</p>
										<?php
									}
								}
								?>
								<p class="form center">
									<img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
									<input type="button" value="Evolucionar Presupuesto" />
								</p>
							</form>
							<?php
						}
						else{
							?>
							<p class="center warning">El presupuesto no est&aacute; activado</p>
							<?php
						}
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