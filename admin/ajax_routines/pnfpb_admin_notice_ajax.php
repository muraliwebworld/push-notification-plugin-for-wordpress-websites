<?php

/************************************************************************************
 * To update Firebase service account credentials uploaded  
 * via PNFPB plugin Admin settings to WordPress options table for Push notifications.
 ************************************************************************************/

	if (isset($_POST['calltype']) && $_POST['calltype'] === 'pnfpb_service_account_upload') {
		// Check the nonce first
  		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'icpushadmincallback' ) ) {
    		echo 'Security validation failed.';
  		} else {
			if (is_user_logged_in() && isset($_FILES['file'])) {
				$user_info = get_userdata( get_current_user_id() );
				$file_content=file_get_contents($_FILES['file']['tmp_name']);
				update_option('pnfpb_sa_json_data',$file_content);
			}
			else {
				echo 'failed';
			}
		} 
	} else {
		update_option('PNFBP_admin_notice','notalive');
		echo 'Admin notice dismissed';
	}
	wp_die();
?>