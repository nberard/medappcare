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
});