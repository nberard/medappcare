<section id="listApps" class="fullList">
	<?php var_dump($search_params); if(!is_null($search_params['term'])): ?>
        <input type="hidden" id="search-term" value="<?php echo $search_params['term']; ?>"/>
    <?php endif; ?>
	<div class="title">
    	<div class="wrapper">
        	<h2 class="short"><?php echo $titre; ?></h2>
        	<form method="POST" id="sort-filter">
                <select name="filters" id="filters" multiple="multiple">

	                <optgroup label="Medappcare" id="eval-medapp">
	                	<option value="eval-medapp" <?php // if($search_params['rated']) echo 'selected'; ?>>Évaluée par Medappcare</option>
	                </optgroup>
	            	
	            	<optgroup label="Prix" id="prix">
	                    <option value="true" <?php if($search_params['free'] === true) echo 'selected'; ?>>Gratuit</option>
	                    <option value="false" <?php if($search_params['free'] === false) echo 'selected'; ?>>Payant</option>
	                </optgroup>
	                
	                <optgroup label="Plateforme" id="devices">
                        <?php foreach($devices as $device): ?>
                            <option value="<?php echo $device->id; ?>" <?php if(is_array($search_params['devices']) && in_array($device->id, $search_params['devices'])) echo 'selected'; ?>><?php echo $device->nom; ?></option>
                        <?php endforeach; ?>
	                </optgroup>
                    <optgroup label="Medappcare" id="medappcare_note">
                        <option value="1">Evalué par Medappcare</option>
                    </optgroup>
	                
	            </select>
	            
	            <select name="sort" id="sort">
                    <option <?php if($search_params['sort'] == 'date_ajout') echo 'selected'; ?> value="date_ajout|desc">Les plus récentes</option>
                    <option <?php if($search_params['sort'] == 'note') echo 'selected'; ?> value="note|desc">Les mieux notées</option>
                    <option <?php if($search_params['sort'] == 'prix' && $search_params['order'] == 'asc') echo 'selected'; ?> value="prix|asc">Prix croissant</option>
                    <option <?php if($search_params['sort'] == 'prix' && $search_params['order'] == 'desc') echo 'selected'; ?> value="prix|desc">Prix décroissant</option>
	                
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