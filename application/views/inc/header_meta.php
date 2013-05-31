<!doctype html>
<html lang="fr-fr"> <!-- A CHANGER EN FONCTION DE LA LANGUE -->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>MEDAPPCARE</title>

	<meta name="description" content="">
	<meta name="author" content="Medappcare">
	
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <?php foreach($css_files as $css_file): ?>
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo $css_file; ?>" />
    <?php endforeach; ?>
	
	<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <link rel="shortcut icon" href="<?php echo img_url('favicon/favicon.ico'); ?>">
    <link rel="icon" type="image/png" href="<?php echo img_url('favicon/favicon.png'); ?>" />
    <link rel="apple-touch-icon" href="<?php echo img_url('favicon/apple-touch-icon.png'); ?>"/>
    <link rel="apple-touch-icon-precomposed" href="<?php echo img_url('favicon/apple-touch-icon-precomposed.png'); ?>" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo img_url('favicon/apple-touch-icon-72x72-precomposed.png'); ?>" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo img_url('favicon/apple-touch-icon-114x114-precomposed.png'); ?>" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo img_url('favicon/apple-touch-icon-144x144-precomposed.png'); ?>">
    
    <!-- POUR FACEBOOK -->
    
    <!-- Ajouter une condition -->
    
    <!-- SI PAGE APP -->
    <meta property="og:title" content="Medappcare - NOM DE L'APPLICATION" /> <!-- AJOUTER ICI LE NOM DE L'APPLICATION -->
	<meta property="og:description" content="DESCRIPTION" /> <!-- AJOUTER ICI LA DESCRIPTION -->
	<meta property="og:image" content="http://www.onemorethingstudio.com/unisize-app/wp-content/themes/unisize/img/apple-touch-icon-72x72-precomposed.png" /> <!-- AJOUTER ICI L'ADRESSE DE L'IMAGE DE L'ICON DE L'APPLICATION -->
	<meta property="og:url" content="http://www.medappcare.com" /> <!-- AJOUTER ICI LE LIEN DIRECT VERS LA PAGE -->
	<link rel="image_src" href="http://www.onemorethingstudio.com/unisize-app/wp-content/themes/unisize/img/apple-touch-icon-72x72-precomposed.png" /> <!-- AJOUTER ICI L'ADRESSE DE L'IMAGE DE L'ICON DE L'APPLICATION -->
	
	<!-- SI AUTRE PAGE -->
    <meta property="og:title" content="Medappcare" />
	<meta property="og:description" content="DESCRIPTION" /> <!-- AJOUTER ICI LA DESCRIPTION DU SITE-->
	<meta property="og:image" content="http://www.onemorethingstudio.com/unisize-app/wp-content/themes/unisize/img/apple-touch-icon-72x72-precomposed.png" /> <!-- AJOUTER ICI L'ADRESSE DE L'IMAGE DU LOGO MEDAPPCARE -->
	<meta property="og:url" content="http://www.medappcare.com" /> <!-- AJOUTER ICI LE LIEN DIRECT VERS LA PAGE -->
	<link rel="image_src" href="http://www.onemorethingstudio.com/unisize-app/wp-content/themes/unisize/img/apple-touch-icon-72x72-precomposed.png" /> <!-- AJOUTER ICI L'ADRESSE DE L'IMAGE DU LOGO MEDAPPCARE -->

    
    
</head>