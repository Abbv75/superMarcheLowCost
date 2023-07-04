<?php
include("../script/connexion_bd.php");
ob_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Liste des produits</title>

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
                                                Nombre de Produit
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $query = $bdd->query("SELECT COUNT(*) AS nbr FROM produit");
                                                echo (number_format(
                                                    $query->fetch()['nbr'],
                                                    0,
                                                    ",",
                                                    " "
                                                ));
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
                                                Total produit
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $query = $bdd->query("SELECT SUM(quantiteProduit) AS nbr FROM produit");

                                                $res = $query->fetch();

                                                echo (is_null($res['nbr']) ? 0 : $res['nbr']);
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
                                                Capital
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $query = $bdd->query("SELECT * FROM produit");
                                                $capital = 0;
                                                while ($res = $query->fetch()) {
                                                    $capital += $res['prixVente'] * $res['quantiteProduit'];
                                                }
                                                echo (number_format(
                                                    $capital,
                                                    0,
                                                    ",",
                                                    " "
                                                ));
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
                        
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Chiffre d'affaire
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $query = $bdd->query("SELECT SUM(montantVente) AS nbr FROM vente");
                                                $res = $query->fetch();
                                                echo (number_format(
                                                    is_null($res['nbr']) ? 0 : $res['nbr'],
                                                    0,
                                                    ",",
                                                    " "
                                                ));
                                                
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
                                Liste de vos produits
                            </h6>
                            <a href="ajouterProduit.html"
                                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <i class="fas fa-plus fa-sm text-white-50"></i>
                                Ajouter un porduit
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Quantite</th>
                                            <th>Prix Achat</th>
                                            <th>Prix Vente</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Quantite</th>
                                            <th>Prix Achat</th>
                                            <th>Prix Vente</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        <?php
                                        $query = $bdd->query("SELECT * FROM produit");
                                        while ($res = $query->fetch()) {
                                            ?>
                                            <tr title="<?= $res['descriptionProduit'] ?>">
                                                <td>
                                                    <?= $res['nomProduit'] ?>
                                                </td>
                                                <td>
                                                    <?= $res['quantiteProduit'] ?>
                                                </td>
                                                <td>
                                                    <?= $res['prixAchat'] ?>
                                                </td>
                                                <td>
                                                    <?= $res['prixVente'] ?>
                                                </td>
                                                <td>
                                                    <a href="modifierProduit.php?idProduit=<?= $res['idProduit'] ?>"
                                                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                                        <i class="fa fa-edit"></i>
                                                        Modifier
                                                    </a>

                                                    <a href="../script/supprimerProduit.php?idProduit=<?= $res['idProduit'] ?>"
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