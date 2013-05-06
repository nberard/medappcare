<form class="form-signup" method="post" id="form-signup" data-action="<?php echo site_url('rest/signup'); ?>">
    <h2 class="form-signup-heading">Inscription grand public</h2>
    <div id="error-reg" class="alert alert-error hide"></div>
    <input name="email" type="email" id="email" class="input-block-level" placeholder="Email" required>
    <input name="password" type="password" id="password" class="input-block-level" placeholder="Mot de passe" required>

    <input name="date_naissance" type="text" class="input-block-level"  placeholder="Date de naissance" data-date-format="dd/mm/yyyy" data-date-viewmode="years" id="ddn" autocomplete="off" required>


    <div class="well"><label>Sexe</label>
        <div id="sexe-group" class="btn-group" data-toggle="buttons-radio" >
            <button type="button" class="btn" data-toggle="button" value="H">Homme</button>
            <button type="button" class="btn" data-toggle="button" value="F">Femme</button>
            <button type="button" class="btn" data-toggle="button" value="A">Autre</button>
            <input type="hidden" name="sexe" id="sexe" value="" required>
        </div>
    </div>

    <input name="country" type="text" class="input-block-level" placeholder="Pays" data-provide="typeahead" data-items="<?php echo $nb_countries; ?>" data-source='<?php echo $country_json; ?>' autocomplete="off" required>

    <select id="interets" multiple="multiple">
        <optgroup label="Ma santé"> <!-- Mettre contenu du menu Ma santé -->
            <option value="cheese">Cheese</option>
            <option value="tomatoes">Tomatoes</option>
            <option value="mozarella">Mozzarella</option>
            <option value="mushrooms">Mushrooms</option>
            <option value="pepperoni">Pepperoni</option>
            <option value="onions">Onions</option>
        </optgroup>
        <optgroup label="Mon quotidien">  <!-- Mettre contenu du menu Mon Quotidien -->
            <option value="cheese2">Cheese2</option>
            <option value="tomatoes2">Tomatoes2</option>
            <option value="mozarella2">Mozzarella2</option>
            <option value="mushroom2">Mushrooms2</option>
            <option value="pepperoni2">Pepperoni2</option>
            <option value="onions2">Onions2</option>
        </optgroup>
    </select>


    <div class="well"><label>Device (plusieurs choix possibles)</label>
        <div id="plateforme-group" class="btn-group" data-toggle="buttons-checkbox">
            <?php foreach($plateformes as $plateforme): ?>
                <button type="button" value="<?php echo $plateforme->id; ?>" class="btn"><?php echo $plateforme->{"label_".config_item('language_short')}; ?></button>
            <?php endforeach; ?>
            <input type="hidden" name="plateformes[]"/>
        </div>
    </div>

    <label class="checkbox">
        <input type="checkbox" value="cgu" required> J'accepte des <a href="#" title="CGU">Conditions Générales d'Utilisation</a>
    </label>
    <label class="checkbox">
        <input type="checkbox" value="data" required> J'accepte le traitement de ces données par Medappcare
    </label>
    <button class="btn btn-primary" type="submit">M'inscrire</button>
    <br> <br>
    <span class="help-block">Medappcare utilise ces données afin de vous recommander des applications qui correspondent à vos intérêts.</span>
</form>