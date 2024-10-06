<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <title>Manage Proposals </title>
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
    ?>
</head>
<body>
    <nav class="navbar fixed-top" > 
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
            <br>
            <div class="row">
                <div class="col-12 col-md-8">
                    <h1>Event Proposals</h1>
                    <div class="row">
                        <form action="../event/publish.php" method="post">
                            <table class="table table-striped table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col"> Title </th>
                                        <th scope="col"> Submit Date </th>
                                        <th scope="col"> Status </th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php    
                                    $sql = "SELECT proposalId,submitDate, title, activityName, p.activityId, status
                                            FROM proposal AS p
                                            LEFT JOIN activity AS a ON p.activityId=a.activityId 
                                            WHERE studentId = '$studentId' && reasoning IS NULL";

                                    $result = $connection->query($sql);
                                    while ( $row =  $result->fetch_assoc() ) {
                                        $clubList[] = $row;
                                    }
                                    if(empty($clubList)){
                                        
                                    }
                                    else{
                                        foreach ($clubList as $index => $arrayRow) {
                                            echo '<tr>';
                                            if(isset($arrayRow['activityName'])){
                                                echo '<td>'. $arrayRow['activityName'] .'</td>';
                                            }else{
                                            echo '<td>'. $arrayRow['title'] .'</td>';
                                            }
                                            echo '<td>'. date("d M", strtotime($arrayRow['submitDate'])) .'</td>';
                                            echo '<td>'. $arrayRow['status'] .'</td>';
                                            switch($arrayRow['status']){
                                                case "Published":
                                                    echo '<td><a href="../event/edit.php?id='.$arrayRow['activityId'].'"><button 
                                                    class="btn btn-outline-success"
                                                    type="button"> Edit 
                                                    </button></a></td>';
                                                    break;
                                                case "Approved":
                                                    echo '<td><button class="btn btn-outline-warning"
                                                    name="proposalId"
                                                    value="' .$arrayRow['proposalId'].'"> Publish 
                                                    </button></td>';
                                                    break;
                                                case "Pending":
                                                case "Rejected":
                                                default: echo '<td></td>';
                                            }
                                            
                                            echo '</tr>';
                                        }
                                        unset($clubList);                
                                    }
                                ?>
                                </tbody> 
                            </table>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <h1>Club Proposals</h1>
                    <form action="../club/publish.php" method="post">
                        <div class="table-responsive">
                            <table class="table table-striped table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col"> Title </th>
                                        <th scope="col"> Submit Date </th>
                                        <th scope="col"> Status </th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php    
                                $sql = "SELECT proposalId,submitDate, title, clubId, status FROM proposal 
                                WHERE studentId = '$studentId' && reasoning IS NOT NULL";

                                $result = $connection->query($sql);
                                while ( $row =  $result->fetch_assoc() ) {
                                    $clubList[] = $row;
                                }
                                if(empty($clubList)){
                                    
                                }
                                else{
                                    foreach ($clubList as $index => $arrayRow) {
                                        echo '<tr>';
                                        echo '<td>'. $arrayRow['title'] .'</td>';
                                        echo '<td>'. date("d M", strtotime($arrayRow['submitDate'])) .'</td>';
                                        echo '<td>'. $arrayRow['status'] .'</td>';
                                        switch($arrayRow['status']){
                                            case "Published":
                                                echo '<td><a href="../club/edit.php?id='.$arrayRow['clubId'].'"><button 
                                                class="btn btn-outline-success"
                                                type="button"> Edit 
                                                </button></a></td>';
                                                break;
                                            case "Approved":
                                                echo '<td><button class="btn btn-outline-warning"
                                                name="proposalId"
                                                value="' .$arrayRow['proposalId'].'"> Publish 
                                                </button></td>';
                                                break;
                                            case "Pending":
                                            case "Rejected":
                                            default: echo '<td></td>';
                                        }
                                        
                                        echo '</tr>';
                                    }
                                    unset($clubList);                
                                }
                                ?>
                                </tbody> 
                            </table>
                        </div>
                    </form>
            </div>
        </div>
    </main>
    <footer>
        <p>If there are any issues, contact us at: B1010101@helplive.edu.my
        </p>
        Copyright &copy; 2023
    </footer>
    <script src="../sidenav.js"></script>
</body>
</html>