<?php
global $wpdb;

// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

$imageurl = "";
$deviceids = [];
$deviceidswebview = [];
$ownerid = $postid;
$targetid = 0;

if (
    $post_title === null ||
    wp_next_scheduled("PNFPB_cron_post_hook") ||
    as_has_scheduled_action("PNFPB_cron_post_hook")
) {
    $post_type_meta_key = "pnfpb_push_notification_send_checkbox";

    $post_title = "[member name] posted new post in " . get_bloginfo("name");
    $post_content = "New content in " . get_bloginfo("name");
    $postlink = get_home_url();
    $authorid = null;

    $pnfbp_post_type = $post->post_type;

    $recent_posts = wp_get_recent_posts([
        "numberposts" => 1, // Number of recent posts thumbnails to display
        "post_status" => "publish", // Show only the published posts
        "meta_key" => $post_type_meta_key,
        "meta_value" => "1",
        "post_type" => $pnfbp_post_type,
    ]);

    foreach ($recent_posts as $post_item) {
        // if it is called from scheduled hook for post cron schedule
        $postid = $post_item["ID"];
        $post_title = $post_item["post_title"];
        $post_content = mb_substr(
            stripslashes(
                wp_strip_all_tags(urldecode(trim($post_item["post_content"])))
            ),
            0,
            130,
            "UTF-8"
        );
        $postlink = get_permalink($post_item["ID"]);
        $authorid = $post_item["post_author"];
        $imageurl = get_the_post_thumbnail_url($post_item["ID"], "full");
        if (!$imageurl) {
            $imageurl = "";
        }
    }
}

if (has_post_thumbnail($postid)) {
    $imageurl = get_the_post_thumbnail_url($postid, "full");
    if (!$imageurl) {
        $imageurl = "";
    }
} else {
    preg_match_all(
        '/(alt|title|src)=("[^"]*")/i',
        stripslashes($post_content),
        $imgresult
    );

    if (is_array($imgresult)) {
        if (
            count($imgresult) > 2 &&
            is_array($imgresult[2]) &&
            count($imgresult[2]) > 0
        ) {
            $imageurl = str_replace('"', "", $imgresult[2][0]);
        }
    }
}


$bb_target_userid_array = [];
$buddyboss_pnfpb = false;
$apiaccesskey = get_option("pnfpb_ic_fcm_google_api");
$webpush_option = get_option("pnfpb_webpush_push");
$webpush_firebase = get_option("pnfpb_webpush_push_firebase");

