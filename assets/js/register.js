$(document).ready(function(){
    $('#form-signup').submit(function()
    {
        var plateformes = [];
        for(var i=0; i<plateformeIds.length; i++)
        {
            if(plateformeIds[i] && plateformeIds[i] != "undefined" && plateformeIds[i] == true)
            {
                plateformes.push(i);
            }
        }
        $.ajax({
            type: 		"POST",
            url:  		$('#form-signup').data('action'),
            dataType: 'json',
            headers: {
                Accept : 'application/json',
                "Content-Type": 'application/json'
            },
            data:
                JSON.stringify({
                    pro : 0,
                    email : $('#reg_email').val(),
                    mot_de_passe : $('#reg_password').val(),
                    date_naissance : $('#date_naissance').val(),
                    sexe : $('#sexe').val(),
                    pays : $('#country').val(),
                    interets : $('#interets').val(),
                    plateformes : plateformes,
                    cgu_valid : $('#cgu').is(':checked') ? 1 : 0,
                    cgv_valid : $('#cgv').is(':checked') ? 1 : 0
                }),
            success: function(data, textStatus, xhr)
            {
                $('#form-signup').empty().html('<div id="reg-sucess" class="alert alert-success">'+xhr.responseJSON.message+'</div>');
                setTimeout(function(){
                    $('#reg-sucess').hide('slow');
                    window.location = xhr.responseJSON.redirect;
                }, 2000);
            },
            error: function(xhr, textStatus, error)
            {
                if(xhr.responseJSON.errors)
                {
                    $('#reg-error').empty().html(xhr.responseJSON.errors).show();
                    return false;
                }
            }
        });
        return false;
    });

    // Datepicker
    $('#date_naissance').datepicker();

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