<?php
session_start();
include('modules/dbhandler.php');
include('modules/functions.php');
if(isset($_SESSION['id'])){
	$handler = new DBHandler();
	$userdata = $handler->getUserDataById($_SESSION['id']);
}
else{
	header('Location:index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Dental: Modificar Contrase&ntilde;a</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/modifypassword.js"></script>
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
		        if($userdata != null){
					?>
					<legend>Cambiar Contrase&ntilde;a: <?php echo $userdata['firstname'] . ' ' . $userdata['firstlastname'] . ' ' . $userdata['secondlastname'];?></legend>
					<?php
					if($userdata['active'] == 1){
						?>
						<form action="#">
							<p class="form">
								<label for="id">Id Usuario</label>
								<input id="id" name="id" type="text" style="width:10%;" value="<?php echo $userdata['id'];?>" />
							</p>
							<p class="form">
								<label for="oldpassword">Contrase&ntilde;a Antigua</label>
								<input id="oldpassword" name="oldpassword" type="password" />
							</p>
							<p class="form">
								<label for="newpassword">Contrase&ntilde;a Nueva</label>
								<input id="newpassword" name="newpassword" type="password" />
							</p>
							<p class="form">
								<label for="confirmedpassword">Confirmar Contrase&ntilde;a Nueva</label>
								<input id="confirmedpassword" name="confirmedpassword" type="password" />
							</p>
							<p class="form center">
								<img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
								<input type="button" value="Modificar Contrase&ntilde;a" />
							</p>
						</form>
						<?php
					}
					else{
						?>
						<p class="center warning">El usuario se encuentra inactivo<br />Consulte a gerencia para el proceso de activaci&oacute;n</p>
						<?php
					}
				}
				else{
					?>
					<legend>Usuario no encontrado</legend>
					<p class="center warning">Usuario no encontrado</p>
					<?php
				}
		        ?>
			</fieldset>
		    <div id="message" style="display:none;"></div>
        </div>
	</body>
</html>