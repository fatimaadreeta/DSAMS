<?php
session_start();

$con = mysqli_connect("localhost","root","","dsams");

if(isset($_POST["verID"])){
    $userID = $_POST["userID"];

    $q = "select * from clubrep where userID = '$userID'";
    $result = mysqli_query($con, $q);

    if(mysqli_num_rows($result)> 0){
        header("location: SubmitProposalPoster.php");
    }
    else{
        $q1 = "select * from student where StudentID = '$userID'";
        $r = mysqli_query($con, $q1);

        if(mysqli_num_rows($r)> 0){
            header("location: submitProposal.php");
        }
        else{
            echo "<script>alert('Cannot access form');</script>";
        }
    }
}

?>