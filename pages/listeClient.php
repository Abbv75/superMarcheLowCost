<?php
ob_start();
include("../script/connexion_bd.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Liste des clients</title>

    <?php
    include("../include/headPage.html");
    ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        include("../include/navBarLeft.php");
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php
                include("../include/navBarTop.php");
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Nombre utilisateur
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $query = $bdd->query("SELECT COUNT(*) AS nbr FROM client");
                                                echo ($query->fetch()['nbr']);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">
                                Liste de vos clients
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Dernier Achat</th>
                                            <th>Nombre d'achat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Dernier Achat</th>
                                            <th>Nombre d'achat</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        <?php
                                        $query = $bdd->query("SELECT * FROM client");
                                        while ($res = $query->fetch()) {
                                            $queryTmp = $bdd->prepare("SELECT * FROM vente WHERE id_client=? ORDER BY dateVente DESC LIMIT 1");
                                            $queryTmp->execute([$res['idClient']]);
                                            $dateVente = $queryTmp->fetch();
                                            
                                            $queryTmp = $bdd->prepare("SELECT COUNT(*) AS nbr FROM vente WHERE id_client=?");
                                            $queryTmp->execute([$res['idClient']]);
                                            $nbrVente = $queryTmp->fetch();
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $res['nomClient'] ?>
                                                </td>
                                                <td>
                                                    <?= $res['prenomClient'] ?>
                                                </td>
                                                <td>
                                                    <?= $dateVente ? $dateVente['dateVente'] : '--' ?>
                                                </td>
                                                <td>
                                                    <?= $nbrVente['nbr'] ?>
                                                </td>
                                                <td>
                                                    <a href="../script/supprimerClient.php?idClient=<?= $res['idClient'] ?>"
                                                        class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                                        Supprimer
                                                        <i class="fa fa-trash-alt"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php
    include("../include/footerScript.html");
    ?>

</body>

</html>