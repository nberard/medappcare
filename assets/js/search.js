$(document).ready(function()
{
    function refreshSearch()
    {
        var target = window.location.origin+window.location.pathname;
        var params = '', prixTab = [], devicesTab = [];
        var sortTab = $('#sort').val().split('|');
        $('#filters option:selected').each(function()
        {
            var parent = $(this).parent()[0].id;
            if(parent == 'prix')
            {
                prixTab.push($(this).val());
            }
            else if(parent == 'devices')
            {
                devicesTab.push($(this).val());
            }
        });
//        console.dir(prixTab);
//        console.dir(devicesTab);
//        console.dir(sortTab);
        params+= '?sort='+sortTab[0]+'&order='+sortTab[1];
        if(prixTab.length == 1)
        {
            params+= '&free='+(prixTab[0] == 'true' ? 1 : 0);
        }
        if(devicesTab.length > 0)
        {
            params+='&devices='+devicesTab.join(',');
        }
//        console.dir(target+params);
//        console.dir(params);
//        console.dir(target+params);
        window.location = target+params;
    }
    $('#sort-filter').submit(function()
    {
        refreshSearch();
        return false;
    });
});
