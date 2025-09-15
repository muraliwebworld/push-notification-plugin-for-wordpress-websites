<?php
	// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery
	// This API routines uses 2 stage AES-256-GCM decryption method to decode data sent in Public REST API
	// It decrypts sanitized post REST data "encrypted_data" using AES-256-GCM algorithm method,
	// if decryption is successful then decrypted value is notificationid
	// It then sanitize and validate remaining fields based on notificationid
	// It then retrieves notification_auth_token from table for corresponding push notification using decrypted notificationid,
	// It then decrypts POST REST data "pnfpb_encrypted_auth_token" using AES-256-GCM, 
	// If decrypts is successful(2nd stage) and if decrypted value is equal to notification_auth_token,
	// it then proceeds to increment notification delivery and read counts based on notification id.

	$title = '';
	$content = '';
	$notification_id = '';
	$notification_action = '';
	$useragent = '';
	$subscription_token = '';
	$browser_userAgent = '';
	$ciphertext = '';
	$notify_type = '';
	$cipher = "aes-256-gcm";
	$notificationid_update_status = '';

	global $wpdb;

	$response = [
		"ok" => false,
		"status" => 400,
		"message" => "Decryption failed",
	];

	if (isset($request["encrypted_data"])) {
		$encrypted_data_json = $request["encrypted_data"];
		if ($encrypted_data_json["ciphertext"]) {
			$ciphertext = base64_decode(esc_html(sanitize_text_field(wp_unslash($encrypted_data_json["ciphertext"]))));
		}
		if ($encrypted_data_json["iv"]) {
			$iv = base64_decode(esc_html(sanitize_text_field(wp_unslash($encrypted_data_json["iv"]))));
		}
		if ($encrypted_data_json["tag"]) {
			$tag = base64_decode(esc_html(sanitize_text_field(wp_unslash($encrypted_data_json["tag"]))));
		}

		$passphrase = get_option('pnfpb_ic_fcm_publickey');
		$hash_passphrase = hash('sha256', $passphrase, true);
		$hash_passphrase_hex = bin2hex($hash_passphrase);

		$keyLength = 32; // Desired key length in bytes
		$iv_length = 16;
		$iterations = 10000; // Number of iterations
		$algorithm = 'sha256'; // Hashing algorithm

		//Extract hash key using sha256 algorithm
		$key = hash('sha256', $hash_passphrase_hex, true);
		
		//Decrypt notification id encoded in AES-256-GCM encryption using AES-256-GCM decryption method
		$decrypted = openssl_decrypt($ciphertext, $cipher, $key, OPENSSL_RAW_DATA, $iv,$tag);
		
		//If decryption fails, terminate process and return with status 401 code
		if ($decrypted === false) {
			return new WP_Error('rest_forbidden', 'Missing or invalid authorization token (1st stage)', array('status' => 401));					
		} else {
			
			//If decryption success, decrypt the data and proceed further to increment delivery and read count based on decrypted notification id
			
			$decryptedArray = explode("@!!@", $decrypted);
			
			if (isset($decryptedArray[0])) {
				$notification_id = intval($decryptedArray[0]);
			}

			if (isset($decryptedArray[1])) {
				$subscription_token = esc_html(sanitize_text_field(wp_unslash($decryptedArray[1])));
			}

			if (isset($decryptedArray[2])) {
				$browser_userAgent = esc_html(sanitize_text_field(wp_unslash($decryptedArray[2])));
			}
			
			if (isset($decryptedArray[3])) {
				$notify_type = esc_html(sanitize_text_field(wp_unslash($decryptedArray[3])));
			}			

			if ($notification_id > 0) {
				$total_statistics_table_name =	$wpdb->prefix . "pnfpb_ic_total_statistics_notifications";
				$dbname = $wpdb->dbname;
				$notification_title = '';
				$notification_content = '';
				$notification_auth_token = '';
				$delivered_notification_confirmation = 0;
				$read_notification_confirmation = 0;
				$notificationid_exists_total_table = $wpdb->get_results($wpdb->prepare("SELECT * FROM %i WHERE notificationid = %d", array($total_statistics_table_name,$notification_id)));						
				foreach ($notificationid_exists_total_table as $notification_result) {
					if ($notify_type === 'delivery') {
						$delivered_notification_confirmation = $notification_result->total_delivery_confirmation + 1;
					} else {
						if ($notify_type === 'read') {
							$read_notification_confirmation = $notification_result->total_open_confirmation + 1;
						}
					}
					$notification_title = $notification_result->title;
					$notification_content = $notification_result->content;
					$notification_auth_token = $notification_result->notification_auth_token;
				}

				$encrypted_token_json = $request["pnfpb_encrypted_authtoken"];

				if ($encrypted_token_json["ciphertext"]) {
					$ciphertext = base64_decode(esc_html(sanitize_text_field(wp_unslash($encrypted_token_json["ciphertext"]))));
				}
				if ($encrypted_token_json["iv"]) {
					$iv = base64_decode(esc_html(sanitize_text_field(wp_unslash($encrypted_token_json["iv"]))));
				}
				if ($encrypted_token_json["tag"]) {
					$tag = base64_decode(esc_html(sanitize_text_field(wp_unslash($encrypted_token_json["tag"]))));
				}				
				//Decrypt notification_auth_token encoded in AES-256-GCM encryption using AES-256-GCM decryption method
				$decrypted = openssl_decrypt($ciphertext, $cipher, $key, OPENSSL_RAW_DATA, $iv,$tag);
				
				//If decryption fails, terminate process and return with status 401 code
				if ($decrypted === false && $decrypted === $notification_auth_token) {
					return new WP_Error('rest_forbidden', 'Missing or invalid authorization token (2nd stage)', array('status' => 401));					
				} else {
					if ($notify_type === 'delivery') {
						//If decryption success, proceed further to increment delivery and read count based on decrypted notification id	
						$notificationid_update_status = $wpdb->query($wpdb->prepare("UPDATE %i SET total_delivery_confirmation = %d WHERE notificationid = %d", $total_statistics_table_name,$delivered_notification_confirmation,$notification_id));
					} else {
						if ($notify_type === 'read') {
							$notificationid_update_status = $wpdb->query($wpdb->prepare("UPDATE %i SET total_open_confirmation = %d WHERE notificationid = %d", $total_statistics_table_name,$read_notification_confirmation,$notification_id));
						}
					}
					if ($notificationid_update_status === false) {
						return new WP_Error('rest_forbidden', 'Error in updating deliver count in total counts', array('status' => 400));
					} else {
						$device_id = '';
						$subscribed_deviceids_table_name =	$wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
						$dbname = $wpdb->dbname;
						$subscription_token_exists = $wpdb->get_results($wpdb->prepare("SELECT * FROM %i WHERE subscription_auth_token LIKE %s", array($subscribed_deviceids_table_name,$subscription_token)));	
						foreach ($subscription_token_exists as $subscription_token_exist) {
							$device_id = $subscription_token_exist->device_id;
						}
						$delivery_statistics_table_name = $wpdb->prefix . "pnfpb_ic_delivery_statistics_notifications";
						$dbname = $wpdb->dbname;
						if ($notify_type === 'delivery') {
							$data = array('notificationid' => $notification_id, 'userid' => 0, 'title' => $notification_title, 'content' => $notification_content, 'browser_token' => $subscription_token, 'browser_type' => $browser_userAgent, 'delivery_confirmation' => 1, 'open_confirmation' => 0);
							$insertstatus = $wpdb->insert($delivery_statistics_table_name, $data);
						} else {
							if ($notify_type === 'read'  && $device_id !== '') {
								$notificationid_update_status = $wpdb->query($wpdb->prepare("UPDATE %i SET open_confirmation = %d WHERE notificationid = %d AND browser_token = %s", $delivery_statistics_table_name,1,$notification_id,$subscription_token));
							}
						}
						$response = [
							"ok" => true,
							"status" => 200,
							"message" => "Decrypted message: " . $decrypted,
						];
						$res = new WP_REST_Response($response);
						$res->set_status(200);
						return ["req" => $res, "notification_id" => $notification_id];
					}
				}
			}	
		}				
	}
	return ["req" => $res, "notification_id" => $notification_id];


?>