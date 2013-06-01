<section id="slider"><?php echo $home_slider ; ?></section> <!-- Section Slider -->

<?php if(!empty($widget_selection)): ?>
    <section id="selections"><?php echo $widget_selection ; ?></section> <!-- Section La Sélection Medappcare -->
<?php endif; ?>

<div class="colorsLine"></div>

<section id="listApps">

    <div class="wrapper">
        <h2>Nos Dernières Évaluations</h2>
        <?php echo $pro_pourlespros ; ?> <!-- Section Les dernières apps évaluées -->

        <?php echo $pro_pourlesgens ; ?> <!-- Section Le Top 5 -->

    </div>

</section>

<section id="devices"><?php echo $widget_devices ; ?></section> <!-- Section Devices connectés -->

<section id="news"><?php echo $widget_news ; ?></section> <!-- Section Actualité -->

<section id="pushFooter"><?php echo $home_pushpartners ; ?></section> <!-- Section Push Information -->

<section id="partners"><?php echo $partners ; ?></section> <!-- Section Partenaires -->