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
            $sql = "SELECT * FROM activity";
            $_SESSION['activities']= [];

            $result = $connection->query($sql);
            while ( $row =  $result->fetch_assoc() ) {
                $_SESSION['activities'][] = $row;
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
                <h1 class="text-center p-3">Front Page Activities</h1>
                <div class="d-flex m-2 justify-content-center">
                <form id ='myform' method="post" action="updateIndex.php">
                    <div class="table-responsive">
                        <table class="table table-striped table-dark" id="thetable">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th onclick="sortTable(0)" scope="col"> ID </th>
                                    <th onclick="sortTable(1)" scope="col"> Title </th>
                                    <th onclick="sortTable(2)" scope="col"> Tag </th>
                                    <th onclick="sortTable(3)" scope="col"> Description </th>
                                    <th onclick="sortTable(4)" scope="col"> Student </th>
                                    <th onclick="sortTable(5)" scope="col"> Post Date</th>
                                    <th onclick="sortTable(6)" scope="col"> Club ID</th>
                                    <th scope="col"><button type="submit" class="btn btn-outline-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                                        <path d="M11 2H9v3h2V2Z"/>
                                        <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0ZM1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5Zm3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4v4.5ZM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5V15Z"/>
                                        </svg>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($_SESSION['activities'] as $index => $arrayRow) {
                                    echo '<tr>';
                                    echo '<td> <input name="frontPage[]" value="'. $arrayRow['activityId'].'"';
                                    if($arrayRow['frontPage']== true){
                                        echo 'checked';
                                    }
                                    echo' class="form-check-input" type="checkbox" value=""id="'. $arrayRow['activityId'] .'"></td>';
                                    echo '<td class="tableData">'. $arrayRow['activityId'].'</td>';
                                    echo '<td class="tableData">'. $arrayRow['activityName'] .'</td>';
                                    echo '<td class="tableData">'. $arrayRow['activityTag'] .'</td>';
                                    echo '<td class="tableData">'. $arrayRow['description'] .'</td>';
                                    echo '<td>                                            
                                    <div class="img-wrapper wrap-top">
                                        <img src="../Images/'.$arrayRow['posterImg'].'"/>
                                    </div></td>';
                                    echo '<td>'. date("d/m H:i", strtotime($arrayRow['postDate'])) .'</td>';
                                    echo '<td>'. $arrayRow['clubId'] .'</td>';
                                    echo '<td><a href="../event/edit.php?id='.$arrayRow['activityId'].'"><button 
                                    class="btn btn-outline-success"
                                    type="button"> Edit 
                                    </button></a></td>';
                                    echo '</tr>';
                                }
                                unset($_SESSION['proposals']);
                            ?>
                            </tbody> 
                        </table>
                    </div> 
                </form>      
            </div>
        </main>
    </body>
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('.tableData').css('cursor', 'pointer').click(function() {
                var checkBoxes = $(this).parent('tr').find('input:checkbox')
                checkBoxes.prop("checked", !checkBoxes.prop("checked"));
            });
        })
    </script>
    <script>
    function submitValue(){
        var checkboxs = [];
        var names = [];
        $(':checkbox:checked').each(function(i){
            checkboxs[i] = $(this).val();
            names[i] = $('input[name=name'+(i+1)+']').val();
        });
        console.log(checkboxs);
        console.log(names);
        $('#checkboxs').val(checkboxs);
        $('#names').val(names);
        $('#myform').submit();
    }
    </script>
</html>
