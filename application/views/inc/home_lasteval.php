<div class="listapps lasteval">
    <h3>Dernières Évaluations Medappcare</h3>
    <ul>
        <?php foreach($applications as $application): ?>
        <li>
            <a href="<?php echo $application->link; ?>" class="icone"><img width="80px" height="80px" src="<?php echo $application->logo_url; ?>"></a> <!-- INSÉRER L'ICON DE L'APP -->
            <div class="metapp">
                <h4><a href="<?php echo $application->link; ?>"><?php echo $application->titre; ?></a></h4> <!-- INSÉRER LE LIEN ET LE TITRE DE L'APP -->
                <a href="<?php echo $application->lien_download; ?>" class="price"><?php echo $application->prix_complet; ?></a> <!-- INSÉRER LE PRIX DE L'APP -->
                <?php foreach($application->categories as $categorie): ?>
                    <p class="category"><?php echo lang('dans');?> <a href="<?php echo $categorie->link_categorie; ?>"><?php echo $categorie->nom; ?></a></p> <!-- INSÉRER LE LIEN VERS L'APP -->
                <?php endforeach; ?>
            </div>
            <?php if($application->moyenne_note_medappcare): ?>
                <div class="note">
                    <span class="<?php echo $application->class_note_medappcare; ?>"><?php echo $application->moyenne_note_medappcare; ?></span>
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