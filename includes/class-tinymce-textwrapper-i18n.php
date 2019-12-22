<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://tutsocean.com/about-me/
 * @since      1.0.0
 *
 * @package    Tinymce_Textwrapper
 * @subpackage Tinymce_Textwrapper/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Tinymce_Textwrapper
 * @subpackage Tinymce_Textwrapper/includes
 * @author     Deepak Anand <anand.deepak9988@gmail.com>
 */
class Tinymce_Textwrapper_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'tinymce-textwrapper',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
