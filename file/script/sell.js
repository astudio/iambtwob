function astudio() {
	$("#DIMG").elevateZoom({
		zoomWindowWidth:380,
		zoomWindowHeight:292				
	});
}

(function($) {
	if(!$) return false;				

	$(function(){
		// fix IE8- opacity
		if( $.browser.msie && parseInt($.browser.version) < 9 ) {
			$('#products_list .info').css({opacity: '0.6'});
			$('#products_list .info').hover(
				function(){
					$(this).css({opacity: '1'});
				},
				function(){
					if( $(this).parent().find('input').attr('checked') ) return;
					$(this).css({opacity: '0.6'});
				});
		}	
		
		//checkall or uncheckall
		$('#checkAll').toggle(
			function(){
				$(':checkbox').attr('checked',true).parent().parent().find('.info').css({'opacity':1});
			},
			function(){
				Dh('sell_tip');
				$(':checkbox').attr('checked',false).parent().parent().find('.info').css({'opacity':0.6});
			});		
		
		// pre-Set the checkbox style of checked
		if( $(':checkbox:checked').length > 0 ) {
			if( $('#products_list > li').is(':visible') ) {
				$(':checkbox:checked').parent().parent().find('.info').css({opacity:'1'});
			}
			if( $('.Lists > .list').is(':visible') ) {
				$(':checkbox:checked').parent().css({backgroundColor:'#f5f5f5'});
			}
		}
		
		// single inquiry fbox
		$("a.Inquiry").fancybox({
				width			: 680,
				height			: '90%',
				title			: 'Select To Inquiry',
				padding			: 0,
				autoDimensions	: false,
				centerOnScroll	: true,
				scrolling		: 'yes',
				transitionIn	: 'elastic',
				transitionOut	: 'elastic',
				speedIn			: 600,
				speedOut		: 200,
				type			: 'iframe'
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
			var title = href == 'compare' ? 'Compare' : 'Inquiry';
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

		// set list type cookie
		if( Dd('list').value !=0 ) {
			set_cookie('list', Dd('list').value, 14);
		} else {
			del_cookie('list');
		}	
	});				
})(jQuery);