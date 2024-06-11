<?php
require_once "pdo_agile.php";

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

function getPersonne($conn, $num)
{
    $tab = array();
    $sql = "SELECT * FROM alp_personne WHERE per_num = '$num'";
    LireDonneesPDO1($conn, $sql, $tab);
    return $tab[0];
}

function getClient($conn, $num)
{
    $tab = array();
    $sql = "SELECT * FROM alp_client WHERE per_num = '$num'";
    LireDonneesPDO1($conn, $sql, $tab);
    return $tab[0];
}

function getGuide($conn, $num)
{
    $tab = array();
    $sql = "SELECT * FROM alp_guide WHERE per_num = '$num'";
    LireDonneesPDO1($conn, $sql, $tab);
    return $tab[0];
}
