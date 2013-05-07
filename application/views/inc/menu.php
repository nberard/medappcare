<nav>
    <ul>
        <li class="home">
            <a href="<?php echo index_page(); ?>">Home</a>
        </li>
        <?php foreach($categories_principales as $categorie_principale): ?>
            <li class="nav<?php echo $categorie_principale->class; ?> megamenu">
                <a dropdowndestination="<?php echo $categorie_principale->class; ?>" href="<?php echo $categorie_principale->link; ?>">
                    <span class="picto"></span>
                    <span class="text"><?php echo $categorie_principale->{"nom_".config_item('language_short')}; ?></span>
                </a>
            </li>
        <?php endforeach; ?>
        <li class="search">
            <a href="#">Rechercher</a>
        </li>
        
        <form action="search.php" method="post" class="search-form">
			<input type="text" id="search-query" placeholder="Trouvez l'appli qui vous plaît...">
		</form>
    </ul>
</nav>

<div id = "dropdown">
    <div class="whiteLine"></div>
    <?php foreach($categories_enfants_assoc as $class => $categories_enfants): ?>
    <nav class = "<?php echo $class; ?>">
        <div class="wrapper">
            <?php $cpt = 0; ?>
            <?php foreach($categories_enfants as $categorie_enfant): ?>
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
                <li><a href="#"><?php echo $categorie_enfant->{"nom_".config_item('language_short')};?></a></li>
            <?php endforeach; ?>
            </ul>
            <div class="sponsored-selection">
                <span class="title">Nos sélections</span>
                <ul>
                    <li><a href=""><img src="<?php echo img_url('tmp/app-icon-57.png'); ?>" alt="[app-title] icon"/>Ma super app</a></li>
                    <li><a href=""><img src="<?php echo img_url('tmp/app-icon-57.png'); ?>" alt="[app-title] icon"/>Ma super app</a></li>
                    <li><a href=""><img src="<?php echo img_url('tmp/app-icon-57.png'); ?>" alt="[app-title] icon"/>Ma super app</a></li>
                </ul>
                <span class="sponsored-indicator">Sponsorisées</span>
            </div>
            <div class="bigpicto"></div>
        </div> <!-- end wrapper -->
    </nav> <!-- end masante -->
    <?php endforeach; ?>
</div>