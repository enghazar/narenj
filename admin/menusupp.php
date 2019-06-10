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
    <p id="login"><?php if (isset($_SESSION['login']))echo $_SESSION['login']; ?></p>
      <?php
     include "../inc/conn_bdd.php" ;
     
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