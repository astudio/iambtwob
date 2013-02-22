(function($) {
	if(!$) return false;				

	$(function(){
		// accordion trigger
		$("#accordion").tabs(
			"#accordion div.pane",
			{tabs: 'h2', effect: 'slide', initialIndex: null}
		);		
	});				
})(jQuery);