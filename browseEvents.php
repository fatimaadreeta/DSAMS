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
<body class="bg-grey">
    <nav class="navbar navbar-expand-lg"> 
    <div class="container-fluid">
        <a class="logo" href="index.php"><img src="logo.png"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse  justify-content-end" id="navbarTogglerDemo01">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="button" href="submitProposal.php">Start a new Event</a>
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
                        <a class="invert button" href="

                        dashboard/home.php
                        
                        ">
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
        <div  class="container">
            <h1 class="title">Ongoing Events</h1>
            <div  class="row">
                <div class="col-12 col-lg-2">
                    <form class="form" method="GET" action="browseEvents.php">
                        <div class="row">
                            <div class="col g-0">
                                <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="search"
                                    value=
                                    <?php
                                        $search="";
                                        if(isset($_GET['search'])){
                                            $search = $_GET['search'];
                                        }
                                        echo $search;
                                    ?>
                                >
                            </div>
                            <div class="col-auto g-0">
                                <button class="btn btn-danger" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="row">
                        <?php
                            $search="";
                            if(isset($_GET['search'])){
                                $search = $_GET['search'];
                            }
                            $sql = "SELECT * FROM activity WHERE activityName LIKE '%".$search."%' 
                            AND activityTag = 'EVENT' And frontPage = 1";
                            unset($search);
                            $result = $connection->query($sql);
                            if(!isset($result)){
                                //no clubs found?
                            }
                            else{
                                $clubArray = [];
                                while($row = $result->fetch_assoc()){
                                    $clubArray[] =  $row;
                                }
                                foreach($clubArray as $index => $arrayRow){
                                    echo '<div class="col-12 col-md-6 col-lg-4">
                                        <div class="article">
                                            <a href="event/events.php?id='.$arrayRow['activityId'].'"/>
                                            <div class="img-wrapper" alt="">
                                            <img src="Images/'.urlencode($arrayRow['posterImg']).'" width="100px" height="250px"/>
                                            </div>';
                                    echo '<div class="article-text">
                                    <div class="article-tag">
                                        '. $arrayRow['activityTag'] .'
                                        </div>';
                                    echo '<div class="article-title">
                                            '. $arrayRow['activityName'] .'
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
        </div>
    </main>
</body>
</html>
