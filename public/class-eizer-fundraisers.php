<?php
class Eizer_Fundraisers {
    protected $helper;

	public function __construct() {
		$this->load_helper();
	}

    private function load_helper() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-eizer-helper.php';

		$this->helper = new Eizer_Helper();

	}

    function eizer_fundraiser_shortcode() {
		add_shortcode('eizer-fundraisers', array($this,'eizer_fundraisers_list'));
	}

	function eizer_fundraiser_page_shortcode() {
		add_shortcode('eizer-fundraiser-page', array($this,'eizer_fundraiser_page'));
	}

    function eizer_fundraisers_list() {
		ob_start();

		include('partials/subscribers-list.php');
        
        return ob_get_clean();
	}

	function eizer_fundraiser_page($atts) {
		$atts = shortcode_atts(
			array(
				'id'   => '', // Page ID
				'slug' => '', // Page Slug
			),
			$atts,
			'eizer-fundraiser-page'
		);

		ob_start();

		include('partials/subscribers-profile.php');
        
        return ob_get_clean();
	}
}