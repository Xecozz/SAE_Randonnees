<?php

require_once "backend/vendor/check_connexion.php";
require_once "backend/vendor/param_connexion.php";
require_once "backend/vendor/pdo_agile.php";
require_once "backend/vendor/fonctions.php";

$conn = OuvrirConnexionPDO($db, $db_username, $db_password);

if (ifOrga($conn, $_SESSION['user_id']) == false){
	header('Location: index.php');
}


$sql = "SELECT sta_nom, sta_code, reg_nom FROM alp_station
		join alp_region using(reg_num)
		order by sta_nom";
$stationsData = array();
LireDonneesPDO1($conn, $sql, $stationsData);


?>


<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Formulaire Nouvelle Randonner</title>

  </head>
  <body>
	
    <form id="monFormulaire" name="monFormulaire" action = "traitement_formulaireRandoV2.php" method="post" enctype="application/x-www-form-urlencoded">
	
  	    
		<br/>
		<label for="nom">Nom de la Randonnee : </label><input type="text" id="nomRando" name="nomRando" size="20" value=""><br />
		
		<label for="niveau">Niveau de la randonnee : </label> 	
		
		<select name="niveau" size="1">		
	      <option value="1" selected> Découverte</option>
	      <option value="2"> Facile</option>
	      <option value="3"> Moyen</option>
	      <option value="4"> Physique</option>
		  <option value="5"> Sportif</option>
		  <option value="6"> Trekking</option>
        </select><br />

		<label for="nomGuide">Nom du Guide : </label><input type="text" id="nomGuide" name="nomGuide" size="20" value="" placeholder="Si nécessaire"><br />
		<label for="prenomGuide">Prénom du Guide : </label><input type="text" id="prenomGuide" name="prenomGuide" size="20" value="" placeholder="Si nécessaire"><br />
				
		<label for="prixPers">Prix par personne : </label><input type="number" min="0" id="prixPers" name="prixPers" size="20" value=""><br />
		<label for="supUnePers">Supplement personne solo : </label><input type="number" min="0" id="supUnePers" name="supUnePers" size="20" value=""><br />

		<label for="descriptif">Descriptif </label><textarea name="descriptif" cols="50" rows="5"></textarea><br />

		<table id="tab">
			<thead>
				<tr>
					<th scope="col">Station</th>
					<th scope="col">Date de passage</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				  <th><select class="form-select" id="station1" name="station1" required>
          			<option selected>Choissisez une station</option>
         			 <?php foreach ($stationsData as $station) : ?>
          				  <option value="<?= $station['STA_CODE'] ?>"><?= $station['STA_NOM']?> (<?= $station['REG_NOM']?>)</option>
         			 <?php endforeach; ?>
       			 </select></th>
				  <td><input type="date" id="date1" name="date1" size="20" value=""></td>
				</tr>
				<tr>
				<th><select class="form-select" id="station2" name="station2" required>
          			<option selected>Choissisez une station</option>
         			 <?php foreach ($stationsData as $station) : ?>
          				  <option value="<?= $station['STA_CODE'] ?>"><?= $station['STA_NOM']?> (<?= $station['REG_NOM']?>)</option>
         			 <?php endforeach; ?>
       			 </select></th>
				  <td><input type="date" id="date2" name="date2" size="20" value=""></td>
				  </tr>
				  <tr>
				  <th><select class="form-select" id="station3" name="station3" required>
          			<option selected>Choissisez une station</option>
         			 <?php foreach ($stationsData as $station) : ?>
          				  <option value="<?= $station['STA_CODE'] ?>"><?= $station['STA_NOM']?> (<?= $station['REG_NOM']?>)</option>
         			 <?php endforeach; ?>
       			 </select></th>
				  <td><input type="date" id="date3" name="date3" size="20" value=""></td>
				  </tr>
			  </tbody>

		</table>
		

        <br/>   
	
	  <!-- troisième groupe de composants-->
		<input type="submit" name="BtSub" value="Ajouter">
        <br />
      <br />
	</form>

	<script src="js/script.js"></script>
  </body>
</html>