<?php
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

$img_url = plugin_dir_url(__FILE__) . '../../public/images/';
?>
<div class="container">
<div class="row row-cols-1 row-cols-md-5 g-4">
    <?php if(!empty($users)): ?>
        <?php foreach($users as $user): ?>
  <div class="col">
    <div class="card h-100">
      <img src="<?php echo $img_url; ?>person.png" class="card-img-top" alt="profile image">
      <div class="card-body text-center">
        <h5 class="card-title"><?php echo $user->display_name; ?></h5>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
  <?php endif; ?>
</div>
</div>