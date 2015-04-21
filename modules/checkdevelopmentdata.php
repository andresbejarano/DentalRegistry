<?php
$success = true;
if(strlen(trim($_POST['description'])) > 2000){
	if($success) $success = false;
	echo '<p>- La descripci&oacute;n ingresada no debe superar las 2000 letras</p>';
}
if($success) echo $success;
?>