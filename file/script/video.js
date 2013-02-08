(function($) {
	if(!$) return false;

	$(function(){
		// top slideshow
		$("#tab_nav ul").tabs("#panes > div", {
			effect: 'fade',
			fadeOutSpeed: 400,
			rotate: true
		}).slideshow({
			//autoplay: true,
			//interval: 3000
		});
		
		// index category tabs
		$("ul.tabs").tabs("div.panes > div");		
	});				
})(jQuery);