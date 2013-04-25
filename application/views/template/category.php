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

<body class="category particuliers masante">

    <header id="header">
    
        <?php include ('inc/header.php') ; ?>
        
        <?php include ('inc/menuParticulier.php') ; ?> <!-- Menu Particulier -->
        
    </header>
    
    <div id="dropdown" class="loading"></div><!-- #dropdown Menu -->
    
    <div class="title">
        <div class="wrapper">
            <h2>Titre de la Catégorie</h2> <!-- INSÉRER LE TITRE DE LA CATÉGORIE ICI -->
        </div>
    </div>
    
    <section id="selections"><?php include ('inc/widget_selection.php') ; ?></section> <!-- Section La Sélection Medappcare -->

    <div class="colorsLine"></div>

    <section id="listApps">
    
        <div class="wrapper">
        
        <?php include ('inc/widget_lasteval.php') ; ?> <!-- Section Les dernières apps évaluées -->
        
        <?php include ('inc/widget_topfive.php') ; ?> <!-- Section Le Top 5 -->
        
        <?php include ('inc/widget_allappcategory.php') ; ?> <!-- Toutes les apps de la catégorie -->
        
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