<?php include ('inc/header_meta.php') ; ?>

<body class="homepage particuliers">

    <header id="header" class="test">
    
        <?php include ('inc/header.php') ; ?>
        
        <?php include ('inc/menuParticulier.php') ; ?> <!-- Menu Particulier -->
        
    </header>

    <section id="slider"><?php include ('inc/home_slider.php') ; ?></section> <!-- Section Slider -->
    
    <section id="selections"><?php include ('inc/widget_selection.php') ; ?></section> <!-- Section La Sélection Medappcare -->

    <div class="colorsLine"></div>

    <section id="listApps">
    
        <div class="wrapper">
        
        <?php include ('inc/home_lasteval.php') ; ?> <!-- Section Les dernières apps évaluées -->
        
        <?php include ('inc/home_topfive.php') ; ?> <!-- Section Le Top 5 -->
        
        </div>
    
    </section>
    
    <section id="devices"><?php include ('inc/widget_devices.php') ; ?></section> <!-- Section Devices connectés -->
    
    <section id="news"><?php include ('inc/widget_news.php') ; ?></section> <!-- Section Actualité -->
    
    <section id="pushFooter"><?php include ('inc/home_pushpartners.php') ; ?></section> <!-- Section Push Information -->
    
    <section id="partners"><?php include ('inc/partners.php') ; ?></section> <!-- Section Partenaires -->

    <?php include ('inc/footer.php') ; ?>

    <?php include ('inc/footer_meta.php') ; ?> <!-- Appels JS & Autres -->
    
</body>
</html>