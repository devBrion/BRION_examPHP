<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require "partial/head.html.php" ?>
    <title>Reservation chambre</title>
</head>

<body class="bg-secondary">
    <?php require "partial/navbar.html.php" ?>

    <div class="container mt-3 bg-light p-4 rounded d-flex justify-content-center">
        <form action="<?= $path ?>/addBooking" method="post" autocomplete="off">
            <h5 class="text-center m-3">Reserver une chambre</h5>
            <div class="form-group">

                </p>
                <label for="categorie">Type de chambre:</label>
                <select class="form-control" id="categorie" name="codeCategorie">
                    <option  value="1">basique</option>
                    <option value="2">confort</option>
                    <option value="3">luxe</option>
                </select>

                <p class="text-center"><label for="dateDebut" class="text-center"> Date début : </label><br />
                    <input type="date" class="form-control" name="dateDebut" id="dateDebut">
                </p>
                <p class="text-center"><label for="dateFin" class="text-center">Date fin : </label><br />
                    <input type="date" class="form-control" name="dateFin" id="dateFin" >

            </div>
            <p class="text-center"><button class="btn btn-primary mt-4 ">Reserver</button></p>
        </form>
    </div>


</body>

<?php require "partial/script.html.php" ?>

</html>