<section id="listApps" class="fullList">
	<?php if($search_params['term']): ?>
        <input type="hidden" id="search-term" value="<?php echo $search_params['term']; ?>"/>
    <?php endif; ?>
	<div class="title">
    	<div class="wrapper">
        	<h2><?php echo $titre; ?></h2> <!-- INSÉRER LE TITRE DE LA CATÉGORIE ICI -->
        	<form method="POST" id="sort-filter">
	        	<select name="filters" id="filters" multiple="multiple">
	        
	            	<optgroup label="Prix" id="prix">
	                    <option value="true">Gratuit</option>
	                    <option value="false">Payant</option>
	                </optgroup>
	                
	                <optgroup label="Plateforme" id="devices">
                        <?php foreach($devices as $device): ?>
                            <option value="<?php echo $device->id; ?>"><?php echo $device->nom; ?></option>
                        <?php endforeach; ?>
	                </optgroup>
	                
	            </select>
	            
	            <select name="sort" id="sort">
	        
                    <option value="date_ajout|desc">Les plus récentes</option>
                    <option value="note|desc">Les mieux notées</option>
                    <option value="prix|asc">Prix croissant</option>
                    <option value="prix|desc">Prix décroissant</option>
	                
	            </select>
                <input type="submit" value="Raffraichir"/>
        	</form>
        </div>
    </div>

    <div class="wrapper">
	    <section class="allapps">
	    	<?php echo $app_grid; ?>
	    	<div class="metaFooter">
	    		<?php if(!is_null($prev_link)): ?><a href="<?php echo $prev_link; ?>" id="previousLink" class="previousLink">&laquo; Précédent</a><?php endif; ?>
                <?php if(!is_null($next_link)): ?><a href="<?php echo $next_link; ?>"  id="nextLink" class="nextLink">Suivant &raquo;</a><?php endif; ?>
	    	</div>
	    </section>
    </div>

</section>

<!-- <section id="partners"><?php echo $partners ; ?></section> -->