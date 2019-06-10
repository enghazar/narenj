<?php ob_start(); ?>
<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>BackOffice de mon site</title>
        <link rel="stylesheet" href="css/style_admin.css">
        <link rel="stylesheet" media="screen and (max-width: 900px)" href="css/style_admin_mobile.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    </head>
    <body>
    
   <?php
     include "../inc/conn_bdd.php" ;
      
      $reponse = $bdd->prepare('SELECT * FROM user WHERE login=? AND password= ?');
      $reponse->execute(array($_POST['login'], $_POST['mdp']));

     if ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
     {   
         session_start(); 
         $_SESSION['login']=$_POST['login'];
         header('Location:backoffice.php');
         exit;
     }
     else  {
     ?>
     
     <p>Compte non reconnu</p>
     <a class="liens" href="../connexion.php">Retourner à la page de connexion </a>
     
     <?php  
           }
     $reponse->closecursor();
     
    ?>
        
        
    </body>
</html>
<?php ob_end_flush(); ?>