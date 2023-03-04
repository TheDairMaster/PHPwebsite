<?php

	if($_SESSION['username'] != "" && $_SESSION['droit'] == "admin"){
				$user = $_SESSION['username'];
				$droit = $_SESSION['droit'];
	}
	else{
		header('Location: index.php?page=home');
	}

	include("./connexion.php");

	
	if(isset($_POST['montant']) && isset($_POST['tri']) && isset($_POST['contrat']) && isset($_POST['company'])) {

		if (!ctype_digit($_POST['montant'])) {
			header('Location: index.php?page=infosFiltre');
		}
		else{
			$montant = $_POST['montant'];
			$tri = $_POST['tri'];
			$contrat = $_POST['contrat'];
			$company = $_POST['company'];
			
			# EDIT THIS WITH YOUR DATABASE SCHEMA
			$req = "SELECT * FROM MARCHE_PUBLIC, ENTREPRISE WHERE SIRET = SIRET_BENEFICIAIRE AND DUREE_MAX_DU_MARCHE >= '" . $contrat . "' AND SIRET_BENEFICIAIRE = '" . $company . "' AND MONTANT_DU_MARCHE >= " . $montant . " ORDER BY DUREE_MAX_DU_MARCHE ". $tri;
			$compte = "SELECT count(*) as NOMBRE FROM MARCHE_PUBLIC, ENTREPRISE WHERE SIRET = SIRET_BENEFICIAIRE AND DUREE_MAX_DU_MARCHE >= '" . $contrat . "' AND SIRET_BENEFICIAIRE = '" . $company . "' AND MONTANT_DU_MARCHE >= " . $montant . " ORDER BY MONTANT_DU_MARCHE ". $tri;
			$filtre = lancerRequete($req, $mabase);
			$nombre = lancerRequete($compte, $mabase);
			if ($nombre[0]->NOMBRE==0)
			{
				echo "<h1 class=\"display-6 m-5 text-center\"> Aucun Résultat trouvé</h1>
					<div class=\"container\">
						<div class=\"row\">
							<div class=\"text-center\">
								<form action=\"index.php?page=infosFiltre\" method=\"POST\">
									<input class=\"btn btn-primary form-check\" type=\"submit\" id='submit' value='RETOUR' >
								</form>
							</div>
						</div>
					</div>";
			}
			else
			{
				
				# EDIT COLUMNS NAMES
				echo "

	<div class=\"container-fluid no-gutter\">
		<div class=\"row no-gutter\">
			<div class=\"col no-gutter p-0\">
			<table class =\"table table-striped\">
				<caption>
				</caption>
				<thead class=\"table-dark\">
					<tr>
						<th scope=\"col\">#</th>
						<th scope=\"col\">Entreprise</th>
						<th scope=\"col\">SIRET</th>
						<th scope=\"col\">Montant</th>
						<th scope=\"col\">Forme du prix</th>
						<th scope=\"col\">Nature du marché</th>
						<th scope=\"col\">Objet du marché</th>
						<th scope=\"col\">Durée maximum du contrat</th>
						<th scope=\"col\">Date du contrat</th>
					</tr>
				</thead>
				<tbody>";
	for ($i = 0; $i < $nombre[0]->NOMBRE; $i++) {
		echo "
				
				<tr>
					<th scope=\"row\">", ($i + 1), "</th>
					<td class=\"\">" . $filtre[$i]->NOM_ENTREPRISE . "</td>
					<td class=\"\">" . $filtre[$i]->SIRET_BENEFICIAIRE . "</td>
					<td class=\"\">" . $filtre[$i]->MONTANT_DU_MARCHE . "</td>
					<td class=\"\">" . $filtre[$i]->FORME_DU_PRIX . "</td>
					<td class=\"\">" . $filtre[$i]->NATURE_MARCHE . "</td>
					<td class=\"\">" . $filtre[$i]->OBJET_DU_MARCHE . "</td>
					<td class=\"\">" . $filtre[$i]->DUREE_MAX_DU_MARCHE . "</td>
					<td class=\"\">" . $filtre[$i]->DATE_CONTRAT . "</td>

				</tr>";

	}
	echo "		</tbody>
			</table>
			</div>
		</div>
	</div>
	<div class=\"container\">
		<div class=\"row\">
			<form class=\"col text-center\" action=\"index.php?page=infosFiltre\" method=\"POST\">
				<input class=\"btn btn-primary form-check\" type=\"submit\" id='submit' value='RETOUR' >
			</form>
		</div>
	</div>";
				
			}
		}
	}
	else{
		header('Location: index.php?page=home');
	}
?>
