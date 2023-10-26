<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Browse Booking</title>
</head>

<body>
    <?php
    include "header.php";
    include "menu.php";
    echo '<div id="site_content">';
    include "sidebar.php";


    include "checksession.php";
    include "config.php";
    $DBS = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);

    if (mysqli_connect_errno()) {
        echo "Error:Unable to connect MySql." . mysqli_connect_error();
        exit; //stop processing the page further.
    }
    //prepare a query and send it to the server

    $query = 'SELECT BookingID, roomID, checkin_date, checkout_date  FROM booking ORDER BY roomID';
    $result = mysqli_query($DBS, $query);
    $rowcount = mysqli_num_rows($result);
    ?>

    

    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']  == 1) { ?>
        <h1>Current Booking</h1>
        <h2>
            <a href="bookroom.php">[Book a Room]</a>
            <a href="/assignment2/index.php">[Return to main page]</a>
        </h2>

        <table border="1">
            <thead>
                <tr>
                    <th>Booking(room, checkin & checkout dates)</th>
                    <th>Action</th>
                </tr>
            </thead>

            <?php
            if ($rowcount > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['BookingID'];
                    $ro = $row['roomID'];
                    $sql = 'SELECT roomID, roomname, roomtype, bed FROM `room` WHERE roomID =' . $ro;
                    $res = mysqli_query($DBS, $sql);
                    $rowc = mysqli_num_rows($res);

                    if ($rowc > 0) {
                        $rowr = mysqli_fetch_assoc($res);
                    }

                    echo '<tr><td>' . $rowr['roomname'] . ',' . $row['checkin_date'] . ',' . $row['checkout_date'] . '</td>';
                    echo '<td><a href="bookingdetails.php?id=' . $id . '">[view]</a>';
                    echo '<a href="editbooking.php?id=' . $id . '">[edit]</a>';
                    echo '<a href="editreviews.php?id=' . $id . '">[manage reviews]</a>';
                    echo '<a href="deletebooking.php?id=' . $id . '">[delete]</a> </td>';

                    echo '</tr>' . PHP_EOL;

                    mysqli_free_result($res);
                }
            } else echo "<h2>NO bookings found!</h2>";

            mysqli_free_result($result); //this query will free memory from used query 
            mysqli_close($DBS);
            ?>

        </table>
    <?php }  ?>
    <?php
    echo '</div></div>';
    include "footer.php";
    ?>
</body>

<style>
    <?php include "style/style.css"; ?>
</style>

</html>