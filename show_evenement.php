<?php
require_once "controllers/AuthController.php";
require_once "controllers/EvenementController.php";
AuthController::isLogin();

$evenementController = new EvenementController();
$evenement = $evenementController->getEvenement($_GET['id_evenement']);
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

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Description</th>
            <th scope="col">Date de créeation</th>
            <th scope="col">Departements</th>
            <th scope="col">Lieu</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody class="table-striped ">
        <tr>
            <td><?= $evenement["nom"] ?></td>
            <td><?= $evenement["description"] ?></td>
            <td><?php
                $heure = new DateTime($evenement["date_creation"]);
                $date = new DateTime($evenement["date_creation"]);
                echo $date->format('d/m/Y') . " a " . $heure->format('H:i');
                ?></td>
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
            <td><?php
                $heure = new DateTime($evenement["date"]);
                $date = new DateTime($evenement["date"]);
                echo $date->format('d/m/Y') . " a " . $heure->format('H:i');
                ?>
            </td>
        </tr>
        </tbody>
        <thead>
        <tr>
            <th scope="col">vote faibles etudiants</th>
            <th scope="col">vote moyen etudiants</th>
            <th scope="col">vote grand etudiants</th>
            <th scope="col">vote faibles employes</th>
            <th scope="col">vote moyen employes</th>
            <th scope="col">vote grand employes</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?= $evenement["nb_vote_faible_et"] ?></td>
            <td><?= $evenement["nb_vote_moyen_et"] ?></td>
            <td><?= $evenement["nb_vote_fort_et"] ?></td>
            <td><?= $evenement["nb_vote_faible_em"] ?></td>
            <td><?= $evenement["nb_vote_moyen_em"] ?></td>
            <td><?= $evenement["nb_vote_fort_em"] ?></td>
        </tr>
        </tbody>
        <thead>
        <th scope="col" colspan="2" class="text-center">Total de votes</th>
        </thead>
        <tbody>
        <tr>
            <td>Etudiants</td>
            <td>Employés</td>
        </tr>
        <tr>
            <td><?= $evenement["nb_vote_faible_et"]+$evenement["nb_vote_moyen_et"]+$evenement["nb_vote_fort_et"] ?></td>
            <td><?= $evenement["nb_vote_faible_em"]+$evenement["nb_vote_moyen_em"]+$evenement["nb_vote_fort_em"] ?></td>
        </tr>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>