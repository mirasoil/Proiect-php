<!DOCTYPE html>
<html>
<head>
	<title>Smart Shop</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="styles/main.css" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php 
  session_start();
  include "sections/nav.sec.php"; 
?>

	<div class="w3-content" style="max-width:1600px">
	  <header class="w3-container w3-center w3-padding-32 w3-white">
    	<h1 class="w3-xxxlarge"><a href="products.php" class="devices"><b>Smart home devices</b></a></h1>
    	<h6 style="font-style: italic;">Make your life easier with just one click</h6>
    	<h6 ><a href="products.php" class="products-click"><b>Check our products</b></a></h6>
      <div class="mesaj"></div>
  </header>
    <header class="w3-display-container w3-wide" id="home">
    <img class="w3-image" src="img/iot2.jpg" alt="Smart home" width="1600" height="460">
    <div class="w3-display-left w3-padding-large">
      <!-- <h1 class="w3-text-white">Smartself</h1> -->
      <h1 class="w3-jumbo w3-text-white w3-hide-small"><a href="products.php" class="devices"><b>SMART<br/> YOURSELF<br> TODAY</b></a></h1>
    </div>
  </header>
 <div>
	<div class="w3-container w3-white w3-padding-32">
    <h1>Subscribe</h1>
    <p>To get special offers and VIP treatment:</p>
    <p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail" style="width:100%"></p>
    <button type="button" class="w3-button w3-red w3-margin-bottom">Subscribe</button>
  </div>
</div>


<?php include "sections/footer.sec.php"; ?>
</body>
</html>