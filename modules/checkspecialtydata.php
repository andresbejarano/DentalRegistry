<?php
//include("dbhandler.php");
//$Handler = new DBHandler();
$success = true;

//El nombre es obligatorio
if(strlen(trim($_POST['name'])) < 1){
   if($success) $success = false;
   echo "<p>Debe ingresar el nombre</p>";
}

//El honorario es obligatorio y debe ser numerico
$fee = trim($_POST['fee']); 
if(strlen($fee) < 1){
   if($success) $success = false;
   echo "<p>Debe ingresar el valor del honorario</p>";
}
else{
   if(!is_numeric($fee)){
      if($success) $success = false;
      echo "<p>Valor del honorario inv&aacute;lido</p>";
   }
}

//La descripcion debe ser menor de 300 caracteres
if(strlen(trim($_POST['description'])) > 300){
   if($success) $success = false;
   echo "<p>La descripci&oacute;n debe ser menor de 300 caracteres</p>";
}

if($success) echo $success;
?>