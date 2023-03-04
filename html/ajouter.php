<?php

	session_start();
	if($_SESSION['username'] != "" && $_SESSION['droit'] == "admin"){
		$user = $_SESSION['username'];
		$droit = $_SESSION['droit'];
	}
	else{
		header('Location: index.php');
	}
	
	include ("./connexion.php");
	$name = $_POST['username'];
	$password = $_POST['password'];
	$mail = $_POST['email'];
	$droit = $_POST['droit'];
	
	$test = "SELECT COUNT(*) AS NOMBRE FROM utilisateur WHERE USERNAME = '$name'"; # EDIT THIS WITH YOUR DATABASE SCHEMA
	$resultat = lancerRequete($test, $mabase);
	echo $resultat[0]->NOMBRE;
	if($resultat[0]->NOMBRE == 0)
	{
		$sql =  "INSERT INTO utilisateur (USERNAME, PASSWORD, EMAIL, TYPE) VALUES ('$name', '$password', '$mail', '$droit')"; # EDIT THIS WITH YOUR DATABASE SCHEMA
		$mabase->query($sql);
		header('Location: index.php?page=users');
	}
	else
	{
		header('Location: index.php?page=users&error=double');
	}
?>
