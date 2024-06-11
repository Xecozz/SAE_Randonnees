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

  <main class="mt-10">
  <?php
    require_once "backend/vendor/pdo_agile.php";
    require_once "backend/vendor/param_connexion.php";
    require_once "backend/vendor/fonctions.php";
    
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
    $tab2 = array();
    $cpt = 0;
    
    echo '
    <div class="container mt-4 ">
        <table class="table mt-4">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">Date de début</th>
            <th scope="col">Date de fin</th>
            <th scope="col">Prix</th>
            <th scope="col">Description</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">'. htmlspecialchars($_POST["ran_nom"]). '</th>
            <td>' . htmlspecialchars($_POST["date_debut"]) . '</td>
            <td>' . htmlspecialchars($_POST["date_fin"]) . '</td>
            <td>' . htmlspecialchars($_POST["prix"]) . '€</td>
            <td>' . htmlspecialchars($_POST["description"]) . '</td>
          </tr>
        </tbody>
      </table>
        
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
              foreach ($v as $cle => $a) {
                $tab2[$cpt] = $a;
                $cpt++;
              }

        echo '
            <tr>
                <td>' . $tab2[14]. '</td>
                <td>' . $tab2[12] . '</td>
                <td>' . $tab2[17] . '</td>';
                if(ifOrga($c, $_SESSION['user_id'])){
                  echo '<td><a href="detailStation.php?id=' . $v['STA_CODE'] . '" class="btn btn-primary">Détails</a></td>';
                }
            echo '</tr>';

            $cpt = 0;
    }

    echo '
            </tbody>
        </table>
    </div>';

    afficherObj($tab);
    return $donnee;
}
?>
<a class="btn btn-primary btn-rounded" href="formulaireInscription.html" role="button">S'inscrire</a>
  </main>

  <footer>
        <?php 
          include 'footer.php';
        ?>
  </footer>
  </body>



  </html>