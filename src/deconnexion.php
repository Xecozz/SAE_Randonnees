<?php
include_once "check_connexion.php";
session_destroy();
header('Location: index.php');

?>