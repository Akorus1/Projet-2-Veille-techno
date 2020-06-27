<?php session_start(); ?>
<?php
require_once("../../BDD/bdd.php"); 

if(isset($_GET['del']) && empty($_GET['id'])){ 
        unset($_SESSION['panier'][array_search($_GET['del'], $_SESSION['panier'])]);
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $select = $bdd->prepare('SELECT ID FROM `produits` WHERE `ID`=:id');
    $select->execute(array(
        'id' => $id));
    $resultat=$select->fetch();   
    $id1 = $resultat['ID'];
    array_unique($_SESSION['panier']);
    array_push($_SESSION['panier'], $id1);
    unset($_SESSION['panier'][$_GET['id']]);
}

if(empty($_SESSION['panier'])){
        header ('Location: http://projet2/Projet-2-Veille-techno/Accueil_et_Mentions_légales/Accueil.php');
}
if(isset($_GET['submit'])){
       header( 'Location: Commande.php');
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
        <title>Mon panier</title>
</head>
<header>
        <?php require_once("../../Elements/menu.php"); ?>
</header>
<body>
 <div class="box">
 <form action="Commande.php" method="get">
 <button type="submit" name="submit" class="btn btn-primary" value="submit" style="margin:2% 20%;"> Finaliser ma commande</button>
 <?php   

        $ids=array_values($_SESSION['panier']);
        $requete = $bdd->prepare('SELECT * FROM `produits` WHERE `ID` IN ('.implode(',',$ids).')');
        $requete->execute();
        while($produit=$requete->fetch(PDO::FETCH_OBJ))  {?>
                <div style="max-height:15%; max-width:15%; margin-left:20%; padding:0px;" >                    
                <img class="img-fluid" src="../../img/<?php echo $produit->ID;  ?>.jpg" >
                <div style="border-top:solid;">
                <B><?php echo $produit->Nom; echo $produit->Type; ?><br>
                 <?php echo $produit->Prix; ?>€</B>
                       <div style="margin: -24% 82%; border-left:solid">
                               <a href="panier.php?del=<?= $produit->ID;?>">
                               <svg class="bi bi-trash-fill" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
</svg>
                               </a>
                       </div>
               </div>
               <div style="margin:-5% 13%; position:absolute;">
                <B><p><?php echo $produit->Description; ?></p></B>
                </div>
               </div>
               <br><br><br><br>
               <?php ?>
               <input type="hidden" name="type" value="<?php echo $produit->Type ?>" ></hidden>
               <input type="hidden" name="img" value="<?php echo $produit->ID ?>" ></hidden>
               <input type="hidden" name="nom" value="<?php echo $produit->Nom ?>" ></hidden>
               
               <?php
               
               if(isset($_SESSION['commande'], $produit->Type)) {
                var_dump(isset($_SESSION['commande']));
               
               array_push($_SESSION['commande'], $produit->Type);
               unset($_SESSION['commande'][$produit->Type]);
               var_dump($_SESSION['commande']);
               }
               /* unset($_SESSION['panier']);== $_SESSION['commande']['Type'])*/
               
               
         } ?>               
</form>               
</div>
</body>
<footer>
        <?php require_once("../../Elements/footer.php"); ?>
</footer>
</html>