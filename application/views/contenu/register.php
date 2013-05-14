<form class="form-signup" method="post" id="form-signup" data-action="<?php echo site_url('rest/signup'); ?>">
    <h2 class="form-signup-heading">Inscription grand public</h2>
    <div id="reg-error" class="alert alert-error hide"></div>
    <input name="email" type="email" id="reg_email" class="input-block-level" placeholder="Email" required>
    <input name="password" type="password" id="reg_password" class="input-block-level" placeholder="Mot de passe" required>

    <input name="date_naissance" id="date_naissance" type="text" class="input-block-level"  placeholder="Date de naissance" data-date-format="dd/mm/yyyy" data-date-viewmode="years" autocomplete="off" required>


    <div class="well"><label>Sexe</label>
        <div id="sexe-group" class="btn-group" data-toggle="buttons-radio" >
            <button type="button" class="btn" data-toggle="button" value="H">Homme</button>
            <button type="button" class="btn" data-toggle="button" value="F">Femme</button>
            <button type="button" class="btn" data-toggle="button" value="A">Autre</button>
            <input type="hidden" name="sexe" id="sexe" value="" required>
        </div>
    </div>

    <input id="country" name="country" type="text" class="input-block-level" placeholder="Pays" data-provide="typeahead" data-items="<?php echo $nb_countries; ?>" data-source='<?php echo $country_json; ?>' autocomplete="off" required>

    <select name="interets" id="interets" multiple="multiple">
        <?php foreach($categories_principales as $categorie_principale): ?>
            <optgroup label="<?php echo $categorie_principale->{"nom_".config_item('lng')}; ?>">
                <?php foreach($categorie_principale->enfants as $categorie_enfant): ?>
                    <option value="<?php echo $categorie_enfant->id; ?>"><?php echo $categorie_enfant->{"nom_".config_item('lng')}; ?></option>
                <?php endforeach; ?>
            </optgroup>
        <?php endforeach; ?>
    </select>


    <div class="well"><label>Device (plusieurs choix possibles)</label>
        <div id="plateforme-group" class="btn-group" data-toggle="buttons-checkbox">
            <?php foreach($plateformes as $plateforme): ?>
                <button type="button" value="<?php echo $plateforme->id; ?>" class="btn"><?php echo $plateforme->{"label_".config_item('lng')}; ?></button>
            <?php endforeach; ?>
            <input type="hidden" name="plateformes" id="plateformes"/>
        </div>
    </div>

    <label class="checkbox">
        <input name="cgu" id="cgu" type="checkbox" required> J'accepte des <a href="#" title="CGU">Conditions Générales d'Utilisation</a>
    </label>
    <label class="checkbox">
        <input name="cgv" id="cgv"  type="checkbox" required> J'accepte le traitement de ces données par Medappcare
    </label>
    <button class="btn btn-primary" type="submit">M'inscrire</button>
    <br> <br>
    <span class="help-block">Medappcare utilise ces données afin de vous recommander des applications qui correspondent à vos intérêts.</span>
</form>

<script>
    var plateformeIds = [];
</script>