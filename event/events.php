<?php include_once '../database.php';
$eventID = $_GET['id'];
$sql = "SELECT * FROM activity WHERE activityId = '$eventID'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
//logged in
session_start();
if(!isset($_SESSION['position'])){
    $_SESSION['loginError'] = 1;
    header("Location: ../login.php");
}

$username = $_SESSION['loggedIn'];
$joined = FALSE;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="events.css" type="text/css"> 
     <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <title>Events - <?php echo $row['activityName'];?></title>
</head>
<body class="overflow-x">
    <nav class="navbar navbar-expand-lg"> 
    <div class="container-fluid">
        <a class="logo" href="../index.php"><img src="../logo.png"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse  justify-content-end" id="navbarTogglerDemo01">
            <ul class="navbar-nav">
                 <li class="nav-item">
                <a class="button" href="../browseClubs.php">Browse Clubs</a>
                </li>
                <li class="nav-item">
                <a class="button" href="../submitProposal.php">Submit Event Proposal</a>
                </li>
                <li class="nav-item">
                <a class="button" href="../clubProposalForm.php">Submit Club Proposal</a>
                </li>
                <li class="nav-item">
                <a class="button" href="../logout.php">Logout</a>
                </li>
            </ul>      
        </div>
        </div>
    </nav>
        <?php
            $student = $username;
            $event = $eventID;
            $q = "SELECT * FROM participation WHERE studentId = '$username' AND activityId = '$eventID'";
            $result = mysqli_query($connection, $q);
            $joined = FALSE;
            //checking if student has already joined this event or not
            if(mysqli_num_rows($result) <= 0){
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $q = "INSERT INTO participation(studentId, activityId, attendance, role, registrationStatus) VALUES('$student', '$eventID', FALSE, 'participant', 'Signed Up');";
                    $result = mysqli_query($connection, $q);
                    header("Location:events.php?id=".$eventID);
                }
            }else{
                // echo 'Already requested registration';
                $joined = TRUE;
            }
        ?>
        <div class="d-flex row justify-content-end">
            <div class="join-button col-2">
             <?php ?> 
             <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?id='.$eventID;?>">
             <?php
             if($joined){
                echo '<button name="submit" type="submit" class="m-3 btn btn-outline-success" disabled>Joined</button>';}
            else{
                echo '<button name="submit" type="submit" class="m-3 btn btn-outline-success">Join</button>';}?>
                </form>
            </div>
        </div>
    <main class="container"> 
        <div class="text-center p-3">
              <div class="event-name">
            <h1 class="fw-bolder"><?php echo $row['activityName'];?></h1>
        </div>
        <div class="event-poster pb-2">
            <h2 class="fw-bold">Event Poster</h2>
            <img src="<?php echo'../Images/'.$row['posterImg']?>" alt="event poster">
        </div>
        <div class="event-description pb-2">
            <h2 class="fw-bold">Event Details</h2>
            <p><?php echo $row['description'];?></p>
        </div>
        <div class="event-details pb-2">
            <h2 class="fw-bold ">Event Time, Date and Venue</h2>
            <div class="details d-flex justify-content-between">
                 <p><b>Date:</b> <?php echo $row['startDate'];?>
                 <p><b>Time:</b> <?php echo $row['Time'];?></p>
                 <p><b>Venue:</b> <?php echo $row['venue'];?></p>
            </div>
        </div>
    </div>
    </main>
</body>
</html>