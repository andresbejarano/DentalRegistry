<?php
include('dbhandler.php');
$state = -1;
if(isset($_POST['documenttype']) && isset($_POST['documentnumber'])){
	$number = trim($_POST['documentnumber']);
	if($number == null){
		$number = -1;
	}
	$handler = new DBHandler();
	$state = $handler->checkPatient($_POST['documenttype'],$number);
}
echo $state;
?>