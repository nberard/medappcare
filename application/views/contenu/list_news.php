<div id="dropdown" class="loading"></div><!-- #dropdown Menu -->

<div class="title">
    <div class="wrapper">
        <h2>Actualité</h2>
    </div>
</div>

<div class="articles">
    <ul id="list-news">
        <?php foreach ($articles as $article): ?>
            <li class="wrapper unarticle <?php echo $article->nom_categorie ? strtolower($article->nom_categorie) : ''; ?>"><!-- Liste des news --> <!-- AJOUTER LA CATÉGORIE DE LA NEWS POUR CHAQUE -->
                <h2><?php echo $article->titre; ?></h2>
                <?php if($article->nom_categorie): ?>
                    <div class="categorie">Posté dans <a href="#" title="<?php echo $article->nom_categorie; ?>"><?php echo $article->nom_categorie; ?></a></div>
                <?php endif; ?>
                <div class="date"><?php echo $article->date_full; ?></div>
                <div class="content">
                    <?php echo $article->contenu; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="metaFooter">
        <?php if(!is_null($prev_link)): ?><a href="<?php echo $prev_link; ?>" id="previousLink" class="previousLink">&laquo; Précédent</a><?php endif; ?>
        <?php if(!is_null($next_link)): ?><a href="<?php echo $next_link; ?>"  id="nextLink" class="nextLink">Suivant &raquo;</a><?php endif; ?>
    </div>

</div>