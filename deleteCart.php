<?php 
include 'db.php';
include 'shoppingCart.php';

$shoppingCart = new shoppingCart();

if(isset($_POST['delete_id'])){
	$id = $_POST['delete_id'];
	// $query = mysqli_query($con,"DELETE FROM tbl_product WHERE id='$id'");	
	$shoppingCart->deleteCartItem($id);  //in cazul in care nu este redactat obiectual, se insereaza query-ul specific delete-ului
}

if(isset($_POST['empty_id'])){
	$user_id = $_POST['empty_id'];	
	$shoppingCart->emptyCart($user_id);  //in cazul in care nu este redactat obiectual, se insereaza query-ul specific delete-ului
}

 ?>