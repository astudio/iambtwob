(function($) {
	if(!$) return false;				

	$(function(){	
		if( $.browser.safari ) {
			$('span.arrowr').css({left: '200px'}).show();
		}
		// images lazy load
		$('img.lazy2').jail({
			loadHiddenImages : true,
			timeout : 3000
		});	
		// 2nd slideshow
		$(".slidetabs2").tabs(".images2 > div", {				 
			// enable "cross-fading" effect
			effect: 'horizontal',
			event: 'mouseover',
			fadeOutSpeed: 2000,				 
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