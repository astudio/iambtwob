(function($) {
	if(!$) return false;

/* 	function getMoreLink(id) {
		var catid = id ? id : $('ul.tabs > li:first-child').data('catid');
		$('.main .more > a').attr('href',DTPath+'brand/list.php?catid='+catid);
	} */
	
	$(function(){

		//checkall or uncheckall
		$('#checkAll').toggle(
			function(){
				$(':checkbox').attr('checked',true).parent().parent().find('.info').css({'opacity':1});
			},
			function(){
				Dh('sell_tip');
				$(':checkbox').attr('checked',false).parent().parent().find('.info').css({'opacity':0.6});
			});	
		
		// index category tabs
 		$("ul.tabs").tabs("div.panes > div",{
			effect: 'fade',
			fadeInSpeed: 600,
			fadeOutSpeed: 400
		});
		
		// multiple inquiry / compare fbox
		$("a.fb").click(function(){			
			var checked = $("[name='itemid[]']:checked");
			//itemid
			var itemid = [];
			checked.each(function(){
				itemid.push($(this).val());
			});
			//href
			var href = $(this).attr('rel');
			//length 
			var len = checked.length;
			//title
			var title = href == 'compare' ? 'Compare' : 'Order';
			//width
			var width = href == 'compare' ? 800 : 680;
						
			$.fancybox({
				width			: width,
				height			: '90%',
				title			: 'Select To '+title,
				padding			: 0,
				autoDimensions	: false,
				centerOnScroll	: true,
				scrolling		: 'yes',
				transitionIn	: 'elastic',
				transitionOut	: 'elastic',
				speedIn			: 600,
				speedOut		: 200,
				type			: 'iframe',
				href			: href+'.php?fbox=1&length='+len+'&itemids='+itemid,
				onComplete		: function(){
					$('#fancybox-title').css({width:width});
					//Dh('sell_tip');
					//$(":checkbox:checked").each(function () {
					//	$(this).attr('checked',false).parent().parent().find('.info').css({opacity:'0.6'});
					//});
				}				
			});	
		});		
	});				
})(jQuery);