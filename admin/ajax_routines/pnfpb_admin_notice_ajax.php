<?php

/************************************************************************************
 * To update Firebase service account credentials uploaded  
 * via PNFPB plugin Admin settings to WordPress options table for Push notifications.
 ************************************************************************************/

	if (isset($_POST['calltype']) && $_POST['calltype'] === 'pnfpb_service_account_upload') {
		// Check the nonce first
  		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field(wp_unslash($_POST['nonce'])), 'icpushadmincallback' ) ) {
    		echo 'Security validation failed.';
  		} else {
			if (is_user_logged_in() && isset($_FILES['file']) && isset($_FILES['file']['tmp_name']) ) {
				
				$user_info = get_userdata( get_current_user_id() );

    			// Call globals
    			global $wp_filesystem;

   				// Initiate
    			WP_Filesystem();
     
    			$local_file =   wp_strip_all_tags(sanitize_text_field($_FILES['file']['tmp_name']));
    			$file_content    =   '';
 
    			if ( $wp_filesystem->exists( $local_file ) ) {

        			// following is alternate to

        			$file_content =  $wp_filesystem->get_contents( $local_file );
					
					update_option('pnfpb_sa_json_data',$file_content);

    			} else {
					
					echo 'wp_filesystem upload failed';
					
				}
				
			}
			else {
				echo 'failed';
			}
		} 
	} else {
		if (isset($_POST['calltype']) && $_POST['calltype'] === 'pnfpb_ondemand_push_select_user') {
			// Check the nonce first
  			if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field(wp_unslash($_POST['nonce'])), 'icpushadmincallback' ) ) {
    			echo 'Security validation failed.';
  			} else {
				$search_term = isset($_POST['pnfpb_ic_on_demand_push_select_user']) ? sanitize_text_field(wp_unslash($_POST['pnfpb_ic_on_demand_push_select_user'])) : '';
				$args = array(
					'search' => '*' . $search_term . '*',
					'search_columns' => array('user_login', 'user_email', 'display_name'),
					'fields' => array('ID', 'display_name', 'user_email'),
					'number' => 50
				);
				$users = get_users($args);

				$results = array();
				foreach ($users as $user) {
					$results[] = array(
						'label' => $user->display_name,
						'value' => $user->ID,
						'email' => $user->user_email,
					);
				}

				wp_send_json($results);
			}
		} else {
			// Check the nonce first
  			if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field(wp_unslash($_POST['nonce'])), 'icpushadmincallback' ) ) {
    			echo 'Security validation failed.';
			} else {
				update_option('PNFBP_admin_notice','notalive');
				echo 'Admin notice dismissed';
			}
		}
	}
	wp_die();
?>