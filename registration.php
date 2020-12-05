<?php 
$SATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'proiect';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);	

//daca exista eroare la conexiune -> oprim script-ul si afisam eroarea
if(mysqli_connect_error()){
	exit('Failed to connect to MySQL: '.mysqli_connect_error());
}

//verificam daca datele din formular au fost trimise
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
	exit('Please complete all the fields!');
}

//verificam daca nu au fost trimise inregistrari goale
if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])){
	exit('All the fields must be completed!');
}

//validare email
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	exit('Invalid email!');
}

//validare username
if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
 	exit('Invalid username!');
}

//validare parola
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	exit('The password should contain between 5 and 20 characters!');
}

//verificam daca datele nu exista deja in tabela 
if($stmt = $con->prepare('SELECT id, password FROM users WHERE username=?')){
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();

	if($stmt->num_rows > 0){
		//username-ul exista in baza de date
		echo 'This username already exists. Choose another one!';
	}else {
		//facem inserarea in baza de date
		if($stmt = $con->prepare('INSERT INTO users(username, password, email) VALUES (?, ?, ?)')){
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

			$stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);//parola hash
			$stmt->execute();

			echo 'Registration succesful!';
			header('Location: index.php');
		}else {
			echo 'Cannot complete the prepare statement!';
		}
	}
	$stmt->close();
}else{
	echo 'Cannot complete the prepare statement!';
}
$con->close();

 ?>

