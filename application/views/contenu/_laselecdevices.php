<div id="dropdown" class="loading"></div><!-- #dropdown Menu -->

<div class="title">
    <div class="wrapper">
        <h2>1Sélection <?php echo $selection->nom; ?></h2> <!-- INSÉRER LE NOM DONNÉ À LA SÉLECTION -->
    </div>
</div>

<div class="selectHeader">
    <div class="wrapper">
        <span class="image"><img width="950px" height="300px" src="<?php echo base_url().config_item('upload_paths')['selection'].$selection->image; ?>"/></span><!-- INSÉRER L'IMAGE QUI VA BIEN -->
        <p class="intro">
            <?php echo $selection->description; ?>
        </p>
    </div>
</div>

<div class="colorsLine"></div>

<section id="listDevices">

    <div class="wrapper">

        <?php echo $widget_alldeviceselection; ?> <!-- Toutes les apps de la catégorie -->

    </div>

</section>

<section id="devices"><?php echo $widget_devices; ?></section> <!-- Section Devices connectés -->

<section id="pushFooter"><?php echo $home_pushpartners; ?></section> <!-- Section Push Information -->

<section id="partners"><?php echo $partners; ?></section> <!-- Section Partenaires -->