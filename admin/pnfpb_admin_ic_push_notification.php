<?php
/**
* Plugin settings area to store FireBase configuration, API key, server key
* Custom title for BuddyPress activity related push notification
*
* @since 1.0.0
*/
?>
<h1 class="pnfpb_ic_push_settings_header">
	<?php echo esc_html(
    	__(
        	"PNFPB - Settings for Push Notification",
        	"push-notification-for-post-and-buddypress"
    	)
	); ?>
</h1>

<div class="nav-tab-wrapper">
	<a href="<?php echo esc_url(
     admin_url()."admin.php?page=pnfpb-icfcm-slug"); ?>" 
	   class="nav-tab tab active nav-tab-active">
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

<div class="pnfpb_column_left_900">
	<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
    	<?php settings_fields("pnfpb_icfcm_group"); ?>
    	<?php do_settings_sections("pnfpb_icfcm_group"); ?>
		<?php
 			if (get_option("pnfpb_bell_icon_prompt_options_on_off", "0") === "0") {
     			update_option("pnfpb_bell_icon_prompt_options_on_off", "1");
 			}
 			$onesignalv3_settings = get_option("OneSignalWPSetting", []);
 			if (
     			!class_exists("OneSignal") &&
     			!function_exists("onesignal_init") &&
     			get_option("pnfpb_onesignal_push") === "1"
 			) { ?>
    			<div class="notice notice-error is-dismissible">
        			<p>
						<?php esc_html_e(
             				"Onesignal plugin is required. Please install Onesignal plugin to enable onesignal as push notification provider",
             				"push-notification-for-post-and-buddypress"
         				); ?>
					</p>
    			</div>		
			<?php } ?>
		<?php
	
			$args = ["public" => true, "_builtin" => false];
			$output = "names"; // or objects
			$operator = "and"; // 'and' or 'or'
			$custposttypes = get_post_types($args, $output, $operator);
			$blog_title = get_bloginfo("name");
	
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
    			],
    			"div" => [
        			"class" => [],
        			"input" => [
            			"class" => [],
            			"id" => [],
            			"name" => [],
            			"type" => [],
            			"value" => [],
        			],
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
    			get_option("pnfpb_sa_json_data") == false ||
    			get_option("pnfpb_sa_json_data") == ""
			) {
    			$pnfpb_sa = false;
			} else {
    			$pnfpb_sa = true;
			}
	
			if (
   	 			get_option("pnfpb_ic_fcm_activity_title") == false ||
    			get_option("pnfpb_ic_fcm_activity_title") == ""
			) {
    			$activitytitle = "[member name] posted new activity " . $blog_title;
			} else {
    			$activitytitle = get_option("pnfpb_ic_fcm_activity_title");
			}
	
			if (
    			get_option("pnfpb_ic_fcm_activity_message") == false ||
    			get_option("pnfpb_ic_fcm_activity_message") == ""
			) {
    			$activitymessage = "";
			} else {
    			$activitymessage = get_option("pnfpb_ic_fcm_activity_message");
			}
	
			if (
    			get_option("pnfpb_ic_fcm_group_activity_message") == false ||
    			get_option("pnfpb_ic_fcm_group_activity_message") == ""
			) {
    			$groupactivitymessage = "";
			} else {
    			$groupactivitymessage = get_option("pnfpb_ic_fcm_group_activity_message");
			}
	
			if (
    			get_option("pnfpb_ic_fcm_group_activity_title") == false ||
    			get_option("pnfpb_ic_fcm_group_activity_title") == ""
			) {
    			$activitygroup = "[member name] posted a new group post in [group name]";
			} else {
    			$activitygroup = get_option("pnfpb_ic_fcm_group_activity_title");
			}
	
			if (
    			get_option("pnfpb_ic_fcm_comment_activity_title") == false ||
    			get_option("pnfpb_ic_fcm_comment_activity_title") == ""
			) {
    			$activitycomment =
        			"[member name] posted a new comment posted in " . $blog_title;
			} else {
    			$activitycomment = get_option("pnfpb_ic_fcm_comment_activity_title");
			}
	
			if (
    			get_option("pnfpb_ic_fcm_comment_activity_message") == false ||
    			get_option("pnfpb_ic_fcm_comment_activity_message") == ""
			) {
    			$commentactivitymessage = "";
			} else {
    				$commentactivitymessage = get_option(
        				"pnfpb_ic_fcm_comment_activity_message"
    				);
			}
	
			if (
    			get_option("pnfpb_ic_fcm_bprivatemessage_content") == false ||
    			get_option("pnfpb_ic_fcm_bprivatemessage_content") == ""
			) {
    			$privatemessagecontent = "";
			} else {
    			$privatemessagecontent = get_option("pnfpb_ic_fcm_bprivatemessage_content");
			}
	
			if (
    			get_option("pnfpb_ic_fcm_new_member_content") == false ||
    			get_option("pnfpb_ic_fcm_new_member_content") == ""
			) {
    			$newmembercontent = "";
			} else {
    			$newmembercontent = get_option("pnfpb_ic_fcm_new_member_content");
			}
	
			if (
    			get_option("pnfpb_ic_fcm_friendship_request_content") == false ||
    			get_option("pnfpb_ic_fcm_friendship_request_content") == ""
			) {
    			$friendshiprequestcontent = "";
			} else {
    			$friendshiprequestcontent = get_option(
        			"pnfpb_ic_fcm_friendship_request_content"
    			);
			}
	
			if (
    			get_option("pnfpb_ic_fcm_friendship_accept_content") == false ||
    			get_option("pnfpb_ic_fcm_friendship_accept_content") == ""
			) {
    			$friendshipacceptcontent = "";
			} else {
    			$friendshipacceptcontent = get_option(
        			"pnfpb_ic_fcm_friendship_accept_content"
    			);
			}
	
			if (
    			get_option("pnfpb_ic_fcm_avatar_change_content") == false ||
    			get_option("pnfpb_ic_fcm_avatar_change_content") == ""
			) {
    			$avatarchangecontent = "";
			} else {
    			$avatarchangecontent = get_option("pnfpb_ic_fcm_avatar_change_content");
			}
	
			if (
    			get_option("pnfpb_ic_fcm_cover_image_change_content") == false ||
    			get_option("pnfpb_ic_fcm_cover_image_change_content") == ""
			) {
    			$coverimagechangecontent = "";
			} else {
    			$coverimagechangecontent = get_option(
        			"pnfpb_ic_fcm_cover_image_change_content"
    			);
			}
	
			if (
    			get_option("pnfpb_ic_fcm_group_details_updated_content") == false ||
    			get_option("pnfpb_ic_fcm_group_details_updated_content") == ""
			) {
    			$groupdetailsupdatedcontent = "";
			} else {
    			$groupdetailsupdatedcontent = get_option(
        			"pnfpb_ic_fcm_group_details_updated_content"
    			);
			}
	
			if (
    			get_option("pnfpb_ic_fcm_group_invitation_content") == false ||
    			get_option("pnfpb_ic_fcm_group_invitation_content") == ""
			) {
    			$groupinvitationcontent = "";
			} else {
    			$groupinvitationcontent = get_option(
        			"pnfpb_ic_fcm_group_invitation_content"
    			);
			}
	
			if (
    			get_option(
        			"pnfpb_ic_fcm_buddypress_new_user_registration_content_enable"
    			) == false ||
    			get_option(
        			"pnfpb_ic_fcm_buddypress_new_user_registration_content_enable"
    			) == ""
			) {
    			$newuserregistrationcontent = "";
			} else {
    			$newuserregistrationcontent = get_option(
        			"pnfpb_ic_fcm_buddypress_new_user_registration_content_enable"
    			);
			}
	
			if (
    			get_option("pnfpb_ic_fcm_buddypress_contact_form7_content_enable") ==
        		false ||
    			get_option("pnfpb_ic_fcm_buddypress_contact_form7_content_enable") == ""
			) {
    			$contactform7content = "";
			} else {
    			$contactform7content = get_option(
        			"pnfpb_ic_fcm_buddypress_contact_form7_content_enable"
    			);
			}
	
			$pnfpb_popup_subscribe_icon =
    			plugin_dir_url(__DIR__) . "public/img/pushbell-pnfpb.png";
		?>
	
			<h2 class="pnfpb_ic_push_settings_header2">
				<?php echo wp_kses_post(
    				__(
        				"Enable/Disable push notifications for following types",
        				"push-notification-for-post-and-buddypress"
    				)
				); ?>
			</h2>
	
			<table class="pnfpb_ic_push_notification_settings_table widefat fixed" cellspacing="0">
    			<tbody>
 					<?php
						require_once( plugin_dir_path( __FILE__ ) . 'pnfpb_admin_custom_push_prompt.php' );
						require_once( plugin_dir_path( __FILE__ ) . 'pnfpb_admin_push_settings_post.php' );
						require_once( plugin_dir_path( __FILE__ ) . 'pnfpb_admin_push_activities_comments_settings.php' );
						require_once( plugin_dir_path( __FILE__ ) . 'pnfpb_admin_buddypress_option_push_settings.php' );
					?>
				</tbody>
			</table>
			<?php
				require_once( plugin_dir_path( __FILE__ ) . 'pnfpb_admin_push_settings_firebase_service_account.php' );
				require_once( plugin_dir_path( __FILE__ ) . 'pnfpb_admin_push_notification_configuration.php' );
			?>
	</form>

	<?php if (get_option("pnfpb_ic_fcm_api")) { ?>
	
	<div>
    	<h3><?php echo esc_html(
        	__("Test Notification", "push-notification-for-post-and-buddypress")
    	); ?></h3>
    	<p><?php echo esc_html(
        	__(
            	"Click below link to send test notification to your subscribed device. Please make sure you already subscribed to notification for this website from browser",
            	"push-notification-for-post-and-buddypress"
        	)
    	); ?></p>
    	<a href="<?php echo esc_url(
        		admin_url("admin.php")
    		); ?>?page=pnfpb_icfmtest_notification"><?php echo wp_kses_post(
   			__("Test Notification", "push-notification-for-post-and-buddypress")
		); ?></a>
	</div>
	<?php } ?>
