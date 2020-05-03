<?php
session_start();
try
{
 $bdd = new PDO('mysql:host=localhost;dbname=nantflix', 'root', 'LINUX@1996v');//,//connexion base de données

}
catch (Exception $e)
{
 
    die('Erreur : ' . $e->getMessage());
}
 
$i=$_SESSION['mail'];//variable de session qui stocke l'identifiant de l'utilisateur
$s=$_SESSION['idserie'];//variable de session qui stocke l'identifiant de la série choisit
   //ON selectionne l'intitulé de la série choisit
   $serie = $bdd->prepare("SELECT intitule FROM serie WHERE idserie like '%".$s."%'");
   $serie->execute();
   $ser=$serie->fetch();
   //on selectionne le prénom de l'utilisateur
   $prenom = $bdd->prepare("SELECT prenom FROM utilisateur WHERE prenom like '%".$_SESSION['prenom']."%'");
   $prenom->execute();
   $pre=$prenom->fetch();
   //on sélectionne le dernier episode regarder
   
  $req = $bdd->prepare("SELECT * FROM episode where refserie='".$s."' and Numepisode in (SELECT max(refepisode) from regarder 
  where refserie ='".$s."' and refutilisateur='".$i."' )" );
$req->execute();
  $d=$req->fetch();
 $episodeprochain=$d['Numepisode']+1; //on stocke dans la variable $episodeprochain lepisode prochain que doit l'uilisateur va regarder
  
?>
<!DOCTYPE html>
<html>
  <meta charset="utf-8"/>
  <title >Visionnage</title>
   <link rel="stylesheet" href="serie.css"/>
  </head>
<body>
  <!--l'utilisateur choisir de regarder la premier episode de la série-->
« Regarder le premier épisode de votre série <?php echo $ser['intitule'] ;?>»<a href="episode1.php">episode1</a><br/>
<!--on affiche le prochain episode que l'utilisateur doit regarder-->
 «Cher(e) <?php echo $pre['prenom'] ?> vous avez commencé la lecture de la série <?php echo $ser['intitule'] ;?>
 le prochain épisode à consulter est l’épisode <?php echo $episodeprochain ;?>»
 <a href="episode1.php">lancer lecture épsidode</a>
  </body>
</html>
