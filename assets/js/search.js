$(document).ready(function()
{
    function refreshSearch()
    {
        var target = window.location.origin+window.location.pathname;
        var params = '', prixTab = [], devicesTab = [];
        var sortTab = $('#sort').val().split('|');
        var eval_medapp = false;
        $('#filters option:selected').each(function()
        {
            var parent = $(this).parent()[0].id;
            console.debug('parent='+parent);
            if(parent == 'prix')
            {
                prixTab.push($(this).val());
            }
            else if(parent == 'devices')
            {
                devicesTab.push($(this).val());
            }
            else if(parent == 'eval-medapp')
            {
                eval_medapp = true;
            }
        });
        params+= '?sort='+sortTab[0]+'&order='+sortTab[1];
        if(prixTab.length == 1)
        {
            params+= '&free='+(prixTab[0] == 'true' ? 1 : 0);
        }
        if(devicesTab.length > 0)
        {
            params+='&devices='+devicesTab.join(',');
        }
        if($('#search-query').val() != '')
        {
            params+='&term='+encodeURIComponent($('#search-query').val());
        }
        if(eval_medapp)
        {
            params+='&eval_medapp=1';
        }
        window.location = target+params;
    }
    $('#sort-filter').submit(function()
    {
        refreshSearch();
        return false;
    });

    if($('#search-term').length)
    {
        $('#search-query').val($('#search-term').val());
    }
});
