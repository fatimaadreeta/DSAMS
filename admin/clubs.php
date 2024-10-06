<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DSAMS </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="icon" type="image/x-icon" href="../favicon.ico">
        <link rel="stylesheet" type="text/css" href="manageIndex.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="../sidenav.js"></script>
        <link rel="stylesheet" type="text/css" href="../popup.css">
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
            $sql = "SELECT * FROM club";
            $_SESSION['club']= [];

            $result = $connection->query($sql);
            while ( $row =  $result->fetch_assoc() ) {
                $_SESSION['club'][] = $row;
            }

            if(isset($_POST['Remove'])){
                $clubId= $_POST['hiddenId'];
                $submitDate = date('Y-m-d');

                $sql ="DELETE FROM club
                WHERE clubId = '$clubId'";
                if ($connection->query($sql) === TRUE) {
                } else {
                    echo "Error: " . $sql . "<br>" . $connection->error;
                }
                unset($_POST);
                header("Location:clubs.php");
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
                <a onclick="openNav()">
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
                <h1 class="text-center p-3">Clubs List</h1>
                <div class="d-flex m-2 justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-striped table-dark" id="clubtable">
                            <thead>
                                <tr>
                                    <th onclick="sortTable(0)" scope="col"> ID </th>
                                    <th onclick="sortTable(1)" scope="col"> Name </th>
                                    <th onclick="sortTable(2)" scope="col"> Description </th>
                                    <th onclick="sortTable(3)" scope="col"> Club Icon </th>
                                    <th onclick="sortTable(4)" scope="col"> Club Banner</th>
                                    <th scope="col">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($_SESSION['club'] as $index => $arrayRow) {
                                    echo '<tr>';
                                    echo '<td class="tableData">'. $arrayRow['clubId'].'</td>';
                                    echo '<td class="tableData">'. $arrayRow['clubName'] .'</td>';
                                    echo '<td class="tableData">'. $arrayRow['description'] .'</td>';
                                    echo '<td><img src="../Images/Clubs/'.$arrayRow['clubIcon'].'"/></td>';
                                    echo '<td>'. $arrayRow['clubId'] .'</td>';
                                    echo '<td>
                                    <a href="members.php?id='.$arrayRow['clubId'].'">
                                    <button class="btn btn-outline-success"> Members </button>
                                    </a>
                                    <br>
                                    <a href="../club/edit.php?id='.$arrayRow['clubId'].'">
                                    <button class="btn btn-outline-warning"> Edit </button>
                                    </a>
                                    <br>
                                    <a href="../club/page.php?id='.$arrayRow['clubId'].'">
                                    <button class="btn btn-outline-success")>Page 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                        </svg>
                                    </button>
                                    </a>
                                    <br>
                                    <button class="btn btn-outline-danger" onclick="review(\'' .$arrayRow['clubId'].'\',\''. $arrayRow['clubName'] .'\')"> Remove </button>
                                    </td>';
                                    echo '</tr>';
                                }
                                unset($_SESSION['proposals']);
                            ?>
                            </tbody> 
                        </table>
                    </div>
                </div>  
            </div>
        </main>
        <div id="popup" class="align-items-center justify-content-center" onclick="closePopUp()" style="display: none; flex-direction: column;">
            <form class="contact-form d-flex flex-column align-items-center p-3 col-6 col-lg-4 p-4 m-4 bg-customGrey" action="#" method="post" onclick="preventClose(event)">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                </svg>
                <h3 class="col-10" name="message" id="message" style="text-align: center;"> </h3>
                <input type="hidden" value="" id="hiddenId" name="hiddenId">
                <div class="d-flex justify-content-around col-12">
                    <input type="submit" value="Remove" class="btn col-md-4 btn-danger" name="Remove" id="confirmButton">
                    <input type="reset" value="Cancel" class="btn col-md-4 btn-outline-danger" name="Remove" onclick="closePopUp()">
                </div>
            </form>
        </div>
    </body>
    <script src="../popUp.js"></script>
    <script>
        function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("thetable");
        switching = true;
        // Default soritng is ascending:
        dir = "asc";
        // Loop that ends when no more switches are needed
        while (switching) {
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
