$(document).ready(function()
{
    $('#search-form').submit(function(){
        if($('#search-query').val() != '')
        {
            $(this).attr('action', $(this).attr('action')+'?term='+encodeURIComponent($('#search-query').val()));
            return true;
        }
        else
        {
            return false;
        }
    });
});