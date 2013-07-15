<div id="dropdown" class="loading"></div><!-- #dropdown Menu -->

<div class="title">
    <div class="wrapper">
        <h2><?php echo $application->titre; ?><span> par</span> <a href="<?php echo $application->lien_contact ? $application->lien_contact : '#'; ?>" title="<?php echo $application->nom_editeur; ?>"><?php echo $application->nom_editeur; ?></a></h2>
    </div>
</div>

<section id="metapp" class="cat<?php echo $application->class; ?>">
    <div class="wrapper">

        <div class="icone">
            <img width="90px" height="90px" src="<?php echo $application->logo_url; ?>">
            <div class="os mobile">
                <div class="list">
                    <span class="<?php echo $application->device_class; ?>"><?php echo $application->device_nom; ?></span>
                    <span class="price"><?php echo $application->prix_complet; ?></span>
                </div>
            </div>
        </div>

        <div class="content">
            <?php if(isset($application->moyenne_note_medappcare) && $application->moyenne_note_medappcare > 0): ?><div class="appnote noteMedappcare"><span></span><a href="#thegrid" class="note <?php echo $application->class_note_medappcare; ?>"><?php echo ucfirst($application->class_note_medappcare); ?></a></div><?php endif; ?>
            
            <!-- DEPRECATED -->
            <!--
<?php if(isset($application->moyenne_note_pro)): ?><div class="appnote notePro"><span></span><a href="#thegrid" class="note <?php echo $application->class_note_pro; ?>"><?php echo ucfirst($application->class_note_pro); ?></a></div><?php endif; ?>
            <?php if(isset($application->moyenne_note_perso)): ?><div class="appnote noteGens"><span></span><a href="#thegrid" class="note <?php echo $application->class_note_perso; ?>"><?php echo ucfirst($application->class_note_perso); ?></a></div><?php endif; ?>
-->
        </div>

    </div>
</section>

<section id="appSectionOne" class="cat<?php echo $application->class; ?>">
    <div class="wrapper">
        <div class="sidebar left">
            <div class="os">
                <div class="list">
                    <span class="<?php echo $application->device_class; ?>"><?php echo $application->device_nom; ?></span>
                    <a class="price" href="<?php echo $application->lien_download; ?>"><?php echo $application->prix_complet; ?></a>
                </div>
            </div>
            <?php if($application->est_ce): ?>
            <div class="labels">
            	<span class="label ce">CE</span>
            	<span class="text">Cet objet est un dispositif médical</span>
            </div>
            <?php endif; ?>
            <div class="social">
                <div class="sharingTwitter">
                    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="fr">Tweet</a>
                </div>
                <div class="sharingFacebook">
                    <div id="fb-root"></div>
                    <div class="fb-like" data-send="true" data-layout="button_count" data-width="250" data-show-faces="false" data-font="lucida grande"></div>
                </div>
                <div class="sharingGoogleplus">
                    <div class="g-plus" data-action="share"></div>
                </div>
            </div>

            <div class="buttons">
                <?php if($user): ?>
                <?php if(!$already_noted): ?>
                    <a href="#commentModal" class="noter">Noter l'Application</a>
                    <?php endif; ?>
                <a href="#signalerModal" class="signaler">Signaler</a>
                <?php else: ?>
                <a href="#application-connexionModal" class="noter">Noter l'Application</a>
                <a href="#connexionModal" class="signaler">Signaler</a>
                <?php endif; ?>
            </div>
                        
        </div>
        <div class="content right description"> <!-- Ajouter une condition : s'il n'y a pas l'avis de Medappcare -->
            <h3>Notre Avis</h3>
            <p>Nullam quis risus eget urna mollis ornare vel eu leo. Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec sed odio dui. Nullam quis risus eget urna mollis ornare vel eu leo.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porta sem malesuada magna mollis euismod. Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Curabitur blandit tempus porttitor.</p>
        </div>
        <div class="content right description">
            <h3>Description de l'application</h3>
            <?php echo $application->description; ?>
        </div>
        <div class="clear"></div>
    </div> <!-- end wrapper -->
</section>

<div class="line"></div>

