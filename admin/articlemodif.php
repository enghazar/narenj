<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style_admin.css">
        <title>Gestion des articles</title>

    </head>
    <body>
   <a href="logout.php" class="deconnexion">Déconnexion</a><br>
      <h1>Gestion des articles</h1>
      <?php
     include "../conn_bdd.php" ;
   // modification d'un article
   if(!isset($_POST['submit']) AND isset($_GET['id']))
   {
      $reponse = $bdd->prepare('SELECT ID,titre,article,img FROM actu WHERE ID=:id');
      $reponse -> execute(array('id' => $_GET['id']));

     if($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
     { ?>
   <div class="presentation">
        <form method="POST" action=""  enctype="multipart/form-data">
     
            <label for "titre" >Titre</label>
            <textarea  name="titre" cols=50 ><?php echo $donnees["titre"];?></textarea><br>
            
            <textarea name="article" rows=30 cols=100 ><?php echo $donnees["article"];?></textarea><br>
            <?php if ($donnees["img"]!="") {
                ?>
            <img src="img/<?= $donnees["img"];?>" width="70%"><br>

            <?php } ?>
            <label for "fichier">Modifier l'image</label><br>
            <input type="file" name="fichier" size="30">
            <div class="boutons">
                <input type="submit" name="submit" value="Modifier" />
            </div>
        </form>
    </div>
    <?php
     }
     $reponse->closecursor();
   }
    //
   else if(!isset($_POST['submit']) AND !isset($_GET['id'])){
     
     ?>
     <div class="presentation">
     <form method="POST" action=""  enctype="multipart/form-data">
     
    <label for "titre" >Titre</label>
    <textarea  name="titre" cols=50 ></textarea><br>
    
    <textarea name="article" rows=30 cols=100 ></textarea><br>

    <label for "fichier">Télécharger l'image</label><br>
    <input type="file" name="fichier" size="30">

    <div class="boutons">
    <input type="submit" name="submit" value="Ajouter"/>
    </div>
    </form>
    </div>
   <?php
   }
   ?>
   
   
    <?php

    if((isset($_POST['submit'])) AND (isset($_GET['id']))){
        if(isset($_FILES["fichier"]["name"]) AND ($_FILES["fichier"]["name"]!="" )){
            $uploadOk = 1;
            $target_dir = "img/";
            $target_file = $target_dir . basename($_FILES["fichier"]["name"]);
            
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            

            // on vérifie maintenant l'extension
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Erreur : seul les images avec les extensions jpg,png,jpeg et gif sont acceptées .";
            $uploadOk = 0;
            }

            if ($uploadOk == 0) {

            echo " L'image n'a pas pu être sauvegardée , veuillez réessayer .";
            // si tout va bien 
            } else {
                if (move_uploaded_file($_FILES["fichier"]["tmp_name"], $target_file)) {
                    echo "L'image ". basename( $_FILES["fichier"]["name"]). " a été téléchargée .";
                } else {
                    echo "Une erreur est arrivée pendant la sauvegarde de l'image,  veuillez réessayer .";
                }
            }
        }
      
        $req = $bdd->prepare('UPDATE actu SET titre=?,article=?,modified=?,img=? WHERE ID=?');
        $titre=$_POST['titre'];
        $article=$_POST['article'];
        $modified=date("Y-m-d H:i:s");
        $img=basename( $_FILES["fichier"]["name"]);
        $ID=$_GET['id'];
        if($req->execute(array($titre,$article,$modified,$img,$ID)))
        {    
        ?>
        
        <p>Article modifié </p>
        
        <?php
        }
        $req->closecursor();
    }
    elseif ((isset($_POST['submit'])) AND (!isset($_GET['id'])))
    {
        $req = $bdd->prepare('INSERT INTO actu(titre,article,modified,img) VALUES(?,?,?,?)');
        $titre=$_POST['titre'];
        $article=$_POST['article'];
        $modified=date("Y-m-d H:i:s");
        $img="";
        if($req->execute(array($titre,$article,$modified,$img))){
        ?>
    
        <p>Article ajouté </p>
    
        <?php
        }
    }
    
?>
        <a class="liens" href="backoffice.php">Retour au backoffice</a>
    </body>
</html>