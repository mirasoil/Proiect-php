<?php 
session_start();
include 'userController.php';

$user = new User();

//EDIT USER
if(isset($_POST['salut'])){
	$user->updateDetails($_SESSION['id'], $_POST['username1']);
	header("Location:controlPanel.php?updated='Successfull' ");
} else {
	header("Location:controlPanel.php?edited='Error' ");
}

 ?>