<div id="dropdown" class="loading"></div><!-- #dropdown Menu -->  

<div class="title">
        <div class="wrapper">
            <h2><?php echo $device->nom; ?> <span>par</span> <a href="#" title="<?php echo $device->nom_fabriquant; ?>"><?php echo $device->nom_fabriquant; ?></a></h2> <!-- INSÉRER LE NOM DU DEVICE et le lien vers la page du fabricant-->
        </div>
    </div>
    
    <section id="metapp">
        <div class="wrapper">
    
        <div class="icone">
            <img width="90px" height="90px" src="<?php echo $device->photo; ?>">
        </div>
        
        <div class="content left">
            <?php if($device->moyenne_note): ?>
                <div class="appnote noteGens"><span></span><a href="#thegrid" class="note <?php echo $device->class_note; ?>"><?php echo ucfirst($device->class_note); ?></a></div>
            <?php endif; ?>
        </div>
        
        </div>
    </section>
    
    <section id="appSectionOne">
        <div class="wrapper">
            <div class="sidebar left">
                <a class="price" href="<?php echo $device->lien_achat; ?>" target="_blank"><?php echo $device->prix_complet; ?></a>
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
                <div class="buttons">
                <?php if($user): ?>
                    <?php if(!$already_noted): ?>
                        <a href="#commentModal" class="noter">Noter le Produit</a>
                    <?php endif; ?>
                    <a href="#signalerModal" class="signaler">Signaler</a>
                <?php else: ?>
                    <a href="#device-connexionModal" class="noter">Noter le Produit</a>
                    <a href="#connexionModal" class="signaler">Signaler</a>
                <?php endif; ?>
                </div>
            </div>
            <div class="content right description">
                <h3>Notre Avis</h3>
                <?php echo $device->avis; ?>
            </div>
            <div class="clear"></div>
        </div> <!-- end wrapper -->
    </section>
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
                <?php if(!empty($device->mot_fabriquant)): ?>
                    <?php echo $device->mot_fabriquant; ?>
                <?php else: ?>
                    Si vous êtes l'éditeur de cette application, contactez-nous par mail à <a href="mailto:<?php echo config_item('contact_mail'); ?>"><?php echo config_item('contact_mail'); ?></a>
                <?php endif; ?>
	    	</div>
            <div class="tabContent" id="commentaires">
                <div class="noteGlobale">
                <h4>Note globale</h4>
                <?php foreach($device->moyennes as $moyenne): ?>
                    <div class="<?php echo strtolower($moyenne->critere); ?>">
                        <label><?php echo $moyenne->critere; ?></label>
                        <div class="rateit" data-rateit-value="<?php echo $moyenne->note; ?>" data-rateit-ispreset="true" data-rateit-readonly="true" data-rateit-max="<?php echo config_item('note_max_accessoire'); ?>"></div>
                    </div>
                <?php endforeach; ?>
                </div>
	    	    <?php echo $widget_devicecomments; ?>
            </div>
	    	<div class="tabContent" id="appsCompatibles">
	    		<section id="apps"><?php  echo $widget_deviceapps; ?></section> <!-- Section App compatobles --> <?php // TODO : remplacer par widget app compatobles ?>
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
        <form method="post" id="form-noter-accessoire" data-criteres='<?php echo json_encode($device->criteres); ?>' data-action="<?php echo site_url('accessoire/'.$device->id.'/note') ?>">

            <ul id="response"></ul>
            
            <ul class="reviewPost">
                <?php foreach($device->criteres as $critere): ?>
                    <label for="note-accessoire-<?php echo $critere->id; ?>"><?php echo strtoupper($critere->nom); ?></label>
                    <input type="hidden" id="note-accessoire-<?php echo $critere->id; ?>">
                    <div class="rateit" data-rateit-step="1" data-rateit-resetable="false" data-rateit-max="5" data-rateit-backingfld="#note-accessoire-<?php echo $critere->id; ?>"></div>
                <?php endforeach; ?>
<!--                <li>-->
<!--                    <label>ERGONOMIE</label>-->
<!--                    <input type="hidden" id="ergo">-->
<!--                    <div data-productid="312" class="rateit" data-rateit-resetable="false" data-rateit-max="5" data-rateit-backingfld="#ergo"></div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <label>DESIGN</label>-->
<!--                    <input type="hidden" id="design">-->
<!--                    <div data-productid="312" class="rateit" data-rateit-resetable="false" data-rateit-max="5" data-rateit-backingfld="#design"></div>-->
<!--                </li>-->
<!--                    <label>FONCTIONNEMENT</label>-->
<!--                    <input type="hidden" id="fonctionnement">-->
<!--                    <div data-productid="312" class="rateit" data-rateit-resetable="false" data-rateit-max="5" data-rateit-backingfld="#fonctionnement"></div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <label>SATISFACTION</label>-->
<!--                    <input type="hidden" id="satisfaction">-->
<!--                    <div data-productid="312" class="rateit" data-rateit-resetable="false" data-rateit-max="5" data-rateit-backingfld="#satisfaction"></div>-->
<!--                </li>-->
            </ul>
            <textarea id="commentaire-accessoire" class="commentPost"></textarea>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
    <div id="accessoire-notation-error" class="alert alert-error hide"></div>
    <div id="accessoire-notation-success" class="success alert-success hide"></div>
</div>
<?php endif; ?>