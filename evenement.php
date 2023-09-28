<?php
require_once "controllers/AuthController.php";
require_once "controllers/EvenementController.php";
AuthController::isLogin();

$evenementController = new EvenementController();
$evenements = $evenementController->getEvenements();

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
    <title>Evenements</title>

</head>
<body>

<?php require_once("partials/navbar.php"); ?>

<?php require_once("partials/sidebar.php"); ?>


<div class="content" style="margin-left: 250px; padding: 20px;">

    <?php
    if (isset($_SESSION["add_evenement"])) {
        ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION["add_evenement"]; ?>
        </div>
        <?php
        unset($_SESSION["add_evenement"]);
    }
    ?>

    <?php
    if (isset($_SESSION["update_evenement"])) {
        ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION["update_evenement"]; ?>
        </div>
        <?php
        unset($_SESSION["update_evenement"]);
    }
    ?>

    <?php
    if (isset($_SESSION["delete_evenement"])) {
        ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION["delete_evenement"]; ?>
        </div>
        <?php
        unset($_SESSION["delete_evenement"]);
    }
    ?>

    <div class="d-flex justify-content-end py-2">
        <a href="add_evenement.php" class="btn btn-primary w-25">Ajouter</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Description</th>
            <th scope="col">Date de créeation</th>
            <th scope="col">Departements</th>
            <th scope="col">Lieu</th>
            <th scope="col">Nombre de votes des employes</th>
            <th scope="col">Nombre de votes des etudiants</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody class="table-striped ">
        <?php
        foreach ($evenements as $evenement) {
            ?>
            <tr>
                <td><?= $evenement["nom"] ?></td>
                <td><?= $evenement["description"] ?></td>
                <td><?= $evenement["date_creation"] ?></td>
                <td>
                    <ul class="list-group">
                        <?php foreach ($evenementController->getDepartements(intval($evenement["id"])) as $d) {
                            ?>
                            <li class="list-group-item">
                                <?= $d["libelle"] ?>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </td>
                <td><?= $evenement["lieu"] ?></td>
                <td><?= $evenement["nb_vote_employe"] ?></td>
                <td><?= $evenement["nb_vote_etudiant"] ?></td>
                <td>
                    <a class="bi bi-pencil-fill px-1 text-primary" href="modifier_evenement.php?id_evenement=<?= $evenement['id'] ?>"></a>
                    <a class="bi bi-trash-fill px-1 text-danger"
                       href="supprimer_evenement.php?id_evenement=<?= $evenement['id'] ?>"></a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>