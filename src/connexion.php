<?php
session_start();

require_once "vendor/bdd_connexion/param_connexion_etu.php";
require_once "vendor/bdd_connexion/connexion_pdo_etu.php";
echo '<meta charset="utf-8"> ';

$db_username = $db_usernameOracle;
$db_password = $db_passwordOracle;
$db = $dbOracle;

$conn = OuvrirConnexionPDO($db, $db_username, $db_password);

//verification connexion
function verify($sql, $conn, &$tab)
{
    LireDonneesPDO1($conn, $sql, $tab);
    if (empty($tab)) {
        return false;
    }
    return true;
}
if ($conn) {
    echo ("<hr/> Connexion réussie à la base de données <br/>");

    if (isset($_POST['courriel']) && isset($_POST['password'])) {
        $courriel = $_POST['courriel'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM alp_personne WHERE per_courriel = '$courriel' and per_mdp = '$password'";

        $tab = array();
        echo $sql;
        if (verify($sql, $conn, $tab)) {
            $num = $tab[0]['PER_NUM'];

            $_SESSION['user_id'] = $num;

            header('Location: choice_connexion.php');
        } else {
            header('Location: connexion.html');
        }
    }
} else
    echo ("<hr/> Connexion impossible à la base de données <br/>");
?>