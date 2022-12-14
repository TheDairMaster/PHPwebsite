<!doctype html>
<html lang="fr">
	<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="./bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <title>SAE23</title>
	<style>

	caption {
		padding-left: 10px;
	}

	.navbar {
	  margin-bottom: -2px;
	}

	.row-no-padding {
	  margin-left: 0;
	  margin-right: 0;
	}

	[class*=\"col-\"],  
	[class^=\"col-\"] { 
	  padding-left: 0;
	  padding-right: 0;
	}
	
	ul {
		list-style-type: none;
	}
	
	.no-gutter > [class*='col-'] {
    padding-right:0;
    padding-left:0;
}

	</style>
	</head>
	

	<?php
	session_start();
	if($_SESSION['username'] != ""){
                    $user = $_SESSION['username'];
					$droit = $_SESSION['droit'];
	}
	else{
		header('Location: login.php');
	}
	
	?>
  
	<body class="bg-light">  
		<nav class="navbar navbar-expand bg-primary navbar-dark">
			<div class="container-fluid">
				<a class="navbar-brand">
					<span class="">Finances de Blois - Agglopolys</span>
				</a>
	
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
				
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link active" href="index.php?page=home">A propos</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="index.php?page=infosTable">Quelques Tableaux</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="index.php?page=infosGraph">Quelques Graphiques</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="index.php?page=infosFiltre">Quelques Filtres</a>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="">
							<div class="btn-group ">
								<button type="button" class="btn btn-dark dropdown-toggle " data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Compte
								</button>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-end">
									<a class="dropdown-item" href="index.php?page=moncompte">Mon compte</a>
									<?php
									if ($droit == "admin")
									{
									echo "
									<a class=\"dropdown-item\" href=\"index.php?page=users\">Gérer utilisateurs</a>";
									}
									?>
										<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="deconnexion.php">Déconnexion</a>
								</div>
							</div>
						</li>
					</ul>
				
				</div>
	
			</div>
		</nav>
		
		<?php
		$page = isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : "";
		if($page != "")
		{
			if(file_exists("./$page.php")) {
				include("./$page.php");
			} 
			else {
				header("HTTP/1.0 404 Not Found");
				echo "<p>Erreur 404</p>";
			}
		}
		else
		{
			include("./home.php");
		}
		include("./footer.php");
		?>
		

	</body>


<!--

-->
</html>