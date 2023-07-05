<?php
try {
    ob_start();

    require("connexion_bd.php");

    if (
        !isset(
        $_POST['nom'],
        $_POST['id'],
        $_POST['quantite'],
        $_POST['prixAchat'],
        $_POST['prixVente']
    )
    ) {
        echo "manque d'info";
        header("location: ../pages/modifierProduit.php");
        exit();
    }

    extract($_POST);

    $query = $bdd->prepare("SELECT * FROM produit WHERE idProduit=?");
    $query->execute([$id]);
    if(!$query->fetch()){
        //produit n'existe pas dans la base de données on ne peut le modifier
        echo "produit n'existe pas dans la base de données on ne peut le modifier";
        header("location: ../pages/modifierProduit.php");
    }

    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $description = $description =="" || $description ==" " ? null : $description ;

    $query = $bdd->prepare("UPDATE produit SET nomProduit=?, quantiteProduit=?, prixAchat=?, prixVente=?, descriptionProduit=? WHERE idProduit=?");
    if($query->execute([
        $nom,
        $quantite,
        $prixAchat,
        $prixVente,
        $description,
        $id
    ])){
        echo "Le produit a été modifier avec succes";
        header("location: ../pages/listeProduit.php");
    }
    else{
        echo "Le produit n'a pas été modifer";
        header("location: ../pages/modifierProduit.php");
    }
} catch (Exception $e) {
    echo $e->getMessage();
    echo "Une erreur est survenue";
    header("location: ../pages/modifierProduit.php");
    exit();
}
?>