<?php
try {
    ob_start();

    require("connexion_bd.php");

    if (
        !isset(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['login'],
        $_POST['mdp'],
        $_POST['role']
    )
    ) {
        echo "manque d'info";
        header("location: ../pages/ajouterUser.php");
        exit();
    }

    extract($_POST);

    $query = $bdd->prepare("SELECT * FROM user WHERE `login`=?");
    $query->execute([$login]);
    if($query->fetch()){
        //user existe déjà dans la base de données on ne peut l'insérer
        echo "user existe déjà dans la base de données on ne peut l'insérer";
        header("location: ../pages/ajouterUser.php");
    }

    $description = isset($_POST['description']) ? $_POST['description'] : null;

    $query = $bdd->prepare("INSERT INTO user (nomUser, prenomUser, `login`, mdp, `role`) VALUES(?,?,?,?,?)");
    if($query->execute([
        $nom,
        $prenom,
        $login,
        $mdp,
        $role
    ])){
        echo "Le user a été ajouté avec succès";
        header("location: ../pages/listeUser.php");
    }
    else{
        echo "Le user n'a pas été ajouté";
        header("location: ../pages/ajouterUser.php");
    }
} catch (Exception $e) {
    echo $e->getMessage();
    echo "Une erreur est survenue";
    header("location: ../pages/ajouterUser.php");
    exit();
}
?>