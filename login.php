<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

    <?php
    include "header.php";
    include "menu.php";
    echo '<div id="site_content">';
    include "sidebar.php";


    include "checksession.php";
    //simple logout
    if (isset($_POST['logout'])) logout();


    if (isset($_POST['login']) and !empty($_POST['login']) and ($_POST['login'] == 'Login')) {
        include "config.php"; //this will load variables
        $DBC = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE) or die();

        //validating incoming data
        $error = 0; //clear our error 
        $msg = 'Error: ';

        if (isset($_POST['username']) and !empty($_POST['username']) and is_string($_POST['username'])) {

            $un = htmlspecialchars(stripslashes(trim($_POST['username'])));
            $username = (strlen($un) > 32) ? substr($un, 1, 32) : $un; //this will check length and clip if too big 

        } else {
            $error++; //bump the error 
            $msg .= 'Invalid username '; //append error message
            $username = '';
        }


        $password = trim($_POST['password']);


        if ($error == 0) {
            $query = "SELECT customerID, password FROM `customer` WHERE email = '$username' 
				AND password = '$password'";

            $result = mysqli_query($DBC, $query);

            if (mysqli_num_rows($result) == 1) { //found the user
                $row = mysqli_fetch_assoc($result);
                mysqli_free_result($result);
                mysqli_close($DBC);

                if ($password === $row['password'])


                    login($row['customerID'], $username);
            }
            echo "<h6>Login fail</h6>" . PHP_EOL;
        } else {
            echo "<h6>$msg</h6>" . PHP_EOL;
        }
    }
    ?>


    <h1>Login</h1>
    <h2>
        <a href="roomlisting.php">[Return to room page]</a>
        <a href="/assignment2/index.php">[Return to main page]</a>
    </h2>

    <form class="form_settings" method="POST">
        <p>
            <label for="username">Email:</label>
            <input type="text" id="username" name="username" maxlength="32" autocomplete="off">
        </p>
        <br>
        <p>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" maxlength="32" autocomplete="off">
        </p>
        <br>

        <input class="submit" type="submit" name="login" value="Login"> <br><br>


        <input class="submit" type="submit" name="logout" value="Logout">
        <!-- this is the login page where customer can log in. -->
    </form>

</body>
<?php
echo '</div></div>';
include "footer.php";
?>
<style>
    <?php include "style/style.css"; ?>
</style>

</html>