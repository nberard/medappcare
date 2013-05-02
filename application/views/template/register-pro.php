<?php include ('inc/header_meta.php') ; ?>

<style>

	/* FORM */
	.form-signin {
		max-width: 500px;
		padding: 19px 39px 39px;
		margin: 20px auto 20px;
		background-color: #fff;
		border: 1px solid #e5e5e5;
		-webkit-border-radius: 5px;
		   -moz-border-radius: 5px;
		        border-radius: 5px;
		-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
		   -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
		        box-shadow: 0 1px 2px rgba(0,0,0,.05);
	}
	.form-signin .form-signin-heading,
	.form-signin .checkbox {
		margin-bottom: 10px;
	}
	.form-signin input[type="text"],
	.form-signin input[type="email"],
	.form-signin input[type="password"],
	.form-signin input[type="date"] {
		font-size: 16px;
		height: auto;
		margin-bottom: 15px;
		padding: 7px 9px;
	}
	.btn-group{margin-bottom: 15px;}
	button{margin-right: 15px;}

	/* SELECT */
	.multiselect {
		text-align: left;
	}
	.multiselect b.caret {
		float: right;
	}
	.multiselect-group {
		font-weight: bold;
		text-decoration: underline;
	}


</style>

<body class="signin particuliers">

    <header id="header">
    
        <?php include ('inc/header.php') ; ?>
        
        <?php include ('inc/menuParticulier.php') ; ?> <!-- Menu Particulier -->
        
    </header>
    
    			
      <form class="form-signin" method="get" >
        <h1 class="form-signin-heading">Inscription grand public</h1>
        
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


    <?php include ('inc/footer.php') ; ?>

    <?php include ('inc/footer_meta.php') ; ?> <!-- Appels JS & Autres -->
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/bootstrap-multiselect.js"></script>
    
    <script>
    	//$('.typeahead').typeahead();
    	// Datepicker
    	$('#ddn').datepicker();  

    	// Boutons radios
		$('div.btn-group button').click(function(){		
		    $("#sexe").attr('value', $(this).attr('id'));		
		})

		// Multi Slect (FR)
		$(document).ready(function() {
		    $('#profession').multiselect({
		        buttonWidth: '500px', // Default
		    });
		
		
			$('#interets').multiselect({
		        buttonWidth: '500px', // Default
		        buttonText: function(options, select) {
		            if (options.length == 0) {
		                return 'Mes centres d\'interêts <b class="caret"></b>';
		            }
		            else if (options.length > 3) {
		                return options.length + ' sélections <b class="caret"></b>';
		            }
		            else {
		                var selected = '';
		                options.each(function() {
		                    selected += $(this).text() + ', ';
		                });
		                return selected.substr(0, selected.length -2) + ' <b class="caret"></b>';
		            }
		        },
		    });
	    });
	</script>
    
</body>
</html>