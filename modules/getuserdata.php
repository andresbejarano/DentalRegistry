<?php
include('dbhandler.php');
include('functions.php');
$data = null;
$array = null;
if(isset($_POST['documenttype']) && isset($_POST['documentnumber'])){
	$handler = new DBHandler();
	$data = $handler->getUserData($_POST['documenttype'],$_POST['documentnumber']);
}
if($data != null){
	if($data['specialty'] == null)
		$data['specialty'] = 0;
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
		'dentist'			=> $data['dentist'],
		'specialty'		=> $data['specialty'],
		'username'		=> $data['username'],
		'privileges'		=> getPrivilegesCode($data['privileges'])
	);
}
echo json_encode($array);
?>