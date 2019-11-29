<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       somthing.ca
 * @since      1.0.0
 *
 * @package    Youtube_fetcher
 * @subpackage Youtube_fetcher/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Youtube_fetcher
 * @subpackage Youtube_fetcher/public
 * @author     Nazmus sakib <sakib.bd08@gmail.com>
 */
class Youtube_fetcher_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Youtube_fetcher_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Youtube_fetcher_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( $this->plugin_name . 'bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . 'fancybox', plugin_dir_url( __FILE__ ) . 'css/jquery.fancybox.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/youtube_fetcher-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Youtube_fetcher_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Youtube_fetcher_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/youtube_fetcher-public.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . 'fancybox', plugin_dir_url( __FILE__ ) . 'js/jquery.fancybox.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'yf', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('_wpnonce')
        ));
	}
	public function yf_video_list_shortcode(){
		function video_list_shortcode($atts){
			$yf_list_setting_arr = get_option( 'yf_list_setting' );
			$api_url = 'https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$atts["channelid"].'&maxResults='.$atts["maxresults"].'&key='. $yf_list_setting_arr["api_key"].'';
			$video_list = json_decode(file_get_contents($api_url));

			$getpage = prev($parts);; 
			if(!is_numeric ($getpage)):  
				$getpage = 1;
			endif;
			$nb_elem_per_page = 12;
			$page = isset($getpage)?intval($getpage-1):0;
			$number_of_pages = intval(count($video_list->items)/$nb_elem_per_page)+1;
			echo '<div class="row yf_content"><input type="hidden" class="channelid" value="'.$atts["channelid"].'"/><input type="hidden" class="maxresults" value="'.$atts["maxresults"].'"/>';
				foreach(array_slice($video_list->items, $page*$nb_elem_per_page, $nb_elem_per_page) as $item)
				{
					if(isset($item->id->videoId)){
					  echo '<div class="col-md-4 col-sm-6 col-lg-3">
								<div class="card youtube-video shadow-lg" id="'. $item->id->videoId .'" style="margin-bottom: 20px">
									<a class="various fancybox.iframe" href="http://www.youtube.com/embed/'. $item->id->videoId .'?autoplay=1" title="'. $item->snippet->title .'" >
										<img class="card-img-top" src="'. $item->snippet->thumbnails->medium->url .'" alt="'. $item->snippet->title .'" alt="Card image cap"> 
									</a>
									<div class="card-body">
										<h6 class="card-title">'. $item->snippet->title .'</h6>
									</div>
								</div>
							</div>';
						}else if(isset($item->id->playlistId)){
							  echo '<div class="col-md-4 col-sm-6 col-lg-3">
										<div id="'. $item->id->playlistId .'" class="card youtube-playlist shadow-lg" style="margin-bottom: 20px">
											<a href="#'. $item->id->playlistId .'" title="'. $item->snippet->title .'" >
												<img src="'. $item->snippet->thumbnails->medium->url .'" alt="'. $item->snippet->title .'" class="img-responsive" height="130px" />
											</a>   
											<div class="card-body">
												<h6 class="card-title">'. $item->snippet->title .'</h6>
											</div>
										</div>
									</div>';
						}
				}
			echo '</div>';
			echo '<nav aria-label="Page navigation example"><ul class="pagination">
			<li class="page-item"><a class="page-link" data-id="'.$video_list->prevPageToken.'">Previous</a></li>
			<li class="page-item"><a class="page-link" data-id="'.$video_list->nextPageToken.'">Next</a></li></ul></nav>';
    	}
		add_shortcode('yf_video_list','video_list_shortcode');
	}
	public function yf_list_pagi(){
			global $wpdb;
			$params = $_POST;
			$pagetoken = sanitize_text_field($params['pagetoken']);
			$channelid = sanitize_text_field($params['channelid']);
			$maxresults = sanitize_text_field($params['maxresults']);
			$yf_list_setting_arr = get_option( 'yf_list_setting' );
			$url_srting ='https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelid.'&maxResults='.$maxresults.'&key='. $yf_list_setting_arr["api_key"].'&pageToken='.$pagetoken;
			//var_dump($url_srting);wp_die();
			$video_list = json_decode(file_get_contents($url_srting));
			$getpage = prev($parts);; 
			if(!is_numeric ($getpage)):  
				$getpage = 1;
			endif;
			$nb_elem_per_page = 12;
			$page = isset($getpage)?intval($getpage-1):0;
			$number_of_pages = intval(count($video_list->items)/$nb_elem_per_page)+1;
			$video_thum = [];
			$inputhidden = '<input type="hidden" class="channelid" value="'.$channelid.'"/><input type="hidden" class="maxresults" value="'.$maxresults.'"/>';
				foreach($video_list->items as $item)
				{
					if(isset($item->id->videoId)){
						$video_content = '<div class="col-md-4 col-sm-6 col-lg-3"><div class="card youtube-video shadow-lg" id="'. $item->id->videoId .'" style="margin-bottom: 20px"><a class="various fancybox.iframe" href="http://www.youtube.com/embed/'. $item->id->videoId .'?autoplay=1" title="'. $item->snippet->title .'"><img class="card-img-top" src="'. $item->snippet->thumbnails->medium->url .'" alt="'. $item->snippet->title .'" alt="Card image cap"></a><div class="card-body"><h6 class="card-title">'. $item->snippet->title .'</h6></div></div></div>';
							array_push($video_thum, $video_content);
						}else if(isset($item->id->playlistId)){
							$video_content =  '<div class="col-md-4 col-sm-6 col-lg-3"><div id="'. $item->id->playlistId .'" class="card youtube-playlist shadow-lg" style="margin-bottom: 20px"><a href="#'. $item->id->playlistId .'" title="'. $item->snippet->title .'"><img src="'. $item->snippet->thumbnails->medium->url .'" alt="'. $item->snippet->title .'" class="img-responsive" height="130px" />	<div class="card-body"><h6 class="card-title">'. $item->snippet->title .'</h6></div></div></div>';
							array_push($video_thum, $video_content);
						}
				}
			wp_send_json(array('success' => true,  'video_thum' =>$video_thum, 'inputhidden' => $inputhidden, 'prevPageToken' => $video_list->prevPageToken, 'nextPageToken' => $video_list->nextPageToken));
			wp_die();
	}

}
