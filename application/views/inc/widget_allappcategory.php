<div id="allappcategory" class="allapps <?php echo $categorie->class; ?>" data-action="<?php echo site_url('application/allappcategory/'.$categorie->id);?>" data-render="<?php echo config_item('render_template_accept'); ?>" data-template="<?php echo $template_render; ?>">
    <h3>Toutes les applications dans <?php echo $categorie->nom; ?></h3>
    <div class="filter">
        <a href="javascript:void(0)" class="gratuit<?php if($free) echo " actif"; ?>" title="Filtrer les apps gratuites" data-params='free=1' data-ref="allappcategory"><span></span>gratuit</a>
        <a href="javascript:void(0)" class="payant<?php if(!$free) echo " actif"; ?>" title="Filtrer les apps payantes" data-params='free=0' data-ref="allappcategory"><span></span>€</a>
    </div>
        <?php echo $app_grid; ?>
    <div class="metaFooter"><a href="<?php echo $see_all_link; ?>">voir tout ></a></div>
    <div class="clear"></div>
</div>
<div class="clear"></div>