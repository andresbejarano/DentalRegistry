<?php
include('dbhandler.php');
include('functions.php');
$data = null;
$array = null;
if(isset($_POST['id'])){
	$handler = new DBHandler();
	$data = $handler->getOdontogramData($_POST['id']);
	$userdata = $handler->getUserDataById($data['user']);
}
if($data != null){
	$array = array(
		'id' => $data['id'],
		'patient' => $data['patient'],
		'user' => $data['user'],
		'username' => $userdata['firstname'] . ' ' . $userdata['firstlastname'] . ' ' . $userdata['secondlastname'],
		'date' => toFormDate($data['date']),
		
		'd18' => $data['d18'],
		'd17' => $data['d17'],
		'd16' => $data['d16'],
		'd15' => $data['d15'],
		'd14' => $data['d14'],
		'd13' => $data['d13'],
		'd12' => $data['d12'],
		'd11' => $data['d11'],
		
		'd21' => $data['d21'],
		'd22' => $data['d22'],
		'd23' => $data['d23'],
		'd24' => $data['d24'],
		'd25' => $data['d25'],
		'd26' => $data['d26'],
		'd27' => $data['d27'],
		'd28' => $data['d28'],
		
		'd55' => $data['d55'],
		'd54' => $data['d54'],
		'd53' => $data['d53'],
		'd52' => $data['d52'],
		'd51' => $data['d51'],
		
		'd61' => $data['d61'],
		'd62' => $data['d62'],
		'd63' => $data['d63'],
		'd64' => $data['d64'],
		'd65' => $data['d65'],
		
		'd85' => $data['d85'],
		'd84' => $data['d84'],
		'd83' => $data['d83'],
		'd82' => $data['d82'],
		'd81' => $data['d81'],
		
		'd71' => $data['d71'],
		'd72' => $data['d72'],
		'd73' => $data['d73'],
		'd74' => $data['d74'],
		'd75' => $data['d75'],
		
		'd48' => $data['d48'],
		'd47' => $data['d47'],
		'd46' => $data['d46'],
		'd45' => $data['d45'],
		'd44' => $data['d44'],
		'd43' => $data['d43'],
		'd42' => $data['d42'],
		'd41' => $data['d41'],
		
		'd31' => $data['d31'],
		'd32' => $data['d32'],
		'd33' => $data['d33'],
		'd34' => $data['d34'],
		'd35' => $data['d35'],
		'd36' => $data['d36'],
		'd37' => $data['d37'],
		'd38' => $data['d38'],
		
		'description' => $data['description']
	);
}
echo json_encode($array);
?>