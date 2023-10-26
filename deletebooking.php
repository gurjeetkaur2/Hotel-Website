<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Booking</title>
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

    function cleanInput($data)
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    //check if id exists
    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        $id = $_GET['id'];
        if (empty($id) or !is_numeric($id)) {
            echo "<h2>Invalid booking id</h2>";
            exit;
        }
    }

    if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Delete')) {
        $error = 0;
        $msg = "Error:";

        //we try to convert to number - intval function(return to the integer of a variable)
        if (isset($_POST['id']) and !empty($_POST['id']) and is_integer(intval($_POST['id']))) {
            $id = CleanInput($_POST['id']);
        } else {
            $error++;
            $msg .= 'Invalid booking ID';
            $id = 0;
        }

        if ($error == 0 and $id > 0) {
            $query = "DELETE FROM booking WHERE BookingID=?";
            $stmt = mysqli_prepare($DBC, $query);
            mysqli_stmt_bind_param($stmt, 'i', $id);

            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo "<h5>Booking deleted.</h5>";
        } else {
            echo "<h5>$msg</h5>" . PHP_EOL;
        }
    }


    $query = 'SELECT booking.BookingID, room.roomname, room.roomtype,room.bed, booking.checkin_date, booking.checkout_date, booking.contactNumber FROM `booking`
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
        $id = $row['BookingID'];

        echo "<dt>Room name: </dt><dd>" . $row['roomname'] . "</dd>" . PHP_EOL;
        echo "<dt>Beds: </dt><dd>" . $row['bed'] . "</dd>" . PHP_EOL;
        echo "<dt>roomtype: </dt><dd>" . $row['roomtype'] . "</dd>" . PHP_EOL;

        echo "<dt>CheckIn-Date: </dt><dd>" . $row['checkin_date'] . "</dd>" . PHP_EOL;
        echo "<dt>CheckOut-Date: </dt><dd>" . $row['checkout_date'] . "</dd>" . PHP_EOL;
        echo "<dt>Contact Number: </dt><dd>" . $row['contactNumber'] . "</dd>" . PHP_EOL;
        echo '</dl></fieldset>' . PHP_EOL;


    ?>

        <form class="form_settings" method="POST" action="deletebooking.php">

            <h4>Are you sure you want to delete this booking?</h4>
            <input class="submit" type="hidden" name="id" value="<?php echo $id; ?>">
            <input class="submit" type="submit" name="submit" value="Delete">
            <a href="bookinglisting.php">Cancel</a>

        </form>

    <?php
    } else echo "<h5>No booking found! Possbily deleted!</h5>";
    mysqli_free_result($result);
    mysqli_close($DBC);
    ?>
    <?php
    echo '</div></div>';
    include "footer.php";
    ?>
</body>
<style>
    <?php include "style/style.css"; ?>
</style>
</html>