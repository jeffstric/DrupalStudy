/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
console.log('Hi ,doNotAddTooMuchModules!');

(function ($) {
	//not recommand do like this
	$(document).ready(function() {
	    console.log(Drupal.settings.addJsSpecialId);
	    $('input#'+Drupal.settings.addJsSpecialId ).focus()
	});
	//recommand
	Drupal.behaviors.jeffSpecialScript = {
	    attach:function(){
		console.log('This is will auto run  after behaviors is called');
	    }
	}
})(jQuery);


