<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DSAMS </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="index.css">
        <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
    <body>
        <nav class="navbar navbar-expand-lg"> 
            <div class="container-fluid">
                <a class="logo" href="index.php"><img src="logo.png"></a>
                <ul class="navbar-nav">
                <?php
                    session_start();
                    if(!isset($_SESSION['loggedIn'])){
                        echo '<li class="nav-item">
                        <a class="button invert" href="Login.php">Login</a>
                        </li>';
                    } else{                        
                        echo '<li class="nav-item">
                        <a class="invert button" href="dashboard/home.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-speedometer" viewBox="0 0 16 16">
                        <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
                        <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z"/>
                        </svg></a>
                        </li>';
                        echo '<li class="nav-item">
                        <a class="invert button" href="logout.php">Sign Out</a>
                        </li>';
                    }
                ?>
                </ul>
            </div>
        </nav>
        <main>
            <h1 class="text-center p-3">Error 404: Page Not Found!</h1>
        </main>
    </body>
</html>
