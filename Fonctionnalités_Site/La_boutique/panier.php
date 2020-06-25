<?php session_start() ?>

<?php
require_once("../../BDD/bdd.php"); 

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $select = $bdd->prepare('SELECT ID FROM produits WHERE ID=:id');
    $select->execute(array(
        'id' => $id));
    $resultat = $select->fetch();
    $id1 = $resultat['ID'];
    array_push($_SESSION['panier'], $id1);
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
 <?php 
        $ids = array_keys($_SESSION['panier']);
        if(empty($ids)){
            $req=array();
        } 
        else{
        $req = $bdd->prepare('SELECT * FROM produits WHERE ID IN ('.implode(',', $ids).')');
        $req->execute();
        var_dump($req);
        }
        if($produit1=$req->fetch(PDO::FETCH_OBJ)){
        if(isset($_GET['del'])){
            if($_GET['del'] == $produit1->ID){
               unset($_SESSION['pannier'][$_GET['del']]);
               var_dump($_SESSION['panier']);
               }
             } ?>
         <div style="max-height:25%; max-width:25%; margin:auto; padding:0px;">                    
         <img class="img-fluid" src="../../img/<?php echo $produit1->ID; ?>.jpg">
         <div style="border-top:solid;">
         <B><?php echo $produit1->Nom; echo $produit1->Type; ?><br>
          <?php echo $produit1->Prix; ?>€</B>
                <div style="margin: -15% 82%; border-left:solid">
                <a href="panier.php?del=<?= $produit1->ID;?>">
                        <svg class="bi bi-trash-fill" width="3em" height="3em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                        </svg>
                </a>        
                </div>
        </div>
        </div>
        <br><br><br><br>
        <?php } ?>
</div>
</body>
<footer>
        <?php require_once("../../Elements/footer.php"); ?>
</footer>
</html>