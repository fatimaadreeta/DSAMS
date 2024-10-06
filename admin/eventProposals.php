<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DSAMS </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="icon" type="image/x-icon" href="../favicon.ico">
        <link rel="stylesheet" type="text/css" href="../popup.css">
        <script src="../sidenav.js"></script>
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
            $sql = "SELECT proposalId, campus, category, type, title, startDate, venue, c.clubName, className, personInCharge,
            p.studentId, s.name, status, comment, submitDate, proposalFile, activityId
            FROM proposal AS p
            LEFT JOIN student AS s ON p.studentId=s.studentId 
            LEFT JOIN club AS c ON p.clubId=c.clubId
            WHERE reasoning IS NULL";
            $_SESSION['proposals']= [];

            $result = $connection->query($sql);
            while ( $row =  $result->fetch_assoc() ) {
                $_SESSION['proposals'][] = $row;
            }
        ?>
    </head>
    <body>
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
               <div class="container">
                <h1 class="text-center p-3">Event Proposals</h1>
                <div class="d-flex m-2 justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-striped table-dark" id="thetable">
                            <thead>
                                <tr>
                                    <th onclick="sortTable(0)" scope="col"> Campus/
                                    ID </th>
                                    <th onclick="sortTable(1)" scope="col"> Category/
                                    Type</th>
                                    <th onclick="sortTable(2)" scope="col"> Event Name</th>
                                    <th onclick="sortTable(3)" scope="col"> Start Date</th>
                                    <th onclick="sortTable(4)" scope="col"> Venue</th>
                                    <th onclick="sortTable(5)" scope="col"> Club Name </th>
                                    <th onclick="sortTable(6)" scope="col"> Class Name </th>
                                    <th onclick="sortTable(7)" scope="col"> People In Charge </th>
                                    <th onclick="sortTable(8)" scope="col"> Submitted By </th>
                                    <th onclick="sortTable(9)" scope="col"> Submit Date </th>
                                    <th onclick="sortTable(10)" scope="col"> Status </th>
                                    <th onclick="sortTable(11)" scope="col"> Comment </th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($_SESSION['proposals'] as $index => $arrayRow) {
                                        echo '<tr>';
                                        echo '<td>'.$arrayRow['campus'] .'<br>'. $arrayRow['proposalId'] .'</td>';
                                        echo '<td>'. $arrayRow['category'].'<br>' . $arrayRow['type'] .'</td>';
                                        echo '<td>'. $arrayRow['title'] .'</td>';
                                        echo '<td>'. date("d/m H:i", strtotime($arrayRow['startDate'])) .'</td>';
                                        echo '<td>'. $arrayRow['venue'] .'</td>';
                                        echo '<td>'. $arrayRow['clubName'] .'</td>';
                                        echo '<td>'. $arrayRow['className'] .'</td>';
                                        echo '<td>'. $arrayRow['personInCharge'] .'</td>';
                                        echo '<td>'. $arrayRow['name'] .' ('.$arrayRow['studentId'].')</td>';
                                        echo '<td>'. date("d/m", strtotime($arrayRow['submitDate'])) .'</td>';
                                        echo '<td>'. $arrayRow['status'] .'</td>';
                                        echo '<td>'. htmlspecialchars($arrayRow['comment'], ENT_QUOTES).'</td>';
                                        echo '<td>';
                                        switch($arrayRow['status']){
                                            case "Pending":
                                                echo '<button class="btn btn-outline-warning" 
                                                onclick="review(\'' .$arrayRow['proposalId'].'\',\'../Proposals/'.$arrayRow['proposalFile'].'\')"> 
                                                Review </button>';
                                                break;
                                            case "Published":
                                                echo '<a href="../event/edit.php?id='.$arrayRow['activityId'].'"><button 
                                                class="btn btn-outline-success"
                                                type="button"> Edit 
                                                </button></a>';
                                                echo '<button class="btn btn-outline-success"
                                                onclick="view(\'' . htmlspecialchars($arrayRow['comment'], ENT_QUOTES).'\',\'../Proposals/'.$arrayRow['proposalFile'].'\')"> 
                                                View </button>';
                                                break;
                                            case "Approved":
                                            case "Rejected":
                                                echo '<button class="btn btn-outline-success"
                                                onclick="view(\'' . htmlspecialchars($arrayRow['comment'], ENT_QUOTES).'\',\'../Proposals/'.$arrayRow['proposalFile'].'\')"> 
                                                View </button>';
                                                break;
                                            default: echo '';
                                        }
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                    unset($_SESSION['proposals']);
                                ?>
                            </tbody>
                        </table>
                </div>       
            </div>
            <div id="popup" class="align-items-center justify-content-center" onclick="closePopUp()" style="display: none; flex-direction: column;">
                <iframe id="file-viewer"class="preview col-10 col-lg-8" src=""></iframe>
                <form class="contact-form d-flex flex-column p-3 col-10 col-lg-8 bg-customGrey" action="proposalReview.php" method="post" onclick="preventClose(event)">
                    <div class="form-group">    
                        <label for="comment"> Comments: </label>
                        <textarea type="text" name="comment" id="comment" class="form-control"
                        rows="4"  placeholder="Comment on your decision" required></textarea>
                    </div>
                    <input type="hidden" value="" id="hiddenId" name="hiddenId">
                    <input type="hidden" value="event" id="proposal" name="proposal">
                    <div class="justify-content-around" id="approvalButtons"  style="display:flex;">
                        <input type="submit" value="Approved" class="btn col-3 btn-success" name="approval">
                        <input type="submit" value="Rejected" class="btn col-3 btn-danger" name="approval">
                    </div>
                </form>
            </div>
        </main>
    </body>
    <script src="proposals.js"></script>
    <script>
        function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("thetable");
        switching = true;
        // Set the sorting direction to ascending:
        dir = "asc";
        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /* Loop through all table rows (except the
            first, which contains table headers): */
            for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /* Check if the two rows should switch place,
            based on the direction, asc or desc: */
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                // If so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                // If so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
                }
            }
            }
            if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            // Each time a switch is done, increase this count by 1:
            switchcount ++;
            } else {
            /* If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again. */
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
            }
        }
        }
    </script>
</html>