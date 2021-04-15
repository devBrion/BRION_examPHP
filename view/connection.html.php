<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require "partial/head.html.php" ?>
    <title>Document</title>
</head>

<body class="bg-secondary">
<?php require "partial/navbar.html.php" ?>
    <div class="container mt-3 bg-light p-4 rounded">
        <form method="post" action="<?= $path ?>/login" autocomplete="off">
            <h5>déja inscrit : </h5>
            <div class="form-group">
                <label for="email">Email : </label>
                <input type="email" class="form-control" name="email" id="email">
                <label for="password">Mot de passe : </label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <button class="btn btn-primary">Connexion</button>
        </form>
    </div>


</body>
<?php require "partial/script.html.php" ?>

</html>