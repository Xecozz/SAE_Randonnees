<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Randonnees</title> <!-- titre en HTML -->
		<link rel="stylesheet" href="styles/styles.css">
    </head>
	<body>
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
	
	function lireDonnees($c)
	{
		$sql = "select niv_code,per_num_guide,per_num_orga,ran_nom,ran_date_d,ran_date_fin,res_prix_pers,res_sup_solo,res_descriptif from alp_randonnee";
		$tab =array();
		$donnee = LireDonneesPDO1($c,$sql, $tab);
		$tab2=array();
		$cpt = 0;

		foreach($tab as $v){
			foreach($v as $cle=>$a){
				$tab2[$cpt]=$a;
				$cpt++;
			}
			echo '
			<div id="container-rando">
			<h3>'.$tab2[3].'</h3>
			<p class="para">Date de début : '.$tab2[4].'</p>
			<p class="para">Date de fin : '.$tab2[5].'</p>
			<p class="para">Prix : '.$tab2[6].' €</p>
			<h3>'.$tab2[8].'</h3>
			</div>';
			
			
			
			
			$cpt=0;
			echo "<br/>";
		}

		afficherObj($tab);
		return $donnee;
	}
	
 ?>
	</body>
</html>

	


