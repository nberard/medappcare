$(document).ready(function() {

    $('#form-signup').submit(function()
    {
        $.ajax({
            type: 		"POST",
            url:  		$('#form-signup').data('action'),
            dataType: 'json',
            contentType: 'application/json',
            data:
                JSON.stringify({
                    pro : 1,
                    nom : $('#nom').val(),
                    prenom : $('#prenom').val(),
                    email : $('#reg_email').val(),
                    mot_de_passe : $('#reg_password').val(),
                    interets : $('#interets').val(),
                    profession : $('#profession').val(),
                    cgu_valid : $('#cgu').is(':checked') ? 1 : 0,
                    numero_rpps : $('#rpps').val()
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

    $('#profession').multiselect({
        buttonWidth: '500px' // Default
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