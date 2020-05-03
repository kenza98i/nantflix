<!--formulaire pour effectuer une recherche avec l'intitulé de la série-->
<!--Pour accéder a la base de données la premiere partie puis on verifie si l'utilisateur a saisie sa recherche avant dexecuter 
la requete de selection en utilusant un LIKE -->
<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=nantflix', 'root', 'LINUX@1996v', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

}
catch (Exception $e)
{
 
    die('Erreur : ' . $e->getMessage());
  }
if(isset($_GET['recherche']) AND !empty($_GET['recherche']))
{
   
  $recherche = $_GET['recherche'];
  $b =$bdd->query('SELECT * FROM serie WHERE intitule LIKE "%'.$recherche.'%"  ') ;
     
}
?>
<!--FORMULAIRE DE RECHERCHE -->
<!DOCTYPE html>
<html>
  <head>
<meta charset="utf-8"/>
  <title >Recherche</title>
    <link rel="stylesheet" href="rec.css" />
</head>
<body>
<h1>Rercherche dans la liste des series disponibles </h1>
<form method="GET" action="">
Veuillez saisir l'intitulé de votre série:<input type="search" name="recherche"/>
<input type="submit" value="Valider"/>
</form>
<!--On verifie si y'a un resultat avec la fonction  rowCount  qui renvoie le nombre d'intitulé qui correspondent a notre recherche
puis on affiche le resultat apres lavoir recuperer avec la fonction fetch qui récupere tous les champs de la table serie  -->
<?php if($b->rowCount() > 0){ ?>
 Voila le résultat de votre recherche :
    <table >
      <tr>
      <th>intitulé</th>
      <th>nombre d'épisodes</th>
      <th>acteurs principaux</th>
      <th>Réalisateur</th>
      <th>année de sorite</th>
      </tr>
     
<?php while($a = $b->fetch()){?>
 <tr>
 <td><?= $a['intitule']?></td>
<td><?= $a['nbepisodes']?></td>
<td><?= $a['acteursprincipaux']?></td>
<td><?= $a['realisateur']?></td>
<td><?= $a['anneesortie']?></td>
</tr>
<?php } ?>
 </table>
  <!--Si aucune serie dans notre base correspond a notre recherche on affiche a l'utilisateur le msg -->
<?php } else{ ?>
Aucun résultat pour: <?= $recherche ?>...
<?php
} 
?>

</body>
</html>

