<div class="colorsLine"></div>

<footer id="footer">

<div class="wrapper">
<!--
	<span class="languages">
        <?php foreach($languages as $languageShort => $languagesVars):
            $current = config_item('language') == $languagesVars['long'];
        ?>
        <a href="<?php echo $current ? '#' : $languagesVars['redirect'] ?> " <?php echo $current ? 'class="selected"' : '' ?> >
            <?php echo $languagesVars['wording'] ?>
        </a> &nbsp;&nbsp;&nbsp;
    <?php endforeach; ?>
    </span>
-->
    
    <span class="languages">
        <a href="#" class="selected">Français</a> &nbsp;&nbsp;&nbsp;
        <a href="#" class="btsoon">English<span class="soon">Soon available</span></a>
    </span>
    
    
    <span class="footer_medappcare"></span>
    <div class="left">
        <nav class="principale">
            <ul>
                <li><a href="<?php echo site_url($access_label.'/page/quality'); ?>">La Démarche Qualité Medappcare</a></li>
                <li><a href="<?php echo site_url($access_label.'/page/developers'); ?>">Développeurs, soumettez votre application</a></li>
                <li><a href="<?php echo site_url($access_label.'/page/annonceurs'); ?>">Espace Annonceurs</a></li>
                <li><a href="<?php echo site_url($access_label.'/page/press'); ?>">Medappcare dans la presse</a></li>
                <li><a href="<?php echo site_url($access_label.'/page/aboutus'); ?>">Qui sommes-nous ?</a></li>
                <li><a href="<?php echo site_url($access_label.'/page/partners'); ?>">Nos partenaires</a></li>
                <li><a href="#">Consulting Medappcare</a></li>  
                <li><a href="<?php echo site_url($access_label.'/list_news_1'); ?>">Actualités sur Medappcare</a></li>                                                                
                <li><a href="<?php echo site_url($access_label.'/page/cgu'); ?>">CGU</a></li>
                <li><a href="<?php echo site_url($access_label.'/page/mentionslegales'); ?>">Mentions Légales</a></li>
                <li><a href="<?php echo site_url($access_label.'/contact'); ?>">Contact</a></li>
            </ul>
        </nav>
    </div>
    <div class="right">
        <nav class="secondary grandPublic">
            <h5>Grand Public</h5>
            <?php foreach($categories_principales_perso as $categorie_principale_perso): ?>
                <ul>
                    <h6><?php echo $categorie_principale_perso->nom; ?></h6>
                    <?php foreach($categorie_principale_perso->enfants as $categorie_enfants_perso): ?>
                        <li><a href="<?php echo $categorie_enfants_perso->link; ?>"><?php echo $categorie_enfants_perso->nom; ?> </a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        </nav>
        <nav class="secondary professionnal">
            <h5>Professionnels de Santé</h5>
            <?php foreach($categories_principales_pro as $categorie_principale_pro): ?>
            <ul>
                <h6><?php echo $categorie_principale_pro->nom; ?></h6>
                <?php foreach($categorie_principale_pro->enfants as $categorie_enfants_pro): ?>
                    <li><a href="<?php echo $categorie_enfants_pro->link; ?>"><?php echo $categorie_enfants_pro->nom; ?> </a></li>
                <?php endforeach; ?>
            </ul>
            <?php endforeach; ?>
        </nav>
    </div> <!-- end right -->
    <div class="clear"></div>
</div>

</footer>

<p class="copyright">&copy; Medappcare 2013 - Tous droits réservés</p>

<div id="dl-menu" class="dl-menuwrapper">
    <button class="dl-trigger">Open Menu</button>
    <button id="bt-login"><span></span></button>
    <ul class="dl-menu dl-menu-toggle">
    	
            
            <?php if(!$user): ?>
                <li class="navMobileItem"><a data-toggle="modal" href="<?php echo $pro ? '#connexionModalPro' : '#connexionModal'?>" class="connexion">Connexion</a>
            <?php endif; ?>
	        
	        <?php if (!$pro && !$user): ?>
                <li class="navMobileItem"><a data-toggle="modal" href="#connexionModalPro" class="pro">Espace Pro</a></li>
            <?php endif; ?>
	        
        <?php foreach($categories_principales as $categorie_principale): ?>
            <li class="navMobileItem <?php echo $categorie_principale->class; ?>">
                <a dropdowndestination="<?php echo $categorie_principale->class;?>" href="#"><?php echo $categorie_principale->nom;?></a>
                <ul class="dl-submenu">
                <?php foreach($categorie_principale->enfants as $categorie_enfant): ?>
                    <li class="navMobileItem"><a dropdowndestination="<?php echo $categorie_principale->class;?>" href="<?php echo $categorie_enfant->link; ?>"><?php echo $categorie_enfant->nom;?></a></li>
                <?php endforeach; ?>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="bigpicto"></div>
    <a href="#" class="closeLink">Fermer le menu</a>
</div> <!-- end mobile menu -->

<script>

/mobi/i.test(navigator.userAgent) && !location.hash && setTimeout(function () {
  if (!pageYOffset) window.scrollTo(0, 1);
}, 1000);


</script>





