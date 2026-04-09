<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
	// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery
	// This API routines uses 2 stage AES-256-GCM decryption method to decode data sent in Public REST API
	// It decrypts sanitized post REST data "encrypted_data" using AES-256-GCM algorithm method,
	// if decryption is successful then decrypted value is notificationid
	// It then sanitize and validate remaining fields based on notificationid
	// It then retrieves notification_auth_token from table for corresponding push notification using decrypted notificationid,
	// It then decrypts POST REST data "pnfpb_encrypted_auth_token" using AES-256-GCM, 
	// If decrypts is successful(2nd stage) and if decrypted value is equal to notification_auth_token,
	// it then proceeds to increment notification delivery and read counts based on notification id.

	$pnfpb_title = '';
	$pnfpb_content = '';
	$pnfpb_notification_id = '';
	$pnfpb_notification_action = '';
	$pnfpb_useragent = '';
	$pnfpb_subscription_token = '';
	$pnfpb_browser_userAgent = '';
	$pnfpb_ciphertext = '';
	$pnfpb_notify_type = '';
	$pnfpb_cipher = "aes-256-gcm";
	$pnfpb_notificationid_update_status = '';

	global $wpdb;

	$pnfpb_response = [
		"ok" => false,
		"status" => 400,
		"message" => "Decryption failed",
	];

	if (isset($pnfpb_request["encrypted_data"]) && get_option("pnfpb_ic_fcm_turnonoff_delivery_notifications") === '1') {
		$pnfpb_encrypted_data_json = $pnfpb_request["encrypted_data"];
		if ($pnfpb_encrypted_data_json["ciphertext"]) {
			$pnfpb_ciphertext = base64_decode(esc_html(sanitize_text_field(wp_unslash($pnfpb_encrypted_data_json["ciphertext"]))));
		}
		if ($pnfpb_encrypted_data_json["iv"]) {
			$pnfpb_iv = base64_decode(esc_html(sanitize_text_field(wp_unslash($pnfpb_encrypted_data_json["iv"]))));
		}
		if ($pnfpb_encrypted_data_json["tag"]) {
			$pnfpb_tag = base64_decode(esc_html(sanitize_text_field(wp_unslash($pnfpb_encrypted_data_json["tag"]))));
		}

		$pnfpb_passphrase = get_option('pnfpb_ic_fcm_publickey');
		$pnfpb_hash_passphrase = hash('sha256', $pnfpb_passphrase, true);
		$pnfpb_hash_passphrase_hex = bin2hex($pnfpb_hash_passphrase);

		$pnfpb_keyLength = 32; // Desired key length in bytes
		$pnfpb_iv_length = 16;
		$pnfpb_iterations = 10000; // Number of iterations
		$pnfpb_algorithm = 'sha256'; // Hashing algorithm

		//Extract hash key using sha256 algorithm
		$pnfpb_key = hash('sha256', $pnfpb_hash_passphrase_hex, true);
		
		//Decrypt notification id encoded in AES-256-GCM encryption using AES-256-GCM decryption method
		$pnfpb_decrypted = openssl_decrypt($pnfpb_ciphertext, $pnfpb_cipher, $pnfpb_key, OPENSSL_RAW_DATA, $pnfpb_iv,$pnfpb_tag);
		
		//If decryption fails, terminate process and return with status 401 code
		if ($pnfpb_decrypted === false) {
			return new WP_Error('rest_forbidden', 'Missing or invalid authorization token (1st stage)', array('status' => 401));					
		} else {
			
			//If decryption success, decrypt the data and proceed further to increment delivery and read count based on decrypted notification id
			
			$pnfpb_decryptedArray = explode("@!!@", $pnfpb_decrypted);
			
			if (isset($pnfpb_decryptedArray[0])) {
				$pnfpb_notification_id = intval($pnfpb_decryptedArray[0]);
			}

			if (isset($pnfpb_decryptedArray[1])) {
				$pnfpb_subscription_token = esc_html(sanitize_text_field(wp_unslash($pnfpb_decryptedArray[1])));
			}

			if (isset($pnfpb_decryptedArray[2])) {
				$pnfpb_browser_userAgent = esc_html(sanitize_text_field(wp_unslash($pnfpb_decryptedArray[2])));
			}
			
			if (isset($pnfpb_decryptedArray[3])) {
				$pnfpb_notify_type = esc_html(sanitize_text_field(wp_unslash($pnfpb_decryptedArray[3])));
			}			

			if ($pnfpb_notification_id > 0) {
				$pnfpb_total_statistics_table_name =	$wpdb->prefix . "pnfpb_ic_total_statistics_notifications";
				$pnfpb_dbname = $wpdb->dbname;
				$pnfpb_notification_title = '';
				$pnfpb_notification_content = '';
				$pnfpb_notification_auth_token = '';
				$pnfpb_delivered_notification_confirmation = 0;
				$pnfpb_read_notification_confirmation = 0;
				$pnfpb_notificationid_exists_total_table = [];
				$pnfpb_notificationid_exists_total_table = $wpdb->get_results($wpdb->prepare("SELECT * FROM %i WHERE notificationid = %d",$pnfpb_total_statistics_table_name,$pnfpb_notification_id));
				foreach ($pnfpb_notificationid_exists_total_table as $pnfpb_notification_result) {
					if ($pnfpb_notify_type === 'delivery') {
						$pnfpb_delivered_notification_confirmation = $pnfpb_notification_result->total_delivery_confirmation + 1;
					} else {
						if ($pnfpb_notify_type === 'read') {
							$pnfpb_read_notification_confirmation = $pnfpb_notification_result->total_open_confirmation + 1;
						} else {
							if ($pnfpb_notify_type === 'read_receipt_webview') {
								$pnfpb_read_notification_confirmation = $pnfpb_notification_result->total_open_confirmation + 1;
								$pnfpb_delivered_notification_confirmation = $pnfpb_notification_result->total_delivery_confirmation + 1;
							}							
						}
					}
					$pnfpb_notification_title = $pnfpb_notification_result->title;
					$pnfpb_notification_content = $pnfpb_notification_result->content;
					$pnfpb_notification_auth_token = $pnfpb_notification_result->notification_auth_token;
				}
				
				if ($pnfpb_notify_type === 'read_receipt_webview') {
					$pnfpb_notification_auth_token = $pnfpb_key.strval($pnfpb_notification_id);
				}

				$pnfpb_encrypted_token_json = $pnfpb_request["pnfpb_encrypted_authtoken"];

				if ($pnfpb_encrypted_token_json["ciphertext"]) {
					$pnfpb_ciphertext = base64_decode(esc_html(sanitize_text_field(wp_unslash($pnfpb_encrypted_token_json["ciphertext"]))));
				}
				if ($pnfpb_encrypted_token_json["iv"]) {
					$pnfpb_iv = base64_decode(esc_html(sanitize_text_field(wp_unslash($pnfpb_encrypted_token_json["iv"]))));
				}
				if ($pnfpb_encrypted_token_json["tag"]) {
					$pnfpb_tag = base64_decode(esc_html(sanitize_text_field(wp_unslash($pnfpb_encrypted_token_json["tag"]))));
				}				
				//Decrypt notification_auth_token encoded in AES-256-GCM encryption using AES-256-GCM decryption method
				$pnfpb_decrypted = openssl_decrypt($pnfpb_ciphertext, $pnfpb_cipher, $pnfpb_key, OPENSSL_RAW_DATA, $pnfpb_iv,$pnfpb_tag);
				
				//If decryption fails, terminate process and return with status 401 code
				if ($pnfpb_decrypted === false && $pnfpb_decrypted === $pnfpb_notification_auth_token) {
					return new WP_Error('rest_forbidden', 'Missing or invalid authorization token (2nd stage)', array('status' => 401));					
				} else {
					if ($pnfpb_notify_type === 'delivery') {
						//If decryption success, proceed further to increment delivery and read count based on decrypted notification id	
						$pnfpb_notificationid_update_status = $wpdb->query($wpdb->prepare("UPDATE %i SET total_delivery_confirmation = %d WHERE notificationid = %d", $pnfpb_total_statistics_table_name,$pnfpb_delivered_notification_confirmation,$pnfpb_notification_id));
					} else {
						if ($pnfpb_notify_type === 'read') {
							$pnfpb_notificationid_update_status = $wpdb->query($wpdb->prepare("UPDATE %i SET total_open_confirmation = %d WHERE notificationid = %d", $pnfpb_total_statistics_table_name,$pnfpb_read_notification_confirmation,$pnfpb_notification_id));
						} else {
							if ($pnfpb_notify_type === 'read_receipt_webview') {
								$pnfpb_notificationid_update_status = $wpdb->query($wpdb->prepare("UPDATE %i SET total_open_confirmation = %d,total_delivery_confirmation = %d WHERE notificationid = %d", $pnfpb_total_statistics_table_name,$pnfpb_read_notification_confirmation,$pnfpb_delivered_notification_confirmation,$pnfpb_notification_id));
							}							
						}
					}
					if ($pnfpb_notificationid_update_status === false) {
						return new WP_Error('rest_forbidden', 'Error in updating deliver count in total counts', array('status' => 400));
					} else {
						$pnfpb_delivery_statistics_table_name = $wpdb->prefix . "pnfpb_ic_delivery_statistics_notifications";
						$pnfpb_dbname = $wpdb->dbname;
						if ($pnfpb_notify_type === 'delivery' || $pnfpb_notify_type === 'read_receipt_webview' ) {
							$pnfpb_open_confirmation = 0;
							if ($pnfpb_notify_type === 'read_receipt_webview') {
								$pnfpb_open_confirmation = 1;
							}
							$pnfpb_data = array('notificationid' => $pnfpb_notification_id, 'userid' => 0, 'title' => $pnfpb_notification_title, 'content' => $pnfpb_notification_content, 'browser_token' => $pnfpb_subscription_token, 'browser_type' => $pnfpb_browser_userAgent, 'delivery_confirmation' => 1, 'open_confirmation' => $pnfpb_open_confirmation);
							$pnfpb_insertstatus = $wpdb->insert($pnfpb_delivery_statistics_table_name, $pnfpb_data);
						} else {
							if ($pnfpb_notify_type === 'read') {
								$pnfpb_open_confirmation = 1;
								$pnfpb_data = array('notificationid' => $pnfpb_notification_id, 'userid' => 0, 'title' => $pnfpb_notification_title, 'content' => $pnfpb_notification_content, 'browser_token' => $pnfpb_subscription_token, 'browser_type' => $pnfpb_browser_userAgent, 'delivery_confirmation' => 1, 'open_confirmation' => $pnfpb_open_confirmation);
								$pnfpb_insertstatus = $wpdb->insert($pnfpb_delivery_statistics_table_name, $pnfpb_data);
							} 
						}
						$pnfpb_response = [
							"ok" => true,
							"status" => 200,
							"message" => "Decrypted message: " . $pnfpb_decrypted,
						];
						$pnfpb_res = new WP_REST_Response($pnfpb_response);
						$pnfpb_res->set_status(200);
						return ["req" => $pnfpb_res, "notification_id" => $pnfpb_notification_id];
					}
				}
			}	
		}
	} else {
		return new WP_Error('rest_forbidden', 'Missing authorization token', array('status' => 401));
	}

?>