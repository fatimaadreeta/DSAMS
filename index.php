<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <title>DSAMS </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg"> 
    <div class="container-fluid">
        <a class="logo" href="index.php"><img src="logo.png"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse  justify-content-end" id="navbarTogglerDemo01">
            <ul class="navbar-nav">
                <!-- <li class="nav-item">
                    <div class="dropdown">
                        <a class="button">Clubs Dropdown</a>
                        <div class="dropdown-content">
                        <a href="browseClubs.php">Browse Clubs</a>
                        <a href="club/page.php?id=C0001">View Club Page</a>
                        <a href="editClub.php">Edit Club Page</a>
                        <a href="memberList.php">Manage Club Members</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                <div class="dropdown">
                    <a class="button">Events Dropdown</a>
                    <div class="dropdown-content">

                        <a href="submitProposal.php">Submit Event Proposal</a>
                        <a href="#">Submit Poster</a>
                        <a href="admin/eventProposals.php">View Event Proposal</a>
                    </div>
                </div>
                </li>
                <li class="nav-item">
                <div class="dropdown">
                    <a class="button">Dashboards</a>
                    <div class="dropdown-content">
                        <a href="dashboard/home.php">Member Dashboard</a>
                        <a href="HomeClubRep.php">Club Rep Dashboard</a>
                        <a href="admin/home.php">Admin Dashboard</a>
                    </div>
                </div>
                </li> -->
                <li class="nav-item">
                <a class="button" href="browseEvents.php">Browse Events</a>
                </li>
                <li class="nav-item">
                <a class="button" href="clubProposalForm.php">Start a new Club</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php
                    include_once 'database.php';
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
    </div>
    </nav>
    <main>
        <div class="landingImg"></div>
        <div id="news">
            <h1 class="title">News and Events</h1>
            <div class="container">
                <div class="row">
                    <?php
                        $sql = "SELECT * FROM activity WHERE frontPage = true ORDER BY postDate";
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
                                // if(count($eventList)%3==0){
                                //     echo'<div class="row d-flex flex-column">'; 
                                // }
                                $imgName = urlencode($arrayRow['posterImg']);
                                echo'   
                                <div class="col-6 col-md-6 col-lg-4">
                                    <div class="article">
                                        <a href="event/events.php?id='.$arrayRow['activityId'].'"/>
                                            <div class="img-wrapper wrap-top">
                                                <img src="Images/'.$imgName.'">
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
                                // if(count($eventList)%3==0){
                                //     echo'</div>'; 
                                // }
                            }                            
                        }
                        unset($eventList);
                    ?>
                </div>
            </div>
        </div>
        <div class="clubPreview">
            <div  class="container">
                <h1 class="title">Join a Club!</h1>
                <div class="row">
                        <?php
                            $sql = "SELECT * FROM club";
                            $result = $connection->query($sql);
                            if(!isset($result)){
                                //if club has no activities just leave it blank
                            }
                            else{
                                $clubArray = [];
                                while($row = $result->fetch_assoc()){
                                    $clubArray[] =  $row;
                                }
                                foreach($clubArray as $index => $arrayRow){
                                    echo '
                                    <div class="col-6 col-lg-3">
                                        <div class="article">
                                            <a href="club/page.php?id='.$arrayRow['clubId'].'"/>
                                            <div class="img-wrapper" alt="">
                                                <img src="Images/Clubs/'.$arrayRow['clubIcon'].'">
                                            </div>';
                                    echo '<div class="article-text">
                                        <div class="article-title">
                                            '. $arrayRow['clubName'] .'
                                            </div>';
                                    echo '<div class="article-body">
                                            '. $arrayRow['description'] .'
                                            </div>';
                                    echo '  </div>
                                            </a>
                                        </div>
                                    </div>';
                                }
                            }
                        ?>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <p>If there are any issues, contact us at: B1010101@helplive.edu.my
        </p>
        Copyright &copy; 2023
    </footer>
</body>
</html>