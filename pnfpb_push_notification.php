<?php
/*
Plugin Name: Push Notification for Post and BuddyPress
Plugin URI: https://www.muraliwebworld.com/groups/wordpress-plugins-by-muralidharan-indiacitys-com-technologies/forum/topic/push-notification-for-post-and-buddypress/
Description: Push notification for Post,custom post,BuddyPress,Woocommerce,Android/IOS mobile apps. Configure push notification settings in <a href="admin.php?page=pnfpb-icfcm-slug"><strong>settings page</strong></a>
Version: 3.01
Author: Muralidharan Ramasamy
Author URI: https://www.muraliwebworld.com
Text Domain: push-notification-for-post-and-buddypress
Requires at least: 6.2
Requires PHP: 8.1
Updated: 16 September 2025
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
                "Push Notification PNFPB"
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER")) {
    define(
        "PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER",
        esc_html(
            "Device tokens"
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_SETTINGS")) {
    define(
        "PNFPB_PLUGIN_NM_SETTINGS",
        esc_html(
                "PNFPB - Settings for Push Notification"
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_DEVICE_TOKENS")) {
    define(
        "PNFPB_PLUGIN_NM_DEVICE_TOKENS",
        esc_html(
                "PNFPB - Device tokens"
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_DEVICE_TOKENS_LIST_HEADER")) {
    define(
        "PNFPB_PLUGIN_NM_DEVICE_TOKENS_LIST_HEADER",
        esc_html(
                "List of device tokens registered for push notification"
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_DEVICE_TOKENS_LIST_DETAILS")) {
    define(
        "PNFPB_PLUGIN_NM_DEVICE_TOKENS_LIST_DETAILS",
        esc_html(
                "(Do not delete tokens unneccessarily it will result in user will not receive push notification, unless it is needed, avoid deleting tokens )"
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_PWA_HEADER")) {
    define(
        "PNFPB_PLUGIN_NM_PWA_HEADER",
        esc_html("PWA/app")
    );
}
if (!defined("PNFPB_PLUGIN_NM_PWA_SETTINGS")) {
    define(
        "PNFPB_PLUGIN_NM_PWA_SETTINGS",
        esc_html(
                "PWA Progressive web app settings"
        )
    );
}
if (!defined("PNFPB_PLUGIN_PWA_SETTINGS")) {
    define(
        "PNFPB_PLUGIN_PWA_SETTINGS",
        esc_html(
                "Below settings are to generate Progressive Web App(PWA) with offline facility"
        )
    );
}
if (!defined("PNFPB_PLUGIN_PWA_SETTINGS_DESCRIPTION")) {
    define(
        "PNFPB_PLUGIN_PWA_SETTINGS_DESCRIPTION",
        esc_html(
                "All below fields are required to generate Progressive Web App (PWA). Additionally, Enable/disable PWA app by selecting appropriate check box and Enter appropriate URLs to store in cache for offline PWA app, selected pages can be viewed in offline without internet. In offline mode, if page is not available/stored in cache then 404 offline page will be displayed"
        )
    );
}
if (!defined("PNFPB_PLUGIN_ENABLE_PUSH")) {
    define(
        "PNFPB_PLUGIN_ENABLE_PUSH",
        esc_html(
                "Enable/Disable push notifications for following types"
        )
    );
}
if (!defined("PNFPB_PLUGIN_SCHEDULE_PUSH")) {
    define(
        "PNFPB_PLUGIN_SCHEDULE_PUSH",
        esc_html(
                "If schedule is enabled then push notification will be sent as per selected schedule otherwise it will be sent whenever new item is posted.<br/>BuddyPress notifications will work only when BuddyPress plugin is installed and active.<br/><b>If you have more than 1000 subscribers, enable schedule in background mode(asynchronous).<br/>Refer scheduled action tab for background scheduled jobs</b><br/>"
        )
    );
}
if (!defined("PNFPB_PLUGIN_FIREBASE_SETTINGS")) {
    define(
        "PNFPB_PLUGIN_FIREBASE_SETTINGS",
        esc_html(
                "Firebase configuration"
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_ONDEMANDPUSH_HEADER")) {
    define(
        "PNFPB_PLUGIN_NM_ONDEMANDPUSH_HEADER",
        esc_html(
                "On demand push notification"
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_BUTTON_HEADER")) {
    define(
        "PNFPB_PLUGIN_NM_BUTTON_HEADER",
        esc_html(
            "Customize buttons"
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_FRONTEND_SETTINGS_HEADER")) {
    define(
        "PNFPB_PLUGIN_NM_FRONTEND_SETTINGS_HEADER",
        esc_html(
                "Frontend subscription"
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_ONDEMANDPUSH_SETTINGS")) {
    define(
        "PNFPB_PLUGIN_NM_ONDEMANDPUSH_SETTINGS",
        esc_html(
                "On demand or one time push notification"
        )
    );
}
if (!defined("PNFPB_PLUGIN_API_MOBILE_APP_HEADER")) {
    define(
        "PNFPB_PLUGIN_API_MOBILE_APP_HEADER",
        esc_html(
                " API to integrate mobile app"
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_ONDEMANDPUSH_DETAIL")) {
    define(
        "PNFPB_PLUGIN_NM_ONDEMANDPUSH_DETAIL",
        esc_html(
                "To send on demand or one time push notification to all subscribers with image"
        )
    );
}
if (!defined("PNFPB_PLUGIN_NGINX_HEADER")) {
    define(
        "PNFPB_PLUGIN_NGINX_HEADER",
        esc_html("for NGINX")
    );
}
if (!defined("PNFPB_PLUGIN_NGINX_SETTINGS")) {
    define(
        "PNFPB_PLUGIN_NGINX_SETTINGS",
        esc_html(
                "Settings for NGINX based server/hosting"
        )
    );
}
if (!defined("PNFPB_PLUGIN_SCHEDULE_ACTIONS")) {
    define(
        "PNFPB_PLUGIN_SCHEDULE_ACTIONS",
        esc_html(
			"Scheduled actions"
        )
    );
}
if (!defined("PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION")) {
    define(
        "PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION",
        esc_html(
                "if server/hosting is based on NGINX and if it is not able to serve dynamic service worker push notification js file(like for example: https:/<yourdomain>/pnfpb_icpush_pwa_sw.js), PWA manifest json file (like for example: https:/<yourdomain>/pnfpb_icpush_pwa_sw.js) from APACHE then enable this option to create static service worker js file for push notification and PWA manifest json files in your website root folder. If this option is enabled it will automatically create push notification service worker file which is used for push notification and PWA manifest json file (pnfpbmanifest.json) in root folder"
        )
    );
}
if (!defined("PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION2")) {
    define(
        "PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION2",
        esc_html(
                "Enable this option only when push notification dynamic service worker file(like for example: https:/<yourdomain>/pnfpb_icpush_pwa_sw.js) not created for SERVER BASED ON NGINX. If this option is enabled it will automatically create push notification service worker file (pnfpb_icpush_pwa_sw.js) which is used for push notification and PWA manifest json file (pnfpbmanifest.json) in root folder"
        )
    );
}
if (!defined("PNFPB_PLUGIN_DISABLE_SW_SETTINGS_DESCRIPTION")) {
    define(
        "PNFPB_PLUGIN_DISABLE_SW_SETTINGS_DESCRIPTION",
        esc_html(
                "Disable push notification service worker file and PWA"
        )
    );
}
if (!defined("PNFPB_PLUGIN_DISABLE_SW_SETTINGS_DESCRIPTION2")) {
    define(
        "PNFPB_PLUGIN_DISABLE_SW_SETTINGS_DESCRIPTION2",
        esc_html(
                "This option will disable service worker file, it will switch off push notification service as well as it will switch off PWA. Use this option only, if you want to use this plugin for push notification services via REST API (example: for mobile app using WebView) "
        )
    );
}
if (!defined("PNFPB_PLUGIN_DISABLE_SW_SETTINGS_DESCRIPTION3")) {
    define(
        "PNFPB_PLUGIN_DISABLE_SW_SETTINGS_DESCRIPTION3",
        esc_html(
                "Currently, Service worker file is disabled/not created. if you need push notification and PWA in website, please enable service worker file using below option"
        )
    );
}
if (!defined("PNFPB_PLUGIN_NM_ACTION_SCHEDULER")) {
    define(
        "PNFPB_PLUGIN_NM_ACTION_SCHEDULER",
        esc_html(
            "Action Scheduler"
        )
    );
}
define("PNFPB_PLUGIN_DIR_PATH", plugin_dir_url(__FILE__));
use Firebase\Auth\Token\Exception\InvalidToken;
// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery
/**
 * Class to load required functions for push notification
 *
 * @since 1.0.0
 *
 */
