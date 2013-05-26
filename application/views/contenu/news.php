<div id="dropdown" class="loading"></div><!-- #dropdown Menu -->

<div class="title">
    <div class="wrapper">
        <h2><?php echo $article->titre; ?></h2> <!-- Insérer le titre ici -->
    </div>
</div>

<div class="wrapper singlenews">
    <?php if($article->nom_categorie): ?>
        <div class="meta">Posté dans <a href="#" title="<?php echo $article->nom_categorie; ?>"><?php echo $article->nom_categorie; ?></a> <?php echo $article->date_full; ?></div>
    <?php endif; ?>

    <div class="content">
        <?php echo $article->contenu; ?>
    </div>

</div>