<?php
require_once "vendor/bdd_connexion/param_connexion_etu.php";
require_once "vendor/bdd_connexion/connexion_pdo_etu.php";
require_once "vendor/bdd_connexion/pdo_agile.php";
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


if($conn){
    if(verifInscription() == true){
        $tab = array();
        $sql = "SELECT MAX(per_num) as max_num FROM alp_personne";
        LireDonneesPDO1($conn, $sql,$tab);
        afficherObj($tab);
    
        $maxNum = (int)$tab[0]['MAX_NUM']; // Assurer que l'index est correct
    
        $newNum = $maxNum + 1;

        $mdp = $_POST['mdp'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $ville = $_POST['ville'];
        $tel = $_POST['tel'];
        $courriel = $_POST['courriel'];
        $insert = "INSERT INTO alp_personne VALUES ($newNum, '$mdp', '$nom', '$prenom', '$ville', '$tel', '$courriel')";
        echo($insert);
        insererDonnee($conn,$insert);
    
    }
}

?>