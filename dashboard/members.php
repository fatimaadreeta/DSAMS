<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DSAMS </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <link rel="stylesheet" type="text/css" href="../popup.css">
        <script src="../sidenav.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg fixed-top"> 
            <div class="container-fluid">
                <a class="logo" href="../index.php"><img src="../logo.png"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse  justify-content-end" id="navbarTogglerDemo01">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="button invert" href="../logout.php">Logout</a>
                        </li>
                    </ul>      
                </div>
            </div>
        </nav>
        <main  id="mainMargin">
            <div id="mySidenav" class="sidenav" style="width :50px;">
                <a onclick="openNav()">
                <i class="bi bi-list"  style="font-size: 1.5rem;"></i>
                </a>
                <a href="home.php"><i class="bi bi-house-door" style="font-size: 1.5rem;"></i>Home</a>
                <a href="proposals.php"><i class="bi bi-collection"  style="font-size: 1.5rem;"></i>Proposals</a>
                <a href="../browseClubs.php"><i class="bi bi-globe2"  style="font-size: 1.5rem;"></i>Clubs</a>
                <a href="../browseEvents.php"><i class="bi bi-calendar4-event"  style="font-size: 1.5rem;"></i>Events</a>
                <a href="#"><i class="bi bi-headset"  style="font-size: 1.5rem;"></i>Contact</a>
            </div>  
            <h1 class="text-center p-3">Member List</h1>
            <div class="d-flex container justify-content-center">
            <?php
                include_once '../database.php';
                session_start();
                $hierarchy = array('Member', 'Committee', 'Vice President','President');
                $position = "";
                if(!isset($_SESSION['position'])){
                    $_SESSION['loginError'] = 1;
                    header("Location: ../login.php");
                    exit();
                }else if(!isset($_GET['id'])){
                    //check club id in URL first
                    echo "<h1>Invalid Club ID</h1>";
                    exit();
                } else if (!empty(array_search("Admin",$_SESSION['position']))){
                    //search Position Array for Admin value
                    //login success as admin
                    $position = "Admin";
                } else if (!array_key_exists($_GET['id'], $_SESSION['position'])) {
                    echo "<h1>You are not a member of this club</h1>";
                    exit();
                }else if ($_SESSION['position'][$_GET['id']] == "Removed"){
                    echo "<h1>You do not have permission to view the Member List</h1>";
                    exit();
                }else if (!is_null(array_search($_SESSION['position'][$_GET['id']], $hierarchy))){
                    //searches if Hiearchy value matches the value gotten from the position value of $_SESSION['position'][clubId]
                    //login success as user
                    $position = $_SESSION['position'][$_GET['id']];
                } else{
                    header("Location: ../index.php");
                    exit();
                }
                 
                $clubId = $_GET['id'];

                if(isset($_POST['Remove'])){
                    $studentId= $_POST['hiddenId'];
                    $submitDate = date('Y-m-d');

                    $sql ="UPDATE clubroles SET position = 'Removed', leaveDate = '$submitDate'
                    WHERE studentId = '$studentId' AND clubId = '$clubId'";
                    if ($connection->query($sql) === TRUE) {
                    } else {
                        echo "Error: " . $sql . "<br>" . $connection->error;
                    }
                    include_once '../updateRoles.php';
                    unset($_POST);
                    header("Location:members.php?id=".$clubId);
                }
                if(isset($_POST['save'])){
                    foreach($_POST['role']  as $key => $value){
                        if($value == "President"){
                            //Demotes all other presidents
                            $sql ="UPDATE clubroles SET position = 'Vice President'
                            WHERE position = 'President' AND clubId = '$clubId'";
                            if ($connection->query($sql) === TRUE) {
                            } else {
                                echo "Error: " . $sql . "<br>" . $connection->error;
                            }  
                        }
                        if($key == $_SESSION['loggedIn']){
                            //Checks if you demoted yourself
                            $_SESSION['position'][$_GET['id']] = $value;
                        }
                        $sql ="UPDATE clubroles SET position = '$value'
                        WHERE studentId = '$key' AND clubId = '$clubId'";
                        if ($connection->query($sql) === TRUE) {
                        } else {
                            echo "Error: " . $sql . "<br>" . $connection->error;
                        }
                    }
                    include "../updateRoles.php";
                    unset($_POST);
                    header("Location:members.php?id=".$clubId);
                }
            ?>
                <form method="post" action="members.php?id=<?php echo $_GET['id']; ?>">
                    <div class="table-responsive">
                        <table class="table table-striped table-dark">
                            <thead>
                                <tr>
                                    <th scope="col"> Name </th>
                                    <th scope="col"> Student Id </th>
                                    <th scope="col"> Position </th>
                                    <th scope="col"> Join Date </th>
                                    <th scope="col"> Leave Date</th>
                                    <th scope="col"><button type="submit" class="btn btn-outline-success" name = "save">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                                        <path d="M11 2H9v3h2V2Z"/>
                                        <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0ZM1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5Zm3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4v4.5ZM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5V15Z"/>
                                        </svg>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $sql = "SELECT s.name, s.studentId, r.joinDate, r.position, r.leaveDate 
                                FROM clubroles AS r 
                                INNER JOIN student AS s ON r.studentId=s.studentId 
                                WHERE r.clubId = '$clubId'
                                ORDER BY r.leaveDate ASC";
                                $_SESSION['memberList']= [];

                                $result = $connection->query($sql);
                                while ($row =  $result->fetch_assoc() ) {
                                    $_SESSION['memberList'][] = $row;
                                }
                                foreach ($_SESSION['memberList'] as $index => $arrayRow) {
                                    echo '<tr>';
                                    echo '<td>'. $arrayRow['name'] .'</td>';
                                    echo '<td>'. $arrayRow['studentId'] .'</td>';
                                    echo '<td>';
                                    //Users are only allowed to modify people under them in the hierarchy 
                                    switch($position){
                                        case "Admin":
                                        case "President":
                                            switch($arrayRow['position']){
                                                case "Member":
                                                case "Committee":
                                                case "Vice President":
                                                    if($arrayRow['position'] == 'Removed' || !in_array($arrayRow['position'], $hierarchy)){
                                                        echo ' Removed ';
                                                    }else{
                                                        echo '<select class="form-select" name="role['. $arrayRow['studentId'] .']">';
                                                        foreach ($hierarchy  as $key => $value) {
                                                            if ($value == $arrayRow['position']) {
                                                                echo('<option selected="selected">'.$value.'</option>');
                                                            } else {
                                                                echo('<option>'.$value.'</option>');
                                                            }
                                                        }   
                                                        echo '</select>';                                    
                                                    }
                                                    break;
                                                case "Removed":
                                                case "President":
                                                default:  echo $arrayRow['position'];
                                            }
                                            break;
                                        case "Vice President":
                                            switch($arrayRow['position']){
                                                case "Member":
                                                case "Committee":
                                                    if($arrayRow['position'] == 'Removed' || !in_array($arrayRow['position'], $hierarchy)){
                                                        echo ' Removed ';
                                                    }else{
                                                        echo '<select class="form-select" name="role['. $arrayRow['studentId'] .']">';
                                                        foreach (array_slice($hierarchy, 0, 2)  as $key => $value) {
                                                            if ($value == $arrayRow['position']) {
                                                                echo('<option selected="selected">'.$value.'</option>');
                                                            } else {
                                                                echo('<option>'.$value.'</option>');
                                                            }
                                                        }   
                                                        echo '</select>';                                    
                                                    }
                                                    break;
                                                case "Vice President":
                                                case "Removed":
                                                case "President":
                                                default:  echo $arrayRow['position'];
                                            }
                                            break;
                                        case "Committee":
                                        case "Member":
                                            echo $arrayRow['position'];
                                            break;
                                        default : echo "Error: Position not found";
                                    }
                                    echo '</td>';
                                    echo '<td>'. date("d/m H:i", strtotime($arrayRow['joinDate'])) .'</td>';
                                    echo '<td>';
                                    if(isset($arrayRow['leaveDate'])){
                                        echo date("d/m H:i", strtotime($arrayRow['leaveDate']));
                                    } 
                                    else{
                                        echo '-';
                                    }
                                    echo '</td>';
                                    echo '<td>';
                                    //Users are only able to see the remove button for users under them in the hierarchy
                                    switch($position){
                                        case "President":
                                            switch($arrayRow['position']){
                                                case "Removed":
                                                case "President":
                                                break;
                                                default: echo '<button class="btn btn-outline-danger" 
                                                type="button"
                                                onclick="review(\''.$arrayRow['studentId'] .'\',\''. $arrayRow['name'] .'\')"> 
                                                Remove </button>';
                                            }
                                            break;
                                        case "Vice President":
                                            switch($arrayRow['position']){
                                                case "Removed":
                                                case "President":
                                                case "Vice President":
                                                break;
                                                default: echo '<button class="btn btn-outline-danger" 
                                                type="button"
                                                onclick="review(\''.$arrayRow['studentId'] .'\',\''. $arrayRow['name'] .'\')"> 
                                                Remove </button>';
                                            }
                                            break;
                                        case "Committee":
                                            switch($arrayRow['position']){
                                                case "Removed":
                                                case "President":
                                                case "Vice President":
                                                case "Committee":
                                                break;
                                                default: echo '<button class="btn btn-outline-danger" 
                                                type="button"
                                                onclick="review(\''.$arrayRow['studentId'] .'\',\''. $arrayRow['name'] .'\')"> 
                                                Remove </button>';
                                            }
                                            break;
                                    }

                                    echo '</td>';
                                    echo '</tr>';
                                } 
                                unset($_SESSION['memberList']);
                            ?>
                            </tbody> 
                        </table>
                    </div>
                </form>
                <div id="popup" class="align-items-center justify-content-center" onclick="closePopUp()" style="display: none; flex-direction: column;">
                    <form class="contact-form d-flex flex-column align-items-center p-3 col-6 col-lg-4 p-4 m-4 bg-customGrey" action="members.php?id=<?php echo $_GET['id']; ?>" method="post" onclick="preventClose(event)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                            <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                        </svg>
                        <h3 class="col-10" name="message" id="message" style="text-align: center;"> </h3>
                        <input type="hidden" value="" id="hiddenId" name="hiddenId">
                        <div class="d-flex justify-content-around col-12">
                            <input type="submit" value="Remove" class="btn col-md-4 btn-danger" name="Remove" id="confirmButton">
                            <input type="reset" value="Cancel" class="btn col-md-4 btn-outline-danger" name="Remove" onclick="closePopUp()">
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </body>
    <script src="../popUp.js"></script>
</html>
