<?php
include('dbhandler.php');
include('functions.php');
$data = null;
$array = null;
if(isset($_POST['documenttype']) && isset($_POST['documentnumber'])){
	$documentnumber = trim($_POST['documentnumber']);
	if($documentnumber == null){
		$documentnumber = -1;
	}
	$handler = new DBHandler();
	$data = $handler->getPatientData($_POST['documenttype'],$documentnumber);
}
if($data != null){
	$array = array(
		'id'				=> $data['id'],
		'firstname'		=> $data['firstname'],
		'middlename'		=> $data['middlename'],
		'firstlastname'	=> $data['firstlastname'],
		'secondlastname'	=> $data['secondlastname'],
		'sex'				=> getSexCode($data['sex']),
		'documenttype'	=> getDocumentTypeCode($data['documenttype']),
		'documentnumber'	=> $data['documentnumber'],
		'birthdate'		=> toFormDate($data['birthdate']),
		'bloodtype'		=> getBloodtypeCode($data['bloodtype']),
		'address'			=> $data['address'],
		'phonehome'		=> $data['phonehome'],
		'phoneoffice'		=> $data['phoneoffice'],
		'cellnumber'		=> $data['cellnumber'],
		'email'			=> $data['email'],
		'maritalstatus'	=> getMaritalstatusCode($data['maritalstatus']),
		'occupation'		=> $data['occupation']
	);
}
echo json_encode($array);
?>