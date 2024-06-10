<?php
	session_start();

	function afficherObj($obj)
	{
		echo "<PRE>";
		print_r($obj);
		echo "</PRE>";
	}

	
	require_once "check_connexion.php";

	include_once "vendor/bdd_connexion/pdo_agile.php";
	include_once "vendor/bdd_connexion/param_connexion_etu.php";
	echo '<meta charset="utf-8"> ';
	
	
	$db_username = $db_usernameOracle;		
	$db_password = $db_passwordOracle;	
	$db = $dbOracle;
	

	$conn = OuvrirConnexionPDO($db,$db_username,$db_password);

	// affichage brut des éléments du formulaire
	afficherObj($_POST);

	$erreur = false;
	
	// il faut vérifier que ces données ont été saisies
	if (empty($_POST["nomRando"]) ){
		afficherObj("Veuillez mettre un nom de randonnée");
		$erreur = true;
	}else{
		$nomRando = $_POST["nomRando"];
	}

	if (empty($_POST["niveau"]) || $_POST["niveau"] <= 0 || $_POST["niveau"] > 6 ){
		afficherObj("Merci de rentrée un niveau valide");
		$erreur = true;
	}else {
		$niveau = $_POST["niveau"];
	}
	
	// début modifs macéo
	
	if (isset($_POST["regionDep"]) && !empty($_POST["regionDep"])) {
		$regionDep = $_POST["regionDep"];
	} else {
		$regionDep = 'Aucune';
	}
	
	$sql = "select reg_num from alp_region
			where upper(reg_nom) = upper('$regionDep')";
	
	LireDonneesPDO2($conn, $sql, $regDepData);
	
	if (isset($regDepData[0])) {
		$codeRegionDep = $regDepData[0]['REG_NUM'];
	} else {
		$codeRegionDep = '0';
		afficherObj("La région de départ que vous avez indiquée n'existe pas.");
		$erreur = true;
	}
	
	if (empty($_POST["stationDep"])) {
		afficherObj("Veuillez mettre un nom de station de départ");
		$erreur = true;

	} else {
		$stationDep = $_POST["stationDep"];
		
		$sql = "select sta_code from alp_station
				where upper(sta_nom) = upper('$stationDep')
				and reg_num = '$codeRegionDep'";
		
		LireDonneesPDO2($conn, $sql, $staDepData);
		
		if (empty($staDepData)) {
			afficherObj("La station de départ que vous avez indiquée n'a pas été trouvée dans cette région.");
			$erreur = true;
		} else {
			$codeStaDep = $staDepData[0]['STA_CODE'];
		}

	}
	
	$now = time();
	if (empty($_POST["dateDep"])) {
		afficherObj("Veuillez mettre une date de depart");
		$erreur = true;

	} else {

		$dateDep = $_POST["dateDep"];
		$timeDep = strtotime($_POST["dateDep"]);
		
		if ($timeDep < $now) {
			afficherObj("Vous avez choisi $dateDep comme date de départ. Vous devez choisir une date qui n'a pas encore eu lieu.");
			$erreur = true;
		}
	}

	if (isset($_POST["regionFin"]) && !empty($_POST["regionFin"])) {
		$regionFin = $_POST["regionFin"];
	} else {
		$regionFin = 'Aucune';
	}
	
	$sql = "select reg_num from alp_region
			where upper(reg_nom) = upper('$regionFin')";
	
	LireDonneesPDO2($conn, $sql, $regFinData);
	
	if (isset($regFinData[0])) {
		$codeRegionFin = $regFinData[0]['REG_NUM'];
	} else {
		$codeRegionFin = '0';
		afficherObj("La région de fin que vous avez indiquée n'existe pas.");
		$erreur = true;
	}
	
	if (empty($_POST["stationFin"])) {
		afficherObj("Veuillez mettre un nom de station de fin");
		$erreur = true;
	} else {
		$stationFin = $_POST["stationFin"];
		
		$sql = "select sta_code from alp_station
				where upper(sta_nom) = upper('$stationFin')
				and reg_num = '$codeRegionFin'";
		
		LireDonneesPDO2($conn, $sql, $staFinData);
		
		if (empty($staFinData)) {
			afficherObj("La station de fin n'a pas été trouvée dans cette région.");
			$erreur = true;
		} else {
			$codeStaFin = $staFinData[0]['STA_CODE'];
		}

	}

	if (empty($_POST["dateFin"])) {
		afficherObj("Veuillez mettre une date de fin");
		$erreur = true;

	} else {

		$dateFin = $_POST["dateFin"];
		$timeFin = strtotime($_POST["dateFin"]);
		
		if ($timeFin < $now || $timeFin < $dateDep) {
			afficherObj("Vous avez choisi $dateFin comme date de fin. Vous devez choisir une date qui n'a pas encore eu lieu et qui se situe après la date de départ.");
			$erreur = true;
		}
	}
	
	// fin modifs

	if (empty($_POST["prixPers"]) || $_POST["prixPers"] < 0 ){
		afficherObj("Veuillez mettre un prix");
		$erreur = true;
	}else {
		$prixPers = $_POST["prixPers"];
	}

	if (empty($_POST["supUnePers"])  || $_POST["supUnePers"] < 0  ){
		afficherObj("Veuillez mettre un prix");
		$erreur = true;
	}else {
		$supUnePers = $_POST["supUnePers"];
	}


	
	// calcul (simpliste) du numéro de personne
	$sql = "select nvl(max(ran_num),0) as maxi from ALP_RANDONNEE";
	LireDonneesPDO2($conn,$sql,$donnee);  
	$ran_num = $donnee[0]['MAXI'] + 1;

	$num_guide = '';

	//verification que le guide existe si il y a
	if(!empty($_POST["nomGuide"]) && !empty($_POST["prenomGuide"])){
		$nomGide = $_POST["nomGuide"];
		$prenomGuide = $_POST["prenomGuide"];
		
		$sql = "select per_num from ALP_PERSONNE
		join ALP_GUIDE using(per_num)
		where upper(per_nom) = upper('$nomGide')
		and upper(per_prenom) = upper('$prenomGuide')";

		
		$nb = LireDonneesPDO2($conn,$sql,$donnee);  
		
		
		if ($nb == 0){
			afficherObj("Veuillez entrer un guide correcte");
			$erreur == true;
		}else {
			$num_guide = $donnee[0]["PER_NUM"];
		}
		

	}
	
	$description = $_POST["descriptif"];

	$numOrga = $_SESSION["user_id"];
	


	afficherObj($_SESSION);
	
	if (	$erreur == false )

	{	
		$sql = "INSERT INTO alp_randonnee VALUES ($ran_num,'$niveau','".$num_guide."','".$numOrga."','".$nomRando."',to_date('".$dateDep."','yyyy-mm-dd'),to_date('".$dateFin."','yyyy-mm-dd'),'".$prixPers."','".$supUnePers."','".$description."')";
		afficherObj($sql);
		$res = majDonneesPDO($conn,$sql);

		
		echo "Résultats de la requête ",$res . "<br/>";
		afficherObj($res);
		
	}

?>
