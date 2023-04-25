<?php
/*
Plugin Name: Push Notification for Post and BuddyPress
Plugin URI: https://www.muraliwebworld.com/groups/wordpress-plugins-by-muralidharan-indiacitys-com-technologies/forum/topic/push-notification-for-post-and-buddypress/
Description: Push notification for Post,custom post,BuddyPress,Woocommerce,mobile apps. Configure push notification settings in <a href="admin.php?page=pnfpb-icfcm-slug"><strong>settings page</strong></a>
Version: 1.59
Author: Muralidharan Ramasamy
Author URI: https://www.muraliwebworld.com
Text Domain: PNFPB_TD
Updated: 10 Apr 2023
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


/**
 * Class to load required functions for push notification
 *
 * @since 1.0.0
 *
 */

if ( !class_exists( 'PNFPB_ICFM_Push_Notification_Post_BuddyPress' ) ) {
	
	class PNFPB_ICFM_Push_Notification_Post_BuddyPress
	{
		public $pre_name = 'PNFPB_';
		
		public $devicetokens_obj;

		public function __construct()
		{
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
			add_action( 'PNFPB_ondemand_schedule_push_notification_hook', array($this, $this->pre_name .'ondemand_schedule_push_notification'),10,1 );			

		
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
				add_action ( 'bp_group_header_actions', array($this,  $this->pre_name .'subscribe_to_group_button'), 1);

				add_action ( 'bp_directory_groups_actions' , array($this,  $this->pre_name .'subscribe_to_group_button'), 1);
				
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
			$dbname = $wpdb->dbname;

			$pnfpb_table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

 			$is_status_col = $wpdb->get_results(  "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS`    WHERE `table_name` = '{$pnfpb_table_name}' AND `TABLE_SCHEMA` = '{$dbname}' AND `COLUMN_NAME` = 'subscription_option'"  );
			
			$is_status_web256 = $wpdb->get_results(  "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS`    WHERE `table_name` = '{$pnfpb_table_name}' AND `TABLE_SCHEMA` = '{$dbname}' AND `COLUMN_NAME` = 'web_256'"  );
			
			if( empty($is_status_col) ):
			
    			$add_status_column = "ALTER TABLE `{$pnfpb_table_name}` ADD `subscription_option` VARCHAR(50) NULL DEFAULT NULL AFTER `device_id`; ";			
				$wpdb->query( $add_status_column );
			
			endif;
			
			if( empty($is_status_web256) ) { 
			
    			$add_device_details_column = "ALTER TABLE `{$pnfpb_table_name}`
				ADD `ip_address` VARCHAR(100) NULL DEFAULT NULL,
				ADD `web_auth` VARCHAR(300) NULL DEFAULT NULL,
				ADD `web_256` VARCHAR(300) NULL DEFAULT NULL AFTER `subscription_option`; ";

   				 $wpdb->query( $add_device_details_column );
				
			}
			else 
			{
				$pnfpblength = $wpdb->get_col_length($pnfpb_table_name,'web_256');
				if (!empty($is_status_web256) && $pnfpblength['length'] <= 50) {
					$modify_web_256_column = "ALTER TABLE `{$pnfpb_table_name}` MODIFY COLUMN web_256 VARCHAR(300);";
					$wpdb->query( $modify_web_256_column );
					$modify_web_auth_column = "ALTER TABLE `{$pnfpb_table_name}` MODIFY COLUMN web_auth VARCHAR(300);";
					$wpdb->query( $modify_web_auth_column );
					
				}
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
					web_auth VARCHAR(300) NULL DEFAULT NULL,
					web_256 VARCHAR(300) NULL DEFAULT NULL,					
                    PRIMARY KEY (id)
                ) {$charset_collate};";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        
			dbDelta( $sql );
			
			if ( ! function_exists( 'action_scheduler_register_3_dot_5_dot_3' ) && function_exists( 'add_action' ) ) {
			
				require_once( plugin_dir_path( __FILE__ ) . '/libraries/action-scheduler/action-scheduler.php' );
				
			}
			
			if (get_option('pnfpb_ic_fcm_post_schedule_enable') && get_option('pnfpb_ic_fcm_post_schedule_enable') == 1) {
				if ( !wp_next_scheduled( 'PNFPB_cron_post_hook' ) ) {
    					wp_schedule_event( time(), get_option('pnfpb_ic_fcm_post_timeschedule_enable'), 'PNFPB_cron_post_hook' );
					}
			}


			if (get_option('pnfpb_ic_fcm_buddypressactivities_schedule_enable') && get_option('pnfpb_ic_fcm_buddypressactivities_schedule_enable') == 1) 			  {
					if ( !wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' ) ) {
    					wp_schedule_event( time(), get_option('pnfpb_ic_fcm_buddypressactivities_timeschedule_enable'), 'PNFPB_cron_buddypressactivities_hook' );
					}
			}
			
			if (get_option('pnfpb_ic_fcm_buddypressactivities_schedule_enable') && get_option('pnfpb_ic_fcm_buddypressactivities_schedule_enable') == 1) 			  {
					if ( !wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
    					wp_schedule_event( time(), get_option('pnfpb_ic_fcm_buddypressgroupactivities_timeschedule_enable'), 'PNFPB_cron_buddypressgroupactivities_hook' );
					}
			}			



			if (get_option('pnfpb_ic_fcm_buddypresscomments_schedule_enable') && get_option('pnfpb_ic_fcm_buddypresscomments_schedule_enable') == 1) {
			
				if ( !wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' ) ) {
    				wp_schedule_event( time(), get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable'), 'PNFPB_cron_buddypresscomments_hook' );
				}
				
				if ( !wp_next_scheduled( 'PNFPB_cron_comments_post_hook' ) ) {
    				wp_schedule_event( time(), get_option('pnfpb_ic_fcm_buddypresscomments_timeschedule_enable'), 'PNFPB_cron_comments_post_hook' );
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
					
			 		if ( false === as_has_scheduled_action( 'PNFPB_cron_post_hook' ) ) {
						as_schedule_recurring_action( strtotime( 'now' ), $timeseconds, 'PNFPB_cron_post_hook', array(), 'pnfpb_post', true );    				
					}
					else 
					{

						as_unschedule_all_actions( 'PNFPB_cron_post_hook', array(), '' );
						as_schedule_recurring_action( strtotime( 'now' ), $timeseconds, 'PNFPB_cron_post_hook', array(), 'pnfpb_post', true );										
					}
				}
				else 
				{
 					if (as_has_scheduled_action( 'PNFPB_cron_post_hook' ) ) {
						as_unschedule_all_actions( 'PNFPB_cron_post_hook', array(), 'pnfpb_post' );
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
			
			 		if ( false === as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ) ) {
						as_schedule_recurring_action( strtotime( 'now' ), $timeseconds, 'PNFPB_cron_buddypressactivities_hook', array(), 'pnfpb_buddypressactivities', true );    				
					}
					else 
					{

						as_unschedule_all_actions( 'PNFPB_cron_buddypressactivities_hook', array(), '' );
						as_schedule_recurring_action( strtotime( 'now' ), $timeseconds, 'PNFPB_cron_buddypressactivities_hook', array(), 'pnfpb_buddypressactivities', true );										
					}
				}
				else 
				{
 					if (as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ) ) {
						as_unschedule_all_actions( 'PNFPB_cron_buddypressactivities_hook', array(), 'pnfpb_buddypressactivities' );
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
			
			 		if ( false === as_has_scheduled_action( 'PNFPB_cron_comments_post_hook' ) ) {
						as_schedule_recurring_action( strtotime( 'now' ), $timeseconds, 'PNFPB_cron_comments_post_hook', array(), 'pnfpb_postcomments', true );    				
					}
					else 
					{

						as_unschedule_all_actions( 'PNFPB_cron_comments_post_hook', array(), '' );
						as_schedule_recurring_action( strtotime( 'now' ), $timeseconds, 'PNFPB_cron_comments_post_hook', array(), 'pnfpb_postcomments', true );										
					}
									
			 		if ( false === as_has_scheduled_action( 'PNFPB_cron_buddypresscomments_hook' ) ) {
						as_schedule_recurring_action( strtotime( 'now' ), $timeseconds, 'PNFPB_cron_buddypresscomments_hook', array(), 'pnfpb_buddypresscomments', true );    				
					}
					else 
					{

						as_unschedule_all_actions( 'PNFPB_cron_buddypresscomments_hook', array(), '' );
						as_schedule_recurring_action( strtotime( 'now' ), $timeseconds, 'PNFPB_cron_buddypresscomments_hook', array(), 'pnfpb_buddypresscomments', true );										
					}									
				}
				else 
				{
 					if (as_has_scheduled_action( 'PNFPB_cron_buddypresscomments_hook' ) ) {
						as_unschedule_all_actions( 'PNFPB_cron_buddypresscomments_hook', array(), 'pnfpb_buddypresscomments' );
					}
					
 					if (as_has_scheduled_action( 'PNFPB_cron_comments_post_hook' ) ) {
						as_unschedule_all_actions( 'PNFPB_cron_comments_post_hook', array(), 'pnfpb_postcomments' );
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
			}

			if ( wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' ) ) {
				$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' );
				wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressactivities_hook' );					
			}
			
			if ( wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
				$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' );
				wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressgroupactivities_hook' );					
			}			

			if ( wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' ) ) {
				$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' );
				wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypresscomments_hook' );					
			}
			
			if ( wp_next_scheduled( 'PNFPB_cron_comments_post_hook' ) ) {
				$timestamp = wp_next_scheduled( 'PNFPB_cron_comments_post_hook' );
				wp_unschedule_event( $timestamp, 'PNFPB_cron_comments_post_hook' );					
			}
			
			if ( wp_next_scheduled( 'PNFPB_cron_token_delete_user_not_exist_hook' ) ) {
				$timestamp = wp_next_scheduled( 'PNFPB_cron_token_delete_user_not_exist_hook' );
				wp_unschedule_event( $timestamp, 'PNFPB_cron_token_delete_user_not_exist_hook' );					
			}
			
 			if (as_has_scheduled_action( 'PNFPB_cron_post_hook' ) ) {
				as_unschedule_all_actions( 'PNFPB_cron_post_hook', array(), 'pnfpb_post' );
			}
					
 			if (as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ) ) {
				as_unschedule_all_actions( 'PNFPB_cron_buddypressactivities_hook', array(), 'pnfpb_buddypressactivities' );
			}

 			if (as_has_scheduled_action( 'PNFPB_cron_comments_post_hook' ) ) {
				as_unschedule_all_actions( 'PNFPB_cron_comments_post_hook', array(), 'pnfpb_buddypresscomments' );
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
	
			wp_enqueue_style( 'pnfpb-admin-icpstyle-name', plugin_dir_url( __FILE__ ).'admin/css/pnfpb_admin.css',array(),'1.581' );
			wp_enqueue_style( 'pnfpb-admin-pwa-icpstyle-name', plugin_dir_url( __FILE__ ).'admin/css/pnfpb_pwa_admin.css',array(),'1.581' );
			
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
			
			$pwacustominstalltype = get_option('pnfpb_ic_pwa_app_custom_prompt_type');

			if ($projectId != false && $projectId != '' && $publicKey != false && $publicKey != '' && $apiKey != false && $apiKey != '' && $messagingSenderId != false && $messagingSenderId != '' && get_option( 'pnfpb_ic_disable_serviceworker_pwa_pushnotification' ) != '1')  {
			    
				$filename = '/public/js/firebase-core/pnfpb_firebase_app.js';
				wp_enqueue_script('pnfpb-firebase_app', plugins_url( $filename, __FILE__ ), array(), '8.2.5', true);

				$filename = '/public/js/firebase-core/pnfpb_firebase_auth.js';
				wp_enqueue_script('pnfpb-firebase_auth', plugins_url( $filename, __FILE__ ), array(), '8.2.5', true);

				$filename = '/public/js/firebase-core/pnfpb_firebase_database.js';
				wp_enqueue_script('pnfpb-firebase_database', plugins_url( $filename, __FILE__ ), array(), '8.2.5', true);

				$filename = '/public/js/firebase-core/pnfpb_firebase_firestore.js';
				wp_enqueue_script('pnfpb-firebase_firestore', plugins_url( $filename, __FILE__ ), array(), '8.2.5', true);

				$filename = '/public/js/firebase-core/pnfpb_firebase_messaging.js';
				wp_enqueue_script('pnfpb-firebase_messaging', plugins_url( $filename, __FILE__ ), array(), '8.2.5', true);
				
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
				$filename = '/public/js/pnfpb_pushscript_pwa.js';
				$ajaxobject = 'pnfpb_ajax_object_push';
				wp_enqueue_script( 'pnfpb-icajax-script-push', plugins_url( $filename, __FILE__ ), array( 'jquery','wp-i18n' ),'1.581',true);
				wp_localize_script( 'pnfpb-icajax-script-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'apiKey' => $apiKey, 'authDomain' => $authDomain, 'databaseURL' => $databaseURL, 'projectId' => $projectId, 'storageBucket' => $storageBucket, 'messagingSenderId' => $messagingSenderId, 'appId' => $appId, 'publicKey' => $publicKey, 'homeurl' => $homeurl, 'pwaapponlyenable' => '0', 'pwainstallheadertext' => $pwainstallheadertext , 'pwainstalltext' => $pwainstalltext, 'pwainstallbuttoncolor' => $pwainstallbuttoncolor, 'pwainstallbuttontextcolor' => $pwainstallbuttontextcolor, 'pwainstallbuttontext' => $pwainstallbuttontext, 'pwainstallpromptenabled' => $pwainstallpromptenabled,  'pwacustominstalltype' => $pwacustominstalltype,'unsubscribe_dialog_text_confirm' => $unsubscribe_dialog_text_confirm, 'subscribe_dialog_text_confirm' => $subscribe_dialog_text_confirm,'unsubscribe_button_text' => $unsubscribe_button_text_shortcode, 'subscribe_button_text' => $subscribe_button_text_shortcode, 'subscribe_button_text_color' => $subscribe_button_text_color, 'subscribe_button_color' => $subscribe_button_color, 'cancel_button_text' => $cancel_button_text, 'save_button_text' => $save_button_text, 'isloggedin' => is_user_logged_in(), 'pnfpb_push_prompt' => $pnfpb_push_prompt) );
				
				$filename = '/public/js/pnfpb_unsubscribe_pushscript_pwa.js';
				$ajaxobject = 'pnfpb_ajax_object_unsubscribe_push';
				wp_enqueue_script( 'pnfpb-icajax-script-unsubscribe-push', plugins_url( $filename, __FILE__ ), array( 'jquery','wp-i18n' ),'1.581',true);
				wp_localize_script( 'pnfpb-icajax-script-unsubscribe-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'publicKey' => $publicKey, 'homeurl' => $homeurl, 'unsubscribe_dialog_text' => $unsubscribe_dialog_text_confirm, 'subscribe_dialog_text' => $subscribe_dialog_text_confirm, 'unsubscribe_dialog_text_confirm' => $unsubscribe_dialog_text_confirm, 'subscribe_dialog_text_confirm' => $subscribe_dialog_text_confirm,'unsubscribe_button_text' => $unsubscribe_button_text_shortcode, 'subscribe_button_text' => $subscribe_button_text_shortcode, 'subscribe_button_text_color' => $subscribe_button_text_color, 'subscribe_button_color' => $subscribe_button_color) );
			
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
				
	
				
				$filename = '/public/js/pnfpb_group_pushscript_pwa.js';
				$ajaxobject = 'pnfpb_ajax_object_group_push';
				wp_enqueue_script( 'pnfpb-icajax-script-group-push', plugins_url( $filename, __FILE__ ), array( 'jquery','wp-i18n' ),'1.581',true);
				wp_localize_script( 'pnfpb-icajax-script-group-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'groupId' => '9', 'publicKey' => $publicKey, 'homeurl' => $homeurl,'group_unsubscribe_dialog_text_confirm' => $group_unsubscribe_dialog_text_confirm, 'group_subscribe_dialog_text_confirm' => $group_subscribe_dialog_text_confirm, 'group_unsubscribe_dialog_text' => $group_unsubscribe_dialog_text, 'group_subscribe_dialog_text' => $group_subscribe_dialog_text, 'unsubscribe_button_text' => $unsubscribe_button_text, 'subscribe_button_text' => $subscribe_button_text, 'subscribe_button_text_color' => $subscribe_button_text_color, 'subscribe_button_color' => $subscribe_button_color) );
				
			}
			else 
			{
				if ($pwaappenable === "1" && get_option( 'pnfpb_ic_disable_serviceworker_pwa_pushnotification' ) != '1') {
					$pnfpb_push_prompt = get_option('pnfpb_ic_fcm_push_prompt_enable');
					$filename = '/public/js/pnfpb_pushscript_pwa.js';
					$ajaxobject = 'pnfpb_ajax_object_push';
					wp_enqueue_script( 'pnfpb-icajax-script-push', plugins_url( $filename, __FILE__ ), array( 'jquery','wp-i18n' ),'1.581',true);
					wp_localize_script( 'pnfpb-icajax-script-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'apiKey' => $apiKey, 'authDomain' => $authDomain, 'databaseURL' => $databaseURL, 'projectId' => $projectId, 'storageBucket' => $storageBucket, 'messagingSenderId' => $messagingSenderId, 'appId' => $appId, 'publicKey' => $publicKey, 'homeurl' => $homeurl, 'pwaapponlyenable' => $pwaappenable, 'pwainstallheadertext' => $pwainstallheadertext , 'pwainstalltext' => $pwainstalltext, 'pwainstallbuttoncolor' => $pwainstallbuttoncolor, 'pwainstallbuttontextcolor' => $pwainstallbuttontextcolor, 'pwainstallbuttontext' => $pwainstallbuttontext, 'pwacustominstalltype' => $pwacustominstalltype,  'pwainstallpromptenabled' => $pwainstallpromptenabled, 'pnfpb_push_prompt'=> $pnfpb_push_prompt) );					
				}
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
			
			wp_enqueue_script("jquery");
			wp_enqueue_script( 'jquery-ui-dialog' ); 
			wp_enqueue_style( 'wp-jquery-ui-dialog' );
	
            wp_enqueue_style( 'pnfpb-icpstyle-name', plugin_dir_url( __FILE__ ).'public/css/pnfpb_main.css',array(),'1.581' );
            
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
			
			$pwacustominstalltype = get_option('pnfpb_ic_pwa_app_custom_prompt_type');

			if ($projectId != false && $projectId != '' && $publicKey != false && $publicKey != '' && $apiKey != false && $apiKey != '' && $messagingSenderId != false && $messagingSenderId != '' && get_option( 'pnfpb_ic_disable_serviceworker_pwa_pushnotification' ) != '1')  {
			    
				$filename = '/public/js/firebase-core/pnfpb_firebase_app.js';
				wp_enqueue_script('pnfpb-firebase_app', plugins_url( $filename, __FILE__ ), array(), '8.2.5', true);

				$filename = '/public/js/firebase-core/pnfpb_firebase_auth.js';
				wp_enqueue_script('pnfpb-firebase_auth', plugins_url( $filename, __FILE__ ), array(), '8.2.5', true);

				$filename = '/public/js/firebase-core/pnfpb_firebase_database.js';
				wp_enqueue_script('pnfpb-firebase_database', plugins_url( $filename, __FILE__ ), array(), '8.2.5', true);

				$filename = '/public/js/firebase-core/pnfpb_firebase_firestore.js';
				wp_enqueue_script('pnfpb-firebase_firestore', plugins_url( $filename, __FILE__ ), array(), '8.2.5', true);

				$filename = '/public/js/firebase-core/pnfpb_firebase_messaging.js';
				wp_enqueue_script('pnfpb-firebase_messaging', plugins_url( $filename, __FILE__ ), array(), '8.2.5', true);
				
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
					
				$filename = '/public/js/pnfpb_pushscript_pwa.js';
				$ajaxobject = 'pnfpb_ajax_object_push';
				wp_enqueue_script( 'pnfpb-icajax-script-push', plugins_url( $filename, __FILE__ ), array( 'jquery' ),'1.581',true);
				wp_localize_script( 'pnfpb-icajax-script-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'apiKey' => $apiKey, 'authDomain' => $authDomain, 'databaseURL' => $databaseURL, 'projectId' => $projectId, 'storageBucket' => $storageBucket, 'messagingSenderId' => $messagingSenderId, 'appId' => $appId, 'publicKey' => $publicKey, 'homeurl' => $homeurl, 'pwaapponlyenable' => '0', 'pwainstallheadertext' => $pwainstallheadertext , 'pwainstalltext' => $pwainstalltext, 'pwainstallbuttoncolor' => $pwainstallbuttoncolor, 'pwainstallbuttontextcolor' => $pwainstallbuttontextcolor, 'pwainstallbuttontext' => $pwainstallbuttontext, 'pwainstallpromptenabled' => $pwainstallpromptenabled,  'pwacustominstalltype' => $pwacustominstalltype,'unsubscribe_dialog_text_confirm' => $unsubscribe_dialog_text_confirm, 'subscribe_dialog_text_confirm' => $subscribe_dialog_text_confirm,'unsubscribe_button_text' => $unsubscribe_button_text_shortcode, 'subscribe_button_text' => $subscribe_button_text_shortcode, 'subscribe_button_text_color' => $subscribe_button_text_color, 'subscribe_button_color' => $subscribe_button_color, 'cancel_button_text' => $cancel_button_text, 'save_button_text' => $save_button_text, 'isloggedin' => is_user_logged_in(), 'pnfpb_push_prompt' => $pnfpb_push_prompt, 'userid' => get_current_user_id()) );
				
				$filename = '/public/js/pnfpb_unsubscribe_pushscript_pwa.js';
				$ajaxobject = 'pnfpb_ajax_object_unsubscribe_push';
				wp_enqueue_script( 'pnfpb-icajax-script-unsubscribe-push', plugins_url( $filename, __FILE__ ), array( 'jquery' ),'1.581',true);
				wp_localize_script( 'pnfpb-icajax-script-unsubscribe-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'publicKey' => $publicKey, 'homeurl' => $homeurl, 'unsubscribe_dialog_text' => $unsubscribe_dialog_text_confirm, 'subscribe_dialog_text' => $subscribe_dialog_text_confirm, 'unsubscribe_dialog_text_confirm' => $unsubscribe_dialog_text_confirm, 'subscribe_dialog_text_confirm' => $subscribe_dialog_text_confirm,'unsubscribe_button_text' => $unsubscribe_button_text_shortcode, 'subscribe_button_text' => $subscribe_button_text_shortcode, 'subscribe_button_text_color' => $subscribe_button_text_color, 'subscribe_button_color' => $subscribe_button_color) );
			
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
				
	
				
				$filename = '/public/js/pnfpb_group_pushscript_pwa.js';
				$ajaxobject = 'pnfpb_ajax_object_group_push';
				wp_enqueue_script( 'pnfpb-icajax-script-group-push', plugins_url( $filename, __FILE__ ), array( 'jquery' ),'1.581',true);
				wp_localize_script( 'pnfpb-icajax-script-group-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'groupId' => '9', 'publicKey' => $publicKey, 'homeurl' => $homeurl,'group_unsubscribe_dialog_text_confirm' => $group_unsubscribe_dialog_text_confirm, 'group_subscribe_dialog_text_confirm' => $group_subscribe_dialog_text_confirm, 'group_unsubscribe_dialog_text' => $group_unsubscribe_dialog_text, 'group_subscribe_dialog_text' => $group_subscribe_dialog_text, 'unsubscribe_button_text' => $unsubscribe_button_text, 'subscribe_button_text' => $subscribe_button_text, 'subscribe_button_text_color' => $subscribe_button_text_color, 'subscribe_button_color' => $subscribe_button_color) );
				
			}
			else 
			{
				if ($pwaappenable === "1" && get_option( 'pnfpb_ic_disable_serviceworker_pwa_pushnotification' ) != '1') {
					$pnfpb_push_prompt = get_option('pnfpb_ic_fcm_push_prompt_enable');
					$filename = '/public/js/pnfpb_pushscript_pwa.js';
					$ajaxobject = 'pnfpb_ajax_object_push';
					wp_enqueue_script( 'pnfpb-icajax-script-push', plugins_url( $filename, __FILE__ ), array( 'jquery' ),'1.581',true);
					wp_localize_script( 'pnfpb-icajax-script-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'apiKey' => $apiKey, 'authDomain' => $authDomain, 'databaseURL' => $databaseURL, 'projectId' => $projectId, 'storageBucket' => $storageBucket, 'messagingSenderId' => $messagingSenderId, 'appId' => $appId, 'publicKey' => $publicKey, 'homeurl' => $homeurl, 'pwaapponlyenable' => $pwaappenable, 'pwainstallheadertext' => $pwainstallheadertext , 'pwainstalltext' => $pwainstalltext, 'pwainstallbuttoncolor' => $pwainstallbuttoncolor, 'pwainstallbuttontextcolor' => $pwainstallbuttontextcolor, 'pwainstallbuttontext' => $pwainstallbuttontext, 'pwacustominstalltype' => $pwacustominstalltype,  'pwainstallpromptenabled' => $pwainstallpromptenabled, 'pnfpb_push_prompt' => $pnfpb_push_prompt, 'userid' => get_current_user_id()) );					
				}
			}
			
  
		}
    
		/**
		 * Add pnfpbmanifest.json to header for PWA app
		 * provided PWA conversion app option is ON
		 * @since 1.20
		 */
		// Creates the link tag
		public function PNFPB_include_manifest_link() {
			if (get_option('pnfpb_ic_pwa_app_enable') === '1' && get_option( 'pnfpb_ic_disable_serviceworker_pwa_pushnotification' ) != '1') {
        		echo '<link rel="manifest" href="'.get_home_url().'/pnfpbmanifest.json">';
			}
		}

		public function PNFPB_custom_pwa_install_prompt() {
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
			
			echo '<div id="pnfpb-push-dialog-container" class="pnfpb-push-dialog-container '.$pnfpb_push_prompt_position.'">
						<div class="pnfpb-push-dialog-box" style="background-color:'.$pnfpb_push_prompt_dialog_background.'">
							<div class="pnfpb-push-dialog-title" style="color:'.$pnfpb_push_prompt_text_color.';">'.$pnfpb_push_prompt_text.'</div>
							<div class="pnfpb-push-dialog-buttons">
								<button id="pnfpb-push-dialog-cancel" type="button" class="button secondary"  style="color:'.$pnfpb_push_prompt_button_text_color.';background-color:'.$pnfpb_push_prompt_button_background.';">'.$pnfpb_push_prompt_cancel_button_text.'</button>
								<button id="pnfpb-push-dialog-subscribe" type="button" class="button primary"  style="color:'.$pnfpb_push_prompt_button_text_color.';background-color:'.$pnfpb_push_prompt_button_background.';">'.$pnfpb_push_prompt_confirm_button_text.'</button>
							</div>
						</div>
				</div>';
			
			if (get_option('pnfpb_ic_pwa_app_enable') === '1' && get_option('pnfpb_ic_pwa_app_custom_prompt_enable') === '1' && get_option( 'pnfpb_ic_disable_serviceworker_pwa_pushnotification' ) != '1') {


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

				<div id="pnfpb-pwa-dialog-app-installed" class="pnfpb-pwa-dialog-app-installed" title="<?php if ( get_option("pnfpb-pwa-dialog-app-installed_text", false) )  { echo get_option("pnfpb-pwa-dialog-app-installed_text"); } else { echo __('App installed successfully','PNFPB_TD'); } ?>">
					<p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span><?php if ( get_option("pnfpb-pwa-dialog-app-installed_description", false)) { echo get_option("pnfpb-pwa-dialog-app-installed_description"); } else { echo __('Progressive Web App (PWA) is installed successfully.','PNFPB_TD'); } ?></p>
				</div>
<?php				
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
				, 3
			);			

			add_submenu_page('pnfpb-icfcm-slug'            // -> Set to null - will hide menu link
				, __('On demand Notification', 'PNFPB_TD')// -> Page Title
				, 'On demand/One time Notification'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfmtest_notification'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_test_notification') // -> To render the page
				, 4
			);
			
			add_submenu_page('pnfpb-icfcm-slug'            // -> Set to null - will hide menu link
				, __('Frontend subscription', 'PNFPB_TD')// -> Page Title
				, 'Frontend subscription'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfm_frontend_settings'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_frontend_settings') // -> To render the page
				, 5
			);
			
			add_submenu_page('pnfpb-icfcm-slug'            // -> Set to null - will hide menu link
				, __('Customize Buttons', 'PNFPB_TD')// -> Page Title
				, 'Customize Buttons'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfm_button_settings'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_button_settings') // -> To render the page
				,6
			);			
			
		  	add_submenu_page('pnfpb-icfcm-slug'            // -> Set to null - will hide menu link
				, __('Integrate Mobile Apps', 'PNFPB_TD')// -> Page Title
				, 'Integrate Mobile App'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfm_integrate_app'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_integrate_app') // -> To render the page
				,7
			);
			
		  	add_submenu_page('pnfpb-icfcm-slug'            // -> Set to null - will hide menu link
				, __('NGNIX', 'PNFPB_TD')// -> Page Title
				, 'NGNIX'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfm_settings_for_ngnix_server'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_settings_for_ngnix_server') // -> To render the page
				,8
			);

			$hook_pnfpb_action_scheduler = add_submenu_page('pnfpb-icfcm-slug'            // -> Set to null - will hide menu link
				, __('Action scheduler', 'PNFPB_TD')// -> Page Title
				, 'Action scheduler'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfm_action_scheduler'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_action_scheduler') // -> To render the page
				,9
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
			include(plugin_dir_path(__FILE__) . 'admin/pnfpb_admin_ondemand_notification_settings.php');
		} 		
		

		/* On demand schedule push notification
		* 
		* 
		* @since 1.57
		* 
		*/
		public function PNFPB_ondemand_schedule_push_notification($scheduled_day_push_notification) {
	
			global $wpdb;
	
			$apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
			
			
			if ($apiaccesskey != '' && $apiaccesskey != false) {
	
			    $table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
			    $deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%'" );
				
				$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%'" );
	
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
				
				if (count($regid) > 0) {

					// prepare the message
					$message = array( 
						'title'     => stripslashes(strip_tags(get_option('pnfpb_ic_fcm_ondemand_schedule_pn_title'.$scheduled_day_push_notification))),
						'body'      => stripslashes(strip_tags($activity_content_push)),
						'icon'		=> $imageurl,
						'image'		=> $imageurl,
						'click_action' => $postlink
					);
    

					$fields = array( 
						'registration_ids' => $regid, 
						'notification' => $message
					);
    
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
			
					$apiresults = wp_remote_post($url, $args);
				
					$apibody = wp_remote_retrieve_body($apiresults);
				
					$bodyresults = json_decode($apibody,true);
					if (is_array($bodyresults)) {
						if (array_key_exists('results', $bodyresults)) {
							foreach ($bodyresults['results'] as $idx=>$result){
								if (array_key_exists('error',$result)) {
									if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
										$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
									}
								}
							}
						}
					}
		
			
					if (is_wp_error($apiresults)) {
						$status = $apiresults->get_error_code(); 				// custom code for WP_ERROR
						$error_message = $apiresults->get_error_message();
						error_log('There was a '.$status.' error in push notification : '.$error_message);
					}
				}
				
				if (count($deviceidswebview) > 0) {

					// prepare the message
					$message = array( 
						'title'     => get_option('pnfpb_ic_fcm_ondemand_schedule_pn_title'.$scheduled_day_push_notification),
						'body'      => stripslashes(strip_tags($activity_content_push)),
						'icon'		=> $imageurl,
						'image'		=> $imageurl,
						'badge'		=> 0
					);
    

					$fields = array( 
						'registration_ids' => $deviceidswebview, 
						'notification' => $message,
						'data'	=> array('click_url' => $postlink)
					);
    
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
			
					$apiresults = wp_remote_post($url, $args);
				
					$apibody = wp_remote_retrieve_body($apiresults);
				
					$bodyresults = json_decode($apibody,true);
					if (is_array($bodyresults)) {
						if (array_key_exists('results', $bodyresults)) {
							foreach ($bodyresults['results'] as $idx=>$result){
								if (array_key_exists('error',$result)) {
									if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($deviceidswebview[$idx], '!!') === false) {
										$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$deviceidswebview[$idx]}'") ;
									}
								}
							}
						}
					}
		
			
					if (is_wp_error($apiresults)) {
						$status = $apiresults->get_error_code(); 				// custom code for WP_ERROR
						$error_message = $apiresults->get_error_message();
						error_log('There was a '.$status.' error in push notification : '.$error_message);
					}
					
				}
			}
			
			delete_option('pnfpb_ic_fcm_ondemand_schedule_pn_title'.$scheduled_day_push_notification);
			delete_option('pnfpb_ic_fcm_ondemand_schedule_pn_content'.$scheduled_day_push_notification);
			delete_option('pnfpb_ic_fcm_ondemand_schedule_pn_image'.$scheduled_day_push_notification);
			delete_option('pnfpb_ic_fcm_ondemand_schedule_pn_url'.$scheduled_day_push_notification);			
	
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
				<?php echo __("Push notification",'PNFPB_TD');?></button></a><a href="admin.php?page=pnfpb_icfm_device_tokens_list" class="pnfpb_column_full"><button class="pnfpb_post_type_content_button" type="button"><?php echo __(PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER,'PNFPB_TD');?></button></a><a href="admin.php?page=pnfpb_icfm_pwa_app_settings" class="pnfpb_column_full"><button class="pnfpb_post_type_content_button" type="button"><?php echo __(PNFPB_PLUGIN_NM_PWA_HEADER,'PNFPB_TD');?></button></a><a href="admin.php?page=pnfpb_icfmtest_notification" class="pnfpb_column_full"><button class="pnfpb_post_type_content_button" type="button"><?php echo __(PNFPB_PLUGIN_NM_ONDEMANDPUSH_HEADER,'PNFPB_TD');?></button></a><a href="admin.php?page=pnfpb_icfm_frontend_settings" class="pnfpb_column_full"><button class="pnfpb_post_type_content_button" type="button"><?php echo __(PNFPB_PLUGIN_NM_FRONTEND_SETTINGS_HEADER,'PNFPB_TD');?></button></a><a href="admin.php?page=pnfpb_icfm_button_settings" class="pnfpb_column_full"><button class="pnfpb_post_type_content_button" type="button"><?php echo __(PNFPB_PLUGIN_NM_BUTTON_HEADER,'PNFPB_TD');?></button></a><a href="admin.php?page=pnfpb_icfm_integrate_app" class="pnfpb_column_full"><button class="pnfpb_post_type_content_button" type="button"><?php echo __(PNFPB_PLUGIN_API_MOBILE_APP_HEADER,'PNFPB_TD');?></button></a><a href="admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="pnfpb_column_full"><button class="pnfpb_post_type_content_button" type="button"><?php echo __(PNFPB_PLUGIN_NGINX_HEADER,'PNFPB_TD');?></button></a><a href="admin.php?page=pnfpb_icfm_action_scheduler" class="pnfpb_column_full"><button class="pnfpb_post_type_content_button" type="button"><?php echo __(PNFPB_PLUGIN_SCHEDULE_ACTIONS,'PNFPB_TD');?></button></a>
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
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_frontend_settings" class="tab"><?php echo __("Frontend settings",'PNFPB_TD');?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_button_settings" class="tab "><?php echo __("Customize buttons",'PNFPB_TD');?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_integrate_app" class="tab "><?php echo __("Mobile app",'PNFPB_TD');?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="tab "><?php echo __("NGINX",'PNFPB_TD');?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_action_scheduler" class="tab active"><?php echo __("Action Scheduler",'PNFPB_TD');?></a>
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
				<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_frontend_settings" class="tab"><?php echo __("Frontend settings",'PNFPB_TD');?></a>
				<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_button_settings" class="tab "><?php echo __("Customize buttons",'PNFPB_TD');?></a>
				<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_integrate_app" class="tab "><?php echo __("Mobile app",'PNFPB_TD');?></a>
				<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="tab "><?php echo __("NGINX",'PNFPB_TD');?></a>
				<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_action_scheduler" class="tab "><?php echo __("Action Scheduler",'PNFPB_TD');?></a>
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
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_prompt_enable");			
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_prompt_text");			
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_prompt_confirm_button");			
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_prompt_cancel_button");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_prompt_button_background");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_prompt_dialog_background");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_prompt_text_color");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_prompt_button_text_color");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_push_prompt_position");
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
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypresscomments_schedule_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypresscomments_schedule_background_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds");			
			
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
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_app_custom_prompt_type");			
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
			
			register_setting("pnfpb_icfcm_nginx", "pnfpb_ic_nginx_static_files_enable");
			
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_button_color");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_button_text_color");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_button_text");			
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_unsubscribe_button_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_group_subscribe_dialog_text");			
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_group_unsubscribe_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm");			
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_unsubscribe_button_shortcode_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_button_shortcode_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_save_button_text_shortcode");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode");		
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_all_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_post_activity_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_all_comments_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_my_comments_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_private_message_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_new_member_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_friendship_request_dialog_text");
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
						wp_schedule_event( time(), $posted_options, 'PNFPB_cron_token_delete_user_not_exist_hook' );														}
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
				
				if (get_option('pnfpb_ic_fcm_post_schedule_enable') && get_option('pnfpb_ic_fcm_post_schedule_enable') == 1 && get_option('pnfpb_ic_fcm_post_schedule_background_enable') != 1) {			
			
			 		if ( !wp_next_scheduled( 'PNFPB_cron_post_hook' ) ) {
    					wp_schedule_event( time(), $posted_options, 'PNFPB_cron_post_hook' );
			
					}
					else 
					{
						$timestamp = wp_next_scheduled( 'PNFPB_cron_post_hook' );
						wp_unschedule_event( $timestamp, 'PNFPB_cron_post_hook' );
								
					}
				}
				else 
				{
					if ( wp_next_scheduled( 'PNFPB_cron_post_hook' ) ) {
						$timestamp = wp_next_scheduled( 'PNFPB_cron_post_hook' );
						wp_unschedule_event( $timestamp, 'PNFPB_cron_post_hook' );
					}
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
					
			 		if ( false === as_has_scheduled_action( 'PNFPB_cron_post_hook' ) ) {
						as_schedule_recurring_action( strtotime( 'now' ), $timeseconds, 'PNFPB_cron_post_hook', array(), 'pnfpb_post', true );    				
					}
					else 
					{

						as_unschedule_all_actions( 'PNFPB_cron_post_hook', array(), '' );
						as_schedule_recurring_action( strtotime( 'now' ), $timeseconds, 'PNFPB_cron_post_hook', array(), 'pnfpb_post', true );										
					}
				}
				else 
				{
 					if (as_has_scheduled_action( 'PNFPB_cron_post_hook' ) ) {
						as_unschedule_all_actions( 'PNFPB_cron_post_hook', array(), 'pnfpb_post' );
					}
				}
			}
			return $posted_options;
			
		}
		
		public function pnfpb_ic_fcm_buddypressactivities_timeschedule_callback($posted_options){
			
			if( $_POST['submit'] == 'Save changes' ) {
				
				if (get_option('pnfpb_ic_fcm_buddypressactivities_schedule_enable') && get_option('pnfpb_ic_fcm_buddypressactivities_schedule_enable') == 1 && get_option('pnfpb_ic_fcm_buddypressactivities_schedule_background_enable') != 1) 
				{
					if (get_option('pnfpb_ic_fcm_buddypress_enable') == 1) {
			 			if ( !wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' ) ) {
    						wp_schedule_event( time(), $posted_options, 'PNFPB_cron_buddypressactivities_hook' );
						}
						else 
						{
							$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' );
							wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressactivities_hook' );
							wp_schedule_event( time(), $posted_options, 'PNFPB_cron_buddypressactivities_hook' );					
						}
						if ( wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
							$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' );
							wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressgroupactivities_hook' );
						}						
					}
					else 
					{
						if (get_option('pnfpb_ic_fcm_buddypress_enable') == 2) {
			 				if ( !wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
    							wp_schedule_event( time(), $posted_options, 'PNFPB_cron_buddypressgroupactivities_hook' );
							}
							else 
							{
								$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' );
								wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressgroupactivities_hook' );
								wp_schedule_event( time(), $posted_options, 'PNFPB_cron_buddypressgroupactivities_hook' );					
							}
							if ( wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' ) ) {
								$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' );
								wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressactivities_hook' );
							}							
						}
					}
				}
				else 
				{
					if ( wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' ) ) {
						$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' );
						wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressactivities_hook' );					
					}
					
					if ( wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
						$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' );
						wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypressgroupactivities_hook' );					
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
			
			 		if ( false === as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ) &&  get_option('pnfpb_ic_fcm_buddypress_enable') == 1 ) {
						as_schedule_recurring_action( strtotime( 'now' ), $timeseconds, 'PNFPB_cron_buddypressactivities_hook', array(), 'pnfpb_buddypressactivities', true ); 
 						if (as_has_scheduled_action( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
							as_unschedule_all_actions( 'PNFPB_cron_buddypressgroupactivities_hook', array(), 'pnfpb_buddypressgroupactivities' );
						}						
						
					}
					else 
					{
						if (get_option('pnfpb_ic_fcm_buddypress_enable') == 1 ) {

							as_unschedule_all_actions( 'PNFPB_cron_buddypressactivities_hook', array(), '' );
							as_schedule_recurring_action( strtotime( 'now' ), $timeseconds, 'PNFPB_cron_buddypressactivities_hook', array(), 'pnfpb_buddypressactivities', true );
							if (as_has_scheduled_action( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
								as_unschedule_all_actions( 'PNFPB_cron_buddypressgroupactivities_hook', array(), 'pnfpb_buddypressgroupactivities' );
							}							
							
						}

					}
									
					if ( false === as_has_scheduled_action( 'PNFPB_cron_buddypressgroupactivities_hook' ) && get_option('pnfpb_ic_fcm_buddypress_enable') == 2  ) {
						as_schedule_recurring_action( strtotime( 'now' ), $timeseconds, 'PNFPB_cron_buddypressgroupactivities_hook', array(), 'pnfpb_buddypressgroupactivities', true );
 						if (as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ) ) {
							as_unschedule_all_actions( 'PNFPB_cron_buddypressactivities_hook', array(), 'pnfpb_buddypressactivities' );
						}						
					}
					else 
					{
						if (get_option('pnfpb_ic_fcm_buddypress_enable') == 2 ) {
							as_unschedule_all_actions( 'PNFPB_cron_buddypressgroupactivities_hook', array(), '' );
							as_schedule_recurring_action( strtotime( 'now' ), $timeseconds, 'PNFPB_cron_buddypressgroupactivities_hook', array(), 'pnfpb_buddypressgroupactivities', true );
 							if (as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ) ) {
								as_unschedule_all_actions( 'PNFPB_cron_buddypressactivities_hook', array(), 'pnfpb_buddypressactivities' );
							}							
						}
						
						
					}					
				}
				else 
				{
 					if (as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ) ) {
						as_unschedule_all_actions( 'PNFPB_cron_buddypressactivities_hook', array(), 'pnfpb_buddypressactivities' );
					}
					
 					if (as_has_scheduled_action( 'PNFPB_cron_buddypressgroupactivities_hook' ) ) {
						as_unschedule_all_actions( 'PNFPB_cron_buddypressgroupactivities_hook', array(), 'pnfpb_buddypressgroupactivities' );
					}					
				}				
			}
			return $posted_options;
		}
		
		public function pnfpb_ic_fcm_buddypresscomments_timeschedule_callback($posted_options){
			
			if( $_POST['submit'] == 'Save changes' ) {
				
				if (get_option('pnfpb_ic_fcm_buddypresscomments_schedule_enable') && get_option('pnfpb_ic_fcm_buddypresscomments_schedule_enable') == 1 && get_option('pnfpb_ic_fcm_buddypresscomments_schedule_background_enable') != 1) {
			
			 		if ( !wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' ) ) {
    					wp_schedule_event( time(), $posted_options, 'PNFPB_cron_buddypresscomments_hook' );
					}
					else 
					{
						$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' );
						wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypresscomments_hook' );
						wp_schedule_event( time(), $posted_options, 'PNFPB_cron_buddypresscomments_hook' );
					}
					
			 		if ( !wp_next_scheduled( 'PNFPB_cron_comments_post_hook' ) ) {
    					wp_schedule_event( time(), $posted_options, 'PNFPB_cron_comments_post_hook' );
					}
					else 
					{
						$timestamp = wp_next_scheduled( 'PNFPB_cron_comments_post_hook' );
						wp_unschedule_event( $timestamp, 'PNFPB_cron_comments_post_hook' );
						wp_schedule_event( time(), $posted_options, 'PNFPB_cron_comments_post_hook' );
					}					
				}
				else 
				{
					if ( wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' ) ) {
						$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' );
						wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypresscomments_hook' );					
					}
					
					if ( wp_next_scheduled( 'PNFPB_cron_comments_post_hook' ) ) {
						$timestamp = wp_next_scheduled( 'PNFPB_cron_comments_post_hook' );
						wp_unschedule_event( $timestamp, 'PNFPB_cron_comments_post_hook' );					
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
			
			 		if ( false === as_has_scheduled_action( 'PNFPB_cron_comments_post_hook' ) ) {
						as_schedule_recurring_action( strtotime( 'now' ), $timeseconds, 'PNFPB_cron_comments_post_hook', array(), 'pnfpb_postcomments', true );    				
					}
					else 
					{

						as_unschedule_all_actions( 'PNFPB_cron_comments_post_hook', array(), '' );
						as_schedule_recurring_action( strtotime( 'now' ), $timeseconds, 'PNFPB_cron_comments_post_hook', array(), 'pnfpb_postcomments', true );										
					}
									
			 		if ( false === as_has_scheduled_action( 'PNFPB_cron_buddypresscomments_hook' ) ) {
						as_schedule_recurring_action( strtotime( 'now' ), $timeseconds, 'PNFPB_cron_buddypresscomments_hook', array(), 'pnfpb_buddypresscomments', true );    				
					}
					else 
					{

						as_unschedule_all_actions( 'PNFPB_cron_buddypresscomments_hook', array(), '' );
						as_schedule_recurring_action( strtotime( 'now' ), $timeseconds, 'PNFPB_cron_buddypresscomments_hook', array(), 'pnfpb_buddypresscomments', true );										
					}									
				}
				else 
				{
 					if (as_has_scheduled_action( 'PNFPB_cron_buddypresscomments_hook' ) ) {
						as_unschedule_all_actions( 'PNFPB_cron_buddypresscomments_hook', array(), 'pnfpb_buddypresscomments' );
					}
					
 					if (as_has_scheduled_action( 'PNFPB_cron_comments_post_hook' ) ) {
						as_unschedule_all_actions( 'PNFPB_cron_comments_post_hook', array(), 'pnfpb_postcomments' );
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
        		if ( 'settings_page_pnfpb-icfcm-slug' == $screen->base || 'settings_page_pnfpb_icfm_pwa_app_settings' == $screen->base || 'settings_page_pnfpb_icfmtest_notification'  == $screen->base ) {
            		wp_enqueue_media();
        		} else return;
    		} );
			$ajaxobject = 'pnfpb_ajax_object_pwa_upload_icon';
			$filename = '/admin/js/pnfpb_ic_upload_icon.js';
			wp_register_script('pnfpb_ic_upload_icon_script',plugins_url( $filename, __FILE__ ), array('jquery','wp-i18n'), '1.58.1', true);
			wp_enqueue_script('pnfpb_ic_upload_icon_script');
			$filename = '/admin/js/pnfpb_ic_pwa_upload_icon.js';
			wp_register_script('pnfpb_ic_pwa_upload_icon_script',plugins_url( $filename, __FILE__ ), array('jquery','wp-i18n'), '1.58.1', true);
			wp_localize_script('pnfpb_ic_pwa_upload_icon_script',$ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
			wp_enqueue_script('pnfpb_ic_pwa_upload_icon_script');
			$filename = '/admin/js/pnfpb_ic_ondemand_push_upload_image.js';
			wp_register_script('pnfpb_ic_ondemand_push_upload_image_script',plugins_url( $filename, __FILE__ ), array('jquery','wp-i18n'), '1.58.1', true);
			wp_enqueue_script('pnfpb_ic_ondemand_push_upload_image_script');				
		}   


		/**
		* Create service worker file on fly(dynamically) which is needed for push notification using FCM
		*
		* @since 1.0.0
		*/
		public function PNFPB_icpush_sw_file_create() {

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
				
					$createfileresult = $wp_filesystem->put_contents( trailingslashit( ABSPATH ) . 'pnfpb_icpush_pwa_sw.js',$sw_content, 0644);

				}
			
				$firebase_sw_contents = PNFPB_icfm_icpush_firebasesw_template();	
				$firebase_swresponse 		= wp_remote_head( home_url( '/' ). 'firebase-messaging-sw.js', array( 'sslverify' => false ) );
				
				$firebase_swresponse_code 	= wp_remote_retrieve_response_code( $firebase_swresponse );

	
				if ( 200 !== $firebase_swresponse_code ) {
				
					$createfileresult = $wp_filesystem->put_contents( trailingslashit( ABSPATH ) . 'firebase-messaging-sw.js',$firebase_sw_contents, 0644);

				}
			
				if (get_option('pnfpb_ic_pwa_app_enable') === '1' && get_option( 'pnfpb_ic_disable_serviceworker_pwa_pushnotification' ) != '1') {
			
					$pwa_manifest_contents = PNFPB_ic_generate_pwa_manifest_json();	
	
					$pwa_manifest_response 		= wp_remote_head( home_url( '/' ). 'pnfpbmanifest.json', array( 'sslverify' => false ) );
					
					$pwa_manifest_response_code 	= wp_remote_retrieve_response_code( $pwa_manifest_response );
				
					if ( 200 !== $pwa_manifest_response_code ) {
				
						$createfileresult = $wp_filesystem->put_contents( trailingslashit( ABSPATH ) . 'pnfpbmanifest.json',$pwa_manifest_contents, 0644);

					}
					
				}
				
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
		public function PNFPB_on_post_save_web($post_id=null, $post=null, $update=null) {
			
		if (!wp_next_scheduled( 'PNFPB_cron_post_hook' ) && (false === as_has_scheduled_action( 'PNFPB_cron_post_hook' )))
		{
			$from = get_bloginfo('name');
			$post_type = $post->post_type;

			if(get_option('pnfpb_ic_fcm_'.$post_type.'_enable')) {
				$postlink = get_permalink($post->ID);
				//new post/page
				if (isset($post->post_status)) {

					if ($post->post_status == 'publish') {
						
                        if (get_option('pnfpb_ic_fcm_'.$post_type.'_enable') == 1) {
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
				// if it is called from scheduled hook for post cron schedule
				$post_title = "New content in ".get_bloginfo( 'name' );
				$post_content = "New post in ".get_bloginfo( 'name' );
				$postlink = get_home_url();
				if (get_option('pnfpb_ic_fcm_new_post_id')){
					$postid = get_option('pnfpb_ic_fcm_new_post_id');
				}				
				if (get_option('pnfpb_ic_fcm_new_post_title')){
					$post_title = get_option('pnfpb_ic_fcm_new_post_title');
				}
				if (get_option('pnfpb_ic_fcm_new_post_content')){
					$post_content = get_option('pnfpb_ic_fcm_new_post_content');
				}
				if (get_option('pnfpb_ic_fcm_new_post_link')){
					$postlink = get_option('pnfpb_ic_fcm_new_post_link');
				}
				if (get_option('pnfpb_ic_fcm_new_post_image')){
					$imageurl = get_option('pnfpb_ic_fcm_new_post_image');
				}				
			}
			else
			{
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
				
				$post_title = __("New post from ",'PNFPB_TD').get_bloginfo( 'name' );
				
				
			}

			$apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
			
			if ($apiaccesskey != '' && $apiaccesskey != false) {
	
			    $table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
				
				
				if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
					$deviceids_count = $wpdb->get_results("SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)");
				}
				else 
				{
					$deviceids_count = $wpdb->get_results("SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%'");					
				}
				
					$deviceids_webview_count = $wpdb->get_results("SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)");
				
				for ($dcount=0; $dcount<=count($deviceids_count); $dcount+=1000) {
				
					if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
					}
					else
					{
			    		$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' LIMIT {$dcount}, 1000" );
					}
				

			    	$url = 'https://fcm.googleapis.com/fcm/send';

			    	$regid = $deviceids;
	
			    	$activity_content_push = strip_tags(urldecode($post_content));

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
						if (get_option("pnfpb_ic_fcm_new_post_author") && get_option("pnfpb_ic_fcm_new_post_author") != '') {
							$sender_name = get_the_author_meta( 'display_name', get_option("pnfpb_ic_fcm_new_post_author") ); 
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
				
		
					if (count($regid) > 0) {				
		    			// prepare the message
			    		$message = array( 
				    	'title'     => stripslashes(strip_tags($post_title)),
				    	'body'      => stripslashes(strip_tags($activity_content_push)),
				    	'icon'		=> $iconurl,
						'image'		=> $imageurl,
				    	'click_action' => $postlink
			    		);
    

			    		$fields = array( 
				    	'registration_ids' => $regid, 
				    	'notification' => $message
			    		);
    
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
			
			    		$apiresults = wp_remote_post($url, $args);
				
						$apibody = wp_remote_retrieve_body($apiresults);

						$bodyresults = json_decode($apibody,true);
				
						if (is_array($bodyresults)) {
							if (array_key_exists('results', $bodyresults)) {
								foreach ($bodyresults['results'] as $idx=>$result){
									if (array_key_exists('error',$result)) {
										if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
											$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
										}
									}
								}
							}

						}
		
			
			    		if (is_wp_error($apiresults)) {
				    		$status = $apiresults->get_error_code(); 				// custom code for WP_ERROR
                    		$error_message = $apiresults->get_error_message();
                    		error_log('There was a '.$status.' error in push notification : '.$error_message);
                		}
						
						do_action('PNFPB_connect_to_external_api_for_post',$message);
					}
				}
				
				for ($dcount=0; $dcount<=count($deviceids_webview_count); $dcount+=1000) {
				
					$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );					
				
					if (count($deviceidswebview) > 0) {				
		    			// prepare the message
			    		$message = array( 
				    	'title'     => stripslashes(strip_tags($post_title)),
				    	'body'      => substr(stripslashes(strip_tags($activity_content_push)),0,59),
				    	'icon'		=> $iconurl,
						'image'		=> $imageurl
			    		);
    

			    		$fields = array( 
				    	'registration_ids' => $deviceidswebview, 
				    	'notification' => $message,
						'data'	=> array('click_url' => $postlink)
			    		);
    
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
			
			    		$apiresults = wp_remote_post($url, $args);
				
						$apibody = wp_remote_retrieve_body($apiresults);

						$bodyresults = json_decode($apibody,true);
				
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
				    		$status = $apiresults->get_error_code(); 				// custom code for WP_ERROR
                    		$error_message = $apiresults->get_error_message();
                    		error_log('There was a '.$status.' error in push notification : '.$error_message);
                		}
						
						do_action('PNFPB_connect_to_external_api_for_post_webview',$message);
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



			if (((($activity_content && !wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' )) || (!$activity_content && wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' ))) || ( 
				($activity_content && (false === as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ))) || (!$activity_content && (as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ))))) && ($bactivity == 1 && get_option('pnfpb_ic_fcm_buddypress_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false)) {

				global $wpdb;
				
				

				$activitylink = get_home_url();
				if (function_exists('bp_is_active')){
					$activitylink = get_home_url().'/'.buddypress()->pages->activity->slug;
				}
				
				if ($activity_id) {
					$activitylink = bp_activity_get_permalink($activity_id);
					
				}
	
				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
				
				if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
				}
				else 
				{
						
					if (get_option('pnfpb_shortcode_enable') === 'yes') {
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
					}
					else 
					{
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%'" );
					}
				}
				
				$localactivitycontent = $activity_content;
				if ($activity_content) {
					$localactivitycontent = $activity_content;
				}
				else 
				{
					$localactivitycontent = __("New contents available in ",'PNFPB_TD').get_bloginfo( 'name' );
				}				
				$imageurl = '';
            
				if (get_option('pnfpb_ic_fcm_activity_title') != false && get_option('pnfpb_ic_fcm_activity_title') != '') {
					$activitytitle = get_option('pnfpb_ic_fcm_activity_title');
				}
				else
				{
					$activitytitle = __('New activity post in ','PNFPB_TD').$blog_title;
				}
				
				if (!get_option('pnfpb_ic_fcm_new_buddypressactivities_content')) {
					if ($activity_content) {
						$localactivitycontent = $activity_content;
					}
					else 
					{
						$localactivitycontent = __("New contents available in ",'PNFPB_TD').get_bloginfo( 'name' );
					}
				}
				else 
				{
					if ($activity_content === null){
						$localactivitycontent = get_option('pnfpb_ic_fcm_new_buddypressactivities_content');
						$activitylink = get_option('pnfpb_ic_fcm_new_buddypressactivities_link');
						$imageurl = get_option('pnfpb_ic_fcm_new_buddypressactivities_image');
					}
				}
				
				if (get_option('pnfpb_ic_fcm_activity_message') != false && get_option('pnfpb_ic_fcm_activity_message') != '' ) {
					
					$localactivitycontent = get_option('pnfpb_ic_fcm_activity_message');
					
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
				$sender_name = '';
				if ($user_id !== null) {
					$sender_name = bp_core_get_user_displayname( $user_id );
					$activitytitle = str_replace("[member name]", $sender_name, $activitytitle);
				}
				else 
				{
					if (get_option('pnfpb_ic_fcm_new_buddypressactivities_userid') != '') {
						$sender_name = bp_core_get_user_displayname( get_option('pnfpb_ic_fcm_new_buddypressactivities_userid') );
						$activitytitle = str_replace("[member name]", $sender_name, $activitytitle);
					}
					else 
					{
						$activitytitle = str_replace("[member name]", '', $activitytitle);
					}
				}
					
				if ($activity_id) {
					update_option('pnfpb_ic_fcm_new_buddypressactivities_content',$activity_content);
					update_option('pnfpb_ic_fcm_new_buddypressactivities_userid',$user_id);
					update_option('pnfpb_ic_fcm_new_buddypressactivities_link',bp_activity_get_permalink($activity_id));
					
					preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($activity_content), $imgresult);
				
					$imageurl = '';
				
					if (is_array($imgresult)) {
						if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
							$imageurl = str_replace('"','',$imgresult[2][0]);
							update_option('pnfpb_ic_fcm_new_buddypressactivities_image',$imageurl);
						}
					}						
				}
					
				$localactivitycontent = str_replace("[member name]", $sender_name, $localactivitycontent);				
				
				for ($dcount=0; $dcount<=count($deviceids_count); $dcount+=1000) {
				
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
					
						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
					}
					else 
					{
						if (get_option('pnfpb_shortcode_enable') === 'yes') {
					
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
						}
						else
						{
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' LIMIT {$dcount}, 1000" );
						}
					}
				
					$url = 'https://fcm.googleapis.com/fcm/send';

					$regid = $deviceids;
    
					$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
            
					$blog_title = get_bloginfo( 'name' );
				
					
					if (count($regid) > 0) {
    
						// prepare the message
						$message = array( 
						'title'     => $activitytitle,
						'body'      => substr(stripslashes(strip_tags(urldecode($localactivitycontent))),0,59),
						'icon'		=> $iconurl,
						'image'		=> $imageurl,
						'click_action'  => $activitylink
						);
					
						$fields = array( 
	                	'registration_ids' => $regid, 
	                	'notification' => $message,
						);					
					
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
			
						$apiresults = wp_remote_post($url, $args);
				
						$apibody = wp_remote_retrieve_body($apiresults);

						$bodyresults = json_decode($apibody,true);

						if (is_array($bodyresults)) {
							if (array_key_exists('results', $bodyresults)) {
								foreach ($bodyresults['results'] as $idx=>$result){
									if (array_key_exists('error',$result)) {
										if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
											$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
						do_action('PNFPB_connect_to_external_api_for_activity');
					}
				}
				
				$isWebView = false;				
				
			
				if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
					
					$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
					
				}
				else {
					
					$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' " );					
				}
				
				if (count($deviceids_webview_count) > 0) {
					$isWebView = true;
				}				
				
				for ($dcount=0; $dcount<=count($deviceids_webview_count); $dcount+=1000) {
					
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						
						$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
						
					}
					else {
						
						$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' LIMIT {$dcount}, 1000" );	
						
					}
					
					if ($isWebView) 
					{
						// prepare the message
						$message = array( 
						'title'     => $activitytitle,
						'body'      => substr(stripslashes(strip_tags(urldecode($localactivitycontent))),0,59),
						'icon'		=> $iconurl,
						'image'		=> $imageurl,
						);					

						$fields = array( 
	                	'registration_ids' => $deviceidswebview, 
	                	'notification' => $message,
						'data'	=> array('click_url' => $activitylink)
						);					
					
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
			
						$apiresults = wp_remote_post($url, $args);
				
						$apibody = wp_remote_retrieve_body($apiresults);

						$bodyresults = json_decode($apibody,true);

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
				    		$status = $apiresults->get_error_code(); 				// custom code for WP_ERROR
                    		$error_message = $apiresults->get_error_message();
                    		error_log('There was a '.$status.' error in push notification: '.$error_message);
                		}
						do_action('PNFPB_connect_to_external_api_for_activity_webview');
				
					}
				}
	
			}
			else 
			{
				if ($activity_content && (wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' ) || as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ))) {
					update_option('pnfpb_ic_fcm_new_buddypressactivities_content',$activity_content);
					update_option('pnfpb_ic_fcm_new_buddypressactivities_userid',$user_id);
					update_option('pnfpb_ic_fcm_new_buddypressactivities_link',bp_activity_get_permalink($activity_id));
					
					preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($activity_content), $imgresult);
				
					$imageurl = '';
				
					if (is_array($imgresult)) {
						if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
							$imageurl = str_replace('"','',$imgresult[2][0]);
							update_option('pnfpb_ic_fcm_new_buddypressactivities_image',$imageurl);
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
        	
			if ((($content && !wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' )) || ($content===null && wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' )) || ($content && (false === as_has_scheduled_action( 'PNFPB_cron_buddypressgroupactivities_hook' )))
				 || ($content===null && (as_has_scheduled_action( 'PNFPB_cron_buddypressgroupactivities_hook' )))) && ($bactivity == 1 &&  get_option('pnfpb_ic_fcm_buddypress_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false)) {
				
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
				
					//if (groups_is_user_member( bp_displayed_user_id(), $group_id )) {}
	
					$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;
				}
				
	
				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
				
				if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
					
					$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
					
				}
				else				
				{
					
					if (get_option('pnfpb_shortcode_enable') === 'yes') {
					
						$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
					
					}
					else 
					{
						$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1)  FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%'" );
					}
				}
				
				if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
					
					$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND  device_id  LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
					
				}
				else {
					
					$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND  device_id  LIKE '%!!webview%'" );					
				}
				
				if ($content) {
					$localactivitycontent = $content;
				}
				else 
				{
					$localactivitycontent = __("New contents available in ",'PNFPB_TD').get_bloginfo( 'name' );
				}
				
           
				$blog_title = get_bloginfo( 'name' );
            
				if (get_option('pnfpb_ic_fcm_group_activity_title') != false && get_option('pnfpb_ic_fcm_group_activity_title') != '') {
					$grouptitle = get_option('pnfpb_ic_fcm_group_activity_title');
				}
				else
				{
					$grouptitle = __('New group post in ','PNFPB_TD').$blog_title;
				}
					
				if (!get_option('pnfpb_ic_fcm_new_buddypressactivities_content')) {
					if ($content) {
						$localactivitycontent = $content;
					}
					else 
					{
						if (get_option('pnfpb_ic_fcm_group_activity_message') != false && get_option('pnfpb_ic_fcm_group_activity_message') != '') {
							$localactivitycontent = get_option('pnfpb_ic_fcm_group_activity_message');
						}
						else 
						{							
							$localactivitycontent = __("New contents available in ",'PNFPB_TD').get_bloginfo( 'name' );
						}
					}
					$grouplink = get_home_url();
					if (function_exists('bp_is_active')){
						$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;
					}					
				}
				else 
				{
					if ($content===null){
						$localactivitycontent = get_option('pnfpb_ic_fcm_new_buddypressactivities_content');
						$grouplink = get_option('pnfpb_ic_fcm_new_buddypressgroup_link');
						$imageurl = get_option('pnfpb_ic_fcm_new_buddypressgroup_image');
					}
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
					
					$localactivitycontent = get_option('pnfpb_ic_fcm_group_activity_message');
					
				}	
					
				$sender_name = '';	
				if ($user_id !== null) {
					$sender_name = bp_core_get_user_displayname( $user_id );
					$grouptitle = str_replace("[member name]", $sender_name, $grouptitle);
				}
				else 
				{
					if (get_option('pnfpb_ic_fcm_new_buddypressgroup_userid') != '') {
						$sender_name = bp_core_get_user_displayname( get_option('pnfpb_ic_fcm_new_buddypressgroup_userid') );
						$grouptitle = str_replace("[member name]", $sender_name, $grouptitle);
					}
					else 
					{
						$grouptitle = __("New contents available in ",PNFPB_TD).get_bloginfo( 'name' );
					}
				}
					
				if ($group_id && $activity_id && $content) {
					update_option('pnfpb_ic_fcm_new_buddypressactivities_content',$content);
					update_option('pnfpb_ic_fcm_new_buddypressactivities_link',bp_activity_get_permalink($activity_id));
					update_option('pnfpb_ic_fcm_new_buddypressgroup_link',get_home_url().'/'.buddypress()->pages->activity->slug);
					update_option('pnfpb_ic_fcm_new_buddypressgroup_id',$group_id);
					update_option('pnfpb_ic_fcm_new_buddypressgroup_userid',$user_id);
					preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($content), $imgresult);					
				}
				
				$localactivitycontent = str_replace("[member name]", $sender_name, $localactivitycontent);
				
				
				for ($dcount=0; $dcount<=count($deviceids_count); $dcount+=1000) {
				
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
					
						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
					
					}
					else				
					{
						if (get_option('pnfpb_shortcode_enable') === 'yes') {
					
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
					
						}						
						else {
							
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1)  FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' LIMIT {$dcount}, 1000" );
							
						}
					}
				

					$url = 'https://fcm.googleapis.com/fcm/send';

					$regid = $deviceids;
    
					$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
				
    
					if (count($regid) > 0) {
						// prepare the message
						$message = array( 
						'title'     => $grouptitle,
						'body'      => substr(stripslashes(strip_tags($localactivitycontent)),0,59),
						'icon'		=> $iconurl,
						'image'		=> $imageurl,
						'click_action' => $grouplink

						);
    

						$fields = array( 
						'registration_ids' => $regid, 
						'notification' => $message
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
				
						$apibody = wp_remote_retrieve_body($apiresults);

						$bodyresults = json_decode($apibody,true);
						if (is_array($bodyresults)) {
							if (array_key_exists('results', $bodyresults)) {
								foreach ($bodyresults['results'] as $idx=>$result){
									if (array_key_exists('error',$result)) {
										if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
											$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
						do_action('PNFPB_connect_to_external_api_for_group');
					}
				}
				
				$webview = false;
				
				if (count($deviceids_webview_count) > 0) {
						$webview = true;
				}
				
				for ($dcount=0; $dcount<=count($deviceids_webview_count); $dcount+=1000) {
					
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						
						$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND  device_id  LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
						
					}
					else {
						
						$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND  device_id  LIKE '%!!webview%'  LIMIT {$dcount}, 1000" );						
					}
				
					if (count($deviceidswebview) > 0) {
						// prepare the message
						$message = array( 
							'title'     => $grouptitle,
							'body'      => substr(stripslashes(strip_tags($localactivitycontent)),0,59),
							'icon'		=> $iconurl,
							'image'		=> $imageurl

						);
    

						$fields = array( 
							'registration_ids' => $deviceidswebview, 
							'notification' => $message,
							'data'	=> array('click_url' => $grouplink)
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
				
						$apibody = wp_remote_retrieve_body($apiresults);

						$bodyresults = json_decode($apibody,true);
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
				    		$status = $apiresults->get_error_code(); 				// custom code for WP_ERROR
                    		$error_message = $apiresults->get_error_message();
                    		error_log('There was a '.$status.' error in push notification: '.$error_message);
                		}
						do_action('PNFPB_connect_to_external_api_for_group_webview');
					
					}
				}
			}
			else
			{
				
				if ((($content && !wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' )) || ($content===null && wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' ) && get_option('pnfpb_ic_fcm_new_buddypressgroup_id')) || ($content && (false === as_has_scheduled_action( 'PNFPB_cron_buddypressgroupactivities_hook' ))) || ($content===null && (as_has_scheduled_action( 'PNFPB_cron_buddypressgroupactivities_hook' )) && get_option('pnfpb_ic_fcm_new_buddypressgroup_id'))) && ($bactivity == 1 && get_option('pnfpb_ic_fcm_buddypress_enable') == 2 && $apiaccesskey != '' && $apiaccesskey != false)) {
					
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
						
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
						
					}
					else				
					{

						if (get_option('pnfpb_shortcode_enable') === 'yes') {
						
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
						
						}
						else 
						{

							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%'" );
							
						}
					}
					
					$webview = false;
					
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
					
						$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1 OR subscription_option = '' OR subscription_option IS NULL) = '1')" );	
						
					}
					else {
						
						$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%'" );							
					}
					
					$blog_title = get_bloginfo( 'name' );
            
					if (get_option('pnfpb_ic_fcm_group_activity_title') != false && get_option('pnfpb_ic_fcm_group_activity_title') != '') {
						$grouptitle = get_option('pnfpb_ic_fcm_group_activity_title');
					}
					else
					{
						$grouptitle = __('New group post in ',PNFPB_TD).$blog_title;
					}
						

					
					if ($content) {
						$localactivitycontent = $content;
					}
					else 
					{
						if (get_option('pnfpb_ic_fcm_group_activity_content') != false && get_option('pnfpb_ic_fcm_group_activity_content') != '') {
							$localactivitycontent = get_option('pnfpb_ic_fcm_group_activity_content');
						}	
						else 
						{						
							$localactivitycontent = __("New contents available in ",PNFPB_TD).get_bloginfo( 'name' );
						}
					}
					
					if (!get_option('pnfpb_ic_fcm_new_buddypressactivities_content') && wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' ))
					{
						if ($content) {
							$localactivitycontent = $content;
						}
						else 
						{
							if (get_option('pnfpb_ic_fcm_group_activity_content') != false && get_option('pnfpb_ic_fcm_group_activity_content') != '') {
								$localactivitycontent = get_option('pnfpb_ic_fcm_group_activity_content');
							}
							else 
							{							
								$localactivitycontent = __("New contents available in ",PNFPB_TD).get_bloginfo( 'name' );
							}
						}
						
						$grouplink = get_home_url();
						if (function_exists('bp_is_active')){
							$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;
						}						
					}
					else 
					{
						if ($content===null){
							$localactivitycontent = get_option('pnfpb_ic_fcm_new_buddypressactivities_content');
							$grouplink = get_option('pnfpb_ic_fcm_new_buddypressgroup_link');
						}
					}

					if (strpos($content, "[bpfb_images]") !== false) {
    
						$bpfbimagesstart = strpos($localactivitycontent, "[bpfb_images]");
    
						$bpfbimagesend = strrpos($localactivitycontent, "[/bpfb_images]");
    
						$bpfbimagestaglength = ($bpfbimagesend+17) - $bpfbimagesstart;
    
						$activity_content_push = strip_tags(urldecode(substr_replace($content,"",$bpfbimagesstart,$bpfbimagestaglength)));
					
						$localactivitycontent = $activity_content_push;
					}
					
					preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($localactivitycontent), $imgresult);
					$imageurl = '';
				
					if (is_array($imgresult)) {
						if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
							$imageurl = str_replace('"','',$imgresult[2][0]);
						}
					}
					
					$sender_name = '';
					if (get_option('pnfpb_ic_fcm_group_activity_message') != false && get_option('pnfpb_ic_fcm_group_activity_message') != '') {
					
						$localactivitycontent = get_option('pnfpb_ic_fcm_group_activity_message');
					
					}
						
					if ($user_id !== null) {
						$sender_name = bp_core_get_user_displayname( $user_id );
						$grouptitle = str_replace("[member name]", $sender_name, $grouptitle);
					}
					else 
					{
						if (get_option('pnfpb_ic_fcm_new_buddypressgroup_userid') != '') {
							$sender_name = bp_core_get_user_displayname( get_option('pnfpb_ic_fcm_new_buddypressgroup_userid') );
							$grouptitle = str_replace("[member name]", $sender_name, $grouptitle);
						}
						else 
						{
							$grouptitle = __("New contents available in ",PNFPB_TD).get_bloginfo( 'name' );
						}
					}
						
					if ($group_id) {
						update_option('pnfpb_ic_fcm_new_buddypressactivities_content',$content);
						update_option('pnfpb_ic_fcm_new_buddypressactivities_link',bp_activity_get_permalink($activity_id));
						update_option('pnfpb_ic_fcm_new_buddypressgroup_link',get_home_url().'/'.buddypress()->pages->activity->slug);
						update_option('pnfpb_ic_fcm_new_buddypressgroup_id',$group_id);
						update_option('pnfpb_ic_fcm_new_buddypressgroup_userid',$user_id);
						preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($content), $imgresult);								
					}						
					
					$localactivitycontent = str_replace("[member name]", $sender_name, $localactivitycontent);
					
					for ($dcount=0; $dcount<=count($deviceids_count); $dcount+=1000) {					
					
						if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
						
						}
						else				
						{

							if (get_option('pnfpb_shortcode_enable') === 'yes') {
						
								$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
						
							}							
							else 
							{
								
								$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' LIMIT {$dcount}, 100" );
								
							}
						}
					

						$url = 'https://fcm.googleapis.com/fcm/send';

						$regid = $deviceids;
    
						$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
					
						if (count($regid) > 0) {
							// prepare the message
							$message = array( 
							'title'     => $grouptitle,
							'body'      => substr(stripslashes(strip_tags($localactivitycontent)),0,59),
							'icon'		=> $iconurl,
							'image'		=> $imageurl,
							'click_action' => $grouplink

							);
    

							$fields = array( 
							'registration_ids' => $regid, 
							'notification' => $message
							);
    
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
			
							$apiresults = wp_remote_post($url, $args);
				
							$apibody = wp_remote_retrieve_body($apiresults);

							$bodyresults = json_decode($apibody,true);
							if (is_array($bodyresults)) {
								if (array_key_exists('results', $bodyresults)) {
									foreach ($bodyresults['results'] as $idx=>$result){
										if (array_key_exists('error',$result)) {
											if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
												$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
							do_action('PNFPB_connect_to_external_api_for_group');
						}
					}
					
					for ($dcount=0; $dcount<=count($deviceids_webview_count); $dcount+=1000) {	
					
						$webview = false;
						
						if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
							
							$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
						}
						else 
						{
							
							$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' LIMIT {$dcount}, 1000" );							
						}
				
						if (count($deviceidswebview) > 0) {
						// prepare the message
						$message = array( 
							'title'     => $grouptitle,
							'body'      => substr(stripslashes(strip_tags($localactivitycontent)),0,59),
							'icon'		=> $iconurl,
							'image'		=> $imageurl

						);
    

						$fields = array( 
							'registration_ids' => $deviceidswebview, 
							'notification' => $message,
							'data'	=> array('click_url' => $grouplink)
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
				
						$apibody = wp_remote_retrieve_body($apiresults);

						$bodyresults = json_decode($apibody,true);
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
				    		$status = $apiresults->get_error_code(); 				// custom code for WP_ERROR
                    		$error_message = $apiresults->get_error_message();
                    		error_log('There was a '.$status.' error in push notification: '.$error_message);
                		}
						do_action('PNFPB_connect_to_external_api_for_group_webview');
					}
				}
					
					
				}
				else 
				{
					if ($content && (wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook') || as_has_scheduled_action( 'PNFPB_cron_buddypressgroupactivities_hook' )) ) {
						update_option('pnfpb_ic_fcm_new_buddypressactivities_content',$content);
						update_option('pnfpb_ic_fcm_new_buddypressactivities_link',bp_activity_get_permalink($activity_id));
						update_option('pnfpb_ic_fcm_new_buddypressgroup_link',get_home_url().'/'.buddypress()->pages->activity->slug);
						update_option('pnfpb_ic_fcm_new_buddypressgroup_id',$group_id);
						update_option('pnfpb_ic_fcm_new_buddypressgroup_userid',$user_id);
						preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($content), $imgresult);
				
						$imageurl = '';
				
						if (is_array($imgresult)) {
							if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
								$imageurl = str_replace('"','',$imgresult[2][0]);
								update_option('pnfpb_ic_fcm_new_buddypressactivities_image',$imageurl);
							}
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
		* @since 1.13
		*/
		public function PNFPB_icforum_push_notifications_private_messages($raw_args = array()) {
			
            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');		    
        
			if (get_option('pnfpb_ic_fcm_bprivatemessage_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false) {
				
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
	
				// Send an email to each recipient.
				foreach ( $recipients as $recipient ) {

					$messageurl = esc_url( bp_core_get_user_domain( $recipient->user_id ).bp_get_messages_slug().'/view/'.$thread_id.'/');
					
					if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = '{$recipient->user_id}' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
					} else {
						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = '{$recipient->user_id}' LIMIT 1000"  );
					}
					
					
					$webview = false;
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND userid = '{$recipient->user_id}' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
					} else {
						$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND userid = '{$recipient->user_id}' LIMIT 1000"  );						
					}
					

					
					$imageurl = '';
					
					$iconurl =	bp_core_fetch_avatar ( 
    							array(  'item_id'   => $sender_id,       // output user id of post author
            							'type'      => 'full',
            							'html'      => FALSE    // FALSE = return url, TRUE (default) = return url wrapped with html
   									 ) 
								);
				

					if (count($deviceids) > 0) {

						$regid = $deviceids;
						
						
						if (get_option('pnfpb_ic_fcm_bprivatemessage_content') != false && get_option('pnfpb_ic_fcm_bprivatemessage_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_bprivatemessage_content');
						}


						$message = array( 
						'title'     => $notificationtitle,
						'body'      => substr(stripslashes(strip_tags($activity_content_push)),0,59),
						'icon'		=> $iconurl,
						'image'		=> $imageurl,
						'click_action' => $messageurl
						);


						$fields = array( 
						'registration_ids' => $regid, 
						'notification' => $message,
						'data'	=> array('thread_id' => $thread_id)
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
						$apibody = wp_remote_retrieve_body($apiresults);
						
						$bodyresults = json_decode($apibody,true);
						
						if (is_array($bodyresults)) {
							if (array_key_exists('results', $bodyresults)) {
								foreach ($bodyresults['results'] as $idx=>$result){
									if (array_key_exists('error',$result)) {
										if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
											$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
						do_action('PNFPB_connect_to_external_api_for_private_messages');
					}

					if (count($deviceidswebview) > 0) {

						$regid = $deviceidswebview;
						
						
						if (get_option('pnfpb_ic_fcm_bprivatemessage_content') != false && get_option('pnfpb_ic_fcm_bprivatemessage_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_bprivatemessage_content');
						}


						$message = array( 
						'title'     => $notificationtitle,
						'body'      => substr(stripslashes(strip_tags($activity_content_push)),0,59),
						'icon'		=> $iconurl,
						'image'		=> $imageurl
						);


						$fields = array( 
						'registration_ids' => $regid, 
						'notification' => $message,
						'data'	=> array('thread_id' => $thread_id,'click_url' => $messageurl)
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
						$apibody = wp_remote_retrieve_body($apiresults);
						
						$bodyresults = json_decode($apibody,true);
						
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
						do_action('PNFPB_connect_to_external_api_for_private_messages_webview');
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
        
			if (get_option('pnfpb_ic_fcm_new_member_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false) {
				
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
				

					$messageurl = esc_url( bp_core_get_user_domain( $user_id ).bp_get_messages_slug().'/view/'.$thread_id.'/');
				
					if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,6,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
					} else {
						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );
					}
					
					$webview = false;
					if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,6,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
					} else {
						$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );						
					}
					
					
					
					$imageurl = '';
				
					$iconurl =	bp_core_fetch_avatar ( 
    							array(  'item_id'   => $user_id,       // output user id of post author
            							'type'      => 'full',
            							'html'      => FALSE       // FALSE = return url, TRUE (default) = return url wrapped with html
   									 ) 
								);
				
					
					$activity_content_push = str_replace("[member name]", $member_name, $activity_content_push);
				
					if (count($deviceids) > 0) {

						$regid = $deviceids;
						
						
						if (get_option('pnfpb_ic_fcm_new_member_content') != false && get_option('pnfpb_ic_fcm_new_member_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_new_member_content');
						}


						$message = array( 
							'title'     => $notificationtitle,
							'body'      => substr(stripslashes(strip_tags($activity_content_push)),0,59),
							'icon'		=> $iconurl,
							'image'		=> $imageurl,
							'click_action' => $messageurl
						);


						$fields = array( 
							'registration_ids' => $regid, 
							'notification' => $message
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
						$apibody = wp_remote_retrieve_body($apiresults);
						
						$bodyresults = json_decode($apibody,true);
						
						if (is_array($bodyresults)) {
							if (array_key_exists('results', $bodyresults)) {
								foreach ($bodyresults['results'] as $idx=>$result){
									if (array_key_exists('error',$result)) {
										if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
											$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
						do_action('PNFPB_connect_to_external_api_for_new_member');
					}

					if (count($deviceidswebview) > 0) {

						$regid = $deviceidswebview;
						
						
						if (get_option('pnfpb_ic_fcm_new_member_content') != false && get_option('pnfpb_ic_fcm_new_member_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_new_member_content');
						}


						$message = array( 
						'title'     => $notificationtitle,
						'body'      => substr(stripslashes(strip_tags($activity_content_push)),0,59),
						'icon'		=> $iconurl,
						'image'		=> $imageurl
						);


						$fields = array( 
						'registration_ids' => $regid, 
						'notification' => $message,
						'data'	=> array('click_url' => $messageurl)
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
						$apibody = wp_remote_retrieve_body($apiresults);
						
						$bodyresults = json_decode($apibody,true);
						
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
						do_action('PNFPB_connect_to_external_api_for_new_member_webview');
					}
				
				//}
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
        
			if (get_option('pnfpb_ic_fcm_friendship_request_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false) {
				
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
				
					if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {

					$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = '{$friend_id}' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,7,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
						
					} else {
						
						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = '{$friend_id}' LIMIT 1000"  );
						
					}
					
					$webview = false;
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND userid = '{$friend_id}' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,7,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
					}
					else {
						$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND userid = '{$friend_id}' LIMIT 1000"  );						
					}
				
					$imageurl = '';
					
					$iconurl =	bp_core_fetch_avatar ( 
    							array(  'item_id'   => $initiator_id,       // output user id of post author
            							'type'      => 'full',
            							'html'      => FALSE       // FALSE = return url, TRUE (default) = return url wrapped with html
								  
   									 ) 
								);					

					if (count($deviceids) > 0) {

						$regid = $deviceids;
						
						
						if (get_option('pnfpb_ic_fcm_friendship_request_content') != false && get_option('pnfpb_ic_fcm_friendship_request_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_friendship_request_content');
						}


						$message = array( 
						'title'     => $notificationtitle,
						'body'      => substr(stripslashes(strip_tags($activity_content_push)),0,59),
						'icon'		=> $iconurl,
						'image'		=> $imageurl,
						'click_action' => $messageurl
						);


						$fields = array( 
						'registration_ids' => $regid, 
						'notification' => $message
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
						$apibody = wp_remote_retrieve_body($apiresults);
						
						$bodyresults = json_decode($apibody,true);
						
						if (is_array($bodyresults)) {
							if (array_key_exists('results', $bodyresults)) {
								foreach ($bodyresults['results'] as $idx=>$result) {
									if (array_key_exists('error',$result)) {
										if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
											$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
						do_action('PNFPB_connect_to_external_api_for_friend_request');
					}

					if (count($deviceidswebview) > 0) {

						$regid = $deviceidswebview;
						
						
						if (get_option('pnfpb_ic_fcm_friendship_request_content') != false && get_option('pnfpb_ic_fcm_friendship_request_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_friendship_request_content');
						}


						$message = array( 
						'title'     => $notificationtitle,
						'body'      => substr(stripslashes(strip_tags($activity_content_push)),0,59),
						'icon'		=> $iconurl,
						'image'		=> $imageurl
						);


						$fields = array( 
						'registration_ids' => $regid, 
						'notification' => $message,
						'data'	=> array('click_url' => $messageurl)
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
						$apibody = wp_remote_retrieve_body($apiresults);
						
						$bodyresults = json_decode($apibody,true);
						
						if (is_array($bodyresults)) {
							if (array_key_exists('results', $bodyresults)) {
								foreach ($bodyresults['results'] as $idx=>$result){
									if (array_key_exists('error',$result)) {
										if ($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') {
											$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id LIKE  '%{$deviceidswebview[$idx]}%'") ;
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
						do_action('PNFPB_connect_to_external_api_for_friend_request_webview');
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
        
			if (get_option('pnfpb_ic_fcm_friendship_accept_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false) {
				
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
				
					if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						
					$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = '{$initiator_id}' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,8,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
						
					} else  {

						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = '{$initiator_id}' LIMIT 1000"  );
						
					}
					
					$webview = false;
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND userid = '{$initiator_id}' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,8,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
					} else {
						$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND userid = '{$initiator_id}'  LIMIT 1000"  );						
					}
				
					$imageurl = '';
					
					$iconurl =	bp_core_fetch_avatar ( 
    							array(  'item_id'   => $friend_id,       // output user id of post author
            							'type'      => 'full',
            							'html'      => FALSE       // FALSE = return url, TRUE (default) = return url wrapped with html
								  
   									 ) 
								);
				
					

					if (count($deviceids) > 0) {

						$regid = $deviceids;
						
						if (get_option('pnfpb_ic_fcm_friendship_accept_content') != false && get_option('pnfpb_ic_fcm_friendship_accept_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_friendship_accept_content');
						}

						$message = array( 
						'title'     => $notificationtitle,
						'body'      => substr(stripslashes(strip_tags($activity_content_push)),0,59),
						'icon'		=> $iconurl,
						'image'		=> $imageurl,
						'click_action' => $messageurl
						);


						$fields = array( 
						'registration_ids' => $regid, 
						'notification' => $message
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
						$apibody = wp_remote_retrieve_body($apiresults);
						
						$bodyresults = json_decode($apibody,true);
						
						if (is_array($bodyresults)) {
							if (array_key_exists('results', $bodyresults)) {
								foreach ($bodyresults['results'] as $idx=>$result){
									if (array_key_exists('error',$result)) {
										if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
											$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
						do_action('PNFPB_connect_to_external_api_for_friend_request_accepted');
					}

					if (count($deviceidswebview) > 0) {

						$regid = $deviceidswebview;
						
						
						if (get_option('pnfpb_ic_fcm_friendship_accept_content') != false && get_option('pnfpb_ic_fcm_friendship_accept_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_friendship_accept_content');
						}


						$message = array( 
						'title'     => $notificationtitle,
						'body'      => substr(stripslashes(strip_tags($activity_content_push)),0,59),
						'icon'		=> $iconurl,
						'image'		=> $imageurl
						);


						$fields = array( 
						'registration_ids' => $regid, 
						'notification' => $message,
						'data'	=> array('click_url' => $messageurl)
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
						$apibody = wp_remote_retrieve_body($apiresults);
						
						$bodyresults = json_decode($apibody,true);
						
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
						do_action('PNFPB_connect_to_external_api_for_friend_request_accepted_webview');
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
        
			if (get_option('pnfpb_ic_fcm_avatar_change_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false) {
				
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
				
					if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {

						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,9,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
						
					} else  {
						
						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );						
						
					}
					
					$webview = false;
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,9,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
					} else {
						$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );						
					}
				
					$imageurl = '';
					
					$iconurl =	bp_core_fetch_avatar ( 
    							array(  'item_id'   => $user_id,       // output user id of post author
            							'type'      => 'full',
            							'html'      => FALSE        // FALSE = return url, TRUE (default) = return url wrapped with html
							  
   									 ) 
								);
					

					if (count($deviceids) > 0) {

						$regid = $deviceids;
						
						
						if (get_option('pnfpb_ic_fcm_avatar_change_content') != false && get_option('pnfpb_ic_fcm_avatar_change_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_avatar_change_content');
						}


						$message = array( 
						'title'     => $notificationtitle,
						'body'      => substr(stripslashes(strip_tags($activity_content_push)),0,59),
						'icon'		=> $iconurl,
						'image'		=> $imageurl,
						'click_action' => $messageurl
						);


						$fields = array( 
						'registration_ids' => $regid, 
						'notification' => $message,
						'data'	=> array('click_url' => $messageurl)
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
						$apibody = wp_remote_retrieve_body($apiresults);
						
						$bodyresults = json_decode($apibody,true);
						
						if (is_array($bodyresults)) {
							if (array_key_exists('results', $bodyresults)) {
								foreach ($bodyresults['results'] as $idx=>$result){
									if (array_key_exists('error',$result)) {
										if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
											$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
						do_action('PNFPB_connect_to_external_api_for_avatar_change');
					}

					if (count($deviceidswebview) > 0) {

						$regid = $deviceidswebview;
						
						
						if (get_option('pnfpb_ic_fcm_avatar_change_content') != false && get_option('pnfpb_ic_fcm_avatar_change_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_avatar_change_content');
						}


						$message = array( 
						'title'     => $notificationtitle,
						'body'      => substr(stripslashes(strip_tags($activity_content_push)),0,59),
						'icon'		=> $iconurl,
						'image'		=> $imageurl
						);


						$fields = array( 
						'registration_ids' => $regid, 
						'notification' => $message,
						'data'	=> array('click_url' => $messageurl)
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
						$apibody = wp_remote_retrieve_body($apiresults);
						
						$bodyresults = json_decode($apibody,true);
						
						if (is_array($bodyresults)) {
							if (array_key_exists('results', $bodyresults)) {
								foreach ($bodyresults['results'] as $idx=>$result){
									if (array_key_exists('error',$result)) {
										if ($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') {
											$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id LIKE  '%{$deviceidswebview[$idx]}%'") ;
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
						do_action('PNFPB_connect_to_external_api_for_avatar_change_webview');
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
        
			if (get_option('pnfpb_ic_fcm_cover_image_change_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false) {
				
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
				
					if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {

						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,10,1) = '1') LIMIT 1000"  );
						
					} else  {
						
						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );
						
					}
					
					$webview = false;
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,10,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
					} else  {
						$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );						
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


						$message = array( 
						'title'     => $notificationtitle,
						'body'      => substr(stripslashes(strip_tags($activity_content_push)),0,59),
						'icon'		=> $iconurl,
						'image'		=> $imageurl,
						'click_action' => $messageurl
						);


						$fields = array( 
						'registration_ids' => $regid, 
						'notification' => $message
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
						$apibody = wp_remote_retrieve_body($apiresults);
						
						$bodyresults = json_decode($apibody,true);
						
						if (is_array($bodyresults)) {
							if (array_key_exists('results', $bodyresults)) {
								foreach ($bodyresults['results'] as $idx=>$result){
									if (array_key_exists('error',$result)) {
										if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
											$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
						do_action('PNFPB_connect_to_external_api_for_cover_image_change');
					}

					if (count($deviceidswebview) > 0) {

						$regid = $deviceidswebview;
						
						
						if (get_option('pnfpb_ic_fcm_cover_image_change_content') != false && get_option('pnfpb_ic_fcm_cover_image_change_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_cover_image_change_content');
						}


						$message = array( 
						'title'     => $notificationtitle,
						'body'      => substr(stripslashes(strip_tags($activity_content_push)),0,59),
						'icon'		=> $iconurl,
						'image'		=> $imageurl
						);


						$fields = array( 
						'registration_ids' => $regid, 
						'notification' => $message,
						'data'	=> array('click_url' => $messageurl)
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
						$apibody = wp_remote_retrieve_body($apiresults);
						
						$bodyresults = json_decode($apibody,true);
						
						if (is_array($bodyresults)) {
							if (array_key_exists('results', $bodyresults)) {
								foreach ($bodyresults['results'] as $idx=>$result){
									if (array_key_exists('error',$result)) {
										if ($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') {
											$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id LIKE  '%{$deviceidswebview[$idx]}%'") ;
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
						do_action('PNFPB_connect_to_external_api_for_cover_image_change_webview');
					}
				
				//}
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
				
            
			if ((($comment_ID && (!wp_next_scheduled( 'PNFPB_cron_comments_post_hook') || (false === as_has_scheduled_action( 'PNFPB_cron_comments_post_hook' )))) || ($comment_ID === null && (wp_next_scheduled( 'PNFPB_cron_comments_post_hook' )) || (as_has_scheduled_action( 'PNFPB_cron_comments_post_hook' )))) && get_option('pnfpb_ic_fcm_bcomment_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false) {
				
				
				if ($comment_ID === null ) {
				
					$comment_ID = get_option('pnfpb_ic_fcm_new_comment_id');
				
					$comment_approved = get_option('pnfpb_ic_fcm_new_comment_approved');
				}
				
		
				if( 1 === $comment_approved ) {
			
					$commentData = get_comment($comment_ID);
					
					$postData = get_post($commentData->comment_post_ID);
					
					$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
				
					if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1')  {
	
						$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
					
					}
					else				
					{
						
						$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%'" );
					}
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1')  {
						$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
					} else  {
						$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%'" );						
					}
				
					/* Logic to get subscribers who subscribed only comments made on my posts */
				
					$deviceidsmypost = [];
				
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
				
    
					$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
            
					$blog_title = get_bloginfo( 'name' );
            
					$commenttitle = __('New comment for post - ',PNFPB_TD).$postData->post_title;
				
					$localpostcontent = $commentData->comment_content;
					
					$postcommentlink = get_permalink($postData->ID);
					
					
						
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
					
					if (count($regid) > 0) {
						// prepare the message
						$message = array( 
							'title'     => $commenttitle,
							'body'      => substr(stripslashes(strip_tags($localpostcontent)),0,59),
							'icon'		=> $iconurl,
							'image'		=> $imageurl,
							'click_action' => $postcommentlink
						);
	
						$fields = array( 
							'registration_ids' => $regid, 
							'notification' => $message
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
				
						$apibody = wp_remote_retrieve_body($apiresults);

						$bodyresults = json_decode($apibody,true);
						if (is_array($bodyresults)) {
							if (array_key_exists('results', $bodyresults)) {
								foreach ($bodyresults['results'] as $idx=>$result){
									if (array_key_exists('error',$result)) {
										if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
											$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
					
					if (count($mergeddeviceidswebview) > 0) {
					
						// prepare the message
						$message = array( 
							'title'     => $commenttitle,
							'body'      => substr(stripslashes(strip_tags($localpostcontent)),0,59),
							'icon'		=> $iconurl,
							'image'		=> $imageurl
						);

						$fields = array( 
							'registration_ids' => $mergeddeviceidswebview, 
							'notification' => $message,
							'data'	=> array('click_url' => $postcommentlink)
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
				
						$apibody = wp_remote_retrieve_body($apiresults);

						$bodyresults = json_decode($apibody,true);
						if (is_array($bodyresults)) {
							if (array_key_exists('results', $bodyresults)) {
								foreach ($bodyresults['results'] as $idx=>$result){
									if (array_key_exists('error',$result)) {
										if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($deviceidswebview[$idx], '!!') === false) {
											$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$deviceidswebview[$idx]}'") ;
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
            
			if ((($comment_id && (!wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook') || (false === as_has_scheduled_action( 'PNFPB_cron_buddypresscomments_hook' )))) || ($comment_id === null && (wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' )) || (as_has_scheduled_action( 'PNFPB_cron_buddypresscomments_hook' )))) && get_option('pnfpb_ic_fcm_bcomment_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false) {

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
	

				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
				
				if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
	
					$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
					
				}
				else				
				{
					$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%'" );
				}
				
				if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
				
					$deviceidswebview = $wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
				} else  {
					$deviceidswebview = $wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%webview%'" );					
				}
				
				/* Logic to get subscribers who subscribed only comments made on my activities */
				
				$deviceidsmyactivities = [];
				
				$activityuserid = 0;
				
				$authoractivityuserid = 0;
				
				if ($user_id) {
					
					$activityuserid = $user_id;
					
					if ($activity && $activity !== null) {
						
						$authoractivityuserid = $activity->user_id;
					}
					
				}
				else 
				{
					if ( get_option('pnfpb_ic_fcm_new_buddypresscomments_activityuserid' )) {
						
						$activityuserid = get_option('pnfpb_ic_fcm_new_buddypresscomments_activityuserid' );
						$authoractivityuserid = get_option('pnfpb_ic_fcm_new_buddypresscomments_authoractivityuserid' );
					}					
				}
				
				
				if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
	
					$deviceidsmyactivities=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid = {$authoractivityuserid} AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,4,1) = '1')" );
					
					$deviceidsmyactivitieswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid = {$authoractivityuserid} AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,4,1) = '1' )" );					
					
				}
				
				
				$mergeddeviceids = array_merge($deviceids,$deviceidsmyactivities);
				
				$mergeddeviceidswebview = array_merge($deviceidswebview,$deviceidsmyactivitieswebview);
	
				$url = 'https://fcm.googleapis.com/fcm/send';

				$regid = $mergeddeviceids;
				

    
				if (strpos($activity_content_push, "[bpfb_images]") !== false) {
    
					$bpfbimagesstart = strpos($activity_content_push, "[bpfb_images]");
    
					$bpfbimagesend = strrpos($activity_content_push, "[/bpfb_images]");
    
					$bpfbimagestaglength = ($bpfbimagesend+17) - $bpfbimagesstart;
    
					$activity_content_push = strip_tags(urldecode(substr_replace($content,"",$bpfbimagesstart,$bpfbimagestaglength)));
				}

				
    
				$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
            
				$blog_title = get_bloginfo( 'name' );
            
				
				$localactivitycontent = $activity_content_push;
				
				if ($comment_id ) {
					
					$activity_content_push = __("New contents available in ",PNFPB_TD).get_bloginfo( 'name' );
				
					$activitylink = get_home_url();
					
					if (function_exists('bp_is_active')){
						
						$activitylink = get_home_url().'/'.buddypress()->pages->activity->slug;
					}					
				
					if ($params) {
						
						extract( $params, EXTR_SKIP );
	
						$activity_content_push = strip_tags(urldecode($content));
	
						$activitylink = bp_activity_get_permalink( $activity_id );
						
						$activitylink = $activitylink.'#acomment-'.$comment_id;
					}
					
					$activityuserid = 0;
					
					$authoractivityuserid = 0;
				
					if ($user_id) {
						$activityuserid = $user_id;
						if ($activity && $activity !== null) {
							$authoractivityuserid = $activity->user_id;
						}						
					}
					
					update_option('pnfpb_ic_fcm_new_buddypresscomments_content',$activity_content_push);
					update_option('pnfpb_ic_fcm_new_buddypresscomments_link',$activitylink);
					update_option('pnfpb_ic_fcm_new_buddypresscomments_authoractivityuserid', $authoractivityuserid);
					update_option('pnfpb_ic_fcm_new_buddypresscomments_activityuserid',$activityuserid);
				}
				
				$sender_name = '';
				
				if (get_option('pnfpb_ic_fcm_comment_activity_title') != false && get_option('pnfpb_ic_fcm_comment_activity_title') != '') {
					
					$commenttitle = get_option('pnfpb_ic_fcm_comment_activity_title');
					
					if ($activityuserid != '' || $activityuserid !== null) {
						
						$sender_name = bp_core_get_user_displayname( $activityuserid );
						
						$commenttitle = str_replace("[member name]", $sender_name, $commenttitle);
						
					}
					else 
					{
						$commenttitle = __('New comment for activity in ',PNFPB_TD).$blog_title;
					}
				}
				else
				{
					$commenttitle = __('New comment for activity in ',PNFPB_TD).$blog_title;
				}
				
				if ($comment_id===null && get_option('pnfpb_ic_fcm_new_buddypresscomments_content')){
					
					$localactivitycontent = get_option('pnfpb_ic_fcm_new_buddypresscomments_content');
					
					$activitylink = get_option('pnfpb_ic_fcm_new_buddypresscomments_link');
				}
				
				if (get_option('pnfpb_ic_fcm_comment_activity_message') != false && get_option('pnfpb_ic_fcm_comment_activity_message') != '') {
					
					$localactivitycontent = get_option('pnfpb_ic_fcm_comment_activity_message');
					
				}				
				
				preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($localactivitycontent), $imgresult);
				
				$imageurl = '';
				
				if (is_array($imgresult)) {
					if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
						$imageurl = str_replace('"','',$imgresult[2][0]);
					}
				}				
				
				$localactivitycontent = str_replace("[member name]", $sender_name, $localactivitycontent);
				
				if (count($regid) > 0) {
					// prepare the message
					$message = array( 
						'title'     => $commenttitle,
						'body'      => substr(stripslashes(strip_tags($localactivitycontent)),0,59),
						'icon'		=> $iconurl,
						'image'		=> $imageurl,
						'click_action' => $activitylink
					);
    

					$fields = array( 
						'registration_ids' => $regid, 
						'notification' => $message
					);
    
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
			
					$apiresults = wp_remote_post($url, $args);
				
					$apibody = wp_remote_retrieve_body($apiresults);

					$bodyresults = json_decode($apibody,true);
					if (is_array($bodyresults)) {
						if (array_key_exists('results', $bodyresults)) {
							foreach ($bodyresults['results'] as $idx=>$result){
								if (array_key_exists('error',$result)) {
									if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
										$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
				
				if (count($mergeddeviceidswebview) > 0) {
					// prepare the message
					$message = array( 
						'title'     => $commenttitle,
						'body'      => substr(stripslashes(strip_tags($localactivitycontent)),0,59),
						'icon'		=> $iconurl,
						'image'		=> $imageurl
					);
    

					$fields = array( 
						'registration_ids' => $mergeddeviceidswebview, 
						'notification' => $message,
						'data'	=> array('click_url' => $activitylink)
					);
    
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
			
					$apiresults = wp_remote_post($url, $args);
				
					$apibody = wp_remote_retrieve_body($apiresults);

					$bodyresults = json_decode($apibody,true);
					if (is_array($bodyresults)) {
						if (array_key_exists('results', $bodyresults)) {
							foreach ($bodyresults['results'] as $idx=>$result){
								if (array_key_exists('error',$result)) {
									if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($deviceidswebview[$idx], '!!') === false) {
										$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$deviceidswebview[$idx]}'") ;
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
			else 
			{
				if ($comment_id && (wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' )
								   || as_has_scheduled_action( 'PNFPB_cron_buddypresscomments_hook' ))) {
					
					$activity_content_push = __("New contents available in ",PNFPB_TD).get_bloginfo( 'name' );
					
					$commentData = get_comment($comment_ID);
					
					$postData = get_post($commentData->comment_post_ID);

					$postuserid = $postData->post_author;
					
					$authoractivityuserid = 0;

					if ($activity && $activity !== null) {
						
						$authoractivityuserid = $activity->user_id;
						
					}						
				
					$activitylink = get_home_url();
					if (function_exists('bp_is_active')){
						$activitylink = get_home_url().'/'.buddypress()->pages->activity->slug;
					}					
				
					if ($params) {
						extract( $params, EXTR_SKIP );
	
						$activity_content_push = strip_tags(urldecode($content));
	
						$activitylink = bp_activity_get_permalink( $activity_id );
					}
					
					$activityuserid = 0;
				
					if ($user_id) {
						$activityuserid = $user_id;
					}
					
					update_option('pnfpb_ic_fcm_new_buddypresscomments_content',$activity_content_push);
					update_option('pnfpb_ic_fcm_new_buddypresscomments_link',$activitylink);
					update_option('pnfpb_ic_fcm_new_buddypresscomments_postuserid',$postuserid);
					update_option('pnfpb_ic_fcm_new_buddypresscomments_activityuserid',$activityuserid);
					update_option('pnfpb_ic_fcm_new_buddypresscomments_authoractivityuserid',$authoractivityuserid);
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

							if (get_option('pnfpb_ic_fcm_contact_form7_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false) {
				
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
					
									if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = {$adminuser->ID} AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1') LIMIT 1000"  );
									} else {
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = {$adminuser->ID} LIMIT 1000"  );
									}
					
									update_user_meta(1,'super_admins_contactform722', $deviceids);
									$webview = false;
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND userid = {$adminuser->ID} LIMIT 1000"  );
					

					
									$imageurl = '';
					
									$iconurl =	bp_core_fetch_avatar ( 
    											array(  'item_id'   => $adminuser->ID,       // output user id of post author
            											'type'      => 'full',
            											'html'      => FALSE    // FALSE = return url, TRUE (default) = return url wrapped with html
   									 				) 
												);
				

									if (count($deviceids) > 0) {

										$regid = $deviceids;
						
						
										if (get_option('pnfpb_ic_fcm_buddypress_contact_form7_content_enable') != false && get_option('pnfpb_ic_fcm_buddypress_contact_form7_content_enable') != '') {
											$activity_content_push = get_option('pnfpb_ic_fcm_buddypress_contact_form7_content_enable');
										}

										$activity_content_push = str_replace("[user name]", $new_user_name, $activity_content_push);
										$message = array( 
											'title'     => $notificationtitle,
											'body'      => stripslashes(strip_tags($activity_content_push)),
											'icon'		=> $iconurl,
											'image'		=> $imageurl,
											'click_action' => $messageurl
										);


										$fields = array( 
											'registration_ids' => $regid, 
											'notification' => $message,
											'data'	=> array('thread_id' => $thread_id)
										);
    
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
			
										$apiresults = wp_remote_post($url, $args);
										$apibody = wp_remote_retrieve_body($apiresults);
						
										$bodyresults = json_decode($apibody,true);
						
										if (is_array($bodyresults)) {
											if (array_key_exists('results', $bodyresults)) {
												foreach ($bodyresults['results'] as $idx=>$result){
													if (array_key_exists('error',$result)) {
														if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
															$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
										do_action('PNFPB_connect_to_external_api_for_contact_form7_send_mail');
									}

									if (count($deviceidswebview) > 0) {

										$regid = $deviceidswebview;
						
										if (get_option('pnfpb_ic_fcm_buddypress_contact_form7_content_enable') != false && get_option('pnfpb_ic_fcm_buddypress_contact_form7_content_enable') != '') {
											$activity_content_push = get_option('pnfpb_ic_fcm_buddypress_contact_form7_content_enable');
										}

										$message = array( 
											'title'     => $notificationtitle,
											'body'      => stripslashes(strip_tags($activity_content_push)),
											'icon'		=> $iconurl,
											'image'		=> $imageurl
										);


										$fields = array( 
											'registration_ids' => $regid, 
											'notification' => $message,
											'data'	=> array('thread_id' => $thread_id,'click_url' => $messageurl)
										);
    
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
			
										$apiresults = wp_remote_post($url, $args);
										$apibody = wp_remote_retrieve_body($apiresults);
						
										$bodyresults = json_decode($apibody,true);
						
										if (is_array($bodyresults)) {
											if (array_key_exists('results', $bodyresults)) {
												foreach ($bodyresults['results'] as $idx=>$result) {
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
										do_action('PNFPB_connect_to_external_api_for_contact_form7_send_mail_webview');
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
        
								if (get_option('pnfpb_ic_fcm_new_user_registration_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false) {
				
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
					
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = {$adminuser->ID} LIMIT 1000"  );
					
					
									$webview = false;
									
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND userid = {$adminuser->ID} LIMIT 1000"  );
					
					
									$imageurl = '';
					
									$iconurl =	bp_core_fetch_avatar ( 
    											array(  'item_id'   => $user_id,       // output user id of post author
            											'type'      => 'full',
            											'html'      => FALSE    // FALSE = return url, TRUE (default) = return url wrapped with html
   									 				) 
												);
				
									$activity_content_push = str_replace("[user name]", $new_user_name, $activity_content_push);
									
									if (count($deviceids) > 0) {

										$regid = $deviceids;
						
						
										if (get_option('pnfpb_ic_fcm_buddypress_new_user_registration_content_enable') != false && get_option('pnfpb_ic_fcm_buddypress_new_user_registration_content_enable') != '') {
											$activity_content_push = get_option('pnfpb_ic_fcm_buddypress_new_user_registration_content_enable');
										}
										
										$activity_content_push = str_replace("[user name]", $new_user_name, $activity_content_push);


										$message = array( 
											'title'     => $notificationtitle,
											'body'      => substr(stripslashes(strip_tags($activity_content_push)),0,59),
											'icon'		=> $iconurl,
											'image'		=> $imageurl,
											'click_action' => $messageurl
										);


										$fields = array( 
											'registration_ids' => $regid, 
											'notification' => $message
										);
    
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
			
										$apiresults = wp_remote_post($url, $args);
										$apibody = wp_remote_retrieve_body($apiresults);
						
										$bodyresults = json_decode($apibody,true);
						
										if (is_array($bodyresults)) {
											if (array_key_exists('results', $bodyresults)) {
												foreach ($bodyresults['results'] as $idx=>$result){
													if (array_key_exists('error',$result)) {
														if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
															$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
										do_action('PNFPB_connect_to_external_api_for_private_messages');
									}

									if (count($deviceidswebview) > 0) {

										$regid = $deviceidswebview;
						
										if (get_option('pnfpb_ic_fcm_new_user_registration_text') != false && get_option('pnfpb_ic_fcm_new_user_registration_text') != '') {
											$activity_content_push = get_option('pnfpb_ic_fcm_new_user_registration_text');
										}
										
										$activity_content_push = str_replace("[user name]", $sender_name, $activity_content_push);

										$message = array( 
											'title'     => $notificationtitle,
											'body'      => substr(stripslashes(strip_tags($activity_content_push)),0,59),
											'icon'		=> $iconurl,
											'image'		=> $imageurl
										);


										$fields = array( 
											'registration_ids' => $regid, 
											'notification' => $message,
											'data'	=> array('click_url' => $messageurl)
										);
    
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
			
										$apiresults = wp_remote_post($url, $args);
										$apibody = wp_remote_retrieve_body($apiresults);
						
										$bodyresults = json_decode($apibody,true);
						
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
										do_action('PNFPB_connect_to_external_api_for_private_messages_webview');
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
				
			if (get_option('pnfpb_ic_fcm_group_details_updated_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false) {
				
				$bpgroup = '';
					
				$bpgroupid = null;

				if ($group_id) {

					$bpgroupid = $group_id;
						
				}
	
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
						
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
						
					}
					else				
					{

							if (get_option('pnfpb_shortcode_enable') === 'yes') {
						
								$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
						
							}							
							else 
							{
								
								$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' LIMIT {$dcount}, 1000" );
								
							}
					}
					

					$url = 'https://fcm.googleapis.com/fcm/send';

					$regid = $deviceids;
    
            
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
					
					if (count($regid) > 0) {
							// prepare the message
							$message = array( 
								'title'     => $grouptitle,
								'body'      => stripslashes(strip_tags($localactivitycontent)),
								'icon'		=> $group_image,
								'image'		=> $imageurl,
								'click_action' => $grouplink

							);
    

							$fields = array( 
								'registration_ids' => $regid, 
								'notification' => $message
							);
    
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
			
							$apiresults = wp_remote_post($url, $args);
				
							$apibody = wp_remote_retrieve_body($apiresults);

							$bodyresults = json_decode($apibody,true);
							if (is_array($bodyresults)) {
								if (array_key_exists('results', $bodyresults)) {
									foreach ($bodyresults['results'] as $idx=>$result){
										if (array_key_exists('error',$result)) {
											if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
												$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
							do_action('PNFPB_connect_to_external_api_for_group_details_updated_notification');
					}
				}
					
				for ($dcount=0; $dcount<=count($deviceids_webview_count); $dcount+=1000) {	
					
						$webview = false;
						
						if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
							
							$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
						}
						else 
						{
							
							$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' LIMIT {$dcount}, 1000" );							
						}
				
						if (count($deviceidswebview) > 0) {
							// prepare the message
							$message = array( 
							'title'     => $grouptitle,
							'body'      => stripslashes(strip_tags($localactivitycontent)),
							'icon'		=> $group_image,
							'image'		=> $imageurl

						);
    

						$fields = array( 
							'registration_ids' => $deviceidswebview, 
							'notification' => $message,
							'data'	=> array('click_url' => $grouplink)
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
				
						$apibody = wp_remote_retrieve_body($apiresults);

						$bodyresults = json_decode($apibody,true);
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
				    		$status = $apiresults->get_error_code(); 				// custom code for WP_ERROR
                    		$error_message = $apiresults->get_error_message();
                    		error_log('There was a '.$status.' error in push notification: '.$error_message);
                		}
						do_action('PNFPB_connect_to_external_api_for_group_details_updated_notification');
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
			
			if (get_option('pnfpb_ic_fcm_group_invitation_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false) {
				
				global $wpdb;
				
				$sender_name = bp_core_get_user_displayname( $inviter_id );

				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
				$url = 'https://fcm.googleapis.com/fcm/send';

				$notificationcontent = $sender_name.__(' invited you to join in group ',PNFPB_TD).$group_name;
				
				$notificationtitle = __('Group invite to join in group ',PNFPB_TD).$group_name;
				
				$titletext = get_option('pnfpb_ic_fcm_buddypress_group_invitation_text_enable');
				
				if ( $titletext && $titletext !== '') {
					$notificationtitle = str_replace("[sender name]", $sender_name, $titletext);
					$notificationtitle = str_replace("[group name]", $group_name, $notificationtitle);
				}
				
				$contenttext = get_option('pnfpb_ic_fcm_buddypress_group_invitation_content_enable');
				
				if ( $contenttext && $contenttext !== '') {
					$notificationcontent = str_replace("[sender name]", $sender_name, $contenttext);
					$notificationcontent = str_replace("[group name]", $group_name, $notificationcontent);
				}				
				
				$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
	
				// Send an email to each recipient.
				foreach ( $invited_users as $invited_user ) {

					
					if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						
						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = {$invited_user} AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
						
					} else {
						
						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = {$invited_user} LIMIT 1000"  );
						
					}
					
					
					$webview = false;
					if ( get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND userid = {$invited_user} AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
					}
					else {
						$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND userid = {$invited_user}  LIMIT 1000"  );						
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
						
						
						$message = array( 
						'title'     => $notificationtitle,
						'body'      => stripslashes(strip_tags($notificationcontent)),
						'icon'		=> $group_image,
						'image'		=> $imageurl,
						'click_action' => $group_link
						);


						$fields = array( 
						'registration_ids' => $regid, 
						'notification' => $message
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
						$apibody = wp_remote_retrieve_body($apiresults);
						
						$bodyresults = json_decode($apibody,true);
						
						if (is_array($bodyresults)) {
							if (array_key_exists('results', $bodyresults)) {
								foreach ($bodyresults['results'] as $idx=>$result){
									if (array_key_exists('error',$result)) {
										if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
											$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
						do_action('PNFPB_connect_to_external_api_for_group_invitation_notification');
					}

					if (count($deviceidswebview) > 0) {

						$regid = $deviceidswebview;
						


						$message = array( 
						'title'     => $notificationtitle,
						'body'      => stripslashes(strip_tags($notificationcontent)),
						'icon'		=> $group_image,
						'image'		=> $imageurl
						);


						$fields = array( 
						'registration_ids' => $regid, 
						'notification' => $message,
						'data'	=> array('click_url' => $group_link)
						);
    
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
			
						$apiresults = wp_remote_post($url, $args);
						$apibody = wp_remote_retrieve_body($apiresults);
						
						$bodyresults = json_decode($apibody,true);
						
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
						do_action('PNFPB_connect_to_external_api_for_group_invitation_notification_webview');
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
				'name'            => _x( 'Push Notification subscription', 'Push Notification subscription sub nav', 'buddypress' ),
				'slug'            => 'push-subscription',
				'parent_url'      => trailingslashit( $user_domain . 'settings' ),
				'parent_slug'     => $settings_slug,
				'screen_function' => array( $this, "pnfpb_buddypress_notification_settings_function" ),
				'position'        => 30
			) 	);
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
		
	    
		    $pnfpb_notification_shortcode .= '
			<div id="pnfpb_subscribe_dialog_confirm" class="pnfpb_subscribe_dialog_confirm  ui-helper-clearfix" title="Subscribe notification?">
				<div class="pnfpb_ic_subscription_menu">
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_all_shortcode_enable" name="pnfpb_ic_subscribe_all_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_all_shortcode_enable' ) ).'  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_all_shortcode_enable">'.$subscribe_all_shortcode_dialog_text.'</label>
					</div>
				</div>
				<div class="pnfpb_ic_subscription_menu">
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_post_activities_shortcode_enable" name="pnfpb_ic_subscribe_post_activities_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_post_activities_shortcode_enable' ) ).'  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_post_activities_shortcode_enable">'.$subscribe_post_activities_shortcode_dialog_text.'</label>
					</div>
				</div>
				<div class="pnfpb_ic_subscription_menu">
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_all_comments_shortcode_enable" name="pnfpb_ic_subscribe_all_comments_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_all_comments_shortcode_enable' ) ).'  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_all_comments_shortcode_enable">'.$subscribe_all_comments_shortcode_dialog_text.'</label>
					</div>
				</div>
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_private_message_shortcode_enable" name="pnfpb_ic_subscribe_private_message_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_private_message_shortcode_enable' ) ).'  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_private_message_shortcode_enable">'.$subscribe_private_message_shortcode_dialog_text.'</label>
					</div>
				</div>
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_new_member_shortcode_enable" name="pnfpb_ic_subscribe_new_member_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_new_member_shortcode_enable' ) ).'  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_new_member_shortcode_enable" >'.$subscribe_new_member_shortcode_dialog_text.'</label>
					</div>
				</div>
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_friendship_request_shortcode_enable" name="pnfpb_ic_subscribe_friendship_request_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_friendship_request_shortcode_enable' ) ).'  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_friendship_request_shortcode_enable" >'.$subscribe_friendship_request_shortcode_dialog_text.'</label>
					</div>
				</div>
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_friendship_accepted_shortcode_enable" name="pnfpb_ic_subscribe_friendship_accepted_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_friendship_accepted_shortcode_enable' ) ).'  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_friendship_accepted_shortcode_enable" >'.$subscribe_friendship_accepted_shortcode_dialog_text.'</label>
					</div>
				</div>
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_user_avatar_shortcode_enable" name="pnfpb_ic_subscribe_user_avatar_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_user_avatar_shortcode_enable' ) ).'  />
					</div>
					<div  class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_user_avatar_shortcode_enable">'.$subscribe_user_avatar_shortcode_dialog_text.'</label>
					</div>
				</div>
				<div class="pnfpb_ic_subscription_menu">					
					<div class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_cover_image_change_shortcode_enable" name="pnfpb_ic_subscribe_cover_image_change_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_cover_image_change_shortcode_enable' ) ).'  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_cover_image_change_shortcode_enable" >'.$subscribe_cover_image_change_shortcode_dialog_text.'</label>
					</div>
				</div>
				<div class="pnfpb_ic_subscription_menu">
					<div   class="pnfpb_ic_subscription_input">
						<input id="pnfpb_ic_subscribe_my_post_shortcode_enable" name="pnfpb_ic_subscribe_my_post_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_my_post_shortcode_enable' ) ).'  />
					</div>
					<div class="pnfpb_ic_subscription_checkbox">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_my_post_shortcode_enable">'.$subscribe_mypost_comments_shortcode_dialog_text.'</label>
					</div>
				</div>
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
		
		/**
	    * Subscription to notification for users who joined in specific groups
	    * Group notification
	    *
	    * @since 1.8
	    */
		public function PNFPB_subscribe_to_group_button() {
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
                    
					if((strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile/') !== false) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/') == false)) :
    					$isWebView = true;
					elseif(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) :
    						$isWebView = true;
					endif;
					
                    if (strpos($_SERVER['HTTP_USER_AGENT'], 'wv') !== false) {
						
                    	$isWebView = true;
                    }
                    
					if ($cookievalue != '' && !$isWebView) {					

						$deviceid_select_status = $wpdb->query("SELECT * FROM {$table} WHERE device_id LIKE '%!!{$group->id}!!{$cookievalue}%' AND userid = {$bpuserid}");                    
						                   
                    }
                    else
                    {
						$deviceid_select_status = $wpdb->query("SELECT * FROM {$table} WHERE device_id LIKE '%!!{$group->id}%' AND device_id LIKE '%webview%' AND userid = {$bpuserid}");                     
                    }
				
					$unsubscribe_button_text = __('Unubscribe push notifications',PNFPB_TD);
				
					if (get_option('pnfpb_ic_fcm_unsubscribe_button_text') && get_option('pnfpb_ic_fcm_unsubscribe_button_text') !== false && get_option('pnfpb_ic_fcm_unsubscribe_button_text') !== '') {
						$unsubscribe_button_text = get_option('pnfpb_ic_fcm_unsubscribe_button_text');
					}
				
					$subscribe_button_text = __('Subscribe to push notifications',PNFPB_TD);
				
					if (get_option('pnfpb_ic_fcm_subscribe_button_text') && get_option('pnfpb_ic_fcm_subscribe_button_text') !== false && get_option('pnfpb_ic_fcm_subscribe_button_text') !== '') {
						$subscribe_button_text = get_option('pnfpb_ic_fcm_subscribe_button_text');
					}				
			
					if ($deviceid_select_status > 0 && groups_is_user_member( $bpuserid, $group->id )) {
						// Setup button attributes.
        				$button = array(
            				'id'                => 'unsubscribe_notification_group',
            				'component'         => 'groups',
            				'must_be_logged_in' => true,
            				'block_self'        => false,
            				'wrapper_class'     => 'unsubscribegroupbutton subscribe-display-on',
            				'wrapper_id'        => 'unsubscribegroupbutton-' . $group->id,
            				'link_text'         => $unsubscribe_button_text,
            				'link_class'        => 'unsubscribe-notification-group subscribe-display-on unsubscribegroupbutton-' . $group->id,
							'button_element'    => 'button',
            				'button_attr' => array(
							'data-group-id'		=> $group->id,
							'data-user-id'		=> $bpuserid,
                			'data-title'           => $unsubscribe_button_text,
                			'data-title-displayed' => $unsubscribe_button_text
            				)
        				);				
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
            				'link_text'         => 'Unsubscribe push notifications',
            				'link_class'        => 'unsubscribe-notification-group subscribe-display-off unsubscribegroupbutton-' . $group->id,
							'button_element'    => 'button',
            				'button_attr' => array(
								'data-group-id'		=> $group->id,
								'data-user-id'		=> $bpuserid,
                				'data-title'           => $unsubscribe_button_text,
                				'data-title-displayed' => $unsubscribe_button_text
            				)
        				);				
					}
					echo bp_get_button( $button );
			
					if ($deviceid_select_status == 0  && groups_is_user_member( $bpuserid, $group->id )) {
						// Setup button attributes.
        				$button = array(
            				'id'                => 'subscribe_notification_group',
            				'component'         => 'groups',
            				'must_be_logged_in' => true,
            				'block_self'        => false,
            				'wrapper_class'     => 'subscribegroupbutton subscribe-display-on',
            				'wrapper_id'        => 'subscribegroupbutton-' . $group->id,
            				'link_text'         => $subscribe_button_text,
            				'link_class'        => 'subscribe-notification-group subscribe-display-on subscribegroupbutton-' . $group->id,
							'button_element'    => 'button',
            				'button_attr' => array(
								'data-group-id'		=> $group->id,
								'data-user-id'		=> $bpuserid,
                				'data-title'           => $subscribe_button_text,
                				'data-title-displayed' => $subscribe_button_text
            				)
        				);
				 
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
            					'link_text'         => $subscribe_button_text,
            					'link_class'        => 'subscribe-notification-group subscribe-display-off subscribegroupbutton-' . $group->id,
								'button_element'    => 'button',
            					'button_attr' => array(
									'data-group-id'		=> $group->id,
									'data-user-id'		=> $bpuserid,
                					'data-title'           => $subscribe_button_text,
                					'data-title-displayed' => $subscribe_button_text
            					)
        					);							
					}
					echo bp_get_button( $button );	
			}

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
			
						$updatetokenresponse = 'duplicate';
					
		    		}
					else 
					{					
					
						$bpnewdeviceid = $decrypted.'!!'.$request['groupid'].'!!'.$request['cookievalue'].'!!webview';
					
						$data = array('userid' => $bpuserid, 'device_id' => $bpnewdeviceid, 'subscription_option' => $subscriptionoptions);					
					
						$insertstatus = $wpdb->insert($table,$data);
					
						if (!$insertstatus || $insertstatus !== 0){
						
							$updatetokenresponse = 'subscribed'.$insertstatus.count($deviceid_select_status);
						
						}
					}						
				}
				else 
				{
					
					if ($request['subscription-type'] === 'unsubscribe-group') {
					
						$bpolddeviceid = $decrypted.'!!'.$request['groupid'].'!!'.$request['cookievalue'].'!!webview';
		
		    			$deviceid_update_status = $wpdb->query("DELETE from {$table} WHERE device_id = '{$bpolddeviceid}'") ;
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
			
							$updatetokenresponse = 'duplicate';
					
		    			}
						else 
						{
							$insertstatus = $wpdb->insert($table,$data);
					
							if (!$insertstatus || $insertstatus !== 0){
						
								$updatetokenresponse = 'subscribed'.$insertstatus.count($deviceid_select_status);
						
							}				
						}
					}
				}
				

				
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
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_frontend_settings" class="tab"><?php echo __("Frontend settings",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_button_settings" class="tab "><?php echo __("Customize buttons",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_integrate_app" class="tab active"><?php echo __("Mobile app",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="tab "><?php echo __("NGINX",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_action_scheduler" class="tab "><?php echo __("Action Scheduler",PNFPB_TD);?></a>
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
			<h2 class="pnfpb_ic_push_settings_header"><?php echo __("Disable push notification service worker file and PWA",PNFPB_TD);?></h2>
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
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_frontend_settings" class="tab"><?php echo __("Frontend settings",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_button_settings" class="tab "><?php echo __("Customize buttons",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_integrate_app" class="tab "><?php echo __("Mobile app",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="tab active"><?php echo __("NGINX",PNFPB_TD);?></a>
					<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_action_scheduler" class="tab "><?php echo __("Action Scheduler",PNFPB_TD);?></a>
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

							$createfileresult = $wp_filesystem->delete( trailingslashit( ABSPATH ) . 'pnfpb_icpush_pwa_sw.js');
						
						}
			
						$firebase_swresponse 		= wp_remote_head( home_url( '/' ). 'firebase-messaging-sw.js', array( 'sslverify' => false ) );
				
						$firebase_swresponse_code 	= wp_remote_retrieve_response_code( $firebase_swresponse );

	
						if ( 200 === $firebase_swresponse_code ) {
				
							$createfileresult = $wp_filesystem->delete( trailingslashit( ABSPATH ) . 'firebase-messaging-sw.js');

						}
			
						if (get_option('pnfpb_ic_pwa_app_enable') === '1') {
			
							$pwa_manifest_response 		= wp_remote_head( home_url( '/' ). 'pnfpbmanifest.json', array( 'sslverify' => false ) );
					
							$pwa_manifest_response_code 	= wp_remote_retrieve_response_code( $pwa_manifest_response );
				
							if ( 200 === $pwa_manifest_response_code ) {
				
								$createfileresult = $wp_filesystem->delete( trailingslashit( ABSPATH ) . 'pnfpbmanifest.json');

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
								</td>							
    						</tr>							
						</tbody>
					</table>
				</form>
			</div>
		<?php
		}		
		
	}

    $PNFPB_ICFM_Push_Notification_Post_BuddyPress_OBJ = new PNFPB_ICFM_Push_Notification_Post_BuddyPress();
	
	include(plugin_dir_path(__FILE__) . 'admin/pnfpb_icfcm_device_tokens_list.php');

}
else
{
    exit;
}
?>