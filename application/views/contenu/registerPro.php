<form id="form-signup" class="form-signup" method="post" data-action="<?php echo site_url('rest/signup');?>" >
    <h2 class="form-signup-heading">Inscription Professionels</h2>
    <div id="reg-error" class="alert alert-error hide"></div>
    <input type="text" id="nom" id="nom" class="input-block-level" placeholder="Nom" required>
    <input type="text" id="prenom" id="prenom" class="input-block-level" placeholder="Prénom" required>
    <input type="email" id="reg_email" id="email" class="input-block-level" placeholder="Email" required>
    <input type="password" id="reg_password" id="password" class="input-block-level" placeholder="Mot de passe" required>

    <select id="profession" name="profession">
        <option value="">Profession</option>
        <optgroup label="Profession médicale">
            <option value="Biologiste">Biologiste</option>
            <option value="Dentiste">Dentiste</option>
            <option value="Médecin">Médecin</option>
            <option value="Pharmacien hospitalier">Pharmacien hospitalier</option>
            <option value="Pharmacien d'officine">Pharmacien d'officine</option>
            <option value="Sage-femme">Sage-femme</option>
            <option value="Interne">Interne</option>
            <option value="Etudiant">Etudiant</option>
        </optgroup>
        <optgroup label="Profession paramédicale">
            <option value="Aide-soigant">Aide-soigant</option>
            <option value="Ambulancier">Ambulancier</option>
            <option value="Audioprothésiste">Audioprothésiste</option>
            <option value="Diététicien">Diététicien</option>
            <option value="Ergothérapeute">Ergothérapeute</option>
            <option value="Infirmier">Infirmier</option>
            <option value="Kinésithérapeute">Kinésithérapeute</option>
            <option value="Manipulateur d'électroradiologie médicale">Manipulateur d'électroradiologie médicale</option>
            <option value="Opticien">Opticien</option>
            <option value="Orthophoniste">Orthophoniste</option>
            <option value="Orthoptiste">Orthoptiste</option>
            <option value="Podologue">Podologue</option>
            <option value="Préparateur en Pharmacie">Préparateur en Pharmacie</option>
            <option value="Psychomotricien">Psychomotricien</option>
            <option value="Technicien de laboratoire">Technicien de laboratoire</option>
            <option value="Psychomotricien">Psychomotricien</option>
            <option value="Technicien de laboratoire">Technicien de laboratoire</option>
            <option value="Etudiant">Etudiant</option>
            <option value="Autres">Autres</option>
        </optgroup>
    </select>


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
        <input type="checkbox" id="cgu"  name="cgu" required> J'accepte des <a href="cgu.html" title="CGU" target="_blank">Conditions Générales d'Utilisation</a>
    </label>
    <button class="btn btn-primary" type="submit">M'inscrire</button>
    <br> <br>
    <span class="help-block">Medappcare utilise ces données afin de vous recommander des applications qui correspondent à vos intérêts.</span>
</form>