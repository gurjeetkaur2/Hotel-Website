<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Booking Details</title>
</head>

<body>
    <?php
    include "header.php";
    include "menu.php";
    echo '<div id="site_content">';
    include "sidebar.php";



    include "config.php";
    $DBC = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);

    if (mysqli_connect_errno()) {
        echo "Error:Unable to connect to MySql." . mysqli_connect_error();
        exit; //stop processing the page further.
    }

    //check if id exists
    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        $id = $_GET['id'];
        if (empty($id) or !is_numeric($id)) {
            echo "<h2>Invalid booking id</h2>";
            exit;
        }
    }


    $query = 'SELECT booking.BookingID, room.roomname, room.roomtype,room.bed, booking.checkin_date, booking.checkout_date, booking.contactNumber, booking.booking_extras, booking.review FROM `booking`
INNER JOIN `room` ON booking.roomID=room.roomID WHERE BookingID=' . $id;

    $result = mysqli_query($DBC, $query);
    $rowcount = mysqli_num_rows($result);
    ?>

    <!-- We can add a menu bar here to go back -->
    <h1>Booking Details View</h1>
    <h2><a href="bookinglisting.php">[Return to the booking listing]</a>
        <a href="/assignment2/index.php">[Return to the main page]</a>
    </h2>
    <?php
    if ($rowcount > 0) {
        echo "<fieldset><legend>Booking Detail #$id</legend><dl>";
        $row = mysqli_fetch_assoc($result);


        echo "<dt>Room name: </dt><dd>" . $row['roomname'] . "</dd>" . PHP_EOL;
        echo "<dt>Beds: </dt><dd>" . $row['bed'] . "</dd>" . PHP_EOL;
        echo "<dt>roomtype: </dt><dd>" . $row['roomtype'] . "</dd>" . PHP_EOL;

        echo "<dt>CheckIn-Date: </dt><dd>" . $row['checkin_date'] . "</dd>" . PHP_EOL;
        echo "<dt>CheckOut-Date: </dt><dd>" . $row['checkout_date'] . "</dd>" . PHP_EOL;
        echo "<dt>Contact Number: </dt><dd>" . $row['contactNumber'] . "</dd>" . PHP_EOL;
        echo "<dt>Booking Extras: </dt><dd>" . $row['booking_extras'] . "</dd>" . PHP_EOL;
        echo "<dt>Review: </dt><dd>" . $row['review'] . "</dd>" . PHP_EOL;
        echo '</dl></fieldset>' . PHP_EOL;
    } else echo "<h5>No booking found! Possbily deleted!</h5>";
    mysqli_free_result($result);
    mysqli_close($DBC);
    echo '</div></div>';
    include "footer.php";
    ?>


</body>
<style>
    <?php include "style/style.css"; ?>
</style>
</html>