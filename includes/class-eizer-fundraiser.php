<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://#
 * @since      1.0.0
 *
 * @package    Eizer_Fundraiser
 * @subpackage Eizer_Fundraiser/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Eizer_Fundraiser
 * @subpackage Eizer_Fundraiser/includes
 * @author     Anthony Canol <hay.an2ny@gmail.com>
 */
class Eizer_Fundraiser {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Eizer_Fundraiser_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'EIZER_FUNDRAISER_VERSION' ) ) {
			$this->version = EIZER_FUNDRAISER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'eizer-fundraiser';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Eizer_Fundraiser_Loader. Orchestrates the hooks of the plugin.
	 * - Eizer_Fundraiser_i18n. Defines internationalization functionality.
	 * - Eizer_Fundraiser_Admin. Defines all hooks for the admin area.
	 * - Eizer_Fundraiser_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-eizer-fundraiser-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-eizer-fundraiser-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-eizer-fundraiser-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-eizer-fundraiser-public.php';

		$this->loader = new Eizer_Fundraiser_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Eizer_Fundraiser_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Eizer_Fundraiser_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Eizer_Fundraiser_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'eizer_fundraiser_add_plugin_menu' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Eizer_Fundraiser_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		

		// Load the fundraisers class and create its hooks:
	    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-eizer-fundraisers.php';
	    $fundraisers = new Eizer_Fundraisers();
		$this->loader->add_action( 'init', $fundraisers, 'eizer_fundraiser_shortcode' );
		$this->loader->add_action( 'init', $fundraisers, 'eizer_fundraiser_page_shortcode' );

		// handle ajax events
		$this->loader->add_action( 'wp_ajax_ezf_init_data', $fundraisers, 'ezf_init_data' );
	    $this->loader->add_action( 'wp_ajax_nopriv_ezf_init_data', $fundraisers, 'ezf_init_data' );

		// collection
		$this->loader->add_action( 'wp_ajax_ezf_add_new_collection', $fundraisers, 'ezf_add_new_collection' );
	    $this->loader->add_action( 'wp_ajax_nopriv_ezf_add_new_collection', $fundraisers, 'ezf_add_new_collection' );
		$this->loader->add_action( 'wp_ajax_ezf_get_collection', $fundraisers, 'ezf_get_collection' );
	    $this->loader->add_action( 'wp_ajax_nopriv_ezf_get_collection', $fundraisers, 'ezf_get_collection' );
		$this->loader->add_action( 'wp_ajax_ezf_update_collection', $fundraisers, 'ezf_update_collection' );
	    $this->loader->add_action( 'wp_ajax_nopriv_ezf_update_collection', $fundraisers, 'ezf_update_collection' );
		$this->loader->add_action( 'wp_ajax_ezf_delete_collection', $fundraisers, 'ezf_delete_collection' );
	    $this->loader->add_action( 'wp_ajax_nopriv_ezf_delete_collection', $fundraisers, 'ezf_delete_collection' );

		// redeem
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-eizer-redeem.php';
	    $redeem = new Eizer_Redeem();
		$this->loader->add_action( 'wp_ajax_ezf_add_new_redeem', $redeem, 'ezf_add_new_redeem' );
	    $this->loader->add_action( 'wp_ajax_nopriv_ezf_add_new_redeem', $redeem, 'ezf_add_new_redeem' );
		$this->loader->add_action( 'wp_ajax_ezf_get_redeem', $redeem, 'ezf_get_redeem' );
	    $this->loader->add_action( 'wp_ajax_nopriv_ezf_get_redeem', $redeem, 'ezf_get_redeem' );
		$this->loader->add_action( 'wp_ajax_ezf_update_redeem', $redeem, 'ezf_update_redeem' );
	    $this->loader->add_action( 'wp_ajax_nopriv_ezf_update_redeem', $redeem, 'ezf_update_redeem' );
		$this->loader->add_action( 'wp_ajax_ezf_delete_redeem', $redeem, 'ezf_delete_redeem' );
	    $this->loader->add_action( 'wp_ajax_nopriv_ezf_delete_redeem', $redeem, 'ezf_delete_redeem' );

		// credit card machine
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-eizer-ccm.php';
	    $ccm = new Eizer_Ccm();
		$this->loader->add_action( 'wp_ajax_ezf_add_new_ccm', $ccm, 'ezf_add_new_ccm' );
	    $this->loader->add_action( 'wp_ajax_nopriv_ezf_add_new_ccm', $ccm, 'ezf_add_new_ccm' );
		$this->loader->add_action( 'wp_ajax_ezf_get_ccm', $ccm, 'ezf_get_ccm' );
	    $this->loader->add_action( 'wp_ajax_nopriv_ezf_get_ccm', $ccm, 'ezf_get_ccm' );
		$this->loader->add_action( 'wp_ajax_ezf_update_ccm', $ccm, 'ezf_update_ccm' );
	    $this->loader->add_action( 'wp_ajax_nopriv_ezf_update_ccm', $ccm, 'ezf_update_ccm' );
		$this->loader->add_action( 'wp_ajax_ezf_delete_ccm', $ccm, 'ezf_delete_ccm' );
	    $this->loader->add_action( 'wp_ajax_nopriv_ezf_delete_ccm', $ccm, 'ezf_delete_ccm' );


		$this->loader->add_action( 'init', $plugin_public, 'ezf_custom_rewrite_rule' );
		$this->loader->add_filter( 'query_vars', $plugin_public, 'ezf_add_query_vars' );
		$this->loader->add_filter( 'template_redirect', $plugin_public, 'ezf_template_redirect' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Eizer_Fundraiser_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
