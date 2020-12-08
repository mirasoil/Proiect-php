<?php 
require_once "shoppingCart.php";
session_start();
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Smart devices for a better life</title>
 	<link rel="stylesheet" type="text/css" href="styles/main.css">
 	
 	<meta charset="utf-8">
	<link rel="stylesheet" href="styles/main.css" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


 </head>
 <body>
 	<!--Includem meniul --->
 	<?php include "sections/nav.sec.php"; ?> 
 	
 <div id="product-grid">
 	<div class="smart-products">
 		<h1>Smart Home Products</h1>
 	</div>

 	<?php 
 		$shoppingCart = new shoppingCart();
 		$query = "SELECT * FROM tbl_product";
 		$product_array = $shoppingCart->getAllProducts($query);

 		if(!empty($product_array)){
 			//var_dump($product_array);

 			foreach($product_array as $key => $value){
?>
<!--Daca utilizatorul doreste sa stie mai multe despre produs, va face click pe nume sau poza -->
		 <div class="product-item">
			<form method="POST" action="cos.php?action=add&code=<?php echo $product_array[$key]["code"];?>">
				<div class="product-title">
					<strong><a href="page.php?page=product&id=<?php echo $product_array[$key]['id']?>" class="product"><?php echo $product_array[$key]["name"]; ?></a></strong>
				</div>
				<div class="product-image">
					<a href="page.php?page=product&id=<?php echo $product_array[$key]['id']?>" class="product">
						<img src="<?php echo $product_array[$key]["image"]; ?>" class="product-image">
					</a>
				</div>
				<div class="product-price">
					<strong><?php echo "$".$product_array[$key]["price"]; ?></strong>
				</div>
				<div class="cart-action">
				<input type="text" name="quantity" value="1" size="2"/>
				<input type="submit"  value="Add to Cart" class="btnAddAction"/>
			</div>
			</form>
		</div> 


<?php


 			}
 		}

 	 ?>

 </div>
 <div class="container"> <!--ca sa functioneze footer-ul -->
</div>
<?php include 'sections/footer.sec.php'; ?>
 </body>
 </html>






