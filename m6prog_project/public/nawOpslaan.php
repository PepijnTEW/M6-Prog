<?php
require_once '../source/config.php';
require_once SOURCE_ROOT . 'database.php';

header('Content-Type: application/json; charset=utf-8');
$data = file_get_contents('php://input');
$json = json_decode($data);

$name = $json->name;
$email = $json->email;
$straat = $json->straat;
$huisnummer = $json->huisnummer;
$postcode = $json->postcode;

$conn = database_connect();

$searchQuery = "SELECT COUNT(1) as count FROM naw WHERE email=?";
$searchStmt = $conn->prepare($searchQuery);
$searchStmt->bind_param("s", $email);
$searchStmt->execute();
$searchResult = $searchStmt->get_result();
$count = $searchResult->fetch_assoc();

if ($count['count'] > 0) {
    echo json_encode([
        'success' => false,
        'count' => $count['count'],
        'error' => 'Dit email adres komt al voor in de database'
    ]);
    return false;
}

$q = "INSERT INTO naw (naam,email,straat,huisnummer,postcode) VALUES (?,?,?,?,?); ";
$stmt = $conn->prepare($q);
$stmt ->bind_param("sssss",$name, $email, $straat, $huisnummer, $postcode);
$result = $stmt->execute();
$insert_id = $stmt->insert_id;
$respond = ["succeeded" => $result];
echo json_encode( $respond);


