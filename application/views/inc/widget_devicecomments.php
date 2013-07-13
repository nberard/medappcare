<div id="accessoire-notes-browser">

    <h4>Commentaires</h4>

    <ul>
        <?php foreach($notes as $membre_id => $notation): ?>
            <li class="onecomment">

                <h5><?php echo $notation->pseudo; ?></h5>

                <div class="commentText">
                    <?php echo $notation->commentaire; ?>
                </div>

                <div class="commentReview">
                    <?php foreach($notation->notes as $note): ?>
                        <div class="<?php echo strtolower($note->critere); ?>">
                            <label><?php echo $note->critere; ?></label>
                            <div class="rateit" data-rateit-value="<?php echo $note->note; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </li>
        <?php endforeach; ?>

    </ul>

    <?php if(count($notes)): ?>
    <ul class="wrapper pager">

        <li class="previous<?php if(is_null($prev_link)): ?> disabled<?php endif; ?>">
            <a href="javascript:void(0);" data-render="<?php echo config_item('render_template_accept'); ?>" <?php if(!is_null($prev_link)) echo 'data-link="'.site_url('accessoire/'.$device_id.'/notes/'.$prev_link).'"'; ?> id="accessoire-comments-previousLink" class="previousLink">&laquo; Précédent</a>
        </li>
        <li class="next<?php if(is_null($next_link)): ?> disabled<?php endif; ?>">
            <a href="javascript:void(0);" data-render="<?php echo config_item('render_template_accept'); ?>" <?php if(!is_null($next_link)) echo 'data-link="'.site_url('accessoire/'.$device_id.'/notes/'.$next_link).'"'; ?> id="accessoire-comments-nextLink" class="nextLink">Suivant &raquo;</a>
        </li>
    </ul>
    <?php endif; ?>
</div>