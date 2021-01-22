<?php 
include 'db.php';
include 'adminController.php';

$admin = new Admin();

if(isset($_POST['delete_id'])){
	$id = $_POST['delete_id'];
	// $query = mysqli_query($con,"DELETE FROM tbl_product WHERE id='$id'");	
	$admin->deleteProduct($id);  //in cazul in care nu este redactat obiectual, se insereaza query-ul specific delete-ului
}


 ?>