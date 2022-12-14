<?php
include ("./connexion.php");
$req = "SELECT * FROM UTILISATEUR";
$ligne = "SELECT COUNT(*) AS NOMBRE FROM UTILISATEUR";

$data = lancerRequete($req, $mabase);
$line = lancerRequete($ligne, $mabase);
$nombre = $line[0]->NOMBRE;


if($_SESSION['username'] != "" && $_SESSION['droit'] == "admin"){
	$user = $_SESSION['username'];
	$droit = $_SESSION['droit'];
}
else{
	header('Location: index.php');
}



echo "

<div class=\"container-fluid no-gutter\">
	<div class=\"row no-gutter\">
		<div class=\"col-5\">
		<table class =\"table table-striped \">
			<caption>
			Liste de tous les utilisateurs	
			</caption>
			<thead class=\"table-dark\">
				<tr>
					<th scope=\"col\">#</th>
					<th scope=\"col\">Nom</th>
					<th scope=\"col\">Adresse Mail</th>
					<th scope=\"col\">Droit</th>
					<th scope=\"col\">Action</th>
				</tr>
			</thead>
			<tbody>";
for ($i = 0; $i < $nombre; $i++) {
    echo "
			<tr>
				<th scope=\"\">", ($i + 1), "</th>
				<td class=\"\">" . $data[$i]->USERNAME . "</td>
				<td class=\"\">" . $data[$i]->EMAIL . "</td>
				<td class=\"\">" . $data[$i]->TYPE . "</td>";
				
	if($data[$i]->USERNAME != $user){
				
				echo "<td class=\"\"><form action=\"./supprimer.php\" method=\"POST\"><button name=\"username\"type=\"submit\" class=\"btn btn-outline-danger\" value=\"".$data[$i]->USERNAME."\">Supprimer</button></form></td>
			</tr>";
	}
	else
	{
		echo "<td class=\"\"><button name=\"username\"type=\"submit\" class=\"btn btn-outline-warning\" value=\"".$data[$i]->USERNAME."\">Supprimer</button></td>
			</tr>";
	}
}
echo "	</tbody>
		</table>
		</div>";
?>
		<!--<div class="col-1"></div>-->
		<div class="col-1"></div>
		<div class="col-6">
			<h2>Ajouter utilisateur</h2><br>
			<form action="./ajouter.php" method="POST">
				<p>Nom d'utilisateur : <input type="text" required="Champ obligatoire" name="username" /></p>
				<?php 
				
				if(isset($_GET['error'])){
					echo "<p class=\"text-danger\"> Utilisateur déjà existant </p>";
				}
				
				?>
				<p>Adresse Email : <input type="text" required="Champ obligatoire" name="email" /></p>
				<p>Mot de passe : <input type="text" required="Champ obligatoire" name="password" /></p>
				<p>Droit : <ul><li><input type="radio" checked id="ext" name="droit" value="ext">
				<label for="ext">Ext</label></li><li>
				<input type="radio" id="admin" name="droit" value="admin">
				<label for="admin">Admin</label><br><br>
				<p><input type="submit" value="Ajouter" class="btn btn-primary "></li></ul></p>
			</form>
		</div>
	</div>
</div>