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

		// print_r($_POST['data']);
		// check_ajax_referer('my_ajax_nonce', 'nonce'); // Verify nonce for security
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

		// $test = parse_str($_POST['data']);
		/*if (isset( $_POST["jmsc_user_email"] ) && isset( $_POST["jmsc_user_member_role"] ) && wp_verify_nonce($_POST['jmsc_user_register_nonce'], 'jmsc-user-register-nonce')) {
			if ( $_POST["jmsc_user_member_role"] == 'nanny' ) {
			  $field_keys = array(); // for variable reference
			  foreach ($_POST as $key => $value) {

				  // remove jmsc_user_
				  ${substr( $key, 10)} = isset( $key ) ? ( is_array( $value ) ? array_map( 'sanitize_text_field', $value) : sanitize_text_field($value) ) : '';

				  $field_keys[] = substr( $key, 10);
			  }

			  // this is required for username checks
			  require_once(ABSPATH . WPINC . '/registration.php');

			  if($email == '') {
				  // empty username
				  $this->helper->jmsc_errors()->add('email_empty', __('Please enter a email'));
			  }else if(!is_email($email)) {
				  //invalid email
				  $this->helper->jmsc_errors()->add('email_invalid', __('Invalid email'));
			  }

			  if(email_exists($email)) {
				  //Email address already registered
				  $this->helper->jmsc_errors()->add('email_used', __('Email already registered'));
			  }

			  if($email != $email_confirm) {
				  // passwords do not match
				  $this->helper->jmsc_errors()->add('email_mismatch', __('Email do not match'));
			  }

			  if($pass == '') {
				  $this->helper->jmsc_errors()->add('password_empty', __('Please enter a password'));
			  }

			  if($pass != $pass_confirm) {
				  // passwords do not match
				  $this->helper->jmsc_errors()->add('password_mismatch', __('Passwords do not match'));
			  }

			  if($fname == '') {
				  // empty fname
				  $this->helper->jmsc_errors()->add('firstname_empty', __('Please enter firstname'));
			  }

			  if($lname == '') {
				  // empty lname
				  $this->helper->jmsc_errors()->add('lastname_empty', __('Please enter lastname'));
			  }

			  if($nationality == '') {
				  // empty nationality
				  $this->helper->jmsc_errors()->add('nationality_empty', __('Please enter nationality'));
			  }

			  if(!$job_type) {
				  // empty job type
				  $this->helper->jmsc_errors()->add('jobtype_empty', __('Please select at least 1 type of job desired'));
			  }

			  if(!isset($_FILES['jmsc_user_img']) || $_FILES['jmsc_user_img']['error'] == UPLOAD_ERR_NO_FILE) {
				  // empty img
				  $this->helper->jmsc_errors()->add('img_empty', __('Please upload image'));
			  }

			  $errors = $this->helper->jmsc_errors()->get_error_messages();

			  $job_type = implode(',', $job_type);

			  $job_experiences = array();

			  if ( strpos( $job_type, 'child-care') > -1 ) {
				  $job_experiences['child-care'] = $child_care_exp;
			  }

			  if ( strpos( $job_type, 'senior-care') > -1 ) {
				  $job_experiences['senior-care'] = $senior_care_exp;
			  }

			  if ( strpos( $job_type, 'house-keeping') > -1 ) {
				  $job_experiences['house-keeping'] = $house_keeping_exp;
			  }

			  $job_experiences = maybe_serialize( $job_experiences );

			  $side_jobs = implode(',', $side_jobs);

			  // if ( $work_type == 'part-time' )
			  // 	$schedule = implode(',', $schedule_part);
			  // else if ( $work_type == 'full-time' )
			  // 	$schedule = $schedule_full;

			  $schedule = implode(',', $schedule);

			  // $shift_time = $start_shift.','.$end_shift;
			  $available_time = $time_in.','.$time_out;

			  $temp_reference = array();

			  if ( $reference_1_name ) {
				  $reference_1 = array(
					  'name' 		=> $reference_1_name,
					  'relation' 	=> $reference_1_relation,
					  'phone' 	=> $reference_1_phone,
					  'email' 	=> $reference_1_email,
					  );
				  $temp_reference[] = $reference_1;
			  }

			  if ( $reference_2_name ) {
				  $reference_2 = array(
					  'name' 		=> $reference_2_name,
					  'relation' 	=> $reference_2_relation,
					  'phone' 	=> $reference_2_phone,
					  'email' 	=> $reference_2_email,
					  );
				  $temp_reference[] = $reference_2;
			  }

			  $reference = maybe_serialize( $temp_reference );

			  // only create the user in if there are no errors
			  if(empty($errors)) {
				  $new_user_id = wp_insert_user(array(
						  'user_login'		=> $email,
						  'user_pass'	 		=> $pass,
						  'user_email'		=> $email,
						  'first_name'		=> $fname,
						  'last_name'			=> $lname,
						  'user_registered'	=> date('Y-m-d H:i:s'),
						  'role'				=> 'nanny'
					  )
				  );

				  $upload = wp_upload_dir();
				  $upload_dir = $upload['basedir'];
				  $upload_url = $upload['baseurl'];

				  if (!file_exists($upload_dir. '/jmsc/nanny/'.$new_user_id)) {
					  wp_mkdir_p($upload_dir. '/jmsc/nanny/'.$new_user_id);
					  wp_mkdir_p($upload_dir. '/jmsc/nanny/'.$new_user_id.'/images' );
					  wp_mkdir_p($upload_dir. '/jmsc/nanny/'.$new_user_id.'/files' );
				  }

				  if($new_user_id) {
					  update_user_meta( $new_user_id, 'jmsc_payment_status', 'unpaid' );

					  // $jmsc_user_imgs = $this->jmsc_save_images( $jmsc_new_user_id, $_FILES['jmsc_user_imgs'] );
					  $img_upload = $_FILES['jmsc_user_img'];
					  $img_url = $this->helper->jmsc_save_image( $new_user_id, $img_upload, 'nanny' );

					  global $wpdb;
					  $is_user_added = $wpdb->insert( $wpdb->prefix . 'jmsc_nannies' , array(
						  'user_id' 				=> $new_user_id,
						  'first_name' 			=> $fname,
						  'last_name' 			=> $lname,
						  'email' 				=> $email,
						  'age' 					=> $age,
						  'nationality' 			=> $nationality,
						  'primary_phone' 		=> $primary_phone,
						  'secondary_phone' 		=> $secondary_phone,
						  'gender' 				=> $gender,
						  'address' 				=> $address,
						  'city' 					=> $city,
						  'state' 				=> $state,
						  'zip_code' 				=> $zip_code,
						  'travel_distance' 		=> $travel_distance,
						  'job_type' 				=> $job_type,
						  'job_experiences' 		=> $job_experiences,
						  'side_jobs' 			=> $side_jobs,
						  'own_car'				=> strpos( $side_jobs, 'transportation' ) ? $own_car : '',
						  'driver_license'		=> strpos( $side_jobs, 'transportation' ) ? $driver_license : '',
						  'work_type' 			=> $work_type,
						  'schedule' 				=> $schedule ? $schedule : '',
						  'available_time'		=> $available_time,
						  'education' 			=> $education,
						  'school' 				=> $school,
						  'yr_grad_stopped' 		=> $yr_grad,
						  'hobbies' 				=> $hobbies,
						  'reference'				=> $reference,
						  'payment'				=> $payment,
						  'hourly_rate' 			=> $hourly_rate ? $hourly_rate : '',
						  'weekly_rate' 			=> $weekly_rate ? $weekly_rate : '',
						  'daily_rate' 			=> $daily_rate ? $daily_rate : '',
						  'availability'			=> $availability ? $availability : 'yes',
						  )
					  );

					  if ( $is_user_added ) {
						  update_user_meta( $new_user_id, 'jmsc_user_status', 'pending' );

						  // // send an email to the admin alerting them of the registration
						  wp_new_user_notification($new_user_id);

						  // // log the new user in
						  wp_setcookie($email, $pass, true);
						  wp_set_current_user($new_user_id, $email);
						  do_action('wp_login', $email);

						  // // send the newly created user to the payment page after logging them in
						  $payment_page = isset( $_POST["jmsc_payment_page"] ) ? $_POST["jmsc_payment_page"] : '';
						  wp_redirect( site_url().'/'.$payment_page ); exit;
					  } else {
						  require_once(ABSPATH.'wp-admin/includes/user.php' );
						  // $wpdb->show_errors();
						  // $wpdb->print_error();
						  // $wpdb->last_error;
						  wp_delete_user( $new_user_id );
						  $this->helper->jmsc_errors()->add('registration_failed', __('Registration failed please try again.'));
					  }
				  }
			  }
			}
	  }*/
	  echo 'done';
		wp_die();
	}
}
