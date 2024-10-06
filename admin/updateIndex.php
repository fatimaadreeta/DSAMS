<?php
    include_once '../database.php';
    session_start();
    //$username = $_SESSION[profile][username];
    $selected = implode("','", $_POST['frontPage']);

    $sql = "UPDATE activity SET frontPage = false
    WHERE activityId IS NOT NULL";

    if ($connection->query($sql) === TRUE) {
        echo "Reset successfuly";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
    
    $sql ="UPDATE activity SET frontPage = true
    WHERE activityId IN ('$selected')";

    if ($connection->query($sql) === TRUE) {
        echo "Updated successfuly";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
    header("Location:manageIndex.php")
?>