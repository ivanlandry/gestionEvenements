<?php
require_once "controllers/AuthController.php";
require_once "controllers/UserController.php";
AuthController::isLogin();

$username = $email = $password = "";
$usernameErreur = $emailErreur = $passwordErreur = "";
$erreur = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (empty($_POST["username"])) {
        $usernameErreur = "le nom d'utilisateur ne peut etre vide";
        $erreur = true;
    } else {
        $username = $_POST["username"];
        $erreur = false;
    }

    if (empty($_POST["email"])) {
        $emailErreur = "l'adresse courriel ne peut etre vide";
        $erreur = true;
    } else {
        $email = $_POST["email"];
        $erreur = false;
    }

    if (empty($_POST["password"])) {
        $passwordErreur = "le mot de passe ne peut etre vide";
        $erreur = true;

    } else {
       $password = $_POST["password"];
        $erreur = false;
    }

    if (strlen($usernameErreur) != 0 || strlen($emailErreur) != 0 || strlen($passwordErreur)) {
        $erreur = true;
    }

    if ($erreur == false) {
        $user = new UserController();

        $user->register($username, $email, $password);
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
    <link rel="stylesheet" href="css/index.css">
    <title>Nouvel utilisateur</title>

</head>
<body>

<?php require_once("partials/navbar.php"); ?>

<?php require_once("partials/sidebar.php"); ?>


<div class="content" style="margin-left: 250px; padding: 20px;">

    <?php
    if ($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true) {
        ?>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="mb-3">
                <label for="username" class="col-form-label">Nom d'utilisateur</label>
                <input type="text" value="<?= $username ?>" class="form-control" id="username" name="username">
                <span class="text-danger"><?= $usernameErreur ?></span>
            </div>
            <div class="mb-3">
                <label for="email" class="col-form-label">Adresse courriel</label>
                <input type="email" value="<?= $email ?>" class="form-control" name="email" id="email">
                <span class="text-danger"><?= $emailErreur ?></span>
            </div>
            <div class="mb-3">
                <label for="password" class="col-form-label">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="password">
                <span class="text-danger"><?= $passwordErreur ?></span>
            </div>
            <button class="btn  btn-primary" type="submit">Enregistrer</button>
        </form>
        <?php
    }
    ?>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>