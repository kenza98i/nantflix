<?php
session_start();
try
{
 $bdd = new PDO('mysql:host=localhost;dbname=nantflix', 'root', 'LINUX@1996v',//connexion base de données
  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

}
catch (Exception $e)
{
 
    die('Erreur : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
  <meta charset="utf-8"/>
  <title >Profil</title>
   <link rel="stylesheet" href="serie.css"/>
  </head>
<?php
 
  $query = "SELECT * FROM serie ";//selectionner tous les champs de la table serie 
  try {
    $bdd_select = $bdd->prepare($query);
    $bdd_select->execute();
    $NbreData = $bdd_select->rowCount();    // nombre d'enregistrements (lignes)
    $rowAll = $bdd_select->fetchAll();     //recupérer tout les champs 
    
  } catch (PDOException $e){ echo 'Erreur SQL : '. $e->getMessage().'<br/>'; die(); }
 
  if ($NbreData != 0) 
  
{
?>
<body>
  <h2>Liste des  séries disponibles :</h2> 
<!-- affichage  les series dans un tableau -->
  <table >
    <thead>
        <tr>
            <th>idserie</th>
            <th>intitulé</th>
            <th>Nombres d'episodes</th>
            <th>Acteurs principaux</th>
            <th>Réalisateur</th>
            <th>Année de sortie</th>
            <th>choix de série</th>
        </tr>
    </thead>
    <tbody>
<?php
    // pour chaque ligne (chaque enregistrement)
    foreach ( $rowAll as $row ) 
    { 
    // DONNÉES À AFFICHER dans chaque cellule de la ligne
?>

  <tr>
    
            <td><?php echo $row['idserie']; ?></td>
            <td><?php echo $row['intitule']; ?></td>
            <td><?php echo $row['nbepisodes']; ?></td>
            <td><?php echo $row['acteursprincipaux']; ?></td>
            <td><?php echo $row['realisateur']; ?></td>
            <td><?php echo $row['anneesortie']; ?></td>
       <td><form method ="GET" action="">
         <!--$row['idserie'] nos permet de renvoyer l'identifiant de série choisit -->
      <button type="submit" name="myButton" value="<?php echo $row['idserie'];?>">visionner</button> </form></td>
        </tr>
        
<?php
} // fin foreach
if( isset($_GET['myButton'])){//

$_SESSION['idserie']=$_GET['myButton'];//on sauvegarde l'identifiant de la serie choisit dans une variable de session 
header("Location:visionner.php");//on redérige l'utilisateur aprés son choix vers la page de visionnage
}
?>
</tbody>
    </table>
    <?php
} 
?>
<br/><br/>
</body>
</html>

