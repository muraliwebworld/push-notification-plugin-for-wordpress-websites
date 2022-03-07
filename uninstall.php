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

delete_option("pnfpb_ic_fcm_buddypresscomments_schedule_enable");
delete_option("pnfpb_ic_fcm_buddypresscomments_timeschedule_enable");
delete_option("pnfpb_ic_fcm_google_api");
delete_option("pnfpb_ic_fcm_api");
delete_option("pnfpb_ic_fcm_authdomain");
delete_option("pnfpb_ic_fcm_databaseurl");
delete_option("pnfpb_ic_fcm_projectid");
delete_option("pnfpb_ic_fcm_storagebucket");
delete_option("pnfpb_ic_fcm_messagingsenderid");
delete_option("pnfpb_ic_fcm_appid");
delete_option("pnfpb_ic_fcm_publickey");
delete_option("pnfpb_ic_pwa_app_enable");
delete_option("pnfpb_ic_fcm_activity_title");
delete_option("pnfpb_ic_fcm_group_activity_title");
delete_option("pnfpb_ic_fcm_comment_activity_title");
delete_option("pnfpb_ic_fcm_upload_icon");
delete_option("pnfpb_ic_fcm_post_enable");
delete_option("pnfpb_ic_fcm_buddypress_enable");
delete_option("pnfpb_ic_fcm_bcomment_enable");
delete_option("pnfpb_ic_fcm_bprivatemessage_enable");
delete_option("pnfpb_ic_fcm_bprivatemessage_text");
delete_option("pnfpb_ic_fcm_post_schedule_enable");
delete_option("pnfpb_ic_pwa_app_enable");
delete_option("pnfpb_ic_pwa_app_name");
delete_option("pnfpb_ic_pwa_app_shortname");
delete_option("pnfpb_ic_pwa_theme_color");
delete_option("pnfpb_ic_pwa_app_backgroundcolor");
delete_option("pnfpb_ic_pwa_app_display");
delete_option("pnfpb_ic_fcm_pwa_upload_icon_132");
delete_option("pnfpb_ic_fcm_pwa_upload_icon_512");
delete_option("pnfpb_ic_pwa_app_offline_url1");
delete_option("pnfpb_ic_pwa_app_offline_url2");
delete_option("pnfpb_ic_pwa_app_offline_url3");
delete_option("pnfpb_ic_pwa_app_offline_url4");
delete_option("pnfpb_ic_pwa_app_offline_url5");
delete_option("pnfpb_ic_pwa_app_excludeurls");
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
delete_option("pnfpb_ic_fcm_unsubscribe_all_dialog_text");
delete_option("pnfpb_ic_fcm_subscribe_dialog_text_confirm");
delete_option("pnfpb_ic_fcm_unsubscribe_dialog_text_confirm");

// delete database table
global $wpdb;
$table_name = $table_name = $wpdb->prefix . 'pnfpb_ic_subscribed_deviceids_web';
$wpdb->query("DROP TABLE IF EXISTS {$table_name}");

?>