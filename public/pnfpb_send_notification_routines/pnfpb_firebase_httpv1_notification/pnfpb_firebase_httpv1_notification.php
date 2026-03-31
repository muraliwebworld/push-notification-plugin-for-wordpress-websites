<?php
use WpOrg\Requests\Requests;

/** Firebase httpv1 api send push notification routine
 *
 * @since 1.65 version
 *
 * Send notification to all users and also to users who are subscribed to following notifications
 *
 * Post, custom post types, activities, group activities, comments, new memeber joined
 * Group invite, group update, avatar change, cover image change
 */
if (!class_exists("PNFPB_firebase_httpv1_notification_class")) {
	
    class PNFPB_firebase_httpv1_notification_class
    {
        public function PNFPB_firebase_httpv1_notification(
            $pushid = 0,
            $pushtitle = "",
            $pushcontent = "",
            $pushicon = "",
            $pushimageurl = "",
            $pushclickurl = "",
            $pushextradata = [],
            $target_device_ids = [],
            $deviceidswebview = [],
            $senderid = 0,
            $receiverid = 0,
            $pushtype = "",
            $grouppush = "",
            $groupid = 0,
			$post_topic_count = 0
        ) {
			global $wpdb;

			$pnfpb_firebase_project = get_option("pnfpb_ic_fcm_projectid");
			
			$topic = '';

			// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

			$url = "https://fcm.googleapis.com/v1/projects/{$pnfpb_firebase_project}/messages:send";
			
			$token = wp_get_session_token();
			$i     = wp_nonce_tick();
			$notification_token = substr( wp_hash( $i . '|' . $token, 'nonce' ), -12, 10 );
			if ($senderid > 0 && $pushtype !== "ondemand" && $pushtype !== "post" && function_exists('bp_core_fetch_avatar')) {
				$pushicon = bp_core_fetch_avatar([
					"item_id" => $senderid, // output user id of post author
					"type" => "full",
					"html" => false, // FALSE = return url, TRUE (default) = return url wrapped with html
				]);
			}

			if (
				($pushtype === "privatemessages" ||
					$pushtype === "friendshiprequest" ||
					$pushtype === "friendshipaccepted" ||
					$pushtype === "groupinvite" ||
					$pushtype === "mycomments") &&
				count($target_device_ids) > 0 && $receiverid > 0
			) {
				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

				$deviceidswebviewcheck = $wpdb->get_col(
					$wpdb->prepare(
						"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id LIKE %s AND device_id NOT LIKE %s AND userid = %d ORDER BY id DESC LIMIT 1000",
						$table_name,
						"%webview%",
						"%@N%",
						$receiverid
					)
				);

				if (count($deviceidswebviewcheck) > 0) {
					$pushclickurl = "";
				}
			}

			$pushcontent = mb_substr(
				stripslashes(
					wp_strip_all_tags(
						urldecode(trim(htmlspecialchars_decode($pushcontent)))
					)
				),
				0,
				130,
				"UTF-8"
			);

			$pushcontent = preg_replace("/\r|\n/", " ", $pushcontent);

			$pushicon = str_replace("&#038;", "&", $pushicon);

			$pushimageurl = str_replace("&#038;", "&", $pushimageurl);

			// prepare the message
			$message = [
				"title" => trim($pushtitle),
				"body" => $pushcontent,
				"image" => $pushimageurl,
			];

			$renotify = false;

			if (
				get_option("pnfpb_ic_fcm_renotify_notification") &&
				get_option("pnfpb_ic_fcm_renotify_notification") === "1"
			) {
				$renotify = true;
			}

			$pnfpb_tag = "";

			if (
				get_option("pnfpb_ic_fcm_replace_notifications") &&
				get_option("pnfpb_ic_fcm_replace_notifications") === "1"
			) {
				$pnfpb_tag = "PNFPB_webpush";
			}

			$pushdataarray = [];

			$pushtimestamp = strval(time());

			$androidarray = [
				"title" => trim($pushtitle),
				"body" => $pushcontent,
				"click_action" => "FLUTTER_NOTIFICATION_CLICK",
				"image" => $pushimageurl,
				"android_notification_id" => $pushtimestamp,
				"notification_auth_token" => $notification_token
			];

			if (is_array($pushextradata) && array_key_exists("click_url", $pushextradata)) {
				
				if (get_option("permalink_structure") !== false) {	
					$pushextradata["click_url"] = $pushextradata["click_url"].'#/notification-id/'.$pushtimestamp;
				} else {
					$pushextradata["click_url"] = $pushextradata["click_url"].'?notification-id='.$pushtimestamp;
				}
				
				$pushdataarray = array_merge($androidarray, $pushextradata);
			} else {
				$pushdataarray = array_merge($androidarray, $pushdataarray);
			}

			$webpushoptions = [
				"notification" => [
					"title" => trim($pushtitle),
					"body" => $pushcontent,
					"image" => $pushimageurl,
					"icon" => $pushicon,
					"link" => $pushclickurl,
					"action" => [
						["action" => "close_notification", "title" => "Dismiss"],
						["action" => "read_more", "title" => "Read More"],
					],
					"tag" => $pnfpb_tag,
					"renotify" => $renotify,
				],
				"data" => [
					"notification_id" => $pushtimestamp,
					"notification_auth_token" => $notification_token,
					"notification_firebase_topic" => $pushtype
				],
				"fcm_options" => [
					"link" => $pushclickurl,
					'analytics_label' => 'pnfpb-analytics-label',
				],
			];

			$androidoptions = [
				"notification" => [
					"title" => trim($pushtitle),
					"body" => $pushcontent,
					"click_action" => "OPEN_MAIN_ACTIVITY",
					"image" => $pushimageurl,
					"tag" => $pnfpb_tag,
				],
			];

			$iosoptions = [
				"payload" => [
					"aps" => [
						"alert" => [
							"title" => trim($pushtitle),
							"body" => $pushcontent,
						],
						"badge" => 0,
						"mutable-content" => 1,
						"content-available" => 1,
					],
				],
				"fcm_options" => [
					"image" => $pushimageurl,
				],
			];

			$topic = "pnfpbgeneral";
			$pnfpb_send_notifications = [];

			if (
				$pushtype === "privatemessages" ||
				$pushtype === "bpfollower" ||
				$pushtype === "friendshiprequest" ||
				$pushtype === "friendshipaccepted" ||
				$pushtype === "markasfavourite" ||
				$pushtype === "groupinvite" ||
				$pushtype === "contactus" ||
				$pushtype === "newuserregistration" ||
				$pushtype === "mycomments"
			) {
				if (count($target_device_ids) > 0) {
					
					$pnfpb_oauth_timestamp = get_option('pnfpb_firebase_oauth_timestamp');
					$pnfpb_fbauth_token = get_option("pnfpb_firebase_oauth_token");
					$pnfpb_one_hour_ago_timestamp = strtotime('-1 hour');
					if ($pnfpb_fbauth_token === false || $pnfpb_fbauth_token === '' 
						|| $pnfpb_oauth_timestamp === false || $pnfpb_oauth_timestamp === ''
						|| !is_numeric($pnfpb_oauth_timestamp)
						|| (is_numeric($pnfpb_oauth_timestamp) && $pnfpb_oauth_timestamp < $pnfpb_one_hour_ago_timestamp)) {
						$key = json_decode(get_option("pnfpb_sa_json_data"), true);
						$now = time();

						// 1. Create JWT Header
						$header = json_encode(['typ' => 'JWT', 'alg' => 'RS256']);

						// 2. Create JWT Payload
						$payload = json_encode([
							'iss' => $key['client_email'],
							'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
							'aud' => $key['token_uri'],
							'exp' => $now + 3600, // Token valid for 1 hour
							'iat' => $now
						]);

						// 3. Base64URL Encode
						$base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
						$base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
						$jwt = $base64UrlHeader . '.' . $base64UrlPayload;

						// 4. Sign JWT using Private Key
						$signature = '';
						openssl_sign($jwt, $signature, $key['private_key'], 'SHA256');
						$base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

						$jwt = $jwt . '.' . $base64UrlSignature;

						// 5. Exchange JWT for OAuth2 Token
						$args = [
							'body' => [
								'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
								'assertion' => $jwt
							]
						];

						$response = wp_remote_post($key['token_uri'], $args);

						if (is_wp_error($response)) {
							error_log(serialize($response));
						} else {
							$data = json_decode(wp_remote_retrieve_body($response), true);
							if (isset($data['access_token'])) {
								$pnfpb_fbauth_token = $data['access_token'];
								update_option("pnfpb_firebase_oauth_token", $data['access_token']);
								update_option("pnfpb_firebase_oauth_timestamp", strtotime('now'));						
							}	
						}						
					
					}
			
					if ($pushtype === 'bpfollower') {
						
						$urladd = "https://iid.googleapis.com/iid/v1:batchAdd";
						
						$topicpath = "/topics/pnfpb_buddypress_followers_".$receiverid;

						$topicname = "pnfpb_buddypress_followers_".$receiverid;

						$headers = [
							"Authorization" => "Bearer " . $pnfpb_fbauth_token,
							"Content-Type" => "application/json",
							"access_token_auth" => "true",
						];
						
						$pnfpb_table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
						
						$pnfpb_deviceids = $wpdb->get_col(
							$wpdb->prepare(
								"SELECT DISTINCT(SUBSTRING_INDEX(device_id, '!!', 1)) FROM %i WHERE device_id NOT LIKE %s AND userid = %d AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,6,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) ORDER BY id DESC LIMIT 50",
								$pnfpb_table_name,
								"%@N%",
								$senderid
							)
						);						

						$pnfpb_topic_requests = [
							// Request 1
							[
								"url" => $urladd,
								"headers" => $headers,
								"data" => wp_json_encode([
									"to" => $topicpath,
									"registration_tokens" => $pnfpb_deviceids,
								]),
								"type" => Requests::POST,
							],
						];

						$pnfpb_topic_subscriptions_request = Requests::request_multiple(
							$pnfpb_topic_requests, array("blocking" => false)
						);						
					}

					$headers = [
						"Authorization" => "Bearer " . $pnfpb_fbauth_token,
						"Content-Type" => "application/json",
					];

					for ($i = 0; $i < count($target_device_ids); $i++) {
						$notification = [
							"token" => $target_device_ids[$i],
							"notification" => $message,
							"data" => $pushdataarray,
							"webpush" => $webpushoptions,
							"android" => $androidoptions,
							"apns" => $iosoptions,
						];

						$fields = [
							"message" => $notification,
						];

						$body = wp_json_encode($fields);

						array_push($pnfpb_send_notifications, [
							"url" => $url,
							"headers" => $headers,
							"data" => $body,
							"type" => Requests::POST,
						]);

						$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
					}
				}

				if (count($pnfpb_send_notifications) > 0) {
					$pnfpb_send_notifications_result = Requests::request_multiple(
						$pnfpb_send_notifications, array("blocking" => false)
					);
				}
				
				$total_statistics_table_name =	$wpdb->prefix . "pnfpb_ic_total_statistics_notifications";
				$dbname = $wpdb->dbname;
				$data = array('notificationid' => $pushtimestamp, 'notification_auth_token' => $notification_token, 'title' => $pushtitle, 'content' => $pushcontent, 'total_delivery_confirmation' => 0, 'total_open_confirmation' => 0);
				$insertstatus = $wpdb->insert($total_statistics_table_name, $data);

			} else {
				if (
					get_option("pnfpb_ic_fcm_only_post_subscribers_enable") === "1" &&
					$pushtype === "reply"
				) {
					$pnfpb_send_notifications = [];
					
					$pnfpb_oauth_timestamp = get_option('pnfpb_firebase_oauth_timestamp');
					$pnfpb_fbauth_token = get_option("pnfpb_firebase_oauth_token");
					$pnfpb_one_hour_ago_timestamp = strtotime('-1 hour');
					if ($pnfpb_fbauth_token === false || $pnfpb_fbauth_token === '' 
						|| $pnfpb_oauth_timestamp === false || $pnfpb_oauth_timestamp === ''
						|| !is_numeric($pnfpb_oauth_timestamp)
						|| (is_numeric($pnfpb_oauth_timestamp) && $pnfpb_oauth_timestamp < $pnfpb_one_hour_ago_timestamp)) {
						$key = json_decode(get_option("pnfpb_sa_json_data"), true);
						$now = time();

						// 1. Create JWT Header
						$header = json_encode(['typ' => 'JWT', 'alg' => 'RS256']);

						// 2. Create JWT Payload
						$payload = json_encode([
							'iss' => $key['client_email'],
							'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
							'aud' => $key['token_uri'],
							'exp' => $now + 3600, // Token valid for 1 hour
							'iat' => $now
						]);

						// 3. Base64URL Encode
						$base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
						$base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
						$jwt = $base64UrlHeader . '.' . $base64UrlPayload;

						// 4. Sign JWT using Private Key
						$signature = '';
						openssl_sign($jwt, $signature, $key['private_key'], 'SHA256');
						$base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

						$jwt = $jwt . '.' . $base64UrlSignature;

						// 5. Exchange JWT for OAuth2 Token
						$args = [
							'body' => [
								'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
								'assertion' => $jwt
							]
						];

						$response = wp_remote_post($key['token_uri'], $args);

						if (is_wp_error($response)) {
							error_log(serialize($response));
						} else {
							$data = json_decode(wp_remote_retrieve_body($response), true);
							if (isset($data['access_token'])) {
								$pnfpb_fbauth_token = $data['access_token'];
								update_option("pnfpb_firebase_oauth_token", $data['access_token']);
								update_option("pnfpb_firebase_oauth_timestamp", strtotime('now'));						
							}	
						}						

					}

					$urladd = "https://iid.googleapis.com/iid/v1:batchAdd";

					$topicpath = "/topics/pnfpbtopic_".$senderid;

					$topicname = "pnfpbtopic_".$senderid;				

					$headers = [
						"Authorization" => "Bearer " . $pnfpb_fbauth_token,
						"Content-Type" => "application/json",
						"access_token_auth" => "true",
					];
					
					if (count($target_device_ids) > 0) {
						$subscribed_user_ids_implArray = implode(
							",",
							$target_device_ids
						);
						$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
						$deviceids = $wpdb->get_col(
							$wpdb->prepare(
								"SELECT DISTINCT(SUBSTRING_INDEX(device_id, '!!', 1)) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s AND userid IN ($subscribed_user_ids_implArray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) ORDER BY device_id DESC LIMIT 500",
								$table_name,
								"%@N%",
								"%!!%"
							)
						);
					}					

					$pnfpb_topic_requests = [
						// Request 1
						[
							"url" => $urladd,
							"headers" => $headers,
							"data" => wp_json_encode([
								"to" => $topicpath,
								"registration_tokens" => $deviceids,
							]),
							"type" => Requests::POST,
						],
					];

					$pnfpb_topic_subscriptions_request = Requests::request_multiple(
						$pnfpb_topic_requests, array("blocking" => false)
					);

					$headers = [
						"Authorization" => "Bearer " . $pnfpb_fbauth_token,
						"Content-Type" => "application/json",
					];

					$notification = [
						"topic" => $topicname,
						"notification" => $message,
						"data" => $pushdataarray,
						"webpush" => $webpushoptions,
						"android" => $androidoptions,
						"apns" => $iosoptions,
					];

					$fields = [
						"message" => $notification,
					];

					/** Send notification to users subscribed to all notifications, BuddyPress group activities */

					$body = wp_json_encode($fields);

					array_push($pnfpb_send_notifications, [
						"url" => $url,
						"headers" => $headers,
						"data" => $body,
						"type" => Requests::POST,
					]);

					$pnfpb_send_notifications_result = Requests::request_multiple(
						$pnfpb_send_notifications, array("blocking" => false)
					);

					$headers = [
						"Authorization" => "Bearer " . $pnfpb_fbauth_token,
						"Content-Type" => "application/json",
						"access_token_auth" => "true",
					];

					$urlremove = "https://iid.googleapis.com/iid/v1:batchRemove";

					$pnfpb_topic_requests = [
						// Request 1
						[
							"url" => $urlremove,
							"headers" => $headers,
							"data" => wp_json_encode([
								"to" => $topicpath,
								"registration_tokens" => $deviceids,
							]),
							"type" => Requests::POST,
						],
					];

					 $pnfpb_topic_subscriptions_request = Requests::request_multiple(
						$pnfpb_topic_requests, array("blocking" => false)
					);

				} else {

					if ($pushtype === 'ondemandselectedusers') {

						if (count($target_device_ids) > 0) {

							$pnfpb_send_notifications = [];
							
							$pnfpb_oauth_timestamp = get_option('pnfpb_firebase_oauth_timestamp');
							$pnfpb_fbauth_token = get_option("pnfpb_firebase_oauth_token");
							$pnfpb_one_hour_ago_timestamp = strtotime('-1 hour');
							if ($pnfpb_fbauth_token === false || $pnfpb_fbauth_token === '' 
								|| $pnfpb_oauth_timestamp === false || $pnfpb_oauth_timestamp === ''
								|| !is_numeric($pnfpb_oauth_timestamp)
								|| (is_numeric($pnfpb_oauth_timestamp) && $pnfpb_oauth_timestamp < $pnfpb_one_hour_ago_timestamp)) {
								
								$key = json_decode(get_option("pnfpb_sa_json_data"), true);
								$now = time();

								// 1. Create JWT Header
								$header = json_encode(['typ' => 'JWT', 'alg' => 'RS256']);

								// 2. Create JWT Payload
								$payload = json_encode([
									'iss' => $key['client_email'],
									'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
									'aud' => $key['token_uri'],
									'exp' => $now + 3600, // Token valid for 1 hour
									'iat' => $now
								]);

								// 3. Base64URL Encode
								$base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
								$base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
								$jwt = $base64UrlHeader . '.' . $base64UrlPayload;

								// 4. Sign JWT using Private Key
								$signature = '';
								openssl_sign($jwt, $signature, $key['private_key'], 'SHA256');
								$base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

								$jwt = $jwt . '.' . $base64UrlSignature;

								// 5. Exchange JWT for OAuth2 Token
								$args = [
									'body' => [
										'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
										'assertion' => $jwt
									]
								];

								$response = wp_remote_post($key['token_uri'], $args);

								if (is_wp_error($response)) {
									error_log(serialize($response));
								} else {
									$data = json_decode(wp_remote_retrieve_body($response), true);
									if (isset($data['access_token'])) {
										$pnfpb_fbauth_token = $data['access_token'];
										update_option("pnfpb_firebase_oauth_token", $data['access_token']);
										update_option("pnfpb_firebase_oauth_timestamp", strtotime('now'));						
									}	
								}								

							}

							$urladd = "https://iid.googleapis.com/iid/v1:batchAdd";

							$headers = [
								"Authorization" => "Bearer " . $pnfpb_fbauth_token,
								"Content-Type" => "application/json",
								"access_token_auth" => "true",
							];

							$topicpath = "/topics/pnfpb_ondemand_selectedusers_".$senderid;

							$topicname = "pnfpb_ondemand_selectedusers_".$senderid;				

							$pnfpb_topic_requests = [
								// Request 1
								[
									"url" => $urladd,
									"headers" => $headers,
									"data" => wp_json_encode([
										"to" => $topicpath,
										"registration_tokens" => $target_device_ids,
									]),
									"type" => Requests::POST,
								],
							];

							$pnfpb_topic_subscriptions_request = Requests::request_multiple(
								$pnfpb_topic_requests, array("blocking" => false)
							);

							$headers = [
								"Authorization" => "Bearer " . $pnfpb_fbauth_token,
								"Content-Type" => "application/json",
							];

							$notification = [
								"topic" => $topicname,
								"notification" => $message,
								"data" => $pushdataarray,
								"webpush" => $webpushoptions,
								"android" => $androidoptions,
								"apns" => $iosoptions,
							];

							$fields = [
								"message" => $notification,
							];

							/** Send notification to users subscribed to all notifications, BuddyPress group activities */

							$body = wp_json_encode($fields);

							array_push($pnfpb_send_notifications, [
								"url" => $url,
								"headers" => $headers,
								"data" => $body,
								"type" => Requests::POST,
							]);

							$pnfpb_send_notifications_result = Requests::request_multiple(
								$pnfpb_send_notifications, array("blocking" => false)
							);

							$headers = [
								"Authorization" => "Bearer " . $pnfpb_fbauth_token,
								"Content-Type" => "application/json",
								"access_token_auth" => "true",
							];

							$urlremove = "https://iid.googleapis.com/iid/v1:batchRemove";

							$pnfpb_topic_requests = [
								// Request 1
								[
									"url" => $urlremove,
									"headers" => $headers,
									"data" => wp_json_encode([
										"to" => $topicpath,
										"registration_tokens" => $target_device_ids,
									]),
									"type" => Requests::POST,
								],
							];

							$pnfpb_topic_subscriptions_request = Requests::request_multiple(
								$pnfpb_topic_requests, array("blocking" => false)
							);			
						}

					} else {

						if ($pushtype === 'onlytofriends') {

							if ($senderid > 0) {

								$pnfpb_send_notifications = [];
								
								$pnfpb_oauth_timestamp = get_option('pnfpb_firebase_oauth_timestamp');
								$pnfpb_fbauth_token = get_option("pnfpb_firebase_oauth_token");
								$pnfpb_one_hour_ago_timestamp = strtotime('-1 hour');
								if ($pnfpb_fbauth_token === false || $pnfpb_fbauth_token === '' 
									|| $pnfpb_oauth_timestamp === false || $pnfpb_oauth_timestamp === ''
									|| !is_numeric($pnfpb_oauth_timestamp)
									|| (is_numeric($pnfpb_oauth_timestamp) && $pnfpb_oauth_timestamp < $pnfpb_one_hour_ago_timestamp)) {
									
									$key = json_decode(get_option("pnfpb_sa_json_data"), true);
									$now = time();

									// 1. Create JWT Header
									$header = json_encode(['typ' => 'JWT', 'alg' => 'RS256']);

									// 2. Create JWT Payload
									$payload = json_encode([
										'iss' => $key['client_email'],
										'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
										'aud' => $key['token_uri'],
										'exp' => $now + 3600, // Token valid for 1 hour
										'iat' => $now
									]);

									// 3. Base64URL Encode
									$base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
									$base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
									$jwt = $base64UrlHeader . '.' . $base64UrlPayload;

									// 4. Sign JWT using Private Key
									$signature = '';
									openssl_sign($jwt, $signature, $key['private_key'], 'SHA256');
									$base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

									$jwt = $jwt . '.' . $base64UrlSignature;

									// 5. Exchange JWT for OAuth2 Token
									$args = [
										'body' => [
											'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
											'assertion' => $jwt
										]
									];

									$response = wp_remote_post($key['token_uri'], $args);

									if (is_wp_error($response)) {
										error_log(serialize($response));
									} else {
										$data = json_decode(wp_remote_retrieve_body($response), true);
										if (isset($data['access_token'])) {
											$pnfpb_fbauth_token = $data['access_token'];
											update_option("pnfpb_firebase_oauth_token", $data['access_token']);
											update_option("pnfpb_firebase_oauth_timestamp", strtotime('now'));						
										}	
									}									

								}

								$urladd = "https://iid.googleapis.com/iid/v1:batchAdd";

								$topicpath = "/topics/pnfpb_onlytofriends_".$senderid;

								$topicname = "pnfpb_onlytofriends_".$senderid;

								$headers = [
									"Authorization" => "Bearer " . $pnfpb_fbauth_token,
									"Content-Type" => "application/json",
									"access_token_auth" => "true",
								];

								$friend_ids = friends_get_friend_user_ids( $senderid );

								$friends_deviceids = array();

								$regid = array();

								$friends_count = 0;

								$friends_deviceid_table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

								foreach ( $friend_ids as $id ) {

										if ($friends_count > 5000) {

											$pnfpb_topic_requests = [
												// Request 1
												[
													"url" => $urladd,
													"headers" => $headers,
													"data" => wp_json_encode([
														"to" => $topicpath,
														"registration_tokens" => $regid,
													]),
													"type" => Requests::POST,
												],
											];

											$pnfpb_topic_subscriptions_request = Requests::request_multiple(
												$pnfpb_topic_requests, array("blocking" => false)
											);

											$headers = [
												"Authorization" => "Bearer " . $pnfpb_fbauth_token,
												"Content-Type" => "application/json",
											];

											$notification = [
												"topic" => $topicname,
												"notification" => $message,
												"data" => $pushdataarray,
												"webpush" => $webpushoptions,
												"android" => $androidoptions,
												"apns" => $iosoptions,
											];

											$fields = [
												"message" => $notification,
											];

											/** Send notification to users subscribed to all notifications, BuddyPress group activities */

											$body = wp_json_encode($fields);

											array_push($pnfpb_send_notifications, [
												"url" => $url,
												"headers" => $headers,
												"data" => $body,
												"type" => Requests::POST,
											]);

											$pnfpb_send_notifications_result = Requests::request_multiple(
												$pnfpb_send_notifications, array("blocking" => false)
											);

											$headers = [
												"Authorization" => "Bearer " . $pnfpb_fbauth_token,
												"Content-Type" => "application/json",
												"access_token_auth" => "true",
											];

											$urlremove = "https://iid.googleapis.com/iid/v1:batchRemove";

											$pnfpb_topic_requests = [
												// Request 1
												[
													"url" => $urlremove,
													"headers" => $headers,
													"data" => wp_json_encode([
														"to" => $topicpath,
														"registration_tokens" => $regid,
													]),
													"type" => Requests::POST,
												],
											];

											$pnfpb_topic_subscriptions_request = Requests::request_multiple(
												$pnfpb_topic_requests, array("blocking" => false)
											);	

											$friends_deviceids = array();
											$friends_deviceidswebview = array();

											$friends_count = 0;										

										}

										$friends_deviceids = $wpdb->get_col(
											$wpdb->prepare(
												"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE  %s AND userid = %d",
												$friends_deviceid_table_name,
												"%!!%",
												"%@N%",
												$id
											)
										);

										$friends_count++;
										$regid = array_merge($regid, $friends_deviceids);

								}

								$pnfpb_topic_requests = [
									// Request 1
									[
										"url" => $urladd,
										"headers" => $headers,
										"data" => wp_json_encode([
											"to" => $topicpath,
											"registration_tokens" => $regid,
										]),
										"type" => Requests::POST,
									],
								];

								$pnfpb_topic_subscriptions_request = Requests::request_multiple(
									$pnfpb_topic_requests, array("blocking" => false)
								);

								$headers = [
									"Authorization" => "Bearer " . $pnfpb_fbauth_token,
									"Content-Type" => "application/json",
								];

								$notification = [
									"topic" => $topicname,
									"notification" => $message,
									"data" => $pushdataarray,
									"webpush" => $webpushoptions,
									"android" => $androidoptions,
									"apns" => $iosoptions,
								];

								$fields = [
									"message" => $notification,
								];

								/** Send notification to users subscribed to all notifications, BuddyPress group activities */

								$body = wp_json_encode($fields);

								array_push($pnfpb_send_notifications, [
									"url" => $url,
									"headers" => $headers,
									"data" => $body,
									"type" => Requests::POST,
								]);

								$pnfpb_send_notifications_result = Requests::request_multiple(
									$pnfpb_send_notifications, array("blocking" => false)
								);

								$headers = [
									"Authorization" => "Bearer " . $pnfpb_fbauth_token,
									"Content-Type" => "application/json",
									"access_token_auth" => "true",
								];

								$urlremove = "https://iid.googleapis.com/iid/v1:batchRemove";

								$pnfpb_topic_requests = [
									// Request 1
									[
										"url" => $urlremove,
										"headers" => $headers,
										"data" => wp_json_encode([
											"to" => $topicpath,
											"registration_tokens" => $regid,
										]),
										"type" => Requests::POST,
									],
								];

								$pnfpb_topic_subscriptions_request = Requests::request_multiple(
									$pnfpb_topic_requests, array("blocking" => false)
								);
							}

						} else {
							$pnfpb_oauth_timestamp = get_option('pnfpb_firebase_oauth_timestamp');
							$pnfpb_fbauth_token = get_option("pnfpb_firebase_oauth_token");
							$pnfpb_one_hour_ago_timestamp = strtotime('-1 hour');
							if ($pnfpb_fbauth_token === false || $pnfpb_fbauth_token === '' 
								|| $pnfpb_oauth_timestamp === false || $pnfpb_oauth_timestamp === ''
								|| !is_numeric($pnfpb_oauth_timestamp)
								|| (is_numeric($pnfpb_oauth_timestamp) && $pnfpb_oauth_timestamp < $pnfpb_one_hour_ago_timestamp)) {
								
								$key = json_decode(get_option("pnfpb_sa_json_data"), true);
								$now = time();

								// 1. Create JWT Header
								$header = json_encode(['typ' => 'JWT', 'alg' => 'RS256']);

								// 2. Create JWT Payload
								$payload = json_encode([
									'iss' => $key['client_email'],
									'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
									'aud' => $key['token_uri'],
									'exp' => $now + 3600, // Token valid for 1 hour
									'iat' => $now
								]);

								// 3. Base64URL Encode
								$base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
								$base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
								$jwt = $base64UrlHeader . '.' . $base64UrlPayload;

								// 4. Sign JWT using Private Key
								$signature = '';
								openssl_sign($jwt, $signature, $key['private_key'], 'SHA256');
								$base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

								$jwt = $jwt . '.' . $base64UrlSignature;

								// 5. Exchange JWT for OAuth2 Token
								$args = [
									'body' => [
										'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
										'assertion' => $jwt
									]
								];

								$response = wp_remote_post($key['token_uri'], $args);

								if (is_wp_error($response)) {
									error_log(serialize($response));
								} else {
									$data = json_decode(wp_remote_retrieve_body($response), true);
									if (isset($data['access_token'])) {
										$pnfpb_fbauth_token = $data['access_token'];
										update_option("pnfpb_firebase_oauth_token", $data['access_token']);
										update_option("pnfpb_firebase_oauth_timestamp", strtotime('now'));						
									}	
								}								

							}

							$headers = [
								"Authorization" => "Bearer " . $pnfpb_fbauth_token,
								"Content-Type" => "application/json",
							];
							
							if ($pushtype !== "ondemand" && strpos($pushtype, "pnfpb_buddypress_followers_") === false) {
								$topic = "pnfpbgeneral";

								if (
									get_option("pnfpb_ic_fcm_loggedin_notify") &&
									get_option("pnfpb_ic_fcm_loggedin_notify") === "1"
								) {
									$topic = "pnfpbgeneralloggedin";
								}

								if ($grouppush === "yes") {
									$group_name = "pnfpbgroupid" . $groupid;
									$topic = $group_name;	
								}

								$notification = [
									"topic" => $topic,
									"notification" => $message,
									"data" => $pushdataarray,
									"webpush" => $webpushoptions,
									"android" => $androidoptions,
									"apns" => $iosoptions,
								];

								$fields = [
									"message" => $notification,
								];

								/** Send notification to users subscribed to all notifications, BuddyPress group activities */

								$body = wp_json_encode($fields);

								array_push($pnfpb_send_notifications, [
									"url" => $url,
									"headers" => $headers,
									"data" => $body,
									"type" => Requests::POST,
								]);

							}

							/** Send notification only to particular users who are subscribed to like BuddyPress all activities, comments,
								 * group invite, group update, new member joined, avatar change, cover image change
								 **/

							if (
								$pushtype !== "" &&
								$pushtype !== "groupactivity" &&
								$pushtype !== "groupdetailsupdate" &&
								((get_option("pnfpb_custom_prompt_options_on_off") !== "1" &&
								  get_option("pnfpb_bell_icon_prompt_options_on_off") !== "1" &&
								  get_option("pnfpb_ic_fcm_frontend_enable_subscription") !==
								  "1" &&
								  get_option("pnfpb_shortcode_enable") !== "yes" &&
								  $pushtype === "ondemand") ||
								 (get_option("pnfpb_custom_prompt_options_on_off") === "1" ||
								  get_option("pnfpb_bell_icon_prompt_options_on_off") ===
								  "1" ||
								  get_option("pnfpb_ic_fcm_frontend_enable_subscription") ===
								  "1" ||
								  get_option("pnfpb_shortcode_enable") !== "yes"))
							) {
								if (strpos($pushtype, "pnfpb_buddypress_followers_") === false) {
									$topic = "pnfpb" . $pushtype;
								} else {
									$topic = $pushtype;
								}
								$notification = [
									"topic" => $topic,
									"notification" => $message,
									"data" => $pushdataarray,
									"webpush" => $webpushoptions,
									"android" => $androidoptions,
									"apns" => $iosoptions,
								];

								$fields = [
									"message" => $notification,
								];

								$body = wp_json_encode($fields);

								array_push($pnfpb_send_notifications, [
									"url" => $url,
									"headers" => $headers,
									"data" => $body,
									"type" => Requests::POST
								]);
							}

							if (count($pnfpb_send_notifications) > 0) {
								$pnfpb_send_notifications_result = Requests::request_multiple(
									$pnfpb_send_notifications
								);

							}

						}
					}
				}

				$total_statistics_table_name =	$wpdb->prefix . "pnfpb_ic_total_statistics_notifications";
				$dbname = $wpdb->dbname;
				if (get_option("pnfpb_ic_fcm_turnonoff_delivery_notifications") === '1' && ($topic === '' || $pushtype === 'onlytofriends' || $pushtype === 'ondemandselectedusers' ))
				{
					$data = array('notificationid' => $pushtimestamp, 'notification_auth_token' => $notification_token, 'title' => $pushtitle, 'content' => $pushcontent, 'total_delivery_confirmation' => 0, 'total_open_confirmation' => 0);
					$insertstatus = $wpdb->insert($total_statistics_table_name, $data);
				} else {
					if (get_option("pnfpb_ic_fcm_turnonoff_delivery_notifications") === '1') {
						$topic_count = intval($post_topic_count);
						if ($topic !== 'contactus' && $topic !== 'newuserregistration') {
							$data = array('notificationid' => $pushtimestamp, 'notification_auth_token' => $notification_token, 'title' => $pushtitle, 'content' => $pushcontent, 'total_delivery_confirmation' => $topic_count, 'total_open_confirmation' => 0);
							$insertstatus = $wpdb->insert($total_statistics_table_name, $data);
						}
					}
				}
			}
		}
	}
}

?>
