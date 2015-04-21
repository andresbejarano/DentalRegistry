<?php
include('dbhandler.php');
include('functions.php');
$handler = new DBHandler();
$data = null;
$array = null;
if(isset($_POST['id'])){
   $data = $handler->getSubprocedureData($_POST['id']);
}
if($data != null){
   $array = array(
      'id' => $data['id'],
      'code' => $data['code'],
      'name' => $data['name'],
      'price' => $data['price'],
      'active' => $data['active'],
      'procedure' => $data['procedure'],
      'description'	=> $data['description']
   );
}
echo json_encode($array);
?>