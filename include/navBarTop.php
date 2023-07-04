<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <form class="form-inline">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">
                    <?php
                    $queryTop = $bdd->query("SELECT COUNT(*) as nbr FROM historique");
                    echo $queryTop->fetch()['nbr'] . "+";
                    ?>
                </span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Dernieres historique
                </h6>

                <?php
                $queryTop = $bdd->query("SELECT * FROM historique ORDER BY dateHistorique DESC");
                $existe = false;
                while ($resTmp = $queryTop->fetch()) {
                    $existe = true;
                    ?>
                    <div class="dropdown-item d-flex align-items-center">
                        <div class="mr-3">
                            <div class="icon-circle <?= isset($resTmp['id_user']) ? "bg-success" : "bg-warning" ?>">
                                <i
                                    class="fas fa-<?= isset($resTmp['id_user']) ? "user" : "exclamation-triangle" ?> text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">
                                <?= $resTmp['dateHistorique'] ?>
                            </div>
                            <span class="font-weight-bold">
                                <?= $resTmp['descriptionHistorique'] ?>
                            </span>
                        </div>
                    </div>
                    <?php
                }
                if (!$existe) {
                    ?>
                    <h6 class="dropdown-header">
                        Aucune historique a afficher
                    </h6>
                    <?php
                }
                ?>

                <a class="dropdown-item text-center small text-gray-500" href="">Afficher tout</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <?php
                        require("../script/isLoged.php");
                        echo $currentUser['nomUser'] ." ". $currentUser['prenomUser'];
                    ?>
                </span>
                <img class="img-profile rounded-circle" src="../img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../index.php">Logout</a>
                </div>
            </div>
        </div>
    </div>