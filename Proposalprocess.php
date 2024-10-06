<?php
session_start();

$con = mysqli_connect('localhost', 'root', "");

mysqli_select_db($con, 'dsams');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Proposal Notification</title>
</head>
<body>
    <?php
if(isset($_POST["proposalSubmit"])){

    $userID = $_POST["userID"];
    $eventID = $_POST["EventID"];
    $eventName = $_POST["eventName"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $clubID = $_POST["clubID"];

    if (isset($_FILES['proposalfile']['name'])){
        $file_name = $_FILES['proposalfile']['name'];
        $file_tmp = $_FILES['proposalfile']['tmp_name'];

        move_uploaded_file($file_tmp, "./Proposals/".$file_name);

        $q =  "INSERT INTO event(EventID, eventName, startDate, endDate, clubID, PIC, EventStatus, proposalfile) VALUES('$eventID','$eventName', '$startDate', '$endDate', '$clubID', '$userID', 'Pending', '$file_name')";
        
        $result = mysqli_query($con, $q);
        }
        else
        {
           ?>
            <div class=
            "alert alert-danger alert-dismissible
            fade show text-center">
              <a class="close" data-dismiss="alert"
                 aria-label="close">×</a>
              <strong>Failed!</strong>
                  File must be uploaded in PDF format!
            </div>
          <?php
        }
    }
?> 
</body>
</html>
