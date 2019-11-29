(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
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
	$('.col-md-6').on('click','.youtube_list_save',function(){
		var api_key = $('#api_key').val();
		$.ajax({
			type        : 'POST', 
			url: yf.ajaxurl, 
            dataType    : 'json',
			data: {
				'action': 'list_yf_setting',
				'ajax_nonce': yf.nonce,
				'api_key' : api_key,
			},
			success: function (response) {
				Swal.fire({
					icon: 'success',
					title: 'Api save',
					showConfirmButton: false,
					timer: 1500
				  })
			}
		});
	});
	$('.col-md-6').on('click','.set_shortcode',function(){
		var channel_id = $('#channel_id').val();
		var max_result = $('#max_result').val();
		var shortcode ='[yf_video_list channelid="'+channel_id+'" maxresults="'+max_result+'"]';
		Swal.fire({
			title: 'Your shortcode',
			text: shortcode,
			showConfirmButton: false,
			timer: 1500
		  })
	});
})( jQuery );
