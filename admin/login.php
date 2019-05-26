
<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>BackOffice de mon site</title>
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    <body>
    
   <?php
     include "../conn_bdd.php" ;
      
      $reponse = $bdd->prepare('SELECT * FROM user WHERE login=? AND password= ?');
      $reponse->execute(array($_POST['login'], $_POST['mdp']));

     if ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
     {   
         session_start(); 
         $_SESSION['login']=$_POST['login'];
         header('Location:backoffice.php');
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