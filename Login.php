<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="login.css">
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    <title>Login - DSAMS</title>
</head>
<body>
    <!--The page that determines which home to land in-->
    <nav class="navbar navbar-expand-lg"> 
        <div class="container-fluid">
            <a class="logo" href="index.php"><img src="logo.png"></a>
        </div>
    </nav>
    <div class="container text-light p-3">
        <h1>DSAMS - User Login</h1>
        <form class="col-12 col-md-6" name="myForm" action="LoginProcess.php" method="POST">
        <label for="userID">Student ID:</label>
        <input type="text" name="userID" class="form-control" required>
        <label for="Password">Password:</label>
        <input type="password" name="password" class="form-control" required>
        <div class="input-group my-2">
            <button type="submit" name="login" class="btn btn-danger hover">Login</button>
        </div>
    </form>
    <a class="text-light" href="#"><i>Don't have an account?</i></a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer>
    <p>If there are any issues, contact us at: B1010101@helplive.edu.my
    </p>
    Copyright &copy; 2023
</footer>
<?php 
    include_once 'database.php';
    session_start();
    if(isset($_SESSION['loginError'])){
        echo '<script>alert("Please login to continue")</script>';
        unset($_SESSION['loginError']);
    }
?>
</html>