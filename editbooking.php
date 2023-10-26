<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script>
        //insert datepicker jQuery

        $(document).ready(function() {
            $.datepicker.setDefaults({
                dateFormat: 'yy-mm-dd'
            });
            $(function() {
                checkIn = $("#checkin").datepicker()
                checkOut = $("#checkout").datepicker()

                function getDate(element) {
                    var date;
                    try {
                        date = $.datepicker.parseDate(dateFormat, element.value);
                    } catch (error) {
                        date = null;
                    }
                    return date;
                }
            });
        });
    </script>
</head>

<body>
    <?php
    include "header.php";
    include "menu.php";
    echo '<div id="site_content">';
    include "sidebar.php";


    //take the details about server and database
    include "config.php"; //load in any variables
    $DBC = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);

    //insert DB code from here onwards
    //check if the connection was good
    if (mysqli_connect_errno()) {
        echo "Error: Unable to connect to MySQL. " . mysqli_connect_error();
        exit; //stop processing the page further
    }


    //function to clean input but not validate type and content
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


    //on submit check if empty or not string and is submited by POST
    if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Update')) {

        $room = cleanInput($_POST['rooms']);

        $checkIn = $_POST['checkin'];
        $checkOut = $_POST['checkout'];

        $contact = cleanInput($_POST['contact']);
        $extra = cleanInput($_POST['extra']);
        $review = cleanInput($_POST['review']);
        $id = cleanInput($_POST['id']);


        $upd = "UPDATE `booking` SET roomID=?, checkin_date=?, checkout_date=?, contactNumber=?, booking_extras=?, review=? WHERE BookingID=?";

        $stmt = mysqli_prepare($DBC, $upd); //prepare the query
        mysqli_stmt_bind_param($stmt, 'isssssi', $room, $checkIn, $checkOut, $contact, $extra, $review, $id);

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        //print message
        echo "<h5>Booking updated successfully</h5>";
    }


    $query = 'SELECT booking.BookingID, room.roomID, room.roomname, room.roomtype, room.bed, booking.checkin_date, booking.checkout_date, booking.contactNumber, booking.booking_extras,  booking.review FROM `booking`
INNER JOIN `room` ON booking.roomID=room.roomID WHERE BookingID=' . $id;


    $result = mysqli_query($DBC, $query);
    $rowcount = mysqli_num_rows($result);

    ?>
    <h1>Edit Booking</h1>
    <h2>
        <a href='bookinglisting.php'>[Return to the Booking listing]</a>
        <a href="/assignment2/index.php">[Return to main page]</a>
    </h2>
    <form class="form_settings" method="POST" action="editbooking.php">
        <p>
            <label for="rooms">Rooms:</label>
            <select name="rooms" id="rooms">
                <?php
                if ($rowcount > 0) {
                    $row = mysqli_fetch_assoc($result);
                ?>

                    <option value="<?php echo $row['roomID']; ?>">
                        <?php echo $row['roomname'] . ' '
                            . $row['roomtype'] . ' '
                            . $row['bed'] ?>
                    </option>

                <?php
                } else echo "<option>No rooms found</option>";
                ?>
            </select>
        </p>

        <p>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        </p>

        <br>
        <p>
            <label for="checkin">Checkin Date:</label>
            <input type="text" id="checkin" name="checkin" value="<?php echo $row['checkin_date'] ?>" required>
        </p>

        <br>
        <p>
            <label for="checkout">Checkout Date:</label>
            <input type="text" id="checkout" name="checkout" required value="<?php echo $row['checkout_date'] ?>">
        </p>
        <br>

        <p>
            <label for="contact">Contact Number:</label>
            <input type="text" id="contact" name="contact" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="###-###-####" required value="<?php echo $row['contactNumber'] ?>">
        </p>
        <br>
        <p>
            <label for="extras">Booking Extras:</label>
            <textarea name="extra" id="extra" cols="35" rows="5" value="<?php echo $row['booking_extras'] ?>"></textarea>
        </p>

        <br>
        <p>
            <label for="review">Review:</label>
            <textarea name="review" id="review" value="<?php echo $row['review'] ?>" cols="35" rows="5"></textarea>
        </p>

        <br>
        <p>
            <input type="submit" class="submit" name="submit" value="Update">
        </p>

    </form>
    <?php
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