include plugin_dir_path(__FILE__) .
        "public/pnfpb_send_notification_routines/pnfpb_firebase_httpv1_notification/pnfpb_firebase_httpv1_notification.php";
include plugin_dir_path(__FILE__) .
		"public/pnfpb_send_notification_routines/pnfpb_web_push_notification/pnfpb_web_push_notification.php";
include plugin_dir_path(__FILE__) .
        "public/pnfpb_send_notification_routines/pnfpb_onesignal_notification/pnfpb_onesignal_notification.php";
include plugin_dir_path(__FILE__) .
        "public/pnfpb_send_notification_routines/pnfpb_webtoapp_notification/pnfpb_webtoapp_notification.php";
include plugin_dir_path(__FILE__) .
        "public/pnfpb_send_notification_routines/pnfpb_progressier_notification/pnfpb_progressier_notification.php";
include plugin_dir_path(__FILE__) .
	"public/pnfpb_activity_notification/pnfpb_all_activities_notification.php";	
include plugin_dir_path(__FILE__) .
	"public/pnfpb_activity_notification/pnfpb_group_activities_notification.php";	
include plugin_dir_path(__FILE__) .
	"public/pnfpb_avatar_change_notification/pnfpb_avatar_change_notification.php";
include plugin_dir_path(__FILE__) .
	"public/pnfpb_cover_image_change_notification/pnfpb_cover_image_change_notification.php";
include plugin_dir_path(__FILE__) .
	"public/pnfpb_friendship_accept_notification/pnfpb_friendship_accept_notification.php";
include plugin_dir_path(__FILE__) .
	"public/pnfpb_friendship_request_notification/pnfpb_friendship_request_notification.php";
include plugin_dir_path(__FILE__) .
	"public/pnfpb_private_message_notification/pnfpb_private_message_notification.php";
include plugin_dir_path(__FILE__) .
	"public/pnfpb_comments_notification/pnfpb_activities_comments_notification.php";
include plugin_dir_path(__FILE__) .
	"public/pnfpb_comments_notification/pnfpb_post_comments_notification.php";
include plugin_dir_path(__FILE__) .
	"public/pnfpb_new_member_joined_notification/pnfpb_new_member_joined_notification.php";
include plugin_dir_path(__FILE__) .
	"public/pnfpb_group_details_update_notification/pnfpb_group_details_update_notification.php";
include plugin_dir_path(__FILE__) .
	"public/pnfpb_group_invite_notification/pnfpb_group_invite_notification.php";
include plugin_dir_path(__FILE__) .
	"public/pnfpb_mark_as_favourite_notification/pnfpb_mark_as_favourite_notification.php";
include plugin_dir_path(__FILE__) .
	"public/pnfpb_contact_form_notification/pnfpb_contact_form_notification.php";
include plugin_dir_path(__FILE__) .
	"public/pnfpb_new_user_registration_notification/pnfpb_new_user_registration_notification.php";

