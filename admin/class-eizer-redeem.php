<?php
class Eizer_Redeem_Admin
{
	public function __construct()
	{  
        
	}

    public function ezf_add_new_ccm()
    {
        global $wpdb;
        $tbl_cc_machine = $wpdb->prefix . 'ezf_cc_machine';
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
            $tbl_cc_machine,
            [
                "cc_machine_name"  => $toinsert->ccm_name,
                "cc_machine_number"  => $toinsert->ccm_number,
                "status"  => $toinsert->ccm_add_status,
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

    function ezf_get_redeem()
    {
        global $wpdb;
        $tbl_redeem = $wpdb->prefix . 'ezf_redeem';
        $recId = $_POST['data']['id'];
        $sql = "SELECT * FROM $tbl_redeem WHERE id = '$recId'";
        $results = $wpdb->get_results($sql);

        // Check if the data was inserted successfully
        if ($results) {
            wp_send_json_success($results[0]);
        } else {
            wp_send_json_error('Failed to save data.');
        }

        wp_die();
    }

    function ezf_update_redeem()
    {
        global $wpdb;
        $tbl_redeem = $wpdb->prefix . 'ezf_redeem';
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
            $tbl_redeem,
            [
                "user_id"  => $toupdate->user_id,
                "amount"  => $toupdate->redeem_update_amount,
                "check_number"  => $toupdate->redeem_update_check_number,
                "check_name"  => $toupdate->redeem_update_check_name,
                "check_memo"  => $toupdate->redeem_update_check_memo,
                "status"  => $toupdate->ccm_update_status,
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

    function ezf_delete_redeem()
    {
        global $wpdb;
        $tbl_redeem = $wpdb->prefix . 'ezf_redeem';
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
            $tbl_redeem,
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