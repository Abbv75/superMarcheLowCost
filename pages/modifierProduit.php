<?php
ob_start();

if (!isset($_GET['idProduit'])) {
    header("location: listeProduit.php");
    exit();
}
extract($_GET);
require("../script/connexion_bd.php");

$query = $bdd->prepare("SELECT * FROM produit WHERE idProduit=?");
$query->execute([$idProduit]);
if (!($res = $query->fetch())) {
    header("location: listeProduit.php");
    exit();
}

extract($res);
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ajouter Produit</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/sb-admin-2.css" rel="stylesheet">

</head>

<body>

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image">
                        <img src="../img/caddie.jpg" alt="">
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Ajouter un produit</h1>
                            </div>
                            <form class="user" action="../script/modifierProduit.php" method="post">
                                <input type="hidden" name="id" value="<?= $idProduit ?>">

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user"
                                            placeholder="Nom du produit" name="nom" value="<?= $nomProduit ?>" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" placeholder="Quantite"
                                            value="1" name="quantite" value="<?= $quantiteProduit ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="number" class="form-control form-control-user"
                                            placeholder="Prix achat" step="5" name="prixAchat" value="<?= $prixAchat ?>"
                                            required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control form-control-user"
                                            placeholder="Prix de vente" name="prixVente" value="<?= $prixVente ?>"
                                            step="5" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea type="text" class="form-control form-control-plaintext" name="description"
                                        placeholder="Description"><?= $descriptionProduit ?>"</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Valider
                                    <i class="fa fa-check"></i>
                                </button>
                                <hr>
                                <a href="listeProduit.php" class="btn btn-google btn-user btn-block">
                                    Annuler
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>