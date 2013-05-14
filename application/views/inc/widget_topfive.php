<div class="listapps topfive">
    <h3>Le Top dans <?php echo $categorie->{"nom_".config_item('lng')}; ?></h3>
    <div class="filter">
        <a href="#" class="gratuit" title="Filtrer les apps gratuites"><span></span>gratuit</a>
        <a href="#" class="payant actif" title="Filtrer les apps payantes"><span></span>€</a>
    </div>
    <ul>
        <?php foreach($applications as $application): ?>
            <li>
                <a href="<?php echo $application->link; ?>" class="icone"><img width="80px" height="80px" src="<?php echo $application->logo_url; ?>"></a> <!-- INSÉRER L'ICON DE L'APP -->
                <div class="metapp">
                    <h4><a href="<?php echo $application->link; ?>"><?php echo $application->titre; ?></a></h4> <!-- INSÉRER LE LIEN ET LE TITRE DE L'APP -->
                    <p class="price"><?php echo $application->prix_complet; ?></p> <!-- INSÉRER LE PRIX DE L'APP -->
                    <p class="category">dans <a href="category.php">Addictions</a></p> <!-- INSÉRER LE LIEN VERS L'APP -->
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