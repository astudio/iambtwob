(function($) {
	if(!$) return false;				

	$(function(){
		// single quote fbox
		$("a.Quote").fancybox({
				width			: 680,
				height			: '90%',
				title			: 'Quotation',
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

		// single detail fbox
		$("a.Detail").each(function(){
			var title = $(this).data('title');
			$(this).fancybox({
					width			: 680,
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