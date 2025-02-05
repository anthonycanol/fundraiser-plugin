<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://#
 * @since      1.0.0
 *
 * @package    Eizer_Fundraiser
 * @subpackage Eizer_Fundraiser/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Eizer_Fundraiser
 * @subpackage Eizer_Fundraiser/public
 * @author     Anthony Canol <hay.an2ny@gmail.com>
 */
class Eizer_Fundraiser_Public
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/eizer-fundraiser-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script('ezf-ajax-public', plugin_dir_url(__FILE__) . 'js/ezf-public.js', array('jquery'), $this->version, true);
		wp_localize_script('ezf-ajax-public', 'ezf_ajax_object', [
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce'    => wp_create_nonce('my_ajax_nonce'),
		]);
		wp_enqueue_script($this->plugin_name . "-bootstrapjs", '//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), $this->version, true);
		wp_enqueue_script($this->plugin_name . "-ezfpublicjs", plugin_dir_url(__FILE__) . 'js/eizer-fundraiser-public.js', array('jquery'), $this->version, true);
	}
}
