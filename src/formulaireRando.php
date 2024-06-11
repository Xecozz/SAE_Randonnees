<?php
require_once "backend/vendor/check_connexion.php";
require_once "backend/vendor/param_connexion.php";
require_once "backend/vendor/pdo_agile.php";

$conn = OuvrirConnexionPDO($db, $db_username, $db_password);
$sql = "SELECT sta_nom FROM alp_station";
$stationsData = array();
LireDonneesPDO1($conn, $sql, $stationsData);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Etude réalisé</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <header>
    <?php
      include 'navbar.php';
    ?>
      </header>

      <main>
      
      <form id="monFormulaire" name="monFormulaire" action="backend/rando/traitement_formulaireRando.php" method="post" enctype="application/x-www-form-urlencoded">
      <div class="mb-3 mt-3">
        <label for="nom" class="form-label">Nom de la randonnée *</label>
        <input type="text" class="form-control" id="nomRando" name="nomRando" required>
      </div>
      <div class="mb-3">
        <label for="niveau" class="form-label">Niveau de la randonnée *</label>
        <select name="niveau" size="1">
          <option value="1" selected> Découverte</option>
          <option value="2"> Facile</option>
          <option value="3"> Moyen</option>
          <option value="4"> Physique</option>
          <option value="5"> Sportif</option>
          <option value="6"> Trekking</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="nomGuide" class="form-label">Nom du Guide</label>
        <input type="text" class="form-control" name="nomGuide" id="nomGuide">
      </div>
      <div class="mb-3">
        <label for="prenomGuide" class="form-label">Prénom du guide</label>
        <input type="text" class="form-control" id="prenomGuide" name="prenomGuide">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Région de départ</label>
        <input type="text" class="form-control" id="regionDep" name="regionDep">
      </div>
      <div class="mb-3">
        <label for="stationDep" class="form-label">Station de départ *</label>
        <select class="form-select" id="stationDep" name="stationDep" required>
          <option selected>Choissisez une station</option>
          <?php foreach ($stationsData as $station) : ?>
            <option value="<?= $station['STA_NOM'] ?>"><?= $station['STA_NOM'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Date de départ *</label>
        <input type="date" class="form-control" id="dateDep" name="dateDep" required>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Région d'arrivée</label>
        <input type="text" class="form-control" id="regionFin" name="regionFin">
      </div>
      <div class="mb-3">
        <label for="stationFin" class="form-label">Station de fin *</label>
        <select class="form-select" id="stationFin" name="stationFin" required>
          <option selected>Choissisez une station</option>
          <?php foreach ($stationsData as $station) : ?>
            <option value="<?= $station['STA_NOM'] ?>"><?= $station['STA_NOM'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Date de fin *</label>
        <input type="date" class="form-control" id="dateFin" name="dateFin" required>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Prix par personne *</label>
        <input type="number" class="form-control" id="prixPers" name="prixPers" required>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Supplément personne solo *</label>
        <input type="number" class="form-control" id="supUnePers" name="supUnePers" required>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Descriptif </label>
        <input type="text" class="form-control" name="descriptif">
      </div>
      <input type="submit" name="BtSub" value="Ajouter">
    </form>
      

  <!-- troisième groupe de composants-->
      </main>


      <footer>
        <?php 
          include 'footer.php';
        ?>
      </footer>

</body>

</html>