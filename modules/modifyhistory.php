<?php
include('dbhandler.php');
$update = 'UPDATE `dental`.`history` SET ';

//Antecedentes
$update .= '`history` = "'  . $_POST['history1'] . $_POST['history2'] . $_POST['history3'] 
							. $_POST['history4'] . $_POST['history5'] . $_POST['history6']
							. $_POST['history7'] . $_POST['history8'] . $_POST['history9']
							. $_POST['history10'] . $_POST['history11'] . $_POST['history12']
							. $_POST['history13'] . $_POST['history14'] . $_POST['history15']
							. $_POST['history16'] . $_POST['history17'] . $_POST['history18']
							. $_POST['history19'] . '"';
for($i = 1;$i <= 19;$i += 1){
	$update .= ',`historydesc' . $i . '` = "' . trim($_POST['historydesc' . $i]) . '"';
}

//Examenes
$update .= ',`test` = "' . $_POST['test1'] . $_POST['test2'] . $_POST['test3'] 
						. $_POST['test4'] . $_POST['test5'] . $_POST['test6']
						. $_POST['test7'] . $_POST['test8'] . $_POST['test9']
						. $_POST['test10'] . $_POST['test11'] . $_POST['test12']
						. $_POST['test13'] . $_POST['test14'] . $_POST['test15']
						. $_POST['test16'] . $_POST['test17'] . $_POST['test18']
						. $_POST['test19'] . $_POST['test20'] . $_POST['test21']
						. '"';
for($i = 1;$i <= 21;$i += 1){
	$update .= ',`testdesc' . $i . '` = "' . trim($_POST['testdesc' . $i]) . '"';
}

//Motivo de la consulta
$update .= ',`plaque` = ' . $_POST['plaque'] . '';
$update .= ',`lastvisit` = "' . trim($_POST['lastvisit']) . '"';
$update .= ',`origin` = ' . $_POST['origin'] . '';
$update .= ',`originhistory` = "' . trim($_POST['originhistory']) . '"';
$update .= ',`background` = "' . trim($_POST['background']) . '"';

$update .= ' WHERE id = ' . $_POST['id'];
$handler = new DBHandler();
$success = $handler->executeQuery($update);
if($success) echo $success;
else echo $update;
?>