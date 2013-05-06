$(document).ready(function(){
    $('#login_form').submit(function()
    {
        $.ajax({
            type: 		"POST",
            url:  		$('#login_form').attr('data-action'),
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
                    $('#login-error').text(xhr.responseJSON.message).show();
                    return false;
                }
            }
        });
        return false;
    });
});