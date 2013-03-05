function astudio() {
	$("#DIMG").elevateZoom({
		zoomWindowWidth:380,
		zoomWindowHeight:292				
	});
}

(function($) {
	if(!$) return false;

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
		
		$('ul.tabs > li').on('click',function(){
			$('.panes > div:visible').find('img.lazy').each(function(){
				var o = $(this).attr('data-src');
				if( o ) $(this).attr('src',o).removeAttr('data-src');
			});			
		});		
		
		// multiple compare fbox
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
				}				
			});	
		});

		// image zoom init
		astudio();			
	});				
})(jQuery);