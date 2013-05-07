$(document).ready(function(){
    $('#reg_form').submit(function()
    {
        $.ajax({
            type: 		"POST",
            url:  		$('#form-signup').attr('data-action'),
            dataType: 'json',
            contentType: 'application/json',
            data:
                JSON.stringify({
                    session : 1,
                    email : $('#email').val(),
                    password : $('#password').val()
                }),
            success: function(data, textStatus, xhr)
            {
                window.location.reload();
            },
            error: function(xhr, textStatus, error)
            {
                if(xhr.responseJSON.message)
                {
                    $('#login-error').text(xhr.responseJSON.message).show(); // On peut le mettre en display block au lieu de inline et ajouter un margin 0 svp ?
                    return false;
                }
            }
        });
        return false;
    });

    // Datepicker
    $('#ddn').datepicker();

    // Boutons radios
    $('#plateforme-group button').click(function(){
        if(plateformeIds[$(this).attr('value')])
            plateformeIds[$(this).attr('value')] = false;
        else plateformeIds[$(this).attr('value')] = true;
    });

    // Boutons radios
    $('#sexe-group button').click(function(){
        $("#sexe").attr('value', $(this).attr('value'));
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
        }
    });
    // Check form validity (fallback pour Safari qui ne gère pas required)
    if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
        $("form").submit(function(e){});
    }
});