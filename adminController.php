<?php 
include 'DBController.php';
class Admin extends DBController{

	function getAllProducts(){
		//functie ce returneaza toate produsele din tabela
		$query = "SELECT * FROM tbl_product";

		$productResult = $this->getDBResult($query);
		foreach ($productResult as $key => $value) {
			//generam interfata produselor ce pot fi editate
			?>
			<div class="product-item">
			<form method="POST" action="execute.php">
				<!---Camp editabil alocat dinamic pentru fiecare proprietate--->
				<input type="hidden" name="product-id" value="<?php echo $productResult[$key]["id"]; ?>">
				<label for="pn">Product Name</label>
				<input type="text" name="product-name"value="<?php echo $productResult[$key]["name"]; ?>" id="pn"/><br>
				
				<label for="pc">Product Code</label>
				<input type="text" name="product-code"value="<?php echo $productResult[$key]["code"]; ?>" id="pc"/>
				<div class="product-image">
					<img src="<?php echo $productResult[$key]["image"]; ?>" class="product-image">
				</div>

				<label for="pi">Product Image</label>
				<input type="text" name="product-image"value="<?php echo $productResult[$key]["image"]; ?>" id="pi"/>
				<br>
				<label for="pp">Product Price</label>
				<input type="text" name="product-price"value="<?php echo $productResult[$key]["price"]; ?>" id="pp"/>
				<br>
				<label for="ps">Product Stock</label>
				<input type="text" name="product-stock"value="<?php echo $productResult[$key]["stock"]; ?>" id="ps"/>
				<br>
				<label for="pd">Product Description</label>
				<textarea rows="4" cols="50" name="product-desc" id="pd"><?php echo $productResult[$key]["description"]; ?></textarea>
				<br>
				<div class="product-action">
				<input type="submit"  value="Edit" class="btnEdit" name="edit-product"/>
				<input type="submit"  value="Delete" class="btnDelete" name="delete-product"/>
			</div>
			</form>
		</div> 


			<?php
		}
		return true;
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



	function editProduct($id, $name, $code, $image, $price, $stock, $description){
		//modifica datele unui produs
		$query = "UPDATE tbl_product SET  name=?, code=?, image=?, price=?, stock=?, description=? WHERE tbl_product.id='$id'";

		$params = array(
			array(
				"param_type" => "s",
				"param_value" => $name
			),
			array(
				"param_type" => "s",
				"param_value" => $code
			),
			array(
				"param_type" => "s",
				"param_value" => $image
			),
			array(
				"param_type" => "d",
				"param_value" => $price
			),
			array(
				"param_type" => "i",
				"param_value" => $stock
			),
			array(
				"param_type" => "s",
				"param_value" => $description
			)
		);

		$this->updateDB($query, $params);
		
	}


	function deleteProduct($id){
		$query = "DELETE FROM tbl_product WHERE id=?";

		$params = array(
			array(
				"param_type" => "i",
				"param_value" => $id
			)
		);

		$this->updateDB($query, $params);
	}



	function createProduct($name, $code, $image, $price, $stock, $description){
		$query = 'INSERT INTO tbl_product(name, code, image, price, stock, description) VALUES (?, ?, ?, ?, ?, ?)';

		$params = array(
			array(
				"param_type" => "s",
				"param_value" => $name
			),
			array(
				"param_type" => "s",
				"param_value" => $code
			),
			array(
				"param_type" => "s",
				"param_value" => $image
			),
			array(
				"param_type" => "d",
				"param_value" => $price
			),
			array(
				"param_type" => "i",
				"param_value" => $stock
			),
			array(
				"param_type" => "s",
				"param_value" => $description
			)
		);

		$this->updateDB($query, $params);
		
	}




	function showDescription($id){
		//aceasta functie va fi apelata prin intermediul unui buton din control panel, care permite vizualizarea descrierii intr-un input editabil
		$query = 'SELECT tbl_product.description FROM tbl_product WHERE id=?';

		$params = array(
			array(
				"param_type" => "i",
				"param_value" => $id
			)
		);

		$productResult = $this->getDBResult($query);


	}


//---------------------USERS------------------------------//

	function getAllUsers(){
		//functie ce returneaza toti utilizatorii din tabela 
		$query = "SELECT * FROM users";

		$userResult = $this->getDBResult($query);
		echo "<h3><strong>Edit User Details</strong></h3>";

		foreach ($userResult as $key => $value) {
			//generam interfata userilor
			?>
			<div class="user-item">
			<form method="POST" action="execute.php">
				<!---Camp editabil alocat dinamic pentru fiecare proprietate--->
				<input type="hidden" name="user-id" value="<?php echo $userResult[$key]["id"]; ?>"><br>

				<label for="un">Username</label><br>
				<input type="text" name="username"value="<?php echo $userResult[$key]["username"]; ?>" id="un"/><br>

				<label for="ue">User Email</label><br>
				<input type="text" name="email"value="<?php echo $userResult[$key]["email"]; ?>" id="ue"/><br>

				<div class="product-action">
				<input type="submit"  value="Edit User" class="btnEditUser" name="edit-user"/><br>
				<input type="submit"  value="Delete User" class="btnDeletetUser" name="delete-user"/><br>
			</div>
			</form>
		</div> 
		<br>

			<?php
		}
		return true;
	}



function editUser($id, $newUsername,  $email){
		//modifica datele unui utilizator
		$query = "UPDATE users SET  username=?, email=? WHERE users.id=? ";

		$params = array(
			array(
				"param_type" => "s",
				"param_value" => $newUsername
			),
			array(
				"param_type" => "s",
				"param_value" => $email
			),
			array(
				"param_type" => "i",
				"param_value" => $id
			)
		);

		$this->updateDB($query, $params);
		
	}


	function deleteUser($id){
		$query = "DELETE FROM users WHERE id=?";

		$params = array(
			array(
				"param_type" => "i",
				"param_value" => $id
			)
		);

		$this->updateDB($query, $params);
	}



	function createUser($username, $password, $email){
		$query = 'INSERT INTO users(username, password, email) VALUES (?, ?, ?)';

		$params = array(
			array(
				"param_type" => "s",
				"param_value" => $username
			),
			array(
				"param_type" => "s",
				"param_value" => $password
			),
			array(
				"param_type" => "s",
				"param_value" => $email
			)
		);

		$this->updateDB($query, $params);
		
	}



}


 ?>