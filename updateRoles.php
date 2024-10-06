<?php
    $_SESSION['position'] = array();
    $userID = $_SESSION['loggedIn'] ;
    $q = "SELECT position, clubId FROM clubroles WHERE studentId = '$userID' AND position != 'Removed'";
    $result = mysqli_query($connection, $q);

    while ($row = $result->fetch_assoc()) {
        $_SESSION['position'][$row['clubId']] = $row['position'];
    }
?>