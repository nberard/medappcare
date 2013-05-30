<form class="form-signup" method="POST" id="form-membre-update" data-action="<?php echo site_url('membre/'.$user->id); ?>">
    <h2 class="form-signup-heading">Mon Espace</h2>
    <div id="update-success" class="alert alert-success hide"></div>
    <div id="update-error" class="alert alert-error hide"></div>
    <input name="pseudo" type="text" id="reg_pseudo" class="input-block-level" placeholder="Pseudo" value="<?php echo $user->pseudo; ?>" required disabled>    
    <input name="email" type="email" id="reg_email" class="input-block-level" placeholder="Email" value="<?php echo $user->email; ?>" required>
    <input name="password" type="password" id="reg_password" class="input-block-level" placeholder="********">

    <input name="date_naissance" id="date_naissance" type="text" class="input-block-level"  placeholder="Date de naissance" value="<?php echo $user->date_naissance_classic; ?>" data-date-format="dd/mm/yyyy" data-date-viewmode="years" autocomplete="off" required>


    <div class="well"><label>Sexe</label>
        <div id="sexe-group" class="btn-group" data-toggle="buttons-radio" >
            <button type="button" class="btn <?php if($user->sexe == 'H'): ?>active<?php endif; ?>" data-toggle="button" value="H">Homme</button>
            <button type="button" class="btn <?php if($user->sexe == 'F'): ?>active<?php endif; ?>" data-toggle="button" value="F">Femme</button>
            <button type="button" class="btn <?php if($user->sexe == 'A'): ?>active<?php endif; ?>" data-toggle="button" value="A">Non précisé</button>
            <input type="hidden" name="sexe" id="sexe" value="<?php echo $user->sexe; ?>" required>
        </div>
    </div>

    <input id="country" name="country" type="text" class="input-block-level" placeholder="Pays" value="<?php echo $user->pays_full; ?>" data-provide="typeahead" data-items="<?php echo $nb_countries; ?>" data-source='<?php echo $country_json; ?>' autocomplete="off" required>

    <select name="interets" id="interets" multiple="multiple">
        <?php foreach($categories_principales as $categorie_principale): ?>
            <optgroup label="<?php echo $categorie_principale->nom; ?>">
                <?php foreach($categorie_principale->enfants as $categorie_enfant): ?>
                    <option value="<?php echo $categorie_enfant->id; ?>" <?php if(in_array($categorie_enfant->id, $user->categories)) echo 'selected';?>><?php echo $categorie_enfant->nom; ?></option>
                <?php endforeach; ?>
            </optgroup>
        <?php endforeach; ?>
    </select>


    <div class="well"><label>Device (plusieurs choix possibles)</label>
        <div id="plateforme-group" class="btn-group" data-toggle="buttons-checkbox">
            <?php foreach($plateformes as $plateforme): ?>
                <button type="button" value="<?php echo $plateforme->id; ?>" class="btn <?php if(in_array($plateforme->id, $user->plateformes)) echo 'active';?>"><?php echo $plateforme->label; ?></button>
            <?php endforeach; ?>
            <input type="hidden" name="plateformes" id="plateformes"/>
        </div>
    </div>

    <button class="btn btn-primary" type="submit">Enregistrer</button>
    
</form>

<script>
    var plateformeIdsJson = <?php echo $user->plateformes_json; ?>;
    var plateformeIds = [];
    for (var plateformeId in plateformeIdsJson) {
        if (plateformeIdsJson.hasOwnProperty(plateformeId)) {
            plateformeIds[plateformeId] = true;
        }
    }
</script>