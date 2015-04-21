<?php
include('dbhandler.php');
include('functions.php');

if($_POST['dentist'] != 0){
	$array = splitDate(trim($_POST['date']));
	$date = $array[2] . '-' . $array[0] . '-' . $array[1];
	$handler = new DBHandler();
	$schedule = $handler->getSchedule($_POST['dentist'],$date);
	if($schedule != null){
		$time = mktime(0,0,0,$array[0],$array[1],$array[2]);
		$day = strtolower(date('l',$time));
		if($schedule[$day] == true){
			$t_init = $schedule[$day . 'init'];
			$t_end = $schedule[$day . 'end'];
			$j = $t_init;
			for($i = 0;$i <= ($t_end - $t_init);$i += 1){
				$matrix[$i][0] = $j;
				$matrix[$i][1] = $handler->getHour($j);
				$matrix[$i][2] = 'Disponible';
				$j += 1;
			}
			$count = $handler->getAppointmentCountByDateAndDentist($date,$_POST['dentist']);
			if($count > 0){
				$list = $handler->getAppointmentListByDateAndDentist($date,$_POST['dentist']);
				for($i = 0;$i < $count;$i += 1){
					for($j = $list[$i][4] - 1;$j < $list[$i][5] - 1;$j += 1){
						if($list[$i][9] != 'can'){
							$matrix[$j][2] = '<a href="patient.php?id=' . $list[$i][1] . '">Cita: ' . $handler->getPatientName($list[$i][1]) . '</a>';
						}
					}
				}
			}
			?>
			<div style="height:400px;overflow:scroll;">
				<table class="tablesorter">
					<thead><tr><th>Hora</th><th>Disponibilidad</th></tr></thead>
					<tbody>
						<?php
						for($i = 0;$i < ($t_end - $t_init);$i += 1){
							?>
							<tr>
								<td><?php echo $matrix[$i][1];?></td>
								<td><?php echo $matrix[$i][2];?></td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
			<?php
		}
		else{
			?>
			<p>El dentista no atiende el d&iacute;a solicitado</p>
			<?php
		}
	}
	else{
		?>
		<p>El dentista no tiene horario programado para la fecha solicitada</p>
		<?php
	}
}
else{
	?>
	<p>Debe seleccionar el dentista con quien desea programar la cita</p>
	<?php
}
?>