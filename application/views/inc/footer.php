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
                <li><a href="contact.html">Contact</a></li>
                <li><a href="mentionslegales.html">Mentions Légales</a></li>
                <li><a href="#">...</a></li>
            </ul>
        </nav>
    </div>
    <div class="right">
        <nav class="secondary grandPublic">
            <h5>Grand Public</h5>
            <ul>
                <h6>Ma Santé</h6>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">...</a></li>
            </ul>
            <ul>
                <h6>Mon Quotidien</h6>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">...</a></li>
            </ul>
            <ul>
                <h6>M'informer</h6>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">...</a></li>
            </ul>
            <ul>
                <h6>Me Déplacer</h6>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">...</a></li>
            </ul>
        </nav>
        <nav class="secondary professionnal">
            <h5>Professionnels de Santé</h5>
            <ul>
                <h6>Ma Santé</h6>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">...</a></li>
            </ul>
            <ul>
                <h6>Mon Quotidien</h6>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">...</a></li>
            </ul>
            <ul>
                <h6>M'informer</h6>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">...</a></li>
            </ul>
            <ul>
                <h6>Me Déplacer</h6>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">Addictions</a></li>
                <li><a href="#">...</a></li>
            </ul>
        </nav>
    </div> <!-- end right -->
    <div class="clear"></div>
</div>

</footer>

<p class="copyright">© Medappcare 2013 - Tous droits réservés</p>