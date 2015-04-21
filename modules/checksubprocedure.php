<?php
include('dbhandler.php');
$handler = new DBHandler();
$state = 0;
if(isset($_POST['id'])){
   $state = $handler->existSubprocedure($_POST['id']);
}
echo $state;
?>