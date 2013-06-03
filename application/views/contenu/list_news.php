<div id="dropdown" class="loading"></div><!-- #dropdown Menu -->

<div class="title">
    <div class="wrapper">
        <h2>Actualités</h2>
    </div>
</div>

<div class="articles">
    <ul id="list-news">
        <?php foreach ($articles as $article): ?>
            <li class="wrapper unarticle <?php echo $article->nom_categorie ? strtolower($article->nom_categorie) : ''; ?>"><!-- Liste des news --> <!-- AJOUTER LA CATÉGORIE DE LA NEWS POUR CHAQUE -->
                <?php if(!empty($article->picto_url)): ?>
                    <img width="80px" height="80px" src="<?php echo $article->picto_url; ?>"/><br/>
                    <?php endif; ?>
                <h2 class="titlenews"><a href="<?php echo $article->link; ?>" title="<?php echo $article->titre; ?>"><?php echo $article->titre; ?></a></h2>
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
    
	<ul class="wrapper pager">
	  <li class="previous<?php if(is_null($prev_link)): ?> disabled<?php endif; ?>">	
	  		<a href="<?php echo is_null($prev_link) ? 'javascript:void(0);' : $prev_link; ?>" id="previousLink" class="previousLink">&laquo; Précédent</a>
	  </li>
	  <li class="next<?php if(is_null($next_link)): ?> disabled<?php endif; ?>">
	        <a href="<?php echo is_null($next_link) ? 'javascript:void(0);' : $next_link; ?>"  id="nextLink" class="nextLink">Suivant &raquo;</a>
	  </li>
	</ul>

</div>