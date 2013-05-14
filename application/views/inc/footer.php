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
                <li><a href="#">La Charte Medappcare</a></li>
                <li><a href="#">Développeurs, soumettez votre application</a></li>
                <li><a href="#">Médecins, évaluez nos applications</a></li>
                <li><a href="#">Espace Annonceurs</a></li>
                <li><a href="#">Medappcare dans la presse</a></li>
                <li><a href="<?php echo site_url($access_label.'/contact'); ?>">Contact</a></li>
                <li><a href="<?php echo site_url($access_label.'/mentionslegales'); ?>">Mentions Légales</a></li>
                <li><a href="#">...</a></li>
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

<p class="copyright">© Medappcare 2013 - Tous droits réservés</p>