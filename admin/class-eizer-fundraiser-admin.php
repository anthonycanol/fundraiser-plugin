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
class Eizer_Fundraiser_Admin
{

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
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

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
		wp_enqueue_style('bootstrap', '//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', [], $this->version, 'all');
		wp_enqueue_style('font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css', [], $this->version, 'all');
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/eizer-fundraiser-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

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
		
		wp_enqueue_script( 'ezf-admin-js', plugin_dir_url(__FILE__) . 'js/ezf-admin.js', array('jquery'), $this->version, true);
		wp_localize_script( 'ezf-admin-js', 'ajax_object', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce('my_ajax_nonce'),
        ]);
		wp_enqueue_script($this->plugin_name . "-admin-bootstrapjs", '//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), $this->version, true);
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/eizer-fundraiser-admin.js', array('jquery'), $this->version, true);
	}

	// add plugin menu
	function eizer_fundraiser_add_plugin_menu()
	{
		add_menu_page(
			'Eizer Fundraiser',
			'Eizer Fundraiser',
			'manage_options',
			'eizer-main-menu',
			array($this, 'eizer_fundraiser_plugin_home_page'),
			'',
			6
		);
		// add_submenu_page( 'vea_api', 'Shortcodes', 'Shortcodes', 'manage_options', 'vea_api-shortcode', array( $this, 'vea_api_plugin_shortcode_page' ) );

		add_submenu_page(
			'eizer-main-menu',          // Parent slug
			'Credit Card Machine',         // Page title
			'Credit Card Machine',             // Menu title
			'manage_options',        // Capability
			'eizer-ccm',         // Menu slug
			array($this, 'eizer_ccm_page')     // Callback function
		);

		add_submenu_page(
			'eizer-main-menu',          // Parent slug
			'Redeems',         // Page title
			'Redeems',             // Menu title
			'manage_options',        // Capability
			'eizer-redeem',         // Menu slug
			array($this, 'eizer_redeem_page')     // Callback function
		);
	}

	// eizer fundraiser plugin home page
	function eizer_fundraiser_plugin_home_page()
	{

		if (!current_user_can('manage_options')) {
			echo ('You do not have sufficient permissions to access this page.');
			return;
		}

		include(plugin_dir_path(__FILE__) . 'partials/eizer-fundraiser-admin-display.php');
	}

	// credit card machine page
	function eizer_ccm_page()
	{
		include(plugin_dir_path(__FILE__) . 'partials/credit-card-machine-list.php');
	}

	// redeem page
	function eizer_redeem_page()
	{
		include(plugin_dir_path(__FILE__) . 'partials/redeem-list.php');
	}
}
