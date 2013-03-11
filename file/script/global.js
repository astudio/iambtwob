(function($) {
	if(!$) return false;

	$.browser.safari = ($.browser.webkit && !(/chrome/.test(navigator.userAgent.toLowerCase())));
	
	$(function(){
		// footer always bottom
		$(window).load(function(){var b=$('[_height=auto]');if(b.length<=0)return false;var c=$(this),$body=$('body'),$none=$('[none=true]'),autoDivHeight=b.outerHeight(true),autoDivBorder=autoDivHeight-b.height(),delBodyMargin=parseInt($body.css('marginTop'))+parseInt($body.css('marginBottom')),none=$none.outerHeight(true)-$none.height(),delHeight=0;$('[_height=none]').each(function(){delHeight+=$(this).outerHeight(true)});function fullHeight(){var a=c.height()-delHeight-delBodyMargin-autoDivBorder-none;if(a>autoDivHeight){b.height(a)}}c.resize(function(){fullHeight()});fullHeight()});
		
		//fix safari browser left position		
		if ( $.browser.safari ) {
			$('span.arrowr').hide();
		}	
	
		/* global */
		// menu
		$('.side li.level1.child').hover(
			function(){
				$(this).find('.level2 img.lazy').each(function(){
					var o = $(this).attr('data-src');
					if( o ) $(this).attr('src',o).removeAttr('data-src');
				});			
				$(this).addClass('active');
				$(this).find('.level2').show();
			},
			function(){
				$(this).removeClass('active');
				$(this).find('.level2').hide();
			});
		// remove .big class while Ad does not exist
		$('.Category .level2').each(function(){
			var a = $(this).find('ul').siblings().is('img,a');
			if(!a) $(this).removeClass('big');
		});		

		// 1st slideshow
		$(".slidetabs").tabs(".images > div", {		
			// enable "cross-fading" effect
			effect: 'horizontal',
			event: 'mouseover',
			fadeInSpeed: 1000,				 
			// start from the beginning after the last tab
			rotate: true				 
		}).slideshow({
			autoplay: true,
			interval: 5000,
			clickable: false
		});		

		// images lazy load
		$('img.lazy').jail();	
		// tooltip
		$('.trigger').tooltip({
			position	: 'top center',
			opacity		: 0.9,
			layout		: '<div><span class="arrow"></span></div>',
			offset		: [ -10, 0]
		});
	});				
})(jQuery);