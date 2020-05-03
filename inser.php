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


if(isset($_POST['forminsertion']))
{
if(!empty($_POST['intitule'])AND
   !empty($_POST['nbepisodes']) AND
   !empty($_POST['acteursprincipaux'])AND
   !empty($_POST['realisateur']) AND
   !empty($_POST['anneesortie']))
   {
             
          $insertserie=$bdd->prepare("INSERT INTO serie (`intitule`, `nbepisodes`, `acteursprincipaux`, `realisateur`, `anneesortie`)
           VALUES (:intitule,:nbepisodes,:acteursprincipaux,:realisateur,:anneesortie)");
          $insertserie->execute( [ "intitule" => $_POST['intitule'],"nbepisodes" => $_POST['nbepisodes'],
           "acteursprincipaux" => $_POST['acteursprincipaux'],"realisateur" => $_POST['realisateur'],
           "anneesortie" => $_POST['anneesortie']]);
           die("votre serie a été correctement ajoutée");
           }else{
             $erreur="Tous les champs doivent etre completés ";
             }}
?>
<!DOCTYPE html>
<html>
  <head>
 <meta charset="utf-8"/>
  <title >insertionserie</title>
  <link rel="stylesheet" href="inscriptionpro.css" />
</head>
<body>
  <!-- Page conçu que pour l'administrateur-->
  <div id="i">
  <h1>Insertionserie<h1>
<form method="POST" action="" id="form">
    <table>
      <tr>
  <td> <label>intitulé :</label></td>
 <td> <input type="text"name="intitule" 
   class="pr" placeholder="You"/></td>
  </tr>
    <tr>
  <td> <label>Nombres d'episodes :</label></td>
 <td> <input type="number" name="nbepisodes" 
   class="pr" placeholder="7"/></td>
  </tr>
   <tr>
  <td> <label>Acteurs principaux :</label></td>
 <td> <input type="text" name="acteursprincipaux"
  class="pr"/></td>
  </tr>
   <tr>
  <td> <label> Réalisateur:</label></td>
 <td> <input type="text" name="realisateur"   class="pr" /></td>
  </tr>
     <tr>
  <td> <label>Année de sortie :</label></td>
 <td> <input type="number" name="anneesortie" class="pr"   /></td>
  </tr>
  <tr>
   <td></td>
  <td>  <input type="submit"  name="forminsertion" value="Ajouter" /></td>
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
