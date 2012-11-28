
(function ($) {
  // All your code here
	// top head section
	$('#topnav > ul > li').mouseover(function(){
	    $(this).addClass('over').find('div.catelist').show();
	}).mouseout(function(){
	    $(this).removeClass('over').find('div.catelist').hide();
	});
	
	$('div.content h3:not([name="has"])').hover(function(){
		$(this).parents('.content').siblings('.popup').show();
	}, function(){
		$(this).parents('.content').siblings('.popup').hide();
	});
	
	$('a.linkdot').hover(function(){
		$(this).siblings('.popup').show();
	}, function(){
		$(this).siblings('.popup').hide();
	});
	
	
	// slideshow page 
	if(($sp =$('div.slidebox'))[0]){
		var $wrap	  = $sp.find('div.slidecontent');
		var $unit	  = $wrap.find('li');		
		var pageNum   = $unit.length;
		if (pageNum > 1) {
			var page	  	= 1;
			var psize	  	= 5;
			var animateTime = 500;
			var timeout     = 1;
			var fadeIntime  = 400;
			var clickTimeout= 50;
			
			var slideWidth	= 122;
			var $prev		= $wrap.siblings('div.prev');
			var $next	  	= $wrap.siblings('div.next');
			
			var $normal	  	= $unit.children('a');
			
			var $mainPictrue	= $sp.children('div.productcontent[name="main"]').children('div.imgbox').children('a');
			
			var $prevtop	= $sp.children('div.slidebut').children("a.prevnone");
			var $nexttop	= $sp.children('div.slidebut').children("a.next");
			
			var prevFunction=function(){
				var $currentSelectedLi = $sp.find('li a.selected').parent('li');
				
				var selectOption = $currentSelectedLi.children().attr('name');
				
				if(selectOption == 'main'){ 
					return false;
                }
				
				var $currentSelectedDiv = $sp.find('div.productcontent:visible');
				
				if (selectOption == pageNum-1 ) {
					$nexttop.attr('class','next');
				}
				//$prevtop.attr('class','prev');
				//$nexttop.attr('class','next');
				
				
				$nexttop.attr('href','#slide-'+selectOption+'');
				$next.children('a').attr('href','#slide-'+selectOption+'');

				if(selectOption == 1){
					$prevtop.attr('class','prevnone');
				}
				if(!$wrap.children('ul').is(":animated")){
	               if((selectOption) % psize == 0 && selectOption != 1){
						$wrap.children('ul').animate({ 'marginLeft' : '+='+slideWidth*psize}, animateTime);
	                }
	            }
				
				$currentSelectedLi.children().attr('class','normal');
				$currentSelectedLi.prev().children('a').attr('class','selected');

				if (selectOption != 1 && selectOption != 2) {
					window.setTimeout(function(){
						$prevtop.attr('href', '#slide-' + (parseInt(selectOption) - 2) + '');
						$prev.children('a').attr('href', '#slide-' + (parseInt(selectOption) - 2) + '');
						
					}, timeout);
				}else{
					$prevtop.attr('href', '#');
					$prev.children('a').attr('href', '#');
				}
				
				$currentSelectedDiv.hide().prev().fadeIn(fadeIntime);
			}
			
			var nextFunction=function(){
				var $currentSelectedLi = $sp.find('li a.selected').parent('li');
				
				var selectOption = $currentSelectedLi.children().attr('name');
				
				if(selectOption == pageNum-1){ 
					return false;
                }
				
				var $currentSelectedDiv=$sp.find('div.productcontent:visible');
				
				//$prevtop.attr('class','prev');
				//$nexttop.attr('class','next');
				if (selectOption == 'main') {
					$prevtop.attr('class','prev');
				}
				
				if (selectOption != 'main' && !isNaN(selectOption)) {
					$prevtop.attr('href','#slide-'+selectOption+'');
					$prev.children('a').attr('href','#slide-'+selectOption+'');
				}
				
				
				if(selectOption == pageNum-2){
					$nexttop.attr('class','nextnone');
				}
				
				if (!$wrap.children('ul').is(":animated")) {
					if((parseInt(selectOption) + 1) % psize ==0){
						$wrap.children('ul').animate({ 'marginLeft' : '-='+slideWidth*psize}, animateTime); 
					}
				}
				
				$currentSelectedLi.children().attr('class','normal');
				$currentSelectedLi.next().children('a').attr('class','selected');
				if (selectOption != 'main' && !isNaN(selectOption)) {
					if((parseInt(selectOption)+2) < 0 || (parseInt(selectOption)+2) > pageNum-1){
						selectOption = pageNum-3;
					}
					
					window.setTimeout(function(){
						$nexttop.attr('href','#slide-'+(parseInt(selectOption)+2)+'');
						$next.children('a').attr('href','#slide-'+(parseInt(selectOption)+2)+'');
					},timeout);
				}else{
					window.setTimeout(function(){
						$nexttop.attr('href','#slide-2');
						$next.children('a').attr('href','#slide-2');
					},timeout);
				}
				
				
				$currentSelectedDiv.hide().next().fadeIn(fadeIntime);
			}
			
			$prevtop.click(function(){
				window.setTimeout(function(){
					prevFunction();
				},clickTimeout);
			});
			
			$prev.click(function(){
				window.setTimeout(function(){
					prevFunction();
				},clickTimeout);
			});
			
			$next.click(function(){
				window.setTimeout(function(){
					nextFunction();
				},clickTimeout);
			});
			
			$nexttop.click(function(){
				window.setTimeout(function(){
					nextFunction();
				},clickTimeout);
			});
			
			$mainPictrue.click(function(){
				window.setTimeout(function(){
					nextFunction();
				},clickTimeout);
			});
			
			$normal.click(function(){
				var $currentSelectedLi=$sp.find('li a.selected').parent('li');
				
				var selectOption=$(this).attr('name');
				
				var $currentSelectedDiv=$sp.find('div.productcontent:visible');
				
				//$prevtop.attr('class','prev');
				//$nexttop.attr('class','next');
				
				if(selectOption != 'main'){
					$prevtop.attr('class','prev');
				}else{
					$prevtop.attr('class','prevnone');
				}
				if(selectOption == pageNum-1){
					$nexttop.attr('class','nextnone');
				}else{
					$nexttop.attr('class','next');
				}
				
				$currentSelectedLi.children().attr('class','normal');
				$(this).attr('class','selected');
				
				$currentSelectedDiv.hide();
				$sp.find('div.productcontent[name="'+selectOption+'"]').fadeIn(fadeIntime);
				
				
				if(selectOption != 1 && selectOption != 'main'){
					$prevtop.attr('href','#slide-'+(parseInt(selectOption)-1)+'');
					$prev.children('a').attr('href','#slide-'+(parseInt(selectOption)-1)+'');
				}
				
				if((parseInt(selectOption)+1) >= pageNum-1){
					selectOption = pageNum-2;
				}
				$nexttop.attr('href','#slide-'+(parseInt(selectOption)+1)+'');
				$next.children('a').attr('href','#slide-'+(parseInt(selectOption)+1)+'');
			});
			
			var urlparams=location.hash.toLowerCase();
			
			if(urlparams){
				var urlparam = new Array();
				urlparam = urlparams.split('#slide-');
				var selectIndex = urlparam['1'];
				if(selectIndex && !isNaN(selectIndex)){
					if(selectIndex < 1 || selectIndex > pageNum-1){
						return false;
					}
					if(selectIndex >= psize){
						if(!$wrap.children('ul').is(":animated")){
							$wrap.children('ul').animate({ 'marginLeft' : '-='+slideWidth*psize}, animateTime);
			            }
					}
					$('[name='+selectIndex+']').click();
				}
			}
		}
	}
	
	// invoke random captcha image
	$('div.postalert a.changecode').click(function(){
		$img = $('div.postalert img');
		$img.attr('src', $img.attr('src')+'?'+Math.random());
		return false;
	});
	// when click the post button
	$('div.postcomment input.post').click(function(){
		// check visitor name
		$visitor = $.trim($('#comment_visitor').val());
		if ($visitor=="") {
			alert("Please input your name!");
			return false;
		}
		
		// check email
		$email = $.trim($('#comment_email').val());
		if ($email=="") {
			alert("Please input your email!");
			return false;
		}
		// email regex
		email_regex = /^[\w\-_\.]+@[\w\-_.]+\.\w+$/i;
		if (!email_regex.test($email)) {
			alert("Please input a valid email!");
			return false;
		}
		// check content
		$content = $.trim($('#comment_content').val());
		if ($content=="" || $content=="Enter your comment here...(max: 2,000 characters)") {
			alert("Please input your comment!");
			return false;
		}
		// do not longer than 2000
		if ($content.length > 2000) {
			alert("Your comment is too long!");
			return false;
		}
		$('div.postalert').show();
	});
	
	$('#comment_content').focus(function(){
		if ( $.trim($(this).val()) == "Enter your comment here...(max: 2,000 characters)" ) {			
			$(this).val('');
		}
	});
	
	// close captchca popup
	$('div.close > #aclose').click(function(){
		$('div.postalert').hide();
		$('div.postalert a.changecode').click();
	});
	
	$('#security').click(function(){
		// aysnc check captacha code 
		$.post('/async_captcha_getcode.php', {}, function(text){
			$code = $('#captcha').val();
			// incorrect captcha code 
			if ($code != text) {
				alert("Incorrect security code!");
			} else {
				$page = $.trim($('#comment_page').val());
				$visitor = $.trim($('#comment_visitor').val());
				$email = $.trim($('#comment_email').val());
				$content = $.trim($('#comment_content').val());
				data = {'page':$page, 'name':$visitor, 'email':$email, 'comment':$content};
				// async post 
				$.post('/async_post_comment.php', data, function(text){
					if (text=="OK") {
						alert("Comment submitted successfully!");
						$('div.postalert').hide();
						$('#comment_visitor').val('');
						$('#comment_email').val('');
						$('#comment_content').val('');
						$('#captcha').val('');
						$('div.postalert a.changecode').click();
					} else {
						alert("Comment failed!");
						$('#captcha').val('');
					}
				}, 'text');
			}
		}, 'text');
	});
	
	// you might also like section 
	if(($mightalsolikesp =$('div.relatedguide'))[0]){
		var $wrap	  = $mightalsolikesp.find('div.content>ul');
		var $unit	  = $wrap.find('li');		
		var pageNum   = $unit.length;	
		if (pageNum > 1) {
			var page	  	= 1;
			var psize	  	= 4;
			var slideWidth	= $unit.first().width()+25;
			
			var prev_none = 'prevnone';
			var prev = 'prev';
			var next_none = 'nextnone';
			var next = 'next';
			
			var $prevtop	= $mightalsolikesp.children('div.slidebut').children("a.prevnone");
			var $nexttop	= $mightalsolikesp.children('div.slidebut').children("a.next");
			
			$prevtop.click(function(){
				if(!$wrap.is(":animated")){
	               if (page == 1) {
					   $prevtop.attr('class',prev_none);
	            	   return false;
	                } else {
						$wrap.animate({ 'marginLeft' : '+='+slideWidth*psize}, 500);
						--page;
						$nexttop.attr('class',next);
						if(page == 1){
							$prevtop.attr('class',prev_none);
						}
	                }
	            }
			});
			
			$nexttop.click(function(){
				if (!$wrap.is(":animated")) {
					if(pageNum < page){
						$nexttop.attr('class',next_none);
						return false;
					}
					if(page*psize >= pageNum){ 
						$nexttop.attr('class',next_none);
						return false;
	                } else {
						$wrap.animate({ 'marginLeft' : '-='+slideWidth*psize}, 500); 
						++page;
						$prevtop.attr('class',prev);
						if(page*psize >= pageNum){
							$nexttop.attr('class',next_none);
						}
					}
				}
			});			
		}
	}

})(jQuery);
