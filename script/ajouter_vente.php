<?php
    ob_start();

    try{
        require_once("connexion_bd.php");
        
        if(!isset($_POST['listeProduit'], $_POST['nom'], $_POST['prenom'])){
            header('HTTP/1.1 403 manque dinfo');
            exit();
        }

        $listeProduit = $_POST['listeProduit'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];

        if(!is_array($listeProduit)){
            header("HTTP/1.1 404 Donnez des produits svp");
            exit();
        }
        
        $produit = null;
        $sum_total_produit = 0;

        foreach($listeProduit as $produit_tmp){
            $queryTmp = $bdd->prepare("SELECT * FROM produit WHERE idproduit=?");
            $queryTmp->execute(
                [$produit_tmp['idProduit']]
            );

            if(!($res = $queryTmp->fetch())){
                $produit=null;
                break;
            }

            $sum_total_produit += $res['prixVente'] * $produit_tmp['quantite'];

            if($res['quantiteProduit'] < $produit_tmp['quantite']){
                $produit=null;
                break;
            }

            $produit[] = array(
                "produit" => $res,
                "quantite" => $produit_tmp['quantite']
            );
        }

        if(is_null($produit)){
            header("HTTP/1.1 404 Donnez des produits qui vous appartienne svp");
            exit();
        }

        $query = $bdd->prepare('SELECT * FROM client WHERE nomClient=? AND prenomClient=?');
        $query->execute(array($nom, $prenom));
        if(!($res=$query->fetch())){
            $query = $bdd->prepare('INSERT INTO client (nomClient, prenomClient) VALUES(?,?)');
            if(!$query->execute(array($nom, $prenom))){
                header("HTTP/1.1 500 client non ajouter");
                exit();
            }

            $idClient = $bdd->lastInsertId();
        }
        else{
            $idClient = $res['idClient'];
        }

        $query = $bdd->prepare('INSERT INTO vente (montantVente, id_client, id_user) VALUES(?,?,?)');
        if(!$query->execute(array(
            $sum_total_produit,
            $idClient,
            $_COOKIE['idUser']
        ))){
            header("HTTP/1.1 403 Vente non cree");
            exit();
        }

        $idVente = $bdd->lastInsertId();

        foreach($produit as $ligne){
            try{
                $query = $bdd->prepare("INSERT INTO venteProduit (quantiteVenteProduit, id_produit, id_vente) VALUES (?,?,?)");
                $query->execute(
                    [
                        $ligne['quantite'],
                        $ligne['produit']['idProduit'],
                        $idVente
                    ]
                );
                
                $query = $bdd->prepare("UPDATE produit SET quantiteProduit=? WHERE idProduit=?");
                $query->execute(
                    [
                        $ligne['produit']['quantiteProduit'] - $ligne['quantite'],
                        $ligne['idProduit'],
                    ]
                );
            }
            catch(Exception $e){}
        }

        try{
            $query = $bdd->prepare("INSERT INTO historique (descriptionHistorique, id_user) VALUES(?,?)");
            $query->execute(
                [
                    "A effectué une nouvelle vente",
                    $_COOKIE['idUser']
                ]
            );
        }
        catch(Exception $e){}

        header("HTTP/1.1 200 Ajouter");
        exit();
    }
    catch(Exception $e){
        echo($e->getMessage());
        header("HTTP/1.1 500 Une erreur est servenue");
        // exit();
    }

    ob_end_flush();
?>