<?php
session_start();
include('modules/dbhandler.php');
include('modules/functions.php');
if(isset($_SESSION['id'])){
    if($_SESSION['privileges'] == 'sec' || $_SESSION['privileges'] == 'aux' || $_SESSION['privileges'] == 'den' || $_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web'){
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
		<title>Dental: <?php echo $userdata['firstname'] . ' ' . $userdata['firstlastname'] . ' ' . $userdata['secondlastname'];?></title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<link rel="stylesheet" type="text/css" href="css/tablesorter.css" />
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
		<script type="text/javascript" src="js/user.js"></script>
	</head>
	<body>
		<div id="header">
		    <div class="center"><a href="menu.php"><img alt="logo" src="images/logo.png" /></a></div>
		    <ul class="innerlinks">
		        <li><a href="adduser.php">Agregar Usuario</a></li>
		        <li><a href="loaduser.php">Consultar Usuario</a></li>
		        <li><a href="userslist.php">Lista de Usuarios</a></li>
		    </ul>
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
					<legend>Usuario: <?php echo $userdata['firstname'] . ' ' . $userdata['firstlastname'] . ' ' . $userdata['secondlastname'];?></legend>
					<div class="persondata">
					    <p class="persondatafield">Id: <span class="clear"><?php echo $userdata['id'];?></span></p>
						<hr />
						<p class="persondatafield">Primer Nombre: <span class="clear"><?php echo $userdata['firstname'];?></span></p>
						<p class="persondatafield">Segundo Nombre: <span class="clear"><?php echo $userdata['middlename'];?></span></p>
						<p class="persondatafield">Primer Apellido: <span class="clear"><?php echo $userdata['firstlastname'];?></span></p>
						<p class="persondatafield">Segundo Apellido: <span class="clear"><?php echo $userdata['secondlastname'];?></span></p>
						<p class="persondatafield">Sexo: <span class="clear"><?php echo getSex($userdata['sex']);?></span></p>
						<p class="persondatafield">Tipo de Documento: <span class="clear"><?php echo getDocumentType($userdata['documenttype']);?></span></p>
						<p class="persondatafield">N&uacute;mero de Documento: <span class="clear"><?php echo $userdata['documentnumber'];?></span></p>
						<p class="persondatafield">Fecha de Nacimiento: <span class="clear"><?php echo toFormDate($userdata['birthdate']);?></span></p>
						<p class="persondatafield">Tipo de Sangre: <span class="clear"><?php echo getBloodtype($userdata['bloodtype']);?></span></p>
						<p class="persondatafield">Direcci&oacute;n: <span class="clear"><?php echo $userdata['address'];?></span></p>
						<p class="persondatafield">Tel&eacute;fono: <span class="clear"><?php echo $userdata['phonehome'];?></span></p>
						<p class="persondatafield">Tel&eacute;fono Oficina: <span class="clear"><?php echo $userdata['phoneoffice'];?></span></p>
						<p class="persondatafield">Celular: <span class="clear"><?php echo $userdata['cellnumber'];?></span></p>
						<p class="persondatafield">Correo Electr&oacute;nico: <span class="clear"><?php echo $userdata['email'];?></span></p>
						<p class="persondatafield">Estado Civil: <span class="clear"><?php echo getMaritalstatus($userdata['maritalstatus']);?></span></p>
						<p class="persondatafield">Dentista: <span class="clear"><?php echo getDentist($userdata['dentist']);?></span></p>
						<p class="persondatafield">Especialidad: <span class="clear"><?php echo $handler->getSpecialtyName($userdata['specialty']);?></span></p>
						<p class="persondatafield">Nombre de Usuario: <span class="clear"><?php echo $userdata['username'];?></span></p>
						<p class="persondatafield">Privilegios del Sistema: <span class="clear"><?php echo getPrivileges($userdata['privileges']);?></span></p>
						<p class="persondatafield">Activo: <span class="clear"><?php echo getState($userdata['active']);?></span></p>
					</div>
					
					<?php
					if($_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web' || $_SESSION['privileges'] == 'sec'){
						?>
						<ul class="innerlinks">
							<?php
							if($userdata['dentist'] == 1){
								?>
								<li><a href="addschedule.php?id=<?php echo $userdata['id'];?>">Agendar Horario</a></li>
								<?php
							}
							?>
							<li><a href="modifyuser.php?id=<?php echo $userdata['id'];?>">Modificar Datos</a></li>
							<li><a href="stateuser.php?id=<?php echo $userdata['id'];?>"><?php if($userdata['active'] == 1) echo 'Inactivar'; else echo 'Activar';?></a></li>
						</ul>
						<?php
					}
					?>
					<?php
					if($userdata['dentist'] == 1){
					    ?>
						<h1>Horario de atenci&oacute;n</h1>
						<hr />
						<div class="section">
							<?php
							$schedulecount = $handler->getScheduleCount($userdata['id']);
							if($schedulecount > 0){
							    $schedulelist = $handler->getScheduleList($userdata['id']);
								?>
								<table class="tablesorter">
								    <thead>
								        <tr>
									        <th>Id</th>
											<th>Fecha de inicio</th>
											<th>Lunes</th>
											<th>Martes</th>
											<th>Mi&eacute;rcoles</th>
											<th>Jueves</th>
											<th>Viernes</th>
											<th>S&aacute;bado</th>
											<th>Domingo</th>
											<th>Ver</th>
										</tr>
									</thead>
									<tbody>
									<?php
									for($i = 0;$i < $schedulecount;$i += 1){
									    ?>
										<tr>
										    <td><?php echo $schedulelist[$i][0];?></td>
											<td><?php echo toFormDate($schedulelist[$i][2]);?></td>
											<td><?php if($schedulelist[$i][3]) echo 'Si'; else echo 'No';?></td>
											<td><?php if($schedulelist[$i][6]) echo 'Si'; else echo 'No';?></td>
											<td><?php if($schedulelist[$i][9]) echo 'Si'; else echo 'No';?></td>
											<td><?php if($schedulelist[$i][12]) echo 'Si'; else echo 'No';?></td>
											<td><?php if($schedulelist[$i][15]) echo 'Si'; else echo 'No';?></td>
											<td><?php if($schedulelist[$i][18]) echo 'Si'; else echo 'No';?></td>
											<td><?php if($schedulelist[$i][21]) echo 'Si'; else echo 'No';?></td>
											<td style="text-align:center;"><a href="showschedule.php?id=<?php echo $schedulelist[$i][0];?>"><img alt="show" src="images/look.png" /></a></td>
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
								<p class="center">El usuario no tiene registrado horario de atenci&oacute;n</p>
								<?php
							}
							?>
						</div>
						<?php
					}
				}
				else{
				    ?>
					<legend>Usuario no encontrado</legend>
					<p class="center">Usuario no encontrado</p>
					<?php
				}
				?>
			</fieldset>
		</div>
	</body>
</html>