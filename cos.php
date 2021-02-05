<?php 
require_once 'shoppingCart.php';
session_start();


if(!isset($_SESSION['loggedin'])){
	header('Location:login.html'); //daca utilizatorul nu e logat nu poate accesa cosul
	//ATENTIE-functioneaza doar la inceput, cand sesiunea nu este pornita. Daca ies din cos cu logout si intru tot in cos, in aceeasi fila, cosul va merge
	exit;
}

$user_id = $_SESSION['id'];
//in variabila locala user_id vom prelua id-ul utilizatorului logat din sesiune
//variabila a fost initializata in login.php

$shoppingCart = new shoppingCart();
if(!empty($_GET['action'])){
	//daca in url avem o variabila action
	switch($_GET['action']){
		case 'add':
			if(!empty($_POST['quantity'])){
				$productResult = $shoppingCart->getProductByCode($_GET['code']);
				//in product-result stocam produsul returnat cu codul preluat din link

				$cartResult = $shoppingCart->getCartItemByProduct($productResult[0]['id'], $user_id);
				$_SESSION['quantity'] = $_POST['quantity'];
				//preluam cantitatea din formular si o retinem in sesiune
				header('Location:cos.php'); 
				//reseteaza link-ul ca sa nu se adauge ultima cantitate stocata la fiecare refresh
				
				if(!empty($cartResult)){
					//modificam cantitatea din cos
					$newQuantity = $cartResult[0]['quantity'] + $_SESSION['quantity'];
					//la cantitatea curenta adaugam ce am retinut in sesiune
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
include 'sections/header.sec.php';
?>
<script>

//Butonul Delete
function deleteAjax(id){
     	if(confirm('Are you sure ?')){
     		$.ajax({
     			type: "POST",
     			url : 'deleteCart.php',
     			data:{delete_id:id},
     			success: function(data){
     				$('#'+id).remove();     //stergem div-ul in care era afisat produsul
     				$( "#price" ).load(window.location.href + " #price" );    //modificam pretul afisat (dupa stergere acesta se modifica)
     			}
     		});
     	}
     }

//Butonul Empty
function emptyCart(){
	if(confirm('Are you sure you want to delete all products from cart ?')){
		$.ajax({
			type:"POST",
			url: 'deleteCart.php',
			data: {empty_id:<?php echo $user_id; ?>},
			success: function(data){
				$('#my_cart').remove();
				$('#message-success').html('Your shopping cart is empty, please check our <a href="products.php" class="devices">products</a> ! ;)');
				
			}
		})
	}
}

</script>
	
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

<div id="my_cart">
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
 //generez produsele in cos fara sa mai apelez functia
  foreach ($cartItem as $item) {

 ?>

	<tr id="<?php echo $item['id']; ?>" class="cart-products">
		 <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><a href="page.php?page=product&id=<?php echo $item['product_id']; ?>" class="devices"><strong><?php echo $item["name"]; ?></strong></a></td>
		 <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><?php echo $item["code"]; ?></td>
		 <td style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
		 <td style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo "$".$item["price"]; ?></td>
		 <td style="text-align: center; border-bottom: #F0F0F0 1px solid;">
		 	<!---am setat un id unic pentru fiecare div, egal cu id-ul produsului pentru a-l accesa la delete--->
			 <?php echo '<button id="'.$item['id'].'" onclick="deleteAjax(this.id)">Delete</button>'; ?>
		 	<span><a href="products.php" class="btnAddAction"><i class="fas fa-cart-plus"></i>Choose another product</a></span>
		 </td>
		 
 	</tr>


<?php 
	$item_total += ($item['price'] * $item['quantity']);
}
 ?>
	<tr>
		 <td colspan="3" align='right'><strong>Total:</strong></td>
		 <td align='right' id="price"><strong><?php echo "$".$item_total; ?></strong></td>
		 <td><button id="btnEmpty" onclick="emptyCart()" ><i class="fas fa-trash"></i>Empty Cart</button></td>
 	</tr>
 	</tbody>
 </table>
</div>

<?php 
 }else{
 	//daca nu exista nimic in cos, afisam un mesaj prietenos 
 	echo "<h1 style='text-align: center; padding: 30px;'>Your shopping cart is empty, please check our <a href=\"products.php\" class='devices'>products</a> ! ;) </h1>
 	";
 }
?>
<h1 id="message-success" style='text-align: center; padding: 30px;'></h1>
 <div><a href="products.php" style="text-decoration: none; font-size: 20px;">Go back to shop</a></div>
 <div><a href="logout.php" style="text-decoration: none; font-size: 20px; ">Logout</a></div>
 <div><a href="order.php" style="float: right; font-size: 20px;color: green;" class="btnPlaceOrder">Place order</a></div>

 </body>
 </html>