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
		<title>Dental: Consultar Antecedentes</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="styles/reset.css" />
		<link rel="stylesheet" type="text/css" href="styles/default.css" />
		<link rel="stylesheet" type="text/css" href="cupertino/jquery-ui-1.8.10.custom.css" />
		<script type="text/javascript" src="javascript/jquery-1.5.min.js"></script>
		<script type="text/javascript" src="cupertino/jquery-ui-1.8.10.custom.min.js"></script>
		<script type="text/javascript" src="javascript/consultbackground.js"></script>
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
					<legend><a href="medicalrecord.php?id=<?php echo $patientdata['id'];?>">Historia Cl&iacute;nica</a> &rarr; Antecedentes: <a href="patient.php?id=<?php echo $patientdata['id'];?>"><?php echo $patientdata['firstname'] . ' ' . $patientdata['firstlastname'] . ' ' . $patientdata['secondlastname'];?></a></legend>
					<?php
					if($patientdata['active'] == 1){
						?>
						<form action="#" id="medicalrecord" method="post">
							<h1>Informaci&oacute;n Inicial</h1>
							<hr />
							<p class="form">
								<label for="id">Id Antecedentes</label>
								<input id="id" name="id" style="width:10%;" type="text" />
							</p>
							<p class="form">
								<label for="patient">Id Paciente</label>
								<input id="patient" name="patient" style="width:10%;" type="text" value="<?php echo $patientdata['id'];?>" />
							</p>
							<p class="form">
								<label for="user">Id Usuario</label>
								<input id="user" name="user"  style="width:10%;" type="text" />
							</p>
							<p class="form">
								<label for="username">Nombre Usuario</label>
								<input id="username" name="username" type="text" />
							</p><p class="form">
								<label for="date">Fecha</label>
								<input id="date" name="date" style="width:10%;" type="text" />
								<span style="font-style:italic;">mm/dd/aaaa</span>
							</p>
							<h1>1. Antecedentes Familiares</h1>
							<hr />
							<p class="form">
								<label for="familiar1">Afecciones cardiacas</label>
								<select id="familiar1" name="familiar1"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="familiar2">Diabetes mellitus</label>
								<select id="familiar2" name="familiar2"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="familiar3">Hipertensi&oacute;n</label>
								<select id="familiar3" name="familiar3"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="familiar4">Epilepsia</label>
								<select id="familiar4" name="familiar4"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="familiar5">C&aacute;ncer</label>
								<select id="familiar5" name="familiar5"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="familiar6">Tuberculosis</label>
								<select id="familiar6" name="familiar6"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="familiardescription">Otros / Descripci&oacute;n</label>
								<textarea id="familiardescription" name="familiardescription" cols="200" rows="20"></textarea>
							</p>
							<h1>2. Antecedentes Patol&oacute;gicos</h1>
							<hr />
							<p class="form">
								<label for="pathological1">VIH</label>
								<select id="pathological1" name="pathological1"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="pathological2">Hepatitis</label>
								<select id="pathological2" name="pathological2"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="pathological3">Fiebre reum&aacute;tica</label>
								<select id="pathological3" name="pathological3"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="pathological4">Diabetes</label>
								<select id="pathological4" name="pathological4"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="pathological5">Ulcera g&aacute;strica</label>
								<select id="pathological5" name="pathological5"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="pathological6">Hernia hiatal</label>
								<select id="pathological6" name="pathological6"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="pathological7">Epilepsia</label>
								<select id="pathological7" name="pathological7"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="pathological8">Tensi&oacute;n arterial alta</label>
								<select id="pathological8" name="pathological8"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="pathological9">Convulsiones</label>
								<select id="pathological9" name="pathological9"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="pathological10">Mareos frecuentes</label>
								<select id="pathological10" name="pathological10"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="pathological11">Fracturas/accidentes</label>
								<select id="pathological11" name="pathological11"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="pathological12">Cicatriza normalmente</label>
								<select id="pathological12" name="pathological12"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="pathological13">Ha tenido infarto del miocardio</label>
								<select id="pathological13" name="pathological13"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="pathological14">Ha tenido reemplazo de v&aacute;lvulas</label>
								<select id="pathological14" name="pathological14"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="pathological15">Ha perdido el conocimiento</label>
								<select id="pathological15" name="pathological15"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="pathological16">Ha perdido peso &uacute;ltimamente</label>
								<select id="pathological16" name="pathological16"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="allergies">&iquest;Alergias a qu&eacute;?</label>
								<textarea id="allergies" name="allergies" cols="200" rows="20"></textarea>
							</p>
							<p class="form">
								<label for="pathologicaldescription">Otros / Descripci&oacute;n</label>
								<textarea id="pathologicaldescription" name="pathologicaldescription" cols="200" rows="20"></textarea>
							</p>
							<h1>3. Antecedentes Toxicol&oacute;gicos</h1>
							<hr />
							<p class="form">
								<label for="toxicological1">Fuma</label>
								<select id="toxicological1" name="toxicological1"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="toxicological2">Ingiere bebidas alcoh&oacute;licas</label>
								<select id="toxicological2" name="toxicological2"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="toxicological3">Usa drogas</label>
								<select id="toxicological3" name="toxicological3"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="toxicological4">Al&eacute;rgico a la anestesia</label>
								<select id="toxicological4" name="toxicological4"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="toxicological5">Toma medicamentos</label>
								<select id="toxicological5" name="toxicological5"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="currentmedication">&iquest;Cu&aacute;les?</label>
								<textarea id="currentmedication" name="currentmedication" cols="200" rows="20" ></textarea>
							</p>
							<p class="form">
								<label for="toxicological6">Es al&eacute;rgico a alg&uacute;n medicamento</label>
								<select id="toxicological6" name="toxicological6"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="allergicmedication">&iquest;Cu&aacute;les?</label>
								<textarea id="allergicmedication" name="allergicmedication" cols="200" rows="20"></textarea>
							</p>
							<p class="form">
								<label for="toxicologicaldescription">Otros / Descripci&oacute;n</label>
								<textarea id="toxicologicaldescription" name="toxicologicaldescription" cols="200" rows="20"></textarea>
							</p>
							<h1>4. Antecedentes Ginecobst&eacute;tricos</h1>
							<hr />
							<p class="form">
								<label for="gynecoobstetrical1">Toma anticonceptivos</label>
								<select id="gynecoobstetrical1" name="gynecoobstetrical1"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="gynecoobstetrical2">Est&aacute; embarazada</label>
								<select id="gynecoobstetrical2" name="gynecoobstetrical2"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="months">&iquest;Cuantos meses?</label>
								<select id="months" name="months">
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">Mas</option>
								</select>
							</p>
							<p class="form">
								<label for="gynecoobstetrical3">Reemplazo de cadera</label>
								<select id="gynecoobstetrical3" name="gynecoobstetrical3"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="gynecoobstetrical4">Fractura de f&eacute;mur</label>
								<select id="gynecoobstetrical4" name="gynecoobstetrical4"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="gynecoobstetricaldescription">Otros / Descripci&oacute;n</label>
								<textarea id="gynecoobstetricaldescription" name="gynecoobstetricaldescription" cols="200" rows="20"></textarea>
							</p>
							<h1>5. Antecedentes Hospitalarios</h1>
							<hr />
							<p class="form">
								<label for="hospital1">Ha recibido transfusiones</label>
								<select id="hospital1" name="hospital1"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="hospital2">Ha sido hospitalizado</label>
								<select id="hospital2" name="hospital2"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="hospitaldescription">Otros / Descripci&oacute;n</label>
								<textarea id="hospitaldescription" name="hospitaldescription" cols="200" rows="20"></textarea>
							</p>
							<h1>6. Antecedentes Estomatol&oacute;gicos</h1>
							<hr />
							<p class="form">
								<label for="stomatological1">Luxaci&oacute;n de mand&iacute;bula</label>
								<select id="stomatological1" name="stomatological1"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="stomatological2">Fractura de mand&iacute;bula</label>
								<select id="stomatological2" name="stomatological2"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="stomatological3">Amigdalitis</label>
								<select id="stomatological3" name="stomatological3"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="stomatological4">Repetici&oacute;n infecciones orales</label>
								<select id="stomatological4" name="stomatological4"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="stomatological5">Mal aliento</label>
								<select id="stomatological5" name="stomatological5"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="stomatological6">Fuegos</label>
								<select id="stomatological6" name="stomatological6"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="stomatologicaldescription">Otros / Descripci&oacute;n</label>
								<textarea id="stomatologicaldescription" name="stomatologicaldescription" cols="200" rows="20"></textarea>
							</p>
							<h1>7. Antecedentes Odontol&oacute;gicos</h1>
							<hr />
							<p class="form">
								<label for="odontological1">Bruxismo</label>
								<select id="odontological1" name="odontological1"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="odontological2">Onicofagia</label>
								<select id="odontological2" name="odontological2"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="odontological3">Mordedura labio (sup / inf)</label>
								<select id="odontological3" name="odontological3"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="odontological4">Succi&oacute;n digital</label>
								<select id="odontological4" name="odontological4"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="odontological5">Biber&oacute;n</label>
								<select id="odontological5" name="odontological5"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="odontological6">Degluci&oacute;n at&iacute;pica</label>
								<select id="odontological6" name="odontological6"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="odontological7">Respirador bucal</label>
								<select id="odontological7" name="odontological7"><option value="0">No</option><option value="1">Si</option></select>
							</p>
							<p class="form">
								<label for="odontologicaldescription">Otros / Descripci&oacute;n</label>
								<textarea id="odontologicaldescription" name="odontologicaldescription" cols="200" rows="20"></textarea>
							</p>
							<h1>8. Motivo de la Consulta</h1>
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