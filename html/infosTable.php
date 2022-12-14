<?php 

	if($_SESSION['username'] != "" && $_SESSION['droit'] == "admin"){
				$user = $_SESSION['username'];
				$droit = $_SESSION['droit'];
	}
	else{
		header('Location: index.php');
	}

	include ("./connexion.php");

	$sql="SELECT AIDE.NOM_MAGASIN, VILLE_MAGASIN, C1.CODE_POSTAL AS CODE_POSTAL_MAGASIN, PRIX, SUBVENTION, AIDE.COMMUNE, C2.CODE_POSTAL AS CODE_POSTAL_VILLE,DATE_RECEPTION
	FROM MAGASIN, COMU C1, COMU C2, AIDE
	WHERE AIDE.COMMUNE = C1.VILLE AND MAGASIN.NOM_MAGASIN = AIDE.NOM_MAGASIN AND MAGASIN.VILLE_MAGASIN = C2.VILLE";
	
	$ligne="SELECT COUNT(*) AS LIGNE
	FROM MAGASIN, COMU C1, COMU C2, AIDE
	WHERE AIDE.COMMUNE = C1.VILLE AND MAGASIN.NOM_MAGASIN = AIDE.NOM_MAGASIN AND MAGASIN.VILLE_MAGASIN = C2.VILLE";

	$nblignes = lancerRequete($ligne, $mabase);
	$table = lancerRequete($sql, $mabase);
	

	echo "

	<div class=\"container-fluid no-gutter\">
		<div class=\"row no-gutter\">
			<div class=\"col no-gutter p-0\">
			<table class =\"table table-striped\">
				<caption>
				Liste de tous les utilisateurs	
				</caption>
				<thead class=\"table-dark\">
					<tr>
						<th scope=\"col\">#</th>
						<th scope=\"col\">Prix</th>
						<th scope=\"col\">Subvention</th>
						<th scope=\"col\">Magasin</th>
						<th scope=\"col\">Ville du magasin</th>
						<th scope=\"col\">Code postal du magasin</th>
						<th scope=\"col\">Commune à l'origine de la subvention</th>
						<th scope=\"col\">Code postal de la commune</th>
						<th scope=\"col\">Date de la subvention</th>
					</tr>
				</thead>
				<tbody>";
	for ($i = 0; $i < $nblignes[0]->LIGNE; $i++) {
		echo "
				
				<tr>
					<th scope=\"row\">", ($i + 1), "</th>
					<td class=\"\">" . $table[$i]->PRIX . "</td>
					<td class=\"\">" . $table[$i]->SUBVENTION . "</td>
					<td class=\"\">" . $table[$i]->NOM_MAGASIN . "</td>
					<td class=\"\">" . $table[$i]->VILLE_MAGASIN . "</td>
					<td class=\"\">" . $table[$i]->CODE_POSTAL_MAGASIN . "</td>
					<td class=\"\">" . $table[$i]->COMMUNE . "</td>
					<td class=\"\">" . $table[$i]->CODE_POSTAL_VILLE . "</td>
					<td class=\"\">" . $table[$i]->DATE_RECEPTION . "</td>
				</tr>";

	}
	echo "		</tbody>
			</table>
			</div>
		</div>
	</div>";

?>