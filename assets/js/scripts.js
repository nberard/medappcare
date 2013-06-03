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

    $('#typeSignaler').multiselect({
        buttonWidth: '500px'
    });

});

// Some of the following variables can be changed depending on the specs you use
var speed = 1200; // speed of the sliding animation
var ext = ".php"; // file extension for the ajax files
var pages = "";
var urlString = "";
var downArrow = ""; // this is the downward-pointing arrow next to each menu link
var upArrow = ""; // ditto for up, when the menu item is selected
var dir = "inc/menu"; // this is the name of the directory that holds your ajax files; if files are in root, just make this blank

$(document).ready(function() {
	
	/* Dropdown menu */
	
	var navLinks = $("li.megamenu > a");
	var navLinksActiveSpan = $("li.megamenu>a.active p");
	var dropDown = $("#dropdown");
	
	var openedDropdownMenu;
	var selectedMenuItem;
	
	function closeDropDown(){
		selectedMenuItem.removeClass('open');
		dropDown.slideUp('fast', function() {
			dropDown.children('nav').each(function() {
				$(this).hide();
			});
			dropDown.removeClass('open');
		});	
	}
	
	// this is the click handler that decides the primary open/close actions
	navLinks.click(function(){
		
		var clickedLink = $(this);
		
		var destination = clickedLink.attr('dropdownDestination');
		
		if (!dropDown.hasClass('open')) {
		
		
			selectedMenuItem = clickedLink;
			selectedMenuItem.addClass('open');
		
			openedDropdownMenu = dropDown.children('nav.'+destination);
			
			
			dropDown.addClass('open');
			
			
			openedDropdownMenu.show();
			dropDown.slideDown('fast');
			
		}
		
		else {
		
			if (clickedLink.hasClass('open')) {
				closeDropDown();
			} else {
				selectedMenuItem.removeClass('open');
				selectedMenuItem = clickedLink;
				selectedMenuItem.addClass('open');
				openedDropdownMenu.fadeOut('fast', function() {
					openedDropdownMenu = dropDown.children('nav.'+destination);
					openedDropdownMenu.fadeIn('fast');
				});		
			}
			
		}
		
	});
	
	/* Search Form */
	var searchForm = $('#header nav .search-form');
	$('#header > nav li.bt-search a').click(function(event) {
		event.stopPropagation();
		if (searchForm.css('display') == 'none') {
			searchForm.toggle("slide", { direction: "right" }, 'normal', 'easeOutCubic');
			searchForm.children('input').focus();
		} else {
			searchForm.submit();
		}
	});
	
	$('body').click(function(event){
		if (event.target != $('form.search-form input')[0]) {
			if (searchForm.css('display') != 'none') {
				
				console.log('prevendDefault');
				event.preventDefault();
				searchForm.toggle("slide", { direction: "right" }, 'normal', 'easeOutCubic');
			}
		}
	});
	
	/* Modal */
	
	var shouldDisplayLostPasswordModal = false;
	
	$('.modal').on('shown', function() {
		$(this).children('.modal-body').children('form').children('p:nth-child(1)').children('input').focus();
	});
	
	/* Lost password Modal */
	
	$('a[href="#lostPassword"]').click(function() {
		shouldDisplayLostPasswordModal = true;
		$('#connexionModal').modal('hide');
	});
	
	$('#connexionModal').on('hide', function() {
		if (shouldDisplayLostPasswordModal) {
			shouldDisplayLostPasswordModal = false;
			$('#lostPasswordModal').modal('show');
		}
	});
	
	$('#lostPasswordModal').on('shown', function() {
		$(this).children('.modal-body').children('form').children('p:nth-child(1)').children('input').focus();
	});
	
	/* Signaler une app Modal */
	
	var shouldDisplaySignalerModal = false;
	
	$('a[href="#signalerModal"]').click(function() {
		shouldDisplaySignalerModal = true;
		$('#signalerModal').modal('show');
	});
	
	$('#signalerModal').on('shown', function() {
		$(this).children('.modal-body').children('form').children('p:nth-child(1)').children('input').focus();
	});
	
	/* Commenter une app Modal */
	
	var shouldDisplayCommenterModal = false;
	
	$('a[href="#commentModal"]').click(function() {
		shouldDisplayCommentModal = true;
		$('#commentModal').modal('show');
	});
	
	$('#commentModal').on('shown', function() {
		$(this).children('.modal-body').children('form').children('p:nth-child(1)').children('input').focus();
	});
	
	
	/* App & Device tabs */
	
	$('#descTabs nav li').click(function() {
		if (!$(this).hasClass('selected')) {
			$('#descTabs nav li.selected').removeClass('selected');
			$(this).addClass('selected');
			
			var destination = $('#descTabs .tabContent#'+$(this).attr('data-destination'));
		
			var previouslyOpened = $('#descTabs .tabContent.open');
			previouslyOpened.removeClass('open');
			destination.addClass('open');
			
			previouslyOpened.stop().fadeOut('fast', function() {
				
				destination.stop().fadeIn('fast');
			});
			
		}
	});
	
	/* Close Menu */
	
	$('#dropdown a.closeLink').click(function() {
	    closeDropDown();
    });
	
	/* Racourcis des textes trop long ... */
	
	$('.short').ellipsis({live:true});
	
});

// this is a separate function that runs when the close button is clicked
// If anyone has a more efficient way to do this, I'm all ears


/* PAGINATION */

// Page App > commentaires
$('#pagination-app').bootpag({
    total: 23,
	maxVisible: 10,
	href: "#page-{{number}}"
}).on("page", function(event, /* page number here */ num){
     $("#list-comentaires").html("Page " + num); // some ajax content loading...
});

// Page Liste news 
//$('#pagination-news').bootpag({
//    total: 23,
//	maxVisible: 10,
//	href: "#page-{{number}}"
//}).on("page", function(event, /* page number here */ num){
//     $("#list-news").html("Page " + num); // some ajax content loading...
//});



/* SOCIAL SHARING */

/* Twitter */

!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");

/* Google Plus */
window.___gcfg = {lang: 'fr'};

(function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();

/* Facebook */
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=275708732454136";  // Modifier l'ID de la page
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

/* MOBILE MENU */

$(function() {
    $( '#dl-menu' ).dlmenu();
});











