(function ($) {
    // All your code here
    $('div.featurebanner > div.content').hover(function(){
	if (!$('#featurepopup').is(':animated')) {
	    $('#featurepopup').animate({
		height:198
	    }, 500);
	    blogResize($('div.blogitem:eq(0)'));
	}
    }, function(){
	if (!$('#featurepopup').is(':animated')) {
	    $('#featurepopup').animate({
		height:48
	    }, 500);
	}
    });
    $('div.featureChange > a.prev').click(function(){
	var item = $('div.blogitem:visible');
	if ($('div.blogitem:first').is(':hidden')) {
	    var prev = item.prev(); 
	    setTimeout(function(){
		prev.show();
		blogResize(prev);
		item.hide();
	    },200);
	}
	if ($('div.blogitem:first').is(':visible')) {
	    $(this).addClass('prevNo');
	} else {
	    $(this).removeClass('prevNo');
	}
	$('div.featureChange > a.next').removeClass('nextNo');
	return false;
    });
    $('div.featureChange > a.next').click(function(){
	var item = $('div.blogitem:visible');
	if ($('div.blogitem:last').is(':hidden')) {
	    var next = item.next();
	    setTimeout(function(){
		next.show();
		blogResize(next);
		item.hide();
	    },200);
	}
	if ($('div.blogitem:last').is(':visible')) {
	    $(this).addClass('nextNo');
	} else {
	    $(this).removeClass('nextNo');
	}
	$('div.featureChange > a.prev').removeClass('prevNo');
	return false;
    });
    $('div.featureChange > a.prev').addClass('prevNo');
})(jQuery);

//featureChange
//blogitem
//content
//featurebanner
//#featurepopup

