<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style_admin.css">
        <title>Gestion du menu</title>

    </head>
    <body>
   <a href="logout.php" id="deconnexion">Déconnexion</a><br>
    <p id="login"><?php if (isset($_SESSION['login']))echo $_SESSION['login']; ?></p>
      <?php
     include "../conn_bdd.php" ;
     
   if(isset($_GET['id'])){
     $reponse = $bdd->prepare('DELETE FROM menu WHERE ID=:id');
     $reponse -> execute(array('id' => $_GET['id']));
    ?>
    
    <p>Le plat a été supprimé </p>
    
    <?php
     
   }
   ?>
   <a class="liens" href="backoffice.php">Retour au backoffice</a>
    </body>
</html>