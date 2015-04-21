<?php
include('dbhandler.php');
include('functions.php');
$data = null;
$array = null;
if(isset($_POST['id'])){
	$handler = new DBHandler();
	$data = $handler->getLocationData($_POST['id']);
}
if($data != null){
	$array = array(
		'id' => $data['id'],
		'code' => $data['code'],
		'name' => $data['name'],
		'description' => $data['description']
	);
}
echo json_encode($array);
?>