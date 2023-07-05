<?php
try {
    ob_start();

    if (!isset($_POST['login'], $_POST['mdp'])) {
        header("location: ../index.php");
        exit();
    }
    extract($_POST);
    require("connexion_bd.php");
    $query = $bdd->prepare("SELECT idUser FROM user WHERE `login`=? AND mdp=?");
    $query->execute([$login, $mdp]);
    if ($res = $query->fetch()) {
        setcookie("idUser", $res['idUser'], time() + 36000, "/");
        echo ("Connexion ok");
        header("location: ../pages/listeProduit.php");
        exit();
    }

    echo ("Aucun user");
    header("location: ../index.php");
    exit();
} catch (Exception $e) {
    echo ($e->getMessage());
    header("location: ../index.php");
    exit();
}

?>