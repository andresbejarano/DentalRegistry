<?php
include('dbhandler.php');
$state = 0;
if(isset($_POST['id'])){
	$handler = new DBHandler();
	$state = $handler->existLocation($_POST['id']);
}
echo $state;
?>