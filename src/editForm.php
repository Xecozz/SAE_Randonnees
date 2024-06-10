<?php
require_once "check_connexion.php";
require_once "vendor/bdd_connexion/fonctions.php";
require_once "vendor/bdd_connexion/param_connexion_etu.php";
require_once "vendor/bdd_connexion/pdo_agile.php";
require_once "vendor/bdd_connexion/connexion_pdo_etu.php";
$conn = OuvrirConnexionPDO($db, $db_username, $db_password);

if ($conn) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $courriel = $_POST['courriel'];
    $tel = $_POST['tel'];
    $num = $_SESSION['user_id'];

    $sql = "UPDATE alp_personne SET per_prenom = '$prenom', per_nom = '$nom', per_courriel = '$courriel', per_telephone = '$tel' WHERE per_num = $num";

    corrigerDonnees($conn, $sql);

    header('Location: edit.php');

}
else
    echo ("<hr/> Connexion impossible à la base de données <br/>");
?>
