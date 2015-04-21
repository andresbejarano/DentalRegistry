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
		<title>Dental: Agregar Odontograma</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/addodontogram.js"></script>
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
					<legend><a href="medicalrecord.php?id=<?php echo $patientdata['id'];?>">Historia Cl&iacute;nica</a> &rarr; Agregar Odontograma: <a href="patient.php?id=<?php echo $patientdata['id'];?>"><?php echo $patientdata['firstname'] . ' ' . $patientdata['firstlastname'] . ' ' . $patientdata['secondlastname'];?></a></legend>
					<?php
					if($patientdata['active'] == 1){
						?>
						<form action="#" id="odontogram">
							<h1>Informaci&oacute;n Inicial (Autom&aacute;tico)</h1>
							<hr />
							<p class="form">
								<label for="patient">Id Paciente</label>
								<input id="patient" name="patient" readonly="readonly" style="width:10%;" type="text" value="<?php echo $patientdata['id'];?>" />
							</p>
							<p class="form">
								<label for="user">Id Usuario</label>
								<input id="user" name="user" readonly="readonly" style="width:10%;" type="text" value="<?php echo $_SESSION['id'];?>" />
							</p>
							<p class="form">
								<label for="username">Nombre Usuario</label>
								<input id="username" name="username" readonly="readonly" type="text" value="<?php echo $_SESSION['name'];?>" />
							</p>
							<p class="form">
								<label for="date">Fecha</label>
								<input id="date" name="date" style="width:10%;" readonly="readonly" type="text" value="<?php echo date('m/d/Y');?>" />
								<span style="font-style:italic;">mm/dd/aaaa</span>
							</p>
							<h1>Informaci&oacute;n Dental</h1>
							<hr />
							<table class="odontogram">
								<tr>
									<td>
										<div class="tooth">
											<img id="d18t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d18l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d18b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d18r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d18c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d18s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d18k" alt="n" src="images/odontogram/bk.png" usemap="#d18" width="60" height="60" style="z-index:7;" />
											<map id="d18" name="d18">
												<area id="a18t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a18l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a18b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a18r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a18c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d17t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d17l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d17b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d17r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d17c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d17s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d17k" alt="n" src="images/odontogram/bk.png" usemap="#d17" width="60" height="60" style="z-index:7;" />
											<map id="d17" name="d17">
												<area id="a17t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a17l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a17b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a17r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a17c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d16t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d16l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d16b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d16r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d16c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d16s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d16k" alt="n" src="images/odontogram/bk.png" usemap="#d16" width="60" height="60" style="z-index:7;" />
											<map id="d16" name="d16">
												<area id="a16t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a16l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a16b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a16r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a16c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d15t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d15l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d15b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d15r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d15c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d15s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d15k" alt="n" src="images/odontogram/bk.png" usemap="#d15" width="60" height="60" style="z-index:7;" />
											<map id="d15" name="d15">
												<area id="a15t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a15l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a15b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a15r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a15c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d14t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d14l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d14b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d14r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d14c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d14s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d14k" alt="n" src="images/odontogram/bk.png" usemap="#d14" width="60" height="60" style="z-index:7;" />
											<map id="d14" name="d14">
												<area id="a14t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a14l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a14b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a14r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a14c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d13t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d13l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d13b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d13r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d13c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d13s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d13k" alt="n" src="images/odontogram/bk.png" usemap="#d13" width="60" height="60" style="z-index:7;" />
											<map id="d13" name="d13">
												<area id="a13t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a13l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a13b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a13r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a13c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d12t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d12l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d12b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d12r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d12c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d12s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d12k" alt="n" src="images/odontogram/bk.png" usemap="#d12" width="60" height="60" style="z-index:7;" />
											<map id="d12" name="d12">
												<area id="a12t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a12l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a12b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a12r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a12c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d11t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d11l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d11b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d11r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d11c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d11s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d11k" alt="n" src="images/odontogram/bk.png" usemap="#d11" width="60" height="60" style="z-index:7;" />
											<map id="d11" name="d11">
												<area id="a11t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a11l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a11b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a11r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a11c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td><img alt="bk"  id="center" src="images/odontogram/bk.png" /></td>
									<td>
										<div class="tooth">
											<img id="d21t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d21l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d21b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d21r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d21c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d21s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d21k" alt="n" src="images/odontogram/bk.png" usemap="#d21" width="60" height="60" style="z-index:7;" />
											<map id="d21" name="d21">
												<area id="a21t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a21l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a21b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a21r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a21c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d22t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d22l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d22b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d22r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d22c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d22s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d22k" alt="n" src="images/odontogram/bk.png" usemap="#d22" width="60" height="60" style="z-index:7;" />
											<map id="d22" name="d22">
												<area id="a22t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a22l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a22b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a22r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a22c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d23t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d23l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d23b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d23r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d23c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d23s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d23k" alt="n" src="images/odontogram/bk.png" usemap="#d23" width="60" height="60" style="z-index:7;" />
											<map id="d23" name="d23">
												<area id="a23t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a23l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a23b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a23r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a23c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d24t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d24l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d24b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d24r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d24c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d24s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d24k" alt="n" src="images/odontogram/bk.png" usemap="#d24" width="60" height="60" style="z-index:7;" />
											<map id="d24" name="d24">
												<area id="a24t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a24l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a24b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a24r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a24c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d25t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d25l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d25b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d25r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d25c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d25s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d25k" alt="n" src="images/odontogram/bk.png" usemap="#d25" width="60" height="60" style="z-index:7;" />
											<map id="d25" name="d25">
												<area id="a25t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a25l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a25b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a25r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a25c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d26t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d26l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d26b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d26r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d26c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d26s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d26k" alt="n" src="images/odontogram/bk.png" usemap="#d26" width="60" height="60" style="z-index:7;" />
											<map id="d26" name="d26">
												<area id="a26t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a26l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a26b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a26r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a26c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d27t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d27l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d27b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d27r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d27c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d27s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d27k" alt="n" src="images/odontogram/bk.png" usemap="#d27" width="60" height="60" style="z-index:7;" />
											<map id="d27" name="d27">
												<area id="a27t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a27l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a27b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a27r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a27c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d28t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d28l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d28b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d28r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d28c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d28s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d28k" alt="n" src="images/odontogram/bk.png" usemap="#d28" width="60" height="60" style="z-index:7;" />
											<map id="d28" name="d28">
												<area id="a28t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a28l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a28b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a28r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a28c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
								</tr>
								<tr>
									<td>18</td><td>17</td><td>16</td><td>15</td><td>14</td><td>13</td><td>12</td><td>11</td>
									<td></td>
									<td>21</td><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td>
								</tr>
							</table>
							<table class="odontogram">
								<tr>
									<td><img alt="bk" src="images/odontogram/bk.png" /></td>
									<td><img alt="bk" src="images/odontogram/bk.png" /></td>
									<td><img alt="bk" src="images/odontogram/bk.png" /></td>
									<td>
										<div class="tooth">
											<img id="d55t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d55l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d55b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d55r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d55c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d55s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d55k" alt="n" src="images/odontogram/bk.png" usemap="#d55" width="60" height="60" style="z-index:7;" />
											<map id="d55" name="d55">
												<area id="a55t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a55l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a55b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a55r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a55c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d54t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d54l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d54b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d54r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d54c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d54s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d54k" alt="n" src="images/odontogram/bk.png" usemap="#d54" width="60" height="60" style="z-index:7;" />
											<map id="d54" name="d54">
												<area id="a54t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a54l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a54b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a54r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a54c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d53t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d53l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d53b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d53r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d53c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d53s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d53k" alt="n" src="images/odontogram/bk.png" usemap="#d53" width="60" height="60" style="z-index:7;" />
											<map id="d53" name="d53">
												<area id="a53t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a53l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a53b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a53r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a53c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d52t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d52l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d52b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d52r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d52c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d52s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d52k" alt="n" src="images/odontogram/bk.png" usemap="#d52" width="60" height="60" style="z-index:7;" />
											<map id="d52" name="d52">
												<area id="a52t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a52l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a52b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a52r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a52c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d51t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d51l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d51b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d51r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d51c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d51s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d51k" alt="n" src="images/odontogram/bk.png" usemap="#d51" width="60" height="60" style="z-index:7;" />
											<map id="d51" name="d51">
												<area id="a51t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a51l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a51b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a51r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a51c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td><img alt="bk" src="images/odontogram/bk.png" /></td>
									<td>
										<div class="tooth">
											<img id="d61t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d61l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d61b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d61r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d61c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d61s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d61k" alt="n" src="images/odontogram/bk.png" usemap="#d61" width="60" height="60" style="z-index:7;" />
											<map id="d61" name="d61">
												<area id="a61t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a61l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a61b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a61r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a61c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d62t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d62l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d62b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d62r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d62c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d62s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d62k" alt="n" src="images/odontogram/bk.png" usemap="#d62" width="60" height="60" style="z-index:7;" />
											<map id="d62" name="d62">
												<area id="a62t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a62l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a62b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a62r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a62c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d63t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d63l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d63b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d63r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d63c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d63s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d63k" alt="n" src="images/odontogram/bk.png" usemap="#d63" width="60" height="60" style="z-index:7;" />
											<map id="d63" name="d63">
												<area id="a63t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a63l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a63b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a63r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a63c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d64t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d64l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d64b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d64r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d64c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d64s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d64k" alt="n" src="images/odontogram/bk.png" usemap="#d64" width="60" height="60" style="z-index:7;" />
											<map id="d64" name="d64">
												<area id="a64t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a64l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a64b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a64r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a64c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d65t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d65l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d65b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d65r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d65c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d65s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d65k" alt="n" src="images/odontogram/bk.png" usemap="#d65" width="60" height="60" style="z-index:7;" />
											<map id="d65" name="d65">
												<area id="a65t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a65l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a65b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a65r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a65c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td><img alt="bk" src="images/odontogram/bk.png" /></td>
									<td><img alt="bk" src="images/odontogram/bk.png" /></td>
									<td><img alt="bk" src="images/odontogram/bk.png" /></td>
								</tr>
								<tr>
									<td></td><td></td><td></td><td>55</td><td>54</td><td>53</td><td>52</td><td>51</td>
									<td></td>
									<td>61</td><td>62</td><td>63</td><td>64</td><td>65</td><td></td><td></td><td></td>
								</tr>
							</table>
							<hr />
							<table class="odontogram">
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td>85</td><td>84</td><td>83</td><td>82</td><td>81</td>
									<td></td>
									<td>71</td><td>72</td><td>73</td><td>74</td><td>75</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td><img alt="separator" src="images/odontogram/bk.png" /></td>
									<td><img alt="sepataror" src="images/odontogram/bk.png" /></td>
									<td><img alt="separator" src="images/odontogram/bk.png" /></td>
									<td>
										<div class="tooth">
											<img id="d85t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d85l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d85b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d85r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d85c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d85s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d85k" alt="n" src="images/odontogram/bk.png" usemap="#d85" width="60" height="60" style="z-index:7;" />
											<map id="d85" name="d85">
												<area id="a85t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a85l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a85b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a85r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a85c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d84t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d84l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d84b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d84r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d84c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d84s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d84k" alt="n" src="images/odontogram/bk.png" usemap="#d84" width="60" height="60" style="z-index:7;" />
											<map id="d84" name="d84">
												<area id="a84t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a84l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a84b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a84r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a84c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d83t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d83l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d83b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d83r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d83c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d83s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d83k" alt="n" src="images/odontogram/bk.png" usemap="#d83" width="60" height="60" style="z-index:7;" />
											<map id="d83" name="d83">
												<area id="a83t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a83l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a83b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a83r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a83c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d82t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d82l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d82b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d82r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d82c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d82s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d82k" alt="n" src="images/odontogram/bk.png" usemap="#d82" width="60" height="60" style="z-index:7;" />
											<map id="d82" name="d82">
												<area id="a82t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a82l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a82b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a82r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a82c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d81t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d81l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d81b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d81r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d81c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d81s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d81k" alt="n" src="images/odontogram/bk.png" usemap="#d81" width="60" height="60" style="z-index:7;" />
											<map id="d81" name="d81">
												<area id="a81t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a81l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a81b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a81r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a81c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td><img alt="separator" src="images/odontogram/bk.png" /></td>
									<td>
										<div class="tooth">
											<img id="d71t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d71l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d71b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d71r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d71c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d71s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d71k" alt="n" src="images/odontogram/bk.png" usemap="#d71" width="60" height="60" style="z-index:7;" />
											<map id="d71" name="d71">
												<area id="a71t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a71l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a71b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a71r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a71c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d72t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d72l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d72b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d72r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d72c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d72s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d72k" alt="n" src="images/odontogram/bk.png" usemap="#d72" width="60" height="60" style="z-index:7;" />
											<map id="d72" name="d72">
												<area id="a72t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a72l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a72b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a72r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a72c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d73t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d73l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d73b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d73r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d73c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d73s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d73k" alt="n" src="images/odontogram/bk.png" usemap="#d73" width="60" height="60" style="z-index:7;" />
											<map id="d73" name="d73">
												<area id="a73t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a73l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a73b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a73r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a73c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d74t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d74l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d74b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d74r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d74c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d74s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d74k" alt="n" src="images/odontogram/bk.png" usemap="#d74" width="60" height="60" style="z-index:7;" />
											<map id="d74" name="d74">
												<area id="a74t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a74l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a74b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a74r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a74c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d75t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d75l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d75b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d75r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d75c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d75s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d75k" alt="n" src="images/odontogram/bk.png" usemap="#d75" width="60" height="60" style="z-index:7;" />
											<map id="d75" name="d75">
												<area id="a75t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a75l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a75b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a75r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a75c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td><img alt="separator" src="images/odontogram/bk.png" /></td>
									<td><img alt="separator" src="images/odontogram/bk.png" /></td>
									<td><img alt="separator" src="images/odontogram/bk.png" /></td>
								</tr>
							</table>
							<table class="odontogram">
								<tr>
									<td>48</td><td>47</td><td>46</td><td>45</td><td>44</td><td>43</td><td>42</td><td>41</td>
									<td></td>
									<td>31</td><td>32</td><td>33</td><td>34</td><td>35</td><td>36</td><td>37</td><td>38</td>
								</tr>
								<tr>
									<td>
										<div class="tooth">
											<img id="d48t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d48l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d48b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d48r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d48c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d48s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d48k" alt="n" src="images/odontogram/bk.png" usemap="#d48" width="60" height="60" style="z-index:7;" />
											<map id="d48" name="d48">
												<area id="a48t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a48l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a48b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a48r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a48c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d47t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d47l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d47b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d47r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d47c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d47s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d47k" alt="n" src="images/odontogram/bk.png" usemap="#d47" width="60" height="60" style="z-index:7;" />
											<map id="d47" name="d47">
												<area id="a47t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a47l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a47b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a47r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a47c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d46t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d46l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d46b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d46r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d46c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d46s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d46k" alt="n" src="images/odontogram/bk.png" usemap="#d46" width="60" height="60" style="z-index:7;" />
											<map id="d46" name="d46">
												<area id="a46t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a46l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a46b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a46r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a46c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d45t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d45l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d45b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d45r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d45c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d45s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d45k" alt="n" src="images/odontogram/bk.png" usemap="#d45" width="60" height="60" style="z-index:7;" />
											<map id="d45" name="d45">
												<area id="a45t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a45l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a45b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a45r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a45c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d44t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d44l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d44b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d44r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d44c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d44s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d44k" alt="n" src="images/odontogram/bk.png" usemap="#d44" width="60" height="60" style="z-index:7;" />
											<map id="d44" name="d44">
												<area id="a44t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a44l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a44b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a44r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a44c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d43t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d43l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d43b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d43r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d43c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d43s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d43k" alt="n" src="images/odontogram/bk.png" usemap="#d43" width="60" height="60" style="z-index:7;" />
											<map id="d43" name="d43">
												<area id="a43t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a43l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a43b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a43r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a43c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d42t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d42l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d42b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d42r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d42c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d42s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d42k" alt="n" src="images/odontogram/bk.png" usemap="#d42" width="60" height="60" style="z-index:7;" />
											<map id="d42" name="d42">
												<area id="a42t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a42l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a42b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a42r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a42c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d41t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d41l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d41b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d41r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d41c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d41s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d41k" alt="n" src="images/odontogram/bk.png" usemap="#d41" width="60" height="60" style="z-index:7;" />
											<map id="d41" name="d41">
												<area id="a41t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a41l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a41b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a41r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a41c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td><img alt="bk" src="images/odontogram/bk.png" /></td>
									<td>
										<div class="tooth">
											<img id="d31t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d31l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d31b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d31r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d31c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d31s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d31k" alt="n" src="images/odontogram/bk.png" usemap="#d31" width="60" height="60" style="z-index:7;" />
											<map id="d31" name="d31">
												<area id="a31t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a31l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a31b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a31r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a31c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d32t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d32l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d32b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d32r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d32c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d32s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d32k" alt="n" src="images/odontogram/bk.png" usemap="#d32" width="60" height="60" style="z-index:7;" />
											<map id="d32" name="d32">
												<area id="a32t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a32l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a32b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a32r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a32c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d33t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d33l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d33b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d33r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d33c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d33s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d33k" alt="n" src="images/odontogram/bk.png" usemap="#d33" width="60" height="60" style="z-index:7;" />
											<map id="d33" name="d33">
												<area id="a33t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a33l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a33b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a33r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a33c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d34t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d34l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d34b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d34r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d34c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d34s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d34k" alt="n" src="images/odontogram/bk.png" usemap="#d34" width="60" height="60" style="z-index:7;" />
											<map id="d34" name="d34">
												<area id="a34t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a34l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a34b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a34r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a34c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d35t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d35l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d35b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d35r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d35c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d35s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d35k" alt="n" src="images/odontogram/bk.png" usemap="#d35" width="60" height="60" style="z-index:7;" />
											<map id="d35" name="d35">
												<area id="a35t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a35l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a35b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a35r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a35c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d36t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d36l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d36b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d36r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d36c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d36s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d36k" alt="n" src="images/odontogram/bk.png" usemap="#d36" width="60" height="60" style="z-index:7;" />
											<map id="d36" name="d36">
												<area id="a36t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a36l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a36b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a36r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a36c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d37t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d37l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d37b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d37r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d37c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d37s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d37k" alt="n" src="images/odontogram/bk.png" usemap="#d37" width="60" height="60" style="z-index:7;" />
											<map id="d37" name="d37">
												<area id="a37t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a37l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a37b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a37r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a37c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
									<td>
										<div class="tooth">
											<img id="d38t" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:1;" />
											<img id="d38l" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:2;" />
											<img id="d38b" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:3;" />
											<img id="d38r" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:4;" />
											<img id="d38c" alt="n" src="images/odontogram/n.png" width="60" height="60" style="z-index:5;" />
											<img id="d38s" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:6;" />
											<img id="d38k" alt="n" src="images/odontogram/bk.png" usemap="#d38" width="60" height="60" style="z-index:7;" />
											<map id="d38" name="d38">
												<area id="a38t" alt="1" href="#center" shape="poly" title="Arriba" coords="19,19,27,15,33,15,40,19,50,9,37,1,22,1,9,9" />
												<area id="a38l" alt="2" href="#center" shape="poly" title="Izquierda" coords="9,9,4,15,0,25,0,35,4,45,9,50,19,40,15,29,19,19" />
												<area id="a38b" alt="3" href="#center" shape="poly" title="Abajo" coords="19,40,9,50,21,57,25,58,35,58,38,57,50,50,40,40,34,44,25,44" />
												<area id="a38r" alt="4" href="#center" shape="poly" title="Derecha" coords="50,50,58,37,58,22,50,9,40,20,44,26,44,33,40,40" />
												<area id="a38c" alt="5" href="#center" shape="poly" title="Centro" coords="19,19,15,29,19,40,30,44,40,40,44,30,40,19,30,15" />
											</map>
										</div>
									</td>
								</tr>
							</table>
						</form>
						<table class="options">
							<tr>
								<td><a name="r" title="r" class="option" href="#center"><img alt="n" src="images/odontogram/ir.png" title="Caries" /></a></td>
								<td><a name="b" title="b" class="option" href="#center"><img alt="n" src="images/odontogram/ib.png" title="Amalgamas" /></a></td>
								<td><a name="l" title="l" class="option" href="#center"><img alt="n" src="images/odontogram/il.png" title="Resinas" /></a></td>
								<td><a name="p" title="p" class="option" href="#center"><img alt="n" src="images/odontogram/ip.png" title="Para Sellante" /></a></td>
								<td><a name="pe" title="pe" class="option" href="#center"><img alt="n" src="images/odontogram/ipe.png" title="Perdido" /></a></td>
								<td><a name="se" title="se" class="option" href="#center"><img alt="n" src="images/odontogram/ise.png" title="Sin Erupcionar" /></a></td>
								<td><a name="x" title="x" class="option" href="#center"><img alt="n" src="images/odontogram/ix.png" title="Resto Radicular" /></a></td>
								<td><a name="sl" title="sl" class="option" href="#center"><img alt="n" src="images/odontogram/isl.png" title="Tiene Sellante" /></a></td>
								<td><a name="g" title="g" class="option" href="#center"><img alt="n" src="images/odontogram/ig.png" title="Protesis Fija" /></a></td>
								<td><a name="pr" title="pr" class="option" href="#center"><img alt="n" src="images/odontogram/ipr.png" title="Protesis Removible" /></a></td>
								<td><a name="di" title="di" class="option" href="#center"><img alt="n" src="images/odontogram/idi.png" title="Diente Incluido" /></a></td>
								<td><a name="sn" title="sn" class="option" href="#center"><img alt="n" src="images/odontogram/isn.png" title="Super Numerario" /></a></td>
								<td><a name="o" title="o" class="option" href="#center"><img alt="n" src="images/odontogram/io.png" title="Obturacion Temporal" /></a></td>
							</tr>
						</table>
						<form id="options" action="#">
							<p class="form">
								<label for="description">Descripci&oacute;n</label>
								<textarea id="description" name="description" rows="120" cols="120"></textarea>
							</p>
							<p class="form">
								<input id="selection" name="selection" type="hidden" style="width:10%;" />
							</p>
						</form>
						<p class="form center">
							<img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
							<input type="button" value="Agregar Odontograma" />
						</p>
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