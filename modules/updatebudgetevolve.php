<?php
include('dbhandler.php');
include('functions.php');
$success = true;
$def = true;
$handler = new DBHandler();
$count = $handler->getBudgetEvolveCount($_POST['id']);
if($count > 0){
	for($i = 0;$i < $count;$i += 1){
		if(isset($_POST['done' . ($i + 1)]) && $_POST['done' . ($i + 1)] == 1){
			$query = 'UPDATE `dental`.`budgetevolve` SET ';
			$query .= '`done` = TRUE';
			$query .= ',`user` = ' . $_POST['user' . ($i + 1)] . '';
			$date = splitDate(trim($_POST['date' . ($i + 1)]));
			$query .= ',`date` = "' . $date[2] . '-' . $date[0] . '-' . $date[1] . '"';
			$query .= ',`description` = "' . trim($_POST['description' . ($i + 1)]) . '"';
			$query .= ' WHERE `id` = ' . $_POST['id' . ($i + 1)] . '';
			$success = $handler->executeQuery($query);
			if(!$success){
				$def = false;
				echo $query;
			}
		}
	}
	echo $def;
}
?>