<?php
session_start();

require("include/connexion.php");
include "include/header.php";
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = '';

}

if ($action == 'script_connexion') {
//
    include 'script_connexion.php';

}

if ($action == 'script_inscription') {
//
    include 'script_inscription.php';
}

if ($action == 'script-choix-proposer-trajet') {
//
    include 'script-choix-proposer-trajet.php';
}


if ($action == 'chercher_trajet') {
    include 'chercher_trajet.php';
}

elseif ($action == 'menu') {
    include 'menu.php';
}





// footer
include 'include/footer.php';
?>
