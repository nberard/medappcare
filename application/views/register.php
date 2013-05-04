<?php echo $inc['header_meta']; ?>

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

    <?php echo $inc['header'] ; ?>

    <?php echo $inc['menuParticulier'] ; ?> <!-- Menu Particulier -->

</header>



<?php echo $contenu ; ?>

<?php echo $inc['footer'] ; ?>

<?php echo $inc['footer_meta'] ; ?> <!-- Appels JS & Autres -->

<?php foreach($js_files as $js_file): ?>
    <script src="<?php echo $js_file; ?>"></script>
<?php endforeach; ?>

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