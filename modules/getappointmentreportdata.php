<?php
include('dbhandler.php');
include('functions.php');
$array = splitDate(trim($_POST['date']));
$date = $array[2] . '-' . $array[0] . '-' . $array[1];
$handler = new DBHandler();
$count = 0;
$list = null;
if($_POST['dentist'] > 0){
	$count = $handler->getAppointmentCountByDateAndDentist($date,$_POST['dentist']);
	$list = $handler->getAppointmentListByDateAndDentist($date,$_POST['dentist']);
}
else{
	$count = $handler->getAppointmentCount($date);
	$list = $handler->getAppointmentList($date);
}
if($count > 0){
	?>
	<table class="tablesorter">
		<thead>
			<tr><th>Id Cita</th><th>Paciente</th><th>Dentista</th><th>Hora Inicio</th><th>Hora Fin</th><th>Tipo</th><th>Estado</th></tr>
		</thead>
		<tbody>
			<?php
			for($i = 0;$i < $count;$i += 1){
				?>
				<tr>
					<td><?php echo $list[$i][0];?></td>
					<td><a href="patient.php?id=<?php echo $list[$i][1];?>"><?php echo $handler->getPatientName($list[$i][1]);?></a></td>
					<td><a href="user.php?id=<?php echo $list[$i][2];?>"><?php echo $handler->getUserName($list[$i][2]);?></a></td>
					<td><?php echo $handler->getHour($list[$i][4]);?></td>
					<td><?php echo $handler->getHour($list[$i][5]);?></td>
					<td><?php echo getAppointmentType($list[$i][6]);?></td>
					<td><a href="stateappointment.php?id=<?php echo $list[$i][0];?>"><?php echo getAppointmentStatus($list[$i][9]);?></a></td>
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
		<p class="message">No hay citas registradas para este d&iacute;a</p>
	<?php
}