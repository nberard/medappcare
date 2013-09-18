<!doctype html>
<html lang="fr-fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>Medappcare - Page non-trouvée</title>

	<meta name="description" content="">
	<meta name="author" content="Medappcare">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
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
    
    <?php if(!empty($meta)): ?>
        <meta property="og:title" content="<?php echo $meta['og:title']; ?>" />
        <meta property="og:description" content="<?php echo $meta['og:description']; ?>" />
        <meta property="og:image" content="<?php echo $meta['og:image']; ?>" />
        <meta property="og:url" content="<?php echo $meta['og:url']; ?>" />
        <link rel="image_src" href="<?php echo $meta['image_src']; ?>" />
    <?php endif; ?>

</head>

<body>

<nav>
    <ul>
        <li class="home">
            <a href="<?php echo site_url("$access_label/index"); ?>">Home</a>
        </li>
        <?php foreach($categories_principales as $categorie_principale): ?>
            <li class="nav<?php echo $categorie_principale->class; ?> megamenu">
                <a dropdowndestination="<?php echo $categorie_principale->class; ?>" href="#">
                    <!--<span class="picto"></span>
                    <span class="text">--><?php echo $categorie_principale->nom; ?><!--</span>-->
                </a>
            </li>
        <?php endforeach; ?>
        <li class="bt-search">
            <a id="link-search" href="#">Rechercher</a>
        </li>
        
        <form action="<?php echo site_url($access_label.'/app_search_1') ; ?>" method="post" id="search-form" class="search-form">
			<input type="text" id="search-query" placeholder="Trouvez l'app qui vous plaît...">
		</form>
    </ul>
</nav>

<div id="dropdown">
    <div class="whiteLine"></div>
    <?php foreach($categories_principales as $categorie_principale): ?>
    <nav class= "<?php echo $categorie_principale->class; ?>">
        <div class="wrapper">
            <?php $cpt = 0; ?>
            <?php foreach($categorie_principale->enfants as $categorie_enfant): ?>
                <?php if($cpt%10 == 0)
                {
                    if($cpt != 0)
                    {
                        echo '</ul>';
                    }
                    echo '<ul>';
                }
                $cpt++;
                ?>
                <li><a href="<?php echo $categorie_enfant->link; ?>"><?php echo $categorie_enfant->nom;?></a></li>
            <?php endforeach; ?>
            </ul>
            <?php if(!empty($categorie_principale->push)): ?>
            <div class="sponsored-selection">
                <span class="title">Nos sélections</span>
                <ul>
<!--                    <li><a href=""><img src="--><?php //echo img_url('tmp/app-icon-57.png'); ?><!--" alt="[app-title] icon" />Ma super app</a></li>-->
                    <?php foreach($categorie_principale->push as $appli_push): ?>
                        <li><a href="<?php echo $appli_push->link; ?>"><img width="57px" height="57px" src="<?php echo $appli_push->logo_url; ?>" alt="<?php echo $appli_push->nom; ?> icon" /><?php echo $appli_push->nom; ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <span class="sponsored-indicator">Sponsorisées</span>
            </div>
            <?php endif; ?>
            <div class="bigpicto"></div>
            <a href="#" class="closeLink">Fermer le menu</a>
        </div> <!-- end wrapper -->
    </nav> <!-- end masante -->
    <?php endforeach; ?>
</div>

<div class="wrapper">

    <h2>404 - Page vide</h2>

</div>

</body>
</html>