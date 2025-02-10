<?php
class Eizer_Redeem
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

    function ezf_add_new_redeem()
    {
        global $wpdb;
        $tbl_redeem = $wpdb->prefix . 'ezf_redeem';
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
            $tbl_redeem,
            [
                "amount"  => $toinsert->amount,
                "check_name"  => $toinsert->check_name,
                "check_number"  => $toinsert->check_number,
                "check_memo"  => $toinsert->check_memo,
                "status"  => $toinsert->redeem_add_status,
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
                "amount"  => $toupdate->redeem_update_amount,
                "check_name"  => $toupdate->redeem_update_check_name,
                "check_number"  => $toupdate->redeem_update_check_number,
                "check_memo"  => $toupdate->redeem_update_check_memo,
                "status"  => $toupdate->redeem_update_status,
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
