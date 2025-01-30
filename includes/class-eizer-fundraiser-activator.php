<?php

/**
 * Fired during plugin activation
 *
 * @link       https://#
 * @since      1.0.0
 *
 * @package    Eizer_Fundraiser
 * @subpackage Eizer_Fundraiser/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Eizer_Fundraiser
 * @subpackage Eizer_Fundraiser/includes
 * @author     Anthony Canol <hay.an2ny@gmail.com>
 */
class Eizer_Fundraiser_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		/**
		 * Create collections records
		 */
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();
		$tbl_collections = $wpdb->prefix . 'ezf_collections';

		$sql_collection = "CREATE TABLE $tbl_collections (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			user_id mediumint(9) NOT NULL,
			amount decimal(19,4) NULL default NULL,
			email varchar(100) NOT NULL,
			card_holder_name text,
			card_number text,
			voucher_type varchar(255),
			check_number text,
			check_memo text,
			date_collected datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			payment_method varchar(255) DEFAULT 'Credit Card',
			status varchar(25) DEFAULT 'pending',
			date_created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			date_updated datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql_collection);

		/**
		 * Add Fundraiser user roles
		 */
		add_role( 'fundraiser', __( 'Fundraiser' ),
			array()
		);

		flush_rewrite_rules();
	}
}
