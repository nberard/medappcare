$(document).ready(function(){
    function populateList(that)
    {
        $.ajax({
            type: 		"GET",
            url:  		$('#listapps_topfive').data('action')+'?links=1&free='+that.data('free')+'&template='+$('#template-render').val(),
            headers: {
                Accept : $('#listapps_topfive').data('render'),
                "Content-Type": $('#listapps_topfive').data('render')
            },
            success: function(data, textStatus, xhr)
            {
                if(xhr.status != 204)
                {
                    $('#listapps_topfive').replaceWith(data);
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