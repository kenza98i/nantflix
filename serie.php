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
if(isset($_GET['mail'])){
    
   $requser = $bdd->prepare("SELECT * FROM utilisateur WHERE mail=:mail");
   $requser->execute(array("mail"=>$mail));
   $userinfo = $requser->fetch();
?>
<!DOCTYPE html>
<html>
  <meta charset="utf-8"/>
  <title >Profil</title>
   <link rel="stylesheet" href="serie.css"/>
  
  </head>
<body>
   <h1 id="i"> Bienvenue "<?php echo $_SESSION['prenom'];?>" </h1>
  <h4> Profil de <?php echo  $_SESSION['prenom'];?> </h4>
 <a href="listes.php"><h4>Listes des séries disponibles</h4></a>
  <a href="rec.php"><h4>Rechercher</h4></a>
<a href="connexionpro.php">Déconnexion</a>
</body>
</html>
<?php
  }
?>
