<?php
/*
Plugin Name: Push Notification for Post and BuddyPress
Plugin URI: https://www.indiacitys.com
Description: Push notification for Post, custom post types and for BuddyPress activities using Firebase. Update Firebase configuration details in <a href="options-general.php?page=pnfpb-icfcm-slug"><strong>settings page</strong></a>
Version: 1.20
Author: Muralidharan Ramasamy
Author URI: https://www.indiacitys.com
Text Domain: PNFPB_TD
Updated: 10 Oct 2021
*/
/**
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Copyright (c) <2020> <Muralidharan Ramasamy>
 *
 *
 * @author    Murali
 * @copyright 2020 Indiacitys.com Technologies private limited, Coimbatore, India
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
if (!defined("PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER")) define("PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER", 'Device tokens list');
if (!defined("PNFPB_PLUGIN_NM_SETTINGS")) define("PNFPB_PLUGIN_NM_SETTINGS", 'PNFPB - Settings for Push Notification');
if (!defined("PNFPB_PLUGIN_NM_DEVICE_TOKENS")) define("PNFPB_PLUGIN_NM_DEVICE_TOKENS", 'PNFPB - Device tokens list');
if (!defined("PNFPB_PLUGIN_NM_DEVICE_TOKENS_LIST_HEADER")) define("PNFPB_PLUGIN_NM_DEVICE_TOKENS_LIST_HEADER", 'List of device tokens registered for push notification');
if (!defined("PNFPB_PLUGIN_NM_DEVICE_TOKENS_LIST_DETAILS")) define("PNFPB_PLUGIN_NM_DEVICE_TOKENS_LIST_DETAILS", '(Do not delete tokens unneccessarily it will result in user will not receive push notification, unless it is needed, avoid deleting tokens )');
if (!defined("PNFPB_PLUGIN_NM_PWA_HEADER")) define("PNFPB_PLUGIN_NM_PWA_HEADER", 'PWA app settings');
if (!defined("PNFPB_PLUGIN_NM_PWA_SETTINGS")) define("PNFPB_PLUGIN_NM_PWA_SETTINGS", 'PWA Progressive web app settings');
if (!defined("PNFPB_PLUGIN_PWA_SETTINGS")) define("PNFPB_PLUGIN_PWA_SETTINGS", 'Below settings are to generate Progressive Web App(PWA) with offline facility');
if (!defined("PNFPB_PLUGIN_PWA_SETTINGS_DESCRIPTION")) define("PNFPB_PLUGIN_PWA_SETTINGS_DESCRIPTION", 'All below fields are required to generate Progressive Web App (PWA). Additionally, Enable/disable PWA app by selecting appropriate check box and Enter appropriate URLs to store in cache for offline PWA app, selected pages can be viewed in offline without internet. In offline mode, if page is not available/stored in cache then 404 offline page will be displayed');
if (!defined("PNFPB_PLUGIN_ENABLE_PUSH")) define("PNFPB_PLUGIN_ENABLE_PUSH", 'Enable/Disable push notifications for following types');
if (!defined("PNFPB_PLUGIN_SCHEDULE_PUSH")) define("PNFPB_PLUGIN_SCHEDULE_PUSH", '(if scheduled, push notification will be sent as per selected schedule otherwise it will be sent whenever new item is posted. BuddyPress notifications only when BuddyPress plugin is installed and active)');
if (!defined("PNFPB_PLUGIN_FIREBASE_SETTINGS")) define("PNFPB_PLUGIN_FIREBASE_SETTINGS", 'Firebase configuration');
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
        
			// Add a link to the plugin's settings and/or network admin settings in the plugins list table.
			add_filter( 'plugin_action_links', array($this, $this->pre_name .'add_settings_link' ), 10, 2 );
			add_filter( 'network_admin_plugin_action_links', array($this, $this->pre_name .'add_settings_link' ), 10, 2 );

			wp_enqueue_script("jquery");
			
			wp_enqueue_script("jquery-ui-dialog");
		
			//Enqueue needed scripts for frontend and for admin area
			add_action( 'wp_enqueue_scripts', array($this, $this->pre_name .'ic_push_notification_scripts') );
			add_action( 'admin_enqueue_scripts', array($this, $this->pre_name .'ic_push_notification_scripts') );
		
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
		
			//Push notification(if enabled) for post and custom post types based on plugin settings
			add_action('save_post', array($this, $this->pre_name . 'on_post_save_web'),5, 3);
			
			// Scheduled push notification(if enabled) for post and custom post types
			add_action( $this->pre_name .'cron_post_hook', array($this, $this->pre_name . 'icforum_push_notifications_post_web'));
			
			//add manifest link for PWA app
			add_action( 'wp_head', array($this, $this->pre_name . 'include_manifest_link'));
			
			if ( function_exists('bp_is_active') ) {
				
		
				//Push notification(if enabled) for BuddyPress new acitivities based on plugin settings
				add_filter('bp_activity_posted_update', array($this,  $this->pre_name .'icforum_push_notifications_web'), 5, 3 );
			
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
			//add_shortcode( 'init', array($this,  $this->pre_name .'subscribe_push_notification_shortcode') );
		
	
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
	
            wp_enqueue_style( 'pnfpb-icpstyle-name', plugin_dir_url( __FILE__ ).'public/css/pnfpb_main.css' );
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

			if ($projectId != false && $projectId != '' && $publicKey != false && $publicKey != '' && $apiKey != false && $apiKey != '' && $messagingSenderId != false && $messagingSenderId != '') {
			    
				$filename = '/public/js/firebase-core/pnfpb_firebase_app.js';
				wp_enqueue_script( 'pnfpb-icajax-script-firebase-app', plugins_url( $filename, __FILE__ ));
	
				$filename = '/public/js/firebase-core/pnfpb_firebase_messaging.js';
				wp_enqueue_script( 'pnfpb-icajax-script-firebase-messaging', plugins_url( $filename, __FILE__ )); 
    
				$filename = '/public/js/pnfpb_pushscript_pwa.js';
				$ajaxobject = 'pnfpb_ajax_object_push';
				wp_enqueue_script( 'pnfpb-icajax-script-push', plugins_url( $filename, __FILE__ ), array( 'jquery' ));
				wp_localize_script( 'pnfpb-icajax-script-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'apiKey' => $apiKey, 'authDomain' => $authDomain, 'databaseURL' => $databaseUrl, 'projectId' => $projectId, 'storageBucket' => $storageBucket, 'messagingSenderId' => $messagingSenderId, 'appId' => $appId, 'publicKey' => $publicKey, 'homeurl' => $homeurl) );
				
				$filename = '/public/js/pnfpb_unsubscribe_pushscript_pwa.js';
				$ajaxobject = 'pnfpb_ajax_object_unsubscribe_push';
				wp_enqueue_script( 'pnfpb-icajax-script-unsubscribe-push', plugins_url( $filename, __FILE__ ), array( 'jquery' ));
				wp_localize_script( 'pnfpb-icajax-script-unsubscribe-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'publicKey' => $publicKey, 'homeurl' => $homeurl) );
				
				$filename = '/public/js/pnfpb_group_pushscript_pwa.js';
				$ajaxobject = 'pnfpb_ajax_object_group_push';
				wp_enqueue_script( 'pnfpb-icajax-script-group-push', plugins_url( $filename, __FILE__ ), array( 'jquery' ));
				wp_localize_script( 'pnfpb-icajax-script-group-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'groupId' => '9', 'publicKey' => $publicKey, 'homeurl' => $homeurl) );
				
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
				, __('Test Notification', PNFPB_TD)// -> Page Title
				, 'Test Notification'    // -> Title that would otherwise appear in the menu
				, 'administrator' // -> Capability level
				, 'pnfpb_icfmtest_notification'   // -> Still accessible via admin.php?page=menu_handle
				, array($this, $this->pre_name.'icfcm_test_notification') // -> To render the page
			);
		}
		
		/**
		* To Test push notification from admin area under plugin settings
		*
		*
		* @since 1.0.0
		*/
		public function PNFPB_icfcm_test_notification(){
			$content = 'Test Notification using Push notification using PNFPB FCM Plugin';
        
			$homeurl = $url = home_url( '/' );

			$result = $this->PNFPB_icforum_push_notifications_post_web($content,"",$homeurl);

			echo '<div class="row">';
			echo '<div><h2>Message sent</h2>';

			echo '<p><a href="'. admin_url('admin.php').'?page=pnfpb-icfcm-slug">Back</a></p>';

			echo '</div>';
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
			<h2 class="nav-tab-wrapper"><a href="options-general.php?page=pnfpb-icfcm-slug" class="nav-tab">Push notification settings</a><a href="options-general.php?page=pnfpb_icfm_device_tokens_list" class="nav-tab nav-tab-active"><?php echo __(PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_pwa_app_settings" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_PWA_HEADER);?></a></h2>
			<h1 class="pnfpb_ic_push_settings_header"><?php echo __(PNFPB_PLUGIN_NM_DEVICE_TOKENS,PNFPB_TD);?></h1>
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
				}
				else 
				{
					if ( wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' ) ) {
						$timestamp = wp_next_scheduled( 'PNFPB_cron_buddypresscomments_hook' );
						wp_unschedule_event( $timestamp, 'PNFPB_cron_buddypresscomments_hook' );					
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
			wp_enqueue_media();
			$filename = '/admin/js/pnfpb_ic_upload_icon.js';
			wp_register_script('pnfpb_ic_upload_icon_script',plugins_url( $filename, __FILE__ ), array('jquery'), '1.0.0', true);
			wp_enqueue_script('pnfpb_ic_upload_icon_script');
			$filename = '/admin/js/pnfpb_ic_pwa_upload_icon.js';
			wp_register_script('pnfpb_ic_pwa_upload_icon_script',plugins_url( $filename, __FILE__ ), array('jquery'), '1.0.0', true);
			wp_enqueue_script('pnfpb_ic_pwa_upload_icon_script');			
		}   


		/**
		* Create service worker file on fly(dynamically) which is needed for push notification using FCM
		*
		* @since 1.0.0
		*/
		public function PNFPB_icpush_sw_file_create() {
			include(plugin_dir_path(__FILE__) . 'public/service_worker/pnfpb_create_sw_file.php');
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
							$this->PNFPB_icforum_push_notifications_post_web($post->post_title,$post->post_content,$postlink);
                        }
                        
					}

				}
			}
		}
		else
		{
			// update latest post title,content,link in the option to send push notification later as per scheduled time
			if ($post){
				update_option('pnfpb_ic_fcm_new_post_title',$post->post_title);
				update_option('pnfpb_ic_fcm_new_post_content',$post->post_content);
				update_option('pnfpb_ic_fcm_new_post_link',get_permalink($post->ID));
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
		public function PNFPB_icforum_push_notifications_post_web ($post_title=null,$post_content=null, $postlink=null) {

			global $wpdb;
			
			if ($post_title === null || wp_next_scheduled( 'PNFPB_cron_post_hook' )){
				// if it is called from scheduled hook for post cron schedule
				$post_title = "New contents available in ".get_bloginfo( 'name' );
				$post_content - "New posts available in ".get_bloginfo( 'name' );
				$postlink = get_home_url();
				if (get_option('pnfpb_ic_fcm_new_post_title')){
					$post_title = get_option('pnfpb_ic_fcm_new_post_title');
				}
				if (get_option('pnfpb_ic_fcm_new_post_content')){
					$post_content = get_option('pnfpb_ic_fcm_new_post_content');
				}
				if (get_option('pnfpb_ic_fcm_new_post_title')){
					$postlink = get_option('pnfpb_ic_fcm_new_post_link');
				}				
			}			

			$apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
			
			if ($apiaccesskey != '' && $apiaccesskey != false) {
	
			    $table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
			    $deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%'" );
	
			    $url = 'https://fcm.googleapis.com/fcm/send';

			    $regid = $deviceids;
	
			    $activity_content_push = strip_tags(urldecode($post_content));
    
			    if (strpos($post_content, "[bpfb_images]") !== false) {
    
				    $bpfbimagesstart = strpos($post_content, "[bpfb_images]");
    
				    $bpfbimagesend = strrpos($post_content, "[/bpfb_images]");
    
				    $bpfbimagestaglength = ($bpfbimagesend+17) - $bpfbimagesstart;
    
				    $activity_content_push = strip_tags(urldecode(substr_replace($post_content,"",$bpfbimagesstart,$bpfbimagestaglength)));
			    }
    
			    $iconurl = get_option ('pnfpb_ic_fcm_upload_icon');

			    // prepare the message
			    $message = array( 
				    'title'     => $post_title,
				    'body'      => $activity_content_push,
				    'icon'		=> $iconurl,
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
				if (array_key_exists('results', $bodyresults)) {
					foreach ($bodyresults['results'] as $idx=>$result){
						if (array_key_exists('error',$result)) {
							if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
									$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
	
				$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%'" );
				
				$url = 'https://fcm.googleapis.com/fcm/send';

				$regid = $deviceids;
    
				$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
            
				$blog_title = get_bloginfo( 'name' );
				
				$localactivitycontent = $activity_content;

            
				if (get_option('pnfpb_ic_fcm_activity_title') != false && get_option('pnfpb_ic_fcm_activity_title') != '') {
					$activitytitle = get_option('pnfpb_ic_fcm_activity_title');
				}
				else
				{
					$activitytitle = 'New activity post in '.$blog_title;
				}
				
				if (!get_option('pnfpb_ic_fcm_new_buddypressactivities_content')) {
					$localactivitycontent = "New contents available in ".get_bloginfo( 'name' );
				}
				else 
				{
					if ($content===null && wp_next_scheduled( 'PNFPB_cron_buddypressactivities_hook' )){
						$localactivitycontent = get_option('pnfpb_ic_fcm_new_buddypressactivities_content');
						$activitylink = get_option('pnfpb_ic_fcm_new_buddypressactivities_link');
					}
				}				
    
				// prepare the message
				$message = array( 
					'title'     => $activitytitle,
					'body'      => $localactivitycontent,
					'icon'		=> $iconurl,
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

				if (array_key_exists('results', $bodyresults)) {
					foreach ($bodyresults['results'] as $idx=>$result){
						if (array_key_exists('error',$result)) {
							if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
									$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
				}
			}
	

			return $activity_content;
	    
	    
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
	
				$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1)  FROM {$table_name} WHERE device_id NOT LIKE '%@N%'" );
	
				$url = 'https://fcm.googleapis.com/fcm/send';

				$regid = $deviceids;
    
				$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
				
				$localactivitycontent = $content;
            
				$blog_title = get_bloginfo( 'name' );
            
				if (get_option('pnfpb_ic_fcm_group_activity_title') != false && get_option('pnfpb_ic_fcm_group_activity_title') != '') {
					$grouptitle = get_option('pnfpb_ic_fcm_group_activity_title');
				}
				else
				{
					$grouptitle = 'New group post in '.$blog_title;
				}
					
				if (!get_option('pnfpb_ic_fcm_new_buddypressactivities_content')) {
					$localactivitycontent = "New contents available in ".get_bloginfo( 'name' );
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
    
				// prepare the message
				$message = array( 
					'title'     => $grouptitle,
					'body'      => $localactivitycontent,
					'icon'		=> $iconurl,
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
				if (array_key_exists('results', $bodyresults)) {
					foreach ($bodyresults['results'] as $idx=>$result){
						if (array_key_exists('error',$result)) {
							if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
									$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
						//$bpgroup = groups_get_group( array( 'group_id' => $group_id) );
				
						//if (groups_is_user_member( bp_displayed_user_id(), $group_id )) {}
	
						$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;

						$bpgroupid = $group_id;

					}
					else 
					{
						$bpgroupid = strval(get_option('pnfpb_ic_fcm_new_buddypressgroup_id'));

						//$bpgroup = groups_get_group( array( 'group_id' => $bpgroupid) );

						$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;
	
					}
	
					$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
					$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!{$bpgroupid}!!%'" );

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
					
					$localactivitycontent = $content;
					
					if (!get_option('pnfpb_ic_fcm_new_buddypressactivities_content') && wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' )) {
						$localactivitycontent = "New contents available in ".get_bloginfo( 'name' );
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
    
					// prepare the message
					$message = array( 
						'title'     => $grouptitle,
						'body'      => $localactivitycontent,
						'icon'		=> $iconurl,
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
					if (array_key_exists('results', $bodyresults)) {
						foreach ($bodyresults['results'] as $idx=>$result){
							if (array_key_exists('error',$result)) {
								if ($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration' && strpos($regid[$idx], '!!') === false) {
									$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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

					if (count($deviceids) > 0) {

						$regid = $deviceids;

						// prepare the message
						$message = array( 
						'title'     => $notificationtitle,
						'body'      => $activity_content_push,
						'icon'		=> $iconurl,
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
						if (array_key_exists('results', $bodyresults)) {
							foreach ($bodyresults['results'] as $idx=>$result){
								if (array_key_exists('error',$result)) {
									if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
										$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
	

				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
				$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%'" );
	
				$url = 'https://fcm.googleapis.com/fcm/send';

				$regid = $deviceids;
				
				$activity_content_push = "New contents available in ".get_bloginfo( 'name' );
				
				$activitylink = get_home_url();
				if (function_exists('bp_is_active')){
					$activitylink = get_home_url().'/'.buddypress()->pages->activity->slug;
				}				
				
				if ($comment_id) {
					extract( $params, EXTR_SKIP );
	
					$activity_content_push = strip_tags(urldecode($content));
	
					$activitylink = bp_activity_get_permalink( $activity_id );
				}
    
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
				

				// prepare the message
				$message = array( 
					'title'     => $commenttitle,
					'body'      => $localactivitycontent,
					'icon'		=> $iconurl,
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
				if (array_key_exists('results', $bodyresults)) {
					foreach ($bodyresults['results'] as $idx=>$result){
						if (array_key_exists('error',$result)) {
							if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
									$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
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
					update_option('pnfpb_ic_fcm_new_buddypresscomments_content',$activity_content_push);
					update_option('pnfpb_ic_fcm_new_buddypresscomments_link',$activitylink);					
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
		
		    $pnfpb_notification_shortcode =  '<div id="pnfpb-unsubscribe-notifications" class="pnfpb-unsubscribe-notifications">';
			
		    $pnfpb_notification_shortcode .= '<button type="button" id="pnfpb_unsubscribe_button" class="pnfpb_unsubscribe_button">'.__( "Unsubscribe Push Notifications", "PNFPB_TD" ).'</button>';
		    
		    $pnfpb_notification_shortcode .= '<button type="button" id="pnfpb_subscribe_button" class="pnfpb_subscribe_button">'.__( "Subscribe Push Notifications", "PNFPB_TD" ).'</button></div>';
		
		    $pnfpb_notification_shortcode .= '<div id="pnfpb_unsubscribe_dialog_confirm" class="pnfpb_unsubscribe_dialog_confirm" title="Unsubscribe notification?"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Do you want to Unsubscribe push notification?</div>';
		    
		    $pnfpb_notification_shortcode .= '<div id="pnfpb_subscribe_dialog_confirm" class="pnfpb_subscribe_dialog_confirm" title="Subscribe notification?"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Do you want to Subscribe push notification?</div>';
		
		    $pnfpb_notification_shortcode .= '<div id="pnfpb-unsubscribe-dialog" title="Push notification status"><div id="pnfpb-unsubscribe-alert-msg" class="pnfpb-unsubscribe-alert-msg"></div></div>';
		    
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
			
					if ($deviceid_select_status > 0 && groups_is_user_member( $bpuserid, $group->id )) {
						// Setup button attributes.
        				$button = array(
            				'id'                => 'unsubscribe_notification_group',
            				'component'         => 'groups',
            				'must_be_logged_in' => true,
            				'block_self'        => false,
            				'wrapper_class'     => 'unsubscribegroupbutton subscribe-display-on',
            				'wrapper_id'        => 'unsubscribegroupbutton-' . $group->id,
            				'link_text'         => 'Remove push notifications',
            				'link_class'        => 'unsubscribe-notification-group subscribe-display-on unsubscribegroupbutton-' . $group->id,
							'button_element'    => 'button',
            				'button_attr' => array(
							'data-group-id'		=> $group->id,
							'data-user-id'		=> $bpuserid,
                			'data-title'           => __( 'Remove push notifications', 'buddyboss' ),
                			'data-title-displayed' => 'Remove push notifications'
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
            				'link_text'         => 'Remove push notifications',
            				'link_class'        => 'unsubscribe-notification-group subscribe-display-off unsubscribegroupbutton-' . $group->id,
							'button_element'    => 'button',
            				'button_attr' => array(
								'data-group-id'		=> $group->id,
								'data-user-id'		=> $bpuserid,
                				'data-title'           => __( 'Remove push notifications', 'buddyboss' ),
                				'data-title-displayed' => 'Remove push notifications'
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
            				'link_text'         => 'subscribe to push notifications',
            				'link_class'        => 'subscribe-notification-group subscribe-display-on subscribegroupbutton-' . $group->id,
							'button_element'    => 'button',
            				'button_attr' => array(
								'data-group-id'		=> $group->id,
								'data-user-id'		=> $bpuserid,
                				'data-title'           => __( 'Subscribe to push notifications', 'buddyboss' ),
                				'data-title-displayed' => 'subscribe to push notifications'
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
            					'link_text'         => 'subscribe to push notifications',
            					'link_class'        => 'subscribe-notification-group subscribe-display-off subscribegroupbutton-' . $group->id,
								'button_element'    => 'button',
            					'button_attr' => array(
									'data-group-id'		=> $group->id,
									'data-user-id'		=> $bpuserid,
                					'data-title'           => __( 'Subscribe to push notifications', 'buddyboss' ),
                					'data-title-displayed' => 'subscribe to push notifications'
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

	}

    $PNFPB_ICFM_Push_Notification_Post_BuddyPress_OBJ = new PNFPB_ICFM_Push_Notification_Post_BuddyPress();
	
	include(plugin_dir_path(__FILE__) . 'admin/pnfpb_icfcm_device_tokens_list.php');

}
else
{
    exit;
}




?>