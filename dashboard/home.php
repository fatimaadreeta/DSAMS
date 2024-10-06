<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <title>DSAMS Member Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../index.css">
    <link rel="stylesheet" type="text/css" href="../popup.css">
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <?php
        include_once '../database.php';
        session_start();
        if(!isset($_SESSION['position'])){
            $_SESSION['loginError'] = 1;
            header("Location: ../login.php");
            exit();
        }
        $studentId = $_SESSION['loggedIn'];
        $position = $_SESSION['position'];

        if(isset($_POST['Leave'])){
            $clubId= $_POST['hiddenId'];
            $submitDate = date('Y-m-d');

            $sql ="DELETE FROM clubroles
            WHERE clubId = '$clubId' && studentId = '$studentId'";
            if ($connection->query($sql) === TRUE) {
            } else {
                echo "Error: " . $sql . "<br>" . $connection->error;
            }
            unset($_POST);
            header("Location:home.php");
        }
    ?>
</head>
<body>
    <nav class="navbar fixed-top"> 
        <div class="container-fluid">
            <a class="logo" href="../index.php"><img src="../logo.png"></a>
            <div class="btn-container">
                <a class="button" href="../submitProposal.php">Submit Event Proposal</a>
                <a class="button" href="../clubProposalForm.php">Submit Club Proposal</a>
                <a class="invert button" href="../logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <main id="mainMargin"> 
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
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php
                        echo "<h1 class ='welcomeCard'>Welcome, ".$_SESSION['loggedIn']."</h1>";
                    ?>     
                </div>
            </div>
            <div class="row mx-2">
                <div class="col-12 col-md-8">
                    <h1>Upcoming Events</h1>
                    <div class="row">
                    <?php
                        $sql = "SELECT * FROM activity WHERE frontPage = 1 ORDER BY postDate DESC";
                        $eventList= [];
                    
                        $result = $connection->query($sql);
                        while ( $row =  $result->fetch_assoc() ) {
                            $eventList[] = $row;
                        }
                        if(!isset($eventList)){
                            echo 'Connection error';
                        }
                        else{
                            foreach ($eventList as $index => $arrayRow) {
                                echo'   
                                <div class="col-12 col-md-6">
                                    <div class="article">
                                        <a href="../event/events.php?id='.$arrayRow['activityId'].'"/>
                                            <div class="img-wrapper wrap-top">
                                                <img src="../Images/' .$arrayRow['posterImg'].'"/>
                                            </div>
                                            <div class="article-text">
                                                <div class="article-tag">
                                                    '. $arrayRow['activityTag'] .'
                                                </div>
                                                <div class="article-title">
                                                '. $arrayRow['activityName'] .'
                                                </div>
                                                <div class="article-body">
                                                '. substr($arrayRow['description'],0 ,100) .'
                                                </div>
                                                <div class="article-date">
                                                '. date("d M Y", strtotime($arrayRow['postDate'])) .'
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>';
                            }                            
                        }
                        unset($eventList);
                    ?>
                    </div>
                </div>
                <div class="col-4">
                    <h1>My Clubs</h1>
                    <div class="table-responsive">
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th scope="col"> Club </th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php    
                        $sql = "SELECT c.clubName, r.clubId, r.joinDate, r.position FROM clubroles AS r
                        JOIN club AS c ON r.clubId= c.clubId
                        WHERE studentId = '$studentId' && r.position !='Removed'";

                        $result = $connection->query($sql);
                        while ( $row =  $result->fetch_assoc() ) {
                            $clubList[] = $row;
                        }
                        if(empty($clubList)){
                            
                        }
                        else{
                            foreach ($clubList as $index => $arrayRow) {
                                echo '<tr>';
                                echo '<td>'. $arrayRow['clubName'] .'</td>';

                                echo '<td>';
                                if($arrayRow['position'] != "Removed"){
                                    echo '<a href="members.php?id='.$arrayRow['clubId'].'">
                                    <button class="btn btn-outline-success" onclick="showReview(' .$arrayRow['clubId']. ')"> Members </button>
                                    </a>
                                    <button class="btn btn-outline-danger" onclick="review(\'' .$arrayRow['clubId'].'\',\''. $arrayRow['clubName'] .'\')"> Leave </button></td>';                  
                                }else{
                                    echo '';
                                }
                                echo '</tr>';
                            }
                            unset($clubList);                
                        }
                        ?>
                    </tbody> 
                </table>
                </div>
            </div>
        </div>
    </main>
    <div id="popup" class="align-items-center justify-content-center" onclick="closePopUp()" style="display: none; flex-direction: column;">
        <form class="contact-form d-flex flex-column align-items-center p-3 col-6 col-lg-4 p-4 m-4 bg-customGrey" action="#" method="post" onclick="preventClose(event)">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
            </svg>
            <h3 class="col-10" name="message" id="message" style="text-align: center;"> </h3>
            <input type="hidden" value="" id="hiddenId" name="hiddenId">
            <div class="d-flex justify-content-around col-12">
                <input type="submit" value="Leave" class="btn col-md-4 btn-danger" name="Leave" id="confirmButton">
                <input type="reset" value="Cancel" class="btn col-md-4 btn-outline-danger" name="Leave" onclick="closePopUp()">
            </div>
        </form>
    </div>
    <footer>
        <p>If there are any issues, contact us at: B1010101@helplive.edu.my
        </p>
        Copyright &copy; 2023
    </footer>
    <script src="../sidenav.js"></script>
    <script src="../popUp.js"></script>
</body>
</html>