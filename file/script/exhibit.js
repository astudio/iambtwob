(function($) {
	if(!$) return false;				

	$(function(){
		// top slideshow
		$("#tab_nav ul").tabs("#panes > div", {
			effect: 'fade',
			fadeInSpeed: 600,
			rotate: true
		}).slideshow({
			autoplay: true,
			interval: 8000
		});
		// remove duplicated left entry
		$('.Rec .invest_rec > ul > li:lt(3)').hide().parent().show();			
		// remove duplicated exhibit entry
		$('.showCat .sublist > li:first-child').remove();
		$('.showCat .sublist').css({visibility:'visible'});
	});				
})(jQuery);