if (!class_exists("PNFPB_ICFM_Push_Notification_Post_BuddyPress")) {
    class PNFPB_ICFM_Push_Notification_Post_BuddyPress
    {
        public $pre_name = "PNFPB_";
        public $devicetokens_obj;
        public $pushnotifications_obj;
		public $pushnotifications_delivered_obj;
		public $pushnotification_browser_delivered_obj;
       	public Messaging $messaging;
        public $_pnfpb_admin_message;
		public $pnfpb_httpv1_notification_class_obj;
		public $pnfpb_onesignal_notification_class_obj;
		public $pnfpb_progressier_notification_class_obj;
		public $pnfpb_webtoapp_notification_class_obj;
		public $pnfpb_webpush_notification_class_obj;
		public $pnfpb_all_activities_notification_obj;
		public $pnfpb_group_activities_notification_obj;
		public $pnfpb_avatar_change_notification_obj;
		public $pnfpb_cover_image_change_notification_obj;
		public $pnfpb_friendship_accept_notification_obj;
		public $pnfpb_friendship_request_notification_obj;
		public $pnfpb_private_message_notification_obj;
		public $pnfpb_activities_comments_notification_obj;
		public $pnfpb_post_comments_notification_obj;
		public $pnfpb_new_member_joined_notification_obj;	
		public $pnfpb_group_details_update_notification_obj;
		public $pnfpb_group_invite_notification_obj;
		public $pnfpb_mark_as_favourite_notification_obj;
		public $pnfpb_contact_form_notification_obj;
		public $pnfpb_new_user_registration_notification_obj;

        public function __construct()
        {
			
			
			$this->pnfpb_all_activities_notification_obj = new PNFPB_all_activities_notification_class();
			$this->pnfpb_group_activities_notification_obj = new PNFPB_group_activities_notification_class();
			$this->pnfpb_avatar_change_notification_obj = new PNFPB_avatar_change_notification_class();
			$this->pnfpb_cover_image_change_notification_obj = new PNFPB_cover_image_change_notification_class();
			$this->pnfpb_friendship_request_notification_obj = new PNFPB_friendship_request_notification_class();
			$this->pnfpb_friendship_accept_notification_obj = new PNFPB_friendship_accept_notification_class();
			$this->pnfpb_private_message_notification_obj = new PNFPB_private_message_notification_class();
			$this->pnfpb_activities_comments_notification_obj = new PNFPB_activities_comments_notification_class();
			$this->pnfpb_post_comments_notification_obj = new PNFPB_post_comments_notification_class();
			$this->pnfpb_new_member_joined_notification_obj = new PNFPB_new_member_joined_notification_class();
			$this->pnfpb_group_details_update_notification_obj = new PNFPB_group_details_update_notification_class();
			$this->pnfpb_group_invite_notification_obj = new PNFPB_group_invite_notification_class();
			$this->pnfpb_mark_as_favourite_notification_obj = new PNFPB_mark_as_favourite_notification_class();
			$this->pnfpb_contact_form_notification_obj = new PNFPB_contact_form_notification_class();
			$this->pnfpb_new_user_registration_notification_obj = new PNFPB_new_user_registration_notification_class();
			$this->pnfpb_httpv1_notification_class_obj = new PNFPB_firebase_httpv1_notification_class();
			$this->pnfpb_onesignal_notification_class_obj = new PNFPB_onesignal_notification_class();
			$this->pnfpb_progressier_notification_class_obj = new PNFPB_progressier_notification_class();
			$this->pnfpb_webtoapp_notification_class_obj = new PNFPB_webtoapp_notification_class();
			$this->pnfpb_webpush_notification_class_obj = new PNFPB_web_push_notification_class();
			
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
			
            // Create push notification subscription tables on creation of new blog in mutisite
            add_action( 'wpmu_new_blog', [
                $this,
                $this->pre_name . "on_create_blog",
            ],10, 6 );
			
			add_filter( 'wpmu_drop_tables', [
                $this,
                $this->pre_name . "on_delete_blog",
            ] );
			

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
                [$this, $this->pre_name . "init_requirements"],
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
                7
            );
			

            //Scheduled httpv1 push notification routine
            add_action(
                "PNFPB_httpv1_schedule_push_notification_hook",
                [
                    $this->pnfpb_httpv1_notification_class_obj,
                    $this->pre_name . "firebase_httpv1_notification",
                ],
                10,
                14
            );			

            //Scheduled webpush push notification routine
            add_action(
                "PNFPB_webpush_schedule_push_notification_hook",
                [
                    $this->pnfpb_webpush_notification_class_obj,
                    $this->pre_name . "web_push_notification",
                ],
                10,
                13
            );

            //Scheduled httpv1 push notification routine
            add_action(
                "PNFPB_onesignal_schedule_push_notification_hook",
                [$this->pnfpb_onesignal_notification_class_obj, $this->pre_name . "onesignal_notification"],
                10,
                7
            );

            //Scheduled httpv1 push notification routine
            add_action(
                "PNFPB_progressier_schedule_push_notification_hook",
                [
                    $this->pnfpb_progressier_notification_class_obj,
                    $this->pre_name .
                    "progressier_notification",
                ],
                10,
                8
            );

            //Scheduled httpv1 push notification routine
            add_action(
                "PNFPB_webtoapp_schedule_push_notification_hook",
                [
                    $this->pnfpb_webtoapp_notification_class_obj,
                    $this->pre_name . "webtoapp_notification",
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
			
            // Scheduled push notification(if enabled) for post and custom post types
            add_action($this->pre_name . "cron_generate_Firebase_oauth_token_hook", [
                $this,
                $this->pre_name . "generate_FB_oauth_token",
            ]);			

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
			
			add_action( 'PNFPB_post_comments_notification_cron_hook',                     
					   [$this->pnfpb_post_comments_notification_obj, $this->pre_name . "post_comments_notification"],
					   10,
					   3
			);			

            add_action("rest_api_init", [
                $this,
                $this->pre_name . "rest_api_subscription_tokens_from_app",
            ]);

            if (function_exists("bp_is_active")) {
               //Push notification(if enabled) for BuddyPress new acitivities based on plugin settings
                add_action(
                    "bp_activity_posted_update",
                    [$this, $this->pre_name . "icforum_push_notifications_activity"],
                    5,
                    3
                );
				
				add_action("PNFPB_trigger_activity_push_notification_action",
					[$this->pnfpb_all_activities_notification_obj, $this->pre_name . "all_activities_notification"],
					5,
					3
				);
				
                // Scheduled push notification(if enabled) for new buddypress activities
                add_action($this->pre_name . "cron_buddypressactivities_hook", [
                    $this,
                    $this->pre_name . "icforum_push_notifications_activity",
                ]);

                //Push notification(if enabled) for BuddyPress new acitivities under group based on plugin settings
                add_action(
                    "bp_groups_posted_update",
                    [
                        $this,
                        $this->pre_name .
                        "icforum_push_notifications_group_activity",
                    ],
                    1,
                    4
                );
				
				add_action( 'PNFPB_group_activity_notification_cron_hook',                     
					[$this->pnfpb_group_activities_notification_obj, $this->pre_name . "group_activities_notification"],
                    1,
                    5
				);				

                // Scheduled push notification(if enabled) for new group activities
                add_action(
                    $this->pre_name . "cron_buddypressgroupactivities_hook",
                    [
                        $this,
                        $this->pre_name .
                        "icforum_push_notifications_group_activity",
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
				
				add_action( 'PNFPB_private_message_notification_cron_hook',                     
					[$this->pnfpb_private_message_notification_obj, $this->pre_name . "private_message_notification"],
                    4,
                    1
				);				

                //New member joined push notification
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
				
				add_action( 'PNFPB_new_member_notification_cron_hook',                     
					[$this->pnfpb_new_member_joined_notification_obj, $this->pre_name . "new_member_joined_notification"],
                    10,
                    3
				);						
				
                //Push notification(if enabled) for BuddyPress Private messages. It will Send notifications only to userid.
                add_action(
                    "bp_activity_add_user_favorite",
                    [
                        $this,
                        $this->pre_name .
                        "icforum_push_notifications_mark_as_favourite",
                    ],
                    10,
                    2
                );
				
				add_action( 'PNFPB_mark_as_favourite_notification_cron_hook',                     
					[$this->pnfpb_mark_as_favourite_notification_obj, $this->pre_name . "mark_as_favourite_notification"],
                    10,
                    2
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
				
				add_action( 'PNFPB_friendship_request_notification_cron_hook',                     
					[$this->pnfpb_friendship_request_notification_obj, $this->pre_name . "friendship_request_notification"],
                    4,
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
				
				add_action( 'PNFPB_friendship_accept_notification_cron_hook',                     
					[$this->pnfpb_friendship_accept_notification_obj, $this->pre_name . "friendship_accept_notification"],
                    4,
                    3
				);				

				//Push notification(if enabled) for BuddyPress user profile avatar change.
				add_action(
					"bp_members_avatar_uploaded",
					[
						$this,
						$this->pre_name .
						"icforum_push_notifications_avatar_change",
					],
					10,
					1
				);

				if ( has_action( 'xprofile_avatar_uploaded' ) ) {
					add_action(
						"xprofile_avatar_uploaded",
						[
							$this,
							$this->pre_name .
							"icforum_push_notifications_avatar_change",
						],
						10,
						1
					);
				}
		
				add_action( 'PNFPB_avatar_change_notification_cron_hook',                     
					[$this->pnfpb_avatar_change_notification_obj, $this->pre_name . "avatar_change_notification"],
                    10,
                    1
				);				

				//Push notification(if enabled) for BuddyPress user profile cover image change.
				add_action(
					"members_cover_image_uploaded",
					[
						$this,
						$this->pre_name .
						"icforum_push_notifications_cover_image_change",
					],
					10,
					2
				);
				if ( has_action( 'xprofile_cover_image_uploaded' ) ) {
					add_action(
						"xprofile_cover_image_uploaded",
						[
							$this,
							$this->pre_name .
							"icforum_push_notifications_cover_image_change",
						],
						10,
						2
					);						
				}
				
				add_action( 'PNFPB_cover_image_change_notification_cron_hook',                     
					[$this->pnfpb_cover_image_change_notification_obj, $this->pre_name . "cover_image_change_notification"],
                    10,
                    2
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
				
				add_action( 'PNFPB_activities_comments_notification_cron_hook',                     
					[$this->pnfpb_activities_comments_notification_obj, $this->pre_name . "activities_comments_notification"],
                    10,
                    4
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

                add_action("bp_setup_nav", [
                    $this,
                    $this->pre_name .
                    "buddypress_setup_notification_settings_nav",
                ]);

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
				add_action( 'PNFPB_group_invite_notification_cron_hook',                     
					[$this->pnfpb_group_invite_notification_obj, $this->pre_name . "group_invite_notification"],
                    5,
                    3
				);				

                add_action("groups_group_details_edited", [
                    $this,
                    $this->pre_name .
                    "buddypress_group_details_updated_notification",
                ]);
				
				add_action( 'PNFPB_group_details_update_notification_cron_hook',                     
					[$this->pnfpb_group_details_update_notification_obj, $this->pre_name . "group_details_update_notification"],
                    3,
                    1
				);				
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


            //admin bar menu
            add_action(
                "admin_bar_menu",
                [$this, $this->pre_name . "ic_fcm_admin_bar_menu_register"],
                999
            );

            //Push notification to admin id, when new user registers
            add_action("user_register", [$this,$this->pre_name . "new_user_registrations"],10,2);
			
			add_action( 'PNFPB_new_user_registration_notification_cron_hook',                     
				[$this->pnfpb_new_user_registration_notification_obj, $this->pre_name . "new_user_registration_notification"],
				5,
				2
			);				

            //Push notification to admin id, when contact form7 submitted
            add_action(
                "wpcf7_before_send_mail",
                [$this, $this->pre_name . "contact_form7_send_mail"],
                5,
                3
            );
			
			add_action( 'PNFPB_contact_form_notification_cron_hook',                     
				[$this->pnfpb_contact_form_notification_obj, $this->pre_name . "contact_form_notification"],
				1,
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
         * Load Action scheduler if action_scheduler plugin not active/class not present
         * Alter push notification table to add new column subscription_option (if not exists)
         * @since 1.50.0
         **/
        public function PNFPB_init_requirements()
        {
			global $wpdb;
			
    		$installed_ver = get_option( 'pnfpb_db_version' );

    		$current_ver = '2.26'; // increment this when schema changes
			
			if ( $installed_ver != $current_ver ) {
			
				$table_name_3 =
					$wpdb->prefix . "pnfpb_ic_delivery_statistics_notifications";

				$charset_collate_3 = $wpdb->get_charset_collate();
				
				$sql_3 = "CREATE TABLE {$table_name_3} (
						id bigint(20) NOT NULL AUTO_INCREMENT,
						notificationid bigint(20) DEFAULT 0,
						userid bigint(20) DEFAULT 0,
						title varchar(300) NULL  DEFAULT NULL,
						content VARCHAR(300) NULL  DEFAULT NULL,
						browser_token varchar(600) NULL  DEFAULT NULL,
						browser_type varchar(255) NULL  DEFAULT NULL,
						delivery_confirmation bigint(20) DEFAULT 0,
						open_confirmation bigint(20) DEFAULT 0,
						PRIMARY KEY (id)
					) {$charset_collate_3};";

				require_once ABSPATH . "wp-admin/includes/upgrade.php";

				dbDelta($sql_3);

				$table_name_4 =
					$wpdb->prefix . "pnfpb_ic_total_statistics_notifications";

				$charset_collate_4 = $wpdb->get_charset_collate();

				$sql_4 = "CREATE TABLE {$table_name_4} (
						id bigint(20) NOT NULL AUTO_INCREMENT,
						notificationid bigint(20) DEFAULT 0,
						notification_auth_token varchar(300) NULL  DEFAULT NULL,
						title varchar(300) NULL  DEFAULT NULL,
						content VARCHAR(300) NULL  DEFAULT NULL,						
						total_delivery_confirmation bigint(20) DEFAULT 0,
						total_open_confirmation bigint(20) DEFAULT 0,					
						PRIMARY KEY (id)
					) {$charset_collate_4};";

				require_once ABSPATH . "wp-admin/includes/upgrade.php";

				dbDelta($sql_4);
				
				$dbname = $wpdb->dbname;

				$pnfpb_table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

 				$is_status_col_authtoken = $wpdb->get_results(  "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS`    WHERE `table_name` = '{$pnfpb_table_name}' AND `TABLE_SCHEMA` = '{$dbname}' AND `COLUMN_NAME` = 'subscription_auth_token'"  );
			
				if( empty($is_status_col_authtoken) ):
			
    				$add_status_column = "ALTER TABLE `{$pnfpb_table_name}` ADD `subscription_auth_token` VARCHAR(300) NULL DEFAULT NULL AFTER `web_256`; ";			
					$wpdb->query( $add_status_column );
			
				endif;
				
				update_option( 'pnfpb_db_version', $current_ver );
			}
			
            if (
                !function_exists("action_scheduler_register_3_dot_5_dot_3") &&
                function_exists("add_action")
            ) {
                require_once plugin_dir_path(__FILE__) .
                    "/libraries/action-scheduler/action-scheduler.php";
                			
            }
			
			if (file_exists(__DIR__ . '/vendor/autoload.php')) {
				require __DIR__ . '/vendor/autoload.php';
			}
			
			if (get_option("pnfpb_httpv1_push") === "1") {
				$new_time = strtotime(
					gmdate(
						"Y-m-d H:i:s",
						strtotime("+1 hours", strtotime("now"))
					)
				);				
				if (!wp_next_scheduled("PNFPB_cron_generate_Firebase_oauth_token_hook")) {
                    wp_schedule_event(
                        $new_time,
                        "hourly",
                        "PNFPB_cron_generate_Firebase_oauth_token_hook"
                    );					
				}
			}
			
        }

       	/**
        * Create table (if not exists) to store subscribed device ids for push notification
        *
        * @since 1.0.0
        */
        public function PNFPB_activate($network_wide)
        {
            global $wpdb;
			
    		if ( is_multisite() && $network_wide ) {
        		// Get all blogs in the network and activate plugin on each one
        		$blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
        		foreach ( $blog_ids as $blog_id ) {
            		switch_to_blog( $blog_id );
            		$this->PNFPB_create_tables_for_pushnotification();
            		restore_current_blog();
        		}
    		} else {
        		$this->PNFPB_create_tables_for_pushnotification();
    		}			


        }
		
		/* Create tables
		* @since 2.13
		*/
		public function PNFPB_create_tables_for_pushnotification() {
			
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
                    subscription_auth_token VARCHAR(300) NULL DEFAULT NULL,                 
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
			
            $table_name_3 =
                $wpdb->prefix . "pnfpb_ic_delivery_statistics_notifications";

            $charset_collate_3 = $wpdb->get_charset_collate();

			$sql_3 = "CREATE TABLE {$table_name_3} (
						id bigint(20) NOT NULL AUTO_INCREMENT,
						notificationid bigint(20) DEFAULT 0,
						userid bigint(20) DEFAULT 0,
						title varchar(300) NULL  DEFAULT NULL,
						content VARCHAR(300) NULL  DEFAULT NULL,
						browser_token varchar(600) NULL  DEFAULT NULL,
						browser_type varchar(255) NULL  DEFAULT NULL,
						delivery_confirmation bigint(20) DEFAULT 0,
						open_confirmation bigint(20) DEFAULT 0,
						PRIMARY KEY (id)
					) {$charset_collate_3};";

            require_once ABSPATH . "wp-admin/includes/upgrade.php";

            dbDelta($sql_3);
			
            $table_name_4 =
                $wpdb->prefix . "pnfpb_ic_total_statistics_notifications";

            $charset_collate_4 = $wpdb->get_charset_collate();

			$sql_4 = "CREATE TABLE {$table_name_4} (
						id bigint(20) NOT NULL AUTO_INCREMENT,
						notificationid bigint(20) DEFAULT 0,
						notification_auth_token varchar(300) NULL  DEFAULT NULL,
						title varchar(300) NULL  DEFAULT NULL,
						content VARCHAR(300) NULL  DEFAULT NULL,						
						total_delivery_confirmation bigint(20) DEFAULT 0,
						total_open_confirmation bigint(20) DEFAULT 0,					
						PRIMARY KEY (id)
					) {$charset_collate_4};";

            require_once ABSPATH . "wp-admin/includes/upgrade.php";

            dbDelta($sql_4);						

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
         * Multisite on creating blog routine
         * Creating PNFPB table whenever a new blog is created
         * @since 2.13.0
         */		
		public function PNFPB_on_create_blog( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {
			
    		if ( is_plugin_active_for_network( 'push-notification-for-post-and-buddypress/pnfpb_push_notification.php' ) ) {
        		switch_to_blog( $blog_id );
        		$this->PNFPB_create_tables_for_pushnotification();
        		restore_current_blog();
    		}
			
		}
		
        /**
         * Multisite on deleting blog routine
         * Deleting its PNFPB tables whenever a new blog is deleted
         * @since 2.14.0
         */			
		public function PNFPB_on_delete_blog( $tables ) {
    		global $wpdb;
    		$tables[] = $wpdb->prefix . 'table_name';
    		return $tables;
		}

        /**
         * Plugin deactivate routine
         *
         * @since 1.0.0
         */
        public function PNFPB_deactivate()
        {
			
			if (wp_next_scheduled("PNFPB_cron_generate_Firebase_oauth_token_hook")) {
				$timestamp = wp_next_scheduled("PNFPB_cron_generate_Firebase_oauth_token_hook");
				wp_unschedule_event(
					$timestamp,
					"PNFPB_cron_generate_Firebase_oauth_token_hook"
				);					
			}
			
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
			wp_enqueue_script("jquery-ui-autocomplete");
            wp_enqueue_style("wp-jquery-ui-dialog");

            wp_enqueue_style(
                "pnfpb-admin-icpstyle-name",
                plugin_dir_url(__FILE__) . "admin/css/pnfpb_admin_v3.css",
                [],
                "2.90.111"
            );
            wp_enqueue_style(
                "pnfpb-admin-pwa-icpstyle-name",
                plugin_dir_url(__FILE__) . "admin/css/pnfpb_pwa_admin.css",
                [],
                "2.14.11"
            );
			
			$pnfpb_ic_ios_pwa_prompt_reappear = '7';
			$pnfpb_ic_ios_pwa_prompt_disable = '';
			
			if (
				get_option("pnfpb_ic_ios_pwa_prompt_reappear") &&
				get_option("pnfpb_ic_ios_pwa_prompt_reappear") !==
				false &&
				get_option("pnfpb_ic_ios_pwa_prompt_reappear") !==
				""
			) {
				$pnfpb_ic_ios_pwa_prompt_reappear = get_option(
					"pnfpb_ic_ios_pwa_prompt_reappear"
				);
			}
			if (
				get_option("pnfpb_ic_ios_pwa_prompt_disable") &&
				get_option("pnfpb_ic_ios_pwa_prompt_disable") !==
				false &&
				get_option("pnfpb_ic_ios_pwa_prompt_disable") !==
				""
			) {
				$pnfpb_ic_ios_pwa_prompt_disable = get_option(
					"pnfpb_ic_ios_pwa_prompt_disable"
				);
			}			

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
                    ["jquery","jquery-ui-autocomplete"],
                    "3.00.1",
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
					$posttypecount = 0;
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
						$posttypecount++;
						if ($posttypecount >= 10) {
				
							break;
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
                        "3.00.2",
                        true
                    );
                    wp_localize_script(
                        "pnfpb-icajax-script-push",
                        $ajaxobject,
                        [
                            "ajax_url" => admin_url("admin-ajax.php"),
                            "groupId" => "9",
							"nonce" => wp_create_nonce('pnfpbpushnonce'),
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
							"pnfpb_ic_ios_pwa_prompt_reappear" => $pnfpb_ic_ios_pwa_prompt_reappear,
							"pnfpb_ic_ios_pwa_prompt_disable" => $pnfpb_ic_ios_pwa_prompt_disable,
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
                            "3.00.2",
                            true
                        );
                        $pnfpb_ic_fcm_prompt_style = "";
						$pnfpb_show_custom_post_types = wp_json_encode([ "post" ]);
                        wp_localize_script(
                            "pnfpb-icajax-script-push",
                            $ajaxobject,
                            [
                                "ajax_url" => admin_url("admin-ajax.php"),
                                "homeurl" => $homeurl,
								"nonce" => wp_create_nonce('pnfpbpushnonce'),
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
                            	"pnfpb_show_custom_post_types" => $pnfpb_show_custom_post_types,
                            	"pnfpb_show_push_notify_types" => $pnfpb_show_custom_post_types,
                            	"pnfpb_front_end_settings_push_notify_types" => $pnfpb_show_custom_post_types,
								"pnfpb_ic_ios_pwa_prompt_reappear" => $pnfpb_ic_ios_pwa_prompt_reappear,
								"pnfpb_ic_ios_pwa_prompt_disable" => $pnfpb_ic_ios_pwa_prompt_disable,								
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
                "3.00.1"
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
			
			$pnfpb_ic_ios_pwa_prompt_reappear = '7';
			$pnfpb_ic_ios_pwa_prompt_disable = '';			
			
			if (
				get_option("pnfpb_ic_ios_pwa_prompt_reappear") &&
				get_option("pnfpb_ic_ios_pwa_prompt_reappear") !==
				false &&
				get_option("pnfpb_ic_ios_pwa_prompt_reappear") !==
				""
			) {
				$pnfpb_ic_ios_pwa_prompt_reappear = get_option(
					"pnfpb_ic_ios_pwa_prompt_reappear"
				);
			}
			if (
				get_option("pnfpb_ic_ios_pwa_prompt_disable") &&
				get_option("pnfpb_ic_ios_pwa_prompt_disable") !==
				false &&
				get_option("pnfpb_ic_ios_pwa_prompt_disable") !==
				""
			) {
				$pnfpb_ic_ios_pwa_prompt_disable = get_option(
					"pnfpb_ic_ios_pwa_prompt_disable"
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
                    "3.00.1"
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

                if ((($projectId != false &&
                    $projectId != "" &&
                    $publicKey != false &&
                    $publicKey != "" &&
                    $apiKey != false &&
                    $apiKey != "" &&
                    $messagingSenderId != false &&
                    $messagingSenderId != "") || 
					 (get_option("pnfpb_webpush_push") === "1" ||
					  get_option("pnfpb_webpush_push") === "2" ||
					  get_option("pnfpb_webpush_push_firebase") === "1" )) &&
                    get_option(
                        "pnfpb_ic_disable_serviceworker_pwa_pushnotification"
                    ) != "1") {
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
					
					$pnfpb_shortcode_installed = "0";
					
                    if (
                        get_option("pnfpb_shortcode_installed") &&
                        get_option("pnfpb_shortcode_installed") != ""
                    ) {
                        $pnfpb_shortcode_installed = get_option("pnfpb_shortcode_installed");
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
					$posttypecount = 0;
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
						$posttypecount++;
						if ($posttypecount >= 10) {
				
							break;
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
					
					if (
					  get_option("pnfpb_webpush_push") === "1" ||
					  get_option("pnfpb_webpush_push") === "2" ||
					  get_option("pnfpb_webpush_push_firebase") === "1"	) {
						
						$filename = "/build/pnfpb_push_notification_webpush/index.js";

						$ajaxobject = "pnfpb_ajax_object_push";

						wp_enqueue_script(
							"pnfpb-icajax-script-push",
							plugins_url($filename, __FILE__),
							[],
							"3.00.2",
							true
						);

						wp_localize_script(
							"pnfpb-icajax-script-push",
							$ajaxobject,
							[
								"ajax_url" => admin_url("admin-ajax.php"),
								"nonce" => wp_create_nonce('pnfpbpushnonce'),
								"rest_nonce" => wp_create_nonce('wp_rest'),
								"groupId" => "1",
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
								"pnfpb_shortcode_installed" => $pnfpb_shortcode_installed,
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
								"pnfpb_ic_ios_pwa_prompt_reappear" => $pnfpb_ic_ios_pwa_prompt_reappear,
								"pnfpb_ic_ios_pwa_prompt_disable" => $pnfpb_ic_ios_pwa_prompt_disable,							
							]
						);

						if (get_option("pnfpb_webpush_push_firebase") === "1") {
							$filename = "/public/js/pnfpb_pushscript_pwa.js";
							wp_enqueue_script(
								"pnfpb-mobile-app-interface-script",
								plugins_url($filename, __FILE__),
								["jquery", "wp-i18n"],
								"3.00.1",
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
									"nonce" => wp_create_nonce('pnfpbpushnonce'),
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
									"pnfpb_shortcode_installed" => $pnfpb_shortcode_installed,
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
									"pnfpb_progressier_app_option" => $pnfpb_progressier_app_option,							
									"pnfpb_show_custom_post_types" => $pnfpb_show_custom_post_types,
									"pnfpb_show_push_notify_types" => $pnfpb_show_push_notify_types,
									"pnfpb_front_end_settings_push_notify_types" => $pnfpb_front_end_settings_push_notify_types,
									"pnfpb_ic_ios_pwa_prompt_reappear" => $pnfpb_ic_ios_pwa_prompt_reappear,
									"pnfpb_ic_ios_pwa_prompt_disable" => $pnfpb_ic_ios_pwa_prompt_disable,							
								]
							);
						}
						
					} else {				

						$filename = "/build/pnfpb_push_notification/index.js";

						$ajaxobject = "pnfpb_ajax_object_push";

						wp_enqueue_script(
							"pnfpb-icajax-script-push",
							plugins_url($filename, __FILE__),
							[],
							"3.00.2",
							true
						);

						wp_localize_script(
							"pnfpb-icajax-script-push",
							$ajaxobject,
							[
								"ajax_url" => admin_url("admin-ajax.php"),
								"nonce" => wp_create_nonce('pnfpbpushnonce'),
								"rest_nonce" => wp_create_nonce('wp_rest'),
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
								"pnfpb_shortcode_installed" => $pnfpb_shortcode_installed,
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
								"pnfpb_ic_ios_pwa_prompt_reappear" => $pnfpb_ic_ios_pwa_prompt_reappear,
								"pnfpb_ic_ios_pwa_prompt_disable" => $pnfpb_ic_ios_pwa_prompt_disable,							
							]
						);

						$filename = "/public/js/pnfpb_pushscript_pwa.js";
						wp_enqueue_script(
							"pnfpb-mobile-app-interface-script",
							plugins_url($filename, __FILE__),
							["jquery", "wp-i18n"],
							"3.00.1",
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
								"nonce" => wp_create_nonce('pnfpbpushnonce'),
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
								"pnfpb_shortcode_installed" => $pnfpb_shortcode_installed,
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
								"pnfpb_progressier_app_option" => $pnfpb_progressier_app_option,							
								"pnfpb_show_custom_post_types" => $pnfpb_show_custom_post_types,
								"pnfpb_show_push_notify_types" => $pnfpb_show_push_notify_types,
								"pnfpb_front_end_settings_push_notify_types" => $pnfpb_front_end_settings_push_notify_types,
								"pnfpb_ic_ios_pwa_prompt_reappear" => $pnfpb_ic_ios_pwa_prompt_reappear,
								"pnfpb_ic_ios_pwa_prompt_disable" => $pnfpb_ic_ios_pwa_prompt_disable,							
							]
						);
					}
                } else {
					$filename = "/public/js/pnfpb_pwa_check.js";
					$ajaxobject = "pnfpb_ajax_object_push_pwa_check";
            		wp_enqueue_script(
                        "pnfpb-pwa-check-interface-script",
                        plugins_url($filename, __FILE__),
                        ["jquery", "wp-i18n"],
                        "3.00.1",
                        true
           			);
                     wp_localize_script(
                            "pnfpb-pwa-check-interface-script",
                            $ajaxobject,
                            [
                                "ajax_url" => admin_url("admin-ajax.php"),
								"nonce" => wp_create_nonce('pnfpbpushnonce'),
								"pnfpb_ic_ios_pwa_prompt_reappear" => $pnfpb_ic_ios_pwa_prompt_reappear,
								"pnfpb_ic_ios_pwa_prompt_disable" => $pnfpb_ic_ios_pwa_prompt_disable,
							]
						 );
								
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
                            "3.00.2",
                            true
                        );
                        $pnfpb_ic_fcm_prompt_style = "";
						$pnfpb_show_custom_post_types = wp_json_encode([ "post" ]);
						
                        wp_localize_script(
                            "pnfpb-icajax-script-push",
                            $ajaxobject,
                            [
                                "ajax_url" => admin_url("admin-ajax.php"),
								"nonce" => wp_create_nonce('pnfpbpushnonce'),
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
                            	"pnfpb_show_custom_post_types" => $pnfpb_show_custom_post_types,
                            	"pnfpb_show_push_notify_types" => $pnfpb_show_custom_post_types,
                            	"pnfpb_front_end_settings_push_notify_types" => $pnfpb_show_custom_post_types,
								"pnfpb_ic_ios_pwa_prompt_reappear" => $pnfpb_ic_ios_pwa_prompt_reappear,
								"pnfpb_ic_ios_pwa_prompt_disable" => $pnfpb_ic_ios_pwa_prompt_disable,								
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
				$filename = "/public/js/pnfpb_pwa_check.js";
				$ajaxobject = "pnfpb_ajax_object_push_pwa_check";
            	wp_enqueue_script(
                        "pnfpb-pwa-check-interface-script",
                        plugins_url($filename, __FILE__),
                        ["jquery", "wp-i18n"],
                        "3.00.1",
                        true
           		);
				wp_localize_script(
					"pnfpb-pwa-check-interface-script",
					$ajaxobject,
					[
						"ajax_url" => admin_url("admin-ajax.php"),
						"nonce" => wp_create_nonce('pnfpbpushnonce'),
						"pnfpb_ic_ios_pwa_prompt_reappear" => $pnfpb_ic_ios_pwa_prompt_reappear,
						"pnfpb_ic_ios_pwa_prompt_disable" => $pnfpb_ic_ios_pwa_prompt_disable,
					]
				);				
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
                            "3.00.1",
                            true
                        );

                        wp_localize_script(
                            "pnfpb-icajax-progressier-script-push",
                            $ajaxobject,
                            [
                                "ajax_url" => admin_url("admin-ajax.php"),
								"nonce" => wp_create_nonce('pnfpbpushnonce'),
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
                    "3.00.1",
                    true
                );

                wp_localize_script(
                    "pnfpb-icajax-webtoapp-script-push",
                    $ajaxobject,
                    [
                        "ajax_url" => admin_url("admin-ajax.php"),
                        "userid" => get_current_user_id(),
						"nonce" => wp_create_nonce('pnfpbpushnonce'),
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
                    esc_html(get_option("pnfpb_ic_pwa_thirdparty_app_id")) .
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
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_custom_install_pwa/pnfpb_custom_install_pwa.php";
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
                "pnfpb-push-notification-configuration-slug",
                [$this, "PNFPB_push_notification_configuration_page"],
                "dashicons-bell",
                98
            );
			
            add_submenu_page(
                "pnfpb-push-notification-configuration-slug",
                __(
                    "Configuration",
                    "push-notification-for-post-and-buddypress"
                ),
                __(
                    "Configuration",
                    "push-notification-for-post-and-buddypress"
                ),
                "manage_options",
                "pnfpb-push-notification-configuration-slug",
                [$this, "PNFPB_push_notification_configuration_page"],
                1
            );			

            add_submenu_page(
                "pnfpb-push-notification-configuration-slug",
                __(
                    "Options",
                    "push-notification-for-post-and-buddypress"
                ),
                __(
                    "Options",
                    "push-notification-for-post-and-buddypress"
                ),
                "manage_options",
                "pnfpb-icfcm-slug",
                [$this, "PNFPB_icfcm_admin_page"],
                2
            );
			
            add_submenu_page(
                "pnfpb-push-notification-configuration-slug", // -> Set to null - will hide menu link
                __(
                    "Send Push",
                    "push-notification-for-post-and-buddypress"
                ), // -> Page Title
                "Send Notification", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfmtest_notification", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfcm_test_notification"], // -> To render the page
                3
            );
			
            $hook_delivery_notifications_list = add_submenu_page(
                "pnfpb-push-notification-configuration-slug", // -> Set to null - will hide menu link
                __(
                    "Delivered & read report",
                    "push-notification-for-post-and-buddypress"
                ), // -> Page Title
                "Delivered/read report", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfm_delivery_notifications_list", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfm_delivery_notifications_list"], // -> To render the page
                4
            );
            add_action("load-$hook_delivery_notifications_list", [
                $this,
                $this->pre_name . "push_notifications_delivery_list_screen_option",
            ]);
            $hook_browser_delivery_notifications_list = add_submenu_page(
                "pnfpb-push-notification-configuration-slug", // -> Set to null - will hide menu link
                __(
                    "Browser based delivery reports ",
                    "push-notification-for-post-and-buddypress"
                ), // -> Page Title
                "Browser based Delivery reports", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfm_browser_delivery_notifications_list", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfm_browser_delivery_notifications_list"], // -> To render the page
                5
            );
            add_action("load-$hook_browser_delivery_notifications_list", [
                $this,
                $this->pre_name . "push_notifications_browser_delivery_list_screen_option",
            ]);
			
            $hook_notifications_list = add_submenu_page(
                "pnfpb-push-notification-configuration-slug", // -> Set to null - will hide menu link
                __(
                    "Notifications from admin",
                    "push-notification-for-post-and-buddypress"
                ), // -> Page Title
                "Notifications from admin", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfm_onetime_notifications_list", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfm_onetime_notifications_list"], // -> To render the page
                6
            );
            add_action("load-$hook_notifications_list", [
                $this,
                $this->pre_name . "push_notifications_list_screen_option",
            ]);			
			
           add_submenu_page(
                "pnfpb-push-notification-configuration-slug", // -> Set to null - will hide menu link
                __(
                    "PWA settings",
                    "push-notification-for-post-and-buddypress"
                ), // -> Page Title
                "PWA settings", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfm_pwa_app_settings", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfcm_pwa_app_settings"], // -> To render the page
                7
            );			

            $hook_device_tokens = add_submenu_page(
                "pnfpb-push-notification-configuration-slug", // -> Set to null - will hide menu link
                __(
                    "Tokens list",
                    "push-notification-for-post-and-buddypress"
                ), // -> Page Title
                "Tokens list", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfm_device_tokens_list", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfcm_device_tokens_list"], // -> To render the page
                8
            );
            add_action("load-$hook_device_tokens", [
                $this,
                $this->pre_name . "screen_option",
            ]);

            add_submenu_page(
                "pnfpb-push-notification-configuration-slug", // -> Set to null - will hide menu link
                __(
                    "Frontend settings",
                    "push-notification-for-post-and-buddypress"
                ), // -> Page Title
                "Frontend settings", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfm_frontend_settings", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfcm_frontend_settings"], // -> To render the page
                9
            );
			
            add_submenu_page(
                "pnfpb-push-notification-configuration-slug", // -> Set to null - will hide menu link
                __(
                    "Shortcodes",
                    "push-notification-for-post-and-buddypress"
                ), // -> Page Title
                "Shortcodes", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfm_shortcode_settings", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfcm_shortcode_settings"], // -> To render the page
                10
            );			

            add_submenu_page(
                "pnfpb-push-notification-configuration-slug", // -> Set to null - will hide menu link
                __(
                    "Buttons",
                    "push-notification-for-post-and-buddypress"
                ), // -> Page Title
                "Buttons", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfm_button_settings", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfcm_button_settings"], // -> To render the page
                11
            );

            add_submenu_page(
                "pnfpb-push-notification-configuration-slug", // -> Set to null - will hide menu link
                __(
                    "Integrate Mobile App",
                    "push-notification-for-post-and-buddypress"
                ), // -> Page Title
                "Integrate Mobile App", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfm_integrate_app", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfcm_integrate_app"], // -> To render the page
                12
            );

            add_submenu_page(
                "pnfpb-push-notification-configuration-slug", // -> Set to null - will hide menu link
                __("NGNIX", "push-notification-for-post-and-buddypress"), // -> Page Title
                "NGNIX", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfm_settings_for_ngnix_server", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfcm_settings_for_ngnix_server"], // -> To render the page
                13
            );

            $hook_pnfpb_action_scheduler = add_submenu_page(
                "pnfpb-push-notification-configuration-slug", // -> Set to null - will hide menu link
                __(
                    "Action scheduler",
                    "push-notification-for-post-and-buddypress"
                ), // -> Page Title
                "Action scheduler", // -> Title that would otherwise appear in the menu
                "administrator", // -> Capability level
                "pnfpb_icfm_action_scheduler", // -> Still accessible via admin.php?page=menu_handle
                [$this, $this->pre_name . "icfcm_action_scheduler"], // -> To render the page
                14
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
         * List of push notifications sent from admin
         * @since 2.20.0
         */
        public function PNFPB_push_notification_configuration_page() {
			
            include plugin_dir_path(__FILE__) .
                "admin/pnfpb_push_notifications_configuration.php";
		}

        /**
         * List of push notifications sent from admin
         * @since 1.64.0
         */
        public function PNFPB_icfm_onetime_notifications_list()
        {
            include plugin_dir_path(__FILE__) .
                "admin/pnfpb_onetime_notifications_list.php";
        }
		
        /**
         * List of Push notifications with delivery and read confirmation report
         * @since 2.20.0
         */
        public function PNFPB_icfm_delivery_notifications_list()
        {
            include plugin_dir_path(__FILE__) .
                "admin/pnfpb_delivery_notifications_list.php";
        }
		
        /**
         * Push notification delivery statistics with browser details
         * @since 2.20.0
         */
        public function PNFPB_icfm_browser_delivery_notifications_list()
        {
            include plugin_dir_path(__FILE__) .
                "admin/pnfpb_delivery_notifications_browser_list.php";
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
            $schedule_post_id = 0,
			$selected_user_ids = []
        ) {
            include plugin_dir_path(__FILE__) .
                "admin/pnfpb_admin_ondemand_schedule_notification.php";
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
				<?php
					$pnfpb_tab_as_active = "nav-tab-active";
					require_once( plugin_dir_path( __FILE__ ) . 'admin/push_admin_menu_list.php' );
				?>

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

			<?php
				$pnfpb_tab_tokens_active = "nav-tab-active";
				require_once( plugin_dir_path( __FILE__ ) . 'admin/push_admin_menu_list.php' );
			?>

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
         $this->devicetokens_obj->prepare_items();
         $this->devicetokens_obj->pnfpb_url_scheme_start();
         $this->devicetokens_obj->search_box(
             "Search",
             "pnfpb_device_token_search"
         );
         $this->devicetokens_obj->display();
		 wp_nonce_field( 'pnfpb_icfcm_device_tokens_list', '_wpnonce' );
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
         * Notifications delivered and read report
         * @since 2.20
         */
        public function PNFPB_push_notifications_delivery_list_screen_option()
        {
            $option = "per_page";
            $args = [
                "label" => "Notifications delivered & read list",
                "default" => 20,
                "option" => "records_per_page",
            ];

            add_screen_option($option, $args);

            $this->pushnotifications_delivered_obj = new PNFPB_ICFM_delivery_notifications_List();
        }
		
        /**
         * Admin page to list and manage device tokens - Screen options
         * @since 1.64
         */
        public function PNFPB_push_notifications_browser_delivery_list_screen_option()
        {
            $option = "per_page";
            $args = [
                "label" => "Notifications delivered with browser details",
                "default" => 20,
                "option" => "records_per_page",
            ];

            add_screen_option($option, $args);

            $this->pushnotification_browser_delivered_obj = new PNFPB_ICFM_browser_delivery_notifications_List();
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
         * Customize shortcode settings
         * @since 2.13
         *
         */
        public function PNFPB_icfcm_shortcode_settings()
        {
            include plugin_dir_path(__FILE__) .
                "admin/pnfpb_admin_shortcode_customization.php";
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
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_register_settings/pnfpb_register_settings.php";
        }
		
		public function pnfpb_ic_fcm_santize_array_callback($pwa_array) {
			
    		return map_deep( $pwa_array, 'sanitize_text_field' );
			
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
					"toplevel_page_pnfpb-push-notification-configuration-slug" == 
						$screen->base ||					
					"pnfpb-push-notification_page_pnfpb-push-notification-configuration-slug" == 
						$screen->base ||					
					"settings_page_pnfpb-push-notification-configuration-slug" == 
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
                "3.00.1",
                true
            );
            wp_enqueue_script("pnfpb_ic_upload_icon_script");
            $filename = "/admin/js/pnfpb_ic_pwa_upload_icon_v3.js";
            wp_register_script(
                "pnfpb_ic_pwa_upload_icon_script",
                plugins_url($filename, __FILE__),
                ["jquery", "wp-i18n"],
                "3.00.1",
                true
            );
            wp_localize_script("pnfpb_ic_pwa_upload_icon_script", $ajaxobject, [
                "ajax_url" => admin_url("admin-ajax.php"),
				"nonce" => wp_create_nonce('pnfpbuploadiconnonce'),
            ]);
            wp_enqueue_script("pnfpb_ic_pwa_upload_icon_script");
            $filename = "/admin/js/pnfpb_ic_ondemand_push_upload_image.js";
            wp_register_script(
                "pnfpb_ic_ondemand_push_upload_image_script",
                plugins_url($filename, __FILE__),
                ["jquery", "wp-i18n"],
                "3.00.1",
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
			global $post;
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
		
		/*
		 * Generate Google client token every 60 minutes for Firebase push notification
		 * 
		 */
		public function PNFPB_generate_FB_oauth_token() {
			
			if (get_option("pnfpb_httpv1_push") === "1") {
			
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
         * @modified 2.21.0
         * @since 1.0.0
         */
        public function PNFPB_icforum_push_notifications_activity(
            $activity_content = null,
            $user_id = null,
            $activity_id = null
        ) {
			if ( (defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON) || get_option("pnfpb_ic_fcm_async_notifications") === false || get_option("pnfpb_ic_fcm_async_notifications") !== "1") {
				// WP-Cron is disabled
				$this->pnfpb_all_activities_notification_obj->PNFPB_all_activities_notification($activity_content,$user_id,$activity_id);
			} else {
				// WP-Cron is enabled
				$arguments = array(	'activity_content' => $activity_content, 
									'user_id' => $user_id, 
									'activity_id' => $activity_id, 
								  );
				as_schedule_single_action( time()+2, 'PNFPB_trigger_activity_push_notification_action',$arguments );
		
			}

		}
		
       /**
         * Triggered after creating group activity in BuddyPress to send push notifications
         * Opt in/out for the notification can be controlled from plugin settings.
         *
         * @param string   $activity_content Activity content
         * @param numeric  $user_id 			USER ID
         * @param numeric  $activity_id		Activity ID
         *
         * @modified 2.21.0
         * @since 1.0.0
         */
        public function PNFPB_icforum_push_notifications_group_activity(
            $activity_content = null,
            $user_id = null,
			$group_id = null,
            $activity_id = null,
			$sendschedule = "no"
        ) {
			
			if ( (defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON) || get_option("pnfpb_ic_fcm_async_notifications") === false || get_option("pnfpb_ic_fcm_async_notifications") !== "1") {
				// WP-Cron is disabled
				$this->pnfpb_group_activities_notification_obj->PNFPB_group_activities_notification($activity_content,$user_id,$group_id,$activity_id,$sendschedule);
			} else {
				$arguments = array( 'activity_content' => $activity_content, 'user_id' => $user_id, 'group_id' => $group_id, 'activity_id' => $activity_id, 'sendschedule' => $sendschedule );
				as_schedule_single_action( time()+5, 'PNFPB_group_activity_notification_cron_hook',$arguments );
				spawn_cron();
			}
 
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
			if ( (defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON) || get_option("pnfpb_ic_fcm_async_notifications") === false || get_option("pnfpb_ic_fcm_async_notifications") !== "1")  {
				// WP-Cron is disabled
				$this->pnfpb_private_message_notification_obj->PNFPB_private_message_notification(
					$raw_args
				);
			} else {
				$arguments = array(
					'raw_args' => $raw_args,
				);
				as_schedule_single_action( time()+2, 'PNFPB_private_message_notification_cron_hook',$arguments );
				spawn_cron();
			}
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
        public function PNFPB_icforum_push_notifications_new_member($user_id, $key, $user)
        {
			if ( (defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON) || get_option("pnfpb_ic_fcm_async_notifications") === false || get_option("pnfpb_ic_fcm_async_notifications") !== "1") {
				// WP-Cron is disabled
				$this->pnfpb_new_member_joined_notification_obj->PNFPB_new_member_joined_notification($user_id,$key,$user);
			} else {
				$arguments = array('user_id' => $user_id, 'key' => $key, 'user' => $user );
				as_schedule_single_action( time()+2, 'PNFPB_new_member_notification_cron_hook',$arguments );
				spawn_cron();
			}

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
			if ( (defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON) || get_option("pnfpb_ic_fcm_async_notifications") === false || get_option("pnfpb_ic_fcm_async_notifications") !== "1")  {
				// WP-Cron is disabled
				$this->pnfpb_friendship_request_notification_obj->PNFPB_friendship_request_notification(
					$friendship_id,
            		$initiator_id,
            		$friend_id
				);
			} else {
				$arguments = array(
					'friendship_id' => $friendship_id,
            		'initiator_id' => $initiator_id,
            		'friend_id' => $friend_id 
				);
				as_schedule_single_action( time()+2, 'PNFPB_friendship_request_notification_cron_hook',$arguments );
				spawn_cron();
			}
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
			if ( (defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON) || get_option("pnfpb_ic_fcm_async_notifications") === false || get_option("pnfpb_ic_fcm_async_notifications") !== "1") {
				// WP-Cron is disabled
				$this->pnfpb_friendship_accept_notification_obj->PNFPB_friendship_accept_notification(
					$friendship_id,
            		$initiator_id,
            		$friend_id
				);
			} else {
				$arguments = array(
					'friendship_id' => $friendship_id,
            		'initiator_id' => $initiator_id,
            		'friend_id' => $friend_id 
				);
				as_schedule_single_action( time()+2, 'PNFPB_friendship_accept_notification_cron_hook',$arguments );
				spawn_cron();
			}
        }
		
       /**
         * Triggered after user marked activity as favourite or liked an activity in BuddyPress.
         * to send push notifications Opt in/out for the notification can be
         * controlled from plugin settings.
         *
         *
         * @param array   $raw_args		Message content array
         *
         *
         * @since 2.14
         */
        public function PNFPB_icforum_push_notifications_mark_as_favourite(
            $activity_id,
            $user_id
        ) {
			if ( (defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON) || get_option("pnfpb_ic_fcm_async_notifications") === false || get_option("pnfpb_ic_fcm_async_notifications") !== "1")  {
				// WP-Cron is disabled
				$this->pnfpb_mark_as_favourite_notification_obj->PNFPB_mark_as_favourite_notification($activity_id,$user_id);
			} else {
				$arguments = array( 'activity_id' => $activity_id,'user_id' => $user_id );
				as_schedule_single_action( time()+2, 'PNFPB_mark_as_favourite_notification_cron_hook',$arguments );
				spawn_cron();
			}
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
			if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON || get_option("pnfpb_ic_fcm_async_notifications") === false || get_option("pnfpb_ic_fcm_async_notifications") !== "1") {
				// WP-Cron is disabled
				$this->pnfpb_avatar_change_notification_obj->PNFPB_avatar_change_notification($user_id);
			} else {
				$arguments = array( 'user_id' => $user_id );
				as_schedule_single_action( time()+2, 'PNFPB_avatar_change_notification_cron_hook',$arguments );
				spawn_cron();
			}
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
			if ( (defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON) || get_option("pnfpb_ic_fcm_async_notifications") === false || get_option("pnfpb_ic_fcm_async_notifications") !== "1") {
				// WP-Cron is disabled
				$this->pnfpb_cover_image_change_notification_obj->PNFPB_cover_image_change_notification($item_id,$cover_url);
			} else {
				$arguments = array( 'item_id' => $item_id,'cover_url' => $cover_url );
				as_schedule_single_action( time()+2, 'PNFPB_cover_image_change_notification_cron_hook',$arguments );
				spawn_cron();
			}
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
			if ( (defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON) || get_option("pnfpb_ic_fcm_async_notifications") === false || get_option("pnfpb_ic_fcm_async_notifications") !== "1") {
				// WP-Cron is disabled
				$this->pnfpb_post_comments_notification_obj->PNFPB_post_comments_notification(
					$comment_ID,
            		$comment_approved,
            		$commentdata,
				);
			} else {
				$arguments = array(             
					'comment_ID' => $comment_ID,
            		'comment_approved' => $comment_approved,
            		'commentdata' => $commentdata,
				);
				as_schedule_single_action( time()+2, 'PNFPB_post_comments_notification_cron_hook',$arguments );
				spawn_cron();
			}
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
			if ( (defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON) || get_option("pnfpb_ic_fcm_async_notifications") === false || get_option("pnfpb_ic_fcm_async_notifications") !== "1") {
				// WP-Cron is disabled
				$this->pnfpb_activities_comments_notification_obj->PNFPB_activities_comments_notification(
					$comment_id,
            		$params,
            		$activity,
            		$sendschedule);
			} else {
				$arguments = array(             
					'comment_id' => $comment_id,
            		'params' => $params,
            		'activity' => $activity,
            		'sendschedule' => $sendschedule );
				as_schedule_single_action( time()+2, 'PNFPB_activities_comments_notification_cron_hook',$arguments );
				spawn_cron();
			}			
        }

        /*
         * Push Notification when contact form7 submitted
         *
         * @since 1.58
         *
         */
        public function pnfpb_contact_form7_send_mail($contact_form, $abort, $submission)
        {
			if ( (defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON) || get_option("pnfpb_ic_fcm_async_notifications") === false || get_option("pnfpb_ic_fcm_async_notifications") !== "1") {
				// WP-Cron is disabled
				$this->pnfpb_contact_form_notification_obj->PNFPB_contact_form_notification($contact_form,$abort,$submission);
			} else {
				$arguments = array('contact_form' => $contact_form,'abort' => $abort,'submission' => $submission );
				as_schedule_single_action( time()+2, 'PNFPB_contact_form_notification_cron_hook',$arguments );
				spawn_cron();
			}
        }

        /*
         *
         * Push Notification when Group
         *
         * @since 1.58
         *
         */
        public function pnfpb_new_user_registrations($user_id,$userdata)
        {
 			if ( (defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON) || get_option("pnfpb_ic_fcm_async_notifications") === false || get_option("pnfpb_ic_fcm_async_notifications") !== "1") {
				// WP-Cron is disabled
				$this->pnfpb_new_user_registration_notification_obj->PNFPB_new_user_registration_notification($user_id,$userdata);
			} else {
				$arguments = array('user_id' => $user_id, 'userdata' => $userdata );
				as_schedule_single_action( time()+5, 'PNFPB_new_user_registration_notification_cron_hook',$arguments );
				spawn_cron();
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
			if ( (defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON) || get_option("pnfpb_ic_fcm_async_notifications") === false || get_option("pnfpb_ic_fcm_async_notifications") !== "1") {
				// WP-Cron is disabled
				$this->pnfpb_group_details_update_notification_obj->PNFPB_group_details_update_notification($group_id);
			} else {
				$arguments = array('group_id' => $group_id );
				as_schedule_single_action( time()+5, 'PNFPB_group_details_update_notification_cron_hook',$arguments );
				spawn_cron();
			}
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
			if ( (defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON) || get_option("pnfpb_ic_fcm_async_notifications") === false || get_option("pnfpb_ic_fcm_async_notifications") !== "1") {
				// WP-Cron is disabled
				$this->pnfpb_group_invite_notification_obj->PNFPB_group_invite_notification($group_id,$invited_users,$inviter_id);
			} else {
				$arguments = array('group_id' => $group_id,'invited_users' => $invited_users,'inviter_id' => $inviter_id );
				as_schedule_single_action( time()+5, 'PNFPB_group_invite_notification_cron_hook',$arguments );
				spawn_cron();
			}
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
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_frontend_notification_settings/pnfpb_frontend_notification_settings.php";
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
			$pnfpb_notification_shortcode = '';
			
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_custom_push_prompt_shortcode/pnfpb_custom_push_prompt_shortcode.php";
			
			return $pnfpb_notification_shortcode;
				
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
			/** Public REST API to get AES-256-GCM encrypted subscription token from mobile app Android/ios **/
            register_rest_route("PNFPBpush/v1", "/subscriptiontoken", [
                "methods" => "POST",
                "callback" => [$this, "PNFPB_get_subscription_tokens_from_app"],
                "permission_callback" => "__return_true",
            ]);
			
		   /** Public REST API to get AES-256-GCM encrypted delivery count details from serviceworker **/
           register_rest_route("PNFPBpush/v1", "/notification-delivery-counts", [
                "methods" => "POST",
                "callback" => [$this, "PNFPB_get_notification_delivery_counts_from_serviceworker"],
                "permission_callback" => "__return_true",
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
            $subscription_token_result = include plugin_dir_path(__FILE__) .
                "public/pnfpb_mobile_app_notification_api_routine/pnfpb_mobile_app_notification_api_routine.php";
			return $subscription_token_result;
        }
		
		/*
		* Sanitize callback function for Notification delivery and read counts API
		* @since 2.20
		*/
		public function PNFPB_get_notification_delivery_counts_permission_callback(WP_REST_Request $request) {
			
            include plugin_dir_path(__FILE__) .
                "public/pnfpb_delivery_counts_api_routine/pnfpb_delivery_count_api_permission_callback.php";
		}
		
        /**
        * API to Update Notification delivery and read counts in custom WordPress PNFPB mysql tables
        * @since 2.20
        */
        public function PNFPB_get_notification_delivery_counts_from_serviceworker(
            WP_REST_Request $request
        ) {
			
            $delivery_count_result = include plugin_dir_path(__FILE__) .
                "public/pnfpb_delivery_counts_api_routine/pnfpb_delivery_count_api_routine.php";
			return $delivery_count_result;
        }		

        /**
         * To generate secret key to integrate app from admin area under plugin settings
         *
         *
         * @since 1.36
         */
        public function PNFPB_icfcm_integrate_app()
        {
           include plugin_dir_path(__FILE__) .
                "admin/pnfpb_integrate_mobile_app_settings.php";
        }

        /**
         * For NGINX enabled servers, enable/disable static service worker js file and PWA manifest json file
         * in root folder of website. This settings is applicable only if server has NGINX and static files are
         * served by NGINX instead of APACHE & for .htaccess rewrite not working for dynamic js/json files.
         * @since 1.40
         */
        public function PNFPB_icfcm_settings_for_ngnix_server()
        {
           include plugin_dir_path(__FILE__) .
                "admin/pnfpb_settings_for_nginx_server.php";			
        }

    }

    $PNFPB_ICFM_Push_Notification_Post_BuddyPress_OBJ = new PNFPB_ICFM_Push_Notification_Post_BuddyPress();

    include plugin_dir_path(__FILE__) .
        "admin/pnfpb_icfcm_device_tokens_list.php";
    include plugin_dir_path(__FILE__) .
        "admin/pnfpb_icfcm_onetime_push_notifications_list_class.php";
    include plugin_dir_path(__FILE__) .
        "admin/pnfpb_delivery_notifications_list_class.php";
    include plugin_dir_path(__FILE__) .
        "admin/pnfpb_delivery_notifications_browser_list_class.php";	
    include plugin_dir_path(__FILE__) .
        "public/pnfpb_topic_subscription_update/PNFPB_httpv1_subscription_option_update.php";
} else {
    exit();
}
?>