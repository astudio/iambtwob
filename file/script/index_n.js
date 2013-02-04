(function($) {
	if(!$) return false;				

	$(function(){	
		if( $.browser.safari ) {
			$('span.arrowr').css({left: '200px'}).show();
		}
		// 2nd slideshow
		$(".slidetabs2").tabs(".images2 > div", {				 
			// enable "cross-fading" effect
			effect: 'horizontal',
			event: 'mouseover',			 
			// start from the beginning after the last tab
			rotate: true
		}).slideshow({
			autoplay: true,
			interval: 10000,
			next: '.forward2',
			prev: '.backward2',
			clickable: false
		});		
		// products list scrollable
		$(".scrollable").scrollable({
			onSeek: function(){ 
				$('.scrollable img.lazy').each(function(){
					var o = $(this).attr('data-src');
					if( o ) $(this).attr('src',o).removeAttr('data-src');
				});
			}
		});		
		// exhibit tabs
		// brand nav alse uses
		$("ul.tabs").tabs("div.panes > div",{
			effect: 'fade',
			fadeInSpeed: 600,
			fadeOutSpeed: 400
		});		
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