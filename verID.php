<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="login.css">
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    <title>Verification</title>
</head>
<body>
    <!--The page that determines which homw to land in-->
    <nav class="navbar"> 
        <a href="index.php"><img class="m-0 mx-2 p-0 logo" src="logo.png" alt="logo"></span></a>
        <a class="button mx-3" href="index.php">Back to Homepage</a>
    </nav>
    <div class="container m-5 text-light p-5">
    <form class="w-50" action="decidePage.php" method="POST">
    <label for="userID">Enter User ID to access form: </label>
    <div class="input-group"><input type="text" name="userID" class="form-control" required>
    <button class="rounded btn-primary mx-2 hover" type="submit" name="verID">Submit</button></div>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer>
    <p>If there are any issues, contact us at: B1010101@helplive.edu.my
    </p>
    Copyright &copy; 2023
</footer>
</html>
