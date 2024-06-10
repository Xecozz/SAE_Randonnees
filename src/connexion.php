<?php
include_once "vendor/bdd_connexion/pdo_agile.php";
include_once "vendor/bdd_connexion/param_connexion_etu.php";
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
function insererDonnee($c, $sql)
{
    afficherObj($sql);
    $res = majDonneesPDO($c,$sql);
    echo "Résultats de la requête ",$res . "<br/>";
}

function corrigerDonnees($c, $sql)
{
    afficherObj($sql);
    $res = majDonneesPDO($c,$sql);
    echo "Résultats de la requête " . $res . "<br/>";
}

function lireDonnees($c, $sql)
{
    $tab =array();
    $donnee = LireDonneesPDO1($c,$sql, $tab);

    foreach($tab as $v){
        foreach($v as $cle=>$a){
            echo $cle ." " . $a . " ";
        }
        echo "<br/>";
    }

    afficherObj($tab);
    return $donnee;
}

function afficherObj($obj)
{
    echo "<PRE>";
    print_r($obj);
    echo "</PRE>";
}

//verification connexion

if (isset($_POST['courriel']) && isset($_POST['password'])) {
    $courriel = $_POST['courriel'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM alp_personne WHERE per_courriel = '$courriel' and per_mdp = '$password'";
  
    echo $sql;
    if (verify($sql,$conn)== 1) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        echo "reussi";
    } else {
        echo "Mauvais id";
    }
}

function verify($sql,$conn){
    echo "check";
    $tab = array();
    LireDonneesPDO1($conn,$sql,$tab);
    if(empty($tab)){
        return 0;
    }
    return 1;
}


if ($conn)
{
    echo ("<hr/> Connexion réussie à la base de données <br/>");
    
    afficherObj($_POST);
}
else
    echo ("<hr/> Connexion impossible à la base de données <br/>");


 //   


?>