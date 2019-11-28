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
	
	function fix_height(){
		var highestBox = 0;
			$('.card-body .card-title').each(function(){  
				if($(this).height() > highestBox){  
					highestBox = $(this).height();  
				}
		});    
		$('.card-body .card-title').height(highestBox);

	};
	$(document).ready(function(){
		fix_height();

	});
	$('.pagination').on('click','.page-link',function(){
		var pagetoken = $(this).attr("data-id");
		yf_content(pagetoken);
	});
	function yf_content(pagetoken){
		$.ajax({
			type: 'POST', 
			url: yf.ajaxurl, 
            dataType    : 'json',
			data: {
				'action': 'yf_list_pagi',
				'ajax_nonce': yf.nonce,
				'pagetoken': pagetoken,
			},
			success: function (response) {
				$('.yf_content').empty();
				$('.pagination').empty();
				var raw = response.video_thum.toString();
				var raw_slash = raw.replace(/\[/g,'');
				var raw_comma= raw_slash.replace(/\,/g,'');
				var result= raw_comma.replace(/\]/g,'');
				var pagi ='<li class="page-item"><a class="page-link" data-id="'+response.prevPageToken+'">Previous</a></li><li class="page-item"><a class="page-link" data-id="'+response.nextPageToken+'">Next</a></li>';
				$('.yf_content').html(result);
				$('.pagination').html(pagi);
			}
		});
	}
})( jQuery );
