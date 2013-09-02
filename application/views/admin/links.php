<h2>Membre Pro en attente de validation</h2>
<ul>
<?php foreach($membres_attente as $membre_attente): ?>
    <li><a href="<?php echo site_url('admin/membres/edit/'.$membre_attente->id); ?>"><?php echo $membre_attente->email; ?></a></li>
<?php endforeach; ?>
</ul>

<h2>Applications en attente</h2>
<ul>
    <?php foreach($applis_attente as $appli_attente): ?>
        <li><a href="<?php echo site_url('admin/applications/edit/'.$appli_attente->id); ?>"><?php echo $appli_attente->nom; ?></a></li>
    <?php endforeach; ?>
</ul>