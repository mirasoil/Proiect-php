<?php 
require_once "DBController.php";
//operatii CRUD pe tabela 

class shoppingCart extends DBController{
	function getAllProducts(){
		//functie ce returneaza toate produsele din tabela
		$query = "SELECT * FROM tbl_product";

		$productResult = $this->getDBResult($query); //in variabila productResult stocam rezultatul query-ului aplicat in tbl_product
		return $productResult;
	}

	function getUserCartItem($user_id){
		//
		$query = "SELECT tbl_product.*, tbl_cart.id as cart_id, tbl_cart.quantity, tbl_cart.product_id FROM tbl_product, tbl_cart WHERE tbl_product.id=tbl_cart.product_id AND tbl_cart.user_id=?";

		$params = array(
			array(
				"param_type" => "i",
				"param_value" => $user_id
			)
		);

		$cartResult = $this->getDBResult($query, $params);
		return $cartResult;
	}


	function getProductByCode($product_code){
		//returneaza produsul in functie de codul introdus, trimis ca referinta (GET)
		$query = "SELECT * FROM tbl_product WHERE code=?";

		$params = array(
			array(
				"param_type" => "s",
				"param_value" => $product_code
			)
		);

		$productResult = $this->getDBResult($query, $params);
		return $productResult;
	}

	function getProductById($id){
		//returneaza produsul in functie de id-ul introdus, trimis ca referinta (GET)
		$query = "SELECT * FROM tbl_product WHERE id=?";

		$params = array(
			array(
				"param_type" => "i",
				"param_value" => $id
			)
		);

		$productResult = $this->getDBResult($query, $params);
		return $productResult;
	}


	function getCartItemByProduct($product_id, $user_id){
		//returneaza produsele in functie deid-ul produsului si id-ul user-ului
		$query = "SELECT * FROM tbl_cart WHERE product_id=? AND user_id=?";

		$params = array(
			array(
				"param_type" => "i",
				"param_value" => $product_id
			),
			array(
				"param_type" => "i",
				"param_value" => $user_id
			)
		);

		$cartResult = $this->getDBResult($query, $params);
		return $cartResult;
	}


	function addToCart($product_id, $quantity, $user_id){
		//adauga produsele in cos pentru utilizatorul cu id-ul curent
		$query = "INSERT INTO tbl_cart(product_id, quantity, user_id) VALUES (?, ?, ?)";

		$params = array(
			array(
				"param_type" => "i",
				"param_value" => $product_id
			),
			array(
				"param_type" => "i",
				"param_value" => $quantity
			),
			array(
				"param_type" => "i",
				"param_value" => $user_id
			)
		);

		$this->updateDB($query, $params);
	}


	function updateCartQuantity($quantity, $cart_id){
		$query = "UPDATE tbl_cart SET quantity=? WHERE id=?";

		$params = array(
			array(
				"param_type" => "i",
				"param_value" => $quantity 
			),
			array(
				"param_type" => "i",
				"param_value" => $cart_id
			)
		);

		$this->updateDB($query, $params);
	}


	function deleteCartItem($cart_id){
		$query = "DELETE FROM tbl_cart WHERE id=?";

		$params = array(
			array(
				"param_type" => "i",
				"param_value" => $cart_id
			)
		);

		$this->updateDB($query, $params);
	}


	function emptyCart($user_id){
		$query = "DELETE FROM tbl_cart WHERE user_id=?";

		$params = array(
			array(
				"param_type" => "i",
				"param_value" => $user_id
			)
		);

		$this->updateDB($query, $params);
	}
}



 ?>