<div id="dropdown" class="loading"></div><!-- #dropdown Menu -->

<div class="title">
    <div class="wrapper">
        <h2><?php echo $application->titre; ?><span> par</span> <a href="<?php echo $application->lien_contact ? $application->lien_contact : '#'; ?>" title="<?php echo $application->nom_editeur; ?>"><?php echo $application->nom_editeur; ?></a></h2>
    </div>
</div>

<section id="metapp" class="cat<?php echo $application->class; ?>">
    <div class="wrapper">

        <div class="icone"><img width="90px" height="90px" src="<?php echo $application->logo_url; ?>"></div>

        <div class="content right">
            <div class="appnote noteMedappcare"><span></span><a href="#thegrid" class="note deux">Deux</a></div>
            <?php if($application->moyenne_note_pro): ?><div class="appnote notePro"><span></span><a href="#thegrid" class="note <?php echo $application->class_note_pro; ?>"><?php echo ucfirst($application->class_note_pro); ?></a></div><?php endif; ?>
            <?php if($application->moyenne_note_user): ?><div class="appnote noteGens"><span></span><a href="#thegrid" class="note <?php echo $application->class_note_user; ?>"><?php echo ucfirst($application->class_note_user); ?></a></div><?php endif; ?>
        </div>

    </div>
</section>

<section id="appSectionOne" class="cat<?php echo $application->class; ?>">
    <div class="wrapper">
        <div class="sidebar left">
            <div class="os">
                <div class="list">
                    <span class="<?php echo $application->device_class; ?>"><?php echo $application->device_nom; ?></span>
                    <span class="price"><?php echo $application->prix_complet; ?></span>
                </div>
            </div>
            <?php if($application->est_ce): ?>
            <div class="labels">
            	<span class="label ce">CE</span>
            	<span class="text">Cet objet est un dispositif médical</span>
            </div>
            <?php endif; ?>
            <div class="buttons">
                <a href="#commentModal" class="noter">Noter l'Application</a>
                <a href="#signalerModal" class="signaler">Signaler</a>
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
                <p>Flashez le code ci-dessus pour télécharger l’app.</p>
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
                <ul>
	    		<?php foreach($application->screenshots as $screenshot): ?>
                    <li><img src="<?php echo $screenshot->url; ?>"/></li>
                    <li><img src="<?php echo $screenshot->url; ?>"/></li>
                <?php endforeach; ?>
                </ul>
	    	</div>
	    	
	    	<div class="tabContent" id="motDelEditeur">
	    		<div class="logoPart">
		    		
		    		<img src="<?php echo img_url('tmp/logo-withings.png'); ?>" alt="[nom-de-l-editeur]"/>
		    		
	    		</div>
	    		<p><?php // echo $device->{"description_".config_item('lng')}; ?></p>
	    	</div>
	    	
	    	<div class="tabContent" id="commentaires"> <!-- Liste des commentaires déjà publiés -->
	    	    <ul class="commentsList">
	    	        <li class="commentSingle">
    	    	        <span class="name">Toto</span>
    	    	        <span class="note">La note</span>
    	    	        <p class="comment">Etiam porta sem malesuada magna mollis euismod. Maecenas faucibus mollis interdum.</p>
	    	        </li>
	    	        <li class="commentSingle">
    	    	        <span class="name">Jean-Pierre</span>
    	    	        <span class="note">La note</span>
    	    	        <p class="comment">Etiam porta sem malesuada magna mollis euismod. Maecenas faucibus mollis interdum.</p>
	    	        </li>
	    	    </ul>
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

<div class="modal hide fade" id="signalerModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"></button>
    <h3>Signalez cette application</h3>
  </div>
  <div class="modal-body">
    <p class="explication">Nullam quis risus eget urna mollis ornare vel eu leo. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
    <form method="post" data-action="<?php echo site_url('rest/signaler') ?>" name="email_form" id="email_form">
      <p><input name="email" id="email" type="email" required placeholder="Email"></p>
      <p>
          <select name="typeSignaler" id="typeSignaler">
	            	<optgroup label="Prix" id="prix">
	                    <option value="true">Gratuit</option>
	                    <option value="false">Payant</option>
	                </optgroup>
	                <optgroup label="Plateforme" id="devices">
                            <option value="">Test</option>
	                </optgroup>
          </select>
      </p>
      <p><textarea id="textSignaler"></textarea></p>
      <p><button type="submit" class="btn btn-primary">Envoyer</button>
      </p>
    </form>
  </div>
    <div id="login-error" class="alert alert-error hide"></div>
</div>

<div class="modal hide fade" id="commentModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"></button>
    <h3>Noter cette application</h3>
  </div>
  <div class="modal-body">
    <p class="explication">Nullam quis risus eget urna mollis ornare vel eu leo. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
    <form method="post" data-action="<?php echo site_url('rest/signaler') ?>" name="email_form" id="email_form">
      <p><input name="email" id="email" type="email" required placeholder="Email"></p>
      <p>Sélectionnez la note</p>
      <p><textarea id="textSignaler"></textarea></p>
      <p><button type="submit" class="btn btn-primary">Envoyer</button>
      </p>
    </form>
  </div>
    <div id="login-error" class="alert alert-error hide"></div>
</div>