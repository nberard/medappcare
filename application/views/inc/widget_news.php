<div class="wrapper">
    <h2>Actualité</h2>
    <ul>
        <?php foreach($articles as $article):?>
        <li>
            <a href="<?php echo $article->link; ?>" class="icone"><img width="80px" height="80px" src="<?php echo $article->picto_url; ?>"/></a> <!-- INSÉRER L'ICON DU NEWS -->
            <h4><a href="<?php echo $article->link; ?>"><?php echo $article->titre; ?></a></h4> <!-- INSÉRER LE LIEN ET LE TITRE DU NEWS -->
            <p class="excerpt"><?php echo $article->contenu_short; ?></p>
            <span class="date"><?php echo $article->date_full; ?></span>
            <?php if($article->nom_categorie): ?>
                <p class="category"><?php echo lang('dans');?> <a href="<?php echo $article->categorie_link; ?>"><?php echo $article->nom_categorie; ?></a></p> <!-- INSÉRER LE LIEN VERS LE NEWS -->
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <div class="clear"></div>
    <div class="metaFooter"><a href="news-list.php">voir tout ></a></div>
</div>