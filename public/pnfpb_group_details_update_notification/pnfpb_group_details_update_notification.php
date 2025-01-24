<?php

/*
 *
 *
 * Push Notification when Group details updated
 *
 * @since 1.58
 */
global $wpdb;

// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

$apiaccesskey = get_option("pnfpb_ic_fcm_google_api");

$imageurl = "";

$deviceids = [];

$deviceidswebview = [];

$deviceids_webview_count = 0;

$group_name = bp_get_group_name(groups_get_group($group_id));

if (function_exists("bp_get_group_url")) {
    $group_link = bp_get_group_url(groups_get_group($group_id));
} else {
    $group_link = bp_get_group_permalink(groups_get_group($group_id));
}

$group_image = bp_get_group_avatar_url(groups_get_group($group_id));

if (
    (get_option("pnfpb_ic_fcm_group_details_updated_enable") == 1 &&
        get_option("pnfpb_progressier_push") !== "1" &&
        ($apiaccesskey != "" && $apiaccesskey != false)) ||
    (get_option("pnfpb_ic_fcm_group_details_updated_enable") == 1 &&
        (get_option("pnfpb_onesignal_push") === "1" ||
            get_option("pnfpb_httpv1_push") === "1"))
) {
    $bpgroup = "";

    $bpgroupid = null;

    if ($group_id) {
        $bpgroupid = $group_id;
    }

    $blog_title = get_bloginfo("name");

    if (
        get_option(
            "pnfpb_ic_fcm_buddypress_group_details_updated_text_enable"
        ) != false &&
        get_option(
            "pnfpb_ic_fcm_buddypress_group_details_updated_text_enable"
        ) != ""
    ) {
        $grouptitle = get_option(
            "pnfpb_ic_fcm_buddypress_group_details_updated_text_enable"
        );
    } else {
        $grouptitle =
            esc_html(
                __("Group update ", "push-notification-for-post-and-buddypress")
            ) . $group_name;
    }

    $grouptitle = str_replace("[group name]", $group_name, $grouptitle);

    if (
        get_option(
            "pnfpb_ic_fcm_buddypress_group_details_updated_content_enable"
        ) != false &&
        get_option(
            "pnfpb_ic_fcm_buddypress_group_details_updated_content_enable"
        ) != ""
    ) {
        $localactivitycontent = get_option(
            "pnfpb_ic_fcm_buddypress_group_details_updated_content_enable"
        );
    } else {
        $localactivitycontent =
            $group_name .
            esc_html(
                __(
                    " group details updated",
                    "push-notification-for-post-and-buddypress"
                )
            );
    }

    $localactivitycontent = str_replace(
        "[group name]",
        $group_name,
        $localactivitycontent
    );

    if (get_option("pnfpb_onesignal_push") === "1") {
        $target_userid_array = [];

        if (
            (get_option("pnfpb_ic_fcm_loggedin_notify") &&
                get_option("pnfpb_ic_fcm_loggedin_notify") === "1") ||
            get_option("pnfpb_ic_fcm_frontend_enable_subscription") === "1"
        ) {
            $target_userid_array_values = $wpdb->get_col(
                $wpdb->prepare(
                    "SELECT userid FROM %i WHERE device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
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
                    $group_id,
                    $grouptitle,
                    $localactivitycontent,
                    $group_link,
                    $group_image,
                    $target_userid_array,
                ]
            );
        } else {
            $response = $this->PNFPB_icfcm_onesignal_push_notification(
                $group_id,
                $grouptitle,
                $localactivitycontent,
                $group_link,
                $group_image,
                $target_userid_array
            );
        }
    } else {
        $url = "https://fcm.googleapis.com/fcm/send";

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
                        $grouptitle,
                        stripslashes(wp_strip_all_tags($localactivitycontent)),
                        $group_image,
                        $group_image,
                        $group_link,
                        ["click_url" => $group_link],
                        [],
                        [],
                        $group_id,
                        0,
                        "groupdetailsupdate",
                    ]
                );
            } else {
                $this->PNFPB_icfcm_httpv1_send_push_notification(
                    0,
                    $grouptitle,
                    stripslashes(wp_strip_all_tags($localactivitycontent)),
                    $group_image,
                    $group_image,
                    $group_link,
                    ["click_url" => $group_link],
                    [],
                    [],
                    $group_id,
                    0,
                    "groupdetailsupdate"
                );
            }
        }
        do_action(
            "PNFPB_connect_to_external_api_for_group_details_updated_notification"
        );
    }
}

?>
