<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * Everything in uninstall.php will be executed when user decides to delete the plugin. 
 * 
 * @since 1.26
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

//die if not uninstalling
if( !defined( 'WP_UNINSTALL_PLUGIN' ) )
die;

/**
 * Delete plugin's WordPress database option settings in wp_options table
 * */

			delete_option('pnfpb_ic_fcm_google_api');
			delete_option('pnfpb_ic_fcm_api');
			delete_option('pnfpb_ic_fcm_authdomain');
			delete_option('pnfpb_ic_fcm_databaseurl');
			delete_option('pnfpb_ic_fcm_projectid');
			delete_option('pnfpb_ic_fcm_storagebucket');
			delete_option('pnfpb_ic_fcm_messagingsenderid');
			delete_option('pnfpb_ic_fcm_appid');
			delete_option('pnfpb_ic_fcm_publickey');
			delete_option('pnfpb_ic_fcm_activity_title');
			delete_option('pnfpb_ic_fcm_activity_message');
			delete_option('pnfpb_ic_fcm_group_activity_title');
			delete_option('pnfpb_ic_fcm_group_activity_message');
			delete_option('pnfpb_ic_fcm_comment_activity_title');
			delete_option('pnfpb_ic_fcm_comment_activity_message');
			delete_option("pnfpb_ic_fcm_upload_icon");
			
			delete_option("pnfpb_onesignal_push");
			delete_option("pnfpb_ic_fcm_progressier_api_key");
			delete_option("pnfpb_progressier_push");
			delete_option("pnfpb_ic_fcm_webtoapp_api_key");
			delete_option("pnfpb_webtoapp_push");
			delete_option("pnfpb_ic_fcm_prompt_style");
			delete_option("pnfpb_ic_fcm_prompt_on_off");
			delete_option("pnfpb_ic_fcm_prompt_style3");
			delete_option("pnfpb_bell_icon_subscription_option_update_text");
			delete_option("pnfpb_bell_icon_subscription_option_update_text_color");
			delete_option("pnfpb_bell_icon_subscription_option_update_background_color");
			delete_option("pnfpb_bell_icon_subscription_option_update_text");
			delete_option("pnfpb_bell_icon_subscription_option_list_background_color");
			delete_option("pnfpb_bell_icon_subscription_option_list_text_color");
			delete_option("pnfpb_bell_icon_subscription_option_list_checkbox_color");
			delete_option("pnfpb_bell_icon_subscription_option_update_confirmation_message");
			delete_option("pnfpb_bell_icon_subscription_option_all_text");
			delete_option("pnfpb_bell_icon_subscription_option_post_text");


			delete_option("pnfpb_bell_icon_subscription_option_activity_text");
			delete_option("pnfpb_bell_icon_subscription_option_all_comments_text");
			delete_option("pnfpb_bell_icon_subscription_option_my_comments_text");
			delete_option("pnfpb_bell_icon_subscription_option_private_message_text");
			delete_option("pnfpb_bell_icon_subscription_option_new_member_joined_text");
			delete_option("pnfpb_bell_icon_subscription_option_friendship_request_text");
			delete_option("pnfpb_bell_icon_subscription_option_friendship_accepted_text");
			delete_option("pnfpb_bell_icon_subscription_option_avatar_change_text");
			delete_option("pnfpb_bell_icon_subscription_option_cover_image_change_text");
			delete_option("pnfpb_bell_icon_subscription_option_group_details_update_text");
			delete_option("pnfpb_bell_icon_subscription_option_group_invite_text");
			delete_option("pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon");
			delete_option("pnfpb_ic_fcm_custom_prompt_animation");
			delete_option("pnfpb_ic_fcm_custom_prompt_header_text");
			delete_option("pnfpb_ic_fcm_custom_prompt_subscribed_text");
			delete_option("pnfpb_custom_prompt_confirmation_message_on_off");
			delete_option("pnfpb_ic_fcm_custom_prompt_show_again_days");
			delete_option("pnfpb_ic_fcm_custom_prompt_allow_button_text_color");
			delete_option("pnfpb_ic_fcm_push_custom_prompt_allow_button_background");
			delete_option("pnfpb_ic_fcm_custom_prompt_allow_button_text");
			delete_option("pnfpb_ic_fcm_custom_prompt_cancel_button_text_color");
			delete_option("pnfpb_ic_fcm_push_custom_prompt_cancel_button_background");
			delete_option("pnfpb_ic_fcm_custom_prompt_cancel_button_text");
			delete_option("pnfpb_ic_fcm_custom_prompt_close_button_text_color");
			delete_option("pnfpb_ic_fcm_push_custom_prompt_close_button_background");
			delete_option("pnfpb_ic_fcm_custom_prompt_close_button_text");				
			
			delete_option("pnfpb_ic_fcm_push_prompt_enable");			
			delete_option("pnfpb_ic_fcm_push_prompt_text");			
			delete_option("pnfpb_ic_fcm_push_prompt_confirm_button");			
			delete_option("pnfpb_ic_fcm_push_prompt_cancel_button");
			delete_option("pnfpb_ic_fcm_push_prompt_button_background");
			delete_option("pnfpb_ic_fcm_push_prompt_dialog_background");
			delete_option("pnfpb_ic_fcm_push_prompt_text_color");
			delete_option("pnfpb_ic_fcm_push_prompt_button_text_color");
			delete_option("pnfpb_ic_fcm_push_prompt_position");
			delete_option("pnfpb_ic_fcm_post_enable");
			delete_option("pnfpb_ic_fcm_post_title");
			delete_option("pnfpb_ic_fcm_buddypress_enable");
			delete_option("pnfpb_ic_fcm_bcomment_enable");
			delete_option("pnfpb_ic_fcm_bactivity_enable");
			delete_option("pnfpb_ic_fcm_bprivatemessage_enable");
			delete_option("pnfpb_ic_fcm_bprivatemessage_text");
			delete_option("pnfpb_ic_fcm_bprivatemessage_content");
			delete_option("pnfpb_ic_fcm_new_member_enable");
			delete_option("pnfpb_ic_fcm_new_member_text");
			delete_option("pnfpb_ic_fcm_new_member_content");
			delete_option("pnfpb_ic_fcm_friendship_request_enable");
			delete_option("pnfpb_ic_fcm_friendship_request_text");
			delete_option("pnfpb_ic_fcm_friendship_request_content");
			delete_option("pnfpb_ic_fcm_friendship_accept_enable");
			delete_option("pnfpb_ic_fcm_friendship_accept_text");
			delete_option("pnfpb_ic_fcm_friendship_accept_content");			
			delete_option("pnfpb_ic_fcm_avatar_change_enable");
			delete_option("pnfpb_ic_fcm_avatar_change_text");
			delete_option("pnfpb_ic_fcm_avatar_change_content");
			delete_option("pnfpb_ic_fcm_cover_image_change_enable");
			delete_option("pnfpb_ic_fcm_cover_image_change_text");
			delete_option("pnfpb_ic_fcm_cover_image_change_content");
			delete_option("pnfpb_ic_fcm_group_invitation_enable");
			delete_option("pnfpb_ic_fcm_buddypress_group_invitation_text_enable");
			delete_option("pnfpb_ic_fcm_buddypress_group_invitation_content_enable");
			delete_option("pnfpb_ic_fcm_group_details_updated_enable");
			delete_option("pnfpb_ic_fcm_buddypress_group_details_updated_text_enable");
			delete_option("pnfpb_ic_fcm_buddypress_group_details_updated_content_enable");
			delete_option("pnfpb_ic_fcm_contact_form7_enable");
			delete_option("pnfpb_ic_fcm_buddypress_contact_form7_text_enable");
			delete_option("pnfpb_ic_fcm_buddypress_contact_form7_content_enable");
			delete_option("pnfpb_ic_fcm_new_user_registration_enable");
			delete_option("pnfpb_ic_fcm_buddypress_new_user_registration_text_enable");
			delete_option("pnfpb_ic_fcm_buddypress_new_user_registration_content_enable");			
			delete_option("pnfpb_ic_fcm_post_schedule_enable");
			delete_option("pnfpb_ic_fcm_post_schedule_background_enable");
			delete_option("pnfpb_ic_fcm_post_timeschedule_seconds");
			delete_option("pnfpb_ic_fcm_buddypressactivities_schedule_enable");
			delete_option("pnfpb_ic_fcm_buddypressactivities_schedule_background_enable");
			delete_option("pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds");
			delete_option("pnfpb_ic_fcm_buddypresscomments_schedule_enable");
			delete_option("pnfpb_ic_fcm_buddypresscomments_schedule_background_enable");
			delete_option("pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds");


			delete_option("pnfpb_ic_fcm_buddypress_followers_enable");
			delete_option("pnfpb_ic_fcm_buddypresscomments_schedule_enable");
			delete_option("pnfpb_ic_fcm_buddypress_comments_radio_enable");
			delete_option("pnfpb_ic_fcm_buddypresscomments_schedule_background_enable");
			delete_option("pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds");
			delete_option("pnfpb_ic_fcm_popup_subscribe_button_icon");
			delete_option("pnfpb_ic_fcm_popup_subscribe_button_text_color");
			delete_option("pnfpb_ic_fcm_popup_subscribe_button_color");
			delete_option("pnfpb_ic_fcm_popup_subscribe_button");
			delete_option("pnfpb_ic_fcm_popup_unsubscribe_button");
			delete_option("pnfpb_ic_fcm_popup_header_text");
			delete_option("pnfpb_ic_fcm_popup_subscribe_message");
			delete_option("pnfpb_ic_fcm_popup_unsubscribe_message");
			delete_option("pnfpb_ic_fcm_popup_wait_message");				
			
			delete_option("pnfpb_ic_pwa_app_enable");
			delete_option("pnfpb_ic_pwa_app_name");
			delete_option("pnfpb_ic_pwa_app_shortname");
			delete_option("pnfpb_ic_pwa_theme_color");
			delete_option("pnfpb_ic_pwa_app_backgroundcolor");
			delete_option("pnfpb_ic_pwa_app_display");
			delete_option("pnfpb_ic_fcm_pwa_upload_icon_132");
			delete_option("pnfpb_ic_fcm_pwa_upload_icon_512");
			
			delete_option("pnfpb-pwa-ios-message");
			delete_option("pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value");
			delete_option("pnfpb_ic_fcm_pwa_upload_screenshot_desktop_label");
			delete_option("pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value");
			delete_option("pnfpb_ic_fcm_pwa_upload_screenshot_mobile_label");
			delete_option("pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value");
			delete_option("pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value");
			delete_option("pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value");
			delete_option("pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_value");
			delete_option("pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_value");
			delete_option("pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_value");
			delete_option("pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_value");
			delete_option("pnfpb_ic_thirdparty_pwa_app_enable");
			delete_option("pnfpb_ic_pwa_thirdparty_app_id");
			
			delete_option("pnfpb_ic_pwa_app_offline_url1");
			delete_option("pnfpb_ic_pwa_app_offline_url2");
			delete_option("pnfpb_ic_pwa_app_offline_url3");
			delete_option("pnfpb_ic_pwa_app_offline_url4");
			delete_option("pnfpb_ic_pwa_app_offline_url5");
			delete_option("pnfpb_ic_pwa_app_excludeallurls");
			delete_option("pnfpb_ic_pwa_app_excludeurls");
			delete_option("pnfpb_ic_pwa_app_custom_prompt_enable");
			delete_option("pnfpb_ic_pwa_app_custom_prompt_type");			
			delete_option("pnfpb_ic_pwa_prompt_install_button_text");
			delete_option("pnfpb_ic_pwa_prompt_header_text");				
			delete_option("pnfpb_ic_pwa_prompt_description");
			delete_option("pnfpb_ic_pwa_prompt_install_button_color");
			delete_option("pnfpb_ic_pwa_prompt_install_text_color");
			delete_option("pnfpb-pwa-dialog-app-installed_text");
			delete_option("pnfpb-pwa-dialog-app-installed_description");
			
			delete_option("pnfpb_ic_fcm_pwa_prompt_confirm_button");
			delete_option("pnfpb_ic_fcm_pwa_prompt_cancel_button");
			delete_option("pnfpb_ic_fcm_pwa_prompt_button_background");
			delete_option("pnfpb_ic_fcm_pwa_prompt_dialog_background");
			delete_option("pnfpb_ic_fcm_pwa_prompt_text_color");
			delete_option("pnfpb_ic_fcm_pwa_prompt_button_text_color");
			delete_option("pnfpb_ic_fcm_pwa_prompt_text");
			delete_option("pnfpb_ic_fcm_pwa_show_again_days");			
			
			delete_option("pnfpb_ic_nginx_static_files_enable");
			
			delete_option("pnfpb_ic_fcm_subscribe_button_color");
			delete_option("pnfpb_ic_fcm_subscribe_button_text_color");
			delete_option("pnfpb_ic_fcm_subscribe_button_text");			
			delete_option("pnfpb_ic_fcm_unsubscribe_button_text");
			delete_option("pnfpb_ic_fcm_group_subscribe_dialog_text");			
			delete_option("pnfpb_ic_fcm_group_subscribe_dialog_text_confirm");
			delete_option("pnfpb_ic_fcm_group_unsubscribe_dialog_text");
			delete_option("pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm");			
			delete_option("pnfpb_ic_fcm_unsubscribe_button_shortcode_text");
			delete_option("pnfpb_ic_fcm_subscribe_button_shortcode_text");
			delete_option("pnfpb_ic_fcm_subscribe_save_button_text_shortcode");
			delete_option("pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode");		
			delete_option("pnfpb_ic_fcm_subscribe_all_dialog_text");
			delete_option("pnfpb_ic_fcm_subscribe_post_activity_dialog_text");
			delete_option("pnfpb_ic_fcm_subscribe_all_comments_dialog_text");
			delete_option("pnfpb_ic_fcm_subscribe_my_comments_dialog_text");
			delete_option("pnfpb_ic_fcm_subscribe_private_message_dialog_text");
			delete_option("pnfpb_ic_fcm_subscribe_new_member_dialog_text");
			delete_option("pnfpb_ic_fcm_subscribe_friendship_request_dialog_text");
			delete_option("pnfpb_ic_fcm_subscribe_friendship_accepted_dialog_text");
			delete_option("pnfpb_ic_fcm_subscribe_user_avatar_dialog_text");
			delete_option("pnfpb_ic_fcm_subscribe_cover_image_change_dialog_text");
			delete_option("pnfpb_ic_fcm_unsubscribe_all_dialog_text");
			delete_option("pnfpb_ic_fcm_subscribe_dialog_text_confirm");
			delete_option("pnfpb_ic_fcm_unsubscribe_dialog_text_confirm");
			delete_option("pnfpb_ic_fcm_install_pwa_shortcode_button_color");
			delete_option("pnfpb_ic_fcm_install_pwa_shortcode_button_text_color");
			delete_option("pnfpb_ic_fcm_install_pwa_shortcode_button_text");
			
			delete_option("pnfpb_ic_fcm_frontend_enable_subscription");
			delete_option("pnfpb_ic_fcm_frontend_settings_post_text");
			delete_option("pnfpb_ic_fcm_frontend_settings_activities_text");
			delete_option("pnfpb_ic_fcm_frontend_settings_comments_text");
			delete_option("pnfpb_ic_fcm_frontend_settings_mycomments_text");
			delete_option("pnfpb_ic_fcm_frontend_settings_privatemessage_text");
			delete_option("pnfpb_ic_fcm_frontend_settings_newmember_text");
			delete_option("pnfpb_ic_fcm_frontend_settings_friend_request_text");
			delete_option("pnfpb_ic_fcm_frontend_settings_friend_accept_text");
			delete_option("pnfpb_ic_fcm_frontend_settings_avatar_change_text");
			delete_option("pnfpb_ic_fcm_frontend_settings_coverimage_change_text");
			
			delete_option("pnfpb_subscribe_group_push_notification_icon");
			delete_option("pnfpb_unsubscribe_group_push_notification_icon");
			delete_option("pnfpb_subscribe_group_push_notification_icon_enable");
			delete_option("pnfpb_ic_fcm_token_delete_without_user_enable");
			delete_option("pnfpb_ic_fcm_token_delete_without_useridtoken_enable");
			
			delete_option("pnfpb_ic_fcm_token_delete_without_user_timeschedule_enable");
			
			delete_option("pnfpb_ic_fcm_post_timeschedule_enable");
			delete_option("pnfpb_ic_fcm_buddypressactivities_schedule_enable");
			delete_option("pnfpb_ic_fcm_buddypressactivities_timeschedule_enable");						 
			delete_option("pnfpb_ic_fcm_buddypresscomments_schedule_enable");
			delete_option("pnfpb_ic_fcm_buddypresscomments_timeschedule_enable");

			delete_option("PNFBP_admin_notice");
		
			$args = array(
				'public'   => true,
				'_builtin' => false
			); 
	
			$output = 'names'; // or objects
			$operator = 'and'; // 'and' or 'or'
			$custposttypes = get_post_types( $args, $output, $operator );
	    
			foreach ( $custposttypes as $post_type ) {
				$fieldname = "pnfpb_ic_fcm_".$post_type."_enable";
				delete_option($fieldname);
				delete_option("pnfpb_ic_fcm_".$post_type."_title");
			}

// delete database table
global $wpdb;
$table_name = $table_name = $wpdb->prefix . 'pnfpb_ic_subscribed_deviceids_web';
$wpdb->query("DROP TABLE IF EXISTS {$table_name}");

?>