<?php
require_once '../source/config.php';
require_once SOURCE_ROOT . 'database.php';

$searchInput = $_GET['searchPersoon'];
$conn = database_connect();
$searchResults = FindPersoon($conn,$searchInput);
$conn->close();

header('Content-Type: application/json; charset=utf-8');
echo json_encode ($searchResults);

function GetQueryResultsAssoc($result)
{
    $results=[];
    if($result)
    {
        for ($i=0; $i < $result->num_rows; $i++) 
        { 
            $row = $result->fetch_assoc();

            array_push($results,$row);
        }
    }
    return $results;
};

function FindPersoon($conn,$name)
{
    if($conn)
    {
        try
        {
            $q = "SELECT * FROM naw WHERE naam=(?)";
            $stmt = $conn->prepare($q);
            $stmt->bind_param('s',$name);
            $stmt->execute();
            $result = $stmt->get_result();

            $searchResults = GetQueryResultsAssoc($result);
            return $searchResults;
        }
        catch(ex)
        {
            echo "error during query" . ex;
        }
    }
    return [];
}