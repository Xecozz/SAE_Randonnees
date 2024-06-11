<?php
require_once "../vendor/connexion_pdo.php";
require_once "../vendor/check_connexion.php";
$num = $_SESSION['user_id'];


$db_username = $db_usernameOracle;
$db_password = $db_passwordOracle;
$db = $dbOracle;

$conn = OuvrirConnexionPDO($db, $db_username, $db_password);


//fonction pour verifier si la personne est organisateur ou client ou guide
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

if ($conn) {
    include 'connexionChoice/choice.html';
    if (ifClient($conn, $num)) {
        include 'connexionChoice/choice_client.html';
    }
    if (ifOrga($conn, $num)) {
        include 'connexionChoice/choice_orga.html';
    }
    if (ifGuide($conn, $num)) {
        include 'connexionChoice/choice_guide.html';
    } else if (!ifClient($conn, $num) && !ifOrga($conn, $num) && !ifGuide($conn, $num)) {
        header('Location: ../../connexion.html');
    }
} else {
    echo "erreur connexion";
}
