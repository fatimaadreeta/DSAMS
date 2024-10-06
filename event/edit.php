<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DSAMS </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <div class="smallnav">
            <a href='#' onclick="history.back()">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="35" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            </a>
        </div>
        <main>
            <h1 class="text-center p-3">Event Details</h1>
            <div class="container d-flex justify-content-center">
                <div class="d-flex bg-light col-9 p-4">
                    <?php
                       include_once '../database.php';
                       session_start();
                       $id = $_GET['id'];
                       $sql= "SELECT * FROM activity WHERE activityId = '$id'";
                       $result = $connection->query($sql)->fetch_assoc();
                       if(!isset($result)){
                        echo 'activity not found';
                        exit();
                       }

                       echo '
                       <form action="editProcess.php" class="d-flex flex-column col-12" method="POST" enctype="multipart/form-data">
                            <input type="hidden" value="'.$id.'" id="activityId" name="activityId">
                            <input type="hidden" value="'.$result['posterImg'].'" id="oldImg" name="oldImg">
                            <div class="form-group">
                                <label for="title"> Event Title </label>
                                <input type="text" name="title" id="title" class="form-control" value="'.$result['activityName'].'">
                            </div>
                            <div class="form-group">
                                <label for="venue"> Venue </label>
                                <input type="text" name="venue" id="venue" class="form-control" value="'.$result['venue'].'">
                            </div>
                            <div class="form-group">
                                <label for="Time"> Time </label>
                                <input type="text" name="Time" id="Time" class="form-control" value="'.$result['Time'].'">
                            </div>
                            <div class="form-group">
                                <label for="startDate" name="startDate" >Start Date: </label>
                                <input type="date" name="startDate" id="startDate" class="form-control" value="'. date("Y-m-d", strtotime($result['startDate'])).'">
                            </div>
                            <div class="form-group">
                                <label for="description"> Description </label>
                                <textarea type="text" name="description" id="description" class="form-control" 
                                rows="3" 
                                placeholder="'.$result['description'].'"
                                required>'.$result['description'].'</textarea>
                            </div>
                            <div class="form-group">
                                <label> Poster Image </label> 
                                <div class="img-wrapper wrap-top">
                                    <img
                                        id="preview-image"
                                        src="../Images/'.$result['posterImg'].'"
                                    />
                                </div>
                                <input class="form-control" type="file" name="posterImg" id="posterImg" accept="image/*">
                            </div>
                            <br>
                            <input type="submit" name = "submit" value="Save" class="btn align-self-center w-50">
                        </form>';
                    ?>
            </div>  
        </main>
    </body>
    <script src="previewImage.js"></script>

</html>
