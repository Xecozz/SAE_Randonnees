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

function verifInscription() {
    $valid = true;

    if (isset($_POST['inscription'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $ville = $_POST['ville'];
        $tel = $_POST['tel'];
        $mail = strtolower($_POST['courriel']);
        $mdp = $_POST['mdp'];
        $confmdp = $_POST['mdpconf'];

        // Vérification des entrées
        if (empty($nom) || empty($prenom) || empty($ville) || empty($tel) || empty($mdp) || empty($confmdp)) {
            $valid = false;
            echo("Ne pas mettre de valeur vide<br>");
        } 
        if ($mdp != $confmdp) {
            $valid = false;
            echo("Le mot de passe doit correspondre à la confirmation<br>");
        }

        // Vérification du mail
        if (empty($mail)) {
            $valid = false;
            echo("Le mail ne peut pas être vide<br>");
        } elseif (!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $mail)) {
            $valid = false;
            echo("Le mail n'est pas valide<br>");
        }
    }

    return $valid;
}

if(verifInscription() == true){
    $tab = array();
    $sql = "SELECT MAX(per_num) as max_num FROM alp_personne";
    $tab = lireDonnees($conn, $sql);

    $maxNum = $tab[0]['max_num']; // Assurer que l'index est correct

    $newNum = $maxNum + 1;
    $mdp = $_POST['mdp'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $ville = $_POST['ville'];
    $tel = $_POST['tel'];
    $courriel = $_POST['courriel'];
    $insert = "INSERT INTO alp_personne VALUES ($newNum, '$mdp', '$nom', '$prenom', '$ville', '$tel', '$courriel')";
    echo($insert);
    insererDonnee($conn,$sql);

}
?>