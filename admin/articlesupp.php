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
      <?php
     include "../conn_bdd.php" ;

   if(isset($_GET['id'])){
     $reponse = $bdd->prepare('DELETE FROM actu WHERE ID=:id');
     $reponse -> execute(array('id' => $_GET['id']));
     ?>
     
     <p>L'article a été supprimé </p>
     
     <?php
   }
   ?>
   
   <a class="liens" href="backoffice.php">Retour au backoffice</a>
    </body>
</html>