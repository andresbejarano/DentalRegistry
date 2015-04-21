<?php
include('dbhandler.php');
include('functions.php');
$Handler = new DBHandler();
$data = null;
$array = null;
if(isset($_POST['id'])){
   $data = $Handler->getSpecialtyData($_POST['id']);
}
if($data != null){
   $array = array(
      'id'			=> $data['id'],
      'name'		=> $data['name'],
      'fee'			=> $data['fee'],
      'description'	=> $data['description']
   );
}
echo json_encode($array);
?>