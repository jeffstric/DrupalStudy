(function ($) {
    // All your code here
    // slideshow page 
    $(document).ready(function(){
	$('a.linkdot').hover(function(){
	    $(this).siblings('.popup').show();
	}, function(){
	    $(this).siblings('.popup').hide();
	});	
    })
})(jQuery);