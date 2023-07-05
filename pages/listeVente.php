<?php
ob_start();
include("../script/connexion_bd.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Liste des ventes</title>

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
                                                Nombre de vente
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $query = $bdd->query("SELECT COUNT(*) AS nbr FROM vente");
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

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Chiffre d'affaire
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $query = $bdd->query("SELECT SUM(montantVente) AS nbr FROM vente");
                                                $res = $query->fetch();
                                                echo (
                                                    number_format(
                                                        is_null($res['nbr']) ? 0 : $res['nbr'],
                                                        0,
                                                        ",",
                                                        " "
                                                    )
                                                );

                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Nombre de vendu
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $query = $bdd->query("SELECT SUM(quantiteVenteProduit) AS nbr FROM venteProduit");
                                                $res = $query->fetch();
                                                echo (
                                                    number_format(
                                                        is_null($res['nbr']) ? 0 : $res['nbr'],
                                                        0,
                                                        ",",
                                                        " "
                                                    )
                                                );

                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
                                Liste de vos ventes
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Client</th>
                                            <th>Date</th>
                                            <th>Montant</th>
                                            <th>Nombre de produit</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>Client</th>
                                            <th>Date</th>
                                            <th>Montant</th>
                                            <th>Nombre de produit</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        <?php
                                        $query = $bdd->query("SELECT * FROM vente, client WHERE vente.id_client=client.idClient ORDER BY idVente DESC");
                                        while ($res = $query->fetch()) {
                                            $queryTmp = $bdd->prepare("SELECT SUM(quantiteVenteProduit) AS sum FROM venteProduit WHERE id_vente=?");
                                            $queryTmp->execute(
                                                [
                                                    $res['idVente']
                                                ]
                                            );

                                            $resTmp = $queryTmp->fetch();
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= ($res['nomClient'] . " " . $res['prenomClient']) ?>
                                                </td>
                                                <td>
                                                    <?= $res['dateVente'] ?>
                                                </td>
                                                <td>
                                                    <?= $res['montantVente'] ?>
                                                </td>
                                                <td>
                                                    <?= $resTmp['sum'] ?>
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