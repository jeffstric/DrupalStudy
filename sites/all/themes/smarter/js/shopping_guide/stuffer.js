(function ($) {
    // All your code here
    // slideshow page 
    $(document).ready(function(){
	$('div.content h3:not([name="has"])').hover(function(){
	    $(this).parents('.content').siblings('.popup').show();
	}, function(){
	    $(this).parents('.content').siblings('.popup').hide();
	});	
    })
})(jQuery);