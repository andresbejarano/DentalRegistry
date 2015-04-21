<?php
include('dbhandler.php');
include('functions.php');
$where = 'WHERE ';
$sw = false;

//Primer nombre
if($_POST['firstname'] != '0'){
	$where .= 'LOWER(LEFT(`firstname`,1)) = LOWER("' . $_POST['firstname'] . '")';
	$sw = true;
}

//Primer apellido
if($_POST['firstlastname'] != '0'){
	if($sw) $where .= ' AND ';
	$where .= 'LOWER(LEFT(`firstlastname`,1)) = LOWER("' . $_POST['firstlastname'] . '")';
	$sw = true;
}

//Segundo apellido
if($_POST['secondlastname'] != '0'){
	if($sw) $where .= ' AND ';
	$where .= 'LOWER(LEFT(`secondlastname`,1)) = LOWER("' . $_POST['secondlastname'] . '")';
	$sw = true;
}

//Sexo
if($_POST['sex'] != '0'){
	if($sw) $where .= ' AND ';
	$where .= '`sex` = ' . $_POST['sex'] . '';
	$sw = true;
}

//Tipo de documento
if($_POST['documenttype'] != '0'){
	if($sw) $where .= ' AND ';
	$where .= '`documenttype` = ' . $_POST['documenttype'] . '';
	$sw = true;
}

if(!$sw) $where = '';
$handler = new DBHandler();
$total = $handler->getConditionedUserCount($where);
$body = '';
	if($total > 0){
		?>
		<h1>Lista de Usuarios</h1>
		<hr />
		<table class="tablesorter" style="margin-left:auto;margin-right:auto;width:85%;">
			<thead>
				<tr><th>Primer Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Sexo</th><th>Tipo de Documento</th><th>N&uacute;mero de Documento</th><th>Ver</th></tr>
			</thead>
			<tbody>
				<?php
				$result = $handler->getConditionedUserList($where);
				for($i = 0;$i < $total;$i += 1){
					?>
					<tr>
						<td><?php echo $result[$i][1];?></td>
						<td><?php echo $result[$i][2];?></td>
						<td><?php echo $result[$i][3];?></td>
						<td><?php echo getSex($result[$i][4]);?></td>
						<td><?php echo getDocumenttype($result[$i][5]);?></td>
						<td><?php echo $result[$i][6];?></td>
						<td><a href="user.php?id=<?php echo $result[$i][0];?>">Ver Usuario</a></td>
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
		<p class="message">No hay resultados con los par&aacute;metros indicados</p>
		<?php
	}
echo $body;
?>