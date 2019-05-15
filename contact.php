<!doctype html>
<html lang="fr">
<head>
    <?php include "link.php"; ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
   integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
   crossorigin=""></script>
    <title>Närenj</title>
    <meta name="Description" content="Contactez-nous pour réserver restaurant Närenj à Orléans">

</head>
<body>
 <?php include "menu.php"; ?>

 <?php

// destinataire est votre adresse mail. Pour envoyer à plusieurs à la fois, séparez-les par une virgule
 $destinataire = 'enghazar@gmail.com';
 
// copie ? (envoie une copie au visiteur)
 $copie = 'oui';
 
// Action du formulaire (si votre page a des paramètres dans l'URL)
// si cette page est index.php?page=contact alors mettez index.php?page=contact
// sinon, laissez vide
 $form_action = '';
 
// Messages de confirmation du mail
 $message_envoye = "Votre message nous est bien parvenu !";
 $message_non_envoye = "L'envoi du message a échoué, veuillez réessayer SVP.";
 
// Message d'erreur du formulaire
 $message_formulaire_invalide = "Vérifiez que tous les champs soient bien remplis et que l'email soit sans erreur.";

 
/*
 * cette fonction sert à nettoyer et enregistrer un texte
 */
function Rec($text)
{
	$text = htmlspecialchars(trim($text), ENT_QUOTES);
	if (1 === get_magic_quotes_gpc())
	{
		$text = stripslashes($text);
	}

	$text = nl2br($text);
	return $text;
};

/*
 * Cette fonction sert à vérifier la syntaxe d'un email
 */
function IsEmail($email)
{
	$value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
	return (($value === 0) || ($value === false)) ? false : true;
}

// formulaire envoyé, on récupère tous les champs.
$nom     = (isset($_POST['nom']))     ? Rec($_POST['nom'])     : '';
$tel     = (isset($_POST['tel']))     ? Rec($_POST['tel'])     : '';
$email   = (isset($_POST['mail']))   ? Rec($_POST['mail'])   : '';
$date   = (isset($_POST['date']))   ? Rec($_POST['date'])   : '';
$message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';

// On va vérifier les variables et l'email ...
$email = (IsEmail($email)) ? $email : ''; // soit l'email est vide si erroné, soit il vaut l'email entré
$err_formulaire = false; // sert pour remplir le formulaire en cas d'erreur si besoin

if (isset($_POST['send']))
{
	if (($nom != '') && ($email != '') && ($tel != '') && ($date != '') && ($message != ''))
	{
		// les 4 variables sont remplies, on génère puis envoie le mail
		$headers  = 'From:'.$nom.' <'.$email.'>' . "\r\n";
		//$headers .= 'Reply-To: '.$email. "\r\n" ;
		//$headers .= 'X-Mailer:PHP/'.phpversion();

		// envoyer une copie au visiteur ?
		if ($copie == 'oui')
		{
			$cible = $destinataire.';'.$email;
		}
		else
		{
			$cible = $destinataire;
		};
        $message="Nom :".$nom."\r\n"."Tel :".$tel."\r\n".$message;
		// Remplacement de certains caractères spéciaux
        $message = str_replace("&#039;","'",$message);
        
        $message = str_replace("&#8217;","'",$message);
        
        $message = str_replace("&quot;",'"',$message);
        
        $message = str_replace('&lt;br&gt;','',$message);
       
        $message = str_replace('&lt;br /&gt;','',$message);
        
        $message = str_replace("&lt;","&lt;",$message);
        
        $message = str_replace("&gt;","&gt;",$message);
       
        $message = str_replace("&amp;","&",$message);
        
        $message=preg_replace('/<br(\s+)?\/?>/i', "\n", $message);
        $message = utf8_decode($message);


		// Envoi du mail
        $num_emails = 0;
        $tmp = explode(';', $cible);
        foreach($tmp as $email_destinataire)
        {
         if (mail($email_destinataire, $date, $message, $headers))
            $num_emails++;
    }

    if ((($copie == 'oui') && ($num_emails == 2)) || (($copie == 'non') && ($num_emails == 1)))
    {
     echo '<p>'.$message_envoye.'</p>';
 }
 else
 {
     echo '<p>'.$message_non_envoye.'</p>';
 };
}
else
{
		// une des 3 variables (ou plus) est vide ...
  echo '<p>'.$message_formulaire_invalide.'</p>';
  $err_formulaire = true;
};
}; // fin du if (!isset($_POST['envoi']))

if (($err_formulaire) || (!isset($_POST['send'])))
{
	// afficher le formulaire
	
	?>

    <article class="contact">

        <h1>Contactez-nous pour faire une réservation</h1>

        <form method="POST" action="" name="formulaire">
            <label for "nom" >Nom et prénom</label>
            <input type="text" name="nom" maxlength="20" autofocus required /><br><br>
            <label for "tel">Téléphone</label>
            <input type="tel" name="tel"/><br><br>
            <label for "mail">E-mail</label>
            <input type="email" name="mail" required /><br><br>

             <label for "date">Date de réservation</label>
            <input type="date" id="date" name="date" /><br><br>



            <label for "message">Votre message</label>
            <textarea name="message" rows=10 cols=50 maxlength="200" required></textarea><br><br>

            <div class="boutons">
                <input type="submit" name="send" value="Envoyer" />
                <input type="reset" name="reset" value=" Annuler " />
            </div>
        </form>
        <?php
    }
    ?>
    <h1>Närenj</h1>
    
    <p><span>Adresse :</span> 178 Rue de Bourgogne 45000 Orléans   </p>
    <p><span>E-Mail :</span><a  href="mailto:enghazar@gmail.com">enghazar@gmail.com</a> </p>
    <p><span>Portable :</span><a  href="tel:07 68 07 34 43 "> 07 68 07 34 43 </a></p>

    
    </article>

    <div id='map'>
    
    <?php include "footer.php"; ?>

    <script type="text/javascript" src="js/map.js"></script>
</body>

</html>