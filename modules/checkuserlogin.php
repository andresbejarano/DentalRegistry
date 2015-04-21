<?php
include('dbhandler.php');
$Handler = new DBHandler();
$state = -1;
if(isset($_POST['username']) && isset($_POST['password'])){
   $state = $Handler->checkUserLogin(trim($_POST['username']),trim($_POST['password']));
}
echo $state; 
?>