<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="?page=home"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= $path ?>/accueil">Accueil</a>
            </li>
            <?php if (isset($_SESSION['client']) && $_SESSION['client']->RoleClient === "CLIENT_ROLE") : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $path ?>/reserver">Reserver</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $path ?>/mesreservations">Mes reservations</a>
                </li>
            <?php endif ?>
        </ul>
        <ul class="navbar-nav mr-auto">
        <?php if (isset($_SESSION['client'])) : ?>
                <li>
                    <a href="<?= $path ?>/logout" class="btn btn-success mr-3">Se deconnecter</a>
                </li>
        <?php elseif (!isset($_SESSION['client'])) : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= $path ?>/connexion">Se connecter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $path ?>/inscription">S'inscrire</a>
            </li>
            <?php endif; ?>

        </ul>
    </div>
</nav>