<div id="dropdown" class="loading"></div><!-- #dropdown Menu -->

<div class="title singlenews">
    <div class="wrapper">
        <h2><?php echo $article->titre; ?></h2> <!-- Insérer le titre ici -->
        <?php if($article->nom_categorie): ?>
            <div class="meta">Posté dans <?php echo $article->nom_categorie; ?> <?php echo $article->date_full; ?></div>
        <?php endif; ?>
    </div>
</div>

<div class="wrapper singlenews">
    <?php if(!empty($article->picto_url)): ?>
        <div class="pictonews">
            <img width="80px" height="80px" src="<?php echo $article->picto_url; ?>"/>
        </div>
    <?php endif; ?>

    <div class="content">
        <?php echo $article->contenu; ?>
    </div>

</div>