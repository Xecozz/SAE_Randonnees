<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Stations</title> <!-- titre en HTML -->
    <link rel="stylesheet" href="styles/styles.css">
</head>

<?php
require_once('navbar.php');
?>

<main>
    <h2 class="my-5 text-center">Rechercher une station</h2>
    <form class="searchbar  mt-0 mb-0" method="GET" action="stations.php">
        <input type="text" placeholder="Rechercher une station" aria-label="Search" name="nom">
        <button type="submit" class="btn btn-outline-success">Rechercher</button>
    </form>
    <!-- Toggle Button -->
    <div class="text-center">
        <button id="toggleButton" class="btn btn-outline-primary mt-3">Rechercher par secteur</button>
    </div>


    <!-- Sector Search Form -->
    <form id="sectorForm" class="searchbar-sector mt-5 mb-0" method="GET" action="stations.php">
        <input type="text" placeholder="Longitude *" aria-label="Search" name="longitude" required>
        <input type="text" placeholder="Latitude *" aria-label="Search" name="latitude" required>
        <input type="text" placeholder="Perimetre (en km) *" aria-label="Search" name="perimetre" required>
        <input type="text" placeholder="Altitude min (en m)" aria-label="Search" name="altMin">
        <input type="text" placeholder="Altitude max (en m)" aria-label="Search" name="altMax">
        <button type="submit" class="btn btn-outline-success mt-3">Rechercher par secteur</button>
    </form>
    <?php
    require_once "backend/vendor/check_connexion.php";
    require_once "backend/vendor/pdo_agile.php";
    require_once "backend/vendor/param_connexion.php";
    require_once "backend/vendor/fonctions.php";

    echo '<meta charset="utf-8"> ';

    $nom = "";
    $latitude = "";
    $longitude = "";
    $perimetre = "";
    $altMin = 0;
    $altMax = 200000;

    if (isset($_GET['nom'])) {
        $nom = strtoupper(trim($_GET['nom']));
    }
    if (isset($_GET['longitude'])) {
        $longitude = strtoupper(trim($_GET['longitude']));
    }
    if (isset($_GET['latitude'])) {
        $latitude = strtoupper(trim($_GET['latitude']));
    }
    if (isset($_GET['perimetre'])) {
        $perimetre  = strtoupper(trim($_GET['perimetre']));
    }
    if (isset($_GET['altMin'])) {

        $altMin = strtoupper(trim($_GET['altMin']));
    }
    if (isset($_GET['altMax'])) {
        $altMax = strtoupper(trim($_GET['altMax']));
    }

    $error = false;

    if ($longitude == "" || $latitude == "" || $perimetre == "") {
        $error = true;
    }

    $conn = OuvrirConnexionPDO($db, $db_username, $db_password);


    if ($conn) {

        if (!ifOrga($conn, $_SESSION['user_id'])) {
            header('Location: index.php');
        }


        $sql = "select sta_code, sta_nom, sta_longitude, sta_latitude, sta_altitude, reg_nom from alp_station join alp_region using(reg_num) order by sta_nom asc";

        if ($nom !== "") {
            $sql = "select sta_code, sta_nom, sta_longitude, sta_latitude, sta_altitude, reg_nom from alp_station join alp_region using(reg_num) where sta_nom like '%" . $nom . "%' order by sta_nom asc";
        }

        echo $altMin;
        echo $altMax;

        if (!$error) {
            $lat_range = $perimetre / 111;
            $lon_range = $perimetre / 78;

            if($altMin == "") {
                $altMin = 0;
            }
            if($altMax == "") {
                $altMax = 200000;
            }

            $sql2 = "
            SELECT sta_code, sta_nom, sta_longitude, sta_latitude, sta_altitude, reg_nom 
            FROM alp_station 
            JOIN alp_region USING(reg_num) 
            WHERE 
                sta_longitude BETWEEN " . ($longitude - $lon_range) . " AND " . ($longitude + $lon_range) . " 
                AND sta_latitude BETWEEN " . ($latitude - $lat_range) . " AND " . ($latitude + $lat_range) . " 
                AND sta_altitude BETWEEN " . $altMin . " AND " . $altMax . " 
            ORDER BY sta_nom ASC
            ";
            lireDonneesStat($conn, $sql2);
        } else {
            lireDonneesStat($conn, $sql);
        }
    }

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
            echo "<a class='navbar-brand' href='detailStation.php?id=" . $v['STA_CODE'] . "'>" . "En voir plus" . "</a>";
            echo "<br/>";
        }
    }

    ?>
</main>
<?php
require_once('footer.php');
?>

<script>
    document.getElementById('toggleButton').addEventListener('click', function() {
        var sectorForm = document.getElementById('sectorForm');
        if (sectorForm.style.display === 'none' || sectorForm.style.display === '') {
            sectorForm.style.display = 'block';
            this.textContent = 'Masquer la recherche par secteur';
        } else {
            sectorForm.style.display = 'none';
            this.textContent = 'Rechercher par secteur';
        }
    });
</script>

</html>