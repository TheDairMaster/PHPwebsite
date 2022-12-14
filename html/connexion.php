<?php
$HOST='10.153.3.17';
$SID='db01';
$PORT='1521';
$USER='iut024';
$MDP='iut024';    
    
try {
$config =
  "(DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = $HOST)(PORT = $PORT))
    (CONNECT_DATA =
      (SID = $SID)
    )
  )";

	$mabase = new PDO("oci:dbname=" . $config . ";charset=utf8", $USER, $MDP, array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ));
} catch (PDOException $e) {
    print "Erreur : " . $e->getMessage() . "<br/>";
    die();
}

function lancerRequete($sql, $bd){
    $donnees=null;
	$res=$bd->prepare($sql);
	$res->execute();
	if($res){
		$donnees=$res->fetchAll(PDO::FETCH_OBJ);
		$res->closeCursor();
	}
	return $donnees;
}

/*$sql =  'select * from entreprise';
$data = lancerRequete($sql, $mabase);
/*

echo "<table class=text-light>";

foreach  ($data as $ligne) {
	echo "<tr>";
    echo "<td>" . $ligne->SIRET . "</td> <td>". $ligne->NOM_ENTREPRISE . "</td>";
	echo "</tr>";
}

echo "</table>";
*/
?>