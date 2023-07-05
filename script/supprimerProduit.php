<?php
try {
    ob_start();
    require("connexion_bd.php");

    if (
        !isset(
        $_GET['idProduit'],
    )
    ) {
        echo "manque d'info";
        header("location: ../pages/listeProduit.php");
        exit();
    }

    extract($_GET);

    $mijo= $bdd->prepare("SELECT * FROM produit where idProduit = ?");
    $mijo ->execute(
        [$idProduit]
    );
    $res = $mijo->fetch();
    extract($res);

    $query = $bdd->prepare("DELETE FROM produit WHERE idProduit=?");
    if($query->execute([
        $idProduit
    ])){
        echo "Le produit a été suprrimer avec succes";
        try{
            
            $query = $bdd->prepare("INSERT INTO historique (descriptionHistorique, id_user) VALUES(?,?)");
            $query->execute([
                "A supprimer le produit ".$nomProduit." qui coute ".$prixVente,
                $_COOKIE['idUser']
            ]);
        }
        catch(Exception $e){
            echo($e->getMessage());
        }
    }
    else{
        echo "Le produit n'a pas été supprimer";
    }
    header("location: ../pages/listeProduit.php");
} catch (Exception $e) {
    echo $e->getMessage();
    echo "Une erreur est survenue";
    header("location: ../pages/modifierProduit.php");
    exit();
}
?>