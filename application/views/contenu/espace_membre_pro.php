<form id="form-membre-update" class="form-signup" method="post" data-action="<?php echo site_url('membre/index/'.$user->id); ?>"" >
    <h2 class="form-signup-heading">Mon Espace Pro</h2>
    <div id="update-success" class="alert alert-success hide"></div>
    <div id="update-error" class="alert alert-error hide"></div>
    
    <input type="text" id="nom" id="nom" class="input-block-level" placeholder="Nom" value="<?php echo $user->nom; ?>" required>
    <input type="text" id="prenom" id="prenom" class="input-block-level" placeholder="Prénom" value="<?php echo $user->prenom; ?>" required>
    <input type="email" id="reg_email" id="email" class="input-block-level" placeholder="Email" value="<?php echo $user->email; ?>" required>
    <input type="password" id="reg_password" id="password" class="input-block-level" placeholder="********">

    <?php echo form_dropdown('profession', config_item('metiers'), array($user->profession), 'id="profession"'); ?>


    <select name="interets" id="interets" multiple="multiple">
        <?php foreach($categories_principales as $categorie_principale): ?>
            <optgroup label="<?php echo $categorie_principale->nom; ?>">
                <?php foreach($categorie_principale->enfants as $categorie_enfant): ?>
                    <option value="<?php echo $categorie_enfant->id; ?>" <?php if(in_array($categorie_enfant->id, $user->categories)) echo 'selected';?>><?php echo $categorie_enfant->nom; ?></option>
                <?php endforeach; ?>
            </optgroup>
        <?php endforeach; ?>
    </select>

    <input name="rpps" type="text" id="rpps" class="input-block-level" placeholder="Numéro RPPS*" value="N° RPPS : <?php echo $user->numero_rpps; ?>" disabled>


    <span class="help-block">* ou bien j'envoie une preuve de ma fonction de professionnel de santé ou d'étudiant en santé (carte professionnelle, carte d'étudiant(e), diplôme, ordonnance barrée,...) par email à identification@medappcare.com dans les 1 mois. Ce document peut être scanné ou pris en photo par votre smartphone.</span>


    <button class="btn btn-primary" type="submit">Enregistrer</button>
</form>