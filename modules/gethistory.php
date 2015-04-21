<?php
include('dbhandler.php');
include('functions.php');
$data = null;
$array = null;
if(isset($_POST['id'])){
	$handler = new DBHandler();
	$data = $handler->getHistory($_POST['id']);
	$userdata = $handler->getUserDataById($data['user']);
}
if($data != null){
	$array = array(
		'id' => $data['id'],
		'patient' => $data['patient'],
		'user' => $data['user'],
		'username' => $userdata['firstname'] . ' ' . $userdata['firstlastname'] . ' ' . $userdata['secondlastname'],
		'date' => toFormDate($data['date']),
		'history' => $data['history'],
		'historydesc1' => $data['historydesc1'],
		'historydesc2' => $data['historydesc2'],
		'historydesc3' => $data['historydesc3'],
		'historydesc4' => $data['historydesc4'],
		'historydesc5' => $data['historydesc5'],
		'historydesc6' => $data['historydesc6'],
		'historydesc7' => $data['historydesc7'],
		'historydesc8' => $data['historydesc8'],
		'historydesc9' => $data['historydesc9'],
		'historydesc10' => $data['historydesc10'],
		'historydesc11' => $data['historydesc11'],
		'historydesc12' => $data['historydesc12'],
		'historydesc13' => $data['historydesc13'],
		'historydesc14' => $data['historydesc14'],
		'historydesc15' => $data['historydesc15'],
		'historydesc16' => $data['historydesc16'],
		'historydesc17' => $data['historydesc17'],
		'historydesc18' => $data['historydesc18'],
		'historydesc19' => $data['historydesc19'],
		'test' => $data['test'],
		'testdesc1' => $data['testdesc1'],
		'testdesc2' => $data['testdesc2'],
		'testdesc3' => $data['testdesc3'],
		'testdesc4' => $data['testdesc4'],
		'testdesc5' => $data['testdesc5'],
		'testdesc6' => $data['testdesc6'],
		'testdesc7' => $data['testdesc7'],
		'testdesc8' => $data['testdesc8'],
		'testdesc9' => $data['testdesc9'],
		'testdesc10' => $data['testdesc10'],
		'testdesc11' => $data['testdesc11'],
		'testdesc12' => $data['testdesc12'],
		'testdesc13' => $data['testdesc13'],
		'testdesc14' => $data['testdesc14'],
		'testdesc15' => $data['testdesc15'],
		'testdesc16' => $data['testdesc16'],
		'testdesc17' => $data['testdesc17'],
		'testdesc18' => $data['testdesc18'],
		'testdesc19' => $data['testdesc19'],
		'testdesc20' => $data['testdesc20'],
		'testdesc21' => $data['testdesc21'],
		'plaque' => $data['plaque'],
		'lastvisit' => $data['lastvisit'],
		'origin' => $data['origin'],
		'originhistory' => $data['originhistory'],
		'background' => $data['background']
	);
}
echo json_encode($array);
?>