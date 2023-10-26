<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="style.css" /> -->
    <title>Customers List</title>
</head>




<body>

    <?php
    
    include "header.php";
    include "menu.php";
    echo '<div id="site_content">';
    include "sidebar.php";

    echo '<div id="content">';

    include "checksession.php";
    include "config.php";
    $DBS = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);

    if (mysqli_connect_errno()) {
        echo "Error:Unable to connect MySql." . mysqli_connect_error();
        exit; //stop processing the page further.
    }
    //prepare a query and send it to the server
    $query = 'SELECT customerID, fname, lname, email FROM customer ORDER BY customerID';
    $result = mysqli_query($DBS, $query);
    $rowcount = mysqli_num_rows($result);
    ?>

    <h1>Customer Listing</h1>
    <h2>
        <a href="registercustomer.php">[Create new customer]</a>
        <a href="/assignment2/index.php">[Return to main page]</a>
    </h2>

    <h2> Customer lists</h2>
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']  == 1) { ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Action</th>
   

                </tr>
            </thead>

            <!-- php query to find out customers -->
            <?php

            if ($rowcount > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['customerID'];
                    echo '<tr><td>' . $row['customerID']
                        . '</td><td>' . $row['fname']
                        . '</td><td>' . $row['lname']
                        . '</td><td>' . $row['email'] . '</td>';
                    echo '<td><a href="viewcustomer.php?id=' . $id . '">[view]</a>';
                    echo '<a href="editcustomer.php?id=' . $id . '">[edit]</a>';
                    echo '<a href="deletecustomer.php?id=' . $id . '">[delete]</a>';
                    
                    echo '</tr>' . PHP_EOL;
                }
            } else echo "<h2>NO customers found!</h2>";

            mysqli_free_result($result); //this query will free memory from used query 
            mysqli_close($DBS);
            ?>
        </table>
    <?php } 
    echo '</div></div>';
    require_once "footer.php";
    ?>


</body>


<style>
    <?php include "style/style.css"; ?>
</style>


</html>