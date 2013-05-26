<form id="form-signup" class="form-signup" method="post" data-action="<?php echo site_url('rest/membre');?>" >
    <h2 class="form-signup-heading">Inscription Professionels</h2>
    <div id="reg-error" class="alert alert-error hide"></div>
    <input type="text" id="nom" id="nom" class="input-block-level" placeholder="Nom" required>
    <input type="text" id="prenom" id="prenom" class="input-block-level" placeholder="Prénom" required>
    <input type="email" id="reg_email" id="email" class="input-block-level" placeholder="Email" required>
    <input type="password" id="reg_password" id="password" class="input-block-level" placeholder="Mot de passe" required>

    <?php echo form_dropdown('profession', config_item('metiers'), array(), 'id="profession"'); ?>


    <select name="interets" id="interets" multiple="multiple">
        <?php foreach($categories_principales as $categorie_principale): ?>
            <optgroup label="<?php echo $categorie_principale->nom; ?>">
                <?php foreach($categorie_principale->enfants as $categorie_enfant): ?>
                    <option value="<?php echo $categorie_enfant->id; ?>"><?php echo $categorie_enfant->nom; ?></option>
                <?php endforeach; ?>
            </optgroup>
        <?php endforeach; ?>
    </select>

    <input name="rpps" type="text" id="rpps" class="input-block-level" placeholder="Numéro RPPS*">


    <span class="help-block">* ou bien j'envoie une preuve de ma fonction de professionnel de santé ou d'étudiant en santé (carte professionnelle, carte d'étudiant(e), diplôme, ordonnance barrée,...) par email à identification@medappcare.com dans les 1 mois. Ce document peut être scanné ou pris en photo par votre smartphone.</span>


    <label class="checkbox">
        <input type="checkbox" id="cgu"  name="cgu" required> J'accepte des <a href="<?php echo site_url($access_label.'/cgu'); ?>" title="CGU" target="_blank">Conditions Générales d'Utilisation</a>
    </label>
    <button class="btn btn-primary" type="submit">M'inscrire</button>
    <br> <br>
    <span class="help-block">Medappcare utilise ces données afin de vous recommander des applications qui correspondent à vos intérêts.</span>
</form>