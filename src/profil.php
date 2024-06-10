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
            <a class="navbar-brand" href="index.html">
                <img id = "imageLogo" src="image/logo.png" alt="Logo" width="100" height="40" class="d-inline-block imageLogo">
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
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Informations
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="infoeco.html">Informations économiques</a>
                  <a class="dropdown-item" href="infoecolo.html">Informations écologiques</a>
                  <a class="dropdown-item" href="#">Statistiques</a>
                  
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Questionnaires
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="questhab.html">Questionnaire Habitant</a>
                  <a class="dropdown-item" href="questmairie.html">Questionnaire Mairie</a>
                  <a class="dropdown-item" href="questasso.html">Questionnaire Entreprise / Associations</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="faq.html">FAQ</a>
              </li>
              <li class="nav-item">
                <?php
                session_start();
                if (isset($_SESSION['user_id'])){
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

    <main class="container mt-5">
    <h2 class="my-5 text-center">Profil</h2>
    <div class="row gutters-sm">
      <div class="col-md-4 mb-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
              <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
              <div class="mt-3">
                <h4>John Doe</h4>
                <p class="text-secondary mb-1">Full Stack Developer</p>
                <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                <button class="btn btn-primary">Follow</button>
                <button class="btn btn-outline-primary">Message</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <div class="col-md-8">
      <div class="card mb-3">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Nom</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              Kenneth
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Prénom</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              Valdez
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Email</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              fip@jukmuh.al
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Téléphone</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              (239) 816-9029
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Ville</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              San Francisco
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-12">
              <a class="btn btn-info " target="__blank" href="edit.html">Edit</a>
            </div>
          </div>
        </div>
      </div>
      </div>
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
        <div
            class="text-center p-3"
            style="background-color: rgba(0, 0, 0, 0.2)"
            >
          © 2020 Copyright:
          <a class="text-white" href="https://mdbootstrap.com/"
            >MDBootstrap.com</a
            >
        </div>
      </div>
    </section>
  </div>
<!-- Copyright -->
</footer>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
<script src="navbar.js"></script>
</body>
</html>