<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Smartself</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <li class="dropdown"><a  href="products.php">Products </a>
      </li>
      <!---<li><a href="account.php">Account</a></li>--->
      
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
          if (isset($_SESSION['accountType']) && $_SESSION['accountType'] == 'admin') {
             echo '<li><a href="controlPanel.php"><span "></span> Control Panel</a></li>';//control panel apare doar daca esti admin
          }else {
            echo '<li><a href="cos.php"><span "></span> Cos</a></li>';//cosul apare doar daca esti user
          }
          echo '
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';//apare doar daca esti logat
      }else {
        echo '<li><a href="registration.html"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="login.html"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>'; //apar in orice alt caz
      }

       ?>
    </ul>
  </div>
</nav>
