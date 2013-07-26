$(document).ready(function() {

    $('#form-membre-update').submit(function()
    {
        $.ajax({
            type: 		"PUT",
            url:  		$(this).data('action'),
            dataType: 'json',
            headers: {
                Accept : 'application/json',
                "Content-Type": 'application/json'
            },
            data:
                JSON.stringify({
                    pro : 1,
                    nom : $('#nom').val(),
                    prenom : $('#prenom').val(),
                    email : $('#upd_email').val(),
                    mot_de_passe : $('#upd_password').val(),
                    interets : $('#interets').val(),
                    profession : $('#profession').val()
                }),
            success: function(data, textStatus, xhr)
            {
                $('#update-success').empty().html(xhr.responseJSON.message).show();
                setTimeout(function(){
                    $('#update-success').hide('slow');
                }, 1000);
            },
            error: function(xhr, textStatus, error)
            {
                $('#update-error').empty().html(xhr.responseJSON.errors).show();
                setTimeout(function(){
                    $('#update-error').hide('slow');
                }, 1000);
            }
        });
        $('body').animate({scrollTop: 0}, 20);
        return false;
    });

    $('#form-signup').submit(function()
    {
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
                    pro : 1,
                    nom : $('#nom').val(),
                    prenom : $('#prenom').val(),
                    pseudo : $('#pseudo').val(),
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
        $('body').animate({scrollTop: 0}, 20);
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