<?php
session_start();
require_once "check_connexion.php";
$num= $_SESSION['user_id'];

$db_username = $db_usernameOracle;
$db_password = $db_passwordOracle;
$db = $dbOracle;

$conn = OuvrirConnexionPDO($db, $db_username, $db_password);

if($conn){
    include 'choice.html';
    if(ifOrga($conn, $num)){
        include 'choice_orga.html';
    }
    else if(ifClient($conn, $num)){
        include 'choice_client.html';
    }
    else if(ifGuide($conn, $num)){
        include 'choice_guide.html';
    }
    else{
        header('Location: connexion.html');
    }
}
else{
    header('Location: connexion.html');
}


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






?>