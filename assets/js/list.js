$(document).ready(function(){
    function populateList(that)
    {
        $.ajax({
            type: 		"GET",
            url:  		$('#'+that.data('ref')).data('action')+'?links=1&template='+$('#'+that.data('ref')).data('template')+'&'+that.data('params'),
            headers: {
                Accept : $('#'+that.data('ref')).data('render'),
                "Content-Type": $('#'+that.data('ref')).data('render')
            },
            success: function(data, textStatus, xhr)
            {
                if(xhr.status != 204)
                {
                    $('#'+that.data('ref')).replaceWith(data);
                    $('.filter a').click(function()
                    {
                        populateList($(this));
                    });
                }
                else
                {

                }
            },
            error: function(xhr, textStatus, error)
            {

            }
        });
        return false;
    }
    $('.filter a').click(function()
    {
        populateList($(this));
    });
});