<?php
	// E.Porcq : TP2 PHP Exo2
	// préparation SAE 2.456 : Traitement d'un formualaire
	// traitement_form.php 29/05/2021

	function afficherObj($obj)
	{
		echo "<PRE>";
		print_r($obj);
		echo "</PRE>";
	}


	include_once "vendor/bdd_connexion/pdo_agile.php";
	include_once "vendor/bdd_connexion/param_connexion_etu.php";
	echo '<meta charset="utf-8"> ';
	
	
	$db_username = $db_usernameOracle;		
	$db_password = $db_passwordOracle;	
	$db = $dbOracle;
	

	$conn = OuvrirConnexionPDO($db,$db_username,$db_password);

	// affichage brut des éléments du formulaire
	afficherObj($_POST);

	
	// il faut vérifier que ces données ont été saisies
	if (empty($_POST["nomRando"]) ){
		afficherObj("Veuillez mettre un nom de randonnée");
	}

	if (empty($_POST["niveau"]) || $_POST["niveau"] <= 0 || $_POST["niveau"] > 6 ){
		afficherObj("Merci de rentrée un niveau valide");
	}
	
	if (empty($_POST["stationDep"]) ){
		afficherObj("Veuillez mettre un nom de qtation de départ");
	}
	if (empty($_POST["dateDep"]) ){
		afficherObj("Veuillez mettre une date de depart");
	}
	if (empty($_POST["stationFin"]) ){
		afficherObj("Veuillez mettre un nom de station d'arrivée");
	}
	if (empty($_POST["dateFin"]) ){
		afficherObj("Veuillez mettre une date de fin");
	}
	if (empty($_POST["stationDep"]) ){
		afficherObj("Veuillez mettre un nom de randonnée");
	}
	if (empty($_POST["stationDep"]) ){
		afficherObj("Veuillez mettre un nom de randonnée");
	}
	if (empty($_POST["stationDep"]) ){
		afficherObj("Veuillez mettre un nom de randonnée");
	}
	if (empty($_POST["stationDep"]) ){
		afficherObj("Veuillez mettre un nom de randonnée");
	}
	


	

	
	/*

	$gouts = $_POST["gouts"]; // non obligatoire
	
	// calcul (simpliste) du numéro de personne
	$sql = "select nvl(max(per_num),0) as maxi from personne";
	LireDonneesPDO2($conn,$sql,$donnee);  
	afficherObj($donnee);
	$per_num = $donnee[0]['MAXI'] + 1;

	if (	$erreur == false )
	{	
		$sql = "INSERT INTO personne VALUES ($per_num,'$nom','".$prenom."','".$code."','".$genre."','".$pays."','".$gouts."')";
		afficherObj($sql);
		$res = majDonneesPDO($conn,$sql);
		echo "Résultats de la requête ",$res . "<br/>";
		afficherObj($res);
	}
	else
		afficherObj("Le formulaire n'est pas complet");


	// partie 2
	if (	$erreur == false )
	{
		afficherObj($preference);
		$pref = "";
		foreach($preference as $cle=>$value )
		{
			$sql = "INSERT INTO preference VALUES ($per_num,'$value')";
			afficherObj($sql);
			$res = majDonneesPDO($conn,$sql);
			echo "Résultats de la requête ",$res . "<br/>";
		}
	}		

*/

?>
