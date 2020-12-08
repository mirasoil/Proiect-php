<?php 
session_start();
include 'adminController.php';

$admin = new Admin();
$id = $_POST['product-id'];
if (isset($_POST['delete-product'])) {
//butonul delete 
	$admin->deleteProduct($id);
	header("Location:controlPanel.php?delete=Succes");
} else if (isset($_POST['edit-product'])) {
//butonul edit
	$admin->editProduct($id, $_POST['product-name'], $_POST['product-code'], $_POST['product-image'], $_POST['product-price'], $_POST['product-stock'], htmlspecialchars($_POST['product-desc']));
	header("Location:controlPanel.php?edit=Succes");
} 
//EDIT USER
 else if(isset($_POST['edit-user'])){
	$admin->editUser($_POST['user-id'], $_POST['username'], $_POST['email']);
	header("Location:controlPanel.php?edited='Successfull' ");
}

//ADD USER
else if (isset($_POST['add-user'])) {//butonul Add User
	$admin->createUser($_POST['username'], $_POST['password'], $_POST['email']);
	header("Location:controlPanel.php?addUser=Succes");
}

//DELETE USER
else if (isset($_POST['delete-user'])) {
	$admin->deleteUser($_POST['user-id']);
	header("Location:controlPanel.php?delete=Success");
}
else {
	echo "No action was selected";
	header("Location:controlPanel.php?error=noAction");
}




 ?>