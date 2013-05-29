<!doctype html>
<html lang="fr-fr"> <!-- A CHANGER EN FONCTION DE LA LANGUE -->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>MEDAPPCARE</title>

	<meta name="description" content="">
	<meta name="author" content="Medappcare">
	
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
	
</head>