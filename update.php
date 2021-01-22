<?php 
include 'db.php';
include 'adminController.php';

$admin = new Admin();

if(isset($_POST['edit_data'])){
		
	$admin->editProduct($_POST['id'], $_POST['name'], $_POST['code'], $_POST['image'], $_POST['price'], $_POST['stock'], $_POST['description']);  

}
 ?>