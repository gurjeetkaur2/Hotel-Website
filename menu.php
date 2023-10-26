<?php 
include "checksession.php";
?>
<div id="header">
  <div id="logo">
    <div id="logo_text">
      <!-- class="logo_colour", allows you to change the colour of the text -->
      <h1><a href="/assignment2/index.php"><span class="logo_colour">Ongaonga Bed & Breakfast</span></a></h1>
      <h2>Make yourself at home is our slogan. We offer some of the best beds on the east coast. Sleep well and rest well.</h2>
    </div>
  </div>
  <div id="menubar">
    <ul id="menu">
      <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
      <li class="selected"><a href="/assignment2/index.php">Home</a></li>
      <li><a href="/assignment2/roomlisting.php">Rooms</a></li>
      <li><a href="/assignment2/registercustomer.php">Register</a></li>
      
      <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']  == 1) { ?>
        <li><a href="/assignment2/listcustomer.php">Customer</a></li>
        <li><a href="/assignment2/bookinglisting.php">Booking</a></li>
      <?php 
      }
      else {?>
      <li><a href="/assignment2/login.php">Login</a></li>
      <?php
      }
      ?>

    </ul>

  </div>
</div>