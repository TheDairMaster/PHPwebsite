<?php
	if($_SESSION['username'] != "" && $_SESSION['droit'] == "admin"){
		$user = $_SESSION['username'];
		$droit = $_SESSION['droit'];
	}
	else{
		header('Location: index.php');
	}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>

<h1 class="display-6 m-5 text-center"> Moyenne des subventions versées aux magasins pour l'achat de vélos électriques par ville :</h1>
<div class="container">
<canvas id="graph1" width="500px"></canvas>
</div>
<br>
<h1 class="display-6 m-5 text-center"> Total des subventions versées pour l'achat de vélos électrique pour chaque magasin :</h1>
<div class="container">
<canvas id="graph2" width="500px"></canvas>
</div>
<?php


	
	include("./connexion.php");

	$req="SELECT COMMUNE, ROUND(AVG(subvention)) AS MOYENNE FROM aide GROUP BY COMMUNE ORDER BY COMMUNE";
	$graph1 = lancerRequete($req, $mabase);
	$compter = "SELECT COUNT(DISTINCT COMMUNE) AS NOMBRE FROM aide";
	$lignes1 = lancerRequete($compter, $mabase);
	
	$req2 = "SELECT NOM_MAGASIN, ROUND(SUM(subvention)) AS TOTAL FROM aide GROUP BY NOM_MAGASIN";
	$graph2 = lancerRequete($req2, $mabase);
	$compter2 = "SELECT COUNT(DISTINCT NOM_MAGASIN) AS NOMBRE FROM aide";
	$lignes2 = lancerRequete($compter2, $mabase);
	echo "

<script>

	const g1 = document.getElementById('graph1').getContext('2d');

	const graph1 = new Chart(g1, {
		    type: 'bar',
            data: {
				labels: [";
			
for ($i = 0; $i < ($lignes1[0]->NOMBRE)-1; $i++) {

	echo "\"" . $graph1[$i]->COMMUNE . "\", ";

}
	echo "\"" . $graph1[$i]->COMMUNE . "\"";
			
	echo "], 
				datasets: [{
					label: 'Valeur moyenne des subventions versées par la ville',
					data: [";
			
for ($i = 0; $i < ($lignes1[0]->NOMBRE)-1; $i++) {

	echo $graph1[$i]->MOYENNE  . ", ";

}
	echo $graph1[$i]->MOYENNE ;
			
	echo "],
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(153, 102, 255, 0.2)',
						'rgba(255, 159, 64, 0.2)'
					],
					borderColor: [
						'rgba(255, 99, 132, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(255, 159, 64, 1)'
					],
					borderWidth: 1
			}]
	},
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

</script>

";




	echo "

<script>

	const g2 = document.getElementById('graph2').getContext('2d');

	const graph2 = new Chart(g2, {
		    type: 'bar',
            data: {
				labels: [";
			
for ($i = 0; $i < ($lignes2[0]->NOMBRE)-1; $i++) {

	echo "\"" . $graph2[$i]->NOM_MAGASIN . "\", ";

}
	echo "\"" . $graph2[$i]->NOM_MAGASIN . "\"";
			
	echo "], 
				datasets: [{
					label: 'Montant total des subventions versées',
					data: [";
			
for ($i = 0; $i < ($lignes2[0]->NOMBRE)-1; $i++) {

	echo $graph2[$i]->TOTAL  . ", ";

}
	echo $graph2[$i]->TOTAL ;
			
	echo "],
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(153, 102, 255, 0.2)',
						'rgba(255, 159, 64, 0.2)'
					],
					borderColor: [
						'rgba(255, 99, 132, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(255, 159, 64, 1)'
					],
					borderWidth: 1
			}]
	},
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

</script>

";



?>