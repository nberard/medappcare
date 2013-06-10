function handleNotation(type)
{
    if($('#form-noter-'+type).length)
    {
        $('#form-noter-'+type).submit(function()
        {
            var data = {commentaire: encodeURIComponent($('#commentaire-'+type).val())}
            var criteres = $(this).data('criteres');
            var nb_criteres = criteres.length;
            if($('#'+type+'-notation-pro').length)
            {
                data.pro = $('#'+type+'-notation-pro').val();
            }
            for(var i=0; i<nb_criteres; i++)
            {
                data['note'+criteres[i].id] = $('#note-'+type+'-'+criteres[i].id).val();
            }
            $.ajax({
                type: 		"POST",
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
                    $('#'+type+'-notation-error').empty();
                    $('#'+type+'-notation-success').empty().html(xhr.responseJSON.message).show();
                    setTimeout(function(){
                        $('#modal-notation-close').click();
                    }, 2000);
                },
                error: function(xhr, textStatus, error)
                {
                    if(xhr.responseJSON.errors)
                    {
                        $('#'+type+'-notation-error').empty().html(xhr.responseJSON.errors).show();
                        return false;
                    }
                }
            });
            return false;
        });
    }

    function loadNotesAndComments(type, link, render)
    {
        if($('#'+type+'-notes-pro').length)
        {
            link+= '?pro='+$('#'+type+'-notes-pro').val();
        }
        $.ajax({
            type: 		"GET",
            url:  		link,
            headers: {
                Accept : render,
                "Content-Type": render
            },
            success: function(data, textStatus, xhr)
            {
                $('#'+type+'-notes-browser').replaceWith(data);
                handleNotation(type);
            },
            error: function(xhr, textStatus, error)
            {

            }
        });
    }
    if($('#'+type+'-comments-nextLink').data('link'))
    {
        $('#'+type+'-comments-nextLink').click(function()
        {
            loadNotesAndComments(type, $(this).data('link'), $(this).data('render'));
        });
    }
    if($('#'+type+'-comments-previousLink').data('link'))
    {
        $('#'+type+'-comments-previousLink').click(function()
        {
            loadNotesAndComments(type, $(this).data('link'), $(this).data('render'));
        });
    }
}

$(document).ready(function()
{
    handleNotation('accessoire');
    handleNotation('application');
});
