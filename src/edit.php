<?php
require_once "backend/vendor/check_connexion.php";
require_once "backend/vendor/fonctions.php";
require_once "backend/vendor/param_connexion.php";
require_once "backend/vendor/pdo_agile.php";
$conn = OuvrirConnexionPDO($db, $db_username, $db_password);

$tab = getPersonne($conn, $_SESSION['user_id']);
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

  <main class="container mt-5">
    <h2 class="my-5 text-center">Modifier son Profil</h2>
    <div class="container">
      <div class="main-body">
        <div class="row">
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                  <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                  <div class="mt-3">
                    <?php

                    echo '<h4>' . $tab['PER_PRENOM'] . ' ' . $tab['PER_NOM'] . '</h4>';
                    if (ifOrga($conn, $_SESSION['user_id'])) {
                      echo '<button class="btn btn-outline-primary m-2">Organisateur</button>';
                    }
                    if (ifClient($conn, $_SESSION['user_id'])) {
                      echo '<button class="btn btn-outline-primary m-2">Randonneur</button>';
                    }
                    if (ifGuide($conn, $_SESSION['user_id'])) {
                      echo '<button class="btn btn-outline-primary m-2">Guide</button>';
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <form class="col-lg-8 m-0" action="backend/account/editForm.php" method="post">
            <div class="card">
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Nom</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?php
                    echo '<input type="text" name="nom" class="form-control" value="' . $tab['PER_NOM'] . '">'; ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Prénom</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?php
                    echo '<input type="text" name = "prenom" class="form-control" value="' . $tab['PER_PRENOM'] . '">'; ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Email</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?php
                    echo '<input type="text" name = "courriel" class="form-control" value="' . $tab['PER_COURRIEL'] . '">'; ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Téléphone</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?php
                    echo '<input type="text" name = "tel" class="form-control" value="' . $tab['PER_TELEPHONE'] . '">'; ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Ville</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?php
                    echo '<input type="text" name = "ville" class="form-control" value="' . $tab['PER_VILLE'] . '">'; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3"></div>
                  <div class="col-sm-9 text-secondary">
                    <input type="submit" class="btn btn-primary px-4" value="Sauvegarder">
                    <a class="btn btn-outline-primary btn-rounded" href="profil.php" role="button">Annuler</a>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
  </main>

      <footer>
        <?php 
          include 'footer.php';
        ?>
      </footer>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>