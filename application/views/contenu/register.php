<form class="form-signin" method="post" action="<?php echo site_url('perso/register_do'); ?>">
    <h2 class="form-signin-heading">Inscription grand public</h2>

    <input type="email" id="email" class="input-block-level" placeholder="Email" required>
    <input type="password" id="password" class="input-block-level" placeholder="Mot de passe" required>

    <input type="text" class="input-block-level"  placeholder="Date de naissance" data-date-format="dd/mm/yyyy" data-date-viewmode="years" id="ddn" autocomplete="off" required>


    <div class="well"><label>Sexe</label>
        <div class="btn-group" data-toggle="buttons-radio" >
            <button type="button" class="btn" data-toggle="button" id="homme">Homme</button>
            <button type="button" class="btn" data-toggle="button" id="femme">Femme</button>
            <button type="button" class="btn" data-toggle="button" id="autre">Autre</button>
            <input type="hidden" name="sexe" id="sexe" value="" required>
        </div>
    </div>

    <input name="country" type="text" class="input-block-level" placeholder="Pays" data-provide="typeahead" data-items="<?php echo $nb_countries; ?>" data-source='<?php echo $country_json; ?>' autocomplete="off" required>

    <!--   Si on préfère les Checkbox classiques...
           <div class="btn-group">
               Device
               <label class="checkbox inline">
                 <input type="checkbox" id="inlineCheckbox1" value="option1"> iPhone
               </label>
               <label class="checkbox inline">
                 <input type="checkbox" id="inlineCheckbox2" value="option2"> iPad
               </label>
               <label class="checkbox inline">
                 <input type="checkbox" id="inlineCheckbox3" value="option3"> Smartphone Android
               </label>
               <label class="checkbox inline">
                 <input type="checkbox" id="inlineCheckbox4" value="option4"> Tablette Android
           </label>
           </div>
    -->

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
        <div class="btn-group" data-toggle="buttons-checkbox">
            <button type="button" class="btn">iPhone</button>
            <button type="button" class="btn">iPad</button>
            <button type="button" class="btn">Tablette Android</button>
            <button type="button" class="btn">Smartphone Android</button>
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