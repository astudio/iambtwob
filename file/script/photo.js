(function($) {
	if(!$) return false;				

	$(function(){
		// top slideshow
		$("#tab_nav ul").tabs("#panes > div", {
			effect: 'fade',
			fadeOutSpeed: 400,
			rotate: true
		}).slideshow({
			autoplay: true,
			interval: 3000
		});
		
		// single detail fbox
		$("a.Detail").each(function(){
			var title = $(this).data('title');
			$(this).fancybox({
					width			: 1090,
					height			: '90%',
					title			: title,
					padding			: 0,
					autoDimensions	: false,
					centerOnScroll	: true,
					scrolling		: 'yes',
					transitionIn	: 'elastic',
					transitionOut	: 'elastic',
					speedIn			: 600,
					speedOut		: 200,
					type			: 'iframe'
			});
		});			
	});				
})(jQuery);