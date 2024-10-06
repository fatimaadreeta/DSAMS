<?php
    include "../database.php";

    if(isset($_POST['submit'])){
        $activityId = $_POST['activityId'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $old_file_name = $_POST['oldImg'];
        $file_name = $_FILES['posterImg']['name'];
        $file_tmp = $_FILES['posterImg']['tmp_name'];
        $startDate = $_POST['startDate'];
        $venue = $_POST['venue'];
        $time = $_POST['Time'];

        if($_FILES['posterImg']['size'] != 0){
            $new_file_name = $activityId.'.'.pathinfo($file_name)['extension'];
            if(!empty($old_file_name)){
                rename("../Images/".$old_file_name, "../Images/".$new_file_name);
            }
            move_uploaded_file($file_tmp, "../Images/".$new_file_name);
        }else{
            $new_file_name = $old_file_name;
        }

        $sql = "UPDATE activity 
                SET activityName = '$title', 
                description = '$description', 
                posterImg = '$new_file_name', 
                startDate = '$startDate', 
                venue ='$venue',
                Time = '$time'
                WHERE activityId = '$activityId'";
        if ($connection->query($sql) === TRUE) {
            echo "Updated successfuly";
            header("Location:events.php?id=".$activityId);
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
            exit();
        }

    }
    else{
        die(mysqli_error($connection));
    }
?>