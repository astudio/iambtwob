(function($) {
	if(!$) return false;

	$(function(){
		// left Category toggle
		$('.menu_category').toggle(
			function(){
				$('.side .Category').show().stop().animate({height:'100%'},1200,function(){});
			},
			function(){
				$('.side .Category').stop().animate({height:'0px'},600,function(){$(this).hide();});
			});

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