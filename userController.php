<?php 
include 'DBController.php';
class User extends DBController{
	function getUserById($id){
		$query = "SELECT * FROM users WHERE id=?";

		$params = array(
			array(
				"param_type" => "i",
				"param_value" => $id
			)
		);

		$userResult = $this->getDBResult($query, $params);
		return $userResult;
	}


	function updateDetails($id, $username){
		$query = "UPDATE users SET username=? WHERE id='$id' ";

		$params = array(
			array(
				"param_type" => "s",
				"param_value" => $username
			)
			
		);

		$this->updateDB($query, $params);
	}


}


 ?>