<?php
global $wpdb;

// tables
$tbl_cc_machine = $wpdb->prefix . 'ezf_cc_machine';
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
$ccms = $wpdb->get_results($wpdb->prepare("select $tbl_cc_machine.*, $tbl_users.display_name from $tbl_cc_machine LEFT JOIN $tbl_users ON $tbl_users.ID = $tbl_cc_machine.user_id"));
?>

<div class="container py-5">

  <div class="d-flex gap-3 justify-content-between align-items-center mb-1">
    <h1>Credit Card Machines</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ccmModal">Add</button>
  </div>

  <div class="row gap-3 ccmDisplay">
    <?php include plugin_dir_path(dirname(__FILE__)) . 'partials/ccm-display.php'; ?>
  </div>

  <!-- Add Credit Card Machine Modal -->
  <div class="modal fade container-fluid" id="ccmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ccmModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <?php include plugin_dir_path(dirname(__FILE__)) . 'partials/ccm-insert.php'; ?>
      </div>
    </div>
  </div>

  <!-- Update Credit Card Machine Modal -->
  <div class="modal fade container-fluid" id="updateCcm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateCcm" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <?php include plugin_dir_path(dirname(__FILE__)) . 'partials/ccm-update.php'; ?>
      </div>
    </div>
  </div>

  <!-- Delete Credit Card Machine Modal -->
  <div class="modal fade container-fluid" id="deleteCCM" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteCCM" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <?php include plugin_dir_path(dirname(__FILE__)) . 'partials/ccm-delete.php'; ?>
      </div>
    </div>
  </div>

</div>