<?php 
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'proiect';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

//daca exista eroare la conexiune, oprim scriptul si afisam eroarea
if(mysqli_connect_errno()){
	exit('Failed to connect to MySql: '.mysqli_connect_error());
}

//verificam daca datele din formularul de autentificare au fost trimise sau nu
if(!isset($_POST['username'], $_POST['password'])){
	//datele nu au fost preluate si, deci, iesim cu eroarea urmatoare
	exit('Completati username si parola !');
}
//daca datele au fost trimise, continuam

//if admin or not
if (isset($_POST['adminCheck'])) {
	$statement = $con->prepare('SELECT id, password FROM admins WHERE username=?');
	$_SESSION['accountType'] = 'admin';
}else{
	$statement = $con->prepare('SELECT id, password FROM users WHERE username=?');
	$_SESSION['accountType'] = 'user';
}

//pregatim sql pentru injectia instructiunii
if($stmt = $statement){ //daca conexiunea a fost realizata cu succes
	$stmt->bind_param('s', $_POST['username']); //inlocuim ? cu username-ul preluat prin post
	$stmt->execute();
	//stocam rezultatul pentru a putea verifica daca contul exista in baza de date
	$stmt->store_result();

	if($stmt->num_rows > 0){
		//daca ne-a rezultat cel putin un rand
		$stmt->bind_result($id, $password);
		$stmt->fetch();

	//contul exista => verificam parola
	if (password_verify($_POST['password'], $password)) {
		//creem sesiuni pentru a stii daca utilizatorul este logat
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['username'];
		$_SESSION['id'] = $id;

		header('Location:index.php');
		echo "Welcome ".$_SESSION['name']." !";
	} else {
		//parola incorecta
		$_SESSION['loggedin'] = FALSE;
		unset($_SESSION['accountType']); //user sau parola gresite => resetare accountType
		echo 'Incorrect password !';
	}
}else {
	//username incorect
	unset($_SESSION['accountType']); //in cazul in care orice autentificare esueaza, se reseteaza accountType
	echo 'You need to register first !';
}

$stmt->close();
}
 ?>