if (
    (($apiaccesskey != "" && $apiaccesskey != false) ||
        get_option("pnfpb_httpv1_push") === "1" ||
        get_option("pnfpb_progressier_push") === "1" ||
        get_option("pnfpb_webtoapp_push") === "1" ||
	 	$webpush_option === '1' || 
	 	$webpush_option === '2' || 
	 	$webpush_firebase === '1' ||
        get_option("pnfpb_onesignal_push") === "1") &&
    	get_permalink($postid) &&
    	get_permalink($postid) != ""
) {
    $table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

     if (
            get_option("pnfpb_ic_fcm_loggedin_notify") &&
            get_option("pnfpb_ic_fcm_loggedin_notify") === "1"
        ) {
            $deviceids_count = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > 0 AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s",
                    $table_name,
                    "%@N%",
                    "%!!webview%",
                    "%!!%"
                )
            );
     } else {
       		$deviceids_count = $wpdb->get_results(
            	$wpdb->prepare(
                	"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)",
                	$table_name,
                	"%@N%",
                	"%!!webview%",
                	"%!!%"
            	)
        	);
    }

    if (
        get_option("pnfpb_ic_fcm_loggedin_notify") &&
        get_option("pnfpb_ic_fcm_loggedin_notify") === "1"
    ) {
        $deviceids_webview_count = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > 0 AND device_id NOT LIKE %s AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)",
                $table_name,
                "%@N%",
                "%!!webview%"
            )
        );
    } else {
        $deviceids_webview_count = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)",
                $table_name,
                "%@N%",
                "%!!webview%"
            )
        );
    }

    $activity_content_push = mb_substr(
        stripslashes(
            wp_strip_all_tags(
                urldecode(trim(htmlspecialchars_decode($post_content)))
            )
        ),
        0,
        130,
        "UTF-8"
    );

    $activity_content_push = preg_replace(
        "/\r|\n/",
        " ",
        $activity_content_push
    );

    $iconurl = get_option("pnfpb_ic_fcm_upload_icon");

    $pnfbp_post_type = "post";
    if (isset($post)) {
        $pnfbp_post_type = $post->post_type;
    } else {
        if (
            get_option("pnfpb_ic_fcm_new_post_type") &&
            get_option("pnfpb_ic_fcm_new_post_type") != ""
        ) {
            $pnfbp_post_type = get_option("pnfpb_ic_fcm_new_post_type");
        }
    }

    $sender_name = "";

    if (isset($post) && $post !== null) {
        $authorid = $post->post_author;
        $sender_name = get_the_author_meta("display_name", $authorid);
    } else {
        if ($authorid) {
            $sender_name = get_the_author_meta("display_name", $authorid);
        }
    }

    if (
        get_option("pnfpb_ic_fcm_" . $pnfbp_post_type . "_title") &&
        get_option("pnfpb_ic_fcm_" . $pnfbp_post_type . "_title") != ""
    ) {
        $post_title = get_option("pnfpb_ic_fcm_" . $pnfbp_post_type . "_title");

        $post_title = str_replace("[member name]", $sender_name, $post_title);
    } else {
        if ($post_title === null || $post_title == "") {
            $post_title =
                esc_html(
                    __(
                        "New post from ",
                        "push-notification-for-post-and-buddypress"
                    )
                ) . get_bloginfo("name");
        }
    }

    $post_title = str_replace("[member name]", $sender_name, $post_title);

    $activity_content_push = str_replace(
        "[member name]",
        $sender_name,
        $activity_content_push
    );
	
	if ($webpush_option === '1' || $webpush_option === '2' || $webpush_firebase === '1') {

		$target_deviceid_values = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT * FROM %i WHERE web_auth <> %s AND web_256 <> %s AND subscription_auth_token <> %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
				$table_name,
				"","",""
			)
		);

		if (count($target_deviceid_values) > 0) {
			foreach ($target_deviceid_values as $target_deviceid_value) {
				$target_subscription_array[] =  [
					"endpoint" => $target_deviceid_value->web_auth,
					"keys" => [
						'p256dh' => $target_deviceid_value->web_256,
						'auth' => $target_deviceid_value->subscription_auth_token
					]
				];
			}

			$PNFPB_WP_web_push_notification_class_obj = new PNFPB_web_push_notification_class();
			$PNFPB_WP_web_push_notification_class_obj->PNFPB_web_push_notification(
				0,
				stripslashes(wp_strip_all_tags($post_title)),
				stripslashes(
					wp_strip_all_tags($activity_content_push)
				),
				$iconurl,
				$imageurl,
				$postlink,
				["click_url" => $postlink],
				$target_subscription_array,
				$ownerid,
				$targetid,
				$pnfbp_post_type	
			);						
		}
	}	

    if (get_option("pnfpb_webtoapp_push") === "1") {
        $target_userid_array_values = $wpdb->get_col(
            $wpdb->prepare(
                "SELECT device_id FROM %i WHERE (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
                $table_name
            )
        );

        if (
            get_option("pnfpb_ic_fcm_post_schedule_now_enable") &&
            get_option("pnfpb_ic_fcm_post_schedule_now_enable") === "1"
        ) {
            $action_scheduler_status = as_schedule_single_action(
                time(),
                "PNFPB_webtoapp_schedule_push_notification_hook",
                [
                    0,
                    $post_title,
                    $activity_content_push,
                    $postlink,
                    $imageurl,
                    0,
                    "",
                    $target_userid_array_values,
                ]
            );
        } else {
			$PNFPB_WP_webtoapp_notification_class_obj = new PNFPB_webtoapp_notification_class();
			$PNFPB_WP_webtoapp_notification_class_obj->PNFPB_webtoapp_notification(
                0,
                $post_title,
                $activity_content_push,
                $postlink,
                $imageurl,
                0,
                "",
                $target_userid_array_values
            );
        }
    }

    if (get_option("pnfpb_progressier_push") === "1") {
            $target_userid_array_values = $wpdb->get_col(
                $wpdb->prepare(
                    "SELECT device_id FROM %i WHERE device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
                    $table_name,
                    "%progressier%"
                )
            );

            if (
                get_option("pnfpb_ic_fcm_post_schedule_now_enable") &&
                get_option("pnfpb_ic_fcm_post_schedule_now_enable") === "1"
            ) {
                $action_scheduler_status = as_schedule_single_action(
                    time(),
                    "PNFPB_progressier_schedule_push_notification_hook",
                    [
                        0,
                        $post_title,
                        $activity_content_push,
                        $postlink,
                        $imageurl,
                        0,
                        "",
                        $target_userid_array_values,
                    ]
                );
            } else {
				$PNFPB_WP_progressier_notification_class_obj = new PNFPB_progressier_notification_class();
				$PNFPB_WP_progressier_notification_class_obj->PNFPB_progressier_notification(
                    0,
                    $post_title,
                    $activity_content_push,
                    $postlink,
                    $imageurl,
                    0,
                    "",
                    $target_userid_array_values
                );
            }
    } else {
        if (get_option("pnfpb_onesignal_push") === "1") {
            $target_userid_array = [];

            $target_group_userid_array = [];

            $target_userid_array_values = $wpdb->get_col(
                $wpdb->prepare(
                    "SELECT userid FROM %i WHERE device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
                    $table_name,
                    "%onesignal%"
                )
            );

            $target_userid_array = array_map(function ($value) {
                return $value == 1 ? "1pnfpbadm" : $value;
            }, $target_userid_array_values);

            $target_group_userid_array = $target_userid_array;

            if (
                ($pnfbp_post_type === "forum" ||
                    $pnfbp_post_type === "reply" ||
                    $pnfbp_post_type === "topic") &&
                function_exists("bb_is_member_subscribed_group") &&
                function_exists("bbp_is_group_forums_active") &&
                function_exists("bp_group_is_forum_enabled") &&
                bbp_is_group_forums_active()
            ) {
                $bb_target_userid_array = [];

				$subscribed_topicid = wp_get_post_parent_id(intval($postid));

				if (!$subscribed_topicid) {
						
					$bb_target_userid_array = [];
						
				} else {
						
					$bb_target_userid_array = bbp_get_topic_subscribers($subscribed_topicid);
				}

                if (count($bb_target_userid_array) > 0) {
                        if (
                            get_option(
                                "pnfpb_ic_fcm_post_schedule_now_enable"
                            ) &&
                            get_option(
                                "pnfpb_ic_fcm_post_schedule_now_enable"
                            ) === "1"
                        ) {
                            $action_scheduler_status = as_schedule_single_action(
                                time(),
                                "PNFPB_onesignal_schedule_push_notification_hook",
                                [
                                    $postid,
                                    $post_title,
                                    $activity_content_push,
                                    $postlink,
                                    $imageurl,
                                    $bb_target_userid_array,
                                ]
                            );
                        } else {
							$PNFPB_WP_onesignal_notification_class_obj = new PNFPB_onesignal_notification_class();
							$PNFPB_WP_onesignal_notification_class_obj->PNFPB_onesignal_notification(
                                $postid,
                                $post_title,
                                $activity_content_push,
                                $postlink,
                                $imageurl,
                                $bb_target_userid_array
                            );
                        }
                    }
            } else {
                if (count($target_userid_array) > 0) {
                    if (
                        get_option("pnfpb_ic_fcm_post_schedule_now_enable") &&
                        get_option("pnfpb_ic_fcm_post_schedule_now_enable") ===
                            "1"
                    ) {
                        $action_scheduler_status = as_schedule_single_action(
                            time(),
                            "PNFPB_onesignal_schedule_push_notification_hook",
                            [
                                $postid,
                                $post_title,
                                $activity_content_push,
                                $postlink,
                                $imageurl,
                                $target_userid_array,
                            ]
                        );
                    } else {
						$PNFPB_WP_onesignal_notification_class_obj = new PNFPB_onesignal_notification_class();
						$PNFPB_WP_onesignal_notification_class_obj->PNFPB_onesignal_notification(
                            $postid,
                            $post_title,
                            $activity_content_push,
                            $postlink,
                            $imageurl,
                            $target_userid_array
                        );
                    }
                }
            }
        } else {
            $target_group_userid_array = $wpdb->get_col(
                $wpdb->prepare(
                    "SELECT userid FROM %i WHERE device_id NOT LIKE %s LIMIT 1000",
                    $table_name,"%onesignal%"
                )
            );

            if (
                get_option("pnfpb_httpv1_push") === "1" &&
                get_option("pnfpb_ic_fcm_only_post_subscribers_enable") ===
                    "1" &&
                $pnfbp_post_type === "reply"
            ) {
                $bb_target_userid_array = [];

                $deviceids = [];

                $deviceidswebview = [];

                $buddyboss_pnfpb = false;

                if (
                    ($pnfbp_post_type === "forum" ||
                        $pnfbp_post_type === "reply" ||
                        $pnfbp_post_type === "topic") &&
                    function_exists("bb_is_member_subscribed_group") &&
                    function_exists("bbp_is_group_forums_active") &&
                    function_exists("bp_group_is_forum_enabled") &&
                    bbp_is_group_forums_active()
                ) {
                    $buddyboss_pnfpb = true;

                    $bb_target_userid_array = [];
					
					$subscribed_topicid = wp_get_post_parent_id(intval($postid));
					
					if (!$subscribed_topicid) {
						
						$bb_target_userid_array = [];
						
					} else {
						
						$bb_target_userid_array = bbp_get_topic_subscribers($subscribed_topicid);
					}
					
                 }

                if (
                    get_option("pnfpb_ic_fcm_loggedin_notify") !== "1" 
                ) {
                    if (count($bb_target_userid_array) > 0 && $buddyboss_pnfpb) {
                        $bb_target_userid_implArray = implode(
                            ",",
                            $bb_target_userid_array
                        );

                        $deviceids = $wpdb->get_col(
                            $wpdb->prepare(
                                "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND userid IN ($bb_target_userid_implArray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 5000",
                                $table_name,
                                "%@N%",
                                "%!!webview%",
                                "%!!%"
                            )
                        );
                    } else {
                        if (
                            !$buddyboss_pnfpb &&
                            get_option(
                                "pnfpb_ic_fcm_only_post_subscribers_enable"
                            ) !== "1" &&
                            $pnfbp_post_type !== "reply"
                        ) {
                            $deviceids = $wpdb->get_col(
                                $wpdb->prepare(
                                    "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 5000",
                                    $table_name,
                                    "%@N%",
                                    "%!!webview%",
                                    "%!!%"
                                )
                            );
                        } else {
                            if (
								!$buddyboss_pnfpb &&
                                function_exists("bbp_get_subscribers") &&
                                get_option(
                                    "pnfpb_ic_fcm_only_post_subscribers_enable"
                                ) === "1" &&
                                $pnfbp_post_type === "reply"
                            ) {
                                $subscribed_topicid = wp_get_post_parent_id(intval($postid));
								$subscribed_user_ids = [];
								if (!$subscribed_topicid) {
									$subscribed_user_ids = [];
								} else {
									$subscribed_user_ids = bbp_get_subscribers($subscribed_topicid);
								}								

                                if (count($subscribed_user_ids) > 0) {
                                    $subscribed_user_ids_implArray = implode(
                                        ",",
                                        $subscribed_user_ids
                                    );

                                    $deviceids = $wpdb->get_col(
                                        $wpdb->prepare(
                                            "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND userid IN ($subscribed_user_ids_implArray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 5000",
                                            $table_name,
                                            "%@N%",
                                            "%!!webview%",
                                            "%!!%"
                                        )
                                    );

                                }
                            }
                        }
                    }
                } else {
                    if (
                        get_option("pnfpb_ic_fcm_loggedin_notify") &&
                        get_option("pnfpb_ic_fcm_loggedin_notify") === "1"
                    ) {
                        if (count($bb_target_userid_array) > 0 && $buddyboss_pnfpb) {
                            $bb_target_userid_implArray = implode(
                                ",",
                                $bb_target_userid_array
                            );

                            $deviceids = $wpdb->get_col(
                                $wpdb->prepare(
                                    "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > 0 AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND userid IN ($bb_target_userid_implArray) LIMIT 5000",
                                    $table_name,
                                    "%@N%",
                                    "%!!webview%",
                                    "%!!%"
                                )
                            );
                        } else {
                            if (
                                !$buddyboss_pnfpb &&
                                get_option(
                                    "pnfpb_ic_fcm_only_post_subscribers_enable"
                                ) !== "1" &&
                                $pnfbp_post_type !== "reply"
                            ) {
                                $deviceids = $wpdb->get_col(
                                    $wpdb->prepare(
                                        "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > 0 AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s LIMIT 5000",
                                        $table_name,
                                        "%@N%",
                                        "%!!webview%",
                                        "%!!%"
                                    )
                                );
                            } else {
                                if (
									!$buddyboss_pnfpb &&
                                    function_exists("bbp_get_subscribers") &&
                                    get_option(
                                        "pnfpb_ic_fcm_only_post_subscribers_enable"
                                    ) === "1" &&
                                    $pnfbp_post_type === "reply"
                                ) {
                                    
									$subscribed_topicid = wp_get_post_parent_id(intval($postid));
									
									if (!$subscribed_topicid) {
										$subscribed_user_ids = [];
									} else {
										$subscribed_user_ids = bbp_get_subscribers($subscribed_topicid);
									}	

                                    if (count($subscribed_user_ids) > 0) {
                                        $subscribed_user_ids_implArray = implode(
                                            ",",
                                            $subscribed_user_ids
                                        );

                                        $deviceids = $wpdb->get_col(
                                            $wpdb->prepare(
                                                "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND userid IN ($subscribed_user_ids_implArray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 5000",
                                                $table_name,
                                                "%@N%",
                                                "%!!webview%",
                                                "%!!%"
                                            )
                                        );
                                    }
                                }
                            }
                        }
                    } else {
                        if (count($bb_target_userid_array) > 0 && $buddyboss_pnfpb) {
                            $bb_target_userid_implArray = implode(
                                ",",
                                $bb_target_userid_array
                            );

                            $deviceids = $wpdb->get_col(
                                $wpdb->prepare(
                                    "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND userid IN ($bb_target_userid_implArray) LIMIT 5000",
                                    $table_name,
                                    "%@N%",
                                    "%!!webview%",
                                    "%!!%"
                                )
                            );
                        } else {
                            if (
                                !$buddyboss_pnfpb &&
                                get_option(
                                    "pnfpb_ic_fcm_only_post_subscribers_enable"
                                ) !== "1" &&
                                $pnfbp_post_type !== "reply"
                            ) {
                                $deviceids = $wpdb->get_col(
                                    $wpdb->prepare(
                                        "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s LIMIT 5000",
                                        $table_name,
                                        "%@N%",
                                        "%!!webview%",
                                        "%!!%"
                                    )
                                );
                            } else {
                                if (
									!$buddyboss_pnfpb &&
                                    function_exists("bbp_get_subscribers") &&
                                    get_option(
                                        "pnfpb_ic_fcm_only_post_subscribers_enable"
                                    ) === "1" &&
                                    $pnfbp_post_type === "reply"
                                ) {
                                  //  $subscribed_topicid = bbp_get_reply_topic_id(
                                  //      intval($postid)
                                  //  );

									$subscribed_topicid = wp_get_post_parent_id(intval($postid));
									
									if (!$subscribed_topicid) {
										$subscribed_user_ids = [];
									} else {
										$subscribed_user_ids = bbp_get_subscribers($subscribed_topicid);
									}

                                    if (count($subscribed_user_ids) > 0) {
                                        $subscribed_user_ids_implArray = implode(
                                            ",",
                                            $subscribed_user_ids
                                        );

                                        $deviceids = $wpdb->get_col(
                                            $wpdb->prepare(
                                                "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND userid IN ($subscribed_user_ids_implArray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 5000",
                                                $table_name,
                                                "%@N%",
                                                "%!!webview%",
                                                "%!!%"
                                            )
                                        );
                                    }
                                }
                            }
                        }
                    }
                }

                if (
                    get_option("pnfpb_ic_fcm_loggedin_notify") &&
                    get_option("pnfpb_ic_fcm_loggedin_notify") === "1"
                ) {
                    if (count($bb_target_userid_array) > 0 && $buddyboss_pnfpb) {
                        $bb_target_userid_implArray = implode(
                            ",",
                            $bb_target_userid_array
                        );

                        $deviceidswebview = $wpdb->get_col(
                            $wpdb->prepare(
                                "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > 0 AND device_id NOT LIKE %s AND device_id LIKE %s AND userid IN ($bb_target_userid_implArray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT  5000",
                                $table_name,
                                "%@N%",
                                "%!!webview%"
                            )
                        );
                    } else {
                        if (
                            !$buddyboss_pnfpb &&
                            get_option(
                                "pnfpb_ic_fcm_only_post_subscribers_enable"
                            ) !== "1" &&
                            $pnfbp_post_type !== "reply"
                        ) {
                            $deviceidswebview = $wpdb->get_col(
                                $wpdb->prepare(
                                    "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > 0 AND device_id NOT LIKE %s AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT  5000",
                                    $table_name,
                                    "%@N%",
                                    "%!!webview%"
                                )
                            );
                        } else {
                            if (
								!$buddyboss_pnfpb &&
                                function_exists("bbp_get_subscribers") &&
                                get_option(
                                    "pnfpb_ic_fcm_only_post_subscribers_enable"
                                ) === "1" &&
                                $pnfbp_post_type === "reply"
                            ) {
								$subscribed_topicid = wp_get_post_parent_id(intval($postid));
									
								if (!$subscribed_topicid) {
									$subscribed_user_ids = [];
								} else {
									$subscribed_user_ids = bbp_get_subscribers($subscribed_topicid);
								}

                                if (count($subscribed_user_ids) > 0) {
                                    $subscribed_user_ids_implArray = implode(
                                        ",",
                                        $subscribed_user_ids
                                    );

                                    $deviceidswebview = $wpdb->get_col(
                                        $wpdb->prepare(
                                            "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id LIKE %s AND device_id NOT LIKE %s AND userid IN ($subscribed_user_ids_implArray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT  5000",
                                            $table_name,
                                            "%@N%",
                                            "%!!webview%",
                                            "%!!%"
                                        )
                                    );
                                }
                            }
                        }
                    }
                } else {
                    if (count($bb_target_userid_array) > 0 && $buddyboss_pnfpb) {
                        $bb_target_userid_implArray = implode(
                            ",",
                            $bb_target_userid_array
                        );

                        $deviceidswebview = $wpdb->get_col(
                            $wpdb->prepare(
                                "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id LIKE %s AND userid IN ($bb_target_userid_implArray)  AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 5000",
                                $table_name,
                                "%@N%",
                                "%!!webview%"
                            )
                        );
                    } else {
                        if (
                            !$buddyboss_pnfpb &&
                            get_option(
                                "pnfpb_ic_fcm_only_post_subscribers_enable"
                            ) !== "1" &&
                            $pnfbp_post_type !== "reply"
                        ) {
                            $deviceidswebview = $wpdb->get_col(
                                $wpdb->prepare(
                                    "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 5000",
                                    $table_name,
                                    "%@N%",
                                    "%!!webview%"
                                )
                            );
                        } else {
                            if (
								!$buddyboss_pnfpb &&
                                function_exists("bbp_get_subscribers") &&
                                get_option(
                                    "pnfpb_ic_fcm_only_post_subscribers_enable"
                                ) === "1" &&
                                $pnfbp_post_type === "reply"
                            ) {
								$subscribed_topicid = wp_get_post_parent_id(intval($postid));
									
								if (!$subscribed_topicid) {
									$subscribed_user_ids = [];
								} else {
									$subscribed_user_ids = bbp_get_subscribers($subscribed_topicid);
								}

                                if (count($subscribed_user_ids) > 0) {
                                    $subscribed_user_ids_implArray = implode(
                                        ",",
                                        $subscribed_user_ids
                                    );

                                    $deviceidswebview = $wpdb->get_col(
                                        $wpdb->prepare(
                                            "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id LIKE %s AND device_id NOT LIKE %s AND userid IN ($subscribed_user_ids_implArray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT  5000",
                                            $table_name,
                                            "%@N%",
                                            "%!!webview%",
                                            "%!!%"
                                        )
                                    );
                                }
                            }
                        }
                    }
                }
            }

            if (get_option("pnfpb_httpv1_push") === "1") {

                $url = "https://fcm.googleapis.com/fcm/send";
				
				if ($imageurl !== '') {
					
					$iconurl = $imageurl;
	
				}				

                $regid = $deviceids;

                if (
                    get_option("pnfpb_ic_fcm_post_schedule_now_enable") &&
                    get_option("pnfpb_ic_fcm_post_schedule_now_enable") ===
                        "1" &&
                    get_option("pnfpb_ic_fcm_only_post_subscribers_enable") !==
                        "1"
                ) {
                    $action_scheduler_status = as_schedule_single_action(
                        time(),
                        "PNFPB_httpv1_schedule_push_notification_hook",
                        [
                            0,
                            stripslashes(wp_strip_all_tags($post_title)),
                            stripslashes(
                                wp_strip_all_tags($activity_content_push)
                            ),
                            $iconurl,
                            $imageurl,
                            $postlink,
                            ["click_url" => $postlink],
                            $regid,
                            $deviceidswebview,
                            $ownerid,
                            $targetid,
                            $pnfbp_post_type,
                        ]
                    );
                } else {
                    if (
                        get_option(
                            "pnfpb_ic_fcm_only_post_subscribers_enable"
                        ) === "1" &&
                        $pnfbp_post_type === "reply"
                    ) {
                        $target_device_ids_merged = array_merge(
                            $regid,
                            $deviceidswebview
                        );

                        $target_device_ids_1000_counts = array_chunk(
                            $target_device_ids_merged,
                            1000
                        );

                        for (
                            $i = 0;
                            $i < count($target_device_ids_1000_counts);
                            $i++
                        ) {
                            $action_scheduler_status = as_schedule_single_action(
                                time(),
                                "PNFPB_httpv1_schedule_push_notification_hook",
                                [
                                    0,
                                    stripslashes(
                                        wp_strip_all_tags($post_title)
                                    ),
                                    stripslashes(
                                        wp_strip_all_tags(
                                            $activity_content_push
                                        )
                                    ),
                                    $iconurl,
                                    $imageurl,
                                    $postlink,
                                    ["click_url" => $postlink],
                                    $target_device_ids_1000_counts[$i],
                                    [],
                                    $ownerid,
                                    $targetid,
                                    $pnfbp_post_type,
                                ]
                            );
                        }
                    } else {
						$FB_httpv1_notification_class_obj = new PNFPB_firebase_httpv1_notification_class();
						$FB_httpv1_notification_class_obj->PNFPB_firebase_httpv1_notification(
                            0,
                            stripslashes(wp_strip_all_tags($post_title)),
                            stripslashes(
                                wp_strip_all_tags($activity_content_push)
                            ),
                            $iconurl,
                            $imageurl,
                            $postlink,
                            ["click_url" => $postlink],
                            $regid,
                            $deviceidswebview,
                            $ownerid,
                            $targetid,
                            $pnfbp_post_type
                        );
                    }
                }

                $table = $wpdb->prefix . "pnfpb_ic_schedule_push_notifications";

                $bpuserid = 0;

                if (is_user_logged_in()) {
                    $bpuserid = get_current_user_id();
                }

                $data = [
                    "userid" => $bpuserid,
                    "action_scheduler_id" => null,
                    "title" => stripslashes(wp_strip_all_tags($post_title)),
                    "content" => stripslashes(
                        wp_strip_all_tags($activity_content_push)
                    ),
                    "image_url" => $imageurl,
                    "click_url" => $postlink,
                    "scheduled_timestamp" => time(),
                    "scheduled_type" => "onetime post",
                    "status" => "sent",
                ];

                $insertid = $wpdb->insert($table, $data);

                do_action("PNFPB_connect_to_external_api_for_post");
            }
        }
    }
}
?>