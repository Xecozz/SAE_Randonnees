<DOCTYPE html>

  <html>

  <head>
    <meta charset="utf-8">
    <title>Randonnees</title> <!-- titre en HTML -->
    <link rel="stylesheet" href="styles/styles.css">
  </head>

  <body>
    <?php

    echo "WESG MAMELLE GANGRENELLE";
    if (isset($_GET['id'])) {
      echo "Je suis $_GET[id]";
    }


    function lireDonnees($c)
    {
      $sql = "select * from alp_randonnee join alp_passer using (ran_num) join alp_station using (sta_code) where ran_num = $_GET[id] order by pas_num";
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
        $cpt = 0;
        echo "<br/>";
      }

      afficherObj($tab);
      return $donnee;
    }

    ?>
  </body>



  </html>