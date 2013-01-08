(function($) {
	if(!$) return false;				

	$(function(){				
		// exhibit tabs
		$("ul.tabs").tabs("div.panes > div");
		// movie tabs
		$("#tab_nav ul").tabs("#panes > div", {
			effect: 'fade',
			fadeOutSpeed: 400,
			rotate: true
		}).slideshow({
			autoplay: true,
			interval: 6000
		});
	});				
})(jQuery);		