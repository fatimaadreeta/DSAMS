<?php
include_once '../database.php';
session_start();

$comment = $_POST['comment'];
$hiddenId = $_POST['hiddenId'];
$status = $_POST['approval'];
$proposal = $_POST['proposal'];

$sql = "UPDATE proposal 
SET comment= '$comment', status = '$status'
WHERE proposalId= '$hiddenId';";
if ($connection->query($sql) === TRUE) {
    echo "Updated successfuly";
    
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}
if ($proposal == "event"){
    header("Location:eventProposals.php");
}
else if ($proposal == "club"){
    header("Location:clubProposals.php");
}else{
    header("Location:404.php");
}


?>