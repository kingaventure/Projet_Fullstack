<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="http://localhost/Projet_fullstack/Projet/index.php?component=article">Le Site de Juju</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Catégorie
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="http://localhost/Projet_fullstack/Projet/index.php?category=television&component=article">Télévision</a></li>
                        <li><a class="dropdown-item" href="http://localhost/Projet_fullstack/Projet/index.php?category=papeterie&component=article">Papeterie</a></li>
                        <li><a class="dropdown-item" href="http://localhost/Projet_fullstack/Projet/index.php?category=informatique&component=article">Informatique</a></li>
                        <li><a class="dropdown-item" href="http://localhost/Projet_fullstack/Projet/index.php?category=mobiier&component=article">Mobilier</a></li>
                        <li><a class="dropdown-item" href="http://localhost/Projet_fullstack/Projet/index.php?category=avion&component=article">Avion</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/Projet_fullstack/Projet/index.php?component=login">Connexion</a>
                </li>
            </ul>
            <form class="d-flex" role="search" method="GET" action="index.php">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <input type="hidden" name="component" value="article">
                <button class="btn btn-outline-success" type="submit" id="search_btn">Search</button>
            </form>
        </div>
    </div>
</nav>