<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://#
 * @since             1.0.0
 * @package           Eizer_Fundraiser
 *
 * @wordpress-plugin
 * Plugin Name:       Eizer Fundraiser
 * Plugin URI:        https://#
 * Description:       For Eizer fundraiser dashboard.
 * Version:           1.0.0
 * Author:            Anthony Canol
 * Author URI:        https://#/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       eizer-fundraiser
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
define( 'EIZER_FUNDRAISER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-eizer-fundraiser-activator.php
 */
function activate_eizer_fundraiser() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-eizer-fundraiser-activator.php';
	Eizer_Fundraiser_Activator::activate();

	// ezf_custom_rewrite_rule();
    flush_rewrite_rules();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-eizer-fundraiser-deactivator.php
 */
function deactivate_eizer_fundraiser() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-eizer-fundraiser-deactivator.php';
	Eizer_Fundraiser_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_eizer_fundraiser' );
register_deactivation_hook( __FILE__, 'deactivate_eizer_fundraiser' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-eizer-fundraiser.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_eizer_fundraiser() {

	$plugin = new Eizer_Fundraiser();
	$plugin->run();

}
run_eizer_fundraiser();
