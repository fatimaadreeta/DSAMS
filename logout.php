<?php 
session_start();

//Checks if user was logged in
if (isset($_SESSION['loggedIn'])) {
    session_destroy();
}
header("Location:index.php");

?>