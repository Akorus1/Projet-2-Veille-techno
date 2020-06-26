<?php
/* Lien avec la DBB */
$bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');

/* Récupération des login du formulaire*/
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email =  $_POST['email'];
$mdp = $_POST['motdepasse'];
$adresse = $_POST['adresse'];
$cp = $_POST['codepostal'];
$ville = $_POST['ville'];

//on regarde si le mots de passe possede une MAJ et un CHIFFRE
if(preg_match_all('#[A-Z0-9]#', $mdp)){


    // chiffrage du mdp
    $mdp_chiffrer = sha1($mdp);


    // Requete qui va insérer les données dans la bdd pour les nouveau inscrit
    // Requête préparée pour empêcher les injections SQL
    $requete_création_User = $bdd->prepare("INSERT INTO utilisateur ( Nom, Prenom, Mots_de_passe, Email, Adresse, Code_Postal, Ville, Status) VALUES( :nom,:prenom,:motdepasse,:email,:adresse,:codepostal,:ville)");

    //préparation des variables
    $requete_création_User->bindValue(':nom', $nom, PDO::PARAM_STR); //PDO::PARAM_STR est l'encodage vers un varchar pour mysql
    $requete_création_User->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $requete_création_User->bindValue(':email', $email, PDO::PARAM_STR);
    $requete_création_User->bindValue(':motdepasse', $mdp_chiffrer, PDO::PARAM_STR);
    $requete_création_User->bindValue(':adresse', $adresse, PDO::PARAM_STR);
    $requete_création_User->bindValue(':codepostal', $cp, PDO::PARAM_STR);
    $requete_création_User->bindValue(':ville', $ville, PDO::PARAM_STR);

    // Requete qui permet de voir si un utilisateur est deja créer
    $requete_recup = $bdd -> prepare("SELECT Nom, Prenom, Mots_de_passe, Email, Adresse, Code_Postal, Ville from utilisateur where Nom = :nom");
    $requete_recup->bindValue(':nom', $nom, PDO::PARAM_STR); //PDO::PARAM_STR est l'encodage vers un varchar pour mysql

    $requete_recup->execute();

    $donne = $requete_recup->fetch();
    var_dump($donne);

    //Si l'utilisateur est deja créer redirection vers la page de connexion sinon on le créer
    if($nom == $donne['Nom'] && $prenom == $donne['Prenom'] && $mdp_chiffrer == $donne['Mots_de_passe'] && $email == $donne['Email']){
        echo "<script type='text/javascript'>window.location.replace('Connexion.php')</script>";
    }else{
        //création de l'utilisateur
        $requete_création_User->execute();
        echo "<script type='text/javascript'>window.location.replace('Connexion.php')</script>";
    }

}

?>