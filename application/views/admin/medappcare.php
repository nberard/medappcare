<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 14/06/13
 * Time: 14:09
 */
?>
<?php if($this->session->flashdata('error')): ?>
<div class="alert alert-error"><?php echo $this->session->flashdata('error'); ?></div>
<?php endif; ?>
<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
<?php endif; ?>
<br/>
<br/>
<hr>
<form method="POST">
<label for="avis">Avis Medappcare : </label><br/>
<textarea class="texteditor" id="avis" name="avis" rows="10" cols="100"><?php echo $avis; ?></textarea>
<?php foreach($criteres as $critere_parent): ?>
<h2><?php echo $critere_parent->nom; ?></h2>
    <?php foreach($critere_parent->childs as $critere_enfant): ?>
        <h4><?php echo $critere_enfant->nom; ?></h4>
        <label for="note<?php echo $critere_enfant->id; ?>">Note (sur <?php echo config_item('note_max_medappcare'); ?>) : </label>
        <input type="number" name="note<?php echo $critere_enfant->id; ?>"
               min="<?php echo config_item('note_min_medappcare'); ?>"
               max="<?php echo config_item('note_max_medappcare'); ?>"
               value="<?php echo isset($notes_criteres[$critere_enfant->id]) ? $notes_criteres[$critere_enfant->id] : '' ?>"
            />
    <?php endforeach; ?>
<?php endforeach; ?>
    <br/>
<input type="submit" value="Noter"/>
</form>
