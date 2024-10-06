<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DSAMS </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="clubProposalForm.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
    <body>
        <nav class="navbar"> 
            <div class="container-fluid">
                <a class="logo" href="index.php"><img src="logo.png"></a>
            </div>
        </nav>
        <main>
            <h1 class="text-center p-3">Club Proposal Form</h1>
    
            <div class="container d-flex justify-content-center">
                <div class="d-flex bg-light col-9 p-4">
                    <form  class="d-flex flex-column col-12" action="clubProposalAdd.php" method="POST">
                        <div class="form-group">
                            <label for="clubName"> Club Name </label>
                            <input type="text" name="clubName" id="clubName" class="form-control"
                            placeholder="Enter Your New Club's Name" required>
                        </div>
                        <div class="form-group">
                            <label for="description"> Description </label>
                            <textarea type="text" name="description" id="description" class="form-control"
                            rows="3" placeholder="Write a brief description of the club and the events it will hold" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="reasoning"> Reasoning </label>
                            <textarea type="text" name="reasoning" id="reasoning" class="form-control"
                            rows="3"  placeholder="Enter a justification to start this club" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="president"> President Details</label>
                            <input type="text" name="personInCharge" id="personInCharge" class="form-control"
                            placeholder="Enter Your New Club President's Name and Student ID" required>
                        </div>
                        <br>
                        <input type="submit" value="Submit" class="btn align-self-center w-50">
                    </form>

            </div>  
        </main>
    </body>
</html>
