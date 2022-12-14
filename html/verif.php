<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
	
	include ("./connexion.php");
	$username = $_POST['username'];
	$password = $_POST['password'];
    
    if($username !== "" && $password !== "")
    {
		
		$sql =  "SELECT count(*) as valeur FROM utilisateur where username = '".$username."' and password = '".$password."' ";
		$data = lancerRequete($sql, $mabase);

	$count = $data[0]->VALEUR;
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
			$sql =  "SELECT TYPE as droit FROM utilisateur where username = '".$username."' and password = '".$password."' ";
			$data = lancerRequete($sql, $mabase);
			$_SESSION['droit'] = $data[0]->DROIT;
			$_SESSION['username'] = $username;
			header('Location: index.php?page=home');
        }
        else
        {
			header('Location: login.php?erreur=1');
        }
    }
    else
    {
		header('Location: login.php?erreur=1');
    }
}
else
{
	header('Location: login.php');
}
?>