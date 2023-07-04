<?php
try {
    ob_start();

    require("connexion_bd.php");

    if (
        !isset(
        $_GET['idHistorique'],
    )
    ) {
        echo "manque d'info";
        header("location: ../pages/listeHistorique.php");
        exit();
    }

    extract($_GET);

    $query = $bdd->prepare("DELETE FROM historique WHERE idHistorique=?");
    if($query->execute([
        $idHistorique
    ])){
        echo "Le historique a été suprrimer avec succes";
    }
    else{
        echo "Le historique n'a pas été supprimer";
    }
    header("location: ../pages/listeHistorique.php");
} catch (Exception $e) {
    echo $e->getMessage();
    header("location: ../pages/listeHistorique.php");

    exit();
}


?>