<!--premiere partie pour acceder a la base de données correctement puis une fois on appuie sur 
le bouton submit vérification avec isset on sécurise les mails avc la fonction htmldpecialchars
et les mots de passe avec hashedpass puisque avec md5 y'a des dictionnaires qui arrivent a décrypter les codes 
j'ai choisis cette méthode la puis on vérifie si tous les champs sont complétés avec !empty sinon on affiche un message
 a l'utilisateur pour qu'ils completent tous les champs. On verifie aussisi le mail et le mail de 
 validation se correspondent on utilise pour l'email la fonction filter_var pour sécuriser meme si
  on a specifier dans le formlaire que c'est un mail mail l'utilisateur qui s'est connait un peu on html peut changer cela 
 dans le code source de la page et faire rentrer n'importe quoi puis les deux mots de passes pareils puis on selectionne 
 dans la base l'email qui correspond a lemail fais rentré par lutilisateur pour voir s'il a deja eté utilise avec rowCount 
 si s'il cas on insert ces informations dans la base de données sinon on affiche un message d'erreur.

 -->
<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=nantflix', 'root', 'LINUX@1996v', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    
}
catch (Exception $e)
{
 
    die('Erreur : ' . $e->getMessage());
}


if(isset($_POST['forminscription']))
{

       $mail=htmlspecialchars($_POST['mail']);
       $mail2=htmlspecialchars($_POST['mail2']);
       $motdepasse=($_POST['motdepasse']);
       $motdepasse2=($_POST['motdepasse2']);
       $hashedpass = password_hash($motdepasse, PASSWORD_DEFAULT);
       $hashedpass = password_hash($motdepasse2, PASSWORD_DEFAULT);

    if(!empty($_POST['prenom'])AND
   !empty($_POST['nom']) AND
   !empty($_POST['Datedenaissance'])AND
   !empty($_POST['mail']) AND
   !empty($_POST['phone'])AND
   !empty($_POST['motdepasse']))
   {
      if($mail == $mail2){
        if(filter_var($mail,FILTER_VALIDATE_EMAIL)){
          $reqmail=$bdd->prepare("SELECT * FROM utilisateur WHERE mail=:mail ");
          $reqmail->execute(array("mail" => $mail));
          $mailexist= $reqmail->rowCount();
          if($mailexist == o){
             if($motdepasse == $motdepasse2){
          $insertmembre=$bdd->prepare("INSERT INTO utilisateur (`prenom`, `nom`, `mail`, `motdepasse`, `phone`, `Datedenaissance`) values (:prenom,:nom,:mail,:motdepasse,:phone,:Datedenaissance)");
          $insertmembre->execute( [ "prenom" => $_POST['prenom'],"nom" => $_POST['nom'], "mail" => $_POST['mail'],"motdepasse" => $_POST['motdepasse'],"phone" => $_POST['phone'],"Datedenaissance" => $_POST['Datedenaissance']]);
          die("votre compte a été crée ") ;
             }
        else{
             $erreur="Vos mots de passe correspondent pas !";
      } }else{
        $erreur="Adresse mail déja utilisée !";
        }

          }
          else{
            $erreur="Votre adresse mail n'est pas valide!";
            }


  }
  else{
    $erreur="Vos adresses mail ne correspondent pas! ";
  }
  }else{
    $erreur="Tous les champs doivent etre complétés!";
  }
}
?>
<!--formulaire d'inscription-->
<!DOCTYPE html>
<html>
  <head>
  
  <meta charset="utf-8"/>
  <title >inscription</title>
    <link rel="stylesheet" href="inscriptionpro.css" />

  </head>
<body>
  <div id="i">
  <h1>Créez votre compte nantflix<h1>


  <form method="POST" action="" id="form">
    <table>
      <tr>
  <td> <label>Prenom :</label></td>
 <td> <input type="text"name="prenom" value ="<?php if(isset ($prenom)){echo $prenom;}?>"
   class="pr" placeholder="Syrine"/></td>
  </tr>
    <tr>
  <td> <label>Nom :</label></td>
  <!--<?php if(isset ($nom)){echo $nom;}?> si l'utilisateur s'est trompé sur un champ il a pas a tout réécrire -->
 <td> <input type="text"name="nom" value ="<?php if(isset ($nom)){echo $nom;}?>"
   class="pr" placeholder="Dupont"/></td>
  </tr>
   <tr>
  <td> <label>Email :</label></td>
 <td> <input type="email" name="mail" value ="<?php
if(isset ($mail)){echo $mail;}?>"
  class="pr" placeholder="Dupontsyrine@gmail.com"/></td>
  </tr>
   <tr>
  <td> <label>Confirmation email :</label></td>
 <td> <input type="email" name="mail2" value ="<?php
if(isset ($mail2)){echo $mail2;}?>"
  class="pr" placeholder="Dupontsyrine@gmail.com"/></td>
  </tr>
     <tr>
  <td> <label>Motdepasse :</label></td>
 <td> <input type="password" name="motdepasse" class="pr"  /></td>
  </tr
  <tr>
        <tr>
  <td> <label>Confirmation motdepasse :</label></td>
 <td> <input type="password"name="motdepasse2" class="pr"   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required /></td>
  </tr>
  <tr>
  <td> <label>Telephone :</label></td>
 <td> <input type="tel"name="phone"  value ="<?php if(isset ($phone)){echo $phone;} ?>"
   class="pr" placeholder="1234567890"  /></td>
  </tr>
   <tr>
     <!--le max pour que ça soit accessible qu'aux majeurs-->
  <td> <label>Datedenaissance :</label></td>
 <td> <input type="date"name="Datedenaissance" value ="<?php
 if(isset ($Datedenaissance)){echo $Datedenaissance;}?>"
   class="pr"  max="2003-01-01"/></td>
  </tr>
<tr>
    <br/>
  <td></td>
  <td>  <input type="submit"  name="forminscription" value="Je m'inscris" /></td>
</tr>
</table>
</form>
</div>
<!--Pour afficher les erreurs en rouge -->
<?php
  if(isset($erreur))
  {
    echo '<font color="red" >'.$erreur."</font>";
  }
?>

</body>
</html>
