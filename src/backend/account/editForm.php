<?php
require_once "../vendor/check_connexion.php";
require_once "../vendor/fonctions.php";
require_once "../vendor/param_connexion.php";
require_once "../vendor/pdo_agile.php";
require_once "../vendor/connexion_pdo.php";
$conn = OuvrirConnexionPDO($db, $db_username, $db_password);

if ($conn) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $courriel = $_POST['courriel'];
    $tel = $_POST['tel'];
    $num = $_SESSION['user_id'];

    $sql = "UPDATE alp_personne SET per_prenom = '$prenom', per_nom = '$nom', per_courriel = '$courriel', per_telephone = '$tel' WHERE per_num = $num";

    corrigerDonnees($conn, $sql);

    header('Location: ../../profil.php');
} else
    echo ("<hr/> Connexion impossible à la base de données <br/>");
