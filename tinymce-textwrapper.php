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

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tinymce-textwrapper-activator.php
 */
function activate_tinymce_textwrapper() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tinymce-textwrapper-activator.php';
	Tinymce_Textwrapper_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tinymce-textwrapper-deactivator.php
 */
function deactivate_tinymce_textwrapper() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tinymce-textwrapper-deactivator.php';
	Tinymce_Textwrapper_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tinymce_textwrapper' );
register_deactivation_hook( __FILE__, 'deactivate_tinymce_textwrapper' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tinymce-textwrapper.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tinymce_textwrapper() {

	$plugin = new Tinymce_Textwrapper();
	$plugin->run();

}
run_tinymce_textwrapper();
