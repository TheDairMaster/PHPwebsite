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
		
	$sql =  "DELETE FROM utilisateur where USERNAME = '$name'";
	//echo $sql;
	$mabase->query($sql);
	
	header('Location: index.php?page=users');


?>