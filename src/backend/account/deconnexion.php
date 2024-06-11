<?php
require_once "../vendor/check_connexion.php";
session_destroy();
header('Location: ../../index.php');
