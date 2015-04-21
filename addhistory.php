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
		<title>Dental: Ingreso de Historia Cl&iacute;nica</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/addhistory.js"></script>
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
					<legend><a href="medicalrecord.php?id=<?php echo $patientdata['id'];?>">Historia Cl&iacute;nica</a> &rarr; Crear historia cl&iacute;nica: <a href="patient.php?id=<?php echo $patientdata['id'];?>"><?php echo $patientdata['firstname'] . ' ' . $patientdata['firstlastname'] . ' ' . $patientdata['secondlastname'];?></a></legend>
					<?php
					if($patientdata['active'] == 1){
						$background = $handler->getHistoryByPatient($patientdata['id']);
						if($background == null){
							?>
							<form action="#" id="medicalrecord" method="post">
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
									<input id="date" name="date" readonly="readonly" style="width:10%;" type="text" value="<?php echo date('m/d/Y');?>" />
									<span style="font-style:italic;">mm/dd/aaaa</span>
								</p>
								<h1>1. Antecedentes del Paciente</h1>
								<hr />
								<p class="form">
									<label for="history1">Afecciones cardiacas</label>
									<select id="history1" name="history1"><option value="0">No</option><option value="1">Si</option></select>
									<input id="historydesc1" name="historydesc1" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="history2">Diabetes</label>
									<select id="history2" name="history2"><option value="0">No</option><option value="1">Si</option></select>
									<input id="historydesc2" name="historydesc2" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="history3">Asma</label>
									<select id="history3" name="history3"><option value="0">No</option><option value="1">Si</option></select>
									<input id="history3desc" name="historydesc3" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="history4">Hipertensi&oacute;n</label>
									<select id="history4" name="history4"><option value="0">No</option><option value="1">Si</option></select>
									<input id="historydesc4" name="historydesc4" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="history5">Epilepsia</label>
									<select id="history5" name="history5"><option value="0">No</option><option value="1">Si</option></select>
									<input id="historydesc5" name="historydesc5" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="history6">Cancer</label>
									<select id="history6" name="history6"><option value="0">No</option><option value="1">Si</option></select>
									<input id="historydesc6" name="historydesc6" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="history7">Tuberculosis</label>
									<select id="history7" name="history7"><option value="0">No</option><option value="1">Si</option></select>
									<input id="historydesc7" name="historydesc7" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="history8">VIH - Sida</label>
									<select id="history8" name="history8"><option value="0">No</option><option value="1">Si</option></select>
									<input id="historydesc8" name="historydesc8" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="history9">Hepatitis</label>
									<select id="history9" name="history9"><option value="0">No</option><option value="1">Si</option></select>
									<input id="historydesc9" name="historydesc9" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="history10">Fiebre reum&aacute;tica</label>
									<select id="history10" name="history10"><option value="0">No</option><option value="1">Si</option></select>
									<input id="historydesc10" name="historydesc10" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="history11">Gastrointestinales</label>
									<select id="history11" name="history11"><option value="0">No</option><option value="1">Si</option></select>
									<input id="historydesc11" name="historydesc11" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="history12">Convulsiones</label>
									<select id="history12" name="history12"><option value="0">No</option><option value="1">Si</option></select>
									<input id="historydesc12" name="historydesc12" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="history13">Fracturas</label>
									<select id="history13" name="history13"><option value="0">No</option><option value="1">Si</option></select>
									<input id="historydesc13" name="historydesc13" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="history14">Hemorragias</label>
									<select id="history14" name="history14"><option value="0">No</option><option value="1">Si</option></select>
									<input id="historydesc14" name="historydesc14" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="history15">Alergias</label>
									<select id="history15" name="history15"><option value="0">No</option><option value="1">Si</option></select>
									<input id="historydesc15" name="historydesc15" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="history16">H&aacute;bitos</label>
									<select id="history16" name="history16"><option value="0">No</option><option value="1">Si</option></select>
									<input id="historydesc16" name="historydesc16" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="history17">Medicamentos</label>
									<select id="history17" name="history17"><option value="0">No</option><option value="1">Si</option></select>
									<input id="historydesc17" name="historydesc17" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="history18">Hospitalizaci&oacute;n</label>
									<select id="history18" name="history18"><option value="0">No</option><option value="1">Si</option></select>
									<input id="historydesc18" name="historydesc18" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="history19">Transfusiones</label>
									<select id="history19" name="history19"><option value="0">No</option><option value="1">Si</option></select>
									<input id="historydesc19" name="historydesc19" style="width:60%;" type="text" />
								</p>
								<h1>2. Examen Cl&iacute;nico</h1>
								<hr />
								<p class="form">
									<label for="test1">Adenopat&iacute;as</label>
									<select id="test1" name="test1"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc1" name="testdesc1" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test2">ATM</label>
									<select id="test2" name="test2"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc2" name="testdesc2" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test3">Maxilares</label>
									<select id="test3" name="test3"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc3" name="testdesc3" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test4">Labios</label>
									<select id="test4" name="test4"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc4" name="testdesc4" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test5">Mejillas</label>
									<select id="test5" name="test5"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc5" name="testdesc5" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test6">Luxaci&oacute;n de mand&iacute;bula</label>
									<select id="test6" name="test6"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc6" name="testdesc6" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test7">Fractura de mand&iacute;bula</label>
									<select id="test7" name="test7"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc7" name="testdesc7" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test8">Amigdalitis</label>
									<select id="test8" name="test8"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc8" name="testdesc8" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test9">Repetici&oacute; infecciones orales</label>
									<select id="test9" name="test9"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc9" name="testdesc9" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test10">Mal aliento</label>
									<select id="test10" name="test10"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc10" name="testdesc10" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test11">Fuegos</label>
									<select id="test11" name="test11"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc11" name="testdesc11" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test12">Lengua</label>
									<select id="test12" name="test12"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc12" name="testdesc12" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test13">Paladar</label>
									<select id="test13" name="test13"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc13" name="testdesc13" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test14">Carrillo</label>
									<select id="test14" name="test14"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc14" name="testdesc14" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test15">Piso de la boca</label>
									<select id="test15" name="test15"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc15" name="testdesc15" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test16">Encias</label>
									<select id="test16" name="test16"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc16" name="testdesc16" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test17">Oclusi&oacute;n</label>
									<select id="test17" name="test17"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc17" name="testdesc17" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test18">Manchas</label>
									<select id="test18" name="test18"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc18" name="testdesc18" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test19">Facetas de desgaste</label>
									<select id="test19" name="test19"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc19" name="testdesc19" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test20">Frenillos</label>
									<select id="test20" name="test20"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc20" name="testdesc20" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="test21">Movilidad</label>
									<select id="test21" name="test21"><option value="0">No</option><option value="1">Si</option></select>
									<input id="testdesc21" name="testdesc21" style="width:60%;" type="text" />
								</p>
								<p class="form">
									<label for="plaque">% placa bacteriana</label>
									<select id="plaque" name="plaque">
										<?php
										for($i = 0;$i <= 100;$i += 1){
											?>
											<option value="<?php echo $i;?>"><?php echo $i . '%';?></option>
											<?php
										}
										?>
									</select>
								</p>
								<h1>3. Motivo de la Consulta</h1>
								<hr />
								<p class="form">
									<label for="lastvisit">&Uacute;ltima visita al odont&oacute;logo</label>
									<input id="lastvisit" name="lastvisit" type="text" />
								</p>
								<p class="form">
									<label for="origin">Origen de la enfermedad</label>
									<select id="origin" name="origin">
										<option value="0">---</option>
										<option value="1">Enfermedad General</option>
										<option value="2">Accidente de Trabajo</option>
										<option value="3">Enfermedad Profesional</option>
									</select>
								</p>
								<p class="form">
									<label for="originhistory">Historia de la enfermedad</label>
									<textarea id="originhistory" name="originhistory" cols="200" rows="20"></textarea>
								</p>
								<p class="form">
									<label for="background">Antecedentes de importancia</label>
									<textarea id="background" name="background" cols="200" rows="20"></textarea>
								</p>
								<p class="form center">
									<img alt="loader" id="loader" src="images/loader.gif" style="display:none;" />
									<input type="button" value="Crear Historia Cl&iacute;nica" />
								</p>
							</form>
							<?php
						}
						else{
							?>
							<p class="center warning">El paciente ya tiene registrado sus antecedentes</p>
							<p class="center"><a href="consultbackground.php?id=<?php echo $patientdata['id'];?>">Ver Antecedentes</a></p>
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