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
        
        <input type="email" id="email" class="input-block-level" placeholder="Email" required>
        <input type="password" id="password" class="input-block-level" placeholder="Mot de passe" required>
               
        <input type="text" class="input-block-level"  placeholder="Date de naissance" data-date-format="dd/mm/yyyy" data-date-viewmode="years" id="ddn" autocomplete="off" required>
        

        <div class="well"> Sexe<br><br>
	        <div class="btn-group" data-toggle="buttons-radio" >		
			  <button type="button" class="btn" data-toggle="button" id="homme">Homme</button>
			  <button type="button" class="btn" data-toggle="button" id="femme">Femme</button>
			  <button type="button" class="btn" data-toggle="button" id="autre">Autre</button>
			  <input type="hidden" name="sexe" id="sexe" value="" required>
			</div>
        </div>
		
		<input type="text" class="input-block-level" placeholder="Pays" data-provide="typeahead" data-items="4" data-source='["Allemagne","France","Italie","Finlande","Belgique"]' autocomplete="off" required>

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
	    
			
		<div class="well"> Device (plusieurs choix possibles)<br><br>
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