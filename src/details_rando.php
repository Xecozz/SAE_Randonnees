<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Randonnée</title>
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
    require_once "backend/vendor/pdo_agile.php";
    require_once "backend/vendor/param_connexion.php";
    
    $db_username = $db_usernameOracle;
    $db_password = $db_passwordOracle;
    $db = $dbOracle;
    $conn = OuvrirConnexionPDO($db, $db_username, $db_password);

    if ($conn) {
      $table = lireDonnees($conn);
      afficherObj($table);
    }
//join alp_passer using (ran_num) join alp_station using (sta_code) where ran_nom = $_POST[ran_nom] order by pas_num
function lireDonnees($c)
{
    $sql = "SELECT * FROM alp_randonnee 
            JOIN alp_passer USING (ran_num) 
            JOIN alp_station USING (sta_code) 
            WHERE ran_nom LIKE '%$_POST[ran_nom]%' 
            ORDER BY pas_num";
    $tab = array();
    $donnee = LireDonneesPDO1($c, $sql, $tab);
    
    echo '
    <div class="container mt-4">
        <h2>'. htmlspecialchars($_POST["ran_nom"]). '</h2>
        <p>Date de début : ' . htmlspecialchars($_POST["date_debut"]) . '</p>
        <p>Date de fin : ' . htmlspecialchars($_POST["date_fin"]) . '</p>
        <p>Prix : ' . htmlspecialchars($_POST["prix"]) . '€</p>
        <p>Description : ' . htmlspecialchars($_POST["description"]) . '</p>
        <a class="btn btn-primary btn-rounded mb-4" href="formulaireInscription.php" role="button">m\'inscrire</a>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom de la Station</th>
                    <th>Date de Passage</th>
                    <th>Altitude (mètres)</th>
                </tr>
            </thead>
            <tbody>';

    foreach ($tab as $v) {
        $nom_station = htmlspecialchars($v['sta_nom']);
        $date_passage = htmlspecialchars($v['pas_date']);
        $altitude = htmlspecialchars($v['sta_altitude']);

        echo '
            <tr>
                <td>' . $nom_station . '</td>
                <td>' . $date_passage . '</td>
                <td>' . $altitude . '</td>
            </tr>';
    }

    echo '
            </tbody>
        </table>
    </div>';

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