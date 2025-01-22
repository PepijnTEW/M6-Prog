<?php
require_once '../source/config.php';
require_once SOURCE_ROOT . 'database.php';
$connection = database_connect();
$sql = 'SELECT * FROM table_name WHERE Plaats LIKE ? ORDER BY Datum'; 
$stmt = $connection->prepare($sql);
$plaats =  '%' . $_GET['zoeken'] . '%';
$stmt->bind_param('s', $plaats);
$stmt->execute();
$result = $stmt->get_result();
while(
    $row = mysqli_fetch_assoc($result)){
        $array[]= array($row["id"], $row["Datum"], $row["aantalGraden"], $row["windKracht"], $row["regenInMilimeters"], $row["plaats"]);
    }
    foreach($array as $arr){
        ?>
        <b>Datum: </b><?echo $arr[1];?><br>
        <b>Graden: </b><?echo $arr[2];?><br>
        <b>WindKracht: </b><?echo $arr[3];?><br>
        <b>Aantal Regen In Millimeter: </b><?echo $arr[4];?><br>
        <b>Locatie: </b><?echo $arr[5];?><br><br>
        <?
      }