$(document).ready(function(){

    $('#form-noter-accessoire').submit(function()
    {
        var data = {commentaire: encodeURIComponent($('#commentaire-accessoire').val())}
        var criteres = $(this).data('criteres');
        var nb_criteres = criteres.length;
        for(var i=0; i<nb_criteres; i++)
        {
            data['note'+criteres[i].id] = $('#note-accessoire-'+criteres[i].id).val();
        }
        $.ajax({
            type: 		"PUT",
            url:  		$(this).data('action'),
            dataType: 'json',
            headers: {
                Accept : 'application/json',
                "Content-Type": 'application/json'
            },
            data:
                JSON.stringify(data),
            success: function(data, textStatus, xhr)
            {
                $('#accessoire-notation-error').empty();
                $('#accessoire-notation-success').empty().html(xhr.responseJSON.message).show();
                setTimeout(function(){
                    $('#modal-notation-close').click();
                }, 2000);
            },
            error: function(xhr, textStatus, error)
            {
                if(xhr.responseJSON.errors)
                {
                    $('#accessoire-notation-error').empty().html(xhr.responseJSON.errors).show();
                    return false;
                }
            }
        });
        return false;
    });
});