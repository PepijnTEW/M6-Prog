<?php
require_once '../source/config.php';
require_once SOURCE_ROOT . 'database.php';
$connection = database_connect();
$sql = "SELECT * FROM WeersomstandighedenPerDag WHERE plaats IN (?,?) ORDER BY datum"; 
$stmt = $connection->prepare($sql);
$plaats = 'rotterdam';
$plaats2 = 'amsterdam';
$stmt->bind_param('ss', $plaats, $plaats2);
$stmt->execute();
$result = $stmt->get_result();
while(
    $Weersomstandigheden = mysqli_fetch_assoc($result)){
    var_dump( $Weersomstandigheden );
}