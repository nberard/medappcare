<div class="allapps catmasante"> <!-- Insérer ici la class de la catégorie (ex : catmasante) -->
    <h3>Toutes les applications dans <?php echo $categorie->nom; ?></h3>
    <div class="filter">
        <a href="#" class="gratuit" title="Filtrer les apps gratuites"><span></span>gratuit</a>
        <a href="#" class="payant actif" title="Filtrer les apps payantes"><span></span>€</a>
    </div>
        <?php echo $app_grid; ?>
    <div class="metaFooter"><a href="category.php">voir tout ></a></div>
    <div class="clear"></div>
</div>
<div class="clear"></div>