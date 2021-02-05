<?php 
include 'db.php';
include 'adminController.php';

$admin = new Admin();
print "Serverul confirma primirea codului postal ".$_POST["product-id"]." pentru persoana ".$_POST["product-name"]." ".$_POST["product-code"];

	//$data=unserialize($_POST['data']);
	$id = $_POST['product-id'];
    $name = $_POST['product-name'];
    $code = $_POST['product-code'];
 	$price = $_POST['product-price'];
 	$stock = $_POST['product-stock'];
	$admin->editProduct($id, $name, $code, $price, $stock); 
 ?>