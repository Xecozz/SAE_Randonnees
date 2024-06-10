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
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark navbar-scrolled">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
          <img id="imageLogo" src="image/logo.png" alt="Logo" width="100" height="40" class="d-inline-block imageLogo">
          Accueil
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="randonnee.php">Randonnée</a>
            </li>
            <li class="nav-item">
              <?php
              session_start();
              if (isset($_SESSION['user_id'])) {
                echo '<a class="nav-link" href="profil.php">Profil</a>';
              } else {
                echo '<a class="nav-link" href="connexion.html">Connexion</a>';
              }
              ?>
            </li>
          </ul>

        </div>
      </div>
    </nav>
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


  <footer class="text-center text-lg-start text-white" style="background-color: black">
    <div class="container p-4 pb-0">
      <!-- Section: Links -->
      <section class="">
        <!--Grid row-->
        <div class="row">
          <!--Grid column-->
          <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase">Newsletter</h5>

            <p>
              La newsletter de Paris 2024 est votre rendez-vous pour tout savoir des Jeux qui se préparent près de chez vous.
            </p>
            <div class="text-center ronded-1 mt-5">
              <a class="btn btn-outline-light btn-rounded" href="https://www.paris2024.org/fr/newsletter/" role="button">En savoir plus</a>
            </div>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-md-6 mb-4">
            <h5 class="text-uppercase">Liens utiles</h5>

            <ul class="list-unstyled mb-0 lien">
              <li>
                <a href="https://olympics.com/en/" class="text-white">CIO</a>
              </li>
              <li>
                <a href="https://www.paralympic.org/" class="text-white">IPC</a>
              </li>
              <li>
                <a href="#!" class="text-white">CNOSF</a>
              </li>
              <li>
                <a href="#!" class="text-white">Beijing 2022</a>
              </li>
              <li>
                <a href="#!" class="text-white">Milano Cortina 2026</a>
              </li>
              <li>
                <a href="#!" class="text-white">LA 2028</a>
              </li>
              <li>
                <a href="#!" class="text-white">Olympic channel</a>
              </li>
            </ul>
          </div>
          <hr class="m-4 mb-4" />
          <div class="text-center p-3">
            <a href="#!" class="text-white">Mentions légales</a>
            <a href="#!" class="text-white">Accessibilité Site</a>
            <a href="#!" class="text-white">Politique de confidentialité</a>
            <a href="#!" class="text-white">Cybersécurité</a>
            <a href="#!" class="text-white">Cookies</a>
            <a href="#!" class="text-white">Appels d’Offres et Consultations</a>
            <a href="#!" class="text-white">Conditions Générales d’Achat</a>
          </div>


          <!-- Copyright -->
          <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2020 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
          </div>
        </div>
      </section>
    </div>
    <!-- Copyright -->
  </footer>
</body>

</html>