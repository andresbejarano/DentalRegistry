<?php
include('dbhandler.php');
include('functions.php');
$Handler = new DBHandler();

$insert = 'INSERT INTO `dental`.`budget`(';
$values = 'VALUES(';

//Codigo
$code = trim($_POST['code']);
$insert .= '`code`';
$values .= '"' . $code . '"';

//Paciente
$insert .= ',`patient`';
$values .= ',' . $_POST['patient'] . '';

//Usuario
$insert .= ',`user`';
$values .= ',' . $_POST['user'] . '';

//Fecha
$date = splitDate(trim($_POST['date']));
$insert .= ',`date`';
$values .= ',' . '"' . $date[2] . '-' . $date[0] . '-' . $date[1] . '"';

//Descuento
$discount = trim($_POST['discount']);
$insert .= ',`discount`';
$values .= ',' . $discount . '';

//Descripcion
$description = trim($_POST['description']);
if(strlen($description) > 0){
   $insert .= ',`description`';
   $values .= ',"' . $description . '"';
}

$query = $insert . ') ' . $values . ')';
$success = $Handler->executeQuery($query);

if($success){
   $budget = $Handler->getBudgetDataByCode($code);
   
   //Para cada uno de los 20 procedimientos disponibles
   for($i = 1;$i <= 20;$i += 1){
      $procedure = 'procedure' . $i;
      $location = 'location' . $i;
      if($_POST[$procedure] > 0 && $_POST[$location] > 0){
         
         $insert = 'INSERT INTO `dental`.`budgetinfo`(';
         $values = 'VALUES(';
         
         //Codigo del presupuesto
         $insert .= '`budget`';
         $values .= '' . $budget['id'] . '';
         
         //Codigo del presupuesto
         $insert .= ',`procedure`';
         $values .= ',' . $_POST[$procedure] . '';
         
         //Ubicacion
         $insert .= ',`location`';
         $values .= ',' . $_POST[$location] . '';
         
         $query = $insert . ') ' . $values . ')';
         $success = $Handler->executeQuery($query);
         if(!$success){
            echo $query;
         }
      }
   }
}
else{
   echo $query;
}

if($success){
   echo $success;
}
?>