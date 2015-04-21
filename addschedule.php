<?php
session_start();
include('modules/dbhandler.php');
include('modules/functions.php');
if(isset($_SESSION['id'])){
	if($_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web'){
		if(isset($_GET['id'])){
			$handler = new DBHandler();
			$userdata = $handler->getUserDataById($_GET['id']);
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
		<title>Dental: Agendar Horario</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/addschedule.js"></script>
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
				<legend>Agendar Horario: <a href="user.php?id=<?php echo $userdata['id'];?>"><?php echo $userdata['firstname'] . ' ' . $userdata['firstlastname'] . ' ' . $userdata['secondlastname'];?></a></legend>
				<?php
				if($userdata != null && $userdata['active'] == 1){
					$timelist = getTimeList();
					?>
					<form action="#">
						<p class="form">
							<label for="dentist">Id Usuario</label>
							<input id="dentist" name="dentist" readonly="readonly" type="text" style="width:10%;" value="<?php echo $userdata['id'];?>" />
						</p>
						<p class="form">
							<label for="dateinit">Fecha de inicio</label>
							<input id="dateinit" name="dateinit" readonly="readonly" style="width:10%;" type="text" />
						</p>
						<p class="form">
							<label for="monday">Lunes</label>
							<select id="monday" name="monday">
								<option value="0">No</option>
								<option value="1">Si</option>
							</select>
							<span>
								Inicio: <select name="mondayinit" disabled="disabled"><?php echo $timelist;?></select> 
								Fin: <select name="mondayend" disabled="disabled"><?php echo $timelist;?></select>
							</span>
						</p>
						<p class="form">
							<label for="tuesday">Martes</label>
							<select id="tuesday" name="tuesday">
								<option value="0">No</option>
								<option value="1">Si</option>
							</select>
							<span>
								Inicio: <select name="tuesdayinit" disabled="disabled"><?php echo $timelist;?></select> 
								Fin: <select name="tuesdayend" disabled="disabled"><?php echo $timelist;?></select>
							</span>
						</p>
						<p class="form">
							<label for="wednesday">Mi&eacute;rcoles</label>
							<select id="wednesday" name="wednesday">
								<option value="0">No</option>
								<option value="1">Si</option>
							</select>
							<span>
								Inicio: <select name="wednesdayinit" disabled="disabled"><?php echo $timelist;?></select> 
								Fin: <select name="wednesdayend" disabled="disabled"><?php echo $timelist;?></select>
							</span>
						</p>
						<p class="form">
							<label for="thursday">Jueves</label>
							<select id="thursday" name="thursday">
								<option value="0">No</option>
								<option value="1">Si</option>
							</select>
							<span>
								Inicio: <select name="thursdayinit" disabled="disabled"><?php echo $timelist;?></select> 
								Fin: <select name="thursdayend" disabled="disabled"><?php echo $timelist;?></select>
							</span>
						</p>
						<p class="form">
							<label for="friday">Viernes</label>
							<select id="friday" name="friday">
								<option value="0">No</option>
								<option value="1">Si</option>
							</select>
							<span>
								Inicio: <select name="fridayinit" disabled="disabled"><?php echo $timelist;?></select> 
								Fin: <select name="fridayend" disabled="disabled"><?php echo $timelist;?></select>
							</span>
						</p>
						<p class="form">
							<label for="saturday">S&aacute;bado</label>
							<select id="saturday" name="saturday">
								<option value="0">No</option>
								<option value="1">Si</option>
							</select>
							<span>
								Inicio: <select name="saturdayinit" disabled="disabled"><?php echo $timelist;?></select> 
								Fin: <select name="saturdayend" disabled="disabled"><?php echo $timelist;?></select>
							</span>
						</p>
						<p class="form">
							<label for="sunday">Domingo</label>
							<select id="sunday" name="sunday">
								<option value="0">No</option>
								<option value="1">Si</option>
							</select>
							<span>
								Inicio: <select name="sundayinit" disabled="disabled"><?php echo $timelist;?></select> 
								Fin: <select name="sundayend" disabled="disabled"><?php echo $timelist;?></select>
							</span>
						</p>
						<p class="form">
							<label for="description">Descripci&oacute;n</label>
							<textarea id="description" name="description" rows="120" cols="120"></textarea>
						</p>
						<p class="form center">
							<img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
							<input type="button" value="Agregar Horario" />
						</p>
					</form>
					<?php
				}
				else{
					if($userdata != null && $userdata['active'] == 0){
						?>
						<p class="center warning">El usuario se encuentra inactivo<br />Consulte a gerencia para el proceso de activaci&oacute;n</p>
						<?php
					}
					else{
						?>
						<legend>Usuario no encontrado</legend>
						<p class="center warning">Usuario no encontrado</p>
						<?php
					}
				}
				?>
			</fieldset>
			<div id="message" style="display:none;"></div>
		</div>
	</body>
</html>