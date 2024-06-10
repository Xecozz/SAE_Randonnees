<?php
session_start();
require_once "check_connexion.php";
require_once "vendor/bdd_connexion/fonctions.php";
require_once "vendor/bdd_connexion/param_connexion_etu.php";
require_once "vendor/bdd_connexion/connexion_pdo_etu.php";

$num = $_SESSION['user_id'];


$db_username = $db_usernameOracle;
$db_password = $db_passwordOracle;
$db = $dbOracle;
$conn = OuvrirConnexionPDO($db, $db_username, $db_password);
//fonction pour verifier si la personne est organisateur ou client ou guide
if ($conn) {
    if (ifClient($conn, $num)) {
        $sql = "delete from alp_client where per_num = $num";
        corrigerDonnees($conn, $sql);
    }
    if (ifOrga($conn, $num)) {
        $sql = "delete from alp_organisateur where per_num = $num";
        corrigerDonnees($conn, $sql);
    }
    if (ifGuide($conn, $num)) {
        $sql = "delete from alp_guide where per_num = $num";
        corrigerDonnees($conn, $sql);
    }
    $sql = "delete from alp_personne where per_num = $num";
    corrigerDonnees($conn, $sql);

    header('Location: index.php');
    session_destroy();

} else {
    echo "erreur connexion";
}

?>
