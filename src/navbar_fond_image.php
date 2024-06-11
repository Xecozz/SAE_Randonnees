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
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
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
</body>
</html>