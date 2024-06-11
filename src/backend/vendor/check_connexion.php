<?php
session_start();

if(isset($_SESSION['user_id']) == false){
    header('Location: connexion.html');
}
?>