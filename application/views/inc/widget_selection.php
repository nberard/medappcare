<div class="wrapper">
    <h2>Nos Sélections</h2>
    <ul>
        <?php foreach($selections as $selection): ?>
            <li><a href="<?php echo $selection->link; ?>" class=""><img width="195px" height="100px" src="<?php echo base_url().config_item('upload_paths')['selection'].$selection->image; ?>"/></a><span class="underline"></span></li>
        <?php endforeach; ?>
    </ul>
</div>