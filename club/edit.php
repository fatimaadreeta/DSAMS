<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DSAMS </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../clubProposalForm.css">
        <link rel="icon" type="image/x-icon" href="../favicon.ico">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg"> 
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
            }else if (!empty($_SESSION['position'][$_GET['id']] == "Member")){
                echo "<h1>You do not have permission to view this page</h1>";
                exit();
            }else if (!empty(array_search($_SESSION['position'][$_GET['id']],$hierarchy))){
                //searches if Hiearchy value matches the value gotten from the position value of $_SESSION['position'][clubId]
                //login success as user
                $position = $_SESSION['position'][$_GET['id']];
            } else{
                header("Location: ../index.php");
                exit();
            }

            $student = $_SESSION['loggedIn'];
            $clubId = $_GET['id'];

            if(isset($_POST['clubId'])){
                $clubId = $_POST['clubId'];
                //double-checks if user has rights to modify club
                $sql = "SELECT c.clubName, c.description, c.clubIcon, c.clubBanner FROM club c 
                INNER JOIN clubRoles r 
                ON c.clubId = r.clubId
                WHERE r.position IN ('President', 'Vice President', 'Committee') AND r.studentId = '$student' AND r.clubId = '$clubId'";
                if(empty($connection-> query($sql))){
                    exit();
                }

                $clubName = $_POST['clubName'];
                $description = $_POST['description'];

                $old_icon = $_POST['oldIcon'];
                $old_banner = $_POST['oldBanner'];

                if($_FILES['clubIcon']['size'] != 0){
                    $file_name = $_FILES['clubIcon']['name'];
                    $file_tmp = $_FILES['clubIcon']['tmp_name'];
                    $new_icon= $clubId.'Icon.'.pathinfo($file_name)['extension'];
                    if(!empty($old_icon)){
                        rename("../Images/Clubs/".$old_icon, "../Images/Clubs/".$new_icon);
                    }
                    move_uploaded_file($file_tmp, "../Images/Clubs/".$new_icon);
                }else{
                    $new_icon = $old_icon;
                }

                if($_FILES['clubBanner']['size'] != 0){
                    $file_name = $_FILES['clubBanner']['name'];
                    $file_tmp = $_FILES['clubBanner']['tmp_name'];
                    $new_banner = $clubId.'Banner.'.pathinfo($file_name)['extension'];
                    if(!empty($old_banner)){
                        rename("../Images/Clubs/".$old_banner, "../Images/Clubs/".$new_banner);
                    }
                    move_uploaded_file($file_tmp, "../Images/Clubs/".$new_banner);
                }else{
                    $new_banner = $old_banner;
                }


                $sql = "UPDATE club SET clubName= '$clubName', description= '$description', clubIcon= '$new_icon', clubBanner= '$new_banner'
                WHERE clubId = '$clubId'";
                if ($connection->query($sql) === TRUE) {
                    echo "Updated successfuly";
                } else {
                    echo "Error: " . $sql . "<br>" . $connection->error;
                }
                header("Location:edit.php?id=".$clubId);
            }
        ?>
        <div class="smallnav">
            <a href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="35" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            </a>
        </div>
        <main>
            <h1 class="text-center p-3">Club Details</h1>
            <div class="container d-flex justify-content-center">
                <div class="d-flex bg-light col-9 p-4">
                    <?php                       
                       $sql= "SELECT * FROM club WHERE clubId = '$clubId'";
                       $club= [];
                       $result = $connection->query($sql)->fetch_assoc();
                       echo '
                       <form  class="d-flex flex-column col-12" action="edit.php?id='.$clubId.'" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="clubId" id="clubId" class="form-control" value="'.$result['clubId'].'">
                            <input type="hidden" value="'.$result['clubIcon'].'" id="oldIcon" name="oldIcon">
                            <input type="hidden" value="'.$result['clubBanner'].'" id="oldBanner" name="oldBanner">
                            <div class="form-group">
                                <label for="clubName"> Club Name </label> 
                                <input type="text" name="clubName" id="clubName" class="form-control" value="'.$result['clubName'].'">
                            </div>
                            <div class="form-group">
                                <label for="description"> Description </label>
                                <textarea type="text" name="description" id="description" class="form-control" 
                                rows="6" 
                                placeholder="'.$result['description'].'"
                                required>'.$result['description'].'</textarea>
                            </div>
                            <div class="form-group">
                                <label for="clubIcon"> Club Icon </label> 
                                <div class="img-wrapper wrap-top">
                                    <img src="../Images/Clubs/'.$result['clubIcon'].'">
                                </div>
                                <input class="form-control" type="file" name="clubIcon" id="clubIcon" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="clubBanner"> Club Banner </label>
                                <div class="img-wrapper wrap-top">
                                    <img src="../Images/Clubs/'.$result['clubBanner'].'">
                                </div>
                                <input class="form-control" type="file" name="clubBanner" id="clubBanner" accept="image/*">
                            </div>
                            <br>
                            <input type="submit" value="Submit" class="btn align-self-center w-50">
                        </form>';
                    ?>
            </div>  
        </main>
    </body>
</html>
