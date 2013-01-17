(function($) {
	if(!$) return false;

/* 	function imgScroll() {
		$('img.lazy:visible').scroll();
	} 
 */
	$.browser.safari = ($.browser.webkit && !(/chrome/.test(navigator.userAgent.toLowerCase())));
	
	$(function(){
		//fix safari browser left position		
		if ( $.browser.safari ) {
			$('span.arrowr').hide();
		}	
	
		/* global */
		//imgScroll();
		// menu
		$('.side li.level1').hover(
			function(){
				$(this).addClass('active');
				$(this).find('.level2').show();
			},
			function(){
				$(this).removeClass('active');
				$(this).find('.level2').hide();
			});

		// 1st slideshow
		$(".slidetabs").tabs(".images > div", {		
			// enable "cross-fading" effect
			effect: 'horizontal',
			event: 'mouseover',
			fadeOutSpeed: 1000,				 
			// start from the beginning after the last tab
			rotate: true				 
		}).slideshow({
			autoplay: true,
			interval: 5000,
			clickable: false
		});

		// images lazy load
		$('img.lazy').jail();
/* 		$('img.lazyAD').jail({
			loadHiddenImages : true,
			timeout : 1500
		});	 */		
		// tooltip
		$('.trigger').tooltip({
			position	: 'top center',
			opacity		: 0.9,
			layout		: '<div><span class="arrow"></span></div>',
			offset		: [ -10, 0]
		});
	});				
})(jQuery);