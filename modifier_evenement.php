<?php
require_once "controllers/AuthController.php";
require_once "controllers/DepartementController.php";
require_once "controllers/EvenementController.php";
AuthController::isLogin();
$evenement = new EvenementController();
$id_evenement = "";

if (isset($_GET["id_evenement"])) {
    $id_evenement = $_GET["id_evenement"];
}
$data = $evenement->getEvenement($id_evenement);

$departs = new DepartementController();
$dataDeparts = $departs->getDepartements();

$nom = $description = $lieu = $departements = $date="";

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    $nom = $data["nom"];
    $description = $data["description"];
    $lieu = $data["lieu"];

}

$nomErreur = $descriptionErreur = $lieuErreur = $departementsErreur =$dateErreur= "";
$erreur = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id_evenement = $_POST["id_evenement"];

    if (empty($_POST["nom"])) {
        $nomErreur = "le nom ne peut etre vide";
        $erreur = true;
    } else {
        $nom = $_POST["nom"];
        $erreur = false;
    }

    if (empty($_POST["lieu"])) {
        $lieuErreur = "le lieu ne peut etre vide";
        $erreur = true;
    } else {
        $lieu = $_POST["lieu"];
        $erreur = false;
    }

    if (empty($_POST["description"])) {
        $descriptionErreur = "la description ne peut etre vide";
        $erreur = true;
    } else {
        $description = $_POST["description"];
        $erreur = false;
    }

    if (empty($_POST["departements"])) {
        $departementsErreur = "le departement ne peut etre vide";
        $erreur = true;

    } else {
        $departements = $_POST["departements"];
        $erreur = false;
    }

    if (empty($_POST["date"])) {
        $dateErreur = "la date ne peut etre vide";
        $erreur = true;

    } else {
        $date = $_POST["date"];
        $erreur = false;
    }

    if (strlen($nomErreur) != 0 || strlen($descriptionErreur) != 0 || strlen($lieuErreur) != 0 || strlen($departementsErreur) || strlen($dateErreur)) {
        $erreur = true;
    }

    if (!$erreur) {

        $evenement->update($nom, $lieu, $description, $departements,$date, $id_evenement);
    } else {

    }
}

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
          integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <title>Modifier-evenement</title>

</head>
<body>

<?php require_once("partials/navbar.php"); ?>

<?php require_once("partials/sidebar.php"); ?>


<div class="content" style="margin-left: 250px; padding: 20px;">

    <?php
    if ($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true) {
        ?>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="text" name="id_evenement" value="<?= $id_evenement ?>" hidden="hidden">
            <div class="mb-3">
                <label for="nom" class="col-form-label">Nom de l'évenement</label>
                <input type="text" value="<?= $nom ?>" class="form-control" id="nom" name="nom">
                <span class="text-danger"><?= $nomErreur ?></span>
            </div>
            <div class="mb-3">
                <label for="nom" class="col-form-label">Lieu de l'évenement</label>
                <input type="text" value="<?= $lieu ?>" class="form-control" id="lieu" name="lieu">
                <span class="text-danger"><?= $lieuErreur ?></span>
            </div>
            <div class="mb-3">
                <label for="email" class="col-form-label">Description</label>
                <textarea class="form-control" name="description" id="description"><?= $description ?></textarea>
                <span class="text-danger"><?= $descriptionErreur ?></span>
            </div>
            <div class="mb-3">
                <label for="date0" class="col-form-label">Date</label>
                <input class="form-control" name="date" id="date" type="datetime-local"/>
                <span class="text-danger"><?= $dateErreur ?></span>
            </div>
            <div class="mb-3">
                <label for="departements" class="col-form-label">Departements</label>
                <select multiple name="departements[]" id="departements" class="form-control">
                    <?php
                    foreach ($dataDeparts as $dataDepart) {
                        ?>
                        <option value="<?= $dataDepart['id'] ?>"><?= $dataDepart['libelle'] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <span class="text-danger"><?= $departementsErreur ?></span>
            </div>
            <button class="btn  btn-primary" type="submit">Modifier</button>
        </form>
        <?php
    }
    ?>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>