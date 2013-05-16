$(window).ready(function() {
	$('.flexslider').flexslider({
        animation: "fade",
        slideDirection: "horizontal",
        slideshow: true,
        slideshowSpeed: 12000,
        animationDuration: 700,
        directionNav: true,
        controlNav: false,
        keyboardNav: false,
        mousewheel: false,
        initDelay: 1000,
        pauseOnAction: true
	});
});

$(function() {
	$('input, textarea').placeholder();
	$('#filtres').multiselect({
        buttonWidth: '500px', // Default
        buttonText: function(options, select) {
            if (options.length == 0) {
                return 'Filtres ... <b class="caret"></b>';
            
            }
            else if (options.length > 3) {
                return options.length + ' filtres <b class="caret"></b>';
            }
            else {
                var selected = '';
                options.each(function() {
                    selected += $(this).text() + ', ';
                });
                return selected.substr(0, selected.length -2) + ' <b class="caret"></b>';
            }

        }
    });
    
    $('#filters').multiselect({
        buttonWidth: '230px', // Default
        buttonText: function(options, select) {
          	if (options.length == 0) {
                return 'Filtrer par... <b class="caret"></b>';
            
            }
            else if (options.length > 2) {
                return options.length + ' filtres <b class="caret"></b>';
            }
            else {
                var selected = '';
                options.each(function() {
                    selected += $(this).text() + ', ';
                });
                return 'Filtré par : ' + selected.substr(0, selected.length -2) + ' <b class="caret"></b>';
            }
        }
    });
    
    $('#sort').multiselect({
        buttonWidth: '160px', // Default
        buttonText: function(options, select) {
        	var selected = '';
                options.each(function() {
                    selected += $(this).text() + ' <b class="caret"></b>';
                });
                return selected;
        }
    });


});