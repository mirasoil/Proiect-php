<?php 
include 'adminController.php';
$admin = new Admin();
$admin->createProduct($_POST['product-name'], $_POST['product-code'], $_POST['product-image'], $_POST['product-price'], $_POST['product-stock'], $_POST['product-desc']);
if($admin != 0){
		header("Location:controlPanel.php?addProduct=Success");
	} else {
		header("Location:controlPanel.php?addProduct=Error");
	}


 ?>