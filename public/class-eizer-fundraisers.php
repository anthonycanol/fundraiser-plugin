<?php
class Eizer_Fundraisers
{
	protected $helper;

	public function __construct()
	{
		$this->load_helper();
	}

	private function load_helper()
	{

		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-eizer-helper.php';

		$this->helper = new Eizer_Helper();
	}

	function eizer_fundraiser_shortcode()
	{
		add_shortcode('eizer-fundraisers', array($this, 'eizer_fundraisers_list'));
	}

	function eizer_fundraiser_page_shortcode($atts)
	{
		add_shortcode('eizer-fundraiser-page', array($this, 'eizer_fundraiser_page'));
	}

	function eizer_fundraisers_list()
	{
		ob_start();

		include('partials/subscribers-list.php');

		return ob_get_clean();
	}

	function eizer_fundraiser_page($atts)
	{
		$atts = shortcode_atts([
			'fundraiserId'   => '2',
		], $atts, 'eizer-fundraiser-page');

		ob_start();

		include('partials/subscribers-profile.php');

		return ob_get_clean();
	}

	function ezf_add_new_collection()
	{
		global $wpdb;
		$tbl_collections = $wpdb->prefix . 'ezf_collections';
		$toinsert = new StdClass();

		if (!check_ajax_referer('my_ajax_nonce', 'nonce', false)) {
			wp_send_json_error('Invalid Request');
		}

		if (wp_verify_nonce($_POST['nonce'], 'my_ajax_nonce')) {
			foreach ($_POST['data'] as $a):
				$name = $a['name'];
				$value = sanitize_text_field($a['value']);
				$toinsert->$name = $value;
			endforeach;
		}

		$now = new DateTime();

		// Insert data into the custom table
		$result = $wpdb->insert(
			$tbl_collections,
			[
				"amount"  => $toinsert->amount,
				"date_collected"  => $toinsert->date_collected,
				"payment_method"  => $toinsert->payment_method,
				"voucher_type"  => $toinsert->voucher_type,
				"card_holder_name"  => $toinsert->card_holder_name,
				"card_number"  => $toinsert->card_number,
				"check_number"  => $toinsert->check_number,
				"check_memo"  => $toinsert->check_memo,
				"status"  => $toinsert->status,
				"user_id" => $toinsert->user_id,
				"date_created" => $now->format('Y-m-d H:i:s'),
				"date_updated" => $now->format('Y-m-d H:i:s')
			]
		);

		// Check if the data was inserted successfully
		if ($result) {
			wp_send_json_success('Data saved successfully!');
		} else {
			wp_send_json_error('Failed to save data.');
		}

		wp_die();
	}


	function ezf_get_collection()
	{
		global $wpdb;
		$tbl_collections = $wpdb->prefix . 'ezf_collections';
		$recId = $_POST['data']['id'];
		$sql = "SELECT * FROM $tbl_collections WHERE id = '$recId'";
		$results = $wpdb->get_results($sql);

		// Check if the data was inserted successfully
		if ($results) {
			wp_send_json_success($results[0]);
		} else {
			wp_send_json_error('Failed to save data.');
		}

		wp_die();
	}

	function ezf_update_collection()
	{
		global $wpdb;
		$tbl_collections = $wpdb->prefix . 'ezf_collections';
		$toupdate = new StdClass();
		$towhere = new StdClass();

		if (!check_ajax_referer('my_ajax_nonce', 'nonce', false)) {
			wp_send_json_error('Invalid Request');
		}

		if (wp_verify_nonce($_POST['nonce'], 'my_ajax_nonce')) {
			foreach ($_POST['data'] as $a):
				if ($a['name'] == 'uid') {
					$name = $a['name'];
					$value = sanitize_text_field($a['value']);
					$towhere->$name = $value;
				} else {
					$name = $a['name'];
					$value = sanitize_text_field($a['value']);
					$toupdate->$name = $value;
				}
			endforeach;
		}

		$now = new DateTime();

		$result = $wpdb->update(
			$tbl_collections,
			[
				"amount"  => $toupdate->amount,
				"date_collected"  => $toupdate->date_collected,
				"payment_method"  => $toupdate->payment_method,
				"voucher_type"  => $toupdate->voucher_type,
				"card_holder_name"  => $toupdate->card_holder_name,
				"card_number"  => $toupdate->card_number,
				"check_number"  => $toupdate->check_number,
				"check_memo"  => $toupdate->check_memo,
				"status"  => $toupdate->status,
				"user_id" => $toupdate->user_id,
				"date_updated" => $now->format('Y-m-d H:i:s')
			],
			[
				"id" =>  $towhere->uid
			]
		);

		// Check if the data was inserted successfully
		if ($result) {
			wp_send_json_success('Data updated successfully!');
		} else {
			wp_send_json_error('Failed to update data.');
		}

		wp_die();
	}

	function ezf_delete_collection()
	{
		global $wpdb;
		$tbl_collections = $wpdb->prefix . 'ezf_collections';
		$towhere = new StdClass();

		if (!check_ajax_referer('my_ajax_nonce', 'nonce', false)) {
			wp_send_json_error('Invalid Request');
		}

		if (wp_verify_nonce($_POST['nonce'], 'my_ajax_nonce')) {
			foreach ($_POST['data'] as $a):
				if ($a['name'] == 'uid') {
					$name = $a['name'];
					$value = sanitize_text_field($a['value']);
					$towhere->$name = $value;
				} 
			endforeach;
		}

		$now = new DateTime();

		$result = $wpdb->delete(
			$tbl_collections,
			[
				"id" =>  $towhere->uid
			]
		);

		// Check if the data was inserted successfully
		if ($result) {
			wp_send_json_success('Data deleted successfully!');
		} else {
			wp_send_json_error('Failed to delete data.');
		}

		wp_die();
	}
}
