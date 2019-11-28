<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       somthing.ca
 * @since      1.0.0
 *
 * @package    Youtube_fetcher
 * @subpackage Youtube_fetcher/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Youtube_fetcher
 * @subpackage Youtube_fetcher/includes
 * @author     Nazmus sakib <sakib.bd08@gmail.com>
 */
class Youtube_fetcher_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'youtube_fetcher',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
