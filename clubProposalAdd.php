<?php
include_once 'database.php';
session_start();

$studentId= $_SESSION['loggedIn'];
$title = $_POST['clubName'];
$description = $_POST['description'];
$reasoning = $_POST['reasoning'];
$personInCharge = $_POST['personInCharge'];

$proposalId = "P". substr($studentId, 4) . getdate()["mday"] . getdate()["seconds"];
date_default_timezone_set("Asia/Singapore");
$date= date("Y-m-d H:i:s");
$sql = "INSERT INTO proposal (proposalId, title, description, reasoning, submitDate, studentId, personInCharge) 
VALUES ('$proposalId', '$title', '$description', '$reasoning', '$date', '$studentId', '$personInCharge');";
if ($connection->query($sql) === TRUE) {
    echo "Added successfuly";
    
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}

header("Location:index.php");

?>