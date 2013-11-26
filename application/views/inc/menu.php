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
			<input type="text" id="search-query" placeholder="Trouvez l'app qui vous convient...">
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
                <?php if($cpt%14 == 0)
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

 