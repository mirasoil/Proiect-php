<!DOCTYPE html>
<html>
<head>
	<title>Account</title>
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
include 'sections/nav.sec.php';
include 'userController.php'; //pagina in care sunt definite functiile de modificare parola, username sau email pentru useri 
if(!(isset($_SESSION['loggedin']) && $_SESSION['accountType'] == 'user')){
         header('Location:login.html');
}

 ?>

<div class="container">
    <h3>My Account</h3>
    <?php 
    echo $_SESSION['name']; ?>
    <form action="execute-user.php" method="POST">
        <div class="row">
            <div class="col input-group form-group" id="account-name">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                </div>
                <input type="text" name="username1" value="<?php echo $_SESSION['name']; ?>" id="account-name" class="form-control" placeholder="Name">	
            </div>
        </div>
        
        <div class="form-group">
            <button type="submit" name="salut" class="btn btn-primary px-5">Apply Changes</button>
        </div>
    </form>
</div>



</body>
</html>