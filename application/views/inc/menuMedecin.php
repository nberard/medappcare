<nav>
    <ul>
        <li class="home">
            <a href="index.html">Home</a>
        </li>
        <?php foreach($categories_principales as $categorie_principale): ?>
            <li class="<?php echo $categorie_principale->class; ?>">
                <a href="<?php echo $categorie_principale->link; ?>"><span class="picto"></span><span class="text"><?php echo $categorie_principale->{"nom_".config_item('language_short')}; ?><span></a>
            </li>
        <?php endforeach; ?>
<!--        <li class="navadministratif megamenu">-->
<!--            <a href="navadministratif.php"><span class="picto"></span><span class="text">Administratif<span></a>-->
<!--        </li>-->
<!--        <li class="navmapratique megamenu">-->
<!--            <a href="navmapratique.php"><span class="picto"></span><span class="text">Ma Pratique</span></a>-->
<!--        </li>-->
<!--        <li class="navminformer megamenu">-->
<!--            <a href="navprominformer.php"><span class="picto"></span><span class="text">M'Informer</span></a>-->
<!--        </li>-->
<!--        <li class="navmespatients megamenu">-->
<!--            <a href="navmespatients.php"><span class="picto"></span><span class="text">Mes Patients</span></a>-->
<!--        </li>-->
        <li class="search">
            <a href="#">Rechercher</a>
        </li>
        
        <form action="search.php" method="post" class="search-form">
			<input type="text" id="search-query" placeholder="Trouvez l'appli qui vous plaît...">
		</form>
    </ul>
</nav>