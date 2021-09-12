<?php
/*
Plugin Name: Push Notification for Post and BuddyPress
Plugin URI: https://www.indiacitys.com
Description: Push notification for Post, custom post types and for BuddyPress activities using Firebase. Update Firebase configuration details in <a href="options-general.php?page=pnfpb-icfcm-slug"><strong>settings page</strong></a>
Version: 1.13
Author: Muralidharan Ramasamy
Author URI: https://www.indiacitys.com
Text Domain: PNFPB_TD
Updated: 13 Sep 2021
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
if (!defined("PNFPB_PLUGIN_NM_SETTINGS")) define("PNFPB_PLUGIN_NM_SETTINGS", 'PNFPB - Settings for Push Notification');
if (!defined("PNFPB_PLUGIN_ENABLE_PUSH")) define("PNFPB_PLUGIN_ENABLE_PUSH", 'Enable/Disable for following post types');
if (!defined("PNFPB_PLUGIN_FIREBASE_SETTINGS")) define("PNFPB_PLUGIN_FIREBASE_SETTINGS", 'Firebase configuration');
if (!defined("PNFPB_TD")) define("PNFPB_TD", 'pnfpb_td');


/**
 * Class to load required functions for push notification
 *
 * @since 1.0.0
 *
 */

if ( !class_exists( 'PNFPB_ICFM_Push_Notification_Post_BuddyPress' ) ) {
	
	Class PNFPB_ICFM_Push_Notification_Post_BuddyPress
	{
		public $pre_name = 'PNFPB_';

		public function __construct()
		{
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
			
			//Push notification(if enabled) for BuddyPress new acitivities based on plugin settings
			add_filter('bp_activity_posted_update', array($this,  $this->pre_name .'icforum_push_notifications_web'), 5, 3 );
			
			//Push notification(if enabled) for BuddyPress new acitivities under group based on plugin settings
			add_action( 'bp_groups_posted_update', array($this,  $this->pre_name .'icforum_push_notifications_web_group'), 1, 4 );

			//Push notification(if enabled) for BuddyPress Private messages. It will Send notifications only to userid.
			add_action( 'messages_message_sent', array($this,  $this->pre_name .'icforum_push_notifications_private_messages'), 10 );			
			
			//Push notification(if enabled) for new comments posted on BuddyPress acitivities based on plugin settings
			add_action( 'bp_activity_comment_posted', array($this,  $this->pre_name .'icforum_push_notifications_comment_web'), 5, 3 );
			
			//Shortcode to unsubscribe push notification
			add_shortcode( 'subscribe_PNFPB_push_notification', array($this,  $this->pre_name .'subscribe_push_notification_shortcode') );
			//add_shortcode( 'init', array($this,  $this->pre_name .'subscribe_push_notification_shortcode') );
			
			add_action ( 'bp_group_header_actions', array($this,  $this->pre_name .'subscribe_to_group_button'), 1);

			add_action ( 'bp_directory_groups_actions' , array($this,  $this->pre_name .'subscribe_to_group_button'), 1);
	
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
		}


		/**
		* Plugin deactivate routine
		*
		* @since 1.0.0
		*/
		public function PNFPB_deactivate()
		{
        
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
            
			$apiKey = get_option( 'pnfpb_ic_fcm_api' );
			$authDomain = get_option( 'pnfpb_ic_fcm_authdomain' );
			$databaseURL =get_option( 'pnfpb_ic_fcm_databaseurl' );
			$projectId = get_option( 'pnfpb_ic_fcm_projectid' );
			$storageBucket = get_option( 'pnfpb_ic_fcm_storagebucket' );
			$messagingSenderId = get_option( 'pnfpb_ic_fcm_messagingsenderid' );
			$appId = get_option( 'pnfpb_ic_fcm_appid' );
			$publicKey = get_option( 'pnfpb_ic_fcm_publickey' );

			if ($projectId != false && $projectId != '' && $publicKey != false && $publicKey != '' && $apiKey != false && $apiKey != '' && $messagingSenderId != false && $messagingSenderId != '') {
			    
				$filename = '/public/js/firebase-core/pnfpb_firebase_app.js';
				wp_enqueue_script( 'pnfpb-icajax-script-firebase-app', plugins_url( $filename, __FILE__ ));
	
				$filename = '/public/js/firebase-core/pnfpb_firebase_messaging.js';
				wp_enqueue_script( 'pnfpb-icajax-script-firebase-messaging', plugins_url( $filename, __FILE__ )); 
    
				$filename = '/public/js/pnfpb_pushscript.js';
				$ajaxobject = 'pnfpb_ajax_object_push';
				wp_enqueue_script( 'pnfpb-icajax-script-push', plugins_url( $filename, __FILE__ ), array( 'jquery' ));
				wp_localize_script( 'pnfpb-icajax-script-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'apiKey' => $apiKey, 'authDomain' => $authDomain, 'databaseURL' => $databaseUrl, 'projectId' => $projectId, 'storageBucket' => $storageBucket, 'messagingSenderId' => $messagingSenderId, 'appId' => $appId, 'publicKey' => $publicKey) );
				
				$filename = '/public/js/pnfpb_unsubscribe_pushscript.js';
				$ajaxobject = 'pnfpb_ajax_object_unsubscribe_push';
				wp_enqueue_script( 'pnfpb-icajax-script-unsubscribe-push', plugins_url( $filename, __FILE__ ), array( 'jquery' ));
				wp_localize_script( 'pnfpb-icajax-script-unsubscribe-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'publicKey' => $publicKey) );
				
				$filename = '/public/js/pnfpb_group_pushscript.js';
				$ajaxobject = 'pnfpb_ajax_object_group_push';
				wp_enqueue_script( 'pnfpb-icajax-script-group-push', plugins_url( $filename, __FILE__ ), array( 'jquery' ));
				wp_localize_script( 'pnfpb-icajax-script-group-push', $ajaxobject,array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'groupId' => '9') );
				
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
			include(plugin_dir_path(__FILE__) . '/public/ajax_routines/pnfpb_update_deviceid_ajax.php');
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
			include(plugin_dir_path(__FILE__) . '/admin/pnfpb_admin_ic_push_notification.php');
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
		}   


		/**
		* Create service worker file on fly(dynamically) which is needed for push notification using FCM
		*
		* @since 1.0.0
		*/
		public function PNFPB_icpush_sw_file_create() {
			include(plugin_dir_path(__FILE__) . '/public/service_worker/pnfpb_create_sw_file.php');
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
		public function PNFPB_on_post_save_web($post_id, $post, $update) {
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
		public function PNFPB_icforum_push_notifications_post_web ($post_title,$post_content, $postlink) {

			global $wpdb;

			$apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
			
			if ($apiaccesskey != '' && $apiaccesskey != false) {
	
			    $table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
			    $deviceids=$wpdb->get_col( "SELECT device_id FROM {$table_name} WHERE device_id NOT LIKE '%@N%'" );
	
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
			
			    $result = wp_remote_post($url, $args);
			
			    if (is_wp_error($response)) {
				    $status = $response->get_error_code(); 				// custom code for WP_ERROR
                    $error_message = $response->get_error_message();
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
		public function PNFPB_icforum_push_notifications_web ($activity_content, $user_id, $activity_id) {
        
            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
 

			if (get_option('pnfpb_ic_fcm_buddypress_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false) {
			    

				global $wpdb;
	
				$activitylink = bp_activity_get_permalink($activity_id);
	
				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
				$deviceids=$wpdb->get_col( "SELECT device_id FROM {$table_name} WHERE device_id NOT LIKE '%@N%'" );
				
				$url = 'https://fcm.googleapis.com/fcm/send';

				$regid = $deviceids;
    
				$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
            
				$blog_title = get_bloginfo( 'name' );
            
				if (get_option('pnfpb_ic_fcm_activity_title') != false && get_option('pnfpb_ic_fcm_activity_title') != '') {
					$activitytitle = get_option('pnfpb_ic_fcm_activity_title');
				}
				else
				{
					$activitytitle = 'New activity post in '.$blog_title;
				}
    
				// prepare the message
				$message = array( 
					'title'     => $activitytitle,
					'body'      => $activity_content,
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
			
				$result = wp_remote_post($url, $args);
				
				update_user_meta(1, 'errorcodepush', serialize($result));
				
				if (is_wp_error($result)) {
				    $status = $result->get_error_code(); 				// custom code for WP_ERROR
                    $error_message = $result->get_error_message();
                    error_log('There was a '.$status.' error in push notification: '.$error_message);
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
		public function PNFPB_icforum_push_notifications_web_group ($content, $user_id, $group_id, $activity_id) {
		    
            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');		    
        
			if (get_option('pnfpb_ic_fcm_buddypress_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false) {
	
				global $wpdb;
	
				$bpgroup = groups_get_group( array( 'group_id' => $group_id) );
				
				//if (groups_is_user_member( bp_displayed_user_id(), $group_id )) {}
	
				$grouplink = bp_get_group_permalink($bpgroup);
	
				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
				$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1)  FROM {$table_name} WHERE device_id NOT LIKE '%@N%'" );
	
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
    
				// prepare the message
				$message = array( 
					'title'     => $grouptitle,
					'body'      => $content,
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
			
				$result = wp_remote_post($url, $args);
				
				if (is_wp_error($response)) {
				    $status = $response->get_error_code(); 				// custom code for WP_ERROR
                    $error_message = $response->get_error_message();
                    error_log('There was a '.$status.' error in push notification: '.$error_message);
                }
			}
			else
			{
				if (get_option('pnfpb_ic_fcm_buddypress_enable') == 2 && $apiaccesskey != '' && $apiaccesskey != false) {
					global $wpdb;
	
					$bpgroup = groups_get_group( array( 'group_id' => $group_id) );
				
					//if (groups_is_user_member( bp_displayed_user_id(), $group_id )) {}
	
					$grouplink = bp_get_group_permalink($bpgroup);
	
					$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
					$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!{$group_id}!!%'" );
	
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
    
					// prepare the message
					$message = array( 
						'title'     => $grouptitle,
						'body'      => $content,
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
			
					$result = wp_remote_post($url, $args);
				
					if (is_wp_error($response)) {
				    	$status = $response->get_error_code(); 				// custom code for WP_ERROR
                    	$error_message = $response->get_error_message();
                    	error_log('There was a '.$status.' error in push notification: '.$error_message);
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

					$deviceids=$wpdb->get_col( "SELECT device_id FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND userid = '{$recipient->user_id}'"  );

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
			
						$result = wp_remote_post($url, $args);
				
						if (is_wp_error($response)) {
				    		$status = $response->get_error_code();
                    		$error_message = $response->get_error_message();
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
		public function PNFPB_icforum_push_notifications_comment_web ($comment_id, $params, $activity) {
        
            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
            
			if (get_option('pnfpb_ic_fcm_bcomment_enable') == 1 && $apiaccesskey != '' && $apiaccesskey != false) {

				global $wpdb;
	
				extract( $params, EXTR_SKIP );
	
				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
				$deviceids=$wpdb->get_col( "SELECT device_id FROM {$table_name} WHERE device_id NOT LIKE '%@N%'" );
	
				$url = 'https://fcm.googleapis.com/fcm/send';

				$regid = $deviceids;
	
				$activity_content_push = strip_tags(urldecode($content));
	
				$activitylink = bp_activity_get_permalink( $activity_id );
    
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

				// prepare the message
				$message = array( 
					'title'     => $commenttitle,
					'body'      => $activity_content_push,
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
			
				$result = wp_remote_post($url, $args);
				
				if (is_wp_error($response)) {
				    $status = $response->get_error_code(); 				// custom code for WP_ERROR
                    $error_message = $response->get_error_message();
                    error_log('There was a '.$status.' error in push notification: '.$error_message);
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
		
		    $pnfpb_notification_shortcode .= '<div id="pnfpb_unsubscribe_dialog_confirm" class="pnfpb_unsubscribe_dialog_confirm" title="UnSubscribe notification?"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Do you want to Unsubscribe push notification?</div>';
		    
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
		    include(plugin_dir_path(__FILE__) . '/public/ajax_routines/pnfpb_update_unsubscribe_deviceids.php');
		    wp_die();			
		
	    }	

	}

    $PNFPB_ICFM_Push_Notification_Post_BuddyPress_OBJ = new PNFPB_ICFM_Push_Notification_Post_BuddyPress();

}
else
{
    exit;
}


?>