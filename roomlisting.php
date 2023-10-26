<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Rooms</title>
</head>

<body>
    <?php
    include "header.php";
    include "menu.php";
    echo '<div id="site_content">';
    include "sidebar.php";

    echo '<div id="content">';

    include "checksession.php";
    include "config.php"; //load in any variables
    $DBC = mysqli_connect("127.0.0.1", DBUSER, DBPASSWORD, DBDATABASE);

    //insert DB code from here onwards
    //check if the connection was good
    if (mysqli_connect_errno()) {
        echo "Error: Unable to connect to MySQL. " . mysqli_connect_error();
        exit; //stop processing the page further
    }

    //prepare a query and send it to the server
    $query = 'SELECT roomID,roomname,roomtype FROM room ORDER BY roomtype';
    $result = mysqli_query($DBC, $query);
    $rowcount = mysqli_num_rows($result);
    ?>
    <h1>Room list</h1>
<h2>
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']  == 1) { ?>
        <a href='addroom.php'>[Add a room]</a>

<?php } ?>
</h2>
        <h2>
            <a href="/assignment2/index.php">[Return to main page]</a>
        </h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Room Name</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>

            <?php

            //makes sure we have rooms
            if ($rowcount > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['roomID'];
                    echo '<tr><td>' . $row['roomname'] . '</td><td>' . $row['roomtype'] . '</td>';
                    echo     '<td><a href="viewroom.php?id=' . $id . '">[view]</a>';
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']  == 1) {
                    echo         '<a href="editroom.php?id=' . $id . '">[edit]</a>';
                    echo         '<a href="deleteroom.php?id=' . $id . '">[delete]</a></td>';
                    }
                    echo '</tr>' . PHP_EOL;
                }
            } else echo "<h2>No rooms found!</h2>"; //suitable feedback
            echo "</table>";
            mysqli_free_result($result); //free any memory used by the query
            mysqli_close($DBC); //close the connection once done
            ?>

        <?php 
    echo '</div></div>';
    require_once "footer.php";
        ?>
</body>
<style>
    <?php include "style/style.css"; ?>
</style>
</html>