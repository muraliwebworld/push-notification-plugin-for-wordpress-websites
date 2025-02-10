<?php
/*
Plugin Name: Push Notification for Post and BuddyPress
Plugin URI: https://www.muraliwebworld.com/groups/wordpress-plugins-by-muralidharan-indiacitys-com-technologies/forum/topic/push-notification-for-post-and-buddypress/
Description: Push notification for Post,custom post,BuddyPress,Woocommerce,Android/IOS mobile apps. Configure push notification settings in <a href="admin.php?page=pnfpb-icfcm-slug"><strong>settings page</strong></a>
Version: 2.11
Author: Muralidharan Ramasamy
Author URI: https://www.muraliwebworld.com
Text Domain: push-notification-for-post-and-buddypress
Requires at least: 6.2
Updated: 8 February 2025
*/
/**
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Copyright (c) <2024> <Muralidharan Ramasamy>
 *
 *
 * @author    Murali
 * @copyright 2024 Indiacitys.com Technologies private limited, Coimbatore, India
 * @license   GPLv2 or later
 *
 */

/***********/

if (!defined("ABSPATH")) {
    exit();
}

if (!defined("PNFPB_VERSION_CURRENT")) {
    define("PNFPB_VERSION_CURRENT", "1");
}
if (!defined("PNFPB_URL")) {
    define("PNFPB_URL", plugin_dir_url(__FILE__));
}
if (!defined("PNFPB_PLUGIN_DIR")) {
    define("PNFPB_PLUGIN_DIR", plugin_dir_path(__FILE__));
}
if (!defined("PNFPB_PLUGIN_NM")) {
    define(
        "PNFPB_PLUGIN_NM",
        esc_html(
            __(
                "Push Notification PNFPB",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER")) {
    define(
        "PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER",
        esc_html(
            __("Device tokens", "push-notification-for-post-and-buddypress")
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_SETTINGS")) {
    define(
        "PNFPB_PLUGIN_NM_SETTINGS",
        esc_html(
            __(
                "PNFPB - Settings for Push Notification",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_DEVICE_TOKENS")) {
    define(
        "PNFPB_PLUGIN_NM_DEVICE_TOKENS",
        esc_html(
            __(
                "PNFPB - Device tokens",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_DEVICE_TOKENS_LIST_HEADER")) {
    define(
        "PNFPB_PLUGIN_NM_DEVICE_TOKENS_LIST_HEADER",
        esc_html(
            __(
                "List of device tokens registered for push notification",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_DEVICE_TOKENS_LIST_DETAILS")) {
    define(
        "PNFPB_PLUGIN_NM_DEVICE_TOKENS_LIST_DETAILS",
        esc_html(
            __(
                "(Do not delete tokens unneccessarily it will result in user will not receive push notification, unless it is needed, avoid deleting tokens )",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_PWA_HEADER")) {
    define(
        "PNFPB_PLUGIN_NM_PWA_HEADER",
        esc_html(__("PWA/app", "push-notification-for-post-and-buddypress"))
    );
}
if (!defined("PNFPB_PLUGIN_NM_PWA_SETTINGS")) {
    define(
        "PNFPB_PLUGIN_NM_PWA_SETTINGS",
        esc_html(
            __(
                "PWA Progressive web app settings",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_PWA_SETTINGS")) {
    define(
        "PNFPB_PLUGIN_PWA_SETTINGS",
        esc_html(
            __(
                "Below settings are to generate Progressive Web App(PWA) with offline facility",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_PWA_SETTINGS_DESCRIPTION")) {
    define(
        "PNFPB_PLUGIN_PWA_SETTINGS_DESCRIPTION",
        esc_html(
            __(
                "All below fields are required to generate Progressive Web App (PWA). Additionally, Enable/disable PWA app by selecting appropriate check box and Enter appropriate URLs to store in cache for offline PWA app, selected pages can be viewed in offline without internet. In offline mode, if page is not available/stored in cache then 404 offline page will be displayed",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_ENABLE_PUSH")) {
    define(
        "PNFPB_PLUGIN_ENABLE_PUSH",
        esc_html(
            __(
                "Enable/Disable push notifications for following types",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_SCHEDULE_PUSH")) {
    define(
        "PNFPB_PLUGIN_SCHEDULE_PUSH",
        esc_html(
            __(
                "If schedule is enabled then push notification will be sent as per selected schedule otherwise it will be sent whenever new item is posted.<br/>BuddyPress notifications will work only when BuddyPress plugin is installed and active.<br/><b>If you have more than 1000 subscribers, enable schedule in background mode(asynchronous).<br/>Refer scheduled action tab for background scheduled jobs</b><br/>",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_FIREBASE_SETTINGS")) {
    define(
        "PNFPB_PLUGIN_FIREBASE_SETTINGS",
        esc_html(
            __(
                "Firebase configuration",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_ONDEMANDPUSH_HEADER")) {
    define(
        "PNFPB_PLUGIN_NM_ONDEMANDPUSH_HEADER",
        esc_html(
            __(
                "On demand push notification",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_BUTTON_HEADER")) {
    define(
        "PNFPB_PLUGIN_NM_BUTTON_HEADER",
        esc_html(
            __("Customize buttons", "push-notification-for-post-and-buddypress")
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_FRONTEND_SETTINGS_HEADER")) {
    define(
        "PNFPB_PLUGIN_NM_FRONTEND_SETTINGS_HEADER",
        esc_html(
            __(
                "Frontend subscription",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_ONDEMANDPUSH_SETTINGS")) {
    define(
        "PNFPB_PLUGIN_NM_ONDEMANDPUSH_SETTINGS",
        esc_html(
            __(
                "On demand or one time push notification",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_API_MOBILE_APP_HEADER")) {
    define(
        "PNFPB_PLUGIN_API_MOBILE_APP_HEADER",
        esc_html(
            __(
                " API to integrate mobile app",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_ONDEMANDPUSH_DETAIL")) {
    define(
        "PNFPB_PLUGIN_NM_ONDEMANDPUSH_DETAIL",
        esc_html(
            __(
                "To send on demand or one time push notification to all subscribers with image",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_NGINX_HEADER")) {
    define(
        "PNFPB_PLUGIN_NGINX_HEADER",
        esc_html(__("for NGINX", "push-notification-for-post-and-buddypress"))
    );
}
if (!defined("PNFPB_PLUGIN_NGINX_SETTINGS")) {
    define(
        "PNFPB_PLUGIN_NGINX_SETTINGS",
        esc_html(
            __(
                "Settings for NGINX based server/hosting",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_SCHEDULE_ACTIONS")) {
    define(
        "PNFPB_PLUGIN_SCHEDULE_ACTIONS",
        esc_html(
            __("Scheduled actions", "push-notification-for-post-and-buddypress")
        )
    );
}
if (!defined("PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION")) {
    define(
        "PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION",
        esc_html(
            __(
                "if server/hosting is based on NGINX and if it is not able to serve dynamic service worker push notification js file(like for example: https:/<yourdomain>/pnfpb_icpush_pwa_sw.js), PWA manifest json file (like for example: https:/<yourdomain>/pnfpb_icpush_pwa_sw.js) from APACHE then enable this option to create static service worker js file for push notification and PWA manifest json files in your website root folder. If this option is enabled it will automatically create push notification service worker file which is used for push notification and PWA manifest json file (pnfpbmanifest.json) in root folder",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION2")) {
    define(
        "PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION2",
        esc_html(
            __(
                "Enable this option only when push notification dynamic service worker file(like for example: https:/<yourdomain>/pnfpb_icpush_pwa_sw.js) not created for SERVER BASED ON NGINX. If this option is enabled it will automatically create push notification service worker file (pnfpb_icpush_pwa_sw.js) which is used for push notification and PWA manifest json file (pnfpbmanifest.json) in root folder",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_DISABLE_SW_SETTINGS_DESCRIPTION")) {
    define(
        "PNFPB_PLUGIN_DISABLE_SW_SETTINGS_DESCRIPTION",
        esc_html(
            __(
                "Disable push notification service worker file and PWA",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_DISABLE_SW_SETTINGS_DESCRIPTION2")) {
    define(
        "PNFPB_PLUGIN_DISABLE_SW_SETTINGS_DESCRIPTION2",
        esc_html(
            __(
                "This option will disable service worker file, it will switch off push notification service as well as it will switch off PWA. Use this option only, if you want to use this plugin for push notification services via REST API (example: for mobile app using WebView) ",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_DISABLE_SW_SETTINGS_DESCRIPTION3")) {
    define(
        "PNFPB_PLUGIN_DISABLE_SW_SETTINGS_DESCRIPTION3",
        esc_html(
            __(
                "Currently, Service worker file is disabled/not created. if you need push notification and PWA in website, please enable service worker file using below option",
                "push-notification-for-post-and-buddypress"
            )
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_ACTION_SCHEDULER")) {
    define(
        "PNFPB_PLUGIN_NM_ACTION_SCHEDULER",
        esc_html(
            __("Action Scheduler", "push-notification-for-post-and-buddypress")
        )
    );
}
define("PNFPB_PLUGIN_DIR_PATH", plugin_dir_url(__FILE__));

/**
 * Class to load required functions for push notification
 *
 * @since 1.0.0
 *
 */
require __DIR__ . "/vendor/autoload.php";

use Firebase\Auth\Token\Exception\InvalidToken;

// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

if (!class_exists("PNFPB_ICFM_Push_Notification_Post_BuddyPress")) {
    class PNFPB_ICFM_Push_Notification_Post_BuddyPress
    {
        public $pre_name = "PNFPB_";

        public $devicetokens_obj;

        public $pushnotifications_obj;

        public Messaging $messaging;

        public $_pnfpb_admin_message;

        public function __construct()
        {
            add_filter(
                "set-screen-option",
                [__CLASS__, "PNFPB_set_screen"],
                10,
                3
            );

            // Installation and uninstallation hooks
            register_activation_hook(__FILE__, [
                $this,
                $this->pre_name . "activate",
            ]);

            register_deactivation_hook(__FILE__, [
                $this,
                $this->pre_name . "deactivate",
            ]);

            add_action("init", [$this, $this->pre_name . "load_text_domain"]);

            add_action("admin_init", [
                $this,
                $this->pre_name . "load_text_domain",
            ]);

            add_action(
                "plugins_loaded",
                [$this, $this->pre_name . "load_action_scheduler"],
                -10
            );

            // Add a link to the plugin's settings and/or network admin settings in the plugins list table.
            add_filter(
                "plugin_action_links",
                [$this, $this->pre_name . "add_settings_link"],
                10,
                2
            );

            add_filter(
                "network_admin_plugin_action_links",
                [$this, $this->pre_name . "add_settings_link"],
                10,
                2
            );

            add_filter(
                "action_scheduler_pastdue_actions_check_pre",
                "__return_false"
            );

            //Scheduled one time push notification routine
            add_action(
                "PNFPB_ondemand_schedule_push_notification_hook",
                [
                    $this,
                    $this->pre_name . "ondemand_schedule_push_notification",
                ],
                10,
                6
            );

            //Scheduled httpv1 push notification routine
            add_action(
                "PNFPB_httpv1_schedule_push_notification_hook",
                [
                    $this,
                    $this->pre_name . "icfcm_httpv1_send_push_notification",
                ],
                10,
                14
            );

            //Scheduled httpv1 push notification routine
            add_action(
                "PNFPB_onesignal_schedule_push_notification_hook",
                [$this, $this->pre_name . "icfcm_onesignal_push_notification"],
                10,
                7
            );

            //Scheduled httpv1 push notification routine
            add_action(
                "PNFPB_progressier_schedule_push_notification_hook",
                [
                    $this,
                    $this->pre_name .
                    "icfcm_progressier_send_push_notification",
                ],
                10,
                8
            );

            //Scheduled httpv1 push notification routine
            add_action(
                "PNFPB_webtoapp_schedule_push_notification_hook",
                [
                    $this,
                    $this->pre_name . "icfcm_webtoapp_send_push_notification",
                ],
                10,
                8
            );

            //Enqueue needed scripts for frontend and for admin area
            add_action(
                "login_enqueue_scripts",
                [$this, $this->pre_name . "ic_push_notification_scripts"],
                20
            );
            add_action(
                "wp_enqueue_scripts",
                [$this, $this->pre_name . "ic_push_notification_scripts"],
                20
            );
            add_action(
                "wp_enqueue_scripts",
                [$this, $this->pre_name . "load_translation_scripts"],
                100
            );
            add_action(
                "admin_enqueue_scripts",
                [$this, $this->pre_name . "ic_admin_push_notification_scripts"],
                20
            );

            add_action("wp_ajax_icpushcallback", [
                $this,
                $this->pre_name . "icpushcallback_callback",
            ]);
            add_action("wp_ajax_nopriv_icpushcallback", [
                $this,
                $this->pre_name . "icpushcallback_callback",
            ]);

            add_action("wp_ajax_icpushadmincallback", [
                $this,
                $this->pre_name . "icpushadmincallback_callback",
            ]);
            add_action("wp_ajax_nopriv_icpushadmincallback", [
                $this,
                $this->pre_name . "icpushadmincallback_callback",
            ]);

            add_action("wp_ajax_unsubscribepush", [
                $this,
                $this->pre_name . "unsubscribe_push_callback",
            ]);
            add_action("wp_ajax_nopriv_unsubscribepush", [
                $this,
                $this->pre_name . "unsubscribe_push_callback",
            ]);

            //Plugin settings in admin area
            add_action(
                "admin_menu",
                [$this, $this->pre_name . "setup_admin_menu"],
                1
            );
            add_action("admin_init", [$this, $this->pre_name . "settings"]);
            add_action("admin_init", [
                $this,
                $this->pre_name . "ic_push_upload_icon_script",
            ]);

            add_action("admin_init", [
                $this,
                $this->pre_name . "send_push_post_options",
            ]);

            //create service worker file which is needed for push notification using FCM
            add_action("init", [
                $this,
                $this->pre_name . "icpush_sw_file_create",
            ]);

            //add manifest link for PWA app
            add_action(
                "wp_head",
                [$this, $this->pre_name . "include_manifest_link"],
                6
            );
            add_action(
                "login_head",
                [$this, $this->pre_name . "include_manifest_link"],
                6
            );

            //add custom pwa install prompt
            add_action(
                "wp_footer",
                [$this, $this->pre_name . "custom_pwa_install_prompt"],
                6
            );
            add_action(
                "login_footer",
                [$this, $this->pre_name . "custom_pwa_install_prompt"],
                6
            );

            //Push notification(if enabled) for post and custom post types based on plugin settings
            add_action(
                "transition_post_status",
                [$this, $this->pre_name . "on_post_save_web"],
                10,
                3
            );

            // Scheduled push notification(if enabled) for post and custom post types
            add_action($this->pre_name . "cron_post_hook", [
                $this,
                $this->pre_name . "icforum_push_notifications_post_web",
            ]);

            //Push notification for comments posted on post.
            add_action(
                "comment_post",
                [
                    $this,
                    $this->pre_name .
                    "icforum_push_notifications_post_comment_web",
                ],
                10,
                3
            );

            // Scheduled push notification(if enabled) for new comments in Buddypress Activities
            add_action($this->pre_name . "cron_comments_post_hook", [
                $this,
                $this->pre_name . "icforum_push_notifications_post_comment_web",
            ]);

            add_action("rest_api_init", [
                $this,
                $this->pre_name . "rest_api_subscription_tokens_from_app",
            ]);

            if (function_exists("bp_is_active")) {
                //Push notification(if enabled) for BuddyPress new acitivities based on plugin settings
                add_action(
                    "bp_activity_posted_update",
                    [$this, $this->pre_name . "icforum_push_notifications_web"],
                    5,
                    3
                );

                // Scheduled push notification(if enabled) for new buddypress activities
                add_action($this->pre_name . "cron_buddypressactivities_hook", [
                    $this,
                    $this->pre_name . "icforum_push_notifications_web",
                ]);

                //Push notification(if enabled) for BuddyPress new acitivities under group based on plugin settings
                add_action(
                    "bp_groups_posted_update",
                    [
                        $this,
                        $this->pre_name .
                        "icforum_push_notifications_web_group",
                    ],
                    1,
                    4
                );

                // Scheduled push notification(if enabled) for new group activities
                add_action(
                    $this->pre_name . "cron_buddypressgroupactivities_hook",
                    [
                        $this,
                        $this->pre_name .
                        "icforum_push_notifications_web_group",
                    ]
                );

                //Push notification(if enabled) for BuddyPress Private messages. It will Send notifications only to userid.
                add_action(
                    "messages_message_sent",
                    [
                        $this,
                        $this->pre_name .
                        "icforum_push_notifications_private_messages",
                    ],
                    10
                );

                if (class_exists("Better_Messages")) {
                    //It is for BP Better messages plugin - Push notification for BuddyPress Private messages. It will Send notifications only to userid.
                    add_action(
                        "better_messages_message_sent",
                        [
                            $this,
                            $this->pre_name .
                            "icforum_push_notifications_private_messages",
                        ],
                        10
                    );
                }

                //Push notification(if enabled) for BuddyPress Private messages. It will Send notifications only to userid.
                add_action(
                    "bp_core_activated_user",
                    [
                        $this,
                        $this->pre_name .
                        "icforum_push_notifications_new_member",
                    ],
                    10,
                    3
                );

                //Push notification(if enabled) for BuddyPress Private messages. It will Send notifications only to userid.
                add_action(
                    "friends_friendship_requested",
                    [
                        $this,
                        $this->pre_name .
                        "icforum_push_notifications_friendship_request",
                    ],
                    10,
                    3
                );

                //Push notification(if enabled) for BuddyPress Private messages. It will Send notifications only to userid.
                add_action(
                    "friends_friendship_accepted",
                    [
                        $this,
                        $this->pre_name .
                        "icforum_push_notifications_friendship_accepted",
                    ],
                    10,
                    3
                );

                //Push notification(if enabled) for BuddyPress Private messages. It will Send notifications only to userid.
                add_action(
                    "bp_members_avatar_uploaded",
                    [
                        $this,
                        $this->pre_name .
                        "icforum_push_notifications_avatar_change",
                    ],
                    10,
                    3
                );

                //Push notification(if enabled) for BuddyPress Private messages. It will Send notifications only to userid.
                add_action(
                    "members_cover_image_uploaded",
                    [
                        $this,
                        $this->pre_name .
                        "icforum_push_notifications_cover_image_change",
                    ],
                    10,
                    3
                );

                //Push notification(if enabled) for new comments posted on BuddyPress acitivities based on plugin settings
                add_action(
                    "bp_activity_comment_posted",
                    [
                        $this,
                        $this->pre_name .
                        "icforum_push_notifications_comment_web",
                    ],
                    5,
                    3
                );

                // Scheduled push notification(if enabled) for new comments in Buddypress Activities
                add_action($this->pre_name . "cron_buddypresscomments_hook", [
                    $this,
                    $this->pre_name . "icforum_push_notifications_comment_web",
                ]);

                if (
                    function_exists("buddyboss_platform_plugin_update_notice")
                ) {
                    add_filter(
                        "bp_get_group_join_button",
                        [$this, $this->pre_name . "subscribe_to_group_button"],
                        101,
                        1
                    );
                } else {
                    add_action(
                        "bp_group_header_actions",
                        [$this, $this->pre_name . "subscribe_to_group_button"],
                        1
                    );
                    add_action(
                        "bp_directory_groups_actions",
                        [$this, $this->pre_name . "subscribe_to_group_button"],
                        1
                    );
                }

                //add_action ( 'bp_directory_groups_actions' , array($this,  $this->pre_name .'subscribe_to_group_button'), 1);

                add_action("bp_setup_nav", [
                    $this,
                    $this->pre_name .
                    "buddypress_setup_notification_settings_nav",
                ]);

                //add_action( 'groups_invite_user', array( $this, $this->pre_name .'buddypress_group_invitation_notification' ) );

                add_action(
                    "groups_send_invites",
                    [
                        $this,
                        $this->pre_name .
                        "buddypress_group_invitation_notification",
                    ],
                    5,
                    3
                );

                add_action("groups_group_details_edited", [
                    $this,
                    $this->pre_name .
                    "buddypress_group_details_updated_notification",
                ]);
            }

            //Shortcode to unsubscribe push notification
            add_shortcode("subscribe_PNFPB_push_notification", [
                $this,
                $this->pre_name . "subscribe_push_notification_shortcode",
            ]);

            //Shortcode for PWA
            add_shortcode("PNFPB_PWA_PROMPT", [
                $this,
                $this->pre_name . "pwa_prompt_shortcode",
            ]);

            //admin notices to show settings menu moved to top level menu
            add_action("admin_notices", [
                $this,
                $this->pre_name . "wpb_admin_notice_warn",
            ]);

            //admin bar menu
            add_action(
                "admin_bar_menu",
                [$this, $this->pre_name . "ic_fcm_admin_bar_menu_register"],
                999
            );

            //Push notification to admin id, when new user registers
            add_action("user_register", [
                $this,
                $this->pre_name . "new_user_registrations",
            ]);

            //Push notification to admin id, when contact form7 submitted
            add_action(
                "wpcf7_before_send_mail",
                [$this, $this->pre_name . "contact_form7_send_mail"],
                15,
                3
            );
        }

        /**
         *
         * @since 1.65
         *
         */
        public function PNFPB_cc_mime_types($mimes)
        {
            $mimes["json"] = "application/json";
            $mimes["svg"] = "image/svg+xml";
            return $mimes;
        }

        /**
         *@since 1.58
         *
         */

        public function PNFPB_wpb_admin_notice_warn()
        {
            if (get_option("PNFBP_admin_notice") != "notalive") {
                echo '<div class="pnfpb_admin_notice notice notice-info is-dismissible">
      <p>Important: PNFPB plugin settings are now in top level admin menu. It is in left sidebar of admin menu below settings menu. <a href="' .
                    esc_url(admin_url("admin.php?page=pnfpb-icfcm-slug")) .
                    '">Click here to go to plugin settings.</a></p></div>';
            }

            if (
                (!get_option("pnfpb_sa_json_data") ||
                    get_option("pnfpb_sa_json_data") === "" ||
                    get_option("pnfpb_httpv1_push") !== "1") &&
                get_option("pnfpb_onesignal_push") !== "1" &&
                get_option("pnfpb_progressier_push") !== "1" &&
                get_option("pnfpb_webtoapp_push") !== "1"
            ) {
                echo '<div class="pnfpb_admin_notice notice notice-error is-dismissible">
      <p>Important: Please enable http v1 option ON by uploading service account JSON credentials file to enable Firebase Push notification</p></div>';
            }
        }

        /**
         * Load Action scheduler if action_scheduler plugin not active/class not present
         * Alter push notification table to add new column subscription_option (if not exists)
         * @since 1.50.0
         **/
        public function PNFPB_load_action_scheduler()
        {
            if (
                !function_exists("action_scheduler_register_3_dot_5_dot_3") &&
                function_exists("add_action")
            ) {
                require_once plugin_dir_path(__FILE__) .
                    "/libraries/action-scheduler/action-scheduler.php";
            }
        }

        /**
         * Create table (if not exists) to store subscribed device ids for push notification
         *
         * @since 1.0.0
         */
        public function PNFPB_activate()
        {
            global $wpdb;

            $table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE {$table_name} (
                    id bigint(20) NOT NULL AUTO_INCREMENT,
                    userid bigint(20) NOT NULL,
                    device_id varchar(300) NOT NULL,
					subscription_option VARCHAR(50) NULL,
					ip_address VARCHAR(100) NULL DEFAULT NULL,
					web_auth VARCHAR(600) NULL DEFAULT NULL,
					web_256 VARCHAR(600) NULL DEFAULT NULL,
					firebase_version VARCHAR(100) DEFAULT 'L',
                    PRIMARY KEY (id)
                ) {$charset_collate};";

            require_once ABSPATH . "wp-admin/includes/upgrade.php";

            dbDelta($sql);

            $table_name_2 =
                $wpdb->prefix . "pnfpb_ic_schedule_push_notifications";

            $charset_collate_2 = $wpdb->get_charset_collate();

            $sql_2 = "CREATE TABLE {$table_name_2} (
                    id bigint(20) NOT NULL AUTO_INCREMENT,
                    userid bigint(20) NOT NULL,
					action_scheduler_id bigint(20) NULL DEFAULT NULL,
                    title varchar(300) NULL  DEFAULT NULL,
					content VARCHAR(300) NULL  DEFAULT NULL,
					image_url VARCHAR(300) NULL DEFAULT NULL,
					click_url VARCHAR(300) NULL DEFAULT NULL,
					scheduled_timestamp bigint(20) NULL DEFAULT NULL,
					scheduled_type varchar(100) NULL  DEFAULT NULL,
					recurring_day_number varchar(100) NULL  DEFAULT NULL,
					recurring_month_number varchar(100) NULL  DEFAULT NULL,
					recurring_day_name varchar(100) NULL  DEFAULT NULL,
					status varchar(300) NULL  DEFAULT NULL,
					firebase_version VARCHAR(100) DEFAULT 'L',
                    PRIMARY KEY (id)
                ) {$charset_collate_2};";

            require_once ABSPATH . "wp-admin/includes/upgrade.php";

            dbDelta($sql_2);

            if (
                !function_exists("action_scheduler_register_3_dot_5_dot_3") &&
                function_exists("add_action")
            ) {
                require_once plugin_dir_path(__FILE__) .
                    "/libraries/action-scheduler/action-scheduler.php";
            }

            if (
                get_option("pnfpb_ic_fcm_post_schedule_enable") &&
                get_option("pnfpb_ic_fcm_post_schedule_enable") == 1
            ) {
                if (!wp_next_scheduled("PNFPB_cron_post_hook")) {
                    if (
                        get_option("pnfpb_ic_fcm_post_timeschedule_enable") ===
                        "hourly"
                    ) {
                        $new_time = strtotime(
                            gmdate(
                                "Y-m-d H:i:s",
                                strtotime("+1 hours", strtotime("now"))
                            )
                        );
                    }
                    if (
                        get_option("pnfpb_ic_fcm_post_timeschedule_enable") ===
                        "twicedaily"
                    ) {
                        $new_time = strtotime(
                            gmdate(
                                "Y-m-d H:i:s",
                                strtotime("+12 hours", strtotime("now"))
                            )
                        );
                    }
                    if (
                        get_option("pnfpb_ic_fcm_post_timeschedule_enable") ===
                        "daily"
                    ) {
                        $new_time = strtotime(
                            gmdate(
                                "Y-m-d H:i:s",
                                strtotime("+24 hours", strtotime("now"))
                            )
                        );
                    }
                    if (
                        get_option("pnfpb_ic_fcm_post_timeschedule_enable") ===
                        "weekly"
                    ) {
                        $new_time = strtotime(
                            gmdate(
                                "Y-m-d H:i:s",
                                strtotime("+1 week", strtotime("now"))
                            )
                        );
                    }
                    wp_schedule_event(
                        $new_time,
                        get_option("pnfpb_ic_fcm_post_timeschedule_enable"),
                        "PNFPB_cron_post_hook"
                    );
                }
            }

            if (
                get_option(
                    "pnfpb_ic_fcm_buddypressactivities_schedule_enable"
                ) &&
                get_option(
                    "pnfpb_ic_fcm_buddypressactivities_schedule_enable"
                ) == 1
            ) {
                if (
                    !wp_next_scheduled("PNFPB_cron_buddypressactivities_hook")
                ) {
                    if (
                        get_option(
                            "pnfpb_ic_fcm_buddypressactivities_schedule_enable"
                        ) === "hourly"
                    ) {
                        $new_time = strtotime(
                            gmdate(
                                "Y-m-d H:i:s",
                                strtotime("+1 hours", strtotime("now"))
                            )
                        );
                    }
                    if (
                        get_option(
                            "pnfpb_ic_fcm_buddypressactivities_schedule_enable"
                        ) === "twicedaily"
                    ) {
                        $new_time = strtotime(
                            gmdate(
                                "Y-m-d H:i:s",
                                strtotime("+12 hours", strtotime("now"))
                            )
                        );
                    }
                    if (
                        get_option(
                            "pnfpb_ic_fcm_buddypressactivities_schedule_enable"
                        ) === "daily"
                    ) {
                        $new_time = strtotime(
                            gmdate(
                                "Y-m-d H:i:s",
                                strtotime("+24 hours", strtotime("now"))
                            )
                        );
                    }
                    if (
                        get_option(
                            "pnfpb_ic_fcm_buddypressactivities_schedule_enable"
                        ) === "weekly"
                    ) {
                        $new_time = strtotime(
                            gmdate(
                                "Y-m-d H:i:s",
                                strtotime("+1 week", strtotime("now"))
                            )
                        );
                    }
                    wp_schedule_event(
                        $new_time,
                        get_option(
                            "pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
                        ),
                        "PNFPB_cron_buddypressactivities_hook"
                    );
                }
            }

            if (
                get_option(
                    "pnfpb_ic_fcm_buddypressgroupactivities_timeschedule_enable"
                ) &&
                get_option(
                    "pnfpb_ic_fcm_buddypressgroupactivities_timeschedule_enable"
                ) == 1
            ) {
                if (
                    !wp_next_scheduled(
                        "PNFPB_cron_buddypressgroupactivities_hook"
                    )
                ) {
                    if (
                        get_option(
                            "pnfpb_ic_fcm_buddypressgroupactivities_timeschedule_enable"
                        ) === "hourly"
                    ) {
                        $new_time = strtotime(
                            gmdate(
                                "Y-m-d H:i:s",
                                strtotime("+1 hours", strtotime("now"))
                            )
                        );
                    }
                    if (
                        get_option(
                            "pnfpb_ic_fcm_buddypressgroupactivities_timeschedule_enable"
                        ) === "twicedaily"
                    ) {
                        $new_time = strtotime(
                            gmdate(
                                "Y-m-d H:i:s",
                                strtotime("+12 hours", strtotime("now"))
                            )
                        );
                    }
                    if (
                        get_option(
                            "pnfpb_ic_fcm_buddypressgroupactivities_timeschedule_enable"
                        ) === "daily"
                    ) {
                        $new_time = strtotime(
                            gmdate(
                                "Y-m-d H:i:s",
                                strtotime("+24 hours", strtotime("now"))
                            )
                        );
                    }
                    if (
                        get_option(
                            "pnfpb_ic_fcm_buddypressgroupactivities_timeschedule_enable"
                        ) === "weekly"
                    ) {
                        $new_time = strtotime(
                            gmdate(
                                "Y-m-d H:i:s",
                                strtotime("+1 week", strtotime("now"))
                            )
                        );
                    }
                    wp_schedule_event(
                        $new_time,
                        get_option(
                            "pnfpb_ic_fcm_buddypressgroupactivities_timeschedule_enable"
                        ),
                        "PNFPB_cron_buddypressgroupactivities_hook"
                    );
                }
            }

            if (
                get_option("pnfpb_ic_fcm_buddypresscomments_schedule_enable") &&
                get_option("pnfpb_ic_fcm_buddypresscomments_schedule_enable") ==
                    1
            ) {
                if (
                    get_option(
                        "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                    ) === "hourly"
                ) {
                    $new_time = strtotime(
                        gmdate(
                            "Y-m-d H:i:s",
                            strtotime("+1 hours", strtotime("now"))
                        )
                    );
                }
                if (
                    get_option(
                        "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                    ) === "twicedaily"
                ) {
                    $new_time = strtotime(
                        gmdate(
                            "Y-m-d H:i:s",
                            strtotime("+12 hours", strtotime("now"))
                        )
                    );
                }
                if (
                    get_option(
                        "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                    ) === "daily"
                ) {
                    $new_time = strtotime(
                        gmdate(
                            "Y-m-d H:i:s",
                            strtotime("+24 hours", strtotime("now"))
                        )
                    );
                }
                if (
                    get_option(
                        "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                    ) === "weekly"
                ) {
                    $new_time = strtotime(
                        gmdate(
                            "Y-m-d H:i:s",
                            strtotime("+1 week", strtotime("now"))
                        )
                    );
                }

                if (!wp_next_scheduled("PNFPB_cron_buddypresscomments_hook")) {
                    wp_schedule_event(
                        $new_time,
                        get_option(
                            "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                        ),
                        "PNFPB_cron_buddypresscomments_hook"
                    );
                }

                if (!wp_next_scheduled("PNFPB_cron_comments_post_hook")) {
                    wp_schedule_event(
                        $new_time,
                        get_option(
                            "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                        ),
                        "PNFPB_cron_comments_post_hook"
                    );
                }
            }

            if (
                get_option("pnfpb_ic_fcm_post_schedule_enable") &&
                get_option("pnfpb_ic_fcm_post_schedule_enable") == 1 &&
                get_option("pnfpb_ic_fcm_post_schedule_background_enable") &&
                get_option("pnfpb_ic_fcm_post_schedule_background_enable") ==
                    1 &&
                (get_option("pnfpb_ic_fcm_post_timeschedule_enable") ==
                    "weekly" ||
                    get_option("pnfpb_ic_fcm_post_timeschedule_enable") ==
                        "twicedaily" ||
                    get_option("pnfpb_ic_fcm_post_timeschedule_enable") ==
                        "daily" ||
                    get_option("pnfpb_ic_fcm_post_timeschedule_enable") ==
                        "hourly" ||
                    (get_option("pnfpb_ic_fcm_post_timeschedule_enable") ==
                        "seconds" &&
                        get_option("pnfpb_ic_fcm_post_timeschedule_seconds") >
                            59))
            ) {
                $timeseconds = "3600";
                if (
                    get_option("pnfpb_ic_fcm_post_timeschedule_enable") ===
                    "weekly"
                ) {
                    $timeseconds = "604800";
                }
                if (
                    get_option("pnfpb_ic_fcm_post_timeschedule_enable") ===
                    "twicedaily"
                ) {
                    $timeseconds = "43200";
                }
                if (
                    get_option("pnfpb_ic_fcm_post_timeschedule_enable") ===
                    "daily"
                ) {
                    $timeseconds = "86400";
                }
                if (
                    get_option("pnfpb_ic_fcm_post_timeschedule_enable") ===
                    "hourly"
                ) {
                    $timeseconds = "3600";
                }
                if (
                    get_option("pnfpb_ic_fcm_post_timeschedule_enable") ===
                    "seconds"
                ) {
                    $timeseconds = get_option(
                        "pnfpb_ic_fcm_post_timeschedule_seconds"
                    );
                }

                $new_time = strtotime(
                    gmdate(
                        "Y-m-d H:i:s",
                        strtotime(
                            "+" . $timeseconds . " seconds",
                            strtotime("now")
                        )
                    )
                );

                if (false === as_has_scheduled_action("PNFPB_cron_post_hook")) {
                    as_schedule_recurring_action(
                        $new_time,
                        $timeseconds,
                        "PNFPB_cron_post_hook",
                        [],
                        "pnfpb_post",
                        true
                    );
                } else {
                    as_unschedule_all_actions("PNFPB_cron_post_hook", [], "");
                    as_schedule_recurring_action(
                        $timeseconds,
                        $timeseconds,
                        "PNFPB_cron_post_hook",
                        [],
                        "pnfpb_post",
                        true
                    );
                }
            } else {
                if (as_has_scheduled_action("PNFPB_cron_post_hook")) {
                    as_unschedule_all_actions(
                        "PNFPB_cron_post_hook",
                        [],
                        "pnfpb_post"
                    );
                    delete_option("pnfpb_ic_fcm_new_post_id");
                    delete_option("pnfpb_ic_fcm_new_post_title");
                    delete_option("pnfpb_ic_fcm_new_post_content");
                    delete_option("pnfpb_ic_fcm_new_post_link");
                    delete_option("pnfpb_ic_fcm_new_post_type");
                    delete_option("pnfpb_ic_fcm_new_post_author");
                }
            }

            if (
                get_option(
                    "pnfpb_ic_fcm_buddypressactivities_schedule_enable"
                ) &&
                get_option(
                    "pnfpb_ic_fcm_buddypressactivities_schedule_enable"
                ) == 1 &&
                get_option(
                    "pnfpb_ic_fcm_buddypressactivities_schedule_background_enable"
                ) &&
                get_option(
                    "pnfpb_ic_fcm_buddypressactivities_schedule_background_enable"
                ) == 1 &&
                (get_option(
                    "pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
                ) == "weekly" ||
                    get_option(
                        "pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
                    ) == "twicedaily" ||
                    get_option(
                        "pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
                    ) == "daily" ||
                    get_option(
                        "pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
                    ) == "hourly" ||
                    (get_option(
                        "pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
                    ) == "seconds" &&
                        get_option(
                            "pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds"
                        ) > 59))
            ) {
                $timeseconds = 3600;
                if (
                    get_option(
                        "pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
                    ) == "weekly"
                ) {
                    $timeseconds = 604800;
                }
                if (
                    get_option(
                        "pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
                    ) == "twicedaily"
                ) {
                    $timeseconds = 43200;
                }
                if (
                    get_option(
                        "pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
                    ) == "daily"
                ) {
                    $timeseconds = 86400;
                }
                if (
                    get_option(
                        "pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
                    ) == "hourly"
                ) {
                    $timeseconds = 3600;
                }
                if (
                    get_option(
                        "pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
                    ) == "seconds"
                ) {
                    $timeseconds = get_option(
                        "pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds"
                    );
                }

                $new_time = strtotime(
                    gmdate(
                        "Y-m-d H:i:s",
                        strtotime(
                            "+" . $timeseconds . " seconds",
                            strtotime("now")
                        )
                    )
                );

                if (
                    false ===
                    as_has_scheduled_action(
                        "PNFPB_cron_buddypressactivities_hook"
                    )
                ) {
                    as_schedule_recurring_action(
                        $new_time,
                        $timeseconds,
                        "PNFPB_cron_buddypressactivities_hook",
                        [],
                        "pnfpb_buddypressactivities",
                        true
                    );
                } else {
                    as_unschedule_all_actions(
                        "PNFPB_cron_buddypressactivities_hook",
                        [],
                        ""
                    );
                    delete_option(
                        "pnfpb_ic_fcm_new_buddypressactivities_content"
                    );
                    delete_option(
                        "pnfpb_ic_fcm_new_buddypressactivities_userid"
                    );
                    delete_option("pnfpb_ic_fcm_new_buddypressactivities_link");
                    delete_option(
                        "pnfpb_ic_fcm_new_buddypressactivities_image"
                    );
                    delete_option("pnfpb_ic_fcm_new_buddypressgroup_link");
                    delete_option("pnfpb_ic_fcm_new_buddypressgroup_id");
                    delete_option("pnfpb_ic_fcm_new_buddypressgroup_userid");
                    as_schedule_recurring_action(
                        $timeseconds,
                        $timeseconds,
                        "PNFPB_cron_buddypressactivities_hook",
                        [],
                        "pnfpb_buddypressactivities",
                        true
                    );
                }
            } else {
                if (
                    as_has_scheduled_action(
                        "PNFPB_cron_buddypressactivities_hook"
                    )
                ) {
                    as_unschedule_all_actions(
                        "PNFPB_cron_buddypressactivities_hook",
                        [],
                        "pnfpb_buddypressactivities"
                    );
                    delete_option(
                        "pnfpb_ic_fcm_new_buddypressactivities_content"
                    );
                    delete_option(
                        "pnfpb_ic_fcm_new_buddypressactivities_userid"
                    );
                    delete_option("pnfpb_ic_fcm_new_buddypressactivities_link");
                    delete_option(
                        "pnfpb_ic_fcm_new_buddypressactivities_image"
                    );
                    delete_option("pnfpb_ic_fcm_new_buddypressgroup_link");
                    delete_option("pnfpb_ic_fcm_new_buddypressgroup_id");
                    delete_option("pnfpb_ic_fcm_new_buddypressgroup_userid");
                }
            }

            if (
                get_option("pnfpb_ic_fcm_buddypresscomments_schedule_enable") &&
                get_option("pnfpb_ic_fcm_buddypresscomments_schedule_enable") ==
                    1 &&
                get_option(
                    "pnfpb_ic_fcm_buddypresscomments_schedule_background_enable"
                ) &&
                get_option(
                    "pnfpb_ic_fcm_buddypresscomments_schedule_background_enable"
                ) == 1 &&
                (get_option(
                    "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                ) == "weekly" ||
                    get_option(
                        "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                    ) == "twicedaily" ||
                    get_option(
                        "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                    ) == "daily" ||
                    get_option(
                        "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                    ) == "hourly" ||
                    (get_option(
                        "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                    ) == "seconds" &&
                        get_option(
                            "pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds"
                        ) > 59))
            ) {
                $timeseconds = 3600;
                if (
                    get_option(
                        "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                    ) == "weekly"
                ) {
                    $timeseconds = 604800;
                }
                if (
                    get_option(
                        "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                    ) == "twicedaily"
                ) {
                    $timeseconds = 43200;
                }
                if (
                    get_option(
                        "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                    ) == "daily"
                ) {
                    $timeseconds = 86400;
                }
                if (
                    get_option(
                        "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                    ) == "hourly"
                ) {
                    $timeseconds = 3600;
                }
                if (
                    get_option(
                        "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                    ) == "seconds"
                ) {
                    $timeseconds = get_option(
                        "pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds"
                    );
                }

                $new_time = strtotime(
                    gmdate(
                        "Y-m-d H:i:s",
                        strtotime(
                            "+" . $timeseconds . " seconds",
                            strtotime("now")
                        )
                    )
                );

                if (
                    false ===
                    as_has_scheduled_action("PNFPB_cron_comments_post_hook")
                ) {
                    as_schedule_recurring_action(
                        $new_time,
                        $timeseconds,
                        "PNFPB_cron_comments_post_hook",
                        [],
                        "pnfpb_postcomments",
                        true
                    );
                } else {
                    as_unschedule_all_actions(
                        "PNFPB_cron_comments_post_hook",
                        [],
                        ""
                    );
                    as_schedule_recurring_action(
                        $new_time,
                        $timeseconds,
                        "PNFPB_cron_comments_post_hook",
                        [],
                        "pnfpb_postcomments",
                        true
                    );
                }

                if (
                    false ===
                    as_has_scheduled_action(
                        "PNFPB_cron_buddypresscomments_hook"
                    )
                ) {
                    as_schedule_recurring_action(
                        $new_time,
                        $timeseconds,
                        "PNFPB_cron_buddypresscomments_hook",
                        [],
                        "pnfpb_buddypresscomments",
                        true
                    );
                } else {
                    as_unschedule_all_actions(
                        "PNFPB_cron_buddypresscomments_hook",
                        [],
                        ""
                    );
                    as_schedule_recurring_action(
                        $new_time,
                        $timeseconds,
                        "PNFPB_cron_buddypresscomments_hook",
                        [],
                        "pnfpb_buddypresscomments",
                        true
                    );
                }
            } else {
                if (
                    as_has_scheduled_action(
                        "PNFPB_cron_buddypresscomments_hook"
                    )
                ) {
                    as_unschedule_all_actions(
                        "PNFPB_cron_buddypresscomments_hook",
                        [],
                        "pnfpb_buddypresscomments"
                    );
                    delete_option(
                        "pnfpb_ic_fcm_new_buddypresscomments_content"
                    );
                    delete_option("pnfpb_ic_fcm_new_buddypresscomments_link");
                    delete_option(
                        "pnfpb_ic_fcm_new_buddypresscomments_postuserid"
                    );
                    delete_option(
                        "pnfpb_ic_fcm_new_buddypresscomments_activityuserid"
                    );
                    delete_option(
                        "pnfpb_ic_fcm_new_buddypresscomments_authoractivityuserid"
                    );
                }

                if (as_has_scheduled_action("PNFPB_cron_comments_post_hook")) {
                    as_unschedule_all_actions(
                        "PNFPB_cron_comments_post_hook",
                        [],
                        "pnfpb_postcomments"
                    );
                    delete_option("pnfpb_ic_fcm_new_comment_id");
                    delete_option("pnfpb_ic_fcm_new_comment_approved");
                    delete_option("pnfpb_ic_fcm_new_comments_post_content");
                    delete_option("pnfpb_ic_fcm_new_comments_post_link");
                    delete_option("pnfpb_ic_fcm_new_comments_post_userid");
                    delete_option("pnfpb_ic_fcm_new_comments_post_authorid");
                }
            }
        }

        /**
         * Plugin deactivate routine
         *
         * @since 1.0.0
         */
        public function PNFPB_deactivate()
        {
            if (wp_next_scheduled("PNFPB_cron_post_hook")) {
                $timestamp = wp_next_scheduled("PNFPB_cron_post_hook");
                wp_unschedule_event($timestamp, "PNFPB_cron_post_hook");
                delete_option("pnfpb_ic_fcm_new_post_id");
                delete_option("pnfpb_ic_fcm_new_post_title");
                delete_option("pnfpb_ic_fcm_new_post_content");
                delete_option("pnfpb_ic_fcm_new_post_link");
                delete_option("pnfpb_ic_fcm_new_post_type");
                delete_option("pnfpb_ic_fcm_new_post_author");
            }

            if (wp_next_scheduled("PNFPB_cron_buddypressactivities_hook")) {
                $timestamp = wp_next_scheduled(
                    "PNFPB_cron_buddypressactivities_hook"
                );
                wp_unschedule_event(
                    $timestamp,
                    "PNFPB_cron_buddypressactivities_hook"
                );
                delete_option("pnfpb_ic_fcm_new_buddypressactivities_content");
                delete_option("pnfpb_ic_fcm_new_buddypressactivities_userid");
                delete_option("pnfpb_ic_fcm_new_buddypressactivities_link");
                delete_option("pnfpb_ic_fcm_new_buddypressactivities_image");
            }

            if (
                wp_next_scheduled("PNFPB_cron_buddypressgroupactivities_hook")
            ) {
                $timestamp = wp_next_scheduled(
                    "PNFPB_cron_buddypressgroupactivities_hook"
                );
                wp_unschedule_event(
                    $timestamp,
                    "PNFPB_cron_buddypressgroupactivities_hook"
                );
                delete_option("pnfpb_ic_fcm_new_buddypressactivities_content");
                delete_option("pnfpb_ic_fcm_new_buddypressactivities_userid");
                delete_option("pnfpb_ic_fcm_new_buddypressactivities_link");
                delete_option("pnfpb_ic_fcm_new_buddypressactivities_image");
                delete_option("pnfpb_ic_fcm_new_buddypressgroup_link");
                delete_option("pnfpb_ic_fcm_new_buddypressgroup_id");
                delete_option("pnfpb_ic_fcm_new_buddypressgroup_userid");
            }

            if (wp_next_scheduled("PNFPB_cron_buddypresscomments_hook")) {
                $timestamp = wp_next_scheduled(
                    "PNFPB_cron_buddypresscomments_hook"
                );
                wp_unschedule_event(
                    $timestamp,
                    "PNFPB_cron_buddypresscomments_hook"
                );
                delete_option("pnfpb_ic_fcm_new_buddypresscomments_content");
                delete_option("pnfpb_ic_fcm_new_buddypresscomments_link");
                delete_option("pnfpb_ic_fcm_new_buddypresscomments_postuserid");
                delete_option(
                    "pnfpb_ic_fcm_new_buddypresscomments_activityuserid"
                );
                delete_option(
                    "pnfpb_ic_fcm_new_buddypresscomments_authoractivityuserid"
                );
            }

            if (wp_next_scheduled("PNFPB_cron_comments_post_hook")) {
                $timestamp = wp_next_scheduled("PNFPB_cron_comments_post_hook");
                wp_unschedule_event(
                    $timestamp,
                    "PNFPB_cron_comments_post_hook"
                );
                delete_option("pnfpb_ic_fcm_new_comment_id");
                delete_option("pnfpb_ic_fcm_new_comment_approved");
                delete_option("pnfpb_ic_fcm_new_comments_post_content");
                delete_option("pnfpb_ic_fcm_new_comments_post_link");
                delete_option("pnfpb_ic_fcm_new_comments_post_userid");
                delete_option("pnfpb_ic_fcm_new_comments_post_authorid");
            }

            if (as_has_scheduled_action("PNFPB_cron_post_hook")) {
                as_unschedule_all_actions(
                    "PNFPB_cron_post_hook",
                    [],
                    "pnfpb_post"
                );
                delete_option("pnfpb_ic_fcm_new_post_id");
                delete_option("pnfpb_ic_fcm_new_post_title");
                delete_option("pnfpb_ic_fcm_new_post_content");
                delete_option("pnfpb_ic_fcm_new_post_link");
                delete_option("pnfpb_ic_fcm_new_post_type");
                delete_option("pnfpb_ic_fcm_new_post_author");
            }

            if (
                as_has_scheduled_action("PNFPB_cron_buddypressactivities_hook")
            ) {
                as_unschedule_all_actions(
                    "PNFPB_cron_buddypressactivities_hook",
                    [],
                    "pnfpb_buddypressactivities"
                );
                delete_option("pnfpb_ic_fcm_new_buddypressactivities_content");
                delete_option("pnfpb_ic_fcm_new_buddypressactivities_userid");
                delete_option("pnfpb_ic_fcm_new_buddypressactivities_link");
                delete_option("pnfpb_ic_fcm_new_buddypressactivities_image");
                delete_option("pnfpb_ic_fcm_new_buddypressgroup_link");
                delete_option("pnfpb_ic_fcm_new_buddypressgroup_id");
                delete_option("pnfpb_ic_fcm_new_buddypressgroup_userid");
            }

            if (as_has_scheduled_action("PNFPB_cron_comments_post_hook")) {
                as_unschedule_all_actions(
                    "PNFPB_cron_comments_post_hook",
                    [],
                    "pnfpb_buddypresscomments"
                );
                delete_option("pnfpb_ic_fcm_new_comment_id");
                delete_option("pnfpb_ic_fcm_new_comment_approved");
                delete_option("pnfpb_ic_fcm_new_comments_post_content");
                delete_option("pnfpb_ic_fcm_new_comments_post_link");
                delete_option("pnfpb_ic_fcm_new_comments_post_userid");
                delete_option("pnfpb_ic_fcm_new_comments_post_authorid");
            }
        }

        /**
         * Add a link to the settings on the Plugins screen.
         *
         * @since 1.0.0
         */
        public function PNFPB_add_settings_link($links, $file)
        {
            if (
                $file ===
                    "push-notification-for-post-and-buddypress/pnfpb_push_notification.php" &&
                current_user_can("manage_options")
            ) {
                if (current_filter() === "plugin_action_links") {
                    $url = admin_url("admin.php?page=pnfpb-icfcm-slug");
                } else {
                    $url = admin_url(
                        "/network/settings.php?page=pnfpb-icfcm-slug"
                    );
                }

                // Prevent warnings in PHP 7.0+ when a plugin uses this filter incorrectly.
                $links = (array) $links;
                $links[] = sprintf(
                    '<a href="%s">%s</a>',
                    $url,
                    __("Settings", "push-notification-for-post-and-buddypress")
                );
            }

            return $links;
        }

        /**
         * Enqueue and localize scripts needed for push notification using FCM
         *
         * @since 1.0.0
         */
        public function PNFPB_ic_admin_push_notification_scripts()
        {
            wp_enqueue_script("jquery");
            wp_enqueue_script("jquery-ui-dialog");
            wp_enqueue_style("wp-jquery-ui-dialog");

            wp_enqueue_style(
                "pnfpb-admin-icpstyle-name",
                plugin_dir_url(__FILE__) . "admin/css/pnfpb_admin.css",
                [],
                "2.07.11"
            );
            wp_enqueue_style(
                "pnfpb-admin-pwa-icpstyle-name",
                plugin_dir_url(__FILE__) . "admin/css/pnfpb_pwa_admin.css",
                [],
                "2.07.11"
            );

            $pnfpb_progressier_app_option = "";

            if (
                get_option("pnfpb_ic_thirdparty_pwa_app_enable") === "1" &&
                get_option(
                    "pnfpb_ic_disable_serviceworker_pwa_pushnotification"
                ) != "1" &&
                get_option("pnfpb_ic_pwa_thirdparty_app_id") &&
                get_option("pnfpb_ic_pwa_thirdparty_app_id") != ""
            ) {
                wp_enqueue_script(
                    "progressier_pwa_app",
                    "https://progressier.app/" .
                        get_option("pnfpb_ic_pwa_thirdparty_app_id") .
                        "/script.js",
                    [],
                    "1.0.1",
                    true
                );

                $pnfpb_progressier_app_option = get_option(
                    "pnfpb_ic_thirdparty_pwa_app_enable"
                );
            }

            if (
                get_option("pnfpb_onesignal_push") !== "1" &&
                get_option("pnfpb_progressier_push") !== "1"
            ) {
                $apiKey = get_option("pnfpb_ic_fcm_api");
                $authDomain = get_option("pnfpb_ic_fcm_authdomain");
                $databaseURL = get_option("pnfpb_ic_fcm_databaseurl");
                $projectId = get_option("pnfpb_ic_fcm_projectid");
                $storageBucket = get_option("pnfpb_ic_fcm_storagebucket");
                $messagingSenderId = get_option(
                    "pnfpb_ic_fcm_messagingsenderid"
                );
                $appId = get_option("pnfpb_ic_fcm_appid");
                $publicKey = get_option("pnfpb_ic_fcm_publickey");
                $homeurl = get_home_url();
                $pwaappenable = get_option("pnfpb_ic_pwa_app_enable");
                $pwainstallbuttontext = get_option(
                    "pnfpb_ic_pwa_prompt_install_button_text"
                );
                if ($pwainstallbuttontext === "") {
                    $pwainstallbuttontext = esc_html(
                        __(
                            "Install PWA app",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }
                $pwainstallheadertext = get_option(
                    "pnfpb_ic_pwa_prompt_header_text"
                );
                if ($pwainstallheadertext === "") {
                    $pwainstallheadertext = esc_html(
                        __(
                            "Install our PWA app",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }
                $pwainstalltext = get_option("pnfpb_ic_pwa_prompt_description");
                if ($pwainstalltext === "") {
                    $pwainstalltext = esc_html(
                        __(
                            "Install PWA",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }
                $pwainstallbuttoncolor = get_option(
                    "pnfpb_ic_pwa_prompt_install_button_color"
                );
                if ($pwainstallbuttoncolor === "") {
                    $pwainstallbuttoncolor = "#3700ff";
                }
                $pwainstallbuttontextcolor = get_option(
                    "pnfpb_ic_pwa_prompt_install_text_color"
                );
                if ($pwainstallbuttontextcolor === "") {
                    $pwainstallbuttontextcolor = "#ffffff";
                }

                $pwainstallpromptenabled = get_option(
                    "pnfpb_ic_pwa_app_custom_prompt_enable"
                );

                $pwadesktopinstallpromptenabled = get_option(
                    "pnfpb_ic_pwa_app_desktop_custom_prompt_enable"
                );

                $pwamobileinstallpromptenabled = get_option(
                    "pnfpb_ic_pwa_app_mobile_custom_prompt_enable"
                );

                $pwapixelsinstallpromptenabled = get_option(
                    "pnfpb_ic_pwa_app_pixels_custom_prompt_enable"
                );

                $pwapixelsinputinstallpromptenabled = 0;

                if (
                    get_option(
                        "pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable"
                    )
                ) {
                    $pwapixelsinputinstallpromptenabled = intval(
                        get_option(
                            "pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable"
                        )
                    );
                }

                $pwacustominstalltype = get_option(
                    "pnfpb_ic_pwa_app_custom_prompt_type"
                );

                $nonce = wp_create_nonce("icpushadmincallback");
                $filename =
                    "/admin/js/pnfpb_ic_admin_upload_service_account.js";
                $ajaxobject = "pnfpb_ajax_admin_service_account_push_object";
                wp_enqueue_script(
                    "pnfpb_ajax_admin_service_account_push",
                    plugins_url($filename, __FILE__),
                    ["jquery"],
                    "2.06.11",
                    true
                );
                wp_localize_script(
                    "pnfpb_ajax_admin_service_account_push",
                    $ajaxobject,
                    [
                        "ajax_url" => admin_url("admin-ajax.php"),
                        "pnfpb_nonce" => $nonce,
                    ]
                );

                if (
                    $projectId != false &&
                    $projectId != "" &&
                    $publicKey != false &&
                    $publicKey != "" &&
                    $apiKey != false &&
                    $apiKey != "" &&
                    $messagingSenderId != false &&
                    $messagingSenderId != "" &&
                    get_option(
                        "pnfpb_ic_disable_serviceworker_pwa_pushnotification"
                    ) != "1"
                ) {
                    $unsubscribe_dialog_text_confirm = esc_html(
                        __(
                            "Your device is unsubscribed from notification",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_unsubscribe_dialog_text_confirm"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_unsubscribe_dialog_text_confirm"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_unsubscribe_dialog_text_confirm"
                        ) !== ""
                    ) {
                        $unsubscribe_dialog_text_confirm = get_option(
                            "pnfpb_ic_fcm_unsubscribe_dialog_text_confirm"
                        );
                    }

                    $subscribe_dialog_text_confirm = esc_html(
                        __(
                            "Subscription updated",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_subscribe_dialog_text_confirm"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_subscribe_dialog_text_confirm"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_subscribe_dialog_text_confirm"
                        ) !== ""
                    ) {
                        $subscribe_dialog_text_confirm = get_option(
                            "pnfpb_ic_fcm_subscribe_dialog_text_confirm"
                        );
                    }

                    $unsubscribe_button_text_shortcode = esc_html(
                        __(
                            "Unsubscribe push notifications",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_unsubscribe_button_shortcode_text"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_unsubscribe_button_shortcode_text"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_unsubscribe_button_shortcode_text"
                        ) !== ""
                    ) {
                        $unsubscribe_button_text_shortcode = get_option(
                            "pnfpb_ic_fcm_unsubscribe_button_shortcode_text"
                        );
                    }

                    $subscribe_button_text_shortcode = esc_html(
                        __(
                            "Subscribe push notifications",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_subscribe_button_shortcode_text"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_subscribe_button_shortcode_text"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_subscribe_button_shortcode_text"
                        ) !== ""
                    ) {
                        $subscribe_button_text_shortcode = get_option(
                            "pnfpb_ic_fcm_subscribe_button_shortcode_text"
                        );
                    }

                    $save_button_text = esc_html(
                        __("Save", "push-notification-for-post-and-buddypress")
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_subscribe_save_button_text_shortcode"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_subscribe_save_button_text_shortcode"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_subscribe_save_button_text_shortcode"
                        ) !== ""
                    ) {
                        $save_button_text = get_option(
                            "pnfpb_ic_fcm_subscribe_save_button_text_shortcode"
                        );
                    }

                    $cancel_button_text = esc_html(
                        __(
                            "Cancel",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode"
                        ) !== ""
                    ) {
                        $cancel_button_text = get_option(
                            "pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode"
                        );
                    }

                    $subscribe_button_text = esc_html(
                        __(
                            "Subscribe push notification",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option("pnfpb_ic_fcm_subscribe_button_text") &&
                        get_option("pnfpb_ic_fcm_subscribe_button_text") !==
                            false &&
                        get_option("pnfpb_ic_fcm_subscribe_button_text") !== ""
                    ) {
                        $subscribe_button_text = get_option(
                            "pnfpb_ic_fcm_subscribe_button_text"
                        );
                    }

                    $unsubscribe_button_text = esc_html(
                        __(
                            "Unsubscribe push notification",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option("pnfpb_ic_fcm_unsubscribe_button_text") &&
                        get_option("pnfpb_ic_fcm_unsubscribe_button_text") !==
                            false &&
                        get_option("pnfpb_ic_fcm_unsubscribe_button_text") !==
                            ""
                    ) {
                        $unsubscribe_button_text = get_option(
                            "pnfpb_ic_fcm_unsubscribe_button_text"
                        );
                    }

                    $subscribe_button_text_color = "#ffffff";

                    if (
                        get_option(
                            "pnfpb_ic_fcm_subscribe_button_text_color"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_subscribe_button_text_color"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_subscribe_button_text_color"
                        ) !== ""
                    ) {
                        $subscribe_button_text_color = get_option(
                            "pnfpb_ic_fcm_subscribe_button_text_color"
                        );
                    }

                    $subscribe_button_color = "#000000";

                    if (
                        get_option("pnfpb_ic_fcm_subscribe_button_color") &&
                        get_option("pnfpb_ic_fcm_subscribe_button_color") !==
                            false &&
                        get_option("pnfpb_ic_fcm_subscribe_button_color") !== ""
                    ) {
                        $subscribe_button_color = get_option(
                            "pnfpb_ic_fcm_subscribe_button_color"
                        );
                    }
                    $pnfpb_push_prompt = get_option(
                        "pnfpb_ic_fcm_push_prompt_enable"
                    );

                    $group_unsubscribe_dialog_text_confirm = esc_html(
                        __(
                            "Your device is unsubscribed from notification",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
                        ) !== ""
                    ) {
                        $group_unsubscribe_dialog_text_confirm = get_option(
                            "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
                        );
                    }

                    $group_subscribe_dialog_text_confirm = esc_html(
                        __(
                            "Your device is subscribed from notification",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
                        ) !== ""
                    ) {
                        $group_subscribe_dialog_text_confirm = get_option(
                            "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
                        );
                    }

                    $group_unsubscribe_dialog_text = esc_html(
                        __(
                            "Would you like to remove push notifications?",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_group_unsubscribe_dialog_text"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_group_unsubscribe_dialog_text"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_group_unsubscribe_dialog_text"
                        ) !== ""
                    ) {
                        $group_unsubscribe_dialog_text = get_option(
                            "pnfpb_ic_fcm_group_unsubscribe_dialog_text"
                        );
                    }

                    $group_subscribe_dialog_text = esc_html(
                        __(
                            "Would you like to subscribe to push notifications?",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_group_subscribe_dialog_text"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_group_subscribe_dialog_text"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_group_subscribe_dialog_text"
                        ) !== ""
                    ) {
                        $group_subscribe_dialog_text = get_option(
                            "pnfpb_ic_fcm_group_subscribe_dialog_text"
                        );
                    }

                    $shortcode_close_button_text = esc_html(
                        __("Close", "push-notification-for-post-and-buddypress")
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_shortcode_close_button_text"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_shortcode_close_button_text"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_shortcode_close_button_text"
                        ) !== ""
                    ) {
                        $shortcode_close_button_text = get_option(
                            "pnfpb_ic_fcm_shortcode_close_button_text"
                        );
                    }

                    $pnfpb_ic_fcm_loggedin_notify = "0";

                    if (
                        get_option("pnfpb_ic_fcm_loggedin_notify") &&
                        get_option("pnfpb_ic_fcm_loggedin_notify") !== ""
                    ) {
                        $pnfpb_ic_fcm_loggedin_notify = get_option(
                            "pnfpb_ic_fcm_loggedin_notify"
                        );
                    }

                    $pnfpb_ic_fcm_custom_prompt_show_again_days = "7";

                    if (
                        get_option(
                            "pnfpb_ic_fcm_custom_prompt_show_again_days"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_custom_prompt_show_again_days"
                        ) != ""
                    ) {
                        $pnfpb_ic_fcm_custom_prompt_show_again_days = get_option(
                            "pnfpb_ic_fcm_custom_prompt_show_again_days"
                        );
                    }

                    $pnfpb_ic_fcm_pwa_show_again_days = "7";

                    if (
                        get_option("pnfpb_ic_fcm_pwa_show_again_days") &&
                        get_option("pnfpb_ic_fcm_pwa_show_again_days") != ""
                    ) {
                        $pnfpb_ic_fcm_pwa_show_again_days = get_option(
                            "pnfpb_ic_fcm_pwa_show_again_days"
                        );
                    }

                    $pnfpb_hide_foreground_notification = "";

                    $pnfpb_show_custom_post_types = [];

                    $pnfpb_show_push_notify_types = [
                        "all",
                        "post",
                        "activity",
                        "all_comments",
                        "my_comments",
                        "private_message",
                        "new_member",
                        "friendship_request",
                        "friendship_accepted",
                        "avatar_change",
                        "cover_image",
                        "group_details",
                        "group_invite",
                    ];

                    $pnfpb_front_end_settings_push_notify_types = [
                        "all",
                        "post",
                        "bcomment",
                        "mybcomment",
                        "bprivatemessage",
                        "new_member",
                        "friendship_request",
                        "friendship_accept",
                        "unsubscribe-all",
                        "avatar_change",
                        "cover_image_change",
                        "bactivity",
                    ];

                    $args = [
                        "public" => true,
                        "_builtin" => false,
                    ];

                    $output = "names"; // or objects
                    $operator = "and"; // 'and' or 'or'
                    $custposttypes = get_post_types($args, $output, $operator);

                    $frontend_post_push_enable = false;

                    foreach ($custposttypes as $post_type) {
                        if (
                            get_option(
                                "pnfpb_ic_fcm_" . $post_type . "_enable"
                            ) === "1"
                        ) {
                            array_push(
                                $pnfpb_show_custom_post_types,
                                $post_type
                            );
                        }
                    }

                    $pnfpb_show_custom_post_types = wp_json_encode(
                        $pnfpb_show_custom_post_types
                    );

                    $pnfpb_show_push_notify_types = wp_json_encode(
                        $pnfpb_show_push_notify_types
                    );

                    $pnfpb_front_end_settings_push_notify_types = wp_json_encode(
                        $pnfpb_front_end_settings_push_notify_types
                    );

                    $pnfpb_progressier_app_option = "";

                    $filename = "/build/pnfpb_push_notification/index.js";
                    $ajaxobject = "pnfpb_ajax_object_push";
                    wp_enqueue_script(
                        "pnfpb-icajax-script-push",
                        plugins_url($filename, __FILE__),
                        [],
                        "2.10.06",
                        true
                    );
                    wp_localize_script(
                        "pnfpb-icajax-script-push",
                        $ajaxobject,
                        [
                            "ajax_url" => admin_url("admin-ajax.php"),
                            "groupId" => "9",
                            "group_unsubscribe_dialog_text_confirm" => $group_unsubscribe_dialog_text_confirm,
                            "group_subscribe_dialog_text_confirm" => $group_subscribe_dialog_text_confirm,
                            "group_unsubscribe_dialog_text" => $group_unsubscribe_dialog_text,
                            "group_subscribe_dialog_text" => $group_subscribe_dialog_text,
                            "homeurl" => $homeurl,
                            "pwaapponlyenable" => "0",
                            "pwainstallheadertext" => $pwainstallheadertext,
                            "pwainstalltext" => $pwainstalltext,
                            "pwainstallbuttoncolor" => $pwainstallbuttoncolor,
                            "pwainstallbuttontextcolor" => $pwainstallbuttontextcolor,
                            "pwainstallbuttontext" => $pwainstallbuttontext,
                            "pwainstallpromptenabled" => $pwainstallpromptenabled,
                            "pwacustominstalltype" => $pwacustominstalltype,
                            "unsubscribe_dialog_text_confirm" => $unsubscribe_dialog_text_confirm,
                            "subscribe_dialog_text_confirm" => $subscribe_dialog_text_confirm,
                            "unsubscribe_button_text_shortcode" => $unsubscribe_button_text_shortcode,
                            "subscribe_button_text_shortcode" => $subscribe_button_text_shortcode,
                            "subscribe_button_text_color" => $subscribe_button_text_color,
                            "subscribe_button_color" => $subscribe_button_color,
                            "cancel_button_text" => $cancel_button_text,
                            "save_button_text" => $save_button_text,
                            "unsubscribe_button_text" => $unsubscribe_button_text,
                            "subscribe_button_text" => $subscribe_button_text,
                            "isloggedin" => is_user_logged_in(),
                            "pnfpb_push_prompt" => $pnfpb_push_prompt,
                            "userid" => get_current_user_id(),
                            "pnfpb_ic_fcm_popup_subscribe_message" => get_option(
                                "pnfpb_ic_fcm_popup_subscribe_message"
                            ),
                            "pnfpb_ic_fcm_popup_unsubscribe_message" => get_option(
                                "pnfpb_ic_fcm_popup_unsubscribe_message"
                            ),
                            "pnfpb_ic_fcm_popup_wait_message" => get_option(
                                "pnfpb_ic_fcm_popup_wait_message"
                            ),
                            "pnfpb_ic_fcm_custom_prompt_popup_wait_message" => get_option(
                                "pnfpb_ic_fcm_custom_prompt_popup_wait_message"
                            ),
                            "pnfpb_ic_fcm_custom_prompt_subscribed_text" => get_option(
                                "pnfpb_ic_fcm_custom_prompt_subscribed_text"
                            ),
                            "pnfpb_ic_fcm_custom_prompt_subscribe_text" => get_option(
                                "pnfpb_ic_fcm_custom_prompt_header_text"
                            ),
                            "pnfpb_ic_fcm_custom_prompt_subscribe_text" => get_option(
                                "pnfpb_ic_fcm_custom_prompt_header_text_line_2"
                            ),							
                            "pnfpb_ic_fcm_custom_prompt_confirmation_message_on_off" => get_option(
                                "pnfpb_custom_prompt_confirmation_message_on_off"
                            ),
                            "pnfpb_ic_fcm_popup_subscribe_button" => get_option(
                                "pnfpb_ic_fcm_popup_subscribe_button"
                            ),
                            "pnfpb_ic_fcm_popup_unsubscribe_button" => get_option(
                                "pnfpb_ic_fcm_popup_unsubscribe_button"
                            ),
                            "pwadesktopinstallpromptenabled" => $pwadesktopinstallpromptenabled,
                            "pwamobileinstallpromptenabled" => $pwamobileinstallpromptenabled,
                            "pwapixelsinstallpromptenabled" => $pwapixelsinstallpromptenabled,
                            "pwapixelsinputinstallpromptenabled" => $pwapixelsinputinstallpromptenabled,
                            "shortcode_close_button_text" => $shortcode_close_button_text,
                            "notify_loggedin" => $pnfpb_ic_fcm_loggedin_notify,
                            "pnfpb_hide_foreground_notification" => $pnfpb_hide_foreground_notification,
                            "pnfpb_show_custom_post_types" => $pnfpb_show_custom_post_types,
                            "pnfpb_show_push_notify_types" => $pnfpb_show_push_notify_types,
                            "pnfpb_front_end_settings_push_notify_types" => $pnfpb_front_end_settings_push_notify_types,
                            "pnfpb_progressier_app_option" => $pnfpb_progressier_app_option,
                        ]
                    );
                } else {
                    if (
                        $pwaappenable === "1" &&
                        get_option(
                            "pnfpb_ic_disable_serviceworker_pwa_pushnotification"
                        ) != "1"
                    ) {
                        $pnfpb_push_prompt = get_option(
                            "pnfpb_ic_fcm_push_prompt_enable"
                        );
                        $filename = "/build/pnfpb_push_notification/index.js";
                        $ajaxobject = "pnfpb_ajax_object_push";
                        wp_enqueue_script(
                            "pnfpb-icajax-script-push",
                            plugins_url($filename, __FILE__),
                            ["jquery"],
                            "2.10.06",
                            true
                        );
                        wp_localize_script(
                            "pnfpb-icajax-script-push",
                            $ajaxobject,
                            [
                                "ajax_url" => admin_url("admin-ajax.php"),
                                "homeurl" => $homeurl,
                                "pwaapponlyenable" => $pwaappenable,
                                "pwainstallheadertext" => $pwainstallheadertext,
                                "pwainstalltext" => $pwainstalltext,
                                "pwainstallbuttoncolor" => $pwainstallbuttoncolor,
                                "pwainstallbuttontextcolor" => $pwainstallbuttontextcolor,
                                "pwainstallbuttontext" => $pwainstallbuttontext,
                                "pwacustominstalltype" => $pwacustominstalltype,
                                "pwainstallpromptenabled" => $pwainstallpromptenabled,
                                "pnfpb_push_prompt" => $pnfpb_push_prompt,
                                "pwadesktopinstallpromptenabled" => $pwadesktopinstallpromptenabled,
                                "pwamobileinstallpromptenabled" => $pwamobileinstallpromptenabled,
                                "pwapixelsinstallpromptenabled" => $pwapixelsinstallpromptenabled,
                                "pwapixelsinputinstallpromptenabled" => $pwapixelsinputinstallpromptenabled,
                            ]
                        );
                    }
                }
            } else {
                $filename = "/public/js/pnfpb_webtonative.js";

                wp_enqueue_script(
                    "pwebtonative_app",
                    plugins_url($filename, __FILE__),
                    [],
                    "1.0.44",
                    true
                );
            }
        }

        /**
         * Enqueue language translation scripts
         *
         * @since 1.57.0
         */
        public function PNFPB_load_text_domain()
        {
            load_plugin_textdomain(
                "push-notification-for-post-and-buddypress",
                false,
                dirname(plugin_basename(__FILE__)) . "/languages/"
            );
        }

        /**
         * Enqueue language translation scripts
         *
         * @since 2.04.0
         */
        public function PNFPB_load_translation_scripts()
        {
            $scripttranslate = wp_set_script_translations(
                "pnfpb-icajax-script-push",
                "push-notification-for-post-and-buddypress",
                plugin_dir_path(__FILE__) . "languages"
            );

            $scripttranslate = wp_set_script_translations(
                "pnfpb-icajax-script-unsubscribe-push",
                "push-notification-for-post-and-buddypress",
                plugin_dir_path(__FILE__) . "languages"
            );

            $scripttranslate = wp_set_script_translations(
                "pnfpb-icajax-script-group-push",
                "push-notification-for-post-and-buddypress",
                plugin_dir_path(__FILE__) . "languages"
            );
        }

        /**
         * Enqueue and localize scripts needed for push notification using FCM
         *
         * @since 1.0.0
         */
        public function PNFPB_ic_push_notification_scripts()
        {
            wp_enqueue_script("jquery-ui-dialog");
            wp_enqueue_style("wp-jquery-ui-dialog");

            wp_enqueue_style(
                "pnfpb-icpstyle-es6-name",
                plugin_dir_url(__FILE__) .
                    "build/pnfpb_push_notification/index.css",
                [],
                "2.08.51"
            );

            if (
                get_option("pnfpb_ic_fcm_push_prompt_text") &&
                get_option("pnfpb_ic_fcm_push_prompt_text") != ""
            ) {
                $pnfpb_push_prompt_text = get_option(
                    "pnfpb_ic_fcm_push_prompt_text"
                );
            } else {
                $pnfpb_push_prompt_text = esc_html(
                    __(
                        "Would you like to subscribe to our notifications?",
                        "push-notification-for-post-and-buddypress"
                    )
                );
            }

            if (
                get_option("pnfpb_ic_fcm_push_prompt_confirm_button") &&
                get_option("pnfpb_ic_fcm_push_prompt_confirm_button") != ""
            ) {
                $pnfpb_push_prompt_confirm_button_text = get_option(
                    "pnfpb_ic_fcm_push_prompt_confirm_button"
                );
            } else {
                $pnfpb_push_prompt_confirm_button_text = esc_html(
                    __("Yes", "push-notification-for-post-and-buddypress")
                );
            }

            if (
                get_option("pnfpb_ic_fcm_push_prompt_cancel_button") &&
                get_option("pnfpb_ic_fcm_push_prompt_cancel_button") != ""
            ) {
                $pnfpb_push_prompt_cancel_button_text = get_option(
                    "pnfpb_ic_fcm_push_prompt_cancel_button"
                );
            } else {
                $pnfpb_push_prompt_cancel_button_text = esc_html(
                    __("No", "push-notification-for-post-and-buddypress")
                );
            }

            if (
                get_option("pnfpb_ic_fcm_push_prompt_button_background") &&
                get_option("pnfpb_ic_fcm_push_prompt_button_background") != ""
            ) {
                $pnfpb_push_prompt_button_background = get_option(
                    "pnfpb_ic_fcm_push_prompt_button_background"
                );
            } else {
                $pnfpb_push_prompt_button_background = "#121240";
            }

            if (
                get_option("pnfpb_ic_fcm_push_prompt_dialog_background") &&
                get_option("pnfpb_ic_fcm_push_prompt_dialog_background") != ""
            ) {
                $pnfpb_push_prompt_dialog_background = get_option(
                    "pnfpb_ic_fcm_push_prompt_dialog_background"
                );
            } else {
                $pnfpb_push_prompt_dialog_background = "#DAD7D7";
            }

            if (
                get_option("pnfpb_ic_fcm_push_prompt_text_color") &&
                get_option("pnfpb_ic_fcm_push_prompt_text_color") != ""
            ) {
                $pnfpb_push_prompt_text_color = get_option(
                    "pnfpb_ic_fcm_push_prompt_text_color"
                );
            } else {
                $pnfpb_push_prompt_text_color = "#161515";
            }

            if (
                get_option("pnfpb_ic_fcm_push_prompt_button_text_color") &&
                get_option("pnfpb_ic_fcm_push_prompt_button_text_color") != ""
            ) {
                $pnfpb_push_prompt_button_text_color = get_option(
                    "pnfpb_ic_fcm_push_prompt_button_text_color"
                );
            } else {
                $pnfpb_push_prompt_button_text_color = "#ffffff";
            }

            if (
                get_option("pnfpb_ic_fcm_push_prompt_position") &&
                get_option("pnfpb_ic_fcm_push_prompt_position") != ""
            ) {
                $pnfpb_push_prompt_position = get_option(
                    "pnfpb_ic_fcm_push_prompt_position"
                );
            } else {
                $pnfpb_push_prompt_position = esc_html(
                    __(
                        "pnfpb-top-left",
                        "push-notification-for-post-and-buddypress"
                    )
                );
            }

            if (
                get_option("pnfpb_ic_fcm_pwa_prompt_text") &&
                get_option("pnfpb_ic_fcm_pwa_prompt_text") != ""
            ) {
                $pnfpb_pwa_prompt_text = get_option(
                    "pnfpb_ic_fcm_pwa_prompt_text"
                );
            } else {
                $pnfpb_pwa_prompt_text = esc_html(
                    __(
                        "Would you like to install our app?",
                        "push-notification-for-post-and-buddypress"
                    )
                );
            }

            if (
                get_option("pnfpb_ic_fcm_pwa_prompt_confirm_button") &&
                get_option("pnfpb_ic_fcm_pwa_prompt_confirm_button") != ""
            ) {
                $pnfpb_pwa_prompt_confirm_button_text = get_option(
                    "pnfpb_ic_fcm_pwa_prompt_confirm_button"
                );
            } else {
                $pnfpb_pwa_prompt_confirm_button_text = esc_html(
                    __("Install", "push-notification-for-post-and-buddypress")
                );
            }

            if (
                get_option("pnfpb_ic_fcm_pwa_prompt_cancel_button") &&
                get_option("pnfpb_ic_fcm_pwa_prompt_cancel_button") != ""
            ) {
                $pnfpb_pwa_prompt_cancel_button_text = get_option(
                    "pnfpb_ic_fcm_pwa_prompt_cancel_button"
                );
            } else {
                $pnfpb_pwa_prompt_cancel_button_text = esc_html(
                    __("Cancel", "push-notification-for-post-and-buddypress")
                );
            }

            if (
                get_option("pnfpb_ic_fcm_pwa_prompt_button_background") &&
                get_option("pnfpb_ic_fcm_pwa_prompt_button_background") != ""
            ) {
                $pnfpb_pwa_prompt_button_background = get_option(
                    "pnfpb_ic_fcm_pwa_prompt_button_background"
                );
            } else {
                $pnfpb_pwa_prompt_button_background = "#121240";
            }

            if (
                get_option("pnfpb_ic_fcm_pwa_prompt_dialog_background") &&
                get_option("pnfpb_ic_fcm_pwa_prompt_dialog_background") != ""
            ) {
                $pnfpb_pwa_prompt_dialog_background = get_option(
                    "pnfpb_ic_fcm_pwa_prompt_dialog_background"
                );
            } else {
                $pnfpb_pwa_prompt_dialog_background = "#6666ff";
            }

            if (
                get_option("pnfpb_ic_fcm_pwa_prompt_text_color") &&
                get_option("pnfpb_ic_fcm_pwa_prompt_text_color") != ""
            ) {
                $pnfpb_pwa_prompt_text_color = get_option(
                    "pnfpb_ic_fcm_pwa_prompt_text_color"
                );
            } else {
                $pnfpb_pwa_prompt_text_color = "#ffffff";
            }

            if (
                get_option("pnfpb_ic_fcm_pwa_prompt_button_text_color") &&
                get_option("pnfpb_ic_fcm_pwa_prompt_button_text_color") != ""
            ) {
                $pnfpb_pwa_prompt_button_text_color = get_option(
                    "pnfpb_ic_fcm_pwa_prompt_button_text_color"
                );
            } else {
                $pnfpb_pwa_prompt_button_text_color = "#ffffff";
            }

            if (
                get_option("pnfpb_progressier_push") &&
                get_option("pnfpb_progressier_push") === "1" &&
                get_option("pnfpb_ic_pwa_app_enable") === "1" &&
                (get_option("pnfpb_ic_pwa_app_custom_prompt_enable") === "1" ||
                    get_option(
                        "pnfpb_ic_pwa_app_desktop_custom_prompt_enable"
                    ) === "1" ||
                    get_option(
                        "pnfpb_ic_pwa_app_mobile_custom_prompt_enable"
                    ) === "1" ||
                    get_option(
                        "pnfpb_ic_pwa_app_pixels_custom_prompt_enable"
                    ) === "1") &&
                get_option(
                    "pnfpb_ic_disable_serviceworker_pwa_pushnotification"
                ) != "1"
            ) {
                echo '<div class="pnfpb-pwa-dialog-container" id="pnfpb-pwa-dialog-container">
										<div class="pnfpb-pwa-dialog-box" style="background-color:' .
                    esc_attr($pnfpb_pwa_prompt_dialog_background) .
                    '">
											<div class="pnfpb-pwa-dialog-title" style="color:' .
                    esc_attr($pnfpb_pwa_prompt_text_color) .
                    ';">' .
                    esc_attr($pnfpb_pwa_prompt_text) .
                    '</div>
											<div class="pnfpb-pwa-dialog-buttons">
												<button id="pnfpb-pwa-dialog-cancel" type="button" class="button secondary" style="color:' .
                    esc_attr($pnfpb_pwa_prompt_button_text_color) .
                    ";background-color:" .
                    esc_attr($pnfpb_pwa_prompt_button_background) .
                    ';">' .
                    esc_attr($pnfpb_pwa_prompt_cancel_button_text) .
                    '</button>
												<button id="pnfpb-pwa-dialog-subscribe" type="button" class="button primary" style="color:' .
                    esc_attr($pnfpb_pwa_prompt_button_text_color) .
                    ";background-color:" .
                    esc_attr($pnfpb_pwa_prompt_button_background) .
                    ';">' .
                    esc_attr($pnfpb_pwa_prompt_confirm_button_text) .
                    '</button>
											</div>
										</div>
									</div>'; ?>

				<div id="pnfpb-pwa-dialog-ios" class="pnfpb-pwa-dialog-app-installed" title="<?php echo esc_attr(
        __("PWA for IOS browsers", "push-notification-for-post-and-buddypress")
    ); ?>">
					<p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span><?php echo esc_html(
         __(
             "For IOS and IPAD browsers, Only option to install PWA is to use add to home screen in safari browser",
             "push-notification-for-post-and-buddypress"
         )
     ); ?></p>
				</div>

				<div id="pnfpb-pwa-dialog-app-installed" class="pnfpb-pwa-dialog-app-installed" title="<?php if (
        get_option("pnfpb-pwa-dialog-app-installed_text", false)
    ) {
        echo esc_attr(get_option("pnfpb-pwa-dialog-app-installed_text"));
    } else {
        echo esc_attr(
            __(
                "App installed successfully",
                "push-notification-for-post-and-buddypress"
            )
        );
    } ?>">
									<p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span><?php if (
             get_option("pnfpb-pwa-dialog-app-installed_description", false)
         ) {
             echo esc_html(
                 get_option("pnfpb-pwa-dialog-app-installed_description")
             );
         } else {
             echo esc_html(
                 __(
                     "Progressive Web App (PWA) is installed successfully.",
                     "push-notification-for-post-and-buddypress"
                 )
             );
         } ?></p>
				</div>
<?php
            }

            $subscribe_button_text = esc_html(
                __(
                    "Subscribe push notification",
                    "push-notification-for-post-and-buddypress"
                )
            );

            if (
                get_option("pnfpb_ic_fcm_subscribe_button_text") &&
                get_option("pnfpb_ic_fcm_subscribe_button_text") !== false &&
                get_option("pnfpb_ic_fcm_subscribe_button_text") !== ""
            ) {
                $subscribe_button_text = get_option(
                    "pnfpb_ic_fcm_subscribe_button_text"
                );
            }

            $unsubscribe_button_text = esc_html(
                __(
                    "Unsubscribe push notification",
                    "push-notification-for-post-and-buddypress"
                )
            );

            if (
                get_option("pnfpb_ic_fcm_unsubscribe_button_text") &&
                get_option("pnfpb_ic_fcm_unsubscribe_button_text") !== false &&
                get_option("pnfpb_ic_fcm_unsubscribe_button_text") !== ""
            ) {
                $unsubscribe_button_text = get_option(
                    "pnfpb_ic_fcm_unsubscribe_button_text"
                );
            }

            $subscribe_button_text_color = "#ffffff";

            if (
                get_option("pnfpb_ic_fcm_subscribe_button_text_color") &&
                get_option("pnfpb_ic_fcm_subscribe_button_text_color") !==
                    false &&
                get_option("pnfpb_ic_fcm_subscribe_button_text_color") !== ""
            ) {
                $subscribe_button_text_color = get_option(
                    "pnfpb_ic_fcm_subscribe_button_text_color"
                );
            }

            $subscribe_button_color = "#000000";

            if (
                get_option("pnfpb_ic_fcm_subscribe_button_color") &&
                get_option("pnfpb_ic_fcm_subscribe_button_color") !== false &&
                get_option("pnfpb_ic_fcm_subscribe_button_color") !== ""
            ) {
                $subscribe_button_color = get_option(
                    "pnfpb_ic_fcm_subscribe_button_color"
                );
            }

            $group_unsubscribe_dialog_text_confirm = esc_html(
                __(
                    "Your device is unsubscribed from notification",
                    "push-notification-for-post-and-buddypress"
                )
            );

            if (
                get_option(
                    "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
                ) &&
                get_option(
                    "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
                ) !== false &&
                get_option(
                    "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
                ) !== ""
            ) {
                $group_unsubscribe_dialog_text_confirm = get_option(
                    "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
                );
            }

            $group_subscribe_dialog_text_confirm = esc_html(
                __(
                    "Your device is subscribed from notification",
                    "push-notification-for-post-and-buddypress"
                )
            );

            if (
                get_option(
                    "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
                ) &&
                get_option(
                    "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
                ) !== false &&
                get_option(
                    "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
                ) !== ""
            ) {
                $group_subscribe_dialog_text_confirm = get_option(
                    "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
                );
            }

            $group_unsubscribe_dialog_text = esc_html(
                __(
                    "Would you like to unsubscribe push notifications?",
                    "push-notification-for-post-and-buddypress"
                )
            );

            if (
                get_option("pnfpb_ic_fcm_group_unsubscribe_dialog_text") &&
                get_option("pnfpb_ic_fcm_group_unsubscribe_dialog_text") !==
                    false &&
                get_option("pnfpb_ic_fcm_group_unsubscribe_dialog_text") !== ""
            ) {
                $group_unsubscribe_dialog_text = get_option(
                    "pnfpb_ic_fcm_group_unsubscribe_dialog_text"
                );
            }

            $group_subscribe_dialog_text = esc_html(
                __(
                    "Would you like to subscribe to push notifications?",
                    "push-notification-for-post-and-buddypress"
                )
            );

            if (
                get_option("pnfpb_ic_fcm_group_subscribe_dialog_text") &&
                get_option("pnfpb_ic_fcm_group_subscribe_dialog_text") !==
                    false &&
                get_option("pnfpb_ic_fcm_group_subscribe_dialog_text") !== ""
            ) {
                $group_subscribe_dialog_text = get_option(
                    "pnfpb_ic_fcm_group_subscribe_dialog_text"
                );
            }

            if (
                get_option("pnfpb_onesignal_push") !== "1" &&
                get_option("pnfpb_progressier_push") !== "1"
            ) {
                wp_enqueue_style(
                    "pnfpb-icpstyle-name",
                    plugin_dir_url(__FILE__) .
                        "src/pnfpb_push_notification/css/pnfpb_main.css",
                    [],
                    "2.10.01"
                );

                $pnfpb_progressier_app_option = "";

                if (
                    get_option("pnfpb_ic_thirdparty_pwa_app_enable") === "1" &&
                    get_option(
                        "pnfpb_ic_disable_serviceworker_pwa_pushnotification"
                    ) != "1" &&
                    get_option("pnfpb_ic_pwa_thirdparty_app_id") &&
                    get_option("pnfpb_ic_pwa_thirdparty_app_id") != ""
                ) {
                    wp_enqueue_script(
                        "progressier_pwa_app",
                        "https://progressier.app/" .
                            get_option("pnfpb_ic_pwa_thirdparty_app_id") .
                            "/script.js",
                        [],
                        "1.0.1",
                        true
                    );

                    $pnfpb_progressier_app_option = get_option(
                        "pnfpb_ic_thirdparty_pwa_app_enable"
                    );
                }

                $apiKey = get_option("pnfpb_ic_fcm_api");
                $authDomain = get_option("pnfpb_ic_fcm_authdomain");
                $databaseURL = get_option("pnfpb_ic_fcm_databaseurl");
                $projectId = get_option("pnfpb_ic_fcm_projectid");
                $storageBucket = get_option("pnfpb_ic_fcm_storagebucket");
                $messagingSenderId = get_option(
                    "pnfpb_ic_fcm_messagingsenderid"
                );
                $appId = get_option("pnfpb_ic_fcm_appid");
                $publicKey = get_option("pnfpb_ic_fcm_publickey");
                $homeurl = get_home_url();
                $pwaappenable = get_option("pnfpb_ic_pwa_app_enable");
                $pwainstallbuttontext = get_option(
                    "pnfpb_ic_pwa_prompt_install_button_text"
                );
                if ($pwainstallbuttontext === "") {
                    $pwainstallbuttontext = esc_html(
                        __(
                            "Install PWA app",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }
                $pwainstallheadertext = get_option(
                    "pnfpb_ic_pwa_prompt_header_text"
                );
                if ($pwainstallheadertext === "") {
                    $pwainstallheadertext = esc_html(
                        __(
                            "Install our PWA app with offline functionality",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }
                $pwainstalltext = get_option("pnfpb_ic_pwa_prompt_description");
                if ($pwainstalltext === "") {
                    $pwainstalltext = esc_html(
                        __(
                            "Install PWA",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }
                $pwainstallbuttoncolor = get_option(
                    "pnfpb_ic_pwa_prompt_install_button_color"
                );
                if ($pwainstallbuttoncolor === "") {
                    $pwainstallbuttoncolor = "#3700ff";
                }
                $pwainstallbuttontextcolor = get_option(
                    "pnfpb_ic_pwa_prompt_install_text_color"
                );
                if ($pwainstallbuttontextcolor === "") {
                    $pwainstallbuttontextcolor = "#ffffff";
                }

                $pwainstallpromptenabled = get_option(
                    "pnfpb_ic_pwa_app_custom_prompt_enable"
                );

                $pwadesktopinstallpromptenabled = get_option(
                    "pnfpb_ic_pwa_app_desktop_custom_prompt_enable"
                );

                $pwamobileinstallpromptenabled = get_option(
                    "pnfpb_ic_pwa_app_mobile_custom_prompt_enable"
                );

                $pwapixelsinstallpromptenabled = get_option(
                    "pnfpb_ic_pwa_app_pixels_custom_prompt_enable"
                );

                $pwapixelsinputinstallpromptenabled = 0;
                if (
                    get_option(
                        "pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable"
                    )
                ) {
                    $pwapixelsinputinstallpromptenabled = intval(
                        get_option(
                            "pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable"
                        )
                    );
                }

                $pwacustominstalltype = get_option(
                    "pnfpb_ic_pwa_app_custom_prompt_type"
                );

                if (
                    $projectId != false &&
                    $projectId != "" &&
                    $publicKey != false &&
                    $publicKey != "" &&
                    $apiKey != false &&
                    $apiKey != "" &&
                    $messagingSenderId != false &&
                    $messagingSenderId != "" &&
                    get_option(
                        "pnfpb_ic_disable_serviceworker_pwa_pushnotification"
                    ) != "1"
                ) {
                    $unsubscribe_dialog_text_confirm =
                        "Your device is unsubscribed from notification";

                    if (
                        get_option(
                            "pnfpb_ic_fcm_unsubscribe_dialog_text_confirm"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_unsubscribe_dialog_text_confirm"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_unsubscribe_dialog_text_confirm"
                        ) !== ""
                    ) {
                        $unsubscribe_dialog_text_confirm = get_option(
                            "pnfpb_ic_fcm_unsubscribe_dialog_text_confirm"
                        );
                    }

                    $subscribe_dialog_text_confirm = esc_html(
                        __(
                            "Subscription updated",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_subscribe_dialog_text_confirm"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_subscribe_dialog_text_confirm"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_subscribe_dialog_text_confirm"
                        ) !== ""
                    ) {
                        $subscribe_dialog_text_confirm = get_option(
                            "pnfpb_ic_fcm_subscribe_dialog_text_confirm"
                        );
                    }

                    $unsubscribe_button_text_shortcode = esc_html(
                        __(
                            "Unsubscribe push notifications",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_unsubscribe_button_shortcode_text"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_unsubscribe_button_shortcode_text"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_unsubscribe_button_shortcode_text"
                        ) !== ""
                    ) {
                        $unsubscribe_button_text_shortcode = get_option(
                            "pnfpb_ic_fcm_unsubscribe_button_shortcode_text"
                        );
                    }

                    $subscribe_button_text_shortcode = esc_html(
                        __(
                            "Subscribe push notifications",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_subscribe_button_shortcode_text"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_subscribe_button_shortcode_text"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_subscribe_button_shortcode_text"
                        ) !== ""
                    ) {
                        $subscribe_button_text_shortcode = get_option(
                            "pnfpb_ic_fcm_subscribe_button_shortcode_text"
                        );
                    }

                    $save_button_text = esc_html(
                        __("Save", "push-notification-for-post-and-buddypress")
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_subscribe_save_button_text_shortcode"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_subscribe_save_button_text_shortcode"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_subscribe_save_button_text_shortcode"
                        ) !== ""
                    ) {
                        $save_button_text = get_option(
                            "pnfpb_ic_fcm_subscribe_save_button_text_shortcode"
                        );
                    }

                    $cancel_button_text = esc_html(
                        __(
                            "Cancel",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode"
                        ) !== ""
                    ) {
                        $cancel_button_text = get_option(
                            "pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode"
                        );
                    }

                    $subscribe_button_text = esc_html(
                        __(
                            "Subscribe push notification",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option("pnfpb_ic_fcm_subscribe_button_text") &&
                        get_option("pnfpb_ic_fcm_subscribe_button_text") !==
                            false &&
                        get_option("pnfpb_ic_fcm_subscribe_button_text") !== ""
                    ) {
                        $subscribe_button_text = get_option(
                            "pnfpb_ic_fcm_subscribe_button_text"
                        );
                    }

                    $unsubscribe_button_text = esc_html(
                        __(
                            "Unsubscribe push notification",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option("pnfpb_ic_fcm_unsubscribe_button_text") &&
                        get_option("pnfpb_ic_fcm_unsubscribe_button_text") !==
                            false &&
                        get_option("pnfpb_ic_fcm_unsubscribe_button_text") !==
                            ""
                    ) {
                        $unsubscribe_button_text = get_option(
                            "pnfpb_ic_fcm_unsubscribe_button_text"
                        );
                    }

                    $subscribe_button_text_color = "#ffffff";

                    if (
                        get_option(
                            "pnfpb_ic_fcm_subscribe_button_text_color"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_subscribe_button_text_color"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_subscribe_button_text_color"
                        ) !== ""
                    ) {
                        $subscribe_button_text_color = get_option(
                            "pnfpb_ic_fcm_subscribe_button_text_color"
                        );
                    }

                    $subscribe_button_color = "#000000";

                    if (
                        get_option("pnfpb_ic_fcm_subscribe_button_color") &&
                        get_option("pnfpb_ic_fcm_subscribe_button_color") !==
                            false &&
                        get_option("pnfpb_ic_fcm_subscribe_button_color") !== ""
                    ) {
                        $subscribe_button_color = get_option(
                            "pnfpb_ic_fcm_subscribe_button_color"
                        );
                    }

                    $pnfpb_push_prompt = get_option(
                        "pnfpb_ic_fcm_push_prompt_enable"
                    );

                    $group_unsubscribe_dialog_text_confirm = esc_html(
                        __(
                            "Your device is unsubscribed from notification",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
                        ) !== ""
                    ) {
                        $group_unsubscribe_dialog_text_confirm = get_option(
                            "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
                        );
                    }

                    $group_subscribe_dialog_text_confirm = esc_html(
                        __(
                            "Your device is subscribed from notification",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
                        ) !== ""
                    ) {
                        $group_subscribe_dialog_text_confirm = get_option(
                            "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
                        );
                    }

                    $group_unsubscribe_dialog_text = esc_html(
                        __(
                            "Would you like to remove push notifications?",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_group_unsubscribe_dialog_text"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_group_unsubscribe_dialog_text"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_group_unsubscribe_dialog_text"
                        ) !== ""
                    ) {
                        $group_unsubscribe_dialog_text = get_option(
                            "pnfpb_ic_fcm_group_unsubscribe_dialog_text"
                        );
                    }

                    $group_subscribe_dialog_text = esc_html(
                        __(
                            "Would you like to subscribe to push notifications?",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_group_subscribe_dialog_text"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_group_subscribe_dialog_text"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_group_subscribe_dialog_text"
                        ) !== ""
                    ) {
                        $group_subscribe_dialog_text = get_option(
                            "pnfpb_ic_fcm_group_subscribe_dialog_text"
                        );
                    }

                    $shortcode_close_button_text = esc_html(
                        __("Close", "push-notification-for-post-and-buddypress")
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_shortcode_close_button_text"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_shortcode_close_button_text"
                        ) !== false &&
                        get_option(
                            "pnfpb_ic_fcm_shortcode_close_button_text"
                        ) !== ""
                    ) {
                        $shortcode_close_button_text = get_option(
                            "pnfpb_ic_fcm_shortcode_close_button_text"
                        );
                    }

                    $pnfpb_ic_fcm_prompt_style = "";

                    if (
                        get_option("pnfpb_ic_fcm_prompt_style") &&
                        get_option("pnfpb_ic_fcm_prompt_style") !== false &&
                        get_option("pnfpb_ic_fcm_prompt_style") !== ""
                    ) {
                        $pnfpb_ic_fcm_prompt_style = get_option(
                            "pnfpb_ic_fcm_prompt_style"
                        );
                    }

                    $pnfpb_ic_fcm_prompt_on_off = "";

                    if (
                        get_option("pnfpb_ic_fcm_prompt_on_off") &&
                        get_option("pnfpb_ic_fcm_prompt_on_off") !== false &&
                        get_option("pnfpb_ic_fcm_prompt_on_off") !== ""
                    ) {
                        $pnfpb_ic_fcm_prompt_on_off = get_option(
                            "pnfpb_ic_fcm_prompt_on_off"
                        );
                    }

                    $pnfpb_ic_fcm_prompt_style3 = "";

                    if (
                        get_option("pnfpb_ic_fcm_prompt_style3") &&
                        get_option("pnfpb_ic_fcm_prompt_style3") !== false &&
                        get_option("pnfpb_ic_fcm_prompt_style3") !== ""
                    ) {
                        $pnfpb_ic_fcm_prompt_style3 = get_option(
                            "pnfpb_ic_fcm_prompt_style3"
                        );
                    }

                    $pnfpb_ic_fcm_custom_prompt_animation = "";

                    if (
                        get_option("pnfpb_ic_fcm_custom_prompt_animation") &&
                        get_option("pnfpb_ic_fcm_custom_prompt_animation") !==
                            false &&
                        get_option("pnfpb_ic_fcm_custom_prompt_animation") !==
                            ""
                    ) {
                        $pnfpb_ic_fcm_custom_prompt_animation = get_option(
                            "pnfpb_ic_fcm_custom_prompt_animation"
                        );
                    }

                    $pnfpb_ic_fcm_loggedin_notify = "0";

                    if (
                        get_option("pnfpb_ic_fcm_loggedin_notify") &&
                        get_option("pnfpb_ic_fcm_loggedin_notify") !== ""
                    ) {
                        $pnfpb_ic_fcm_loggedin_notify = get_option(
                            "pnfpb_ic_fcm_loggedin_notify"
                        );
                    }

                    $pnfpb_ic_fcm_custom_prompt_show_again_days = "7";

                    if (
                        get_option(
                            "pnfpb_ic_fcm_custom_prompt_show_again_days"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_custom_prompt_show_again_days"
                        ) != ""
                    ) {
                        $pnfpb_ic_fcm_custom_prompt_show_again_days = get_option(
                            "pnfpb_ic_fcm_custom_prompt_show_again_days"
                        );
                    }

                    $pnfpb_ic_fcm_pwa_show_again_days = "7";

                    if (
                        get_option("pnfpb_ic_fcm_pwa_show_again_days") &&
                        get_option("pnfpb_ic_fcm_pwa_show_again_days") != ""
                    ) {
                        $pnfpb_ic_fcm_pwa_show_again_days = get_option(
                            "pnfpb_ic_fcm_pwa_show_again_days"
                        );
                    }

                    $pnfpb_hide_foreground_notification = "";

                    $pnfpb_show_custom_post_types = [];

                    $pnfpb_show_push_notify_types = [
                        "all",
                        "post",
                        "all_comments",
                        "my_comments",
                        "private_message",
                        "new_member",
                        "friendship_request",
                        "friendship_accepted",
                        "unsubscribe-all",
                        "avatar_change",
                        "cover_image_change",
                        "activity",
                        "group_details_update",
                        "group_invite",
                    ];

                    $pnfpb_front_end_settings_push_notify_types = [
                        "all",
                        "post",
                        "bcomment",
                        "mybcomment",
                        "bprivatemessage",
                        "new_member",
                        "friendship_request",
                        "friendship_accept",
                        "unsubscribe-all",
                        "avatar_change",
                        "cover_image_change",
                        "bactivity",
                    ];

                    $args = [
                        "public" => true,
                        "_builtin" => false,
                    ];

                    $output = "names"; // or objects
                    $operator = "and"; // 'and' or 'or'
                    $custposttypes = get_post_types($args, $output, $operator);

                    $frontend_post_push_enable = false;

                    foreach ($custposttypes as $post_type) {
                        if (
                            get_option(
                                "pnfpb_ic_fcm_" . $post_type . "_enable"
                            ) === "1" &&
                            $post_type !== "buddypress"
                        ) {
                            array_push(
                                $pnfpb_show_custom_post_types,
                                $post_type
                            );
                        }
                    }

                    $pnfpb_show_custom_post_types = wp_json_encode(
                        $pnfpb_show_custom_post_types
                    );

                    $pnfpb_show_push_notify_types = wp_json_encode(
                        $pnfpb_show_push_notify_types
                    );

                    $pnfpb_front_end_settings_push_notify_types = wp_json_encode(
                        $pnfpb_front_end_settings_push_notify_types
                    );

                    $filename = "/build/pnfpb_push_notification/index.js";

                    $ajaxobject = "pnfpb_ajax_object_push";

                    wp_enqueue_script(
                        "pnfpb-icajax-script-push",
                        plugins_url($filename, __FILE__),
                        [],
                        "2.10.06",
                        true
                    );

                    wp_localize_script(
                        "pnfpb-icajax-script-push",
                        $ajaxobject,
                        [
                            "ajax_url" => admin_url("admin-ajax.php"),
                            "groupId" => "9",
                            "group_unsubscribe_dialog_text_confirm" => $group_unsubscribe_dialog_text_confirm,
                            "group_subscribe_dialog_text_confirm" => $group_subscribe_dialog_text_confirm,
                            "group_unsubscribe_dialog_text" => $group_unsubscribe_dialog_text,
                            "group_subscribe_dialog_text" => $group_subscribe_dialog_text,
                            "homeurl" => $homeurl,
                            "pwaapponlyenable" => "0",
                            "pwainstallheadertext" => $pwainstallheadertext,
                            "pwainstalltext" => $pwainstalltext,
                            "pwainstallbuttoncolor" => $pwainstallbuttoncolor,
                            "pwainstallbuttontextcolor" => $pwainstallbuttontextcolor,
                            "pwainstallbuttontext" => $pwainstallbuttontext,
                            "pwainstallpromptenabled" => $pwainstallpromptenabled,
                            "pwacustominstalltype" => $pwacustominstalltype,
                            "unsubscribe_dialog_text_confirm" => $unsubscribe_dialog_text_confirm,
                            "subscribe_dialog_text_confirm" => $subscribe_dialog_text_confirm,
                            "unsubscribe_button_text_shortcode" => $unsubscribe_button_text_shortcode,
                            "subscribe_button_text_shortcode" => $subscribe_button_text_shortcode,
                            "subscribe_button_text_color" => $subscribe_button_text_color,
                            "subscribe_button_color" => $subscribe_button_color,
                            "cancel_button_text" => $cancel_button_text,
                            "save_button_text" => $save_button_text,
                            "unsubscribe_button_text" => $unsubscribe_button_text,
                            "subscribe_button_text" => $subscribe_button_text,
                            "isloggedin" => is_user_logged_in(),
                            "pnfpb_push_prompt" => $pnfpb_push_prompt,
                            "userid" => get_current_user_id(),
                            "pnfpb_ic_fcm_popup_subscribe_message" => get_option(
                                "pnfpb_ic_fcm_popup_subscribe_message"
                            ),
                            "pnfpb_ic_fcm_popup_unsubscribe_message" => get_option(
                                "pnfpb_ic_fcm_popup_unsubscribe_message"
                            ),
                            "pnfpb_ic_fcm_popup_wait_message" => get_option(
                                "pnfpb_ic_fcm_popup_wait_message"
                            ),
                            "pnfpb_ic_fcm_custom_prompt_popup_wait_message" => get_option(
                                "pnfpb_ic_fcm_custom_prompt_popup_wait_message"
                            ),
                            "pnfpb_ic_fcm_custom_prompt_subscribed_text" => get_option(
                                "pnfpb_ic_fcm_custom_prompt_subscribed_text"
                            ),
                            "pnfpb_ic_fcm_custom_prompt_subscribe_text" => get_option(
                                "pnfpb_ic_fcm_custom_prompt_header_text"
                            ),
                            "pnfpb_ic_fcm_custom_prompt_subscribe_text_line_2" => get_option(
                                "pnfpb_ic_fcm_custom_prompt_header_text_line_2"
                            ),							
                            "pnfpb_ic_fcm_custom_prompt_confirmation_message_on_off" => get_option(
                                "pnfpb_custom_prompt_confirmation_message_on_off"
                            ),
                            "pnfpb_ic_fcm_popup_subscribe_button" => get_option(
                                "pnfpb_ic_fcm_popup_subscribe_button"
                            ),
                            "pnfpb_ic_fcm_popup_unsubscribe_button" => get_option(
                                "pnfpb_ic_fcm_popup_unsubscribe_button"
                            ),
                            "pwadesktopinstallpromptenabled" => $pwadesktopinstallpromptenabled,
                            "pwamobileinstallpromptenabled" => $pwamobileinstallpromptenabled,
                            "pwapixelsinstallpromptenabled" => $pwapixelsinstallpromptenabled,
                            "pwapixelsinputinstallpromptenabled" => $pwapixelsinputinstallpromptenabled,
                            "shortcode_close_button_text" => $shortcode_close_button_text,
                            "pnfpb_ic_fcm_prompt_style" => $pnfpb_ic_fcm_prompt_style,
                            "pnfpb_ic_fcm_prompt_on_off" => $pnfpb_ic_fcm_prompt_on_off,
                            "pnfpb_ic_fcm_prompt_style3" => $pnfpb_ic_fcm_prompt_style3,
                            "pnfpb_ic_fcm_custom_prompt_animation" => $pnfpb_ic_fcm_custom_prompt_animation,
                            "notify_loggedin" => $pnfpb_ic_fcm_loggedin_notify,
                            "pnfpb_custom_prompt_show_again_days" => $pnfpb_ic_fcm_custom_prompt_show_again_days,
                            "pnfpb_show_again_days" => $pnfpb_ic_fcm_pwa_show_again_days,
                            "pnfpb_hide_foreground_notification" => $pnfpb_hide_foreground_notification,
                            "pnfpb_show_custom_post_types" => $pnfpb_show_custom_post_types,
                            "pnfpb_show_push_notify_types" => $pnfpb_show_push_notify_types,
                            "pnfpb_front_end_settings_push_notify_types" => $pnfpb_front_end_settings_push_notify_types,
                            "pnfpb_progressier_app_option" => $pnfpb_progressier_app_option,
                        ]
                    );

                    $filename = "/public/js/pnfpb_pushscript_pwa.js";
                    wp_enqueue_script(
                        "pnfpb-mobile-app-interface-script",
                        plugins_url($filename, __FILE__),
                        ["jquery", "wp-i18n"],
                        "2.06.82",
                        true
                    );

                    $ajaxobject =
                        "pnfpb_ajax_object_mobile_app_interface_script";

                    wp_localize_script(
                        "pnfpb-mobile-app-interface-script",
                        $ajaxobject,
                        [
                            "ajax_url" => admin_url("admin-ajax.php"),
                            "userid" => get_current_user_id(),
                            "pnfpb_show_custom_post_types" => $pnfpb_show_custom_post_types,
                            "pnfpb_show_push_notify_types" => $pnfpb_show_push_notify_types,
                            "pnfpb_front_end_settings_push_notify_types" => $pnfpb_front_end_settings_push_notify_types,
                        ]
                    );
                } else {
                    if (
                        $pwaappenable === "1" &&
                        get_option(
                            "pnfpb_ic_disable_serviceworker_pwa_pushnotification"
                        ) != "1"
                    ) {
                        $pnfpb_push_prompt = get_option(
                            "pnfpb_ic_fcm_push_prompt_enable"
                        );

                        $filename = "/build/pnfpb_push_notification/index.js";

                        $ajaxobject = "pnfpb_ajax_object_push";

                        $pnfpb_ic_fcm_pwa_show_again_days = "7";

                        if (
                            get_option("pnfpb_ic_fcm_pwa_show_again_days") &&
                            get_option("pnfpb_ic_fcm_pwa_show_again_days") != ""
                        ) {
                            $pnfpb_ic_fcm_pwa_show_again_days = get_option(
                                "pnfpb_ic_fcm_pwa_show_again_days"
                            );
                        }

                        wp_enqueue_script(
                            "pnfpb-icajax-script-push",
                            plugins_url($filename, __FILE__),
                            ["jquery"],
                            "2.10.06",
                            true
                        );

                        wp_localize_script(
                            "pnfpb-icajax-script-push",
                            $ajaxobject,
                            [
                                "ajax_url" => admin_url("admin-ajax.php"),
                                "homeurl" => $homeurl,
                                "pwaapponlyenable" => $pwaappenable,
                                "pwainstallheadertext" => $pwainstallheadertext,
                                "pwainstalltext" => $pwainstalltext,
                                "pwainstallbuttoncolor" => $pwainstallbuttoncolor,
                                "pwainstallbuttontextcolor" => $pwainstallbuttontextcolor,
                                "pwainstallbuttontext" => $pwainstallbuttontext,
                                "pwacustominstalltype" => $pwacustominstalltype,
                                "pwainstallpromptenabled" => $pwainstallpromptenabled,
                                "pnfpb_push_prompt" => $pnfpb_push_prompt,
                                "pwadesktopinstallpromptenabled" => $pwadesktopinstallpromptenabled,
                                "pwamobileinstallpromptenabled" => $pwamobileinstallpromptenabled,
                                "pwapixelsinstallpromptenabled" => $pwapixelsinstallpromptenabled,
                                "pwapixelsinputinstallpromptenabled" => $pwapixelsinputinstallpromptenabled,
                                "pnfpb_ic_fcm_prompt_style" => $pnfpb_ic_fcm_prompt_style,
                                "pnfpb_show_again_days" => $pnfpb_ic_fcm_pwa_show_again_days,
                            ]
                        );
                    } else {
                        if (
                            get_option("pnfpb_ic_thirdparty_pwa_app_enable") ===
                                "1" &&
                            get_option(
                                "pnfpb_ic_disable_serviceworker_pwa_pushnotification"
                            ) != "1" &&
                            get_option("pnfpb_ic_pwa_thirdparty_app_id") &&
                            get_option("pnfpb_ic_pwa_thirdparty_app_id") != ""
                        ) {
                            wp_enqueue_script(
                                "progressier_pwa_app",
                                "https://progressier.app/" .
                                    get_option(
                                        "pnfpb_ic_pwa_thirdparty_app_id"
                                    ) .
                                    "/script.js",
                                [],
                                "1.0.1",
                                true
                            );
                        }
                    }
                }
            } else {
                if (get_option("pnfpb_onesignal_push") === "1") {
                    $filename = "/public/js/pnfpb_webtonative.js";

                    wp_enqueue_script(
                        "pwebtonative_app",
                        plugins_url($filename, __FILE__),
                        [],
                        "1.0.44",
                        true
                    );
                } else {
                    if (
                        get_option("pnfpb_ic_thirdparty_pwa_app_enable") ===
                            "1" &&
                        get_option(
                            "pnfpb_ic_disable_serviceworker_pwa_pushnotification"
                        ) != "1" &&
                        get_option("pnfpb_ic_pwa_thirdparty_app_id") &&
                        get_option("pnfpb_ic_pwa_thirdparty_app_id") != ""
                    ) {
                        wp_enqueue_script(
                            "progressier_pwa_app",
                            "https://progressier.app/" .
                                get_option("pnfpb_ic_pwa_thirdparty_app_id") .
                                "/script.js",
                            [],
                            "1.0.1",
                            true
                        );
                    }

                    if (
                        get_option("pnfpb_progressier_push") &&
                        get_option("pnfpb_progressier_push") === "1"
                    ) {
                        $pnfpb_push_prompt = get_option(
                            "pnfpb_ic_fcm_push_prompt_enable"
                        );
                        $pnfpb_progressier_on = get_option(
                            "pnfpb_progressier_push"
                        );

                        $filename =
                            "/public/js/pnfpb_pushscript_progressier_pwa.js";
                        $ajaxobject = "pnfpb_ajax_object_progressier_push";

                        wp_enqueue_script(
                            "pnfpb-icajax-progressier-script-push",
                            plugins_url($filename, __FILE__),
                            ["jquery", "wp-i18n"],
                            "1.99.1",
                            true
                        );

                        wp_localize_script(
                            "pnfpb-icajax-progressier-script-push",
                            $ajaxobject,
                            [
                                "ajax_url" => admin_url("admin-ajax.php"),
                                "userid" => get_current_user_id(),
                                "pnfpb_progressier_on" => $pnfpb_progressier_on,
                                "subscribe_button_text" => $subscribe_button_text,
                                "unsubscribe_button_text" => $unsubscribe_button_text,
                                "subscribe_button_text_color" => $subscribe_button_text_color,
                                "subscribe_button_color" => $subscribe_button_color,
                                "group_unsubscribe_dialog_text_confirm" => $group_unsubscribe_dialog_text_confirm,
                                "group_subscribe_dialog_text_confirm" => $group_subscribe_dialog_text_confirm,
                                "group_unsubscribe_dialog_text" => $group_unsubscribe_dialog_text,
                                "group_subscribe_dialog_text" => $group_subscribe_dialog_text,
                            ]
                        );
                    }
                }
            }

            if (
                get_option("pnfpb_webtoapp_push") &&
                get_option("pnfpb_webtoapp_push") === "1"
            ) {
                $filename = "/public/js/pnfpb_webtoapp_app-helper.js";

                wp_enqueue_script(
                    "pwebtoapp_app",
                    plugins_url($filename, __FILE__),
                    [],
                    "1.0.1",
                    true
                );

                $pnfpb_push_prompt = get_option(
                    "pnfpb_ic_fcm_push_prompt_enable"
                );
                $pnfpb_webtoapp_on = get_option("pnfpb_webtoapp_push");
                $filename = "/public/js/pnfpb_webtoapp_pwa.js";
                $ajaxobject = "pnfpb_ajax_object_webtoapp_push";

                wp_enqueue_script(
                    "pnfpb-icajax-webtoapp-script-push",
                    plugins_url($filename, __FILE__),
                    ["jquery", "wp-i18n"],
                    "1.99.11",
                    true
                );

                wp_localize_script(
                    "pnfpb-icajax-webtoapp-script-push",
                    $ajaxobject,
                    [
                        "ajax_url" => admin_url("admin-ajax.php"),
                        "userid" => get_current_user_id(),
                        "subscribe_button_text" => $subscribe_button_text,
                        "unsubscribe_button_text" => $unsubscribe_button_text,
                        "subscribe_button_text_color" => $subscribe_button_text_color,
                        "subscribe_button_color" => $subscribe_button_color,
                        "group_unsubscribe_dialog_text_confirm" => $group_unsubscribe_dialog_text_confirm,
                        "group_subscribe_dialog_text_confirm" => $group_subscribe_dialog_text_confirm,
                        "group_unsubscribe_dialog_text" => $group_unsubscribe_dialog_text,
                        "group_subscribe_dialog_text" => $group_subscribe_dialog_text,
                    ]
                );
            }
        }

        /**
         * Add pnfpbmanifest.json to header for PWA app
         * provided PWA conversion app option is ON
         * @since 1.20
         */
        // Creates the link tag
        public function PNFPB_include_manifest_link()
        {
            if (
                get_option("pnfpb_ic_thirdparty_pwa_app_enable") === "1" &&
                get_option(
                    "pnfpb_ic_disable_serviceworker_pwa_pushnotification"
                ) != "1" &&
                get_option("pnfpb_ic_pwa_thirdparty_app_id") &&
                get_option("pnfpb_ic_pwa_thirdparty_app_id") != ""
            ) {
                echo '<link rel="manifest" href="https://progressier.app/' .
                    esc_url(get_option("pnfpb_ic_pwa_thirdparty_app_id")) .
                    '/progressier.json">';
            } else {
                if (
                    get_option("pnfpb_ic_pwa_app_enable") === "1" &&
                    get_option(
                        "pnfpb_ic_disable_serviceworker_pwa_pushnotification"
                    ) != "1"
                ) {
                    echo '<link rel="manifest" href="' .
                        esc_url(get_home_url()) .
                        '/pnfpbmanifest.json">';

                    if (
                        get_option(
                            "pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value"
                        ) !== ""
                    ) {
                        echo '<link rel="apple-touch-startup-image" href="' .
                            esc_url(
                                get_option(
                                    "pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value"
                                )
                            ) .
                            '" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">';
                    } else {
                        if (get_option("pnfpb_ic_fcm_pwa_upload_icon_512")) {
                            echo '<link rel="apple-touch-startup-image" href="' .
                                esc_url(
                                    get_option(
                                        "pnfpb_ic_fcm_pwa_upload_icon_512"
                                    )
                                ) .
                                '" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">';
                        }
                    }

                    if (
                        get_option(
                            "pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value"
                        ) !== ""
                    ) {
                        echo '<link rel="apple-touch-startup-image" href="' .
                            esc_url(
                                get_option(
                                    "pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value"
                                )
                            ) .
                            '" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">';
                    } else {
                        if (get_option("pnfpb_ic_fcm_pwa_upload_icon_512")) {
                            echo '<link rel="apple-touch-startup-image" href="' .
                                esc_url(
                                    get_option(
                                        "pnfpb_ic_fcm_pwa_upload_icon_512"
                                    )
                                ) .
                                '" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">';
                        }
                    }

                    if (
                        get_option(
                            "pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value"
                        ) !== ""
                    ) {
                        echo '<link rel="apple-touch-startup-image" href="' .
                            esc_url(
                                get_option(
                                    "pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value"
                                )
                            ) .
                            '" media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">';
                    } else {
                        if (get_option("pnfpb_ic_fcm_pwa_upload_icon_512")) {
                            echo '<link rel="apple-touch-startup-image" href="' .
                                esc_url(
                                    get_option(
                                        "pnfpb_ic_fcm_pwa_upload_icon_512"
                                    )
                                ) .
                                '" media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">';
                        }
                    }

                    if (
                        get_option(
                            "pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_value"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_value"
                        ) !== ""
                    ) {
                        echo '<link rel="apple-touch-startup-image" href="' .
                            esc_url(
                                get_option(
                                    "pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_value"
                                )
                            ) .
                            '" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">';
                    } else {
                        if (get_option("pnfpb_ic_fcm_pwa_upload_icon_512")) {
                            echo '<link rel="apple-touch-startup-image" href="' .
                                esc_url(
                                    get_option(
                                        "pnfpb_ic_fcm_pwa_upload_icon_512"
                                    )
                                ) .
                                '" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">';
                        }
                    }

                    if (
                        get_option(
                            "pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_value"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_value"
                        ) !== ""
                    ) {
                        echo '<link rel="apple-touch-startup-image" href="' .
                            esc_url(
                                get_option(
                                    "pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_value"
                                )
                            ) .
                            '" media="(min-device-width: 768px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">';
                    } else {
                        if (get_option("pnfpb_ic_fcm_pwa_upload_icon_512")) {
                            echo '<link rel="apple-touch-startup-image" href="' .
                                esc_url(
                                    get_option(
                                        "pnfpb_ic_fcm_pwa_upload_icon_512"
                                    )
                                ) .
                                '" media="(min-device-width: 768px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">';
                        }
                    }

                    if (
                        get_option(
                            "pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_value"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_value"
                        ) !== ""
                    ) {
                        echo '<link rel="apple-touch-startup-image" href="' .
                            esc_url(
                                get_option(
                                    "pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_value"
                                )
                            ) .
                            '" media="(min-device-width: 834px) and (max-device-width: 834px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">';
                    } else {
                        if (get_option("pnfpb_ic_fcm_pwa_upload_icon_512")) {
                            echo '<link rel="apple-touch-startup-image" href="' .
                                esc_url(
                                    get_option(
                                        "pnfpb_ic_fcm_pwa_upload_icon_512"
                                    )
                                ) .
                                '" media="(min-device-width: 834px) and (max-device-width: 834px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">';
                        }
                    }

                    if (
                        get_option(
                            "pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_value"
                        ) &&
                        get_option(
                            "pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_value"
                        ) !== ""
                    ) {
                        echo '<link rel="apple-touch-startup-image" href="' .
                            esc_url(
                                get_option(
                                    "pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_value"
                                )
                            ) .
                            '" media="(min-device-width: 1024px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">';
                    } else {
                        if (get_option("pnfpb_ic_fcm_pwa_upload_icon_512")) {
                            echo '<link rel="apple-touch-startup-image" href="' .
                                esc_url(
                                    get_option(
                                        "pnfpb_ic_fcm_pwa_upload_icon_512"
                                    )
                                ) .
                                '" media="(min-device-width: 1024px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">';
                        }
                    }
                }
            }
        }

        public function PNFPB_custom_pwa_install_prompt()
        {
            $allowed_html = [
                "a" => [
                    "href" => [],
                    "title" => [],
                ],
                "input" => [
                    "class" => [],
                    "id" => [],
                    "name" => [],
                    "type" => [],
                    "value" => [],
					"pnfpb_index" => []
                ],
                "div" => [
                    "class" => [],
                    "label" => [
                        "class" => [
                            "span" => [
                                "class" => [],
                            ],
                            "input" => [
                                "class" => [],
                                "id" => [],
                                "name" => [],
                                "type" => [],
                                "value" => [],
								"pnfpb_index" => [],
                            ],
                        ],
                    ],
                    "span" => [
                        "class" => [],
                    ],
                    "input" => [
                        "class" => [],
                        "id" => [],
                        "name" => [],
                        "type" => [],
                        "value" => [],
						"pnfpb_index" => []
                    ],
                ],
                "label" => [
                    "class" => [
                        "span" => [
                            "class" => [],
                        ],
                        "input" => [
                            "class" => [],
                            "id" => [],
                            "name" => [],
                            "type" => [],
                            "value" => [],
							"pnfpb_index" => []
                        ],
                    ],
                ],
                "span" => [
                    "class" => [],
                ],
                "input" => [
                    "class" => [],
                    "id" => [],
                    "name" => [],
                    "type" => [],
                    "value" => [],
					"pnfpb_index" => [],
                ],
                "button" => [
                    "class" => [],
                    "id" => [],
                    "class" => [],
                    "type" => [],
                    "style" => [],
                ],
                "br" => [],
                "em" => [],
                "b" => [],
                "option" => [
                    "value" => [],
                    "selected" => [],
                ],
            ];

            if (
                get_option("pnfpb_onesignal_push") !== "1" &&
                get_option("pnfpb_progressier_push") !== "1"
            ) {
                if (
                    get_option("pnfpb_ic_fcm_push_prompt_text") &&
                    get_option("pnfpb_ic_fcm_push_prompt_text") != ""
                ) {
                    $pnfpb_push_prompt_text = get_option(
                        "pnfpb_ic_fcm_push_prompt_text"
                    );
                } else {
                    $pnfpb_push_prompt_text = esc_html(
                        __(
                            "Would you like to subscribe to our notifications?",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }
                if (
                    get_option("pnfpb_ic_fcm_push_prompt_confirm_button") &&
                    get_option("pnfpb_ic_fcm_push_prompt_confirm_button") != ""
                ) {
                    $pnfpb_push_prompt_confirm_button_text = get_option(
                        "pnfpb_ic_fcm_push_prompt_confirm_button"
                    );
                } else {
                    $pnfpb_push_prompt_confirm_button_text = esc_html(
                        __("Yes", "push-notification-for-post-and-buddypress")
                    );
                }
                if (
                    get_option("pnfpb_ic_fcm_push_prompt_cancel_button") &&
                    get_option("pnfpb_ic_fcm_push_prompt_cancel_button") != ""
                ) {
                    $pnfpb_push_prompt_cancel_button_text = get_option(
                        "pnfpb_ic_fcm_push_prompt_cancel_button"
                    );
                } else {
                    $pnfpb_push_prompt_cancel_button_text = esc_html(
                        __("No", "push-notification-for-post-and-buddypress")
                    );
                }
                if (
                    get_option("pnfpb_ic_fcm_push_prompt_button_background") &&
                    get_option("pnfpb_ic_fcm_push_prompt_button_background") !=
                        ""
                ) {
                    $pnfpb_push_prompt_button_background = get_option(
                        "pnfpb_ic_fcm_push_prompt_button_background"
                    );
                } else {
                    $pnfpb_push_prompt_button_background = "#121240";
                }
                if (
                    get_option("pnfpb_ic_fcm_push_prompt_dialog_background") &&
                    get_option("pnfpb_ic_fcm_push_prompt_dialog_background") !=
                        ""
                ) {
                    $pnfpb_push_prompt_dialog_background = get_option(
                        "pnfpb_ic_fcm_push_prompt_dialog_background"
                    );
                } else {
                    $pnfpb_push_prompt_dialog_background = "#DAD7D7";
                }
                if (
                    get_option("pnfpb_ic_fcm_push_prompt_text_color") &&
                    get_option("pnfpb_ic_fcm_push_prompt_text_color") != ""
                ) {
                    $pnfpb_push_prompt_text_color = get_option(
                        "pnfpb_ic_fcm_push_prompt_text_color"
                    );
                } else {
                    $pnfpb_push_prompt_text_color = "#161515";
                }
                if (
                    get_option("pnfpb_ic_fcm_push_prompt_button_text_color") &&
                    get_option("pnfpb_ic_fcm_push_prompt_button_text_color") !=
                        ""
                ) {
                    $pnfpb_push_prompt_button_text_color = get_option(
                        "pnfpb_ic_fcm_push_prompt_button_text_color"
                    );
                } else {
                    $pnfpb_push_prompt_button_text_color = "#ffffff";
                }
                if (
                    get_option("pnfpb_ic_fcm_push_prompt_position") &&
                    get_option("pnfpb_ic_fcm_push_prompt_position") != ""
                ) {
                    $pnfpb_push_prompt_position = get_option(
                        "pnfpb_ic_fcm_push_prompt_position"
                    );
                } else {
                    $pnfpb_push_prompt_position = esc_html(
                        __(
                            "pnfpb-top-left",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if (
                    get_option("pnfpb_ic_fcm_pwa_prompt_text") &&
                    get_option("pnfpb_ic_fcm_pwa_prompt_text") != ""
                ) {
                    $pnfpb_pwa_prompt_text = get_option(
                        "pnfpb_ic_fcm_pwa_prompt_text"
                    );
                } else {
                    $pnfpb_pwa_prompt_text = esc_html(
                        __(
                            "Would you like to install our app?",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }
                if (
                    get_option("pnfpb_ic_fcm_pwa_prompt_confirm_button") &&
                    get_option("pnfpb_ic_fcm_pwa_prompt_confirm_button") != ""
                ) {
                    $pnfpb_pwa_prompt_confirm_button_text = get_option(
                        "pnfpb_ic_fcm_pwa_prompt_confirm_button"
                    );
                } else {
                    $pnfpb_pwa_prompt_confirm_button_text = esc_html(
                        __(
                            "Install",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }
                if (
                    get_option("pnfpb_ic_fcm_pwa_prompt_cancel_button") &&
                    get_option("pnfpb_ic_fcm_pwa_prompt_cancel_button") != ""
                ) {
                    $pnfpb_pwa_prompt_cancel_button_text = get_option(
                        "pnfpb_ic_fcm_pwa_prompt_cancel_button"
                    );
                } else {
                    $pnfpb_pwa_prompt_cancel_button_text = esc_html(
                        __(
                            "Cancel",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }
                if (
                    get_option("pnfpb_ic_fcm_pwa_prompt_button_background") &&
                    get_option("pnfpb_ic_fcm_pwa_prompt_button_background") !=
                        ""
                ) {
                    $pnfpb_pwa_prompt_button_background = get_option(
                        "pnfpb_ic_fcm_pwa_prompt_button_background"
                    );
                } else {
                    $pnfpb_pwa_prompt_button_background = "#121240";
                }
                if (
                    get_option("pnfpb_ic_fcm_pwa_prompt_dialog_background") &&
                    get_option("pnfpb_ic_fcm_pwa_prompt_dialog_background") !=
                        ""
                ) {
                    $pnfpb_pwa_prompt_dialog_background = get_option(
                        "pnfpb_ic_fcm_pwa_prompt_dialog_background"
                    );
                } else {
                    $pnfpb_pwa_prompt_dialog_background = "#DAD7D7";
                }
                if (
                    get_option("pnfpb_ic_fcm_pwa_prompt_text_color") &&
                    get_option("pnfpb_ic_fcm_pwa_prompt_text_color") != ""
                ) {
                    $pnfpb_pwa_prompt_text_color = get_option(
                        "pnfpb_ic_fcm_pwa_prompt_text_color"
                    );
                } else {
                    $pnfpb_pwa_prompt_text_color = "#161515";
                }
                if (
                    get_option("pnfpb_ic_fcm_pwa_prompt_button_text_color") &&
                    get_option("pnfpb_ic_fcm_pwa_prompt_button_text_color") !=
                        ""
                ) {
                    $pnfpb_pwa_prompt_button_text_color = get_option(
                        "pnfpb_ic_fcm_pwa_prompt_button_text_color"
                    );
                } else {
                    $pnfpb_pwa_prompt_button_text_color = "#ffffff";
                }
                $pnfpb_popup_subscribe_icon = "";
                if (get_option("pnfpb_ic_fcm_popup_subscribe_button_icon")) {
                    $pnfpb_popup_subscribe_icon = get_option(
                        "pnfpb_ic_fcm_popup_subscribe_button_icon"
                    );
                } else {
                    $pnfpb_popup_subscribe_icon =
                        plugin_dir_url(__DIR__) .
                        "public/img/pushbell-pnfpb.png";
                }

                if (
                    get_option("pnfpb_ic_fcm_push_prompt_enable") === "1" &&
                    (!get_option("pnfpb_ic_fcm_loggedin_notify") ||
                        (get_option("pnfpb_ic_fcm_loggedin_notify") &&
                            get_option("pnfpb_ic_fcm_loggedin_notify") ===
                                "1" &&
                            is_user_logged_in()) ||
                        (get_option("pnfpb_ic_fcm_loggedin_notify") &&
                            get_option("pnfpb_ic_fcm_loggedin_notify") !== "1"))
                ) {
                    echo '<button type="button" id="pnfpb-push-subscribe-icon" class="pnfpb-push-subscribe-icon"><img src="' .
                        esc_url($pnfpb_popup_subscribe_icon) .
                        '" width="32px" height="32px"/></button>';

                    $pnfpb_ic_fcm_popup_header_text = esc_html(
                        __(
                            "Manage Push Notifications",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (get_option("pnfpb_ic_fcm_popup_header_text")) {
                        $pnfpb_ic_fcm_popup_header_text = get_option(
                            "pnfpb_ic_fcm_popup_header_text"
                        );
                    }

                    $pnfpb_ic_fcm_popup_subscribe_button_color = "#E54B4D";

                    if (
                        get_option("pnfpb_ic_fcm_popup_subscribe_button_color")
                    ) {
                        $pnfpb_ic_fcm_popup_subscribe_button_color = get_option(
                            "pnfpb_ic_fcm_popup_subscribe_button_color"
                        );
                    }

                    $pnfpb_ic_fcm_popup_subscribe_options_button_color =
                        "#CCCCCC";

                    if (
                        get_option(
                            "pnfpb_ic_fcm_popup_subscribe_options_button_color"
                        )
                    ) {
                        $pnfpb_ic_fcm_popup_subscribe_options_button_color = get_option(
                            "pnfpb_ic_fcm_popup_subscribe_options_button_color"
                        );
                    }

                    $pnfpb_ic_fcm_popup_subscribe_button_text_color = "#FFFFFF";

                    if (
                        get_option(
                            "pnfpb_ic_fcm_popup_subscribe_button_text_color"
                        )
                    ) {
                        $pnfpb_ic_fcm_popup_subscribe_button_text_color = get_option(
                            "pnfpb_ic_fcm_popup_subscribe_button_text_color"
                        );
                    }

                    $pnfpb_ic_fcm_popup_subscribe_options_button_text_color =
                        "#000000";

                    if (
                        get_option(
                            "pnfpb_ic_fcm_popup_subscribe_options_button_text_color"
                        )
                    ) {
                        $pnfpb_ic_fcm_popup_subscribe_options_button_text_color = get_option(
                            "pnfpb_ic_fcm_popup_subscribe_options_button_text_color"
                        );
                    }

                    $pnfpb_ic_fcm_popup_subscribe_options_button_text =
                        "Update";

                    if (
                        get_option(
                            "pnfpb_ic_fcm_popup_subscribe_options_button_text_color"
                        )
                    ) {
                        $pnfpb_ic_fcm_popup_subscribe_options_button_text = get_option(
                            "pnfpb_ic_fcm_popup_subscribe_options_button_text"
                        );
                    }

                    $pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon =
                        "#FFFFFF";

                    if (
                        get_option(
                            "pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon"
                        )
                    ) {
                        $pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon = get_option(
                            "pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon"
                        );
                    }

                    $pnfpb_ic_fcm_custom_prompt_header_text = esc_html(
                        __(
                            "We would like to show you notifications for the latest news and updates.",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
					
                    $pnfpb_ic_fcm_custom_prompt_header_text_line_2 = "";					

                    if (get_option("pnfpb_ic_fcm_custom_prompt_header_text")) {
                        $pnfpb_ic_fcm_custom_prompt_header_text = get_option(
                            "pnfpb_ic_fcm_custom_prompt_header_text"
                        );
                    }
					
                    if (get_option("pnfpb_ic_fcm_custom_prompt_header_text_line_2")) {
                        $pnfpb_ic_fcm_custom_prompt_header_text_line_2 = get_option(
                            "pnfpb_ic_fcm_custom_prompt_header_text_line_2"
                        );
                    }					

                    $pnfpb_ic_fcm_custom_prompt_allow_button_text = esc_html(
                        __("Allow", "push-notification-for-post-and-buddypress")
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_custom_prompt_allow_button_text"
                        )
                    ) {
                        $pnfpb_ic_fcm_custom_prompt_allow_button_text = get_option(
                            "pnfpb_ic_fcm_custom_prompt_allow_button_text"
                        );
                    }

                    $pnfpb_ic_fcm_custom_prompt_cancel_button_text = esc_html(
                        __(
                            "Cancel",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_custom_prompt_cancel_button_text"
                        )
                    ) {
                        $pnfpb_ic_fcm_custom_prompt_cancel_button_text = get_option(
                            "pnfpb_ic_fcm_custom_prompt_cancel_button_text"
                        );
                    }

                    $pnfpb_ic_fcm_custom_prompt_close_button_text = esc_html(
                        __("Close", "push-notification-for-post-and-buddypress")
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_custom_prompt_close_button_text"
                        )
                    ) {
                        $pnfpb_ic_fcm_custom_prompt_close_button_text = get_option(
                            "pnfpb_ic_fcm_custom_prompt_close_button_text"
                        );
                    }

                    $pnfpb_ic_fcm_custom_prompt_header_text_processing = esc_html(
                        __(
                            "Please wait...it is processing",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_custom_prompt_popup_wait_message"
                        )
                    ) {
                        $pnfpb_ic_fcm_custom_prompt_header_text_processing = get_option(
                            "pnfpb_ic_fcm_custom_prompt_popup_wait_message"
                        );
                    }

                    $pnfpb_ic_fcm_custom_prompt_subscribed_text = esc_html(
                        __(
                            "You are subscribed to notifications",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

                    if (
                        get_option("pnfpb_ic_fcm_custom_prompt_subscribed_text")
                    ) {
                        $pnfpb_ic_fcm_custom_prompt_subscribed_text = get_option(
                            "pnfpb_ic_fcm_custom_prompt_subscribed_text"
                        );
                    }

                    $pnfpb_ic_fcm_custom_prompt_animation = "slideDown";

                    if (get_option("pnfpb_ic_fcm_custom_prompt_animation")) {
                        $pnfpb_ic_fcm_custom_prompt_animation = get_option(
                            "pnfpb_ic_fcm_custom_prompt_animation"
                        );

                        if (
                            $pnfpb_ic_fcm_custom_prompt_animation !==
                                "slideDown" &&
                            $pnfpb_ic_fcm_custom_prompt_animation !== "slideUp"
                        ) {
                            $pnfpb_ic_fcm_custom_prompt_animation = "slideDown";
                        }
                    }

                    $pnfpb_bell_icon_subscription_option_update_text = "Update";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_update_text"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_update_text = get_option(
                            "pnfpb_bell_icon_subscription_option_update_text"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_update_text_color =
                        "#000000";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_update_text_color"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_update_text_color = get_option(
                            "pnfpb_bell_icon_subscription_option_update_text_color"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_update_background_color =
                        "#cccccc";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_update_background_color"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_update_background_color = get_option(
                            "pnfpb_bell_icon_subscription_option_update_background_color"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_list_background_color =
                        "#cccccc";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_list_background_color"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_list_background_color = get_option(
                            "pnfpb_bell_icon_subscription_option_list_background_color"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_list_text_color =
                        "#000000";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_list_text_color"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_list_text_color = get_option(
                            "pnfpb_bell_icon_subscription_option_list_text_color"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_list_checkbox_color =
                        "#135e96";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_list_checkbox_color"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_list_checkbox_color = get_option(
                            "pnfpb_bell_icon_subscription_option_list_checkbox_color"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_update_confirmation_message =
                        "subscription updated";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_update_confirmation_message"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_update_confirmation_message = get_option(
                            "pnfpb_bell_icon_subscription_option_update_confirmation_message"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_update_text = "Update";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_update_text"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_update_text = get_option(
                            "pnfpb_bell_icon_subscription_option_update_text"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_all_text = "All";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_all_text"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_all_text = get_option(
                            "pnfpb_bell_icon_subscription_option_all_text"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_post_text = "Post";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_post_text"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_post_text = get_option(
                            "pnfpb_bell_icon_subscription_option_post_text"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_activity_text =
                        "Activity";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_activity_text"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_activity_text = get_option(
                            "pnfpb_bell_icon_subscription_option_activity_text"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_all_comments_text =
                        "All comments";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_all_comments_text"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_all_comments_text = get_option(
                            "pnfpb_bell_icon_subscription_option_all_comments_text"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_my_comments_text =
                        "My comments";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_my_comments_text"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_my_comments_text = get_option(
                            "pnfpb_bell_icon_subscription_option_my_comments_text"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_private_message_text =
                        "Private Message";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_private_messsage_text"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_private_message_text = get_option(
                            "pnfpb_bell_icon_subscription_option_private_message_text"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_new_member_joined_text =
                        "New member joined";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_new_member_joined_text"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_new_member_joined_text = get_option(
                            "pnfpb_bell_icon_subscription_option_new_member_joined_text"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_friendship_request_text =
                        "Friendship request";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_friendship_request_text"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_friendship_request_text = get_option(
                            "pnfpb_bell_icon_subscription_option_friendship_request_text"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_friendship_accepted_text =
                        "Friendship accepted";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_friendship_accepted_text"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_friendship_accepted_text = get_option(
                            "pnfpb_bell_icon_subscription_option_friendship_accepted_text"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_avatar_change_text =
                        "Avatar change";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_avatar_change_text"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_avatar_change_text = get_option(
                            "pnfpb_bell_icon_subscription_option_avatar_change_text"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_cover_image_change_text =
                        "Cover image change";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_cover_image_change_text"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_cover_image_change_text = get_option(
                            "pnfpb_bell_icon_subscription_option_cover_image_change_text"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_group_details_update_text =
                        "Group details update";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_group_details_update_text"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_group_details_update_text = get_option(
                            "pnfpb_bell_icon_subscription_option_group_details_update_text"
                        );
                    }

                    $pnfpb_bell_icon_subscription_option_group_invite_text =
                        "Group invite";

                    if (
                        get_option(
                            "pnfpb_bell_icon_subscription_option_group_invite_text"
                        )
                    ) {
                        $pnfpb_bell_icon_subscription_option_group_invite_text = get_option(
                            "pnfpb_bell_icon_subscription_option_group_invite_text"
                        );
                    }

                    $pnfpb_custom_prompt_options_on_off = "0";

                    if (get_option("pnfpb_custom_prompt_options_on_off")) {
                        $pnfpb_custom_prompt_options_on_off = get_option(
                            "pnfpb_custom_prompt_options_on_off"
                        );
                    }

                    $pnfpb_bell_icon_prompt_options_on_off = "1";

                    if (
                        get_option(
                            "pnfpb_bell_icon_prompt_options_on_off",
                            "0"
                        ) != "0"
                    ) {
                        $pnfpb_bell_icon_prompt_options_on_off = get_option(
                            "pnfpb_bell_icon_prompt_options_on_off"
                        );
                    }

                    $args = [
                        "public" => true,
                        "_builtin" => false,
                    ];

                    $output = "names"; // or objects
                    $operator = "and"; // 'and' or 'or'
                    $custposttypes = get_post_types($args, $output, $operator);

                    $frontend_post_push_enable = false;

                    $pnfpb_html_subscription_custom_post_options = "";

                    $pnfpb_html_subscription_post_options = "";

                    $pnfpb_html_bellicon_subscription_post_options = "";

                    $pnfpb_html_subscription_push_type_options = "";

                    $pnfpb_html_bellicon_subscription_custom_post_options = "";

                    $pnfpb_html_subscription_activity_options = "";

                    $pnfpb_html_bellicon_subscription_activity_options = "";

                    $pnfpb_push_count = 14;

                    foreach ($custposttypes as $post_type) {
                        if (
                            get_option(
                                "pnfpb_ic_fcm_" . $post_type . "_enable"
                            ) === "1" &&
                            $post_type !== "post" &&
                            $post_type !== "buddypress"
                        ) {
                            if (
                                get_option(
                                    "pnfpb_ic_fcm_show_allposttype_subscriptions_custom_prompt"
                                ) === "1"
                            ) {
                                $pnfpb_ic_fcm_bell_subscription_default_label = ucwords(
                                    $post_type
                                );

                                if (
                                    get_option(
                                        "pnfpb_bell_icon_subscription_option_" .
                                            $post_type .
                                            "_text"
                                    )
                                ) {
                                    $pnfpb_ic_fcm_bell_subscription_default_label = get_option(
                                        "pnfpb_bell_icon_subscription_option_" .
                                            $post_type .
                                            "_text"
                                    );
                                }

                                $pnfpb_html_subscription_custom_post_options .=
                                    '<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox 
											pnfpb_flex_grow_6 pnfpb_max_width_236" 
											for="' .esc_html("pnfpb_bell_icon_subscription_".$post_type."_enable") .
                                    	'">' .
                                    		esc_html(
                                        		$pnfpb_ic_fcm_bell_subscription_default_label
                                    		) .
                                    	'	
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="' .
                                    			esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
                                    			'" class="' .
                                    			esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
                                    			'" name="' .
                                    			esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
                                    			'" pnfpb_index="' .
                                    			esc_attr($pnfpb_push_count) .
                                    			'" type="checkbox" value="1"
											/> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';

                                	$pnfpb_html_bellicon_subscription_custom_post_options .=
                                    	'<div class="pnfpb_card">				
											<label class="pnfpb_ic_push_settings_table_label_checkbox 
												pnfpb_flex_grow_6 pnfpb_max_width_236" 
												for="' .
                                    				esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
                                    		'">' .
                                    			esc_html(
                                        			$pnfpb_ic_fcm_bell_subscription_default_label
                                    			) .'
											</label>
											<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
												<input id="' .
                                    				esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
                                    				'" class="' .
                                    				esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
                                    				'" name="' .
                                    				esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
                                    				'" pnfpb_index="' .
                                    				esc_attr($pnfpb_push_count) .
                                    				'" type="checkbox" value="1"
												/> 
												<span class="pnfpb_slider round"></span>
											</label>
										</div>';
                            }
                        }
                        $pnfpb_push_count++;
                    }

                    if (get_option("pnfpb_ic_fcm_post_enable") === "1") {
                        $post_type = "post";

                        $pnfpb_html_subscription_post_options .=
                            '<div class="pnfpb_card">				
								<label class="pnfpb_ic_push_settings_table_label_checkbox 
									pnfpb_flex_grow_6 pnfpb_max_width_236" 
									for="' .
                            			esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
                            		'">' .
                            			esc_html(
                                			$pnfpb_bell_icon_subscription_option_post_text
                            			) .
                            		'
								</label>
								<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
									<input id="' .
                            			esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
                            			'" class="' .
                            			esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
                            			'" name="'.
                            			esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
                            			'" pnfpb_index="1" type="checkbox" value="1" 
									/> 
									<span class="pnfpb_slider round"></span>
								</label>
							</div>';

                        $pnfpb_html_bellicon_subscription_post_options .=
                            '<div class="pnfpb_card">				
								<label class="pnfpb_ic_push_settings_table_label_checkbox 
										pnfpb_flex_grow_6 pnfpb_max_width_236" 
										for="' .
                            				esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
                            	'">' .
                            		esc_html(
                                		$pnfpb_bell_icon_subscription_option_post_text
                            		) .
                            	'
								</label>
								<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
									<input id="' .
                            			esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
                            			'" class="'.
                            			esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
                            			'" name="' .
                            			esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
                            			'"  pnfpb_index="1" type="checkbox" value="1"
									/> 
									<span class="pnfpb_slider round"></span>
								</label>
							</div>';
                    }

                    if (get_option("pnfpb_ic_fcm_bactivity_enable") === "1") {
                        $post_type = "activity";

                        $pnfpb_html_subscription_activity_options .=
                            '<div class="pnfpb_card">				
								<label class="pnfpb_ic_push_settings_table_label_checkbox 
										pnfpb_flex_grow_6 pnfpb_max_width_236" 
										for="' .
                            				esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
                            	'		">' .
                            				esc_html(
                                			$pnfpb_bell_icon_subscription_option_activity_text
                            			) .'
								</label>
								<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
									<input id="' .
                            			esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
                            			'" class="' .
                            			esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
                            			'" name="' .
                            			esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
                            			'" pnfpb_index="11" type="checkbox" value="1"
									/> 
									<span class="pnfpb_slider round"></span>
								</label>
							</div>';

                        $pnfpb_html_bellicon_subscription_activity_options .=
                            '<div class="pnfpb_card">				
								<label class="pnfpb_ic_push_settings_table_label_checkbox 
									pnfpb_flex_grow_6 pnfpb_max_width_236" 
									for="' .esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
                            	'">' .
										esc_html($pnfpb_bell_icon_subscription_option_activity_text) .'
								</label>
								<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
									<input id="' .
                            			esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
                            			'" class="' .
                            			esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
                            			'" name="' .
                            			esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
                            			'"  pnfpb_index="11" type="checkbox" value="1"
									/> 
									<span class="pnfpb_slider round"></span>
								</label>
							</div>';
                    }

                    $pnfpb_html_subscription_options = "";

                    $pnfpb_html_subscription_options_header = "";

                    $pnfpb_html_subscription_options_header =
                        '<div class="pnfpb_bell_icon_subscription_options_container" 
								style="background:' .
                        				esc_attr(
                            				$pnfpb_bell_icon_subscription_option_list_background_color
                        				) .
                        				";color:" .
                        				esc_attr(
                            				$pnfpb_bell_icon_subscription_option_list_text_color
                        				) .
                        ';">
						<div class="pnfpb_card">				
							<label class="pnfpb_ic_push_settings_table_label_checkbox 
								pnfpb_flex_grow_6 pnfpb_max_width_236" 
								for="pnfpb_bell_icon_subscription_all_enable">' .
                        		esc_html(
                            		$pnfpb_bell_icon_subscription_option_all_text
                        		) .'
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
								<input id="pnfpb_bell_icon_subscription_all_enable" 
									class="pnfpb_bell_icon_subscription_all_enable" 
									name="pnfpb_bell_icon_subscription_all_enable" 
									type="checkbox" pnfpb_index="0" value="1"
								> 
								<span class="pnfpb_slider round"></span>
							</label>
						</div>';

                    $pnfpb_show_push_notify_admin_types = [
                        "",
                        "post",
                        "bcomment",
                        "bcomment",
                        "bprivatemessage",
                        "new_member",
                        "friendship_request",
                        "friendship_accept",
                        "unsubscribe-all",
                        "avatar_change",
                        "cover_image_change",
                        "bactivity",
                        "group_details_updated",
                        "group_invitation",
                    ];

                    $pnfpb_show_push_notify_types = [
                        "all",
                        "post",
                        "all_comments",
                        "my_comments",
                        "private_message",
                        "new_member",
                        "friendship_request",
                        "friendship_accepted",
                        "unsubscribe-all",
                        "avatar_change",
                        "cover_image_change",
                        "activity",
                        "group_details_update",
                        "group_invite",
                    ];

                    $pnfpb_push_admin_type_count = 0;

                    $pnfpb_push_type_index = 0;

                    foreach ($pnfpb_show_push_notify_types as $push_type) {
                        if ($push_type === "all") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "All",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "activity") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Activities",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "all_comments") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Comments in Activity/Post",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "my_comments") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Comments in My Activity/My Post",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "private_message") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "New private message",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "new_member") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "New member joined",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "friendship_request") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Friendship request",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "friendship_accepted") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Friendship accepted",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "avatar_change") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Avatar change",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "cover_image_change") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Cover image change",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "group_details_update") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Group details update",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "group_invite") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Group Invites",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if (
                            $push_type !== "all" &&
                            $push_type !== "post" &&
                            $push_type !== "activity" &&
                            $push_type !== "unsubscribe-all" &&
                            $push_type !== "buddypress" &&
                            get_option(
                                "pnfpb_ic_fcm_" .
                                    $pnfpb_show_push_notify_admin_types[
                                        $pnfpb_push_admin_type_count
                                    ] .
                                    "_enable"
                            ) === "1"
                        ) {
                            $pnfpb_ic_fcm_bell_subscription_default_label = $pnfpb_ic_fcm_front_enable_default_label;

                            if (
                                get_option(
                                    "pnfpb_bell_icon_subscription_option_" .
                                        $push_type .
                                        "_text"
                                )
                            ) {
                                $pnfpb_ic_fcm_bell_subscription_default_label = get_option(
                                    "pnfpb_bell_icon_subscription_option_" .
                                        $push_type .
                                        "_text"
                                );
                            }

                            $pnfpb_html_subscription_push_type_options .=
                                '<div class="pnfpb_card">				
									<label class="pnfpb_ic_push_settings_table_label_checkbox 
											pnfpb_flex_grow_6 pnfpb_max_width_236" 
											for="'.esc_attr("pnfpb_bell_icon_subscription_".$push_type."_enable") .'">' .
                                			esc_html(
                                    			$pnfpb_ic_fcm_bell_subscription_default_label
                                			) .'
									</label>
									<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
										<input id="' .
                                			esc_attr("pnfpb_bell_icon_subscription_".$push_type."_enable") .
                                			'" class="' .
                                			esc_attr("pnfpb_bell_icon_subscription_".$push_type."_enable") .
                                			'" name="' .
                                			esc_attr("pnfpb_bell_icon_subscription_".$push_type."_enable") .
                                			'" pnfpb_index="' .
                                			esc_attr($pnfpb_push_type_index) .
                                			'" type="checkbox" value="1"
										/> 
										<span class="pnfpb_slider round"></span>
									</label>
								</div>';
                        }

                        $pnfpb_push_admin_type_count++;
                        $pnfpb_push_type_index++;
                    }

                    $pnfpb_html_subscription_footer_options =
                        '<button type="button" class="pnfpb-push-subscribe-options-button" 
									id="pnfpb-push-subscribe-options-button" 
									style="background:' .
                        				esc_attr(
                            				$pnfpb_bell_icon_subscription_option_update_background_color
                        				) .
                        				";color:" .
                       					 esc_attr(
                            				$pnfpb_bell_icon_subscription_option_update_text_color
                        				) .
                        				';">
										' .
                        				esc_html(
                            				$pnfpb_bell_icon_subscription_option_update_text
                        				) .
                        "</button>";

                    $pnfpb_html_bellicon_subscription_options = "";

                    $pnfpb_html_bellicon_subscription_push_type_options = "";

                    $pnfpb_html_bellicon_subscription_options_header = "";

                    $pnfpb_html_bellicon_subscription_options_header =
                        '<div class="pnfpb_bell_icon_prompt_subscription_options_container" 
							style="background:' .
                        		esc_attr(
                            		$pnfpb_bell_icon_subscription_option_list_background_color
                        		) .
                        		";color:" .
                        		esc_attr(
                            		$pnfpb_bell_icon_subscription_option_list_text_color
                        		) .
                        		';">
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox 
											pnfpb_flex_grow_6 pnfpb_max_width_236" 
											for="pnfpb_bell_icon_subscription_all_enable">
											' .
                        						esc_html(
                            						$pnfpb_bell_icon_subscription_option_all_text
                        						) .
                        					'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_prompt_subscription_all_enable" class="pnfpb_bell_icon_prompt_subscription_all_enable" name="pnfpb_bell_icon_prompt_subscription_all_enable" type="checkbox" pnfpb_index="0" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';

                    $pnfpb_show_push_notify_admin_types = [
                        "",
                        "post",
                        "bcomment",
                        "bcomment",
                        "bprivatemessage",
                        "new_member",
                        "friendship_request",
                        "friendship_accept",
                        "unsubscribe-all",
                        "avatar_change",
                        "cover_image_change",
                        "bactivity",
                        "group_details_updated",
                        "group_invitation",
                    ];

                    $pnfpb_show_push_notify_types = [
                        "all",
                        "post",
                        "all_comments",
                        "my_comments",
                        "private_message",
                        "new_member",
                        "friendship_request",
                        "friendship_accepted",
                        "unsubscribe-all",
                        "avatar_change",
                        "cover_image_change",
                        "activity",
                        "group_details_update",
                        "group_invite",
                    ];

                    $pnfpb_push_admin_type_count = 0;

                    foreach ($pnfpb_show_push_notify_types as $push_type) {
                        if ($push_type === "all") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "All",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "activity") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Activities",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "all_comments") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Comments in Activity/Post",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "my_comments") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Comments in My Activity/My Post",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "private_message") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "New private message",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "new_member") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "New member joined",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "friendship_request") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Friendship request",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "friendship_accepted") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Friendship accepted",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "avatar_change") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Avatar change",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "cover_image_change") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Cover image change",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "group_details_update") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Group details update",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "group_invite") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Group Invites",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if (
                            $push_type !== "all" &&
                            $push_type !== "post" &&
                            $push_type !== "buddypress" &&
                            $push_type !== "activity" &&
                            $push_type !== "unsubscribe-all" &&
                            get_option(
                                "pnfpb_ic_fcm_" .
                                    $pnfpb_show_push_notify_admin_types[
                                        $pnfpb_push_admin_type_count
                                    ] .
                                    "_enable"
                            ) === "1"
                        ) {
                            $pnfpb_ic_fcm_bell_subscription_default_label = $pnfpb_ic_fcm_front_enable_default_label;

                            if (
                                get_option(
                                    "pnfpb_bell_icon_subscription_option_" .
                                        $push_type .
                                        "_text"
                                )
                            ) {
                                $pnfpb_ic_fcm_bell_subscription_default_label = get_option(
                                    "pnfpb_bell_icon_subscription_option_" .
                                        $push_type .
                                        "_text"
                                );
                            }

                            $pnfpb_html_bellicon_subscription_push_type_options .=
                                '<div class="pnfpb_card">				
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" 
									for="' .
                                		esc_attr("pnfpb_bell_icon_prompt_subscription_".$push_type."_enable") .
                                '">' .
                                		esc_html(
                                    		$pnfpb_ic_fcm_bell_subscription_default_label
                                		) .
                                '
								</label>
								<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
									<input id="' .
                                		esc_attr("pnfpb_bell_icon_prompt_subscription_".$push_type."_enable") .
                                		'" class="' .
                                		esc_attr("pnfpb_bell_icon_prompt_subscription_".$push_type."_enable") .
                                		'" name="' .
                                		esc_attr("pnfpb_bell_icon_prompt_subscription_".$push_type."_enable") .
                                		'_enable" pnfpb_index="' .
                                		esc_attr($pnfpb_push_admin_type_count) .
                                		'" type="checkbox" value="1"
									/> 
									<span class="pnfpb_slider round"></span>
								</label>
							</div>';
                        }
                        $pnfpb_push_admin_type_count++;
                    }

                    $pnfpb_html_bellicon_subscription_footer_options =
                        '								
								<button type="button" class="pnfpb-push-subscribe-options-button" 
										id="pnfpb-push-subscribe-options-button" 
										style="background:' .
                        						esc_attr(
                            						$pnfpb_bell_icon_subscription_option_update_background_color
                        						) .
                        						";color:" .
                        						esc_attr(
                            						$pnfpb_bell_icon_subscription_option_update_text_color
                        						) .
                        		';">' .
                        			esc_attr(
                            			$pnfpb_bell_icon_subscription_option_update_text
                        			) .
                        	"</button>";

                    $pnfpb_html_subscription_options = "";

                    if ($pnfpb_custom_prompt_options_on_off === "1") {
                        $pnfpb_html_subscription_options =
                            $pnfpb_html_subscription_options_header .
                            $pnfpb_html_subscription_post_options .
                            $pnfpb_html_subscription_custom_post_options .
                            $pnfpb_html_subscription_activity_options .
                            $pnfpb_html_subscription_push_type_options .
                            "</div>" .
                            $pnfpb_html_subscription_footer_options;
                    }

                    $pnfpb_html_bellicon_subscription_options = "";

                    if ($pnfpb_bell_icon_prompt_options_on_off === "1") {
                        $pnfpb_html_bellicon_subscription_options =
                            $pnfpb_html_bellicon_subscription_options_header .
                            $pnfpb_html_bellicon_subscription_post_options .
                            $pnfpb_html_bellicon_subscription_custom_post_options .
                            $pnfpb_html_bellicon_subscription_activity_options .
                            $pnfpb_html_bellicon_subscription_push_type_options .
                            "</div>" .
                            $pnfpb_html_bellicon_subscription_footer_options;
                    }

                    echo '<div id="pnfpb-push-status-text" class="pnfpb-push-status-text"></div>
						<div id="pnfpb-push-subscribe-button-layout" class="pnfpb-push-subscribe-button-layout">
							<p class="pnfpb-bell-icon-header">' .
                        		esc_html($pnfpb_ic_fcm_popup_header_text) .
                        	'</p>
							<div class="pnfpb_bell_icon_custom_prompt_loader" id="pnfpb_bell_icon_custom_prompt_loader"></div>
							<div id="pnfpb-push-subscribe-options-button-container" class="pnfpb-push-subscribe-options-button-container">
								' .
                        	wp_kses(
                            	$pnfpb_html_bellicon_subscription_options,
                            	$allowed_html
                        	) .
                        	'							
							</div>					
							<div class="pnfpb-push-msg-container">
								<div class="pnfpb-push-icon"><img src="' .
                       		 		esc_url(get_option("pnfpb_ic_fcm_upload_icon")) .
                        		'" /></div>
								<div class="pnfpb-push-msg-text-layout">
									<div class="pnfpb-push-msg-text-line"></div>
									<div class="pnfpb-push-msg-text-long-line"></div>
									<div class="pnfpb-push-msg-text-line"></div>
									<div class="pnfpb-push-msg-text-long-line"></div>
									<div class="pnfpb-push-msg-text-line"></div>
								</div>
							</div>						
							<div id="pnfpb-push-subscribe-button-container" class="pnfpb-push-subscribe-button-container">
								<button type="button" class="pnfpb-push-subscribe-button" 
									id="pnfpb-push-subscribe-button" 
									style="background:' .
                        				esc_attr($pnfpb_ic_fcm_popup_subscribe_button_color) .
                        			";color:" .
                        				esc_attr(
                            				$pnfpb_ic_fcm_popup_subscribe_button_text_color
                        				) .
                        		';">
								</button>
							</div>
						</div>';
					
                    echo '<div id="pnfpb-popup-customprompt-container" class="pnfpb-popup-customprompt-container">
							<div id="' .
                        		esc_attr("pnfpb-popup-customprompt-container-dialog-".$pnfpb_ic_fcm_custom_prompt_animation) .
                        		'" class="' .
                        		esc_attr("pnfpb-popup-customprompt-container-dialog-".$pnfpb_ic_fcm_custom_prompt_animation) .
                        	'">
							<div id="pnfpb-popup-customprompt-transistion" class="pnfpb-popup-customprompt-transistion">
								<div class="pnfpb-popup-customprompt-transistion-body" id="pnfpb-popup-customprompt-transistion-body">
									<div class="pnfpb-popup-customprompt-transistion-body-icon">
										<img alt="notification icon" src="' .
                        					esc_url(
                            					$pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon
                        					) .
                        				'">
									</div>';
					
					if ($pnfpb_ic_fcm_custom_prompt_header_text_line_2 !== '') {
						echo '<div class="pnfpb-popup-customprompt-transistion-body-line-1 pnfpb-popup-customprompt-transistion-body-message">' .
                        		esc_html($pnfpb_ic_fcm_custom_prompt_header_text) .
							'</div> <div class="pnfpb-popup-customprompt-transistion-body-line-2 pnfpb-popup-customprompt-transistion-body-message">' .
								esc_html($pnfpb_ic_fcm_custom_prompt_header_text_line_2) .
                        	'</div>';
					} else {
						echo '<div class="pnfpb-popup-customprompt-transistion-body-message">' .
                        		esc_html($pnfpb_ic_fcm_custom_prompt_header_text) .
                        	'</div>';
					}
					
					echo wp_kses($pnfpb_html_subscription_options,$allowed_html) .
                        		'								
									<div class="clearfix"></div>
									<div id="pnfpb-loading-container"></div>
								</div>
								<div class="pnfpb-popup-customprompt-transistion-footer" id="pnfpb-popup-customprompt-transistion-footer">
									<button class="pnfpb-popup-customprompt-transistion-allow-button" id="pnfpb-popup-customprompt-transistion-allow-button">' .
                        				esc_html(
                            				$pnfpb_ic_fcm_custom_prompt_allow_button_text
                        				) .
                        			'</button>
									<button class="pnfpb-popup-customprompt-transistion-cancel-button" id="pnfpb-popup-customprompt-transistion-cancel-button">' .
                        				esc_html(
                            				$pnfpb_ic_fcm_custom_prompt_cancel_button_text
                        				) .
                        			'</button>
									<div class="pnfpb_custom_prompt_loader" id="pnfpb_custom_prompt_loader"></div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div id="pnfpb-popup-customprompt-transistion-confirmation" class="pnfpb-popup-customprompt-transistion-confirmation">
								<div class="pnfpb-popup-customprompt-transistion-body" id="pnfpb-popup-customprompt-transistion-body">
									<div class="pnfpb-popup-customprompt-transistion-body-icon">
										<img alt="notification icon" src="' .
                        					esc_url(
                            					$pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon
                        					) .
                        				'">
									</div>
									<div class="pnfpb-popup-customprompt-transistion-body-message">' .
                        				esc_html($pnfpb_ic_fcm_custom_prompt_subscribed_text) .
                        			'</div>
									<div class="clearfix"></div>
									<div id="pnfpb-loading-container"></div>
								</div>
								<div class="pnfpb-popup-customprompt-transistion-footer" id="pnfpb-popup-customprompt-transistion-footer">
									<button class="pnfpb-popup-customprompt-transistion-close-button" id="pnfpb-popup-customprompt-transistion-close-button">' .
                        				esc_html(
                            				$pnfpb_ic_fcm_custom_prompt_close_button_text
                        				) .
                        			'</button>
									<div class="clearfix"></div>
								</div>
							</div>							
						</div>
					</div>';

                    echo '<div id="pnfpb-popup-customprompt-vertical-container" class="pnfpb-popup-customprompt-vertical-container">
							<div id="pnfpb-popup-customprompt-vertical-container-dialog-' .
                        		esc_attr($pnfpb_ic_fcm_custom_prompt_animation) .
                        		'" class="pnfpb-popup-customprompt-vertical-container-dialog-' .
                        		esc_attr($pnfpb_ic_fcm_custom_prompt_animation) .
                        	'">
								<div id="pnfpb-popup-customprompt-vertical-transistion" class="pnfpb-popup-customprompt-vertical-transistion">
									<div class="pnfpb-popup-customprompt-vertical-transistion-body" id="pnfpb-popup-customprompt-vertical-transistion-body">
										<div class="pnfpb-popup-customprompt-vertical-transistion-body-icon">
											<img alt="notification icon" src="' .
                        						esc_url(
                            						$pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon
                        						) .
                        					'">
									</div>';
					if ($pnfpb_ic_fcm_custom_prompt_header_text_line_2 !== '') {
						echo '<div class="pnfpb-popup-customprompt-vertical-transistion-body-line-1 pnfpb-popup-customprompt-vertical-transistion-body-message">' .
                        				esc_html($pnfpb_ic_fcm_custom_prompt_header_text) .
							'</div> <div class="pnfpb-popup-customprompt-vertical-transistion-body-line-2 pnfpb-popup-customprompt-vertical-transistion-body-message">' .
										esc_html($pnfpb_ic_fcm_custom_prompt_header_text_line_2) .
                        	'</div>';
					} else {
						echo '<div class="pnfpb-popup-customprompt-vertical-transistion-body-message">' .
                        				esc_html($pnfpb_ic_fcm_custom_prompt_header_text) .
                        	'</div>';
					}					
					echo wp_kses($pnfpb_html_subscription_options,$allowed_html) .
                       		 	'	
									<div class="clearfix"></div>
									<div id="pnfpb-loading-container"></div>
								</div>
								<div class="pnfpb-popup-customprompt-vertical-transistion-footer" id="pnfpb-popup-customprompt-vertical-transistion-footer">
									<button class="pnfpb-popup-customprompt-vertical-transistion-allow-button" 
											id="pnfpb-popup-customprompt-vertical-transistion-allow-button">' .
                        						esc_html(
                            						$pnfpb_ic_fcm_custom_prompt_allow_button_text
                        						) .
                        			'</button>
									<button class="pnfpb-popup-customprompt-vertical-transistion-cancel-button" 
											id="pnfpb-popup-customprompt-vertical-transistion-cancel-button">' .
                        				esc_html(
                            				$pnfpb_ic_fcm_custom_prompt_cancel_button_text
                        				) .
                        			'</button>
									<div class="pnfpb_custom_prompt_loader" id="pnfpb_custom_prompt_loader"></div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div id="pnfpb-popup-customprompt-vertical-transistion-confirmation" class="pnfpb-popup-customprompt-vertical-transistion-confirmation">
								<div class="pnfpb-popup-customprompt-vertical-transistion-body" id="pnfpb-popup-customprompt-vertical-transistion-body">
									<div class="pnfpb-popup-customprompt-vertical-transistion-body-icon">
										<img alt="notification icon" src="' .
                        					esc_url(
                            					$pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon
                        					) .
                        				'">
									</div>
									<div class="pnfpb-popup-customprompt-vertical-transistion-body-message">' .
                        				esc_html($pnfpb_ic_fcm_custom_prompt_subscribed_text) .
                        			'</div>
									<div class="clearfix"></div>
									<div id="pnfpb-loading-container"></div>
								</div>
								<div class="pnfpb-popup-customprompt-vertical-transistion-footer" id="pnfpb-popup-customprompt-vertical-transistion-footer">
									<button class="pnfpb-popup-customprompt-vertical-transistion-close-button" 
											id="pnfpb-popup-customprompt-vertical-transistion-close-button">' .
                        						esc_html(
                            						$pnfpb_ic_fcm_custom_prompt_close_button_text
                        						) .
                        			'</button>
									<div class="clearfix"></div>
								</div>
							</div>							
						</div>
					</div>';
                }

                if (
                    get_option("pnfpb_ic_pwa_app_enable") === "1" &&
                    (get_option("pnfpb_ic_pwa_app_custom_prompt_enable") ===
                        "1" ||
                        get_option(
                            "pnfpb_ic_pwa_app_desktop_custom_prompt_enable"
                        ) === "1" ||
                        get_option(
                            "pnfpb_ic_pwa_app_mobile_custom_prompt_enable"
                        ) === "1" ||
                        get_option(
                            "pnfpb_ic_pwa_app_pixels_custom_prompt_enable"
                        ) === "1") &&
                    get_option(
                        "pnfpb_ic_disable_serviceworker_pwa_pushnotification"
                    ) != "1"
                ) {

                    echo '<div class="pnfpb-pwa-dialog-container" id="pnfpb-pwa-dialog-container">
						<div class="pnfpb-pwa-dialog-box" style="background-color:' .
                        	esc_attr($pnfpb_pwa_prompt_dialog_background) .
                        '">
							<div class="pnfpb-pwa-dialog-title" style="color:' .
                        		esc_attr($pnfpb_pwa_prompt_text_color) .
                        	';">' .
                        		esc_html($pnfpb_pwa_prompt_text) .
                        	'</div>
							<div class="pnfpb-pwa-dialog-buttons">
								<button id="pnfpb-pwa-dialog-cancel" type="button" class="button secondary" 
										style="color:' .
                        					esc_attr($pnfpb_pwa_prompt_button_text_color) .
                        					";background-color:" .
                        					esc_attr($pnfpb_pwa_prompt_button_background) .
                        		';">' .
                        			esc_html($pnfpb_pwa_prompt_cancel_button_text) .
                        		'</button>
								<button id="pnfpb-pwa-dialog-subscribe" type="button" class="button primary" 
									style="color:' .
                        				esc_attr($pnfpb_pwa_prompt_button_text_color) .
                        				";background-color:" .
                        				esc_attr($pnfpb_pwa_prompt_button_background) .
                        		';">' .
                        			esc_html($pnfpb_pwa_prompt_confirm_button_text) .
                        		'</button>
							</div>
						</div>
				</div>';

                    if (get_option("pnfpb-pwa-ios-message")) {
                        $pnfpb_pwa_ios_message_custom_prompt = get_option(
                            "pnfpb-pwa-ios-message"
                        );
                    } else {
                        $pnfpb_pwa_ios_message_custom_prompt = esc_html(
                            __(
                                "For IOS and IPAD browsers, Install PWA using add to home screen in ios safari browser or add to dock option in macos safari browser",
                                "push-notification-for-post-and-buddypress"
                            )
                        );
                    }

                    $pnfpb_ic_fcm_custom_prompt_close_button_text = esc_html(
                        __("Close", "push-notification-for-post-and-buddypress")
                    );

                    if (
                        get_option(
                            "pnfpb_ic_fcm_custom_prompt_close_button_text"
                        )
                    ) {
                        $pnfpb_ic_fcm_custom_prompt_close_button_text = get_option(
                            "pnfpb_ic_fcm_custom_prompt_close_button_text"
                        );
                    }

                    echo '<div class="pnfpb-pwa-dialog-ios-container" id="pnfpb-pwa-dialog-ios-container" 
								style="background-color:' .
                        			esc_attr($pnfpb_pwa_prompt_dialog_background) .
                        '">
						<div class="pnfpb-pwa-dialog-ios-box">
							<div class="pnfpb-pwa-dialog-ios-title pnfpb-notice" 
								style="color:' .
                        			esc_attr($pnfpb_pwa_prompt_text_color) .
                        	';">
								<img class="pnfpb-apple-share-icon" src="' .
                        			esc_url(plugin_dir_url(__FILE__)."public/img/pnfpb-apple-share-icon-50px.png") .
                        			'" 
									alt="PNFPB Install PWA using share icon" 
									width="50px" height="50px">
								<p>' .
                        			esc_html($pnfpb_pwa_ios_message_custom_prompt) .
                        		'</p>
								<button type="button" id="pnfpb-pwa-dialog-ios-cancel" class="pnfpb-notice-dismiss">
									<span class="pnfpb-screen-reader-text">Dismiss this notice.</span>
								</button>
							</div>
						</div>
				</div>';

                    echo '<div id="pnfpb-pwa-dialog-ios" class="pnfpb-pwa-dialog-app-installed" title="' .
                        esc_attr(
                            __(
                                "PWA for IOS browsers",
                                "push-notification-for-post-and-buddypress"
                            )
                        ) .
                        '">
							<div class="pnfpb-pwa-dialog-ios-title pnfpb-notice" 
								style="color:' .
                        			esc_attr($pnfpb_pwa_prompt_text_color) .
                    		';">
								<img class="pnfpb-apple-share-icon" src="' .
                        			esc_url(plugin_dir_url(__FILE__)."public/img/pnfpb-apple-share-icon-50px.png") .
                        		'" alt="PNFPB Install PWA using share icon" 
								width="50px" height="50px">
								<p>' .
                        			esc_attr($pnfpb_pwa_ios_message_custom_prompt) .
                        		'</p>
							</div>
					</div>';
                    ?>

				<div id="pnfpb-pwa-dialog-app-installed" class="pnfpb-pwa-dialog-app-installed" 
					 title="<?php if (
        				get_option("pnfpb-pwa-dialog-app-installed_text", false)
    				) {
        				echo esc_attr(get_option("pnfpb-pwa-dialog-app-installed_text"));
    				} else {
        				echo esc_attr(
           				 __(
                			"App installed successfully",
                			"push-notification-for-post-and-buddypress"
            				)
        				);
    				} ?>"
				>
					<p>
						<span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
						<?php if (
         						get_option("pnfpb-pwa-dialog-app-installed_description", false)
     						) {
         						echo esc_html(
             						get_option("pnfpb-pwa-dialog-app-installed_description")
         						);
     						} else {
         						echo esc_html(
             						__(
                 						"Progressive Web App (PWA) is installed successfully.",
                 						"push-notification-for-post-and-buddypress"
             						)
         						);
     						} ?>
					</p>
				</div>

				<div id="pnfpb-push-notification-blocked" class="pnfpb-push-notification-blocked" 
					 title="<?php echo esc_attr(
        				__(
           					 "Push notification permission",
            				"push-notification-for-post-and-buddypress"
        				)
    				); ?>"
				>
					<p>
						<span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
						<?php echo esc_html(
         					__(
             					"Push notification permission blocked in browser settings. Reset the notification settings for website/PWA",
             					"push-notification-for-post-and-buddypress"
         					)
     					); ?>
					</p>
				</div>
			<?php
                }
            } else {
                if (
                    get_option("pnfpb_ic_fcm_push_prompt_text") &&
                    get_option("pnfpb_ic_fcm_push_prompt_text") != ""
                ) {
                    $pnfpb_push_prompt_text = get_option(
                        "pnfpb_ic_fcm_push_prompt_text"
                    );
                } else {
                    $pnfpb_push_prompt_text = esc_html(
                        __(
                            "Would you like to subscribe to our notifications?",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if (
                    get_option("pnfpb_ic_fcm_push_prompt_confirm_button") &&
                    get_option("pnfpb_ic_fcm_push_prompt_confirm_button") != ""
                ) {
                    $pnfpb_push_prompt_confirm_button_text = get_option(
                        "pnfpb_ic_fcm_push_prompt_confirm_button"
                    );
                } else {
                    $pnfpb_push_prompt_confirm_button_text = esc_html(
                        __("Yes", "push-notification-for-post-and-buddypress")
                    );
                }

                if (
                    get_option("pnfpb_ic_fcm_push_prompt_cancel_button") &&
                    get_option("pnfpb_ic_fcm_push_prompt_cancel_button") != ""
                ) {
                    $pnfpb_push_prompt_cancel_button_text = get_option(
                        "pnfpb_ic_fcm_push_prompt_cancel_button"
                    );
                } else {
                    $pnfpb_push_prompt_cancel_button_text = esc_html(
                        __("No", "push-notification-for-post-and-buddypress")
                    );
                }

                if (
                    get_option("pnfpb_ic_fcm_push_prompt_button_background") &&
                    get_option("pnfpb_ic_fcm_push_prompt_button_background") !=
                        ""
                ) {
                    $pnfpb_push_prompt_button_background = get_option(
                        "pnfpb_ic_fcm_push_prompt_button_background"
                    );
                } else {
                    $pnfpb_push_prompt_button_background = "#121240";
                }

                if (
                    get_option("pnfpb_ic_fcm_push_prompt_dialog_background") &&
                    get_option("pnfpb_ic_fcm_push_prompt_dialog_background") !=
                        ""
                ) {
                    $pnfpb_push_prompt_dialog_background = get_option(
                        "pnfpb_ic_fcm_push_prompt_dialog_background"
                    );
                } else {
                    $pnfpb_push_prompt_dialog_background = "#DAD7D7";
                }

                if (
                    get_option("pnfpb_ic_fcm_push_prompt_text_color") &&
                    get_option("pnfpb_ic_fcm_push_prompt_text_color") != ""
                ) {
                    $pnfpb_push_prompt_text_color = get_option(
                        "pnfpb_ic_fcm_push_prompt_text_color"
                    );
                } else {
                    $pnfpb_push_prompt_text_color = "#161515";
                }

                if (
                    get_option("pnfpb_ic_fcm_push_prompt_button_text_color") &&
                    get_option("pnfpb_ic_fcm_push_prompt_button_text_color") !=
                        ""
                ) {
                    $pnfpb_push_prompt_button_text_color = get_option(
                        "pnfpb_ic_fcm_push_prompt_button_text_color"
                    );
                } else {
                    $pnfpb_push_prompt_button_text_color = "#ffffff";
                }

                if (
                    get_option("pnfpb_ic_fcm_push_prompt_position") &&
                    get_option("pnfpb_ic_fcm_push_prompt_position") != ""
                ) {
                    $pnfpb_push_prompt_position = get_option(
                        "pnfpb_ic_fcm_push_prompt_position"
                    );
                } else {
                    $pnfpb_push_prompt_position = esc_html(
                        __(
                            "pnfpb-top-left",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if (
                    get_option("pnfpb_ic_fcm_pwa_prompt_text") &&
                    get_option("pnfpb_ic_fcm_pwa_prompt_text") != ""
                ) {
                    $pnfpb_pwa_prompt_text = get_option(
                        "pnfpb_ic_fcm_pwa_prompt_text"
                    );
                } else {
                    $pnfpb_pwa_prompt_text = esc_html(
                        __(
                            "Would you like to install our app?",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if (
                    get_option("pnfpb_ic_fcm_pwa_prompt_confirm_button") &&
                    get_option("pnfpb_ic_fcm_pwa_prompt_confirm_button") != ""
                ) {
                    $pnfpb_pwa_prompt_confirm_button_text = get_option(
                        "pnfpb_ic_fcm_pwa_prompt_confirm_button"
                    );
                } else {
                    $pnfpb_pwa_prompt_confirm_button_text = esc_html(
                        __(
                            "Install",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if (
                    get_option("pnfpb_ic_fcm_pwa_prompt_cancel_button") &&
                    get_option("pnfpb_ic_fcm_pwa_prompt_cancel_button") != ""
                ) {
                    $pnfpb_pwa_prompt_cancel_button_text = get_option(
                        "pnfpb_ic_fcm_pwa_prompt_cancel_button"
                    );
                } else {
                    $pnfpb_pwa_prompt_cancel_button_text = esc_html(
                        __(
                            "Cancel",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if (
                    get_option("pnfpb_ic_fcm_pwa_prompt_button_background") &&
                    get_option("pnfpb_ic_fcm_pwa_prompt_button_background") !=
                        ""
                ) {
                    $pnfpb_pwa_prompt_button_background = get_option(
                        "pnfpb_ic_fcm_pwa_prompt_button_background"
                    );
                } else {
                    $pnfpb_pwa_prompt_button_background = "#121240";
                }

                if (
                    get_option("pnfpb_ic_fcm_pwa_prompt_dialog_background") &&
                    get_option("pnfpb_ic_fcm_pwa_prompt_dialog_background") !=
                        ""
                ) {
                    $pnfpb_pwa_prompt_dialog_background = get_option(
                        "pnfpb_ic_fcm_pwa_prompt_dialog_background"
                    );
                } else {
                    $pnfpb_pwa_prompt_dialog_background = "#6666ff";
                }

                if (
                    get_option("pnfpb_ic_fcm_pwa_prompt_text_color") &&
                    get_option("pnfpb_ic_fcm_pwa_prompt_text_color") != ""
                ) {
                    $pnfpb_pwa_prompt_text_color = get_option(
                        "pnfpb_ic_fcm_pwa_prompt_text_color"
                    );
                } else {
                    $pnfpb_pwa_prompt_text_color = "#ffffff";
                }

                if (
                    get_option("pnfpb_ic_fcm_pwa_prompt_button_text_color") &&
                    get_option("pnfpb_ic_fcm_pwa_prompt_button_text_color") !=
                        ""
                ) {
                    $pnfpb_pwa_prompt_button_text_color = get_option(
                        "pnfpb_ic_fcm_pwa_prompt_button_text_color"
                    );
                } else {
                    $pnfpb_pwa_prompt_button_text_color = "#ffffff";
                }

                if (
                    get_option("pnfpb_ic_pwa_app_enable") === "1" &&
                    (get_option("pnfpb_ic_pwa_app_custom_prompt_enable") ===
                        "1" ||
                        get_option(
                            "pnfpb_ic_pwa_app_desktop_custom_prompt_enable"
                        ) === "1" ||
                        get_option(
                            "pnfpb_ic_pwa_app_mobile_custom_prompt_enable"
                        ) === "1" ||
                        get_option(
                            "pnfpb_ic_pwa_app_pixels_custom_prompt_enable"
                        ) === "1") &&
                    get_option(
                        "pnfpb_ic_disable_serviceworker_pwa_pushnotification"
                    ) != "1"
                ) {
                    echo '<div class="pnfpb-pwa-dialog-container" id="pnfpb-pwa-dialog-container">
						<div class="pnfpb-pwa-dialog-box" style="background-color:' .
                        esc_attr($pnfpb_pwa_prompt_dialog_background) .
                        '">
							<div class="pnfpb-pwa-dialog-title" style="color:' .
                        esc_attr($pnfpb_pwa_prompt_text_color) .
                        ';">' .
                        esc_html($pnfpb_pwa_prompt_text) .
                        '</div>
							<div class="pnfpb-pwa-dialog-buttons">
								<button id="pnfpb-pwa-dialog-cancel" type="button" class="button secondary" style="color:' .
                        esc_attr($pnfpb_pwa_prompt_button_text_color) .
                        ";background-color:" .
                        esc_attr($pnfpb_pwa_prompt_button_background) .
                        ';">' .
                        esc_html($pnfpb_pwa_prompt_cancel_button_text) .
                        '</button>
								<button id="pnfpb-pwa-dialog-subscribe" type="button" class="button primary" style="color:' .
                        esc_attr($pnfpb_pwa_prompt_button_text_color) .
                        ";background-color:" .
                        esc_attr($pnfpb_pwa_prompt_button_background) .
                        ';">' .
                        esc_html($pnfpb_pwa_prompt_confirm_button_text) .
                        '</button>
							</div>
						</div>
						</div>'; ?>

						<div id="pnfpb-pwa-dialog-ios" class="pnfpb-pwa-dialog-app-installed" 
							 title="<?php echo esc_attr(
          						__(
              						"PWA for IOS browsers",
              						"push-notification-for-post-and-buddypress"
          						)
      						); ?>"
						>
							<p>
								<span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
								<?php echo esc_html(
           							__(
               							"For IOS and IPAD browsers, Only option to install PWA is to use add to home screen in safari browser",
               							"push-notification-for-post-and-buddypress"
           							)
       							); ?>
							</p>
						</div>

						<div id="pnfpb-pwa-dialog-app-installed" class="pnfpb-pwa-dialog-app-installed" 
							 title="<?php if (
          								get_option("pnfpb-pwa-dialog-app-installed_text", false)
      								) {
          								echo esc_attr(get_option("pnfpb-pwa-dialog-app-installed_text"));
      								} else {
          								echo esc_attr(
              								__(
                  								"App installed successfully",
                  								"push-notification-for-post-and-buddypress"
              								)
         								 );
      								} ?>"
						>
							<p>
								<span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
								<?php if (
           							get_option("pnfpb-pwa-dialog-app-installed_description", false)
       							) {
           							echo esc_html(
               							get_option("pnfpb-pwa-dialog-app-installed_description")
           							);
       							} else {
           							echo esc_html(
               							__(
                   							"Progressive Web App (PWA) is installed successfully.",
                   							"push-notification-for-post-and-buddypress"
               							)
           							);
       							} ?></p>
						</div>
				<?php
                }

                $subscribe_button_text = esc_html(
                    __(
                        "Subscribe push notification",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option("pnfpb_ic_fcm_subscribe_button_text") &&
                    get_option("pnfpb_ic_fcm_subscribe_button_text") !==
                        false &&
                    get_option("pnfpb_ic_fcm_subscribe_button_text") !== ""
                ) {
                    $subscribe_button_text = get_option(
                        "pnfpb_ic_fcm_subscribe_button_text"
                    );
                }

                $unsubscribe_button_text = esc_html(
                    __(
                        "Unsubscribe push notification",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option("pnfpb_ic_fcm_unsubscribe_button_text") &&
                    get_option("pnfpb_ic_fcm_unsubscribe_button_text") !==
                        false &&
                    get_option("pnfpb_ic_fcm_unsubscribe_button_text") !== ""
                ) {
                    $unsubscribe_button_text = get_option(
                        "pnfpb_ic_fcm_unsubscribe_button_text"
                    );
                }

                $subscribe_button_text_color = "#ffffff";

                if (
                    get_option("pnfpb_ic_fcm_subscribe_button_text_color") &&
                    get_option("pnfpb_ic_fcm_subscribe_button_text_color") !==
                        false &&
                    get_option("pnfpb_ic_fcm_subscribe_button_text_color") !==
                        ""
                ) {
                    $subscribe_button_text_color = get_option(
                        "pnfpb_ic_fcm_subscribe_button_text_color"
                    );
                }

                $subscribe_button_color = "#000000";

                if (
                    get_option("pnfpb_ic_fcm_subscribe_button_color") &&
                    get_option("pnfpb_ic_fcm_subscribe_button_color") !==
                        false &&
                    get_option("pnfpb_ic_fcm_subscribe_button_color") !== ""
                ) {
                    $subscribe_button_color = get_option(
                        "pnfpb_ic_fcm_subscribe_button_color"
                    );
                }

                $group_unsubscribe_dialog_text_confirm = esc_html(
                    __(
                        "Your device is unsubscribed from notification",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option(
                        "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
                    ) &&
                    get_option(
                        "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
                    ) !== false &&
                    get_option(
                        "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
                    ) !== ""
                ) {
                    $group_unsubscribe_dialog_text_confirm = get_option(
                        "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
                    );
                }

                $group_subscribe_dialog_text_confirm = esc_html(
                    __(
                        "Your device is subscribed from notification",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option(
                        "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
                    ) &&
                    get_option(
                        "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
                    ) !== false &&
                    get_option(
                        "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
                    ) !== ""
                ) {
                    $group_subscribe_dialog_text_confirm = get_option(
                        "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
                    );
                }

                $group_unsubscribe_dialog_text = esc_html(
                    __(
                        "Would you like to unsubscribe push notifications?",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option("pnfpb_ic_fcm_group_unsubscribe_dialog_text") &&
                    get_option("pnfpb_ic_fcm_group_unsubscribe_dialog_text") !==
                        false &&
                    get_option("pnfpb_ic_fcm_group_unsubscribe_dialog_text") !==
                        ""
                ) {
                    $group_unsubscribe_dialog_text = get_option(
                        "pnfpb_ic_fcm_group_unsubscribe_dialog_text"
                    );
                }

                $group_subscribe_dialog_text = esc_html(
                    __(
                        "Would you like to subscribe to push notifications?",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option("pnfpb_ic_fcm_group_subscribe_dialog_text") &&
                    get_option("pnfpb_ic_fcm_group_subscribe_dialog_text") !==
                        false &&
                    get_option("pnfpb_ic_fcm_group_subscribe_dialog_text") !==
                        ""
                ) {
                    $group_subscribe_dialog_text = get_option(
                        "pnfpb_ic_fcm_group_subscribe_dialog_text"
                    );
                }
                if (
                    get_option("pnfpb_progressier_push") !== "1" &&
                    get_option("pnfpb_webtoapp_push") !== "1"
                ) {
                    $pnfpb_push_prompt = get_option(
                        "pnfpb_ic_fcm_push_prompt_enable"
                    );
                    $pnfpb_onesignal_on = get_option("pnfpb_onesignal_push");
                    $filename = "/public/js/pnfpb_pushscript_onesignal_pwa.js";
                    $ajaxobject = "pnfpb_ajax_object_onesignal_push";

                    wp_enqueue_script(
                        "pnfpb-icajax-onesignal-script-push",
                        plugins_url($filename, __FILE__),
                        ["jquery", "wp-i18n"],
                        "2.06.1",
                        true
                    );

                    wp_localize_script(
                        "pnfpb-icajax-onesignal-script-push",
                        $ajaxobject,
                        [
                            "ajax_url" => admin_url("admin-ajax.php"),
                            "userid" => get_current_user_id(),
                            "pnfpb_onesignal_on" => $pnfpb_onesignal_on,
                            "subscribe_button_text" => $subscribe_button_text,
                            "unsubscribe_button_text" => $unsubscribe_button_text,
                            "subscribe_button_text_color" => $subscribe_button_text_color,
                            "subscribe_button_color" => $subscribe_button_color,
                            "group_unsubscribe_dialog_text_confirm" => $group_unsubscribe_dialog_text_confirm,
                            "group_subscribe_dialog_text_confirm" => $group_subscribe_dialog_text_confirm,
                            "group_unsubscribe_dialog_text" => $group_unsubscribe_dialog_text,
                            "group_subscribe_dialog_text" => $group_subscribe_dialog_text,
                        ]
                    );
                }
            }
        }

        /**
         * Ajax callback routine to update subscribed device id for push notification.
         *
         *
         * @since 1.0.0
         */
        public function PNFPB_icpushcallback_callback()
        {
            global $wpdb;
            include plugin_dir_path(__FILE__) .
                "public/ajax_routines/pnfpb_update_deviceid_ajax.php";
            wp_die();
        }

        /**
         * Ajax callback routine to update admin notice.
         *
         *
         * @since 1.58.0
         */
        public function PNFPB_icpushadmincallback_callback()
        {
            global $wpdb;
            include plugin_dir_path(__FILE__) .
                "admin/ajax_routines/pnfpb_admin_notice_ajax.php";
            wp_die();
        }

        /**
         * Create push notification settings menu under settings menu in admin area for push notification using FCM
         *
         * @since 1.0.0
         */
        public function PNFPB_setup_admin_menu()
        {
            add_menu_page(
                esc_html__(
                    "PNFPB Push Notification",
                    "push-notification-for-post-and-buddypress"
                ),
                esc_html__(
                    "PNFPB Push Notification",
                    "push-notification-for-post-and-buddypress"
                ),
                "administrator", // -> Capability level
                "pnfpb-icfcm-slug",
                [$this, "PNFPB_icfcm_admin_page"],
                "dashicons-bell",
                98
            );

            add_submenu_page(
                "pnfpb-icfcm-slug",
                __(
                    "Push settings",
                    "push-notification-for-post-and-buddypress"
                ),
                __(
                    "Push settings",
                    "push-notification-for-post-and-buddypress"
                ),
                "manage_options",
                "pnfpb-icfcm-slug",
                [$this, "PNFPB_icfcm_admin_page"],
                1
            );

            $hook_device_tokens = add_submenu_page(
                "pnfpb-icfcm-slug", // -> Set to null - will hide menu link
                __(
                    "Device tokens list",
                    "push-notification-for-post-and-buddypress"
                ), // -> Page Title
                "Device tokens", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfm_device_tokens_list", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfcm_device_tokens_list"], // -> To render the page
                2
            );
            add_action("load-$hook_device_tokens", [
                $this,
                $this->pre_name . "screen_option",
            ]);

            add_submenu_page(
                "pnfpb-icfcm-slug", // -> Set to null - will hide menu link
                __(
                    "PWA app settings",
                    "push-notification-for-post-and-buddypress"
                ), // -> Page Title
                "PWA app", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfm_pwa_app_settings", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfcm_pwa_app_settings"], // -> To render the page
                3
            );

            add_submenu_page(
                "pnfpb-icfcm-slug", // -> Set to null - will hide menu link
                __(
                    "Send Notification",
                    "push-notification-for-post-and-buddypress"
                ), // -> Page Title
                "Send Notification", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfmtest_notification", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfcm_test_notification"], // -> To render the page
                4
            );

            $hook_notifications_list = add_submenu_page(
                "pnfpb-icfcm-slug", // -> Set to null - will hide menu link
                __(
                    "Push Notifications list",
                    "push-notification-for-post-and-buddypress"
                ), // -> Page Title
                "Push notifications list", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfm_onetime_notifications_list", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfm_onetime_notifications_list"], // -> To render the page
                5
            );
            add_action("load-$hook_notifications_list", [
                $this,
                $this->pre_name . "push_notifications_list_screen_option",
            ]);

            add_submenu_page(
                "pnfpb-icfcm-slug", // -> Set to null - will hide menu link
                __(
                    "Frontend subscription settings",
                    "push-notification-for-post-and-buddypress"
                ), // -> Page Title
                "Frontend subscription settings", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfm_frontend_settings", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfcm_frontend_settings"], // -> To render the page
                6
            );

            add_submenu_page(
                "pnfpb-icfcm-slug", // -> Set to null - will hide menu link
                __(
                    "Customize Buttons",
                    "push-notification-for-post-and-buddypress"
                ), // -> Page Title
                "Customize Buttons", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfm_button_settings", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfcm_button_settings"], // -> To render the page
                7
            );

            add_submenu_page(
                "pnfpb-icfcm-slug", // -> Set to null - will hide menu link
                __(
                    "Integrate Mobile Apps",
                    "push-notification-for-post-and-buddypress"
                ), // -> Page Title
                "Integrate Mobile App", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfm_integrate_app", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfcm_integrate_app"], // -> To render the page
                8
            );

            add_submenu_page(
                "pnfpb-icfcm-slug", // -> Set to null - will hide menu link
                __("NGNIX", "push-notification-for-post-and-buddypress"), // -> Page Title
                "NGNIX", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfm_settings_for_ngnix_server", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfcm_settings_for_ngnix_server"], // -> To render the page
                9
            );

            $hook_pnfpb_action_scheduler = add_submenu_page(
                "pnfpb-icfcm-slug", // -> Set to null - will hide menu link
                __(
                    "Action scheduler",
                    "push-notification-for-post-and-buddypress"
                ), // -> Page Title
                "Action scheduler", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfm_action_scheduler", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfcm_action_scheduler"], // -> To render the page
                10
            );
            add_action("load-$hook_pnfpb_action_scheduler", [
                $this,
                $this->pre_name . "action_scheduler_screen_option",
            ]);
        }

        /*
         * Admin bar menu registration
         *
         * @since 1.58.0
         */
        public function PNFPB_ic_fcm_admin_bar_menu_register(
            WP_Admin_Bar $wp_admin_bar
        ) {
            include plugin_dir_path(__FILE__) .
                "admin/pnfpb_admin_bar_menu_settings.php";

            $pnfpb_admin_bar_menu_obj = new PNFPB_ICFM_admin_bar_menu_class();

            $pnfpb_admin_bar_menu_obj->pnfpb_admin_bar_menu_register(
                $wp_admin_bar
            );
        }

        /**
         * To Test push notification from admin area under plugin settings
         *
         *
         * @since 1.0.0
         */
        public function PNFPB_icfcm_test_notification()
        {
            require __DIR__ . "/vendor/autoload.php";

            include plugin_dir_path(__FILE__) .
                "admin/pnfpb_admin_ondemand_notification_settings.php";
        }

        /**
         * To Test push notification from admin area under plugin settings
         *
         *
         * @since 1.64.0
         */
        public function PNFPB_icfm_onetime_notifications_list()
        {
            include plugin_dir_path(__FILE__) .
                "admin/pnfpb_onetime_notifications_list.php";
        }

        /* On demand schedule push notification
         *
         *
         * @since 1.57
         *
         */
        public function PNFPB_ondemand_schedule_push_notification(
            $scheduled_day_push_notification,
            $notification_id,
            $occurence,
            $selected_recurring_status,
            $schedule_push_type = "",
            $schedule_post_id = 0
        ) {
            global $wpdb;

            $apiaccesskey = get_option("pnfpb_ic_fcm_google_api");

            update_post_meta($schedule_post_id, "pnfpb_post_schedule", "");

            if (
                ($apiaccesskey != "" && $apiaccesskey != false) ||
                get_option("pnfpb_httpv1_push") === "1" ||
                get_option("pnfpb_onesignal_push") === "1" ||
                get_option("pnfpb_progressier_push") === "1" ||
                get_option("pnfpb_webtoapp_push") === "1"
            ) {
                $table_name =
                    $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

                if (
                    get_option("pnfpb_ic_fcm_loggedin_notify") &&
                    get_option("pnfpb_ic_fcm_loggedin_notify") === "1"
                ) {
                    $deviceids = $wpdb->get_col(
                        $wpdb->prepare(
                            "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > %d AND device_id NOT LIKE %s AND device_id NOT LIKE %s",
                            $table_name,
                            0,
                            "%webview%",
                            "%@N%"
                        )
                    );

                    $deviceidswebview = $wpdb->get_col(
                        $wpdb->prepare(
                            "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > %d AND device_id LIKE %s AND device_id NOT LIKE %s",
                            $table_name,
                            0,
                            "%webview%",
                            "%@N%"
                        )
                    );
                } else {
                    $deviceids = $wpdb->get_col(
                        $wpdb->prepare(
                            "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s",
                            $table_name,
                            "%webview%",
                            "%@N%"
                        )
                    );

                    $deviceidswebview = $wpdb->get_col(
                        $wpdb->prepare(
                            "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id LIKE %s AND device_id NOT LIKE %s",
                            $table_name,
                            "%webview%",
                            "%@N%"
                        )
                    );
                }

                $url = "https://fcm.googleapis.com/fcm/send";

                $regid = $deviceids;

                $activity_content_push = wp_strip_all_tags(
                    urldecode(
                        get_option(
                            "pnfpb_ic_fcm_ondemand_schedule_pn_content" .
                                $scheduled_day_push_notification
                        )
                    )
                );

                $imageurl = "";
                if (
                    get_option(
                        "pnfpb_ic_fcm_ondemand_schedule_pn_image" .
                            $scheduled_day_push_notification
                    )
                ) {
                    $imageurl = get_option(
                        "pnfpb_ic_fcm_ondemand_schedule_pn_image" .
                            $scheduled_day_push_notification
                    );
                }

                $postlink = get_home_url();
                if (
                    get_option(
                        "pnfpb_ic_fcm_ondemand_schedule_pn_url" .
                            $scheduled_day_push_notification
                    )
                ) {
                    $postlink = get_option(
                        "pnfpb_ic_fcm_ondemand_schedule_pn_url" .
                            $scheduled_day_push_notification
                    );
                }

                $notification_table_name =
                    $wpdb->prefix . "pnfpb_ic_schedule_push_notifications";

                $notifications = $wpdb->get_results(
                    "SELECT * FROM {$notification_table_name} WHERE `id` = {$notification_id} "
                );

                foreach ($notifications as $notification) {
                    $onetime_push_title = $notification->title;
                    $onetime_push_content = $notification->content;
                    $onetime_push_imageurl = $notification->image_url;
                    $onetime_push_clickurl = $notification->click_url;
                    $onetime_push_time = gmdate(
                        "Y/m/d H:i:s",
                        $notification->scheduled_timestamp
                    );
                    $onetime_push_status = $notification->status;
                }

                if ($schedule_push_type === "post") {
                    if (has_post_thumbnail($schedule_post_id)) {
                        $onetime_push_imageurl = wp_get_attachment_url(
                            get_post_thumbnail_id($schedule_post_id),
                            "thumbnail"
                        );

                        update_option("pnfpb_ic_fcm_new_post_image", $imageurl);
                    }
                }

                if (get_option("pnfpb_webtoapp_push") === "1") {
                    $response = $this->PNFPB_icfcm_webtoapp_send_push_notification(
                        0,
                        stripslashes(wp_strip_all_tags($onetime_push_title)),
                        stripslashes(wp_strip_all_tags($onetime_push_content)),
                        $onetime_push_clickurl,
                        $onetime_push_imageurl
                    );
                }

                if (get_option("pnfpb_progressier_push") === "1") {
                    $response = $this->PNFPB_icfcm_progressier_send_push_notification(
                        0,
                        stripslashes(wp_strip_all_tags($onetime_push_title)),
                        stripslashes(wp_strip_all_tags($onetime_push_content)),
                        $onetime_push_clickurl,
                        $onetime_push_imageurl
                    );
                } else {
                    if (get_option("pnfpb_onesignal_push") === "1") {
                        $response = $this->PNFPB_icfcm_onesignal_push_notification(
                            0,
                            stripslashes(
                                wp_strip_all_tags($onetime_push_title)
                            ),
                            stripslashes(
                                wp_strip_all_tags($onetime_push_content)
                            ),
                            $onetime_push_clickurl,
                            $onetime_push_imageurl
                        );
                    } else {
                        if (count($regid) > 0) {
                            if (get_option("pnfpb_httpv1_push") === "1") {
                                $this->PNFPB_icfcm_httpv1_send_push_notification(
                                    0,
                                    stripslashes(
                                        wp_strip_all_tags($onetime_push_title)
                                    ),
                                    stripslashes(
                                        wp_strip_all_tags($onetime_push_content)
                                    ),
                                    $onetime_push_imageurl,
                                    $onetime_push_imageurl,
                                    $onetime_push_clickurl,
                                    ["click_url" => $postlink],
                                    $regid,
                                    [],
                                    0,
                                    0,
                                    "ondemand"
                                );
                            }
                        }
                    }
                }
            }

            $table = $table =
                $wpdb->prefix . "pnfpb_ic_schedule_push_notifications";

            if ($occurence === "recurring") {
                $recurring_status = $selected_recurring_status;

                try {
                    $future_action_id = ActionScheduler::store()->query_action([
                        "hook" =>
                            "PNFPB_ondemand_schedule_push_notification_hook",
                        "date" => $scheduled_day_push_notification,
                        "date_compare" => "=",
                        "status" => [
                            ActionScheduler_Store::STATUS_RUNNING,
                            ActionScheduler_Store::STATUS_PENDING,
                        ],
                    ]);

                    if (!$future_action_id) {
                        $datetime = new DateTime();
                        $datetime->setTimestamp(
                            $scheduled_day_push_notification
                        );
                        $datetime->setTimezone(
                            new DateTimeZone(wp_timezone_string())
                        );
                        $recurring_status =
                            esc_html(
                                __(
                                    "Finished on ",
                                    "push-notification-for-post-and-buddypress"
                                )
                            ) . $datetime->format("Y-m-d H:i:s");

                        if ($schedule_push_type === "post") {
                            update_post_meta(
                                $schedule_post_id,
                                "pnfpb_post_schedule",
                                ""
                            );
                        }
                    } else {
                        $action = ActionScheduler::store()->fetch_action(
                            $future_action_id
                        );
                        $scheduled_date = $action->get_schedule()->get_date();
                        $scheduled_date->setTimezone(
                            new DateTimeZone(wp_timezone_string())
                        );

                        if ($scheduled_date) {
                            $recurring_status =
                                "<br/>" . $selected_recurring_status;

                            if ($schedule_push_type === "post") {
                                update_post_meta(
                                    $schedule_post_id,
                                    "pnfpb_post_schedule",
                                    $selected_recurring_status
                                );
                            }
                        }
                    }
                } catch (Exception $e) {
                    /* for debugging purpose */
                    /*error_log(serialize($e));*/
                }

                $datetime = new DateTime();
                $datetime->setTimestamp($scheduled_day_push_notification);
                $datetime->setTimezone(new DateTimeZone(wp_timezone_string()));
                $current_run_timestamp = strtotime(
                    $datetime->format("Y-m-d H:i:s")
                );
                $onetime_push_update_status = $wpdb->query(
                    $wpdb->prepare(
                        "UPDATE %i SET scheduled_timestamp = %d,status = %s WHERE id = %d",
                        $table,
                        $current_run_timestamp,
                        $notification_id
                    )
                );
            } else {
                $future_action_id = ActionScheduler::store()->query_action([
                    "hook" => "PNFPB_ondemand_schedule_push_notification_hook",
                    "date" => $scheduled_day_push_notification,
                    "date_compare" => "=",
                    "status" => [
                        ActionScheduler_Store::STATUS_RUNNING,
                        ActionScheduler_Store::STATUS_PENDING,
                    ],
                ]);

                $datetime = new DateTime();
                $datetime->setTimestamp($scheduled_day_push_notification);
                $datetime->setTimezone(new DateTimeZone(wp_timezone_string()));
                $recurring_status =
                    esc_html(
                        __(
                            "Finished on ",
                            "push-notification-for-post-and-buddypress"
                        )
                    ) . $datetime->format("Y/m/d H:i:s");
                $onetime_push_update_status = $wpdb->query(
                    $wpdb->prepare(
                        "UPDATE %i SET status = %s WHERE id = %d",
                        $table,
                        $recurring_status,
                        $notification_id
                    )
                );
                if ($schedule_push_type === "post") {
                    update_post_meta(
                        $schedule_post_id,
                        "pnfpb_post_schedule",
                        ""
                    );
                }
            }
        }

        /**
         * Create push notification settings page under admin area to enter FireBase configuartion
         *
         * @since 1.0.0
         */
        public function PNFPB_icfcm_admin_page()
        {
            include plugin_dir_path(__FILE__) .
                "admin/pnfpb_admin_ic_push_notification.php";
        }

        /**
         * Action scheduler list
         *
         *
         * @since 1.50.0
         */
        public function PNFPB_icfcm_action_scheduler()
        {
            ?>
				<h1 class="pnfpb_ic_push_settings_header"><?php echo esc_html(
        __(
            "PNFPB - Action scheduler",
            "push-notification-for-post-and-buddypress"
        )
    ); ?></h1>
			<div class="nav-tab-wrapper">
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb-icfcm-slug"); ?>" 
	   				class="nav-tab tab">
						<?php echo esc_html(
    					__("Push Settings", "push-notification-for-post-and-buddypress")
					); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_device_tokens_list"); ?>" 
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("Device tokens", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_pwa_app_settings"); ?>" 
					class="nav-tab tab  ">
						<?php echo esc_html(
    						__("PWA", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfmtest_notification"); ?>"
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("Send push notification", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc"); ?>"
	   				class=" nav-tab tab">
						<?php echo esc_html(
    						__("Push Notifications list", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_frontend_settings"); ?>"
	   				class="nav-tab tab ">
					<?php echo esc_html(
    					__(
        					"Frontend subscription settings",
        					"push-notification-for-post-and-buddypress"
    					)
					); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_button_settings"); ?>"
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("Customize buttons", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_integrate_app"); ?>" 
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("Integrate Mobile app", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_settings_for_ngnix_server"); ?>"
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("NGINX", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1"); ?>"
	   				class="nav-tab tab active nav-tab-active">
						<?php echo esc_html(
    						__("Action Scheduler", "push-notification-for-post-and-buddypress")
					); ?>
			</a>
		</div>

				<div class="pnfpb_column_1200">
					<p>
						<?php echo esc_html(
          __(
              "Action Scheduler library is also used by other plugins, like WPForms and WooCommerce, so you might see tasks that are not related to our plugin in the table below.",
              "push-notification-for-post-and-buddypress"
          )
      ); ?>
					</p>
					<?php if (class_exists("ActionScheduler_AdminView")) {
         ActionScheduler_AdminView::instance()->render_admin_ui();
     } ?>
				</div>
			<?php
        }

        /**
         * Admin page to list and manage device tokens - set screen options
         *
         * @since 1.19
         */
        public static function PNFPB_set_screen($status, $option, $value)
        {
            return $value;
        }

        /**
         * Admin page to list and manage device tokens
         *
         * @since 1.19
         */
        public function PNFPB_icfcm_device_tokens_list()
        {
            ?>
			<h1 class="pnfpb_ic_push_settings_header"><?php echo esc_html(
       			__(
           			"PNFPB - Device tokens list",
           			"push-notification-for-post-and-buddypress"
       			)
   				); ?>
			</h1>

			<div class="nav-tab-wrapper">
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb-icfcm-slug"); ?>" 
	   				class="nav-tab tab">
						<?php echo esc_html(
    					__("Push Settings", "push-notification-for-post-and-buddypress")
					); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_device_tokens_list"); ?>" 
	   				class="nav-tab tab active nav-tab-active">
						<?php echo esc_html(
    						__("Device tokens", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_pwa_app_settings"); ?>" 
					class="nav-tab tab ">
						<?php echo esc_html(
    						__("PWA", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfmtest_notification"); ?>"
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("Send push notification", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc"); ?>"
	   				class=" nav-tab tab">
						<?php echo esc_html(
    						__("Push Notifications list", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_frontend_settings"); ?>"
	   				class="nav-tab tab ">
					<?php echo esc_html(
    					__(
        					"Frontend subscription settings",
        					"push-notification-for-post-and-buddypress"
    					)
					); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_button_settings"); ?>"
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("Customize buttons", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_integrate_app"); ?>" 
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("Integrate Mobile app", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_settings_for_ngnix_server"); ?>"
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("NGINX", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1"); ?>"
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("Action Scheduler", "push-notification-for-post-and-buddypress")
					); ?>
			</a>
		</div>

			<div class="pnfpb_column_1200">
				<div class="wrap">
					<div class="pnfpb_row">
  						<div class="pnfpb_column_400">					
							<h2><?php echo esc_html(
           						__(
               						"List of device tokens registered for push notification",
               						"push-notification-for-post-and-buddypress"
           						)
       							); ?>
							</h2>
						</div>
					</div>
					<div class="pnfpb_row">
  						<div class="pnfpb_column_400">
							<p>
								<b>
									<?php echo esc_html(
             __(
                 "(Do not delete tokens unneccessarily it will result in user will not receive push notification, unless it is needed, avoid deleting tokens )",
                 "push-notification-for-post-and-buddypress"
             )
         ); ?>
								</b>
							</p>
						</div>
					</div>
   					<?php settings_fields("pnfpb_icfcm_token"); ?>
    				<?php do_settings_sections("pnfpb_icfcm_token"); ?>					
					<div id="poststuff">
						<div id="post-body" class="metabox-holder columns-2">
						<div id="post-body-content">
							<div class="meta-box-sortables ui-sortable">
								<form method="post">
									<?php
         $nonce = "";

         if (isset($_REQUEST["_wpnonce"])) {
             $nonce = esc_attr(
                 sanitize_text_field(wp_unslash($_REQUEST["_wpnonce"]))
             );
         }

         if (isset($_REQUEST["s"])) {
             $this->devicetokens_obj->prepare_items(
                 wp_unslash(sanitize_text_field($_REQUEST["s"]))
             );
         } else {
             $this->devicetokens_obj->prepare_items();
         }
         $this->devicetokens_obj->pnfpb_url_scheme_start();
         $this->devicetokens_obj->search_box(
             "Search",
             "pnfpb_device_token_search"
         );
         $this->devicetokens_obj->display();
         $this->devicetokens_obj->pnfpb_url_scheme_stop();
         ?>
								</form>
							</div>
						</div>
						</div>
						<br class="clear">
					</div>
					<div class="pnfpb_row">
  						<div class="pnfpb_column_400">
							<p>
								<b><?php echo esc_html(
            __(
                "Subscription option code - details",
                "push-notification-for-post-and-buddypress"
            )
        ); ?> </b><br/>
								<?php echo esc_html(
            __(
                "if Subscription option is 1000000000000 means user subscribed all notifications",
                "push-notification-for-post-and-buddypress"
            )
        ); ?> <br/>
								<?php echo esc_html(
            __(
                ' "1" in 1st position indicates - subscribed to all notifications',
                "push-notification-for-post-and-buddypress"
            )
        ); ?> <br/>
								<?php echo esc_html(
            __(
                ' "1" in 2nd position indicates - subscribed to Post/custom post notifications',
                "push-notification-for-post-and-buddypress"
            )
        ); ?> <br/>
								<?php echo esc_html(
            __(
                ' "1" in 3rd position indicates - subscribed to Comments notifications',
                "push-notification-for-post-and-buddypress"
            )
        ); ?> <br/>
								<?php echo esc_html(
            __(
                ' "1" in 4th position indicates - subscribed to my-comments notifications',
                "push-notification-for-post-and-buddypress"
            )
        ); ?> <br/>
								<?php echo esc_html(
            __(
                ' "1" in 5th position indicates - subscribed to new member notifications',
                "push-notification-for-post-and-buddypress"
            )
        ); ?> <br/>
								<?php echo esc_html(
            __(
                ' "1" in 6th position indicates - subscribed to private message notifications',
                "push-notification-for-post-and-buddypress"
            )
        ); ?> <br/>
								<?php echo esc_html(
            __(
                ' "1" in 7th position indicates - subscribed to friendship request notifications',
                "push-notification-for-post-and-buddypress"
            )
        ); ?> <br/>
								<?php echo esc_html(
            __(
                ' "1" in 8th position indicates - subscribed to friendship accept notifications',
                "push-notification-for-post-and-buddypress"
            )
        ); ?> <br/>
								<?php echo esc_html(
            __(
                ' "1" in 9th position indicates - Unsubscribed to all notifications',
                "push-notification-for-post-and-buddypress"
            )
        ); ?> <br/>
								<?php echo esc_html(
            __(
                ' "1" in 10th position indicates - subscribed to profile avatar change notifications',
                "push-notification-for-post-and-buddypress"
            )
        ); ?> <br/>
								<?php echo esc_html(
            __(
                ' "1" in 11th position indicates - subscribed to profile cover image change notifications',
                "push-notification-for-post-and-buddypress"
            )
        ); ?> <br/>
								<?php echo esc_html(
            __(
                ' "1" in 12th position indicates - Subscribed to BuddyPress activities/group activities',
                "push-notification-for-post-and-buddypress"
            )
        ); ?> <br/>
								<?php echo esc_html(
            __(
                ' "1" in 13th position indicates - subscribed to group invite notifications',
                "push-notification-for-post-and-buddypress"
            )
        ); ?> <br/>
								<?php echo esc_html(
            __(
                ' "1" in 14th position indicates - subscribed to group details update notifications',
                "push-notification-for-post-and-buddypress"
            )
        ); ?> <br/>
							</p>
						</div>
					</div>					
				</div>
			</div>
		<?php
        }

        /**
         * Admin page to list and manage device tokens - Screen options
         * @since 1.64
         */
        public function PNFPB_push_notifications_list_screen_option()
        {
            $option = "per_page";
            $args = [
                "label" => "Push notifications list",
                "default" => 20,
                "option" => "records_per_page",
            ];

            add_screen_option($option, $args);

            $this->pushnotifications_obj = new PNFPB_ICFM_onetime_push_notifications_List();
        }

        /**
         *
         * Initialize Action scheduler
         *
         */
        public function PNFPB_action_scheduler_screen_option()
        {
            if (class_exists("ActionScheduler_AdminView")) {
                ActionScheduler_AdminView::instance()->process_admin_ui();
            }
        }

        /**
         * Admin page to list and manage device tokens - Screen options
         * @since 1.19
         */
        public function PNFPB_screen_option()
        {
            $option = "per_page";
            $args = [
                "label" => "Device tokens",
                "default" => 20,
                "option" => "records_per_page",
            ];

            add_screen_option($option, $args);

            $this->devicetokens_obj = new PNFPB_ICFM_Device_tokens_List();
        }

        /**
         * To customize Subscription/unsubscribe buttons
         * @since 1.29
         *
         */
        public function PNFPB_icfcm_button_settings()
        {
            include plugin_dir_path(__FILE__) .
                "admin/pnfpb_admin_button_customization.php";
        }

        /**
         * To customize Subscription/unsubscribe buttons
         * for front-end
         * @since 1.52
         *
         */
        public function PNFPB_icfcm_frontend_settings()
        {
            include plugin_dir_path(__FILE__) .
                "admin/pnfpb_admin_front_end_notification_settings.php";
        }
        /**
         * Generate PWA app with offline facility
         * @since 1.20
         *
         */
        public function PNFPB_icfcm_pwa_app_settings()
        {
            include plugin_dir_path(__FILE__) .
                "admin/pnfpb_admin_pwa_app_settings.php";
        }

        /**
         * Store push notification settings from admin area settings
         *
         * @since 1.0.0
         */
        public function PNFPB_settings()
        {
            //register our settings
            register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_google_api");
            register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_api");
            register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_authdomain");
            register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_databaseurl");
            register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_projectid");
            register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_storagebucket");
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_messagingsenderid"
            );
            register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_appid");
            register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_publickey");
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_activity_title"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_activity_message"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_group_activity_title"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_group_activity_message"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_comment_activity_title"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_comment_activity_message"
            );
            register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_upload_icon");
            register_setting("pnfpb_icfcm_group", "pnfpb_onesignal_push");
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_progressier_api_key"
            );
            register_setting("pnfpb_icfcm_group", "pnfpb_progressier_push");
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_webtoapp_api_key"
            );
            register_setting("pnfpb_icfcm_group", "pnfpb_webtoapp_push");
            register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_prompt_style");
            register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_prompt_on_off");
            register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_prompt_style3");
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_update_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_update_text_color"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_update_background_color"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_update_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_list_background_color"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_list_text_color"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_list_checkbox_color"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_update_confirmation_message"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_all_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_post_text"
            );

            $args = [
                "public" => true,
                "_builtin" => false,
            ];

            $output = "names"; // or objects

            $operator = "and"; // 'and' or 'or'

            $custposttypes = get_post_types($args, $output, $operator);

            foreach ($custposttypes as $post_type) {
                register_setting(
                    "pnfpb_icfcm_group",
                    "pnfpb_bell_icon_subscription_option_" .
                        $post_type .
                        "_text"
                );
            }

            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_activity_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_all_comments_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_my_comments_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_private_message_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_new_member_joined_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_friendship_request_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_friendship_accepted_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_avatar_change_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_cover_image_change_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_group_details_update_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_subscription_option_group_invite_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_custom_prompt_animation"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_custom_prompt_header_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_custom_prompt_header_text_line_2"
            );			
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_custom_prompt_subscribed_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_custom_prompt_confirmation_message_on_off"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_custom_prompt_show_again_days"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_custom_prompt_allow_button_text_color"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_push_custom_prompt_allow_button_background"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_custom_prompt_allow_button_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_custom_prompt_cancel_button_text_color"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_push_custom_prompt_cancel_button_background"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_custom_prompt_cancel_button_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_custom_prompt_close_button_text_color"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_push_custom_prompt_close_button_background"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_custom_prompt_close_button_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_push_prompt_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_push_prompt_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_push_prompt_confirm_button"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_push_prompt_cancel_button"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_push_prompt_button_background"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_push_prompt_dialog_background"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_push_prompt_text_color"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_push_prompt_button_text_color"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_push_prompt_position"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_custom_prompt_popup_wait_message"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_custom_prompt_options_on_off"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_bell_icon_prompt_options_on_off"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_loggedin_notify"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_turnoff_foreground_messages"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_renotify_notification"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_replace_notifications"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_show_allposttype_subscriptions_custom_prompt"
            );
            register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_post_enable");
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_only_post_subscribers_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_disable_post_update_enable"
            );
            register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_post_title");
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypress_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_bcomment_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_bactivity_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_bprivatemessage_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_bprivatemessage_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_bprivatemessage_content"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_new_member_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_new_member_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_new_member_content"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_friendship_request_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_friendship_request_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_friendship_request_content"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_friendship_accept_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_friendship_accept_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_friendship_accept_content"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_avatar_change_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_avatar_change_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_avatar_change_content"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_cover_image_change_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_cover_image_change_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_cover_image_change_content"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_group_invitation_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypress_group_invitation_text_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypress_group_invitation_content_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_group_details_updated_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypress_group_details_updated_text_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypress_group_details_updated_content_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_contact_form7_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypress_contact_form7_text_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypress_contact_form7_content_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_new_user_registration_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypress_new_user_registration_text_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypress_new_user_registration_content_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_post_schedule_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_post_schedule_background_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_post_schedule_now_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_activity_schedule_now_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_comments_schedule_now_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypressoptions_schedule_now_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_admin_schedule_now_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_post_timeschedule_seconds"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypressactivities_schedule_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypressactivities_schedule_background_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypress_followers_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypresscomments_schedule_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypress_comments_radio_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypresscomments_schedule_background_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_popup_subscribe_button_icon"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_popup_subscribe_button_text_color"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_popup_subscribe_button_color"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_popup_subscribe_button"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_popup_unsubscribe_button"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_popup_header_text"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_popup_subscribe_message"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_popup_unsubscribe_message"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_popup_wait_message"
            );

            register_setting("pnfpb_icfcm_group", "pnfpb_httpv1_push");

            register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_enable");
            register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_name");
            register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_shortname");
            register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_theme_color");
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_app_backgroundcolor"
            );
            register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_display");
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_upload_icon_132"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_upload_icon_512"
            );
            register_setting("pnfpb_icfcm_pwa", "pnfpb-pwa-ios-message");
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_upload_screenshot_desktop_label"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_upload_screenshot_mobile_label"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_value"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_value"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_value"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_value"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_thirdparty_pwa_app_enable"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_thirdparty_app_id"
            );
            $pnfpb_pwa_args = [
                "type" => "array",
            ];
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_protocol_name",
                $pnfpb_pwa_args
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_protocol_url",
                $pnfpb_pwa_args
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_app_offline_url1"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_app_offline_url2"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_app_offline_url3"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_app_offline_url4"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_app_offline_url5"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_app_excludeallurls"
            );
            register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_excludeurls");
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_app_custom_prompt_enable"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_app_desktop_custom_prompt_enable"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_app_mobile_custom_prompt_enable"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_app_pixels_custom_prompt_enable"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_prompt_install_button_text"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_prompt_header_text"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_prompt_description"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_prompt_install_button_color"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_pwa_prompt_install_text_color"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb-pwa-dialog-app-installed_text"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb-pwa-dialog-app-installed_description"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_prompt_confirm_button"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_prompt_cancel_button"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_prompt_button_background"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_prompt_dialog_background"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_prompt_text_color"
            );
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_prompt_button_text_color"
            );
            register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_fcm_pwa_prompt_text");
            register_setting(
                "pnfpb_icfcm_pwa",
                "pnfpb_ic_fcm_pwa_show_again_days"
            );

            register_setting(
                "pnfpb_icfcm_nginx",
                "pnfpb_ic_nginx_static_files_enable"
            );

            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_subscribe_button_color"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_subscribe_button_text_color"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_subscribe_button_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_subscribe_group_push_notification_icon"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_unsubscribe_button_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_unsubscribe_group_push_notification_icon"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_subscribe_group_push_notification_icon_enable"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_group_subscribe_dialog_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_group_unsubscribe_dialog_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_unsubscribe_button_shortcode_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_subscribe_button_shortcode_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_subscribe_save_button_text_shortcode"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_shortcode_close_button_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_subscribe_all_dialog_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_subscribe_post_activity_dialog_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb-pwa-shortcode-install-icon"
            );

            $args = [
                "public" => true,
                "_builtin" => false,
            ];

            $output = "names"; // or objects

            $operator = "and"; // 'and' or 'or'

            $custposttypes = get_post_types($args, $output, $operator);

            foreach ($custposttypes as $post_type) {
                register_setting(
                    "pnfpb_icfcm_buttons",
                    "pnfpb_ic_fcm_subscribe_" . $post_type . "_dialog_text"
                );
            }
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_subscribe_all_comments_dialog_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_subscribe_my_comments_dialog_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_subscribe_private_message_dialog_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_subscribe_new_member_dialog_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_subscribe_friend_request_dialog_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_subscribe_friendship_accepted_dialog_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_subscribe_user_avatar_dialog_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_subscribe_cover_image_change_dialog_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_unsubscribe_all_dialog_text"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_subscribe_dialog_text_confirm"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_unsubscribe_dialog_text_confirm"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_install_pwa_shortcode_button_color"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_install_pwa_shortcode_button_text_color"
            );
            register_setting(
                "pnfpb_icfcm_buttons",
                "pnfpb_ic_fcm_install_pwa_shortcode_button_text"
            );

            register_setting(
                "pnfpb_icfcm_frontend_buttons",
                "pnfpb_ic_fcm_frontend_enable_subscription"
            );
            register_setting(
                "pnfpb_icfcm_frontend_buttons",
                "pnfpb_ic_fcm_frontend_settings_post_text"
            );

            $args = [
                "public" => true,
                "_builtin" => false,
            ];

            $output = "names"; // or objects

            $operator = "and"; // 'and' or 'or'

            $custposttypes = get_post_types($args, $output, $operator);

            foreach ($custposttypes as $post_type) {
                register_setting(
                    "pnfpb_icfcm_frontend_buttons",
                    "pnfpb_ic_fcm_frontend_settings_" . $post_type . "_text"
                );
            }

            register_setting(
                "pnfpb_icfcm_frontend_buttons",
                "pnfpb_ic_fcm_frontend_settings_activities_text"
            );
            register_setting(
                "pnfpb_icfcm_frontend_buttons",
                "pnfpb_ic_fcm_frontend_settings_comments_text"
            );
            register_setting(
                "pnfpb_icfcm_frontend_buttons",
                "pnfpb_ic_fcm_frontend_settings_mycomments_text"
            );
            register_setting(
                "pnfpb_icfcm_frontend_buttons",
                "pnfpb_ic_fcm_frontend_settings_privatemessage_text"
            );
            register_setting(
                "pnfpb_icfcm_frontend_buttons",
                "pnfpb_ic_fcm_frontend_settings_newmember_text"
            );
            register_setting(
                "pnfpb_icfcm_frontend_buttons",
                "pnfpb_ic_fcm_frontend_settings_friend_request_text"
            );
            register_setting(
                "pnfpb_icfcm_frontend_buttons",
                "pnfpb_ic_fcm_frontend_settings_friend_accept_text"
            );
            register_setting(
                "pnfpb_icfcm_frontend_buttons",
                "pnfpb_ic_fcm_frontend_settings_avatar_change_text"
            );
            register_setting(
                "pnfpb_icfcm_frontend_buttons",
                "pnfpb_ic_fcm_frontend_settings_coverimage_change_text"
            );
            register_setting(
                "pnfpb_icfcm_frontend_buttons",
                "pnfpb_ic_fcm_frontend_settings_groupinvite_text"
            );
            register_setting(
                "pnfpb_icfcm_frontend_buttons",
                "pnfpb_ic_fcm_frontend_settings_groupdetails_text"
            );

            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_post_timeschedule_enable",
                [
                    "type" => "string",
                    "sanitize_callback" => [
                        $this,
                        "pnfpb_ic_fcm_post_timeschedule_callback",
                    ],
                ]
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypressactivities_schedule_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypressactivities_timeschedule_enable",
                [
                    "type" => "string",
                    "sanitize_callback" => [
                        $this,
                        "pnfpb_ic_fcm_buddypressactivities_timeschedule_callback",
                    ],
                ]
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypresscomments_schedule_enable"
            );
            register_setting(
                "pnfpb_icfcm_group",
                "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable",
                [
                    "type" => "string",
                    "sanitize_callback" => [
                        $this,
                        "pnfpb_ic_fcm_buddypresscomments_timeschedule_callback",
                    ],
                ]
            );

            $args = [
                "public" => true,
                "_builtin" => false,
            ];

            $output = "names"; // or objects
            $operator = "and"; // 'and' or 'or'
            $custposttypes = get_post_types($args, $output, $operator);

            foreach ($custposttypes as $post_type) {
                $fieldname = "pnfpb_ic_fcm_" . $post_type . "_enable";
                register_setting("pnfpb_icfcm_group", $fieldname);
                register_setting(
                    "pnfpb_icfcm_group",
                    "pnfpb_ic_fcm_" . $post_type . "_title"
                );
            }
        }

        public function pnfpb_ic_fcm_post_timeschedule_callback($posted_options)
        {
            if ($_POST["submit"] == "Save changes") {
                if (
                    (get_option("pnfpb_ic_fcm_post_schedule_enable") &&
                        get_option("pnfpb_ic_fcm_post_schedule_enable") == 1) ||
                    (get_option(
                        "pnfpb_ic_fcm_post_schedule_background_enable"
                    ) &&
                        get_option(
                            "pnfpb_ic_fcm_post_schedule_background_enable"
                        ) == 1 &&
                        (get_option("pnfpb_ic_fcm_post_timeschedule_enable") ==
                            "weekly" ||
                            get_option(
                                "pnfpb_ic_fcm_post_timeschedule_enable"
                            ) == "twicedaily" ||
                            get_option(
                                "pnfpb_ic_fcm_post_timeschedule_enable"
                            ) == "daily" ||
                            get_option(
                                "pnfpb_ic_fcm_post_timeschedule_enable"
                            ) == "hourly" ||
                            (get_option(
                                "pnfpb_ic_fcm_post_timeschedule_enable"
                            ) == "seconds" &&
                                get_option(
                                    "pnfpb_ic_fcm_post_timeschedule_seconds"
                                ) > 59)))
                ) {
                    $timeseconds = "3600";
                    if ($posted_options === "weekly") {
                        $timeseconds = "604800";
                    }
                    if ($posted_options === "twicedaily") {
                        $timeseconds = "43200";
                    }
                    if ($posted_options === "daily") {
                        $timeseconds = "86400";
                    }
                    if ($posted_options === "hourly") {
                        $timeseconds = "3600";
                    }
                    if ($posted_options === "seconds") {
                        $timeseconds = get_option(
                            "pnfpb_ic_fcm_post_timeschedule_seconds"
                        );
                    }

                    $new_time = strtotime(
                        gmdate(
                            "Y-m-d H:i:s",
                            strtotime(
                                "+" . $timeseconds . " seconds",
                                strtotime("now")
                            )
                        )
                    );

                    if (
                        false ===
                        as_has_scheduled_action("PNFPB_cron_post_hook")
                    ) {
                        as_schedule_recurring_action(
                            $new_time,
                            $timeseconds,
                            "PNFPB_cron_post_hook",
                            [],
                            "pnfpb_post",
                            true
                        );
                    } else {
                        if (wp_next_scheduled("PNFPB_cron_post_hook")) {
                            $timestamp = wp_next_scheduled(
                                "PNFPB_cron_post_hook"
                            );
                            wp_unschedule_event(
                                $timestamp,
                                "PNFPB_cron_post_hook"
                            );
                        }
                        as_unschedule_all_actions(
                            "PNFPB_cron_post_hook",
                            [],
                            ""
                        );
                        delete_option("pnfpb_ic_fcm_new_post_id");
                        delete_option("pnfpb_ic_fcm_new_post_title");
                        delete_option("pnfpb_ic_fcm_new_post_content");
                        delete_option("pnfpb_ic_fcm_new_post_link");
                        delete_option("pnfpb_ic_fcm_new_post_type");
                        delete_option("pnfpb_ic_fcm_new_post_author");
                        as_schedule_recurring_action(
                            $new_time,
                            $timeseconds,
                            "PNFPB_cron_post_hook",
                            [],
                            "pnfpb_post",
                            true
                        );
                    }
                } else {
                    if (as_has_scheduled_action("PNFPB_cron_post_hook")) {
                        if (wp_next_scheduled("PNFPB_cron_post_hook")) {
                            $timestamp = wp_next_scheduled(
                                "PNFPB_cron_post_hook"
                            );
                            wp_unschedule_event(
                                $timestamp,
                                "PNFPB_cron_post_hook"
                            );
                        }
                        as_unschedule_all_actions(
                            "PNFPB_cron_post_hook",
                            [],
                            "pnfpb_post"
                        );
                        delete_option("pnfpb_ic_fcm_new_post_id");
                        delete_option("pnfpb_ic_fcm_new_post_title");
                        delete_option("pnfpb_ic_fcm_new_post_content");
                        delete_option("pnfpb_ic_fcm_new_post_link");
                        delete_option("pnfpb_ic_fcm_new_post_type");
                        delete_option("pnfpb_ic_fcm_new_post_author");
                    }
                }
            }
            return $posted_options;
        }

        public function pnfpb_ic_fcm_buddypressactivities_timeschedule_callback(
            $posted_options
        ) {
            if (isset($_POST["submit"]) && $_POST["submit"] == "Save changes") {
                if (
                    (get_option(
                        "pnfpb_ic_fcm_buddypressactivities_schedule_enable"
                    ) &&
                        get_option(
                            "pnfpb_ic_fcm_buddypressactivities_schedule_enable"
                        ) == 1) ||
                    (get_option(
                        "pnfpb_ic_fcm_buddypressactivities_schedule_background_enable"
                    ) &&
                        get_option(
                            "pnfpb_ic_fcm_buddypressactivities_schedule_background_enable"
                        ) == 1 &&
                        (get_option(
                            "pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
                        ) == "weekly" ||
                            get_option(
                                "pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
                            ) == "twicedaily" ||
                            get_option(
                                "pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
                            ) == "daily" ||
                            get_option(
                                "pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
                            ) == "hourly" ||
                            (get_option(
                                "pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
                            ) == "seconds" &&
                                get_option(
                                    "pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds"
                                ) > 59)))
                ) {
                    $timeseconds = 3600;
                    if ($posted_options == "weekly") {
                        $timeseconds = 604800;
                    }
                    if ($posted_options == "twicedaily") {
                        $timeseconds = 43200;
                    }
                    if ($posted_options == "daily") {
                        $timeseconds = 86400;
                    }
                    if ($posted_options == "hourly") {
                        $timeseconds = 3600;
                    }
                    if ($posted_options == "seconds") {
                        $timeseconds = get_option(
                            "pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds"
                        );
                    }

                    $new_time = strtotime(
                        gmdate(
                            "Y-m-d H:i:s",
                            strtotime(
                                "+" . $timeseconds . " seconds",
                                strtotime("now")
                            )
                        )
                    );

                    if (
                        false ===
                            as_has_scheduled_action(
                                "PNFPB_cron_buddypressactivities_hook"
                            ) &&
                        get_option("pnfpb_ic_fcm_buddypress_enable") == 1
                    ) {
                        as_schedule_recurring_action(
                            $new_time,
                            $timeseconds,
                            "PNFPB_cron_buddypressactivities_hook",
                            [],
                            "pnfpb_buddypressactivities",
                            true
                        );
                        if (
                            wp_next_scheduled(
                                "PNFPB_cron_buddypressgroupactivities_hook"
                            )
                        ) {
                            $timestamp = wp_next_scheduled(
                                "PNFPB_cron_buddypressgroupactivities_hook"
                            );
                            wp_unschedule_event(
                                $timestamp,
                                "PNFPB_cron_buddypressgroupactivities_hook"
                            );
                        }
                        if (
                            as_has_scheduled_action(
                                "PNFPB_cron_buddypressgroupactivities_hook"
                            )
                        ) {
                            as_unschedule_all_actions(
                                "PNFPB_cron_buddypressgroupactivities_hook",
                                [],
                                "pnfpb_buddypressgroupactivities"
                            );
                            delete_option(
                                "pnfpb_ic_fcm_new_buddypressactivities_content"
                            );
                            delete_option(
                                "pnfpb_ic_fcm_new_buddypressactivities_userid"
                            );
                            delete_option(
                                "pnfpb_ic_fcm_new_buddypressactivities_link"
                            );
                            delete_option(
                                "pnfpb_ic_fcm_new_buddypressactivities_image"
                            );
                            delete_option(
                                "pnfpb_ic_fcm_new_buddypressgroup_link"
                            );
                            delete_option(
                                "pnfpb_ic_fcm_new_buddypressgroup_id"
                            );
                            delete_option(
                                "pnfpb_ic_fcm_new_buddypressgroup_userid"
                            );
                        }
                    } else {
                        if (get_option("pnfpb_ic_fcm_buddypress_enable") == 1) {
                            if (
                                wp_next_scheduled(
                                    "PNFPB_cron_buddypressgroupactivities_hook"
                                )
                            ) {
                                $timestamp = wp_next_scheduled(
                                    "PNFPB_cron_buddypressgroupactivities_hook"
                                );
                                wp_unschedule_event(
                                    $timestamp,
                                    "PNFPB_cron_buddypressgroupactivities_hook"
                                );
                            }
                            if (
                                wp_next_scheduled(
                                    "PNFPB_cron_buddypressactivities_hook"
                                )
                            ) {
                                $timestamp = wp_next_scheduled(
                                    "PNFPB_cron_buddypressactivities_hook"
                                );
                                wp_unschedule_event(
                                    $timestamp,
                                    "PNFPB_cron_buddypressactivities_hook"
                                );
                            }
                            as_unschedule_all_actions(
                                "PNFPB_cron_buddypressactivities_hook",
                                [],
                                ""
                            );
                            as_schedule_recurring_action(
                                $new_time,
                                $timeseconds,
                                "PNFPB_cron_buddypressactivities_hook",
                                [],
                                "pnfpb_buddypressactivities",
                                true
                            );
                            if (
                                as_has_scheduled_action(
                                    "PNFPB_cron_buddypressgroupactivities_hook"
                                )
                            ) {
                                as_unschedule_all_actions(
                                    "PNFPB_cron_buddypressgroupactivities_hook",
                                    [],
                                    "pnfpb_buddypressgroupactivities"
                                );
                                delete_option(
                                    "pnfpb_ic_fcm_new_buddypressactivities_content"
                                );
                                delete_option(
                                    "pnfpb_ic_fcm_new_buddypressactivities_userid"
                                );
                                delete_option(
                                    "pnfpb_ic_fcm_new_buddypressactivities_link"
                                );
                                delete_option(
                                    "pnfpb_ic_fcm_new_buddypressactivities_image"
                                );
                                delete_option(
                                    "pnfpb_ic_fcm_new_buddypressgroup_link"
                                );
                                delete_option(
                                    "pnfpb_ic_fcm_new_buddypressgroup_id"
                                );
                                delete_option(
                                    "pnfpb_ic_fcm_new_buddypressgroup_userid"
                                );
                            }
                        }
                    }

                    if (
                        false ===
                            as_has_scheduled_action(
                                "PNFPB_cron_buddypressgroupactivities_hook"
                            ) &&
                        get_option("pnfpb_ic_fcm_buddypress_enable") == 2
                    ) {
                        $timeseconds = 3600;
                        if ($posted_options == "weekly") {
                            $timeseconds = 604800;
                        }
                        if ($posted_options == "twicedaily") {
                            $timeseconds = 43200;
                        }
                        if ($posted_options == "daily") {
                            $timeseconds = 86400;
                        }
                        if ($posted_options == "hourly") {
                            $timeseconds = 3600;
                        }
                        if ($posted_options == "seconds") {
                            $timeseconds = get_option(
                                "pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds"
                            );
                        }

                        $new_time = strtotime(
                            gmdate(
                                "Y-m-d H:i:s",
                                strtotime(
                                    "+" . $timeseconds . " seconds",
                                    strtotime("now")
                                )
                            )
                        );

                        if (
                            wp_next_scheduled(
                                "PNFPB_cron_buddypressgroupactivities_hook"
                            )
                        ) {
                            $timestamp = wp_next_scheduled(
                                "PNFPB_cron_buddypressgroupactivities_hook"
                            );
                            wp_unschedule_event(
                                $timestamp,
                                "PNFPB_cron_buddypressgroupactivities_hook"
                            );
                        }
                        if (
                            wp_next_scheduled(
                                "PNFPB_cron_buddypressactivities_hook"
                            )
                        ) {
                            $timestamp = wp_next_scheduled(
                                "PNFPB_cron_buddypressactivities_hook"
                            );
                            wp_unschedule_event(
                                $timestamp,
                                "PNFPB_cron_buddypressactivities_hook"
                            );
                        }

                        as_schedule_recurring_action(
                            $new_time,
                            $timeseconds,
                            "PNFPB_cron_buddypressgroupactivities_hook",
                            [],
                            "pnfpb_buddypressgroupactivities",
                            true
                        );
                        if (
                            as_has_scheduled_action(
                                "PNFPB_cron_buddypressactivities_hook"
                            )
                        ) {
                            as_unschedule_all_actions(
                                "PNFPB_cron_buddypressactivities_hook",
                                [],
                                "pnfpb_buddypressactivities"
                            );
                            delete_option(
                                "pnfpb_ic_fcm_new_buddypressactivities_content"
                            );
                            delete_option(
                                "pnfpb_ic_fcm_new_buddypressactivities_userid"
                            );
                            delete_option(
                                "pnfpb_ic_fcm_new_buddypressactivities_link"
                            );
                            delete_option(
                                "pnfpb_ic_fcm_new_buddypressactivities_image"
                            );
                            delete_option(
                                "pnfpb_ic_fcm_new_buddypressgroup_link"
                            );
                            delete_option(
                                "pnfpb_ic_fcm_new_buddypressgroup_id"
                            );
                            delete_option(
                                "pnfpb_ic_fcm_new_buddypressgroup_userid"
                            );
                        }
                    } else {
                        if (get_option("pnfpb_ic_fcm_buddypress_enable") == 2) {
                            if (
                                wp_next_scheduled(
                                    "PNFPB_cron_buddypressgroupactivities_hook"
                                )
                            ) {
                                $timestamp = wp_next_scheduled(
                                    "PNFPB_cron_buddypressgroupactivities_hook"
                                );
                                wp_unschedule_event(
                                    $timestamp,
                                    "PNFPB_cron_buddypressgroupactivities_hook"
                                );
                            }
                            if (
                                wp_next_scheduled(
                                    "PNFPB_cron_buddypressactivities_hook"
                                )
                            ) {
                                $timestamp = wp_next_scheduled(
                                    "PNFPB_cron_buddypressactivities_hook"
                                );
                                wp_unschedule_event(
                                    $timestamp,
                                    "PNFPB_cron_buddypressactivities_hook"
                                );
                            }
                            as_unschedule_all_actions(
                                "PNFPB_cron_buddypressgroupactivities_hook",
                                [],
                                ""
                            );
                            $timeseconds = 3600;
                            if ($posted_options == "weekly") {
                                $timeseconds = 604800;
                            }
                            if ($posted_options == "twicedaily") {
                                $timeseconds = 43200;
                            }
                            if ($posted_options == "daily") {
                                $timeseconds = 86400;
                            }
                            if ($posted_options == "hourly") {
                                $timeseconds = 3600;
                            }
                            if ($posted_options == "seconds") {
                                $timeseconds = get_option(
                                    "pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds"
                                );
                            }

                            $new_time = strtotime(
                                gmdate(
                                    "Y-m-d H:i:s",
                                    strtotime(
                                        "+" . $timeseconds . " seconds",
                                        strtotime("now")
                                    )
                                )
                            );
                            if (
                                wp_next_scheduled(
                                    "PNFPB_cron_buddypressgroupactivities_hook"
                                )
                            ) {
                                $timestamp = wp_next_scheduled(
                                    "PNFPB_cron_buddypressgroupactivities_hook"
                                );
                                wp_unschedule_event(
                                    $timestamp,
                                    "PNFPB_cron_buddypressgroupactivities_hook"
                                );
                            }
                            if (
                                wp_next_scheduled(
                                    "PNFPB_cron_buddypressactivities_hook"
                                )
                            ) {
                                $timestamp = wp_next_scheduled(
                                    "PNFPB_cron_buddypressactivities_hook"
                                );
                                wp_unschedule_event(
                                    $timestamp,
                                    "PNFPB_cron_buddypressactivities_hook"
                                );
                            }
                            as_schedule_recurring_action(
                                $new_time,
                                $timeseconds,
                                "PNFPB_cron_buddypressgroupactivities_hook",
                                [],
                                "pnfpb_buddypressgroupactivities",
                                true
                            );
                            if (
                                as_has_scheduled_action(
                                    "PNFPB_cron_buddypressactivities_hook"
                                )
                            ) {
                                as_unschedule_all_actions(
                                    "PNFPB_cron_buddypressactivities_hook",
                                    [],
                                    "pnfpb_buddypressactivities"
                                );
                                delete_option(
                                    "pnfpb_ic_fcm_new_buddypressactivities_content"
                                );
                                delete_option(
                                    "pnfpb_ic_fcm_new_buddypressactivities_userid"
                                );
                                delete_option(
                                    "pnfpb_ic_fcm_new_buddypressactivities_link"
                                );
                                delete_option(
                                    "pnfpb_ic_fcm_new_buddypressactivities_image"
                                );
                                delete_option(
                                    "pnfpb_ic_fcm_new_buddypressgroup_link"
                                );
                                delete_option(
                                    "pnfpb_ic_fcm_new_buddypressgroup_id"
                                );
                                delete_option(
                                    "pnfpb_ic_fcm_new_buddypressgroup_userid"
                                );
                            }
                        }
                    }
                } else {
                    if (
                        as_has_scheduled_action(
                            "PNFPB_cron_buddypressactivities_hook"
                        )
                    ) {
                        if (
                            wp_next_scheduled(
                                "PNFPB_cron_buddypressgroupactivities_hook"
                            )
                        ) {
                            $timestamp = wp_next_scheduled(
                                "PNFPB_cron_buddypressgroupactivities_hook"
                            );
                            wp_unschedule_event(
                                $timestamp,
                                "PNFPB_cron_buddypressgroupactivities_hook"
                            );
                        }
                        if (
                            wp_next_scheduled(
                                "PNFPB_cron_buddypressactivities_hook"
                            )
                        ) {
                            $timestamp = wp_next_scheduled(
                                "PNFPB_cron_buddypressactivities_hook"
                            );
                            wp_unschedule_event(
                                $timestamp,
                                "PNFPB_cron_buddypressactivities_hook"
                            );
                        }
                        as_unschedule_all_actions(
                            "PNFPB_cron_buddypressactivities_hook",
                            [],
                            "pnfpb_buddypressactivities"
                        );
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypressactivities_content"
                        );
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypressactivities_userid"
                        );
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypressactivities_link"
                        );
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypressactivities_image"
                        );
                        delete_option("pnfpb_ic_fcm_new_buddypressgroup_link");
                        delete_option("pnfpb_ic_fcm_new_buddypressgroup_id");
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypressgroup_userid"
                        );
                    }

                    if (
                        as_has_scheduled_action(
                            "PNFPB_cron_buddypressgroupactivities_hook"
                        )
                    ) {
                        if (
                            wp_next_scheduled(
                                "PNFPB_cron_buddypressgroupactivities_hook"
                            )
                        ) {
                            $timestamp = wp_next_scheduled(
                                "PNFPB_cron_buddypressgroupactivities_hook"
                            );
                            wp_unschedule_event(
                                $timestamp,
                                "PNFPB_cron_buddypressgroupactivities_hook"
                            );
                        }
                        if (
                            wp_next_scheduled(
                                "PNFPB_cron_buddypressactivities_hook"
                            )
                        ) {
                            $timestamp = wp_next_scheduled(
                                "PNFPB_cron_buddypressactivities_hook"
                            );
                            wp_unschedule_event(
                                $timestamp,
                                "PNFPB_cron_buddypressactivities_hook"
                            );
                        }
                        as_unschedule_all_actions(
                            "PNFPB_cron_buddypressgroupactivities_hook",
                            [],
                            "pnfpb_buddypressgroupactivities"
                        );
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypressactivities_content"
                        );
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypressactivities_userid"
                        );
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypressactivities_link"
                        );
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypressactivities_image"
                        );
                        delete_option("pnfpb_ic_fcm_new_buddypressgroup_link");
                        delete_option("pnfpb_ic_fcm_new_buddypressgroup_id");
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypressgroup_userid"
                        );
                    }
                }
            }
            return $posted_options;
        }

        public function pnfpb_ic_fcm_buddypresscomments_timeschedule_callback(
            $posted_options
        ) {
            if (isset($_POST["submit"]) && $_POST["submit"] == "Save changes") {
                if (
                    (get_option(
                        "pnfpb_ic_fcm_buddypresscomments_schedule_enable"
                    ) &&
                        get_option(
                            "pnfpb_ic_fcm_buddypresscomments_schedule_enable"
                        ) == 1) ||
                    (get_option(
                        "pnfpb_ic_fcm_buddypresscomments_schedule_background_enable"
                    ) &&
                        get_option(
                            "pnfpb_ic_fcm_buddypresscomments_schedule_background_enable"
                        ) == 1 &&
                        (get_option(
                            "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                        ) == "weekly" ||
                            get_option(
                                "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                            ) == "twicedaily" ||
                            get_option(
                                "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                            ) == "daily" ||
                            get_option(
                                "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                            ) == "hourly" ||
                            (get_option(
                                "pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
                            ) == "seconds" &&
                                get_option(
                                    "pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds"
                                ) > 59)))
                ) {
                    $timeseconds = 3600;
                    if ($posted_options == "weekly") {
                        $timeseconds = 604800;
                    }
                    if ($posted_options == "twicedaily") {
                        $timeseconds = 43200;
                    }
                    if ($posted_options == "daily") {
                        $timeseconds = 86400;
                    }
                    if ($posted_options == "hourly") {
                        $timeseconds = 3600;
                    }
                    if ($posted_options == "seconds") {
                        $timeseconds = get_option(
                            "pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds"
                        );
                    }

                    $new_time = strtotime(
                        gmdate(
                            "Y-m-d H:i:s",
                            strtotime(
                                "+" . $timeseconds . " seconds",
                                strtotime("now")
                            )
                        )
                    );

                    if (
                        false ===
                        as_has_scheduled_action("PNFPB_cron_comments_post_hook")
                    ) {
                        as_schedule_recurring_action(
                            $new_time,
                            $timeseconds,
                            "PNFPB_cron_comments_post_hook",
                            [],
                            "pnfpb_postcomments",
                            true
                        );
                    } else {
                        if (
                            wp_next_scheduled("PNFPB_cron_comments_post_hook")
                        ) {
                            $timestamp = wp_next_scheduled(
                                "PNFPB_cron_comments_post_hook"
                            );
                            wp_unschedule_event(
                                $timestamp,
                                "PNFPB_cron_comments_post_hook"
                            );
                        }
                        if (
                            wp_next_scheduled(
                                "PNFPB_cron_buddypresscomments_hook"
                            )
                        ) {
                            $timestamp = wp_next_scheduled(
                                "PNFPB_cron_buddypresscomments_hook"
                            );
                            wp_unschedule_event(
                                $timestamp,
                                "PNFPB_cron_buddypresscomments_hook"
                            );
                        }
                        as_unschedule_all_actions(
                            "PNFPB_cron_comments_post_hook",
                            [],
                            ""
                        );
                        delete_option("pnfpb_ic_fcm_new_comment_id");
                        delete_option("pnfpb_ic_fcm_new_comment_approved");
                        delete_option("pnfpb_ic_fcm_new_comments_post_content");
                        delete_option("pnfpb_ic_fcm_new_comments_post_link");
                        delete_option("pnfpb_ic_fcm_new_comments_post_userid");
                        delete_option(
                            "pnfpb_ic_fcm_new_comments_post_authorid"
                        );
                        as_schedule_recurring_action(
                            $new_time,
                            $timeseconds,
                            "PNFPB_cron_comments_post_hook",
                            [],
                            "pnfpb_postcomments",
                            true
                        );
                    }

                    if (
                        false ===
                        as_has_scheduled_action(
                            "PNFPB_cron_buddypresscomments_hook"
                        )
                    ) {
                        as_schedule_recurring_action(
                            $new_time,
                            $timeseconds,
                            "PNFPB_cron_buddypresscomments_hook",
                            [],
                            "pnfpb_buddypresscomments",
                            true
                        );
                    } else {
                        if (
                            wp_next_scheduled("PNFPB_cron_comments_post_hook")
                        ) {
                            $timestamp = wp_next_scheduled(
                                "PNFPB_cron_comments_post_hook"
                            );
                            wp_unschedule_event(
                                $timestamp,
                                "PNFPB_cron_comments_post_hook"
                            );
                        }
                        if (
                            wp_next_scheduled(
                                "PNFPB_cron_buddypresscomments_hook"
                            )
                        ) {
                            $timestamp = wp_next_scheduled(
                                "PNFPB_cron_buddypresscomments_hook"
                            );
                            wp_unschedule_event(
                                $timestamp,
                                "PNFPB_cron_buddypresscomments_hook"
                            );
                        }

                        as_unschedule_all_actions(
                            "PNFPB_cron_buddypresscomments_hook",
                            [],
                            ""
                        );
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypresscomments_content"
                        );
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypresscomments_link"
                        );
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypresscomments_postuserid"
                        );
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypresscomments_activityuserid"
                        );
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypresscomments_authoractivityuserid"
                        );
                        as_schedule_recurring_action(
                            $new_time,
                            $timeseconds,
                            "PNFPB_cron_buddypresscomments_hook",
                            [],
                            "pnfpb_buddypresscomments",
                            true
                        );
                    }
                } else {
                    if (
                        as_has_scheduled_action(
                            "PNFPB_cron_buddypresscomments_hook"
                        )
                    ) {
                        if (
                            wp_next_scheduled("PNFPB_cron_comments_post_hook")
                        ) {
                            $timestamp = wp_next_scheduled(
                                "PNFPB_cron_comments_post_hook"
                            );
                            wp_unschedule_event(
                                $timestamp,
                                "PNFPB_cron_comments_post_hook"
                            );
                        }
                        if (
                            wp_next_scheduled(
                                "PNFPB_cron_buddypresscomments_hook"
                            )
                        ) {
                            $timestamp = wp_next_scheduled(
                                "PNFPB_cron_buddypresscomments_hook"
                            );
                            wp_unschedule_event(
                                $timestamp,
                                "PNFPB_cron_buddypresscomments_hook"
                            );
                        }
                        as_unschedule_all_actions(
                            "PNFPB_cron_buddypresscomments_hook",
                            [],
                            "pnfpb_buddypresscomments"
                        );
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypresscomments_content"
                        );
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypresscomments_link"
                        );
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypresscomments_postuserid"
                        );
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypresscomments_activityuserid"
                        );
                        delete_option(
                            "pnfpb_ic_fcm_new_buddypresscomments_authoractivityuserid"
                        );
                    }

                    if (
                        as_has_scheduled_action("PNFPB_cron_comments_post_hook")
                    ) {
                        if (
                            wp_next_scheduled("PNFPB_cron_comments_post_hook")
                        ) {
                            $timestamp = wp_next_scheduled(
                                "PNFPB_cron_comments_post_hook"
                            );
                            wp_unschedule_event(
                                $timestamp,
                                "PNFPB_cron_comments_post_hook"
                            );
                        }
                        if (
                            wp_next_scheduled(
                                "PNFPB_cron_buddypresscomments_hook"
                            )
                        ) {
                            $timestamp = wp_next_scheduled(
                                "PNFPB_cron_buddypresscomments_hook"
                            );
                            wp_unschedule_event(
                                $timestamp,
                                "PNFPB_cron_buddypresscomments_hook"
                            );
                        }
                        as_unschedule_all_actions(
                            "PNFPB_cron_comments_post_hook",
                            [],
                            "pnfpb_postcomments"
                        );
                        delete_option("pnfpb_ic_fcm_new_comment_id");
                        delete_option("pnfpb_ic_fcm_new_comment_approved");
                        delete_option("pnfpb_ic_fcm_new_comments_post_content");
                        delete_option("pnfpb_ic_fcm_new_comments_post_link");
                        delete_option("pnfpb_ic_fcm_new_comments_post_userid");
                        delete_option(
                            "pnfpb_ic_fcm_new_comments_post_authorid"
                        );
                    }
                }
            }
            return $posted_options;
        }

        /**
         * Upload custom push notification icon from admin settings to send notification with custom icon
         *
         * @since 1.0.0
         */
        public function PNFPB_ic_push_upload_icon_script()
        {
            add_action("admin_enqueue_scripts", function ($hook) {
                /** @var \WP_Screen $screen */
                $screen = get_current_screen();

                if (
                    "settings_page_pnfpb-icfcm-slug" == $screen->base ||
                    "settings_page_pnfpb_icfm_pwa_app_settings" ==
                        $screen->base ||
                    "settings_page_pnfpb_icfmtest_notification" ==
                        $screen->base ||
                    "pnfpb-push-notification_page_pnfpb_icfmtest_notification" ==
                        $screen->base ||
                    "pnfpb-push-notification_page_pnfpb-icfcm-slug" ==
                        $screen->base ||
                    "pnfpb-push-notification_page_pnfpb_icfm_pwa_app_settings" ==
                        $screen->base ||
                    "toplevel_page_pnfpb-icfcm-slug" == $screen->base ||
                    "pnfpb-push-notification_page_pnfpb_icfm_button_settings" ==
                        $screen->base
                ) {
                    wp_enqueue_media();
                } else {
                    return;
                }
            });
            $ajaxobject = "pnfpb_ajax_object_pwa_upload_icon";
            $filename = "/admin/js/pnfpb_ic_upload_icon.js";
            wp_register_script(
                "pnfpb_ic_upload_icon_script",
                plugins_url($filename, __FILE__),
                ["jquery", "wp-i18n"],
                "2.00.11",
                true
            );
            wp_enqueue_script("pnfpb_ic_upload_icon_script");
            $filename = "/admin/js/pnfpb_ic_pwa_upload_icon.js";
            wp_register_script(
                "pnfpb_ic_pwa_upload_icon_script",
                plugins_url($filename, __FILE__),
                ["jquery", "wp-i18n"],
                "2.00.11",
                true
            );
            wp_localize_script("pnfpb_ic_pwa_upload_icon_script", $ajaxobject, [
                "ajax_url" => admin_url("admin-ajax.php"),
            ]);
            wp_enqueue_script("pnfpb_ic_pwa_upload_icon_script");
            $filename = "/admin/js/pnfpb_ic_ondemand_push_upload_image.js";
            wp_register_script(
                "pnfpb_ic_ondemand_push_upload_image_script",
                plugins_url($filename, __FILE__),
                ["jquery", "wp-i18n"],
                "2.00.11",
                true
            );
            wp_enqueue_script("pnfpb_ic_ondemand_push_upload_image_script");
        }

        /**
         * Create service worker file on fly(dynamically) which is needed for push notification using FCM
         *
         * @since 1.0.0
         */
        public function PNFPB_icpush_sw_file_create()
        {
            if (
                get_option(
                    "pnfpb_ic_disable_serviceworker_pwa_pushnotification"
                ) != "1"
            ) {
                include plugin_dir_path(__FILE__) .
                    "public/service_worker/pnfpb_create_sw_file.php";
            }

            if (
                get_option("pnfpb_onesignal_push") !== "1" &&
                get_option("pnfpb_progressier_push") !== "1" &&
                get_option("pnfpb_webtoapp_push") !== "1"
            ) {
                if (get_option("pnfpb_ic_nginx_static_files_enable") === "1") {
                    global $wp_filesystem;

                    if (empty($wp_filesystem)) {
                        require_once trailingslashit(ABSPATH) .
                            "wp-admin/includes/file.php";
                        WP_Filesystem();
                    }

                    $sw_content = PNFPB_icfm_icpush_sw_template();

                    $swresponse = wp_remote_head(
                        home_url("/") . "pnfpb_icpush_pwa_sw.js",
                        ["sslverify" => false]
                    );
                    $swresponse_code = wp_remote_retrieve_response_code(
                        $swresponse
                    );

                    if (200 !== $swresponse_code) {
                        $createfileresult = $wp_filesystem->put_contents(
                            trailingslashit(get_home_path()) .
                                "pnfpb_icpush_pwa_sw.js",
                            $sw_content,
                            0644
                        );
                    }

                    $firebase_sw_contents = PNFPB_icfm_icpush_firebasesw_template();
                    $firebase_swresponse = wp_remote_head(
                        home_url("/") . "firebase-messaging-sw.js",
                        ["sslverify" => false]
                    );

                    $firebase_swresponse_code = wp_remote_retrieve_response_code(
                        $firebase_swresponse
                    );

                    if (200 !== $firebase_swresponse_code) {
                        $createfileresult = $wp_filesystem->put_contents(
                            trailingslashit(get_home_path()) .
                                "firebase-messaging-sw.js",
                            $firebase_sw_contents,
                            0644
                        );
                    }

                    if (
                        get_option("pnfpb_ic_pwa_app_enable") === "1" &&
                        get_option(
                            "pnfpb_ic_disable_serviceworker_pwa_pushnotification"
                        ) != "1"
                    ) {
                        $pwa_manifest_contents = PNFPB_ic_generate_pwa_manifest_json();

                        $pwa_manifest_response = wp_remote_head(
                            home_url("/") . "pnfpbmanifest.json",
                            ["sslverify" => false]
                        );

                        $pwa_manifest_response_code = wp_remote_retrieve_response_code(
                            $pwa_manifest_response
                        );

                        if (200 !== $pwa_manifest_response_code) {
                            $createfileresult = $wp_filesystem->put_contents(
                                trailingslashit(get_home_path()) .
                                    "pnfpbmanifest.json",
                                $pwa_manifest_contents,
                                0644
                            );
                        }
                    }
                }
            }
        }

        /*
         * @since 1.70.0
         *
         * Add PNFPB send push notification meta box in New/Edit post/custom post page
         */
        public function PNFPB_send_push_post_options()
        {
            // Add meta box for the "post" post type (default)
            add_meta_box(
                "PNFPB_send_notification_html",
                "PNFPB Push Notifications",
                [$this, "PNFPB_send_notification_html"],
                "post",
                "side",
                "high"
            );

            // Then add meta box for all other post types that are public but not built in to WordPress
            $args = [
                "public" => true,
                "_builtin" => false,
            ];

            $output = "names";
            $operator = "and";
            $post_types = get_post_types($args, $output, $operator);

            foreach ($post_types as $post_type) {
                add_meta_box(
                    "PNFPB_send_notification_html",
                    "PNFPB Push Notifications",
                    [$this, "PNFPB_send_notification_html"],
                    $post_type,
                    "side",
                    "high"
                );
            }
        }

        /**
         * Render Meta Box content.
         *
         * @param WP_Post $post the post object
         *
         * @since 1.70.0
         */
        public function PNFPB_send_notification_html($post)
        {
            include plugin_dir_path(__FILE__) .
                "admin/pnfpb_schedule_push_notification_post_editor.php";
        }

        /**
         * Triggered while saving post or custom post type to send push notifications
         *
         *
         * @param numeric $post_id 	Post/Custom post id
         * @param array   $post 		wp_post object
         * @param bool  	 $update 	Update flag
         *
         *
         * @since 1.0.0
         */
        public function PNFPB_on_post_save_web(
            $new_status = null,
            $old_status = null,
            $post = null
        ) {
            include plugin_dir_path(__FILE__) .
                "public/post_custom_post_type_notification/pnfpb_post_push_notification_routine.php";
        }

        /**
         * To send push notifications while saving post or custom post type
         * Opt in/out for the notification can be controlled from plugin settings.
         *
         *
         * @param string $post_title 	Post Title
         * @param string $post_content 	Post Content
         * @param string $postlink 		Post permalink
         *
         *
         * @since 1.0.0
         */
        public function PNFPB_icforum_push_notifications_post_web(
            $post_title = null,
            $post_content = null,
            $postlink = null,
            $postid = null,
            $post = null
        ) {
            include plugin_dir_path(__FILE__) .
                "public/post_custom_post_type_notification/post_custom_post_type_send_notification.php";
        }

        /**
         * Triggered after creating activity in BuddyPress to send push notifications
         * Opt in/out for the notification can be controlled from plugin settings.
         *
         * @param string   $activity_content Activity content
         * @param numeric  $user_id 			USER ID
         * @param numeric  $activity_id		Activity ID
         *
         *
         * @since 1.0.0
         */
        public function PNFPB_icforum_push_notifications_web(
            $activity_content = null,
            $user_id = null,
            $activity_id = null
        ) {
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_activity_notification/pnfpb_all_activities_notification.php";
        }
        /**
         * Triggered after creating activity under group in BuddyPress to send push notifications
         * Opt in/out for the notification can be controlled from plugin settings.
         *
         *
         * @param string   $content 		Activity content
         * @param numeric  $user_id 		USER ID
         * @param numeric  $group_id		GROUP ID
         * @param numeric  $activity_id	Activity ID
         *
         *
         * @since 1.0.0
         */
        public function PNFPB_icforum_push_notifications_web_group(
            $content = null,
            $user_id = null,
            $group_id = null,
            $activity_id = null,
            $sendschedule = "no"
        ) {
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_activity_notification/pnfpb_group_activities_notification.php";
        }

        /**
         * Triggered after private messages sent for user in BuddyPress.
         * to send push notifications Opt in/out for the notification can be
         * controlled from plugin settings.
         *
         *
         * @param array   $raw_args		Message content array
         *
         *
         * @since 1.13
         */
        public function PNFPB_icforum_push_notifications_private_messages(
            $raw_args = []
        ) {
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_private_message_notification/pnfpb_private_message_notification.php";
        }

        /**
         * Triggered after private messages sent for user in BuddyPress.
         * to send push notifications Opt in/out for the notification can be
         * controlled from plugin settings.
         *
         *
         * @param array   $raw_args		Message content array
         *
         *
         * @since 1.47
         */
        public function PNFPB_icforum_push_notifications_new_member($user_id)
        {
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_new_member_joined_notification/pnfpb_new_member_joined_notification.php";
        }

        /**
         * Triggered after friendship request sent for user in BuddyPress.
         * to send push notifications Opt in/out for the notification can be
         * controlled from plugin settings.
         *
         *
         * @param array   $raw_args		Message content array
         *
         *
         * @since 1.47
         */
        public function PNFPB_icforum_push_notifications_friendship_request(
            $friendship_id,
            $initiator_id,
            $friend_id
        ) {
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_friendship_request_notification/pnfpb_friendship_request_notification.php";
        }

        /**
         * Triggered after friendship accepted sent for user in BuddyPress.
         * to send push notifications Opt in/out for the notification can be
         * controlled from plugin settings.
         *
         *
         * @param array   $raw_args		Message content array
         *
         *
         * @since 1.47
         */
        public function PNFPB_icforum_push_notifications_friendship_accepted(
            $friendship_id,
            $initiator_id,
            $friend_id
        ) {
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_friendship_accept_notification/pnfpb_friendship_accept_notification.php";
        }

        /**
         * Triggered after avatar change sent for user in BuddyPress.
         * to send push notifications Opt in/out for the notification can be
         * controlled from plugin settings.
         *
         *
         * @param array   $raw_args		Message content array
         *
         *
         * @since 1.47
         */
        public function PNFPB_icforum_push_notifications_avatar_change(
            $user_id = 0
        ) {
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_avatar_change_notification/pnfpb_avatar_change_notification.php";
        }

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
        public function PNFPB_icforum_push_notifications_cover_image_change(
            $item_id,
            $cover_url
        ) {
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_cover_image_change_notification/pnfpb_cover_image_change_notification.php";
        }

        /** Push notification for post comment
         *
         *
         * @since 1.31
         *
         */

        public function PNFPB_icforum_push_notifications_post_comment_web(
            $comment_ID = null,
            $comment_approved = null,
            $commentdata = null
        ) {
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_comments_notification/pnfpb_post_comments_notification.php";
        }

        /**
         * Triggered if user comments on activity in BuddyPress to send push notifications.
         * Opt in/out for the notification can be controlled from plugin settings.
         *
         *
         * @param string   $activity_content Activity content
         * @param numeric  $user_id 			USER ID
         * @param numeric  $activity_id		Activity ID
         *
         *
         * @since 1.0.0
         */
        public function PNFPB_icforum_push_notifications_comment_web(
            $comment_id = null,
            $params = null,
            $activity = null,
            $sendschedule = "no"
        ) {
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_comments_notification/pnfpb_activities_comments_notification.php";
        }

        /*
         * Push Notification when contact form7 submitted
         *
         * @since 1.58
         *
         */
        public function pnfpb_contact_form7_send_mail()
        {
            $super_admins = get_users("role=administrator");

            if ($super_admins) {
                foreach ($super_admins as $adminuser) {
                    if (isset($adminuser->ID) && !empty($adminuser->ID)) {
                        $apiaccesskey = get_option("pnfpb_ic_fcm_google_api");

                        if (
                            (get_option("pnfpb_ic_fcm_contact_form7_enable") ==
                                1 &&
                                get_option("pnfpb_progressier_push") !== "1" &&
                                get_option("pnfpb_webtoapp_push") !== "1" &&
                                ($apiaccesskey != "" &&
                                    $apiaccesskey != false)) ||
                            (get_option("pnfpb_ic_fcm_contact_form7_enable") ==
                                1 &&
                                (get_option("pnfpb_onesignal_push") === "1" ||
                                    get_option("pnfpb_httpv1_push") === "1"))
                        ) {
                            global $wpdb;

                            $new_user_name = bp_core_get_user_displayname(
                                $adminuser->ID
                            );

                            $table_name =
                                $wpdb->prefix .
                                "pnfpb_ic_subscribed_deviceids_web";

                            $url = "https://fcm.googleapis.com/fcm/send";

                            $activity_content_push =
                                "You got a new message from contact form";

                            $notificationtitle = esc_html(
                                __(
                                    "New message from contact us page",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );

                            $titletext = get_option(
                                "pnfpb_ic_fcm_buddypress_contact_form7_text_enable"
                            );

                            if ($titletext && $titletext !== "") {
                                $notificationtitle = str_replace(
                                    "[user name]",
                                    $new_user_name,
                                    $titletext
                                );
                            }

                            $iconurl = get_option("pnfpb_ic_fcm_upload_icon");

                            // Send an email to each recipient.

                            $messageurl = esc_url(admin_url("users.php"));

                            $activity_content_push = "";

                            if (
                                get_option(
                                    "pnfpb_ic_fcm_buddypress_contact_form7_content_enable"
                                ) != false &&
                                get_option(
                                    "pnfpb_ic_fcm_buddypress_contact_form7_content_enable"
                                ) != ""
                            ) {
                                $activity_content_push = get_option(
                                    "pnfpb_ic_fcm_buddypress_contact_form7_content_enable"
                                );
                            }

                            $activity_content_push = str_replace(
                                "[user name]",
                                $new_user_name,
                                $activity_content_push
                            );

                            if (get_option("pnfpb_onesignal_push") === "1") {
                                $target_userid_array_values = [
                                    "$adminuser->ID",
                                ];

                                if (
                                    (get_option(
                                        "pnfpb_ic_fcm_loggedin_notify"
                                    ) &&
                                        get_option(
                                            "pnfpb_ic_fcm_loggedin_notify"
                                        ) === "1") ||
                                    get_option(
                                        "pnfpb_ic_fcm_frontend_enable_subscription"
                                    ) === "1"
                                ) {
                                    $target_userid_array_values = $wpdb->get_col(
                                        $wpdb->prepare(
                                            "SELECT userid FROM %i WHERE device_id LIKE %s AND userid = %d AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
                                            $table_name,
                                            "%onesignal%",
                                            $adminuser->ID
                                        )
                                    );
                                }

                                $target_userid_array = array_map(function (
                                    $value
                                ) {
                                    return $value == 1 ? "1pnfpbadm" : $value;
                                }, $target_userid_array_values);

                                $response = $this->PNFPB_icfcm_onesignal_push_notification(
                                    $adminuser->ID,
                                    $notificationtitle,
                                    $activity_content_push,
                                    $messageurl,
                                    "",
                                    $target_userid_array
                                );
                            } else {
                                if (
                                    get_option("pnfpb_shortcode_enable") ===
                                        "yes" ||
                                    get_option(
                                        "pnfpb_ic_fcm_frontend_enable_subscription"
                                    ) === "1"
                                ) {
                                    if (
                                        get_option(
                                            "pnfpb_ic_fcm_loggedin_notify"
                                        ) &&
                                        get_option(
                                            "pnfpb_ic_fcm_loggedin_notify"
                                        ) === "1"
                                    ) {
                                        $deviceids = $wpdb->get_col(
                                            $wpdb->prepare(
                                                "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > %d AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND userid = %d AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1') LIMIT %d",
                                                $table_name,
                                                0,
                                                "%webview%",
                                                "%!!%",
                                                "%@N%",
                                                $adminuser->ID,
                                                1000
                                            )
                                        );
                                    } else {
                                        $deviceids = $wpdb->get_col(
                                            $wpdb->prepare(
                                                "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = {$adminuser->ID} AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1') LIMIT %d",
                                                $table_name,
                                                "%webview%",
                                                "%!!%",
                                                "%@N%",
                                                $adminuser->ID,
                                                1000
                                            )
                                        );
                                    }
                                } else {
                                    if (
                                        get_option(
                                            "pnfpb_ic_fcm_loggedin_notify"
                                        ) &&
                                        get_option(
                                            "pnfpb_ic_fcm_loggedin_notify"
                                        ) === "1"
                                    ) {
                                        $deviceids = $wpdb->get_col(
                                            $wpdb->prepare(
                                                "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > %d AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND userid = %d LIMIT %d",
                                                $table_name,
                                                "%webview%",
                                                "%!!%",
                                                "%@N%",
                                                $adminuser->ID,
                                                1000
                                            )
                                        );
                                    } else {
                                        $deviceids = $wpdb->get_col(
                                            $wpdb->prepare(
                                                "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND userid = %d LIMIT %d",
                                                $table_name,
                                                "%webview%",
                                                "%!!%",
                                                "%@N%",
                                                $adminuser->ID,
                                                1000
                                            )
                                        );
                                    }
                                }

                                update_user_meta(
                                    1,
                                    "super_admins_contactform722",
                                    $deviceids
                                );
                                $webview = false;
                                if (
                                    get_option(
                                        "pnfpb_ic_fcm_loggedin_notify"
                                    ) &&
                                    get_option(
                                        "pnfpb_ic_fcm_loggedin_notify"
                                    ) === "1"
                                ) {
                                    $deviceidswebview = $wpdb->get_col(
                                        $wpdb->prepare(
                                            "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > %d AND device_id LIKE %s AND device_id NOT LIKE %s AND userid = %d LIMIT %d",
                                            $table_name,
                                            "%webview%",
                                            "%!!%",
                                            "%@N%",
                                            $adminuser->ID,
                                            1000
                                        )
                                    );
                                } else {
                                    $deviceidswebview = $wpdb->get_col(
                                        $wpdb->prepare(
                                            "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id LIKE %s AND device_id NOT LIKE %s AND userid = %d LIMIT 1000",
                                            $table_name,
                                            "%webview%",
                                            "%!!%",
                                            "%@N%",
                                            $adminuser->ID,
                                            1000
                                        )
                                    );
                                }

                                $imageurl = "";

                                $iconurl = bp_core_fetch_avatar([
                                    "item_id" => $adminuser->ID, // output user id of post author
                                    "type" => "full",
                                    "html" => false, // FALSE = return url, TRUE (default) = return url wrapped with html
                                ]);

                                if (count($deviceids) > 0) {
                                    $regid = $deviceids;
                                    if (
                                        get_option("pnfpb_httpv1_push") === "1"
                                    ) {
                                        $this->PNFPB_icfcm_httpv1_send_push_notification(
                                            0,
                                            $notificationtitle,
                                            stripslashes(
                                                wp_strip_all_tags(
                                                    $activity_content_push
                                                )
                                            ),
                                            $iconurl,
                                            $imageurl,
                                            $messageurl,
                                            [
                                                "thread_id" => $thread_id,
                                                "click_url" => $messageurl,
                                            ],
                                            $regid,
                                            $deviceidswebview,
                                            $adminuser->ID,
                                            0
                                        );
                                    }
                                    do_action(
                                        "PNFPB_connect_to_external_api_for_contact_form7_send_mail"
                                    );
                                }
                            }
                        }
                    }
                }
            }
        }

        /*
         *
         * Push Notification when Group
         *
         * @since 1.58
         *
         */
        public function pnfpb_new_user_registrations($user_id)
        {
            $user_meta = get_userdata($user_id);

            if (empty($user_meta)) {
                return;
            }

            $super_admins = get_users("role=administrator");

            if ($super_admins) {
                foreach ($super_admins as $adminuser) {
                    if (isset($adminuser->ID) && !empty($adminuser->ID)) {
                        /* $user_meta->user_login */

                        $apiaccesskey = get_option("pnfpb_ic_fcm_google_api");

                        if (
                            (get_option(
                                "pnfpb_ic_fcm_new_user_registration_enable"
                            ) == 1 &&
                                get_option("pnfpb_progressier_push") !== "1" &&
                                get_option("pnfpb_webtoapp_push") !== "1" &&
                                ($apiaccesskey != "" &&
                                    $apiaccesskey != false)) ||
                            (get_option(
                                "pnfpb_ic_fcm_new_user_registration_enable"
                            ) == 1 &&
                                (get_option("pnfpb_onesignal_push") === "1" ||
                                    get_option("pnfpb_httpv1_push") === "1"))
                        ) {
                            global $wpdb;

                            $new_user_name = bp_core_get_user_displayname(
                                $user_id
                            );

                            $table_name =
                                $wpdb->prefix .
                                "pnfpb_ic_subscribed_deviceids_web";

                            $url = "https://fcm.googleapis.com/fcm/send";

                            $activity_content_push =
                                "New user registered in " .
                                get_bloginfo("name");

                            $notificationtitle =
                                $new_user_name .
                                esc_html(
                                    __(
                                        " registered as new member",
                                        "push-notification-for-post-and-buddypress"
                                    )
                                );

                            $titletext = get_option(
                                "pnfpb_ic_fcm_buddypress_new_user_registration_text_enable"
                            );

                            if ($titletext && $titletext !== "") {
                                $notificationtitle = str_replace(
                                    "[user name]",
                                    $new_user_name,
                                    $titletext
                                );
                            }

                            $iconurl = get_option("pnfpb_ic_fcm_upload_icon");

                            $messageurl = esc_url(admin_url("users.php"));

                            if (
                                get_option(
                                    "pnfpb_ic_fcm_buddypress_new_user_registration_content_enable"
                                ) != false &&
                                get_option(
                                    "pnfpb_ic_fcm_buddypress_new_user_registration_content_enable"
                                ) != ""
                            ) {
                                $activity_content_push = get_option(
                                    "pnfpb_ic_fcm_buddypress_new_user_registration_content_enable"
                                );
                            }

                            $activity_content_push = str_replace(
                                "[user name]",
                                $new_user_name,
                                $activity_content_push
                            );

                            if (get_option("pnfpb_onesignal_push") === "1") {
                                $target_userid_array = [];

                                $target_userid_array_values = $wpdb->get_col(
                                    $wpdb->prepare(
                                        "SELECT userid FROM %i WHERE device_id LIKE %s AND userid = %d LIMIT %d",
                                        $table_name,
                                        "%onesignal%",
                                        $adminuser->ID,
                                        2000
                                    )
                                );

                                $target_userid_array = array_map(function (
                                    $value
                                ) {
                                    return $value == 1 ? "1pnfpbadm" : $value;
                                }, $target_userid_array_values);

                                $response = $this->PNFPB_icfcm_onesignal_push_notification(
                                    $group_id,
                                    $grouptitle,
                                    $localactivitycontent,
                                    $group_link,
                                    $group_image,
                                    $target_userid_array
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
                                    $deviceids = $wpdb->get_col(
                                        $wpdb->prepare(
                                            "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > %d AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE '%@N%' AND userid = {$adminuser->ID} LIMIT 1000",
                                            $table_name,
                                            0,
                                            "%webview%",
                                            "%!!%",
                                            "%@N%",
                                            $adminuser->ID,
                                            1000
                                        )
                                    );
                                } else {
                                    $deviceids = $wpdb->get_col(
                                        $wpdb->prepare(
                                            "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE '%@N%' AND userid = {$adminuser->ID} LIMIT 1000",
                                            $table_name,
                                            0,
                                            "%webview%",
                                            "%!!%",
                                            "%@N%",
                                            $adminuser->ID,
                                            1000
                                        )
                                    );
                                }

                                $webview = false;
                                if (
                                    get_option(
                                        "pnfpb_ic_fcm_loggedin_notify"
                                    ) &&
                                    get_option(
                                        "pnfpb_ic_fcm_loggedin_notify"
                                    ) === "1"
                                ) {
                                    $deviceidswebview = $wpdb->get_col(
                                        $wpdb->prepare(
                                            "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > 0 AND device_id LIKE %s AND device_id NOT LIKE %s AND userid = %d LIMIT 1000",
                                            $table_name,
                                            0,
                                            "%webview%",
                                            "%!!%",
                                            "%@N%",
                                            $adminuser->ID,
                                            1000
                                        )
                                    );
                                } else {
                                    $deviceidswebview = $wpdb->get_col(
                                        $wpdb->prepare(
                                            "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id LIKE %s AND device_id NOT LIKE %s AND userid = %d LIMIT 1000",
                                            $table_name,
                                            0,
                                            "%webview%",
                                            "%!!%",
                                            "%@N%",
                                            $adminuser->ID,
                                            1000
                                        )
                                    );
                                }

                                $imageurl = "";

                                $iconurl = bp_core_fetch_avatar([
                                    "item_id" => $user_id, // output user id of post author
                                    "type" => "full",
                                    "html" => false, // FALSE = return url, TRUE (default) = return url wrapped with html
                                ]);

                                if (count($deviceids) > 0) {
                                    $regid = $deviceids;
                                    if (
                                        get_option("pnfpb_httpv1_push") === "1"
                                    ) {
                                        $this->PNFPB_icfcm_httpv1_send_push_notification(
                                            0,
                                            $notificationtitle,
                                            stripslashes(
                                                wp_strip_all_tags(
                                                    $activity_content_push
                                                )
                                            ),
                                            $iconurl,
                                            $imageurl,
                                            $messageurl,
                                            ["click_url" => $messageurl],
                                            $regid,
                                            $deviceidswebview,
                                            $user_id,
                                            0
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

        /*
         *
         *
         * Push Notification when Group details updated
         *
         * @since 1.58
         */
        public function pnfpb_buddypress_group_details_updated_notification(
            $group_id
        ) {
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_group_details_update_notification/pnfpb_group_details_update_notification.php";
        }

        /*
         *
         * Push Notification for Group invitation sent
         *
         * @since 1.58
         */
        public function pnfpb_buddypress_group_invitation_notification(
            $group_id,
            $invited_users,
            $inviter_id
        ) {
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_group_invite_notification/pnfpb_group_invite_notification.php";
        }

        /*
         * Set up the Settings > Profile nav item.
         *
         * Loaded in a separate method because the Settings component may not
         * be loaded in time for BP_XProfile_Component::setup_nav().
         *
         * @since 1.52
         */
        public function pnfpb_buddypress_setup_notification_settings_nav()
        {
            global $bp;

            if (
                !bp_is_active("settings") ||
                get_option("pnfpb_ic_fcm_frontend_enable_subscription") ===
                    "0" ||
                !get_option("pnfpb_ic_fcm_frontend_enable_subscription")
            ) {
                return;
            }

            if (
                !get_option("pnfpb_ic_fcm_loggedin_notify") ||
                (get_option("pnfpb_ic_fcm_loggedin_notify") &&
                    get_option("pnfpb_ic_fcm_loggedin_notify") === "1" &&
                    is_user_logged_in()) ||
                (get_option("pnfpb_ic_fcm_loggedin_notify") &&
                    get_option("pnfpb_ic_fcm_loggedin_notify") !== "1")
            ) {
                // Determine user to use.
                if (bp_displayed_user_domain()) {
                    $user_domain = bp_displayed_user_domain();
                } elseif (bp_loggedin_user_domain()) {
                    $user_domain = bp_loggedin_user_domain();
                } else {
                    return;
                }

                // Get the settings slug.
                $settings_slug = bp_get_settings_slug();

                bp_core_new_subnav_item([
                    "name" => _x(
                        "Push Notification subscription",
                        "Push Notification subscription sub nav",
                        "push-notification-for-post-and-buddypress"
                    ),
                    "slug" => "push-subscription",
                    "parent_url" => trailingslashit($user_domain . "settings"),
                    "parent_slug" => $settings_slug,
                    "screen_function" => [
                        $this,
                        "pnfpb_buddypress_notification_settings_function",
                    ],
                    "position" => 30,
                ]);
            }
        }

        public function pnfpb_buddypress_notification_settings_function()
        {
            global $bp;
            // We never get here for some reason
            add_action("bp_template_title", [
                $this,
                "pnfpb_bp_projects_screen_title",
            ]);
            add_action("bp_template_content", [
                $this,
                "pnfpb_bp_projects_screen_content",
            ]);
            bp_core_load_template(
                apply_filters(
                    "bp_core_template_plugin",
                    "members/single/plugins"
                )
            );
        }

        public function pnfpb_bp_projects_screen_title()
        {
            global $bp;
        }

        public function pnfpb_bp_projects_screen_content()
        {
            global $bp, $wpdb;
            $args = [
                "public" => true,
                "_builtin" => false,
            ];

            $output = "names"; // or objects
            $operator = "and"; // 'and' or 'or'
            $custposttypes = get_post_types($args, $output, $operator);

            $bpsubscribeoptions = "10000000000";

            $allowed_html = [
                "a" => [
                    "href" => [],
                    "title" => [],
                ],
                "span" => [
                    "class" => [],
                ],
                "p" => [
                    "class" => [],
                ],
                "aside" => [
                    "class" => [],
                    "span" => [
                        "class" => [],
                    ],
                    "p" => [
                        "class" => [],
                    ],
                ],
                "input" => [
                    "class" => [],
                    "id" => [],
                    "name" => [],
                    "type" => [],
                    "value" => [],
                ],
                "div" => [
                    "class" => [],
                    "input" => [
                        "class" => [],
                        "id" => [],
                        "name" => [],
                        "type" => [],
                        "value" => [],
						"pnfpb_index" => []
                    ],
                ],
                "label" => [
                    "class" => [
                        "span" => [
                            "class" => [],
                        ],
                        "input" => [
                            "class" => [],
                            "id" => [],
                            "name" => [],
                            "type" => [],
                            "value" => [],
							"pnfpb_index" => []
                        ],
                    ],
                ],
                "span" => [
                    "class" => [],
                ],
                "input" => [
                    "class" => [],
                    "id" => [],
                    "name" => [],
                    "type" => [],
                    "value" => [],
					"pnfpb_index" => [],
                ],
                "button" => [
                    "class" => [],
                    "id" => [],
                    "class" => [],
                    "type" => [],
                    "style" => [],
                ],				
                "br" => [],
                "em" => [],
                "b" => [],
                "option" => [
                    "value" => [],
                    "selected" => [],
                ],
            ];
            ?>
			<form class="standard-form" id="pnfpb_push_notification_frontend-settings-form">
				
				<table class="pnfpb_ic_front_push_notification_settings_table widefat" cellspacing="0">
    				<tbody>
        				<tr class="pnfpb_ic_push_settings_table_row">
							<td class="pnfpb_ic_push_settings_table_column column-columnname">
								<div class="pnfpb_bell_icon_custom_prompt_loader_frontend" id="pnfpb_bell_icon_custom_prompt_loader_frontend"></div>
								<div class="pnfpb_row pnfpb_frontend_subscriptions_options_menu_all">
									<?php
         $args = [
             "public" => true,
             "_builtin" => false,
         ];

         $output = "names"; // or objects
         $operator = "and"; // 'and' or 'or'
         $custposttypes = get_post_types($args, $output, $operator);
         $frontend_post_push_enable = false;

         $pnfpb_html_frontend_subscription_custom_post_options = "";

         $pnfpb_push_count = 14;

         foreach ($custposttypes as $post_type) {
             if (
                 get_option("pnfpb_ic_fcm_" . $post_type . "_enable") === "1" &&
                 $post_type !== "buddypress" &&
                 $post_type !== "post"
             ) {
                 if (
                     get_option(
                         "pnfpb_ic_fcm_show_allposttype_subscriptions_custom_prompt"
                     ) === "1"
                 ) {
                     $pnfpb_ic_fcm_bell_subscription_default_label = ucwords(
                         $post_type
                     );

                     if (
                         get_option(
                             "pnfpb_ic_fcm_frontend_settings_" .
                                 $post_type .
                                 "_text"
                         )
                     ) {
                         $pnfpb_ic_fcm_bell_subscription_default_label = get_option(
                             "pnfpb_ic_fcm_frontend_settings_" .
                                 $post_type .
                                 "_text"
                         );
                     }

                     $pnfpb_html_frontend_subscription_custom_post_options .=
                         '<div class="pnfpb_column pnfpb_column_buddypress_functions">
							<div class="pnfpb_card">				
								<label class="pnfpb_ic_push_settings_table_label_checkbox 
									pnfpb_flex_grow_6 pnfpb_max_width_236" 
									for="'.esc_attr("pnfpb_ic_fcm_front_subscription_".$post_type."_enable").'">' .
                         					esc_html($pnfpb_ic_fcm_bell_subscription_default_label).
                         		'</label>
								<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
									<input id="' .
                         				esc_attr("pnfpb_ic_fcm_front_subscription_".$post_type."_enable").
                         				'" class="' .
                         				esc_attr("pnfpb_ic_fcm_front_subscription_".$post_type."_enable").
                         				'" name="' .
                         				esc_attr("pnfpb_ic_fcm_front_subscription_".$post_type."_enable").
                         				'" type="checkbox" pnfpb_index="' .
                         				esc_attr($pnfpb_push_count) .
                         				'" value="1"> 
									<span class="pnfpb_slider round"></span>
								</label>
							</div>
						</div>';
                 } else {
                     $frontend_post_push_enable = true;
                 }
             }
             $pnfpb_push_count++;
         }

         $pnfpb_ic_fcm_front_post_enable_label = esc_html(
             __("Post", "push-notification-for-post-and-buddypress")
         );

         if (get_option("pnfpb_ic_fcm_frontend_settings_post_text")) {
             $pnfpb_ic_fcm_front_post_enable_label = get_option(
                 "pnfpb_ic_fcm_frontend_settings_post_text"
             );
         }

         $pnfpb_show_push_notify_admin_types = [
             "activities",
             "comments",
             "mycomments",
             "privatemessage",
             "newmember",
             "friend_request",
             "friend_accept",
             "avatar_change",
             "coverimage_change",
         ];

         $pnfpb_show_push_notify_types = [
             "bactivity",
             "bcomment",
             "mybcomment",
             "bprivatemessage",
             "new_member",
             "friendship_request",
             "friendship_accept",
             "avatar_change",
             "cover_image_change",
         ];

         if (get_option("pnfpb_ic_fcm_post_enable") === "1") { ?>
												
			<div class="pnfpb_column pnfpb_column_buddypress_functions">
				<div class="pnfpb_card">				
					<label class="pnfpb_ic_push_settings_table_label_checkbox 
								  pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_ic_fcm_front_post_enable">
						<?php echo esc_html(
                    		get_option("pnfpb_ic_fcm_frontend_settings_post_text")
                		) ??
                    		esc_html(
                        		__("Post", "push-notification-for-post-and-buddypress")
                    	); ?>
					</label>
					<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
						<input id="pnfpb_ic_fcm_front_post_enable" 
							   class="pnfpb_ic_fcm_front_post_enable" 
							   name="pnfpb_ic_fcm_front_post_enable" 
							   type="checkbox" value="1"
						/> 
						<span class="pnfpb_slider round"></span>
					</label>
				</div>
			</div>
		<?php }

         echo wp_kses(
             $pnfpb_html_frontend_subscription_custom_post_options,
             $allowed_html
         );

         $pnfpb_push_admin_type_count = 0;

         $pnfpb_ic_fcm_front_enable_default_label = "";

         foreach ($pnfpb_show_push_notify_types as $notify_type) {
             if (
                 get_option("pnfpb_ic_fcm_" . $notify_type . "_enable") === "1"
             ) {

                 if ($notify_type === "bactivity") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "Activities",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "bcomment") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "Comments in Activity/Post",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "mybcomment") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "Comments in My Activity/My Post",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "bprivatemessage") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "New private message",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "new_member") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "New member joined",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "friendship_request") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "Friendship request",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "friendship_accept") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "Friendship accepted",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "avatar_change") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "Avatar change",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "cover_image_change") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "Cover image change",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "group_details_updated") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "Group details update",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "group_invite") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "Group Invites",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if (
                     get_option(
                         "pnfpb_ic_fcm_frontend_settings_" .
                             $post_type .
                             "_text"
                     )
                 ) {
                     $pnfpb_ic_fcm_front_enable_default_label = get_option(
                         "pnfpb_ic_fcm_frontend_settings_" .
                             $pnfpb_show_push_notify_admin_types[
                                 $pnfpb_push_admin_type_count
                             ] .
                             "_text"
                     );
                 }
                 ?>	
				<div class="pnfpb_column pnfpb_column_buddypress_functions">
					<div class="pnfpb_card">				
						<label class="pnfpb_ic_push_settings_table_label_checkbox 
									  pnfpb_flex_grow_6 pnfpb_max_width_236" 
							   	for="<?php echo esc_attr(
                    					"pnfpb_ic_fcm_front_".$notify_type."_enable"); ?>"
						>
							<?php echo esc_html($pnfpb_ic_fcm_front_enable_default_label); ?>
						</label>
						<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
							<input id="<?php echo esc_attr(
                     			"pnfpb_ic_fcm_front_".$notify_type."_enable"
                 			); ?>" class="<?php echo esc_attr(
    							"pnfpb_ic_fcm_front_".$notify_type."_enable"
							); ?>" name="<?php echo esc_attr(
    							"pnfpb_ic_fcm_front_".$notify_type."_enable"
							); ?>" type="checkbox" value="1"> 
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
				</div>
				<?php
             }
             $pnfpb_push_admin_type_count++;
         }

         						if (get_option("pnfpb_ic_fcm_group_details_updated_enable") === "1") { ?>
									
									<div class="pnfpb_column pnfpb_column_buddypress_functions">
    									<div class="pnfpb_card">
											<label class="pnfpb_ic_push_settings_table_label_checkbox 
														  pnfpb_flex_grow_6 pnfpb_max_width_236" 
												   for="pnfpb_ic_fcm_group_details_updated_enable">
														<?php if (get_option("pnfpb_ic_fcm_frontend_settings_groupdetails_text")) {
                											echo esc_html(
                    											get_option(
                        											"pnfpb_ic_fcm_frontend_settings_groupdetails_text"
                    											)
                											);
            											} else {
                											echo esc_html(
                    											__(
                        											"Group details update",
                        											"push-notification-for-post-and-buddypress"
                   												 )
                											);
            											} ?>
											</label>
											<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
												<input  id="pnfpb_ic_fcm_front_group_details_update_enable" 
													   name="pnfpb_ic_fcm_front_group_details_update_enable" 
													   type="checkbox" value="1"  
												/>	
												<span class="pnfpb_slider round"></span>
											</label>
										</div>
									</div>
									<?php }
         							if (get_option("pnfpb_ic_fcm_group_invitation_enable") === "1") { ?>
										<div class="pnfpb_column pnfpb_column_buddypress_functions">
    										<div class="pnfpb_card">
												<label class="pnfpb_ic_push_settings_table_label_checkbox 
															  pnfpb_flex_grow_6 pnfpb_max_width_236" 
													   for="pnfpb_ic_fcm_group_invite_enable"
												>
												<?php if (get_option("pnfpb_ic_fcm_frontend_settings_groupinvite_text")) {
                										echo esc_html(
                    										get_option(
                        										"pnfpb_ic_fcm_frontend_settings_groupinvite_text"
                    									)
                									);
            									} else {
                									echo esc_html(
                    									__(
                        									"Group Invites",
                        									"push-notification-for-post-and-buddypress"
                    									)
                									);
            									} ?>
											</label>
											<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
												<input  id="pnfpb_ic_fcm_front_group_invite_enable" name="pnfpb_ic_fcm_front_group_invite_enable" type="checkbox" value="1"  />	
												<span class="pnfpb_slider round"></span>
											</label>
										</div>
									</div>
									<?php }
         ?>
								</div>
							</td>
						</tr>
    				</tbody>
				</table>
			</form>
			<?php do_action("pnfpb_push_notification_frontend_before_submit"); ?>
			<div class="submit">
				<input id="submit" type="button" class="pnfpb_push_notification_frontend_settings_submit primary" 
					   name="pnfpb_push_notification_frontend_settings_submit" 
					   value="<?php echo esc_attr(__("Save Settings", "push-notification-for-post-and-buddypress")); ?>" 
					   class="auto" 
				/>
			</div>
			<br/>
			<?php do_action("pnfpb_push_notification_frontend_after_submit"); ?>
			<?php echo wp_kses(
      			'<aside class="screen-heading email-settings-screen pnfpb_ic_front_push_notification_settings_messages bp-feedback bp-messages bp-template-notice">
					<span class="bp-icon" aria-hidden="true"></span>
					<p class="pnfpb_ic_front_push_notification_settings_text">',
      					$allowed_html
  				) .
      			esc_html(
          		__(
             		 "Your notification settings have been saved.",
              		"push-notification-for-post-and-buddypress"
          		)
      		) .
      		wp_kses("</p></aside>", $allowed_html);
        }

        /** Shortcode PWA prompt install
         *
         *
         * @since 1.45
         */
        public function PNFPB_pwa_prompt_shortcode()
        {
            $pwa_install_button_color = "#ffffff";

            if (
                get_option("pnfpb_ic_fcm_install_pwa_shortcode_button_color") &&
                get_option(
                    "pnfpb_ic_fcm_install_pwa_shortcode_button_color"
                ) !== false &&
                get_option(
                    "pnfpb_ic_fcm_install_pwa_shortcode_button_color"
                ) !== ""
            ) {
                $pwa_install_button_color = get_option(
                    "pnfpb_ic_fcm_install_pwa_shortcode_button_color"
                );
            }

            $pwa_install_button_text_color = "#000000";

            if (
                get_option(
                    "pnfpb_ic_fcm_install_pwa_shortcode_button_text_color"
                ) &&
                get_option(
                    "pnfpb_ic_fcm_install_pwa_shortcode_button_text_color"
                ) !== false &&
                get_option(
                    "pnfpb_ic_fcm_install_pwa_shortcode_button_text_color"
                ) !== ""
            ) {
                $pwa_install_button_text_color = get_option(
                    "pnfpb_ic_fcm_install_pwa_shortcode_button_text_color"
                );
            }

            $pwa_install_button_text = "Install Our App";

            if (
                get_option("pnfpb_ic_fcm_install_pwa_shortcode_button_text") &&
                get_option("pnfpb_ic_fcm_install_pwa_shortcode_button_text") !==
                    false &&
                get_option("pnfpb_ic_fcm_install_pwa_shortcode_button_text") !==
                    ""
            ) {
                $pwa_install_button_text = get_option(
                    "pnfpb_ic_fcm_install_pwa_shortcode_button_text"
                );
            }

            $pwa_install_button_icon =
                '<div id="pnfpb_pwa_shortcode_box" class="pnfpb_pwa_shortcode_box"><div>
				<button type="button" id="pnfpb_pwa_button" class="pnfpb_pwa_button pnfpb_pwa_ios_button">
				<img src="' .
                	esc_url(get_option("pnfpb_ic_fcm_pwa_upload_icon_132")) .
                '" width="49px" height="49px"/></button></div><div>' .
                esc_html($pwa_install_button_text) .
                "</div></div>";

            $pwa_install_ios_messsage =
                '<div id="pnfpb-pwa-ios-message-layout" class="pnfpb-pwa-ios-message-layout">
					<div id="pnfpb-pwa-ios-message-container" class="pnfpb-pwa-ios-message-container">
							' .
                		esc_html(get_option("pnfpb-pwa-ios-message")) .
                '							
					</div>					
				</div>';

            if (
                get_option("pnfpb-pwa-shortcode-install-icon") &&
                get_option("pnfpb-pwa-shortcode-install-icon") === "1"
            ) {
                $pnfpb_pwa_prompt_shortcode =
                    '<div id="pnfpb_pwa_shortcode_box" class="pnfpb_pwa_shortcode_box">' .
                    $pwa_install_button_icon .
                    "</div>";
                $pnfpb_pwa_prompt_shortcode .= $pwa_install_ios_messsage;
            } else {
                $pnfpb_pwa_prompt_shortcode =
                    '<div id="pnfpb_pwa_shortcode_box" class="pnfpb_pwa_shortcode_box">
						<button type="button" id="pnfpb_pwa_button" class="pnfpb_pwa_button" style="color:' .
                    		esc_attr($pwa_install_button_text_color) .
                    		";background-color:" .
                    		esc_attr($pwa_install_button_color) .
                    	';">' .
                    		esc_html($pwa_install_button_text) .
                    	"</button>
					</div>";
            }

            return $pnfpb_pwa_prompt_shortcode;
        }

        /**
         * Shortcode - UnSubscribe push notification.
         *
         *
         * @since 1.1.1
         */
        public function PNFPB_subscribe_push_notification_shortcode()
        {
            if (
                !get_option("pnfpb_ic_fcm_loggedin_notify") ||
                (get_option("pnfpb_ic_fcm_loggedin_notify") &&
                    get_option("pnfpb_ic_fcm_loggedin_notify") === "1" &&
                    is_user_logged_in()) ||
                (get_option("pnfpb_ic_fcm_loggedin_notify") &&
                    get_option("pnfpb_ic_fcm_loggedin_notify") !== "1")
            ) {
                $subscribe_button_text_color = "#ffffff";

                if (
                    get_option("pnfpb_ic_fcm_subscribe_button_text_color") &&
                    get_option("pnfpb_ic_fcm_subscribe_button_text_color") !==
                        false &&
                    get_option("pnfpb_ic_fcm_subscribe_button_text_color") !==
                        ""
                ) {
                    $subscribe_button_text_color = get_option(
                        "pnfpb_ic_fcm_subscribe_button_text_color"
                    );
                }

                $subscribe_button_color = "#000000";

                if (
                    get_option("pnfpb_ic_fcm_subscribe_button_color") &&
                    get_option("pnfpb_ic_fcm_subscribe_button_color") !==
                        false &&
                    get_option("pnfpb_ic_fcm_subscribe_button_color") !== ""
                ) {
                    $subscribe_button_color = get_option(
                        "pnfpb_ic_fcm_subscribe_button_color"
                    );
                }

                $unsubscribe_shortcode_dialog_text = esc_html(
                    __(
                        "Change push subscriptions",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option(
                        "pnfpb_ic_fcm_unsubscribe_button_shortcode_text"
                    ) &&
                    get_option(
                        "pnfpb_ic_fcm_unsubscribe_button_shortcode_text"
                    ) !== false &&
                    get_option(
                        "pnfpb_ic_fcm_unsubscribe_button_shortcode_text"
                    ) !== ""
                ) {
                    $unsubscribe_shortcode_dialog_text = get_option(
                        "pnfpb_ic_fcm_unsubscribe_button_shortcode_text"
                    );
                }

                $subscribe_shortcode_dialog_text = esc_html(
                    __(
                        "Subscribe push notifications",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option(
                        "pnfpb_ic_fcm_subscribe_button_shortcode_text"
                    ) &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_button_shortcode_text"
                    ) !== false &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_button_shortcode_text"
                    ) !== ""
                ) {
                    $subscribe_shortcode_dialog_text = get_option(
                        "pnfpb_ic_fcm_subscribe_button_shortcode_text"
                    );
                }

                $subscribe_all_shortcode_dialog_text = esc_html(
                    __(
                        "All notifications",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option("pnfpb_ic_fcm_subscribe_all_dialog_text") &&
                    get_option("pnfpb_ic_fcm_subscribe_all_dialog_text") !==
                        false &&
                    get_option("pnfpb_ic_fcm_subscribe_all_dialog_text") !== ""
                ) {
                    $subscribe_all_shortcode_dialog_text = get_option(
                        "pnfpb_ic_fcm_subscribe_all_dialog_text"
                    );
                }

                $subscribe_post_activities_shortcode_dialog_text = esc_html(
                    __("Post", "push-notification-for-post-and-buddypress")
                );

                if (
                    get_option(
                        "pnfpb_ic_fcm_subscribe_post_activity_dialog_text"
                    ) &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_post_activity_dialog_text"
                    ) !== false &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_post_activity_dialog_text"
                    ) !== ""
                ) {
                    $subscribe_post_activities_shortcode_dialog_text = get_option(
                        "pnfpb_ic_fcm_subscribe_post_activity_dialog_text"
                    );
                }

                $subscribe_activities_shortcode_dialog_text = esc_html(
                    __("Activity", "push-notification-for-post-and-buddypress")
                );

                if (
                    get_option("pnfpb_ic_fcm_subscribe_activity_dialog_text") &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_activity_dialog_text"
                    ) !== false &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_activity_dialog_text"
                    ) !== ""
                ) {
                    $subscribe_activities_shortcode_dialog_text = get_option(
                        "pnfpb_ic_fcm_subscribe_activity_dialog_text"
                    );
                }

                $subscribe_all_comments_shortcode_dialog_text = esc_html(
                    __(
                        "All Comments",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option(
                        "pnfpb_ic_fcm_subscribe_all_comments_dialog_text"
                    ) &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_all_comments_dialog_text"
                    ) !== false &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_all_comments_dialog_text"
                    ) !== ""
                ) {
                    $subscribe_all_comments_shortcode_dialog_text = get_option(
                        "pnfpb_ic_fcm_subscribe_all_comments_dialog_text"
                    );
                }

                $subscribe_mypost_comments_shortcode_dialog_text = esc_html(
                    __(
                        "Comments from My Posts/my activities",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option(
                        "pnfpb_ic_fcm_subscribe_my_comments_dialog_text"
                    ) &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_my_comments_dialog_text"
                    ) !== false &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_my_comments_dialog_text"
                    ) !== ""
                ) {
                    $subscribe_mypost_comments_shortcode_dialog_text = get_option(
                        "pnfpb_ic_fcm_subscribe_my_comments_dialog_text"
                    );
                }

                $subscribe_private_message_shortcode_dialog_text = esc_html(
                    __(
                        "Private messages",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option(
                        "pnfpb_ic_fcm_subscribe_private_message_dialog_text"
                    ) &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_private_message_dialog_text"
                    ) !== false &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_private_message_dialog_text"
                    ) !== ""
                ) {
                    $subscribe_private_message_shortcode_dialog_text = get_option(
                        "pnfpb_ic_fcm_subscribe_private_message_dialog_text"
                    );
                }

                $subscribe_new_member_shortcode_dialog_text = esc_html(
                    __(
                        "New member joined",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option(
                        "pnfpb_ic_fcm_subscribe_new_member_dialog_text"
                    ) &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_new_member_dialog_text"
                    ) !== false &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_new_member_dialog_text"
                    ) !== ""
                ) {
                    $subscribe_new_member_shortcode_dialog_text = get_option(
                        "pnfpb_ic_fcm_subscribe_new_member_dialog_text"
                    );
                }

                $subscribe_friendship_request_shortcode_dialog_text = esc_html(
                    __(
                        "Friend requests",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option(
                        "pnfpb_ic_fcm_subscribe_friendship_request_dialog_text"
                    ) &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_friendship_request_dialog_text"
                    ) !== false &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_friendship_request_dialog_text"
                    ) !== ""
                ) {
                    $subscribe_friendship_request_shortcode_dialog_text = get_option(
                        "pnfpb_ic_fcm_subscribe_friendship_request_dialog_text"
                    );
                }

                $subscribe_friendship_accepted_shortcode_dialog_text = esc_html(
                    __(
                        "Friendship accepted",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option(
                        "pnfpb_ic_fcm_subscribe_friendship_accepted_dialog_text"
                    ) &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_friendship_accepted_dialog_text"
                    ) !== false &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_friendship_accepted_dialog_text"
                    ) !== ""
                ) {
                    $subscribe_friendship_accepted_shortcode_dialog_text = get_option(
                        "pnfpb_ic_fcm_subscribe_friendship_accepted_dialog_text"
                    );
                }

                $subscribe_user_avatar_shortcode_dialog_text = esc_html(
                    __(
                        "User avatar change",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option(
                        "pnfpb_ic_fcm_subscribe_user_avatar_dialog_text"
                    ) &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_user_avatar_dialog_text"
                    ) !== false &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_user_avatar_dialog_text"
                    ) !== ""
                ) {
                    $subscribe_user_avatar_shortcode_dialog_text = get_option(
                        "pnfpb_ic_fcm_subscribe_user_avatar_dialog_text"
                    );
                }

                $subscribe_cover_image_change_shortcode_dialog_text = esc_html(
                    __(
                        "Cover image change",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option(
                        "pnfpb_ic_fcm_subscribe_cover_image_change_dialog_text"
                    ) &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_cover_image_change_dialog_text"
                    ) !== false &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_cover_image_change_dialog_text"
                    ) !== ""
                ) {
                    $subscribe_cover_image_change_shortcode_dialog_text = get_option(
                        "pnfpb_ic_fcm_subscribe_cover_image_change_dialog_text"
                    );
                }

                $subscribe_group_details_update_shortcode_dialog_text = esc_html(
                    __(
                        "Group details update",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option(
                        "pnfpb_ic_fcm_subscribe_group_details_update_dialog_text"
                    ) &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_group_details_update_dialog_text"
                    ) !== false &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_group_details_update_dialog_text"
                    ) !== ""
                ) {
                    $subscribe_group_details_update_shortcode_dialog_text = get_option(
                        "pnfpb_ic_fcm_subscribe_group_details_update_dialog_text"
                    );
                }

                $subscribe_group_invite_shortcode_dialog_text = esc_html(
                    __(
                        "Group invite",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option("pnfpb_ic_fcm_subscribe_invite_dialog_text") &&
                    get_option("pnfpb_ic_fcm_subscribe_invite_dialog_text") !==
                        false &&
                    get_option("pnfpb_ic_fcm_subscribe_invite_dialog_text") !==
                        ""
                ) {
                    $subscribe_invite_shortcode_dialog_text = get_option(
                        "pnfpb_ic_fcm_subscribe_invite_dialog_text"
                    );
                }

                $unsubscribe_all_shortcode_dialog_text = esc_html(
                    __(
                        "Un-Subscribe all",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option("pnfpb_ic_fcm_unsubscribe_all_dialog_text") &&
                    get_option("pnfpb_ic_fcm_unsubscribe_all_dialog_text") !==
                        false &&
                    get_option("pnfpb_ic_fcm_unsubscribe_all_dialog_text") !==
                        ""
                ) {
                    $unsubscribe_all_shortcode_dialog_text = get_option(
                        "pnfpb_ic_fcm_unsubscribe_all_dialog_text"
                    );
                }

                $pnfpb_notification_shortcode =
                    '<div id="pnfpb-unsubscribe-notifications" class="pnfpb-unsubscribe-notifications">';

                $pnfpb_notification_shortcode .=
                    '<button type="button" id="pnfpb_unsubscribe_button" class="pnfpb_unsubscribe_button" style="color:' .
                    esc_attr($subscribe_button_text_color) .
                    ";background-color:" .
                    esc_attr($subscribe_button_color) .
                    '">' .
                    esc_html($unsubscribe_shortcode_dialog_text) .
                    "</button>";

                $pnfpb_notification_shortcode .=
                    '<button type="button" id="pnfpb_subscribe_button" class="pnfpb_subscribe_button" style="color:' .
                    esc_attr($subscribe_button_text_color) .
                    ";background-color:" .
                    esc_attr($subscribe_button_color) .
                    '">' .
                    esc_html($subscribe_shortcode_dialog_text) .
                    "</button></div>";

                $pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text = esc_html(
                    __(
                        "You are subscribed. Change/Update subscriptions according to your choice.",
                        "push-notification-for-post-and-buddypress"
                    )
                );
                if (
                    get_option(
                        "pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text"
                    ) &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text"
                    ) !== false &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text"
                    ) !== ""
                ) {
                    $pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text = get_option(
                        "pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text"
                    );
                }

                $pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text = esc_html(
                    __(
                        "Please wait...subscribing push notification is in progress.",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option(
                        "pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text"
                    ) &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text"
                    ) !== false &&
                    get_option(
                        "pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text"
                    ) !== ""
                ) {
                    $pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text = get_option(
                        "pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text"
                    );
                }

                $args = [
                    "public" => true,
                    "_builtin" => false,
                ];

                $output = "names"; // or objects
                $operator = "and"; // 'and' or 'or'

                $custposttypes = get_post_types($args, $output, $operator);

                $frontend_post_push_enable = false;

                $pnfpb_html_shortcode_subscription_custom_post_options = "";

                $pnfpb_push_count = 14;

                foreach ($custposttypes as $post_type) {
                    if (
                        get_option("pnfpb_ic_fcm_" . $post_type . "_enable") ===
                            "1" &&
                        $post_type !== "buddypress"
                    ) {
                        if (
                            get_option(
                                "pnfpb_ic_fcm_show_allposttype_subscriptions_custom_prompt"
                            ) === "1"
                        ) {
                            $pnfpb_ic_fcm_bell_subscription_default_label = ucwords(
                                $post_type
                            );

                            if (
                                get_option(
                                    "pnfpb_ic_fcm_subscribe_" .
                                        $post_type .
                                        "_dialog_text"
                                )
                            ) {
                                $pnfpb_ic_fcm_bell_subscription_default_label = get_option(
                                    "pnfpb_ic_fcm_subscribe_" .
                                        $post_type .
                                        "_dialog_text"
                                );
                            }

                            $pnfpb_html_shortcode_subscription_custom_post_options .=
                                '<div class="pnfpb_ic_subscription_menu">
								<div class="pnfpb_ic_subscription_input">
									<input id="'.
                                		esc_attr("pnfpb_ic_subscribe_".$post_type."_shortcode_enable") .
                                	'" class="' .
                                		esc_attr("pnfpb_ic_subscribe_".$post_type."_shortcode_enable") .
                                	'" name="' .
                                		esc_attr("pnfpb_ic_subscribe_".$post_type."_shortcode_enable") .
                                	'"' .
                                		esc_attr($pnfpb_push_count) .
                                	'" type="checkbox" value="1" ' .
                                		checked(
                                   		 	"1",
                                    		esc_attr(get_option(
                                       	 	"pnfpb_ic_subscribe_" .
                                            	$post_type .
                                            	"_shortcode_enable"
                                    		))
                                		) .
                                '  />
								</div>
								<div class="pnfpb_ic_subscription_checkbox">
									<label class="pnfpb_ic_push_settings_table_label_checkbox" for="' .
                                esc_attr("pnfpb_ic_subscribe_".$post_type."_shortcode_enable") .
                                '">' .
                                esc_html($pnfpb_ic_fcm_bell_subscription_default_label) .
                                '</label>
								</div>
							</div>';
                        } else {
                            $frontend_post_push_enable = true;
                        }
                    }
                    $pnfpb_push_count++;
                }
                if (get_option("pnfpb_ic_fcm_post_enable") === "1") {
                    $frontend_post_push_enable = true;
                }

                $pnfpb_notification_shortcode .=
                    '
			<div id="pnfpb_subscribe_dialog_confirm" class="pnfpb_subscribe_dialog_confirm  ui-helper-clearfix" title="Subscribe notification?">
				<div id="pnfpb_subscribe_dialog_confirm_heading_notoken" class="pnfpb_subscribe_dialog_confirm_heading_notoken">' .
                    esc_html(
                        $pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text
                    ) .
                    '</div>
				<div id="pnfpb_subscribe_dialog_confirm_heading_token" class="pnfpb_subscribe_dialog_confirm_heading_token">' .
                    esc_html(
                        $pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text
                    ) .
                    '</div>				
				<div class="pnfpb_ic_subscription_menu">
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_all_shortcode_enable" name="pnfpb_ic_subscribe_all_shortcode_enable" type="checkbox" value="1" ' .
                    		checked(
                        	"1",
                        	esc_attr(get_option("pnfpb_ic_subscribe_all_shortcode_enable"))
                    		) .
                    '  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_all_shortcode_enable">' .
                    esc_html($subscribe_all_shortcode_dialog_text) .
                    '</label>
					</div>
				</div>';

                if ($frontend_post_push_enable) {
                    $pnfpb_notification_shortcode .=
                        '
					<div class="pnfpb_ic_subscription_menu">
						<div class="pnfpb_ic_subscription_input">
							<input id="pnfpb_ic_subscribe_post_activities_shortcode_enable" name="pnfpb_ic_subscribe_post_activities_shortcode_enable" type="checkbox" value="1" ' .
                        	checked(
                           	 "1",
                            	esc_attr(get_option(
                                	"pnfpb_ic_subscribe_post_activities_shortcode_enable"
                            	))
                        ) .
                        '  />
						</div>
						<div class="pnfpb_ic_subscription_checkbox">
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_post_activities_shortcode_enable">' .
                        	esc_html(
                            	$subscribe_post_activities_shortcode_dialog_text
                        	) .
                        '</label>
						</div>
					</div>';
                }

                if (get_option("pnfpb_ic_fcm_bactivity_enable") === "1") {
                    $pnfpb_notification_shortcode .=
                        '
					<div class="pnfpb_ic_subscription_menu">
						<div class="pnfpb_ic_subscription_input">
							<input id="pnfpb_ic_subscribe_activities_shortcode_enable" name="pnfpb_ic_subscribe_activities_shortcode_enable" type="checkbox" value="1" ' .
                        	checked(
                           	 "1",
                            	esc_attr(get_option(
                                "pnfpb_ic_subscribe_activities_shortcode_enable"
                            	))
                        	) .
                        '  />
						</div>
						<div class="pnfpb_ic_subscription_checkbox">
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_activities_shortcode_enable">' .
                        		esc_html($subscribe_activities_shortcode_dialog_text) .
                        '</label>
						</div>
					</div>';
                }

                $pnfpb_notification_shortcode .= $pnfpb_html_shortcode_subscription_custom_post_options;

                if (
                    get_option("pnfpb_ic_fcm_bcomment_enable") === "1" &&
                    get_option(
                        "pnfpb_ic_fcm_buddypress_comments_radio_enable"
                    ) === "1"
                ) {
                    $pnfpb_notification_shortcode .=
                        '
					<div class="pnfpb_ic_subscription_menu">
						<div class="pnfpb_ic_subscription_input">
							<input id="pnfpb_ic_subscribe_all_comments_shortcode_enable" name="pnfpb_ic_subscribe_all_comments_shortcode_enable" type="checkbox" value="1" ' .
                        	checked(
                            	"1",
                            	esc_attr(get_option(
                                	"pnfpb_ic_subscribe_all_comments_shortcode_enable"
                            	))
                        ) .
                        '  />
						</div>
						<div class="pnfpb_ic_subscription_checkbox">
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_all_comments_shortcode_enable">' .
                        	esc_html(
                            	$subscribe_all_comments_shortcode_dialog_text
                        	) .
                        '</label>
						</div>
					</div>';
                }

                if (
                    get_option("pnfpb_ic_fcm_bcomment_enable") === "1" &&
                    get_option(
                        "pnfpb_ic_fcm_buddypress_comments_radio_enable"
                    ) === "2"
                ) {
                    $pnfpb_notification_shortcode .=
                        '
				<div class="pnfpb_ic_subscription_menu">
					<div   class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_my_post_shortcode_enable" name="pnfpb_ic_subscribe_my_post_shortcode_enable" type="checkbox" value="1" ' .
                        	checked(
                            "1",
                            esc_attr(get_option(
                                "pnfpb_ic_subscribe_my_post_shortcode_enable"
                            ))
                        ) .
                        '  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_my_post_shortcode_enable">' .
                        esc_html(
                            $subscribe_mypost_comments_shortcode_dialog_text
                        ) .
                        '</label>
					</div>
				</div>';
                }

                if (get_option("pnfpb_ic_fcm_bprivatemessage_enable") === "1") {
                    $pnfpb_notification_shortcode .=
                        '
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_private_message_shortcode_enable" name="pnfpb_ic_subscribe_private_message_shortcode_enable" type="checkbox" value="1" ' .
                        	checked(
                            "1",
                            esc_attr(get_option(
                                "pnfpb_ic_subscribe_private_message_shortcode_enable"
                            ))
                        ) .
                        '  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_private_message_shortcode_enable">' .
                        esc_html(
                            $subscribe_private_message_shortcode_dialog_text
                        ) .
                        '</label>
					</div>
				</div>';
                }

                if (get_option("pnfpb_ic_fcm_new_member_enable") === "1") {
                    $pnfpb_notification_shortcode .=
                        '
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_new_member_shortcode_enable" name="pnfpb_ic_subscribe_new_member_shortcode_enable" type="checkbox" value="1" ' .
                        checked(
                            "1",
                            esc_attr(get_option(
                                "pnfpb_ic_subscribe_new_member_shortcode_enable"
                            ))
                        ) .
                        '  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_new_member_shortcode_enable" >' .
                        	esc_html($subscribe_new_member_shortcode_dialog_text) .
                        '</label>
					</div>
				</div>';
                }

                if (
                    get_option("pnfpb_ic_fcm_friendship_request_enable") === "1"
                ) {
                    $pnfpb_notification_shortcode .=
                        '
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_friendship_request_shortcode_enable" name="pnfpb_ic_subscribe_friendship_request_shortcode_enable" type="checkbox" value="1" ' .
                        checked(
                            "1",
                            esc_attr(get_option(
                                "pnfpb_ic_subscribe_friendship_request_shortcode_enable"
                            ))
                        ) .
                        '  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_friendship_request_shortcode_enable" >' .
                        esc_html(
                            $subscribe_friendship_request_shortcode_dialog_text
                        ) .
                        '</label>
					</div>
				</div>';
                }

                if (
                    get_option("pnfpb_ic_fcm_friendship_accept_enable") === "1"
                ) {
                    $pnfpb_notification_shortcode .=
                        '
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_friendship_accepted_shortcode_enable" name="pnfpb_ic_subscribe_friendship_accepted_shortcode_enable" type="checkbox" value="1" ' .
                        checked(
                            "1",
                            esc_attr(get_option(
                                "pnfpb_ic_subscribe_friendship_accepted_shortcode_enable"
                            ))
                        ) .
                        '  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_friendship_accepted_shortcode_enable" >' .
                        esc_html(
                            $subscribe_friendship_accepted_shortcode_dialog_text
                        ) .
                        '</label>
					</div>
				</div>';
                }

                if (get_option("pnfpb_ic_fcm_avatar_change_enable") === "1") {
                    $pnfpb_notification_shortcode .=
                        '
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_user_avatar_shortcode_enable" name="pnfpb_ic_subscribe_user_avatar_shortcode_enable" type="checkbox" value="1" ' .
                        checked(
                            "1",
                            esc_attr(get_option(
                                "pnfpb_ic_subscribe_user_avatar_shortcode_enable"
                            ))
                        ) .
                        '  />
					</div>
					<div  class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_user_avatar_shortcode_enable">' .
                        	esc_html($subscribe_user_avatar_shortcode_dialog_text) .
                        '</label>
					</div>
				</div>';
                }

                if (
                    get_option("pnfpb_ic_fcm_cover_image_change_enable") === "1"
                ) {
                    $pnfpb_notification_shortcode .=
                        '
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_cover_image_change_shortcode_enable" name="pnfpb_ic_subscribe_cover_image_change_shortcode_enable" type="checkbox" value="1" ' .
                        checked(
                            "1",
                            esc_attr(get_option(
                                "pnfpb_ic_subscribe_cover_image_change_shortcode_enable"
                            ))
                        ) .
                        '  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_cover_image_change_shortcode_enable" >' .
                        esc_html(
                            $subscribe_cover_image_change_shortcode_dialog_text
                        ) .
                        '</label>
					</div>
				</div>';
                }

                if (
                    get_option("pnfpb_ic_fcm_group_details_updated_enable") ===
                    "1"
                ) {
                    $pnfpb_notification_shortcode .=
                        '
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_group_details_update_shortcode_enable" name="pnfpb_ic_subscribe_group_details_update_shortcode_enable" type="checkbox" value="1" ' .
                        checked(
                            "1",
                            esc_attr(get_option(
                                "pnfpb_ic_subscribe_group_details_update_shortcode_enable"
                            ))
                        ) .
                        '  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_group_details_update_shortcode_enable" >' .
                        esc_html(
                            $subscribe_group_details_update_shortcode_dialog_text
                        ) .
                        '</label>
					</div>
				</div>';
                }

                if (
                    get_option("pnfpb_ic_fcm_group_invitation_enable") === "1"
                ) {
                    $pnfpb_notification_shortcode .=
                        '
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_group_invite_shortcode_enable" name="pnfpb_ic_subscribe_invite_shortcode_enable" type="checkbox" value="1" ' .
                        checked(
                            "1",
                            esc_attr(get_option(
                                "pnfpb_ic_subscribe_invite_shortcode_enable"
                            ))
                        ) .
                        '  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_invite_shortcode_enable" >' .
                        esc_html(
                            $subscribe_group_invite_shortcode_dialog_text
                        ) .
                        '</label>
					</div>
				</div>';
                }

                $pnfpb_notification_shortcode .=
                    '
				<div class="pnfpb_ic_subscription_menu"><div class="pnfpb_ic_subscription_input">
					<input id="pnfpb_ic_unsubscribe_all_shortcode_enable" name="pnfpb_ic_unsubscribe_all_shortcode_enable" type="checkbox" value="1" ' .
                    checked(
                        "1",
                        esc_attr(get_option("pnfpb_ic_unsubscribe_all_shortcode_enable")
                    )) .
                    '  />
				</div>
				<div class="pnfpb_ic_subscription_checkbox"> 
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_unsubscribe_all_shortcode_enable">' .
                    esc_html($unsubscribe_all_shortcode_dialog_text) .
                    '</label>
				</div>
			</div>
		</div>';

                $pnfpb_notification_shortcode .=
                    '<div id="pnfpb-unsubscribe-dialog" title="Confirmation">
						<div id="pnfpb-unsubscribe-alert-msg" class="pnfpb-unsubscribe-alert-msg"></div>
					</div>';

                return $pnfpb_notification_shortcode;
            }
        }

        /**
         * Subscription to notification for users who joined in specific groups
         * Group notification
         *
         * @since 1.8
         */
        public function PNFPB_subscribe_to_group_button($grp_btn = [])
        {
            global $groups_template, $wpdb;

            if (isset($GLOBALS["groups_template"]->group)) {
                $group = $GLOBALS["groups_template"]->group;
            } else {
                $group = groups_get_current_group();
            }

            $bpuserid = 0;

            if (
                is_user_logged_in() &&
                get_option("pnfpb_ic_fcm_buddypress_enable") == 2
            ) {
                $bpuserid = get_current_user_id();

                $cookievalue = "";
                if (
                    isset(
                        $_COOKIE["pnfpb_group_push_notification_" . $group->id]
                    )
                ) {
                    $cookievalue = wp_unslash(
                        sanitize_text_field(
                            $_COOKIE[
                                "pnfpb_group_push_notification_" . $group->id
                            ]
                        )
                    );
                }

                $table = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

                $deviceid_select_status = 0;

                $isWebView = false;

                if (
                    strpos(
                        wp_unslash(
                            sanitize_text_field($_SERVER["HTTP_USER_AGENT"])
                        ),
                        "Mobile/"
                    ) !== false &&
                    strpos(
                        wp_unslash(
                            sanitize_text_field($_SERVER["HTTP_USER_AGENT"])
                        ),
                        "Safari/"
                    ) == false
                ) {
                    $isWebView = true;
                }

                if (
                    strpos(
                        wp_unslash(
                            sanitize_text_field($_SERVER["HTTP_USER_AGENT"])
                        ),
                        "wv"
                    ) !== false
                ) {
                    $isWebView = true;
                }

                if ($cookievalue != "" && $isWebView) {
                    $deviceid_select_status = $wpdb->query(
                        $wpdb->prepare(
                            "SELECT * FROM %i WHERE device_id LIKE %s AND device_id LIKE %s AND userid = %d",
                            $table,
                            "%!!" . $group->id . "%",
                            "%webview%",
							$bpuserid
                        )
                    );
                } else {
                    $deviceid_select_status = $wpdb->query(
                        $wpdb->prepare(
                            "SELECT * FROM %i WHERE device_id LIKE %s AND userid = %d",
                            $table,
                            "%!!" . $group->id . "!!" . $cookievalue . "%",
							$bpuserid
                        )
                    );
                }

                $unsubscribe_button_text = esc_html(
                    __(
                        "Unsubscribe push notifications",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option("pnfpb_ic_fcm_unsubscribe_button_text") &&
                    get_option("pnfpb_ic_fcm_unsubscribe_button_text") !==
                        false &&
                    get_option("pnfpb_ic_fcm_unsubscribe_button_text") !== ""
                ) {
                    $unsubscribe_button_text = get_option(
                        "pnfpb_ic_fcm_unsubscribe_button_text"
                    );
                }

                $subscribe_button_text = esc_html(
                    __(
                        "Subscribe to push notifications",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                if (
                    get_option("pnfpb_ic_fcm_subscribe_button_text") &&
                    get_option("pnfpb_ic_fcm_subscribe_button_text") !==
                        false &&
                    get_option("pnfpb_ic_fcm_subscribe_button_text") !== ""
                ) {
                    $subscribe_button_text = get_option(
                        "pnfpb_ic_fcm_subscribe_button_text"
                    );
                }

                $subscribe_button_icon_text = "";

                $unsubscribe_button_icon_text = "";

                if (
                    get_option(
                        "pnfpb_subscribe_group_push_notification_icon"
                    ) &&
                    get_option(
                        "pnfpb_subscribe_group_push_notification_icon"
                    ) !== false &&
                    get_option(
                        "pnfpb_subscribe_group_push_notification_icon"
                    ) !== ""
                ) {
                    $subscribe_button_icon_text = get_option(
                        "pnfpb_subscribe_group_push_notification_icon"
                    );
                }

                if (
                    get_option(
                        "pnfpb_unsubscribe_group_push_notification_icon"
                    ) &&
                    get_option(
                        "pnfpb_unsubscribe_group_push_notification_icon"
                    ) !== false &&
                    get_option(
                        "pnfpb_unsubscribe_group_push_notification_icon"
                    ) !== ""
                ) {
                    $unsubscribe_button_icon_text = get_option(
                        "pnfpb_unsubscribe_group_push_notification_icon"
                    );
                }

                $link_subscribe_text = $subscribe_button_text;

                $link_unsubscribe_text = $unsubscribe_button_text;

                if (
                    $subscribe_button_icon_text != "" &&
                    (get_option(
                        "pnfpb_subscribe_group_push_notification_icon_enable"
                    ) &&
                        get_option(
                            "pnfpb_subscribe_group_push_notification_icon_enable"
                        ) === "1")
                ) {
                    $link_subscribe_text =
                        '<img src="' .
                        esc_url($subscribe_button_icon_text) .
                        '" alt="' .
                        $subscribe_button_text .
                        '"/>';
                }

                if (
                    $unsubscribe_button_icon_text != "" &&
                    (get_option(
                        "pnfpb_subscribe_group_push_notification_icon_enable"
                    ) &&
                        get_option(
                            "pnfpb_subscribe_group_push_notification_icon_enable"
                        ) === "1")
                ) {
                    $link_unsubscribe_text =
                        '<img src="' .
                        esc_url($unsubscribe_button_icon_text) .
                        '" alt="' .
                        $unsubscribe_button_text .
                        '"/>';
                }
                if (
                    $deviceid_select_status === 0 &&
                    groups_is_user_member($bpuserid, $group->id)
                ) {
                    // Setup button attributes.
                    $button = [
                        "id" => "subscribe_notification_group",
                        "component" => "groups",
                        "must_be_logged_in" => true,
                        "block_self" => false,
                        "wrapper_class" => "subscribegroupbutton",
                        "wrapper_id" => "subscribegroupbutton-" . $group->id,
                        "link_text" => $link_subscribe_text,
                        "link_href" => "",
                        "link_class" =>
                            "subscribe-notification-group subscribe-init-display-off subscribegroupbutton-" .
                            $group->id,
                        "button_element" => "button",
                        "parent_attr" => [
                            "id" => "",
                            "class" =>
                                "bp-generic-meta groups-meta action subscribegroupbutton subscribe-init-display-off",
                        ],
                        "button_attr" => [
                            "data-group-id" => $group->id,
                            "data-user-id" => $bpuserid,
                            "data-title" => $subscribe_button_text,
                            "data-title-displayed" => $subscribe_button_text,
                        ],
                    ];
                } else {
                    // Setup button attributes.
                    $button = [
                        "id" => "subscribe_notification_group",
                        "component" => "groups",
                        "must_be_logged_in" => true,
                        "block_self" => false,
                        "wrapper_class" =>
                            "subscribegroupbutton subscribe-display-off subscribe-init-display-off",
                        "wrapper_id" => "subscribegroupbutton-" . $group->id,
                        "link_text" => $link_subscribe_text,
                        "link_href" => "",
                        "link_class" =>
                            "subscribe-notification-group subscribe-display-off subscribe-init-display-off subscribegroupbutton-" .
                            $group->id,
                        "button_element" => "button",
                        "parent_attr" => [
                            "id" => "",
                            "class" =>
                                "bp-generic-meta groups-meta action subscribegroupbutton subscribe-display-off subscribe-init-display-off",
                        ],
                        "button_attr" => [
                            "data-group-id" => $group->id,
                            "data-user-id" => $bpuserid,
                            "data-title" => $subscribe_button_text,
                            "data-title-displayed" => $subscribe_button_text,
                        ],
                    ];
                }
                bp_button($button);

                if (
                    $deviceid_select_status > 0 &&
                    groups_is_user_member($bpuserid, $group->id)
                ) {
                    // Setup button attributes.
                    $button = [
                        "id" => "unsubscribe_notification_group",
                        "component" => "groups",
                        "must_be_logged_in" => true,
                        "block_self" => false,
                        "wrapper_class" => "unsubscribegroupbutton",
                        "wrapper_id" => "unsubscribegroupbutton-" . $group->id,
                        "link_text" => $link_unsubscribe_text,
                        "link_href" => "",
                        "link_class" =>
                            "unsubscribe-notification-group subscribe-init-display-off unsubscribegroupbutton-" .
                            $group->id,
                        "button_element" => "button",
                        "parent_attr" => [
                            "id" => "",
                            "class" =>
                                "bp-generic-meta groups-meta action unsubscribegroupbutton subscribe-init-display-off",
                        ],
                        "button_attr" => [
                            "data-group-id" => $group->id,
                            "data-user-id" => $bpuserid,
                            "data-title" => $unsubscribe_button_text,
                            "data-title-displayed" => $unsubscribe_button_text,
                        ],
                    ];
                    bp_button($button);
                } else {
                    // Setup button attributes.
                    $button = [
                        "id" => "unsubscribe_notification_group",
                        "component" => "groups",
                        "must_be_logged_in" => true,
                        "block_self" => false,
                        "wrapper_class" =>
                            "unsubscribegroupbutton subscribe-display-off subscribe-init-display-off",
                        "wrapper_id" => "unsubscribegroupbutton-" . $group->id,
                        "link_text" => $link_unsubscribe_text,
                        "link_href" => "",
                        "link_class" =>
                            "unsubscribe-notification-group subscribe-display-off subscribe-init-display-off unsubscribegroupbutton-" .
                            $group->id,
                        "button_element" => "button",
                        "parent_attr" => [
                            "id" => "",
                            "class" =>
                                "bp-generic-meta groups-meta action unsubscribegroupbutton subscribe-display-off subscribe-init-display-off",
                        ],
                        "button_attr" => [
                            "data-group-id" => $group->id,
                            "data-user-id" => $bpuserid,
                            "data-title" => $unsubscribe_button_text,
                            "data-title-displayed" => $unsubscribe_button_text,
                        ],
                    ];
                    bp_button($button);
                }
            }
            return $grp_btn;
        }

        /**
         * UnSubscribe push notification ajax callback.
         *
         *
         * @since 1.1.1
         */
        public function PNFPB_unsubscribe_push_callback()
        {
            global $wpdb;
            include plugin_dir_path(__FILE__) .
                "public/ajax_routines/pnfpb_update_unsubscribe_deviceids.php";
            wp_die();
        }

        /**
         * New REST api to get subscription token from Android app/Ios app to send push notifications
         *
         * @since 1.36
         *
         */
        public function PNFPB_rest_api_subscription_tokens_from_app()
        {
            register_rest_route("PNFPBpush/v1", "/subscriptiontoken", [
                "methods" => "POST",
                "callback" => [$this, "PNFPB_get_subscription_tokens_from_app"],
                "permission_callback" => "__return_true",
                "args" => [
                    "id" => [
                        "sanitize_callback" => function (
                            $value,
                            $request,
                            $param
                        ) {
                            return $value;
                        },
                    ],
                ],
            ]);
        }

        /**
         * Insert subscription token received in rest api from Android app/Ios app for push notifications
         *
         * @since 1.36
         *
         */
        public function PNFPB_get_subscription_tokens_from_app(
            WP_REST_Request $request
        ) {
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_mobile_app_notification_api_routine/pnfpb_mobile_app_notification_api_routine.php";
        }

        /**
         * To generate secret key to integrate app from admin area under plugin settings
         *
         *
         * @since 1.36
         */
        public function PNFPB_icfcm_integrate_app()
        {
            global $wpdb;
            if (isset($_POST["submit"])) {
                $bytes = random_bytes(16);
                update_option(
                    "PNFPB_icfcm_integrate_app_secret_code",
                    bin2hex($bytes)
                );
            }

            if (
                isset($_POST["disable_sw_file"]) &&
                get_option(
                    "pnfpb_ic_disable_serviceworker_pwa_pushnotification"
                ) === "1"
            ) {
                update_option(
                    "pnfpb_ic_disable_serviceworker_pwa_pushnotification",
                    null
                );
            } else {
                if (isset($_POST["disable_sw_file"])) {
                    update_option(
                        "pnfpb_ic_disable_serviceworker_pwa_pushnotification",
                        "1"
                    );
                }
            }
            ?>

			<h1 class="pnfpb_ic_push_settings_header"><?php echo esc_html(
       __(
           "PNFPB - API for Mobile app integration",
           "push-notification-for-post-and-buddypress"
       )
   ); ?></h1>
			<div class="nav-tab-wrapper">
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb-icfcm-slug"); ?>" 
	   				class="nav-tab tab">
						<?php echo esc_html(
    					__("Push Settings", "push-notification-for-post-and-buddypress")
					); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_device_tokens_list"); ?>" 
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("Device tokens", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_pwa_app_settings"); ?>" 
					class="nav-tab tab  ">
						<?php echo esc_html(
    						__("PWA", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfmtest_notification"); ?>"
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("Send push notification", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc"); ?>"
	   				class=" nav-tab tab">
						<?php echo esc_html(
    						__("Push Notifications list", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_frontend_settings"); ?>"
	   				class="nav-tab tab ">
					<?php echo esc_html(
    					__(
        					"Frontend subscription settings",
        					"push-notification-for-post-and-buddypress"
    					)
					); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_button_settings"); ?>"
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("Customize buttons", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_integrate_app"); ?>" 
	   				class="nav-tab tab active nav-tab-active">
						<?php echo esc_html(
    						__("Integrate Mobile app", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_settings_for_ngnix_server"); ?>"
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("NGINX", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1"); ?>"
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("Action Scheduler", "push-notification-for-post-and-buddypress")
					); ?>
			</a>
		</div>

			<div class="pnfpb_column_1200">
			<h2 class="pnfpb_ic_push_settings_header2"><?php echo esc_html(
       __(
           "Generate secret key for Android/Ios app integration",
           "push-notification-for-post-and-buddypress"
       )
   ); ?></h2>
			<h4 class="pnfpb_ic_push_settings_header2"><?php echo esc_html(
       __(
           "This secret key will be used to get subscription token in secured manner from Android/Ios app to store it in WordPress Database table to send push notifications for app users",
           "push-notification-for-post-and-buddypress"
       )
   ); ?></h4>
			<h4 class="pnfpb_ic_push_settings_header2"><?php echo esc_html(
       __(
           "Use this secret key in http post request using this rest api from app",
           "push-notification-for-post-and-buddypress"
       )
   ); ?></h4>
			<form method="post" enctype="multipart/form-data" class="form-field">
				<table class="pnfpb_ic_push_settings_table widefat fixed">
    				<tbody>
    					<tr  class="pnfpb_ic_push_settings_table_row">
							<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
								<div><?php submit_button(
            __(
                "Generate/Change secret key",
                "push-notification-for-post-and-buddypress"
            ),
            "primary"
        ); ?></div>
								<label><?php echo esc_html(
            get_option("PNFPB_icfcm_integrate_app_secret_code")
        ); ?></label>
							</td>							
    					</tr>						
					</tbody>
				</table>
			</form>
			<br/>
			<h4>REST API url post method to get subscription token from app users to send push notification
https://domainname.com/wp-json/PNFPBpush/v1/subscriptiontoken</h4>
			<br/>
			<h4>Documentation on how to use API to integrate this plugin push notification with mobile app is in this link <a href="https://www.muraliwebworld.com/groups/wordpress-plugins-by-muralidharan-indiacitys-com-technologies/forum/topic/integrate-push-notification-for-post-buddypress-wp-in-mobile-app-webview/" target="_blank">Integrate it with native mobile app users to send push notifications for app users</a></h4>
			<br />
			<div id="pnfpb-admin-right_sidebar">
				<h4><?php echo esc_html(
        __(
            "Mobile app integration help on github respository",
            "push-notification-for-post-and-buddypress"
        )
    ); ?></h4>
				<ol>
					<li><a href="https://github.com/muraliwebworld/android-app-to-integrate-push-notification-wordpress-plugin" target="_blank"><?php echo esc_html(
         __(
             "Procedure/Sample code to Integrate Android mobile app with this plugin using API",
             "push-notification-for-post-and-buddypress"
         )
     ); ?></a></li>
					<li><a href="https://github.com/muraliwebworld/ios-swift-app-to-integrate-push-notification-wordpress-plugin" target="_blank"><?php echo esc_html(
         __(
             "Procedure/Sample code to Integrate IOS mobile app with this plugin using API",
             "push-notification-for-post-and-buddypress"
         )
     ); ?></a></li>
				</ol>
			</div>
			<br /><br />			
			<div><h2 class="pnfpb_ic_push_settings_header"><?php echo esc_html(
       __(
           "Disable push notification service worker file and PWA",
           "push-notification-for-post-and-buddypress"
       )
   ); ?></h2></div>
			<?php if (
       get_option("pnfpb_ic_disable_serviceworker_pwa_pushnotification") === "1"
   ) { ?>
				<p class="pnfpb_ic_red_color_text"><b><?php echo esc_html(
        __(
            "Currently, Service worker file is disabled/not created. if you need push notification and PWA in website, please enable service worker file using below option",
            "push-notification-for-post-and-buddypress"
        )
    ); ?></b></p>
			<?php } ?>
			<form method="post" enctype="multipart/form-data" class="form-field">
				<table class="pnfpb_ic_push_settings_table widefat fixed">
    				<tbody>
    					<tr  class="pnfpb_ic_push_settings_table_row">
							<td class="column-columnname">
								<?php if (
            get_option(
                "pnfpb_ic_disable_serviceworker_pwa_pushnotification"
            ) === "1"
        ) { ?> 
								<div class="col-sm-10"><?php submit_button(
            __(
                "Enable service worker file",
                "push-notification-for-post-and-buddypress"
            ),
            "primary",
            "disable_sw_file"
        ); ?></div>
								<?php } else { ?>
								<div class="col-sm-10"><?php submit_button(
            __(
                "Disable service worker file",
                "push-notification-for-post-and-buddypress"
            ),
            "primary",
            "disable_sw_file"
        ); ?></div>		
								<?php } ?>
								<ul>
									<li><?php echo esc_html(
             __(
                 "This option will disable service worker file, it will switch off push notification service as well as it will switch off PWA. Use this option only, if you want to use this plugin for push notification services via REST API (example: for mobile app using WebView)",
                 "push-notification-for-post-and-buddypress"
             )
         ); ?></li>
								</ul>
							</td>							
    					</tr>							
					</tbody>
				</table>
			</form>
			<br/>
		</div>
		<?php
        }

        /**
         * For NGINX enabled servers, enable/disable static service worker js file and PWA manifest json file
         * in root folder of website. This settings is applicable only if server has NGINX and static files are
         * served by NGINX instead of APACHE & for .htaccess rewrite not working for dynamic js/json files.
         * @since 1.40
         */
        public function PNFPB_icfcm_settings_for_ngnix_server()
        {
            ?>
			
			<h1 class="pnfpb_ic_push_settings_header"><?php echo esc_html(
       __(
           "PNFPB - settings for NGNIX server",
           "push-notification-for-post-and-buddypress"
       )
   ); ?></h1>
			<div class="nav-tab-wrapper">
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb-icfcm-slug"); ?>" 
	   				class="nav-tab tab">
						<?php echo esc_html(
    					__("Push Settings", "push-notification-for-post-and-buddypress")
					); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_device_tokens_list"); ?>" 
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("Device tokens", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_pwa_app_settings"); ?>" 
					class="nav-tab tab  ">
						<?php echo esc_html(
    						__("PWA", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfmtest_notification"); ?>"
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("Send push notification", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc"); ?>"
	   				class=" nav-tab tab">
						<?php echo esc_html(
    						__("Push Notifications list", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_frontend_settings"); ?>"
	   				class="nav-tab tab ">
					<?php echo esc_html(
    					__(
        					"Frontend subscription settings",
        					"push-notification-for-post-and-buddypress"
    					)
					); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_button_settings"); ?>"
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("Customize buttons", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_integrate_app"); ?>" 
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("Integrate Mobile app", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_settings_for_ngnix_server"); ?>"
	   				class="nav-tab tab active nav-tab-active">
						<?php echo esc_html(
    						__("NGINX", "push-notification-for-post-and-buddypress")
						); ?>
				</a>
				<a href="<?php echo esc_url(
     				admin_url()."admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1"); ?>"
	   				class="nav-tab tab ">
						<?php echo esc_html(
    						__("Action Scheduler", "push-notification-for-post-and-buddypress")
					); ?>
			</a>
		</div>

			<div class="pnfpb_column_1200">	
				<h1 class="pnfpb_ic_push_settings_header"><?php echo esc_html(
        __(
            "Settings for NGINX based server/hosting",
            "push-notification-for-post-and-buddypress"
        )
    ); ?></h1>

				<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
	
    				<?php settings_fields("pnfpb_icfcm_nginx"); ?>
				
    				<?php do_settings_sections("pnfpb_icfcm_nginx"); ?>
				
					<?php if (get_option("pnfpb_ic_nginx_static_files_enable") != "1") {
         global $wp_filesystem;

         if (empty($wp_filesystem)) {
             require_once trailingslashit(ABSPATH) .
                 "wp-admin/includes/file.php";
             WP_Filesystem();
         }

         $swresponse = wp_remote_head(
             home_url("/") . "pnfpb_icpush_pwa_sw.js",
             ["sslverify" => false]
         );

         $swresponse_code = wp_remote_retrieve_response_code($swresponse);

         if (200 === $swresponse_code) {
             $createfileresult = $wp_filesystem->delete(
                 trailingslashit(get_home_path()) . "pnfpb_icpush_pwa_sw.js"
             );
         }

         $firebase_swresponse = wp_remote_head(
             home_url("/") . "firebase-messaging-sw.js",
             ["sslverify" => false]
         );

         $firebase_swresponse_code = wp_remote_retrieve_response_code(
             $firebase_swresponse
         );

         if (200 === $firebase_swresponse_code) {
             $createfileresult = $wp_filesystem->delete(
                 trailingslashit(get_home_path()) . "firebase-messaging-sw.js"
             );
         }

         if (get_option("pnfpb_ic_pwa_app_enable") === "1") {
             $pwa_manifest_response = wp_remote_head(
                 home_url("/") . "pnfpbmanifest.json",
                 ["sslverify" => false]
             );

             $pwa_manifest_response_code = wp_remote_retrieve_response_code(
                 $pwa_manifest_response
             );

             if (200 === $pwa_manifest_response_code) {
                 $createfileresult = $wp_filesystem->delete(
                     trailingslashit(get_home_path()) . "pnfpbmanifest.json"
                 );
             }
         }
     } ?>
	
					<ul>
					
						<li><?php echo esc_html(PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION); ?></li>
					
					</ul>
				
					<table class="pnfpb_ic_push_settings_table widefat fixed">
    					<tbody>
							<tr class="pnfpb_ic_push_settings_table_row">
								<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
									<div class="pnfpb_row">
  										<div class="pnfpb_column_400">
    										<div class="pnfpb_card">									
												<label for="pnfpb_ic_nginx_static_files_enable">
													<?php echo esc_html(
                 __(
                     "Enable/Disable static service worker and PWA manifest files",
                     "push-notification-for-post-and-buddypress"
                 )
             ); ?>
												</label>
												<label class="pnfpb_switch">
													<input  id="pnfpb_ic_nginx_static_files_enable" name="pnfpb_ic_nginx_static_files_enable" type="checkbox" value="1" <?php checked(
                 "1",
                 esc_attr(get_option("pnfpb_ic_nginx_static_files_enable"))
             ); ?>  />
													<span class="pnfpb_slider round"></span>
												</label>
											</div>
										</div>
									</div>
								</td>
							</tr>
    						<tr  class="pnfpb_ic_push_settings_table_row">
								<td class="column-columnname">
									<div class="pnfpb_column_full"><?php submit_button(
             __("Save changes", "push-notification-for-post-and-buddypress"),
             "pnfpb_ic_push_save_configuration_button"
         ); ?></div>
									<ul>
					
										<li><?php echo esc_html(PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION2); ?></li>
					
									</ul>
									<ul>
					
										<li><?php echo esc_html(
              __(
                  "If Push notification admin settings or PWA admin settings are changed then regenerate service worker file by switching off this option, save changes, switch on again and save the changes again, so that service worker file and PWA manifest files will be regenerated",
                  "push-notification-for-post-and-buddypress"
              )
          ); ?></li>
					
									</ul>									
								</td>							
    						</tr>							
						</tbody>
					</table>
				</form>
			</div>
		<?php
        }

        /** Firebase httpv1 api send push notification routine
         *
         * @since 1.65 version
         */
        public function PNFPB_icfcm_httpv1_send_push_notification(
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
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_send_notification_routines/pnfpb_firebase_httpv1_notification/pnfpb_firebase_httpv1_notification.php";
        }

        /** Onesignal push notification
         *
         * @since 1.65 version
         */
        public function PNFPB_icfcm_onesignal_push_notification(
            $pushid,
            $pushtitle,
            $pushcontent,
            $pushlink,
            $pushimageurl,
            $target_device_id = 0,
            $retry_count = 4
        ) {
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_send_notification_routines/pnfpb_onesignal_notification/pnfpb_onesignal_notification.php";
        }

        /** Progressier push notification API
         *
         * @since 1.97 version
         *
         */

        public function PNFPB_icfcm_progressier_send_push_notification(
            $pushid,
            $pushtitle,
            $pushcontent,
            $pushlink,
            $pushimageurl,
            $target_user_id = 0,
            $pushtype = "",
            $target_user_id_array = []
        ) {
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_send_notification_routines/pnfpb_progressier_notification/pnfpb_progressier_notification.php";
        }

        /** Webtoapp push notification API
         *
         * @since 1.99 version
         *
         */

        public function PNFPB_icfcm_webtoapp_send_push_notification(
            $pushid,
            $pushtitle,
            $pushcontent,
            $pushlink,
            $pushimageurl,
            $target_device_ids = [],
            $pushtype = "",
            $grouppush = ""
        ) {
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_send_notification_routines/pnfpb_webtoapp_notification/pnfpb_webtoapp_notification.php";
        }

        /** To generate random uuid function
         *
         * @since 1.65 version
         */
        public function PNFPB_icfcm_generate_random_uuid($title)
        {
            $now_minutes = floor(time() / 60);
            $prev_minutes = get_option("TimeLastUpdated");
            $prehash = (string) $title;
            $updatedAMinuteOrMoreAgo =
                $prev_minutes !== false && $now_minutes - $prev_minutes > 0;

            if ($updatedAMinuteOrMoreAgo || $prev_minutes === false) {
                update_option("TimeLastUpdated", $now_minutes);
                $timestamp = $now_minutes;
            } else {
                $timestamp = $prev_minutes;
            }

            $prehash = $prehash . $timestamp;
            $sha1 = substr(sha1($prehash), 0, 32);
            return substr($sha1, 0, 8) .
                "-" .
                substr($sha1, 8, 4) .
                "-" .
                substr($sha1, 12, 4) .
                "-" .
                substr($sha1, 16, 4) .
                "-" .
                substr($sha1, 20, 12);
        }
    }

    $PNFPB_ICFM_Push_Notification_Post_BuddyPress_OBJ = new PNFPB_ICFM_Push_Notification_Post_BuddyPress();

    include plugin_dir_path(__FILE__) .
        "admin/pnfpb_icfcm_device_tokens_list.php";
    include plugin_dir_path(__FILE__) .
        "admin/pnfpb_icfcm_onetime_push_notifications_list_class.php";
    include plugin_dir_path(__FILE__) .
        "public/pnfpb_topic_subscription_update/PNFPB_httpv1_subscription_option_update.php";
} else {
    exit();
}
?>
