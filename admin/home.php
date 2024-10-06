<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <title>DSAMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../index.css">
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
</head>
<body>
    <?php
        include_once '../database.php';
        session_start();
        if(!isset($_SESSION['position'])){
            $_SESSION['loginError'] = 1;
            header("Location: ../login.php");
        } else if(empty(array_search("Admin",$_SESSION['position']))){
            header("Location: ../404.php");
            exit();
        }
    ?>
    <nav class="navbar navbar-expand-lg fixed-top"> 
        <div class="container-fluid">
            <a class="logo" href="../index.php"><img src="../logo.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
    <main id="mainMargin">    
        <div id="mySidenav" class="sidenav" style="width :50px;">
            <a onclick="openNav()" nav-expanded="false">
            <i class="bi bi-list"  style="font-size: 1.5rem;"></i>
            </a>
            <a href="home.php"><i class="bi bi-house-door" style="font-size: 1.5rem;"></i>Home</a>
            <a href="eventProposals.php"><i class="bi bi-calendar-event"  style="font-size: 1.5rem;"></i>Event Proposals</a>
            <a href="manageIndex.php"><i class="bi bi-newspaper"  style="font-size: 1.5rem;"></i>Front Page</a>
            <a href="clubs.php"><i class="bi bi-globe2"  style="font-size: 1.5rem;"></i>Clubs</a>
            <a href="clubProposals.php"><i class="bi bi-collection"  style="font-size: 1.5rem;"></i>Club Proposals</a>
            <a href="#"><i class="bi bi-headset"  style="font-size: 1.5rem;"></i>Contact</a>
            
        </div>  
        <div class="justify-content-center container my-2 col-8 col-md-10">
            <div class="row">
                <a href = "eventProposals.php" class="card text-center border-dark mb-2 col-12 col-sm-6 col-lg-4">
                <i class="bi bi-calendar-event-fill" style="font-size: 7rem; height:150px;"></i>
                <div class="card-body">
                    <h5>Review Event Proposals</h5>
                    <h5 class="card-title">Pending: 
                        <?php 
                            $sql = "SELECT COUNT(*) AS count
                            FROM proposal
                            WHERE reasoning IS NULL";

                            $result = $connection->query($sql);
                            $row = $result -> fetch_assoc();
                            echo $row['count'];
                        ?>
                    </h5>
                </div>
                </a>
                <a href = "manageIndex.php" class="card text-center border-dark mb-2 col-12 col-sm-6 col-lg-4">
                <i class="bi bi-newspaper"  style="font-size: 7rem; height:150px;"></i>
                <div class="card-body">
                    <h5>Manage Front Page</h5>
                    <h5 class="card-title">Expired Events:
                        <?php 
                            $sql = "SELECT COUNT(*) AS count
                            FROM activity
                            WHERE startDate IS NOT NULL && startDate < CURRENT_DATE() && frontPage = 1";

                            $result = $connection->query($sql);
                            $row = $result -> fetch_assoc();
                            echo $row['count'];
                        ?>
                    </h5>
                </div>
                </a>
                <a href = "clubs.php" class="card text-center border-dark mb-2 col-12 col-sm-6 col-lg-4">
                <i class="bi bi-globe2"  style="font-size: 7rem; height:150px;"></i>
                <div class="card-body">
                    <h5>Manage Clubs</h5>
                    <h5 class="card-title">Total Clubs:
                        <?php 
                            $sql = "SELECT COUNT(*) AS count
                            FROM club";

                            $result = $connection->query($sql);
                            $row = $result -> fetch_assoc();
                            echo $row['count'];
                        ?>
                    </h5>
                </div>
                </a>
                <a href = "clubProposals.php" class="card text-center border-dark mb-2 col-12 col-sm-6 col-lg-4">
                <i class="bi bi-calendar-event"  style="font-size: 7rem; height:150px;"></i>
                <div class="card-body">
                    <h5>Review Club Proposals</h5>
                    <h5 class="card-title">Pending Proposals:
                        <?php 
                            $sql = "SELECT COUNT(*) AS count
                            FROM proposal
                            WHERE reasoning IS NOT NULL";

                            $result = $connection->query($sql);
                            $row = $result -> fetch_assoc();
                            echo $row['count'];
                        ?>
                    </h5>
                </div>
                </a>
                <a href = "#" class="card text-center border-dark mb-2 col-12 col-lg-4">
                <i class="bi bi-collection"  style="font-size: 7rem; height:150px;"></i>
                <div class="card-body">
                    <h5>Past Proposals</h5>
                    <h5 class="card-title">Total:
                        <?php 
                            $sql = "SELECT COUNT(*) AS count
                            FROM proposal";

                            $result = $connection->query($sql);
                            $row = $result -> fetch_assoc();
                            echo $row['count'];
                        ?>
                    </h5>
                </div>
                </a>
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