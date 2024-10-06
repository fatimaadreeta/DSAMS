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
                <a class="logo" href="index.php"><img src="../logo.png"></a>
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
                       include_once '../database.php';
                       session_start();
                       if(!isset($_POST['proposalId'])){
                        echo 'proposal not found';
                        exit();
                       }
                       $propId = $_POST['proposalId'];
                       
                       //$sql = "SELECT c.clubName, c.description, c.clubIcon, c.clubBanner FROM club c INNER JOIN clubRoles r ON c.clubId=r.clubId";
                       $sql= "SELECT * FROM proposal WHERE proposalId = '$propId'";
                       $result = $connection->query($sql)->fetch_assoc();
                       if($result['status'] != 'Approved'){
                        exit();
                       }
                       echo '
                       <form action="publishProcess.php" class="d-flex flex-column col-12" method="POST" enctype="multipart/form-data">
                            <input type="hidden" value="'.$propId.'" id="hiddenId" name="hiddenId">
                            <div class="form-group">
                                <label for="title"> Club Name </label>
                                <input type="text" name="title" id="title" class="form-control" value="'.$result['title'].'">
                            </div>
                            <div class="form-group">
                                <label for="description"> Description </label>
                                <textarea type="text" name="description" id="description" class="form-control" 
                                rows="3" 
                                placeholder="'.$result['description'].'"
                                required>'.$result['description'].'</textarea>
                            </div>
                            <div class="form-group">
                                <label for="posterImg"> Club Icon </label> 
                                <div class="img-wrapper wrap-top">
                                    <img
                                        id="preview-image"
                                        src=""
                                    />
                                </div>
                                <input class="form-control" type="file" name="posterImg" id="posterImg" accept="image/*">
                            </div>
                            <br>
                            <input type="submit" value="Submit" class="btn align-self-center w-50">
                        </form>';
                    ?>
            </div>  
        </main>
    </body>
    <script src="previewImage.js"></script>

</html>
