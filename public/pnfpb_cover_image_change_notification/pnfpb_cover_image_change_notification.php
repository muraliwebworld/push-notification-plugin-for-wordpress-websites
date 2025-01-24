<?php

/**
 * Triggered after cover image change sent for user in BuddyPress.
 * to send push notifications Opt in/out for the notification can be
 * controlled from plugin settings.
 *
 *
 * @param array   $raw_args		Message content array
 *
 *
 * @since 1.47
 */

$apiaccesskey = get_option("pnfpb_ic_fcm_google_api");

// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

if (
    (get_option("pnfpb_ic_fcm_cover_image_change_enable") == 1 &&
        get_option("pnfpb_progressier_push") !== "1" &&
        ($apiaccesskey != "" && $apiaccesskey != false)) ||
    (get_option("pnfpb_ic_fcm_cover_image_change_enable") == 1 &&
        (get_option("pnfpb_onesignal_push") === "1" ||
            get_option("pnfpb_httpv1_push") === "1"))
) {
    global $wpdb;

    $deviceidswebview = [];

    $deviceids = [];

    $member_name = bp_core_get_user_displayname($item_id);

    $table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

    $url = "https://fcm.googleapis.com/fcm/send";

    $activity_content_push = "";

    $notificationtitle =
        $member_name .
        esc_html(
            __(
                " updated cover photo",
                "push-notification-for-post-and-buddypress"
            )
        );

    $titletext = get_option("pnfpb_ic_fcm_cover_image_change_text");

    if ($titletext && $titletext !== "") {
        $notificationtitle = str_replace(
            "[member name]",
            $member_name,
            $titletext
        );
    }

    $activity_content_push = str_replace(
        "[member name]",
        $member_name,
        $activity_content_push
    );

    if (function_exists("bp_members_get_user_url")) {
        $messageurl = esc_url(bp_members_get_user_url($item_id));
    } else {
        $messageurl = esc_url(bp_core_get_user_domain($item_id));
    }

    if (get_option("pnfpb_onesignal_push") === "1") {
        $target_userid_array = [];

        if (
            (get_option("pnfpb_ic_fcm_loggedin_notify") &&
                get_option("pnfpb_ic_fcm_loggedin_notify") === "1") ||
            get_option("pnfpb_ic_fcm_frontend_enable_subscription") === "1"
        ) {
            $target_userid_array_values = $wpdb->get_col(
                $wpdb->prepare(
                    "SELECT userid FROM %i WHERE device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,10,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
                    $table_name,
                    "%onesignal%"
                )
            );

            $target_userid_array = array_map(function ($value) {
                return $value == 1 ? "1pnfpbadm" : $value;
            }, $target_userid_array_values);
        }

        if (
            get_option("pnfpb_ic_fcm_buddypressoptions_schedule_now_enable") &&
            get_option("pnfpb_ic_fcm_buddypressoptions_schedule_now_enable") ===
                "1"
        ) {
            $action_scheduler_status = as_schedule_single_action(
                time(),
                "PNFPB_onesignal_schedule_push_notification_hook",
                [
                    $activity_id,
                    $activitytitle,
                    $localactivitycontent,
                    $activitylink,
                    $imageurl,
                    $target_userid_array,
                ]
            );
        } else {
            $response = $this->PNFPB_icfcm_onesignal_push_notification(
                $activity_id,
                $activitytitle,
                $localactivitycontent,
                $activitylink,
                $imageurl,
                $target_userid_array
            );
        }
    } else {
        $iconurl = bp_core_fetch_avatar([
            "item_id" => $item_id, // output user id of post author
            "type" => "full",
            "html" => false, // FALSE = return url, TRUE (default) = return url wrapped with html
        ]);

        $imageurl = "";

        if (
            get_option("pnfpb_ic_fcm_cover_image_change_content") != false &&
            get_option("pnfpb_ic_fcm_cover_image_change_content") != ""
        ) {
            $activity_content_push = get_option(
                "pnfpb_ic_fcm_cover_image_change_content"
            );
        }

        if (get_option("pnfpb_httpv1_push") === "1") {
            if (
                get_option(
                    "pnfpb_ic_fcm_buddypressoptions_schedule_now_enable"
                ) &&
                get_option(
                    "pnfpb_ic_fcm_buddypressoptions_schedule_now_enable"
                ) === "1"
            ) {
                $action_scheduler_status = as_schedule_single_action(
                    time(),
                    "PNFPB_httpv1_schedule_push_notification_hook",
                    [
                        0,
                        $notificationtitle,
                        mb_substr(
                            stripslashes(
                                wp_strip_all_tags(trim($activity_content_push))
                            ),
                            0,
                            130,
                            "UTF-8"
                        ),
                        $iconurl,
                        $iconurl,
                        $messageurl,
                        ["click_url" => $messageurl],
                        [],
                        [],
                        $item_id,
                        0,
                        "coverimagechange",
                    ]
                );
            } else {
                $this->PNFPB_icfcm_httpv1_send_push_notification(
                    0,
                    $notificationtitle,
                    mb_substr(
                        stripslashes(
                            wp_strip_all_tags(trim($activity_content_push))
                        ),
                        0,
                        130,
                        "UTF-8"
                    ),
                    $iconurl,
                    $iconurl,
                    $messageurl,
                    ["click_url" => $messageurl],
                    [],
                    [],
                    $item_id,
                    0,
                    "coverimagechange"
                );
            }
        }

        do_action("PNFPB_connect_to_external_api_for_cover_image_change");
    }
}

?>
