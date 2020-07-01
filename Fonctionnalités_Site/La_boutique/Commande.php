<?php session_start(); ?>

<?php 
require_once("../../BDD/bdd.php");

$nom = $_POST['nom'];
$num = $_POST['num'];
$email = $_POST['mail'];
$nom_ent = $_POST['nom_entreprise'];
$lieu_ent = $_POST['lieu_entreprise'];
$produits = $_POST['produits'];
$date = $_POST['date'];

if(isset($_POST['submit'])) 
{
        $requete2 = $bdd->prepare("INSERT INTO `commande` (`Nom_client`, `Num_telephone_client`, `Adresse_mail_client`, `Nom_entreprise`, `Localisation_entreprise`, `Nom_produits`, `Date` ) VALUES(:nom, :num, :mail, :nom_entreprise, :localisation_entreprise, :nom_produits, :date)");
        $requete2->bindParam(':nom', $nom, PDO::PARAM_STR);
        $requete2->bindParam(':num', $num, PDO::PARAM_INT);
        $requete2->bindParam(':mail', $email, PDO::PARAM_STR);
        $requete2->bindParam(':nom_entreprise', $nom_ent, PDO::PARAM_STR);
        $requete2->bindParam(':localisation_entreprise', $lieu_ent, PDO::PARAM_STR);
        $requete2->bindParam(':nom_produits', $produits, PDO::PARAM_STR);
        $requete2->bindParam(':date', $date, PDO::PARAM_INT);
        $requete2->execute();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/Projet-2-Veille-techno/Elements/Style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>Finalisation commande </title>
</head>
<header>
<?php  require_once("../../Elements/menu.php"); ?>
</header>
<body>
 <div class="box">
 <form  action="remerciements.php" method="post">
 <h2 class="text-center">Formulaire de contact</h2>
 <label for="inputLastName" class="sr-only">Nom</label>
   <input type="text" id="inputNom" name="nom" class="form-control" placeholder="Votre Nom" required autofocus>
   </br>
   <label for="inputNumtel" class="sr-only">Numéro de téléphone</label>
   <input type="text" id="inputNum" name="num" class="form-control" placeholder="Numéro de téléphone" required>
   </br>
   <label for="inputMailAddress" class="sr-only">Adresse mail</label>
   <input type="text" id="inputMail" name="mail" class="form-control" placeholder="Adresse mail" required>
   </br>
   <label for="inputNameEnterprise" class="sr-only">Nom de l'entreprise</label>
   <input type="text" id="inputNomEntreprise" name="nom_entreprise" class="form-control" placeholder="Nom de l'entrprise" >
   </br>
   <label for="inputPlace" class="sr-only">Localisation de l'entreprise</label>
   <input type="text" id="inputLieu" name="lieu_entreprise" class="form-control" placeholder="Localisation de l'entrprise">
   </br>
   <label for="inputPlace" class="sr-only"></label>
   <input type="text" id="inputLieu" name="produits" value=" Masque<?php 
    
           $ids=implode("," , $_SESSION['commande']);
           $tab=explode("," , $ids);
           $tab1=array_unique($tab);
           $ids1=implode("," ,$tab1);
        echo $ids1;?>" class="form-control" >
   </br>
   </br>
   <label for="inputDate" class="sr-only">Date</label>
   <input type="text" id="inputNom" name="date" class="form-control" placeholder="Date">
   </br>

   <a href="Connexion.php" target="blank">Déjà enregistré ? </a>
   </br>
   <button type="submit" name="submit" class="btn btn-primary" >Accepter</button>
   </form>
</div>
</body>
<footer>
        <?php require_once("../../Elements/footer.php"); ?>
</footer>
</html>