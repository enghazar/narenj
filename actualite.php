<!doctype html>
<html lang="fr">
    <head>
        <?php include "inc/link.php"; ?>
            <title>Actualité Närenj</title>
            <meta name="Description" content="Actualité du restaurant Närenj à Orléans">

    </head>
    <body>
        <?php include "inc/menu.php"; ?>
                    
            <?php
                include "inc/conn_bdd.php" ;
                $reponse = $bdd->query('SELECT titre,article, modified,img FROM actu ORDER BY modified DESC');

                while($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
            { ?>
            <article>

                <h2><?php echo ($donnees['titre']); ?></h2>
                <p><?php echo ($donnees['article']); ?></p>

                <?php if(isset ($donnees['img']) && ($donnees['img']!="")){ ?>

                    <img class ="img_actu" src="img/<?= $donnees['img'];?>">

                <?php 
                }

                ?>
                <p class="modified"><?php echo ($donnees['modified']); ?></p>

            </article>
            <?php 
            }    
                $reponse->closecursor();
             ?>

        </div>

        <?php include "inc/footer.php"; ?>


    </body>
</html>
