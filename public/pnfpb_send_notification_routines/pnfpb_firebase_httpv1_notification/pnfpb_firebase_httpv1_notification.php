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
            $pushextradata = "",
            $target_device_ids = [],
            $deviceidswebview = [],
            $senderid = 0,
            $receiverid = 0,
            $pushtype = "",
            $grouppush = "",
            $groupid = 0
        ) {
			global $wpdb;

			$pnfpb_firebase_project = get_option("pnfpb_ic_fcm_projectid");

			// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

			$url = "https://fcm.googleapis.com/v1/projects/{$pnfpb_firebase_project}/messages:send";

			$token = wp_get_session_token();
			$i     = wp_nonce_tick();
			$notification_token = substr( wp_hash( $i . '|' . $token, 'nonce' ), -12, 10 );
			if ($senderid > 0) {
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
					"notification_auth_token" => $notification_token
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
				$pushtype === "friendshiprequest" ||
				$pushtype === "friendshipaccepted" ||
				$pushtype === "markasfavourite" ||
				$pushtype === "groupinvite" ||
				$pushtype === "contactus" ||
				$pushtype === "newuserregistration" ||
				$pushtype === "mycomments"
			) {
				if (count($target_device_ids) > 0) {
					$pnfpb_fbauth_token = get_option("pnfpb_firebase_oauth_token");

					if (get_option("pnfpb_firebase_oauth_token") === false || get_option("pnfpb_firebase_oauth_token") === "") {

						$client = new Google_Client();

						// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
						//
						$client->useApplicationDefaultCredentials();

						// Alternatively, provide the JSON authentication file directly.
						$configArray = json_decode(get_option("pnfpb_sa_json_data"), true);
						$client->setAuthConfig($configArray);

						// Add the scope as a string (multiple scopes can be provided as an array)
						$client->addScope("https://www.googleapis.com/auth/firebase.messaging");
						$client->refreshTokenWithAssertion();
						$pnfpb_fbauth_token_array = $client->getAccessToken();
						$pnfpb_fbauth_token = $pnfpb_fbauth_token_array["access_token"];
						update_option("pnfpb_firebase_oauth_token", $pnfpb_fbauth_token);
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

					$pnfpb_fbauth_token = get_option("pnfpb_firebase_oauth_token");

					if (get_option("pnfpb_firebase_oauth_token") === false || get_option("pnfpb_firebase_oauth_token") === "") {

						$client = new Google_Client();

						// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
						//
						$client->useApplicationDefaultCredentials();

						// Alternatively, provide the JSON authentication file directly.
						$configArray = json_decode(get_option("pnfpb_sa_json_data"), true);
						$client->setAuthConfig($configArray);

						// Add the scope as a string (multiple scopes can be provided as an array)
						$client->addScope("https://www.googleapis.com/auth/firebase.messaging");
						$client->refreshTokenWithAssertion();
						$pnfpb_fbauth_token_array = $client->getAccessToken();
						$pnfpb_fbauth_token = $pnfpb_fbauth_token_array["access_token"];
						update_option("pnfpb_firebase_oauth_token", $pnfpb_fbauth_token);
					}

					$urladd = "https://iid.googleapis.com/iid/v1:batchAdd";

					$topicpath = "/topics/pnfpbtopic_".$senderid;

					$topicname = "pnfpbtopic_".$senderid;				

					$headers = [
						"Authorization" => "Bearer " . $pnfpb_fbauth_token,
						"Content-Type" => "application/json",
						"access_token_auth" => "true",
					];

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

				} else {

					if ($pushtype === 'ondemandselectedusers') {

						if (count($target_device_ids) > 0) {

							$pnfpb_send_notifications = [];

							$pnfpb_fbauth_token = get_option("pnfpb_firebase_oauth_token");
							
							if (get_option("pnfpb_firebase_oauth_token") === false || get_option("pnfpb_firebase_oauth_token") === "") {

								$client = new Google_Client();

								// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
								//
								$client->useApplicationDefaultCredentials();

								// Alternatively, provide the JSON authentication file directly.
								$configArray = json_decode(get_option("pnfpb_sa_json_data"), true);
								$client->setAuthConfig($configArray);

								// Add the scope as a string (multiple scopes can be provided as an array)
								$client->addScope("https://www.googleapis.com/auth/firebase.messaging");
								$client->refreshTokenWithAssertion();
								$pnfpb_fbauth_token_array = $client->getAccessToken();
								$pnfpb_fbauth_token = $pnfpb_fbauth_token_array["access_token"];
								update_option("pnfpb_firebase_oauth_token", $pnfpb_fbauth_token);
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

								$pnfpb_fbauth_token = get_option("pnfpb_firebase_oauth_token");

								if (get_option("pnfpb_firebase_oauth_token") === false || get_option("pnfpb_firebase_oauth_token") === "") {

									$client = new Google_Client();

									// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
									//
									$client->useApplicationDefaultCredentials();

									// Alternatively, provide the JSON authentication file directly.
									$configArray = json_decode(get_option("pnfpb_sa_json_data"), true);
									$client->setAuthConfig($configArray);

									// Add the scope as a string (multiple scopes can be provided as an array)
									$client->addScope("https://www.googleapis.com/auth/firebase.messaging");
									$client->refreshTokenWithAssertion();
									$pnfpb_fbauth_token_array = $client->getAccessToken();
									$pnfpb_fbauth_token = $pnfpb_fbauth_token_array["access_token"];
									update_option("pnfpb_firebase_oauth_token", $pnfpb_fbauth_token);
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

										if ($friends_count > 100) {

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
							
							$pnfpb_fbauth_token = get_option("pnfpb_firebase_oauth_token");
							
							if (get_option("pnfpb_firebase_oauth_token") === false || get_option("pnfpb_firebase_oauth_token") === "") {

								$client = new Google_Client();

								// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
								//
								$client->useApplicationDefaultCredentials();

								// Alternatively, provide the JSON authentication file directly.
								$configArray = json_decode(get_option("pnfpb_sa_json_data"), true);
								$client->setAuthConfig($configArray);

								// Add the scope as a string (multiple scopes can be provided as an array)
								$client->addScope("https://www.googleapis.com/auth/firebase.messaging");
								$client->refreshTokenWithAssertion();
								$pnfpb_fbauth_token_array = $client->getAccessToken();
								$pnfpb_fbauth_token = $pnfpb_fbauth_token_array["access_token"];
								update_option("pnfpb_firebase_oauth_token", $pnfpb_fbauth_token);
							}

							$headers = [
								"Authorization" => "Bearer " . $pnfpb_fbauth_token,
								"Content-Type" => "application/json",
							];

							if ($pushtype !== "ondemand") {
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
								$topic = "pnfpb" . $pushtype;
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
									$pnfpb_send_notifications, array("timeout" => 0.01,"blocking" => false)
								);
							}
						}
					}
				}

				$total_statistics_table_name =	$wpdb->prefix . "pnfpb_ic_total_statistics_notifications";
				$dbname = $wpdb->dbname;
				$data = array('notificationid' => $pushtimestamp, 'notification_auth_token' => $notification_token, 'title' => $pushtitle, 'content' => $pushcontent, 'total_delivery_confirmation' => 0, 'total_open_confirmation' => 0);
				$insertstatus = $wpdb->insert($total_statistics_table_name, $data);	
			}
		}
	}
}

?>
