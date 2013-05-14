<div class="listapps lasteval">
    <h3>Dernières Évaluations Medappcare</h3>
    <ul>
        <?php foreach($applications as $application): ?>
        <li>
            <?php
            log_message('debug', "application=".var_export($application->nom_categorie, true));
            ?>
            <a href="<?php echo $application->link; ?>" class="icone"><img width="80px" height="80px" src="<?php echo $application->logo_url; ?>"></a> <!-- INSÉRER L'ICON DE L'APP -->
            <div class="metapp">
                <h4><a href="<?php echo $application->link; ?>"><?php echo $application->titre; ?></a></h4> <!-- INSÉRER LE LIEN ET LE TITRE DE L'APP -->
                <p class="price"><?php echo $application->prix_complet; ?></p> <!-- INSÉRER LE PRIX DE L'APP -->
                <?php if($application->nom_categorie): ?>
                    <p class="category"><?php echo lang('dans');?> <a href="<?php echo $application->link_categorie; ?>"><?php echo $application->nom_categorie; ?></a></p> <!-- INSÉRER LE LIEN VERS L'APP -->
                <?php endif; ?>
            </div>
            <div class="note">
                <span class="dixsurdix">10</span> <!-- INSÉRER LA NOTE -->
            </div>
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