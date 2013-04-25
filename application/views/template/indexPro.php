<!doctype html>
<html lang="en"> <!-- A CHANGER EN FONCTION DE LA LANGUE -->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>MEDAPPCARE</title>

	<meta name="description" content="">
	<meta name="author" content="Medappcare">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" type="text/css" media="all" href="css/stylesheet.css" />
	
	
</head>

<body class="homepage lespros">

    <header id="header">
    
        <?php include ('inc/header.php') ; ?>
        
        <?php include ('inc/menuMedecin.php') ; ?> <!-- Menu Particulier -->
        
    </header>
    
    <div id="dropdown" class="loading"></div><!-- #dropdown Menu -->

    <section id="slider"><?php include ('inc/home_slider.php') ; ?></section> <!-- Section Slider -->
    
    <section id="selections"><?php include ('inc/widget_selection.php') ; ?></section> <!-- Section La Sélection Medappcare -->

    <div class="colorsLine"></div>

    <section id="listApps">
    
        <div class="wrapper">
        
        <h2>Nos Dernières Évaluations</h2>
        
        <?php include ('inc/pro_pourlespros.php') ; ?> <!-- Section Les dernières apps évaluées pour les prosfessionnels-->
        
        <?php include ('inc/pro_pourlesgens.php') ; ?> <!-- Section Les dernières apps évaluées pour les gens -->
        
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