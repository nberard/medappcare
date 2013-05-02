// Some of the following variables can be changed depending on the specs you use
var speed = 1200; // speed of the sliding animation
var ext = ".php"; // file extension for the ajax files
var pages = "";
var urlString = "";
var downArrow = ""; // this is the downward-pointing arrow next to each menu link
var upArrow = ""; // ditto for up, when the menu item is selected
var dir = "inc/menu"; // this is the name of the directory that holds your ajax files; if files are in root, just make this blank

$(document).ready(function(){

	var navLinks = $("li.megamenu > a");
	var navLinksActiveSpan = $("li.megamenu>a.active p");
	var dropDown = $("#dropdown");
	// the loop below creates the string of classes each named after a menu's ajax page
	// these classes are used to identify which menu is currenly open
	/*for (var i = 0, j = navLinks.length; i < j; i++) {
		urlString = navLinks[i].href.split("/");
		urlString = urlString[urlString.length-1].replace(ext, "");
		pages = pages + " " + urlString;
	}
	var currHash = document.location.hash.replace("#","");
	var removeLoading = function() {
		dropDown.removeClass("loading"); // remove the "loading" graphic
	};
	var addLoading = function() {
		dropDown.addClass("loading"); // add the "loading" graphic
	};
	// the "close" link is injected with JS; we don't want non-JS users to see it anyhow
	var closeLinkString = "";
	var addCloseLink = function() {
		dropDown.append(closeLinkString);
	};

	navLinks.append(downArrow); // the down-pointing arrows are appended to each link with JS; they shouldn't appear to non-JS users
	
	// open the appropriate drop-down menu if a hash is present in the URL
	if (currHash) {
		dropDown.slideDown(speed, function() {
			// callback after slideDown is complete
			for (var i = 0, j = navLinks.length; i < j; i++) {
				if (navLinks[i].href.toString().indexOf(currHash) != -1) {
					navLinks[i].className = "active";
					dropDown.addClass("open " + currHash);
				}
			}
			// a timestamp is appended to the ajax-loaded file, to ensure no caching; you can remove this if you don't mind the files cached
			dropDown.load(dir+"/"+currHash.replace("#","")+ext+"?"+new Date().getTime(), function() {
				// callback after ajax call is complete
				navLinksActiveSpan.html(upArrow);
				addCloseLink();
				removeLoading();
			});
		});
	}*/
	
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
	
});

// this is a separate function that runs when the close button is clicked
// If anyone has a more efficient way to do this, I'm all ears
