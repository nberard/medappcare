<<<<<<< HEAD
<div class="listapps topfive">
    <h3 class="short">Le Top dans <?php echo $categorie->nom; ?> iop iop iop iop iop iop iop op</h3>
=======
<div id="listapps_topfive" class="listapps topfive" data-action="<?php echo site_url('rest/topfiveapplis/'.$categorie->id);?>" data-render="<?php echo config_item('render_template_accept'); ?>">
    <h3>Le Top dans <?php echo $categorie->nom; ?></h3>
    <input type="hidden" id="template-render" value="<?php echo $template_render; ?>"/>
>>>>>>> 8527d40e78998a73e276d3e8e42d0fb21d899ee8
    <div class="filter">
        <a href="javascript:void(0)" class="gratuit<?php if($free) echo " actif"; ?>" title="Filtrer les apps gratuites" data-free="1"><span></span>gratuit</a>
        <a href="javascript:void(0)" class="payant<?php if(!$free) echo " actif"; ?>" title="Filtrer les apps payantes" data-free="0"><span></span>€</a>
    </div>
    <ul>
        <?php foreach($applications as $application): ?>
            <li>
                <a href="<?php echo $application->link; ?>" class="icone"><img width="80px" height="80px" src="<?php echo $application->logo_url; ?>"></a> <!-- INSÉRER L'ICON DE L'APP -->
                <div class="metapp">
<<<<<<< HEAD
                    <h4><a class="short" href="<?php echo $application->link; ?>"><?php echo $application->titre; ?></a></h4> <!-- INSÉRER LE LIEN ET LE TITRE DE L'APP -->
=======
                    <h4><a href="<?php echo $application->link; ?>"><?php echo $application->nom; ?></a></h4> <!-- INSÉRER LE LIEN ET LE TITRE DE L'APP -->
>>>>>>> 8527d40e78998a73e276d3e8e42d0fb21d899ee8
                    <p class="price"><?php echo $application->prix_complet; ?></p> <!-- INSÉRER LE PRIX DE L'APP -->
                    <?php foreach($application->categories as $categorie): ?>
                        <p class="category"><?php echo lang('dans');?> <a href="<?php echo $categorie->link_categorie; ?>"><?php echo $categorie->nom; ?></a></p> <!-- INSÉRER LE LIEN VERS L'APP -->
                    <?php endforeach; ?>
                </div>
                <?php if($application->moyenne_note): ?>
                    <div class="note">
                        <span class="<?php echo $application->class_note; ?>"><?php echo $application->moyenne_note; ?></span> <!-- INSÉRER LA NOTE -->
                    </div>
                <?php endif; ?>
                <div class="os">
                    <span class="<?php echo $application->device_class; ?>"><?php echo $application->device_nom; ?></span>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="metaFooter"><a href="category.php">voir tout ></a></div>
</div>