<div class="wrapper">
    <h2>Les Produits Connectés</h2>
    <ul>
        <?php foreach($accessoires as $accessoire): ?>
            <li>
                <a href="<?php echo $accessoire->link; ?>" class="icone"><img width="80px" height="80px" src="<?php echo $accessoire->photo; ?>"></a> <!-- INSÉRER L'ICON DU DEVICE -->
                <div class="metapp">
                    <h4 class="short"><a href="<?php echo $accessoire->link; ?>"><?php echo $accessoire->nom; ?></a></h4> <!-- INSÉRER LE LIEN ET LE TITRE DU DEVICE -->
                    <p class="excerpt"><?php echo $accessoire->description_short; ?></p>
<!--                    <p class="category">dans <a href="category.php">Addictions</a></p> <!-- INSÉRER LE LIEN VERS LE DEVICE -- WTF ?-->
                </div>
                <p class="price"><?php echo $accessoire->prix_complet; ?></p> <!-- INSÉRER LE PRIX DU DEVICE -->
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="clear"></div>
    <div class="metaFooter"><a href="category.php">voir tout ></a></div>
</div>