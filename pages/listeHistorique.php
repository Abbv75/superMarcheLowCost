<?php
ob_start();

include("../script/connexion_bd.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Vos historiques</title>

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
                                                Nombre d'historiques
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $query = $bdd->query("SELECT COUNT(*) AS nbr FROM historique");
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
                                            <th>Date</th>
                                            <th>Concerner</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>Date</th>
                                            <th>Concerner</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        <?php
                                        $query = $bdd->query("SELECT * FROM historique ORDER BY dateHistorique DESC");
                                        while ($res = $query->fetch()) {
                                            $nom= $prenom= null;
                                            if(!is_null($res['id_user'])){
                                                $queryTmp = $bdd->prepare("SELECT nomUser, prenomUser FROM user WHERE idUser=?");
                                                $queryTmp->execute([$res['id_user']]);
                                                $resTmp = $queryTmp->fetch();
                                                $nom = $resTmp['nomUser'];
                                                $prenom = $resTmp['prenomUser'];
                                            }
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $res['dateHistorique'] ?>
                                                </td>
                                                <td>
                                                    <?= $nom.$prenom ?>
                                                </td>
                                                <td>
                                                    <?= $res['descriptionHistorique'] ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    if($currentUser['role'] == 'admin'){
                                                    ?>
                                                        <a href="../script/supprimerHistorique.php?idHistorique=<?= $res['idHistorique'] ?>"
                                                            class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                                            Supprimer
                                                            <i class="fa fa-trash-alt"></i>
                                                        </a>
                                                    <?php
                                                    }
                                                    ?>

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