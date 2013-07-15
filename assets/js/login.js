$(document).ready(function(){
    function login(pro)
    {
        var url = pro ? $('#login_form_pro').data('action') : $('#login_form').data('action');
        var suffixe = pro ? '-pro' : '';
        $.ajax({
            type: 		"POST",
            url:  		url,
            dataType: 'json',
            contentType: 'application/json',
            data:
                JSON.stringify({
                    session : 1,
                    email : $('#email'+suffixe).val(),
                    password : $('#password'+suffixe).val()
                }),
            success: function(data, textStatus, xhr)
            {
                if(data.redirect)
                {
                    window.location = data.redirect;
                }
                else
                {
                    window.location.reload();
                }
            },
            error: function(xhr, textStatus, error)
            {
                if(xhr.responseJSON.message)
                {
                    $('#login-error'+suffixe).text(xhr.responseJSON.message).show();
                    return false;
                }
            }
        });
    }

    $('#login_form').submit(function()
    {
        login(false);
        return false;
    });

    $('#login_form_pro').submit(function()
    {
        login(true);
        return false;
    });

    $('#lost_password_form').submit(function(){
        console.debug('ok');
        $.ajax({
            type: 		"PUT",
            url:  		$(this).data('action'),
            dataType: 'json',
            contentType: 'application/json',
            data:
                JSON.stringify({
                    email : $('#lost-password-email').val()
                }),
            success: function(data, textStatus, xhr)
            {
                console.dir(data);
            },
            error: function(xhr, textStatus, error)
            {

            }
        });
        return false;
    })
});