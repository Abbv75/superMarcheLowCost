<?php

if (!isset($_COOKIE['idUser'])) {
    echo "Utilisateur non connecté";
    header("location: ../index.php");
}
$queryCurrentUser = $bdd->prepare("SELECT * FROM user WHERE idUser=?");
$queryCurrentUser->execute([$_COOKIE['idUser']]);
if (!($currentUser = $queryCurrentUser->fetch())) {
    header('Location:../index.php');
}
?>