<?php 
session_start();
include 'adminController.php';
$admin = new Admin();
$id = $_POST['product-id'];
if (isset($_POST['delete-product'])) {//butonul delete 
	$admin->deleteProduct($id);
	header("Location:controlPanel.php?delete=Succes");
} else if (isset($_POST['edit-product'])) {//butonul edit
	$admin->editProduct($id, $_POST['product-name'], $_POST['product-code'], $_POST['product-image'], $_POST['product-price'], $_POST['product-stock']);
	header("Location:controlPanel.php?edit=Succes");
} else {
	echo "cannot execute edit";
	header("Location:controlPanel.php?error=noAction");
}

/*$desc = $_POST['show-desc-prod']; //inputul Show Description din adminController.php
if(isset($desc)){
	$admin->showDescription($id);
	header("Location:controlPanel.php?show=description");
} else {
	header("Location:controlPanel.php");
}*/








//EDIT USER
if(isset($_POST['edit-user'])){
	$admin->editUser($_POST['user-id'], $_POST['username'], $_POST['email']);
	header("Location:controlPanel.php?edited='Successfull' ");
} else {
	header("Location:controlPanel.php?edited='Error' ");
}


//ADD USER
if (isset($_POST['add-user'])) {//butonul Add User
	$admin->addUser($_POST['user-id'], $_POST['username'], $_POST['email']);
	header("Location:controlPanel.php?addUser=Succes");
}
 ?>