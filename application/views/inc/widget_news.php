<div class="wrapper">
    <h2>Actualité</h2>
    <ul>
        <?php foreach($articles as $article):?>
        <li>
            <a href="<?php echo $article->link; ?>" class="icone"><img width="80px" height="80px" src="<?php echo $article->picto_url; ?>"/></a> <!-- INSÉRER L'ICON DU NEWS -->
            <h4><a href="<?php echo $article->link; ?>"><?php echo $article->{'titre_'.config_item('lng')}; ?></a></h4> <!-- INSÉRER LE LIEN ET LE TITRE DU NEWS -->
            <span class="date"><?php echo $article->date_full; ?></span>
            <?php if($article->nom_categorie): ?>
                <p class="category"><?php echo lang('dans');?> <a href="<?php echo $article->categorie_link; ?>"><?php echo $article->nom_categorie; ?></a></p> <!-- INSÉRER LE LIEN VERS LE NEWS -->
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
        <li>
            <a href="news.php" class="icone"></a> <!-- INSÉRER L'ICON DU NEWS -->
            <h4><a href="news.php">Titre de la news</a></h4> <!-- INSÉRER LE LIEN ET LE TITRE DU NEWS -->
            <span class="date">le 23 mai 2013</span>
            <p class="category">dans <a href="news-category.php">Addictions</a></p> <!-- INSÉRER LE LIEN VERS LE NEWS -->
        </li>
    </ul>
    <div class="clear"></div>
    <div class="metaFooter"><a href="news-list.php">voir tout ></a></div>
</div>