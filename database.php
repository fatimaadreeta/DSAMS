
<?php
$host = "localhost";
$database = "dsams";
$user = "root";
$pass = "";

$connection = new mysqli ($host, $user, $pass, $database);

// mysqli_connect_errno returns the last error code
if ($connection->connect_errno) {
	die("connection failed; ". $connection->connect_error);
}

date_default_timezone_set("Asia/Singapore");
?>