<?php
session_start();

$con = mysqli_connect('localhost', 'root', "", 'dsams');

$s = "select * from club";

$result = mysqli_query($con, $s);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="submitProposal.css">
    <title>Submit Proposal and Posters Page</title>
</head>
<body>
    <nav class="navbar"> 
        <a href="index.php"><img class="m-0 mx-2 p-0 logo" src="logo.png" alt="logo"></a>
        <a class="button mx-3" href="HomeClub.php">View Noticeboard</a>
    </nav>
    <div class="container">
         <div class="m-3 p-3">
            <h1>Proposal Form</h1>
            <div class="bg-light m-3 p-3">
                 <form method="POST" enctype="multipart/form-data" class="form">
        <input type="hidden" value="<?php echo uniqid("E-")?>" name="EventID">
        <label for="userID" name="userID">Student ID: </label>
        <input type="text" name="userID" class="form-control">
        <label for="eventName" name="eventName">Event Name: </label>
        <input type="text" name="eventName" class="form-control">
        <label for="startDate" name="startDate" >Start Date: </label>
        <input type="date" name="startDate" class="form-control">
        <label for="endDate" name="endDate">End Date:</label>
        <input type="date" name="endDate" class="form-control">
        <label for="clubID" name="clubID" >Select Club:</label>
        <select name="clubID" id="clubID" class="form-select" required>
            <option value="--Club Name will appear here--" selected>--Club Name will appear here--</option>
            <?php
            $i=0;
            while($row = mysqli_fetch_array($result)) {
            if($i%2==0)
            $classname="even";
            else
            $classname="odd";
        ?>
        <?php if(isset($classname)) echo $classname;?>
        <option value="<?php echo $row["clubID"]; ?>"><?php echo $row["ClubName"]; ?></option>
        <?php
            $i++;
            }
            ?> 
    </select>
        <label for="proposal" class="mt-2" name="proposal">Upload Proposal:</label>
        <input type="file" name="proposalfile" accept=".pdf" title="Upload pdf" class="form-control">
         <div class="input-group">
            <button type="submit" name="proposalSubmit" class="btn btn-primary my-2 rounded">Submit</button>
             <button type="reset" class="btn btn-primary my-2 mx-2 rounded">Reset</button>
        </div>
    </form>
            </div>
    </div>
    <?php
    ?>
     <?php
    // $q ="SELECT * FROM event JOIN club where event.clubID = club.clubID and event.EventStatus= 'Approved'";

    // $result1 = mysqli_query($con, $q);

    // $q1 = "select * from event where EventStatus = 'Approved'";

    // $res = mysqli_query($con, $q1);
    ?>
    <div class="m-3 p-3">
        <h1 class="bg-none">Poster Submit form</h1>
        <div class="bg-light m-3 p-3">
            <form class="bg-light" method="POST" enctype="multipart/form-data">
    <input type="hidden" value="<?php echo uniqid("P-")?>" name="posterID">
    <label for="clubID" name="clubID" >Select Club:</label>
        <select name="clubID" id="clubID" class="form-select" required>
            <option value="--Club Name will appear here--" selected>--Club Name will appear here--</option>
            <?php
            $i=0;
            while($row = mysqli_fetch_array($result1)) {
            if($i%2==0)
            $classname="even";
            else
            $classname="odd";
        ?>
        <?php if(isset($classname)) echo $classname;?>
        <option value="<?php echo $row["clubID"]; ?>"><?php echo $row["ClubName"]; ?></option>
        <?php
            $i++;
            }
            ?> 
    </select>
     <label for="eventID" name="eventID">Select Event:</label>
    <select name="eventID" id="eventID" class="form-select" required>
        <option value="--Event Name will appear here--" selected>--Event Name will appear here--</option>
        <?php
        $i=0;
        while($row = mysqli_fetch_array($res)) {
        if($i%2==0)
        $classname="even";
        else
        $classname="odd";
        ?>
        <?php if(isset($classname)) echo $classname;?>
        <option value="<?php echo $row["EventID"]; ?>"><?php echo $row["eventName"]; ?></option>
        <?php
            $i++;
            }
            ?> 
    </select>
        <label for="poster" class="mt-2" name="poster">Upload Poster:</label>
        <input type="file" name="posterfile" accept="image/png, image/gif, image/jpeg" title="Upload image file" class="form-control">
        <div class="input-group">
            <button type="submit" name="posterSubmit" class="btn btn-primary my-2 rounded">Submit</button>
             <button type="reset" class="btn btn-primary my-2 mx-2 rounded">Reset</button>
        </div>
    </form>
        </div>
        </div>
    </div>
    <br>
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
    
    <?php
     
     if(isset($_POST["posterSubmit"])){

    $posterID = $_POST["posterID"];
    $eventID = $_POST["eventID"];
    $clubID = $_POST["clubID"];

    if (isset($_FILES['posterfile']['name'])){
        $file_name = $_FILES['posterfile']['name'];
        $file_tmp = $_FILES['posterfile']['tmp_name'];

        move_uploaded_file($file_tmp, "./Posters/".$file_name);

         $query =  "INSERT INTO poster(posterID, file, EventID, clubID) VALUES('$posterID','$file_name','$eventID', '$clubID'";
        
        $result = mysqli_query($con, $query);
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
                  File must be uploaded in image format!
            </div>
          <?php
        }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> 
</body>
<footer>
    <p>If there are any issues, contact us at: B1010101@helplive.edu.my
    </p>
    Copyright &copy; 2023
</footer>
</html>