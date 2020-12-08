<?php 
include 'adminController.php';
$admin = new Admin();
//instantiem un obiect din clasa Admin
$admin->createProduct($_POST['product-name'], $_POST['product-code'], $_POST['product-image'], $_POST['product-price'], $_POST['product-stock'], $_POST['product-desc']);
//apelam fucntia ce ne creeaza un produs nou, definita in adminController.php
if($admin != 0){
		header("Location:controlPanel.php?addProduct=Success");
	} else {
		header("Location:controlPanel.php?addProduct=Error");
	}


 ?>