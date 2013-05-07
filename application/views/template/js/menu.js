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
	$('#header > nav li.search a').click(function(event) {
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
	
	$('.modal').on('shown', function() {
		$(this).children('.modal-body').children('form').children('p:nth-child(1)').children('input').focus();
	});
	
	
	/* Device tabs */
	
	$('#deviceTabs nav li').click(function() {
		if (!$(this).hasClass('selected')) {
			$('#deviceTabs nav li.selected').removeClass('selected');
			$(this).addClass('selected');
			
			var destination = $('#deviceTabs .tabContent#'+$(this).attr('data-destination'));
		
			var previouslyOpened = $('#deviceTabs .tabContent.open');
			previouslyOpened.removeClass('open');
			destination.addClass('open');
			
			previouslyOpened.stop().fadeOut('fast', function() {
				
				destination.stop().fadeIn('fast');
			});
			
		}
	})
	
});

// this is a separate function that runs when the close button is clicked
// If anyone has a more efficient way to do this, I'm all ears
