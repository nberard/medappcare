<div id="dropdown" class="loading"></div><!-- #dropdown Menu -->

<div class="title">
    <div class="wrapper">
        <h2>Titre du device <a href="developer.php" title="Nom du Développeur"><span>par</span> Nom du studio</a></h2> <!-- INSÉRER LE TITRE DE L'APP ICI et le lien vers la page du Développeur-->
    </div>
</div>

<section id="metapp" class="catmasante">
    <div class="wrapper">

        <div class="icone"></div>

        <div class="content right">
            <div class="appnote noteMedappcare"><span></span><a href="#thegrid" class="note deux">Deux</a></div>
            <div class="appnote notePro"><span></span><a href="#thegrid" class="note neuf">Cinq</a></div>
            <div class="appnote noteGens"><span></span><a href="#thegrid" class="note huit">Huit</a></div>
        </div>

    </div>
</section>

<section id="appSectionOne" class="catmasante">
    <div class="wrapper">
        <div class="sidebar left">
            <div class="os">
                <div class="list"><span class="ios">iOS</span><span class="price">4,89 €</span></div> <!-- INSERER L'OS et le prix correspondant-->
                <div class="list"><span class="android">Android</span><span class="price">2,34 €</span></div>
                <div class="list"><span class="web">Web App</span><span class="price">gratuit</span></div>
            </div>
            <div class="buttons">
                <a href="#" class="noter">Noter l'Application</a>
                <a href="#" class="signaler">Signaler</a>
            </div>
        </div>
        <div class="content right description">
            <h3>Notre Avis</h3>
            <p>Nullam quis risus eget urna mollis ornare vel eu leo. Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec sed odio dui. Nullam quis risus eget urna mollis ornare vel eu leo.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porta sem malesuada magna mollis euismod. Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Curabitur blandit tempus porttitor.</p>
        </div>
        <div class="clear"></div>
    </div> <!-- end wrapper -->
</section>

<div class="line"></div>

<section id="appSectionTwo" class="catmasante">
    <div class="wrapper">
        <div class="sidebar left">
            <div class="qrcode">
                <img src="tmp/qr.png" alt="qr" width="200" height="200">
                <span>Flashez le code ci-dessus pour télécharger l’application.</span>
            </div>
            <div class="social">
                <div class="sharingTwitter"></div>
                <div class="sharingFacebook"></div>
                <div class="sharingGoogleplus"></div>
            </div>
        </div>
        <div id ="thegrid" class="content right">
            <h5 class="soon">Retrouvez prochainement ici la grille d'évaluation de l'application.
        </div>
        <div class="clear"></div>
    </div> <!-- end wrapper -->
</section>

<section id="appTabs" class="catmasante">

</section>

<section id="devices"><?php echo $widget_devices; ?></section> <!-- Section Devices connectés -->

<section id="partners"><?php echo $partners; ?></section> <!-- Section Partenaires -->