<?php 
session_start();

//se realizeaza conexiunea la baza de date
function pdo_connect_mysql(){
	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = '';
	$DATABASE_NAME = 'proiect';
	try{
		return new PDO('mysql:host='.$DATABASE_HOST.';dbname='.$DATABASE_NAME.';charset=utf8',$DATABASE_USER, $DATABASE_PASS); 
		//creeaza un nou obiect de tip PDO unde se conecteaza la mysql, si daca o reusit sa creeze obiectul, returneaza obiectul nou creat
	}catch(PDOException $exception){
		exit('Conectare la baza de date esuata');
	}
}

$pdo = pdo_connect_mysql();//obiect definit din functia de mai sus
$page = isset($_GET['page'])&& file_exists($_GET['page'].'.php') ? $_GET['page']:'index';
//daca este setata variabila page in link include $page.php, daca nu e redirectioneaza spre index.php
include $page.'.php';


 ?>