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

    <?php
    foreach($css_files as $file): ?>
        <link type="text/css" rel="stylesheet" media="all" href="<?php echo $file; ?>" />
    <?php endforeach; ?>

</head>

<body class="homepage particuliers">

    <header id="header">
    
        <?php echo $header; ?>
        
        <?php include ('inc/menuParticulier.php') ; ?> <!-- Menu Particulier -->
        
    </header>

    <?php echo $contenu; ?>
    
    <section id="partners"><?php include ('inc/partners.php') ; ?></section> <!-- Section Partenaires -->

    <footer><?php include ('inc/footer.php') ; ?></footer>

<?php echo $footer_meta; ?> <!-- Appels JS & Autres -->
</body>
</html>