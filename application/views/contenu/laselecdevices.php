<div id="dropdown" class="loading"></div><!-- #dropdown Menu -->

<div class="title">
    <div class="wrapper">
        <h2>Sélection <?php echo $selection->nom; ?></h2> <!-- INSÉRER LE NOM DONNÉ À LA SÉLECTION -->
    </div>
</div>

<div class="selectHeader">
    <div class="wrapper">
        <span class="image"></span><!-- INSÉRER L'IMAGE QUI VA BIEN -->
        <p class="intro">
Nulla vitae elit libero, a pharetra augue. Maecenas faucibus mollis interdum. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Curabitur blandit tempus porttitor. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
        </p>
    </div>                                
</div>

<div class="colorsLine"></div>

<section id="listApps">

    <div class="wrapper">

        <?php echo $widget_allappselection; ?> <!-- Toutes les apps de la catégorie -->

    </div>

</section>

<section id="devices"><?php echo $widget_devices; ?></section> <!-- Section Devices connectés -->

<section id="pushFooter"><?php echo $home_pushpartners; ?></section> <!-- Section Push Information -->

<section id="partners"><?php echo $partners; ?></section> <!-- Section Partenaires -->