<?php
include('dbhandler.php');
$Handler = new DBHandler();
$state = -1;
if(isset($_POST['id'])){
   $state = $Handler->checkUserById($_POST['id']);
}
echo $state;
?>