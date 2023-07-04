<?php
try {
    ob_start();

    require("connexion_bd.php");

    if (
        !isset(
        $_GET['idUser'],
    )
    ) {
        echo "manque d'info";
        header("location: ../pages/listeUser.php");
        exit();
    }

    extract($_GET);

    $query = $bdd->prepare("DELETE FROM user WHERE idUser=?");
    if($query->execute([
        $idUser
    ])){
        echo "Le user a été suprrimer avec succes";
    }
    else{
        echo "Le user n'a pas été supprimer";
    }
    header("location: ../pages/listeUser.php");
} catch (Exception $e) {
    echo $e->getMessage();
    header("location: ../pages/listeUser.php");

    exit();
}


?>