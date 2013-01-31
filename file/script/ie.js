$(function(){
	if( $.browser.msie && parseInt($.browser.version) < 9 ) {
		if( $('#:0.targetLanguage').is(':visible') ) {
			alert('33');
			$('#google_translate_element').find('.goog-te-menu-value > span:last-child').css({color:'#0569B4'});
		}
		
	}
});