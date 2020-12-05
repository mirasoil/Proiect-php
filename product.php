<?php 
require_once 'shoppingCart.php';

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
				 </div>
			</div>
			<form method="POST" action="cos.php?action=add&code=<?php echo $product_array[$key]["code"];?>">
				<div class="cart-action" style="text-align: center;">
				<input type="text" name="quantity" value="1" size="2"/>
				<input type="submit"  value="Add to Cart" class="btnAddAction"/>
			</div>
			</form>

		<?php
		}
	}else {
		echo 'nimic :(';
	}
}

 ?>