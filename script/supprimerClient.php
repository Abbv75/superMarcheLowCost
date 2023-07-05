<?php
try {
    ob_start();

    require("connexion_bd.php");

    if (
        !isset(
        $_GET['idClient'],
    )
    ) {
        echo "manque d'info";
        header("location: ../pages/listeClient.php");
        exit();
    }

    extract($_GET);

    $query = $bdd->prepare("DELETE FROM client WHERE idClient=?");
    if($query->execute([
        $idClient
    ])){
        echo "Le client a été suprrimer avec succes";
    }
    else{
        echo "Le client n'a pas été supprimer";
    }
    header("location: ../pages/listeClient.php");
} catch (Exception $e) {
    echo $e->getMessage();
    header("location: ../pages/listeClient.php");

    exit();
}


?>