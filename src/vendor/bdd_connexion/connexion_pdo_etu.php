<?php
require_once "pdo_agile.php";
require_once "param_connexion_etu.php";
echo '<meta charset="utf-8"> ';
//fonction utile
function insererDonnee($c, $sql)
{
	afficherObj($sql);
	$res = majDonneesPDO($c, $sql);
	echo "Résultats de la requête ", $res . "<br/>";
}

function corrigerDonnees($c, $sql)
{
	afficherObj($sql);
	$res = majDonneesPDO($c, $sql);
	echo "Résultats de la requête " . $res . "<br/>";
}

function lireDonnees($c, $sql)
{
	$tab = array();
	$donnee = LireDonneesPDO1($c, $sql, $tab);

	foreach ($tab as $v) {
		foreach ($v as $cle => $a) {
			echo $cle . " " . $a . " ";
		}
		echo "<br/>";
	}
	return $donnee;
}

function afficherObj($obj)
{
	echo "<PRE>";
	print_r($obj);
	echo "</PRE>";
}

?>