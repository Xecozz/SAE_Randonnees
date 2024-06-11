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
    <h2 class="my-5 text-center">Rechercher une randonnée</h2>
    <a class="navbar-brand" href="formulaireRando.php">
      <button class="btn btn-outline-primary m-2">Créer une randonnée</button>
    </a>
    <form action="recherche_rando.php" id="searchbar" class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Rechercher une randonnée" aria-label="Search" name="nom">
      <button type="submit"><img src = "image/loupe.png"></button>
    </form>
    <?php
    header('Content-Type: text/html; charset=utf-8');
    include_once "backend/vendor/pdo_agile.php";
    include_once "backend/vendor/param_connexion.php";

    $conn = OuvrirConnexionPDO($db, $db_username, $db_password);

    if ($conn) {
      $table = lireDonnees($conn);
      afficherObj($table);
    }

    function lireDonnees($c)
    {
      $sql = "select * from alp_randonnee order by ran_num DESC";
      $tab = array();
      $donnee = LireDonneesPDO1($c, $sql, $tab);
      $tab2 = array();
      $cpt = 0;

      foreach ($tab as $v) {
        foreach ($v as $cle => $a) {
          $tab2[$cpt] = $a;
          $cpt++;
        }
        echo '
                <h3>' . $tab2[4] . '</h3>
                <p>Date de début : ' . $tab2[5] . '</p>
                <p>Date de fin : ' . $tab2[6] . '</p>
                <p>Prix : ' . $tab2[7] . ' €</p>
                <p>Description : ' . $tab2[9] . '</p>';
        
        echo '
        <form action="details_rando.php" method="POST">
        <input type="hidden" name="ran_nom" value="' . $tab2[4] . '">
        <input type="hidden" name="date_debut" value="' . $tab2[5] . '">
        <input type="hidden" name="date_fin" value="' . $tab2[6] . '">
        <input type="hidden" name="prix" value="' . $tab2[7] . '">
        <input type="hidden" name="description" value="' . $tab2[9] . '">
        <button type="submit" class="btn btn-primary">Details</button>
          </form>
        <br/>';




        $cpt = 0;
        echo "<br/>";
      }

      afficherObj($tab);
      return $donnee;
    }

    ?>
  </main>

  <footer>
        <?php 
          include 'footer.php';
        ?>
  </footer>
  
</body>

</html>