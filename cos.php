<?php 
require_once 'shoppingCart.php';
session_start();


if(!isset($_SESSION['loggedin'])){
	header('Location:login.html'); //daca utilizatorul nu e logat nu poate accesa cosul
	exit;
}

$user_id = $_SESSION['loggedin'];
//in variabila locala user_id vom prelua id-ul utilizatorului logat din sesiune

$shoppingCart = new shoppingCart();
if(!empty($_GET['action'])){
	switch($_GET['action']){
		case 'add':
			if(!empty($_POST['quantity'])){
				$productResult = $shoppingCart->getProductByCode($_GET['code']);

				$cartResult = $shoppingCart->getCartItemByProduct($productResult[0]['id'], $user_id);
				$_SESSION['quantity'] = $_POST['quantity'];
				header('Location:cos.php'); //reseteaza link-ul 
				
				if(!empty($cartResult)){
					//modificam cantitatea din cos
					$newQuantity = $cartResult[0]['quantity'] + $_SESSION['quantity'];
					$shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]['id']);
					

				}else{
					//actualizam cantitatea si in tabela cos
					$shoppingCart->addToCart($productResult[0]['id'], $_SESSION['quantity'], $user_id);
				}
			}
			break;

			case 'remove':
				//sterg o inregistrare
				$shoppingCart->deleteCartItem($_GET['id']);
				break;

			case 'empty':
				//sterg toate inregistrarile din cos
				$shoppingCart->emptyCart($user_id);
				break;
	}
}


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Shopping Cart</title>
 	<meta charset="utf-8">
	<link rel="stylesheet" href="styles/main.css" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>

	
 </head>
 <body>
 	<?php include 'sections/nav.sec.php'; ?>
  <div id="shopping-cart">
 	<div class="txt-heading">
 		<div class="txt-heading-label" style="font-family: 'Times New Roman', Times, serif; font-weight: bold; font-size: 32px; color: white;">My Cart</div>
    		
 	</div>


 <?php 
 	$cartItem = $shoppingCart->getUserCartItem($user_id);

 	if(!empty($cartItem)){
 		$item_total = 0;

  ?>


  <table cellpadding="10" cellspacing="1">
	 <tbody>
	 <tr>
		 <th style="text-align: left;"><strong>Name</strong></th>
		 <th style="text-align: left;"><strong>Code</strong></th>
		 <th style="text-align: right;"><strong>Quantity</strong></th>
		 <th style="text-align: right;"><strong>Price</strong></th>
		 <th style="text-align: center;"><strong>Action</strong></th>
	 </tr>	

 <?php 
  foreach ($cartItem as $item) {

 ?>

	<tr>
		 <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><strong><?php echo $item["name"]; ?></strong></td>
		 <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><?php echo $item["code"]; ?></td>
		 <td style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
		 <td style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo "$".$item["price"]; ?></td>
		 <td style="text-align: center; border-bottom: #F0F0F0 1px solid;"><a href="cos.php?action=remove&id=<?php echo $item["cart_id"]; ?>" class="btnRemoveAction"><i class="fas fa-times-circle"></i>Delete product</a><span><a href="products.php" class="btnAddAction"><i class="fas fa-cart-plus"></i>Choose another product</a></span></td>
 	</tr>


<?php 
	$item_total += ($item['price'] * $item['quantity']);
}
 ?>
	<tr>
		 <td colspan="3" align=right><strong>Total:</strong></td>
		 <td align=right><strong><?php echo "$".$item_total; ?></strong></td>
		 <td><a id="btnEmpty" href="cos.php?action=empty"><i class="fas fa-trash"></i>Empty Cart</a></td>
 	</tr>
 	</tbody>
 </table>

<?php 
 }
?>
 <div><a href="products.php" style="text-decoration: none; font-size: 20px; ">Go back to shop</a></div>
 <div><a href="logout.php" style="text-decoration: none; font-size: 20px; ">Logout</a></div>
 </body>
 </html>