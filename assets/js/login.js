$(document).ready(function(){
    $('#login_form').submit(function()
    {
        $.ajax({
            type: 		"POST",
            url:  		$('#login_form').attr('data-action'),
            dataType: 'json',
            data:
            JSON.stringify({
                email : $('#email').val(),
                password : $('#password').val()
            }),
            success: function(xhr)
            {
                if(xhr.status == 'ok')
                {
                    window.location.reload();
                }
                else
                {
                    $('#login-error').text(xhr.message).show(); // On peut le mettre en display block au lieu de inline et ajouter un margin 0 svp ?
                    return false;
                }
            }
        });
        return false;
    });
});