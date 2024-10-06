<?php
    include "../database.php";
    session_start();

    $studentId = $_SESSION['loggedIn'];
    $date= date("Y-m-d");
    $clubId= uniqid("C");
    $title = $_POST['title'];
    $description = $_POST['description'];
    $file_name = $_FILES['posterImg']['name'];
    $file_tmp = $_FILES['posterImg']['tmp_name'];
    $proposalId = $_POST['hiddenId'];
    $new_file_name = $clubId.'Icon.'.pathinfo($file_name)['extension'];

    move_uploaded_file($file_tmp, "../Images/Clubs/".$file_name);
    rename("../Images/Clubs/".$file_name, "../Images/Clubs/".$new_file_name);
    
    $sql = "INSERT INTO club (clubId, clubName, description, clubIcon) 
    VALUES ('$clubId', '$title', '$description', '$new_file_name');";
    if ($connection->query($sql) === TRUE) {
        echo "Added successfuly";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
        exit();
    }

    $sql = "UPDATE proposal SET status = 'Published', clubId = '$clubId'
    WHERE proposalId = '$proposalId'";
    if ($connection->query($sql) === TRUE) {
        echo "Added successfuly";
        
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }

    $sql = "INSERT INTO clubroles (clubId, studentId, position, joinDate) 
    VALUES ('$clubId', '$studentId', 'President', '$date');";
    if ($connection->query($sql) === TRUE) {
        echo "Added successfuly";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
    include_once '../updateRoles.php';
    header("Location:../dashboard/proposals.php");
?>