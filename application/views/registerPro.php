<?php echo $inc['header_meta']; ?>

<body class="signup lespros">

<header id="header">

    <?php echo $inc['header'] ; ?>

    <?php echo $inc['menuMedecin'] ; ?> <!-- Menu Particulier -->

</header>



<?php echo $contenu ; ?>

<?php echo $inc['footer'] ; ?>

<!-- Appels JS & Autres -->
<?php echo $inc['footer_meta'] ; ?> 

<?php foreach($js_files as $js_file): ?>
    <script src="<?php echo $js_file; ?>"></script>
<?php endforeach; ?>

<script>
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
    
    // Check form validity (fallback pour Safari qui ne gère pas required)
    if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
    	$("form").submit(function(e){});
    }
</script>

</body>
</html>