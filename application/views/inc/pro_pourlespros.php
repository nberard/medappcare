<div class="listapps pourlespros">
    <h3><span></span>Pour les Pros</h3>
    <div class="filter">
        <a href="#" class="pardate actif" title="Filtrer par dates"><span></span>filtrer par date</a>
        <a href="#" class="parnote" title="Filtrer par notes"><span></span>filtrer par notes</a>
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
                <div class="note">
                    <span class="dixsurdix">10</span> <!-- INSÉRER LA NOTE -->
                </div>
                <div class="os">
                    <span class="<?php echo $application->device_class; ?>"><?php echo $application->device_nom; ?></span>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="metaFooter"><a href="category.php">voir tout ></a></div>
</div>