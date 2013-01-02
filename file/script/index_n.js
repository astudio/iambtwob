(function($) {
	if(!$) return false;				

	$(function(){				
		// exhibit tabs
		$("ul.tabs").tabs("div.panes > div");
		// movie tabs
		$("#tab_nav ul").tabs("#panes > div", {effect: 'fade', fadeOutSpeed: 400});
	});				
})(jQuery);		