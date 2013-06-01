<div id="dropdown" class="loading"></div><!-- #dropdown Menu -->

<div class="title">
        <div class="wrapper">
            <h2><?php echo $device->nom; ?> <span>par</span> <a href="#" title="<?php echo $device->nom_fabriquant; ?>"><?php echo $device->nom_fabriquant; ?></a></h2> <!-- INSÉRER LE NOM DU DEVICE et le lien vers la page du fabricant-->
        </div>
    </div>
    
    <section id="metapp">
        <div class="wrapper">
    
        <div class="icone"><img width="90px" height="90px" src="<?php echo $device->photo; ?>"></div>
        
        <div class="content right">
            <?php if($device->moyenne_note): ?>
                <div class="appnote noteGens"><span></span><a href="#thegrid" class="note <?php echo $device->class_note; ?>"><?php echo ucfirst($device->class_note); ?></a></div>
            <?php endif; ?>
        </div>
        
        </div>
    </section>
    
    <section id="appSectionOne">
        <div class="wrapper">
            <div class="sidebar left">
                <div class="features">
                    <span class="<?php echo $device->type; ?>"><?php echo ucfirst($device->type); ?></span>
                </div>
                <?php if($device->est_ce || $device->est_dispo_medical): ?>
                <div class="labels">
                    <?php if($device->est_ce): ?>
                	    <span class="label ce">CE</span>
                    <?php endif; ?>
                    <?php if($device->est_dispo_medical): ?>
                	    <span class="text">Cet objet est un dispositif médical</span>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php if($user): ?>
                <div class="buttons">
                    <?php if(!$already_noted): ?>
                        <a href="#commentModal" class="noter">Noter le Produit</a>
                    <?php endif; ?>
                    <a href="#" class="signaler">Signaler</a>
                </div>
                <?php endif; ?>
            </div>
            <div class="content right description">
                <h3>Notre Avis</h3>
                <?php echo $device->avis; ?>
            </div>
            <div class="clear"></div>
        </div> <!-- end wrapper -->
    </section>
    
    <div class="line"></div>

<?php /*   
    <section id="appSectionTwo" class="catmasante">
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
    */ ?>
    
    <section id="descTabs">
    	<nav>
    		<div class="wrapper">
    			<ul>
    				<li class="selected" data-destination="galeriePhotos">
    					Galerie Photos
    				</li>
    				<li data-destination="motDuFabricant">
    					Le Mot du Fabricant
    				</li>
    				<li data-destination="commentaires">
    					Commentaires
    				</li>
    				<li data-destination="appsCompatibles">
    					Apps Compatibles
    				</li>
    				<li data-destination="revueDePresse">
    					Revue de presse
    				</li>
    			</ul>
    		</div>
    	</nav>
    	
    	<div class="wrapper">
	    	<div class="tabContent open" id="galeriePhotos">
	    		<ul>
                    <?php foreach($device->photos as $photo): ?>
                        <li><img src="<?php echo $photo->full_url; ?>"/></li>
                    <?php endforeach; ?>
	    		</ul>
	    	</div>
	    	
	    	<div class="tabContent" id="motDuFabricant">
                <?php if(!empty($application->mot_fabriquant)): ?>
                    <?php echo $application->mot_fabriquant; ?>
                <?php else: ?>
                    Si vous êtes l'éditeur de cette application, contactez-nous par mail à <a href="mailto:<?php echo config_item('contact_mail'); ?>"><?php echo config_item('contact_mail'); ?></a>
                <?php endif; ?>
	    	</div>
	    	
	    	<div class="tabContent" id="commentaires">
	    		Commentaires :
                <?php foreach($device->notes as $notation): ?>
                    <?php echo $notation->pseudo.' a noté cette application '.$notation->date_full.' : '.$notation->moyenne_note.' / 10 <br/>'; ?>
                <?php endforeach; ?>

	    	</div>
	    	
	    	<div class="tabContent" id="appsCompatibles">
	    		<section id="devices"><?php  echo $widget_deviceapps; ?></section> <!-- Section App compatobles --> <?php // TODO : remplacer par widget app compatobles ?>
	    	</div>
	    	
	    	<div class="tabContent" id="revueDePresse">
                <p><?php echo $device->presse; ?></p>
	    	</div>
    	</div>
    	
    </section>
<?php if($user): ?>
<section id="partners"><?php echo $partners; ?></section> <!-- Section Partenaires -->
<div class="modal hide fade" id="commentModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id="modal-notation-close"></button>
        <h3>Noter ce produit</h3>
    </div>
    <div class="modal-body">
        <p class="explication">Nullam quis risus eget urna mollis ornare vel eu leo. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
        <form method="post" id="form-noter-accessoire" data-criteres='<?php echo json_encode($criteres); ?>' data-action="<?php echo site_url('accessoire/'.$device->id.'/note/'.$user->id) ?>" name="email_form" id="email_form">
            <?php foreach($criteres as $critere): ?>
                <p><input type="text" id="note-accessoire-<?php echo $critere->id; ?>"/></p>
            <?php endforeach; ?>
            <p><textarea id="commentaire-accessoire"></textarea></p>
            <p><button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
    <div id="accessoire-notation-error" class="alert alert-error hide"></div>
    <div id="accessoire-notation-success" class="success alert-success hide"></div>
</div>
<?php endif; ?>