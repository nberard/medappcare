<div id="listapps_pourlespros" class="listapps pourlespros" data-action="<?php echo site_url('application/pourlesprosapplis');?>" data-render="<?php echo config_item('render_template_accept'); ?>" data-template="<?php echo $template_render; ?>">
    <h3><span></span>Pour les Pros</h3>
    <div class="filter">
        <a href="javascript:void(0)" class="pardate<?php if($sort == 'date') echo " actif"; ?>" title="Filtrer par dates" data-params='sort=date' data-ref="listapps_pourlespros"><span></span>filtrer par date</a>
        <a href="javascript:void(0)" class="parnote<?php if($sort == 'note') echo " actif"; ?>" title="Filtrer par notes" data-params='sort=note' data-ref="listapps_pourlespros"><span></span>filtrer par notes</a>
    </div>
    <ul>
        <?php foreach($applications as $application): ?>
            <li>
                <a href="<?php echo $application->link; ?>" class="icone"><img width="80px" height="80px" src="<?php echo $application->logo_url; ?>"></a> <!-- INSÉRER L'ICON DE L'APP -->
                <div class="metapp">
                    <h4><a class="short" href="<?php echo $application->link; ?>"><?php echo $application->titre; ?></a></h4> <!-- INSÉRER LE LIEN ET LE TITRE DE L'APP -->
                    <p class="price"><?php echo $application->prix_complet; ?></p> <!-- INSÉRER LE PRIX DE L'APP -->
                    <p class="category">dans <a href="category.php">Addictions</a></p> <!-- INSÉRER LE LIEN VERS L'APP -->
                </div>
                <?php if(isset($application->moyenne_note_medappcare)): ?>
                    <div class="note">
                        <span class="<?php echo $application->class_note_medappcare; ?>"><?php echo $application->moyenne_note_medappcare; ?></span> <!-- INSÉRER LA NOTE -->
                    </div>
                <?php endif; ?>
                <div class="os">
                    <span class="<?php echo $application->device_class; ?>"><?php echo $application->device_nom; ?></span>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="metaFooter"><a href="<?php echo $see_all_link; ?>">voir tout ></a></div>
</div>