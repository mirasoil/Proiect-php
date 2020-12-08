<!DOCTYPE html>
<html>
<head>
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
require_once 'shoppingCart.php';
include 'sections/nav.sec.php';

$shoppingCart = new shoppingCart();

if(isset($_GET['id'])) { //daca in link este setat id-ul il preluam si pe baza lui afisam datele produsului
	
	$query = 'SELECT * FROM tbl_product WHERE id=?';
	//definim query-ul care va cauta produsul in baza de date dupa id-ul introdus
	$product_array = $shoppingCart->getProductById($_GET['id']);
	//in variabila $product_array apelam functia getProductById definita in shoppingCart.php

	if(!empty($product_array)){
		//daca produsul cu id-ul introdus exista il afisam
		
		foreach ($product_array as $key => $value) {
		
		?>
			<div class="product content-wrapper">
			 <img src="<?php echo $product_array[$key]['image']?>" width="300" height="300" style="display: block; margin: 0 auto;" alt="<?php echo $product_array[$key]['name']?>">
				 <div>
					 <h1 class="name" style="text-align: center;"><?php echo $product_array[$key]['name']?></h1>
					 <label><h3 style="text-align: center;">Price</label>
					 <span class="price">
					 &dollar;<?php echo $product_array[$key]['price']?>
					 </span></h3>
					 
				<div class="description">
					 <?php echo $product_array[$key]['description']?>
				</div>
			<form method="POST" action="cos.php?action=add&code=<?php echo $product_array[$key]["code"];?>">
				<div class="cart-action" >
					<input type="text" name="quantity" value="1" size="2"/>
					<input type="submit"  value="Add to Cart" class="btnAddToCart"/>
				</div>
			</form>
				<div style="text-align: center; margin-bottom: 30px;">
					<a href="products.php"><button>Back to shop</button></a>
				</div>
			</div>
		</label>
	</div>
		<?php
		}
	}else {
		echo 'nimic :(';
	}
}

?>

<?php
include 'sections/footer.sec.php';
 ?>
 </body>
</html>