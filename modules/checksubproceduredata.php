<?php
include('dbhandler.php');
$handler = new DBHandler();
$success = true;

//El codigo es obligatorio y no debe estar en la base de datos
$code = trim($_POST['code']);
if(strlen($code) < 1){
   if($success) $success = false;
   echo "<p>Debe ingresar el c&oacute;digo del subprocedimiento</p>";
}
else{
   $id = $handler->getSubprocedureId($code);
   if(isset($_POST['id'])){//Se esta modificando el procedimiento
      if($id != 0 && $id != $_POST['id']){
         $success = false;
         echo '<p>Ya se encuentra registrado el c&oacute;digo del subprocedimiento</p>';
      }
   }
   else{//Se esta agregando el procedimiento
      if($id != 0){
         if($success) $success = false;
         echo '<p>Ya se encuentra registrado el c&oacute;digo del subprocedimiento</p>';
      }
   }
}

//El nombre es obligatorio
if(strlen(trim($_POST['name'])) < 1){
   if($success) $success = false;
   echo "<p>Debe ingresar el nombre del subprocedimiento</p>";
}

//El precio es obligatorio y debe ser numerico
$price = trim($_POST['price']);
if(strlen($price) < 1){
   if($success) $success = false;
   echo "<p>Debe ingresar el precio del subprocedimiento</p>";
}
else{
   if(!is_numeric($price)){
      if($success) $success = false;
      echo "<p>El precio del subprocedimiento debe ser un valor num&eacute;rico</p>";
   }
}

//El tipo de procedimiento es obligatorio
if($_POST['procedure'] == 0){
   if($success) $success = false;
   echo "<p>Debe ingresar el procedimiento al cual va a ser vinculado</p>";
}

//La descripcion debe ser menor de 2000 caracteres
if(strlen(trim($_POST['description'])) > 2000){
   if($success) $success = false;
   echo '<p>La descripci&oacute;n debe ser menor de 2000 caracteres</p>';
}

if($success) echo $success;
?>