<?php
class Eizer_Helper {

	// used for tracking error messages
	function eizer_errors(){
	    static $wp_error; // Will hold global variable safely
	    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
	}

	// displays error messages from form submissions
	function jmsc_show_error_messages() {
		if($codes = $this->jmsc_errors()->get_error_codes()) {
			// echo '<pre>',print_r($codes),'</pre>';
			echo '<div class="jmsc-errors alert alert-danger fade in">';
			echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			    // Loop error codes and display errors
			   foreach($codes as $code){
			        $message = $this->jmsc_errors()->get_error_message($code);
			        echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
			    }
			echo '</div>';
		}
	}

	function jmsc_save_images( $user_id, $file_imgs, $role ) {
		if(count($file_imgs['name']) > 0) {
			$upload = wp_upload_dir();
			$upload_dir = $upload['basedir'];
			$upload_url = $upload['baseurl'];

			$images = array();

		    //Loop through each file
		    for($i=0; $i<count($file_imgs['name']); $i++) {
		      //Get the temp file path
		        $tmpFilePath = $file_imgs['tmp_name'][$i];

		        //Make sure we have a filepath
		        if($tmpFilePath != ""){

		            //save the filename
		            $filename = $file_imgs['name'][$i];

		            if (!file_exists($upload_dir. '/jmsc/'. $role .'/'.$user_id)) {
            			wp_mkdir_p($upload_dir. '/jmsc/'. $role .'/'.$user_id);
	                }
	                $filePath = $upload_dir.'/jmsc/'. $role .'/'.$user_id. '/' . date('m-d-Y-H-i-s') .'-'. $file_imgs['name'][$i];
	                $fileURL = $upload_url.'/jmsc/'. $role .'/'.$user_id. '/' . date('m-d-Y-H-i-s') .'-'. $file_imgs['name'][$i];
		            //Upload the file into the temp dir
		            if(move_uploaded_file($tmpFilePath, $filePath)) {

		                $files[] = $filename;
		                //insert into db
		                //use $shortname for the filename
		                //use $filePath for the relative url to the file
		                $images[] = array( 'filename' => $filename, 'file-url' => $fileURL );
		            }
		        }
		    }

		    $images = maybe_serialize( $images );
		    return $images;
		}
	}

	function jmsc_save_image( $user_id, $file_img, $role ) {
		if(count($file_img['name']) > 0) {
			$upload = wp_upload_dir();
			$upload_dir = $upload['basedir'];
			$upload_url = $upload['baseurl'];

	    	//Get the temp file path
	        $tmpFilePath = $file_img['tmp_name'];

	        //Make sure we have a filepath
	        if($tmpFilePath != ""){

	            //save the filename
	            $filename = $file_img['name'];

	            if (!file_exists($upload_dir. '/jmsc/'. $role .'/'.$user_id)) {
        			wp_mkdir_p($upload_dir. '/jmsc/'. $role .'/'.$user_id);
                }
                $filePath = $upload_dir.'/jmsc/'. $role .'/'.$user_id. '/images/' . date('m-d-Y-H-i-s') .'-'. $file_img['name'];
                $fileURL = $upload_url.'/jmsc/'. $role .'/'.$user_id. '/images/' . date('m-d-Y-H-i-s') .'-'. $file_img['name'];
	            //Upload the file into the temp dir
	            if(move_uploaded_file($tmpFilePath, $filePath)) {
	                // $files[] = $filename;
	                //insert into db
	                //use $shortname for the filename
	                //use $filePath for the relative url to the file
	                // $images[] = array( 'filename' => $filename, 'file-url' => $fileURL );
	                update_user_meta( $user_id, 'jmsc_user_img_name', $filename);
	                update_user_meta( $user_id, 'jmsc_user_img_path', $fileURL );
	                return $fileURL;
	            }
	        }
		}
	}
}