<?php
ob_start();
require("../script/connexion_bd.php");

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de vente</title>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="../vendor/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="../css/ajouter_vente.css">
</head>

<body>
    <div class="main">
        <header>
            <h6>Effectuez une vente</h6>

            <a href="listeVente.php">
                <i class="fa fa-arrow-left"></i>

                <span>Quitter</span>
            </a>
        </header>

        <div class="contenue">
            <div class="partie1">
                <form action="" class="form form1" id="form1">
                    <h4>Selectionnez le produit</h4>

                    <div class="inputZone searchProduitZone">
                        <div class="searchZone">
                            <input type="text" placeholder="Recherchez un produit" id="searchInput">

                            <i class="fa fa-search searchBtn"></i>
                        </div>

                        <select id="selectProduitZone1" required>
                            <?php
                            $query = $bdd->query("SELECT * FROM produit WHERE quantiteProduit > 0 ORDER BY nomProduit");
                            while ($res = $query->fetch()) {
                                ?>
                                <option data-idProduit="<?php echo ($res['idProduit']) ?>"
                                    data-prixDet="<?php echo ($res['prixVente']) ?>"
                                    data-stock="<?php echo ($res['quantiteProduit']) ?>">
                                    <?php echo ($res['nomProduit']) ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="inputZone" required>
                        <label for="">Quantite</label>
                        <input id="quantiteZone1" type="number" min="1" required>
                    </div>

                    <div class="inputZone">
                        <div>
                            <label>Prix Detaillant</label>
                            <input value="0" id="prixDetZone1" disabled>
                        </div>

                        <div>
                            <label>Prix Grossiste</label>
                            <input value="0" id="prixGroZone1" disabled>
                        </div>
                    </div>

                    <div class="btnZone">
                        <button type="submit" class="btnValider">
                            Ajouter au panier
                            <i class="fa fa-shopping-bag"></i>
                        </button>
                    </div>
                </form>

                <div class="ListeProduitZone">
                    <h4>La liste des produits</h4>
                    <table>
                        <thead>
                            <th>Produit</th>
                            <th>P.U</th>
                            <th>Qt</th>
                            <th>Total</th>
                            <th>Action</th>
                        </thead>

                        <tbody id="tableauListeProduit">
                        </tbody>
                    </table>


                    <p>
                        <button class="btnAnnuler" id="btnViderTableau" style="width: 100%; color:white">
                            Vider
                            <i class="fa fa-refresh"></i>
                        </button>
                    </p>
                </div>
            </div>

            <form class="form partie2" id="formFinalVente">

                <div action="" class="form2">
                    <h4>Les informations du clients</h4>

                    <div class="inputZone" required>
                        <label for="">Nom du client</label>

                        <input type="text" id="nomClient" placeholder="Donnez le nom du client" required>
                    </div>

                    <div class="inputZone" required>
                        <label for="">Prrenom du cleint</label>

                        <input type="text" id="prenomClient" placeholder="Donnez le prenom du client" required>
                    </div>
                </div>

                <div action="" class="form2">
                    <h4>Informations de paiment</h4>

                    <div class="inputZone" required>
                        <label for="">Somme recu</label>

                        <input type="number" id="sommeRecu" placeholder="Saisissez le montant recu" value="0" step="5"
                            min="0" required>
                    </div>
                </div>

                <div class="infoVenteZone">
                    <h3 align="center">resume de la vente</h3>

                    <div class="infoVente">
                        <span class="titre">
                            Nombre de produit
                        </span>

                        <span id="nombreProduitSpan">
                            --
                        </span>
                    </div>

                    <div class="infoVente">
                        <span class="titre">
                            montant total hors remise
                        </span>

                        <span id="montantHorsRemise">
                            --
                        </span>
                    </div>

                    <div class="infoVente">
                        <span class="titre">
                            montant a remettre
                        </span>

                        <span id="montantARemettre">
                            --
                        </span>
                    </div>
                </div>

                <div class="btnZone" id="validerBtnZone">
                    <button type="submit" class="btnValider" id="validerVenteBtn">
                        <span>
                            Valider la vente
                            <i class="fa fa-shopping-cart"></i>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="../js/ajouter_vente.js"></script>
</body>

</html>