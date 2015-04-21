<?php
session_start();
include('dbhandler.php');
if(isset($_POST['username']) && isset($_POST['password'])){
	$handler = new DBHandler();
	$data = $handler->getUserLoginData(trim($_POST['username']),trim($_POST['password']));
	if($data != null){
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['id'] = $data['id'];
		$_SESSION['firstname'] = $data['firstname'];
		$_SESSION['middlename'] = $data['middlename'];
		$_SESSION['firstlastname'] = $data['firstlastname'];
		$_SESSION['secondlastname'] = $data['secondlastname'];
		$_SESSION['name'] = $data['firstname'] . ' ' . $data['firstlastname'] . ' ' . $data['secondlastname'];
		$_SESSION['sex'] = $data['sex'];
		$_SESSION['privileges'] = $data['privileges'];
	}
}
?>