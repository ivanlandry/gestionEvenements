<?php
require_once "controllers/AuthController.php";
require_once "controllers/UserController.php";
AuthController::isLogin();

$user = new UserController();

$users = $user->getUsers();

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
    <title>Utilisateurs</title>

</head>
<body>

<?php require_once("partials/navbar.php"); ?>

<?php require_once("partials/sidebar.php"); ?>


<div class="content" style="margin-left: 250px; padding: 20px;">

    <?php
    if (isset($_SESSION["add_user"])) {
        ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION["add_user"]; ?>
        </div>
        <?php
        unset($_SESSION["add_user"]);
    }
    ?>

    <div class="d-flex justify-content-end py-2">
        <a href="adduser.php" class="btn btn-primary w-25">Ajouter</a>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom d'utilisateur</th>
            <th scope="col">Email</th>
            <th scope="col">Date de créeation</th>

        </tr>
        </thead>
        <tbody class="table-striped ">

        <?php
        foreach ($users as $user) {
            ?>
            <tr>
                <th scope="row">#</th>
                <td><?= $user["username"] ?></td>
                <td><?= $user["email"] ?></td>
                <td><?= $user["date_creation"] ?></td>

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