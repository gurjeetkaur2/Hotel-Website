<div class="sidebar">
  <?php if (isset($_SESSION['username'])) {
    if (isset($_POST['logout'])) logout();
    $un = $_SESSION['username'];
    if ($_SESSION['loggedin'] == 1){ ?>
      <h6>Logged in as: <?php echo $un ?></h6>
      <form class="form_settings" method="post">
        <input class="submit" type="submit" name="logout" value="Logout">
      </form>
  <?php
    }
  }
  ?>
  <!-- insert your sidebar items here -->
  <h3>Latest News</h3>
  <h4>check these websites for more information.</h4>

  <h3>Useful Links</h3>
  <ul>
    <li><a href="https://www.tourismnewzealand.com/" target="blank">Newzealand Tourism Website</a></li>
    <li><a href="https://en.wikipedia.org/wiki/Ongaonga,_New_Zealand" target="blank">About Ongoanga</a></li>
    <li><a href="/assignment2/privacy.php">Privacy statement</a></li>
  </ul>
  <h3>Search</h3>
  <form method="post" action="#" id="search_form">
    <p>
      <input class="search" type="text" name="search_field" value="Enter keywords....." />
      <input name="search" type="image" style="border: 0; margin: 0 0 -9px 5px;" src="style/search.png" alt="Search" title="Search" />
    </p>
  </form>
</div>