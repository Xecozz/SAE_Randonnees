<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Detail Station</title>
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
    <?php
    require_once "backend/vendor/check_connexion.php";
    require_once "backend/vendor/fonctions.php";
    require_once "backend/vendor/pdo_agile.php";
    require_once "backend/vendor/param_connexion.php";
    $conn = OuvrirConnexionPDO($db, $db_username, $db_password);

    if (!isset($_GET['id'])) {
      header('Location: stations.php');
    }

    $id = $_GET['id'];

    if ($conn) {
      if(!ifOrga($conn, $_SESSION['user_id'])){
        header('Location: stations.php');
      }

      $sql = "select sta_code, sta_nom, sta_longitude, sta_latitude, sta_altitude, reg_nom from alp_station join alp_region using(reg_num) where sta_code like '%" . $id . "%' order by sta_nom asc";
      lireDonneesStat($conn, $sql);
    }
    //join alp_passer using (ran_num) join alp_station using (sta_code) where ran_nom = $_POST[ran_nom] order by pas_num
    function lireDonneesStat($c, $sql)
    {
      $tab = array();
      LireDonneesPDO1($c, $sql, $tab);

      foreach ($tab as $v) {
        echo '
  <div id="container-station">
  <h3>' . $v['STA_NOM'] . '</h3>
  <p class="para">Longitude : ' . $v['STA_LONGITUDE'] . '</p>
  <p class="para">Latitude : ' . $v['STA_LATITUDE'] . '</p>
  <p class="para">Altitude : ' . $v['STA_ALTITUDE'] . '</p>
  <p>Region : ' . $v['REG_NOM'] . '</p>
  </div>';
        echo "<br/>";
      }
    }

    ?>
  </main>
  <?php
  require_once 'footer.php';
  ?>
</body>



</html>