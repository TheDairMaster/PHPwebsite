<?php

	if($_SESSION['username'] != "" && $_SESSION['droit'] == "admin"){
				$user = $_SESSION['username'];
				$droit = $_SESSION['droit'];
	}
	else{
		header('Location: index.php?page=home');
	}


	include("./connexion.php");
	
	$req = "SELECT * FROM ENTREPRISE ORDER BY NOM_ENTREPRISE";
	$req2 = "select count(*) as nombre, nom_entreprise from entreprise, marche_public
where entreprise.siret = siret_beneficiaire or entreprise.siret = siret_acheteur
group by nom_entreprise
order by nom_entreprise";
	$nb = "SELECT COUNT(*) AS NOMBRE FROM ENTREPRISE";
	$entreprises = lancerRequete($req, $mabase);
	$op = lancerRequete($req2, $mabase);
	$nbentreprises = lancerRequete($nb, $mabase);
	
	$req3 = "select distinct duree_max_du_marche from marche_public order by duree_max_du_marche";
	$nb2 = "select count(distinct duree_max_du_marche) as nombre from marche_public";
	$duree = lancerRequete($req3, $mabase);
	$nbdurees = lancerRequete($nb2, $mabase);
?>



<div class="container">
	<form class="" action="index.php?page=filtre" method="POST">
		<div class="row mb-1 pt-5">
			<div class="col-3"></div>
			<div class="col-6">
				<label class="form-label" for="entreprise">Choisir une entreprise :</label>
				<select name="company" class="form-select" id="company">
				
				<?php
				
				for ($i = 0; $i < $nbentreprises[0]->NOMBRE; $i++) {

					echo "<option value=\"". $entreprises[$i]->SIRET ."\">". $entreprises[$i]->NOM_ENTREPRISE . "    (". $op[$i]->NOMBRE . " opérations)</option>
					";

				}
				
				?>
				</select>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-3"></div>
			<div class="col-6">
				<label class="form-label">Choisir une durée maximale minimale de marché</label>
				<select name="contrat" class="form-select" id="contrat">
				
				<?php
				
				for ($i = 0; $i < $nbdurees[0]->NOMBRE; $i++) {

					echo "<option value=\"". $duree[$i]->DUREE_MAX_DU_MARCHE ."\">". $duree[$i]->DUREE_MAX_DU_MARCHE . "</option>
					";

				}
				
				?>
				</select>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-3"></div>
			<div class="col-6">
				<label class="form-label">Choisir un montant minimal de marché</label>
				<input class="form-control" type="montant" placeholder="Entrer un montant" name="montant" required="Entrer un montant">
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-3"></div>
			<div class="col-6">
				<label class="form-label">Choisir un tri</label><br>
				<input class="form-check-input" type="radio" checked id="ASC" name="tri" value="ASC">
				<label class="form-label" for="ASC">Croissant</label>
				<input class="form-check-input" type="radio" id="DESC" name="tri" value="DESC">
				<label class="form-label" for="DESC">Décroissant</label>
			</div>
		</div>
		<div class="row">
			<div class="col-3"> </div>
			<div class="col-6">
				<input class="btn btn-primary form-check" type="submit" id='submit' value='VALIDER' >
			</div>
		</div>
	</form>	
</div>

