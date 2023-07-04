<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-utensils"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            <b>Low Cost</b>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gestion
    </div>

    <?php
    require_once("../script/isLoged.php");
    if ($currentUser['role'] == 'admin') {
        ?>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                aria-controls="collapseTwo">
                <i class="fas fa-user fa-cog"></i>
                <span>Utilisateurs</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Action:</h6>
                    <a class="collapse-item" href="listeUser.php">Lister les utilisateurs</a>
                    <a class="collapse-item" href="ajouterUser.html">Ajouter un utilisateur</a>
                </div>
            </div>
        </li>
        <?php
    }
    ?>


    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduit"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Produit</span>
        </a>
        <div id="collapseProduit" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Actions</h6>
                <a class="collapse-item" href="listeProduit.php">Lister les produits</a>
                <a class="collapse-item" href="ajouterProduit.html">Ajouter un produit</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVente" aria-expanded="true"
            aria-controls="collapseUtilities">
            <i class="fas fa-shopping-bag"></i>
            <span>Vente</span>
        </a>
        <div id="collapseVente" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Actions</h6>
                <a class="collapse-item" href="../utilities-color.html">Lister les ventes</a>
                <a class="collapse-item" href="../utilities-border.html">Effectuer une vente</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Vue d'ensemble
    </div>

    <?php
    if ($currentUser['role'] == 'admin') {
        ?>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="statistique.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Statistiques</span>
            </a>
        </li>
        <?php
    }
    ?>


    <!-- Nav Item - Tables -->
    <li class="nav-item ">
        <a class="nav-link" href="listeHistorique.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Historique</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="listeClient.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Clients</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->