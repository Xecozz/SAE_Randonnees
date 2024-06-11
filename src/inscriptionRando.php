<?php
include_once "vendor/bdd_connexion/pdo_agile.php";
include_once "vendor/bdd_connexion/param_connexion_etu.php";

require_once "check_connexion.php";
$num= $_SESSION['user_id'];

echo '<meta charset="utf-8"> ';
// décommenter en fonction du serveur de BDD utilisé
//define ("MOD_BDD","MYSQL");
define ("MOD_BDD","ORACLE");

if (MOD_BDD == "MYSQL")
{
    $db_username = $db_usernameMySQL;		
    $db_password = $db_passwordMySQL;
    $db = $dbMySQL;
}
else
{
    $db_username = $db_usernameOracle;		
    $db_password = $db_passwordOracle;	
    $db = $dbOracle;
}

$conn = OuvrirConnexionPDO($db,$db_username,$db_password);

//fonction utile


if ($conn) {
    $num_rando = 0;
    $nb_per = 0;
    $prix_tot = $_POST["prix"] * $nb_pers;
    //insert alp_reserver
    $insert = "INSERT INTO alp_reserver Values($num_rando,$num,$nb_per,$prix_tot)";
    corrigerDonnees($conn,$sql);
    echo "inscription reussi";
}



?>