<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <?php include "inc/link.php"; ?>
        
        <title>Connexion au BackOffice</title>

    </head>
    <body>
        <img src="img/orange_cartoon.png" width="150px"><h1>Narenj</h1>
        <p>Veuillez entrer votre login et votre mot de passe</p>
        <form action="admin/login.php" method="post" name="connexion">
            <p>
            <label for "login" >Login</label><br>
            <input type="text" name="login" autofocus required /><br>
            <label for "mdp" >Mot de passe</label><br>
            <input type="password" name="mdp"  required /><br>
            <input type="submit" value="Valider" />
            </p>
        </form>
    </body>
</html>