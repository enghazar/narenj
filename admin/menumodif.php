<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">    
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style_admin.css">
        <link rel="stylesheet" media="screen and (max-width: 900px)" href="css/style_admin_mobile.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <title>Gestion du menu</title>

    </head>
    <body>
        <a href="logout.php" id="deconnexion">Déconnexion</a><br>

        <h1>Gestion du menu</h1>
          <?php
         include "../inc/conn_bdd.php" ;
       // modification d'un plat
       if(isset($_GET['id']))
       {
          $reponse = $bdd->prepare('SELECT ID,type,description,prix FROM menu WHERE ID=:id');
          $reponse -> execute(array('id' => $_GET['id']));

         if($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
         { ?>
        <div class="presentation">
            <form method="POST" action="">
                <h2><?php echo $donnees["type"];?></h2>

                <label for "description" >Description</label>
                <textarea  name="description" cols=50 ><?php echo $donnees["description"];?></textarea><br>

                <label for "prix">Prix</label>
                <textarea name="prix"  ><?php echo $donnees["prix"];?></textarea><br>

                <div class="boutons">
                    <input type="submit" name="submit" value="Modifier" />
                </div>

            </form>
        </div>
        <?php
         }
         $reponse->closecursor();
       }
        // ajout plat au menu
        else {
         
         ?>
        <div class="presentation">
            <form method="POST" action="">
                <p>
                    <select name="type">
                        <?php
                        $reponse = $bdd->query('SELECT type FROM type_plat ');
                        while($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
                        {
                        ?>
                          <option value="<?php echo $donnees['type'];?>"><?php echo $donnees['type'];?></option>
                          <?php
                        }
                        ?>
                    </select>
                 </p>
                <label for "description" >Description</label>
                <textarea  name="description" cols=50 ></textarea>
                <label for "prix">Prix</label>
                <textarea name="prix"  ></textarea><br>

                <div class="boutons">
                    <input type="submit" name="submit" value="Ajouter" />
                </div>
            </form>
        </div>
   <?php
   }
   ?>
   
   
    <?php

    if((isset($_POST['submit'])) AND (isset($_GET['id']))){
      
        $req = $bdd->prepare('UPDATE menu SET description=?,prix=? WHERE ID=?');
        $description=$_POST['description'];
        $prix=$_POST['prix'];
        $ID=$_GET['id'];
        if($req->execute(array($description,$prix,$ID))){
        
            ?>
            <p>Menu modifiée </p>
            
            <?php
        }
        $req->closecursor();
    }
    elseif ((isset($_POST['submit'])) AND (!isset($_GET['id'])))
    {
        $req = $bdd->prepare('INSERT INTO menu(description,prix,type) VALUES(?,?,?)');
        $description=$_POST['description'];
        $prix=$_POST['prix'];
        $type=$_POST['type'];
        
        if($req->execute(array($description,$prix,$type)))
        {
        ?>
            <p>Plat ajoutée</p>
        <?php
        }
    }
?>
    
        <a class="liens" href="backoffice.php">Retour au backoffice</a>
    </body>
</html>