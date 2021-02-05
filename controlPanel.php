<!DOCTYPE html>
<html>
<head>
	<title>
		Admin - CRUD
	</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="styles/main.css" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
<?php 
session_start();

//Includem meniul
include 'sections/nav.sec.php';

//includem adminController pentru a putea folosi functia getAllProducts
include 'adminController.php';

//daca loggedin si accountType nu sunt setate redirectionam spre login.html
if(isset($_SESSION['loggedin']) && isset($_SESSION['accountType'])){//daca sunt setate
	if(!($_SESSION['loggedin'] == TRUE && $_SESSION['accountType'] == 'admin')){
	//ai acces doar daca esti logat si tip cont = admin
	header('Location:login.html');
	}
} else {
	header('Location:login.html');
}


 ?>
<div class="container" style="padding-bottom: 3rem;">
	
<button onclick="showDiv('lista')">See all products</button>
<button onclick="showDiv('lista-useri')">See all users</button>

<!---div-ul pentru crearea unui produs nou---->
<div id="lista">
	<button onclick="showDiv('new-product')" class="create-product">
		Create a new product
	</button>
	<div id="new-product" style="display:none;">
	<form action="addProduct.php" method="post">
		<label for="product-name">
		</label>
		<input type="text" name="product-name" placeholder="Product Name" id="product-name" required><br>
		<label for="product-code">
		</label>
		<input type="product-code" name="product-code" placeholder="Code" id="product-code" required><br>
		<label for="product-image">
		</label>
		<input type="product-image" name="product-image" placeholder="Image URL" id="product-code" required><br>
		<label for="product-price">
		</label>
		<input type="product-price" name="product-price" placeholder="Price" id="product-code" required><br>
		<label for="product-stock">
		</label>
		<input type="product-stock" name="product-stock" placeholder="Stock" id="product-stock" required><br>
		<div id="desc-div"></div>
		<label for="product-desc">
		</label>
		<input type="product-desc" name="product-desc" placeholder="Description" id="product-desc" required><br>
		<div id="desc-div"></div>
		<button type="submit">Add Product </button>
		</form>
</div>
	<?php 
	$admin = new Admin();
	//afisarea propriu-zisa a tuturor produselor
	$admin->getAllProducts(); 
	?>
</div>


<!---Div-ul pentru afisarea userilor --->
<div id="lista-useri" style="display: none;">
	<div id="users">
		<h3><strong>... new user</strong></h3>
	<form action="execute.php" method="post">
		<label for="username">Username</label><br>
		<input type="text" name="username" placeholder="New Username" id="username" required><br>

		<label for="password">Default Password</label><br>
		<input type="text" name="password" placeholder="Default password" id="password" required><br>
		<!---Parola trebuie schimbata la prima autentificare! --->

		<label for="email">Email</label><br>
		<input type="text" name="email" placeholder="New Email" id="email" required><br>
		
		<button type="submit" name="add-user">Add User </button><br>
		</form>
</div>
	<?php 
	$admin = new Admin();
	//afisarea propriu-zisa a tuturor utilizatorilor din baza de date
	$admin->getAllUsers(); 
	?>
</div>
</div>
<div class="footer" style=" bottom: 0; width: 100%; padding: 0; margin: 0;">
<?php include 'sections/footer.sec.php'; ?>
</div>
<script>
//functie apelata intern pentru a face vizibil un div rezervat
	function showDiv(id){
		
		if (document.getElementById(id).style.display === 'none') {
			document.getElementById(id).style.display = 'block';
		} else {
			document.getElementById(id).style.display = 'none';
		}
	}

</script>
</body>
</html>