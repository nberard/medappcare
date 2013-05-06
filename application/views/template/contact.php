<?php include ('inc/header_meta.php') ; ?>

<style>
	/* FORM */
	.form-signin {
		max-width: 500px;
		padding: 19px 39px 39px;
		margin: 20px auto 20px;
		background-color: #fff;
		border: 1px solid #e5e5e5;
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
		width: 458px;
	}

	.well{
		padding: 10px 15px 0;
	}
	
	.well label {
		font-size: 16px;
		color: #999999;
	}

</style>

<body class="signin particuliers">

    <header id="header">
    
        <?php include ('inc/header.php') ; ?>
        
        <?php include ('inc/menuParticulier.php') ; ?> <!-- Menu Particulier -->
        
    </header>
    
    			
      <form class="form-signin" method="get" >
        <h2 class="form-signin-heading">Contact</h2>
        
        <input type="email" id="email" class="input-block-level" placeholder="Email" required>
        <input type="email" id="password" class="input-block-level" placeholder="Sujet" required>
		
		<textarea class="input-block-level" placeholder="Message" required></textarea>

        <button class="btn btn-primary" type="submit">Envoyer mon message</button>

      </form>		


    <?php include ('inc/footer.php') ; ?>

    <?php include ('inc/footer_meta.php') ; ?> <!-- Appels JS & Autres -->
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