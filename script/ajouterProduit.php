<?php
try {
    ob_start();
    require("connexion_bd.php");

    if (
        !isset(
        $_POST['nom'],
        $_POST['quantite'],
        $_POST['prixAchat'],
        $_POST['prixVente']
    )
    ) {
        echo "manque d'info";
        header("location: ../pages/ajouterProduit.php");
        exit();
    }

    extract($_POST);

    $query = $bdd->prepare("SELECT * FROM produit WHERE nomProduit=?");
    $query->execute([$nom]);
    if($query->fetch()){
        //produit existe déjà dans la base de données on ne peut l'insérer
        echo "produit existe déjà dans la base de données on ne peut l'insérer";
        header("location: ../pages/ajouterProduit.php");
    }

    $description = isset($_POST['description']) ? $_POST['description'] : null;

    $query = $bdd->prepare("INSERT INTO produit (nomProduit, quantiteProduit, prixAchat, prixVente, `descriptionProduit`) VALUES(?,?,?,?,?)");
    if($query->execute([
        $nom,
        $quantite,
        $prixAchat,
        $prixVente,
        $description
    ])){
        echo "Le produit a été ajouté avec succès";
        try{
            $query = $bdd->prepare("INSERT INTO historique (descriptionHistorique, id_user) VALUES(?,?)");
            $query->execute([
                "A jouter le produit ".$nom." qui coute ".$prixVente,
                $_COOKIE['idUser']
            ]);
        }
        catch(Exception $e){
            echo($e->getMessage());
        }
        header("location: ../pages/listeProduit.php");
    }
    else{
        echo "Le produit n'a pas été ajouté";
        header("location: ../pages/ajouterProduit.php");
    }
} catch (Exception $e) {
    echo $e->getMessage();
    echo "Une erreur est survenue";
    header("location: ../pages/ajouterProduit.php");
    exit();
}
?>