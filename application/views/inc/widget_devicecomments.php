<div id="accessoire-notes-browser">
<?php $cpt = 0; foreach($notes as $notation): ?>
    <?php $cpt++; echo $notation->pseudo.' a noté cette application '.$notation->date_full.' : '.$notation->note.' / 10 dans '.$notation->critere.'<br/>'; ?>
    <?php if($cpt % config_item('nb_comments_page') == 0) echo '<br/>';  ?>
<?php endforeach; ?>
<ul class="wrapper pager">
    <li class="previous<?php if(is_null($prev_link)): ?> disabled<?php endif; ?>">
        <a href="javascript:void(0);" data-render="<?php echo config_item('render_template_accept'); ?>" <?php if(!is_null($prev_link)) echo 'data-link="'.site_url('accessoire/'.$device_id.'/notes/'.$prev_link).'"'; ?> id="accessoire-comments-previousLink" class="previousLink">&laquo; Précédent</a>
    </li>
    <li class="next<?php if(is_null($next_link)): ?> disabled<?php endif; ?>">
        <a href="javascript:void(0);" data-render="<?php echo config_item('render_template_accept'); ?>" <?php if(!is_null($next_link)) echo 'data-link="'.site_url('accessoire/'.$device_id.'/notes/'.$next_link).'"'; ?> id="accessoire-comments-nextLink" class="nextLink">Suivant &raquo;</a>
    </li>
</ul>
</div>