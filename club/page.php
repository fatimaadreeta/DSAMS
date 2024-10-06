<?php 
session_start();
$joined = FALSE;
if(!isset($_SESSION['position'])){
    $_SESSION['loginError'] = 1;
    header("Location: ../login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DSAMS Club</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="page.css">
     <link rel="icon" type="image/x-icon" href="../favicon.ico">
</head>
    <body>
        <nav class="navbar"> 
            <a class="logo mx-3" href="../index.php" title="Home page"><img src="../logo.png" alt="Logo"></a>
        </nav>
        <main>
            <div class="container">
                <?php
                    include_once '../database.php';
                    $clubId = $_GET['id'];
                    $sql = "SELECT * FROM club WHERE clubId = '$clubId'";
                    $result = $connection->query($sql)->fetch_assoc();
                    if(!isset($result)){
                        echo "<h1>Invalid Club Id</h1>";
                        //if club not found from ID in url
                    }
                    else{
                        $_SESSION['clubId']=$clubId;
                        if(empty($result['clubBanner'])){
                            echo '<div id="cover-img" style="height: 130px;">
                                <img src="../Images/Clubs/'.$result['clubIcon'].'" id="logo-img-raised">
                            </div>';
                        }
                        else
                        {
                            echo '<div id="cover-img" style="background-image: url(../Images/Clubs/'.$result['clubBanner'].');">
                                <img src="../Images/Clubs/'.$result['clubIcon'].'" id="logo-img">
                            </div>';
                        }

                    }
                ?>
                <div class="row">
                    <div class="col-12 col-md-3 col-lg-3 col-xl-2">
                        <br>
                    </div>
                    <div class="col-9 col-md-6 col-lg-6 col-xl-7">
                    <?php
                            if(!isset($result)){
                                //header("Location:index.php");
                                //if club not found from ID in url
                            }
                            else{
                                echo "<h2 class='clubName'>".$result['clubName']."</h2>";
                            }
                        ?>
                    </div>
                    <div class="col-3">
                        <form method="post" action="page.php?id=<?php echo $clubId;?>">
                            <div class="row justify-content-end">
                                <div class="col-9 col-md-6 p-3">
                                    <a href="gallery.php" class="btn btn-outline-success joinBtn">Gallery</a>
                                </div>
                                <div class="col-9 col-md-6 p-3">
                                    <?php 
                                    $username = $_SESSION['loggedIn'];
                                    $q = "SELECT * FROM clubroles where studentId = '$username' and clubId = '$clubId'";
                                    $r = mysqli_query($connection, $q);
                                    $joined = FALSE;
                                    
                                    if(mysqli_num_rows($r) <= 0){
                                        if(isset($_POST['submit'])){
                                        $today = date("Y-m-d");
                                        $q = "INSERT INTO clubroles(clubId, studentId, position, joinDate) VALUES('$clubId', '$username', 'Member', '$today');";
                                        $r = mysqli_query($connection, $q);
                                        header("Location:page.php?id=".$clubId);
                                    }
                                    }
                                    else{
                                        $joined = TRUE;
                                    }
                                    ?>
                                    <?php 
                                    if($joined){
                                        echo '<button type="submit" class="btn btn-outline-success joinBtn" disabled name="submit">Joined</button>';
                                    }
                                    else{
                                        echo '<button type="submit" class="btn btn-outline-success joinBtn" name="submit">Join</button>';
                                    }
                                    ?>
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">

                        <div class="descBox">
                            <?php
                                if(!isset($result)){
                                    //header("Location:index.php");
                                    //if club not found from ID in url
                                }
                                else{
                                    echo $result['description'];
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-8">
                        <div class="row">
                            <?php
                                $clubId = $_GET['id'];
                                
                                $sql = "SELECT * FROM activity WHERE clubId = '$clubId' ORDER BY postDate DESC";
                                $result = $connection->query($sql);
                                if(!isset($result)){
                                    //if club has no activities just leave it blank
                                }
                                else{
                                    $activityArray = [];
                                    while($row = $result->fetch_assoc()){
                                        $activityArray[] =  $row;
                                    }
                                    foreach($activityArray as $index => $arrayRow){
                                        echo '
                                        <div class="col-12 col-lg-6">
                                            <div class="article">
                                                <a href="../event/events.php?id='.$arrayRow['activityId'].'"/>
                                                <div class="img-wrapper wrap-top">
                                                <img src="../Images/'.$arrayRow['posterImg'].'" height="250px" width="100px"/>
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
                                        echo '<div class="article-date">
                                            '. date("d M Y", strtotime($arrayRow['postDate'])) .'
                                            </div>';
                                        echo '</div>
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
        <footer>
            <p>If there are any issues, contact us at: B1010101@helplive.edu.my
            </p>
            Copyright &copy; 2023
        </footer>
    </body>
</html>
