<?php
global $wpdb;

// tables
$tbl_redeem = $wpdb->prefix . 'ezf_redeem';
$tbl_users = $wpdb->prefix . 'users';

// Define the role you want to query
$role = 'fundraiser';

// Create a new WP_User_Query instance
$user_query = new WP_User_Query(array(
  'role'    => $role,
  'orderby' => 'display_name', // Optional: Sort users by display name
  'order'   => 'ASC',          // Optional: Sort in ascending order
));

// Get the results
$users = $user_query->get_results();
$redeems = $wpdb->get_results($wpdb->prepare("select $tbl_redeem.*, $tbl_users.display_name from $tbl_redeem LEFT JOIN $tbl_users ON $tbl_users.ID = $tbl_redeem.user_id"));
?>

<div class="container py-5">

  <div class="d-flex gap-3 justify-content-between align-items-center mb-1">
    <h1>Redeems</h1>
  </div>

  <div class="row gap-3 redeemDisplay">
    <?php include plugin_dir_path(dirname(__FILE__)) . 'partials/redeem-display.php'; ?>
  </div>

  <!-- Add Credit Card Machine Modal -->
  <div class="modal fade container-fluid" id="ccmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ccmModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <?php //include plugin_dir_path(dirname(__FILE__)) . 'partials/ccm-insert.php'; ?>
      </div>
    </div>
  </div>

  <!-- Update Credit Card Machine Modal -->
  <div class="modal fade container-fluid" id="updateRedeem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateRedeem" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <?php include plugin_dir_path(dirname(__FILE__)) . 'partials/redeem-update.php'; ?>
      </div>
    </div>
  </div>

  <!-- Delete Credit Card Machine Modal -->
  <div class="modal fade container-fluid" id="deleteRedeem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteRedeem" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <?php include plugin_dir_path(dirname(__FILE__)) . 'partials/redeem-delete.php'; ?>
      </div>
    </div>
  </div>

</div>