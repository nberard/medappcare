<div id="dropdown" class="loading"></div><!-- #dropdown Menu -->

<div class="title">
    <div class="wrapper">
        <h2><?php echo $application->titre; ?><span> par</span> <a href="<?php echo $application->lien_contact ? $application->lien_contact : '#'; ?>" title="<?php echo $application->nom_editeur; ?>"><?php echo $application->nom_editeur; ?></a></h2> <!-- INSÉRER LE TITRE DE L'APP ICI et le lien vers la page du Développeur-->
    </div>
</div>

<section id="metapp" class="cat<?php echo $application->class; ?>">
    <div class="wrapper">

        <div class="icone"><img width="90px" height="90px" src="<?php echo $application->logo_url; ?>"></div>

        <div class="content right">
            <div class="appnote noteMedappcare"><span></span><a href="#thegrid" class="note deux">Deux</a></div>
            <div class="appnote notePro"><span></span><a href="#thegrid" class="note neuf">Cinq</a></div>
            <div class="appnote noteGens"><span></span><a href="#thegrid" class="note huit">Huit</a></div>
        </div>

    </div>
</section>

<section id="appSectionOne" class="cat<?php echo $application->class; ?>">
    <div class="wrapper">
        <div class="sidebar left">
            <div class="os">
                <div class="list">
                    <?php if($application->device_id == $deviceApple): ?>
                        <span class="ios">iOS</span> <!-- INSERER L'OS -->
                    <?php elseif($application->device_id == $deviceAndroid): ?>
                        <span class="android">Android</span>
                    <?php else: ?>
                        <span class="web">Web App</span>
                    <?php endif; ?>
                    <span class="price"><?php echo $application->prix_complet; ?></span>
                </div>
            </div>
            <div class="labels">
            	<span class="label ce">CE</span>
            	<span class="text">Cet objet est un dispositif médical</span>
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

<section id="appSectionTwo" class="cat<?php echo $application->class; ?>">
    <div class="wrapper">
        <div class="sidebar left">
            <div class="qrcode">
                <img src="<?php echo img_url('tmp/qr.png'); ?>" alt="qr" width="200" height="200">
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

<section id="descTabs" class="cat<?php echo $application->class; ?>">
    	<nav>
    		<div class="wrapper">
    			<ul>
    				<li class="selected" data-destination="galeriePhotos">
    					Screenshots
    				</li>
    				<li data-destination="motDelEditeur">
    					Le mot de l'éditeur
    				</li>
    				<li data-destination="commentaires">
    					Commentaires
    				</li>
    				<li data-destination="devicesCompatibles">
    					Produits connectés compatibles
    				</li>
    				<li data-destination="revueDePresse">
    					Revue de presse
    				</li>
    			</ul>
    		</div>
    	</nav>
    	
    	<div class="wrapper">
	    	<div class="tabContent open" id="galeriePhotos">
	    		Screenshots
	    	</div>
	    	
	    	<div class="tabContent" id="motDelEditeur">
	    		<div class="logoPart">
		    		
		    		<img src="<?php echo img_url('tmp/logo-withings.png'); ?>" alt="[nom-de-l-editeur]"/>
		    		
	    		</div>
	    		<p><?php // echo $device->{"description_".config_item('language_short')}; ?></p>
	    	</div>
	    	
	    	<div class="tabContent" id="commentaires">
	    		Commentaires
	    	</div>
	    	
	    	<div class="tabContent" id="devicesCompatibles">
	    		<section id="devices"><?php echo $widget_devices; ?></section> <!-- Section Devices connectés -->
	    	</div>
	    	
	    	<div class="tabContent" id="revueDePresse">
	    		Revue de presse
	    	</div>
    	</div>
    	
</section>

<section id="partners"><?php echo $partners; ?></section> <!-- Section Partenaires -->