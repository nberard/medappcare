<div id="listapps_topfive" class="listapps topfive" data-action="<?php echo site_url('rest/topfiveapplis');?>" data-render="<?php echo config_item('render_template_accept'); ?>">
    <h3>Le Top Medappcare</h3>
    <div class="filter">
        <a href="javascript:void(0)" class="gratuit<?php if($free) echo " actif"; ?>" title="Filtrer les apps gratuites" data-free="1"><span></span>gratuit</a>
        <a href="javascript:void(0)" class="payant<?php if(!$free) echo " actif"; ?>" title="Filtrer les apps payantes" data-free="0"><span></span>€</a>
    </div>
    <ul>
        <?php foreach($applications as $application): ?>
            <li>
                <a href="<?php echo $application->link; ?>" class="icone"><img width="80px" height="80px" src="<?php echo $application->logo_url; ?>"></a> <!-- INSÉRER L'ICON DE L'APP -->
                <div class="metapp">
                    <h4><a href="<?php echo $application->link; ?>"><?php echo $application->nom; ?></a></h4> <!-- INSÉRER LE LIEN ET LE TITRE DE L'APP -->
                    <p class="price"><?php echo $application->prix_complet; ?></p> <!-- INSÉRER LE PRIX DE L'APP -->
                    <?php if($application->nom_categorie): ?>
                        <p class="category"><?php echo lang('dans');?> <a href="<?php echo $application->link_categorie; ?>"><?php echo $application->nom_categorie; ?></a></p> <!-- INSÉRER LE LIEN VERS L'APP -->
                    <?php endif; ?>
                </div>
                <?php if($application->moyenne_note): ?>
                    <div class="note">
                        <span class="<?php echo $application->class_note; ?>"><?php echo $application->moyenne_note; ?></span> <!-- INSÉRER LA NOTE -->
                    </div>
                <?php endif; ?>
                <div class="os">
                    <?php if($application->device_id == $deviceApple): ?>
                        <span class="ios">iOS</span> <!-- INSERER L'OS -->
                    <?php elseif($application->device_id == $deviceAndroid): ?>
                        <span class="android">Android</span>
                    <?php else: ?>
                        <span class="web">Web App</span>
                    <?php endif; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="metaFooter"><a href="category.php">voir tout ></a></div>
</div>