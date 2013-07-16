<section id="listDevices" class="fullList">

	<div class="title">
    	<div class="wrapper">
        	<h2 class="short"><?php echo $titre; ?></h2>
        </div>
    </div>

    <div class="wrapper">
	    <section class="alldevices" id="devices">
	    	<?php echo $device_grid; ?>
	    	<div class="metaFooter">
	    		<?php if(!is_null($prev_link)): ?><a href="<?php echo $prev_link; ?>" id="previousLink" class="previousLink">&laquo; Précédent</a><?php endif; ?>
                <?php if(!is_null($next_link)): ?><a href="<?php echo $next_link; ?>"  id="nextLink" class="nextLink">Suivant &raquo;</a><?php endif; ?>
	    	</div>
	    </section>
    </div>

</section>