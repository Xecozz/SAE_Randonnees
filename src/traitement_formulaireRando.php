<?php
require_once "vendor/bdd_connexion/check_connexion.php";

include_once "vendor/bdd_connexion/pdo_agile.php";
include_once "vendor/bdd_connexion/param_connexion.php";

	function afficherObj($obj)
	{
		echo "<PRE>";
		print_r($obj);
		echo "</PRE>";
	}

	
	
	
	echo '<meta charset="utf-8"> ';
	
	
	$db_username = $db_usernameOracle;		
	$db_password = $db_passwordOracle;	
	$db = $dbOracle;
	

	$conn = OuvrirConnexionPDO($db,$db_username,$db_password);



	$erreur = false;
	
	// il faut vérifier que ces données ont été saisies
	if (empty($_POST["nomRando"]) ){
		afficherObj("Veuillez mettre un nom de randonnée");
		$erreur = true;
	}else{
		$nomRando = $_POST["nomRando"];
	}

	if (empty($_POST["niveau"]) || $_POST["niveau"] <= 0 || $_POST["niveau"] > 6 ){
		afficherObj("Merci de rentrer un niveau valide");
		$erreur = true;
	}else {
		$niveau = $_POST["niveau"];
	}

	/******************************************************************************************** */
	

	$i = 1;
	while (isset($_POST["station$i"])) {
		$max = $i;

		$i++;
	}

	$now = time();
	$oldTime = time(); // oldTime = le time de la date i-1

	for( $i = 1 ; $i < $max; $i++){
		if (!empty($_POST["station$i"]) && $_POST["station$i"] !== "Choissisez une station") {
			$tabSta[$i]["stationCode"] = $_POST["station$i"];

			if (!empty($_POST["date$i"])) {
				$date = $_POST["date$i"];
				$timeDep = strtotime($date);
				
				if ($i > 1) {
					if ($oldTime <= $timeDep) {
						$tabSta[$i]["date"] = $date;
					} else {
						afficherObj("Vous avez choisi $date comme date n°$i. Vous ne pouvez pas choisir une date qui se situe avant la date précédente.");
						$erreur = true;
					}
				} else {
					if ($timeDep > $now) {
						$tabSta[$i]["date"] = $date;
					} else {
						afficherObj("Vous avez choisi $date comme date de départ. Vous devez choisir une date qui n'a pas encore eu lieu.");
						$erreur = true;
					}
				}

				$oldTime = $timeDep;
			} else {
				afficherObj("Veuillez choisir une date au numéro $i");
				$erreur = true;
				break;
			}
		} else {
			afficherObj("Veuillez mettre un nom de station au numéro $i");
			$erreur = true;
			break;
		}
	}

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
			afficherObj("Veuillez entrer un guide correct");
			$erreur == true;
		}else {
			$num_guide = $donnee[0]["PER_NUM"];
		}
		

	}
	
	$description = $_POST["descriptif"];

	$numOrga = $_SESSION["user_id"];
	
	
	if ($erreur == false )

	{	
		$sql = "INSERT INTO alp_randonnee VALUES ($ran_num,'$niveau','".$num_guide."','".$numOrga."','".$nomRando."',to_date('".$tabSta[1]["date"]."','yyyy-mm-dd'),to_date('".$tabSta[$max-1]["date"]."','yyyy-mm-dd'),'".$prixPers."','".$supUnePers."','".$description."')";
		
		majDonneesPDO($conn,$sql);


		for ($i = 1; $i < $max; $i++) {
			majDonneesPDO($conn,"INSERT INTO alp_passer VALUES ('" . $tabSta[$i]["stationCode"] . "','$ran_num',$i,to_date('". $tabSta[$i]["date"]."','yyyy-mm-dd'))");
		}
		
		echo "Votre randonnée a bien été ajoutée <br/>";
		
		
	}

?>
