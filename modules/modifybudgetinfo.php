<?php
include('dbhandler.php');
$handler = new DBHandler();
$success = true;

$update = 'UPDATE `dental`.`budget` SET ';
$update .= '`discount` = ' . trim($_POST['discount']) . '';
$description = trim($_POST['description']);
if(strlen($description) > 0){
    $update .= ',`description` = "' . $description . '"';
}
else{
	$update .= ',`description` = NULL';
}
$update .= ' WHERE `id` = ' . $_POST['id'] . '';
$success = $handler->executeQuery($update);
if(!$success) echo $update;

$oldinfocount = $handler->getBudgetInfoCount($_POST['id']);
$oldinfolist = $handler->getBudgetInfoList($_POST['id']);
$newinfocount = 0;
$newinfolist = null;

//Para cada uno de los 20 procedimientos disponibles en el formulario
for($i = 1;$i <= 20;$i += 1){
    $procedure = 'procedure' . $i;
    $location = 'location' . $i;
    if($_POST[$procedure] > 0 && $_POST[$location] > 0){
        $newinfolist[$newinfocount][0] = $_POST[$procedure];
        $newinfolist[$newinfocount][1] = $_POST[$location];
        $newinfocount += 1;
    }
}

$index = 0;

//Se reemplaza cada procedimiento anterior con uno nuevo, hasta que se llegue al numero de
while($index < $oldinfocount && $index < $newinfocount){
    $update = 'UPDATE `dental`.`budgetinfo` SET ';
    $update .= '`procedure` = ' . $newinfolist[$index][0] . '';
    $update .= ',`location` = ' . $newinfolist[$index][1] . '';
    $update .= ' WHERE `id` = ' . $oldinfolist[$index][0] . ';';
    $success = $handler->executeQuery($update);
    if(!$success){
        echo $update;
    }
    $index += 1;
}

if($index < $oldinfocount){
    while($index < $oldinfocount){
        $delete = 'DELETE FROM `dental`.`budgetinfo` WHERE `id` = ' . $oldinfolist[$index][0] . '';
        $success = $handler->executeQuery($delete);
        if(!$success){
            echo $delete;
        }
        $index += 1;
    }
}
else{
    if($index < $newinfocount){
        while($index < $newinfocount){
            $insert = 'INSERT INTO `dental`.`budgetinfo`(`budget`,`procedure`,`location`)';
            $insert .= ' VALUES(' . $_POST['id'] . ',' . $newinfolist[$index][0] . ',' . $newinfolist[$index][1] . ')';
            $success = $handler->executeQuery($insert);
            if(!$success){
                echo $$insert;
            }
            $index += 1;
        }
    }
}

echo $success;
?>