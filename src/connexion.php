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

if ($conn)
{
    echo ("<hr/> Connexion réussie à la base de données <br/>");
    $sql = "select * from alp_personne";
    lireDonnees($conn,$sql );
    echo "test";
}
else
    echo ("<hr/> Connexion impossible à la base de données <br/>");

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






?>