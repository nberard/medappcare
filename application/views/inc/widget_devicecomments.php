<div id="accessoire-notes-browser">

    <h4>Commentaires</h4>
    
    <ul>
    
        <li class="onecomment">
    
            <h5>Jean-Pierre</h5>
        
            <div class="commentText">
                <p>Donec ullamcorper nulla non metus auctor fringilla. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
            </div>
            
            <div class="commentReview">
                <div class="ergonomie">
                    <label>Ergonomie</label>
                    <div class="rateit" data-rateit-value="2" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                </div>
                <div class="design">
                    <label>Design</label>
                    <div class="rateit" data-rateit-value="3" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                </div>
                <div class="fonctionnement">
                    <label>Fonctionnement</label>
                    <div class="rateit" data-rateit-value="4" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                </div>
                <div class="satisfaction">
                    <label>Satisfaction</label>
                    <div class="rateit" data-rateit-value="5" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                </div>
        
        
        
        
        <!--
                <?php $cpt = 0; foreach($notes as $notation): ?>
                    <?php $cpt++; echo $notation->pseudo.' a noté cette application '.$notation->date_full.' : '.$notation->note.' / '.config_item('note_max_user').' dans '.$notation->critere.'<br/>'; ?>
                    <?php if($cpt % config_item('nb_comments_page') == 0) echo '<br/>';  ?>
                <?php endforeach; ?>
        -->
            </div>
        
        </li>
        
        <li class="onecomment">
    
            <h5>Jean-Paul</h5>
        
            <div class="commentText">
                <p>Donec ullamcorper nulla non metus auctor fringilla. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
            </div>
            
            <div class="commentReview">
                <div class="ergonomie">
                    <label>Ergonomie</label>
                    <div class="rateit" data-rateit-value="2" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                </div>
                <div class="design">
                    <label>Design</label>
                    <div class="rateit" data-rateit-value="3" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                </div>
                <div class="fonctionnement">
                    <label>Fonctionnement</label>
                    <div class="rateit" data-rateit-value="4" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                </div>
                <div class="satisfaction">
                    <label>Satisfaction</label>
                    <div class="rateit" data-rateit-value="5" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                </div>
        
        
        
        
        <!--
                <?php $cpt = 0; foreach($notes as $notation): ?>
                    <?php $cpt++; echo $notation->pseudo.' a noté cette application '.$notation->date_full.' : '.$notation->note.' / '.config_item('note_max_user').' dans '.$notation->critere.'<br/>'; ?>
                    <?php if($cpt % config_item('nb_comments_page') == 0) echo '<br/>';  ?>
                <?php endforeach; ?>
        -->
            </div>
            <div class="clear"></div>
        
        </li>
    
    </ul>
    
    <ul class="wrapper pager">
        <input type="hidden" id="application-notes-pro" value="<?php echo $pro ? 1 : 0; ?>"/>
        <li class="previous<?php if(is_null($prev_link)): ?> disabled<?php endif; ?>">
            <a href="javascript:void(0);" data-render="<?php echo config_item('render_template_accept'); ?>" <?php if(!is_null($prev_link)) echo 'data-link="'.site_url('application/'.$application_id.'/notes/'.$prev_link).'"'; ?> id="accessoire-comments-previousLink" class="previousLink">&laquo; Précédent</a>
        </li>
        <li class="next<?php if(is_null($next_link)): ?> disabled<?php endif; ?>">
            <a href="javascript:void(0);" data-render="<?php echo config_item('render_template_accept'); ?>" <?php if(!is_null($next_link)) echo 'data-link="'.site_url('application/'.$application_id.'/notes/'.$next_link).'"'; ?> id="accessoire-comments-nextLink" class="nextLink">Suivant &raquo;</a>
        </li>
    </ul>
    
</div>