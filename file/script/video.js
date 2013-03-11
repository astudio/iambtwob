(function($) {
	if(!$) return false;

	$(function(){
		// top slideshow
		$("#tab_nav ul").tabs("#panes > div", {
			effect: 'fade',
			fadeOutSpeed: 400,
			rotate: true
		}).slideshow({});
		
		// index category tabs
		$("ul.tabs").tabs("div.panes > div", {
			effect: 'fade',
			fadeInSpeed: 600		
		});		
	});				
})(jQuery);