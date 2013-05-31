<div class="colorsLine"></div>

<footer id="footer">

<div class="wrapper">
	<span class="languages">
        <?php foreach($languages as $languageShort => $languagesVars):
            $current = config_item('language') == $languagesVars['long'];
        ?>
        <a href="<?php echo $current ? '#' : $languagesVars['redirect'] ?> " <?php echo $current ? 'class="selected"' : '' ?> >
            <?php echo $languagesVars['wording'] ?>
        </a> &nbsp;&nbsp;&nbsp;
    <?php endforeach; ?>
    </span>
    <span class="footer_medappcare"></span>
    <div class="left">
        <nav class="principale">
            <ul>
                <li><a href="#">La Démarche Qualité Medappcare</a></li>
                <li><a href="#">Développeurs, soumettez votre application</a></li>
                <li><a href="#">Accès professionnels de santé</a></li>
                <li><a href="#">Espace Annonceurs</a></li>
                <li><a href="#">Medappcare dans la presse</a></li>
                <li><a href="#">Qui sommes-nous ?</a></li>
                <li><a href="#">Nos partenaires</a></li>  
                <li><a href="#">Consulting Medappcare</a></li>  
                <li><a href="#">Actualités sur Medappcare</a></li>                                                                
                <li><a href="<?php echo site_url($access_label.'/page/cgu'); ?>">CGU</a></li>
                <li><a href="<?php echo site_url($access_label.'/mentionslegales'); ?>">Mentions Légales</a></li>
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
    <button id="bt-search">Rechercher</button>
    <ul class="dl-menu dl-menu-toggle">
        <li class="navMobileItem masante">
            <a dropdowndestination="masante" href="#">Ma Santé</a>
            <ul class="dl-submenu">
                <li class="navMobileItem"><a dropdowndestination="addictions" href="#">Addictions</a></li>
                <li class="navMobileItem"><a dropdowndestination="allergies" href="#">Allergies</a></li>
            </ul>
        </li>
        <li class="navMobileItem monquotidien">
            <a dropdowndestination="monquotidien" href="#">Mon Quotidien</a>
            <ul class="dl-submenu">
                <li class="navMobileItem"><a dropdowndestination="item" href="#">Item 1</a></li>
                <li class="navMobileItem"><a dropdowndestination="item" href="#">Item 2</a></li>
            </ul>
        </li>
        <li class="navMobileItem minformer">
            <a dropdowndestination="minformer" href="#">M'Informer</a>
            <ul class="dl-submenu">
                <li class="navMobileItem"><a dropdowndestination="item" href="#">Item 1</a></li>
                <li class="navMobileItem"><a dropdowndestination="item" href="#">Item 2</a></li>
            </ul>
        </li>
        <li class="navMobileItem medeplacer">
            <a dropdowndestination="medeplacer" href="#">Me Déplacer</a>
            <ul class="dl-submenu">
                <li class="navMobileItem"><a dropdowndestination="item" href="#">Item 1</a></li>
                <li class="navMobileItem"><a dropdowndestination="item" href="#">Item 2</a></li>
            </ul>
        </li>
    </ul>
</div> <!-- end mobile menu -->

<script>

/mobi/i.test(navigator.userAgent) && !location.hash && setTimeout(function () {
  if (!pageYOffset) window.scrollTo(0, 1);
}, 1000);


</script>





