<?php
global $wpdb;
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

$imageurl = "";
$deviceids = [];
$deviceidswebview = [];
$ownerid = $postid;
$targetid = 0;

$current_hook = current_filter();
$post_type_hook = str_replace( 'PNFPB_cron_', '', $current_hook );
$post_type = str_replace( '_hook', '', $post_type_hook );

if (
    $post_title === null ||
    wp_next_scheduled("PNFPB_cron_".$post_type."_hook") ||
    as_has_scheduled_action("PNFPB_cron_".$post_type."_hook")
) {
    $post_title = "[member name] posted new post in " . get_bloginfo("name");
    $post_content = "New content in " . get_bloginfo("name");
    $postlink = get_home_url();
    $authorid = null;
	
	$pnfbp_post_type = $post_type;

    $recent_posts = wp_get_recent_posts([
        "numberposts" => 1, // Number of recent posts thumbnails to display
        "post_status" => "publish", // Show only the published posts
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
    if (isset($post) && isset($post->post_type)) {
        $pnfbp_post_type = $post->post_type;
    } else {
        if (
            get_option("pnfpb_ic_fcm_new_post_type") &&
            get_option("pnfpb_ic_fcm_new_post_type") != ""
        ) {
            $pnfbp_post_type = get_option("pnfpb_ic_fcm_new_post_type");
        }
    }
	
	$post_topic_count = 0;

	if ($pnfbp_post_type === 'post') {
		if (get_option('pnfpb_post_subscription_count') !== false && 
			get_option('pnfpb_general_subscription_count') !== false &&
			(get_option('pnfpb_post_subscription_count') > 0 || get_option('pnfpb_general_subscription_count') > 0)) {
			$post_topic_count = intval(get_option('pnfpb_post_subscription_count'))+intval(get_option('pnfpb_general_subscription_count'));
		}
		
	} else {
		$custom_post_option = 'pnfpb_'.$pnfbp_post_type.'_subscription_count';
		if (get_option($custom_post_option) !== false  && 
			get_option('pnfpb_general_subscription_count') !== false &&
			(get_option($custom_post_option) > 0 || get_option('pnfpb_general_subscription_count') > 0)) {
			$post_topic_count = get_option($custom_post_option)+intval(get_option('pnfpb_general_subscription_count'));
		}
	}

	$sender_name = "";
	$authorid = 0;
    if (isset($post) && isset($post->post_author)) {
        $authorid = $post->post_author;
        $sender_name = get_the_author_meta("display_name", $authorid);
    } else {
        if (isset($authorid)) {
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
			(get_option("pnfpb_ic_fcm_only_post_subscribers_enable") !==
			"1" ||
			$pnfbp_post_type !== "reply") &&			
			get_option("pnfpb_ic_fcm_only_role_based_post_enable") !==
			"1" &&
			get_option("pnfpb_ic_fcm_only_post_followers_enable") !==
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
					["click_url" => $postlink, "post_id" => strval($postid)],
					$regid,
					$deviceidswebview,
					$ownerid,
					$targetid,
					$pnfbp_post_type,
					"",
					0,
					$post_topic_count
				]
			);
		} else {
			if (
				get_option("pnfpb_ic_fcm_post_schedule_now_enable") !==
				"1" &&
				(get_option("pnfpb_ic_fcm_only_post_subscribers_enable") !==
				"1" ||
				$pnfbp_post_type !== "reply") &&
				get_option("pnfpb_ic_fcm_only_role_based_post_enable") !==
				"1" &&
				get_option("pnfpb_ic_fcm_only_post_followers_enable") !==
				"1"
			) {
				$PNFPB_httpv1_notification_class_obj = new PNFPB_firebase_httpv1_notification_class();
				$PNFPB_httpv1_notification_class_obj->PNFPB_firebase_httpv1_notification(
					0,
					stripslashes(wp_strip_all_tags($post_title)),
					stripslashes(
						wp_strip_all_tags($activity_content_push)
					),
					$iconurl,
					$imageurl,
					$postlink,
					["click_url" => $postlink, "post_id" => strval($postid)],
					$regid,
					$deviceidswebview,
					$ownerid,
					$targetid,
					$pnfbp_post_type,
					"",
					0,
					$post_topic_count
				);
			} else {
				if (
					get_option("pnfpb_httpv1_push") === "1" &&
					 is_user_logged_in() &&
					get_option("pnfpb_ic_fcm_only_post_followers_enable") ===
					"1" &&
					get_option("pnfpb_ic_fcm_post_type_followers") === $pnfbp_post_type
				) {
					if (is_user_logged_in() && class_exists('BP_Follow')) {
						/* check for role based notification */
						$pnfpb_check_allow_notification = true;
						if (get_option("pnfpb_ic_fcm_only_role_based_post_enable") === "1"  &&
						get_option("pnfpb_ic_fcm_post_type_role_based") === $pnfbp_post_type) {
							$pnfpb_user_role = get_option("pnfpb_ic_fcm_select_role_based");
							$pnfpb_args = array(
								'role'    => $pnfpb_user_role, // Replace 'your_role_name_here' with the actual role slug (e.g., 'administrator', 'editor', 'subscriber')
								'fields'  => 'ID', // This will return an array of user IDs
								'orderby' => 'ID',
								'order'   => 'ASC'
							);
							$pnfpb_user_role_ids = get_users( $pnfpb_args );
							if ($authorid > 0 && in_array($authorid,$pnfpb_user_role_ids)) {
								$pnfpb_check_allow_notification = true;
							} else {
								$pnfpb_check_allow_notification = false;
							}
						}
						if ($pnfpb_check_allow_notification){
							$pnfpb_current_userid = get_current_user_id();
							$topicname = "pnfpb_buddypress_followers_".$pnfpb_current_userid;
							if (
								get_option("pnfpb_ic_fcm_post_schedule_now_enable") &&
								get_option("pnfpb_ic_fcm_post_schedule_now_enable") ===
								"1") {							
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
										["click_url" => $postlink, "post_id" => strval($postid)],
										[],
										[],
										$ownerid,
										$targetid,
										$topicname,
										"",
										0,
										$post_topic_count								
									]
								);
							} else {
								$PNFPB_httpv1_notification_class_obj = new PNFPB_firebase_httpv1_notification_class();
								$PNFPB_httpv1_notification_class_obj->PNFPB_firebase_httpv1_notification(
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
									["click_url" => $postlink, "post_id" => strval($postid)],
									[],
									[],
									$ownerid,
									$targetid,
									$topicname,
									"",
									0,
									$post_topic_count										
								);								
							}
						}
					}
				} else {
					if (
						get_option("pnfpb_httpv1_push") === "1" &&
						get_option("pnfpb_ic_fcm_only_post_followers_enable") !==
						"1" &&						
						get_option("pnfpb_ic_fcm_only_role_based_post_enable") ===
						"1"  &&
						get_option("pnfpb_ic_fcm_post_type_role_based") === $pnfbp_post_type
					) {
						$pnfpb_user_role = get_option("pnfpb_ic_fcm_select_role_based");
						
						$pnfpb_args = array(
							'role'    => $pnfpb_user_role, // Replace 'your_role_name_here' with the actual role slug (e.g., 'administrator', 'editor', 'subscriber')
							'fields'  => 'ID', // This will return an array of user IDs
							'orderby' => 'ID',
							'order'   => 'ASC'
						);
						$pnfpb_user_role_ids = get_users( $pnfpb_args );
						if ($authorid > 0 && in_array($authorid,$pnfpb_user_role_ids)) {
							if (
								get_option("pnfpb_ic_fcm_post_schedule_now_enable") &&
								get_option("pnfpb_ic_fcm_post_schedule_now_enable") ===
								"1") {						
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
												[],
												[],
												$ownerid,
												$targetid,
												$pnfbp_post_type,
												"",
												0,
												$post_topic_count												
											]
										);
								} else {
									$PNFPB_httpv1_notification_class_obj = new PNFPB_firebase_httpv1_notification_class();
									$PNFPB_httpv1_notification_class_obj->PNFPB_firebase_httpv1_notification(
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
												[],
												[],
												$ownerid,
												$targetid,
												$pnfbp_post_type,
												"",
												0,
												$post_topic_count										
									);									
								}
						}
					} else {
						$bb_target_userid_array = [];
						$deviceids = [];
						$deviceidswebview = [];
						$buddyboss_pnfpb = false;				
						if (
							get_option("pnfpb_httpv1_push") === "1" &&
							get_option("pnfpb_ic_fcm_only_post_subscribers_enable") ===
							"1" 
						) {

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
									$deviceids = $bb_target_userid_array;
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
												"SELECT DISTINCT(SUBSTRING_INDEX(device_id, '!!', 1)) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 500",
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
											$deviceids = $subscribed_user_ids;
										}
									}
								}
							} else {
								if (
									get_option("pnfpb_ic_fcm_loggedin_notify") &&
									get_option("pnfpb_ic_fcm_loggedin_notify") === "1"
								) {
									if (count($bb_target_userid_array) > 0 && $buddyboss_pnfpb) {
										$deviceids = $bb_target_userid_array;
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
													"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > 0 AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s LIMIT 500",
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
												$deviceids = $subscribed_user_ids;
											}
										}
									}
								} else {
									if (count($bb_target_userid_array) > 0 && $buddyboss_pnfpb) {
										$deviceids = $bb_target_userid_array;
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
													"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s LIMIT 500",
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
												$deviceids = $subscribed_user_ids;
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
									$deviceidswebview = $bb_target_userid_array;
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
												"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > 0 AND device_id NOT LIKE %s AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT  50",
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
											$deviceidswebview = $subscribed_user_ids;	
										}
									}
								}
							} else {
								if (count($bb_target_userid_array) > 0 && $buddyboss_pnfpb) {
									$deviceidswebview = $bb_target_userid_array;
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
												"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 50",
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
											$deviceidswebview = $subscribed_user_ids;
										}
									}
								}
							}
							
							$target_device_ids_merged = array_merge(
								$deviceids,
								$deviceidswebview
							);
							
							if (
								get_option(
									"pnfpb_ic_fcm_only_post_subscribers_enable"
								) === "1" &&
								get_option("pnfpb_ic_fcm_post_schedule_now_enable") &&
								get_option("pnfpb_ic_fcm_post_schedule_now_enable") ===
								"1" &&								
								$pnfbp_post_type === "reply"
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
										$target_device_ids_merged,
										[],
										$ownerid,
										$targetid,
										$pnfbp_post_type
									]
								);
							} else {
								
							if (
								get_option(
									"pnfpb_ic_fcm_only_post_subscribers_enable"
								) === "1" &&
								$pnfbp_post_type === "reply"
							) {								
									$PNFPB_httpv1_notification_class_obj = new PNFPB_firebase_httpv1_notification_class();
									$PNFPB_httpv1_notification_class_obj->PNFPB_firebase_httpv1_notification(
										0,
										stripslashes(wp_strip_all_tags($post_title)),
										stripslashes(
											wp_strip_all_tags($activity_content_push)
										),
										$iconurl,
										$imageurl,
										$postlink,
										["click_url" => $postlink],
										$target_device_ids_merged,
										$deviceidswebview,
										$ownerid,
										$targetid,
										$pnfbp_post_type
									);
								}
							}					
						}				
					}						
				}
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
		
	} else {	
	
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
					["click_url" => $postlink, "post_id" => strval($postid)],
					$target_subscription_array,
					$ownerid,
					$targetid,
					$pnfbp_post_type	
				);						
			}
		} else {
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
			} else {
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
					} 
				}
			}
        }
    }
}
?>