<?php
/*
Plugin Name: Push Notification for Post and BuddyPress
Plugin URI: https://www.muraliwebworld.com/groups/wordpress-plugins-by-muralidharan-indiacitys-com-technologies/forum/topic/push-notification-for-post-and-buddypress/
Description: Push notification for Post, custom post types and for BuddyPress activities using Firebase. Update Firebase configuration details in <a href="options-general.php?page=pnfpb-icfcm-slug"><strong>settings page</strong></a>
Version: 1.351
Author: Muralidharan Ramasamy
Author URI: https://www.muraliwebworld.com
Text Domain: PNFPB_TD
Updated: 21 Feb 2022
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
if (!defined("PNFPB_PLUGIN_SCHEDULE_PUSH")) define("PNFPB_PLUGIN_SCHEDULE_PUSH", '(if scheduled, push notification will be sent as per selected schedule otherwise it will be sent whenever new item is posted. BuddyPress notifications only when BuddyPress plugin is installed and active)');
if (!defined("PNFPB_PLUGIN_FIREBASE_SETTINGS")) define("PNFPB_PLUGIN_FIREBASE_SETTINGS", 'Firebase configuration');
if (!defined("PNFPB_PLUGIN_NM_ONDEMANDPUSH_HEADER")) define("PNFPB_PLUGIN_NM_ONDEMANDPUSH_HEADER", 'On demand push notification');
if (!defined("PNFPB_PLUGIN_NM_BUTTON_HEADER")) define("PNFPB_PLUGIN_NM_BUTTON_HEADER", 'Customize buttons');
if (!defined("PNFPB_PLUGIN_NM_ONDEMANDPUSH_SETTINGS")) define("PNFPB_PLUGIN_NM_ONDEMANDPUSH_SETTINGS", 'On demand or one time push notification settings');
if (!defined("PNFPB_PLUGIN_NM_ONDEMANDPUSH_DETAIL")) define("PNFPB_PLUGIN_NM_ONDEMANDPUSH_DETAIL", 'To send On demand or one time push notification to all subscribers with image');
if (!defined("PNFPB_TD")) define("PNFPB_TD", 'pnfpb_td');


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
        
			// Add a link to the plugin's settings and/or network admin settings in the plugins list table.
			add_filter( 'plugin_action_links', array($this, $this->pre_name .'add_settings_link' ), 10, 2 );
			add_filter( 'network_admin_plugin_action_links', array($this, $this->pre_name .'add_settings_link' ), 10, 2 );

			wp_enqueue_script("jquery");
			
			wp_enqueue_script("jquery-ui-dialog");
		
			//Enqueue needed scripts for frontend and for admin area
			add_action( 'wp_enqueue_scripts', array($this, $this->pre_name .'ic_push_notification_scripts'),12 );
			add_action( 'admin_enqueue_scripts', array($this, $this->pre_name .'ic_push_notification_scripts'),12 );
		
			add_action( 'wp_ajax_icpushcallback', array($this,  $this->pre_name .'icpushcallback_callback') );
			add_action( 'wp_ajax_nopriv_icpushcallback', array($this,  $this->pre_name .'icpushcallback_callback') );
			
			add_action( 'wp_ajax_unsubscribepush', array($this,  $this->pre_name .'unsubscribe_push_callback') );
			add_action( 'wp_ajax_nopriv_unsubscribepush', array($this,  $this->pre_name .'unsubscribe_push_callback') );
			
			//Plugin settings in admin area
			add_action('admin_menu', array($this, $this->pre_name . 'setup_admin_menu'));
			add_action('admin_init', array($this, $this->pre_name . 'settings'));
			add_action('admin_init', array($this, $this->pre_name . 'ic_push_upload_icon_script'));
			
			//create service worker file which is needed for push notification using FCM
			add_action('init', array($this, $this->pre_name .'icpush_sw_file_create'));
		
			//add manifest link for PWA app
			add_action( 'wp_head', array($this, $this->pre_name . 'include_manifest_link'));

			//add custom pwa install prompt
			add_action( 'wp_footer', array($this, $this->pre_name . 'custom_pwa_install_prompt'));
		
			//Push notification(if enabled) for post and custom post types based on plugin settings
			add_action('save_post', array($this, $this->pre_name . 'on_post_save_web'),5, 3);
			
			// Scheduled push notification(if enabled) for post and custom post types
			add_action( $this->pre_name .'cron_post_hook', array($this, $this->pre_name . 'icforum_push_notifications_post_web'));
			
			//Push notification for comments posted on post.
			add_action( 'comment_post', array($this,  $this->pre_name .'icforum_push_notifications_post_comment_web'),10,3);
				
			// Scheduled push notification(if enabled) for new comments in Buddypress Activities
			add_action( $this->pre_name .'cron_comments_post_hook', array($this,  $this->pre_name .'icforum_push_notifications_post_comment_web'));
			
			add_action( 'rest_api_init',array($this,  $this->pre_name .'rest_api_subscription_tokens_from_app'));
			//
			/*add_action ('rest_api_init' , function () {
				register_rest_route( 'PNFPBpush/v1', 'token/(?P<id>\d+)', array(
   				 'methods' => 'GET',
    			'callback' => array($this,  $this->pre_name .'PNFPB_get_subscription_tokens_from_app'),
    			'args' => array(
      				'id' => array(
						'sanitize_callback' => function($value, $request, $param) {
							return $value;
						}
      				),
    			),
  				) );
			})*/
			
			
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
				
							
				//Push notification(if enabled) for new comments posted on BuddyPress acitivities based on plugin settings
				add_action( 'bp_activity_comment_posted', array($this,  $this->pre_name .'icforum_push_notifications_comment_web'), 5, 3 );
			
				// Scheduled push notification(if enabled) for new comments in Buddypress Activities
				add_action( $this->pre_name .'cron_buddypresscomments_hook', array($this,  $this->pre_name .'icforum_push_notifications_comment_web'));							
				add_action ( 'bp_group_header_actions', array($this,  $this->pre_name .'subscribe_to_group_button'), 1);

				add_action ( 'bp_directory_groups_actions' , array($this,  $this->pre_name .'subscribe_to_group_button'), 1);

			}		
			
			//Shortcode to unsubscribe push notification
			add_shortcode( 'subscribe_PNFPB_push_notification', array($this,  $this->pre_name .'subscribe_push_notification_shortcode') );
		
	
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

			if( empty($is_status_col) ):
    			$add_status_column = "ALTER TABLE `{$pnfpb_table_name}` ADD `subscription_option` VARCHAR(50) NULL DEFAULT NULL AFTER `device_id`; ";

   				 $wpdb->query( $add_status_column );
			endif;
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
                    PRIMARY KEY (id)
                ) {$charset_collate};";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        
			dbDelta( $sql );
			
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
			
		}


		/**
		* Add a link to the settings on the Plugins screen.
		*
		* @since 1.0.0
		*/
		public function PNFPB_add_settings_link( $links, $file ) {
	    

			if ( $file === 'push-notification-for-post-and-buddypress/pnfpb_push_notification.php' && current_user_can( 'manage_options' ) ) {
				if ( current_filter() === 'plugin_action_links' ) {
					$url = admin_url( 'options-general.php?page=pnfpb-icfcm-slug' );
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
		public function PNFPB_ic_push_notification_scripts() {
			
			wp_enqueue_script( 'jquery-ui-dialog' ); 
			wp_enqueue_style( 'wp-jquery-ui-dialog' );
	
            wp_enqueue_style( 'pnfpb-icpstyle-name', plugin_dir_url( __FILE__ ).'public/css/pnfpb_main.css',array(),'1.371' );
			wp_enqueue_style( 'pnfpb-admin-icpstyle-name', plugin_dir_url( __FILE__ ).'admin/css/pnfpb_admin.css' );
			wp_enqueue_style( 'pnfpb-admin-pwa-icpstyle-name', plugin_dir_url( __FILE__ ).'admin/css/pnfpb_pwa_admin.css' );
            
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
				$pwainstallbuttontext = 'Install PWA app';
			}
			$pwainstallheadertext = get_option("pnfpb_ic_pwa_prompt_header_text");
			if ($pwainstallheadertext === '') {
				$pwainstallheadertext = 'Install our PWA app with offline functionality';
			}			
			$pwainstalltext = get_option("pnfpb_ic_pwa_prompt_description");
			if ($pwainstalltext === '') {
				$pwainstalltext = 'Install PWA';
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

			if (($projectId != false && $projectId != '' && $publicKey != false && $publicKey != '' && $apiKey != false && $apiKey != '' && $messagingSenderId != false && $messagingSenderId != '' ) ) {
			    
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
				
					$subscribe_dialog_text_confirm = 'Subscription updated';
				
					if (get_option('pnfpb_ic_fcm_subscribe_dialog_text_confirm') && get_option('pnfpb_ic_fcm_subscribe_dialog_text_confirm') !== false && get_option('pnfpb_ic_fcm_subscribe_dialog_text_confirm') !== '') {
						$subscribe_dialog_text_confirm = get_option('pnfpb_ic_fcm_subscribe_dialog_text_confirm');
					}
				
					$unsubscribe_button_text_shortcode = 'Unsubscribe push notifications';
				
					if (get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text') && get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text') !== false && get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text') !== '') {
						$unsubscribe_button_text_shortcode = get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text');
					}
				
					$subscribe_button_text_shortcode = 'Subscribe push notifications';
				
					if (get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text') && get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text') !== false && get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text') !== '') {
						$subscribe_button_text_shortcode = get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text');
					}				
				
				
					$save_button_text = 'Save';
				
					if (get_option('pnfpb_ic_fcm_subscribe_save_button_text_shortcode') && get_option('pnfpb_ic_fcm_subscribe_save_button_text_shortcode') !== false && get_option('pnfpb_ic_fcm_subscribe_save_button_text_shortcode') !== '') {
						$save_button_text = get_option('pnfpb_ic_fcm_subscribe_save_button_text_shortcode');
					}
				
					$cancel_button_text = 'Cancel';
				
					if (get_option('pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode') && get_option('pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode') !== false && get_option('pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode') !== '') {
						$cancel_button_text = get_option('pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode');
					}
				
					$subscribe_button_text = 'Subscribe push notification';
				
					if (get_option('pnfpb_ic_fcm_subscribe_button_text') && get_option('pnfpb_ic_fcm_subscribe_button_text') !== false && get_option('pnfpb_ic_fcm_subscribe_button_text') !== '') {
						$subscribe_button_text = get_option('pnfpb_ic_fcm_subscribe_button_text');
					}
				
					$unsubscribe_button_text = 'Unsubscribe push notification';;
				
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
				$filename = '/public/js/pnfpb_pushscript_pwa.js';
				$ajaxobject = 'pnfpb_ajax_object_push';
				wp_enqueue_script( 'pnfpb-icajax-script-push', plugins_url( $filename, __FILE__ ), array( 'jquery' ),'1.35944');
				wp_localize_script( 'pnfpb-icajax-script-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'apiKey' => $apiKey, 'authDomain' => $authDomain, 'databaseURL' => $databaseURL, 'projectId' => $projectId, 'storageBucket' => $storageBucket, 'messagingSenderId' => $messagingSenderId, 'appId' => $appId, 'publicKey' => $publicKey, 'homeurl' => $homeurl, 'pwaapponlyenable' => '0', 'pwainstallheadertext' => $pwainstallheadertext , 'pwainstalltext' => $pwainstalltext, 'pwainstallbuttoncolor' => $pwainstallbuttoncolor, 'pwainstallbuttontextcolor' => $pwainstallbuttontextcolor, 'pwainstallbuttontext' => $pwainstallbuttontext, 'pwainstallpromptenabled' => $pwainstallpromptenabled,  'pwacustominstalltype' => $pwacustominstalltype,'unsubscribe_dialog_text_confirm' => $unsubscribe_dialog_text_confirm, 'subscribe_dialog_text_confirm' => $subscribe_dialog_text_confirm,'unsubscribe_button_text' => $unsubscribe_button_text_shortcode, 'subscribe_button_text' => $subscribe_button_text_shortcode, 'subscribe_button_text_color' => $subscribe_button_text_color, 'subscribe_button_color' => $subscribe_button_color, 'cancel_button_text' => $cancel_button_text, 'save_button_text' => $save_button_text, 'isloggedin' => is_user_logged_in() ) );
				
				$filename = '/public/js/pnfpb_unsubscribe_pushscript_pwa.js';
				$ajaxobject = 'pnfpb_ajax_object_unsubscribe_push';
				wp_enqueue_script( 'pnfpb-icajax-script-unsubscribe-push', plugins_url( $filename, __FILE__ ), array( 'jquery' ),'1.31');
				wp_localize_script( 'pnfpb-icajax-script-unsubscribe-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'publicKey' => $publicKey, 'homeurl' => $homeurl, 'unsubscribe_dialog_text' => $unsubscribe_dialog_text, 'subscribe_dialog_text' => $subscribe_dialog_text, 'unsubscribe_dialog_text_confirm' => $unsubscribe_dialog_text_confirm, 'subscribe_dialog_text_confirm' => $subscribe_dialog_text_confirm,'unsubscribe_button_text' => $unsubscribe_button_text_shortcode, 'subscribe_button_text' => $subscribe_button_text_shortcode, 'subscribe_button_text_color' => $subscribe_button_text_color, 'subscribe_button_color' => $subscribe_button_color) );
			
				$group_unsubscribe_dialog_text_confirm = 'Your device is unsubscribed from notification';
				
					if (get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm') && get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm') !== false && get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm') !== '') {
						$group_unsubscribe_dialog_text_confirm = get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm');
					}
				
					$group_subscribe_dialog_text_confirm = 'Your device is subscribed from notification';
				
					if (get_option('pnfpb_ic_fcm_group_subscribe_dialog_text_confirm') && get_option('pnfpb_ic_fcm_group_subscribe_dialog_text_confirm') !== false && get_option('pnfpb_ic_fcm_group_subscribe_dialog_text_confirm') !== '') {
						$group_subscribe_dialog_text_confirm = get_option('pnfpb_ic_fcm_group_subscribe_dialog_text_confirm');
					}			
				
					$group_unsubscribe_dialog_text = 'Would you like to remove push notifications?';
				
					if (get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text') && get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text') !== false && get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text') !== '') {
						$group_unsubscribe_dialog_text = get_option('pnfpb_ic_fcm_group_unsubscribe_dialog_text');
					}
				
					$group_subscribe_dialog_text = 'Would you like to subscribe to push notifications?';
				
					if (get_option('pnfpb_ic_fcm_group_subscribe_dialog_text') && get_option('pnfpb_ic_fcm_group_subscribe_dialog_text') !== false && get_option('pnfpb_ic_fcm_group_subscribe_dialog_text') !== '') {
						$group_subscribe_dialog_text = get_option('pnfpb_ic_fcm_group_subscribe_dialog_text');
					}			
				
	
				
				$filename = '/public/js/pnfpb_group_pushscript_pwa.js';
				$ajaxobject = 'pnfpb_ajax_object_group_push';
				wp_enqueue_script( 'pnfpb-icajax-script-group-push', plugins_url( $filename, __FILE__ ), array( 'jquery' ),'1.3138');
				wp_localize_script( 'pnfpb-icajax-script-group-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'groupId' => '9', 'publicKey' => $publicKey, 'homeurl' => $homeurl,'group_unsubscribe_dialog_text_confirm' => $group_unsubscribe_dialog_text_confirm, 'group_subscribe_dialog_text_confirm' => $group_subscribe_dialog_text_confirm, 'group_unsubscribe_dialog_text' => $group_unsubscribe_dialog_text, 'group_subscribe_dialog_text' => $group_subscribe_dialog_text, 'unsubscribe_button_text' => $unsubscribe_button_text, 'subscribe_button_text' => $subscribe_button_text, 'subscribe_button_text_color' => $subscribe_button_text_color, 'subscribe_button_color' => $subscribe_button_color) );
				
			}
			else 
			{
				if ($pwaappenable === "1") {
					$filename = '/public/js/pnfpb_pushscript_pwa.js';
					$ajaxobject = 'pnfpb_ajax_object_push';
					wp_enqueue_script( 'pnfpb-icajax-script-push', plugins_url( $filename, __FILE__ ), array( 'jquery' ),'1.3579');
					wp_localize_script( 'pnfpb-icajax-script-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'apiKey' => $apiKey, 'authDomain' => $authDomain, 'databaseURL' => $databaseURL, 'projectId' => $projectId, 'storageBucket' => $storageBucket, 'messagingSenderId' => $messagingSenderId, 'appId' => $appId, 'publicKey' => $publicKey, 'homeurl' => $homeurl, 'pwaapponlyenable' => $pwaappenable, 'pwainstallheadertext' => $pwainstallheadertext , 'pwainstalltext' => $pwainstalltext, 'pwainstallbuttoncolor' => $pwainstallbuttoncolor, 'pwainstallbuttontextcolor' => $pwainstallbuttontextcolor, 'pwainstallbuttontext' => $pwainstallbuttontext, 'pwacustominstalltype' => $pwacustominstalltype,  'pwainstallpromptenabled' => $pwainstallpromptenabled) );					
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
			if (get_option('pnfpb_ic_pwa_app_enable') === '1') {
        		echo '<link rel="manifest" href="'.get_home_url().'/pnfpbmanifest.json">';
			}
		}

		public function PNFPB_custom_pwa_install_prompt() {
			if (get_option('pnfpb_ic_pwa_app_enable') === '1' && get_option('pnfpb_ic_pwa_app_custom_prompt_enable') === '1') {
				
?>
				<!-- The actual snackbar -->
				<div id="pnfpbsnackbar"><a id="pnfpbsnackbarlink" href="#"><?php if ( get_option("pnfpb_ic_pwa_prompt_description", false)) { echo get_option("pnfpb_ic_pwa_prompt_description"); } else { echo 'Would like to Install our Progressive Web App (PWA)'; } ?></a><span class="pnfpbclose"></span></div>
				
				<div id="pnfpb-pwa-dialog-confirm" class="pnfpb-pwa-dialog-confirm" title="<?php if ( get_option("pnfpb_ic_pwa_prompt_header_text", false) )  { echo get_option("pnfpb_ic_pwa_prompt_header_text"); } else { echo 'Install PWA app'; } ?>">
					<p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span><?php if ( get_option("pnfpb_ic_pwa_prompt_description", false)) { echo get_option("pnfpb_ic_pwa_prompt_description"); } else { echo 'Would like to Install our Progressive Web App (PWA)'; } ?></p>
				</div>
				<div id="pnfpb-pwa-dialog-app-installed" class="pnfpb-pwa-dialog-app-installed" title="<?php if ( get_option("pnfpb-pwa-dialog-app-installed_text", false) )  { echo get_option("pnfpb-pwa-dialog-app-installed_text"); } else { echo 'App installed successfully'; } ?>">
					<p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span><?php if ( get_option("pnfpb-pwa-dialog-app-installed_description", false)) { echo get_option("pnfpb-pwa-dialog-app-installed_description"); } else { echo 'Progressive Web App (PWA) is installed successfully. It will also work in offline'; } ?></p>
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
		* Create push notification settings menu under settings menu in admin area for push notification using FCM
		*
		* @since 1.0.0
		*/
		public function PNFPB_setup_admin_menu()
		{
			add_submenu_page('options-general.php', __('Push Notification using PNFPB', PNFPB_TD), PNFPB_PLUGIN_NM, 'manage_options', 'pnfpb-icfcm-slug', array($this, 'PNFPB_icfcm_admin_page'));
			
			add_submenu_page(null            // -> Set to null - will hide menu link
				, __('Customize Buttons', PNFPB_TD)// -> Page Title
				, 'Customize Buttons'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfm_button_settings'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_button_settings') // -> To render the page
			);			
			
			$hook_device_tokens = add_submenu_page(null            // -> Set to null - will hide menu link
				, __('Subscribed tokens list', PNFPB_TD)// -> Page Title
				, 'Subscribed tokens list'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfm_device_tokens_list'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_device_tokens_list') // -> To render the page
			);
			add_action( "load-$hook_device_tokens", [ $this, $this->pre_name.'screen_option' ] );
			
			add_submenu_page(null            // -> Set to null - will hide menu link
				, __('PWA app settings', PNFPB_TD)// -> Page Title
				, 'PWA app settings'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfm_pwa_app_settings'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_pwa_app_settings') // -> To render the page
			);			

			add_submenu_page(null            // -> Set to null - will hide menu link
				, __('On demand Notification', PNFPB_TD)// -> Page Title
				, 'On demand Notification'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfmtest_notification'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_test_notification') // -> To render the page
			);
			
		  	add_submenu_page(null            // -> Set to null - will hide menu link
				, __('Integrate App', PNFPB_TD)// -> Page Title
				, 'Integrate App'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfm_integrate_app'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_integrate_app') // -> To render the page
			);
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
			<h1 class="pnfpb_ic_push_settings_header"><?php echo __(PNFPB_PLUGIN_NM_DEVICE_TOKENS,PNFPB_TD);?></h1>
			<h2 class="nav-tab-wrapper"><a href="options-general.php?page=pnfpb-icfcm-slug" class="nav-tab">Push notification</a><a href="options-general.php?page=pnfpb_icfm_device_tokens_list" class="nav-tab nav-tab-active"><?php echo __(PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_pwa_app_settings" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_PWA_HEADER);?></a><a href="options-general.php?page=pnfpb_icfmtest_notification" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_ONDEMANDPUSH_HEADER);?></a><a href="options-general.php?page=pnfpb_icfm_button_settings" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_BUTTON_HEADER);?></a><a href="options-general.php?page=pnfpb_icfm_integrate_app" class="nav-tab"><?php echo 'Integrate app API';?></a></h2>

			<div class="wrap">
				<h2><?php echo __(PNFPB_PLUGIN_NM_DEVICE_TOKENS_LIST_HEADER,PNFPB_TD);?></h2>
				<p>
					<b>
						<?php echo __(PNFPB_PLUGIN_NM_DEVICE_TOKENS_LIST_DETAILS);?>
					</b>
				</p>
				<div id="poststuff">
					<div id="post-body" class="metabox-holder columns-2">
						<div id="post-body-content">
							<div class="meta-box-sortables ui-sortable">
								<form method="post">
									<?php
										$this->devicetokens_obj->prepare_items();
										$this->devicetokens_obj->display(); 
									?>
								</form>
							</div>
						</div>
					</div>
					<br class="clear">
				</div>
			</div>
		<?php
			
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
			register_setting('pnfpb_icfcm_group', 'pnfpb_ic_fcm_group_activity_title');
			register_setting('pnfpb_icfcm_group', 'pnfpb_ic_fcm_comment_activity_title');
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_upload_icon");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_post_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_buddypress_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_bcomment_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_bprivatemessage_enable");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_bprivatemessage_text");
			register_setting("pnfpb_icfcm_group", "pnfpb_ic_fcm_post_schedule_enable");
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
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_prompt_header_text");				register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_prompt_description");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_prompt_install_button_color");
			register_setting("pnfpb_icfcm_pwa", "pnfpb_ic_pwa_prompt_install_text_color");
			register_setting("pnfpb_icfcm_pwa", "pnfpb-pwa-dialog-app-installed_text");
			register_setting("pnfpb_icfcm_pwa", "pnfpb-pwa-dialog-app-installed_description");
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
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_unsubscribe_all_dialog_text");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_subscribe_dialog_text_confirm");
			register_setting("pnfpb_icfcm_buttons", "pnfpb_ic_fcm_unsubscribe_dialog_text_confirm");
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
			}
			
			
		}
		
		public function pnfpb_ic_fcm_post_timeschedule_callback($posted_options){
			
			if( $_POST['submit'] == 'Save Changes' ) {
			
				if (get_option('pnfpb_ic_fcm_post_schedule_enable') && get_option('pnfpb_ic_fcm_post_schedule_enable') == 1) {
			
			 		if ( !wp_next_scheduled( 'PNFPB_cron_post_hook' ) ) {
    					wp_schedule_event( time(), $posted_options, 'PNFPB_cron_post_hook' );
					}
					else 
					{
						$timestamp = wp_next_scheduled( 'PNFPB_cron_post_hook' );
						wp_unschedule_event( $timestamp, 'PNFPB_cron_post_hook' );
						wp_schedule_event( time(), $posted_options, 'PNFPB_cron_post_hook' );										
					}
				}
				else 
				{
					if ( wp_next_scheduled( 'PNFPB_cron_post_hook' ) ) {
						$timestamp = wp_next_scheduled( 'PNFPB_cron_post_hook' );
						wp_unschedule_event( $timestamp, 'PNFPB_cron_post_hook' );					
					}
				}
			}
			return $posted_options;
			
		}
		
		public function pnfpb_ic_fcm_buddypressactivities_timeschedule_callback($posted_options){
			
			if( $_POST['submit'] == 'Save Changes' ) {
				
				if (get_option('pnfpb_ic_fcm_buddypressactivities_schedule_enable') && get_option('pnfpb_ic_fcm_buddypressactivities_schedule_enable') == 1) 			  {
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
			}
			return $posted_options;
		}
		
		public function pnfpb_ic_fcm_buddypresscomments_timeschedule_callback($posted_options){
			
			if( $_POST['submit'] == 'Save Changes' ) {
				
				if (get_option('pnfpb_ic_fcm_buddypresscomments_schedule_enable') && get_option('pnfpb_ic_fcm_buddypresscomments_schedule_enable') == 1) {
			
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
			$filename = '/admin/js/pnfpb_ic_upload_icon.js';
			wp_register_script('pnfpb_ic_upload_icon_script',plugins_url( $filename, __FILE__ ), array('jquery'), '1.30.0', true);
			wp_enqueue_script('pnfpb_ic_upload_icon_script');
			$filename = '/admin/js/pnfpb_ic_pwa_upload_icon.js';
			wp_register_script('pnfpb_ic_pwa_upload_icon_script',plugins_url( $filename, __FILE__ ), array('jquery'), '1.0.0', true);
			wp_enqueue_script('pnfpb_ic_pwa_upload_icon_script');
			$filename = '/admin/js/pnfpb_ic_ondemand_push_upload_image.js';
			wp_register_script('pnfpb_ic_ondemand_push_upload_image_script',plugins_url( $filename, __FILE__ ), array('jquery'), '1.0.0', true);
			wp_enqueue_script('pnfpb_ic_ondemand_push_upload_image_script');				
		}   


		/**
		* Create service worker file on fly(dynamically) which is needed for push notification using FCM
		*
		* @since 1.0.0
		*/
		public function PNFPB_icpush_sw_file_create() {
			include(plugin_dir_path(__FILE__) . 'public/service_worker/pnfpb_create_sw_file.php');
			//$this->PNFPB_icfm_check_serviceworker_and_manifest();
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
		if (!wp_next_scheduled( 'PNFPB_cron_post_hook' ))
		{
			$from = get_bloginfo('name');
			$post_type = $post->post_type;

			if(get_option('pnfpb_ic_fcm_'.$post_type.'_enable')) {
				$postlink = get_permalink($post->ID);
				//new post/page
				if (isset($post->post_status)) {

					if ($post->post_status == 'publish') {
						
                        if (get_option('pnfpb_ic_fcm_'.$post_type.'_enable') == 1) {
							$this->PNFPB_icforum_push_notifications_post_web($post->post_title,$post->post_content,$postlink,$post->ID);
                        }
                        
					}

				}
			}
		}
		else
		{
			// update latest post title,content,link in the option to send push notification later as per scheduled time
			if ($post)
			{
				update_option('pnfpb_ic_fcm_new_post_id',$post->ID);
				update_option('pnfpb_ic_fcm_new_post_title',$post->post_title);
				update_option('pnfpb_ic_fcm_new_post_content',$post->post_content);
				update_option('pnfpb_ic_fcm_new_post_link',get_permalink($post->ID));
				
				$imageurl = '';
				
				if ( has_post_thumbnail($post->ID) ) {
					$imageurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
					update_option('pnfpb_ic_fcm_new_post_image',$imageurl);
				}
				else 
				{
					
					preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($post->post_content), $imgresult);
				
					if (is_array($imgresult)) {
						if (count($imgresult) > 0) {
							$imageurl = str_replace('"','',$imgresult[2][0]);
							update_option('pnfpb_ic_fcm_new_post_image',$imageurl);
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
		public function PNFPB_icforum_push_notifications_post_web ($post_title=null,$post_content=null, $postlink=null,$postid=null) {

			global $wpdb;
			$imageurl = '';
			
			if ($post_title === null || wp_next_scheduled( 'PNFPB_cron_post_hook' )){
				// if it is called from scheduled hook for post cron schedule
				$post_title = "New contents available in ".get_bloginfo( 'name' );
				$post_content - "New posts available in ".get_bloginfo( 'name' );
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
						if (count($imgresult) > 0) {
							$imageurl = str_replace('"','',$imgresult[2][0]);
						}
					}					
				}
				
				
			}

			$apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
			
			if ($apiaccesskey != '' && $apiaccesskey != false) {
	
			    $table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

				if (get_option('pnfpb_shortcode_enable') === 'yes') {
					$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND (subscription_option = '01000' OR subscription_option = '01100' OR subscription_option = '01010' OR subscription_option = '10000')" );
				}
				else
				{
			    	$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%'" );
				}
	
			    $url = 'https://fcm.googleapis.com/fcm/send';

			    $regid = $deviceids;
	
			    $activity_content_push = strip_tags(urldecode($post_content));

			    $iconurl = get_option ('pnfpb_ic_fcm_upload_icon');

			    // prepare the message
			    $message = array( 
				    'title'     => $post_title,
				    'body'      => substr(stripslashes(strip_tags($activity_content_push)),0,59),
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

			if ((($activity_content && !wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' )) || (!$activity_content && wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' )))  && (get_option('pnfpb_ic_fcm_buddypress_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false)) {

				global $wpdb;

				$activitylink = get_home_url();
				if (function_exists('bp_is_active')){
					$activitylink = get_home_url().'/'.buddypress()->pages->activity->slug;
				}
				
				if ($activity_id) {
					$activitylink = bp_activity_get_permalink($activity_id);
				}
	
				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
				
				if (get_option('pnfpb_shortcode_enable') === 'yes') {
					
					$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (subscription_option = '01000' OR subscription_option = '01100' OR subscription_option = '01010' OR subscription_option = '10000')" );
				}
				else 
				{
					$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%'" );
				}
				
				$url = 'https://fcm.googleapis.com/fcm/send';

				$regid = $deviceids;
    
				$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
            
				$blog_title = get_bloginfo( 'name' );
				
				$localactivitycontent = $activity_content;
				if ($activity_content) {
					$localactivitycontent = $activity_content;
				}
				else 
				{
					$localactivitycontent = "New contents available in ".get_bloginfo( 'name' );
				}				
				$imageurl = '';
            
				if (get_option('pnfpb_ic_fcm_activity_title') != false && get_option('pnfpb_ic_fcm_activity_title') != '') {
					$activitytitle = get_option('pnfpb_ic_fcm_activity_title');
				}
				else
				{
					$activitytitle = 'New activity post in '.$blog_title;
				}
				
				if (!get_option('pnfpb_ic_fcm_new_buddypressactivities_content')) {
					if ($activity_content) {
						$localactivitycontent = $activity_content;
					}
					else 
					{
						$localactivitycontent = "New contents available in ".get_bloginfo( 'name' );
					}
				}
				else 
				{
					if ($activity_content === null && wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' )){
						$localactivitycontent = get_option('pnfpb_ic_fcm_new_buddypressactivities_content');
						$activitylink = get_option('pnfpb_ic_fcm_new_buddypressactivities_link');
						$imageurl = get_option('pnfpb_ic_fcm_new_buddypressactivities_image');
					}
				}	
				
				if ($localactivitycontent) {
					preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($localactivitycontent), $imgresult);
					
				
					if (is_array($imgresult)) {
						if (count($imgresult) > 0) {
							$imageurl = str_replace('"','',$imgresult[2][0]);
							$imageurl = stripslashes($imageurl);
						}
					}
				}
    
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
				
	
			}
			else 
			{
				if ($activity_content && wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' )) {
					update_option('pnfpb_ic_fcm_new_buddypressactivities_content',$activity_content);
					update_option('pnfpb_ic_fcm_new_buddypressactivities_link',bp_activity_get_permalink($activity_id));
					
					preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($activity_content), $imgresult);
				
					$imageurl = '';
				
					if (is_array($imgresult)) {
						if (count($imgresult) > 0) {
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
			
			global $wpdb;
        
			if ((($content && !wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' )) || ($content===null && wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' ))) && (get_option('pnfpb_ic_fcm_buddypress_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false)) {

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
				
				if (get_option('pnfpb_shortcode_enable') === 'yes') {
					
					$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (subscription_option = '01000' OR subscription_option = '01100' OR subscription_option = '01010' OR subscription_option = '10000')" );
					
				}
				else				
				{
					$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1)  FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%'" );
				}
	
				$url = 'https://fcm.googleapis.com/fcm/send';

				$regid = $deviceids;
    
				$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
				
				if ($content) {
					$localactivitycontent = $content;
				}
				else 
				{
					$localactivitycontent = "New contents available in ".get_bloginfo( 'name' );
				}
            
				$blog_title = get_bloginfo( 'name' );
            
				if (get_option('pnfpb_ic_fcm_group_activity_title') != false && get_option('pnfpb_ic_fcm_group_activity_title') != '') {
					$grouptitle = get_option('pnfpb_ic_fcm_group_activity_title');
				}
				else
				{
					$grouptitle = 'New group post in '.$blog_title;
				}
					
				if (!get_option('pnfpb_ic_fcm_new_buddypressactivities_content')) {
						if ($content) {
							$localactivitycontent = $content;
						}
						else 
						{
							$localactivitycontent = "New contents available in ".get_bloginfo( 'name' );
						}
					$grouplink = get_home_url();
					if (function_exists('bp_is_active')){
						$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;
					}					
				}
				else 
				{
					if ($content===null && wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' )){
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
						if (count($imgresult) > 0) {
							$imageurl = str_replace('"','',$imgresult[2][0]);
						}
					}
				}
    
				// prepare the message
				$message = array( 
					'title'     => $grouptitle,
					'body'      => substr(stripslashes(strip_tags($localactivitycontent)),0,59),
					'icon'		=> $iconurl,
					'image'		=> $imageurl,
					'click_action' => $grouplink,

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
			else
			{
				if ((($content && !wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' )) || ($content===null && wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' ) && get_option('pnfpb_ic_fcm_new_buddypressgroup_id'))) && (get_option('pnfpb_ic_fcm_buddypress_enable') == 2 && $apiaccesskey != '' && $apiaccesskey != false)) {
					
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
					
					if (get_option('pnfpb_shortcode_enable') === 'yes') {
						
							$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!{$bpgroupid}!!%' AND (subscription_option = '01000' OR subscription_option = '01100' OR subscription_option = '01010' OR subscription_option = '10000')" );
						
					}
					else				
					{					
	
						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!{$bpgroupid}!!%'" );
					}

					$url = 'https://fcm.googleapis.com/fcm/send';

					$regid = $deviceids;
    
					$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
            
					$blog_title = get_bloginfo( 'name' );
            
					if (get_option('pnfpb_ic_fcm_group_activity_title') != false && get_option('pnfpb_ic_fcm_group_activity_title') != '') {
						$grouptitle = get_option('pnfpb_ic_fcm_group_activity_title');
					}
					else
					{
						$grouptitle = 'New group post in '.$blog_title;
					}
					
					if ($content) {
						$localactivitycontent = $content;
					}
					else 
					{
						$localactivitycontent = "New contents available in ".get_bloginfo( 'name' );
					}
					
					if (!get_option('pnfpb_ic_fcm_new_buddypressactivities_content') && wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' ))
					{
						if ($content) {
							$localactivitycontent = $content;
						}
						else 
						{
							$localactivitycontent = "New contents available in ".get_bloginfo( 'name' );
						}
						
						$grouplink = get_home_url();
						if (function_exists('bp_is_active')){
							$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;
						}						
					}
					else 
					{
							if ($content===null && wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' )){
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
					if (count($imgresult) > 0) {
						$imageurl = str_replace('"','',$imgresult[2][0]);
					}
				}					
    
					// prepare the message
					$message = array( 
						'title'     => $grouptitle,
						'body'      => substr(stripslashes(strip_tags($localactivitycontent)),0,59),
						'icon'		=> $iconurl,
						'image'		=> $imageurl,
						'click_action' => $grouplink,

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
				else 
				{
					if ($content && wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' )) {
						update_option('pnfpb_ic_fcm_new_buddypressactivities_content',$content);
						update_option('pnfpb_ic_fcm_new_buddypressactivities_link',bp_activity_get_permalink($activity_id));
						update_option('pnfpb_ic_fcm_new_buddypressgroup_link',get_home_url().'/'.buddypress()->pages->activity->slug);
						update_option('pnfpb_ic_fcm_new_buddypressgroup_id',$group_id);
						preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($content), $imgresult);
				
						$imageurl = '';
				
						if (is_array($imgresult)) {
							if (count($imgresult) > 0) {
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
		
				if ( empty( $recipients ) ) {
					return;
				}

				$sender_name = bp_core_get_user_displayname( $sender_id );

				if ( isset( $message ) ) {
					$message = wpautop( $message );
				} else {
					$message = '';
				}

				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
				$url = 'https://fcm.googleapis.com/fcm/send';

				$activity_content_push = strip_tags(urldecode($message));
				
				$notificationtitle = $sender_name.' sent you private message';
				
				$titletext = get_option('pnfpb_ic_fcm_bprivatemessage_text');
				
				if ( $titletext && $titletext !== '') {
					$notificationtitle = str_replace("[sender name]", $sender_name, $titletext);
				}
				
				$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
	
				// Send an email to each recipient.
				foreach ( $recipients as $recipient ) {

					$messageurl = esc_url( bp_core_get_user_domain( $recipient->user_id ).bp_get_messages_slug().'/view/'.$thread_id.'/');

					$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND userid = '{$recipient->user_id}'"  );


				if (strpos($activity_content_push, "[bpfb_images]") !== false) {
    
					$bpfbimagesstart = strpos($activity_content_push, "[bpfb_images]");
    
					$bpfbimagesend = strrpos($activity_content_push, "[/bpfb_images]");
    
					$bpfbimagestaglength = ($bpfbimagesend+17) - $bpfbimagesstart;
    
					$activity_content_push = strip_tags(urldecode(substr_replace($content,"",$bpfbimagesstart,$bpfbimagestaglength)));
				}
					
					preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($message), $imgresult);
					$imageurl = '';
				
					if (is_array($imgresult)) {
						if (count($imgresult) > 0) {
							$imageurl = str_replace('"','',$imgresult[2][0]);
						}
					}

					if (count($deviceids) > 0) {

						$regid = $deviceids;

						// prepare the message
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
				
            
			if (($comment_ID && !wp_next_scheduled( 'PNFPB_cron_comments_post_hook' )) || ($comment_ID === null && wp_next_scheduled( 'PNFPB_cron_comments_post_hook' )) && get_option('pnfpb_ic_fcm_bcomment_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false) {
				
				
				if ($comment_ID === null ) {
				
					$comment_ID = get_option('pnfpb_ic_fcm_new_comment_id');
				
					$comment_approved = get_option('pnfpb_ic_fcm_new_comment_approved');
				}
				
		
				if( 1 === $comment_approved ) {
			
					$commentData = get_comment($comment_ID);
					
					$postData = get_post($commentData->comment_post_ID);
					
					$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
				
					if (get_option('pnfpb_shortcode_enable') === 'yes') {
	
						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND (subscription_option = '01100' OR subscription_option = '00100' OR subscription_option = '10000')" );
					
					}
					else				
					{
						
						$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%'" );
					}
				
					/* Logic to get subscribers who subscribed only comments made on my posts */
				
					$deviceidsmypost = [];
				
					$postuserid = 0;
				
					if ( !wp_next_scheduled( 'PNFPB_cron_comments_post_hook' ) )
					{				
				
						if ($comment_ID && $comment_ID !== null) {
							
							$postuserid = $postData->post_author;
							
						}
					}
					else 
					{
						if ( get_option('pnfpb_ic_fcm_new_comments_post_userid' )) {
						
							$postuserid = get_option('pnfpb_ic_fcm_new_comments_post_userid' );
						
						}
					}
				
					if (get_option('pnfpb_shortcode_enable') === 'yes') {
						$deviceidsmypost=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid = {$postuserid} AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND (subscription_option = '01010' OR subscription_option = '00010')" );

					}
				
					$mergeddeviceids = array_merge($deviceids,$deviceidsmypost);
	
					$url = 'https://fcm.googleapis.com/fcm/send';

					$regid = $mergeddeviceids;
				
    
					$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
            
					$blog_title = get_bloginfo( 'name' );
            
					$commenttitle = 'New comment for post - '.$postData->post_title;
				
					$localpostcontent = $commentData->comment_content;
					
					$postcommentlink = get_permalink($postData->ID);
				
								
					preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($localpostcontent), $imgresult);
					$imageurl = '';
				
					if (is_array($imgresult)) {
						if (count($imgresult) > 0) {
							$imageurl = str_replace('"','',$imgresult[2][0]);
						}
					}				
				

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
			}
			else 
			{
				if ($comment_id && wp_next_scheduled( 'PNFPB_cron_comments_post_hook' )) {
					
					$commentData = get_comment($comment_ID);
					
					$postData = get_post($commentData->comment_post_ID);
					
					$post_content_push = "New comments for post - ".$postData->post_title;
				
					$postuserid = $postData->post_author;
					
					$postlink = get_permalink($postData->ID);
					
					update_option('pnfpb_ic_fcm_new_comment_id',$comment_ID);
					
					update_option('pnfpb_ic_fcm_new_comment_approved',$comment_approved);
				
					update_option('pnfpb_ic_fcm_new_comments_post_content',$post_content_push);
					
					update_option('pnfpb_ic_fcm_new_comments_post_link',$postlink);
					
					update_option('pnfpb_ic_fcm_new_comments_post_userid',$postuserid);
					
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
            
			if (($comment_id && !wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' )) || ($comment_id===null && wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' )) && get_option('pnfpb_ic_fcm_bcomment_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false) {

				global $wpdb;
				
				$activity_content_push = "New comments posted in ".get_bloginfo( 'name' );
				
				$activitylink = get_home_url();
				if (function_exists('bp_is_active')){
					$activitylink = get_home_url().'/'.buddypress()->pages->activity->slug;
				}				
				
				if ($comment_id) {
					extract( $params, EXTR_SKIP );
	
					$activity_content_push = strip_tags(urldecode($content));
	
					$activitylink = bp_activity_get_permalink( $activity_id );
				}				
	

				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
				
				if (get_option('pnfpb_shortcode_enable') === 'yes') {
	
					$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND (subscription_option = '01100' OR subscription_option = '00100' OR subscription_option = '10000')" );
					
				}
				else				
				{
					$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%'" );
				}
				
				/* Logic to get subscribers who subscribed only comments made on my activities */
				
				$deviceidsmyactivities = [];
				
				$activityuserid = 0;
				
				if ( !wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' ) )
				{				
				
					if ($activity && $activity !== null) {
						$activityuserid = $activity->user_id;
					}
				}
				else 
				{
					if ( get_option('pnfpb_ic_fcm_new_buddypresscomments_activityuserid' )) {
						$activityuserid = get_option('pnfpb_ic_fcm_new_buddypresscomments_activityuserid' );
					}
				}
				
				if (get_option('pnfpb_shortcode_enable') === 'yes') {
	
					$deviceidsmyactivities=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid = {$activityuserid} AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND (subscription_option = '01010' OR subscription_option = '00010')" );
					
				}
				
				$mergeddeviceids = array_merge($deviceids,$deviceidsmyactivities);
	
				$url = 'https://fcm.googleapis.com/fcm/send';

				$regid = $mergeddeviceids;
				

    
				if (strpos($content, "[bpfb_images]") !== false) {
    
					$bpfbimagesstart = strpos($content, "[bpfb_images]");
    
					$bpfbimagesend = strrpos($content, "[/bpfb_images]");
    
					$bpfbimagestaglength = ($bpfbimagesend+17) - $bpfbimagesstart;
    
					$activity_content_push = strip_tags(urldecode(substr_replace($content,"",$bpfbimagesstart,$bpfbimagestaglength)));
				}

				
    
				$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
            
				$blog_title = get_bloginfo( 'name' );
            
				if (get_option('pnfpb_ic_fcm_comment_activity_title') != false && get_option('pnfpb_ic_fcm_comment_activity_title') != '') {
					$commenttitle = get_option('pnfpb_ic_fcm_comment_activity_title');
				}
				else
				{
					$commenttitle = 'New comment for activity in '.$blog_title;
				}
				
				$localactivitycontent = $activity_content_push;
				
				if ($comment_id===null && wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' ) && get_option('pnfpb_ic_fcm_new_buddypresscomments_content')){
					$localactivitycontent = get_option('pnfpb_ic_fcm_new_buddypresscomments_content');
					$activitylink = get_option('pnfpb_ic_fcm_new_buddypresscomments_link');
				}	
				
				preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($localactivitycontent), $imgresult);
				$imageurl = '';
				
				if (is_array($imgresult)) {
					if (count($imgresult) > 0) {
						$imageurl = str_replace('"','',$imgresult[2][0]);
					}
				}				
				

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
			else 
			{
				if ($comment_id && wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' )) {
					$activity_content_push = "New contents available in ".get_bloginfo( 'name' );
				
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
				
				if ($activity && $activity !== null) {
					$activityuserid = $activity->user_id;
				}				
					update_option('pnfpb_ic_fcm_new_buddypresscomments_content',$activity_content_push);
					update_option('pnfpb_ic_fcm_new_buddypresscomments_link',$activitylink);
					
					update_option('pnfpb_ic_fcm_new_buddypresscomments_activityuserid',$activityuserid);
				}
			}			

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
			
					$unsubscribe_shortcode_dialog_text = 'Unsubscribe push notifications';
				
					if (get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text') && get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text') !== false && get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text') !== '') {
						$unsubscribe_shortcode_dialog_text = get_option('pnfpb_ic_fcm_unsubscribe_button_shortcode_text');
					}
				
					$subscribe_shortcode_dialog_text = 'Subscribe push notifications';
				
					if (get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text') && get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text') !== false && get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text') !== '') {
						$subscribe_shortcode_dialog_text = get_option('pnfpb_ic_fcm_subscribe_button_shortcode_text');
					}
			
					$subscribe_all_shortcode_dialog_text = 'Subscribe all notifications';
				
					if (get_option('pnfpb_ic_fcm_subscribe_all_dialog_text') && get_option('pnfpb_ic_fcm_subscribe_all_dialog_text') !== false && get_option('pnfpb_ic_fcm_subscribe_all_dialog_text') !== '') {
						$subscribe_all_shortcode_dialog_text = get_option('pnfpb_ic_fcm_subscribe_all_dialog_text');
					}
			
					$subscribe_post_activities_shortcode_dialog_text = 'Subscribe new post/new BuddyPress activity notifications';
				
					if (get_option('pnfpb_ic_fcm_subscribe_post_activity_dialog_text') && get_option('pnfpb_ic_fcm_subscribe_post_activity_dialog_text') !== false && get_option('pnfpb_ic_fcm_subscribe_post_activity_dialog_text') !== '') {
						$subscribe_post_activities_shortcode_dialog_text = get_option('pnfpb_ic_fcm_subscribe_post_activity_dialog_text');
					}
			
					$subscribe_all_comments_shortcode_dialog_text = 'Subscribe all new comments notifications';
				
					if (get_option('pnfpb_ic_fcm_subscribe_all_comments_dialog_text') && get_option('pnfpb_ic_fcm_subscribe_all_comments_dialog_text') !== false && get_option('pnfpb_ic_fcm_subscribe_all_comments_dialog_text') !== '') {
						$subscribe_all_comments_shortcode_dialog_text = get_option('pnfpb_ic_fcm_subscribe_all_comments_dialog_text');
					}
			
					$subscribe_mypost_comments_shortcode_dialog_text = 'Subscribe notifications on comments from my Posts/my BuddyPress activities';
				
					if (get_option('pnfpb_ic_fcm_subscribe_my_comments_dialog_text') && get_option('pnfpb_ic_fcm_subscribe_my_comments_dialog_text') !== false && get_option('pnfpb_ic_fcm_subscribe_my_comments_dialog_text') !== '') {
						$subscribe_mypost_comments_shortcode_dialog_text = get_option('pnfpb_ic_fcm_subscribe_my_comments_dialog_text');
					}
			
					$unsubscribe_all_shortcode_dialog_text = 'Un-Subscribe all notifications';
				
					if (get_option('pnfpb_ic_fcm_unsubscribe_all_dialog_text') && get_option('pnfpb_ic_fcm_unsubscribe_all_dialog_text') !== false && get_option('pnfpb_ic_fcm_unsubscribe_all_dialog_text') !== '') {
						$unsubscribe_all_shortcode_dialog_text = get_option('pnfpb_ic_fcm_unsubscribe_all_dialog_text');
					}			
	
		    $pnfpb_notification_shortcode =  '<div id="pnfpb-unsubscribe-notifications" class="pnfpb-unsubscribe-notifications">';
			
		    $pnfpb_notification_shortcode .= '<button type="button" id="pnfpb_unsubscribe_button" class="pnfpb_unsubscribe_button" style="color:'.$subscribe_button_text_color.';background-color:'.$subscribe_button_color.'">'.$unsubscribe_shortcode_dialog_text.'</button>';
		    
		    $pnfpb_notification_shortcode .= '<button type="button" id="pnfpb_subscribe_button" class="pnfpb_subscribe_button" style="color:'.$subscribe_button_text_color.';background-color:'.$subscribe_button_color.'">'.$subscribe_shortcode_dialog_text.'</button></div>';
		
	    
		    $pnfpb_notification_shortcode .= '<div id="pnfpb_subscribe_dialog_confirm" class="pnfpb_subscribe_dialog_confirm" title="Subscribe notification?"><div style="background:#eeeeee;float:left;width:100%;padding:5px;margin:5px;padding-bottom:0px;border:1px solid #eeeeee;"><div  style="width:5%;float:left;"><input id="pnfpb_ic_subscribe_all_shortcode_enable" name="pnfpb_ic_subscribe_all_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_all_shortcode_enable' ) ).'  /></div><div  style="width:95%;float:left;"> <label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_all_shortcode_enable" style="font-weight:400;">'.$subscribe_all_shortcode_dialog_text.'</label></div></div><div style="background:#eeeeee;float:left;width:100%;padding:5px;margin:5px;padding-bottom:0px;border:1px solid #eeeeee;"><div style="width:5%;float:left;"><input id="pnfpb_ic_subscribe_post_activities_shortcode_enable" name="pnfpb_ic_subscribe_post_activities_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_post_activities_shortcode_enable' ) ).'  /></div><div  style="width:95%;float:left;"> <label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_post_activities_shortcode_enable" style="font-weight:400;">'.$subscribe_post_activities_shortcode_dialog_text.'</label></div><div style="width:5%;float:left;"><input id="pnfpb_ic_subscribe_all_comments_shortcode_enable" name="pnfpb_ic_subscribe_all_comments_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_all_comments_shortcode_enable' ) ).'  /></div><div  style="width:95%;float:left;"> <label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_subscribe_all_comments_shortcode_enable" style="font-weight:400;">'.$subscribe_all_comments_shortcode_dialog_text.'</label></div></div><div style="background:#eeeeee;float:left;width:100%;padding:5px;margin:5px;padding-bottom:0px;border:1px solid #eeeeee;"><div style="width:5%;float:left;"><input id="pnfpb_ic_subscribe_my_post_shortcode_enable" name="pnfpb_ic_subscribe_my_post_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_subscribe_my_post_shortcode_enable' ) ).'  /></div><div  style="width:95%;float:left;"> <label class="pnfpb_ic_subscribe_my_post_shortcode_label_checkbox" for="pnfpb_ic_subscribe_my_post_shortcode_enable" style="font-weight:400;">'.$subscribe_mypost_comments_shortcode_dialog_text.'</label></div></div><div style="background:#eeeeee;float:left;width:100%;padding:5px;margin:5px;padding-bottom:0px;border:1px solid #eeeeee;"><div style="width:5%;float:left;"><input id="pnfpb_ic_unsubscribe_all_shortcode_enable" name="pnfpb_ic_unsubscribe_all_shortcode_enable" type="checkbox" value="1" '.checked( '1', get_option( 'pnfpb_ic_unsubscribe_all_shortcode_enable' ) ).'  /></div><div  style="width:95%;float:left;"> <label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_unsubscribe_all_shortcode_enable" style="font-weight:400;">'.$unsubscribe_all_shortcode_dialog_text.'</label></div></div></div>';
		
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
					if(!isset($_COOKIE[$cookie_name])) {
						$cookievalue = $_COOKIE['pnfpb_group_push_notification_'.$group->id];
					}
			
					$table = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
			
					$deviceid_select_status = $wpdb->query("SELECT * FROM {$table} WHERE device_id LIKE '%!!{$group->id}!!{$cookievalue}%'");
				
					$unsubscribe_button_text = 'Unubscribe push notifications';
				
					if (get_option('pnfpb_ic_fcm_unsubscribe_button_text') && get_option('pnfpb_ic_fcm_unsubscribe_button_text') !== false && get_option('pnfpb_ic_fcm_unsubscribe_button_text') !== '') {
						$unsubscribe_button_text = get_option('pnfpb_ic_fcm_unsubscribe_button_text');
					}
				
					$subscribe_button_text = 'Subscribe to push notifications';
				
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
			
			$encryption_key = get_option('PNFPB_icfcm_integrate_app_secret_code');
			
			$encrypted = $request['token'];
			
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
				//$receivedhasmac = $parts[2];

				//$bphasmac = hash_hmac('sha256',$decrypted, $key,true);
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
					
					$subscriptionoptions = '10000';
					
					foreach( $deviceid_select_status as $result ) {
						
						$subscriptionoptions = $result->subscription_option;
						
					}
					
					$bpnewdeviceid = $decrypted.'!!'.$request['groupid'].'!!'.$request['cookievalue'];
					
					$data = array('userid' => $bpuserid, 'device_id' => $bpnewdeviceid, 'subscription_option' => $subscriptionoptions);					
					
					$insertstatus = $wpdb->insert($table,$data);
					
					if (!$insertstatus || $insertstatus !== 0){
						
						$updatetokenresponse = 'subscribed'.$insertstatus.count($deviceid_select_status);
						
					}				
				}
				else 
				{
					
					if ($request['subscription-type'] === 'unsubscribe-group') {
					
						$bpolddeviceid = $decrypted.'!!'.$request['groupid'].'!!'.$request['cookievalue'];
		
		    			$deviceid_update_status = $wpdb->query("DELETE from {$table} WHERE userid = {$bpuserid} AND device_id = '{$bpolddeviceid}'") ;
					}
					else 
					{
						$data = array('userid' => $bpuserid, 'device_id' => $decrypted, 'subscription_option' => '10000');
				
						$deviceid_select_status = $wpdb->get_results("SELECT * FROM {$table} WHERE device_id LIKE '%".$decrypted."%'");
				
						$updatetokenresponse = 'fail';
						
						foreach( $deviceid_select_status as $result ) {
			
							if ($result->userid === 0 || $result->userid !== $bpuserid){

								$deviceid_update_status = $wpdb->query("UPDATE $table SET userid = {$bpuserid} WHERE device_id = '{$bpdeviceid}'") ;	
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
			
			//$parameters = $request->get_params();
			//print_r($parameters);
		}
		
		/**
		* To generate secret key to integrate app from admin area under plugin settings
		*
		*
		* @since 1.36
		*/
		public function PNFPB_icfcm_integrate_app() {
			global $wpdb;
			//$table = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
			//$data = array('userid' => 0, 'device_id' => 'test', 'subscription_option' => '10000');
			//$insertstatus = $wpdb->insert($table,$data);
			//print_r($insertstatus);
			if (isset($_POST["submit"])) {
				$bytes = random_bytes(16);
				update_option('PNFPB_icfcm_integrate_app_secret_code',bin2hex($bytes));
			}
			
		?>

		<h2 class="nav-tab-wrapper"><a href="options-general.php?page=pnfpb-icfcm-slug" class="nav-tab">Push notification</a><a href="options-general.php?page=pnfpb_icfm_device_tokens_list" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER);?></a><a href="options-general.php?page=pnfpb_icfm_pwa_app_settings" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_PWA_HEADER);?></a><a href="options-general.php?page=pnfpb_icfmtest_notification" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_ONDEMANDPUSH_HEADER);?></a><a href="options-general.php?page=pnfpb_icfm_button_settings" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_BUTTON_HEADER);?></a><a href="options-general.php?page=pnfpb_icfm_integrate_app" class="nav-tab nav-tab-active"><?php echo 'API to integrate mobile app';?></a></h2>

			<h2 class="pnfpb_ic_push_settings_header2"><?php echo 'Generate secret key for Android/Ios app integration';?></h2>
			<h5 class="pnfpb_ic_push_settings_header2"><?php echo 'This secret key will be used to get subscription token in secured manner from Android/Ios app to store it in WordPress Database table to send push notifications for app users';?></h5>
			<h5 class="pnfpb_ic_push_settings_header2"><?php echo 'Use this secret key in http post request using this rest api from app';?></h5>

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