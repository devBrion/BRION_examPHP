<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require "partial/head.html.php" ?>
    <title>Reserver</title>
</head>

<body class="bg-secondary">
    <?php require "partial/navbar.html.php" ?>
    <h1>Reserver</h1>

    <div class="container-fluid d-flex flex-wrap justify-content-center ">
        <?php foreach ($hotels as $hotel) : ?>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $hotel->NomHotel ?></h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <p><?= $hotel->AdresseHotel ?><br />
                        <?= $hotel->CodePostalHotel ?> <?= $hotel->VilleHotel ?><br />
                        <?= $hotel->TelHotel ?>
                    </p>
                    <a href="<?= $path ?>/reserver/<?=$hotel->NumHotel?>" class="btn btn-warning">Reserver une chambre</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



</body>

<?php require "partial/script.html.php" ?>

</html>