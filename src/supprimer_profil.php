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


function corrigerDonnees($c, $sql)
{
    afficherObj($sql);
    $res = majDonneesPDO($c,$sql);
    echo "Résultats de la requête " . $res . "<br/>";
}

function ifOrga($conn, $num)
{
    $tab = array();
    $sql = "SELECT * FROM alp_organisateur WHERE per_num = '$num'";
    LireDonneesPDO1($conn, $sql, $tab);
    if (empty($tab)) {
        return false;
    }
    return true;
}
function ifClient($conn, $num)
{
    $tab = array();
    $sql = "SELECT * FROM alp_client WHERE per_num = '$num'";
    LireDonneesPDO1($conn, $sql, $tab);
    if (empty($tab)) {
        return false;
    }
    return true;
}
function ifGuide($conn, $num)
{
    $tab = array();
    $sql = "SELECT * FROM alp_guide WHERE per_num = '$num'";
    LireDonneesPDO1($conn, $sql, $tab);
    if (empty($tab)) {
        return false;
    }
    return true;
}

if(ifClient($conn, $num)){
    $sql = "delete from alp_client where per_num = $num";
    corrigerDonnees($conn,$sql);
}
if(ifOrga($conn, $num)){
    $sql = "delete from alp_organisateur where per_num = $num";
    corrigerDonnees($conn,$sql);
}
if(ifGuide($conn, $num)){
    $sql = "delete from alp_guide where per_num = $num";
    corrigerDonnees($conn,$sql);
}

$sql = "delete from alp_personne where per_num = $num";
corrigerDonnees($conn,$sql);




?>