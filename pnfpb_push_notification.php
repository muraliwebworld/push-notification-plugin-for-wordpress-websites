<?php
/*
Plugin Name: Push Notification for Post and BuddyPress
Plugin URI: https://www.muraliwebworld.com/groups/wordpress-plugins-by-muralidharan-indiacitys-com-technologies/forum/topic/push-notification-for-post-and-buddypress/
Description: Push notification for Post,custom post,BuddyPress,Woocommerce,Android/IOS mobile apps. Configure push notification settings in <a href="admin.php?page=pnfpb-icfcm-slug"><strong>settings page</strong></a>
Version: 1.82
Author: Muralidharan Ramasamy
Author URI: https://www.muraliwebworld.com
Text Domain: PNFPB_TD
Updated: 26 March 2024
*/
/**
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Copyright (c) <2022> <Muralidharan Ramasamy>
 *
 *
 * @author    Murali
 * @copyright 2022 Indiacitys.com Technologies private limited, Coimbatore, India
 * @license   GPLv2 or later
 * 
 */


/***********/


if (!defined('ABSPATH')) {
    exit;
}


if (!defined("PNFPB_VERSION_CURRENT")) define("PNFPB_VERSION_CURRENT", '1');
if (!defined("PNFPB_URL")) define("PNFPB_URL", plugin_dir_url( __FILE__ ) );
if (!defined("PNFPB_PLUGIN_DIR")) define("PNFPB_PLUGIN_DIR", plugin_dir_path(__FILE__));
if (!defined("PNFPB_PLUGIN_NM")) define("PNFPB_PLUGIN_NM", 'Push Notification PNFPB');
if (!defined("PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER")) define("PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER", 'Device tokens');
if (!defined("PNFPB_PLUGIN_NM_SETTINGS")) define("PNFPB_PLUGIN_NM_SETTINGS", 'PNFPB - Settings for Push Notification');
if (!defined("PNFPB_PLUGIN_NM_DEVICE_TOKENS")) define("PNFPB_PLUGIN_NM_DEVICE_TOKENS", 'PNFPB - Device tokens');
if (!defined("PNFPB_PLUGIN_NM_DEVICE_TOKENS_LIST_HEADER")) define("PNFPB_PLUGIN_NM_DEVICE_TOKENS_LIST_HEADER", 'List of device tokens registered for push notification');
if (!defined("PNFPB_PLUGIN_NM_DEVICE_TOKENS_LIST_DETAILS")) define("PNFPB_PLUGIN_NM_DEVICE_TOKENS_LIST_DETAILS", '(Do not delete tokens unneccessarily it will result in user will not receive push notification, unless it is needed, avoid deleting tokens )');
if (!defined("PNFPB_PLUGIN_NM_PWA_HEADER")) define("PNFPB_PLUGIN_NM_PWA_HEADER", 'PWA/app');
if (!defined("PNFPB_PLUGIN_NM_PWA_SETTINGS")) define("PNFPB_PLUGIN_NM_PWA_SETTINGS", 'PWA Progressive web app settings');
if (!defined("PNFPB_PLUGIN_PWA_SETTINGS")) define("PNFPB_PLUGIN_PWA_SETTINGS", 'Below settings are to generate Progressive Web App(PWA) with offline facility');
if (!defined("PNFPB_PLUGIN_PWA_SETTINGS_DESCRIPTION")) define("PNFPB_PLUGIN_PWA_SETTINGS_DESCRIPTION", 'All below fields are required to generate Progressive Web App (PWA). Additionally, Enable/disable PWA app by selecting appropriate check box and Enter appropriate URLs to store in cache for offline PWA app, selected pages can be viewed in offline without internet. In offline mode, if page is not available/stored in cache then 404 offline page will be displayed');
if (!defined("PNFPB_PLUGIN_ENABLE_PUSH")) define("PNFPB_PLUGIN_ENABLE_PUSH", 'Enable/Disable push notifications for following types');
if (!defined("PNFPB_PLUGIN_SCHEDULE_PUSH")) define("PNFPB_PLUGIN_SCHEDULE_PUSH", 'If schedule is enabled then push notification will be sent as per selected schedule otherwise it will be sent whenever new item is posted.<br/>BuddyPress notifications will work only when BuddyPress plugin is installed and active.<br/><b>If you have more than 1000 subscribers, enable schedule in background mode(asynchronous).<br/>Refer scheduled action tab for background scheduled jobs</b><br/>');
if (!defined("PNFPB_PLUGIN_FIREBASE_SETTINGS")) define("PNFPB_PLUGIN_FIREBASE_SETTINGS", 'Firebase configuration');
if (!defined("PNFPB_PLUGIN_NM_ONDEMANDPUSH_HEADER")) define("PNFPB_PLUGIN_NM_ONDEMANDPUSH_HEADER", 'On demand push notification');
if (!defined("PNFPB_PLUGIN_NM_BUTTON_HEADER")) define("PNFPB_PLUGIN_NM_BUTTON_HEADER", 'Customize buttons');
if (!defined("PNFPB_PLUGIN_NM_FRONTEND_SETTINGS_HEADER")) define("PNFPB_PLUGIN_NM_FRONTEND_SETTINGS_HEADER", 'Frontend subscription');
if (!defined("PNFPB_PLUGIN_NM_ONDEMANDPUSH_SETTINGS")) define("PNFPB_PLUGIN_NM_ONDEMANDPUSH_SETTINGS", 'On demand or one time push notification');
if (!defined("PNFPB_PLUGIN_API_MOBILE_APP_HEADER")) define("PNFPB_PLUGIN_API_MOBILE_APP_HEADER", " API to integrate mobile app");
if (!defined("PNFPB_PLUGIN_NM_ONDEMANDPUSH_DETAIL")) define("PNFPB_PLUGIN_NM_ONDEMANDPUSH_DETAIL", 'To send on demand or one time push notification to all subscribers with image');
if (!defined("PNFPB_TD")) define("PNFPB_TD", "PNFPB_TD");
if (!defined("PNFPB_PLUGIN_NGINX_HEADER")) define("PNFPB_PLUGIN_NGINX_HEADER", "for NGINX");
if (!defined("PNFPB_PLUGIN_NGINX_SETTINGS")) define("PNFPB_PLUGIN_NGINX_SETTINGS", "Settings for NGINX based server/hosting");
if (!defined("PNFPB_PLUGIN_SCHEDULE_ACTIONS")) define("PNFPB_PLUGIN_SCHEDULE_ACTIONS", "Scheduled actions");
if (!defined("PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION")) define("PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION", "if server/hosting is based on NGINX and if it is not able to serve dynamic service worker push notification js file(like for example: https:/<yourdomain>/pnfpb_icpush_pwa_sw.js), PWA manifest json file (like for example: https:/<yourdomain>/pnfpb_icpush_pwa_sw.js) from APACHE then enable this option to create static service worker js file for push notification and PWA manifest json files in your website root folder. If this option is enabled it will automatically create push notification service worker file which is used for push notification and PWA manifest json file (pnfpbmanifest.json) in root folder");
if (!defined("PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION2")) define("PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION2", "Enable this option only when push notification dynamic service worker file(like for example: https:/<yourdomain>/pnfpb_icpush_pwa_sw.js) not created for SERVER BASED ON NGINX. If this option is enabled it will automatically create push notification service worker file (pnfpb_icpush_pwa_sw.js) which is used for push notification and PWA manifest json file (pnfpbmanifest.json) in root folder");
if (!defined("PNFPB_PLUGIN_DISABLE_SW_SETTINGS_DESCRIPTION")) define("PNFPB_PLUGIN_DISABLE_SW_SETTINGS_DESCRIPTION", "Disable push notification service worker file and PWA");
if (!defined("PNFPB_PLUGIN_DISABLE_SW_SETTINGS_DESCRIPTION2")) define("PNFPB_PLUGIN_DISABLE_SW_SETTINGS_DESCRIPTION2", "This option will disable service worker file, it will switch off push notification service as well as it will switch off PWA. Use this option only, if you want to use this plugin for push notification services via REST API (example: for mobile app using WebView) ");
if (!defined("PNFPB_PLUGIN_DISABLE_SW_SETTINGS_DESCRIPTION3")) define("PNFPB_PLUGIN_DISABLE_SW_SETTINGS_DESCRIPTION3", "Currently, Service worker file is disabled/not created. if you need push notification and PWA in website, please enable service worker file using below option");
if (!defined("PNFPB_PLUGIN_NM_ACTION_SCHEDULER")) define("PNFPB_PLUGIN_NM_ACTION_SCHEDULER", 'Action Scheduler');
define( 'PNFPB_PLUGIN_DIR_PATH', plugin_dir_url( __FILE__ ) );

/**
 * Class to load required functions for push notification
 *
 * @since 1.0.0
 *
 */
require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
if ( !class_exists( 'PNFPB_ICFM_Push_Notification_Post_BuddyPress' ) ) {
	
	class PNFPB_ICFM_Push_Notification_Post_BuddyPress
	{
		public $pre_name = 'PNFPB_';
		
		public $devicetokens_obj;
		
		public $pushnotifications_obj;
		
		public Messaging $messaging;

		public function __construct()
		{
			
			//$this->messaging = $factory->createMessaging();
			
			add_filter( 'set-screen-option', [ __CLASS__, 'PNFPB_set_screen' ], 10, 3 );
			
			// Installation and uninstallation hooks
			register_activation_hook(__FILE__, array($this, $this->pre_name . 'activate'));
			register_deactivation_hook(__FILE__, array($this, $this->pre_name . 'deactivate'));
			
			add_action('plugins_loaded', array($this, $this->pre_name .'update_database'));
			
			add_action('plugins_loaded', array($this, $this->pre_name .'load_action_scheduler'),-10);
        
			// Add a link to the plugin's settings and/or network admin settings in the plugins list table.
			add_filter( 'plugin_action_links', array($this, $this->pre_name .'add_settings_link' ), 10, 2 );
			add_filter( 'network_admin_plugin_action_links', array($this, $this->pre_name .'add_settings_link' ), 10, 2 );
			
			add_filter( 'action_scheduler_pastdue_actions_check_pre', '__return_false' );
			
			//Scheduled one time push notification routine
			add_action( 'PNFPB_ondemand_schedule_push_notification_hook', array($this, $this->pre_name .'ondemand_schedule_push_notification'),10,4 );			
		
			//Enqueue needed scripts for frontend and for admin area
			add_action( 'login_enqueue_scripts', array($this, $this->pre_name .'ic_push_notification_scripts'),20 );
			add_action( 'wp_enqueue_scripts', array($this, $this->pre_name .'ic_push_notification_scripts'),20 );
			add_action( 'admin_enqueue_scripts', array($this, $this->pre_name .'ic_admin_push_notification_scripts'),20 );
			
			add_action( 'wp_ajax_icpushcallback', array($this,  $this->pre_name .'icpushcallback_callback') );
			add_action( 'wp_ajax_nopriv_icpushcallback', array($this,  $this->pre_name .'icpushcallback_callback') );
			
			add_action( 'wp_ajax_icpushadmincallback', array($this,  $this->pre_name .'icpushadmincallback_callback') );
			add_action( 'wp_ajax_nopriv_icpushadmincallback', array($this,  $this->pre_name .'icpushadmincallback_callback') );			
			
			add_action( 'wp_ajax_unsubscribepush', array($this,  $this->pre_name .'unsubscribe_push_callback') );
			add_action( 'wp_ajax_nopriv_unsubscribepush', array($this,  $this->pre_name .'unsubscribe_push_callback') );
			
			//Plugin settings in admin area
			add_action('admin_menu', array($this, $this->pre_name . 'setup_admin_menu'), 1);
			add_action('admin_init', array($this, $this->pre_name . 'settings'));
			add_action('admin_init', array($this, $this->pre_name . 'ic_push_upload_icon_script'));
			
			add_action('admin_init', array($this, $this->pre_name. 'send_push_post_options'));
			
			add_action( 'wp_enqueue_scripts', array( $this, $this->pre_name .'load_text_domain' ), 100 );
			
			//create service worker file which is needed for push notification using FCM
			add_action('init', array($this, $this->pre_name .'icpush_sw_file_create'));
		
			//add manifest link for PWA app
			add_action( 'wp_head', array($this, $this->pre_name . 'include_manifest_link'),6);
			add_action( 'login_head', array($this, $this->pre_name . 'include_manifest_link'),6);

			//add custom pwa install prompt
			add_action( 'wp_footer', array($this, $this->pre_name . 'custom_pwa_install_prompt'),6);
			add_action( 'login_footer', array($this, $this->pre_name . 'custom_pwa_install_prompt'),6);
		
			//Push notification(if enabled) for post and custom post types based on plugin settings
			add_action('save_post', array($this, $this->pre_name . 'on_post_save_web'),5, 3);
			
			// Scheduled push notification(if enabled) for post and custom post types
			add_action( $this->pre_name .'cron_post_hook', array($this, $this->pre_name . 'icforum_push_notifications_post_web'));
			
			//Push notification for comments posted on post.
			add_action( 'comment_post', array($this,  $this->pre_name .'icforum_push_notifications_post_comment_web'),10,3);
				
			// Scheduled push notification(if enabled) for new comments in Buddypress Activities
			add_action( $this->pre_name .'cron_comments_post_hook', array($this,  $this->pre_name .'icforum_push_notifications_post_comment_web'));
			
			// Scheduled task to delete push subscription token with user id no longer exists
			add_action( $this->pre_name .'cron_token_delete_user_not_exist_hook', array($this,  $this->pre_name .'icforum_delete_token_user_not_exist'));			
			
			add_action( 'rest_api_init',array($this,  $this->pre_name .'rest_api_subscription_tokens_from_app'));
			//
			
			if ( function_exists('bp_is_active') ) {
				
		
				//Push notification(if enabled) for BuddyPress new acitivities based on plugin settings
				add_action('bp_activity_posted_update', array($this,  $this->pre_name .'icforum_push_notifications_web'), 5, 3 );
			
				// Scheduled push notification(if enabled) for new buddypress activities
				add_action( $this->pre_name .'cron_buddypressactivities_hook', array($this,  $this->pre_name .'icforum_push_notifications_web'));			
			
				//Push notification(if enabled) for BuddyPress new acitivities under group based on plugin settings
				add_action( 'bp_groups_posted_update', array($this,  $this->pre_name .'icforum_push_notifications_web_group'), 1, 4 );
			
				// Scheduled push notification(if enabled) for new group activities
				add_action( $this->pre_name .'cron_buddypressgroupactivities_hook', array($this,  $this->pre_name .'icforum_push_notifications_web_group'));
				
				//Push notification(if enabled) for BuddyPress Private messages. It will Send notifications only to userid.
				add_action( 'messages_message_sent', array($this,  $this->pre_name .'icforum_push_notifications_private_messages'), 10 );
				
				if ( class_exists( 'Better_Messages' )) {
					//It is for BP Better messages plugin - Push notification for BuddyPress Private messages. It will Send notifications only to userid.
					add_action( 'better_messages_message_sent', array($this,  $this->pre_name .'icforum_push_notifications_private_messages'), 10 );
				}
				
				//Push notification(if enabled) for BuddyPress Private messages. It will Send notifications only to userid.
				add_action( 'bp_core_activated_user', array($this,  $this->pre_name .'icforum_push_notifications_new_member'), 10, 3 );
				
				//Push notification(if enabled) for BuddyPress Private messages. It will Send notifications only to userid.
				add_action( 'friends_friendship_requested', array($this,  $this->pre_name .'icforum_push_notifications_friendship_request'), 10, 3 );
				
				//Push notification(if enabled) for BuddyPress Private messages. It will Send notifications only to userid.
				add_action( 'friends_friendship_accepted', array($this,  $this->pre_name .'icforum_push_notifications_friendship_accepted'), 10, 3 );
				
				//Push notification(if enabled) for BuddyPress Private messages. It will Send notifications only to userid.
				add_action( 'bp_members_avatar_uploaded', array($this,  $this->pre_name .'icforum_push_notifications_avatar_change'), 10, 3 );
				
				//Push notification(if enabled) for BuddyPress Private messages. It will Send notifications only to userid.
				add_action( 'members_cover_image_uploaded', array($this,  $this->pre_name .'icforum_push_notifications_cover_image_change'), 10, 3 );				
						
				//Push notification(if enabled) for new comments posted on BuddyPress acitivities based on plugin settings
				add_action( 'bp_activity_comment_posted', array($this,  $this->pre_name .'icforum_push_notifications_comment_web'), 5, 3 );
			
				// Scheduled push notification(if enabled) for new comments in Buddypress Activities
				add_action( $this->pre_name .'cron_buddypresscomments_hook', array($this,  $this->pre_name .'icforum_push_notifications_comment_web'));	
										
				if (  function_exists( 'buddyboss_platform_plugin_update_notice' ) ) {
					add_filter( 'bp_get_group_join_button', array($this,  $this->pre_name .'subscribe_to_group_button'), 101, 1 );
				}
				else {
					add_action ( 'bp_group_header_actions', array($this,  $this->pre_name .'subscribe_to_group_button'), 1);
					add_action ( 'bp_directory_groups_actions' , array($this,  $this->pre_name .'subscribe_to_group_button'), 1);
				}
				
				//add_action ( 'bp_directory_groups_actions' , array($this,  $this->pre_name .'subscribe_to_group_button'), 1);
				
				add_action ( 'bp_setup_nav', array( $this, $this->pre_name .'buddypress_setup_notification_settings_nav' ) );
				
        		//add_action( 'groups_invite_user', array( $this, $this->pre_name .'buddypress_group_invitation_notification' ) );
				
				add_action( 'groups_send_invites', array( $this, $this->pre_name .'buddypress_group_invitation_notification' ), 5, 3 );
				
				add_action( 'groups_group_details_edited', array( $this, $this->pre_name .'buddypress_group_details_updated_notification' ) );
				

			}
	
			//Shortcode to unsubscribe push notification
			add_shortcode( 'subscribe_PNFPB_push_notification', array($this,  $this->pre_name .'subscribe_push_notification_shortcode') );
			
			//Shortcode for PWA
			add_shortcode( 'PNFPB_PWA_PROMPT', array($this,  $this->pre_name .'pwa_prompt_shortcode') );
			
			//admin notices to show settings menu moved to top level menu
			add_action( 'admin_notices', array( $this, $this->pre_name .'wpb_admin_notice_warn' ) );
			
			//admin bar menu
			add_action( 'admin_bar_menu', [ $this, $this->pre_name .'ic_fcm_admin_bar_menu_register' ], 999 );
			
			//Push notification to admin id, when new user registers
			add_action( 'user_register', array( $this, $this->pre_name .'new_user_registrations' ) );
				
			//Push notification to admin id, when contact form7 submitted
			add_action( 'wpcf7_before_send_mail', array( $this, $this->pre_name .'contact_form7_send_mail' ), 15, 3 );
			
			//add_filter('upload_mimes', array($this, $this->pre_name.'cc_mime_types'), 15,3);
		
	
		}
		
	
		/**
		* 
		* @since 1.65
		* 
		*/
		public function PNFPB_cc_mime_types($mimes) {
			$mimes['json'] = 'application/json'; 
			$mimes['svg'] = 'image/svg+xml'; 
			return $mimes; 
		} 
		
		/**
		*@since 1.58
		*
		*/
		
		public function PNFPB_wpb_admin_notice_warn() {

				if ( get_option('PNFBP_admin_notice') != 'notalive' ) {
			
					echo '<div class="pnfpb_admin_notice notice notice-info is-dismissible">
      <p>Important: PNFPB plugin settings are now in top level admin menu. It is in left sidebar of admin menu below settings menu. <a href="'.admin_url( "admin.php?page=pnfpb-icfcm-slug" ).'">Click here to go to plugin settings.</a></p></div>';
				}
			
		}
		
		/**
		 * Load Action scheduler if action_scheduler plugin not active/class not present
		 * Alter push notification table to add new column subscription_option (if not exists)
		 * @since 1.50.0
		 **/
    	public function PNFPB_load_action_scheduler() {
			
			if ( ! function_exists( 'action_scheduler_register_3_dot_5_dot_3' ) && function_exists( 'add_action' ) ) {
			
				require_once( plugin_dir_path( __FILE__ ) . '/libraries/action-scheduler/action-scheduler.php' );
				
			}
			
			
		}
		
	
		/**
		 * Alter push notification table to add new column subscription_option (if not exists)
		 **/
    	public function PNFPB_update_database() {
			
			/*@ Add status column if not exist */
			global $wpdb;
			
			$table_name = $wpdb->prefix . 'pnfpb_ic_schedule_push_notifications';

			$charset_collate = $wpdb->get_charset_collate();

			$sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
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
                    PRIMARY KEY (id)
                ) {$charset_collate};";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        
			dbDelta( $sql );			
			
			$dbname = $wpdb->dbname;

			$pnfpb_table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

 			$is_status_col = $wpdb->get_results(  "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS`    WHERE `table_name` = '{$pnfpb_table_name}' AND `TABLE_SCHEMA` = '{$dbname}' AND `COLUMN_NAME` = 'subscription_option'"  );
			
			$is_status_web256 = $wpdb->get_results(  "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS`    WHERE `table_name` = '{$pnfpb_table_name}' AND `TABLE_SCHEMA` = '{$dbname}' AND `COLUMN_NAME` = 'web_256'"  );
			
			$is_firebase_version = $wpdb->get_results(  "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS`    WHERE `table_name` = '{$pnfpb_table_name}' AND `TABLE_SCHEMA` = '{$dbname}' AND `COLUMN_NAME` = 'firebase_version'"  );
			
			if( empty($is_status_col) ):
			
    			$add_status_column = "ALTER TABLE `{$pnfpb_table_name}` ADD `subscription_option` VARCHAR(50) NULL DEFAULT NULL AFTER `device_id`; ";			
				$wpdb->query( $add_status_column );
			
			endif;
			
			if( empty($is_status_web256) ) { 
			
    			$add_device_details_column = "ALTER TABLE `{$pnfpb_table_name}`
				ADD `firebase_version` VARCHAR(100) DEFAULT 'L',
				ADD `ip_address` VARCHAR(100) NULL DEFAULT NULL,
				ADD `web_auth` VARCHAR(600) NULL DEFAULT NULL,
				ADD `web_256` VARCHAR(600) NULL DEFAULT NULL AFTER `subscription_option`; ";

   				$wpdb->query( $add_device_details_column );
				
			}
			else 
			{
				if( empty($is_firebase_version) ) {
					$modify_firebase_version = "ALTER TABLE `{$pnfpb_table_name}` ADD firebase_version VARCHAR(100) DEFAULT 'L';";
					$wpdb->query( $modify_firebase_version );
				}
				$pnfpblength = $wpdb->get_col_length($pnfpb_table_name,'web_256');
				if (!empty($is_status_web256) && ($pnfpblength['length'] <= 50)) {
					$modify_web_256_column = "ALTER TABLE `{$pnfpb_table_name}` MODIFY COLUMN web_256 VARCHAR(600);";
					$wpdb->query( $modify_web_256_column );
					$modify_web_auth_column = "ALTER TABLE `{$pnfpb_table_name}` MODIFY COLUMN web_auth VARCHAR(600);";
					$wpdb->query( $modify_web_auth_column );
					
				}
				$pnfpblength = $wpdb->get_col_length($pnfpb_table_name,'web_256');
				if (!empty($is_status_web256) && ($pnfpblength['length'] <= 300)) {
					$modify_web_256_column = "ALTER TABLE `{$pnfpb_table_name}` MODIFY COLUMN web_256 VARCHAR(600);";
					$wpdb->query( $modify_web_256_column );
					$modify_web_auth_column = "ALTER TABLE `{$pnfpb_table_name}` MODIFY COLUMN web_auth VARCHAR(600);";
					$wpdb->query( $modify_web_auth_column );
					
				}				
			}
			
		
			$dbname = $wpdb->dbname;

			$pnfpb_table_name = $wpdb->prefix . "pnfpb_ic_schedule_push_notifications";
			
			$is_recurring_day_number = $wpdb->get_results(  "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS`    WHERE `table_name` = '{$pnfpb_table_name}' AND `TABLE_SCHEMA` = '{$dbname}' AND `COLUMN_NAME` = 'recurring_day_number'"  );
			
			if( empty($is_recurring_day_number) ) {

				$add_recurring_columns = "ALTER TABLE `{$pnfpb_table_name}` 
						ADD `recurring_day_number` VARCHAR(100)  NULL DEFAULT NULL,
						ADD `recurring_month_number` VARCHAR(100)  NULL DEFAULT NULL,
						ADD `recurring_day_name` VARCHAR(100)  NULL DEFAULT NULL;";
					
				$wpdb->query( $add_recurring_columns );
				
				
			}
			
			$is_scheduled_type = $wpdb->get_results(  "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS`    WHERE `table_name` = '{$pnfpb_table_name}' AND `TABLE_SCHEMA` = '{$dbname}' AND `COLUMN_NAME` = 'scheduled_type'"  );
			
			if( empty($is_scheduled_type) ) {

				$add_scheduled_type = "ALTER TABLE `{$pnfpb_table_name}` 
						ADD `scheduled_type` VARCHAR(100)  NULL DEFAULT NULL;";
					
				$wpdb->query( $add_scheduled_type );
				
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
        
			$table_name = $wpdb->prefix . 'pnfpb_ic_subscribed_deviceids_web';

			$charset_collate = $wpdb->get_charset_collate();

			$sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
                    id bigint(20) NOT NULL AUTO_INCREMENT,
                    userid bigint(20) NOT NULL,
                    device_id varchar(300) NOT NULL,
					subscription_option VARCHAR(50) NULL,
					ip_address VARCHAR(100) NULL DEFAULT NULL,
					web_auth VARCHAR(600) NULL DEFAULT NULL,
					web_256 VARCHAR(600) NULL DEFAULT NULL,					
                    PRIMARY KEY (id)
                ) {$charset_collate};";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        
			dbDelta( $sql );
			
			$table_name_2 = $wpdb->prefix . 'pnfpb_ic_schedule_push_notifications';

			$charset_collate_2 = $wpdb->get_charset_collate();

			$sql_2 = "CREATE TABLE IF NOT EXISTS {$table_name_2} (
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

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        
			dbDelta( $sql_2 );				
			
			if ( ! function_exists( 'action_scheduler_register_3_dot_5_dot_3' ) && function_exists( 'add_action' ) ) {
			
				require_once( plugin_dir_path( __FILE__ ) . '/libraries/action-scheduler/action-scheduler.php' );
				
			}
			
			if (get_option('pnfpb_ic_fcm_post_schedule_enable') && get_option('pnfpb_ic_fcm_post_schedule_enable') == 1) {
				if ( !wp_next_scheduled( 'PNFPB_cron_post_hook' ) ) {
						if (get_option('pnfpb_ic_fcm_post_timeschedule_enable') === 'hourly') {
							$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+1 hours', strtotime("now"))));
						}
						if (get_option('pnfpb_ic_fcm_post_timeschedule_enable') === 'twicedaily') {
							$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+12 hours', strtotime("now"))));
						}
						if (get_option('pnfpb_ic_fcm_post_timeschedule_enable') === 'daily') {
							$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+24 hours', strtotime("now"))));
						}
						if (get_option('pnfpb_ic_fcm_post_timeschedule_enable') === 'weekly') {
							$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+1 week', strtotime("now"))));
						}					
    					wp_schedule_event( $new_time, get_option('pnfpb_ic_fcm_post_timeschedule_enable'), 'PNFPB_cron_post_hook' );
					}
			}


			if (get_option('pnfpb_ic_fcm_buddypressactivities_schedule_enable') && get_option('pnfpb_ic_fcm_buddypressactivities_schedule_enable') == 1) 			  {
					if ( !wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' ) ) {
						if (get_option('pnfpb_ic_fcm_buddypressactivities_schedule_enable') === 'hourly') {
							$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+1 hours', strtotime("now"))));
						}
						if (get_option('pnfpb_ic_fcm_buddypressactivities_schedule_enable') === 'twicedaily') {
							$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+12 hours', strtotime("now"))));
						}
						if (get_option('pnfpb_ic_fcm_buddypressactivities_schedule_enable') === 'daily') {
							$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+24 hours', strtotime("now"))));
						}
						if (get_option('pnfpb_ic_fcm_buddypressactivities_schedule_enable') === 'weekly') {
							$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+1 week', strtotime("now"))));
						}						
    					wp_schedule_event( $new_time, get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_enable'), 'PNFPB_cron_buddypressactivities_hook' );
					}
			}
			
			if (get_option('pnfpb_ic_fcm_buddypressgroupactivities_timeschedule_enable') && get_option('pnfpb_ic_fcm_buddypressgroupactivities_timeschedule_enable') == 1) 			  {
					if ( !wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
						if (get_option('pnfpb_ic_fcm_buddypressgroupactivities_timeschedule_enable') === 'hourly') {
							$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+1 hours', strtotime("now"))));
						}
						if (get_option('pnfpb_ic_fcm_buddypressgroupactivities_timeschedule_enable') === 'twicedaily') {
							$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+12 hours', strtotime("now"))));
						}
						if (get_option('pnfpb_ic_fcm_buddypressgroupactivities_timeschedule_enable') === 'daily') {
							$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+24 hours', strtotime("now"))));
						}
						if (get_option('pnfpb_ic_fcm_buddypressgroupactivities_timeschedule_enable') === 'weekly') {
							$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+1 week', strtotime("now"))));
						}						
    					wp_schedule_event( $new_time, get_option('pnfpb_ic_fcm_buddypressgroupactivities_timeschedule_enable'), 'PNFPB_cron_buddypressgroupactivities_hook' );
					}
			}			



			if (get_option('pnfpb_ic_fcm_buddypresscomments_schedule_enable') && get_option('pnfpb_ic_fcm_buddypresscomments_schedule_enable') == 1) {
				
				if (get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable') === 'hourly') {
					$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+1 hours', strtotime("now"))));
				}
				if (get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable') === 'twicedaily') {
					$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+12 hours', strtotime("now"))));
				}
				if (get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable') === 'daily') {
					$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+24 hours', strtotime("now"))));
				}
				if (get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable') === 'weekly') {
					$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+1 week', strtotime("now"))));
				}				
			
				if ( !wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' ) ) {
    				wp_schedule_event( $new_time, get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable'), 'PNFPB_cron_buddypresscomments_hook' );
				}
				
				if ( !wp_next_scheduled( 'PNFPB_cron_comments_post_hook' ) ) {
    				wp_schedule_event( $new_time, get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable'), 'PNFPB_cron_comments_post_hook' );
				}				
			}
			
			if (get_option('pnfpb_ic_fcm_token_delete_without_user_enable') && get_option('pnfpb_ic_fcm_token_delete_without_user_enable') == 1) {
					
				if ( !wp_next_scheduled( 'PNFPB_cron_token_delete_user_not_exist_hook' ) ) {
    				wp_schedule_event( time(), get_option('pnfpb_ic_fcm_token_delete_without_user_timeschedule_enable'), 'PNFPB_cron_token_delete_user_not_exist_hook' );
				}
				else 
				{
					$timestamp = wp_next_scheduled( 'PNFPB_cron_token_delete_user_not_exist_hook' );
					wp_unschedule_event( $timestamp, 'PNFPB_cron_token_delete_user_not_exist_hook' );
					wp_schedule_event( time(), get_option('pnfpb_ic_fcm_token_delete_without_user_timeschedule_enable'), 'PNFPB_cron_token_delete_user_not_exist_hook' );														}
			}
			
				if (get_option('pnfpb_ic_fcm_post_schedule_enable') && get_option('pnfpb_ic_fcm_post_schedule_enable') == 1 && get_option('pnfpb_ic_fcm_post_schedule_background_enable') && get_option('pnfpb_ic_fcm_post_schedule_background_enable') == 1  && 
(get_option('pnfpb_ic_fcm_post_timeschedule_enable') == 'weekly' || get_option('pnfpb_ic_fcm_post_timeschedule_enable') == 'twicedaily' || get_option('pnfpb_ic_fcm_post_timeschedule_enable') == 'daily' || get_option('pnfpb_ic_fcm_post_timeschedule_enable') == 'hourly' ||					
					(get_option('pnfpb_ic_fcm_post_timeschedule_enable') == 'seconds' && get_option('pnfpb_ic_fcm_post_timeschedule_seconds') > 59))) {
					
					$timeseconds = '3600';
					if (get_option('pnfpb_ic_fcm_post_timeschedule_enable') === 'weekly') {
						$timeseconds = '604800';
					}
					if (get_option('pnfpb_ic_fcm_post_timeschedule_enable') === 'twicedaily') {
						$timeseconds = '43200';
					}
					if (get_option('pnfpb_ic_fcm_post_timeschedule_enable') === 'daily') {
						$timeseconds = '86400';
					}
					if (get_option('pnfpb_ic_fcm_post_timeschedule_enable') === 'hourly') {
						$timeseconds = '3600';
					}
					if (get_option('pnfpb_ic_fcm_post_timeschedule_enable') === 'seconds') {
						$timeseconds = get_option('pnfpb_ic_fcm_post_timeschedule_seconds');
					}
					
					$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+'.$timeseconds.' seconds', strtotime("now"))));
					
			 		if ( false === as_has_scheduled_action( 'PNFPB_cron_post_hook' ) ) {
						as_schedule_recurring_action( $new_time, $timeseconds, 'PNFPB_cron_post_hook', array(), 'pnfpb_post', true );    				
					}
					else 
					{

						as_unschedule_all_actions( 'PNFPB_cron_post_hook', array(), '' );
						as_schedule_recurring_action( $timeseconds, $timeseconds, 'PNFPB_cron_post_hook', array(), 'pnfpb_post', true );										
					}
				}
				else 
				{
 					if (as_has_scheduled_action( 'PNFPB_cron_post_hook' ) ) {
						as_unschedule_all_actions( 'PNFPB_cron_post_hook', array(), 'pnfpb_post' );
						delete_option('pnfpb_ic_fcm_new_post_id');
						delete_option('pnfpb_ic_fcm_new_post_title');
						delete_option('pnfpb_ic_fcm_new_post_content');
						delete_option('pnfpb_ic_fcm_new_post_link');
						delete_option('pnfpb_ic_fcm_new_post_type');
						delete_option('pnfpb_ic_fcm_new_post_author');					
					}
				}

				if (get_option('pnfpb_ic_fcm_buddypressactivities_schedule_enable') && get_option('pnfpb_ic_fcm_buddypressactivities_schedule_enable') == 1 && get_option('pnfpb_ic_fcm_buddypressactivities_schedule_background_enable') && get_option('pnfpb_ic_fcm_buddypressactivities_schedule_background_enable') == 1 && 
(get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_enable') == 'weekly' || get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_enable') == 'twicedaily' || get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_enable') == 'daily' || get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_enable') == 'hourly' ||					
					(get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_enable') == 'seconds' && get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds') > 59))) {
					
					$timeseconds = 3600;
					if (get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_enable') == 'weekly') {
						$timeseconds = 604800;
					}
					if (get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_enable') == 'twicedaily') {
						$timeseconds = 43200;
					}
					if (get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_enable') == 'daily') {
						$timeseconds = 86400;
					}
					if (get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_enable') == 'hourly') {
						$timeseconds = 3600;
					}
					if (get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_enable') == 'seconds') {
						$timeseconds = get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds');
					}
					
					$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+'.$timeseconds.' seconds', strtotime("now"))));
			
			 		if ( false === as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ) ) {
						as_schedule_recurring_action( $new_time, $timeseconds, 'PNFPB_cron_buddypressactivities_hook', array(), 'pnfpb_buddypressactivities', true );
					}
					else 
					{

						as_unschedule_all_actions( 'PNFPB_cron_buddypressactivities_hook', array(), '' );
						delete_option('pnfpb_ic_fcm_new_buddypressactivities_content');
						delete_option('pnfpb_ic_fcm_new_buddypressactivities_userid');
						delete_option('pnfpb_ic_fcm_new_buddypressactivities_link');
						delete_option('pnfpb_ic_fcm_new_buddypressactivities_image');				
						delete_option('pnfpb_ic_fcm_new_buddypressgroup_link');
						delete_option('pnfpb_ic_fcm_new_buddypressgroup_id');
						delete_option('pnfpb_ic_fcm_new_buddypressgroup_userid');						
						as_schedule_recurring_action( $timeseconds, $timeseconds, 'PNFPB_cron_buddypressactivities_hook', array(), 'pnfpb_buddypressactivities', true );										
					}
				}
				else 
				{
 					if (as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ) ) {
						as_unschedule_all_actions( 'PNFPB_cron_buddypressactivities_hook', array(), 'pnfpb_buddypressactivities' );
						delete_option('pnfpb_ic_fcm_new_buddypressactivities_content');
						delete_option('pnfpb_ic_fcm_new_buddypressactivities_userid');
						delete_option('pnfpb_ic_fcm_new_buddypressactivities_link');
						delete_option('pnfpb_ic_fcm_new_buddypressactivities_image');				
						delete_option('pnfpb_ic_fcm_new_buddypressgroup_link');
						delete_option('pnfpb_ic_fcm_new_buddypressgroup_id');
						delete_option('pnfpb_ic_fcm_new_buddypressgroup_userid');						
					}
				}				

				if (get_option('pnfpb_ic_fcm_buddypresscomments_schedule_enable') && get_option('pnfpb_ic_fcm_buddypresscomments_schedule_enable') == 1 && get_option('pnfpb_ic_fcm_buddypresscomments_schedule_background_enable') && get_option('pnfpb_ic_fcm_buddypresscomments_schedule_background_enable') == 1 && 
(get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable') == 'weekly' || get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable') == 'twicedaily' || get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable') == 'daily' || get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable') == 'hourly' ||					
					(get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable') == 'seconds' && get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds') > 59))) {
					
					$timeseconds = 3600;
					if (get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable') == 'weekly') {
						$timeseconds = 604800;
					}
					if (get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable') == 'twicedaily') {
						$timeseconds = 43200;
					}
					if (get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable') == 'daily') {
						$timeseconds = 86400;
					}
					if (get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable') == 'hourly') {
						$timeseconds = 3600;
					}
					if (get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable') == 'seconds') {
						$timeseconds = get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds');
					}
					
					$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+'.$timeseconds.' seconds', strtotime("now"))));
			
			 		if ( false === as_has_scheduled_action( 'PNFPB_cron_comments_post_hook' ) ) {
						as_schedule_recurring_action( $new_time, $timeseconds, 'PNFPB_cron_comments_post_hook', array(), 'pnfpb_postcomments', true );    				
					}
					else 
					{

						as_unschedule_all_actions( 'PNFPB_cron_comments_post_hook', array(), '' );
						as_schedule_recurring_action( $new_time, $timeseconds, 'PNFPB_cron_comments_post_hook', array(), 'pnfpb_postcomments', true );										
					}
									
			 		if ( false === as_has_scheduled_action( 'PNFPB_cron_buddypresscomments_hook' ) ) {
						as_schedule_recurring_action( $new_time, $timeseconds, 'PNFPB_cron_buddypresscomments_hook', array(), 'pnfpb_buddypresscomments', true );    				
					}
					else 
					{

						as_unschedule_all_actions( 'PNFPB_cron_buddypresscomments_hook', array(), '' );
						as_schedule_recurring_action( $new_time, $timeseconds, 'PNFPB_cron_buddypresscomments_hook', array(), 'pnfpb_buddypresscomments', true );										
					}									
				}
				else 
				{
 					if (as_has_scheduled_action( 'PNFPB_cron_buddypresscomments_hook' ) ) {
						as_unschedule_all_actions( 'PNFPB_cron_buddypresscomments_hook', array(), 'pnfpb_buddypresscomments' );
						delete_option('pnfpb_ic_fcm_new_buddypresscomments_content');
						delete_option('pnfpb_ic_fcm_new_buddypresscomments_link');
						delete_option('pnfpb_ic_fcm_new_buddypresscomments_postuserid');
						delete_option('pnfpb_ic_fcm_new_buddypresscomments_activityuserid');
						delete_option('pnfpb_ic_fcm_new_buddypresscomments_authoractivityuserid');					
					}
					
 					if (as_has_scheduled_action( 'PNFPB_cron_comments_post_hook' ) ) {
						as_unschedule_all_actions( 'PNFPB_cron_comments_post_hook', array(), 'pnfpb_postcomments' );
						delete_option('pnfpb_ic_fcm_new_comment_id');
						delete_option('pnfpb_ic_fcm_new_comment_approved');
						delete_option('pnfpb_ic_fcm_new_comments_post_content');
						delete_option('pnfpb_ic_fcm_new_comments_post_link');
						delete_option('pnfpb_ic_fcm_new_comments_post_userid');	
						delete_option('pnfpb_ic_fcm_new_comments_post_authorid');						
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
			if ( wp_next_scheduled( 'PNFPB_cron_post_hook' ) ) {
				$timestamp = wp_next_scheduled( 'PNFPB_cron_post_hook' );
				wp_unschedule_event( $timestamp, 'PNFPB_cron_post_hook' );
				delete_option('pnfpb_ic_fcm_new_post_id');
				delete_option('pnfpb_ic_fcm_new_post_title');
				delete_option('pnfpb_ic_fcm_new_post_content');
				delete_option('pnfpb_ic_fcm_new_post_link');
				delete_option('pnfpb_ic_fcm_new_post_type');
				delete_option('pnfpb_ic_fcm_new_post_author');				
			}

			if ( wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' ) ) {
				$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' );
				wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressactivities_hook' );
				delete_option('pnfpb_ic_fcm_new_buddypressactivities_content');
				delete_option('pnfpb_ic_fcm_new_buddypressactivities_userid');
				delete_option('pnfpb_ic_fcm_new_buddypressactivities_link');
				delete_option('pnfpb_ic_fcm_new_buddypressactivities_image');
			}
			
			if ( wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
				$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' );
				wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressgroupactivities_hook' );
				delete_option('pnfpb_ic_fcm_new_buddypressactivities_content');
				delete_option('pnfpb_ic_fcm_new_buddypressactivities_userid');
				delete_option('pnfpb_ic_fcm_new_buddypressactivities_link');
				delete_option('pnfpb_ic_fcm_new_buddypressactivities_image');				
				delete_option('pnfpb_ic_fcm_new_buddypressgroup_link');
				delete_option('pnfpb_ic_fcm_new_buddypressgroup_id');
				delete_option('pnfpb_ic_fcm_new_buddypressgroup_userid');				
			}			

			if ( wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' ) ) {
				$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' );
				wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypresscomments_hook' );
				delete_option('pnfpb_ic_fcm_new_buddypresscomments_content');
				delete_option('pnfpb_ic_fcm_new_buddypresscomments_link');
				delete_option('pnfpb_ic_fcm_new_buddypresscomments_postuserid');
				delete_option('pnfpb_ic_fcm_new_buddypresscomments_activityuserid');
				delete_option('pnfpb_ic_fcm_new_buddypresscomments_authoractivityuserid');				
			}
			
			if ( wp_next_scheduled( 'PNFPB_cron_comments_post_hook' ) ) {
				$timestamp = wp_next_scheduled( 'PNFPB_cron_comments_post_hook' );
				wp_unschedule_event( $timestamp, 'PNFPB_cron_comments_post_hook' );
				delete_option('pnfpb_ic_fcm_new_comment_id');
				delete_option('pnfpb_ic_fcm_new_comment_approved');
				delete_option('pnfpb_ic_fcm_new_comments_post_content');
				delete_option('pnfpb_ic_fcm_new_comments_post_link');
				delete_option('pnfpb_ic_fcm_new_comments_post_userid');	
				delete_option('pnfpb_ic_fcm_new_comments_post_authorid');					
			}
			

			
			if ( wp_next_scheduled( 'PNFPB_cron_token_delete_user_not_exist_hook' ) ) {
				$timestamp = wp_next_scheduled( 'PNFPB_cron_token_delete_user_not_exist_hook' );
				wp_unschedule_event( $timestamp, 'PNFPB_cron_token_delete_user_not_exist_hook' );					
			}
			
 			if (as_has_scheduled_action( 'PNFPB_cron_post_hook' ) ) {
				as_unschedule_all_actions( 'PNFPB_cron_post_hook', array(), 'pnfpb_post' );
				delete_option('pnfpb_ic_fcm_new_post_id');
				delete_option('pnfpb_ic_fcm_new_post_title');
				delete_option('pnfpb_ic_fcm_new_post_content');
				delete_option('pnfpb_ic_fcm_new_post_link');
				delete_option('pnfpb_ic_fcm_new_post_type');
				delete_option('pnfpb_ic_fcm_new_post_author');				
			}
					
 			if (as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ) ) {
				as_unschedule_all_actions( 'PNFPB_cron_buddypressactivities_hook', array(), 'pnfpb_buddypressactivities' );
				delete_option('pnfpb_ic_fcm_new_buddypressactivities_content');
				delete_option('pnfpb_ic_fcm_new_buddypressactivities_userid');
				delete_option('pnfpb_ic_fcm_new_buddypressactivities_link');
				delete_option('pnfpb_ic_fcm_new_buddypressactivities_image');				
				delete_option('pnfpb_ic_fcm_new_buddypressgroup_link');
				delete_option('pnfpb_ic_fcm_new_buddypressgroup_id');
				delete_option('pnfpb_ic_fcm_new_buddypressgroup_userid');				
			}

 			if (as_has_scheduled_action( 'PNFPB_cron_comments_post_hook' ) ) {
				as_unschedule_all_actions( 'PNFPB_cron_comments_post_hook', array(), 'pnfpb_buddypresscomments' );
				delete_option('pnfpb_ic_fcm_new_comment_id');
				delete_option('pnfpb_ic_fcm_new_comment_approved');
				delete_option('pnfpb_ic_fcm_new_comments_post_content');
				delete_option('pnfpb_ic_fcm_new_comments_post_link');
				delete_option('pnfpb_ic_fcm_new_comments_post_userid');	
				delete_option('pnfpb_ic_fcm_new_comments_post_authorid');					
			}			
			
		}


		/**
		* Add a link to the settings on the Plugins screen.
		*
		* @since 1.0.0
		*/
		public function PNFPB_add_settings_link( $links, $file ) {
	    

			if ( $file === 'push-notification-for-post-and-buddypress/pnfpb_push_notification.php' && current_user_can( 'manage_options' ) ) {
				if ( current_filter() === 'plugin_action_links' ) {
					$url = admin_url( 'admin.php?page=pnfpb-icfcm-slug' );
				} else {
					$url = admin_url( '/network/settings.php?page=pnfpb-icfcm-slug' );
				}

				// Prevent warnings in PHP 7.0+ when a plugin uses this filter incorrectly.
				$links = (array) $links;
				$links[] = sprintf( '<a href="%s">%s</a>', $url, __( 'Settings', 'PNFPB_TD' ) );
			}

			return $links;
		}
		
		/**
		* Enqueue and localize scripts needed for push notification using FCM
		*
		* @since 1.0.0
		*/
		public function PNFPB_ic_admin_push_notification_scripts() {
			
			wp_enqueue_script("jquery");
			wp_enqueue_script( 'jquery-ui-dialog' ); 
			wp_enqueue_style( 'wp-jquery-ui-dialog' );
	
			wp_enqueue_style( 'pnfpb-admin-icpstyle-name', plugin_dir_url( __FILE__ ).'admin/css/pnfpb_admin.css',array(),'1.79.1' );
			wp_enqueue_style( 'pnfpb-admin-pwa-icpstyle-name', plugin_dir_url( __FILE__ ).'admin/css/pnfpb_pwa_admin.css',array(),'1.79.1' );
			
			if (get_option("pnfpb_onesignal_push") !== '1') {
			
			$apiKey = get_option( 'pnfpb_ic_fcm_api' );
			$authDomain = get_option( 'pnfpb_ic_fcm_authdomain' );
			$databaseURL =get_option( 'pnfpb_ic_fcm_databaseurl' );
			$projectId = get_option( 'pnfpb_ic_fcm_projectid' );
			$storageBucket = get_option( 'pnfpb_ic_fcm_storagebucket' );
			$messagingSenderId = get_option( 'pnfpb_ic_fcm_messagingsenderid' );
			$appId = get_option( 'pnfpb_ic_fcm_appid' );
			$publicKey = get_option( 'pnfpb_ic_fcm_publickey' );
			$homeurl = get_home_url();
			$pwaappenable = get_option("pnfpb_ic_pwa_app_enable");
			$pwainstallbuttontext = get_option("pnfpb_ic_pwa_prompt_install_button_text");
			if ($pwainstallbuttontext === '') {
				$pwainstallbuttontext = __( 'Install PWA app', 'PNFPB_TD' );
			}
			$pwainstallheadertext = get_option("pnfpb_ic_pwa_prompt_header_text");
			if ($pwainstallheadertext === '') {
				$pwainstallheadertext = __( 'Install our PWA app', 'PNFPB_TD' );
			}			
			$pwainstalltext = get_option("pnfpb_ic_pwa_prompt_description");
			if ($pwainstalltext === '') {
				$pwainstalltext =  __( 'Install PWA', 'PNFPB_TD' );
			}			
			$pwainstallbuttoncolor = get_option("pnfpb_ic_pwa_prompt_install_button_color");
			if ($pwainstallbuttoncolor === '') {
				$pwainstallbuttoncolor = '#3700ff';
			}			
			$pwainstallbuttontextcolor = get_option("pnfpb_ic_pwa_prompt_install_text_color");
			if ($pwainstallbuttontextcolor === '') {
				$pwainstallbuttontextcolor = '#ffffff';
			}
			
			$pwainstallpromptenabled = get_option('pnfpb_ic_pwa_app_custom_prompt_enable');
				
			$pwadesktopinstallpromptenabled = get_option('pnfpb_ic_pwa_app_desktop_custom_prompt_enable');
				
			$pwamobileinstallpromptenabled = get_option('pnfpb_ic_pwa_app_mobile_custom_prompt_enable');
				
			$pwapixelsinstallpromptenabled = get_option('pnfpb_ic_pwa_app_pixels_custom_prompt_enable');
				
			$pwapixelsinputinstallpromptenabled = 0;
				
			if (get_option('pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable')) {
				$pwapixelsinputinstallpromptenabled = intval(get_option('pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable'));
			}
			
			$pwacustominstalltype = get_option('pnfpb_ic_pwa_app_custom_prompt_type');
			
			$nonce = wp_create_nonce( 'icpushadmincallback' );
			$filename = '/admin/js/pnfpb_ic_admin_upload_service_account.js';
			$ajaxobject = 'pnfpb_ajax_admin_service_account_push_object';
			wp_enqueue_script( 'pnfpb_ajax_admin_service_account_push', plugins_url( $filename, __FILE__ ), array( 'jquery' ),'1.64.1',true);
			wp_localize_script( 'pnfpb_ajax_admin_service_account_push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ),'pnfpb_nonce' => $nonce) );			

			if ($projectId != false && $projectId != '' && $publicKey != false && $publicKey != '' && $apiKey != false && $apiKey != '' && $messagingSenderId != false && $messagingSenderId != '' && get_option( 'pnfpb_ic_disable_serviceworker_pwa_pushnotification' ) != '1')  {
			    
				
				$unsubscribe_dialog_text_confirm = __( 'Your device is unsubscribed from notification', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_unsubscribe_dialog_text_confirm') && get_option('pnfpb_ic_fcm_unsubscribe_dialog_text_confirm') !== false && get_option('pnfpb_ic_fcm_unsubscribe_dialog_text_confirm') !== '') {
						$unsubscribe_dialog_text_confirm = get_option('pnfpb_ic_fcm_unsubscribe_dialog_text_confirm');
					}
				
					$subscribe_dialog_text_confirm = __( 'Subscription updated', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_subscribe_dialog_text_confirm') && get_option('pnfpb_ic_fcm_subscribe_dialog_text_confirm') !== false && get_option('pnfpb_ic_fcm_subscribe_dialog_text_confirm') !== '') {
						$subscribe_dialog_text_confirm = get_option('pnfpb_ic_fcm_subscribe_dialog_text_confirm');
					}
				
					$unsubscribe_button_text_shortcode = __( 'Unsubscribe push notifications', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text') && get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text') !== false && get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text') !== '') {
						$unsubscribe_button_text_shortcode = get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text');
					}
				
					$subscribe_button_text_shortcode = __( 'Subscribe push notifications', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text') && get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text') !== false && get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text') !== '') {
						$subscribe_button_text_shortcode = get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text');
					}				
				
				
					$save_button_text = __( 'Save', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_subscribe_save_button_text_shortcode') && get_option('pnfpb_ic_fcm_subscribe_save_button_text_shortcode') !== false && get_option('pnfpb_ic_fcm_subscribe_save_button_text_shortcode') !== '') {
						$save_button_text = get_option('pnfpb_ic_fcm_subscribe_save_button_text_shortcode');
					}
				
					$cancel_button_text = __( 'Cancel', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode') && get_option('pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode') !== false && get_option('pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode') !== '') {
						$cancel_button_text = get_option('pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode');
					}
				
					$subscribe_button_text = __( 'Subscribe push notification', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_subscribe_button_text') && get_option('pnfpb_ic_fcm_subscribe_button_text') !== false && get_option('pnfpb_ic_fcm_subscribe_button_text') !== '') {
						$subscribe_button_text = get_option('pnfpb_ic_fcm_subscribe_button_text');
					}
				
					$unsubscribe_button_text = __( 'Unsubscribe push notification', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_unsubscribe_button_text') && get_option('pnfpb_ic_fcm_unsubscribe_button_text') !== false && get_option('pnfpb_ic_fcm_unsubscribe_button_text') !== '') {
						$unsubscribe_button_text = get_option('pnfpb_ic_fcm_unsubscribe_button_text');
					}				

					$subscribe_button_text_color = '#ffffff';
				
					if ((get_option('pnfpb_ic_fcm_subscribe_button_text_color')) && (get_option('pnfpb_ic_fcm_subscribe_button_text_color') !== false) && (get_option('pnfpb_ic_fcm_subscribe_button_text_color') !== '')) {
						$subscribe_button_text_color = get_option('pnfpb_ic_fcm_subscribe_button_text_color');
					}
				
					$subscribe_button_color = '#000000';
				
					if ((get_option('pnfpb_ic_fcm_subscribe_button_color')) && (get_option('pnfpb_ic_fcm_subscribe_button_color') !== false) && (get_option('pnfpb_ic_fcm_subscribe_button_color') !== '')) {
						$subscribe_button_color = get_option('pnfpb_ic_fcm_subscribe_button_color');
					}
				$pnfpb_push_prompt = get_option('pnfpb_ic_fcm_push_prompt_enable');
			
				$group_unsubscribe_dialog_text_confirm = __( 'Your device is unsubscribed from notification', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm') && get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm') !== false && get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm') !== '') {
						$group_unsubscribe_dialog_text_confirm = get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm');
					}
				
					$group_subscribe_dialog_text_confirm = __( 'Your device is subscribed from notification', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_group_subscribe_dialog_text_confirm') && get_option('pnfpb_ic_fcm_group_subscribe_dialog_text_confirm') !== false && get_option('pnfpb_ic_fcm_group_subscribe_dialog_text_confirm') !== '') {
						$group_subscribe_dialog_text_confirm = get_option('pnfpb_ic_fcm_group_subscribe_dialog_text_confirm');
					}			
				
					$group_unsubscribe_dialog_text = __( 'Would you like to remove push notifications?', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text') && get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text') !== false && get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text') !== '') {
						$group_unsubscribe_dialog_text = get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text');
					}
				
					$group_subscribe_dialog_text = __( 'Would you like to subscribe to push notifications?', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_group_subscribe_dialog_text') && get_option('pnfpb_ic_fcm_group_subscribe_dialog_text') !== false && get_option('pnfpb_ic_fcm_group_subscribe_dialog_text') !== '') {
						$group_subscribe_dialog_text = get_option('pnfpb_ic_fcm_group_subscribe_dialog_text');
					}			
				
					$shortcode_close_button_text = __( 'Close', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_shortcode_close_button_text') && get_option('pnfpb_ic_fcm_shortcode_close_button_text') !== false && get_option('pnfpb_ic_fcm_shortcode_close_button_text') !== '') {
						$shortcode_close_button_text = get_option('pnfpb_ic_fcm_shortcode_close_button_text');
					}
				
					$pnfpb_ic_fcm_loggedin_notify = '0';
				
					if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') !== '') {
					
						$pnfpb_ic_fcm_loggedin_notify = get_option('pnfpb_ic_fcm_loggedin_notify');
					
					}				

				$filename = '/build/pnfpb_push_notification/index.js';
				$ajaxobject = 'pnfpb_ajax_object_push';
				wp_enqueue_script( 'pnfpb-icajax-script-push', plugins_url( $filename, __FILE__ ),array(),'1.81.1',true);
				wp_localize_script( 'pnfpb-icajax-script-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'groupId' => '9','group_unsubscribe_dialog_text_confirm' => $group_unsubscribe_dialog_text_confirm, 'group_subscribe_dialog_text_confirm' => $group_subscribe_dialog_text_confirm, 'group_unsubscribe_dialog_text' => $group_unsubscribe_dialog_text, 'group_subscribe_dialog_text' => $group_subscribe_dialog_text, 'homeurl' => $homeurl, 'pwaapponlyenable' => '0', 'pwainstallheadertext' => $pwainstallheadertext , 'pwainstalltext' => $pwainstalltext, 'pwainstallbuttoncolor' => $pwainstallbuttoncolor, 'pwainstallbuttontextcolor' => $pwainstallbuttontextcolor, 'pwainstallbuttontext' => $pwainstallbuttontext, 'pwainstallpromptenabled' => $pwainstallpromptenabled,  'pwacustominstalltype' => $pwacustominstalltype,'unsubscribe_dialog_text_confirm' => $unsubscribe_dialog_text_confirm, 'subscribe_dialog_text_confirm' => $subscribe_dialog_text_confirm,'unsubscribe_button_text_shortcode' => $unsubscribe_button_text_shortcode, 'subscribe_button_text_shortcode' => $subscribe_button_text_shortcode, 'subscribe_button_text_color' => $subscribe_button_text_color, 'subscribe_button_color' => $subscribe_button_color, 'cancel_button_text' => $cancel_button_text, 'save_button_text' => $save_button_text, 'unsubscribe_button_text' => $unsubscribe_button_text, 'subscribe_button_text' => $subscribe_button_text,'isloggedin' => is_user_logged_in(), 'pnfpb_push_prompt' => $pnfpb_push_prompt, 'userid' => get_current_user_id(), 'pnfpb_ic_fcm_popup_subscribe_message' => get_option('pnfpb_ic_fcm_popup_subscribe_message'), 'pnfpb_ic_fcm_popup_unsubscribe_message' => get_option('pnfpb_ic_fcm_popup_unsubscribe_message'), 'pnfpb_ic_fcm_popup_wait_message' => get_option('pnfpb_ic_fcm_popup_wait_message'),'pnfpb_ic_fcm_custom_prompt_popup_wait_message' => get_option('pnfpb_ic_fcm_custom_prompt_popup_wait_message'),  'pnfpb_ic_fcm_popup_subscribe_button' => get_option('pnfpb_ic_fcm_popup_subscribe_button'),'pnfpb_ic_fcm_popup_unsubscribe_button' => get_option('pnfpb_ic_fcm_popup_unsubscribe_button'),'pwadesktopinstallpromptenabled' => $pwadesktopinstallpromptenabled,'pwamobileinstallpromptenabled' => $pwamobileinstallpromptenabled,'pwapixelsinstallpromptenabled' => $pwapixelsinstallpromptenabled,'pwapixelsinputinstallpromptenabled' => $pwapixelsinputinstallpromptenabled,'shortcode_close_button_text' => $shortcode_close_button_text,'notify_loggedin' => $pnfpb_ic_fcm_loggedin_notify) );
				

			}
			else 
			{
				if ($pwaappenable === "1" && get_option( 'pnfpb_ic_disable_serviceworker_pwa_pushnotification' ) != '1') {
					$pnfpb_push_prompt = get_option('pnfpb_ic_fcm_push_prompt_enable');
					$filename = '/build/pnfpb_push_notification/index.js';
					$ajaxobject = 'pnfpb_ajax_object_push';
					wp_enqueue_script( 'pnfpb-icajax-script-push', plugins_url( $filename, __FILE__ ), array( 'jquery' ),'1.81.1',true);
					wp_localize_script( 'pnfpb-icajax-script-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'homeurl' => $homeurl, 'pwaapponlyenable' => $pwaappenable, 'pwainstallheadertext' => $pwainstallheadertext , 'pwainstalltext' => $pwainstalltext, 'pwainstallbuttoncolor' => $pwainstallbuttoncolor, 'pwainstallbuttontextcolor' => $pwainstallbuttontextcolor, 'pwainstallbuttontext' => $pwainstallbuttontext, 'pwacustominstalltype' => $pwacustominstalltype,  'pwainstallpromptenabled' => $pwainstallpromptenabled, 'pnfpb_push_prompt'=> $pnfpb_push_prompt,'pwadesktopinstallpromptenabled' => $pwadesktopinstallpromptenabled,'pwamobileinstallpromptenabled' => $pwamobileinstallpromptenabled,'pwapixelsinstallpromptenabled' => $pwapixelsinstallpromptenabled,'pwapixelsinputinstallpromptenabled' => $pwapixelsinputinstallpromptenabled) );					
				}
			}
			}  else {
				
				wp_enqueue_script('pwebtonative_app', 'https://unpkg.com/webtonative@1.0.44/webtonative.min.js', array(), '1.0.44', true);
				
			}
			
			
		}
		
		/**
		* Enqueue language translation scripts
		*
		* @since 1.57.0
		*/		
		public function PNFPB_load_text_domain() {
    		$scripttranslate = wp_set_script_translations( 
         		'pnfpb-icajax-script-push',
         		'PNFPB_TD',
         		plugin_dir_path( __FILE__ ) . 'languages' 
    		);
			
    		$scripttranslate = wp_set_script_translations( 
         		'pnfpb-icajax-script-unsubscribe-push',
         		'PNFPB_TD',
         		plugin_dir_path( __FILE__ ) . 'languages' 
    		);

    		$scripttranslate = wp_set_script_translations( 
         		'pnfpb-icajax-script-group-push',
         		'PNFPB_TD',
         		plugin_dir_path( __FILE__ ) . 'languages' 
    		);			
			
			load_plugin_textdomain('PNFPB_TD', false, dirname(plugin_basename(__FILE__)) . '/languages/');

		}		
		

		/**
		* Enqueue and localize scripts needed for push notification using FCM
		*
		* @since 1.0.0
		*/
		public function PNFPB_ic_push_notification_scripts() {
			
			wp_enqueue_script( 'jquery-ui-dialog' ); 
			wp_enqueue_style( 'wp-jquery-ui-dialog' );
			
			wp_enqueue_style( 'pnfpb-icpstyle-es6-name', plugin_dir_url( __FILE__ ).'build/pnfpb_push_notification/index.css',array(),'1.81.1' );
			
			
			if (get_option("pnfpb_onesignal_push") !== '1') {

	
            wp_enqueue_style( 'pnfpb-icpstyle-name', plugin_dir_url( __FILE__ ).'src/pnfpb_push_notification/css/pnfpb_main.css',array(),'1.81.1' );
				
			$filename = '/public/js/pnfpb_pushscript_pwa.js';
			wp_enqueue_script( 'pnfpb-mobile-app-interface-script', plugins_url( $filename, __FILE__ ),array('jquery','wp-i18n'),'1.81.1',true);
				
			$ajaxobject = 'pnfpb_ajax_object_mobile_app_interface_script';
			wp_localize_script( 'pnfpb-mobile-app-interface-script', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'userid' => get_current_user_id()) );
				
            
			$apiKey = get_option( 'pnfpb_ic_fcm_api' );
			$authDomain = get_option( 'pnfpb_ic_fcm_authdomain' );
			$databaseURL =get_option( 'pnfpb_ic_fcm_databaseurl' );
			$projectId = get_option( 'pnfpb_ic_fcm_projectid' );
			$storageBucket = get_option( 'pnfpb_ic_fcm_storagebucket' );
			$messagingSenderId = get_option( 'pnfpb_ic_fcm_messagingsenderid' );
			$appId = get_option( 'pnfpb_ic_fcm_appid' );
			$publicKey = get_option( 'pnfpb_ic_fcm_publickey' );
			$homeurl = get_home_url();
			$pwaappenable = get_option("pnfpb_ic_pwa_app_enable");
			$pwainstallbuttontext = get_option("pnfpb_ic_pwa_prompt_install_button_text");
			if ($pwainstallbuttontext === '') {
				$pwainstallbuttontext = __( 'Install PWA app', 'PNFPB_TD' );
			}
			$pwainstallheadertext = get_option("pnfpb_ic_pwa_prompt_header_text");
			if ($pwainstallheadertext === '') {
				$pwainstallheadertext = __( 'Install our PWA app with offline functionality', 'PNFPB_TD' );
			}			
			$pwainstalltext = get_option("pnfpb_ic_pwa_prompt_description");
			if ($pwainstalltext === '') {
				$pwainstalltext = __( 'Install PWA', 'PNFPB_TD' );
			}			
			$pwainstallbuttoncolor = get_option("pnfpb_ic_pwa_prompt_install_button_color");
			if ($pwainstallbuttoncolor === '') {
				$pwainstallbuttoncolor = '#3700ff';
			}			
			$pwainstallbuttontextcolor = get_option("pnfpb_ic_pwa_prompt_install_text_color");
			if ($pwainstallbuttontextcolor === '') {
				$pwainstallbuttontextcolor = '#ffffff';
			}
			
			$pwainstallpromptenabled = get_option('pnfpb_ic_pwa_app_custom_prompt_enable');
				
			$pwadesktopinstallpromptenabled = get_option('pnfpb_ic_pwa_app_desktop_custom_prompt_enable');
				
			$pwamobileinstallpromptenabled = get_option('pnfpb_ic_pwa_app_mobile_custom_prompt_enable');
				
			$pwapixelsinstallpromptenabled = get_option('pnfpb_ic_pwa_app_pixels_custom_prompt_enable');
				
			$pwapixelsinputinstallpromptenabled = 0;
			if (get_option('pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable')) {
				$pwapixelsinputinstallpromptenabled = intval(get_option('pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable'));
			}
			
			$pwacustominstalltype = get_option('pnfpb_ic_pwa_app_custom_prompt_type');

			if ($projectId != false && $projectId != '' && $publicKey != false && $publicKey != '' && $apiKey != false && $apiKey != '' && $messagingSenderId != false && $messagingSenderId != '' && get_option( 'pnfpb_ic_disable_serviceworker_pwa_pushnotification' ) != '1')  {
			    
				
				$unsubscribe_dialog_text_confirm = 'Your device is unsubscribed from notification';
				
					if (get_option('pnfpb_ic_fcm_unsubscribe_dialog_text_confirm') && get_option('pnfpb_ic_fcm_unsubscribe_dialog_text_confirm') !== false && get_option('pnfpb_ic_fcm_unsubscribe_dialog_text_confirm') !== '') {
						$unsubscribe_dialog_text_confirm = get_option('pnfpb_ic_fcm_unsubscribe_dialog_text_confirm');
					}
				
					$subscribe_dialog_text_confirm = __( 'Subscription updated', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_subscribe_dialog_text_confirm') && get_option('pnfpb_ic_fcm_subscribe_dialog_text_confirm') !== false && get_option('pnfpb_ic_fcm_subscribe_dialog_text_confirm') !== '') {
						$subscribe_dialog_text_confirm = get_option('pnfpb_ic_fcm_subscribe_dialog_text_confirm');
					}
				
					$unsubscribe_button_text_shortcode = __( 'Unsubscribe push notifications', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text') && get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text') !== false && get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text') !== '') {
						$unsubscribe_button_text_shortcode = get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text');
					}
				
					$subscribe_button_text_shortcode = __( 'Subscribe push notifications', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text') && get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text') !== false && get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text') !== '') {
						$subscribe_button_text_shortcode = get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text');
					}				
				
				
					$save_button_text = __( 'Save', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_subscribe_save_button_text_shortcode') && get_option('pnfpb_ic_fcm_subscribe_save_button_text_shortcode') !== false && get_option('pnfpb_ic_fcm_subscribe_save_button_text_shortcode') !== '') {
						$save_button_text = get_option('pnfpb_ic_fcm_subscribe_save_button_text_shortcode');
					}
				
					$cancel_button_text = __( 'Cancel', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode') && get_option('pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode') !== false && get_option('pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode') !== '') {
						$cancel_button_text = get_option('pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode');
					}
				
					$subscribe_button_text = __( 'Subscribe push notification', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_subscribe_button_text') && get_option('pnfpb_ic_fcm_subscribe_button_text') !== false && get_option('pnfpb_ic_fcm_subscribe_button_text') !== '') {
						$subscribe_button_text = get_option('pnfpb_ic_fcm_subscribe_button_text');
					}
				
					$unsubscribe_button_text = __( 'Unsubscribe push notification', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_unsubscribe_button_text') && get_option('pnfpb_ic_fcm_unsubscribe_button_text') !== false && get_option('pnfpb_ic_fcm_unsubscribe_button_text') !== '') {
						$unsubscribe_button_text = get_option('pnfpb_ic_fcm_unsubscribe_button_text');
					}				

					$subscribe_button_text_color = '#ffffff';
				
					if ((get_option('pnfpb_ic_fcm_subscribe_button_text_color')) && (get_option('pnfpb_ic_fcm_subscribe_button_text_color') !== false) && (get_option('pnfpb_ic_fcm_subscribe_button_text_color') !== '')) {
						$subscribe_button_text_color = get_option('pnfpb_ic_fcm_subscribe_button_text_color');
					}
				
					$subscribe_button_color = '#000000';
				
					if ((get_option('pnfpb_ic_fcm_subscribe_button_color')) && (get_option('pnfpb_ic_fcm_subscribe_button_color') !== false) && (get_option('pnfpb_ic_fcm_subscribe_button_color') !== '')) {
						$subscribe_button_color = get_option('pnfpb_ic_fcm_subscribe_button_color');
					}
				
				$pnfpb_push_prompt = get_option('pnfpb_ic_fcm_push_prompt_enable');
					
		
				$group_unsubscribe_dialog_text_confirm = __( 'Your device is unsubscribed from notification', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm') && get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm') !== false && get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm') !== '') {
						$group_unsubscribe_dialog_text_confirm = get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm');
					}
				
					$group_subscribe_dialog_text_confirm = __( 'Your device is subscribed from notification', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_group_subscribe_dialog_text_confirm') && get_option('pnfpb_ic_fcm_group_subscribe_dialog_text_confirm') !== false && get_option('pnfpb_ic_fcm_group_subscribe_dialog_text_confirm') !== '') {
						$group_subscribe_dialog_text_confirm = get_option('pnfpb_ic_fcm_group_subscribe_dialog_text_confirm');
					}			
				
					$group_unsubscribe_dialog_text = __( 'Would you like to remove push notifications?', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text') && get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text') !== false && get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text') !== '') {
						$group_unsubscribe_dialog_text = get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text');
					}
				
					$group_subscribe_dialog_text = __( 'Would you like to subscribe to push notifications?', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_group_subscribe_dialog_text') && get_option('pnfpb_ic_fcm_group_subscribe_dialog_text') !== false && get_option('pnfpb_ic_fcm_group_subscribe_dialog_text') !== '') {
						$group_subscribe_dialog_text = get_option('pnfpb_ic_fcm_group_subscribe_dialog_text');
					}
					
					$shortcode_close_button_text = __( 'Close', 'PNFPB_TD' );
				
					if (get_option('pnfpb_ic_fcm_shortcode_close_button_text') && get_option('pnfpb_ic_fcm_shortcode_close_button_text') !== false && get_option('pnfpb_ic_fcm_shortcode_close_button_text') !== '') {
						$shortcode_close_button_text = get_option('pnfpb_ic_fcm_shortcode_close_button_text');
					}
				
				$pnfpb_ic_fcm_prompt_style = '';
				
				if (get_option('pnfpb_ic_fcm_prompt_style') && get_option('pnfpb_ic_fcm_prompt_style') !== false && get_option('pnfpb_ic_fcm_prompt_style') !== '') {
					
					$pnfpb_ic_fcm_prompt_style = get_option('pnfpb_ic_fcm_prompt_style');
					
				}
				
				$pnfpb_ic_fcm_prompt_on_off = '';
				
				if (get_option('pnfpb_ic_fcm_prompt_on_off') && get_option('pnfpb_ic_fcm_prompt_on_off') !== false && get_option('pnfpb_ic_fcm_prompt_on_off') !== '') {
					
					$pnfpb_ic_fcm_prompt_on_off = get_option('pnfpb_ic_fcm_prompt_on_off');
					
				}
				
				$pnfpb_ic_fcm_prompt_style3 = '';
				
				if (get_option('pnfpb_ic_fcm_prompt_style3') && get_option('pnfpb_ic_fcm_prompt_style3') !== false && get_option('pnfpb_ic_fcm_prompt_style3') !== '') {
					
					$pnfpb_ic_fcm_prompt_style3 = get_option('pnfpb_ic_fcm_prompt_style3');
					
				}
				
				$pnfpb_ic_fcm_custom_prompt_animation = '';
				
				if (get_option('pnfpb_ic_fcm_custom_prompt_animation') && get_option('pnfpb_ic_fcm_custom_prompt_animation') !== false && get_option('pnfpb_ic_fcm_custom_prompt_animation') !== '') {
					
					$pnfpb_ic_fcm_custom_prompt_animation = get_option('pnfpb_ic_fcm_custom_prompt_animation');
					
				}
				
				
				$pnfpb_ic_fcm_loggedin_notify = '0';
				
				if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') !== '') {
					
					$pnfpb_ic_fcm_loggedin_notify = get_option('pnfpb_ic_fcm_loggedin_notify');
					
				}
				
				$pnfpb_ic_fcm_custom_prompt_show_again_days = '7';
				
				if (get_option( 'pnfpb_ic_fcm_custom_prompt_show_again_days' ) && get_option( 'pnfpb_ic_fcm_custom_prompt_show_again_days' ) != '') {
					
					$pnfpb_ic_fcm_custom_prompt_show_again_days = get_option( 'pnfpb_ic_fcm_custom_prompt_show_again_days' );
					
				}
				
				$pnfpb_ic_fcm_pwa_show_again_days = '7';
				
				if (get_option( 'pnfpb_ic_fcm_pwa_show_again_days' ) && get_option( 'pnfpb_ic_fcm_pwa_show_again_days' ) != '') {
					
					$pnfpb_ic_fcm_pwa_show_again_days = get_option( 'pnfpb_ic_fcm_pwa_show_again_days' );
					
				}				
				

				$filename = '/build/pnfpb_push_notification/index.js';
				$ajaxobject = 'pnfpb_ajax_object_push';
				wp_enqueue_script( 'pnfpb-icajax-script-push', plugins_url( $filename, __FILE__ ),array(),'1.81.1',true);
				wp_localize_script( 'pnfpb-icajax-script-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'groupId' => '9','group_unsubscribe_dialog_text_confirm' => $group_unsubscribe_dialog_text_confirm, 'group_subscribe_dialog_text_confirm' => $group_subscribe_dialog_text_confirm, 'group_unsubscribe_dialog_text' => $group_unsubscribe_dialog_text, 'group_subscribe_dialog_text' => $group_subscribe_dialog_text, 'homeurl' => $homeurl, 'pwaapponlyenable' => '0', 'pwainstallheadertext' => $pwainstallheadertext , 'pwainstalltext' => $pwainstalltext, 'pwainstallbuttoncolor' => $pwainstallbuttoncolor, 'pwainstallbuttontextcolor' => $pwainstallbuttontextcolor, 'pwainstallbuttontext' => $pwainstallbuttontext, 'pwainstallpromptenabled' => $pwainstallpromptenabled,  'pwacustominstalltype' => $pwacustominstalltype,'unsubscribe_dialog_text_confirm' => $unsubscribe_dialog_text_confirm, 'subscribe_dialog_text_confirm' => $subscribe_dialog_text_confirm,'unsubscribe_button_text_shortcode' => $unsubscribe_button_text_shortcode, 'subscribe_button_text_shortcode' => $subscribe_button_text_shortcode, 'subscribe_button_text_color' => $subscribe_button_text_color, 'subscribe_button_color' => $subscribe_button_color, 'cancel_button_text' => $cancel_button_text, 'save_button_text' => $save_button_text, 'unsubscribe_button_text' => $unsubscribe_button_text, 'subscribe_button_text' => $subscribe_button_text,'isloggedin' => is_user_logged_in(), 'pnfpb_push_prompt' => $pnfpb_push_prompt, 'userid' => get_current_user_id(), 'pnfpb_ic_fcm_popup_subscribe_message' => get_option('pnfpb_ic_fcm_popup_subscribe_message'), 'pnfpb_ic_fcm_popup_unsubscribe_message' => get_option('pnfpb_ic_fcm_popup_unsubscribe_message'), 'pnfpb_ic_fcm_popup_wait_message' => get_option('pnfpb_ic_fcm_popup_wait_message'),'pnfpb_ic_fcm_custom_prompt_popup_wait_message' => get_option('pnfpb_ic_fcm_custom_prompt_popup_wait_message'), 'pnfpb_ic_fcm_popup_subscribe_button' => get_option('pnfpb_ic_fcm_popup_subscribe_button'),'pnfpb_ic_fcm_popup_unsubscribe_button' => get_option('pnfpb_ic_fcm_popup_unsubscribe_button'),'pwadesktopinstallpromptenabled' => $pwadesktopinstallpromptenabled,'pwamobileinstallpromptenabled' => $pwamobileinstallpromptenabled,'pwapixelsinstallpromptenabled' => $pwapixelsinstallpromptenabled,'pwapixelsinputinstallpromptenabled' => $pwapixelsinputinstallpromptenabled,'shortcode_close_button_text' => $shortcode_close_button_text,'pnfpb_ic_fcm_prompt_style' => $pnfpb_ic_fcm_prompt_style,'pnfpb_ic_fcm_prompt_on_off' => $pnfpb_ic_fcm_prompt_on_off,'pnfpb_ic_fcm_prompt_style3' => $pnfpb_ic_fcm_prompt_style3,'pnfpb_ic_fcm_custom_prompt_animation' => $pnfpb_ic_fcm_custom_prompt_animation,'notify_loggedin' => $pnfpb_ic_fcm_loggedin_notify,'pnfpb_custom_prompt_show_again_days' => $pnfpb_ic_fcm_custom_prompt_show_again_days, 'pnfpb_show_again_days' => $pnfpb_ic_fcm_pwa_show_again_days) );
				
				
			}
			else 
			{
				if ($pwaappenable === "1" && get_option( 'pnfpb_ic_disable_serviceworker_pwa_pushnotification' ) != '1') {
					
					$pnfpb_push_prompt = get_option('pnfpb_ic_fcm_push_prompt_enable');
					
					$filename = '/build/pnfpb_push_notification/index.js';
					
					$ajaxobject = 'pnfpb_ajax_object_push';
					
					$pnfpb_ic_fcm_pwa_show_again_days = '7';
				
					if (get_option( 'pnfpb_ic_fcm_pwa_show_again_days' ) && get_option( 'pnfpb_ic_fcm_pwa_show_again_days' ) != '') {
					
						$pnfpb_ic_fcm_pwa_show_again_days = get_option( 'pnfpb_ic_fcm_pwa_show_again_days' );
					
					}					
					
					wp_enqueue_script( 'pnfpb-icajax-script-push', plugins_url( $filename, __FILE__ ), array( 'jquery' ),'1.81.1',true);
					
					wp_localize_script( 'pnfpb-icajax-script-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'homeurl' => $homeurl, 'pwaapponlyenable' => $pwaappenable, 'pwainstallheadertext' => $pwainstallheadertext , 'pwainstalltext' => $pwainstalltext, 'pwainstallbuttoncolor' => $pwainstallbuttoncolor, 'pwainstallbuttontextcolor' => $pwainstallbuttontextcolor, 'pwainstallbuttontext' => $pwainstallbuttontext, 'pwacustominstalltype' => $pwacustominstalltype,  'pwainstallpromptenabled' => $pwainstallpromptenabled, 'pnfpb_push_prompt'=> $pnfpb_push_prompt,'pwadesktopinstallpromptenabled' => $pwadesktopinstallpromptenabled,'pwamobileinstallpromptenabled' => $pwamobileinstallpromptenabled,'pwapixelsinstallpromptenabled' => $pwapixelsinstallpromptenabled,'pwapixelsinputinstallpromptenabled' => $pwapixelsinputinstallpromptenabled,'pnfpb_ic_fcm_prompt_style' => $pnfpb_ic_fcm_prompt_style, 'pnfpb_show_again_days' => $pnfpb_ic_fcm_pwa_show_again_days) );						
					
					
				}
			}
			} else {
				
				wp_enqueue_script('pwebtonative_app', 'https://unpkg.com/webtonative@1.0.44/webtonative.min.js', array(), '1.0.44', true);
				wp_enqueue_script('onesignal_app', 'https://cdn.onesignal.com/sdks/OneSignalSDK.js', array(), '1.0.44', true);
				
			}
  
		}
    
		/**
		 * Add pnfpbmanifest.json to header for PWA app
		 * provided PWA conversion app option is ON
		 * @since 1.20
		 */
		// Creates the link tag
		public function PNFPB_include_manifest_link() {
			
			if (get_option("pnfpb_onesignal_push") !== '1' && get_option('pnfpb_ic_pwa_app_enable') === '1' && get_option( 'pnfpb_ic_disable_serviceworker_pwa_pushnotification' ) != '1') {
        		echo '<link rel="manifest" href="'.get_home_url().'/pnfpbmanifest.json">';
			}
		}

		public function PNFPB_custom_pwa_install_prompt() {
			if (get_option( 'pnfpb_onesignal_push' ) !== '1') {
			if (get_option( 'pnfpb_ic_fcm_push_prompt_text' ) && get_option( 'pnfpb_ic_fcm_push_prompt_text' ) != '') {
				$pnfpb_push_prompt_text = get_option( 'pnfpb_ic_fcm_push_prompt_text' );
			}
			else {
				$pnfpb_push_prompt_text = __("Would you like to subscribe to our notifications?",'PNFPB_TD');
			}
			if (get_option( 'pnfpb_ic_fcm_push_prompt_confirm_button' ) && get_option( 'pnfpb_ic_fcm_push_prompt_confirm_button' ) != '') {
				$pnfpb_push_prompt_confirm_button_text = get_option( 'pnfpb_ic_fcm_push_prompt_confirm_button' );
			}
			else {
				$pnfpb_push_prompt_confirm_button_text = __("Yes",'PNFPB_TD');
			}
			if (get_option( 'pnfpb_ic_fcm_push_prompt_cancel_button' ) && get_option( 'pnfpb_ic_fcm_push_prompt_cancel_button' ) != '') {
				$pnfpb_push_prompt_cancel_button_text = get_option( 'pnfpb_ic_fcm_push_prompt_cancel_button' );
			}
			else {
				$pnfpb_push_prompt_cancel_button_text = __("No",'PNFPB_TD');
			}
			if (get_option( 'pnfpb_ic_fcm_push_prompt_button_background' ) && get_option( 'pnfpb_ic_fcm_push_prompt_button_background' ) != '') {
				$pnfpb_push_prompt_button_background = get_option( 'pnfpb_ic_fcm_push_prompt_button_background' );
			}
			else {
				$pnfpb_push_prompt_button_background = "#121240";
			}
			if (get_option( 'pnfpb_ic_fcm_push_prompt_dialog_background' ) && get_option( 'pnfpb_ic_fcm_push_prompt_dialog_background' ) != '') {
				$pnfpb_push_prompt_dialog_background = get_option( 'pnfpb_ic_fcm_push_prompt_dialog_background' );
			}
			else {
				$pnfpb_push_prompt_dialog_background = "#DAD7D7";
			}
			if (get_option( 'pnfpb_ic_fcm_push_prompt_text_color' ) && get_option( 'pnfpb_ic_fcm_push_prompt_text_color' ) != '') {
				$pnfpb_push_prompt_text_color = get_option( 'pnfpb_ic_fcm_push_prompt_text_color' );
			}
			else {
				$pnfpb_push_prompt_text_color = "#161515";
			}
			if (get_option( 'pnfpb_ic_fcm_push_prompt_button_text_color' ) && get_option( 'pnfpb_ic_fcm_push_prompt_button_text_color' ) != '') {
				$pnfpb_push_prompt_button_text_color = get_option( 'pnfpb_ic_fcm_push_prompt_button_text_color' );
			}
			else {
				$pnfpb_push_prompt_button_text_color = "#ffffff";
			}			
			if (get_option( 'pnfpb_ic_fcm_push_prompt_position' ) && get_option( 'pnfpb_ic_fcm_push_prompt_position' ) != '') {
				$pnfpb_push_prompt_position = get_option( 'pnfpb_ic_fcm_push_prompt_position' );
			}
			else {
				$pnfpb_push_prompt_position = __("pnfpb-top-left",'PNFPB_TD');
			}
			
			if (get_option( 'pnfpb_ic_fcm_pwa_prompt_text' ) && get_option( 'pnfpb_ic_fcm_pwa_prompt_text' ) != '') {
				$pnfpb_pwa_prompt_text = get_option( 'pnfpb_ic_fcm_pwa_prompt_text' );
			}
			else {
				$pnfpb_pwa_prompt_text = __("Would you like to install our app?",PNFPB_TD);
			}
			if (get_option( 'pnfpb_ic_fcm_pwa_prompt_confirm_button' ) && get_option( 'pnfpb_ic_fcm_pwa_prompt_confirm_button' ) != '') {
				$pnfpb_pwa_prompt_confirm_button_text = get_option( 'pnfpb_ic_fcm_pwa_prompt_confirm_button' );
			}
			else {
				$pnfpb_pwa_prompt_confirm_button_text = __("Install",'PNFPB_TD');
			}
			if (get_option( 'pnfpb_ic_fcm_pwa_prompt_cancel_button' ) && get_option( 'pnfpb_ic_fcm_pwa_prompt_cancel_button' ) != '') {
				$pnfpb_pwa_prompt_cancel_button_text = get_option( 'pnfpb_ic_fcm_pwa_prompt_cancel_button' );
			}
			else {
				$pnfpb_pwa_prompt_cancel_button_text = __("Cancel",'PNFPB_TD');
			}
			if (get_option( 'pnfpb_ic_fcm_pwa_prompt_button_background' ) && get_option( 'pnfpb_ic_fcm_pwa_prompt_button_background' ) != '') {
				$pnfpb_pwa_prompt_button_background = get_option( 'pnfpb_ic_fcm_pwa_prompt_button_background' );
			}
			else {
				$pnfpb_pwa_prompt_button_background = "#121240";
			}
			if (get_option( 'pnfpb_ic_fcm_pwa_prompt_dialog_background' ) && get_option( 'pnfpb_ic_fcm_pwa_prompt_dialog_background' ) != '') {
				$pnfpb_pwa_prompt_dialog_background = get_option( 'pnfpb_ic_fcm_pwa_prompt_dialog_background' );
			}
			else {
				$pnfpb_pwa_prompt_dialog_background = "#DAD7D7";
			}
			if (get_option( 'pnfpb_ic_fcm_pwa_prompt_text_color' ) && get_option( 'pnfpb_ic_fcm_pwa_prompt_text_color' ) != '') {
				$pnfpb_pwa_prompt_text_color = get_option( 'pnfpb_ic_fcm_pwa_prompt_text_color' );
			}
			else {
				$pnfpb_pwa_prompt_text_color = "#161515";
			}
			if (get_option( 'pnfpb_ic_fcm_pwa_prompt_button_text_color' ) && get_option( 'pnfpb_ic_fcm_pwa_prompt_button_text_color' ) != '') {
				$pnfpb_pwa_prompt_button_text_color = get_option( 'pnfpb_ic_fcm_pwa_prompt_button_text_color' );
			}
			else {
				$pnfpb_pwa_prompt_button_text_color = "#ffffff";
			}
			$pnfpb_popup_subscribe_icon = '';	
			if (get_option( 'pnfpb_ic_fcm_popup_subscribe_button_icon' )) {
				
				$pnfpb_popup_subscribe_icon = get_option('pnfpb_ic_fcm_popup_subscribe_button_icon'); 
				
			} else { 
				
				$pnfpb_popup_subscribe_icon = plugin_dir_url( __DIR__ ).'public/img/pushbell-pnfpb.png';
			}
			if (get_option('pnfpb_ic_fcm_push_prompt_enable') === '1' && (!get_option('pnfpb_ic_fcm_loggedin_notify') || (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1' && is_user_logged_in()) || (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') !== '1'))) {	
			
				echo '<button type="button" id="pnfpb-push-subscribe-icon" class="pnfpb-push-subscribe-icon"><img src="'.$pnfpb_popup_subscribe_icon.'" width="32px" height="32px"/></button>';
				
				$pnfpb_ic_fcm_popup_header_text = __('Manage Push Notifications','PNFPB_TD');
				
				if (get_option('pnfpb_ic_fcm_popup_header_text')) {
					
					$pnfpb_ic_fcm_popup_header_text = get_option('pnfpb_ic_fcm_popup_header_text');
					
				}
				
				$pnfpb_ic_fcm_popup_subscribe_button_color = '#E54B4D';
				
				if (get_option('pnfpb_ic_fcm_popup_subscribe_button_color')) {
					
					$pnfpb_ic_fcm_popup_subscribe_button_color = get_option('pnfpb_ic_fcm_popup_subscribe_button_color');
					
				}

				$pnfpb_ic_fcm_popup_subscribe_options_button_color = '#CCCCCC';
				
				if (get_option('pnfpb_ic_fcm_popup_subscribe_options_button_color')) {
					
					$pnfpb_ic_fcm_popup_subscribe_options_button_color = get_option('pnfpb_ic_fcm_popup_subscribe_options_button_color');
					
				}				
				
				$pnfpb_ic_fcm_popup_subscribe_button_text_color = '#FFFFFF';
				
				if (get_option('pnfpb_ic_fcm_popup_subscribe_button_text_color')) {
					
					$pnfpb_ic_fcm_popup_subscribe_button_text_color = get_option('pnfpb_ic_fcm_popup_subscribe_button_text_color');
					
				}
				
				$pnfpb_ic_fcm_popup_subscribe_options_button_text_color = '#000000';
				
				if (get_option('pnfpb_ic_fcm_popup_subscribe_options_button_text_color')) {
					
					$pnfpb_ic_fcm_popup_subscribe_options_button_text_color = get_option('pnfpb_ic_fcm_popup_subscribe_options_button_text_color');
					
				}
				
				$pnfpb_ic_fcm_popup_subscribe_options_button_text = 'Update';
				
				if (get_option('pnfpb_ic_fcm_popup_subscribe_options_button_text_color')) {
					
					$pnfpb_ic_fcm_popup_subscribe_options_button_text = get_option('pnfpb_ic_fcm_popup_subscribe_options_button_text');
					
				}				
				
				$pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon = '#FFFFFF';
				
				if (get_option('pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon')) {
					
					$pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon = get_option('pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon');
					
				}
				
				$pnfpb_ic_fcm_custom_prompt_header_text = __('We would like to show you notifications for the latest news and updates.','PNFPB_TD');
				
				if (get_option('pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon')) {
					
					$pnfpb_ic_fcm_custom_prompt_header_text = get_option('pnfpb_ic_fcm_custom_prompt_header_text');
					
				}
				
				$pnfpb_ic_fcm_custom_prompt_allow_button_text = __('Allow','PNFPB_TD');
				
				if (get_option('pnfpb_ic_fcm_custom_prompt_allow_button_text')) {
					
					$pnfpb_ic_fcm_custom_prompt_allow_button_text = get_option('pnfpb_ic_fcm_custom_prompt_allow_button_text');
					
				}
				
				$pnfpb_ic_fcm_custom_prompt_cancel_button_text = __('Cancel','PNFPB_TD');
				
				if (get_option('pnfpb_ic_fcm_custom_prompt_cancel_button_text')) {
					
					$pnfpb_ic_fcm_custom_prompt_cancel_button_text = get_option('pnfpb_ic_fcm_custom_prompt_cancel_button_text');
					
				}
				
				$pnfpb_ic_fcm_custom_prompt_close_button_text = __('Close','PNFPB_TD');
				
				if (get_option('pnfpb_ic_fcm_custom_prompt_close_button_text')) {
					
					$pnfpb_ic_fcm_custom_prompt_close_button_text = get_option('pnfpb_ic_fcm_custom_prompt_close_button_text');
					
				}
				
				$pnfpb_ic_fcm_custom_prompt_header_text_processing = __('Please wait...it is processing','PNFPB_TD');
				
				if (get_option('pnfpb_ic_fcm_custom_prompt_popup_wait_message')) {
					
					$pnfpb_ic_fcm_custom_prompt_header_text_processing = get_option('pnfpb_ic_fcm_custom_prompt_popup_wait_message');
					
				}
				
				$pnfpb_ic_fcm_custom_prompt_animation = "slideDown";
				
				if (get_option('pnfpb_ic_fcm_custom_prompt_animation')) {
					
					$pnfpb_ic_fcm_custom_prompt_animation = get_option('pnfpb_ic_fcm_custom_prompt_animation');
					
					if ($pnfpb_ic_fcm_custom_prompt_animation !== 'slideDown' && $pnfpb_ic_fcm_custom_prompt_animation !== 'slideUp') {
						
						$pnfpb_ic_fcm_custom_prompt_animation = "slideDown";
						
					}
					
				}
				
				$pnfpb_bell_icon_subscription_option_update_text = "Update";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_update_text' )) {
					
					$pnfpb_bell_icon_subscription_option_update_text  = get_option( 'pnfpb_bell_icon_subscription_option_update_text' );
					
				} 
				
				$pnfpb_bell_icon_subscription_option_update_text_color = "#000000";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_update_text_color' )) {
					
					$pnfpb_bell_icon_subscription_option_update_text_color  = get_option( 'pnfpb_bell_icon_subscription_option_update_text_color' );
					
				}
				
				$pnfpb_bell_icon_subscription_option_update_background_color = "#cccccc";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_update_background_color' )) {
					
					$pnfpb_bell_icon_subscription_option_update_background_color  = get_option( 'pnfpb_bell_icon_subscription_option_update_background_color' );
					
				}
				
				$pnfpb_bell_icon_subscription_option_list_background_color = "#cccccc";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_list_background_color' )) {
					
					$pnfpb_bell_icon_subscription_option_list_background_color  = get_option( 'pnfpb_bell_icon_subscription_option_list_background_color' );
					
				}
				
				$pnfpb_bell_icon_subscription_option_list_text_color = "#000000";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_list_text_color' )) {
					
					$pnfpb_bell_icon_subscription_option_list_text_color  = get_option( 'pnfpb_bell_icon_subscription_option_list_text_color' );
					
				}
				
				$pnfpb_bell_icon_subscription_option_list_checkbox_color = "#135e96";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_list_checkbox_color' )) {
					
					$pnfpb_bell_icon_subscription_option_list_checkbox_color  = get_option( 'pnfpb_bell_icon_subscription_option_list_checkbox_color' );
					
				}
				
				$pnfpb_bell_icon_subscription_option_update_confirmation_message = "subscription updated";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_update_confirmation_message' )) {
					
					$pnfpb_bell_icon_subscription_option_update_confirmation_message  = get_option( 'pnfpb_bell_icon_subscription_option_update_confirmation_message' );
					
				}
				
				$pnfpb_bell_icon_subscription_option_update_text = "Update";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_update_text' )) {
					
					$pnfpb_bell_icon_subscription_option_update_text  = get_option( 'pnfpb_bell_icon_subscription_option_update_text' );
					
				}
				
				$pnfpb_bell_icon_subscription_option_all_text = "All";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_all_text' )) {
					
					$pnfpb_bell_icon_subscription_option_all_text  = get_option( 'pnfpb_bell_icon_subscription_option_all_text' );
					
				}
				
				$pnfpb_bell_icon_subscription_option_post_text = "Post";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_post_text' )) {
					
					$pnfpb_bell_icon_subscription_option_post_text  = get_option( 'pnfpb_bell_icon_subscription_option_post_text' );
					
				}
				
				$pnfpb_bell_icon_subscription_option_activity_text = "Activity";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_activity_text' )) {
					
					$pnfpb_bell_icon_subscription_option_activity_text  = get_option( 'pnfpb_bell_icon_subscription_option_activity_text' );
					
				}
				
				$pnfpb_bell_icon_subscription_option_all_comments_text = "All comments";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_all_comments_text' )) {
					
					$pnfpb_bell_icon_subscription_option_all_comments_text  = get_option( 'pnfpb_bell_icon_subscription_option_all_comments_text' );
					
				}
				
				$pnfpb_bell_icon_subscription_option_my_comments_text = "My comments";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_my_comments_text' )) {
					
					$pnfpb_bell_icon_subscription_option_my_comments_text  = get_option( 'pnfpb_bell_icon_subscription_option_my_comments_text' );
					
				}
				
				$pnfpb_bell_icon_subscription_option_private_message_text = "Private Message";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_private_messsage_text' )) {
					
					$pnfpb_bell_icon_subscription_option_private_message_text  = get_option( 'pnfpb_bell_icon_subscription_option_private_message_text' );
					
				}
				
				$pnfpb_bell_icon_subscription_option_new_member_joined_text = "New member joined";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_new_member_joined_text' )) {
					
					$pnfpb_bell_icon_subscription_option_new_member_joined_text  = get_option( 'pnfpb_bell_icon_subscription_option_new_member_joined_text' );
					
				}
				
				
				$pnfpb_bell_icon_subscription_option_friendship_request_text = "Friendship request";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_friendship_request_text' )) {
					
					$pnfpb_bell_icon_subscription_option_friendship_request_text  = get_option( 'pnfpb_bell_icon_subscription_option_friendship_request_text' );
					
				}
				
				$pnfpb_bell_icon_subscription_option_friendship_accepted_text = "Friendship accepted";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_friendship_accepted_text' )) {
					
					$pnfpb_bell_icon_subscription_option_friendship_accepted_text  = get_option( 'pnfpb_bell_icon_subscription_option_friendship_accepted_text' );
					
				}
				
				
				$pnfpb_bell_icon_subscription_option_avatar_change_text = "Avatar change";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_avatar_change_text' )) {
					
					$pnfpb_bell_icon_subscription_option_avatar_change_text  = get_option( 'pnfpb_bell_icon_subscription_option_avatar_change_text' );
					
				}
				
				$pnfpb_bell_icon_subscription_option_cover_image_change_text = "Cover image change";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_cover_image_change_text' )) {
					
					$pnfpb_bell_icon_subscription_option_cover_image_change_text  = get_option( 'pnfpb_bell_icon_subscription_option_cover_image_change_text' );
					
				}
				
				$pnfpb_bell_icon_subscription_option_group_details_update_text = "Group details update";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_group_details_update_text' )) {
					
					$pnfpb_bell_icon_subscription_option_group_details_update_text  = get_option( 'pnfpb_bell_icon_subscription_option_group_details_update_text' );
					
				}
				
				$pnfpb_bell_icon_subscription_option_group_invite_text = "Group invite";
				
				if(get_option( 'pnfpb_bell_icon_subscription_option_group_invite_text' )) {
					
					$pnfpb_bell_icon_subscription_option_group_invite_text  = get_option( 'pnfpb_bell_icon_subscription_option_group_invite_text' );
					
				}
				
				$pnfpb_custom_prompt_options_on_off = '0';
				
				if(get_option( 'pnfpb_custom_prompt_options_on_off' )) {
					
					$pnfpb_custom_prompt_options_on_off  = get_option( 'pnfpb_custom_prompt_options_on_off' );
					
				}
				
				$pnfpb_bell_icon_prompt_options_on_off = '1';
				
				if(get_option( 'pnfpb_bell_icon_prompt_options_on_off','0' ) != '0') {
					
					$pnfpb_bell_icon_prompt_options_on_off  = get_option( 'pnfpb_bell_icon_prompt_options_on_off' );
					
				}
				
			
				
				$args = array(
					'public'   => true,
					'_builtin' => false
				); 
	
				$output = 'names'; // or objects
				$operator = 'and'; // 'and' or 'or'
				$custposttypes = get_post_types( $args, $output, $operator );
				
	    		$frontend_post_push_enable = false;
				
				foreach ( $custposttypes as $post_type ) {
					if (get_option('pnfpb_ic_fcm_'.$post_type.'_enable') === '1') {
						$frontend_post_push_enable = true;
					}
				}
				
				if (get_option('pnfpb_ic_fcm_post_enable') === '1') {
					$frontend_post_push_enable = true;
				}				
							
				$pnfpb_html_subscription_options = '';
				
				$pnfpb_html_subscription_options_header = '';
				$pnfpb_html_subscription_post_options = '';
				$pnfpb_html_subscription_activity_options = '';
				$pnfpb_html_subscription_all_comments_options = '';
				$pnfpb_html_subscription_my_comments_options = '';
				$pnfpb_html_subscription_private_message_options = '';
				$pnfpb_html_subscription_new_member_joined_options = '';
				$pnfpb_html_subscription_friendship_request_options = '';
				$pnfpb_html_subscription_friendship_accepted_options = '';
				$pnfpb_html_subscription_avatar_change_options = '';
				$pnfpb_html_subscription_cover_image_change_options = '';
				$pnfpb_html_subscription_group_details_update_options = '';
				$pnfpb_html_subscription_group_invite_options = '';
				
				$pnfpb_html_subscription_options_header = '<div class="pnfpb_bell_icon_subscription_options_container" style="background:'.$pnfpb_bell_icon_subscription_option_list_background_color.';color:'.$pnfpb_bell_icon_subscription_option_list_text_color.';">
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_all_enable">
											'.$pnfpb_bell_icon_subscription_option_all_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_subscription_all_enable" class="pnfpb_bell_icon_subscription_all_enable" name="pnfpb_bell_icon_subscription_all_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
				
							if ($frontend_post_push_enable) {
								$pnfpb_html_subscription_post_options = '<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_post_enable">
											'.$pnfpb_bell_icon_subscription_option_post_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_subscription_post_enable" class="pnfpb_bell_icon_subscription_post_enable" name="pnfpb_bell_icon_subscription_post_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_bactivity_enable') === '1') {
								$pnfpb_html_subscription_activity_options = '								
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_activity_enable">
											'.$pnfpb_bell_icon_subscription_option_activity_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_subscription_activity_enable" class="pnfpb_bell_icon_subscription_activity_enable" name="pnfpb_bell_icon_subscription_activity_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_bcomment_enable') === '1') {
								$pnfpb_html_subscription_all_comments_options = '
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_all_comments_enable">
											'.$pnfpb_bell_icon_subscription_option_all_comments_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_subscription_all_comments_enable" class="pnfpb_bell_icon_subscription_all_comments_enable" name="pnfpb_bell_icon_subscription_all_comments_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_bcomment_enable') === '1') {
								$pnfpb_html_subscription_my_comments_options = '									
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_my_comments_enable">
											'.$pnfpb_bell_icon_subscription_option_my_comments_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_subscription_my_comments_enable" class="pnfpb_bell_icon_subscription_my_comments_enable" name="pnfpb_bell_icon_subscription_my_comments_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_bprivatemessage_enable') === '1') {
								$pnfpb_html_subscription_private_message_options = '								
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_private_message_enable">
											'.$pnfpb_bell_icon_subscription_option_private_message_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_subscription_private_message_enable" class="pnfpb_bell_icon_subscription_private_message_enable" name="pnfpb_bell_icon_subscription_private_message_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_new_member_enable') === '1') {
								$pnfpb_html_subscription_new_member_joined_options = '								
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_new_member_enable">
											'.$pnfpb_bell_icon_subscription_option_new_member_joined_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_subscription_new_member_enable" class="pnfpb_bell_icon_subscription_new_member_enable" name="pnfpb_bell_icon_subscription_new_member_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_friendship_request_enable') === '1') {
								$pnfpb_html_subscription_friendship_request_options = '								
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_friendship_request_enable">
											'.$pnfpb_bell_icon_subscription_option_friendship_request_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_subscription_friendship_request_enable" class="pnfpb_bell_icon_subscription_friendship_request_enable" name="pnfpb_bell_icon_subscription_friendship_request_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_friendship_accept_enable') === '1') {
								$pnfpb_html_subscription_friendship_accepted_options = '								
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_friendship_accepted_enable">
											'.$pnfpb_bell_icon_subscription_option_friendship_accepted_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_subscription_friendship_accepted_enable" class="pnfpb_bell_icon_subscription_friendship_accepted_enable" name="pnfpb_bell_icon_subscription_friendship_accepted_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_avatar_change_enable') === '1') {
								$pnfpb_html_subscription_avatar_change_options = '								
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_avatar_change_enable">
											'.$pnfpb_bell_icon_subscription_option_avatar_change_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_subscription_avatar_change_enable" class="pnfpb_bell_icon_subscription_avatar_change_enable" name="pnfpb_bell_icon_subscription_avatar_change_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_cover_image_change_enable') === '1') {
								$pnfpb_html_subscription_cover_image_change_options = '								
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_cover_image_change_enable">
											'.$pnfpb_bell_icon_subscription_option_cover_image_change_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_subscription_cover_image_change_enable" class="pnfpb_bell_icon_subscription_cover_image_change_enable" name="pnfpb_bell_icon_subscription_cover_image_change_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_group_details_updated_enable') === '1') {
								$pnfpb_html_subscription_group_details_update_options = '								
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_group_details_update_enable">
											'.$pnfpb_bell_icon_subscription_option_group_details_update_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_subscription_group_details_update_enable" class="pnfpb_bell_icon_subscription_group_details_update_enable" name="pnfpb_bell_icon_subscription_group_details_update_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_group_invitation_enable') === '1') {
								$pnfpb_html_subscription_group_invite_options = '								
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_group_invite_enable">
											'.$pnfpb_bell_icon_subscription_option_group_invite_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_subscription_group_invite_enable" class="pnfpb_bell_icon_subscription_group_invite_enable" name="pnfpb_bell_icon_subscription_group_invite_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
				$pnfpb_html_subscription_footer_options = '								
								<button type="button" class="pnfpb-push-subscribe-options-button" id="pnfpb-push-subscribe-options-button" style="background:'.$pnfpb_bell_icon_subscription_option_update_background_color.';color:'.$pnfpb_bell_icon_subscription_option_update_text_color.';">
								'.$pnfpb_bell_icon_subscription_option_update_text.'</button>';
				
				$pnfpb_html_bellicon_subscription_options = '';
				
				$pnfpb_html_bellicon_subscription_options_header = '';
				$pnfpb_html_bellicon_subscription_post_options = '';
				$pnfpb_html_bellicon_subscription_activity_options = '';
				$pnfpb_html_bellicon_subscription_all_comments_options = '';
				$pnfpb_html_bellicon_subscription_my_comments_options = '';
				$pnfpb_html_bellicon_subscription_private_message_options = '';
				$pnfpb_html_bellicon_subscription_new_member_joined_options = '';
				$pnfpb_html_bellicon_subscription_friendship_request_options = '';
				$pnfpb_html_bellicon_subscription_friendship_accepted_options = '';
				$pnfpb_html_bellicon_subscription_avatar_change_options = '';
				$pnfpb_html_bellicon_subscription_cover_image_change_options = '';
				$pnfpb_html_bellicon_subscription_group_details_update_options = '';
				$pnfpb_html_bellicon_subscription_group_invite_options = '';				
				
				$pnfpb_html_bellicon_subscription_options_header = '<div class="pnfpb_bell_icon_prompt_subscription_options_container" style="background:'.$pnfpb_bell_icon_subscription_option_list_background_color.';color:'.$pnfpb_bell_icon_subscription_option_list_text_color.';">
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_all_enable">
											'.$pnfpb_bell_icon_subscription_option_all_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_prompt_subscription_all_enable" class="pnfpb_bell_icon_prompt_subscription_all_enable" name="pnfpb_bell_icon_prompt_subscription_all_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
				

			
							if ($frontend_post_push_enable) {
								$pnfpb_html_bellicon_subscription_post_options = '<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_post_enable">
											'.$pnfpb_bell_icon_subscription_option_post_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_prompt_subscription_post_enable" class="pnfpb_bell_icon_prompt_subscription_post_enable" name="pnfpb_bell_icon_prompt_subscription_post_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_bactivity_enable') === '1') {
								$pnfpb_html_bellicon_subscription_activity_options = '								
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_activity_enable">
											'.$pnfpb_bell_icon_subscription_option_activity_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_prompt_subscription_activity_enable" class="pnfpb_bell_icon_prompt_subscription_activity_enable" name="pnfpb_bell_icon_prompt_subscription_activity_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_bcomment_enable') === '1') {
								$pnfpb_html_bellicon_subscription_all_comments_options = '
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_all_comments_enable">
											'.$pnfpb_bell_icon_subscription_option_all_comments_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_prompt_subscription_all_comments_enable" class="pnfpb_bell_icon_prompt_subscription_all_comments_enable" name="pnfpb_bell_icon_prompt_subscription_all_comments_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_bcomment_enable') === '1') {
								$pnfpb_html_bellicon_subscription_my_comments_options = '									
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_my_comments_enable">
											'.$pnfpb_bell_icon_subscription_option_my_comments_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_prompt_subscription_my_comments_enable" class="pnfpb_bell_icon_prompt_subscription_my_comments_enable" name="pnfpb_bell_icon_prompt_subscription_my_comments_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_bprivatemessage_enable') === '1') {
								$pnfpb_html_bellicon_subscription_private_message_options = '								
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_private_message_enable">
											'.$pnfpb_bell_icon_subscription_option_private_message_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_prompt_subscription_private_message_enable" class="pnfpb_bell_icon_prompt_subscription_private_message_enable" name="pnfpb_bell_icon_prompt_subscription_private_message_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_new_member_enable') === '1') {
								$pnfpb_html_bellicon_subscription_new_member_joined_options = '								
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_new_member_enable">
											'.$pnfpb_bell_icon_subscription_option_new_member_joined_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_prompt_subscription_new_member_enable" class="pnfpb_bell_icon_prompt_subscription_new_member_enable" name="pnfpb_bell_icon_prompt_subscription_new_member_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_friendship_request_enable') === '1') {
								$pnfpb_html_bellicon_subscription_friendship_request_options = '								
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_friendship_request_enable">
											'.$pnfpb_bell_icon_subscription_option_friendship_request_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_prompt_subscription_friendship_request_enable" class="pnfpb_bell_icon_prompt_subscription_friendship_request_enable" name="pnfpb_bell_icon_prompt_subscription_friendship_request_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_friendship_accept_enable') === '1') {
								$pnfpb_html_bellicon_subscription_friendship_accepted_options = '								
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_friendship_accepted_enable">
											'.$pnfpb_bell_icon_subscription_option_friendship_accepted_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_prompt_subscription_friendship_accepted_enable" class="pnfpb_bell_icon_prompt_subscription_friendship_accepted_enable" name="pnfpb_bell_icon_prompt_subscription_friendship_accepted_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_avatar_change_enable') === '1') {
								$pnfpb_html_bellicon_subscription_avatar_change_options = '								
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_avatar_change_enable">
											'.$pnfpb_bell_icon_subscription_option_avatar_change_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_prompt_subscription_avatar_change_enable" class="pnfpb_bell_icon_prompt_subscription_avatar_change_enable" name="pnfpb_bell_icon_prompt_subscription_avatar_change_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_cover_image_change_enable') === '1') {
								$pnfpb_html_bellicon_subscription_cover_image_change_options = '								
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_cover_image_change_enable">
											'.$pnfpb_bell_icon_subscription_option_cover_image_change_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_prompt_subscription_cover_image_change_enable" class="pnfpb_bell_icon_prompt_subscription_cover_image_change_enable" name="pnfpb_bell_icon_prompt_subscription_cover_image_change_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_group_details_updated_enable') === '1') {
								$pnfpb_html_bellicon_subscription_group_details_update_options = '								
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_group_details_update_enable">
											'.$pnfpb_bell_icon_subscription_option_group_details_update_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_prompt_subscription_group_details_update_enable" class="pnfpb_bell_icon_prompt_subscription_group_details_update_enable" name="pnfpb_bell_icon_prompt_subscription_group_details_update_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
							if (get_option('pnfpb_ic_fcm_group_invitation_enable') === '1') {
								$pnfpb_html_bellicon_subscription_group_invite_options = '								
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_bell_icon_subscription_group_invite_enable">
											'.$pnfpb_bell_icon_subscription_option_group_invite_text.'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_prompt_subscription_group_invite_enable" class="pnfpb_bell_icon_prompt_subscription_group_invite_enable" name="pnfpb_bell_icon_prompt_subscription_group_invite_enable" type="checkbox" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
							}
				
				$pnfpb_html_bellicon_subscription_footer_options = '								
								<button type="button" class="pnfpb-push-subscribe-options-button" id="pnfpb-push-subscribe-options-button" style="background:'.$pnfpb_bell_icon_subscription_option_update_background_color.';color:'.$pnfpb_bell_icon_subscription_option_update_text_color.';">
								'.$pnfpb_bell_icon_subscription_option_update_text.'</button>';
				
				
				$pnfpb_html_subscription_options = '';
				
				if ($pnfpb_custom_prompt_options_on_off === '1') {
					
					$pnfpb_html_subscription_options = $pnfpb_html_subscription_options_header.$pnfpb_html_subscription_post_options.$pnfpb_html_subscription_activity_options.							$pnfpb_html_subscription_all_comments_options.$pnfpb_html_subscription_my_comments_options.$pnfpb_html_subscription_private_message_options.							$pnfpb_html_subscription_new_member_joined_options.$pnfpb_html_subscription_friendship_request_options.$pnfpb_html_subscription_friendship_accepted_options.					$pnfpb_html_subscription_avatar_change_options.$pnfpb_html_subscription_cover_image_change_options.$pnfpb_html_subscription_group_details_update_options.							$pnfpb_html_subscription_group_invite_options.'</div>';
					
				}
				
				$pnfpb_html_bellicon_subscription_options = '';
				
				if ($pnfpb_bell_icon_prompt_options_on_off === '1') {
					
					$pnfpb_html_bellicon_subscription_options = $pnfpb_html_bellicon_subscription_options_header.$pnfpb_html_bellicon_subscription_post_options.$pnfpb_html_bellicon_subscription_activity_options.							$pnfpb_html_bellicon_subscription_all_comments_options.$pnfpb_html_bellicon_subscription_my_comments_options.$pnfpb_html_bellicon_subscription_private_message_options.							$pnfpb_html_bellicon_subscription_new_member_joined_options.$pnfpb_html_bellicon_subscription_friendship_request_options.$pnfpb_html_bellicon_subscription_friendship_accepted_options.					$pnfpb_html_bellicon_subscription_avatar_change_options.$pnfpb_html_bellicon_subscription_cover_image_change_options.$pnfpb_html_bellicon_subscription_group_details_update_options.							$pnfpb_html_bellicon_subscription_group_invite_options.'</div>'.$pnfpb_html_bellicon_subscription_footer_options;

				}
				
				
				
				echo '<div id="pnfpb-push-status-text" class="pnfpb-push-status-text"></div>
						<div id="pnfpb-push-subscribe-button-layout" class="pnfpb-push-subscribe-button-layout">
							<p class="pnfpb-bell-icon-header">'.$pnfpb_ic_fcm_popup_header_text.'</p>
							<div class="pnfpb_bell_icon_custom_prompt_loader" id="pnfpb_bell_icon_custom_prompt_loader"></div>
							<div id="pnfpb-push-subscribe-options-button-container" class="pnfpb-push-subscribe-options-button-container">
								'.$pnfpb_html_bellicon_subscription_options.'							
							</div>					
							<div class="pnfpb-push-msg-container">
								<div class="pnfpb-push-icon"><img src="'.get_option('pnfpb_ic_fcm_upload_icon').'" /></div>
								<div class="pnfpb-push-msg-text-layout">
									<div class="pnfpb-push-msg-text-line"></div>
									<div class="pnfpb-push-msg-text-long-line"></div>
									<div class="pnfpb-push-msg-text-line"></div>
									<div class="pnfpb-push-msg-text-long-line"></div>
									<div class="pnfpb-push-msg-text-line"></div>
								</div>
							</div>						
							<div id="pnfpb-push-subscribe-button-container" class="pnfpb-push-subscribe-button-container">
								<button type="button" class="pnfpb-push-subscribe-button" id="pnfpb-push-subscribe-button" style="background:'.$pnfpb_ic_fcm_popup_subscribe_button_color.';color:'.$pnfpb_ic_fcm_popup_subscribe_button_text_color.';">
								</button>
							</div>
						</div>';
				
				echo '<div id="pnfpb-popup-customprompt-container" class="pnfpb-popup-customprompt-container">
						<div id="pnfpb-popup-customprompt-container-dialog-'.$pnfpb_ic_fcm_custom_prompt_animation.'" class="pnfpb-popup-customprompt-container-dialog-'.$pnfpb_ic_fcm_custom_prompt_animation.'">
							<div id="pnfpb-popup-customprompt-transistion" class="pnfpb-popup-customprompt-transistion">
								<div class="pnfpb-popup-customprompt-transistion-body" id="pnfpb-popup-customprompt-transistion-body">
									<div class="pnfpb-popup-customprompt-transistion-body-icon">
										<img alt="notification icon" src="'.$pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon.'">
									</div>
									<div class="pnfpb-popup-customprompt-transistion-body-message">'.$pnfpb_ic_fcm_custom_prompt_header_text.'</div>															'.$pnfpb_html_subscription_options.'								
									<div class="clearfix"></div>
									<div id="pnfpb-loading-container"></div>
								</div>
								<div class="pnfpb-popup-customprompt-transistion-footer" id="pnfpb-popup-customprompt-transistion-footer">
									<button class="pnfpb-popup-customprompt-transistion-allow-button" id="pnfpb-popup-customprompt-transistion-allow-button">'.$pnfpb_ic_fcm_custom_prompt_allow_button_text.'</button>
									<button class="pnfpb-popup-customprompt-transistion-cancel-button" id="pnfpb-popup-customprompt-transistion-cancel-button">'.$pnfpb_ic_fcm_custom_prompt_cancel_button_text.'</button>
									<div class="pnfpb_custom_prompt_loader" id="pnfpb_custom_prompt_loader"></div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div id="pnfpb-popup-customprompt-transistion-confirmation" class="pnfpb-popup-customprompt-transistion-confirmation">
								<div class="pnfpb-popup-customprompt-transistion-body" id="pnfpb-popup-customprompt-transistion-body">
									<div class="pnfpb-popup-customprompt-transistion-body-icon">
										<img alt="notification icon" src="'.$pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon.'">
									</div>
									<div class="pnfpb-popup-customprompt-transistion-body-message">'.$pnfpb_ic_fcm_custom_prompt_header_text_processing.'</div>
									<div class="clearfix"></div>
									<div id="pnfpb-loading-container"></div>
								</div>
								<div class="pnfpb-popup-customprompt-transistion-footer" id="pnfpb-popup-customprompt-transistion-footer">
									<button class="pnfpb-popup-customprompt-transistion-close-button" id="pnfpb-popup-customprompt-transistion-close-button">'.$pnfpb_ic_fcm_custom_prompt_close_button_text.'</button>
									<div class="clearfix"></div>
								</div>
							</div>							
						</div>
					</div>';
				
				echo '<div id="pnfpb-popup-customprompt-vertical-container" class="pnfpb-popup-customprompt-vertical-container">
						<div id="pnfpb-popup-customprompt-vertical-container-dialog-'.$pnfpb_ic_fcm_custom_prompt_animation.'" class="pnfpb-popup-customprompt-vertical-container-dialog-'.$pnfpb_ic_fcm_custom_prompt_animation.'">
							<div id="pnfpb-popup-customprompt-vertical-transistion" class="pnfpb-popup-customprompt-vertical-transistion">
								<div class="pnfpb-popup-customprompt-vertical-transistion-body" id="pnfpb-popup-customprompt-vertical-transistion-body">
									<div class="pnfpb-popup-customprompt-vertical-transistion-body-icon">
										<img alt="notification icon" src="'.$pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon.'">
									</div>
									<div class="pnfpb-popup-customprompt-vertical-transistion-body-message">'.$pnfpb_ic_fcm_custom_prompt_header_text.'</div>
								'.$pnfpb_html_subscription_options.'	
									<div class="clearfix"></div>
									<div id="pnfpb-loading-container"></div>
								</div>
								<div class="pnfpb-popup-customprompt-vertical-transistion-footer" id="pnfpb-popup-customprompt-vertical-transistion-footer">
									<button class="pnfpb-popup-customprompt-vertical-transistion-allow-button" id="pnfpb-popup-customprompt-vertical-transistion-allow-button">'.$pnfpb_ic_fcm_custom_prompt_allow_button_text.'</button>
									<button class="pnfpb-popup-customprompt-vertical-transistion-cancel-button" id="pnfpb-popup-customprompt-vertical-transistion-cancel-button">'.$pnfpb_ic_fcm_custom_prompt_cancel_button_text.'</button>
									<div class="pnfpb_custom_prompt_loader" id="pnfpb_custom_prompt_loader"></div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div id="pnfpb-popup-customprompt-vertical-transistion-confirmation" class="pnfpb-popup-customprompt-vertical-transistion-confirmation">
								<div class="pnfpb-popup-customprompt-vertical-transistion-body" id="pnfpb-popup-customprompt-vertical-transistion-body">
									<div class="pnfpb-popup-customprompt-vertical-transistion-body-icon">
										<img alt="notification icon" src="'.$pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon.'">
									</div>
									<div class="pnfpb-popup-customprompt-vertical-transistion-body-message">'.$pnfpb_ic_fcm_custom_prompt_header_text_processing.'</div>
									<div class="clearfix"></div>
									<div id="pnfpb-loading-container"></div>
								</div>
								<div class="pnfpb-popup-customprompt-vertical-transistion-footer" id="pnfpb-popup-customprompt-vertical-transistion-footer">
									<button class="pnfpb-popup-customprompt-vertical-transistion-close-button" id="pnfpb-popup-customprompt-vertical-transistion-close-button">'.$pnfpb_ic_fcm_custom_prompt_close_button_text.'</button>
									<div class="clearfix"></div>
								</div>
							</div>							
						</div>
					</div>';				
						
			}
			
			if (get_option('pnfpb_ic_pwa_app_enable') === '1' && (get_option('pnfpb_ic_pwa_app_custom_prompt_enable') === '1' || get_option('pnfpb_ic_pwa_app_desktop_custom_prompt_enable') === '1' || get_option('pnfpb_ic_pwa_app_mobile_custom_prompt_enable') === '1' || get_option('pnfpb_ic_pwa_app_pixels_custom_prompt_enable') === '1') && get_option( 'pnfpb_ic_disable_serviceworker_pwa_pushnotification' ) != '1') {


			echo '<div class="pnfpb-pwa-dialog-container" id="pnfpb-pwa-dialog-container">
						<div class="pnfpb-pwa-dialog-box" style="background-color:'.$pnfpb_pwa_prompt_dialog_background.'">
							<div class="pnfpb-pwa-dialog-title" style="color:'.$pnfpb_pwa_prompt_text_color.';">'.$pnfpb_pwa_prompt_text.'</div>
							<div class="pnfpb-pwa-dialog-buttons">
								<button id="pnfpb-pwa-dialog-cancel" type="button" class="button secondary" style="color:'.$pnfpb_pwa_prompt_button_text_color.';background-color:'.$pnfpb_pwa_prompt_button_background.';">'.$pnfpb_pwa_prompt_cancel_button_text.'</button>
								<button id="pnfpb-pwa-dialog-subscribe" type="button" class="button primary" style="color:'.$pnfpb_pwa_prompt_button_text_color.';background-color:'.$pnfpb_pwa_prompt_button_background.';">'.$pnfpb_pwa_prompt_confirm_button_text.'</button>
							</div>
						</div>
				</div>';
?>

				<div id="pnfpb-pwa-dialog-ios" class="pnfpb-pwa-dialog-app-installed" title="<?php echo __('PWA for IOS browsers','PNFPB_TD');  ?>">
					<p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span><?php echo __('For IOS and IPAD browsers, Only option to install PWA is to use add to home screen in safari browser','PNFPB_TD'); ?></p>
				</div>

				<div id="pnfpb-pwa-dialog-app-installed" class="pnfpb-pwa-dialog-app-installed" title="<?php if ( get_option("pnfpb-pwa-dialog-app-installed_text", false) )  { echo get_option("pnfpb-pwa-dialog-app-installed_text"); } else { echo __('App installed successfully','PNFPB_TD'); } ?>">
					<p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span><?php if ( get_option("pnfpb-pwa-dialog-app-installed_description", false)) { echo get_option("pnfpb-pwa-dialog-app-installed_description"); } else { echo __('Progressive Web App (PWA) is installed successfully.','PNFPB_TD'); } ?></p>
				</div>
<?php				
			}
			} else {
				
				$pnfpb_push_prompt = get_option('pnfpb_ic_fcm_push_prompt_enable');
				$filename = '/public/js/pnfpb_pushscript_onesignal_pwa.js';
				$ajaxobject = 'pnfpb_ajax_object_onesignal_push';
				wp_enqueue_script( 'pnfpb-icajax-onesignal-script-push', plugins_url( $filename, __FILE__ ), array( 'jquery' ),'1.64.31',true);
				wp_localize_script( 'pnfpb-icajax-onesignal-script-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'userid' => get_current_user_id()) );				
			}
		}
		
		/**
		* Ajax callback routine to update subscribed device id for push notification.
		*
		*
		* @since 1.0.0
		*/
		public function PNFPB_icpushcallback_callback() {
			global $wpdb;
			include(plugin_dir_path(__FILE__) . 'public/ajax_routines/pnfpb_update_deviceid_ajax.php');
			wp_die();
		}
		
		/**
		* Ajax callback routine to update admin notice.
		*
		*
		* @since 1.58.0
		*/
		public function PNFPB_icpushadmincallback_callback() {
			global $wpdb;
			include(plugin_dir_path(__FILE__) . 'admin/ajax_routines/pnfpb_admin_notice_ajax.php');
			wp_die();
		}		


		/**
		* Create push notification settings menu under settings menu in admin area for push notification using FCM
		*
		* @since 1.0.0
		*/
		public function PNFPB_setup_admin_menu()
		{
			$this->hook = add_menu_page(
				esc_html__( 'PNFPB Push Notification', 'PNFPB_TD' ),
				esc_html__( 'PNFPB Push Notification', 'PNFPB_TD' ),
				'administrator', // -> Capability level
				'pnfpb-icfcm-slug',
				array($this, 'PNFPB_icfcm_admin_page'),
				'dashicons-bell',
				98
			);
			
		
			add_submenu_page('pnfpb-icfcm-slug', __('Push settings', 'PNFPB_TD'), __('Push settings', 'PNFPB_TD'), 'manage_options', 'pnfpb-icfcm-slug', array($this, 'PNFPB_icfcm_admin_page'),1);
			
			$hook_device_tokens = add_submenu_page('pnfpb-icfcm-slug'            // -> Set to null - will hide menu link
				, __('Device tokens list', 'PNFPB_TD')// -> Page Title
				, 'Device tokens'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfm_device_tokens_list'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_device_tokens_list') // -> To render the page
				,2
			);
			add_action( "load-$hook_device_tokens", [ $this, $this->pre_name.'screen_option' ] );
			
			add_submenu_page('pnfpb-icfcm-slug'            // -> Set to null - will hide menu link
				, __('PWA app settings', 'PNFPB_TD')// -> Page Title
				, 'PWA app'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfm_pwa_app_settings'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_pwa_app_settings') // -> To render the page
				, 4
			);			

			add_submenu_page('pnfpb-icfcm-slug'            // -> Set to null - will hide menu link
				, __('On demand Notification', 'PNFPB_TD')// -> Page Title
				, 'On demand/One time Notification'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfmtest_notification'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_test_notification') // -> To render the page
				, 5
			);
			
		  	$hook_notifications_list = add_submenu_page('pnfpb-icfcm-slug'            // -> Set to null - will hide menu link
				, __('Onetime Notifications list', 'PNFPB_TD')// -> Page Title
				, 'One time push notifications list'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfm_onetime_notifications_list'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfm_onetime_notifications_list') // -> To render the page
				,3
			);
			add_action( "load-$hook_notifications_list", [ $this, $this->pre_name.'push_notifications_list_screen_option' ] );	
			
			add_submenu_page('pnfpb-icfcm-slug'            // -> Set to null - will hide menu link
				, __('Frontend subscription', 'PNFPB_TD')// -> Page Title
				, 'Frontend subscription'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfm_frontend_settings'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_frontend_settings') // -> To render the page
				, 6
			);
			
			add_submenu_page('pnfpb-icfcm-slug'            // -> Set to null - will hide menu link
				, __('Customize Buttons', 'PNFPB_TD')// -> Page Title
				, 'Customize Buttons'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfm_button_settings'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_button_settings') // -> To render the page
				,7
			);			
			
		  	add_submenu_page('pnfpb-icfcm-slug'            // -> Set to null - will hide menu link
				, __('Integrate Mobile Apps', 'PNFPB_TD')// -> Page Title
				, 'Integrate Mobile App'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfm_integrate_app'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_integrate_app') // -> To render the page
				,8
			);
			
		  	add_submenu_page('pnfpb-icfcm-slug'            // -> Set to null - will hide menu link
				, __('NGNIX', 'PNFPB_TD')// -> Page Title
				, 'NGNIX'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfm_settings_for_ngnix_server'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_settings_for_ngnix_server') // -> To render the page
				,9
			);

			$hook_pnfpb_action_scheduler = add_submenu_page('pnfpb-icfcm-slug'            // -> Set to null - will hide menu link
				, __('Action scheduler', 'PNFPB_TD')// -> Page Title
				, 'Action scheduler'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfm_action_scheduler'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_action_scheduler') // -> To render the page
				,10
			);
			add_action( "load-$hook_pnfpb_action_scheduler", [ $this, $this->pre_name.'action_scheduler_screen_option' ] );
			
		}
		
		/*
		 * Admin bar menu registration
		 * 
		 * @since 1.58.0
		 */
		public function PNFPB_ic_fcm_admin_bar_menu_register(WP_Admin_Bar $wp_admin_bar) {
			
			include(plugin_dir_path(__FILE__) . 'admin/pnfpb_admin_bar_menu_settings.php');
			
			$this->pnfpb_admin_bar_menu_obj = new PNFPB_ICFM_admin_bar_menu_class();
			
			$this->pnfpb_admin_bar_menu_obj->pnfpb_admin_bar_menu_register($wp_admin_bar);
			
		}
		
		/**
		* To Test push notification from admin area under plugin settings
		*
		*
		* @since 1.0.0
		*/
		public function PNFPB_icfcm_test_notification(){
			require __DIR__.'/vendor/autoload.php';

		
			include(plugin_dir_path(__FILE__) . 'admin/pnfpb_admin_ondemand_notification_settings.php');
		}
		
		/**
		* To Test push notification from admin area under plugin settings
		*
		*
		* @since 1.64.0
		*/
		public function PNFPB_icfm_onetime_notifications_list(){
			include(plugin_dir_path(__FILE__) . 'admin/pnfpb_onetime_notifications_list.php');
		}		
		
		/* On demand schedule push notification
		* 
		* 
		* @since 1.57
		* 
		*/
		public function PNFPB_ondemand_schedule_push_notification($scheduled_day_push_notification,$notification_id,$occurence,$selected_recurring_status) {
	
			global $wpdb;
	
			$apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
			
			if (($apiaccesskey != '' && $apiaccesskey != false) || (get_option( 'pnfpb_onesignal_push' ) === '1')) {
	
			    $table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
				
				if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
					
					$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%'" );
				
					$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%'" );					
					
				} else {
 	
			    	$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%'" );
				
					$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%'" );
					
				}
	
			    $url = 'https://fcm.googleapis.com/fcm/send';

			    $regid = $deviceids;
	
			    $activity_content_push = strip_tags(urldecode(get_option('pnfpb_ic_fcm_ondemand_schedule_pn_content'.$scheduled_day_push_notification)));
				
			    $imageurl = '';
                if (get_option('pnfpb_ic_fcm_ondemand_schedule_pn_image'.$scheduled_day_push_notification)) {
                    $imageurl = get_option('pnfpb_ic_fcm_ondemand_schedule_pn_image'.$scheduled_day_push_notification);
                }

                $postlink = get_home_url();
                if (get_option('pnfpb_ic_fcm_ondemand_schedule_pn_url'.$scheduled_day_push_notification)) {
                    $postlink = get_option('pnfpb_ic_fcm_ondemand_schedule_pn_url'.$scheduled_day_push_notification);
                }
				
				$notification_table_name = $wpdb->prefix . 'pnfpb_ic_schedule_push_notifications';
				
				$notifications = $wpdb->get_results("SELECT * FROM {$notification_table_name} WHERE `id` = {$notification_id} ");
				
				foreach ( $notifications as $notification ){
					
					$onetime_push_title = $notification->title;
					$onetime_push_content = $notification->content;
					$onetime_push_imageurl = $notification->image_url;
					$onetime_push_clickurl = $notification->click_url;
					$onetime_push_time = date('Y/m/d H:i:s',$notification->scheduled_timestamp);
					$onetime_push_status = $notification->status;
					
				}				
				
				if (get_option('pnfpb_onesignal_push') === '1') {
						
					$response = $this->PNFPB_icfcm_onesignal_push_notification(0,stripslashes(strip_tags($onetime_push_title)),stripslashes(strip_tags($onetime_push_content)),$onetime_push_clickurl,$onetime_push_imageurl);
							
				} else {				
				
					if (count($regid) > 0) {
						
						if (get_option('pnfpb_httpv1_push') === '1') {
							$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			stripslashes(strip_tags($onetime_push_title)),
																			stripslashes(strip_tags($onetime_push_content)),
																			$onetime_push_imageurl,
																			$onetime_push_imageurl,
																			$onetime_push_clickurl,
																			array(),
																			$regid,
																			array(),
																			0,
																			0
																			);
						}
						else 
						{
							$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			stripslashes(strip_tags($onetime_push_title)),
																			stripslashes(strip_tags($onetime_push_content)),
																			$onetime_push_imageurl,
																			$onetime_push_imageurl,
																			$onetime_push_clickurl,
																		 	array(),
																		 	$regid,
																			array(),
																		 	0,
																	     	0																					 
																			);
						}
						
					}
					
																									 				
					if (count($deviceidswebview) > 0) {
						
						$this->PNFPB_icfcm_legacy_send_push_notification(0,
																		stripslashes(strip_tags($onetime_push_title)),
																		stripslashes(strip_tags($onetime_push_content)),
																		$onetime_push_imageurl,
																		$onetime_push_imageurl,
																		$onetime_push_clickurl,
																		array('click_url' => $postlink),
																		array(),
																		$deviceidswebview,
																		0,
																	    0																					 
																		);						
					
					}
				}
			}
			
			
			$table = $table = $wpdb->prefix.'pnfpb_ic_schedule_push_notifications';

		
			if ($occurence === 'recurring') {
				
				
				$recurring_status = $selected_recurring_status;
				
				try {
					
				
					$future_action_id = ActionScheduler::store()->query_action( [
    					'hook'   => 'PNFPB_ondemand_schedule_push_notification_hook',
						'date' => $scheduled_day_push_notification,
						'date_compare' => '=',
						'status' => array( ActionScheduler_Store::STATUS_RUNNING, ActionScheduler_Store::STATUS_PENDING ),
					] );
					
					if ( !$future_action_id ) {
						
						$datetime = new DateTime();
						$datetime->setTimestamp($scheduled_day_push_notification);
						$datetime->setTimezone(new DateTimeZone(wp_timezone_string()));	
    					$recurring_status = __('Finished on ','PNFPB_TD').$datetime->format('Y-m-d H:i:s');
						
					} else {
						
							$action         = ActionScheduler::store()->fetch_action( $future_action_id );
							$scheduled_date = $action->get_schedule()->get_date();
							$scheduled_date->setTimezone(new DateTimeZone(wp_timezone_string()));
							if ( $scheduled_date ) {
								$recurring_status = '<br/>'.$selected_recurring_status;
							} elseif ( null === $scheduled_date ) { // pending async action with NullSchedule.
								error_log('null');
							}
						
					}
					
				} catch ( Exception $e ) {
					error_log(serialize($e));
				}
				
				$datetime = new DateTime();
				$datetime->setTimestamp($scheduled_day_push_notification);
				$datetime->setTimezone(new DateTimeZone(wp_timezone_string()));				
				$current_run_timestamp = strtotime($datetime->format('Y-m-d H:i:s'));
				$onetime_push_update_status = $wpdb->query("UPDATE {$table} SET scheduled_timestamp = {$current_run_timestamp},status = '{$recurring_status}' WHERE id = {$notification_id}") ;
				
			}
			else {
				
				$future_action_id = ActionScheduler::store()->query_action( [
    					'hook'   => 'PNFPB_ondemand_schedule_push_notification_hook',
						'date' => $scheduled_day_push_notification,
						'date_compare' => '=',
						'status' => array( ActionScheduler_Store::STATUS_RUNNING, ActionScheduler_Store::STATUS_PENDING ),
				] );
				
				$datetime = new DateTime();
				$datetime->setTimestamp($scheduled_day_push_notification);
				$datetime->setTimezone(new DateTimeZone(wp_timezone_string()));				
				$recurring_status = __('Finished on '.$datetime->format('Y/m/d H:i:s'),'PNFPB_TD');
				$onetime_push_update_status = $wpdb->query("UPDATE {$table} SET status = '{$recurring_status}' WHERE id = {$notification_id}");
				
			}
	
		}
		
		/**
		* Create push notification settings page under admin area to enter FireBase configuartion
		*
		* @since 1.0.0
		*/
		public function PNFPB_icfcm_admin_page()
		{
			include(plugin_dir_path(__FILE__) . 'admin/pnfpb_admin_ic_push_notification.php');
		}
		

		/**
		* Create push notification settings page under admin area to enter FireBase configuartion
		*
		* @since 1.0.0
		*/
		public function PNFPB_icfcm_old_admin_page()
		{
			?>
			<div class="pnfpb-center-box"><a href="admin.php?page=pnfpb-icfcm-slug"><h2 class="pnfpb_ic_push_settings_header"><?php echo __("From release 1.58 onwards, PNFPB settings page moved to new location as separate admin menu. click here for PNFPB plugin settings menu",'PNFPB_TD');?></h2></a>
			<a href="admin.php?page=pnfpb-push-notification-menu" class="pnfpb_column_full"><button class="pnfpb_post_type_content_button" type="button">			
				<?php echo __("Push notification",'PNFPB_TD');?></button></a><a href="admin.php?page=pnfpb_icfm_device_tokens_list" class="pnfpb_column_full"><button class="pnfpb_post_type_content_button" type="button"><?php echo __(PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER,'PNFPB_TD');?></button></a><a href="admin.php?page=pnfpb_icfm_pwa_app_settings" class="pnfpb_column_full"><button class="pnfpb_post_type_content_button" type="button"><?php echo __(PNFPB_PLUGIN_NM_PWA_HEADER,'PNFPB_TD');?></button></a><a href="admin.php?page=pnfpb_icfmtest_notification" class="pnfpb_column_full"><button class="pnfpb_post_type_content_button" type="button"><?php echo __(PNFPB_PLUGIN_NM_ONDEMANDPUSH_HEADER,'PNFPB_TD');?></button></a><a href="admin.php?page=pnfpb_icfm_frontend_settings" class="pnfpb_column_full"><button class="pnfpb_post_type_content_button" type="button"><?php echo __(PNFPB_PLUGIN_NM_FRONTEND_SETTINGS_HEADER,'PNFPB_TD');?></button></a><a href="admin.php?page=pnfpb_icfm_button_settings" class="pnfpb_column_full"><button class="pnfpb_post_type_content_button" type="button"><?php echo __(PNFPB_PLUGIN_NM_BUTTON_HEADER,'PNFPB_TD');?></button></a><a href="admin.php?page=pnfpb_icfm_integrate_app" class="pnfpb_column_full"><button class="pnfpb_post_type_content_button" type="button"><?php echo __(PNFPB_PLUGIN_API_MOBILE_APP_HEADER,'PNFPB_TD');?></button></a><a href="admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="pnfpb_column_full"><button class="pnfpb_post_type_content_button" type="button"><?php echo __(PNFPB_PLUGIN_NGINX_HEADER,'PNFPB_TD');?></button></a><a href="admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1" class="pnfpb_column_full"><button class="pnfpb_post_type_content_button" type="button"><?php echo __(PNFPB_PLUGIN_SCHEDULE_ACTIONS,'PNFPB_TD');?></button></a>
			</div>
			<?php
		}
		
		/**
		* Action scheduler list
		*
		*
		* @since 1.50.0
		*/
		public function PNFPB_icfcm_action_scheduler() {
			?>
				<h1 class="pnfpb_ic_push_settings_header"><?php echo __("PNFPB - Action scheduler",'PNFPB_TD');?></h1>
				<div class="pnfpb_admin_top_menu">
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb-icfcm-slug" class="tab"><?php echo __("Push Settings",'PNFPB_TD');?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_device_tokens_list" class="tab"><?php echo __("Device tokens",'PNFPB_TD');?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_pwa_app_settings" class="tab "><?php echo __("PWA",'PNFPB_TD');?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfmtest_notification" class="tab "><?php echo __("One time push",'PNFPB_TD');?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc" class="tab"><?php echo __("Notifications",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_frontend_settings" class="tab"><?php echo __("Frontend settings",'PNFPB_TD');?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_button_settings" class="tab "><?php echo __("Customize buttons",'PNFPB_TD');?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_integrate_app" class="tab "><?php echo __("Mobile app",'PNFPB_TD');?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="tab "><?php echo __("NGINX",'PNFPB_TD');?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1" class="tab active"><?php echo __("Action Scheduler",'PNFPB_TD');?></a>
				</div>
				<div class="pnfpb_column_1200">
					<p>
						<?php echo __( 'Action Scheduler library is also used by other plugins, like WPForms and WooCommerce, so you might see tasks that are not related to our plugin in the table below.', 'PNFPB_TD' ); ?>
					</p>
					<?php
					if ( class_exists( 'ActionScheduler_AdminView' )) {
						ActionScheduler_AdminView::instance()->render_admin_ui();
					}
					?>
				</div>
			<?php
		} 		
		
		
		/**
		* Admin page to list and manage device tokens - set screen options
		*
		* @since 1.19
		*/		
		public static function PNFPB_set_screen( $status, $option, $value ) {
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
			<h1 class="pnfpb_ic_push_settings_header"><?php echo __("PNFPB - Device tokens list",'PNFPB_TD');?></h1>
			<div class="pnfpb_admin_top_menu">
				<a href="<?php echo admin_url();?>admin.php?page=pnfpb-icfcm-slug" class="tab"><?php echo __("Push Settings",'PNFPB_TD');?></a>
				<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_device_tokens_list" class="tab active"><?php echo __("Device tokens",'PNFPB_TD');?></a>
				<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_pwa_app_settings" class="tab "><?php echo __("PWA",'PNFPB_TD');?></a>
				<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfmtest_notification" class="tab "><?php echo __("One time push",'PNFPB_TD');?></a>
				<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc" class="tab"><?php echo __("Notifications",PNFPB_TD);?></a>
				<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_frontend_settings" class="tab"><?php echo __("Frontend settings",'PNFPB_TD');?></a>
				<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_button_settings" class="tab "><?php echo __("Customize buttons",'PNFPB_TD');?></a>
				<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_integrate_app" class="tab "><?php echo __("Mobile app",'PNFPB_TD');?></a>
				<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="tab "><?php echo __("NGINX",'PNFPB_TD');?></a>
				<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1" class="tab "><?php echo __("Action Scheduler",'PNFPB_TD');?></a>
			</div>
			<div class="pnfpb_column_1200">
				<div class="wrap">
					<div class="pnfpb_row">
  						<div class="pnfpb_column_400">					
							<h2><?php echo __("List of device tokens registered for push notification",'PNFPB_TD');?></h2>
						</div>
					</div>
					<div class="pnfpb_row">
  						<div class="pnfpb_column_400">
							<p>
								<b>
									<?php echo __('(Do not delete tokens unneccessarily it will result in user will not receive push notification, unless it is needed, avoid deleting tokens )');?>
								</b>
							</p>
						</div>
					</div>
					<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
    					<?php settings_fields( 'pnfpb_icfcm_token'); ?>
    					<?php do_settings_sections( 'pnfpb_icfcm_token' ); ?>					
						<div class="pnfpb_row">
  							<div class="pnfpb_column_400">
    							<div class="pnfpb_card">
									<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_token_delete_without_user_timeschedule_enable">
										<?php echo __("Schedule automatic delete tokens with userid no longer exist",'PNFPB_TD');?>
									</label>
									<label class="pnfpb_switch">
										<input  id="pnfpb_ic_fcm_token_delete_without_user_enable" name="pnfpb_ic_fcm_token_delete_without_user_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_token_delete_without_user_enable' ) ); ?>  />
										<span class="pnfpb_slider round"></span>
									</label>
								</div>
							</div>
  							<div class="pnfpb_column_400">
    							<div class="pnfpb_card">
									<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_token_delete_without_useridtoken_enable">
										<?php echo __("Schedule automatic delete tokens without userid (userid=0)",'PNFPB_TD');?>
									</label>
									<label class="pnfpb_switch">
										<input  id="pnfpb_ic_fcm_token_delete_without_useridtoken_enable" name="pnfpb_ic_fcm_token_delete_without_useridtoken_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_token_delete_without_useridtoken_enable' ) ); ?>  />
										<span class="pnfpb_slider round"></span>
									</label>
								</div>
							</div>							
						</div>
						<div class="pnfpb_row">
  							<div class="pnfpb_column_400">
    							<div class="pnfpb_card">
									<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container"><?php echo __("Twicedaily",'PNFPB_TD');?>
										<input name="pnfpb_ic_fcm_token_delete_without_user_timeschedule_enable" type="radio" value="twicedaily" <?php checked( 'twicedaily', get_option( 'pnfpb_ic_fcm_token_delete_without_user_timeschedule_enable' ) ); ?>  />
										<span class="pnfpb_checkmark"></span>
									</label>
									<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container"><?php echo __("Daily",'PNFPB_TD');?>
										<input name="pnfpb_ic_fcm_token_delete_without_user_timeschedule_enable" type="radio" value="daily" <?php checked( 'daily', get_option( 'pnfpb_ic_fcm_token_delete_without_user_timeschedule_enable' ) ); ?>  />
										<span class="pnfpb_checkmark"></span>
									</label>
									<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
										<?php echo __("Weekly",'PNFPB_TD');?>
										<input name="pnfpb_ic_fcm_token_delete_without_user_timeschedule_enable" type="radio" value="weekly" <?php checked( 'weekly', get_option( 'pnfpb_ic_fcm_token_delete_without_user_timeschedule_enable' ) ); ?>  />
										<span class="pnfpb_checkmark"></span>
									</label>
								</div>
							</div>
							<div class="pnfpb_column_400">
								<?php submit_button(__('Save changes','PNFPB_TD'),''); ?>
							</div>
						</div>
					</form>
					<div id="poststuff">
						<div id="post-body" class="metabox-holder columns-2">
						<div id="post-body-content">
							<div class="meta-box-sortables ui-sortable">
								<form method="post">
									<?php
										if( isset( $_REQUEST ["s"]) ){
											$this->devicetokens_obj->prepare_items( $_REQUEST ["s"]);
										}
										else 
										{
											$this->devicetokens_obj->prepare_items();
										}
										$this->devicetokens_obj->pnfpb_url_scheme_start();
										$this->devicetokens_obj->search_box('Search', 'pnfpb_device_token_search');
										$this->devicetokens_obj->display();
										$this->devicetokens_obj->pnfpb_url_scheme_stop(); 
									?>
								</form>
							</div>
						</div>
						</div>
						<br class="clear">
					</div>
				</div>
			</div>
		<?php
			
		}
		
		/**
		* Admin page to list and manage device tokens - Screen options
		* @since 1.64
		*/
		public function PNFPB_push_notifications_list_screen_option() {

			$option = 'per_page';
			$args   = [
				'label'   => 'Push notifications list',
				'default' => 20,
				'option'  => 'records_per_page'
			];

			add_screen_option( $option, $args );

			$this->pushnotifications_obj = new PNFPB_ICFM_onetime_push_notifications_List();
		}
		

		/**
		*
		* Initialize Action scheduler
		*
		*/
		public function PNFPB_action_scheduler_screen_option() {
			
			if ( class_exists( 'ActionScheduler_AdminView' )) {
				ActionScheduler_AdminView::instance()->process_admin_ui();
			}
			
		}

		/**
		* Admin page to list and manage device tokens - Screen options
		* @since 1.19
		*/
		public function PNFPB_screen_option() {

			$option = 'per_page';
			$args   = [
				'label'   => 'Device tokens',
				'default' => 20,
				'option'  => 'records_per_page'
			];

			add_screen_option( $option, $args );

			$this->devicetokens_obj = new PNFPB_ICFM_Device_tokens_List();
		}
		
		/**
		 * To customize Subscription/unsubscribe buttons
		 * @since 1.29
		 * 
		*/
		public function PNFPB_icfcm_button_settings()
		{
			include(plugin_dir_path(__FILE__) . 'admin/pnfpb_admin_button_customization.php');
		}
		
		/**
		 * To customize Subscription/unsubscribe buttons
		 * for front-end
		 * @since 1.52
		 * 
		*/
		public function PNFPB_icfcm_frontend_settings()
		{
			include(plugin_dir_path(__FILE__) . 'admin/pnfpb_admin_front_end_notification_settings.php');
		}		
		/**
		 * Generate PWA app with offline facility
		 * @since 1.20
		 * 
		*/
		public function PNFPB_icfcm_pwa_app_settings()
		{
			include(plugin_dir_path(__FILE__) . 'admin/pnfpb_admin_pwa_app_settings.php');
		}
 
		/**
		* Store push notification settings from admin area settings
		*
		* @since 1.0.0
		*/
		public function PNFPB_settings()
		{    //register our settings
			register_setting('pnfpb_icfcm_group', 'pnfpb_ic_fcm_google_api');
			register_setting('pnfpb_icfcm_group', 'pnfpb_ic_fcm_api');
			register_setting('pnfpb_icfcm_group', 'pnfpb_ic_fcm_authdomain');
			register_setting('pnfpb_icfcm_group', 'pnfpb_ic_fcm_databaseurl');
			register_setting('pnfpb_icfcm_group', 'pnfpb_ic_fcm_projectid');
			register_setting('pnfpb_icfcm_group', 'pnfpb_ic_fcm_storagebucket');
			register_setting('pnfpb_icfcm_group', 'pnfpb_ic_fcm_messagingsenderid');
			register_setting('pnfpb_icfcm_group', 'pnfpb_ic_fcm_appid');
			register_setting('pnfpb_icfcm_group', 'pnfpb_ic_fcm_publickey');
			register_setting('pnfpb_icfcm_group', 'pnfpb_ic_fcm_activity_title');
			register_setting('pnfpb_icfcm_group', 'pnfpb_ic_fcm_activity_message');
			register_setting('pnfpb_icfcm_group', 'pnfpb_ic_fcm_group_activity_title');
			register_setting('pnfpb_icfcm_group', 'pnfpb_ic_fcm_group_activity_message');
			register_setting('pnfpb_icfcm_group', 'pnfpb_ic_fcm_comment_activity_title');
			register_setting('pnfpb_icfcm_group', 'pnfpb_ic_fcm_comment_activity_message');
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_upload_icon");
			register_setting("pnfpb_icfcm_group", "pnfpb_onesignal_push");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_prompt_style");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_prompt_on_off");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_prompt_style3");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_update_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_update_text_color");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_update_background_color");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_update_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_list_background_color");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_list_text_color");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_list_checkbox_color");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_update_confirmation_message");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_all_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_post_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_activity_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_all_comments_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_my_comments_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_private_messsage_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_new_member_joined_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_friendship_request_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_friendship_accepted_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_avatar_change_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_cover_image_change_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_group_details_update_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_subscription_option_group_invite_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_custom_prompt_animation");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_custom_prompt_header_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_custom_prompt_show_again_days");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_custom_prompt_allow_button_text_color");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_custom_prompt_allow_button_background");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_custom_prompt_allow_button_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_custom_prompt_cancel_button_text_color");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_custom_prompt_cancel_button_background");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_custom_prompt_cancel_button_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_custom_prompt_close_button_text_color");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_custom_prompt_close_button_background");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_custom_prompt_close_button_text");		
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_prompt_enable");			
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_prompt_text");			
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_prompt_confirm_button");			
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_prompt_cancel_button");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_prompt_button_background");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_prompt_dialog_background");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_prompt_text_color");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_prompt_button_text_color");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_prompt_position");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_custom_prompt_popup_wait_message");
			register_setting("pnfpb_icfcm_group", "pnfpb_custom_prompt_options_on_off");
			register_setting("pnfpb_icfcm_group", "pnfpb_bell_icon_prompt_options_on_off");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_loggedin_notify");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_post_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_post_title");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypress_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_bcomment_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_bactivity_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_bprivatemessage_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_bprivatemessage_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_bprivatemessage_content");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_new_member_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_new_member_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_new_member_content");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_friendship_request_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_friendship_request_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_friendship_request_content");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_friendship_accept_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_friendship_accept_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_friendship_accept_content");			
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_avatar_change_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_avatar_change_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_avatar_change_content");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_cover_image_change_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_cover_image_change_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_cover_image_change_content");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_group_invitation_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypress_group_invitation_text_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypress_group_invitation_content_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_group_details_updated_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypress_group_details_updated_text_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypress_group_details_updated_content_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_contact_form7_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypress_contact_form7_text_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypress_contact_form7_content_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_new_user_registration_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypress_new_user_registration_text_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypress_new_user_registration_content_enable");			
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_post_schedule_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_post_schedule_background_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_post_timeschedule_seconds");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypressactivities_schedule_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypressactivities_schedule_background_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypress_followers_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypresscomments_schedule_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypress_comments_radio_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypresscomments_schedule_background_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_popup_subscribe_button_icon");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_popup_subscribe_button_text_color");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_popup_subscribe_button_color");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_popup_subscribe_button");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_popup_unsubscribe_button");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_popup_header_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_popup_subscribe_message");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_popup_unsubscribe_message");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_popup_wait_message");				
				
			register_setting("pnfpb_icfcm_group","pnfpb_httpv1_push");
			
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_enable");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_name");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_shortname");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_theme_color");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_backgroundcolor");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_display");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_fcm_pwa_upload_icon_132");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_fcm_pwa_upload_icon_512");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_offline_url1");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_offline_url2");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_offline_url3");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_offline_url4");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_offline_url5");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_excludeallurls");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_excludeurls");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_custom_prompt_enable");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_desktop_custom_prompt_enable");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_mobile_custom_prompt_enable");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_pixels_custom_prompt_enable");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_prompt_install_button_text");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_prompt_header_text");				
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_prompt_description");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_prompt_install_button_color");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_prompt_install_text_color");
			register_setting("pnfpb_icfcm_pwa", "pnfpb-pwa-dialog-app-installed_text");
			register_setting("pnfpb_icfcm_pwa", "pnfpb-pwa-dialog-app-installed_description");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_fcm_pwa_prompt_confirm_button");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_fcm_pwa_prompt_cancel_button");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_fcm_pwa_prompt_button_background");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_fcm_pwa_prompt_dialog_background");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_fcm_pwa_prompt_text_color");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_fcm_pwa_prompt_button_text_color");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_fcm_pwa_prompt_text");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_fcm_pwa_show_again_days");
			
			register_setting("pnfpb_icfcm_nginx", "pnfpb_ic_nginx_static_files_enable");
			
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_button_color");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_button_text_color");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_button_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_subscribe_group_push_notification_icon");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_unsubscribe_button_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_unsubscribe_group_push_notification_icon");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_subscribe_group_push_notification_icon_enable");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_group_subscribe_dialog_text");			
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_group_unsubscribe_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm");			
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_unsubscribe_button_shortcode_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_button_shortcode_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_save_button_text_shortcode");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_shortcode_close_button_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text");			
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_all_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_post_activity_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_all_comments_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_my_comments_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_private_message_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_new_member_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_friend_request_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_friendship_accepted_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_user_avatar_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_cover_image_change_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_unsubscribe_all_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_dialog_text_confirm");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_unsubscribe_dialog_text_confirm");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_install_pwa_shortcode_button_color");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_install_pwa_shortcode_button_text_color");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_install_pwa_shortcode_button_text");
			
			register_setting("pnfpb_icfcm_frontend_buttons", "pnfpb_ic_fcm_frontend_enable_subscription");
			register_setting("pnfpb_icfcm_frontend_buttons", "pnfpb_ic_fcm_frontend_settings_post_text");
			register_setting("pnfpb_icfcm_frontend_buttons", "pnfpb_ic_fcm_frontend_settings_activities_text");
			register_setting("pnfpb_icfcm_frontend_buttons", "pnfpb_ic_fcm_frontend_settings_comments_text");
			register_setting("pnfpb_icfcm_frontend_buttons", "pnfpb_ic_fcm_frontend_settings_mycomments_text");
			register_setting("pnfpb_icfcm_frontend_buttons", "pnfpb_ic_fcm_frontend_settings_privatemessage_text");
			register_setting("pnfpb_icfcm_frontend_buttons", "pnfpb_ic_fcm_frontend_settings_newmember_text");
			register_setting("pnfpb_icfcm_frontend_buttons", "pnfpb_ic_fcm_frontend_settings_friend_request_text");
			register_setting("pnfpb_icfcm_frontend_buttons", "pnfpb_ic_fcm_frontend_settings_friend_accept_text");
			register_setting("pnfpb_icfcm_frontend_buttons", "pnfpb_ic_fcm_frontend_settings_avatar_change_text");
			register_setting("pnfpb_icfcm_frontend_buttons", "pnfpb_ic_fcm_frontend_settings_coverimage_change_text");
			register_setting("pnfpb_icfcm_frontend_buttons", "pnfpb_ic_fcm_frontend_settings_groupinvite_text");
			register_setting("pnfpb_icfcm_frontend_buttons", "pnfpb_ic_fcm_frontend_settings_groupdetails_text");
			
			register_setting("pnfpb_icfcm_token", "pnfpb_ic_fcm_token_delete_without_user_enable");
			register_setting("pnfpb_icfcm_token", "pnfpb_ic_fcm_token_delete_without_useridtoken_enable");
			
			register_setting(
				"pnfpb_icfcm_token", 
				"pnfpb_ic_fcm_token_delete_without_user_timeschedule_enable",
            	array('type' => 'string',
            			'sanitize_callback' => array( $this, "pnfpb_ic_fcm_token_delete_without_user_timeschedule_enable_callback" ),							 
					)
			);
			
			register_setting(
				"pnfpb_icfcm_group", 
				"pnfpb_ic_fcm_post_timeschedule_enable",
            	array('type' => 'string',
            			'sanitize_callback' => array( $this, "pnfpb_ic_fcm_post_timeschedule_callback" ),							 
					)
			);
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypressactivities_schedule_enable");
			register_setting(
				"pnfpb_icfcm_group", 
				"pnfpb_ic_fcm_buddypressactivities_timeschedule_enable",
            	array('type' => 'string',
            			'sanitize_callback' => array( $this, "pnfpb_ic_fcm_buddypressactivities_timeschedule_callback" ),							 
					)
			);						 
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypresscomments_schedule_enable");
			register_setting(
				"pnfpb_icfcm_group", 
				"pnfpb_ic_fcm_buddypresscomments_timeschedule_enable",
            	array('type' => 'string',
            			'sanitize_callback' => array( $this, "pnfpb_ic_fcm_buddypresscomments_timeschedule_callback" ),							 
					)
			);			
		
			$args = array(
				'public'   => true,
				'_builtin' => false
			); 
	
			$output = 'names'; // or objects
			$operator = 'and'; // 'and' or 'or'
			$custposttypes = get_post_types( $args, $output, $operator );
	    
			foreach ( $custposttypes as $post_type ) {
				$fieldname = "pnfpb_ic_fcm_".$post_type."_enable";
				register_setting("pnfpb_icfcm_group", $fieldname);
				register_setting("pnfpb_icfcm_group","pnfpb_ic_fcm_".$post_type."_title");
			}
			
			
		}
		
		public function pnfpb_ic_fcm_token_delete_without_user_timeschedule_enable_callback($posted_options) {
			
			if( $_POST['submit'] == 'Save changes' ) {
				
				if ((get_option('pnfpb_ic_fcm_token_delete_without_user_enable') && get_option('pnfpb_ic_fcm_token_delete_without_user_enable')) == 1
				    || (get_option('pnfpb_ic_fcm_token_delete_without_useridtoken_enable') && get_option('pnfpb_ic_fcm_token_delete_without_useridtoken_enable') == 1)) 					{
					
					if ( !wp_next_scheduled( 'PNFPB_cron_token_delete_user_not_exist_hook' ) ) {
    					wp_schedule_event( time(), $posted_options, 'PNFPB_cron_token_delete_user_not_exist_hook' );
					}
					else 
					{
						$timestamp = wp_next_scheduled( 'PNFPB_cron_token_delete_user_not_exist_hook' );
						wp_unschedule_event( $timestamp, 'PNFPB_cron_token_delete_user_not_exist_hook' );
						wp_schedule_event( time(), $posted_options, 'PNFPB_cron_token_delete_user_not_exist_hook' );
					}
				}
				else 
				{
						$timestamp = wp_next_scheduled( 'PNFPB_cron_token_delete_user_not_exist_hook' );
						wp_unschedule_event( $timestamp, 'PNFPB_cron_token_delete_user_not_exist_hook' );
			
				}
			}
			return $posted_options;
		}
		
		public function pnfpb_ic_fcm_post_timeschedule_callback($posted_options){
			
			if( $_POST['submit'] == 'Save changes' ) {
		
				if ((get_option('pnfpb_ic_fcm_post_schedule_enable') && get_option('pnfpb_ic_fcm_post_schedule_enable') == 1) || ( get_option('pnfpb_ic_fcm_post_schedule_background_enable') && get_option('pnfpb_ic_fcm_post_schedule_background_enable') == 1) && 
(get_option('pnfpb_ic_fcm_post_timeschedule_enable') == 'weekly' || get_option('pnfpb_ic_fcm_post_timeschedule_enable') == 'twicedaily' || get_option('pnfpb_ic_fcm_post_timeschedule_enable') == 'daily' || get_option('pnfpb_ic_fcm_post_timeschedule_enable') == 'hourly' ||					
					(get_option('pnfpb_ic_fcm_post_timeschedule_enable') == 'seconds' && get_option('pnfpb_ic_fcm_post_timeschedule_seconds') > 59))) {
					
					$timeseconds = '3600';
					if ($posted_options === 'weekly') {
						$timeseconds = '604800';
					}
					if ($posted_options === 'twicedaily') {
						$timeseconds = '43200';
					}
					if ($posted_options === 'daily') {
						$timeseconds = '86400';
					}
					if ($posted_options === 'hourly') {
						$timeseconds = '3600';
					}
					if ($posted_options === 'seconds') {
						$timeseconds = get_option('pnfpb_ic_fcm_post_timeschedule_seconds');
					}
					
					$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+'.$timeseconds.' seconds', strtotime("now"))));
					
			 		if ( false === as_has_scheduled_action( 'PNFPB_cron_post_hook' ) ) {
						as_schedule_recurring_action( $new_time, $timeseconds, 'PNFPB_cron_post_hook', array(), 'pnfpb_post', true );    				
					}
					else 
					{

						if ( wp_next_scheduled( 'PNFPB_cron_post_hook' ) ) {
							$timestamp = wp_next_scheduled( 'PNFPB_cron_post_hook' );
							wp_unschedule_event( $timestamp, 'PNFPB_cron_post_hook' );
						}
						as_unschedule_all_actions( 'PNFPB_cron_post_hook', array(), '' );
						delete_option('pnfpb_ic_fcm_new_post_id');
						delete_option('pnfpb_ic_fcm_new_post_title');
						delete_option('pnfpb_ic_fcm_new_post_content');
						delete_option('pnfpb_ic_fcm_new_post_link');
						delete_option('pnfpb_ic_fcm_new_post_type');
						delete_option('pnfpb_ic_fcm_new_post_author');						
						as_schedule_recurring_action( $new_time, $timeseconds, 'PNFPB_cron_post_hook', array(), 'pnfpb_post', true );										
					}
				}
				else 
				{
 					if (as_has_scheduled_action( 'PNFPB_cron_post_hook' ) ) {
						if ( wp_next_scheduled( 'PNFPB_cron_post_hook' ) ) {
							$timestamp = wp_next_scheduled( 'PNFPB_cron_post_hook' );
							wp_unschedule_event( $timestamp, 'PNFPB_cron_post_hook' );
						}
						as_unschedule_all_actions( 'PNFPB_cron_post_hook', array(), 'pnfpb_post' );
						delete_option('pnfpb_ic_fcm_new_post_id');
						delete_option('pnfpb_ic_fcm_new_post_title');
						delete_option('pnfpb_ic_fcm_new_post_content');
						delete_option('pnfpb_ic_fcm_new_post_link');
						delete_option('pnfpb_ic_fcm_new_post_type');
						delete_option('pnfpb_ic_fcm_new_post_author');						
					}
				}
			}
			return $posted_options;
			
		}
		
		public function pnfpb_ic_fcm_buddypressactivities_timeschedule_callback($posted_options){
			
			if( $_POST['submit'] == 'Save changes' ) {
				
				if ((get_option('pnfpb_ic_fcm_buddypressactivities_schedule_enable') && get_option('pnfpb_ic_fcm_buddypressactivities_schedule_enable') == 1) || ( get_option('pnfpb_ic_fcm_buddypressactivities_schedule_background_enable') && get_option('pnfpb_ic_fcm_buddypressactivities_schedule_background_enable') == 1) && 
(get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_enable') == 'weekly' || get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_enable') == 'twicedaily' || get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_enable') == 'daily' || get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_enable') == 'hourly' ||					
					(get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_enable') == 'seconds' && get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds') > 59))) {
					
					$timeseconds = 3600;
					if ($posted_options == 'weekly') {
						$timeseconds = 604800;
					}
					if ($posted_options == 'twicedaily') {
						$timeseconds = 43200;
					}
					if ($posted_options == 'daily') {
						$timeseconds = 86400;
					}
					if ($posted_options == 'hourly') {
						$timeseconds = 3600;
					}
					if ($posted_options == 'seconds') {
						$timeseconds = get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds');
					}
			
					$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+'.$timeseconds.' seconds', strtotime("now"))));
									
			 		if ( false === as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ) &&  get_option('pnfpb_ic_fcm_buddypress_enable') == 1 ) {
						as_schedule_recurring_action( $new_time, $timeseconds, 'PNFPB_cron_buddypressactivities_hook', array(), 'pnfpb_buddypressactivities', true );
						if ( wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
							$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' );
							wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressgroupactivities_hook' );
						}
 						if (as_has_scheduled_action( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
							as_unschedule_all_actions( 'PNFPB_cron_buddypressgroupactivities_hook', array(), 'pnfpb_buddypressgroupactivities' );
							delete_option('pnfpb_ic_fcm_new_buddypressactivities_content');
							delete_option('pnfpb_ic_fcm_new_buddypressactivities_userid');
							delete_option('pnfpb_ic_fcm_new_buddypressactivities_link');
							delete_option('pnfpb_ic_fcm_new_buddypressactivities_image');				
							delete_option('pnfpb_ic_fcm_new_buddypressgroup_link');
							delete_option('pnfpb_ic_fcm_new_buddypressgroup_id');
							delete_option('pnfpb_ic_fcm_new_buddypressgroup_userid');							
						}						
						
					}
					else 
					{
						if (get_option('pnfpb_ic_fcm_buddypress_enable') == 1 ) {
							if ( wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
								$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' );
								wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressgroupactivities_hook' );
							}
							if ( wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' ) ) {
								$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' );
								wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressactivities_hook' );
							}							
							as_unschedule_all_actions( 'PNFPB_cron_buddypressactivities_hook', array(), '' );
							as_schedule_recurring_action( $new_time, $timeseconds, 'PNFPB_cron_buddypressactivities_hook', array(), 'pnfpb_buddypressactivities', true );
							if (as_has_scheduled_action( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
								as_unschedule_all_actions( 'PNFPB_cron_buddypressgroupactivities_hook', array(), 'pnfpb_buddypressgroupactivities' );
								delete_option('pnfpb_ic_fcm_new_buddypressactivities_content');
								delete_option('pnfpb_ic_fcm_new_buddypressactivities_userid');
								delete_option('pnfpb_ic_fcm_new_buddypressactivities_link');
								delete_option('pnfpb_ic_fcm_new_buddypressactivities_image');				
								delete_option('pnfpb_ic_fcm_new_buddypressgroup_link');
								delete_option('pnfpb_ic_fcm_new_buddypressgroup_id');
								delete_option('pnfpb_ic_fcm_new_buddypressgroup_userid');								
							}							
							
						}

					}
									
					if ( false === as_has_scheduled_action( 'PNFPB_cron_buddypressgroupactivities_hook' ) && get_option('pnfpb_ic_fcm_buddypress_enable') == 2  ) {
						
						$timeseconds = 3600;
						if ($posted_options == 'weekly') {
							$timeseconds = 604800;
						}
						if ($posted_options == 'twicedaily') {
							$timeseconds = 43200;
						}
						if ($posted_options == 'daily') {
							$timeseconds = 86400;
						}
						if ($posted_options == 'hourly') {
							$timeseconds = 3600;
						}
						if ($posted_options == 'seconds') {
							$timeseconds = get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds');
						}
			
						$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+'.$timeseconds.' seconds', strtotime("now"))));
						
						if ( wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
							$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' );
							wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressgroupactivities_hook' );
						}
						if ( wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' ) ) {
							$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' );
							wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressactivities_hook' );
						}						
						
						as_schedule_recurring_action( $new_time, $timeseconds, 'PNFPB_cron_buddypressgroupactivities_hook', array(), 'pnfpb_buddypressgroupactivities', true );
 						if (as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ) ) {
							as_unschedule_all_actions( 'PNFPB_cron_buddypressactivities_hook', array(), 'pnfpb_buddypressactivities' );
							delete_option('pnfpb_ic_fcm_new_buddypressactivities_content');
							delete_option('pnfpb_ic_fcm_new_buddypressactivities_userid');
							delete_option('pnfpb_ic_fcm_new_buddypressactivities_link');
							delete_option('pnfpb_ic_fcm_new_buddypressactivities_image');				
							delete_option('pnfpb_ic_fcm_new_buddypressgroup_link');
							delete_option('pnfpb_ic_fcm_new_buddypressgroup_id');
							delete_option('pnfpb_ic_fcm_new_buddypressgroup_userid');							
							
						}						
					}
					else 
					{
						if (get_option('pnfpb_ic_fcm_buddypress_enable') == 2 ) {
							if ( wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
								$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' );
								wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressgroupactivities_hook' );
							}
							if ( wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' ) ) {
								$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' );
								wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressactivities_hook' );
							}							
							as_unschedule_all_actions( 'PNFPB_cron_buddypressgroupactivities_hook', array(), '' );
							$timeseconds = 3600;
							if ($posted_options == 'weekly') {
								$timeseconds = 604800;
							}
							if ($posted_options == 'twicedaily') {
								$timeseconds = 43200;
							}
							if ($posted_options == 'daily') {
								$timeseconds = 86400;
							}
							if ($posted_options == 'hourly') {
								$timeseconds = 3600;
							}
							if ($posted_options == 'seconds') {
								$timeseconds = get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds');
							}
			
							$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+'.$timeseconds.' seconds', strtotime("now"))));
							if ( wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
								$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' );
								wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressgroupactivities_hook' );
							}
							if ( wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' ) ) {
								$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' );
								wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressactivities_hook' );
							}							
							as_schedule_recurring_action( $new_time, $timeseconds, 'PNFPB_cron_buddypressgroupactivities_hook', array(), 'pnfpb_buddypressgroupactivities', true );
 							if (as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ) ) {
								as_unschedule_all_actions( 'PNFPB_cron_buddypressactivities_hook', array(), 'pnfpb_buddypressactivities' );
								delete_option('pnfpb_ic_fcm_new_buddypressactivities_content');
								delete_option('pnfpb_ic_fcm_new_buddypressactivities_userid');
								delete_option('pnfpb_ic_fcm_new_buddypressactivities_link');
								delete_option('pnfpb_ic_fcm_new_buddypressactivities_image');				
								delete_option('pnfpb_ic_fcm_new_buddypressgroup_link');
								delete_option('pnfpb_ic_fcm_new_buddypressgroup_id');
								delete_option('pnfpb_ic_fcm_new_buddypressgroup_userid');								
							}							
						}
						
						
					}					
				}
				else 
				{
 					if (as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ) ) {
						if ( wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
							$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' );
							wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressgroupactivities_hook' );
						}
						if ( wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' ) ) {
							$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' );
								wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressactivities_hook' );
						}						
						as_unschedule_all_actions( 'PNFPB_cron_buddypressactivities_hook', array(), 'pnfpb_buddypressactivities' );
						delete_option('pnfpb_ic_fcm_new_buddypressactivities_content');
						delete_option('pnfpb_ic_fcm_new_buddypressactivities_userid');
						delete_option('pnfpb_ic_fcm_new_buddypressactivities_link');
						delete_option('pnfpb_ic_fcm_new_buddypressactivities_image');				
						delete_option('pnfpb_ic_fcm_new_buddypressgroup_link');
						delete_option('pnfpb_ic_fcm_new_buddypressgroup_id');
						delete_option('pnfpb_ic_fcm_new_buddypressgroup_userid');
					}
					
 					if (as_has_scheduled_action( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
						if ( wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
							$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' );
							wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressgroupactivities_hook' );
						}
						if ( wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' ) ) {
							$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' );
							wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressactivities_hook' );
						}						
						as_unschedule_all_actions( 'PNFPB_cron_buddypressgroupactivities_hook', array(), 'pnfpb_buddypressgroupactivities' );
						delete_option('pnfpb_ic_fcm_new_buddypressactivities_content');
						delete_option('pnfpb_ic_fcm_new_buddypressactivities_userid');
						delete_option('pnfpb_ic_fcm_new_buddypressactivities_link');
						delete_option('pnfpb_ic_fcm_new_buddypressactivities_image');				
						delete_option('pnfpb_ic_fcm_new_buddypressgroup_link');
						delete_option('pnfpb_ic_fcm_new_buddypressgroup_id');
						delete_option('pnfpb_ic_fcm_new_buddypressgroup_userid');						
					}					
				}				
			}
			return $posted_options;
		}
		
		public function pnfpb_ic_fcm_buddypresscomments_timeschedule_callback($posted_options){
			
			if( $_POST['submit'] == 'Save changes' ) {
				
				if ((get_option('pnfpb_ic_fcm_buddypresscomments_schedule_enable') && get_option('pnfpb_ic_fcm_buddypresscomments_schedule_enable') == 1) || (get_option('pnfpb_ic_fcm_buddypresscomments_schedule_background_enable') && get_option('pnfpb_ic_fcm_buddypresscomments_schedule_background_enable') == 1) && 
(get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable') == 'weekly' || get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable') == 'twicedaily' || get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable') == 'daily' || get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable') == 'hourly' ||					
					(get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable') == 'seconds' && get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds') > 59))) {
					
					$timeseconds = 3600;
					if ($posted_options == 'weekly') {
						$timeseconds = 604800;
					}
					if ($posted_options == 'twicedaily') {
						$timeseconds = 43200;
					}
					if ($posted_options == 'daily') {
						$timeseconds = 86400;
					}
					if ($posted_options == 'hourly') {
						$timeseconds = 3600;
					}
					if ($posted_options == 'seconds') {
						$timeseconds = get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds');
					}
									
					$new_time = strtotime(date("Y-m-d H:i:s", strtotime('+'.$timeseconds.' seconds', strtotime("now"))));	
			
			 		if ( false === as_has_scheduled_action( 'PNFPB_cron_comments_post_hook' ) ) {
						as_schedule_recurring_action( $new_time, $timeseconds, 'PNFPB_cron_comments_post_hook', array(), 'pnfpb_postcomments', true );    				
					}
					else 
					{

						if ( wp_next_scheduled( 'PNFPB_cron_comments_post_hook' ) ) {
							$timestamp = wp_next_scheduled( 'PNFPB_cron_comments_post_hook' );
							wp_unschedule_event( $timestamp, 'PNFPB_cron_comments_post_hook' );
						}
						if ( wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' ) ) {
							$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' );
							wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypresscomments_hook' );
						}						
						as_unschedule_all_actions( 'PNFPB_cron_comments_post_hook', array(), '' );
						delete_option('pnfpb_ic_fcm_new_comment_id');
						delete_option('pnfpb_ic_fcm_new_comment_approved');
						delete_option('pnfpb_ic_fcm_new_comments_post_content');
						delete_option('pnfpb_ic_fcm_new_comments_post_link');
						delete_option('pnfpb_ic_fcm_new_comments_post_userid');	
						delete_option('pnfpb_ic_fcm_new_comments_post_authorid');							
						as_schedule_recurring_action( $new_time, $timeseconds, 'PNFPB_cron_comments_post_hook', array(), 'pnfpb_postcomments', true );										
					}
									
			 		if ( false === as_has_scheduled_action( 'PNFPB_cron_buddypresscomments_hook' ) ) {
						as_schedule_recurring_action( $new_time, $timeseconds, 'PNFPB_cron_buddypresscomments_hook', array(), 'pnfpb_buddypresscomments', true );    				
					}
					else 
					{
						
						if ( wp_next_scheduled( 'PNFPB_cron_comments_post_hook' ) ) {
							$timestamp = wp_next_scheduled( 'PNFPB_cron_comments_post_hook' );
							wp_unschedule_event( $timestamp, 'PNFPB_cron_comments_post_hook' );
						}
						if ( wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' ) ) {
							$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' );
							wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypresscomments_hook' );
						}						

						as_unschedule_all_actions( 'PNFPB_cron_buddypresscomments_hook', array(), '' );
						delete_option('pnfpb_ic_fcm_new_buddypresscomments_content');
						delete_option('pnfpb_ic_fcm_new_buddypresscomments_link');
						delete_option('pnfpb_ic_fcm_new_buddypresscomments_postuserid');
						delete_option('pnfpb_ic_fcm_new_buddypresscomments_activityuserid');
						delete_option('pnfpb_ic_fcm_new_buddypresscomments_authoractivityuserid');								
						as_schedule_recurring_action( $new_time, $timeseconds, 'PNFPB_cron_buddypresscomments_hook', array(), 'pnfpb_buddypresscomments', true );										
					}									
				}
				else 
				{
 					if (as_has_scheduled_action( 'PNFPB_cron_buddypresscomments_hook' ) ) {
						if ( wp_next_scheduled( 'PNFPB_cron_comments_post_hook' ) ) {
							$timestamp = wp_next_scheduled( 'PNFPB_cron_comments_post_hook' );
							wp_unschedule_event( $timestamp, 'PNFPB_cron_comments_post_hook' );
						}
						if ( wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' ) ) {
							$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' );
							wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypresscomments_hook' );
						}						
						as_unschedule_all_actions( 'PNFPB_cron_buddypresscomments_hook', array(), 'pnfpb_buddypresscomments' );
						delete_option('pnfpb_ic_fcm_new_buddypresscomments_content');
						delete_option('pnfpb_ic_fcm_new_buddypresscomments_link');
						delete_option('pnfpb_ic_fcm_new_buddypresscomments_postuserid');
						delete_option('pnfpb_ic_fcm_new_buddypresscomments_activityuserid');
						delete_option('pnfpb_ic_fcm_new_buddypresscomments_authoractivityuserid');						
						
					}
					
 					if (as_has_scheduled_action( 'PNFPB_cron_comments_post_hook' ) ) {
						if ( wp_next_scheduled( 'PNFPB_cron_comments_post_hook' ) ) {
							$timestamp = wp_next_scheduled( 'PNFPB_cron_comments_post_hook' );
							wp_unschedule_event( $timestamp, 'PNFPB_cron_comments_post_hook' );
						}
						if ( wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' ) ) {
							$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' );
							wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypresscomments_hook' );
						}						
						as_unschedule_all_actions( 'PNFPB_cron_comments_post_hook', array(), 'pnfpb_postcomments' );
						delete_option('pnfpb_ic_fcm_new_comment_id');
						delete_option('pnfpb_ic_fcm_new_comment_approved');
						delete_option('pnfpb_ic_fcm_new_comments_post_content');
						delete_option('pnfpb_ic_fcm_new_comments_post_link');
						delete_option('pnfpb_ic_fcm_new_comments_post_userid');	
						delete_option('pnfpb_ic_fcm_new_comments_post_authorid');							
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
			add_action( 'admin_enqueue_scripts', function( $hook )
    		{
        		/** @var \WP_Screen $screen */
        		$screen = get_current_screen();

        		if ( 'settings_page_pnfpb-icfcm-slug' == $screen->base || 'settings_page_pnfpb_icfm_pwa_app_settings' == $screen->base || 'settings_page_pnfpb_icfmtest_notification'  == $screen->base || 'pnfpb-push-notification_page_pnfpb_icfmtest_notification' == $screen->base || 'pnfpb-push-notification_page_pnfpb-icfcm-slug' == $screen->base || 'pnfpb-push-notification_page_pnfpb_icfm_pwa_app_settings' == $screen->base || 'toplevel_page_pnfpb-icfcm-slug' == $screen->base || 'pnfpb-push-notification_page_pnfpb_icfm_button_settings' == $screen->base ) {
            		wp_enqueue_media();
        		} else return;
    		} );
			$ajaxobject = 'pnfpb_ajax_object_pwa_upload_icon';
			$filename = '/admin/js/pnfpb_ic_upload_icon.js';
			wp_register_script('pnfpb_ic_upload_icon_script',plugins_url( $filename, __FILE__ ), array('jquery','wp-i18n'), '1.77.1', true);
			wp_enqueue_script('pnfpb_ic_upload_icon_script');
			$filename = '/admin/js/pnfpb_ic_pwa_upload_icon.js';
			wp_register_script('pnfpb_ic_pwa_upload_icon_script',plugins_url( $filename, __FILE__ ), array('jquery','wp-i18n'), '1.77.111', true);
			wp_localize_script('pnfpb_ic_pwa_upload_icon_script',$ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
			wp_enqueue_script('pnfpb_ic_pwa_upload_icon_script');
			$filename = '/admin/js/pnfpb_ic_ondemand_push_upload_image.js';
			wp_register_script('pnfpb_ic_ondemand_push_upload_image_script',plugins_url( $filename, __FILE__ ), array('jquery','wp-i18n'), '1.77.111', true);
			wp_enqueue_script('pnfpb_ic_ondemand_push_upload_image_script');				
		}   


		/**
		* Create service worker file on fly(dynamically) which is needed for push notification using FCM
		*
		* @since 1.0.0
		*/
		public function PNFPB_icpush_sw_file_create() {
			
			if (get_option("pnfpb_onesignal_push") !== '1') {

			if (get_option( 'pnfpb_ic_disable_serviceworker_pwa_pushnotification' ) != '1') {
			
				include(plugin_dir_path(__FILE__) . 'public/service_worker/pnfpb_create_sw_file.php');
			}
			
			if (get_option( 'pnfpb_ic_nginx_static_files_enable' ) === '1') {

				global $wp_filesystem;
	
				if ( empty( $wp_filesystem ) ) {
				
					require_once( trailingslashit( ABSPATH ) . 'wp-admin/includes/file.php' );
					WP_Filesystem();
				}
	
				$sw_content = PNFPB_icfm_icpush_sw_template();	
	
				$swresponse 		= wp_remote_head( home_url( '/' ). 'pnfpb_icpush_pwa_sw.js', array( 'sslverify' => false ) );
				$swresponse_code 	= wp_remote_retrieve_response_code( $swresponse );

	
				if ( 200 !== $swresponse_code ) {
				
					$createfileresult = $wp_filesystem->put_contents( trailingslashit( get_home_path() ) . 'pnfpb_icpush_pwa_sw.js',$sw_content, 0644);

				}
			
				$firebase_sw_contents = PNFPB_icfm_icpush_firebasesw_template();	
				$firebase_swresponse 		= wp_remote_head( home_url( '/' ). 'firebase-messaging-sw.js', array( 'sslverify' => false ) );
				
				$firebase_swresponse_code 	= wp_remote_retrieve_response_code( $firebase_swresponse );

	
				if ( 200 !== $firebase_swresponse_code ) {
				
					$createfileresult = $wp_filesystem->put_contents( trailingslashit( get_home_path() ) . 'firebase-messaging-sw.js',$firebase_sw_contents, 0644);

				}
			
				if (get_option('pnfpb_ic_pwa_app_enable') === '1' && get_option( 'pnfpb_ic_disable_serviceworker_pwa_pushnotification' ) != '1') {
			
					$pwa_manifest_contents = PNFPB_ic_generate_pwa_manifest_json();	
	
					$pwa_manifest_response 		= wp_remote_head( home_url( '/' ). 'pnfpbmanifest.json', array( 'sslverify' => false ) );
					
					$pwa_manifest_response_code 	= wp_remote_retrieve_response_code( $pwa_manifest_response );
				
					if ( 200 !== $pwa_manifest_response_code ) {
				
						$createfileresult = $wp_filesystem->put_contents( trailingslashit( get_home_path() ) . 'pnfpbmanifest.json',$pwa_manifest_contents, 0644);

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
        	add_meta_box('PNFPB_send_notification_html',
                 'PNFPB Push Notifications',
				 array($this, 'PNFPB_send_notification_html'),
                 'post',
                 'side',
                 'high');

        	// Then add meta box for all other post types that are public but not built in to WordPress
        	$args = array(
      		'public' => true,
      		'_builtin' => false,
    		);
		
        	$output = 'names';
        	$operator = 'and';
        	$post_types = get_post_types($args, $output, $operator);
		
        	foreach ($post_types  as $post_type) {
            	add_meta_box(
        			'PNFPB_send_notification_html',
        			'PNFPB Push Notifications',
       				 array($this, 'PNFPB_send_notification_html'),
        				$post_type,
        				'side',
        				'high'
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
			
        	$post_type = $post->post_type;
			
			$pnfpb_post_meta_send_push_notification = get_post_meta( $post->ID, 'pnfpb_push_notification_send_checkbox', true );
			

        	?>

	    	<input type="hidden" name="pnfpb_send_notification_meta_box" value="true"></input>

      		<div id="pnfpb_push_notification_send_layout">
				
        		<label>
					<?php if (get_option('pnfpb_ic_fcm_'.$post_type.'_enable') === '1' && $post->post_status !== 'publish') { ?>
						<input type="checkbox" id="pnfpb_push_notification_send_checkbox" name="pnfpb_push_notification_send_checkbox" value="1" checked>
						</input>				
					<?php } else { ?>
          				<input type="checkbox" id="pnfpb_push_notification_send_checkbox" name="pnfpb_push_notification_send_checkbox" value="1" <?php checked( '1', get_post_meta( $post->ID, 'pnfpb_push_notification_send_checkbox', true ) ); ?> >
						</input>
					<?php } ?>
				
          			<?php if ($post->post_status === 'publish') {
              			echo esc_attr('Send notification on '.$post_type.' update');
          			} else {
              			echo esc_attr('Send notification on '.$post_type.' publish');
         			} ?>
				
        		</label>

      		</div>

			<?php
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
		public function PNFPB_on_post_save_web($post_id=null, $post=null, $update=null) {
			
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    			return $post->ID;
			}
			
			$screen = get_current_screen();
			
			
			if ( isset( $_POST['pnfpb_push_notification_send_checkbox'] ) && $post_id ) {
				
				update_post_meta( $post_id, 'pnfpb_push_notification_send_checkbox', $_POST['pnfpb_push_notification_send_checkbox'] );
				
			}
			else {
				
				update_post_meta( $post_id, 'pnfpb_push_notification_send_checkbox', '' );
			}
			
			if (!wp_next_scheduled( 'PNFPB_cron_post_hook' ) && (false === as_has_scheduled_action( 'PNFPB_cron_post_hook' )))
			{
				$from = get_bloginfo('name');
				
				$post_type = $post->post_type;
				
				$post_meta_box_push_notification = get_post_meta( $post->ID, 'pnfpb_push_notification_send_checkbox', true);

				if(get_option('pnfpb_ic_fcm_'.$post_type.'_enable') || (isset( $_POST['pnfpb_push_notification_send_checkbox'] ) && $_POST['pnfpb_push_notification_send_checkbox'] === '1') || $post_meta_box_push_notification === '1') {
					
					$postlink = get_permalink($post->ID);
					
					//new post/page
					if (isset($post->post_status)) {

						if ($post->post_status == 'publish') {
							
							if (isset($_POST['pnfpb_push_notification_send_checkbox'])) {
								update_post_meta( $post->ID, 'pnfpb_push_notification_send_checkbox', $_POST['pnfpb_push_notification_send_checkbox'] );
								
							}
						
                       	 	if ((isset($screen) && $screen->base == "post" && isset( $_POST['pnfpb_push_notification_send_checkbox'] ) && $_POST['pnfpb_push_notification_send_checkbox'] === '1') || (isset($screen) && $screen->base == "post" && $post_meta_box_push_notification === '1') || ((!isset($screen) || !isset($screen->base)) && get_option('pnfpb_ic_fcm_'.$post_type.'_enable'))) {
								
								$this->PNFPB_icforum_push_notifications_post_web($post->post_title,$post->post_content,$postlink,$post->ID,$post);
								
                        	}
                       
						}

					}
				}
			}
			else
			{
				// update latest post title,content,link in the option to send push notification later as per scheduled time
				if ($post !== null)
				{
					update_option('pnfpb_ic_fcm_new_post_id',$post->ID);
					update_option('pnfpb_ic_fcm_new_post_title',$post->post_title);
					update_option('pnfpb_ic_fcm_new_post_content',$post->post_content);
					update_option('pnfpb_ic_fcm_new_post_link',get_permalink($post->ID));
					update_option('pnfpb_ic_fcm_new_post_type',$post->post_type);
					update_option('pnfpb_ic_fcm_new_post_author',$post->post_author);
					$imageurl = '';
				
					if ( has_post_thumbnail($post->ID) ) {
						$imageurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
						update_option('pnfpb_ic_fcm_new_post_image',$imageurl);
					}
					else 
					{
					
						preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($post->post_content), $imgresult);
				
						if (is_array($imgresult)) {
							if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
								$imageurl = str_replace('"','',$imgresult[2][0]);
								update_option('pnfpb_ic_fcm_new_post_image',$imageurl);
							}
							else 
							{
								update_option('pnfpb_ic_fcm_new_post_image','');
							}
						}					
					}				
				
				
				}
			}

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
		public function PNFPB_icforum_push_notifications_post_web ($post_title=null,$post_content=null, $postlink=null,$postid=null,$post=null) {

			global $wpdb;
			$imageurl = '';
			
			if ($post_title === null || wp_next_scheduled( 'PNFPB_cron_post_hook' )
			   || (as_has_scheduled_action( 'PNFPB_cron_post_hook' ))){
				
				$post_type_meta_key = 'pnfpb_push_notification_send_checkbox';
				
				
				$post_title = "[member name] posted new post in ".get_bloginfo( 'name' );
				$post_content = "New content in ".get_bloginfo( 'name' );
				$postlink = get_home_url();
				$authorid = null;
				
				
				$recent_posts = wp_get_recent_posts(array(
					'numberposts' => 1, // Number of recent posts thumbnails to display
					'post_status' => 'publish', // Show only the published posts
					'meta_key'	  => $post_type_meta_key,
					'meta_value' => '1',
					'post_type'	=> 'post'
				));
				
				foreach( $recent_posts as $post_item ) {
					// if it is called from scheduled hook for post cron schedule
					$postid = $post_item['ID'];
					$post_title = $post_item['post_title'];
					$post_content = substr(stripslashes(strip_tags(urldecode($post_item['post_content']))),0,130);
					$postlink = get_permalink($post_item['ID']);
					$authorid = $post_item['post_author'];
				}
	
			}

			if ( has_post_thumbnail($postid) ) {
				$imageurl = wp_get_attachment_url( get_post_thumbnail_id($postid), 'thumbnail' ); 
			}
			else 
			{
				preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($post_content), $imgresult);
				
				if (is_array($imgresult)) {
					if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
						$imageurl = str_replace('"','',$imgresult[2][0]);
					}
				}					
			}
				

			$apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
			
			if ((($apiaccesskey != '' && $apiaccesskey != false) || (get_option( 'pnfpb_onesignal_push' ) === '1')) && get_permalink( $postid ) && get_permalink( $postid ) != '') {
	
			    $table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
				
				
				if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
					$deviceids_count = $wpdb->get_results("SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)");
				}
				else 
				{
					if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
						
						$deviceids_count = $wpdb->get_results("SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%'");
						
					} else {
						
						$deviceids_count = $wpdb->get_results("SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%'");
						
					}
				}
				
				if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
						
					$deviceids_webview_count = $wpdb->get_results("SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)");
						
				} else {				
					$deviceids_webview_count = $wpdb->get_results("SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)");
				}
				
			    	$activity_content_push = substr(stripslashes(strip_tags(urldecode($post_content))),0,130);

			    	$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
					
					$pnfbp_post_type = 'post';
					if (isset($post)) {
						$pnfbp_post_type = $post->post_type;
					}
					else {
						if (get_option("pnfpb_ic_fcm_new_post_type") && get_option("pnfpb_ic_fcm_new_post_type") != '') {
							$pnfbp_post_type = get_option("pnfpb_ic_fcm_new_post_type");
						}
					}
					
					$sender_name =  '';
					
					if (isset($post) && $post !== null) {
						$authorid = $post->post_author;
						$sender_name = get_the_author_meta( 'display_name', $authorid );
					}
					else {						
						if ($authorid) {
							$sender_name = get_the_author_meta( 'display_name', $authorid );							
						}
					}					
					
					if (get_option("pnfpb_ic_fcm_".$pnfbp_post_type."_title") && get_option("pnfpb_ic_fcm_".$pnfbp_post_type."_title") != '') {
						$post_title = get_option("pnfpb_ic_fcm_".$pnfbp_post_type."_title");

						$post_title = str_replace("[member name]", $sender_name, $post_title);

					}
					else 
					{
						if ($post_title === null || $post_title == '') {
							$post_title = __("New post from ",'PNFPB_TD').get_bloginfo( 'name' );
						}
					}
				
				
					$activity_content_push = str_replace("[member name]", $sender_name, $activity_content_push);
				
					if (get_option('pnfpb_onesignal_push') === '1') {
						
						$target_userid_array = array();
						
						$target_group_userid_array = array();
						
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE device_id LIKE '%onesignal%' LIMIT 2000" );
							$target_userid_array = array_map(function ($value) {
    							return $value == 1 ? '1pnfpbadm' : $value;
							}, $target_userid_array_values);
							$target_group_userid_array = $target_userid_array;
						} else {
							$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE device_id LIKE '%onesignal%' LIMIT 2000" );
							$target_group_userid_array = array_map(function ($value) {
    							return $value == 1 ? '1pnfpbadm' : $value;
							}, $target_userid_array_values);							
						}
						
						
						
						
						if (($pnfbp_post_type === 'forum' || $pnfbp_post_type === 'reply' || $pnfbp_post_type === 'topic' ) && function_exists('bb_is_member_subscribed_group') && function_exists( 'bbp_is_group_forums_active' ) && function_exists( 'bp_group_is_forum_enabled' )  && bbp_is_group_forums_active() ) {
							
							
							$bb_target_userid_array = array();
							
							$forum_id = null;
							$post_id = intval($postid);

							if ( 'reply' === $pnfbp_post_type ) {
								$topic_id = $post->post_parent;
								$forum_id = bbp_get_topic_forum_id( $topic_id );

							} else {
								if ( 'topic' === $pnfbp_post_type) {
									$topic_id = $post->post_parent;
									$forum_id = bbp_get_topic_forum_id( $topic_id );

								}
							}

							
							$group_ids = get_post_meta( $forum_id, '_bbp_group_ids', true );
							
							
							// Make sure result is an array.
							if ( ! is_array( $group_ids ) ) {
								$group_ids = (array) $group_ids;
							}

							// Trim out any empty array items.
							$group_ids = array_filter( $group_ids );
							
							
							for($ig = 0; $ig < count($group_ids); $ig++) {
								
								$bbp_bp_group_id = $group_ids[$ig];
								
						
								for($i = 0; $i < count($target_group_userid_array); $i++) {
									
						
									if ( bb_is_member_subscribed_group($bbp_bp_group_id, $target_group_userid_array[$i] )) {
								
										array_push($bb_target_userid_array,$target_group_userid_array[$i]);
									}
									
								}
								
							
								$response = $this->PNFPB_icfcm_onesignal_push_notification($postid,$post_title,$activity_content_push,$postlink,$imageurl,$bb_target_userid_array);	
								
							}
						
						} else {
							
						
							$response = $this->PNFPB_icfcm_onesignal_push_notification($postid,$post_title,$activity_content_push,$postlink,$imageurl,$target_userid_array);
							
						}
							
					} else {
						
						$target_group_userid_array = $wpdb->get_col( "SELECT userid FROM {$table_name} WHERE device_id NOT LIKE '%onesignal%' LIMIT 2000");
						//error_log('serialize($target_group_userid_array)');
						//error_log(serialize($target_group_userid_array));
				
						for ($dcount=0; $dcount<=count($deviceids_count); $dcount+=1000) {
							
							$bb_target_userid_array = array();
							
							$deviceids = array();
							
							$deviceidswebview = array();
							
							$buddyboss_pnfpb = false;
							
							if (($pnfbp_post_type === 'forum' || $pnfbp_post_type === 'reply' || $pnfbp_post_type === 'topic' ) && function_exists('bb_is_member_subscribed_group') && function_exists( 'bbp_is_group_forums_active' ) && function_exists( 'bp_group_is_forum_enabled' )  && bbp_is_group_forums_active() ) {
							
								$buddyboss_pnfpb = true;
								$bb_target_userid_array = array();
							
								$forum_id = null;
								$post_id = intval($postid);

								if ( 'reply' === $pnfbp_post_type ) {
									$topic_id = $post->post_parent;
									$forum_id = bbp_get_topic_forum_id( $topic_id );

								} else {
									if ( 'topic' === $pnfbp_post_type) {
										$topic_id = $post->post_parent;
										$forum_id = bbp_get_topic_forum_id( $topic_id );

									}
								}

							
								$group_ids = get_post_meta( $forum_id, '_bbp_group_ids', true );
							
							
								// Make sure result is an array.
								if ( ! is_array( $group_ids ) ) {
									$group_ids = (array) $group_ids;
								}

								// Trim out any empty array items.
								$group_ids = array_filter( $group_ids );
							
							
								for($ig = 0; $ig < count($group_ids); $ig++) {
								
									$bbp_bp_group_id = $group_ids[$ig];
								
						
									for($i = 0; $i < count($target_group_userid_array); $i++) {
									
						
										if ( bb_is_member_subscribed_group($bbp_bp_group_id, $target_group_userid_array[$i] )) {
											
											
								
											array_push($bb_target_userid_array,$target_group_userid_array[$i]);
										}
									
									}
								
						
								}
								
							}
							//error_log('serialize($bb_target_userid_array)');
							//error_log(serialize($bb_target_userid_array));
								if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
									
									
									
									if(count($bb_target_userid_array) > 0) {
										
										$bb_target_userid_implArray = implode(",",$bb_target_userid_array);
										
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%!!%' AND userid IN ($bb_target_userid_implArray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );										
										
									} else {
										
										if (!$buddyboss_pnfpb) {
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
										}
										
									}
									
								}
								else
								{
									if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
									
										
										
										if(count($bb_target_userid_array) > 0) {
											
											$bb_target_userid_implArray = implode(",",$bb_target_userid_array);
											
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND userid IN ($bb_target_userid_implArray) LIMIT {$dcount}, 1000" );
											
										}
										else {
											if (!$buddyboss_pnfpb) {
												$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' LIMIT {$dcount}, 1000" );
											}
										}
									
									} else {
									
										
										
										if(count($bb_target_userid_array) > 0) {
											
											$bb_target_userid_implArray = implode(",",$bb_target_userid_array);
											
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND userid IN ($bb_target_userid_implArray) LIMIT {$dcount}, 1000" );
											
										} else {
											if (!$buddyboss_pnfpb) {
												$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' LIMIT {$dcount}, 1000" );
											}
										}
									
									}
								}
							
							//error_log('serialize($deviceids)');
							//error_log($buddyboss_pnfpb);
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								
								

								if(count($bb_target_userid_array) > 0) {
									
									$bb_target_userid_implArray = implode(",",$bb_target_userid_array);
									
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND userid IN ($bb_target_userid_implArray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );									

								} else { 
									if (!$buddyboss_pnfpb) {
										$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
									}
									
								}
								
							} else {
							
								
								
								if(count($bb_target_userid_array) > 0) {
									
									$bb_target_userid_implArray = implode(",",$bb_target_userid_array);
									
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND userid IN ($bb_target_userid_implArray)  AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );									
									
								} else {
									if (!$buddyboss_pnfpb) {
										$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
									}
								}
								
								
							}
							
							//error_log(serialize($deviceidswebview));

			    			$url = 'https://fcm.googleapis.com/fcm/send';

			    			$regid = $deviceids;
							$ownerid = 0;
							$targetid= 0;

							if (count($regid) > 0) {
								if (get_option('pnfpb_httpv1_push') === '1') {
									$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																				 stripslashes(strip_tags($post_title)),
																				 stripslashes(strip_tags($activity_content_push)),
																				 $iconurl,
																				 $imageurl,
																				 $postlink,
																				 array('click_url' => $postlink),
																				 $regid,
																				 $deviceidswebview,
																				 $ownerid,
																			     $targetid
																				);
								}
								else {
									$this->PNFPB_icfcm_legacy_send_push_notification(0,
																				 stripslashes(strip_tags($post_title)),
																				 stripslashes(strip_tags($activity_content_push)),
																				 $iconurl,
																				 $imageurl,
																				 $postlink,
																				 array(),
																				 $regid,
																				 array(),
																				 $ownerid,
																			     $targetid																					 
																				);
								}

						
							do_action('PNFPB_connect_to_external_api_for_post');
						}
				
				
						for ($dcount=0; $dcount<=count($deviceids_webview_count); $dcount+=1000) {
				
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
									
									
									if(count($bb_target_userid_array) > 0) {
										
										$bb_target_userid_implArray = implode(",",$bb_target_userid_array);
										
										$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND userid IN ($bb_target_userid_implArray)  AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );										
									}
									else {
										if (!$buddyboss_pnfpb) {
											$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
										}
										
									}
									
							} else {
								
								
								if(count($bb_target_userid_array) > 0) {
									$bb_target_userid_implArray = implode(",",$bb_target_userid_array);
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND userid IN ($bb_target_userid_implArray)  AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );									
								}
								else {
									if (!$buddyboss_pnfpb) {
										$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
									}
								}
							}
				
							if (count($deviceidswebview) > 0) {				
		    					// prepare the message
								$this->PNFPB_icfcm_legacy_send_push_notification(0,
																				 stripslashes(strip_tags($post_title)),
																				 stripslashes(strip_tags($activity_content_push)),
																				 $iconurl,
																				 $imageurl,
																				 $postlink,
																				 array('click_url' => $postlink),
																				 array(),
																				 $deviceidswebview,
																				 $ownerid,
																			     $targetid																						 
																				);
						
								do_action('PNFPB_connect_to_external_api_for_post_webview');
							}
						}
					}
				}
			}    
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
		public function PNFPB_icforum_push_notifications_web ($activity_content=null, $user_id=null, $activity_id=null) {
			
        
            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
			
			$bactivity = 0;
			
			if (get_option('pnfpb_ic_fcm_bactivity_enable')) {
				$bactivity = get_option('pnfpb_ic_fcm_bactivity_enable');
			}
			else 
			{
				if (false === get_option('pnfpb_ic_fcm_bactivity_enable')) {
					$bactivity = 1;
				}
				else 
				{
					$bactivity = 0;
				}
			}



			if ((( 
				($activity_content && (false === as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ))) || (!$activity_content && (as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ))))) && ($bactivity == 1 && get_option('pnfpb_ic_fcm_buddypress_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false) || ($bactivity == 1 && get_option('pnfpb_ic_fcm_buddypress_enable') == 1 && get_option( 'pnfpb_onesignal_push' ) === '1'))) {

				global $wpdb;
				
				$blog_title = get_bloginfo( 'name' );

				$activitylink = get_home_url();
				if (function_exists('bp_is_active')){
					$activitylink = get_home_url().'/'.buddypress()->pages->activity->slug;
				}
				
				if ($activity_id) {
					
					$activitylink = bp_activity_get_permalink($activity_id);
					
				}
	
				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
				
				if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
					if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
						$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );						
					} else {
						$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
					}
				}
				else 
				{
						
					if (get_option('pnfpb_shortcode_enable') === 'yes') {
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );							
						} else {
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
						}
					}
					else 
					{
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%'" );							
						} else {
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%'" );
						}
					}
				}
				
	
				if ($activity_content) {
					
					$localactivitycontent = $activity_content;
					
				}
				else 
				{
					$cron_get_scheduled_activities = bp_activity_get( $args = array('per_page' => 1,'sort'=> 'DESC') );
					
					foreach ( $cron_get_scheduled_activities['activities'] as $activity ) {
							
						$localactivitycontent = substr(stripslashes(strip_tags(urldecode($activity->content))),0,80);
							
						$activitylink = bp_activity_get_permalink( $activity->id, $activity );
								
						$user_id = $activity->user_id;
					}
				}				
				$imageurl = '';
				
				$activitytitle = '[member name]'.__(' posted new activity in ','PNFPB_TD').$blog_title;
				
				$sender_name = '';
			
				if (get_option('pnfpb_ic_fcm_activity_title') != false && get_option('pnfpb_ic_fcm_activity_title') != '') {
					
					$activitytitle = get_option('pnfpb_ic_fcm_activity_title');
					
				}
				
				if ($user_id !== null) {
					
					$sender_name = bp_core_get_user_displayname( $user_id );
					
					$activitytitle = str_replace("[member name]", $sender_name, $activitytitle);
					
				}				
		
			
				
				if (get_option('pnfpb_ic_fcm_activity_message') != false && get_option('pnfpb_ic_fcm_activity_message') != '') {
					
					if ($activity_content) {
						$localactivitycontent = get_option('pnfpb_ic_fcm_activity_message');
					} else {
						$localactivitycontent .= get_option('pnfpb_ic_fcm_activity_message');
					}
					
				}
				
				if ($localactivitycontent) {
					preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($localactivitycontent), $imgresult);
					
				
					if (is_array($imgresult)) {
						if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
							$imageurl = str_replace('"','',$imgresult[2][0]);
							$imageurl = stripslashes($imageurl);
						}
					}
				}
					
				$localactivitycontent = str_replace("[member name]", $sender_name, $localactivitycontent);
				
				if (get_option('pnfpb_onesignal_push') === '1') {
					
				
					$target_userid = 0;
					
					$target_userid_array = array();
					
					if (($pos = strpos($localactivitycontent, "@")) !== FALSE) {

						
    					$str = stripslashes($localactivitycontent);

    					$DOM = new DOMDocument;
    					$DOM->loadHTML($str);

    					$items = $DOM->getElementsByTagName('span');
    					$span_list = '';
    					for($i = 0; $i < $items->length; $i++) {
        					$item = $items->item($i);

        					if($item->getAttribute('class') == 'atwho-inserted'){
            					$span_list = $item->nodeValue;
								
								$target_username_array = explode('@',$span_list);
								if (count($target_username_array) > 1) {
						
									$target_userid = bp_activity_get_userid_from_mentionname( $target_username_array[1] );
									array_push($target_userid_array,"$target_userid");
								}								
        					}
    					}
			
						
					}
					
					if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1' && ($pos = strpos($localactivitycontent, "@")) === FALSE) {
						$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE device_id LIKE '%onesignal%' LIMIT 2000" );
						$target_userid_array = array_map(function ($value) {
    						return $value == 1 ? '1pnfpbadm' : $value;
						}, $target_userid_array_values);						
					}
					
					if (function_exists('bb_is_member_subscribed_group') && function_exists( 'bp_group_is_forum_enabled' )  && bp_group_is_forum_enabled() ) {
						$bb_target_userid_array = array();
						
						for($i = 0; $i < $target_userid_array->length; $i++) {
							
							if (bb_activity_is_item_favorite($activity_id, 'activity', $target_userid_array[$i])) {

								array_push($bb_target_userid_array,$target_userid_array[$i]);
								
								$response = $this->PNFPB_icfcm_onesignal_push_notification($activity_id,$activitytitle,$localactivitycontent,$activitylink,$imageurl,$bb_target_userid_array);	
								
							}
						
							
						}
						
					} else {
						$response = $this->PNFPB_icfcm_onesignal_push_notification($activity_id,$activitytitle,$localactivitycontent,$activitylink,$imageurl,$target_userid_array);
					}
							
				} else {
					
						$target_userid = 0;
					
						$target_userid_array = array();					
					
						if (($pos = strpos($localactivitycontent, "@")) !== FALSE) {
						
    							$str = stripslashes($localactivitycontent);
							
								$target_username_array = explode('@',$str);

								if (count($target_username_array) > 1) {
						
									$target_userid_array = explode( ' ',$target_username_array[1] );
									
									if (count($target_userid_array) > 0) {
										
										$target_userid = intval(bp_activity_get_userid_from_mentionname($target_userid_array[0]));
										
									}
									
								}
							
								$pushtype = 'privatemessages';
							
								$url = 'https://fcm.googleapis.com/fcm/send';

								$regid = array();
    
								$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');	
							
							
								if (get_option('pnfpb_httpv1_push') === '1'&& $target_userid > 0) {
									
									$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = '{$target_userid}'");
										

									$regid = $deviceids;
									
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND userid = '{$target_userid}'");

									$regidwebview = $deviceidswebview;
									
									$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			stripslashes(strip_tags($activitytitle)),
																			substr(stripslashes(strip_tags(urldecode($localactivitycontent))),0,130),
																			$iconurl,
																			$imageurl,
																			$activitylink,
																			array('click_url' => $activitylink),
																			$regid,
																			$regidwebview,
																			$user_id,
																			$target_userid,
																			$pushtype
																			);
																	
									
									
								}
								else {

									if ($target_userid > 0) {
										
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = '{$target_userid}'");
										

										$regid = $deviceids;
										
									
										$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			stripslashes(strip_tags($activitytitle)),
																			substr(stripslashes(strip_tags(urldecode($localactivitycontent))),0,130),
																			$iconurl,
																			$imageurl,
																			$activitylink,
																			array(),
																			$regid,
																			array(),
																			$user_id,
																			$target_userid,
																			$pushtype
																			);
										
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND userid = '{$target_userid}'");							

										$regid = $deviceids;										
										
										$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			stripslashes(strip_tags($activitytitle)),
																			substr(stripslashes(strip_tags(urldecode($localactivitycontent))),0,130),
																			$iconurl,
																			$imageurl,
																			'',
																			array('click_url' => $activitylink),
																			array(),
																			$regid,
																			$user_id,
																			$target_userid,
																			$pushtype
																			);										
									}
							}
							
						} else {					
				
							for ($dcount=0; $dcount<=count($deviceids_count); $dcount+=1000) {
				
								if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
									
									if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );										
									} else {
					
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
									}
								}
								else 
								{
									if (get_option('pnfpb_shortcode_enable') === 'yes') {
										if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );											
										} else {
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
										}
									}
									else
									{
										if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' LIMIT {$dcount}, 1000" );											
										} else {
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' LIMIT {$dcount}, 1000" );
										}
									}
								}
								
								$regid = $deviceids;
    
								$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
            
								$blog_title = get_bloginfo( 'name' );
								
								if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						
									if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
										$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );										
									} else {
										$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
									}
						
								}
								else {
									if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
										$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' LIMIT {$dcount}, 1000" );										
									} else {
										$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' LIMIT {$dcount}, 1000" );
									}
						
								}								
				

								if (function_exists('bp_follow_get_followers') && ((get_option( 'pnfpb_ic_fcm_buddypress_followers_enable') && get_option( 'pnfpb_ic_fcm_buddypress_followers_enable')  === '1'))) {
										
									$bp_follow_get_followers_array = bp_follow_get_followers($user_id);
									
									$bp_follow_get_followers_implarray = implode(",",$bp_follow_get_followers_array);
										
									$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%!!%' AND userid IN ($bp_follow_get_followers_implarray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
									
									$regid = $deviceids;
									
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND userid IN ($bp_follow_get_followers_implarray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );									
										
								}								
								
								if (count($regid) > 0) {


		    						// prepare the message
		    						$targetid = 0;
									if (get_option('pnfpb_httpv1_push') === '1') {
											$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			stripslashes(strip_tags($activitytitle)),
																			substr(stripslashes(strip_tags(urldecode($localactivitycontent))),0,130),
																			$iconurl,
																			$imageurl,
																			$activitylink,
																			array(),
																			$regid,
																			$deviceidswebview,
																			$user_id,
																			$targetid																						 
																			);
									}
									else {			    				
										$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			stripslashes(strip_tags($activitytitle)),
																			substr(stripslashes(strip_tags(urldecode($localactivitycontent))),0,130),
																			$iconurl,
																			$imageurl,
																			$activitylink,
																			array(),
																			$regid,
																			array(),
																			$user_id,
																			$targetid																				
																			);
								}

								do_action('PNFPB_connect_to_external_api_for_activity');
							}
						}
					}
				
					$isWebView = false;				
				
			
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );							
						} else {
							$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
						}
					
					}
					else {
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' " );
						} else {
							$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' " );
						}
					}
				
					if (count($deviceids_webview_count) > 0) {
						$isWebView = true;
					}				
				
					for ($dcount=0; $dcount<=count($deviceids_webview_count); $dcount+=1000) {
					
						if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
							
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );								
							} else {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
							}
						
						}
						else {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' LIMIT {$dcount}, 1000" );								
							} else {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' LIMIT {$dcount}, 1000" );
							}
						
						}
						
						if (function_exists('bp_follow_get_followers') && ((get_option( 'pnfpb_ic_fcm_buddypress_followers_enable') && get_option( 'pnfpb_ic_fcm_buddypress_followers_enable')  === '1'))) {
										
							$bp_follow_get_followers_array = bp_follow_get_followers($user_id);
									
							$bp_follow_get_followers_implarray = implode(",",$bp_follow_get_followers_array);
													
							$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND userid IN ($bp_follow_get_followers_implarray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );									
										
						}
						
						if ($isWebView) 
						{
							// prepare the message
							$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			stripslashes(strip_tags($activitytitle)),
																			stripslashes(strip_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			"",
																			array('click_url' => $activitylink),
																			array(),
																			$deviceidswebview,
																			$user_id,
																			$targetid																					 
																			);
							
							do_action('PNFPB_connect_to_external_api_for_activity_webview');
							
						}
					}
				}
	
			}
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
		public function PNFPB_icforum_push_notifications_web_group ($content=null, $user_id=null, $group_id=null, $activity_id=null, $sendschedule='no') {
		    
            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
			
			$bactivity = 0;
			
			$blog_title = get_bloginfo( 'name' );
			
			if (get_option('pnfpb_ic_fcm_bactivity_enable')) {
				$bactivity = get_option('pnfpb_ic_fcm_bactivity_enable');
			}
			else 
			{
				if (false === get_option('pnfpb_ic_fcm_bactivity_enable')) {
					$bactivity = 1;
				}
				else 
				{
					$bactivity = 0;
				}
			}			
			
			global $wpdb;
        	
			if ((($content && (false === as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' )))
				 || ($content===null && (as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' )))) && ($bactivity == 1 &&  get_option('pnfpb_ic_fcm_buddypress_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false) || ($bactivity == 1 && get_option('pnfpb_ic_fcm_buddypress_enable') == 1 && get_option( 'pnfpb_onesignal_push' ) === '1'))) {
				
				preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($content), $imgresult);
				
				$imageurl = '';
				
				if (is_array($imgresult)) {
					if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
						$imageurl = str_replace('"','',$imgresult[2][0]);
						update_option('pnfpb_ic_fcm_new_buddypressactivities_image',$imageurl);
					}
				}				

				$bpgroup = '';
				$grouplink = get_home_url();
				if (function_exists('bp_is_active')){
					$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;
				}				
				
				if ($group_id && !wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' )) {
					
					$bpgroup = groups_get_group( array( 'group_id' => $group_id) );

					$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;
				}
				
	
				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
				
				if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
					
					if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
						$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );						
					} else {
						$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
					}
					
				}
				else				
				{
					
					if (get_option('pnfpb_shortcode_enable') === 'yes') {
						
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );							
						} else {
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
						}
					
					}
					else 
					{
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1)  FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%'" );							
						} else {
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1)  FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%'" );
						}
					}
				}
				
				if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
					if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
						$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND  device_id  LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );						
					} else {
						$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND  device_id  LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
					}
					
				}
				else {
					if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
						$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND  device_id  LIKE '%!!webview%'" );						
					} else {
						$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND  device_id  LIKE '%!!webview%'" );
					}
				}
				
			
				if ($content) {
					
					$localactivitycontent = $content;
					
				}
				else 
				{
					$cron_get_scheduled_activities = bp_activity_get( $args = array('per_page' => 1,'sort'=> 'DESC','filter' => array('primary_id'   => $group_id)) );
					
					foreach ( $cron_get_scheduled_activities['activities'] as $activity ) {
							
						$localactivitycontent = substr(stripslashes(strip_tags(urldecode($activity->content))),0,80);
							
						$activitylink = bp_activity_get_permalink( $activity->id, $activity );
								
						$user_id = $activity->user_id;
					}
				}				
				$imageurl = '';
				
				$group_name = bp_get_group_name( groups_get_group( $group_id));
				
				$grouptitle = '[member name]'.__(' posted activity in group ','PNFPB_TD').$group_name;
				
				$sender_name = '';
			
				if (get_option('pnfpb_ic_fcm_group_activity_title') != false && get_option('pnfpb_ic_fcm_group_activity_title') != '') {
					
					$grouptitle = get_option('pnfpb_ic_fcm_group_activity_title');
					
				}
				
				if ($user_id !== null) {
					
					$sender_name = bp_core_get_user_displayname( $user_id );
					
					$grouptitle = str_replace("[member name]", $sender_name, $grouptitle);
					
				}
           
				$grouplink = get_home_url();
				if (function_exists('bp_is_active')){
					$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;
				}
				
				if (strpos($content, "[bpfb_images]") !== false) {
    
					$bpfbimagesstart = strpos($localactivitycontent, "[bpfb_images]");
    
					$bpfbimagesend = strrpos($localactivitycontent, "[/bpfb_images]");
    
					$bpfbimagestaglength = ($bpfbimagesend+17) - $bpfbimagesstart;
    
					$localactivitycontent = strip_tags(urldecode(substr_replace($content,"",$bpfbimagesstart,$bpfbimagestaglength)));

				}
				
				if ($content) {
					preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($localactivitycontent), $imgresult);
					$imageurl = '';
				
					if (is_array($imgresult)) {
						if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
							$imageurl = str_replace('"','',$imgresult[2][0]);
						}
					}
				}
				
				
				if (get_option('pnfpb_ic_fcm_group_activity_message') != false && get_option('pnfpb_ic_fcm_group_activity_message') != '') {
					
					if ($content) {
						$localactivitycontent = get_option('pnfpb_ic_fcm_group_activity_message');
					} else {
						$localactivitycontent .= get_option('pnfpb_ic_fcm_group_activity_message');
					}
					
				}	
		
				$localactivitycontent = str_replace("[member name]", $sender_name, $localactivitycontent);

				if (get_option('pnfpb_onesignal_push') === '1') {
					
					$target_userid = 0;
					
					$target_userid_array = array();
					
					if (($pos = strpos($localactivitycontent, "@")) !== FALSE) {
						
    					$str = stripslashes($localactivitycontent);

    					$DOM = new DOMDocument;
    					$DOM->loadHTML($str);

    					$items = $DOM->getElementsByTagName('span');
    					$span_list = '';
    					for($i = 0; $i < $items->length; $i++) {
        					$item = $items->item($i);

        					if($item->getAttribute('class') == 'atwho-inserted'){
            					$span_list = $item->nodeValue;
								
								$target_username_array = explode('@',$span_list);
								if (count($target_username_array) > 1) {
						
									$target_userid = bp_activity_get_userid_from_mentionname( $target_username_array[1] );
									array_push($target_userid_array,"$target_userid");
								}								
        					}
    					}
			
						
					}
					
					if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1' && ($pos = strpos($localactivitycontent, "@")) === FALSE) {
						$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE device_id LIKE '%onesignal%' LIMIT 2000" );
						$target_userid_array = array_map(function ($value) {
    						return $value == 1 ? '1pnfpbadm' : $value;
						}, $target_userid_array_values);						
					}
					
					$response = $this->PNFPB_icfcm_onesignal_push_notification($activity_id,$grouptitle,$localactivitycontent,$grouplink,$imageurl,$target_userid_array);
							
				} else {
					
						$target_userid = 0;
					
						$target_userid_array = array();
					
						if (($pos = strpos($localactivitycontent, "@")) !== FALSE) {
						
    							$str = stripslashes($localactivitycontent);
							
								$target_username_array = explode('@',$str);

								if (count($target_username_array) > 1) {
						
									$target_userid_array = explode( ' ',$target_username_array[1] );
									
									if (count($target_userid_array) > 0) {
										
										$target_userid = intval(bp_activity_get_userid_from_mentionname($target_userid_array[0]));
										
									}
									
								}
								$pushtype = 'privatemessages';
							
								$url = 'https://fcm.googleapis.com/fcm/send';
							

								$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');							
							
								if (get_option('pnfpb_httpv1_push') === '1'&& $target_userid > 0) {
									
									$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = '{$target_userid}'");							

									$regid = $deviceids;
									
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND userid = '{$target_userid}'");							

									$regidwebview = $deviceidswebview;										
									
									$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			stripslashes(strip_tags($grouptitle)),
																			stripslashes(strip_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			$grouplink,
																			array(),
																			$regid,
																			$regidwebview,
																			$user_id,
																			$target_userid,
																			$pushtype
																			);
									
								}
								else {
									
									if ($target_userid > 0) {
										
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = '{$target_userid}'");							

										$regid = $deviceids;										
										
										$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			stripslashes(strip_tags($grouptitle)),
																			stripslashes(strip_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			$grouplink,
																			array(),
																			$regid,
																			array(),
																			$user_id,
																			$target_userid,
																			$pushtype
																			);
										
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND userid = '{$target_userid}'");							

										$regid = $deviceids;										
										
										$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			stripslashes(strip_tags($grouptitle)),
																			stripslashes(strip_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			'',
																			array('click_url' => $grouplink),
																			array(),
																			$regid,
																			$user_id,
																			$target_userid,
																			$pushtype
																			);
										
									}
							}
							
						} else {					
				
							for ($dcount=0; $dcount<=count($deviceids_count); $dcount+=1000) {
				
								if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
									if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
									} else {
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
									}
					
								}
								else				
								{
									if (get_option('pnfpb_shortcode_enable') === 'yes') {
										if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );											
										} else {
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
										}
					
									}						
									else {
										if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1)  FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' LIMIT {$dcount}, 1000" );											
										} else {
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1)  FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' LIMIT {$dcount}, 1000" );
										}
							
									}
								}
								
								if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
									if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
										$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND  device_id  LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );										
									} else {
										$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND  device_id  LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
									}
						
								}
								else {
									if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
										$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND  device_id  LIKE '%!!webview%'  LIMIT {$dcount}, 1000" );										
									} else {
										$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND  device_id  LIKE '%!!webview%'  LIMIT {$dcount}, 1000" );
									}
								}								
				

								$url = 'https://fcm.googleapis.com/fcm/send';

								$regid = $deviceids;
    
								$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
								
								if (function_exists('bp_follow_get_followers') && ((get_option( 'pnfpb_ic_fcm_buddypress_followers_enable') && get_option( 'pnfpb_ic_fcm_buddypress_followers_enable')  === '1'))) {
										
									$bp_follow_get_followers_array = bp_follow_get_followers($user_id);
									
									$bp_follow_get_followers_implarray = implode(",",$bp_follow_get_followers_array);
										
									$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%!!%' AND userid IN ($bp_follow_get_followers_implarray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
									
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND userid IN ($bp_follow_get_followers_implarray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );									
										
								}								
				
    
								if (count($regid) > 0) {
									// prepare the message
									if (get_option('pnfpb_httpv1_push') === '1') {
										$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			stripslashes(strip_tags($grouptitle)),
																			stripslashes(strip_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			$grouplink,
																			array('click_url' => $grouplink),
																			$regid,
																			$deviceidswebview,
																			$user_id,
																			0,
																			'',
																			'no',
																			$group_id
																			);
								

									}
									else {							 
										$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			stripslashes(strip_tags($grouptitle)),
																			stripslashes(strip_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			$grouplink,
																			array(),
																			$regid,
																			array(),
																			$user_id,
																			0,
																			'',
																			'no',
																			$group_id																				 
																			);
								}
								do_action('PNFPB_connect_to_external_api_for_group');
							}
						}
					}
				
					$webview = false;
				
					if (count($deviceids_webview_count) > 0) {
							$webview = true;
					}
				
					for ($dcount=0; $dcount<=count($deviceids_webview_count); $dcount+=1000) {
					
						if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND  device_id  LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );								
							} else {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND  device_id  LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
							}
						
						}
						else {
							
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND  device_id  LIKE '%!!webview%'  LIMIT {$dcount}, 1000" );								
							} else {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND  device_id  LIKE '%!!webview%'  LIMIT {$dcount}, 1000" );
							}
						}
						
						if (function_exists('bp_follow_get_followers') && ((get_option( 'pnfpb_ic_fcm_buddypress_followers_enable') && get_option( 'pnfpb_ic_fcm_buddypress_followers_enable')  === '1'))) {
										
							$bp_follow_get_followers_array = bp_follow_get_followers($user_id);
									
							$bp_follow_get_followers_implarray = implode(",",$bp_follow_get_followers_array);
										
									
							$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND userid IN ($bp_follow_get_followers_implarray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );									
										
						}						
				
						if (count($deviceidswebview) > 0) {
							// prepare the message
							$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			stripslashes(strip_tags($grouptitle)),
																			stripslashes(strip_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			"",
																			array('click_url' => $grouplink),
																			array(),
																			$deviceidswebview,
																			$user_id,
																			0,
																			'',
																			'no',
																			$group_id																			 
																			);
							do_action('PNFPB_connect_to_external_api_for_group_webview');
						}
					}
				}
			}
			else
			{
				
				if ((($content && (false === as_has_scheduled_action( 'PNFPB_cron_buddypressgroupactivities_hook' ))) || ($content===null && (as_has_scheduled_action( 'PNFPB_cron_buddypressgroupactivities_hook' )))) && ($bactivity == 1 && get_option('pnfpb_ic_fcm_buddypress_enable') == 2 && ($apiaccesskey != '' && $apiaccesskey != false) || ($bactivity == 1 && get_option('pnfpb_ic_fcm_buddypress_enable') == 2 && get_option( 'pnfpb_onesignal_push' ) === '1'))) {
					
					preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($content), $imgresult);
				
					$imageurl = '';
				
					if (is_array($imgresult)) {
						if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
							$imageurl = str_replace('"','',$imgresult[2][0]);
							update_option('pnfpb_ic_fcm_new_buddypressactivities_image',$imageurl);
						}
					}					
					
					$bpgroup = '';
					$grouplink = get_home_url();
					if (function_exists('bp_is_active')){
						$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;
					}
					
					$bpgroupid = null;

					if ($group_id) {
	
						$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;

						$bpgroupid = $group_id;
						
					}
					else 
					{
						$bpgroupid = strval(get_option('pnfpb_ic_fcm_new_buddypressgroup_id'));


						$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;
	
					}
	
					$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
					
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );							
						} else {
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
						}
						
					}
					else				
					{

						if (get_option('pnfpb_shortcode_enable') === 'yes') {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );								
							} else {
								$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
							}
						
						}
						else 
						{
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%'" );								
							} else {
								$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%'" );
							}
							
						}
					}
					
					$webview = false;
					
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid >0 AND device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1 OR subscription_option = '' OR subscription_option IS NULL) = '1')" );							
						} else {
							$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1 OR subscription_option = '' OR subscription_option IS NULL) = '1')" );
						}
						
					}
					else {
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%'" );							
						} else {
							$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%'" );
						}
					}
	
	
					if ($content) {
					
						$localactivitycontent = $content;
					
					}
					else 
					{
						$cron_get_scheduled_activities = bp_activity_get( $args = array('per_page' => 1,'sort'=> 'DESC','filter' => array('primary_id'   => $bpgroupid)) );
					
						foreach ( $cron_get_scheduled_activities['activities'] as $activity ) {
							
							$localactivitycontent = substr(stripslashes(strip_tags(urldecode($activity->content))),0,80);
							
							$activitylink = bp_activity_get_permalink( $activity->id, $activity );
								
							$user_id = $activity->user_id;
						}
					}				
					$imageurl = '';
				
					$group_name = bp_get_group_name( groups_get_group( $bpgroupid));
				
					$grouptitle = '[member name]'.__(' posted activity in group ','PNFPB_TD').$group_name;
				
					$sender_name = '';
			
					if (get_option('pnfpb_ic_fcm_group_activity_title') != false && get_option('pnfpb_ic_fcm_group_activity_title') != '') {
					
						$grouptitle = get_option('pnfpb_ic_fcm_group_activity_title');
					
					}
				
					if ($user_id !== null) {
					
						$sender_name = bp_core_get_user_displayname( $user_id );
					
						$grouptitle = str_replace("[member name]", $sender_name, $grouptitle);
						
						$grouptitle = str_replace("[group name]", $group_name, $grouptitle);
					
					}
           
					$grouplink = get_home_url();
					
					if (function_exists('bp_is_active')){
						
						$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;
					}

					
					preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($localactivitycontent), $imgresult);
					
					$imageurl = '';
				
					if (is_array($imgresult)) {
						
						if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
							
							$imageurl = str_replace('"','',$imgresult[2][0]);
							
						}
					}
					
					if (get_option('pnfpb_ic_fcm_group_activity_message') != false && get_option('pnfpb_ic_fcm_group_activity_message') != '') {
					
						if ($content) {
							
							$localactivitycontent = get_option('pnfpb_ic_fcm_group_activity_message');
							
						} else {
							
							$localactivitycontent .= get_option('pnfpb_ic_fcm_group_activity_message');
							
						}
					
					}					
				
					$localactivitycontent = str_replace("[member name]", $sender_name, $localactivitycontent);
					
					$localactivitycontent = str_replace("[group name]", $group_name, $localactivitycontent);
					
					if (get_option('pnfpb_onesignal_push') === '1') {
						
						// Update the users who have favorited this activity.
						// 
						$target_userid = 0;
					
						$target_userid_array = array();
					
						if (($pos = strpos($localactivitycontent, "@")) !== FALSE) {
						
    						$str = stripslashes($localactivitycontent);

    						$DOM = new DOMDocument;
							
    						$DOM->loadHTML($str);

    						$items = $DOM->getElementsByTagName('span');
							
    						$span_list = '';
							
    						for($i = 0; $i < $items->length; $i++) {
								
        						$item = $items->item($i);

        						if($item->getAttribute('class') == 'atwho-inserted'){
									
            						$span_list = $item->nodeValue;
								
									$target_username_array = explode('@',$span_list);
									
									if (count($target_username_array) > 1) {
						
										$target_userid = bp_activity_get_userid_from_mentionname( $target_username_array[1] );
										
										array_push($target_userid_array,"$target_userid");
									}								
        						}
    						}
			
						
						}
						else 
						{

							$target_userid_array = array();
						
							$members = groups_get_group_members(
										array(
											'group_id' => $bpgroupid,
										)
									);

							$members = $members['members'];

							foreach ( $members as $member ) {
								array_push($target_userid_array,$member->ID);
							}
						}
						
						$response = $this->PNFPB_icfcm_onesignal_push_notification($group_id,$grouptitle,$localactivitycontent,$grouplink,$imageurl,$target_userid_array);
							
					} else {
						
						$target_userid = 0;
						
						if (($pos = strpos($localactivitycontent, "@")) !== FALSE) {
						
    							$str = stripslashes($localactivitycontent);
							
								$target_username_array = explode('@',$str);

								if (count($target_username_array) > 1) {
						
									$target_userid_array = explode( ' ',$target_username_array[1] );
									
									if (count($target_userid_array) > 0) {
										
										$target_userid = intval(bp_activity_get_userid_from_mentionname($target_userid_array[0]));
										
									}
									
								}
							
								$pushtype = 'privatemessages';
							
								$url = 'https://fcm.googleapis.com/fcm/send';

								$regid = array();
    
								$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');							
							
								if (get_option('pnfpb_httpv1_push') === '1'&& $target_userid > 0) {
									
									$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!{$bpgroupid}!!%' AND device_id NOT LIKE '%@N%' AND userid = '{$target_userid}'");
										

									$regid = $deviceids;
									
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND device_id NOT LIKE '%@N%' AND userid = '{$target_userid}'");

									$regidwebview = $deviceidswebview;									
									
									$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			stripslashes(strip_tags($grouptitle)),
																			stripslashes(strip_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			$grouplink,
																			array('click_url' => $grouplink),
																			$regid,
																			$regidwebview,
																			$user_id,
																			$target_userid,
																			$pushtype
																			);
								
								}
								else {
									
									if ($target_userid > 0) {
										
									$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND device_id NOT LIKE '%@N%' AND userid = '{$target_userid}'");
										

										$regid = $deviceids;										
										
										$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			stripslashes(strip_tags($grouptitle)),
																			stripslashes(strip_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			$grouplink,
																			array(),
																			$regid,
																			array(),
																			$user_id,
																			$target_userid,
																			$pushtype
																			);
										
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND device_id NOT LIKE '%@N%' AND userid = '{$target_userid}'");
										

										$regid = $deviceids;										
										
										$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			stripslashes(strip_tags($grouptitle)),
																			stripslashes(strip_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			$grouplink,
																			array('click_url' => $grouplink),
																			array(),
																			$regid,
																			$user_id,
																			$target_userid,
																			$pushtype
																			);										
									}
							}
							
						} else {						
					
							for ($dcount=0; $dcount<=count($deviceids_count); $dcount+=1000) {					
					
								if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
									
									if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );										
									} else {
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
									}
						
								}
								else				
								{

									if (get_option('pnfpb_shortcode_enable') === 'yes') {
										if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );											
										} else {
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
										}
						
									}							
									else 
									{
										if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' LIMIT {$dcount}, 100" );											
										} else {
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' LIMIT {$dcount}, 100" );
										}
								
									}
								}
								
								if (function_exists('bp_follow_get_followers') && ((get_option( 'pnfpb_ic_fcm_buddypress_followers_enable') && get_option( 'pnfpb_ic_fcm_buddypress_followers_enable')  === '1'))) {
										
									$bp_follow_get_followers_array = bp_follow_get_followers($user_id);
									
									$bp_follow_get_followers_implarray = implode(",",$bp_follow_get_followers_array);
										
									$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%!!%' AND userid IN ($bp_follow_get_followers_implarray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
									
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND userid IN ($bp_follow_get_followers_implarray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );									
										
								}								
					

								$url = 'https://fcm.googleapis.com/fcm/send';

								$regid = $deviceids;
    
								$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
					
								if (count($regid) > 0) {
									// prepare the message
									if (get_option('pnfpb_httpv1_push') === '1') {
										$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			stripslashes(strip_tags($grouptitle)),
																			stripslashes(strip_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			$grouplink,
																			array(),
																			$regid,
																			array(),
																			$user_id,
																			0,
																			'',
																			'yes',
																			$group_id																					 
																			);	
									}
									else {
										$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			stripslashes(strip_tags($grouptitle)),
																			stripslashes(strip_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			$grouplink,
																			array(),
																			$regid,
																			array(),
																			$user_id,
																			0,
																			'',
																			'yes',
																			$group_id																			
																			);
									}
								
									do_action('PNFPB_connect_to_external_api_for_group');
								}
							}
						}
					
						for ($dcount=0; $dcount<=count($deviceids_webview_count); $dcount+=1000) {	
					
							$webview = false;
						
							if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
								if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );									
								} else {
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
								}
							}
							else 
							{
								if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' LIMIT {$dcount}, 1000" );
								} else {
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' LIMIT {$dcount}, 1000" );
								}
							}
							
								if (function_exists('bp_follow_get_followers') && ((get_option( 'pnfpb_ic_fcm_buddypress_followers_enable') && get_option( 'pnfpb_ic_fcm_buddypress_followers_enable')  === '1'))) {
										
									$bp_follow_get_followers_array = bp_follow_get_followers($user_id);
									
									$bp_follow_get_followers_implarray = implode(",",$bp_follow_get_followers_array);
										
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND userid IN ($bp_follow_get_followers_implarray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );									
										
								}							
				
							if (count($deviceidswebview) > 0) {
							// prepare the message
							$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			stripslashes(strip_tags($grouptitle)),
																			stripslashes(strip_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			"",
																			array('click_url' => $grouplink),
																			array(),
																			$deviceidswebview,
																			$user_id,
																			0,
																			'',
																			'yes',
																			$group_id																			 
																			);
							do_action('PNFPB_connect_to_external_api_for_group_webview');
						}
					}
					}	
				}
				else {
					update_option('pnfpb_ic_fcm_new_buddypressgroup_id', $group_id);
				}
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
		public function PNFPB_icforum_push_notifications_private_messages($raw_args = array()) {
			
            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');		    
        
			if (get_option('pnfpb_ic_fcm_bprivatemessage_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false) || (get_option('pnfpb_ic_fcm_bprivatemessage_enable') == 1 && get_option( 'pnfpb_onesignal_push' ) === '1')) {
				
				global $wpdb;
				
				if ( is_object( $raw_args ) ) {
					$args = (array) $raw_args;
				} else {
					$args = $raw_args;
				}
		
				// These should be extracted below.
				$recipients    = array();
				$email_subject = $email_content = '';
				$sender_id     = 0;
		
				// Barf.
				extract( $args );
				
				//print_r($args);
		
				if ( empty( $recipients ) ) {
					return;
				}
				
	
				// Send an email to each recipient.
				foreach ( $recipients as $recipient ) {

					$sender_name = '';

					$sender_name = bp_core_get_user_displayname( $sender_id );

					if ( isset( $message ) ) {
						$message = wpautop( $message );
					} else {
						$message = '';
					}

					$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
					$url = 'https://fcm.googleapis.com/fcm/send';

					$activity_content_push = strip_tags(urldecode($message));
				
					$notificationtitle = $sender_name.__(' sent you private message',PNFPB_TD);
				
					$titletext = get_option('pnfpb_ic_fcm_bprivatemessage_text');
				
					if ( $titletext && $titletext !== '') {
						$notificationtitle = str_replace("[sender name]", $sender_name, $titletext);
					}
				
					$activity_content_push = str_replace("[sender name]", $sender_name, $activity_content_push);
				
					$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
				
					$messageurl = esc_url( bp_core_get_user_domain( $recipient->user_id ).bp_get_messages_slug().'/view/'.$thread_id.'/');
				
					$imageurl = '';
					
					$iconurl =	bp_core_fetch_avatar ( 
    							array(  'item_id'   => $sender_id,       // output user id of post author
            							'type'      => 'full',
            							'html'      => FALSE    // FALSE = return url, TRUE (default) = return url wrapped with html
   									 ) 
								);
								
							
				
					if (get_option('pnfpb_onesignal_push') === '1') {
					
						$target_user_ids = array("$recipient->user_id");
						$target_userid_array = array_map(function ($value) {
    						return $value == 1 ? '1pnfpbadm' : $value;
						}, $target_user_ids);							
						
						$response = $this->PNFPB_icfcm_onesignal_push_notification($sender_id,$notificationtitle,$activity_content_push,$messageurl,$iconurl,$target_userid_array);
							
					} else {				
						
					
						if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND userid = '{$recipient->user_id}' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) ORDER BY id DESC LIMIT 1000"  );
						} else {
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND userid = '{$recipient->user_id}' ORDER BY id DESC LIMIT 1000"  );
						}
					
					
						$webview = false;
											
						$pushtype = 'privatemessages';
						
						if (count($deviceids) > 0) {

							$regid = $deviceids;
						
						
							if (get_option('pnfpb_ic_fcm_bprivatemessage_content') != false && get_option('pnfpb_ic_fcm_bprivatemessage_content') != '') {
								$activity_content_push = get_option('pnfpb_ic_fcm_bprivatemessage_content');
							}
							
							if (get_option('pnfpb_httpv1_push') === '1') {
								$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			$notificationtitle,
																			substr(stripslashes(strip_tags($activity_content_push)),0,130),
																			$iconurl,
																			$imageurl,
																			$messageurl,
																			array('thread_id' => $thread_id,'click_url' => $messageurl),
																			$regid,
																			array(),
																			$sender_id,
																			$recipient->user_id,
																			$pushtype
																			);	
							}
							else {							
								$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			$notificationtitle,
																			substr(stripslashes(strip_tags($activity_content_push)),0,130),
																			$iconurl,
																			$imageurl,
																			$messageurl,
																			array('thread_id' => $thread_id,'click_url' => $messageurl),
																			$regid,
																			array(),
																			$sender_id,
																			$recipient->user_id,
																			$pushtype
																			);
							}

							do_action('PNFPB_connect_to_external_api_for_private_messages');
						}

				
					}
					
				}
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
		public function PNFPB_icforum_push_notifications_new_member($user_id) {
			
            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');		    
        
			if (get_option('pnfpb_ic_fcm_new_member_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false) || (get_option('pnfpb_ic_fcm_new_member_enable') == 1 && get_option( 'pnfpb_onesignal_push' ) === '1')) {
				
				global $wpdb;

		
				if ( empty( $user_id ) ) {
					return;
				}
				

				$member_name = bp_core_get_user_displayname( $user_id );

				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
				$url = 'https://fcm.googleapis.com/fcm/send';

				$activity_content_push = __('Welcome our new member ',PNFPB_TD).$member_name;
				
				$notificationtitle = $member_name.__(' registered as new member',PNFPB_TD);
				
				$titletext = get_option('pnfpb_ic_fcm_new_member_text');
				
				if ( $titletext && $titletext !== '') {
					$notificationtitle = str_replace("[member name]", $member_name, $titletext);
				}
				
				$imageurl = '';
				
				$iconurl =	bp_core_fetch_avatar ( 
    							array(  'item_id'   => $user_id,       // output user id of post author
            							'type'      => 'full',
            							'html'      => FALSE       // FALSE = return url, TRUE (default) = return url wrapped with html
   									 ) 
								);
				
					
				$activity_content_push = str_replace("[member name]", $member_name, $activity_content_push);
				
				if (get_option('pnfpb_ic_fcm_new_member_content') != false && get_option('pnfpb_ic_fcm_new_member_content') != '') {
						$activity_content_push = get_option('pnfpb_ic_fcm_new_member_content');
				}

				$messageurl = esc_url( bp_core_get_user_domain( $user_id ).bp_get_messages_slug().'/view/'.$thread_id.'/');
				
				if (get_option('pnfpb_onesignal_push') === '1') {
					$target_userid_array = array();
					if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE device_id LIKE '%onesignal%' LIMIT 2000" );
							$target_userid_array = array_map(function ($value) {
    							return $value == 1 ? '1pnfpbadm' : $value;
							}, $target_userid_array_values);						
					}					
						
					$response = $this->PNFPB_icfcm_onesignal_push_notification($user_id,$notificationtitle,$activity_content_push,$messageurl,$iconurl,$target_userid_array);
							
				} else {				
				
					if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,6,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );							
						} else {
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,6,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
						}
					} else {
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );							
						} else {
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );
						}
					}
					
					$webview = false;
					if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,6,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );							
						} else {
							$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,6,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
						}
					} else {
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );							
						} else {
							$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );
						}
					}

		
					if (count($deviceids) > 0) {

						$regid = $deviceids;
						if (get_option('pnfpb_httpv1_push') === '1') {
								$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																		$notificationtitle,
																		substr(stripslashes(strip_tags($activity_content_push)),0,130),
																		$iconurl,
																		$imageurl,
																		$messageurl,
																		array(),
																		$regid,
																		$deviceidswebview,
																		$user_id,
																		0
																		);
						}
						else {							
							$this->PNFPB_icfcm_legacy_send_push_notification(0,
																		$notificationtitle,
																		substr(stripslashes(strip_tags($activity_content_push)),0,130),
																		$iconurl,
																		$imageurl,
																		$messageurl,
																		array(),
																		$regid,
																		array(),
																		$user_id,
																		0
																		);
						}

						do_action('PNFPB_connect_to_external_api_for_new_member');
					}

					if (count($deviceidswebview) > 0) {

						$regid = $deviceidswebview;
						
						
						if (get_option('pnfpb_ic_fcm_new_member_content') != false && get_option('pnfpb_ic_fcm_new_member_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_new_member_content');
						}
						$this->PNFPB_icfcm_legacy_send_push_notification(0,
																		$notificationtitle,
																		substr(stripslashes(strip_tags($activity_content_push)),0,130),
																		$iconurl,
																		$imageurl,
																		"",
																		array('click_url' => $messageurl),
																		array(),
																		$deviceidswebview,
																		$user_id,
																		0
																		);
						do_action('PNFPB_connect_to_external_api_for_new_member_webview');
					}
				
				}
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
		public function PNFPB_icforum_push_notifications_friendship_request($friendship_id, $initiator_id, $friend_id) {
			
            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');		    
        
			if (get_option('pnfpb_ic_fcm_friendship_request_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false) || (get_option('pnfpb_ic_fcm_friendship_request_enable') == 1 && get_option( 'pnfpb_onesignal_push' ) === '1')) {
				
				global $wpdb;
	
				$friendship_initiator_name = bp_core_get_user_displayname( $initiator_id );
				
				$friend_name = bp_core_get_user_displayname( $friend_id );

				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
				$url = 'https://fcm.googleapis.com/fcm/send';

				$activity_content_push = $friendship_initiator_name.__(' sent you friendship request',PNFPB_TD);
				
				$notificationtitle = '[friendship initiator name]'.__(' sent you friend request',PNFPB_TD);
				
				$titletext = get_option('pnfpb_ic_fcm_friendship_request_text');
				
				if ( $titletext && $titletext !== '') {
					$notificationtitle = str_replace("[friendship initiator name]", $friendship_initiator_name, $titletext);
				}
				
				$activity_content_push = str_replace("[friendship initiator name]", $friendship_initiator_name, $activity_content_push);
				
				$messageurl = esc_url( bp_core_get_user_domain( $friend_id ) . bp_get_friends_slug() . '/requests/');
				
				$imageurl = '';
					
				$iconurl =	bp_core_fetch_avatar ( 
    							array(  'item_id'   => $initiator_id,       // output user id of post author
            							'type'      => 'full',
            							'html'      => FALSE       // FALSE = return url, TRUE (default) = return url wrapped with html
								  
   									 ) 
								);					
				
				if (get_option('pnfpb_onesignal_push') === '1') {
					
					$target_user_ids = array("$friend_id");
					$target_userid_array = array_map(function ($value) {
    					return $value == 1 ? '1pnfpbadm' : $value;
					}, $target_user_ids);					
						
					$response = $this->PNFPB_icfcm_onesignal_push_notification($initiator_id,$notificationtitle,$activity_content_push,$messageurl,$iconurl,$target_userid_array);
							
				} else {				
				
					if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {

					$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND userid = '{$friend_id}' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,7,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) ORDER BY id DESC LIMIT 1000"  );
						
					} else {
						
						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND userid = '{$friend_id}' ORDER BY id DESC LIMIT 1000"  );
						
					}
					
					$webview = false;
									
					$pushtype = 'friendshiprequest';

					if (count($deviceids) > 0) {

						$regid = $deviceids;
						
						
						if (get_option('pnfpb_ic_fcm_friendship_request_content') != false && get_option('pnfpb_ic_fcm_friendship_request_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_friendship_request_content');
						}

						if (get_option('pnfpb_httpv1_push') === '1') {
								$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																		$notificationtitle,
																		substr(stripslashes(strip_tags($activity_content_push)),0,130),
																		$iconurl,
																		$imageurl,
																		$messageurl,
																		array('click_url' => $messageurl),
																		$regid,
																		array(),
																		$initiator_id,
																		$friend_id,
																		$pushtype
																		);
						}
						else {						
							$this->PNFPB_icfcm_legacy_send_push_notification(0,
																		$notificationtitle,
																		substr(stripslashes(strip_tags($activity_content_push)),0,130),
																		$iconurl,
																		$imageurl,
																		$messageurl,
																		array('click_url' => $messageurl),
																		$regid,
																		array(),
																		$initiator_id,
																		$friend_id,
																		$pushtype
																		);
						}

						do_action('PNFPB_connect_to_external_api_for_friend_request');
					}

				}
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
		public function PNFPB_icforum_push_notifications_friendship_accepted($friendship_id, $initiator_id, $friend_id) {
			
            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');		    
        
			if (get_option('pnfpb_ic_fcm_friendship_accept_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false) || (get_option('pnfpb_ic_fcm_friendship_accept_enable') == 1 &&  get_option( 'pnfpb_onesignal_push' ) === '1')) {
				
				global $wpdb;
	
				$friendship_initiator_name = bp_core_get_user_displayname( $initiator_id );
				
				$friend_name = bp_core_get_user_displayname( $friend_id );

				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
				$url = 'https://fcm.googleapis.com/fcm/send';

				$activity_content_push = $friend_name.__(' accepted your friendship request',PNFPB_TD);
				
				$notificationtitle = '[friendship acceptor name]'.__(' accepted your friendship request',PNFPB_TD);
				
				$titletext = get_option('pnfpb_ic_fcm_friendship_accept_text');
				
				
				
				if ( $titletext && $titletext !== '') {
					$notificationtitle = str_replace("[friendship acceptor name]", $friend_name, $titletext);
				}
				
				$activity_content_push = str_replace("[friendship acceptor name]", $friend_name, $activity_content_push);
				
				$messageurl = esc_url( bp_core_get_user_domain( $friend_id ) . bp_get_friends_slug() . '/requests/');
				
				$imageurl = '';
					
				$iconurl =	bp_core_fetch_avatar ( 
    							array(  'item_id'   => $friend_id,       // output user id of post author
            							'type'      => 'full',
            							'html'      => FALSE       // FALSE = return url, TRUE (default) = return url wrapped with html
								  
   									 ) 
								);				
				
				if (get_option('pnfpb_onesignal_push') === '1') {
					
					$target_user_ids = array("$initiator_id");
					$target_userid_array = array_map(function ($value) {
    					return $value == 1 ? '1pnfpbadm' : $value;
					}, $target_user_ids);					
						
					$response = $this->PNFPB_icfcm_onesignal_push_notification($friend_id,$notificationtitle,$activity_content_push,$messageurl,$iconurl,$target_userid_array);
							
				} else {
				
					if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						
					$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND userid = '{$initiator_id}' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,8,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) ORDER BY id DESC LIMIT 1000"  );
						
					} else  {

						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND userid = '{$initiator_id}' ORDER BY id DESC LIMIT 1000"  );
						
					}
					
					$webview = false;
					
				
					$pushtype = 'friendshipaccepted';
					
					if (count($deviceids) > 0) {

						$regid = $deviceids;
						
						if (get_option('pnfpb_ic_fcm_friendship_accept_content') != false && get_option('pnfpb_ic_fcm_friendship_accept_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_friendship_accept_content');
						}
						
						if (get_option('pnfpb_httpv1_push') === '1') {
								$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																$notificationtitle,
																substr(stripslashes(strip_tags($activity_content_push)),0,130),
																$iconurl,
																$imageurl,
																$messageurl,
																array('click_url' => $messageurl),
																$deviceids,
																array(),
																$friend_id,
																$initiator_id,
																$pushtype
																);
						}
						else {						
							$this->PNFPB_icfcm_legacy_send_push_notification(0,
																$notificationtitle,
																substr(stripslashes(strip_tags($activity_content_push)),0,130),
																$iconurl,
																$imageurl,
																$messageurl,
																array('click_url' => $messageurl),
																$deviceids,
																array(),
																$friend_id,
																$initiator_id,
																$pushtype
																);
						}

						do_action('PNFPB_connect_to_external_api_for_friend_request_accepted');
					}

				}
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
		public function PNFPB_icforum_push_notifications_avatar_change($user_id = 0) {
			
            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');		    
        
			if (get_option('pnfpb_ic_fcm_avatar_change_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false) || (get_option('pnfpb_ic_fcm_avatar_change_enable') == 1 &&  get_option( 'pnfpb_onesignal_push' ) === '1')) {
				
				global $wpdb;
				
				$member_name = bp_core_get_user_displayname( $user_id );

				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
				$url = 'https://fcm.googleapis.com/fcm/send';

				$activity_content_push = '';
				
				$notificationtitle = $member_name.__(' updated avatar',PNFPB_TD);
				
				$titletext = get_option('pnfpb_ic_fcm_avatar_change_text');
				
				if ( $titletext && $titletext !== '') {
					$notificationtitle = str_replace("[member name]", $member_name, $titletext);
				}
				
				$activity_content_push = str_replace("[member name]", $member_name, $activity_content_push);
				
				$messageurl = esc_url( bp_core_get_user_domain( $user_id ));
				
				$imageurl = '';
					
				$iconurl =	bp_core_fetch_avatar ( 
    						array(  'item_id'   => $user_id,       // output user id of post author
            						'type'      => 'full',
            						'html'      => FALSE        // FALSE = return url, TRUE (default) = return url wrapped with html
							  
   									) 
							);				
				
				if (get_option('pnfpb_onesignal_push') === '1') {
					
					$target_userid_array = array();
					if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE device_id LIKE '%onesignal%' LIMIT 2000" );
							$target_userid_array = array_map(function ($value) {
    							return $value == 1 ? '1pnfpbadm' : $value;
							}, $target_userid_array_values);						
					}						
						
					$response = $this->PNFPB_icfcm_onesignal_push_notification($user_id,$notificationtitle,$activity_content_push,$messageurl,$iconurl,$target_userid_array);
							
				} else {				
				
					if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,9,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );							
						} else {
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,9,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
						}
						
					} else  {
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );
						} else {
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );
						}
						
					}
					
					$webview = false;
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,9,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );							
						} else {
							$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,9,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
						}
					} else {
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );							
						} else {
							$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );
						}
					}
				

					

					if (count($deviceids) > 0) {

						$regid = $deviceids;
						
						
						if (get_option('pnfpb_ic_fcm_avatar_change_content') != false && get_option('pnfpb_ic_fcm_avatar_change_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_avatar_change_content');
						}
						if (get_option('pnfpb_httpv1_push') === '1') {
								$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																$notificationtitle,
																substr(stripslashes(strip_tags($activity_content_push)),0,130),
																$iconurl,
																$imageurl,
																$messageurl,
																array(),
																$deviceids,
																$deviceidswebview,
																$user_id,
																0
																);
						}
						else {
							$this->PNFPB_icfcm_legacy_send_push_notification(0,
																$notificationtitle,
																substr(stripslashes(strip_tags($activity_content_push)),0,130),
																$iconurl,
																$imageurl,
																$messageurl,
																array(),
																$deviceids,
																array(),
																$user_id,
																0
																);
						}

						do_action('PNFPB_connect_to_external_api_for_avatar_change');
					}

					if (count($deviceidswebview) > 0) {

						$regid = $deviceidswebview;
						
						
						if (get_option('pnfpb_ic_fcm_avatar_change_content') != false && get_option('pnfpb_ic_fcm_avatar_change_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_avatar_change_content');
						}

						$this->PNFPB_icfcm_legacy_send_push_notification(0,
																$notificationtitle,
																substr(stripslashes(strip_tags($activity_content_push)),0,130),
																$iconurl,
																$imageurl,
																"",
																array('click_url' => $messageurl),
																array(),
																$deviceidswebview,
																$user_id,
																0
																);
						do_action('PNFPB_connect_to_external_api_for_avatar_change_webview');
					}
				}
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
		public function PNFPB_icforum_push_notifications_cover_image_change($item_id, $cover_url) {
			
            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');		    
        
			if (get_option('pnfpb_ic_fcm_cover_image_change_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false) || (get_option('pnfpb_ic_fcm_cover_image_change_enable') == 1 && get_option( 'pnfpb_onesignal_push' ) === '1')) {
				
				global $wpdb;

				$member_name = bp_core_get_user_displayname( $item_id );

				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
				$url = 'https://fcm.googleapis.com/fcm/send';

				$activity_content_push = '';
				
				$notificationtitle = $member_name.__(' updated cover photo',PNFPB_TD);
				
				$titletext = get_option('pnfpb_ic_fcm_cover_image_change_text');
				
				if ( $titletext && $titletext !== '') {
					$notificationtitle = str_replace("[member name]", $member_name, $titletext);
				}
				
				$activity_content_push = str_replace("[member name]", $member_name, $activity_content_push);
				
				$messageurl = esc_url( bp_core_get_user_domain( $item_id ));
				
				if (get_option('pnfpb_onesignal_push') === '1') {
					
					$target_userid_array = array();
					if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE device_id LIKE '%onesignal%' LIMIT 2000" );
							$target_userid_array = array_map(function ($value) {
    							return $value == 1 ? '1pnfpbadm' : $value;
							}, $target_userid_array_values);						
					}					
						
					$response = $this->PNFPB_icfcm_onesignal_push_notification($activity_id,$activitytitle,$localactivitycontent,$activitylink,$imageurl,$target_userid_array);
							
				} else {				
				
					if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,10,1) = '1') LIMIT 1000"  );
							
						} else {

							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,10,1) = '1') LIMIT 1000"  );
						}
						
					} else  {
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );							
						} else {
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );
						}
						
					}
					
					$webview = false;
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,10,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );							
						} else {
							$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,10,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
						}
					} else  {
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );							
						} else {
							$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );
						}
					}
					

					$iconurl =	bp_core_fetch_avatar ( 
    							array(  'item_id'   => $item_id,       // output user id of post author
            							'type'      => 'full',
            							'html'      => FALSE    // FALSE = return url, TRUE (default) = return url wrapped with html
   									 ) 
								);
				
					
					$imageurl = '';
				

					if (count($deviceids) > 0) {

						$regid = $deviceids;
						
						
						if (get_option('pnfpb_ic_fcm_cover_image_change_content') != false && get_option('pnfpb_ic_fcm_cover_image_change_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_cover_image_change_content');
						}

						if (get_option('pnfpb_httpv1_push') === '1') {
								$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																$notificationtitle,
																substr(stripslashes(strip_tags($activity_content_push)),0,130),
																$iconurl,
																$imageurl,
																$messageurl,
																array(),
																$regid,
																$deviceidswebview,
																$item_id,
																0
																);
						}
						else {						
							$this->PNFPB_icfcm_legacy_send_push_notification(0,
																$notificationtitle,
																substr(stripslashes(strip_tags($activity_content_push)),0,130),
																$iconurl,
																$imageurl,
																$messageurl,
																array(),
																$regid,
																array(),
																$item_id,
																0
																);
						}
						do_action('PNFPB_connect_to_external_api_for_cover_image_change');
					}

					if (count($deviceidswebview) > 0) {

						$regid = $deviceidswebview;
						
						
						if (get_option('pnfpb_ic_fcm_cover_image_change_content') != false && get_option('pnfpb_ic_fcm_cover_image_change_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_cover_image_change_content');
						}
						
						$this->PNFPB_icfcm_legacy_send_push_notification(0,
																$notificationtitle,
																substr(stripslashes(strip_tags($activity_content_push)),0,130),
																$iconurl,
																$imageurl,
																"",
																array('click_url' => $messageurl),
																array(),
																$deviceidswebview,
																$item_id,
																0
																);
						do_action('PNFPB_connect_to_external_api_for_cover_image_change_webview');
					}
				
				}
			}
		}
		
		/**
		 * To delete push notification subscription token with user no longer exists
		 * using CRON schedule every day or 2 times every day
		 * since 1.47
		 * 
		 */
		 public function PNFPB_icforum_delete_token_user_not_exist() {
			 
			global $wpdb;
			 
			$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
			 
			$users_table_name =  $wpdb->prefix . "users";
			 
			if ( get_option('pnfpb_ic_fcm_token_delete_without_user_enable' ) && get_option('pnfpb_ic_fcm_token_delete_without_user_enable' ) == '1' && get_option('pnfpb_ic_fcm_token_delete_without_useridtoken_enable' ) && get_option('pnfpb_ic_fcm_token_delete_without_useridtoken_enable' ) == '1') {
				
			 	$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE {$table_name}.userid = 0 OR NOT EXISTS (SELECT * FROM {$users_table_name} WHERE {$table_name}.userid = {$users_table_name}.ID)");
				
			}
			else {
				if ( get_option('pnfpb_ic_fcm_token_delete_without_user_enable' ) && get_option('pnfpb_ic_fcm_token_delete_without_user_enable' ) == '1') 				  {
					
					$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE {$table_name}.userid != 0 AND NOT EXISTS (SELECT * FROM {$users_table_name} WHERE {$table_name}.userid = {$users_table_name}.ID)");
					
				}
				else 
				{
					if ( get_option('pnfpb_ic_fcm_token_delete_without_useridtoken_enable' ) && get_option('pnfpb_ic_fcm_token_delete_without_useridtoken_enable' ) == '1') {
						
						$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE {$table_name}.userid = 0");
						
					}
				}
			}
			 
				 
		 }
		
		
		/** Push notification for post comment
		 * 
		 * 
		 * @since 1.31
		 * 
		 */
		
		public function PNFPB_icforum_push_notifications_post_comment_web($comment_ID=null, $comment_approved=null, $commentdata=null) {
			
			global $wpdb;
				
            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
				
            
			if ((($comment_ID && (false === as_has_scheduled_action( 'PNFPB_cron_comments_post_hook' ))) || ($comment_ID === null && (as_has_scheduled_action( 'PNFPB_cron_comments_post_hook' )))) && get_option('pnfpb_ic_fcm_bcomment_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false) || (get_option('pnfpb_ic_fcm_bcomment_enable') == 1 && get_option( 'pnfpb_onesignal_push' ) === '1')) {
				
				
				if ($comment_ID === null ) {
				
					$comment_ID = get_option('pnfpb_ic_fcm_new_comment_id');
					
					$commentData = get_comment($comment_ID);
				
					$comment_approved = get_option('pnfpb_ic_fcm_new_comment_approved');
				}
				else {
					
					$commentData = get_comment($comment_ID);
				}
				
		
				if( 1 === $comment_approved && $commentData) {
			
					$commentData = get_comment($comment_ID);
					
					$postData = get_post($commentData->comment_post_ID);
					
					$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
					
					$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
            
					$blog_title = get_bloginfo( 'name' );
            
					$commenttitle = __('New comment for post - ',PNFPB_TD).$postData->post_title;
				
					$localpostcontent = $commentData->comment_content;
					
					$postcommentlink = get_permalink($postData->ID);
					
					$postuserid = 0;
				
					if ( !wp_next_scheduled( 'PNFPB_cron_comments_post_hook' ) )
					{				
				
						if ($comment_ID && $comment_ID !== null) {
							
							$postuserid = $commentData->user_id;
							
							$commentData = get_comment($comment_ID);
					
							$postData = get_post($commentData->comment_post_ID);
					
							$authorid = $postData->post_author;							
							
						}
					}
					else 
					{
						if ( get_option('pnfpb_ic_fcm_new_comments_post_userid' )) {
						
							$postuserid = get_option('pnfpb_ic_fcm_new_comments_post_userid' );
							
							$authorid = get_option('pnfpb_ic_fcm_new_comments_author_userid' );
						
						}
					}					
						
					if (get_option('pnfpb_ic_fcm_comment_activity_message') != false && get_option('pnfpb_ic_fcm_comment_activity_message') != '') {
						$localpostcontent = get_option('pnfpb_ic_fcm_comment_activity_message');
					}						
				
								
					preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($localpostcontent), $imgresult);
					$imageurl = '';
				
					if (is_array($imgresult)) {
						if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
							$imageurl = str_replace('"','',$imgresult[2][0]);
						}
					}
					
					if (get_option('pnfpb_ic_fcm_comment_activity_title') != false && get_option('pnfpb_ic_fcm_comment_activity_title') != '') {
						$commenttitle = get_option('pnfpb_ic_fcm_comment_activity_title');
						if ($postuserid != '' || $postuserid !== null) {
							$sender_name = bp_core_get_user_displayname( $postuserid );
							$commenttitle = str_replace("[member name]", $sender_name, $commenttitle);
						}
						else 
						{
							$commenttitle = __('New comment for post - ',PNFPB_TD).$postData->post_title;
						}
					}
					else
					{
						$commenttitle = __('New comment for post - ',PNFPB_TD).$postData->post_title;
					}
					
					if ($comment_ID) {
					
						$commentData = get_comment($comment_ID);
					
						$postData = get_post($commentData->comment_post_ID);
					
						$post_content_push = __("New comments for post - ",PNFPB_TD).$postData->post_title;
				
						$postuserid = $commentData->user_id;
						
						$authorid = $postData->post_author;
					
						$postlink = get_permalink($postData->ID);
					
						update_option('pnfpb_ic_fcm_new_comment_id',$comment_ID);
					
						update_option('pnfpb_ic_fcm_new_comment_approved',$comment_approved);
				
						update_option('pnfpb_ic_fcm_new_comments_post_content',$post_content_push);
					
						update_option('pnfpb_ic_fcm_new_comments_post_link',$postlink);
					
						update_option('pnfpb_ic_fcm_new_comments_post_userid',$postuserid);	
						
						update_option('pnfpb_ic_fcm_new_comments_post_authorid',$authorid);
					}
					
					$localpostcontent = str_replace("[member name]", $sender_name, $localpostcontent);
					
					
					if (get_option('pnfpb_onesignal_push') === '1') {
						
						// Update the users who have favorited this activity.
						// 
						$liked_user_ids = array();
						if ( function_exists('bb_activity_is_item_favorite') ) {
						
							$liked_users = bp_activity_get_meta( $activity_id, 'bp_favorite_users', true );
						
							if ( empty( $liked_users ) || ! is_array( $liked_users ) ) {
								$liked_user_ids = array();
							}	else {
								$liked_user_ids = array_map(function($value) {
    								return $value == 1 ? '1pnfpbadm' : strval($value);
								}, $liked_users);						
							}
					
						
							$response = $this->PNFPB_icfcm_onesignal_push_notification($activity_id,$activitytitle,$localactivitycontent,$activitylink,$imageurl,$liked_user_ids);
							
						} else {
							
							$response = $this->PNFPB_icfcm_onesignal_push_notification($activity_id,$activitytitle,$localactivitycontent,$activitylink,$imageurl);
						}
							
					} else {					
				
						if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1')  {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );								
							} else {
								$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
							}
					
						}
						else				
						{
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%'" );								
							} else {
								$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%'" );
							}
						}
						if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1')  {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );								
							} else {
								$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
							}
					} else  {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%'" );	
							} else {
							$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%'" );
							}
						}
				
						/* Logic to get subscribers who subscribed only comments made on my posts */
				
						$deviceidsmypost = [];
				
			
						if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
							$deviceidsmypost=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid = {$authorid} AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,4,1) = '1')" );

						}
					
						if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
							$deviceidsmypostwebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid = {$authorid} AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,4,1) = '1')" );

						}					
				
						$mergeddeviceids = array_merge($deviceids,$deviceidsmypost);
					
						$mergeddeviceidswebview = array_merge($deviceids,$deviceidsmypostwebview);
	
						$url = 'https://fcm.googleapis.com/fcm/send';

						$regid = $mergeddeviceids;
					
						if (count($regid) > 0) {
							// prepare the message
							
						if (get_option('pnfpb_httpv1_push') === '1') {
								$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			$commenttitle,
																			substr(stripslashes(strip_tags($localpostcontent)),0,130),
																			$iconurl,
																			$imageurl,
																			$postcommentlink,
																			array(),
																			$regid,
																			$mergeddeviceidswebview,
																			$postuserid,
																			$authorid
																			);
						}
						else {							
							$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			$commenttitle,
																			substr(stripslashes(strip_tags($localpostcontent)),0,130),
																			$iconurl,
																			$imageurl,
																			$postcommentlink,
																			array(),
																			$regid,
																			array(),
																			$postuserid,
																			$authorid																			 
																			);
						}
							
						}
					
						if (count($mergeddeviceidswebview) > 0) {
					
							// prepare the message
							$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			$commenttitle,
																			substr(stripslashes(strip_tags($localpostcontent)),0,130),
																			$iconurl,
																			$imageurl,
																			"",
																			array('click_url' => $postcommentlink),
																			array(),
																			$mergeddeviceidswebview,
																			$postuserid,
																			$authorid																			 
																			);
						}
					}	
				}
			}
			else 
			{
				if ($comment_ID && (wp_next_scheduled( 'PNFPB_cron_comments_post_hook' ) 
									|| (as_has_scheduled_action( 'PNFPB_cron_comments_post_hook' )))) {
					
					$commentData = get_comment($comment_ID);
					
					$postData = get_post($commentData->comment_post_ID);
					
					$authorid = $postData->post_author;												
					
					$post_content_push = __("New comments for post - ",PNFPB_TD).$postData->post_title;
				
					$postuserid = $commentData->user_id;
					
					$postlink = get_permalink($postData->ID);
					
					update_option('pnfpb_ic_fcm_new_comment_id',$comment_ID);
					
					update_option('pnfpb_ic_fcm_new_comment_approved',$comment_approved);
				
					update_option('pnfpb_ic_fcm_new_comments_post_content',$post_content_push);
					
					update_option('pnfpb_ic_fcm_new_comments_post_link',$postlink);
					
					update_option('pnfpb_ic_fcm_new_comments_post_userid',$postuserid);
					
					update_option('pnfpb_ic_fcm_new_comments_post_authorid',$authorid);
					
				}
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
		public function PNFPB_icforum_push_notifications_comment_web ($comment_id=null, $params=null, $activity=null, $sendschedule='no') {
        
            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
            
			if ((($comment_id && (false === as_has_scheduled_action( 'PNFPB_cron_buddypresscomments_hook' ))) || ($comment_id === null && (as_has_scheduled_action( 'PNFPB_cron_buddypresscomments_hook' )))) && get_option('pnfpb_ic_fcm_bcomment_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false) || (get_option('pnfpb_ic_fcm_bcomment_enable') == 1 && get_option( 'pnfpb_onesignal_push' ) === '1')) {

				global $wpdb;
				
			
				$activity_content_push = __("New comments posted in ",PNFPB_TD).get_bloginfo( 'name' );
				
				$activitylink = get_home_url();
				if (function_exists('bp_is_active')){
					$activitylink = get_home_url().'/'.buddypress()->pages->activity->slug;
				}				
				
				if ($comment_id) {
					extract( $params, EXTR_SKIP );
	
					$activity_content_push = strip_tags(urldecode($content));
	
					$activitylink = bp_activity_get_permalink( $activity_id );
					
					$activitylink = $activitylink.'#acomment-'.$comment_id;
					
				}
				
				$activityuserid = 0;
				
				$authoractivityuserid = 0;
				
			
				if ($comment_id && $user_id) {
					
					$activityuserid = $user_id;
					
					if ($activity && $activity !== null) {
						
						$authoractivityuserid = $activity->user_id;
					}
					
				}

				$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
            
				$blog_title = get_bloginfo( 'name' );
            
				$localactivitycontent = substr(stripslashes(strip_tags($activity_content_push)),0,80);
				
				$sender_name = '';
				
			
				if ($comment_id===null ) {
					
					$recent_comments = $wpdb->get_results( "SELECT user_id, content, item_id, id, date_recorded FROM {$wpdb->prefix}bp_activity WHERE TYPE = 'activity_comment' ORDER BY date_recorded DESC LIMIT 1" );
					

    				foreach( $recent_comments as $recent_comment ) {
						
						$activity_id = $recent_comment->item_id;
						
						$activityuserid = $recent_comment->user_id;

        				$activitylink = bp_activity_get_permalink( $recent_comment->item_id );
					
						$activitylink = $activitylink.'#acomment-'.$comment_id;
						
						$localactivitycontent = substr(stripslashes(strip_tags($recent_comment->content)),0,80);
						
						$activity_details = $wpdb->get_results( "SELECT user_id, content, item_id, id, date_recorded FROM {$wpdb->prefix}bp_activity WHERE id = {$activity_id} AND TYPE = 'activity_update' ORDER BY date_recorded DESC LIMIT 1" );
						
						foreach( $activity_details as $activity_detail ) {
					
							$authoractivityuserid = $activity_detail->user_id;
							
						}
    				}
					
				}
				
				if (get_option('pnfpb_ic_fcm_comment_activity_title') != false && get_option('pnfpb_ic_fcm_comment_activity_title') != '') {
					
					$commenttitle = get_option('pnfpb_ic_fcm_comment_activity_title');
					
					if ($activityuserid != '' || $activityuserid !== null) {
						
						$sender_name = bp_core_get_user_displayname( $activityuserid );
						
						$commenttitle = str_replace("[member name]", $sender_name, $commenttitle);
						
					}
				}
				else
				{
					$commenttitle = __('New comment posted in ',PNFPB_TD).$blog_title;
				}				
				
				if (get_option('pnfpb_ic_fcm_comment_activity_message') != false && get_option('pnfpb_ic_fcm_comment_activity_message') != '') {
					
					if ($comment_id) {
						$localactivitycontent = get_option('pnfpb_ic_fcm_comment_activity_message');
					} else {
						$localactivitycontent .= get_option('pnfpb_ic_fcm_comment_activity_message');
					}
					
				}				
				
				preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($localactivitycontent), $imgresult);
				
				$imageurl = '';
				
				if (is_array($imgresult)) {
					if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
						$imageurl = str_replace('"','',$imgresult[2][0]);
					}
				}				
				
				$localactivitycontent = str_replace("[member name]", $sender_name, $localactivitycontent);
				
				$deviceids = [];
					
				$deviceidswebview = [];
	
				if (get_option('pnfpb_onesignal_push') === '1' && $activity_id > 0) {
					
					// Update the users who have favorited this activity.
					
					$bb_target_userid_array = array();
					
					if ( function_exists('bb_activity_is_item_favorite') ) {
					
						$reacted_users = $wpdb->get_results( "SELECT id,user_id,reaction_id,item_type,item_id FROM {$wpdb->prefix}bb_user_reactions WHERE item_id = {$activity_id} AND item_type = 'activity'" );
					
						//error_log(serialize($reacted_users));
						
						$liked_users = array();
						
						foreach( $reacted_users as $result ) {
							
							array_push($liked_users,$result->user_id);
							
						}
						
						if ( empty( $liked_users ) || ! is_array( $liked_users ) ) {
							$liked_user_ids = array("0");
						}
						else {
							$liked_user_ids = array_map(function($value) {
    							return $value == 1 ? '1pnfpbadm' : strval($value);
							}, $liked_users);						
						}
						
						//error_log(serialize($liked_user_ids));
						
						if (count($liked_user_ids) > 0) {
							
							$response = $this->PNFPB_icfcm_onesignal_push_notification($activity_id,$commenttitle,$localactivitycontent,$activitylink,$imageurl,$liked_user_ids);
							
						}
						
					} else {
						
						$response = $this->PNFPB_icfcm_onesignal_push_notification($activity_id,$commenttitle,$localactivitycontent,$activitylink,$imageurl);
						
					}
					

							
				} else {
					
					$liked_user_ids = array();
					
					$buddyboss_pnfpb = false;
					
					if ( function_exists('bb_activity_is_item_favorite') ) {
						
						$buddyboss_pnfpb = true;
					
						$reacted_users = $wpdb->get_results( "SELECT id,user_id,reaction_id,item_type,item_id FROM {$wpdb->prefix}bb_user_reactions WHERE item_id = {$activity_id} AND item_type = 'activity'" );
					
						//error_log(serialize($reacted_users));
						
						$liked_users = array();
						
						foreach( $reacted_users as $result ) {
							
							array_push($liked_users,$result->user_id);
							
						}
						
						if ( empty( $liked_users ) || ! is_array( $liked_users ) ) {
							$liked_user_ids = array();
						}
						else {
							$liked_user_ids = array_map(function($value) {
    							return $value == 1 ? 1 : strval($value);
							}, $liked_users);						
						}
						if (count($liked_user_ids) > 0) {
							$liked_user_ids_implode = implode(",",$liked_user_ids);
						}
						//error_log(serialize($liked_user_ids));
						
					
					}					
						
					$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
				
					if (get_option('pnfpb_ic_fcm_buddypress_comments_radio_enable') !== '2'  && $activity_id > 0) {
						
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							
							

							if (count($liked_user_ids) > 0) {
							
								$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND  userid IN ($liked_user_ids_implode) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
								
								$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%webview%' AND userid IN ($liked_user_ids_implode) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );								
							
							}	else {
								if (!$buddyboss_pnfpb) {
									
									$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
									
									$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
									
								}
							}
						} else {
							
							
							
							if (count($liked_user_ids) > 0) {
							
								$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND userid IN ($liked_user_ids_implode) AND  (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
								
								$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND userid IN ($liked_user_ids_implode) AND  (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );								
								
							
							} else {
								if (!$buddyboss_pnfpb) {
									
									$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
									
									$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );									
									
								}

							}
						}
					
					}

				
					/*if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1' && $activity_id > 0) {
						
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							
							if (count($liked_user_ids) > 0) {
								
								$deviceidswebview = $wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND device_id LIKE '%webview%' AND userid IN ($liked_user_ids_implode) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
								
							} else {
								if (!$buddyboss_pnfpb) {
									$deviceidswebview = $wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND device_id LIKE '%webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );	
								}
								
							}
							
						} else {
							
							if (count($liked_user_ids) > 0) {
								
							
								$deviceidswebview = $wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND device_id LIKE '%webview%' AND userid IN ($liked_user_ids_implode) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
							
							} else {
								if (!$buddyboss_pnfpb) {
									$deviceidswebview = $wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
								}
								
							}
						}
					} else  {
						if ($activity_id > 0) {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								
								$deviceidswebview = $wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND device_id LIKE '%webview%'" );		
								
							} else {
								
								if (count($liked_user_ids) > 0 && !$buddyboss_pnfpb) {
									
							
									$deviceidswebview = $wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND userid IN ($liked_user_ids_implode) AND device_id LIKE '%webview%' " );
							
								}	else {
									if (!$buddyboss_pnfpb) {
										$deviceidswebview = $wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%webview%'" );
									}
									
								}
							}
						}
					}*/
					
				
					/* Logic to get subscribers who subscribed only comments made on my activities */
				
					$deviceidsmyactivities = [];
					
					$deviceidsmyactivitieswebview = [];
				
					if (get_option('pnfpb_ic_fcm_buddypress_comments_radio_enable') === '2' && $activity_id > 0) {
							
						if(count($liked_user_ids) <= 0 && !$buddyboss_pnfpb) {
							
							$deviceidsmyactivities = $wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid = {$authoractivityuserid} AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) != '0' OR SUBSTRING(subscription_option,4,1) = '1' )" );							
	
							$deviceidsmyactivitieswebview = $wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid = {$authoractivityuserid} AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) != '0' OR SUBSTRING(subscription_option,4,1) = '1' )" );
								
						}
							
						if (count($liked_user_ids) > 0) {
							
							$deviceidsmyactivities = $wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid = {$authoractivityuserid} AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) != '0' OR SUBSTRING(subscription_option,4,1) = '1' )" );							
							
							$deviceidsmyactivitieswebview = $wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid = {$authoractivityuserid} AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) != '0' OR SUBSTRING(subscription_option,4,1) = '1' )" );
							
						}							
							
					}
			
					$pushtype = '';
					
					if (count($deviceidsmyactivitieswebview) > 0 || count($deviceidsmyactivities) > 0) {
						
						$pushtype = 'mycomments';
						
					}
					
					$mergeddeviceids = array_merge($deviceids,$deviceidsmyactivities);
				
					$mergeddeviceidswebview = array_merge($deviceidswebview,$deviceidsmyactivitieswebview);
	
					$url = 'https://fcm.googleapis.com/fcm/send';

					$regid = $mergeddeviceids;
					
					if (function_exists('bp_follow_get_followers') && ((get_option( 'pnfpb_ic_fcm_buddypress_followers_enable') && get_option( 'pnfpb_ic_fcm_buddypress_followers_enable')  === '1'))) {

								$bp_follow_get_followers_array = bp_follow_get_followers($authoractivityuserid);
									
								$bp_follow_get_followers_implarray = implode(",",$bp_follow_get_followers_array);
						
										
								$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND userid IN ($bp_follow_get_followers_implarray) AND device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
						
								$regid = $deviceids;
									
								$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND userid IN ($bp_follow_get_followers_implarray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
						
								$mergeddeviceidswebview = $deviceidswebview;
										
					}					

					if (count($regid) > 0) {
						// prepare the message
						if (get_option('pnfpb_httpv1_push') === '1'  && $activity_id > 0) {
								$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																		$commenttitle,
																		substr(stripslashes(strip_tags($localactivitycontent)),0,130),
																		$iconurl,
																		$imageurl,
																		$activitylink,
																		array(),
																		$regid,
																		$mergeddeviceidswebview,
																		$activityuserid,
																		$authoractivityuserid,
																		$pushtype							
																		);
						}
						else {
							if ($activity_id > 0) {
								$this->PNFPB_icfcm_legacy_send_push_notification(0,
																		$commenttitle,
																		substr(stripslashes(strip_tags($localactivitycontent)),0,130),
																		$iconurl,
																		$imageurl,
																		$activitylink,
																		array(),
																		$regid,
																		array(),
																		$activityuserid,
																		$authoractivityuserid															
																		);
							}
						}
						
					}
				
					if (count($mergeddeviceidswebview ) > 0 && $activity_id > 0) {
						// prepare the message
						$this->PNFPB_icfcm_legacy_send_push_notification(0,
																		$commenttitle,
																		substr(stripslashes(strip_tags($localactivitycontent)),0,130),
																		$iconurl,
																		$imageurl,
																		"",
																		array('click_url' => $activitylink),
																		array(),
																		$mergeddeviceidswebview,
																		$activityuserid,
																		$authoractivityuserid															
																		);
					}
				}
        
			}

		}
		
		/*
		 * Push Notification when contact form7 submitted
		 * 
		 * @since 1.58
		 *
		 */
		public function pnfpb_contact_form7_send_mail() {
			
			$super_admins = get_users('role=administrator');
			
			if( $super_admins ) {
				
				foreach ($super_admins as $adminuser) {
					
					if( isset($adminuser->ID) && !empty($adminuser->ID) ) {
						
	            			$apiaccesskey = get_option('pnfpb_ic_fcm_google_api');

							if (get_option('pnfpb_ic_fcm_contact_form7_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false) || (get_option('pnfpb_ic_fcm_contact_form7_enable') == 1 && get_option( 'pnfpb_onesignal_push' ) === '1')) {
				
									global $wpdb;
				
									$new_user_name = bp_core_get_user_displayname( $adminuser->ID );

									$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
									$url = 'https://fcm.googleapis.com/fcm/send';

									$activity_content_push = 'You got a new message from contact form';
				
									$notificationtitle = __('New message from contact us page',PNFPB_TD);
				
									$titletext = get_option('pnfpb_ic_fcm_buddypress_contact_form7_text_enable');
				
									if ( $titletext && $titletext !== '') {
										$notificationtitle = str_replace("[user name]", $new_user_name, $titletext);
									}
				
									$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
	
									// Send an email to each recipient.
									//foreach ( $recipients as $recipient ) {

									$messageurl = esc_url( admin_url('users.php'));
								
									$activity_content_push = '';
								
									if (get_option('pnfpb_ic_fcm_buddypress_contact_form7_content_enable') != false && get_option('pnfpb_ic_fcm_buddypress_contact_form7_content_enable') != '') {
										$activity_content_push = get_option('pnfpb_ic_fcm_buddypress_contact_form7_content_enable');
									}

									$activity_content_push = str_replace("[user name]", $new_user_name, $activity_content_push);								
								
									if (get_option('pnfpb_onesignal_push') === '1') {
										
										$target_userid_array = array();
										if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
											$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE device_id LIKE '%onesignal%' LIMIT 2000" );
											$target_userid_array = array_map(function ($value) {
    											return $value == 1 ? '1pnfpbadm' : $value;
											}, $target_userid_array_values);						
										}										
						
										$response = $this->PNFPB_icfcm_onesignal_push_notification($adminuser->ID,$notificationtitle,$activity_content_push,$messageurl,'',$target_userid_array);
							
									} else {									
					
										if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
											if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
												$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = {$adminuser->ID} AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1') LIMIT 1000"  );												
											} else {
												$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = {$adminuser->ID} AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1') LIMIT 1000"  );
											}
										} else {
											if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
												$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = {$adminuser->ID} LIMIT 1000"  );				
											} else {
												$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = {$adminuser->ID} LIMIT 1000"  );
											}
										}
					
										update_user_meta(1,'super_admins_contactform722', $deviceids);
										$webview = false;
										if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
											$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND userid = {$adminuser->ID} LIMIT 1000"  );											
										} else {
											$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND userid = {$adminuser->ID} LIMIT 1000"  );
										}
					

					
										$imageurl = '';
					
										$iconurl =	bp_core_fetch_avatar ( 
    											array(  'item_id'   => $adminuser->ID,       // output user id of post author
            											'type'      => 'full',
            											'html'      => FALSE    // FALSE = return url, TRUE (default) = return url wrapped with html
   									 				) 
												);
				

										if (count($deviceids) > 0) {

											$regid = $deviceids;
												if (get_option('pnfpb_httpv1_push') === '1') {
													$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																		$notificationtitle,
																		stripslashes(strip_tags($activity_content_push)),
																		$iconurl,
																		$imageurl,
																		$messageurl,
																		array(),
																		$regid,
																		$deviceidswebview,
																		$adminuser->ID,
																		0
																		);	
											}
											else {											
												$this->PNFPB_icfcm_legacy_send_push_notification(0,
																		$notificationtitle,
																		stripslashes(strip_tags($activity_content_push)),
																		$iconurl,
																		$imageurl,
																		$messageurl,
																		array(),
																		$regid,
																		array(),
																		$adminuser->ID,
																		0
																		);
											}
											do_action('PNFPB_connect_to_external_api_for_contact_form7_send_mail');
										}

										if (count($deviceidswebview) > 0) {

											$regid = $deviceidswebview;
						
											if (get_option('pnfpb_ic_fcm_buddypress_contact_form7_content_enable') != false && get_option('pnfpb_ic_fcm_buddypress_contact_form7_content_enable') != '') {
												$activity_content_push = get_option('pnfpb_ic_fcm_buddypress_contact_form7_content_enable');
											}
											$this->PNFPB_icfcm_legacy_send_push_notification(0,
																		$notificationtitle,
																		stripslashes(strip_tags($activity_content_push)),
																		$iconurl,
																		$imageurl,
																		"",
																		array('thread_id' => $thread_id,'click_url' => $messageurl),
																		array(),
																		$regid,
																		$adminuser->ID,
																		0
																		);
											do_action('PNFPB_connect_to_external_api_for_contact_form7_send_mail_webview');
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
		public function pnfpb_new_user_registrations($user_id) {
			
			$user_meta = get_userdata( $user_id );

			if ( empty( $user_meta ) ) {
				return;
			}
			
			$super_admins = get_users('role=administrator');
			
			if( $super_admins ) {
				
				foreach ($super_admins as $adminuser) {
					
					if( isset($adminuser->ID) && !empty($adminuser->ID) ) {
						
						/* $user_meta->user_login */
						
            			$apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
        
						if (get_option('pnfpb_ic_fcm_new_user_registration_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false) || (get_option('pnfpb_ic_fcm_new_user_registration_enable') == 1 && get_option( 'pnfpb_onesignal_push' ) === '1')) {
				
							global $wpdb;
				
							$new_user_name = bp_core_get_user_displayname( $user_id );

							$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
							$url = 'https://fcm.googleapis.com/fcm/send';

							$activity_content_push = 'New user registered in '.get_bloginfo( 'name' );
				
							$notificationtitle = $new_user_name.__(' registered as new member',PNFPB_TD);
				
							$titletext = get_option('pnfpb_ic_fcm_buddypress_new_user_registration_text_enable');
				
							if ( $titletext && $titletext !== '') {
								$notificationtitle = str_replace("[user name]", $new_user_name, $titletext);
							}
				
							$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
	

							$messageurl = esc_url( admin_url('users.php'));
							
							if (get_option('pnfpb_ic_fcm_buddypress_new_user_registration_content_enable') != false && get_option('pnfpb_ic_fcm_buddypress_new_user_registration_content_enable') != '') {
								$activity_content_push = get_option('pnfpb_ic_fcm_buddypress_new_user_registration_content_enable');
							}
										
							$activity_content_push = str_replace("[user name]", $new_user_name, $activity_content_push);							
									
							if (get_option('pnfpb_onesignal_push') === '1') {
								
								$target_userid_array = array();
								if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
											$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE device_id LIKE '%onesignal%' LIMIT 2000" );
											$target_userid_array = array_map(function ($value) {
    											return $value == 1 ? '1pnfpbadm' : $value;
											}, $target_userid_array_values);						
									}								
						
								$response = $this->PNFPB_icfcm_onesignal_push_notification($group_id,$grouptitle,$localactivitycontent,$group_link,$group_image,$target_userid_array);
							
							} else {										
									if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = {$adminuser->ID} LIMIT 1000"  );									
									} else {
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = {$adminuser->ID} LIMIT 1000"  );
									}
					
					
									$webview = false;
									if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
										$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND userid = {$adminuser->ID} LIMIT 1000"  );										
									} else {
										$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND userid = {$adminuser->ID} LIMIT 1000"  );
									}
					
					
									$imageurl = '';
					
									$iconurl =	bp_core_fetch_avatar ( 
    											array(  'item_id'   => $user_id,       // output user id of post author
            											'type'      => 'full',
            											'html'      => FALSE    // FALSE = return url, TRUE (default) = return url wrapped with html
   									 				) 
												);
				
									
									if (count($deviceids) > 0) {

										$regid = $deviceids;
											if (get_option('pnfpb_httpv1_push') === '1') {
												$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																		$notificationtitle,
																		stripslashes(strip_tags($activity_content_push)),
																		$iconurl,
																		$imageurl,
																		$messageurl,
																		array(),
																		$regid,
																		$deviceidswebview,
																		$user_id,
																		0						 
																		);	
										}
										else {										
											$this->PNFPB_icfcm_legacy_send_push_notification(0,
																		$notificationtitle,
																		stripslashes(strip_tags($activity_content_push)),
																		$iconurl,
																		$imageurl,
																		$messageurl,
																		array(),
																		$regid,
																		array(),
																		$user_id,
																		0					 
																		);
										}

										do_action('PNFPB_connect_to_external_api_for_private_messages');
									}

									if (count($deviceidswebview) > 0) {

										$regid = $deviceidswebview;
						
										if (get_option('pnfpb_ic_fcm_new_user_registration_text') != false && get_option('pnfpb_ic_fcm_new_user_registration_text') != '') {
											$activity_content_push = get_option('pnfpb_ic_fcm_new_user_registration_text');
										}
										
										$activity_content_push = str_replace("[user name]", $sender_name, $activity_content_push);
										$this->PNFPB_icfcm_legacy_send_push_notification(0,
																		$notificationtitle,
																		stripslashes(strip_tags($activity_content_push)),
																		$iconurl,
																		$imageurl,
																		"",
																		array('click_url' => $messageurl),
																		array(),
																		$regid,
																		0
																		);
										do_action('PNFPB_connect_to_external_api_for_private_messages_webview');
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
		public function pnfpb_buddypress_group_details_updated_notification($group_id) {
			
			global $wpdb;

			$apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
			
			$imageurl = '';
			
			$group_name = bp_get_group_name( groups_get_group( $group_id));
			
			$group_link = bp_get_group_permalink( groups_get_group( $group_id));
			
			$group_image = bp_get_group_avatar_url( groups_get_group( $group_id));
				
			if (get_option('pnfpb_ic_fcm_group_details_updated_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false) || (get_option('pnfpb_ic_fcm_group_details_updated_enable') == 1 && get_option( 'pnfpb_onesignal_push' ) === '1')) {
				
				$bpgroup = '';
					
				$bpgroupid = null;

				if ($group_id) {

					$bpgroupid = $group_id;
						
				}
				
				$blog_title = get_bloginfo( 'name' );
            
				if (get_option('pnfpb_ic_fcm_buddypress_group_details_updated_text_enable') != false && get_option('pnfpb_ic_fcm_buddypress_group_details_updated_text_enable') != '') {
						$grouptitle = get_option('pnfpb_ic_fcm_buddypress_group_details_updated_text_enable');
				}
				else
				{
						$grouptitle = __('Group update ',PNFPB_TD).$group_name;
				}
					
				$grouptitle = str_replace("[group name]", $group_name, $grouptitle);
					
					
				if (get_option('pnfpb_ic_fcm_buddypress_group_details_updated_content_enable') != false && get_option('pnfpb_ic_fcm_buddypress_group_details_updated_content_enable') != '') {
						
					$localactivitycontent = get_option('pnfpb_ic_fcm_buddypress_group_details_updated_content_enable');
						
				}	
				else 
				{						
					$localactivitycontent = $group_name.__(" group details updated",PNFPB_TD);
				}
					
				$localactivitycontent = str_replace("[group name]", $group_name, $localactivitycontent);				
				
				if (get_option('pnfpb_onesignal_push') === '1') {
					
					$target_userid_array = array();
					if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
						$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE device_id LIKE '%onesignal%' LIMIT 2000" );
						$target_userid_array = array_map(function ($value) {
    						return $value == 1 ? '1pnfpbadm' : $value;
						}, $target_userid_array_values);						
					}					
						
					$response = $this->PNFPB_icfcm_onesignal_push_notification($group_id,$grouptitle,$localactivitycontent,$group_link,$group_image,$target_userid_array);
							
				} else {					
	
					$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
					
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1 OR subscription_option = '' OR subscription_option IS NULL) = '1')" );
						
					}
					else				
					{

							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%'" );
							
					}
					
					$webview = false;
					
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
					
							$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );	
						
					}
					else {
						
						$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%'" );							
					}
					
					for ($dcount=0; $dcount<=count($deviceids_count); $dcount+=1000) {					
					
						if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
								if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
									$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
								} else {
									$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
								}
						}
						else				
						{

							if (get_option('pnfpb_shortcode_enable') === 'yes') {
									if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );										
									} else {
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
									}
						
								}							
								else 
								{
									if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' LIMIT {$dcount}, 1000" );										
									} else {
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' LIMIT {$dcount}, 1000" );
									}
								
								}
						}
					

						$url = 'https://fcm.googleapis.com/fcm/send';

						$regid = $deviceids;
					
						if (count($regid) > 0) {
							// prepare the message
							// 
							if (get_option('pnfpb_httpv1_push') === '1') {
									$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																	$grouptitle,
																	stripslashes(strip_tags($localactivitycontent)),
																	$group_image,
																	$imageurl,
																	$grouplink,
																	array(),
																	$regid,
																	$deviceids_webview_count,
																	$group_id,
																	0				 
																	);
							}
							else {							
								$this->PNFPB_icfcm_legacy_send_push_notification(0,
																	$grouptitle,
																	stripslashes(strip_tags($localactivitycontent)),
																	$group_image,
																	$imageurl,
																	$grouplink,
																	array(),
																	$regid,
																	array(),
																	$group_id,
																	0			 
																	);
							}
							do_action('PNFPB_connect_to_external_api_for_group_details_updated_notification');
						}
					}
					
					for ($dcount=0; $dcount<=count($deviceids_webview_count); $dcount+=1000) {	
					
						$webview = false;
						
						if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
							
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );								
							} else {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
							}
						}
						else 
						{
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' LIMIT {$dcount}, 1000" );								
							} else {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' LIMIT {$dcount}, 1000" );
							}
						}
				
						if (count($deviceidswebview) > 0) {
							// prepare the message
							$this->PNFPB_icfcm_legacy_send_push_notification(0,
																	$grouptitle,
																	stripslashes(strip_tags($localactivitycontent)),
																	$group_image,
																	$imageurl,
																	"",
																	array('click_url' => $grouplink),
																	array(),
																	$deviceidswebview,
																	$group_id,
																	0			 
																	);
							do_action('PNFPB_connect_to_external_api_for_group_details_updated_notification');
						}
					}
				}
			}
			
		}
		
		/*
		 * 
		 * Push Notification for Group details updated
		 * Push Notification for Group invitation sent
		 * 
		 * @since 1.58 
		 */
		public function pnfpb_buddypress_group_invitation_notification($group_id,$invited_users,$inviter_id) {
			
            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
			
			$group_name = bp_get_group_name( groups_get_group( $group_id));
			
      		$group_image = bp_get_group_avatar_url( groups_get_group( $group_id));
			
			$group_link = bp_get_group_permalink( groups_get_group( $group_id));
			
			if (get_option('pnfpb_ic_fcm_group_invitation_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false) || (get_option('pnfpb_ic_fcm_group_invitation_enable') == 1 && get_option( 'pnfpb_onesignal_push' ) === '1')) {
				
				global $wpdb;
				
				$sender_name = bp_core_get_user_displayname( $inviter_id );

				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
				$url = 'https://fcm.googleapis.com/fcm/send';

				$notificationcontent = $sender_name.__(' invited you to join in group ',PNFPB_TD).$group_name;
				
				$notificationtitle = __('Group invite to join in group ',PNFPB_TD).$group_name;
				
				$titletext = get_option('pnfpb_ic_fcm_buddypress_group_invitation_text_enable');
				
				$notificationtitle = '';
				
				if ( $titletext && $titletext !== '') {
					$notificationtitle = str_replace("[sender name]", $sender_name, $titletext);
					$notificationtitle = str_replace("[group name]", $group_name, $notificationtitle);
				}
				
				$contenttext = get_option('pnfpb_ic_fcm_buddypress_group_invitation_content_enable');
				
				$notificationcontent = '';
				
				if ( $contenttext && $contenttext !== '') {
					$notificationcontent = str_replace("[sender name]", $sender_name, $contenttext);
					$notificationcontent = str_replace("[group name]", $group_name, $notificationcontent);
				}
				
				
				$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
	
				// Send an email to each recipient.
				foreach ( $invited_users as $invited_user ) {
					
					if (get_option('pnfpb_onesignal_push') === '1') {
						
						$target_userid_array = array();
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE device_id LIKE '%onesignal%' LIMIT 2000" );
							$target_userid_array = array_map(function ($value) {
    							return $value == 1 ? '1pnfpbadm' : $value;
							}, $target_userid_array_values);						
						}
						
						$response = $this->PNFPB_icfcm_onesignal_push_notification($group_id,$notificationtitle,$notificationcontent,$group_link,$group_image,$target_userid_array);
							
					} else {					

					
						if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = {$invited_user} AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );							
							} else {
								$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = {$invited_user} AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
							}
						} else {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = {$invited_user} LIMIT 1000"  );							
							} else {
								$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = {$invited_user} LIMIT 1000"  );
							}
						}
					
						$webview = false;
						if ( get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND userid = {$invited_user} AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );								
							} else {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND userid = {$invited_user} AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
							}
						}
						else {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND userid = {$invited_user}  LIMIT 1000"  );								
							} else {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND userid = {$invited_user}  LIMIT 1000"  );
							}
						}
					

					
						$imageurl = '';
					
						$iconurl =	bp_core_fetch_avatar ( 
    							array(  'item_id'   => $invited_user,       // output user id of post author
            							'type'      => 'full',
            							'html'      => FALSE    // FALSE = return url, TRUE (default) = return url wrapped with html
   									 ) 
								);
				

						if (count($deviceids) > 0) {

							$regid = $deviceids;
							
							if (get_option('pnfpb_httpv1_push') === '1') {
									$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																	$grouptitle,
																	stripslashes(strip_tags($localactivitycontent)),
																	$group_image,
																	$imageurl,
																	"",
																	array('click_url' => $grouplink),
																	$regid,
																	$deviceidswebview,
																	$group_id,
																	0				 
																	);
							}
							else {							
								$this->PNFPB_icfcm_legacy_send_push_notification(0,
																	$grouptitle,
																	stripslashes(strip_tags($localactivitycontent)),
																	$group_image,
																	$imageurl,
																	"",
																	array('click_url' => $grouplink),
																	$regid,
																	array(),
																	$group_id,
																	0			 
																	);
							}

							do_action('PNFPB_connect_to_external_api_for_group_invitation_notification');
						}

						if (count($deviceidswebview) > 0) {

							$regid = $deviceidswebview;
							$this->PNFPB_icfcm_legacy_send_push_notification(0,
																	$grouptitle,
																	stripslashes(strip_tags($localactivitycontent)),
																	$group_image,
																	$imageurl,
																	"",
																	array('click_url' => $grouplink),
																	array(),
																	$deviceidswebview,
																	$group_id,
																	0
																	);
							do_action('PNFPB_connect_to_external_api_for_group_invitation_notification_webview');
						}
					}
				}
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
		public function pnfpb_buddypress_setup_notification_settings_nav() {
			
			global $bp;
			
			if ( ! bp_is_active( 'settings' )  || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '0' || ! get_option('pnfpb_ic_fcm_frontend_enable_subscription') ) {
				return;
			}
			
			if (!get_option('pnfpb_ic_fcm_loggedin_notify') || (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1' && is_user_logged_in()) || (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') !== '1')) {			

				// Determine user to use.
				if ( bp_displayed_user_domain() ) {
					$user_domain = bp_displayed_user_domain();
				} elseif ( bp_loggedin_user_domain() ) {
					$user_domain = bp_loggedin_user_domain();
				} else {
					return;
				}

				// Get the settings slug.
				$settings_slug = bp_get_settings_slug();

				bp_core_new_subnav_item( array(
					'name'            => _x( 'Push Notification subscription', 'Push Notification subscription sub nav', 'PNFPB_TD' ),
					'slug'            => 'push-subscription',
					'parent_url'      => trailingslashit( $user_domain . 'settings' ),
					'parent_slug'     => $settings_slug,
					'screen_function' => array( $this, "pnfpb_buddypress_notification_settings_function" ),
					'position'        => 30
				) 		);
			}
		}
		
		public function pnfpb_buddypress_notification_settings_function() {
			global $bp;
    		// We never get here for some reason
    		add_action( 'bp_template_title', array( $this, "pnfpb_bp_projects_screen_title" ) );
    		add_action( 'bp_template_content', array( $this, "pnfpb_bp_projects_screen_content" ) );
    		bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );	
		}
		
		public function pnfpb_bp_projects_screen_title() {
			global $bp;

		}
		
		public function pnfpb_bp_projects_screen_content() {
			global $bp, $wpdb;
			$args = array(
  				'public'   => true,
  				'_builtin' => false
			); 
	
			$output = 'names'; // or objects
			$operator = 'and'; // 'and' or 'or'
			$custposttypes = get_post_types( $args, $output, $operator );			
			
			$bpsubscribeoptions = '10000000000';
			
			if (get_option('pnfpb_ic_fcm_frontend_settings_post_text')) {
				
			}
	
		?>
			<form class="standard-form" id="pnfpb_push_notification_frontend-settings-form">
				
				<table class="pnfpb_ic_front_push_notification_settings_table widefat" cellspacing="0">
    				<tbody>
        				<tr class="pnfpb_ic_push_settings_table_row">
							<td class="pnfpb_ic_push_settings_table_column column-columnname">
								<div class="pnfpb_row">
									<?php
										$args = array(
											'public'   => true,
											'_builtin' => false
										); 
	
										$output = 'names'; // or objects
										$operator = 'and'; // 'and' or 'or'
										$custposttypes = get_post_types( $args, $output, $operator );
	    								$frontend_post_push_enable = false;
										foreach ( $custposttypes as $post_type ) {
											if (get_option('pnfpb_ic_fcm_'.$post_type.'_enable') === '1') {
												$frontend_post_push_enable = true;
											}
										}
										if (get_option('pnfpb_ic_fcm_post_enable') === '1') {
											$frontend_post_push_enable = true;
										}
										if ($frontend_post_push_enable) 
										{	
									?>
  										<div class="pnfpb_column pnfpb_column_buddypress_functions">
    										<div class="pnfpb_card">				
												<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_ic_fcm_post_enable"><?php if (get_option('pnfpb_ic_fcm_frontend_settings_post_text')) { echo get_option('pnfpb_ic_fcm_frontend_settings_post_text'); } else { echo __("Post",'PNFPB_TD'); } ?></label>
												<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
													<input id="pnfpb_ic_fcm_front_post_enable" name="pnfpb_ic_fcm_front_post_enable" type="checkbox" value="1"   /> 
													<span class="pnfpb_slider round"></span>
												</label>
											</div>
										</div>
									<?php 
										}
										if (get_option('pnfpb_ic_fcm_bactivity_enable') === '1') {
									?>
									<div class="pnfpb_column pnfpb_column_buddypress_functions">
										<div class="pnfpb_card">
											<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_bactivity_enable">
												<?php if (get_option('pnfpb_ic_fcm_frontend_settings_activities_text')) { echo get_option('pnfpb_ic_fcm_frontend_settings_activities_text'); } else { echo __("Activities",'PNFPB_TD'); } ?>
												
											</label>
											<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
												<input  id="pnfpb_ic_fcm_front_bactivity_enable" name="pnfpb_ic_fcm_front_bactivity_enable" type="checkbox" value="1" />
												<span class="pnfpb_slider round"></span>
											</label>
										</div>
									</div>
									<?php 
										}
										if (get_option('pnfpb_ic_fcm_bcomment_enable') === '1') {
									?>									
									<div class="pnfpb_column pnfpb_column_buddypress_functions">
    									<div class="pnfpb_card">
											<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_bcomment_enable">
												<?php if (get_option('pnfpb_ic_fcm_frontend_settings_comments_text')) { echo get_option('pnfpb_ic_fcm_frontend_settings_comments_text'); } else { echo __("Comments in Activity/Post",'PNFPB_TD'); } ?>
												
											</label>
											<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
												<input  id="pnfpb_ic_fcm_front_bcomment_enable" name="pnfpb_ic_fcm_front_bcomment_enable" type="checkbox" value="1"   />
												<span class="pnfpb_slider round"></span>
											</label>
										</div>
									</div>
									<div class="pnfpb_column pnfpb_column_buddypress_functions">
    									<div class="pnfpb_card">
											<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_mybcomment_enable">
												<?php if (get_option('pnfpb_ic_fcm_frontend_settings_mycomments_text')) { echo get_option('pnfpb_ic_fcm_frontend_settings_mycomments_text'); } else { echo __("Comments in My Activity/My Post",'PNFPB_TD'); } ?>
												
											</label>
											<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
												<input  id="pnfpb_ic_fcm_front_mybcomment_enable" name="pnfpb_ic_fcm_front_mybcomment_enable" type="checkbox" value="1"   />
												<span class="pnfpb_slider round"></span>
											</label>
										</div>
									</div>									
									<?php 
										}
										if (get_option('pnfpb_ic_fcm_bprivatemessage_enable') === '1') {
									?>									
									<div class="pnfpb_column pnfpb_column_buddypress_functions">
    									<div class="pnfpb_card">
											<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_bprivatemessage_enable">
												<?php if (get_option('pnfpb_ic_fcm_frontend_settings_privatemessage_text')) { echo get_option('pnfpb_ic_fcm_frontend_settings_privatemessage_text'); } else { echo __("New private message",'PNFPB_TD'); } ?>
												
											</label>
											<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
												<input  id="pnfpb_ic_fcm_front_bprivatemessage_enable" name="pnfpb_ic_fcm_front_bprivatemessage_enable" type="checkbox" value="1"   />	
												<span class="pnfpb_slider round"></span>
											</label>								
										</div>
									</div>
									<?php 
										}
										if (get_option('pnfpb_ic_fcm_new_member_enable') === '1') {
									?>									
									<div class="pnfpb_column pnfpb_column_buddypress_functions">
    									<div class="pnfpb_card">
											<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_new_member_enable">
												<?php if (get_option('pnfpb_ic_fcm_frontend_settings_newmember_text')) { echo get_option('pnfpb_ic_fcm_frontend_settings_newmember_text'); } else { echo __("New member joined",'PNFPB_TD'); } ?>
												
											</label>
											<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
												<input  id="pnfpb_ic_fcm_front_new_member_enable" name="pnfpb_ic_fcm_front_new_member_enable" type="checkbox" value="1"  />	
												<span class="pnfpb_slider round"></span>
											</label>
										</div>
									</div>
									<?php 
										}
										if (get_option('pnfpb_ic_fcm_friendship_request_enable') === '1') {
									?>									
									<div class="pnfpb_column pnfpb_column_buddypress_functions">
    									<div class="pnfpb_card">
											<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_friendship_request_enable">
												<?php if (get_option('pnfpb_ic_fcm_frontend_settings_friend_request_text')) { echo get_option('pnfpb_ic_fcm_frontend_settings_friend_request_text'); } else { echo __("Friendship request",'PNFPB_TD'); } ?>
											</label>
											<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
												<input  id="pnfpb_ic_fcm_front_friendship_request_enable" name="pnfpb_ic_fcm_front_friendship_request_enable" type="checkbox" value="1"  />	
												<span class="pnfpb_slider round"></span>
											</label>
										</div>
									</div>
									<?php 
										}
										if (get_option('pnfpb_ic_fcm_friendship_accept_enable') === '1') {
									?>									
									<div class="pnfpb_column pnfpb_column_buddypress_functions">
    									<div class="pnfpb_card">
											<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_friendship_accept_enable">
												<?php if (get_option('pnfpb_ic_fcm_frontend_settings_friend_accept_text')) { echo get_option('pnfpb_ic_fcm_frontend_settings_friend_accept_text'); } else { echo __("Friendship accepted",'PNFPB_TD'); } ?>
											</label>
											<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
												<input  id="pnfpb_ic_fcm_front_friendship_accept_enable" name="pnfpb_ic_fcm_front_friendship_accept_enable" type="checkbox" value="1"   />	
												<span class="pnfpb_slider round"></span>
											</label>
										</div>
									</div>
									<?php 
										}
										if (get_option('pnfpb_ic_fcm_avatar_change_enable') === '1') {
									?>									
									<div class="pnfpb_column pnfpb_column_buddypress_functions">
    									<div class="pnfpb_card">
											<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_avatar_change_enable">
												<?php if (get_option('pnfpb_ic_fcm_frontend_settings_avatar_change_text')) { echo get_option('pnfpb_ic_fcm_frontend_settings_avatar_change_text'); } else { echo __("Avatar change",'PNFPB_TD'); } ?>
											</label>
											<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
												<input  id="pnfpb_ic_fcm_front_avatar_change_enable" name="pnfpb_ic_fcm_front_avatar_change_enable" type="checkbox" value="1"  />	
												<span class="pnfpb_slider round"></span>
											</label>
										</div>
									</div>
									<?php 
										}
										if (get_option('pnfpb_ic_fcm_cover_image_change_enable') === '1') {
									?>									
									<div class="pnfpb_column pnfpb_column_buddypress_functions">
    									<div class="pnfpb_card">
											<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_cover_image_change_enable">
												<?php if (get_option('pnfpb_ic_fcm_frontend_settings_coverimage_change_text')) { echo get_option('pnfpb_ic_fcm_frontend_settings_coverimage_change_text'); } else { echo __("Cover image change",'PNFPB_TD'); } ?>
											</label>
											<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
												<input  id="pnfpb_ic_fcm_front_cover_image_change_enable" name="pnfpb_ic_fcm_front_cover_image_change_enable" type="checkbox" value="1"  />	
												<span class="pnfpb_slider round"></span>
											</label>
										</div>
									</div>
									<?php 
										}
										if (get_option('pnfpb_ic_fcm_group_details_updated_enable') === '1') {
									?>									
									<div class="pnfpb_column pnfpb_column_buddypress_functions">
    									<div class="pnfpb_card">
											<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_ic_fcm_group_details_updated_enable">
												<?php if (get_option('pnfpb_ic_fcm_frontend_settings_groupdetails_text')) { echo get_option('pnfpb_ic_fcm_frontend_settings_groupdetails_text'); } else { echo __("Group details update",'PNFPB_TD'); } ?>
											</label>
											<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
												<input  id="pnfpb_ic_fcm_front_group_details_update_enable" name="pnfpb_ic_fcm_front_group_details_update_enable" type="checkbox" value="1"  />	
												<span class="pnfpb_slider round"></span>
											</label>
										</div>
									</div>
									<?php 
										}
										if (get_option('pnfpb_ic_fcm_group_invitation_enable') === '1') {
									?>
									<div class="pnfpb_column pnfpb_column_buddypress_functions">
    									<div class="pnfpb_card">
											<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_ic_fcm_group_invite_enable">
												<?php if (get_option('pnfpb_ic_fcm_frontend_settings_groupinvite_text')) { echo get_option('pnfpb_ic_fcm_frontend_settings_groupinvite_text'); } else { echo __("Group Invites",'PNFPB_TD'); } ?>
											</label>
											<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
												<input  id="pnfpb_ic_fcm_front_group_invite_enable" name="pnfpb_ic_fcm_front_group_invite_enable" type="checkbox" value="1"  />	
												<span class="pnfpb_slider round"></span>
											</label>
										</div>
									</div>
									<?php 
										}
									?>
								</div>
							</td>
						</tr>
    				</tbody>
				</table>
			</form>
			<?php do_action( 'pnfpb_push_notification_frontend_before_submit' ); ?>
			<div class="submit">
				<input id="submit" type="button" class="pnfpb_push_notification_frontend_settings_submit primary" name="pnfpb_push_notification_frontend_settings_submit" value="<?php esc_attr_e( 'Save Settings', 'buddypress' ); ?>" class="auto" />
			</div>
			<?php do_action( 'pnfpb_push_notification_frontend_after_submit' ); ?>
		<?php
			echo '<br/><aside class="screen-heading email-settings-screen pnfpb_ic_front_push_notification_settings_messages bp-feedback bp-messages bp-template-notice"><span class="bp-icon" aria-hidden="true"></span><p class="pnfpb_ic_front_push_notification_settings_text">'.__("Your notification settings have been saved.",'PNFPB_TD').'</p></aside>';		
		}		
		
		/** Shortcode PWA prompt install
		* 
		* 
		* @since 1.45 
		*/
		public function PNFPB_pwa_prompt_shortcode() {
			
			$pwa_install_button_color = '#ffffff';
				
			if ((get_option('pnfpb_ic_fcm_install_pwa_shortcode_button_color')) && (get_option('pnfpb_ic_fcm_install_pwa_shortcode_button_color') !== false) && (get_option('pnfpb_ic_fcm_install_pwa_shortcode_button_color') !== '')) {
					$pwa_install_button_color = get_option('pnfpb_ic_fcm_install_pwa_shortcode_button_color');
			}
				
			$pwa_install_button_text_color = '#000000';
				
			if ((get_option('pnfpb_ic_fcm_install_pwa_shortcode_button_text_color')) && (get_option('pnfpb_ic_fcm_install_pwa_shortcode_button_text_color') !== false) && (get_option('pnfpb_ic_fcm_install_pwa_shortcode_button_text_color') !== '')) {
					$pwa_install_button_text_color = get_option('pnfpb_ic_fcm_install_pwa_shortcode_button_text_color');
			}
			
			$pwa_install_button_text = 'Install Our App';
				
			if (get_option('pnfpb_ic_fcm_install_pwa_shortcode_button_text') && get_option('pnfpb_ic_fcm_install_pwa_shortcode_button_text') !== false && get_option('pnfpb_ic_fcm_install_pwa_shortcode_button_text') !== '') {
					$pwa_install_button_text = get_option('pnfpb_ic_fcm_install_pwa_shortcode_button_text');
			}			
			
			$pnfpb_pwa_prompt_shortcode = '<div id="pnfpb_pwa_shortcode_box" class="pnfpb_pwa_shortcode_box"><button type="button" id="pnfpb_pwa_button" class="pnfpb_pwa_button" style="color:'.$pwa_install_button_text_color.';background-color:'.$pwa_install_button_color.';">'.$pwa_install_button_text.'</button></div>';
			
			return $pnfpb_pwa_prompt_shortcode;
		}

		

	    /**
	    * Shortcode - UnSubscribe push notification.
	    *
	    *
	    * @since 1.1.1
	    */
	    public function PNFPB_subscribe_push_notification_shortcode() {
			
			if (!get_option('pnfpb_ic_fcm_loggedin_notify') || (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1' && is_user_logged_in()) || (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') !== '1')) {
			
					$subscribe_button_text_color = '#ffffff';
				
					if ((get_option('pnfpb_ic_fcm_subscribe_button_text_color')) && (get_option('pnfpb_ic_fcm_subscribe_button_text_color') !== false) && (get_option('pnfpb_ic_fcm_subscribe_button_text_color') !== '')) {
						$subscribe_button_text_color = get_option('pnfpb_ic_fcm_subscribe_button_text_color');
					}
				
					$subscribe_button_color = '#000000';
				
					if ((get_option('pnfpb_ic_fcm_subscribe_button_color')) && (get_option('pnfpb_ic_fcm_subscribe_button_color') !== false) && (get_option('pnfpb_ic_fcm_subscribe_button_color') !== '')) {
						$subscribe_button_color = get_option('pnfpb_ic_fcm_subscribe_button_color');
					}
			
					$unsubscribe_shortcode_dialog_text = __('Change push subscriptions',PNFPB_TD);
				
					if (get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text') && get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text') !== false && get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text') !== '') {
						$unsubscribe_shortcode_dialog_text = get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text');
					}
				
					$subscribe_shortcode_dialog_text = __('Subscribe push notifications',PNFPB_TD);
				
					if (get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text') && get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text') !== false && get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text') !== '') {
						$subscribe_shortcode_dialog_text = get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text');
					}
			
					$subscribe_all_shortcode_dialog_text = __('All notifications',PNFPB_TD);
				
					if (get_option('pnfpb_ic_fcm_subscribe_all_dialog_text') && get_option('pnfpb_ic_fcm_subscribe_all_dialog_text') !== false && get_option('pnfpb_ic_fcm_subscribe_all_dialog_text') !== '') {
						$subscribe_all_shortcode_dialog_text = get_option('pnfpb_ic_fcm_subscribe_all_dialog_text');
					}
			
					$subscribe_post_activities_shortcode_dialog_text = __('Post/activity',PNFPB_TD);
				
					if (get_option('pnfpb_ic_fcm_subscribe_post_activity_dialog_text') && get_option('pnfpb_ic_fcm_subscribe_post_activity_dialog_text') !== false && get_option('pnfpb_ic_fcm_subscribe_post_activity_dialog_text') !== '') {
						$subscribe_post_activities_shortcode_dialog_text = get_option('pnfpb_ic_fcm_subscribe_post_activity_dialog_text');
					}
			
			
					$subscribe_all_comments_shortcode_dialog_text = __('Comments',PNFPB_TD);
				
					if (get_option('pnfpb_ic_fcm_subscribe_all_comments_dialog_text') && get_option('pnfpb_ic_fcm_subscribe_all_comments_dialog_text') !== false && get_option('pnfpb_ic_fcm_subscribe_all_comments_dialog_text') !== '') {
						$subscribe_all_comments_shortcode_dialog_text = get_option('pnfpb_ic_fcm_subscribe_all_comments_dialog_text');
					}
			
					$subscribe_mypost_comments_shortcode_dialog_text = __('My Posts/my activities',PNFPB_TD);
				
					if (get_option('pnfpb_ic_fcm_subscribe_my_comments_dialog_text') && get_option('pnfpb_ic_fcm_subscribe_my_comments_dialog_text') !== false && get_option('pnfpb_ic_fcm_subscribe_my_comments_dialog_text') !== '') {
						$subscribe_mypost_comments_shortcode_dialog_text = get_option('pnfpb_ic_fcm_subscribe_my_comments_dialog_text');
					}
			
					$subscribe_private_message_shortcode_dialog_text = __('Private messages',PNFPB_TD);
				
					if (get_option('pnfpb_ic_fcm_subscribe_private_message_dialog_text') && get_option('pnfpb_ic_fcm_subscribe_private_message_dialog_text') !== false && get_option('pnfpb_ic_fcm_subscribe_private_message_dialog_text') !== '') {
						$subscribe_private_message_shortcode_dialog_text = get_option('pnfpb_ic_fcm_subscribe_private_message_dialog_text');
					}
						
			
					$subscribe_new_member_shortcode_dialog_text = __('New member joined',PNFPB_TD);
				
					if (get_option('pnfpb_ic_fcm_subscribe_new_member_dialog_text') && get_option('pnfpb_ic_fcm_subscribe_new_member_dialog_text') !== false && get_option('pnfpb_ic_fcm_subscribe_new_member_dialog_text') !== '') {
						$subscribe_new_member_shortcode_dialog_text = get_option('pnfpb_ic_fcm_subscribe_new_member_dialog_text');
					}
			
					$subscribe_friendship_request_shortcode_dialog_text = __('Friend requests',PNFPB_TD);
				
					if (get_option('pnfpb_ic_fcm_subscribe_friendship_request_dialog_text') && get_option('pnfpb_ic_fcm_subscribe_friendship_request_dialog_text') !== false && get_option('pnfpb_ic_fcm_subscribe_friendship_request_dialog_text') !== '') {
						$subscribe_friendship_request_shortcode_dialog_text = get_option('pnfpb_ic_fcm_subscribe_friendship_request_dialog_text');
					}			
			
					$subscribe_friendship_accepted_shortcode_dialog_text = __('Friendship accepted',PNFPB_TD);
				
					if (get_option('pnfpb_ic_fcm_subscribe_friendship_accepted_dialog_text') && get_option('pnfpb_ic_fcm_subscribe_friendship_accepted_dialog_text') !== false && get_option('pnfpb_ic_fcm_subscribe_friendship_accepted_dialog_text') !== '') {
						$subscribe_friendship_accepted_shortcode_dialog_text = get_option('pnfpb_ic_fcm_subscribe_friendship_accepted_dialog_text');
					}
			
					$subscribe_user_avatar_shortcode_dialog_text = __('User avatar change',PNFPB_TD);
				
					if (get_option('pnfpb_ic_fcm_subscribe_user_avatar_dialog_text') && get_option('pnfpb_ic_fcm_subscribe_user_avatar_dialog_text') !== false && get_option('pnfpb_ic_fcm_subscribe_user_avatar_dialog_text') !== '') {
						$subscribe_user_avatar_shortcode_dialog_text = get_option('pnfpb_ic_fcm_subscribe_user_avatar_dialog_text');
					}
			
					$subscribe_cover_image_change_shortcode_dialog_text = __('Cover image change',PNFPB_TD);
				
					if (get_option('pnfpb_ic_fcm_subscribe_cover_image_change_dialog_text') && get_option('pnfpb_ic_fcm_subscribe_cover_image_change_dialog_text') !== false && get_option('pnfpb_ic_fcm_subscribe_cover_image_change_dialog_text') !== '') {
						$subscribe_cover_image_change_shortcode_dialog_text = get_option('pnfpb_ic_fcm_subscribe_cover_image_change_dialog_text');
					}				
			
					$unsubscribe_all_shortcode_dialog_text = __('Un-Subscribe all',PNFPB_TD);
				
					if (get_option('pnfpb_ic_fcm_unsubscribe_all_dialog_text') && get_option('pnfpb_ic_fcm_unsubscribe_all_dialog_text') !== false && get_option('pnfpb_ic_fcm_unsubscribe_all_dialog_text') !== '') {
						$unsubscribe_all_shortcode_dialog_text = get_option('pnfpb_ic_fcm_unsubscribe_all_dialog_text');
					}			
	
		    $pnfpb_notification_shortcode =  '<div id="pnfpb-unsubscribe-notifications" class="pnfpb-unsubscribe-notifications">';
			
		    $pnfpb_notification_shortcode .= '<button type="button" id="pnfpb_unsubscribe_button" class="pnfpb_unsubscribe_button" style="color:'.$subscribe_button_text_color.';background-color:'.$subscribe_button_color.'">'.$unsubscribe_shortcode_dialog_text.'</button>';
		    
		    $pnfpb_notification_shortcode .= '<button type="button" id="pnfpb_subscribe_button" class="pnfpb_subscribe_button" style="color:'.$subscribe_button_text_color.';background-color:'.$subscribe_button_color.'">'.$subscribe_shortcode_dialog_text.'</button></div>';
		
			$pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text = __('You are subscribed. Change/Update subscriptions according to your choice.',PNFPB_TD);
			if (get_option('pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text') && get_option('pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text') !== false && get_option('pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text') !== '') {
				$pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text = get_option('pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text');
			}
			
			$pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text = __('Please wait...subscribing push notification is in progress.',PNFPB_TD);
			if (get_option('pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text') && get_option('pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text') !== false && get_option('pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text') !== '') {
				$pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text = get_option('pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text');
			}
			
			$args = array(
						'public'   => true,
						'_builtin' => false
					); 
	
			$output = 'names'; // or objects
			$operator = 'and'; // 'and' or 'or'
			$custposttypes = get_post_types( $args, $output, $operator );
	    	$frontend_post_push_enable = false;
			foreach ( $custposttypes as $post_type ) {
				if (get_option('pnfpb_ic_fcm_'.$post_type.'_enable') === '1') {
					$frontend_post_push_enable = true;
				}
			}
			if (get_option('pnfpb_ic_fcm_post_enable') === '1') {
				$frontend_post_push_enable = true;
			}
			
		    $pnfpb_notification_shortcode .= '
			<div id="pnfpb_subscribe_dialog_confirm" class="pnfpb_subscribe_dialog_confirm  ui-helper-clearfix" title="Subscribe notification?">
				<div id="pnfpb_subscribe_dialog_confirm_heading_notoken" class="pnfpb_subscribe_dialog_confirm_heading_notoken">'.$pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text.'</div>
				<div id="pnfpb_subscribe_dialog_confirm_heading_token" class="pnfpb_subscribe_dialog_confirm_heading_token">'.$pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text.'</div>				
				<div class="pnfpb_ic_subscription_menu">
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_all_shortcode_enable" name="pnfpb_ic_subscribe_all_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_all_shortcode_enable' ) ).'  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_all_shortcode_enable">'.$subscribe_all_shortcode_dialog_text.'</label>
					</div>
				</div>';
			if ($frontend_post_push_enable || get_option('pnfpb_ic_fcm_bactivity_enable') === '1') {
			 	$pnfpb_notification_shortcode .= '
					<div class="pnfpb_ic_subscription_menu">
						<div class="pnfpb_ic_subscription_input">
							<input id="pnfpb_ic_subscribe_post_activities_shortcode_enable" name="pnfpb_ic_subscribe_post_activities_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_post_activities_shortcode_enable' ) ).'  />
						</div>
						<div class="pnfpb_ic_subscription_checkbox">
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_post_activities_shortcode_enable">'.$subscribe_post_activities_shortcode_dialog_text.'</label>
						</div>
					</div>';
			}
			if (get_option('pnfpb_ic_fcm_bcomment_enable') === '1' && get_option('pnfpb_ic_fcm_buddypress_comments_radio_enable') === '1') {
			 	$pnfpb_notification_shortcode .= '
					<div class="pnfpb_ic_subscription_menu">
						<div class="pnfpb_ic_subscription_input">
							<input id="pnfpb_ic_subscribe_all_comments_shortcode_enable" name="pnfpb_ic_subscribe_all_comments_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_all_comments_shortcode_enable' ) ).'  />
						</div>
						<div class="pnfpb_ic_subscription_checkbox">
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_all_comments_shortcode_enable">'.$subscribe_all_comments_shortcode_dialog_text.'</label>
						</div>
					</div>';
			}
			if (get_option('pnfpb_ic_fcm_bprivatemessage_enable') === '1') {
			 $pnfpb_notification_shortcode .= '
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_private_message_shortcode_enable" name="pnfpb_ic_subscribe_private_message_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_private_message_shortcode_enable' ) ).'  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_private_message_shortcode_enable">'.$subscribe_private_message_shortcode_dialog_text.'</label>
					</div>
				</div>';
			}
			if (get_option('pnfpb_ic_fcm_new_member_enable') === '1') {
			 $pnfpb_notification_shortcode .= '
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_new_member_shortcode_enable" name="pnfpb_ic_subscribe_new_member_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_new_member_shortcode_enable' ) ).'  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_new_member_shortcode_enable" >'.$subscribe_new_member_shortcode_dialog_text.'</label>
					</div>
				</div>';
			}
			if (get_option('pnfpb_ic_fcm_friendship_request_enable') === '1') {
			 $pnfpb_notification_shortcode .= '
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_friendship_request_shortcode_enable" name="pnfpb_ic_subscribe_friendship_request_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_friendship_request_shortcode_enable' ) ).'  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_friendship_request_shortcode_enable" >'.$subscribe_friendship_request_shortcode_dialog_text.'</label>
					</div>
				</div>';
			}
			if (get_option('pnfpb_ic_fcm_friendship_accept_enable') === '1') {
			 $pnfpb_notification_shortcode .= '
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_friendship_accepted_shortcode_enable" name="pnfpb_ic_subscribe_friendship_accepted_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_friendship_accepted_shortcode_enable' ) ).'  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_friendship_accepted_shortcode_enable" >'.$subscribe_friendship_accepted_shortcode_dialog_text.'</label>
					</div>
				</div>';
			}
			if (get_option('pnfpb_ic_fcm_avatar_change_enable') === '1') {
			 $pnfpb_notification_shortcode .= '
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_user_avatar_shortcode_enable" name="pnfpb_ic_subscribe_user_avatar_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_user_avatar_shortcode_enable' ) ).'  />
					</div>
					<div  class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_user_avatar_shortcode_enable">'.$subscribe_user_avatar_shortcode_dialog_text.'</label>
					</div>
				</div>';
			}
			if (get_option('pnfpb_ic_fcm_cover_image_change_enable') === '1') {
			 $pnfpb_notification_shortcode .= '
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_cover_image_change_shortcode_enable" name="pnfpb_ic_subscribe_cover_image_change_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_cover_image_change_shortcode_enable' ) ).'  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_cover_image_change_shortcode_enable" >'.$subscribe_cover_image_change_shortcode_dialog_text.'</label>
					</div>
				</div>';
			}
			if (get_option('pnfpb_ic_fcm_bcomment_enable') === '1' && get_option('pnfpb_ic_fcm_buddypress_comments_radio_enable') === '2') {
			 $pnfpb_notification_shortcode .= '
				<div class="pnfpb_ic_subscription_menu">
					<div   class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_my_post_shortcode_enable" name="pnfpb_ic_subscribe_my_post_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_my_post_shortcode_enable' ) ).'  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_my_post_shortcode_enable">'.$subscribe_mypost_comments_shortcode_dialog_text.'</label>
					</div>
				</div>';
			}
			 $pnfpb_notification_shortcode .= '
				<div class="pnfpb_ic_subscription_menu"><div class="pnfpb_ic_subscription_input">
					<input id="pnfpb_ic_unsubscribe_all_shortcode_enable" name="pnfpb_ic_unsubscribe_all_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_unsubscribe_all_shortcode_enable' ) ).'  />
				</div>
				<div class="pnfpb_ic_subscription_checkbox"> 
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_unsubscribe_all_shortcode_enable">'.$unsubscribe_all_shortcode_dialog_text.'</label>
				</div>
			</div>
		</div>';
		
		    $pnfpb_notification_shortcode .= '<div id="pnfpb-unsubscribe-dialog" title="Confirmation"><div id="pnfpb-unsubscribe-alert-msg" class="pnfpb-unsubscribe-alert-msg"></div></div>';
			
			
            return $pnfpb_notification_shortcode;
			}
		
	    }
		
		/**
	    * Subscription to notification for users who joined in specific groups
	    * Group notification
	    *
	    * @since 1.8
	    */
		public function PNFPB_subscribe_to_group_button($grp_btn = array()) {
			global $groups_template, $wpdb;

			if ( isset( $GLOBALS['groups_template']->group ) ) {
				$group = $GLOBALS['groups_template']->group;
			} else {
				$group = groups_get_current_group();
			}
			
			$bpuserid = 0;

			if ( is_user_logged_in() && get_option('pnfpb_ic_fcm_buddypress_enable') == 2 ) {
				
    				$bpuserid = get_current_user_id();
			
					$cookievalue = '';
					if(isset($_COOKIE['pnfpb_group_push_notification_'.$group->id])) {
						$cookievalue = $_COOKIE['pnfpb_group_push_notification_'.$group->id];
					}
			
					$table = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
					
					$deviceid_select_status = 0;
					
                    $isWebView = false;
                    
					if((strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile/') !== false) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/') == false)) {
    					$isWebView = true;
					}
					
                    if (strpos($_SERVER['HTTP_USER_AGENT'], 'wv') !== false) {
						
                    	$isWebView = true;
                    }
				
                    
					if ($cookievalue != '' && $isWebView) {					

						$deviceid_select_status = $wpdb->query("SELECT * FROM {$table} WHERE device_id LIKE '%!!{$group->id}%' AND device_id LIKE '%webview%' AND userid = {$bpuserid}");      
                    }
                    else
                    {
						$deviceid_select_status = $wpdb->query("SELECT * FROM {$table} WHERE device_id LIKE '%!!{$group->id}!!{$cookievalue}%' AND userid = {$bpuserid}");			                       }
				
				
					$unsubscribe_button_text = __('Unsubscribe push notifications',PNFPB_TD);
				
					if (get_option('pnfpb_ic_fcm_unsubscribe_button_text') && get_option('pnfpb_ic_fcm_unsubscribe_button_text') !== false && get_option('pnfpb_ic_fcm_unsubscribe_button_text') !== '') {
						$unsubscribe_button_text = get_option('pnfpb_ic_fcm_unsubscribe_button_text');
					}
				
					$subscribe_button_text = __('Subscribe to push notifications',PNFPB_TD);
				
					if (get_option('pnfpb_ic_fcm_subscribe_button_text') && get_option('pnfpb_ic_fcm_subscribe_button_text') !== false && get_option('pnfpb_ic_fcm_subscribe_button_text') !== '') {
						$subscribe_button_text = get_option('pnfpb_ic_fcm_subscribe_button_text');
					}
					

					$subscribe_button_icon_text = '';
				
					$unsubscribe_button_icon_text = '';

					if (get_option('pnfpb_subscribe_group_push_notification_icon') && get_option('pnfpb_subscribe_group_push_notification_icon') !== false && get_option('pnfpb_subscribe_group_push_notification_icon') !== '') {
						$subscribe_button_icon_text = get_option('pnfpb_subscribe_group_push_notification_icon');
					}
				
					if (get_option('pnfpb_unsubscribe_group_push_notification_icon') && get_option('pnfpb_unsubscribe_group_push_notification_icon') !== false && get_option('pnfpb_unsubscribe_group_push_notification_icon') !== '') {
						$unsubscribe_button_icon_text = get_option('pnfpb_unsubscribe_group_push_notification_icon');
					}
				
					$link_subscribe_text = $subscribe_button_text;
				
					$link_unsubscribe_text = $unsubscribe_button_text;
				
					if ($subscribe_button_icon_text != '' && (get_option('pnfpb_subscribe_group_push_notification_icon_enable') && get_option('pnfpb_subscribe_group_push_notification_icon_enable') === '1')) {
						$link_subscribe_text = '<img src="'.$subscribe_button_icon_text.'" alt="'.$subscribe_button_text.'"/>';
					}
				
					if ($unsubscribe_button_icon_text != '' && (get_option('pnfpb_subscribe_group_push_notification_icon_enable') && get_option('pnfpb_subscribe_group_push_notification_icon_enable') === '1')) {
						$link_unsubscribe_text = '<img src="'.$unsubscribe_button_icon_text.'" alt="'.$unsubscribe_button_text.'"/>';
					}
				if ($deviceid_select_status === 0  && groups_is_user_member( $bpuserid, $group->id )) {
						// Setup button attributes.
						if (get_option('pnfpb_onesignal_push') !== '1') {
        						$button = array(
            					'id'                => 'subscribe_notification_group',
            					'component'         => 'groups',
            					'must_be_logged_in' => true,
            					'block_self'        => false,
            					'wrapper_class'     => 'subscribegroupbutton',
            					'wrapper_id'        => 'subscribegroupbutton-' . $group->id,
            					'link_text'         => $link_subscribe_text,
								'link_href'			=> '',
            					'link_class'        => 'subscribe-notification-group subscribegroupbutton-' . $group->id,
								'button_element'    => 'button',
            					'parent_attr'       => array(
                						'id'    => '',
                						'class' => 'bp-generic-meta groups-meta action subscribegroupbutton',
            					),							
            					'button_attr' => array(
									'data-group-id'		=> $group->id,
									'data-user-id'		=> $bpuserid,
                					'data-title'           => $subscribe_button_text,
                					'data-title-displayed' => $subscribe_button_text
            					)
        					);
						}
						else {
        						$button = array(
            					'id'                => 'subscribe_notification_group',
            					'component'         => 'groups',
            					'must_be_logged_in' => true,
            					'block_self'        => false,
            					'wrapper_class'     => 'subscribegroupbutton subscribe-display-off',
            					'wrapper_id'        => 'subscribegroupbutton-' . $group->id,
            					'link_text'         => $link_subscribe_text,
								'link_href'			=> '',
            					'link_class'        => 'subscribe-notification-group subscribe-display-off subscribegroupbutton-' . $group->id,
								'button_element'    => 'button',
            					'parent_attr'       => array(
                						'id'    => '',
                						'class' => 'bp-generic-meta groups-meta action subscribegroupbutton',
            					),							
            					'button_attr' => array(
									'data-group-id'		=> $group->id,
									'data-user-id'		=> $bpuserid,
                					'data-title'           => $subscribe_button_text,
                					'data-title-displayed' => $subscribe_button_text
            					)
        					);							
						}
					

					}
        			else
					{
						// Setup button attributes.
        				$button = array(
            					'id'                => 'subscribe_notification_group',
            					'component'         => 'groups',
            					'must_be_logged_in' => true,
            					'block_self'        => false,
            					'wrapper_class'     => 'subscribegroupbutton subscribe-display-off',
            					'wrapper_id'        => 'subscribegroupbutton-' . $group->id,
            					'link_text'         => $link_subscribe_text,
								'link_href'			=> '',
            					'link_class'        => 'subscribe-notification-group subscribe-display-off subscribegroupbutton-' . $group->id,
								'button_element'    => 'button',
            					'parent_attr'       => array(
                						'id'    => '',
                						'class' => 'bp-generic-meta groups-meta action subscribegroupbutton subscribe-display-off',
            					),							
            					'button_attr' => array(
									'data-group-id'		=> $group->id,
									'data-user-id'		=> $bpuserid,
                					'data-title'           => $subscribe_button_text,
                					'data-title-displayed' => $subscribe_button_text
            					)
        					);
							
					}
					echo bp_get_button($button);
				
					if ($deviceid_select_status > 0 && groups_is_user_member( $bpuserid, $group->id )) {
						// Setup button attributes.
						if (get_option('pnfpb_onesignal_push') !== '1') {
        					$button = array(
            					'id'                => 'unsubscribe_notification_group',
            					'component'         => 'groups',
            					'must_be_logged_in' => true,
            					'block_self'        => false,
            					'wrapper_class'     => 'unsubscribegroupbutton',
            					'wrapper_id'        => 'unsubscribegroupbutton-' . $group->id,
            					'link_text'         => $link_unsubscribe_text,
								'link_href'			=> '',
            					'link_class'        => 'unsubscribe-notification-group unsubscribegroupbutton-' . $group->id,
								'button_element'    => 'button',
            					'parent_attr'       => array(
                						'id'    => '',
                						'class' => 'bp-generic-meta groups-meta action unsubscribegroupbutton ',
            					),							
            					'button_attr' => array(
								'data-group-id'		=> $group->id,
								'data-user-id'		=> $bpuserid,
                				'data-title'           => $unsubscribe_button_text,
                				'data-title-displayed' => $unsubscribe_button_text
            					)
        					);
							echo bp_get_button($button);
						}
						else {
        					$button = array(
            					'id'                => 'unsubscribe_notification_group',
            					'component'         => 'groups',
            					'must_be_logged_in' => true,
            					'block_self'        => false,
            					'wrapper_class'     => 'unsubscribegroupbutton subscribe-display-off',
            					'wrapper_id'        => 'unsubscribegroupbutton-' . $group->id,
            					'link_text'         => $link_unsubscribe_text,
								'link_href'			=> '',
            					'link_class'        => 'unsubscribe-notification-group subscribe-display-off unsubscribegroupbutton-' . $group->id,
								'button_element'    => 'button',
            					'parent_attr'       => array(
                						'id'    => '',
                						'class' => 'bp-generic-meta groups-meta action unsubscribegroupbutton ',
            					),							
            					'button_attr' => array(
								'data-group-id'		=> $group->id,
								'data-user-id'		=> $bpuserid,
                				'data-title'           => $unsubscribe_button_text,
                				'data-title-displayed' => $unsubscribe_button_text
            					)
        					);							
						}
					}
        			else
					{
						// Setup button attributes.
        				$button = array(
            				'id'                => 'unsubscribe_notification_group',
            				'component'         => 'groups',
            				'must_be_logged_in' => true,
            				'block_self'        => false,
            				'wrapper_class'     => 'unsubscribegroupbutton subscribe-display-off',
            				'wrapper_id'        => 'unsubscribegroupbutton-' . $group->id,
            				'link_text'         => $link_unsubscribe_text,
							'link_href'			=> '',
            				'link_class'        => 'unsubscribe-notification-group subscribe-display-off unsubscribegroupbutton-' . $group->id,
							'button_element'    => 'button',
            				'parent_attr'       => array(
                						'id'    => '',
                						'class' => 'bp-generic-meta groups-meta action unsubscribegroupbutton subscribe-display-off',
            				),							
            				'button_attr' => array(
								'data-group-id'		=> $group->id,
								'data-user-id'		=> $bpuserid,
                				'data-title'           => $unsubscribe_button_text,
                				'data-title-displayed' => $unsubscribe_button_text
            				)
        				);
						echo bp_get_button($button);
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
	    public function PNFPB_unsubscribe_push_callback() {
            global $wpdb;
		    include(plugin_dir_path(__FILE__) . 'public/ajax_routines/pnfpb_update_unsubscribe_deviceids.php');
		    wp_die();			
		
	    }
		
		/**
		* New REST api to get subscription token from Android app/Ios app to send push notifications
		* 
		* @since 1.36
		* 
		*/
		public function PNFPB_rest_api_subscription_tokens_from_app() {
			register_rest_route( 'PNFPBpush/v1', '/subscriptiontoken', array(
   				 'methods' => 'POST',
    			'callback' => array($this,'PNFPB_get_subscription_tokens_from_app'),
				'permission_callback' => '__return_true',
    			'args' => array(
      				'id' => array(
						'sanitize_callback' => function($value, $request, $param) {
							return $value;
						}
      				),
    			),
  			) );
		}
		
		/**
		* Insert subscription token received in rest api from Android app/Ios app for push notifications
		* 
		* @since 1.36
		* 
		*/		
		public function PNFPB_get_subscription_tokens_from_app(WP_REST_Request $request) {
			
			global $wpdb;
			
			$bpuserid = 0;
			
			if ( is_user_logged_in() ) {
		
    			$bpuserid = get_current_user_id();
				
			}
			
			$table = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
		
			$dbname = $wpdb->dbname;

			$is_firebase_version_col = $wpdb->get_results(  "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `table_name` = '{$table}' AND `TABLE_SCHEMA` = '{$dbname}' AND `COLUMN_NAME` = 'firebase_version'"  );

			if( empty($is_firebase_version_col) ):
				$add_status_column = "ALTER TABLE `{$table}` ADD `firebase_version` VARCHAR(100) DEFAULT 'L'; ";
				$wpdb->query( $add_firebase_version_column );
			endif;			
			
			

            if (isset($request['userid'])) {
            	$bpuserid = $request['userid'];
            }			
			
			$encryption_key = get_option('PNFPB_icfcm_integrate_app_secret_code');
			
			$encrypted = $request['token'];
			
			$subscriptionoptions = '100000000000';
			
			if (isset($request['subscriptionoptions']) && $request['subscriptionoptions'] !== '') {
				$subscriptionoptions = $request['subscriptionoptions'];
			}			
			
        	$parts = explode(':', $encrypted);
			
			$keynonce = $encryption_key;
			
			// Decode AES-256-CBC encrypted data from mobile app to extract and store subscription token in WordPress database
			
        	// Don't forget to base64-decode the $iv before feeding it back to
        	//openssl_decrypt
        	//
        	$decrypted = openssl_decrypt(base64_decode($parts[0]), "aes-256-cbc", $keynonce, OPENSSL_RAW_DATA, base64_decode($parts[1]));
			
        	if (!$decrypted) {
				
            	$res = new WP_REST_Response($response);
				
        		$res->set_status(200);
				
        		return ['req' => $res,'tokenupdatestatus'=>' failed - invalid data '.$parts[0].'-----***'.$parts[1]];	
				
        	}
			else 
			{
				$key = hash('sha256', $encryption_key);

				$receivedhasmac = base64_decode($parts[2]);

				$bphasmac = hash_hmac('sha256',$decrypted, $encryption_key);

				if ($bphasmac !== $parts[3]) {
					
            		$res = new WP_REST_Response($response);
				
        			$res->set_status(200);
				
        			return ['req' => $res,'tokenupdatestatus'=>' failed - invalid data/encryption ','$bphasmac' => $bphasmac,'$receivedhasmac' => $parts[3], 'decrypted' => $decrypted];					
				}
			
				$table = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
				
				if ($request['subscription-type'] === 'subscribe-group') {
				
					$deviceid_select_status = $wpdb->get_results("SELECT * FROM {$table} WHERE device_id LIKE '%".$decrypted."%'");
				
					$updatetokenresponse = 'fail';
					
				
					foreach( $deviceid_select_status as $result ) {
						
						$subscriptionoptions = $result->subscription_option;
						
						$bpuserid =  $result->userid;
						
					}
					
					$bpcheckdeviceid = $decrypted.'!!'.$request['groupid'].'!!'.$request['cookievalue'].'!!webview';
					
					$deviceid_check_status = $wpdb->get_results("SELECT * FROM {$table} WHERE device_id LIKE '%".$bpcheckdeviceid."%'");
					
					if(count($deviceid_check_status) > 0) {
						
						foreach( $deviceid_select_status as $result ) {
						
							if ($bpuserid !== 0){

								$deviceid_update_status = $wpdb->query("UPDATE {$table} SET userid = {$bpuserid} WHERE device_id = '{$bpcheckdeviceid}' AND device_id LIKE '%webview%'") ;	
							}
						}
						
						$version_values = $wpdb->get_col( "SELECT firebase_version FROM {$table} WHERE device_id = '{$bpcheckdeviceid}'" );
						$version_value = 'L';
						foreach ( $version_values as $value ) {
							$version_value = $value;
						}
			
						if ($version_value !== 'httpv3' && get_option('pnfpb_httpv1_push') === '1') {						
						
							$group_name = 'pnfpbgroupid'.$request['groupid'];
							$client = new Google_Client();
							// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
							$client->useApplicationDefaultCredentials(); 
							
							// Alternatively, provide the JSON authentication file directly.
							$configArray = json_decode(get_option('pnfpb_sa_json_data'),true);
							$client->setAuthConfig($configArray);
							
							// Add the scope as a string (multiple scopes can be provided as an array)
							$client->addScope('https://www.googleapis.com/auth/firebase.messaging');
							$client->refreshTokenWithAssertion();
							$pnfpb_fbauth_token_array = $client->getAccessToken();
							$pnfpb_fbauth_token = $pnfpb_fbauth_token_array['access_token'];
			
							$url = 'https://iid.googleapis.com/iid/v1:batchAdd';
			
							$headers = array( 
								'Authorization' => 'Bearer '.$pnfpb_fbauth_token, 
								'Content-Type' => 'application/json',
								'access_token_auth'=> 'true'
							);
							$grouptopic = "/topics/".$group_name;
							$fields = array( 
								"to" => $grouptopic,
								"registration_tokens"=> array($decrypted)
							);			
    
				
							$body = json_encode($fields);
			
							$args = array(
								'httpversion' => '1.0',
								'blocking' => true,
								'sslverify' => false,
								'body' => $body,
								'headers' => $headers
							);
			
							$apiresults = wp_remote_post($url, $args);
							$apibody = wp_remote_retrieve_body($apiresults);
							$bodyresults = json_decode($apibody,true);
							$deviceid_version_update_status = $wpdb->query("UPDATE {$table} SET firebase_version = 'httpv3' WHERE device_id = '{$bpcheckdeviceid}'") ;
							
						}
						
			
						$updatetokenresponse = 'duplicate';
					
		    		}
					else 
					{					
					
						$bpnewdeviceid = $decrypted.'!!'.$request['groupid'].'!!'.$request['cookievalue'].'!!webview';
					
						$data = array('userid' => $bpuserid, 'device_id' => $bpnewdeviceid, 'subscription_option' => $subscriptionoptions);					
					
						$insertstatus = $wpdb->insert($table,$data);
						
						if (get_option('pnfpb_httpv1_push') === '1') {	
						
						
							$group_name = 'pnfpbgroupid'.$request['groupid'];
						
							$client = new Google_Client();
							// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
							$client->useApplicationDefaultCredentials(); 
							
							// Alternatively, provide the JSON authentication file directly.
							$configArray = json_decode(get_option('pnfpb_sa_json_data'),true);
							$client->setAuthConfig($configArray);
							
							// Add the scope as a string (multiple scopes can be provided as an array)
							$client->addScope('https://www.googleapis.com/auth/firebase.messaging');
							$client->refreshTokenWithAssertion();
							$pnfpb_fbauth_token_array = $client->getAccessToken();
							$pnfpb_fbauth_token = $pnfpb_fbauth_token_array['access_token'];
			
							$url = 'https://iid.googleapis.com/iid/v1:batchAdd';
			
							$headers = array( 
								'Authorization' => 'Bearer '.$pnfpb_fbauth_token, 
								'Content-Type' => 'application/json',
								'access_token_auth'=> 'true'
							);
						
							$grouptopic = "/topics/".$group_name;
			
							$fields = array( 
	          					"to" => $grouptopic,
			  					"registration_tokens"=> array($decrypted)
							);			
    
				
							$body = json_encode($fields);
			
							$args = array(
			    				'httpversion' => '1.0',
								'blocking' => true,
								'sslverify' => false,
								'body' => $body,
								'headers' => $headers
							);
			
							$apiresults = wp_remote_post($url, $args);
							$apibody = wp_remote_retrieve_body($apiresults);
							$bodyresults = json_decode($apibody,true);
							$deviceid_version_update_status = $wpdb->query("UPDATE {$table} SET firebase_version = 'httpv3' WHERE device_id = '{$bpcheckdeviceid}'") ;
							
						}
						
					
						if (!$insertstatus || $insertstatus !== 0){
						
							$updatetokenresponse = 'subscribed'.$insertstatus.count($deviceid_select_status);
						
						}
					}						
				}
				else 
				{
					
					if ($request['subscription-type'] === 'unsubscribe-group') {
					
						$bpolddeviceid = $decrypted.'!!'.$request['groupid'].'!!'.$request['cookievalue'].'!!webview';
		
		    			$deviceid_update_status = $wpdb->query("DELETE from {$table} WHERE device_id = '{$bpolddeviceid}'");
						
						if (get_option('pnfpb_httpv1_push') === '1') {	
							
							$group_name = 'pnfpbgroupid'.$request['groupid'];
						
							$client = new Google_Client();
							// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
							$client->useApplicationDefaultCredentials(); 
							
							// Alternatively, provide the JSON authentication file directly.
							$configArray = json_decode(get_option('pnfpb_sa_json_data'),true);
							$client->setAuthConfig($configArray);
							
							// Add the scope as a string (multiple scopes can be provided as an array)
							$client->addScope('https://www.googleapis.com/auth/firebase.messaging');
							$client->refreshTokenWithAssertion();
							$pnfpb_fbauth_token_array = $client->getAccessToken();
							$pnfpb_fbauth_token = $pnfpb_fbauth_token_array['access_token'];
			
							$url = 'https://iid.googleapis.com/iid/v1:batchRemove';
			
							$headers = array( 
								'Authorization' => 'Bearer '.$pnfpb_fbauth_token, 
								'Content-Type' => 'application/json',
								'access_token_auth'=> 'true'
							);
						
							$grouptopic = "/topics/".$group_name;
			
							$fields = array( 
	          					"to" => $grouptopic,
			  					"registration_tokens"=> array($decrypted)
							);			
    
				
							$body = json_encode($fields);
			
							$args = array(
			    				'httpversion' => '1.0',
								'blocking' => true,
								'sslverify' => false,
								'body' => $body,
								'headers' => $headers
							);
			
							$apiresults = wp_remote_post($url, $args);
							$apibody = wp_remote_retrieve_body($apiresults);
							$bodyresults = json_decode($apibody,true);
							
						}
						
					}
					else 
					{
						$deviceid = $decrypted;
                        
                        $deviceidinsert = $decrypted.'!!webview';
						
						$data = array('userid' => $bpuserid, 'device_id' => $deviceidinsert, 'subscription_option' => $subscriptionoptions);
				
						$deviceid_select_status = $wpdb->get_results("SELECT * FROM {$table} WHERE device_id LIKE '%".$deviceid."%' AND device_id LIKE '%webview%'");
				
						$updatetokenresponse = 'fail';
						
						foreach( $deviceid_select_status as $result ) {
			
							if ($bpuserid !== 0){

								$deviceid_update_status = $wpdb->query("UPDATE {$table} SET userid = {$bpuserid} WHERE device_id LIKE '%{$deviceid}%' AND device_id LIKE '%webview%'") ;		
							}
							
							if ($result->subscription_option == '') {
								$deviceid_update_status = $wpdb->query("UPDATE {$table} SET subscription_option = '100000000000' WHERE device_id LIKE '%{$deviceid}%' AND device_id LIKE '%webview%'") ;									
							}

							if ($subscriptionoptions !== '100000000000' || $subscriptionoptions == ''){

								$deviceid_update_status = $wpdb->query("UPDATE {$table} SET subscription_option = '{$subscriptionoptions}' WHERE device_id LIKE '%{$deviceid}%' AND device_id LIKE '%webview%'") ;	
							}

							if ($subscriptionoptions !== '100000000000' || $subscriptionoptions == '' && $result->userid !== 0){

								$deviceid_update_status = $wpdb->query("UPDATE {$table} SET subscription_option = '{$subscriptionoptions}' WHERE userid = {$result->userid}") ;	
							}							
						}						
				
						if(count($deviceid_select_status) > 0) {
							
							$version_values = $wpdb->get_col( "SELECT firebase_version FROM {$table} WHERE device_id = '{$deviceid}'" );
							$version_value = 'L';
							foreach ( $version_values as $value ) {
								$version_value = $value;
							}
			
							if ($version_value !== 'httpv3' && get_option('pnfpb_httpv1_push') === '1') {	
								
								$client = new Google_Client();
								// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
								$client->useApplicationDefaultCredentials(); 
							
								// Alternatively, provide the JSON authentication file directly.
								$configArray = json_decode(get_option('pnfpb_sa_json_data'),true);
								$client->setAuthConfig($configArray);
							
								// Add the scope as a string (multiple scopes can be provided as an array)
								$client->addScope('https://www.googleapis.com/auth/firebase.messaging');
								$client->refreshTokenWithAssertion();
								$pnfpb_fbauth_token_array = $client->getAccessToken();
								$pnfpb_fbauth_token = $pnfpb_fbauth_token_array['access_token'];
			
								$url = 'https://iid.googleapis.com/iid/v1:batchAdd';
			
								$headers = array( 
									'Authorization' => 'Bearer '.$pnfpb_fbauth_token, 
									'Content-Type' => 'application/json',
									'access_token_auth'=> 'true'
								);
			
								$fields = array( 
									"to" => "/topics/pnfpbgeneral",
									"registration_tokens"=> array($deviceid)
								);			
    
				
								$body = json_encode($fields);
			
								$args = array(
									'httpversion' => '1.0',
									'blocking' => true,
									'sslverify' => false,
									'body' => $body,
									'headers' => $headers
								);
			
								$apiresults = wp_remote_post($url, $args);
								$apibody = wp_remote_retrieve_body($apiresults);
								$bodyresults = json_decode($apibody,true);
								$deviceid_version_update_status = $wpdb->query("UPDATE {$table} SET firebase_version = 'httpv3' WHERE device_id = '{$deviceid}'") ;
								
							}
			
							$updatetokenresponse = 'duplicate';
					
		    			}
						else 
						{
							$insertstatus = $wpdb->insert($table,$data);
					
							if (!$insertstatus || $insertstatus !== 0){
						
								$updatetokenresponse = 'subscribed'.$insertstatus.count($deviceid_select_status);
						
							}
							
							if (get_option('pnfpb_httpv1_push') === '1') {	
							
								$client = new Google_Client();
								// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
								$client->useApplicationDefaultCredentials(); 
							
								// Alternatively, provide the JSON authentication file directly.
								$configArray = json_decode(get_option('pnfpb_sa_json_data'),true);
								$client->setAuthConfig($configArray);
							
								// Add the scope as a string (multiple scopes can be provided as an array)
								$client->addScope('https://www.googleapis.com/auth/firebase.messaging');
								$client->refreshTokenWithAssertion();
								$pnfpb_fbauth_token_array = $client->getAccessToken();
								$pnfpb_fbauth_token = $pnfpb_fbauth_token_array['access_token'];
			
								$url = 'https://iid.googleapis.com/iid/v1:batchAdd';
			
								$headers = array( 
									'Authorization' => 'Bearer '.$pnfpb_fbauth_token, 
									'Content-Type' => 'application/json',
									'access_token_auth'=> 'true'
								);
			
								$fields = array( 
	          						"to" => "/topics/pnfpbgeneral",
			  						"registration_tokens"=> array($deviceid)
								);			
    
				
								$body = json_encode($fields);
			
								$args = array(
			    					'httpversion' => '1.0',
									'blocking' => true,
									'sslverify' => false,
									'body' => $body,
									'headers' => $headers
								);
			
								$apiresults = wp_remote_post($url, $args);
								$apibody = wp_remote_retrieve_body($apiresults);
								$bodyresults = json_decode($apibody,true);
								$deviceid_version_update_status = $wpdb->query("UPDATE {$table} SET firebase_version = 'httpv3' WHERE device_id = '{$deviceid}'") ;
							}
							
						}
					}
				}
				
				$response = array(
					'status'  => 200,
					'message' => $updatetokenresponse
				);
				
        		$res = new WP_REST_Response($response);
				
        		$res->set_status(200);
				
        		return ['req' => $res,'tokenupdatestatus'=>$updatetokenresponse];			
				
			}
			
		}
		
		/**
		* To generate secret key to integrate app from admin area under plugin settings
		*
		*
		* @since 1.36
		*/
		public function PNFPB_icfcm_integrate_app() {
			global $wpdb;
			if (isset($_POST["submit"])) {
				$bytes = random_bytes(16);
				update_option('PNFPB_icfcm_integrate_app_secret_code',bin2hex($bytes));
			}
			
 			if (isset($_POST["disable_sw_file"]) && get_option( 'pnfpb_ic_disable_serviceworker_pwa_pushnotification' ) === '1') {
				update_option('pnfpb_ic_disable_serviceworker_pwa_pushnotification',null);
			}
			else 
			{
				if (isset($_POST["disable_sw_file"])) {
					update_option('pnfpb_ic_disable_serviceworker_pwa_pushnotification','1');
				}
			}
			
		?>

			<h1 class="pnfpb_ic_push_settings_header"><?php echo __("PNFPB - API for Mobile app integration",PNFPB_TD);?></h1>
			<div class="pnfpb_admin_top_menu">
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb-icfcm-slug" class="tab"><?php echo __("Push Settings",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_device_tokens_list" class="tab"><?php echo __("Device tokens",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_pwa_app_settings" class="tab "><?php echo __("PWA",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfmtest_notification" class="tab "><?php echo __("One time push",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc" class="tab"><?php echo __("Notifications",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_frontend_settings" class="tab"><?php echo __("Frontend settings",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_button_settings" class="tab "><?php echo __("Customize buttons",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_integrate_app" class="tab active"><?php echo __("Mobile app",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="tab "><?php echo __("NGINX",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1" class="tab "><?php echo __("Action Scheduler",PNFPB_TD);?></a>
			</div>
			<div class="pnfpb_column_1200">
			<h2 class="pnfpb_ic_push_settings_header2"><?php echo __('Generate secret key for Android/Ios app integration',PNFPB_TD);?></h2>
			<h4 class="pnfpb_ic_push_settings_header2"><?php echo __('This secret key will be used to get subscription token in secured manner from Android/Ios app to store it in WordPress Database table to send push notifications for app users',PNFPB_TD);?></h4>
			<h4 class="pnfpb_ic_push_settings_header2"><?php echo __('Use this secret key in http post request using this rest api from app',PNFPB_TD);?></h4>
			<form method="post" enctype="multipart/form-data" class="form-field">
				<table class="pnfpb_ic_push_settings_table widefat fixed">
    				<tbody>
    					<tr  class="pnfpb_ic_push_settings_table_row">
							<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
								<div><?php submit_button(__( 'Generate/Change secret key', 'PNFPB_TD' ), 'primary' ); ?></div>
								<label><?php echo get_option('PNFPB_icfcm_integrate_app_secret_code');?></label>
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
				<h4><?php echo __("Mobile app integration help on github respository",PNFPB_TD);?></h4>
				<ol>
					<li><a href="https://github.com/muraliwebworld/android-app-to-integrate-push-notification-wordpress-plugin" target="_blank"><?php echo __("Procedure/Sample code to Integrate Android mobile app with this plugin using API",PNFPB_TD);?></a></li>
					<li><a href="https://github.com/muraliwebworld/ios-swift-app-to-integrate-push-notification-wordpress-plugin" target="_blank"><?php echo __("Procedure/Sample code to Integrate IOS mobile app with this plugin using API",PNFPB_TD);?></a></li>
				</ol>
			</div>
			<br /><br />			
			<div><h2 class="pnfpb_ic_push_settings_header"><?php echo __("Disable push notification service worker file and PWA",PNFPB_TD);?></h2></div>
			<?php if (get_option( 'pnfpb_ic_disable_serviceworker_pwa_pushnotification' ) === '1') { ?>
				<p class="pnfpb_ic_red_color_text"><b><?php echo __("Currently, Service worker file is disabled/not created. if you need push notification and PWA in website, please enable service worker file using below option",PNFPB_TD);?></b></p>
			<?php } ?>
			<form method="post" enctype="multipart/form-data" class="form-field">
				<table class="pnfpb_ic_push_settings_table widefat fixed">
    				<tbody>
    					<tr  class="pnfpb_ic_push_settings_table_row">
							<td class="column-columnname">
								<?php if (get_option( 'pnfpb_ic_disable_serviceworker_pwa_pushnotification' ) === '1') { ?> 
								<div class="col-sm-10"><?php submit_button(__( 'Enable service worker file', 'PNFPB_TD' ), 'primary','disable_sw_file' ); ?></div>
								<?php } else { ?>
								<div class="col-sm-10"><?php submit_button(__( 'Disable service worker file', 'PNFPB_TD' ), 'primary','disable_sw_file' ); ?></div>		
								<?php } ?>
								<ul>
									<li><?php echo __("This option will disable service worker file, it will switch off push notification service as well as it will switch off PWA. Use this option only, if you want to use this plugin for push notification services via REST API (example: for mobile app using WebView)",PNFPB_TD);?></li>
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
		public function PNFPB_icfcm_settings_for_ngnix_server() {
			?>
			
			<h1 class="pnfpb_ic_push_settings_header"><?php echo __("PNFPB - settings for NGNIX server",PNFPB_TD);?></h1>
			<div class="pnfpb_admin_top_menu">
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb-icfcm-slug" class="tab"><?php echo __("Push Settings",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_device_tokens_list" class="tab"><?php echo __("Device tokens",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_pwa_app_settings" class="tab "><?php echo __("PWA",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfmtest_notification" class="tab "><?php echo __("One time push",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc" class="tab"><?php echo __("Notifications",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_frontend_settings" class="tab"><?php echo __("Frontend settings",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_button_settings" class="tab "><?php echo __("Customize buttons",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_integrate_app" class="tab "><?php echo __("Mobile app",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="tab active"><?php echo __("NGINX",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1" class="tab "><?php echo __("Action Scheduler",PNFPB_TD);?></a>
			</div>
			<div class="pnfpb_column_1200">	
				<h1 class="pnfpb_ic_push_settings_header"><?php echo __("Settings for NGINX based server/hosting",PNFPB_TD);?></h1>

				<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
	
    				<?php settings_fields( 'pnfpb_icfcm_nginx'); ?>
				
    				<?php do_settings_sections( 'pnfpb_icfcm_nginx' ); ?>
				
					<?php
						if (get_option( 'pnfpb_ic_nginx_static_files_enable' ) != '1') {

						global $wp_filesystem;
						

						if ( empty( $wp_filesystem ) ) {
				
							require_once( trailingslashit( ABSPATH ) . 'wp-admin/includes/file.php' );
							WP_Filesystem();
						}
	
						$swresponse 		= wp_remote_head( home_url( '/' ). 'pnfpb_icpush_pwa_sw.js', array( 'sslverify' => false ) );
						
						$swresponse_code 	= wp_remote_retrieve_response_code( $swresponse );
						
						if ( 200 === $swresponse_code ) {

							$createfileresult = $wp_filesystem->delete( trailingslashit( get_home_path() ) . 'pnfpb_icpush_pwa_sw.js');
						
						}
			
						$firebase_swresponse 		= wp_remote_head( home_url( '/' ). 'firebase-messaging-sw.js', array( 'sslverify' => false ) );
				
						$firebase_swresponse_code 	= wp_remote_retrieve_response_code( $firebase_swresponse );

	
						if ( 200 === $firebase_swresponse_code ) {
				
							$createfileresult = $wp_filesystem->delete( trailingslashit( get_home_path() ) . 'firebase-messaging-sw.js');

						}
			
						if (get_option('pnfpb_ic_pwa_app_enable') === '1') {
			
							$pwa_manifest_response 		= wp_remote_head( home_url( '/' ). 'pnfpbmanifest.json', array( 'sslverify' => false ) );
					
							$pwa_manifest_response_code 	= wp_remote_retrieve_response_code( $pwa_manifest_response );
				
							if ( 200 === $pwa_manifest_response_code ) {
				
								$createfileresult = $wp_filesystem->delete( trailingslashit( get_home_path() ) . 'pnfpbmanifest.json');

							}
					
						}
				
					}			
			
					?>
	
					<ul>
					
						<li><?php echo __(PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION);?></li>
					
					</ul>
				
					<table class="pnfpb_ic_push_settings_table widefat fixed">
    					<tbody>
							<tr class="pnfpb_ic_push_settings_table_row">
								<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
									<div class="pnfpb_row">
  										<div class="pnfpb_column_400">
    										<div class="pnfpb_card">									
												<label for="pnfpb_ic_nginx_static_files_enable">
													<?php echo __("Enable/Disable static service worker and PWA manifest files",'PNFPB_TD');?>
												</label>
												<label class="pnfpb_switch">
													<input  id="pnfpb_ic_nginx_static_files_enable" name="pnfpb_ic_nginx_static_files_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_nginx_static_files_enable' ) ); ?>  />
													<span class="pnfpb_slider round"></span>
												</label>
											</div>
										</div>
									</div>
								</td>
							</tr>
    						<tr  class="pnfpb_ic_push_settings_table_row">
								<td class="column-columnname">
									<div class="pnfpb_column_full"><?php submit_button(__('Save changes',PNFPB_TD),'pnfpb_ic_push_save_configuration_button'); ?></div>
									<ul>
					
										<li><?php echo __(PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION2);?></li>
					
									</ul>
									<ul>
					
										<li><?php echo __("If Push notification admin settings or PWA admin settings are changed then regenerate service worker file by switching off this option, save changes, switch on again and save the changes again, so that service worker file and PWA manifest files will be regenerated",'PNFPB_TD');?></li>
					
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
		public function PNFPB_icfcm_httpv1_send_push_notification($pushid=0, 
																  $pushtitle="", 
																  $pushcontent="", 
																  $pushicon="", 
																  $pushimageurl="",
																  $pushclickurl="", 
																  $pushextradata="", 
																  $target_device_ids=array(), 
																  $deviceidswebview=array(),
																  $senderid=0,
																  $receiverid=0,
																  $pushtype='',
																  $grouppush='',
																  $groupid=0) 
		{
			global $wpdb;
			
	
			$pnfpb_firebase_project = get_option( 'pnfpb_ic_fcm_projectid' );
			
			$url = "https://fcm.googleapis.com/v1/projects/{$pnfpb_firebase_project}/messages:send";
			
			if ($senderid > 0) {
				$pushicon =	bp_core_fetch_avatar ( 
    				array('item_id'   => $senderid,  // output user id of post author
            			'type'      => 'full',
            			'html'      => FALSE    // FALSE = return url, TRUE (default) = return url wrapped with html
   					 	) 
				);
			}			

			$client = new Google_Client();
			
			// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
			// 
			$client->useApplicationDefaultCredentials(); 
							
			// Alternatively, provide the JSON authentication file directly.
			$configArray = json_decode(get_option('pnfpb_sa_json_data'),true);
			$client->setAuthConfig($configArray);
							
			// Add the scope as a string (multiple scopes can be provided as an array)
			$client->addScope('https://www.googleapis.com/auth/firebase.messaging');
			$client->refreshTokenWithAssertion();
			$pnfpb_fbauth_token_array = $client->getAccessToken();
			$pnfpb_fbauth_token = $pnfpb_fbauth_token_array['access_token'];
			
			if (($pushtype === 'privatemessages' || $pushtype === 'friendshiprequest' || $pushtype === 'friendshipaccepted' || $pushtype === 'mycomments') && count($target_device_ids) > 0 ) {
				
					$table_name = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
			
					$deviceidswebviewcheck=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND userid = '{$receiverid}' ORDER BY id DESC LIMIT 1000"  );
				
					if (count($deviceidswebviewcheck) > 0) {
					
						$pushclickurl = '';
					
					}
			}

			// prepare the message
			$message = array( 
				'title'     => $pushtitle,
				'body'      => substr(stripslashes(strip_tags(urldecode($pushcontent))),0,130),
				'image'		=> $pushimageurl,
			);

			$webpushoptions = array (
				'notification' => array(
					'title'     => $pushtitle,
					'body'      => substr(stripslashes(strip_tags(urldecode($pushcontent))),0,130),
					'image'		=> $pushimageurl,
					'icon'		=> $pushicon,
					'link' 		=> $pushclickurl,
					'action'	=> [['action'=> "close_notification",'title'=> "Dismiss"],['action' => "read_more",'title' => "Read More"]],					
					'tag'		=> 'PNFPB_webpush'
				 ),
				'fcm_options' => array (
					'link' => $pushclickurl
				)
			);
			
			$androidoptions = array(
				"notification" => array(
					"title" => $pushtitle,
  					"body" => substr(stripslashes(strip_tags(urldecode($pushcontent))),0,130),
  					"click_action" => $pushclickurl,
					'image'		=> $pushimageurl,
					'tag'		=> 'PNFPB_webpush'
				)
			);
			

   			$iosoptions = array(
      			"payload" => array(				
					"aps" => array(
      					"alert" => array(
        					"title" => $pushtitle,
         					"body" => substr(stripslashes(strip_tags(urldecode($pushcontent))),0,130),
      					),
						"badge" => 0,
      				)
				),
				'fcm_options' => array (
					"image" => $pushimageurl
				)				
			);
			if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
				$topic = "pnfpbgeneralloggedin";
			} else {
				$topic = 'pnfpbgeneral';
			}
			
			if ($grouppush === 'yes') {
				//$group_name = groups_get_slug($groupid);
				$group_name = 'pnfpbgroupid'.$groupid;
				//error_log($group_name);
				$topic = $group_name;
			}

			if ($pushtype === 'privatemessages' || $pushtype === 'friendshiprequest' || $pushtype === 'friendshipaccepted' || $pushtype === 'mycomments') {
				
				if ($receiverid > 0 && count($target_device_ids) > 0) {
					
					for ($i=0;$i<count($target_device_ids);$i++) {
						
						$notification = array (
							'token' => $target_device_ids[$i],
							'notification' => $message,
							'webpush' => $webpushoptions,
							'android' => $androidoptions,
							'apns'	  => $iosoptions
						);
						
						$fields = array( 
	           			 'message' => $notification,
						);					
					
						$headers = array( 
							'Authorization' => 'Bearer '.$pnfpb_fbauth_token, 
							'Content-Type' => 'application/json'
						);
    
				
						$body = json_encode($fields);
			
						$args = array(
			   				'httpversion' => '1.0',
							'blocking' => true,
							'sslverify' => false,
							'body' => $body,
							'headers' => $headers
						);
			
						$table_name = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
			
						$apiresults = wp_remote_post($url, $args);

						$apibody = wp_remote_retrieve_body($apiresults);

						$bodyresults = json_decode($apibody,true);
			
			
					
						if (is_array($bodyresults)) {
							if (array_key_exists('results', $bodyresults)) {
								foreach ($bodyresults['results'] as $idx=>$result){
									if (array_key_exists('error',$result)) {
										if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($target_device_ids[$idx], '!!') === false) {
												$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$target_device_ids[$idx]}'") ;
											}
										}
									}
							}
						}
				
						if (is_wp_error($apiresults)) {
							$status = $apiresults->get_error_code(); 				// custom code for WP_ERROR
            				$error_message = $apiresults->get_error_message();
            				error_log('There was a '.$status.' error in push notification: '.$error_message);
						}						
					}
				}
			}
			else 
			{
				
				
				$notification = array (
					'topic' => $topic,
					'notification' => $message,
					'webpush' => $webpushoptions,
					'android' => $androidoptions,
					'apns'	  => $iosoptions
				);
				
				$fields = array( 
	            	'message' => $notification,
				);					
					
				$headers = array( 
					'Authorization' => 'Bearer '.$pnfpb_fbauth_token, 
					'Content-Type' => 'application/json'
				);
    
				
				$body = json_encode($fields);
			
				$args = array(
			    	'httpversion' => '1.0',
					'blocking' => true,
					'sslverify' => false,
					'body' => $body,
					'headers' => $headers
				);
			
				$table_name = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
			
				$apiresults = wp_remote_post($url, $args);

				$apibody = wp_remote_retrieve_body($apiresults);

				$bodyresults = json_decode($apibody,true);
			
			
					
				if (is_array($bodyresults)) {
					if (array_key_exists('results', $bodyresults)) {
						foreach ($bodyresults['results'] as $idx=>$result){
							if (array_key_exists('error',$result)) {
								if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($target_device_ids[$idx], '!!') === false) {
									$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$target_device_ids[$idx]}'") ;
								}
							}
						}
					}
				}
				
				if (is_wp_error($apiresults)) {
					$status = $apiresults->get_error_code(); 				// custom code for WP_ERROR
            		$error_message = $apiresults->get_error_message();
            		error_log('There was a '.$status.' error in push notification: '.$error_message);
				}				
			}
			
		}

		/** Firebase Legacy api send push notification routine
		* 
		* @since 1.65 version
		*/
		public function PNFPB_icfcm_legacy_send_push_notification($pushid=0, 
																  $pushtitle="", 
																  $pushcontent="", 
																  $pushicon="", 
																  $pushimageurl="",
																  $pushclickurl="",
																  $pushextradata=array(), 
																  $target_device_ids=array(),
																  $deviceidswebview=array(),
																  $senderid=0,
																  $receiverid=0,
																  $pushtype='',
																  $grouppush='',
																  $groupid=0)																  
		{
			global $wpdb;
			
			$apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
			
			$url = 'https://fcm.googleapis.com/fcm/send';
			
			if ($senderid > 0) {
				$avataricon =	bp_core_fetch_avatar ( 
    				array('item_id'   => $senderid,  // output user id of post author
            			'type'      => 'full',
						'no_grav'   => false,
            			'html'      => FALSE    // FALSE = return url, TRUE (default) = return url wrapped with html
   					 	) 
				);
			}
			else {
				$avataricon = '';
			}
			
			if ($avataricon) {
				$pushicon = $avataricon;
			}
			
			if ($pushtype === 'privatemessages' || $pushtype === 'friendshiprequest' || $pushtype === 'friendshipaccepted') {
				
				$table_name = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
				
				$deviceidswebviewcheck=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND userid = '{$receiverid}' ORDER BY id DESC LIMIT 1000"  );
				
				if (count($deviceidswebviewcheck) > 0) {
					
					$pushclickurl = '';
					
				}
				
			}
			
			if (count($target_device_ids) > 0) {

				$regid = $target_device_ids;			
				// prepare the message
				$message = array( 
					'title'     => $pushtitle,
					'body'      => substr(stripslashes(strip_tags(urldecode($pushcontent))),0,130),
					'icon'		=> $pushicon,
					'image'		=> $pushimageurl,
					'click_action'  => $pushclickurl,
					'tag'		=> 'PNFPB_webpush'
				);
							
				
				if (count($pushextradata) > 0) { 
					$fields = array( 
	            		'registration_ids' => $target_device_ids, 
	            		'notification' => $message,
						'data'	=> $pushextradata
					);
				} else {
					$fields = array( 
	            		'registration_ids' => $target_device_ids, 
	            		'notification' => $message
					);					
					
				}					
					
				$headers = array( 
					'Authorization' => 'key='.$apiaccesskey,
					'Content-Type' => 'application/json'
				);
    
				
				$body = json_encode($fields);
			
				$args = array(
			    	'httpversion' => '1.0',
					'blocking' => true,
					'sslverify' => false,
					'body' => $body,
					'headers' => $headers
				);
				
				$table_name = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
			
				$apiresults = wp_remote_post($url, $args);

				$apibody = wp_remote_retrieve_body($apiresults);

				$bodyresults = json_decode($apibody,true);
				
				
				
				if (is_array($bodyresults)) {
					if (array_key_exists('results', $bodyresults)) {
						foreach ($bodyresults['results'] as $idx=>$result){
							if (array_key_exists('error',$result)) {
								if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($target_device_ids[$idx], '!!') === false) {
									$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$target_device_ids[$idx]}'") ;
								}
							}
						}
					}
				}
				
				if (is_wp_error($apiresults)) {
					$status = $apiresults->get_error_code(); 				// custom code for WP_ERROR
            		$error_message = $apiresults->get_error_message();
            		error_log('There was a '.$status.' error in push notification: '.$error_message);
				}
			}
			
			if (count($deviceidswebview) > 0) {

				$regid = $deviceidswebview;
						


				$message = array( 
					'title'     => $pushtitle,
					'body'      => stripslashes(strip_tags($pushcontent)),
					'icon'		=> $pushicon,
					'image'		=> $pushimageurl,
					'tag'		=> 'PNFPB_webpush'
				);


				if (count($pushextradata) > 0) { 
					$fields = array( 
						'registration_ids' => $deviceidswebview, 
						'notification' => $message,
						'data'	=> $pushextradata
					);
				} else {
					$fields = array( 
						'registration_ids' => $deviceidswebview, 
						'notification' => $message
					);				
				}
    
				$headers = array( 
					'Authorization' => 'key='.$apiaccesskey, 
					'Content-Type' => 'application/json'
				);
				
				$body = json_encode($fields);
				//error_log(serialize($body));
				$args = array(
			        'httpversion' => '1.0',
					'blocking' => true,
					'sslverify' => false,
					'body' => $body,
					'headers' => $headers
				);
				
				$table_name = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
			
				$apiresults = wp_remote_post($url, $args);
				
				$apibody = wp_remote_retrieve_body($apiresults);
						
				$bodyresults = json_decode($apibody,true);
				
				//error_log(serialize($bodyresults));		
				
				if (is_array($bodyresults)) {
					if (array_key_exists('results', $bodyresults)) {
						foreach ($bodyresults['results'] as $idx=>$result){
							if (array_key_exists('error',$result)) {
								if ($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') {
									$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id LIKE '%{$deviceidswebview[$idx]}%'") ;
								}
							}
						}
					}
				}						
				
				if (is_wp_error($apiresults)) {
				    $status = $apiresults->get_error_code();
                    $error_message = $apiresults->get_error_message();
                    error_log('There was a '.$status.' error in push notification: '.$error_message);
				}
			}
			
			
		}
		
		
		/** Onesignal push notification 
		* 
		* @since 1.65 version
		*/
		public function PNFPB_icfcm_onesignal_push_notification($pushid,$pushtitle,$pushcontent,$pushlink,$pushimageurl,$target_device_id=0,$retry_count=4) {
			
			try {
				$onesignal_post_url = 'https://onesignal.com/api/v1/notifications';

            	if (defined('ONESIGNAL_DEBUG') && defined('ONESIGNAL_LOCAL')) {
                 	$onesignal_post_url = 'https://localhost:3001/api/v1/notifications';
            	}
						
				$onesignal_wp_settings = OneSignal::get_onesignal_settings();

						
				$onesignal_auth_key = $onesignal_wp_settings['app_rest_api_key'];
						
				$include_external_ids = array();
				
				$externalid = $this->PNFPB_icfcm_generate_random_uuid($pushtitle);
				//error_log(serialize($target_device_id));
				if ($target_device_id !== 0 && (is_array($target_device_id) && count($target_device_id) > 0)) {
					//error_log(serialize($target_device_id));
					$include_external_ids = $target_device_id;
					
            		$fields = array(
                  		'external_id' => $externalid,
                  		'app_id' => $onesignal_wp_settings['app_id'],
                  		'data' => array("post_id" => $pushid,"imageUrl" => $pushimageurl),
                  		'headings' => array('en' => stripslashes_deep(wp_specialchars_decode($pushtitle))),
                  		//'included_segments' => array('All'),
                  		'isAnyWeb' => true,
                  		'url' => $pushlink,
                  		'contents' => array('en' => stripslashes_deep(wp_specialchars_decode(stripslashes(strip_tags(urldecode($pushcontent)))))),
				  		//'include_external_user_ids' => $include_external_ids,
						'include_aliases' => array("external_id" => $include_external_ids),
						'target_channel' => 'push'
            		);					
				}
				else {
					
            		$fields = array(
                  		'external_id' => $externalid,
                  		'app_id' => $onesignal_wp_settings['app_id'],
                  		'data' => array("post_id" => $pushid,"imageUrl" => $pushimageurl),
                  		'headings' => array('en' => stripslashes_deep(wp_specialchars_decode($pushtitle))),
                  		'included_segments' => array('All'),
                  		'isAnyWeb' => true,
                  		'url' => $pushlink,
                  		'contents' => array('en' => stripslashes_deep(wp_specialchars_decode(stripslashes(strip_tags(urldecode($pushcontent)))))),
            		);					
					
				}
			


				$fields['isIos'] = true;
				$fields['isAndroid'] = true;
				
				//$config_use_featured_image_as_image = $onesignal_wp_settings['showNotificationImageFromPostThumbnail'] === true;
				
				if ($pushimageurl != '') {
					$fields['chrome_web_icon'] = $pushimageurl;
                    $fields['chrome_web_image'] = $pushimageurl;
                    $fields['firefox_icon'] = $pushimageurl;
					$fields['big_picture'] = $pushimageurl;
					$fields['huawei_big_picture']  = $pushimageurl;
					$fields['adm_big_picture']  = $pushimageurl;
					$fields['chrome_big_picture']  = $pushimageurl;
					$fields['large_icon']  = $pushimageurl;
					$fields['ios_attachments'] = json_encode(array("id1"=>$pushimageurl));
			
				}
				
				
				
            	$request = array(
                 'headers' => array(
                 	'content-type' => 'application/json;charset=utf-8',
                 	'Authorization' => 'Basic '.$onesignal_auth_key,
                  ),
                   'body' => wp_json_encode($fields),
                   'timeout' => 3,
            	);
				
        		$response = wp_remote_post($onesignal_post_url, $request);

				if (is_wp_error($response)) {
				    $status = $response->get_error_code();
                    $error_message = $response->get_error_message();
                    error_log('There was a '.$status.' error in push notification: '.$error_message);
				}
        	} catch (Exception $e) {
            	$wp_error_msg = new WP_Error('err', __( "OneSignal: There was a problem sending a notification"));
				if( is_wp_error( $wp_error_msg ) ) {
    				error_log($wp_error_msg->get_error_message());
				}
        	}				
				
		}
		
		/** To generate random uuid function 
		*
		* @since 1.65 version
		*/
		public function PNFPB_icfcm_generate_random_uuid($title) {
			
        	$now_minutes = floor(time()/60);
        	$prev_minutes = get_option('TimeLastUpdated');
        	$prehash = (string) $title;
        	$updatedAMinuteOrMoreAgo = $prev_minutes !== false && ($now_minutes - $prev_minutes) > 0;

        	if ($updatedAMinuteOrMoreAgo || $prev_minutes === false) {
            	update_option('TimeLastUpdated', $now_minutes);
            	$timestamp = $now_minutes;
        	} else {
            	$timestamp = $prev_minutes;
        	}

        	$prehash = $prehash.$timestamp;
        	$sha1 = substr(sha1($prehash), 0, 32);
       		return (substr($sha1, 0, 8).'-'.substr($sha1, 8, 4).'-'.substr($sha1, 12, 4).'-'.substr($sha1, 16, 4).'-'.substr($sha1, 20, 12));			
			
		}
		
		
	}

    $PNFPB_ICFM_Push_Notification_Post_BuddyPress_OBJ = new PNFPB_ICFM_Push_Notification_Post_BuddyPress();
	
	include(plugin_dir_path(__FILE__) . 'admin/pnfpb_icfcm_device_tokens_list.php');
	include(plugin_dir_path(__FILE__) . 'admin/pnfpb_icfcm_onetime_push_notifications_list_class.php');

}
else
{
    exit;
}
?>