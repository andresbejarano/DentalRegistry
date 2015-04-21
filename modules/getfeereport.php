<?php
include('dbhandler.php');
include('functions.php');
$date = splitDate($_POST['dateinit']);
$init = '"' . $date[2] . '-' . $date[0] . '-' . $date[1] . '"';
$date = splitDate($_POST['dateend']);
$end = '"' . $date[2] . '-' . $date[0] . '-' . $date[1] . '"';
$user = $_POST['user'];
$handler = new DBHandler();
$count = 0;
$list = null;
if($_POST['user'] == 0){
	$count = $handler->getFeeReportCount($init,$end);
	if($count > 0){
		$list = $handler->getFeeReportList($init,$end);
	}
}
else{
	$count = $handler->getFeeReportCountByDentist($init,$end,$user);
	if($count > 0){
		$list = $handler->getFeeReportListByDentist($init,$end,$user);
	}
}
if($count > 0){
	$total = 0;
	$feetotal = 0;
	?>
	<table class="tablesorter">
		<thead><tr><th>Fecha</th><th>Usuario</th><th>Paciente</th><th>Subprocedimiento</th><th>Valor Proc</th><th>Honorario</th></tr></thead>
		<tbody>
			<?php
			for($i = 0;$i < $count;$i += 1){
				$budgetdata = $handler->getBudgetDataById($list[$i][1]);
				$subprocedure = $handler->getSubprocedureData($list[$i][4]);
				$userdata = $handler->getUserDataById($list[$i][6]);
				$specialtydata = $handler->getSpecialtyData($userdata[17]);
				$total += $subprocedure[3];
				$fee = $subprocedure[3] * $specialtydata[2];
				$feetotal += $fee;
				?>
				<tr>
					<td><?php echo toFormDate($list[$i][7]);?></td>
					<td><a href="user.php?id=<?php echo $list[$i][6];?>"><?php echo $handler->getUserName($list[$i][6]);?></a></td>
					<td><a href="patient.php?id=<?php echo $budgetdata['patient'];?>"><?php echo $handler->getPatientName($budgetdata['patient']);?></a></td>
					<td><?php echo $handler->getSubprocedureName($list[$i][4]);?></td>
					<td>$<?php echo number_format($subprocedure[3]);?></td>
					<td>$<?php echo number_format($fee);?></td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
	<p>Valor total de los subprpcedimientos: $<?php echo number_format($total);?></p>
	<p>Valor total honorarios: $<?php echo number_format($feetotal);?></p>
	<?php
}
else{
	?>
	<p class="center message">No hay subprocedimientos registrados durante las fechas indicadas</p>
	<?php
}
?>