<section id="appSectionTwo" class="cat<?php echo $application->class; ?>">
    <div class="wrapper">
        <div class="sidebar left">
            <div class="qrcode">
                <a href="<?php echo $application->lien_download; ?>" target="_blank" title="<?php echo $application->nom; ?>"><img src="<?php echo $application->qr_code_url; ?>" title="Lien vers <?php echo $application->nom; ?>" /></a>
                <p>Flashez le code ci-dessus ou <a href="<?php echo $application->lien_download; ?>" target="_blank" title="<?php echo $application->nom; ?>">cliquez ici</a> pour télécharger l’app.</p>
            </div>
        </div>
        <div id="thegrid" class="content right">
            <h2 class="gridTitle">La Grille Medappcare</h2>
            <?php if(!empty($application->note_medappcare_detail)): ?>
            <?php foreach ($application->criteres as $critere_parent): ?>
                <div id="<?php echo strtolower($critere_parent->nom); ?>" class="onegrid">
                    <h3><?php echo $critere_parent->nom; ?></h3>
                    <div class="grid">
                        <div class="gridLables">
                        <?php $classes = array('extTitle', 'midTitle', 'intTitle'); ?>
                        <?php foreach($critere_parent->childs as $critere_enfant): ?>
                            <?php if($critere_enfant->est_affichable == 1): ?>
                                <div class="<?php echo array_shift($classes); ?>"><span class="label"><?php echo $critere_enfant->nom; ?></span><span class="thenote"><?php echo $application->note_medappcare_detail[$critere_enfant->id]; ?></span></div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </div>
                        <div class="chart">
                            <?php $classes = array('ext', 'mid', 'int'); ?>
                            <?php foreach($critere_parent->childs as $critere_enfant): ?>
                                <?php if($critere_enfant->est_affichable == 1): ?>
                                    <div class="<?php echo array_shift($classes); ?>" data-percent="<?php echo $application->note_medappcare_detail[$critere_enfant->id] * 10; ?>"></div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <span class="notemoyenne"><?php echo $application->note_medappcare_detail[$critere_parent->id]; ?></span>
                            <canvas id="extLine"></canvas>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>
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
                <ul>
	    		<?php foreach($application->screenshots as $screenshot): ?>
                    <li><img src="<?php echo $screenshot->url; ?>"/></li>
                <?php endforeach; ?>
                </ul>
	    	</div>
	    	
	    	<div class="tabContent" id="motDelEditeur">
                <?php if(!empty($application->mot_editeur)): ?>
	    		<?php echo $application->mot_editeur; ?>
                <?php else: ?>
                    Si vous êtes l'éditeur de cette application, contactez-nous par mail à <a href="mailto:<?php echo config_item('contact_mail'); ?>"><?php echo config_item('contact_mail'); ?></a>
                <?php endif; ?>
	    	</div>

            <div class="tabContent" id="commentaires">
                <div class="noteGlobale">
                    <h4>Note globale</h4>
                    <?php foreach($application->moyennes as $moyenne): ?>
                        <div class="<?php echo strtolower($moyenne->critere); ?>">
                            <label><?php echo $moyenne->critere; ?></label>
                            <div class="rateit" data-rateit-value="<?php echo $moyenne->note; ?>" data-rateit-ispreset="true" data-rateit-readonly="true" data-rateit-max="<?php echo config_item('note_max_accessoire'); ?>"></div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php echo $widget_appcomments; ?>
            </div>
	    	
    	
	    	<div class="tabContent" id="devicesCompatibles">
	    		<section id="devices"><?php echo $widget_devices; ?></section> <!-- Section Devices connectés -->
	    	</div>

            <div class="tabContent" id="revueDePresse">
                <p><?php echo $application->presse; ?></p>
            </div>
    	</div>
    	
</section>

<section id="partners"><?php echo $partners; ?></section> <!-- Section Partenaires -->



<?php if($user): ?>
    <div class="modal hide fade" id="commentModal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" id="modal-notation-close"></button>
            <h3>Noter cette application</h3>
        </div>
        <div class="modal-body">
            <p class="explication">Nullam quis risus eget urna mollis ornare vel eu leo. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
            <form method="post" id="form-noter-application" data-criteres='<?php echo json_encode($application->criteres); ?>' data-action="<?php echo site_url('application/'.$application->id.'/note/'.$user->id) ?>">
                <input type="hidden" id="application-notation-pro" value="<?php echo $application->est_pro ? 1 : 0; ?>"/>
                <?php foreach($application->criteres as $critere): ?>
                    <p><label for="note-application-<?php echo $critere->id; ?>"><?php echo $critere->nom; ?></label><input type="text" id="note-application-<?php echo $critere->id; ?>"/></p>
                <?php endforeach; ?>
                <p><textarea id="commentaire-application"></textarea></p>
                <p><button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
        <div id="application-notation-error" class="alert alert-error hide"></div>
        <div id="application-notation-success" class="success alert-success hide"></div>
    </div>
<?php endif; ?>