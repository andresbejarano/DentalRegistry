<?php
session_start();
include('modules/dbhandler.php');
include('modules/functions.php');
if(isset($_SESSION['id'])){
	if($_SESSION['privileges'] == 'man' || $_SESSION['privileges'] == 'web'){
		if(isset($_GET['id'])){
			$handler = new DBHandler();
            $scheduledata = $handler->getScheduleData($_GET['id']);
            if($scheduledata != null){
                $userdata = $handler->getUserDataById($scheduledata['dentist']);
                $time = $handler->getTimeList();
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
		<title>Dental: Horario de Atenci&oacute;n</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
	    <?php include('includes/styles.php');?>
		<link rel="stylesheet" type="text/css" href="css/tablesorter.css" />
		<?php include('includes/jquery.php');?>
		
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
                <legend>Horario de Atenci&oacute;n: <a href="user.php?id=<?php echo $scheduledata['dentist'];?>"><?php echo $userdata['firstname'] . ' ' . $userdata['firstlastname'] . ' ' . $userdata['secondlastname'];?></a></legend>
                <form action="#">
                    <p class="form">
                        <label for="id">Id Horario</label>
                        <input id="id" name="id" readonly="readonly" style="width:10%;" type="text" value="<?php echo $scheduledata['id'];?>" />
                    </p>
                    <p class="form">
                        <label for="dateinit">Fecha de Inicio</label>
                        <input id="dateinit" name="dateinit" readonly="readonly" style="width:10%;" type="text" value="<?php echo toFormDate($scheduledata['dateinit']);?>" />
                    </p>
					
						<?php
						for($i = 0;$i < 157;$i += 1){
							$table[$i][0] = $handler->getHour($i + 1);
							for($j = 1;$j <= 7;$j += 1){
								$table[$i][$j] = '-1';
							}
						}
						if($scheduledata['monday'] == '1'){
							for($i = $scheduledata['mondayinit'] - 1;$i < $scheduledata['mondayend'] - 1;$i += 1){
								$table[$i][1] = '1';
							}
						}
						if($scheduledata['tuesday'] == '1'){
							for($i = $scheduledata['tuesdayinit'] - 1;$i < $scheduledata['tuesdayend'] - 1;$i += 1){
								$table[$i][2] = '1';
							}
						}
						if($scheduledata['wednesday'] == '1'){
							for($i = $scheduledata['wednesdayinit'] - 1;$i < $scheduledata['wednesdayend'] - 1;$i += 1){
								$table[$i][3] = '1';
							}
						}
						if($scheduledata['thursday'] == '1'){
							for($i = $scheduledata['thursdayinit'] - 1;$i < $scheduledata['thursdayend'] - 1;$i += 1){
								$table[$i][4] = '1';
							}
						}
						if($scheduledata['friday'] == '1'){
							for($i = $scheduledata['fridayinit'] - 1;$i < $scheduledata['fridayend'] - 1;$i += 1){
								$table[$i][5] = '1';
							}
						}
						if($scheduledata['saturday'] == '1'){
							for($i = $scheduledata['saturdayinit'] - 1;$i < $scheduledata['saturdayend'] - 1;$i += 1){
								$table[$i][6] = '1';
							}
						}
						if($scheduledata['sunday'] == '1'){
							for($i = $scheduledata['sundayinit'] - 1;$i < $scheduledata['sundayend'] - 1;$i += 1){
								$table[$i][7] = '1';
							}
						}
						?>
						<div class="section">
						<table class="tablesorter">
							<thead>
								<tr>
									<th>Hora</th>
									<th>Lunes</th>
									<th>Martes</th>
									<th>Mi&eacute;rcoles</th>
									<th>Jueves</th>
									<th>Viernes</th>
									<th>S&aacute;bado</th>
									<th>Domingo</th>
								</tr>
							</thead>
							<tbody>
								<?php
								for($i = 0;$i < 156;$i += 1){
									?>
									<tr>
										<?php
										for($j = 0;$j <= 7;$j += 1){
											?>
											<td>
												<?php
												if($table[$i][$j] == '-1'){
													echo '---';
												}
												else{
													if($table[$i][$j] == '1'){
														echo 'Atiende';
													}
													else{
														echo $table[$i][$j];
													}
												}
												?>
											</td>
											<?php
										}
										?>
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
						</div>
					
                    <p class="form">
                        <label for="description">Descripci&oacute;n</label>
                        <textarea id="description" name="description" readonly="readonly" rows="120" cols="120"><?php echo $scheduledata['description'];?></textarea>
                    </p>
                </form>
            </fieldset>
        </div>
    </body>
</html>