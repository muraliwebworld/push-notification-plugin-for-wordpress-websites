<?php
// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery
if (!class_exists("PNFPB_new_user_registration_notification_class")) {
    class PNFPB_new_user_registration_notification_class
    {
        public function PNFPB_new_user_registration_notification(
			$pnfpb_user_id,
			$pnfpb_userdata
		) {
			
			$pnfpb_webpush_option = get_option("pnfpb_webpush_push");
			$pnfpb_webpush_firebase = get_option("pnfpb_webpush_push_firebase");
			
			$pnfpb_user_meta = get_userdata($pnfpb_user_id);

			if (empty($pnfpb_userdata) || get_option("pnfpb_ic_fcm_new_user_registration_enable") !== "1") {
				return;
			}

			$pnfpb_super_admins = get_users("role=administrator");
			
			if ($pnfpb_super_admins) {
				foreach ($pnfpb_super_admins as $pnfpb_adminuser) {
					if (isset($pnfpb_adminuser->ID) && !empty($pnfpb_adminuser->ID)) {

						$pnfpb_apiaccesskey = get_option("pnfpb_ic_fcm_google_api");

						if (
							(get_option(
								"pnfpb_ic_fcm_new_user_registration_enable"
							) == "1" &&
							 get_option("pnfpb_progressier_push") !== "1" &&
							 get_option("pnfpb_webtoapp_push") !== "1" &&
							 ($pnfpb_apiaccesskey !== "" &&
							  $pnfpb_apiaccesskey !== false)) ||
							(get_option(
								"pnfpb_ic_fcm_new_user_registration_enable"
							) == 1 &&
							 (get_option("pnfpb_onesignal_push") === "1" ||
							  $pnfpb_webpush_option === '1' || 
							  $pnfpb_webpush_option === '2' || 
							  $pnfpb_webpush_firebase === '1' ||
							  get_option("pnfpb_httpv1_push") === "1"))
						) {
							global $wpdb;

							$pnfpb_new_user_name = bp_core_get_user_displayname(
								$pnfpb_user_id
							);

							$pnfpb_table_name =
								$wpdb->prefix .
								"pnfpb_ic_subscribed_deviceids_web";

							$pnfpb_url = "https://fcm.googleapis.com/fcm/send";

							$pnfpb_activity_content_push =
								"New user registered in " .
								get_bloginfo("name");

							$pnfpb_notificationtitle =
								$pnfpb_new_user_name .
								esc_html(
								__(
									" registered as new member",
									"push-notification-for-post-and-buddypress"
								)
							);

							$pnfpb_titletext = get_option(
								"pnfpb_ic_fcm_buddypress_new_user_registration_text_enable"
							);

							if ($pnfpb_titletext && $pnfpb_titletext !== "") {
								$pnfpb_notificationtitle = str_replace(
									"[user name]",
									$pnfpb_new_user_name,
									$pnfpb_titletext
								);
							}

							$pnfpb_iconurl = get_option("pnfpb_ic_fcm_upload_icon");

							$pnfpb_messageurl = esc_url(admin_url("users.php"));

							if (
								get_option(
									"pnfpb_ic_fcm_buddypress_new_user_registration_content_enable"
								) != false &&
								get_option(
									"pnfpb_ic_fcm_buddypress_new_user_registration_content_enable"
								) != ""
							) {
								$pnfpb_activity_content_push = get_option(
									"pnfpb_ic_fcm_buddypress_new_user_registration_content_enable"
								);
							}

							$pnfpb_activity_content_push = str_replace(
								"[user name]",
								$pnfpb_new_user_name,
								$pnfpb_activity_content_push
							);
							
							$pnfpb_imageurl = '';

							$pnfpb_target_deviceid_values = [];								
							
							if ($pnfpb_webpush_option === '1' || $pnfpb_webpush_option === '2' || $pnfpb_webpush_firebase === '1') {

								$pnfpb_target_deviceid_values = $wpdb->get_results(
									$wpdb->prepare(
										"SELECT * FROM %i WHERE device_id NOT LIKE %s AND userid = %d AND web_auth <> %s AND web_256 <> %s AND subscription_auth_token <> %s ORDER BY id DESC LIMIT 50",
										$pnfpb_table_name,
										"%!!%",
										$pnfpb_adminuser->ID,
										"","",""
									)
								);
								
								if (count($pnfpb_target_deviceid_values) > 0) {
									foreach ($pnfpb_target_deviceid_values as $pnfpb_target_deviceid_value) {
										$pnfpb_target_subscription_array[] =  [
											"endpoint" => $pnfpb_target_deviceid_value->web_auth,
											"keys" => [
												'p256dh' => $pnfpb_target_deviceid_value->web_256,
												'auth' => $pnfpb_target_deviceid_value->subscription_auth_token
											]
										];
									}

									$PNFPB_WP_web_push_notification_class_obj = new PNFPB_web_push_notification_class();
									$PNFPB_WP_web_push_notification_class_obj->PNFPB_web_push_notification(
										0,
										$pnfpb_notificationtitle,
										stripslashes(
											wp_strip_all_tags(
												$pnfpb_activity_content_push
											)
										),
										$pnfpb_iconurl,
										$pnfpb_imageurl,
										$pnfpb_messageurl,
										["click_url" => $pnfpb_messageurl],
										$pnfpb_target_subscription_array,
										$pnfpb_user_id,
										0	
									);						
								}
								
							} else {								

								if (get_option("pnfpb_onesignal_push") === "1") {
									$pnfpb_target_userid_array = [];

									$pnfpb_target_userid_array_values = $wpdb->get_col(
										$wpdb->prepare(
											"SELECT userid FROM %i WHERE device_id LIKE %s AND userid = %d ORDER BY id DESC LIMIT %d",
											$pnfpb_table_name,
											"%onesignal%",
											$pnfpb_adminuser->ID,
											50
										)
									);

									$pnfpb_target_userid_array = array_map(function (
										$pnfpb_value
									) {
										return $pnfpb_value == 1 ? "1pnfpbadm" : $pnfpb_value;
									}, $pnfpb_target_userid_array_values);

									$PNFPB_WP_onesignal_notification_class_obj = new PNFPB_onesignal_notification_class();
									$PNFPB_WP_onesignal_notification_class_obj->PNFPB_onesignal_notification(
										$pnfpb_adminuser->ID,
										$pnfpb_notificationtitle,
										stripslashes(
											wp_strip_all_tags(
												$pnfpb_activity_content_push
											)
										),
										$pnfpb_messageurl,
										$pnfpb_iconurl,
										$pnfpb_target_userid_array
									);
								} else {
									if (
										get_option(
											"pnfpb_ic_fcm_loggedin_notify"
										) &&
										get_option(
											"pnfpb_ic_fcm_loggedin_notify"
										) === "1"
									) {
										$pnfpb_deviceids = $wpdb->get_col(
											$wpdb->prepare(
												"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > %d AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND userid = %d ORDER BY id DESC LIMIT %d",
												$pnfpb_table_name,
												0,
												"%webview%",
												"%!!%",
												"%@N%",
												$pnfpb_adminuser->ID,
												50
											)
										);
									} else {
										$pnfpb_deviceids = $wpdb->get_col(
											$wpdb->prepare(
												"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND userid = %d ORDER BY id DESC LIMIT %d",
												$pnfpb_table_name,
												"%webview%",
												"%!!%",
												"%@N%",
												$pnfpb_adminuser->ID,
												50
											)
										);
									}

									$pnfpb_webview = false;
									if (
										get_option(
											"pnfpb_ic_fcm_loggedin_notify"
										) &&
										get_option(
											"pnfpb_ic_fcm_loggedin_notify"
										) === "1"
									) {
										$pnfpb_deviceidswebview = $wpdb->get_col(
											$wpdb->prepare(
												"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > %d AND device_id LIKE %s AND device_id NOT LIKE %s AND userid = %d ORDER BY id DESC LIMIT %d",
												$pnfpb_table_name,
												0,
												"%webview%",
												"%!!%",
												$pnfpb_adminuser->ID,
												50
											)
										);
									} else {
										$pnfpb_deviceidswebview = $wpdb->get_col(
											$wpdb->prepare(
												"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id LIKE %s AND device_id NOT LIKE %s AND userid = %d ORDER BY id DESC LIMIT %d",
												$pnfpb_table_name,
												"%webview%",
												"%!!%",
												$pnfpb_adminuser->ID,
												50
											)
										);
									}

									$pnfpb_imageurl = "";

									$pnfpb_iconurl = bp_core_fetch_avatar([
										"item_id" => $pnfpb_user_id, // output user id of post author
										"type" => "full",
										"html" => false, // FALSE = return url, TRUE (default) = return url wrapped with html
									]);

									if (count($pnfpb_deviceids) > 0) {
										$pnfpb_regid = $pnfpb_deviceids;
										if (
											get_option("pnfpb_httpv1_push") === "1"
										) {
											$PNFPB_httpv1_notification_class_obj = new PNFPB_firebase_httpv1_notification_class();
											$PNFPB_httpv1_notification_class_obj->PNFPB_firebase_httpv1_notification(										
												0,
												$pnfpb_notificationtitle,
												stripslashes(
													wp_strip_all_tags(
														$pnfpb_activity_content_push
													)
												),
												$pnfpb_iconurl,
												$pnfpb_imageurl,
												$pnfpb_messageurl,
												["click_url" => $pnfpb_messageurl],
												$pnfpb_regid,
												$pnfpb_deviceidswebview,
												$pnfpb_user_id,
												0,
												'newuserregistration'
											);
										}
										do_action(
											"PNFPB_connect_to_external_api_for_private_messages"
										);
									}
								}
							}
						}
					}
				}
			}
		}
	}
}

?>