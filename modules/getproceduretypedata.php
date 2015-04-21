<?php
include('dbhandler.php');
include('functions.php');
$Handler = new DBHandler();
$data = null;
$array = null;
if(isset($_POST['id'])){
   $data = $Handler->getProceduretypeData($_POST['id']);
}
if($data != null){
   $array = array(
      'id'			=> $data['id'],
      'name'		=> $data['name'],
      'description'	=> $data['description']
   );
}
echo json_encode($array);
?>