<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=yoda;charset=utf8', 'root', 'cetroxNEST');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$arrayBrowser =[];
$arrayNbr = [];
$arrayColor = [];
$array = [];
$total = 0;


function Percent($Nombre, $Total) {
	return $Nombre * 100 / $Total;
}


$select = $bdd->query('SELECT COUNT(*) FROM YDA_SPY');

while ($query = $select->fetch()){

    $total = $query['COUNT(*)'];
    
}


$select = $bdd->query('SELECT SPY_PAGE, COUNT(*) FROM `YDA_SPY` GROUP BY SPY_PAGE');

while ($query = $select->fetch()){
    
      array_push($arrayBrowser, substr($query['SPY_PAGE'], 6));
      array_push($arrayNbr,$query['COUNT(*)']); 
      array_push($arrayColor, '#'.dechex(rand(0x000000, 0xFFFFFF)));
    
    }
$select->closeCursor();
array_push($array, $arrayBrowser, $arrayNbr, $arrayColor);
$array['total'] = $total;

    header("content-type:application/json");
    echo json_encode($array);
    
?>