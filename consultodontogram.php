 <?php
session_start();
include('modules/dbhandler.php');
include('modules/functions.php');
if(isset($_SESSION['id'])){
	if($_SESSION['privileges'] == 'sec' || $_SESSION['privileges'] == 'aux' || $_SESSION['privileges'] == 'den' || $_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web'){
		if(isset($_GET['id'])){
			$handler = new DBHandler();
			$data = $handler->getOdontogramData($_GET['id']);
			$patientdata = $handler->getPatientDataById($data['patient']);
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
		<title>Dental: Consultar Odontograma</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
		<?php include('includes/styles.php');?>
		<?php include('includes/jquery.php');?>
		<script type="text/javascript" src="js/consultodontogram.js"></script>
		<script type="text/javascript">
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
				if($patientdata != null){
					?>
					<legend><a href="medicalrecord.php?id=<?php echo $patientdata['id'];?>">Historia Cl&iacute;nica</a> &rarr; Ver Odontograma: <a href="patient.php?id=<?php echo $patientdata['id'];?>"><?php echo $patientdata['firstname'] . ' ' . $patientdata['firstlastname'] . ' ' . $patientdata['secondlastname'];?></a></legend>
					<?php
					if($patientdata['active'] == 1){
						?>
						<h1>Informaci&oacute;n Inicial (Autom&aacute;tico)</h1>
						<hr />
						<form action="#" id="odontogram">
							<p class="form">
								<label for="id">Id Odontograma</label>
								<input id="id" name="id" readonly="readonly" style="width:10%;" type="text" value="<?php echo $data['id'];?>" />
							</p>
							<p class="form">
								<label for="patient">Id Paciente</label>
								<input id="patient" name="patient" readonly="readonly" style="width:10%;" type="text" value="<?php echo $patientdata['id'];?>" />
							</p>
							<p class="form">
								<label for="user">Id Usuario</label>
								<input id="user" name="user" readonly="readonly" style="width:10%;" type="text" value="<?php echo $data['user'];?>" />
							</p>
							<p class="form">
								<label for="username">Nombre Usuario</label>
								<input id="username" name="username" readonly="readonly" type="text" value="<?php echo $handler->getUserName($data['user']);?>" />
							</p>
							<p class="form">
								<label for="date">Fecha</label>
								<input id="date" name="date" style="width:10%;" readonly="readonly" type="text" value="<?php echo toFormDate($data['date']);?>" />
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
											<img id="d18k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d17k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d16k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d15k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d14k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d13k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d12k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d11k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d21k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d22k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d23k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d24k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d25k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d26k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d27k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d28k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d55k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d54k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d53k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d52k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d51k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d61k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d62k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d63k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d64k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d65k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d85k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d84k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d83k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d82k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d81k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d71k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d72k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d73k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d74k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d75k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d48k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d47k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d46k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d45k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d44k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d43k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d42k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d41k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d31k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d32k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d33k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d34k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d35k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d36k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d37k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
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
											<img id="d38k" alt="n" src="images/odontogram/bk.png" width="60" height="60" style="z-index:7;" />
										</div>
									</td>
								</tr>
							</table>
						</form>
						<form id="options" action="#">
							<p class="form">
								<label for="description">Descripci&oacute;n</label>
								<textarea id="description" name="description" readonly="readonly" rows="120" cols="120"><?php echo $data['description'];?></textarea>
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