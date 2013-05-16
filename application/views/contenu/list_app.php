
<section id="listApps" class="fullList">
	
	<div class="title">
    	<div class="wrapper">
        	<h2>Toutes les applications dans Allergies</h2> <!-- INSÉRER LE TITRE DE LA CATÉGORIE ICI -->
        	<form method="POST" id="sort-filter">
	        	<select name="filters" id="filters" multiple="multiple">
	        
	            	<optgroup label="Prix">
	                    <option value="0">Gratuit</option>
	                    <option value="1">Payant</option>
	                </optgroup>
	                
	                <optgroup label="Plateforme">
	                    <option value="0">Web</option>
	                    <option value="1">iOS</option>
	                    <option value="1">Android</option>
	                </optgroup>
	                
	            </select>
	            
	            <select name="sort" id="sort">
	        
                    <option value="0">Les plus récentes</option>
                    <option value="1">Les mieux notées</option>
                    <option value="2">Prix croissant</option>
                    <option value="2">Prix décroissant</option>
	                
	            </select>
        	</form>
        </div>
    </div>


    <div class="wrapper">
	    <section class="allapps">
	    	<?php echo $app_grid; ?>
	    	<div class="metaFooter">
	    		<a href="<?php echo site_url($access_label.'/target'); ?>" class="previousLink">&laquo; Précédent</a>
	    		<a href="<?php echo site_url($access_label.'/target'); ?>" class="nextLink">Suivant &raquo;</a>
	    	</div>
	    </section>
    </div>

</section>

<!-- <section id="partners"><?php echo $partners ; ?></section> -->