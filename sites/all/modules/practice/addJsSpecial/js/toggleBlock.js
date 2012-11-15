/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
	Drupal.behaviors.toggleBlock = {
	    attach:function(){
		$('.close_block').click(function(O){
		    $('#'+$(this).attr('target')).toggle("slow");
		});
	    }
	}
})(jQuery);


