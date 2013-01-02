(function($) {
	if(!$) return false;				

	function imgMouseOver() {
		$('img.lazy:visible').scroll();
	}
	
	$(function(){
		/* global */
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
			// 2nd slideshow
			$(".slidetabs2").tabs(".images2 > div", {				 
				// enable "cross-fading" effect
				effect: 'horizontal',
				event: 'mouseover',
				fadeOutSpeed: 2000,				 
				// start from the beginning after the last tab
				rotate: true
			}).slideshow({
				//autoplay: true,
				//interval: 10000,
				next: '.forward2',
				prev: '.backward2',
				clickable: false
			});		
		// products list scrollable
		$(".scrollable").scrollable({
			onSeek: function(){ 
				imgMouseOver();
			}
		});		
		// images lazy load
		$('img.lazy').jail();
		imgMouseOver();
		//checkall or uncheckall
		$('#checkAll').toggle(
			function(){
				$(':checkbox').attr('checked',true).parent().parent().find('.info').css({'opacity':1});
			},
			function(){
				Dh('sell_tip');
				$(':checkbox').attr('checked',false).parent().parent().find('.info').css({'opacity':0.6});
			});
		
		// tooltip
		$('.trigger').tooltip({
			position	: 'top center',
			opacity		: 0.9,
			layout		: '<div><span class="arrow"></span></div>',
			offset		: [ -10, 0]
		});
	});				
})(jQuery);