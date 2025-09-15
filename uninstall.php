<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * Everything in uninstall.php will be executed when user decides to delete the plugin.
 *
 * @since 1.26
 */

// Exit if accessed directly
if (!defined("ABSPATH")) {
    exit();
}

//die if not uninstalling
if (!defined("WP_UNINSTALL_PLUGIN")) {
    die();
}

/**
 * Delete plugin's WordPress database option settings in wp_options table
 * */

delete_option("pnfpb_ic_fcm_google_api");
delete_option("pnfpb_ic_fcm_api");
delete_option("pnfpb_ic_fcm_authdomain");
delete_option("pnfpb_ic_fcm_databaseurl");
delete_option("pnfpb_ic_fcm_projectid");
delete_option("pnfpb_ic_fcm_storagebucket");
delete_option("pnfpb_ic_fcm_messagingsenderid");
delete_option("pnfpb_ic_fcm_appid");
delete_option("pnfpb_ic_fcm_publickey");
delete_option("pnfpb_ic_fcm_activity_title");
delete_option("pnfpb_ic_fcm_activity_message");
delete_option("pnfpb_ic_fcm_group_activity_title");
delete_option("pnfpb_ic_fcm_group_activity_message");
delete_option("pnfpb_ic_fcm_comment_activity_title");
delete_option("pnfpb_ic_fcm_comment_activity_message");
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
delete_option(
    "pnfpb_bell_icon_subscription_option_update_confirmation_message"
);
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

