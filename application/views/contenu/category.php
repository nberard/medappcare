<div id="dropdown" class="loading"></div><!-- #dropdown Menu -->

<div class="title">
    <div class="wrapper">
        <h2><?php echo $categorie->nom; ?></h2> <!-- INSÉRER LE TITRE DE LA CATÉGORIE ICI -->
    </div>
</div>

<?php if(!empty($widget_selection)): ?>
    <section id="selections"><?php echo $widget_selection ; ?></section> <!-- Section La Sélection Medappcare -->
<?php endif; ?>

<div class="colorsLine"></div>

<section id="listApps">

    <div class="wrapper">

        <?php echo $widget_lasteval; ?> <!-- Section Les dernières apps évaluées -->

        <?php echo $widget_topfive; ?> <!-- Section Le Top 5 -->

        <?php echo $widget_allappcategory; ?> <!-- Toutes les apps de la catégorie -->

    </div>

</section>

<section id="devices"><?php echo $widget_devices; ?></section> <!-- Section Devices connectés -->

<section id="pushFooter"><?php echo $home_pushpartners; ?></section> <!-- Section Push Information -->

<section id="partners"><?php echo $partners; ?></section> <!-- Section Partenaires -->