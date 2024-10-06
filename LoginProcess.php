<!--page that decides which homepage to land in-->
<?php 
session_start();

$con = mysqli_connect("localhost", "root", "", "dsams");

if(isset($_POST["login"])){
  $userID = $_POST["userID"];
  $password = $_POST["password"];

  $q = 'SELECT studentId FROM student WHERE studentId = ? AND password = ?';
  $query = $con->prepare($q);
  $query->bind_param("ss", $userID, $password);
  $query->execute();
  $result = $query->get_result();

  //Proceed if student Id and password are valid
  if(mysqli_num_rows($result) > 0){
   
    //Set session variables
    $_SESSION['loggedIn'] = $userID;

    //Search for students in clubs that they haven't left yet
    $q = "SELECT position, clubId FROM clubroles WHERE studentId = '$userID' AND position != 'Removed'";
    $result = mysqli_query($con, $q);
    $_SESSION['position'] = array();
    while ($row = $result->fetch_assoc()) {
      $_SESSION['position'][$row['clubId']] = $row['position'];
    }
    //If user is an admin, redirect to admin dashboard
    if(!empty(array_search("Admin",$_SESSION['position']))){
      header("Location: admin/home.php");
    }
    else{
      header("Location: dashboard/home.php");
    }

  }
  else{
    echo 'invalid userid/password';
    header("Location: 404.php");
  }
}
?>