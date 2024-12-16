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
        echo $arr[1];
        echo '<br>';
        echo $arr[2];
        echo '<br>';
        echo $arr[3];
        echo '<br>';
        echo $arr[4];
        echo '<br>';
        echo $arr[5];
        echo '<br>';
        echo '<br>';
      }