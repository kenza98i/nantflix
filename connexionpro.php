<?php
session_start();
try
{
 $bdd = new PDO('mysql:host=localhost;dbname=nantflix', 'root', 'LINUX@1996v',
  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

}
catch (Exception $e)
{
 
    die('Erreur : ' . $e->getMessage());
}
if(isset($_POST['formconnexion'])){
     $mail=htmlspecialchars($_POST['mail']);
     $motdepasse=($_POST['motdepasse']);
     $hashedpass = password_hash($motdepasse, PASSWORD_DEFAULT);
    if(!empty($mail)AND !empty($motdepasse)){
      $requser = $bdd->prepare("SELECT * FROM utilisateur WHERE mail=:mail AND motdepasse =:motdepasse");
      $requser->execute(array("mail" => $mail,"motdepasse" => $motdepasse));
      $userexist = $requser->rowCount();
      if ($userexist == 1){
         $userinfo = $requser->fetch();
         $_SESSION['mail']= $userinfo['mail'];
         $_SESSION['prenom']= $userinfo['prenom'];
         $_SESSION['nom']= $userinfo['nom'];
         header("Location:serie.php?mail=".$_SESSION['mail']);
        }else{
            $erreur="Mauvais mail ou motdepasse!";
          }
      }
      else{
        $erreur="Tous les champs doivent etre complétés!";
        }
}
?>
<!DOCTYPE html>
<html>
  <meta charset="utf-8"/>
  <title >Connexion</title>
   <link rel="stylesheet" href="connexionpro.css" />
 
  
  </head>
<body>
  <div align="center">
<h1>Connexion<h1>
    
<form method="POST" action="" id="form">
    <table id="i">
      <tr>
<td> <label>Email :</label> </td>
 <td><input type="email" name="mail" value ="<?php if(isset ($mail)){echo $mail;} ?>"
  class="pr" placeholder="Dupontsyrine@gmail.com"/></td>
  </tr>
  <tr>
<td><label>Motdepasse :</label></td>
 <td><input type="password" name="motdepasse" class="pr" /></td></tr>
<tr><td ><input type="submit"  name="formconnexion" value="Se connecter" class="vv" /></td>
</tr>
</table>
</form>
</div>
<?php
  if(isset($erreur))
  {
    echo '<font color="red" >'.$erreur."</font>";
  }
?>

</body>
</html>
