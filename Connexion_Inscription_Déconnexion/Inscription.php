<div class="inscriptionform">
    <div id="register" class="animate form">
        <form  method="post" action="scriptInscription.php" autocomplete="on">
            <h1> Inscription Etudiants</h1>

            <?php //NOM ?>
            <p>
                <label class="firstname" data-icon="u" ></label>
                <input id="usernamesignup" name="prenom" required="required" type="text" placeholder="Prenom" />
            </p>

            <?php //Prenom ?>
            <p>
                <label class="" data-icon="p" ></label>
                <input id="lastnamesignup" name="nom" required="required" type="text" placeholder="Nom"/>
            </p>

            <?php //mots de passe ?>
            <p>
                <label class="password" data-icon="p" ></label>
                <input id="passwordsignup" name="motdepasse" required="required" type="password" placeholder="Mot de passe"/>
            </p>

            <?php //Addresse mail ?>
            <p>
                <label class="" data-icon="p" ></label>
                <input id="mailsignup" name="email" required="required" type="email" placeholder="E-Mail"/>
            </p>

            <?php //Adresse ?>
            <p>
                <label class="" data-icon="p" ></label>
                <input id="adresssignup" name="adresse" required="required" type="text" placeholder="Adresse"/>
            </p>

            <?php //Code postal ?>
            <p>
                <label class="" data-icon="p" ></label>
                <input id="costalcode" name="codepostal" required="required" type="text" placeholder="Code Postal"/>
            </p>

            <?php //Ville ?>
            <p>
                <label class="" data-icon="p" ></label>
                <input id="city" name="ville" required="required" type="text" placeholder="Ville"/>
            </p>

            <p class="signin_button">
                <input type="submit" value="S'inscrire"/>
            </p>
            <p class="change_link">
                Déjà inscrit ?
                <a href="./Connexion.php" class="to_register"> Connexion </a>
            </p>
        </form>
    </div>
</div>