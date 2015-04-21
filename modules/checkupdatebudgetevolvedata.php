<?php
include('dbhandler.php');
include('functions.php');
$success = true;
$handler = new DBHandler();
$count = $handler->getBudgetEvolveCount($_POST['id']);
if($count > 0){
	for($i = 0;$i < $count;$i += 1){
		if(isset($_POST['done' . ($i + 1)]) && $_POST['done' . ($i + 1)] == 1){
			if($_POST['user' . ($i + 1)] == 0){
				if($success) $success = false;
				echo '<p>- Debe ingresar el dentista en el procedimiento ' . $_POST['id' . ($i + 1)] . '</p>';
			}
			if($_POST['date' . ($i + 1)] == ''){
				if($success) $success = false;
				echo '<p>- Debe ingresar la fecha de finalizaci&oacute;n en el procedimiento ' . $_POST['id' . ($i + 1)] . '</p>';
			}
			if(strlen(trim($_POST['description' . ($i + 1)])) > 2000){
				if($success) $success = false;
				echo '<p>- La longitud de la descripci&oacute;n en el procedimiento ' . $_POST['id' . ($i + 1)] . ' no debe superar las 2000 letras</p>';
			}
		}
	}
}
if($success) echo $success;
?>