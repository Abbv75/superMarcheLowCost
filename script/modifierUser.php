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
        $_POST['role'],
        $_POST['id']
    )
    ) {
        echo "manque d'info";
        header("location: ../pages/modifierUser.php");
        exit();
    }

    extract($_POST);

    $query = $bdd->prepare("SELECT * FROM user WHERE idUser=?");
    $query->execute([$id]);
    if(!$query->fetch()){
        //user n'existe pas dans la base de données on ne peut le modifier
        echo "user n'existe pas dans la base de données on ne peut le modifier";
        header("location: ../pages/modifierUser.php");
    }

    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $description = $description =="" || $description ==" " ? null : $description ;

    $query = $bdd->prepare("UPDATE user SET nomUser=?, prenomUser=?, `login`=?, mdp=?, `role`=? WHERE idUser=?");
    if($query->execute([
        $nom,
        $prenom,
        $login,
        $mdp,
        $role,
        $id
    ])){
        echo "Le user a été ajouté avec modifier";
        header("location: ../pages/listeUser.php");
    }
    else{
        echo "Le user n'a pas été modifer";
        header("location: ../pages/modifierUser.php");
    }
} catch (Exception $e) {
    echo $e->getMessage();
    echo "Une erreur est survenue";
    header("location: ../pages/modifierUser.php");
    exit();
}
?>