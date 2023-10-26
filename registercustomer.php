<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
     include "header.php";
     include "menu.php";
     echo '<div id="site_content">';
     include "sidebar.php";
    //input which have unnecessary data 

    function cleanInput($data){
        return htmlspecialchars(stripslashes(trim($data)));
    }
    if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] =='Register')){

        include "config.php";
        $DBC = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
    
        if (mysqli_connect_errno()) {
            echo "Error:Unable to connect to MySql." . mysqli_connect_error();
            exit; //stop processing the page further.
        };

        $error = 0;
        $msg ="Error";

        if (isset($_POST['firstname']) and !empty($_POST['firstname']) and is_string($_POST['firstname'])){
            $fn = CleanInput($_POST['firstname']);

            //https://www.php.net/manual/en/function.substr.php
            $firstname = (strlen($fn) > 50)?substr($fn,1,50):$fn; //check length and clip if too big
        }else{
            $error++;
            $msg .='Invalid firstname';
            $firstname ='';
        }

        $lastname =CleanInput($_POST['lastname']);
        $email =CleanInput($_POST['email']);
        $password =CleanInput($_POST['password']);

        if ($error == 0){
            $query = "INSERT INTO customer (fname, lname, email, password) VALUES(?,?,?,?)";

            $stmt =mysqli_prepare($DBC,$query); //prepare the query


            //https://www.w3schools.com/php/php_mysql_prepared_statements.asp
            mysqli_stmt_bind_param($stmt, 'ssss',$firstname, $lastname, $email, $password);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            
            echo"<h2>customer saved</h2>";

        }else{
            echo "<h2>$msg</h2>".PHP_EOL;
        }
        mysqli_close($DBC);

    }

    ?>
    <h1>New Customer Registration</h1>
    <h2>
        <a href="roomlisting.php">[Return to room page]</a>
        <a href="/assignment2/index.php">[Return to main page]</a>
    </h2>

    <form class="form_settings" method="POST" action="registercustomer.php">
        <p>
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" minlength="2" maxlength="50" required>
        </p>   
        
        <p>
            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" minlength="2" maxlength="50" required>
        </p>   

        <p>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"  maxlength="100" required>
        </p>   

        <p>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" minlength="8" maxlength="50" required>
        </p>   

        <input class="submit" type="submit" name="submit" value="Register">
    
    </form>  
    <?php
    echo '</div></div>';
    include "footer.php";
    ?>


</body>
<style>
    <?php include "style/style.css"; ?>
</style>
</html>