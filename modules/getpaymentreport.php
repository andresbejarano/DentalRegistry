<?php
include('dbhandler.php');
include('functions.php');
$date = splitDate($_POST['dateinit']);
$init = '"' . $date[2] . '-' . $date[0] . '-' . $date[1] . '"';
$date = splitDate($_POST['dateend']);
$end = '"' . $date[2] . '-' . $date[0] . '-' . $date[1] . '"';
$handler = new DBHandler();
$total = $handler->getPaymentReportCount($init,$end);
$sum = 0;
if($total > 0){
	$list = $handler->getPaymentReportList($init,$end);
	?>
	<table class="tablesorter">
		<thead><tr><th>Id</th><th>Paciente</th><th>Usuario</th><th>Fecha</th><th>Valor</th><th>Forma de pago</th><th>N&uacute;mero</th><th>Banco</th><th>Descripci&oacute;n</th></tr></thead>
		<tbody>
			<?php
			for($i = 0;$i < $total;$i += 1){
				$sum += $list[$i][4];
				?>
				<tr>
					<td><?php echo $list[$i][0];?></td>
					<td><a href="patient.php?id=<?php echo $list[$i][1];?>"><?php echo $handler->getPatientName($list[$i][1]);?></a></td>
					<td><a href="user.php?id=<?php echo $list[$i][2];?>"><?php echo $handler->getUserName($list[$i][2]);?></a></td>
					<td><?php echo toFormDate($list[$i][3]);?></td>
					<td>$<?php echo number_format($list[$i][4]);?></td>
					<td><?php echo $handler->getPaymenttypeName($list[$i][5]);?></td>
					<td><?php echo $list[$i][6];?></td>
					<td><?php echo $handler->getBankName($list[$i][7]);?></td>
					<td><?php echo $list[$i][8];?></td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
	<p>Total recaudos: $<?php echo number_format($sum);?></p>
	<?php
}
else{
	?>
	<p class="center message">No hay recaudos registrados durante las fechas indicadas</p>
	<?php
}
?>