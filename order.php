<!DOCTYPE html>
<html>
<head>
	<title>Order Confirmation Page</title>
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
include 'sections/nav.sec.php';

?>
<div id='order'><h1>Order placed successfully! </h1>
<h3>Thank you !</h3>
 <div style="padding-top: 50px;"><button><a href="products.php" style="text-decoration: none; font-size: 20px; ">Go back to shop</a></button></div>

</div>


<div class="container"></div>
<?php 
include 'sections/footer.sec.php';

?>
</body>
</html>