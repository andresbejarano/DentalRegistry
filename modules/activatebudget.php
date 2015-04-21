<?php
include('dbhandler.php');
include('functions.php');
$update = 'UPDATE `dental`.`budget` SET `active` = TRUE WHERE `id` = ' . $_POST['id'] . '';
$handler = new DBHandler();
$success = $handler->executeQuery($update);
$def = true;
if($success){
	$budgetinfocount = $handler->getBudgetInfoCount($_POST['id']);
	if($budgetinfocount > 0){
		$budgetinfolist = $handler->getBudgetInfoList($_POST['id']);
		for($i = 0;$i < $budgetinfocount;$i += 1){
			$subprocedurecount = $handler->getSubprocedureCount($budgetinfolist[$i][2]);
			if($subprocedurecount > 0){
				$subprocedurelist = $handler->getSubprocedureList($budgetinfolist[$i][2]);
				for($j = 0;$j < $subprocedurecount;$j += 1){
					$insert = 'INSERT INTO `dental`.`budgetevolve`(';
					$values = 'VALUES(';
					
					//budget
					$insert .= '`budget`';
					$values .= '' . $budgetinfolist[$i][1] . '';
					
					//budgetinfo
					$insert .= ',`budgetinfo`';
					$values .= ',' . $budgetinfolist[$i][0] . '';
					
					//procedure
					$insert .= ',`procedure`';
					$values .= ',' . $budgetinfolist[$i][2] . '';
					
					//subprocedure
					$insert .= ',`subprocedure`';
					$values .= ',' . $subprocedurelist[$j][0] . '';
					
					//location
					$insert .= ',`location`';
					$values .= ',' . $budgetinfolist[$i][3] . '';
					
					$query = $insert . ') ' . $values . ')';
					$success = $handler->executeQuery($query);
					if(!$success) $def = false;
				}
			}
		}
		echo $def;
	}
}
else{
	echo $success;
}
?>