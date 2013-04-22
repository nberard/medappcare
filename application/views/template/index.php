<!doctype html>
<html lang="en"> <!-- A CHANGER EN FONCTION DE LA LANGUE -->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>MEDAPPCARE</title>

	<meta name="description" content="">
	<meta name="author" content="">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" type="text/css" media="all" href="css/stylesheet.css" />
	
	
</head>

<body>

    <header id="header">
    
        <?php include ('inc/header.php') ; ?>
        
        <?php include ('inc/menuParticulier.php') ; ?> <!-- Menu Particulier -->
        
    </header>

    <section id="slider"><?php include ('inc/slider.php') ; ?></section> <!-- Section Slider -->
    
    <section id="selections"></section> <!-- Section La Sélection Medappcare -->

    <section id="lastEval"></section> <!-- Section Les dernières apps évaluées -->
    
    <section id="topFive"></section> <!-- Section Le Top 5 -->
    
    <section id="news"></section> <!-- Section Actualité -->
    
    <section id="devices"></section> <!-- Section Devices connectés -->
    
    <section id="pushFooter"></section> <!-- Section Push Information -->
    
    <section id="partners"></section> <!-- Section Partenaires -->

    <footer>
    
        <?php include ('inc/footer.php') ; ?>
    
    </footer>

</body>
</html>