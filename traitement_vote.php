<?php
require_once "controllers/EvenementController.php";
$evenentController = new EvenementController();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = $evenentController->requestAjax($_POST);
    echo json_encode($response);
}
