<!doctype html>
<html lang="fr">
<head>
    <?php include "link.php"; ?>
        <title>Carte Närenj</title>
        <meta name="Description" content="Carte du restaurant Närenj à Orléans">

</head>

<body>
    
    <?php include "menu.php"; ?>
    
    <article>
        
        <h2>Notre Carte</h2>
        <div class="menu_chef">
            <h3>Entrées</h3>
                <table>
                    
                        <?php
                            include "conn_bdd.php" ;
                            $reponse = $bdd->query('SELECT description,prix FROM menu WHERE type="entree"');

                            while($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
                        { ?>
                        <tr>
                            <td class="intitule">
                                <?php echo nl2br($donnees['description']);?>
                            </td>
                            <td>
                                <?php echo ($donnees['prix']);?>€
                            </td>
                       </tr>      
                        <?php
                            }
                            $reponse->closecursor();
                             
                        ?>
                    

                </table>
            
            <h3>Plats</h3>
            <table>
                <?php
                     include "conn_bdd.php" ;
                    $reponse = $bdd->query('SELECT description,prix FROM menu WHERE type="plat"');

                    while($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
                { ?>
                <tr>
                    <td class="intitule">
                        <?php echo nl2br($donnees['description']);?>
                    </td>
                    <td>
                        <?php echo ($donnees['prix']);?>€
                    </td>
                </tr>
                    <?php
                        }
                        $reponse->closecursor();
                         
                    ?>
                </tr>

            </table>
            
            <h3>Desserts</h3>
            <table>
                    
                <?php
                    include "conn_bdd.php" ;
                    $reponse = $bdd->query('SELECT description,prix FROM menu WHERE type="dessert"');

                    while($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
                { ?>
                <tr>
                    <td class="intitule">
                        <?php echo nl2br($donnees['description']);?>
                    </td>
                    <td>
                        <?php echo ($donnees['prix']);?>€
                    </td>
                </tr>   
                <?php
                    }
                    $reponse->closecursor();
                     
                ?>
            

                </table>
            
        </div>
        <div class="carousel">
            <img class="mySlides" src="img/img1.jpg" title="Langue de bœuf fondante, cuisson lente, légumes de la ferme d’Artaud." alt="Langue de bœuf fondante">
            <img class="mySlides" src="img/img2.jpg" title="Houmous de pois chiche" alt="Houmous de pois chiche">
            <img class="mySlides" src="img/img3.jpg" title="Canette aux trois cuissons ,signature du chef" alt="Canette aux trois cuissons">
            <img class="mySlides" src="img/img4.jpg" title="Pintade" alt="Pintade">
        </div>
    </article>
    
    
    
    <?php include "footer.php"; ?>

    <script type="text/javascript" src="js/script.js"></script>
</body>

</html>