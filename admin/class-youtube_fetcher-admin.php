<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       somthing.ca
 * @since      1.0.0
 *
 * @package    Youtube_fetcher
 * @subpackage Youtube_fetcher/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Youtube_fetcher
 * @subpackage Youtube_fetcher/admin
 * @author     Nazmus sakib <sakib.bd08@gmail.com>
 */
class Youtube_fetcher_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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
		wp_enqueue_style( $this->plugin_name . 'sweetalert2', plugin_dir_url( __FILE__ ) . 'css/sweetalert2.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/youtube_fetcher-admin.css', array(), $this->version, false);

	}

	/**
	 * Register the JavaScript for the admin area.
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
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/youtube_fetcher-admin.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name. 'ajax_jquery' ,'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name. 'sweetalert2' ,plugin_dir_url( __FILE__ ) . 'js/sweetalert2.min.js', array( 'jquery' ), $this->version, true );
		wp_localize_script( $this->plugin_name, 'yf', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('_wpnonce')
        ));

	}
	public function display_page() {
		$page_location = 'partials/' . strtolower($_GET['page']) . '.php';
		include_once $page_location;
	}
	public function add_menu() {
		add_menu_page($this->plugin_name, "Youtube Fetcher", 'manage_options', 'Youtube_Fetcher', array($this, 'display_page'), 
		plugin_dir_url( __FILE__ ) .'/img/iconfinder_youtube_317714.png',3);
	}
	public function list_yf_setting(){
		global $wpdb;
		$params = $_POST;
		$channel_id = sanitize_text_field($params['channel_id']);
		$max_result = sanitize_text_field($params['max_result']);
		$api_key = sanitize_text_field($params['api_key']);
		$yf_list_setting = array(
			'channel_id' => $channel_id,
			'max_result' => $max_result,
			'api_key' => $api_key,
		);
		update_option( 'yf_list_setting', $yf_list_setting );
		$yf_list_setting_arr = get_option( 'yf_list_setting' );
		wp_send_json(array('success' => true,  'setting' => $yf_list_setting_arr));
		wp_die();

	}

}
