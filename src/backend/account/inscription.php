<?php
session_start();
require_once "../vendor/param_connexion.php";
require_once "../vendor/connexion_pdo.php";
require_once "../vendor/pdo_agile.php";
echo '<meta charset="utf-8"> ';
// décommenter en fonction du serveur de BDD utilisé
//define ("MOD_BDD","MYSQL");
define("MOD_BDD", "ORACLE");

if (MOD_BDD == "MYSQL") {
    $db_username = $db_usernameMySQL;
    $db_password = $db_passwordMySQL;
    $db = $dbMySQL;
} else {
    $db_username = $db_usernameOracle;
    $db_password = $db_passwordOracle;
    $db = $dbOracle;
}

$conn = OuvrirConnexionPDO($db, $db_username, $db_password);


//verification connexion
function verifInscription()
{
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
            echo ("Ne pas mettre de valeur vide<br>");
        }
        if ($mdp != $confmdp) {
            $valid = false;
            echo ("Le mot de passe doit correspondre à la confirmation<br>");
        }

        // Vérification du mail
        if (empty($mail)) {
            $valid = false;
            echo ("Le mail ne peut pas être vide<br>");
        } elseif (!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $mail)) {
            $valid = false;
            echo ("Le mail n'est pas valide<br>");
        }
    }

    return $valid;
}

function mailExiste($conn,$mail)
{
    $sql = "SELECT per_courriel FROM alp_personne WHERE per_courriel = '$mail'";
    $tab = array();
    LireDonneesPDO1($conn, $sql, $tab);
    return count($tab) > 0;
}


if ($conn) {
    if (verifInscription() == true) {
        $tab = array();
        $sql = "SELECT MAX(per_num) as max_num FROM alp_personne";
        LireDonneesPDO1($conn, $sql, $tab);
        afficherObj($tab);

        $maxNum = (int)$tab[0]['MAX_NUM']; // Assurer que l'index est correct

        $newNum = $maxNum + 1;

        $mdp = md5(trim($_POST['mdp']));
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $ville = $_POST['ville'];
        $tel = $_POST['tel'];
        $courriel = $_POST['courriel'];

        if (mailExiste($conn,trim($courriel))) {
            echo ("Le mail existe déjà<br>");
            return;
        }

        $insert = "INSERT INTO alp_personne VALUES ($newNum, '$mdp', '$nom', '$prenom', '$ville', '$tel', '$courriel')";
        insererDonnee($conn, $insert);
        $insertClient = "INSERT INTO alp_client VALUES ($newNum, 0,0, sysdate)";
        insererDonnee($conn, $insertClient);

        $_SESSION['user_id'] = $newNum;

        header('Location: ../../confirmationInscription.html');
    }
}
