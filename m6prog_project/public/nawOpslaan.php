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
$q = "INSERT INTO naw (naam,email,straat,huisnummer,postcode) VALUES (?,?,?,?,?); ";
$stmt = $conn->prepare($q);
$stmt ->bind_param("sssss",$name, $email, $straat, $huisnummer, $postcode);
$result = $stmt->execute();
$respond = ["succeeded" => $result];
echo json_encode( $respond);
