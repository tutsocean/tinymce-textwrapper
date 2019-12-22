<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://tutsocean.com/about-me/
 * @since             1.0.0
 * @package           Tinymce_Textwrapper
 *
 * @wordpress-plugin
 * Plugin Name:       Tinymce Text Wrapper
 * Plugin URI:        https://tutsocean.com/tinymce-textwrapper
 * Description:       TinyMCE Plugin to wrap selected text in a span tag with custom CSS class. The best part is you can do this within the Visual Editor of WordPress.
 * Version:           1.0.0
 * Author:            Deepak Anand
 * Author URI:        https://tutsocean.com/about-me/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tinymce-textwrapper
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TINYMCE_TEXTWRAPPER_VERSION', '1.0.0' );
define( 'TINYMCE_TEXTWRAPPER_PLUGIN_BASE_URL',plugin_basename( __FILE__ )); 
define( 'TINYMCE_TEXTWRAPPER_PLUGIN_BASE_URI',plugin_dir_path( __FILE__ )); 
define("TINYMCE_TEXTWRAPPER_PLUGIN_DIR",plugin_basename( __DIR__ ));
define("TINYMCE_TEXTWRAPPER_PLUGIN_NAME",'Tinymce Text Wrapper');
/**
 * The code that runs during plugin activation.
 */
class tinymcetextWrapper {
	function __construct() {

		if ( is_admin() ) {
			add_action( 'init', array( &$this, 'tinymcetextWrapperSetupPlugin' ) );
			add_action( 'admin_enqueue_scripts', array( &$this, 'admin_scripts_css' ) );
			add_action( 'admin_print_footer_scripts', array( &$this, 'admin_footer_scripts' ) );
		}

	}
	function tinymcetextWrapperSetupPlugin() {
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
			return;
		}
		if ( get_user_option( 'rich_editing' ) !== 'true' ) {
			return;
		}
		add_filter( 'mce_external_plugins', array( &$this, 'add_tinymce_plugin' ) );
		add_filter( 'mce_buttons', array( &$this, 'add_tinymce_toolbar_button' ) );

	}
	function add_tinymce_plugin( $plugin_array ) {

		$plugin_array['tinymceTextwrapper'] = plugin_dir_url( __FILE__ ) . 'tinymce-textwrapper.js';
		return $plugin_array;

	}
	function add_tinymce_toolbar_button( $buttons ) {

		array_push( $buttons, 'tinymceTextwrapper' );
		return $buttons;

	}
	function admin_scripts_css() {

		wp_enqueue_style( 'tinymce-textwrapper', plugins_url( 'tinymce-textwrapper.css', __FILE__ ) );

	}
	function admin_footer_scripts() {
		if ( ! wp_script_is( 'quicktags' ) ) {
			return;
		}
		?>
		<script type="text/javascript">
			QTags.addButton( 'tinymceTextwrapper', 'Insert Custom Class', insert_tinymceTextwrapper );
			function insert_tinymceTextwrapper() {
				var result = prompt('Class name for span tag');
				if ( !result ) {
					return;
				}
				if (result.length === 0) {
					return;
				}
				QTags.insertContent('<span class="' + result +'"></span>');
			}
		</script>
		<?php
	}

}

$tinymcetextWrapper = new tinymcetextWrapper;