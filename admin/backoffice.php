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
        <title>Connexion au BackOffice</title>

    </head>
    <body>
    <a href="logout.php" class="deconnexion">Déconnexion</a><br>

      
    <h1>Administrer mon site</h1>
          
      <h2>Mon actualité</h2>
      <?php
       include "../inc/conn_bdd.php" ;
        $reponse = $bdd->query('SELECT ID,titre,article, modified FROM actu');

       while($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
       { 
        ?>
        
          <div class="modif">
          <div class="articlemodif">
            <h2>Article</h2>
            <a href="articlemodif.php?id=<?php echo $donnees['ID'];?>">
              <p><?php echo $donnees['titre'];?><br>
              <?php echo $donnees['article'];?></p>
            </a>
          </div>

          <div class="articlemodif">
            <h2>Modifié</h2>
            <?php echo $donnees['modified'];?>
          </div>
          
          <div class="articlemodif"><a class="liens" href="articlemodif.php?id=<?php echo $donnees['ID'];?>">Modifier l'article</a></div>
          <div class="articlemodif"style="font:#ef88a5;" >
            <a class="liens"  href="articlesupp.php?id=<?php echo $donnees['ID'];?>" onclick="return confirmer();">Supprimer l'article</a>
          </div>
         
          </div>
          
          <?php
          }
       $reponse->closecursor();
          ?>
          <a class="liens" href="articlemodif.php">Ajouter un article</a>
          
          <h2>Mon menu</h2>
          
          <?php 
          $reponse = $bdd->query('SELECT ID,type,description,prix FROM menu ORDER by type');

       while($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
       { 
     ?>
     <div class="modif">
       
      <div class="articlemodif"><a href="menumodif.php?id=<?php echo $donnees['ID'];?>"><?php echo $donnees['description']; ?></div>
      <div class="articlemodif"><a href="menumodif.php?id=<?php echo $donnees['ID'];?>"><?php echo $donnees['type']; ?></div>
      <div class="articlemodif"><a href="menumodif.php?id=<?php echo $donnees['ID'];?>"><?php echo $donnees['prix'].' €'; ?></div>
      <div class="articlemodif"><a class="liens" href="menumodif.php?id=<?php echo $donnees['ID'];?>">Modifier le plat</a></div>
      <div class="articlemodif" style="background:#ef88a5;">
        <a class="liens" href="menusupp.php?id=<?php echo $donnees['ID'];?>" onclick="return confirmer();">Supprimer le plat</a>
      </div>
     </div>
   <?php 
       }
      
    $reponse->closecursor();
      ?> 
   
          <a class="liens" href="menumodif.php">Ajouter un plat</a>

          <script type="text/javascript" src="js/script.js"></script>
      </body>
  </html>