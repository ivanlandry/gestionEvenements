<?php
require_once "controllers/AuthController.php";
require_once "controllers/EvenementController.php";
AuthController::isLogin();

if ($_GET["id_evenement"]) {
    $evenement = new EvenementController();
    $evenement->delete($_GET["id_evenement"]);
}

