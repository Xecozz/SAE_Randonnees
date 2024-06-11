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
    <form action="recherche_rando.php" id="searchbar" class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="nom">
      <button class="btn btn-outline-success" type="submit">Chercher</button>
      </br>
      <label>Prix minimum : </label>
      <input class="form-control me-2" type="number" placeholder="par personne" name="prix_min">
      <label>Prix maximum : </label>
      <input class="form-control me-2" type="number" placeholder="par personne" name="prix_max">
      </br>
      <label>Date de départ : </label>
      <input class="form-control me-2" type="date" name="date_dep">
      <label>Date de d'arrivée : </label>
      <input class="form-control me-2" type="date" name="date_arr">
    </form>
    <?php
    header('Content-Type: text/html; charset=utf-8');
    require_once "backend/vendor/pdo_agile.php";
    require_once "backend/vendor/param_connexion.php";
    define("MOD_BDD", "ORACLE");

    $db_username = $db_usernameOracle;
    $db_password = $db_passwordOracle;
    $db = $dbOracle;

    $conn = OuvrirConnexionPDO($db, $db_username, $db_password);

    if ($conn) {
      $table = lireDonnees($conn);
      afficherObj($table);
    }

    function lireDonnees($c)
    {
      $cpt2 = 0;

      

      $sql = "select * from alp_randonnee where ";
      if(isset($_GET["nom"])){
        $sql = $sql . "upper(ran_nom) like upper('%$_GET[nom]%') ";
        $cpt2++;
      }

      if ($_GET["prix_min"] != "" && $cpt2 >= 1) {
        $sql = $sql . "and $_GET[prix_min] <= res_prix_pers ";
        $cpt2++;
      }
      else if ($_GET["prix_min"] != "" && $cpt2 < 1) {
        $sql = $sql . "$_GET[prix_min] <= res_prix_pers ";
        $cpt2++;
      }
      if ($_GET["prix_max"] != "" && $cpt2 >= 1) {
        $sql = $sql . "and $_GET[prix_max] >= res_prix_pers ";
        $cpt2++;
      }
      else if ($_GET["prix_max"] != "" && $cpt2 < 1) {
        $sql = $sql . "$_GET[prix_max] >= res_prix_pers ";
        $cpt2++;
      }

      if ($_GET["date_dep"] != "" && $cpt2 >= 1) {
        $sql = $sql . "and to_date('$_GET[date_dep]', 'yyyy/mm/dd') = ran_date_d ";
        $cpt2++;
      }
      else if ($_GET["date_dep"] != "" && $cpt2 < 1) {
        $sql = $sql . "to_date('$_GET[date_dep]', 'yyyy/mm/dd') = ran_date_d ";
        $cpt2++;
      }
      if ($_GET["date_arr"] != "" && $cpt2 >= 1) {
        $sql = $sql . "and to_date('$_GET[date_arr]', 'yyyy/mm/dd') = ran_date_fin ";
        $cpt2++;
      }
      else if ($_GET["date_arr"] != "" && $cpt2 < 1) {
        $sql = $sql . "to_date('$_GET[date_arr]', 'yyyy/mm/dd') = ran_date_fin ";
        $cpt2++;
      }
      $sql = $sql ."order by ran_num DESC";
      echo $sql;

      
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
    ?>
  </main>


  <footer class="text-center text-lg-start text-white" style="background-color: black">
      <?php 
          include 'footer.php';
      ?>
  </footer>
</body>

</html>