delete_option('pnfpb_bell_icon_prompt_options_on_off');
delete_option('pnfpb_bell_icon_prompt_options_on_off_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_activity_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_all_comments_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_all_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_buddypress_text');
delete_option('pnfpb_bell_icon_subscription_option_buddypress_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_cover_image_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_e-floating-buttons_text');
delete_option('pnfpb_bell_icon_subscription_option_e-floating-buttons_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_e-landing-page_text');
delete_option('pnfpb_bell_icon_subscription_option_e-landing-page_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_elementor_library_text');
delete_option('pnfpb_bell_icon_subscription_option_elementor_library_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_favourite_text');
delete_option('pnfpb_bell_icon_subscription_option_favourite_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_forum_text');
delete_option('pnfpb_bell_icon_subscription_option_forum_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_friend_request_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_friendship_accepted_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_group_details_update_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_group_invite_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_my_comments_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_new_member_joined_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_post_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_private_message_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_private_messsage_text');
delete_option('pnfpb_bell_icon_subscription_option_reply_text');
delete_option('pnfpb_bell_icon_subscription_option_reply_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_topic_text');
delete_option('pnfpb_bell_icon_subscription_option_topic_text_shortcode');
delete_option('pnfpb_bell_icon_subscription_option_user_avatar_text_shortcode');
delete_option('pnfpb_custom_prompt_options_on_off');
delete_option('pnfpb_db_version');
delete_option('pnfpb_firebase_oauth_token');
delete_option('pnfpb_httpv1_push');
delete_option('pnfpb_ic_fcm_activity_schedule_now_enable');
delete_option('pnfpb_ic_fcm_admin_schedule_now_enable');
delete_option('pnfpb_ic_fcm_async_notifications');
delete_option('pnfpb_ic_fcm_bellicon_shortcode_style');
delete_option('pnfpb_ic_fcm_buddypress_mark_favourite_content_enable');
delete_option('pnfpb_ic_fcm_buddypress_mark_favourite_text_enable');
delete_option('pnfpb_ic_fcm_buddypressoptions_schedule_now_enable');
delete_option('pnfpb_ic_fcm_comments_schedule_now_enable');
delete_option('pnfpb_ic_fcm_custom_prompt_header_text_line_2');
delete_option('pnfpb_ic_fcm_custom_prompt_popup_wait_message');
delete_option('pnfpb_ic_fcm_disable_post_update_enable');
delete_option('pnfpb_ic_fcm_e-floating-buttons_enable');
delete_option('pnfpb_ic_fcm_e-floating-buttons_title');
delete_option('pnfpb_ic_fcm_e-landing-page_enable');
delete_option('pnfpb_ic_fcm_e-landing-page_title');
delete_option('pnfpb_ic_fcm_elementor_library_enable');
delete_option('pnfpb_ic_fcm_elementor_library_title');
delete_option('pnfpb_ic_fcm_forum_enable');
delete_option('pnfpb_ic_fcm_forum_title');
delete_option('pnfpb_ic_fcm_frontend_settings_buddypress_text');
delete_option('pnfpb_ic_fcm_frontend_settings_e-floating-buttons_text');
delete_option('pnfpb_ic_fcm_frontend_settings_e-landing-page_text');
delete_option('pnfpb_ic_fcm_frontend_settings_elementor_library_text');
delete_option('pnfpb_ic_fcm_frontend_settings_favourite_text');
delete_option('pnfpb_ic_fcm_frontend_settings_forum_text');
delete_option('pnfpb_ic_fcm_frontend_settings_groupdetails_text');
delete_option('pnfpb_ic_fcm_frontend_settings_groupinvite_text');
delete_option('pnfpb_ic_fcm_frontend_settings_reply_text');
delete_option('pnfpb_ic_fcm_frontend_settings_topic_text');
delete_option('pnfpb_ic_fcm_label_text_shortcode');
delete_option('pnfpb_ic_fcm_loggedin_notify');
delete_option('pnfpb_ic_fcm_mark_favourite_enable');
delete_option('pnfpb_ic_fcm_new_buddypressactivities_content');
delete_option('pnfpb_ic_fcm_new_buddypressactivities_link');
delete_option('pnfpb_ic_fcm_new_buddypressactivities_userid');
delete_option('pnfpb_ic_fcm_new_buddypresscomments_activityuserid');
delete_option('pnfpb_ic_fcm_new_buddypresscomments_authoractivityuserid');
delete_option('pnfpb_ic_fcm_new_buddypresscomments_content');
delete_option('pnfpb_ic_fcm_new_buddypresscomments_link');
delete_option('pnfpb_ic_fcm_new_comment_approved');
delete_option('pnfpb_ic_fcm_new_comment_id');
delete_option('pnfpb_ic_fcm_new_comments_post_authorid');
delete_option('pnfpb_ic_fcm_new_comments_post_content');
delete_option('pnfpb_ic_fcm_new_comments_post_link');
delete_option('pnfpb_ic_fcm_new_comments_post_userid');
delete_option('pnfpb_ic_fcm_only_post_subscribers_enable');
delete_option('pnfpb_ic_fcm_popup_header_text_shortcode');
delete_option('pnfpb_ic_fcm_popup_subscribe_button_color_shortcode');
delete_option('pnfpb_ic_fcm_popup_subscribe_button_icon_shortcode');
delete_option('pnfpb_ic_fcm_popup_subscribe_button_shortcode');
delete_option('pnfpb_ic_fcm_popup_subscribe_button_text_color_shortcode');
delete_option('pnfpb_ic_fcm_popup_subscribe_message_shortcode');
delete_option('pnfpb_ic_fcm_popup_unsubscribe_button_shortcode');
delete_option('pnfpb_ic_fcm_popup_unsubscribe_message_shortcode');
delete_option('pnfpb_ic_fcm_popup_wait_message_shortcode');
delete_option('pnfpb_ic_fcm_post_schedule_now_enable');
delete_option('pnfpb_ic_fcm_pwa_ios_prompt_button_background');
delete_option('pnfpb_ic_fcm_pwa_ios_prompt_button_text_color');
delete_option('pnfpb_ic_fcm_pwa_ios_prompt_dialog_background');
delete_option('pnfpb_ic_fcm_pwa_ios_prompt_ok_button');
delete_option('pnfpb_ic_fcm_pwa_ios_prompt_text_color');
delete_option('pnfpb_ic_fcm_pwa_shortcut_upload_icon_132');
delete_option('pnfpb_ic_fcm_pwa_shortcut_upload_icon_512');
delete_option('pnfpb_ic_fcm_renotify_notification');
delete_option('pnfpb_ic_fcm_replace_notifications');
delete_option('pnfpb_ic_fcm_reply_enable');
delete_option('pnfpb_ic_fcm_reply_title');
delete_option('pnfpb_ic_fcm_shortcode_close_button_text');
delete_option('pnfpb_ic_fcm_show_allposttype_subscriptions_custom_prompt');
delete_option('pnfpb_ic_fcm_subscribe_buddypress_dialog_text');
delete_option('pnfpb_ic_fcm_subscribe_e-floating-buttons_dialog_text');
delete_option('pnfpb_ic_fcm_subscribe_e-landing-page_dialog_text');
delete_option('pnfpb_ic_fcm_subscribe_elementor_library_dialog_text');
delete_option('pnfpb_ic_fcm_subscribe_forum_dialog_text');
delete_option('pnfpb_ic_fcm_subscribe_friend_request_dialog_text');
delete_option('pnfpb_ic_fcm_subscribe_reply_dialog_text');
delete_option('pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text');
delete_option('pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text');
delete_option('pnfpb_ic_fcm_subscribe_topic_dialog_text');
delete_option('pnfpb_ic_fcm_topic_enable');
delete_option('pnfpb_ic_fcm_topic_title');
delete_option('pnfpb_ic_fcm_turnoff_foreground_messages');
delete_option('pnfpb_ic_ios_pwa_prompt_disable');
delete_option('pnfpb_ic_ios_pwa_prompt_reappear');
delete_option('pnfpb_ic_pwa_app_description');
delete_option('pnfpb_ic_pwa_app_desktop_custom_prompt_enable');
delete_option('pnfpb_ic_pwa_app_mobile_custom_prompt_enable');
delete_option('pnfpb_ic_pwa_app_orientation');
delete_option('pnfpb_ic_pwa_app_pixels_custom_prompt_enable');
delete_option('pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable');
delete_option('pnfpb_ic_pwa_app_shortcut_description');
delete_option('pnfpb_ic_pwa_app_shortcut_name');
delete_option('pnfpb_ic_pwa_app_shortcut_shortname');
delete_option('pnfpb_ic_pwa_app_shortcut_starturl');
delete_option('pnfpb_ic_pwa_app_starturl');
delete_option('pnfpb_ic_pwa_protocol_name');
delete_option('pnfpb_ic_pwa_protocol_url');
delete_option('PNFPB_icfcm_integrate_app_secret_code');
delete_option('pnfpb_sa_json_data');
delete_option('pnfpb_shortcode_enable');
delete_option('pnfpb_webpush_firebase_private_key');
delete_option('pnfpb_webpush_firebase_public_key');
delete_option('pnfpb_webpush_push');
delete_option('pnfpb_webpush_push_firebase');
delete_option('pnfpb-pwa-shortcode-install-icon');

delete_option("PNFBP_admin_notice");

$args = [
    "public" => true,
    "_builtin" => false,
];

$output = "names"; // or objects
$operator = "and"; // 'and' or 'or'
$custposttypes = get_post_types($args, $output, $operator);

foreach ($custposttypes as $post_type) {
    $fieldname = "pnfpb_ic_fcm_" . $post_type . "_enable";
    delete_option($fieldname);
    delete_option("pnfpb_ic_fcm_" . $post_type . "_title");
}

// delete database table
// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery
global $wpdb;
$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
$wpdb->query($wpdb->prepare("DROP TABLE IF EXISTS %i", $table_name));

$table_name = $wpdb->prefix . "wp_pnfpb_ic_delivery_statistics_notifications";
$wpdb->query($wpdb->prepare("DROP TABLE IF EXISTS %i", $table_name));

$table_name = $wpdb->prefix . "wp_pnfpb_ic_schedule_push_notifications";
$wpdb->query($wpdb->prepare("DROP TABLE IF EXISTS %i", $table_name));

$table_name = $wpdb->prefix . "wp_pnfpb_ic_total_statistics_notifications";
$wpdb->query($wpdb->prepare("DROP TABLE IF EXISTS %i", $table_name));

?>
