(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$(".various").fancybox({
		maxWidth: 800,
		maxHeight: 600,
		fitToView: false,
		width: '70%',
		height: '70%',
		autoSize: false,
		closeClick: true,
		openEffect: 'none',
		closeEffect: 'none'
	});
	$(document).ready(function(){
		var highestBox = 0;
			$('.card-body .card-title').each(function(){  
				if($(this).height() > highestBox){  
					highestBox = $(this).height();  
				}
		});    
		$('.card-body .card-title').height(highestBox);

	});
	$('.pagination').on('click','.page-link',function(){
		var pagetoken = $(this).attr("data-id");
		console.log(pagetoken);
		$.ajax({
			type        : 'POST', 
			url: yf.ajaxurl, 
            dataType    : 'json',
			data: {
				'action': 'yf_list_pagi',
				'ajax_nonce': yf.nonce,
				'pagetoken': pagetoken,
			},
			success: function (response) {
				$('.yf_content').empty();
				var raw = response.video_thum.toString();
				var raw_slash = raw.replace(/\[/g,'');
				var raw_comma= raw_slash.replace(/\,/g,'');
				var result= raw_comma.replace(/\]/g,'');
				$('.yf_content').html(result);
			}
		});
	});

})( jQuery );
