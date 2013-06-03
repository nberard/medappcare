<div class="wrapper">
    <h2>Nos Sélections</h2>
    <ul>
        <?php foreach($selections as $selection): ?>
            <li><a href="<?php echo $selection->link; ?>" class="">Description</a><span class="underline"></span></li>
        <?php endforeach; ?>
    </ul>
</div>