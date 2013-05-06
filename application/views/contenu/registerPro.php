<form class="form-signup" method="get" >
    <h2 class="form-signup-heading">Inscription Professionels</h2>

    <input type="text" id="nom" class="input-block-level" placeholder="Nom" required>
    <input type="text" id="prenom" class="input-block-level" placeholder="Prénom" required>
    <input type="email" id="email" class="input-block-level" placeholder="Email" required>
    <input type="password" id="password" class="input-block-level" placeholder="Mot de passe" required>

    <select id="profession" required>
        <option value="">Profession</option>
        <optgroup label="Profession médicale">
            <option value="cheese">Biologiste</option>
            <option value="Dentiste">Dentiste</option>
            <option value="Médecin">Médecin</option>
            <option value="Pharmacien hospitalier">Pharmacien hospitalier</option>
            <option value="Pharmacien d'officine">Pharmacien d'officine</option>
            <option value="Sage-femme">Sage-femme</option>
            <option value="Interne">Interne</option>
            <option value="Etudiant">Etudiant</option>
        </optgroup>
        <optgroup label="Profession paramédicale">
            <option value="cheese">Aide-soigant</option>
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


    <select id="interets" multiple="multiple"><!-- Mettre contenu du menu Ma pratique -->
        <option value="cheese">Cheese</option>
        <option value="tomatoes">Tomatoes</option>
        <option value="mozarella">Mozzarella</option>
        <option value="mushrooms">Mushrooms</option>
        <option value="pepperoni">Pepperoni</option>
        <option value="onions">Onions</option>
    </select>

    <input type="text" id="rpps" class="input-block-level" placeholder="Numéro RPPS*">


    <span class="help-block">* ou bien j'envoie une preuve de ma fonction de professionnel de santé ou d'étudiant en santé (carte professionnelle, carte d'étudiant(e), diplôme, ordonnance barrée,...) par email à identification@medappcare.com dans les 1 mois. Ce document peut être scanné ou pris en photo par votre smartphone.</span>


    <label class="checkbox">
        <input type="checkbox" value="cgu" required> J'accepte des <a href="#" title="CGU">Conditions Générales d'Utilisation</a>
    </label>
    <button class="btn btn-primary" type="submit">M'inscrire</button>
    <br> <br>
    <span class="help-block">Medappcare utilise ces données afin de vous recommander des applications qui correspondent à vos intérêts.</span>
</form>