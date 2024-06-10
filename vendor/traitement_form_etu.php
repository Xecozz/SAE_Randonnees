	<?php
	// E.Porcq : TP2 PHP Exo2
	// préparation SAE 2.456 : Traitement d'un formualaire
	// traitement_form_etu.php 29/05/2021

	function afficherObj($obj)
	{
		echo "<PRE>";
		print_r($obj);
		echo "</PRE>";
	}

	include_once "pdo_agile.php";
	include_once "param_connexion_etu.php";
	echo '<meta charset="utf-8"> ';
	define ("MOD_BDD","MYSQL");
	//define ("MOD_BDD","ORACLE");

	if (MOD_BDD == "MYSQL")
	{
		$db_username = $db_usernameMySQL;		
		$db_password = $db_passwordMySQL;
		$db = $dbMySQL;
	}
	else
	{
		$db_username = $db_usernameOracle;		
		$db_password = $db_passwordOracle;	
		$db = $dbOracle;
	}

	$conn = OuvrirConnexionPDO($db,$db_username,$db_password);
	
	// affichage brut des éléments du formulaire
	// placer le code ici
	$prenom;
	$code;
	$genre;
	$pays;
	$preference;
			
	$erreur=false; // true => formulaire défaut

	// il faut vérifier que ces données ont été saisies
	if (!empty($_POST["nom"])) 
		$nom = $_POST["nom"];
	else 
	    $erreur = true;

		if (!empty($_POST["prenom"])) 
		$prenom = $_POST["prenom"];
	else 
	    $erreur = true;

		if (!empty($_POST["code"])) 
		$code = $_POST["code"];
	else 
	    $erreur = true;

		if (!isset($_POST["genre"])) 
		$genre = $_POST["genre"];
	else 
	    $erreur = true;

		if (!isset($_POST["pays"])) 
		$pays = $_POST["pays"];
	else 
	    $erreur = true;

		if (!empty($_POST["preference"])) 
		$preference = $_POST["preference"];
	else 
	    $erreur = true;

	$prenom = $_POST["prenom"];
	$code = $_POST["code"];
	$genre =$_POST["genre"];
	$pays = $_POST["pays"];
	$preference =$_POST["preference"];

	echo $nom." ".$prenom." ".$code." ".$genre." ".$pays." ";

	
	$gouts = $_POST["gouts"]; // non obligatoire

	// calcul (simpliste) du numéro de personne
	$sql = "select max(per_num) from personne";
	$tab = array();
	LireDonneesPDO1($conn, $sql, $tab );
	$per_num = $tab[0];
	afficherObj(($tab));
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
		
	}
	?>
