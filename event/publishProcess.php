<?php
    include "../database.php";

    $activityId= uniqid("A");
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date= date("Y-m-d");
    $file_name = $_FILES['posterImg']['name'];
    $file_tmp = $_FILES['posterImg']['tmp_name'];
    $proposalId = $_POST['hiddenId'];
    $new_file_name = $activityId.'.'.pathinfo($file_name)['extension'];
    $startDate = $_POST['startDate'];
    $venue = $_POST['venue'];
    $time = $_POST['Time'];

    move_uploaded_file($file_tmp, "../Images/".$file_name);
    rename("../Images/".$file_name, "../Images/".$new_file_name);
    
    $sql = "INSERT INTO activity (activityId, activityName, description, posterImg, postDate, startDate, venue, Time) VALUES ('$activityId', '$title', '$description', '$new_file_name', '$date', '$startDate', '$venue','$time');";
    if ($connection->query($sql) === TRUE) {
        echo "Added successfuly";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
        exit();
    }

    $sql = "UPDATE proposal SET status = 'Published', activityId = '$activityId'
    WHERE proposalId = '$proposalId'";
    if ($connection->query($sql) === TRUE) {
        echo "Added successfuly";
        
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
    header("Location:../dashboard/proposals.php");
?>