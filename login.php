<?php
require_once "controllers/UserController.php";
require_once "controllers/AuthController.php";

$auth = false;

$username = $password = "";
$usernameErreur = $passwordErreur = "";
$erreur = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $auth = AuthController::login($_POST["username"], $_POST["password"]);
        if (!$auth) {
            $erreur = true;
            $passwordErreur = "nom d'utilisateur ou mot de passe incorect";
        } else {
            $erreur = false;
        }
    } else {
        if (empty($_POST["username"])) {
            $usernameErreur = "le nom d'utilisateur ne peut etre vide";
            $erreur = true;
        } else {
            $erreur = false;
            $username = $_POST["username"];
        }

        if (empty($_POST["password"])) {
            $passwordErreur = "le mot de passe ne peut etre vide";
            $erreur = true;
        } else {
            $erreur = false;
            $password = $_POST["password"];
        }

        if (strlen($usernameErreur) != 0 || strlen($passwordErreur)) {
            $erreur = true;
        }
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
    <title>Connexion</title>
</head>
<body>

<div class="container ">
    <div class="row ">
        <?php
        if ($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true) {
            ?>
            <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                  class="col-md-6 offset-md-3 border border-dark p-5 rounded-3">
                <div class="form-group">
                    <label for="username" class="form-label">Nom d'utilisateur</label>
                    <br>
                    <input type="username" value="<?= $username ?>" class="form-control" id="username" name="username">
                    <span class="text-danger"><?= $usernameErreur ?></span>
                </div>
                <div class="form-group mt-3">
                    <label for="password" class="form-label">Mot de passe</label><br>
                    <input type="password" class="form-control" id="password" name="password">
                    <span class="text-danger"><?= $passwordErreur ?></span>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </div>
            </form>
            <?php
        }
        ?>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>