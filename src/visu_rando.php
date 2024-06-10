<?php
	include_once "vendor/bdd_connexion/pdo_agile.php";
	include_once "vendor/bdd_connexion/param_connexion_etu.php";
	echo '<meta charset="utf-8"> ';
	define ("MOD_BDD","ORACLE");
	
	$db_username = $db_usernameOracle;		
	$db_password = $db_passwordOracle;	
	$db = $dbOracle;
	
	$conn = OuvrirConnexionPDO($db,$db_username,$db_password);
	
	if ($conn)
	{
		echo ("<hr/> Connexion réussie à la base de données <br/>");
		$table = lireDonnees($conn);
		afficherObj($table);
	}
	
	//echo $cle ." " . $a . " ";
	
	function lireDonnees($c)
	{
		$sql = "select niv_code,per_num_guide,per_num_orga,ran_nom,ran_date_d,ran_date_fin,res_prix_pers,res_sup_solo,res_descriptif from alp_randonnee";
		$tab =array();
		$donnee = LireDonneesPDO1($c,$sql, $tab);
		$cpt = 0;
		$tab2 = array();

		foreach($tab as $v){
			foreach($v as $cle=>$a){
				$tab2[$cpt] = $a;
				$cpt++;
			}
			echo "<br/>";
			echo "$tab2[8]";
			$cpt = 0;
		}

		afficherObj($tab);
		return $donnee;
	}
	
/*"select niv_code,per_num_guide,per_num_orga,ran_nom,ran_date_d,
		ran_date_fin,res_prix_pers,res_sup_solo,res_descriptif from alp_randonnee"*/
 ?>

