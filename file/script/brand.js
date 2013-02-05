(function($) {
	if(!$) return false;

	function getMoreLink(id) {
		var catid = id ? id : $('ul.tabs > li:first-child').data('catid');
		$('.main .more > a').attr('href',DTPath+'brand/list.php?catid='+catid);
	}
	
	$(function(){
		// index category / more
		getMoreLink();
		$('ul.tabs > li').on('click',function(){
			getMoreLink($(this).data('catid'));
			$('.panes > div:visible').find('img.lazy').each(function(){
				var o = $(this).attr('data-src');
				if( o ) $(this).attr('src',o).removeAttr('data-src');
			});			
		});
	});				
})(jQuery);