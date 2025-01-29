<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://#
 * @since      1.0.0
 *
 * @package    Eizer_Fundraiser
 * @subpackage Eizer_Fundraiser/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Eizer_Fundraiser
 * @subpackage Eizer_Fundraiser/admin
 * @author     Anthony Canol <hay.an2ny@gmail.com>
 */
class Eizer_Fundraiser_Admin {

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
		 * defined in Eizer_Fundraiser_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Eizer_Fundraiser_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/eizer-fundraiser-admin.css', array(), $this->version, 'all' );

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
		 * defined in Eizer_Fundraiser_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Eizer_Fundraiser_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/eizer-fundraiser-admin.js', array( 'jquery' ), $this->version, false );

	}

	// add plugin menu
	function eizer_fundraiser_add_plugin_menu() {
		add_menu_page(
			'Eizer Fundraiser',
			'Eizer Fundraiser',
			'manage_options',
			'eizer-index', 
			array( $this, 'eizer_fundraiser_plugin_home_page' ),
			'', 
			6
		);
		// add_submenu_page( 'vea_api', 'Shortcodes', 'Shortcodes', 'manage_options', 'vea_api-shortcode', array( $this, 'vea_api_plugin_shortcode_page' ) );
	}

	// eizer fundraiser plugin home page
	function eizer_fundraiser_plugin_home_page() {

		if (!current_user_can('manage_options')) {
			echo('You do not have sufficient permissions to access this page.');
			return;
		}

		// Add error/update messages

        // Check if the user have submitted the settings,
        // WordPress will add the "settings-updated" $_GET parameter to the url
        // if ( isset( $_GET['settings-updated'] ) ) {
        //     // Add settings saved message with the class of "updated"
        //     add_settings_error( 'vea-api-section', 'vea_api_message', __( 'Settings Saved', 'vea-api' ), 'updated' );
        // }

        // Show error/update messages
        // settings_errors( 'vea-api-section' );

		// $output_header = $this->output_header( );

		?>
		<div class="wrap">
			<div>Homepage</div>
		</div>
		<?php
	}

}
