<?php
session_start();
if(!$_SESSION['loggedIn']){
    header("Location: login.php");
}

$con = mysqli_connect('localhost', 'root', "");

mysqli_select_db($con, 'dsams');

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
    <title>Submit Proposal Page</title>
</head>
<body>
<nav class="navbar"> 
    <div class="container-fluid">
        <a class="logo" href="index.php"><img src="logo.png"></a>     
    </div>
</nav>
    <div class="container m-3 p-3">
         <div>
            <?php 
            if(isset($_POST["proposalSubmit"])){
                echo "<p id='submitMsg'>new event proposal submitted</p>";
                header("Location: successful.php");
            }else{
                echo '';
            }?>
            <h1>Event Proposal Form</h1>
            <div class="m-2 p-2 bg-light">
                 <form method="POST" enctype="multipart/form-data" class="form">
        <input type="hidden" value="<?php echo uniqid("P")?>" name="ProposalID">
        <label for="campus">Choose your campus:</label>
        <select id="campus" name="campus" class="form-select">
            <option value="" disabled Selected>---Selected Campus goes here---</option>
            <option value="Subang 2">Subang 2</option>
            <option value="Damansara">Damansara - Wisma CL</option>
            <option value="Damansara">Damansara - Wisma HELP</option>
            <option value="Damansara">Damansara - ELM</option>
        </select>
        <label for="submittedBy" name="submittedBy">Submitted by: </label>
        <input type="text" name="submittedBy" class="form-control" placeholder="Please include your studentID" required>
        <label for="eventName" name="eventName">Event Name: </label>
        <input type="text" name="eventName" class="form-control">
        <label for="category" name="category">Event Category: </label>
         <select id="category" name="category" class="form-select">
            <option value="" disabled Selected>---Your event category---</option>
            <option value="Organized">Organized</option>
            <option value="Collaboration">Collaboration</option>
            <option value="Participation">Participation</option>
        </select>
         <label for="type" name="type">Event Type: </label>
         <select id="type" name="type" class="form-select">
            <option value="" disabled Selected>---Your event type---</option>
            <option value="Clubs">Clubs and societies</option>
            <option value="Assignment">Class Assignment</option>
            <option value="DIY">Individual - DIY</option>
        </select>
        <label for="startDate" name="startDate" >Start Date: </label>
        <input type="date" name="startDate" class="form-control">
        <label for="clubName" name="clubName" >Select Club:</label>
        <select name="clubName" id="clubName" class="form-select" required>
            <option value="--Club Name will appear here--" selected>--Club Name will appear here--</option>
            <?php
            $i=0;
            while($row = mysqli_fetch_array($result)) {
            if($i%2==0)
            $classname="even";
            else
            $classname="odd";
         if(isset($classname)) echo $classname;?>
        <option value="<?php echo $row["clubId"]; ?>"><?php echo $row["clubName"]; ?></option>
        <?php
            $i++;
            }
            ?> 
    </select>
    <label for="className" name="className">Class Subject Code and Name: </label>
        <input type="text" name="className" class="form-control" placeholder="provide only if event for class assignment">
        <label for="proposal" name="proposal" class="mt-2">Upload Proposal:</label>
        <input type="file" name="proposalfile" accept=".pdf" title="Upload pdf" class="form-control">
        <label for="venue" name="venue">Venue(Meeting link or the proposed venue of your event): </label>
        <input type="text" name="venue" class="form-control">
        <label for="PIC1" name="PIC1">Person-in charge 1: </label>
        <input type="text" name="PIC1" class="form-control" placeholder="MUST include studentID, name and contact no.">
        <label for="PIC2" name="PIC2">Person-in charge 2: </label>
        <input type="text" name="PIC2" class="form-control" placeholder="MUST include studentID, name and contact no.">

        <div class="input-group">
            <button type="submit" name="proposalSubmit" id="submit" class="btn btn-primary my-2 rounded">Submit</button>
             <button type="reset" id="reset" class="btn btn-primary my-2 mx-2 rounded">Reset</button>
        </div>
    </form>
            </div>
    </div>
    </div>
     <?php
if(isset($_POST["proposalSubmit"])){

    $proposalID = $_POST["ProposalID"];
    $campus = $_POST["campus"];
    $eventName = $_POST["eventName"];
    $category = $_POST["category"];
    $type = $_POST["type"];
    $startDate = $_POST["startDate"];
    $clubName = $_POST["clubName"];
    $className = $_POST["className"];
    $venue = $_POST["venue"];
    $PIC = $_POST["PIC1"]."<br>".$_POST["PIC2"];
    $submittedBy = $_POST["submittedBy"];

    $submitDate = date("Y-m-d");
    
    if (isset($_FILES['proposalfile']['name'])){
        $file_name = $_FILES['proposalfile']['name'];
        $file_tmp = $_FILES['proposalfile']['tmp_name'];

        move_uploaded_file($file_tmp, "./Proposals/".$file_name);

        $q = "SELECT * FROM proposal where proposalId = '$proposalID'";
        $result = mysqli_query($con, $q);

        if(mysqli_num_rows($result) <= 0 ){
            $q =  "INSERT INTO proposal(proposalId, campus, title, category, type, startDate, duration, clubId, className, venue, personInCharge, studentId, proposalfile, status, submitDate) VALUES('$proposalID','$campus', '$eventName', '$category', '$type', '$startDate', NULL, '$clubName', '$className', '$venue', '$PIC', '$submittedBy', '$file_name', DEFAULT, '$submitDate')";
            
            $result = mysqli_query($con, $q); 
        }
        else if(mysqli_num_rows($result) > 0 ){
            echo 'Warning: duplicate entry '.$proposalID;
        }
        }
        unset($_POST); 
    }
?> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
    const form = document.querySelector("form");
    const reset = document.querySelector("#reset");

   reset.addEventListener("click", ()=>{
        form.reset();
    })
</script>
<footer>
    <p>If there are any issues, contact us at: B1010101@helplive.edu.my
    </p>
    Copyright &copy; 2023
</footer>
</html>