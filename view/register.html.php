<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require "partial/head.html.php" ?>
    <title>Document</title>
</head>

<body class="bg-secondary">

    <?php require "partial/navbar.html.php" ?>

    <div class="container mt-3 bg-light p-4 rounded d-flex justify-content-center">
        <form action="<?= $path ?>/addClient" method="post" autocomplete="off">
            <h5 class="text-center m-3">Pas encore inscrit ?</h5>
            <div class="form-group">
                <p class="text-center"><label for="email" class="text-center">Email : </label><br />
                    <input type="email" class="form-control" name="email" id="email" class="text-center">
                </p>
                <p class="text-center"><label for="password" class="text-center">Mot de passe : </label><br />
                    <input type="password" class="form-control" name="password" id="password" class="text-center">
                </p>
                <p class="text-center"><label for="nom" class="text-center">Votre nom : </label><br />
                    <input type="text" class="form-control" name="nom" id="nom" class="text-center">
                </p>
                <p class="text-center"><label for="prenom" class="text-center"> Votre prénom :</label><br />
                    <input type="text" class="form-control" name="prenom" id="prenom" class="text-center">
                </p>
                <p class="text-center"><label for="telephone" class="text-center"> Votre téléphone :</label><br />
                    <input type="text" class="form-control" name="telephone" id="telephone" class="text-center">
                </p>
                <p class="text-center"><label for="adresse" class="text-center">Votre adresse : </label><br />
                    <textarea class="form-control" name="adresse" id="adresse" class="text-center" rows="3"> </textarea>
                </p>
                <p class="text-center"><label for="codePostal" class="text-center">Code postal : </label><br />
                    <input type="number" class="form-control" name="codepostal" id="codepostal" class="text-center">
                </p>
                <p class="text-center"><label for="ville" class="text-center">Ville : </label><br />
                    <input type="text" class="form-control" name="ville" id="ville" class="text-center">
                </p>
                <p class="text-center"><label for="pays" class="text-center">Pays : </label><br />
                    <input type="text" class="form-control" name="pays" id="pays" class="text-center">
                </p>

            </div>
            <p class="text-center"><button class="btn btn-primary mt-4 ">Inscription</button></p>
        </form>
    </div>


</body>
<?php require "partial/script.html.php" ?>

</html>