</div>

<div id="pnfpb-admin-right_sidebar" class="pnfpb_column_left_300 pnfpb-admin-right_sidebar" >
	
	<h4>
		<?php echo esc_html(
     		__("Need Help?", "push-notification-for-post-and-buddypress")
 		); ?>
	</h4>
	
	<ol>
	<li>
		<?php echo esc_html(
     		__("Check out the", "push-notification-for-post-and-buddypress")
 		); ?>
		<a href="https://wordpress.org/support/plugin/push-notification-for-post-and-buddypress/">
			<?php echo esc_html(
    			__("support forum", "push-notification-for-post-and-buddypress")
			); ?>
		</a> 
			<?php echo esc_html(
    			__("and", "push-notification-for-post-and-buddypress")
			); ?>
		<a href="https://wordpress.org/plugins/push-notification-for-post-and-buddypress/#do%20you%20have%20any%20questions%3F">
			<?php echo esc_html(
     			__("FAQ", "push-notification-for-post-and-buddypress")
 			); ?>
		</a>.
	</li>
	<li>
		<a href="https://github.com/muraliwebworld?tab=repositories" target="_blank">
			<?php echo esc_html(
     			__(
         			"Github repository sample code To Integrate mobile app with this plugin using API",
         			"push-notification-for-post-and-buddypress"
     			)
 			); ?>
		</a>
	</li>
	<li>
		<?php echo esc_html(
     		__("Visit ", "push-notification-for-post-and-buddypress")
 		); ?>
		<a href="https://wordpress.org/plugins/push-notification-for-post-and-buddypress/">
			<?php echo esc_html(
    			__("plugin homepage", "push-notification-for-post-and-buddypress")
			); ?>
		</a>.
	</li>
	<li>
		<?php echo esc_html(
     		__(
         		"If you need help, Please feel free to send us your queries",
         		"push-notification-for-post-and-buddypress"
     		)
 		); ?>
		<code>murali@indiacitys.com</code>
	</li>
	</ol>
	
	<h4>
		<?php echo wp_kses_post(
     		__("Rate This Plugin", "push-notification-for-post-and-buddypress")
 		); ?>
	</h4>
	<p>
		<?php echo esc_html(
     		__("Please", "push-notification-for-post-and-buddypress")
 		); ?>
	 	 <a href="https://wordpress.org/support/plugin/push-notification-for-post-and-buddypress/reviews/#new-post">
		 	<?php echo esc_html(
     			__("give your rating", "push-notification-for-post-and-buddypress")
 			); ?>
		</a>
		<?php echo esc_html(
    		__(" and feedback.", "push-notification-for-post-and-buddypress")
		); ?>
	</p>
	<h4>
		<?php echo esc_html(
     		__("Contribute/Donate", "push-notification-for-post-and-buddypress")
 		); ?>
	</h4>
	<p>
		<a href="https://www.muraliwebworld.com/support-to-push-notification-plugin-for-buddypress-and-for-post/">
			<?php echo esc_html(
     			__(
         			"Donate/Contribute to this plugin",
         			"push-notification-for-post-and-buddypress"
     			)
 			); ?>
		</a>
	</p>
	<h4>
		<?php echo esc_html(
     		__(
         		"Mobile app integration help on github respository",
         		"push-notification-for-post-and-buddypress"
     		)
 		); ?>
	</h4>
	
	<ol>
		
		<li>
			<a href="https://github.com/muraliwebworld/android-app-to-integrate-push-notification-wordpress-plugin" target="_blank">
				<?php echo esc_html(
     			__(
         			"Procedure/Sample code to Integrate Android mobile app with this plugin using API",
         			"push-notification-for-post-and-buddypress"
     			)
 				); ?>
			</a>
		</li>
		<li>
			<a href="https://github.com/muraliwebworld/ios-swift-app-to-integrate-push-notification-wordpress-plugin" target="_blank">
				<?php echo esc_html(
     				__(
         				"Procedure/Sample code to Integrate IOS mobile app with this plugin using API",
         				"push-notification-for-post-and-buddypress"
     				)
 				); ?>
			</a>
		</li>
		
	</ol>
	
	<h4>
		<?php echo esc_html(
     		__(
         		"Demo site using WordPress Playground to test this plugin",
         		"push-notification-for-post-and-buddypress"
     		)
 		); ?>
	</h4>
	
	<ol>
		
		<li>
			<a href="https://www.muraliwebworld.com" target="_blank">
				<?php echo esc_html(
     				__("Plugin support forum", "push-notification-for-post-and-buddypress")
 				); ?>
			</a>
		</li>

	</ol>
	
</div>