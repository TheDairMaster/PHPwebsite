<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="./bootstrap/css/bootstrap.css" rel="stylesheet">
    <title>SAE23</title>
	 </head>
	 <body class=""> 

		<?php
		include ("./connexion.php");
		?>

		<div class="">
		<!-- <h1>Connexion</h1> -->
			<div class="container">
				<form class="" action="./verif.php" method="POST">
					<div class="row mb-1 pt-5">
						<div class="col-3"></div>
						<div class="col-6">
							<label class="form-label">Nom d'utilisateur</label>
							<input class="form-control" type="text" placeholder="Entrer un nom d'utilisateur" name="username" required="Entrer un nom d'utilisateur"><br>
						</div>
					</div>
					<div class="row mb-4">
						<div class="col-3"></div>
						<div class="col-6">
							<label class="form-label">Mot de passe</label>
							<input class="form-control" type="password" placeholder="Entrer un mot de passe" name="password" required="Entrer un mot de passe">
						</div>
					</div>
					<div class="row">
						<div class="col-3"> </div>
						<div class="col-6">
							<input class="btn btn-primary form-check" type="submit" id='submit' value='SE CONNECTER' >
						</div>
					</div>
				</form>	
			</div>
		</div>

		<?php
			if(isset($_GET['erreur'])){
				echo "Utilisateur ou mot de passe incorrect";
			}
			?>
		<script src="./bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>