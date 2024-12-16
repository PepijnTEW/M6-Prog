<?php
require_once '../source/config.php';
require_once SOURCE_ROOT . 'database.php';
$connection = database_connect();
$sql = "SELECT * FROM weersomstandighedenPerDag WHERE plaats IN (?) ORDER BY datum"; 
$stmt = $connection->prepare($sql);
$plaats = $_GET;
$newPlaats = implode($plaats);
$stmt->bind_param('s', $newPlaats);
$stmt->execute();
$result = $stmt->get_result();
while(
    $row = mysqli_fetch_assoc($result)){
        $array[]= array($row["idWeersomstandighedenPerDag"], $row["datum"], $row["aantalGraden"], $row["windkracht"], $row["regenInMilimeters"], $row["plaats"]);
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