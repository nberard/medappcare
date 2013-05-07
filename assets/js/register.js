$(document).ready(function(){
    $('#form-signup').submit(function()
    {
//        console.dir($('#email').val());
//        console.dir($('#password').val());
//        console.dir($('#date_naissance').val());
//        console.dir($('#sexe').val());
//        console.dir($('#country').val());
//        console.dir($('#interets').val());
//        console.dir(plateformeIds);
//        console.dir($('#cgu').is(':checked'));
//        console.dir($('#cgv').is(':checked'));
        var plateformes = [];
        for(var i=0; i<plateformeIds.length; i++)
        {
            if(plateformeIds[i] && plateformeIds[i] != "undefined" && plateformeIds[i] == true)
            {
                plateformes.push(i);
            }
        }
//        console.dir(plateformes);
//        return false;
        $.ajax({
            type: 		"POST",
            url:  		$('#form-signup').attr('data-action'),
            dataType: 'json',
            contentType: 'application/json',
            data:
                JSON.stringify({
                    pro : 0,
                    email : $('#email').val(),
                    password : $('#password').val(),
                    date_naissance : $('#date_naissance').val(),
                    sexe : $('#sexe').val(),
                    country : $('#country').val(),
                    interets : $('#interets').val(),
                    plateformes : plateformes,
                    cgu : $('#cgu').is(':checked') ? 1 : 0,
                    cgv : $('#cgv').is(':checked') ? 1 : 0
                }),
            success: function(data, textStatus, xhr)
            {
                alert('ok');
//                window.location.reload();
            },
            error: function(xhr, textStatus, error)
            {
                if(xhr.responseJSON.message)
                {
                    $('#reg-error').text(xhr.responseJSON.message).show();
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