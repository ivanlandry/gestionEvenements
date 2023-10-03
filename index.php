<?php
require_once "controllers/EvenementController.php";
$evenentController = new EvenementController();
$retour = $evenentController->index();

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

<?php
if ($retour != null) {
    ?>
    <div class="container">
        <div class="row" id="form_select_vote">
            <div class="col-md-6 offset-md-4 mt-5">
                <h3>Evenement du jour</h3>
                <h1><?= $retour["nom"] ?></h1>
                <form action="" class="mt-5">
                    <label for="">Type de voteurs</label>
                    <select class="form-control" id="select_value">
                        <option value="1">Etudiants</option>
                        <option value="2">Employes</option>
                    </select>
                    <input class="btn btn-primary mt-2 w-100" type="submit" value="Valider">

                </form>
            </div>
        </div>
    </div>
    <div class="row mt-5" id="group_emojis">
        <input type="text" id="id_evenement" value="<?= $retour['id'] ?>" hidden="hidden">
        <div class="col-md-3 offset-md-3">
            <button class="btn btn-danger" id="faible">faible</button>
        </div>
        <div class="col-md-3">
            <button class="btn btn-secondary" id="moyen">moyen</button>
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary" id="fort">fort</button>
        </div>
    </div>
    <?php
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(function () {
        let form_select_vote = $("#form_select_vote");
        let select_value = $("#select_value");
        let form = $("form");
        let group_emojis = $("#group_emojis");
        let value_selected;
        group_emojis.hide();

        form.submit((e) => {
            e.preventDefault();
            value_selected = select_value.val();
            form_select_vote.remove();
            group_emojis.show();
        });


        $("#group_emojis button").click(function () {

            $(this).animate({
                height: '+=50px',
                width: '+=50px',
            }, 'slow');

            $(this).animate({
                height: '-=50px',
                width: '-=50px',
            }, 'slow');

            vote = $(this).attr('id');
            console.log(vote);
            $.ajax({
                type: 'POST',
                data: {
                    'vote': vote,
                    'value_selected': value_selected,
                    'id_evenement': $('#id_evenement').val()
                },
                url: 'traitement_vote.php',
                success: function (response) {
                    console.log(response);
                }
            });
        });
    });
</script>
</body>
</html>