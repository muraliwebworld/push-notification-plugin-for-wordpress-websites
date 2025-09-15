<?php
/**
* Plugin settings area to store FireBase configuration, API key, server key
* Custom title for BuddyPress activity related push notification
*
* @since 2.20.0
*/
use Minishlink\WebPush\VAPID;
?>
<h1 class="pnfpb_ic_push_settings_header">
	<?php echo esc_html(
    	__(
        	"PNFPB - Configurations for Push notification",
        	"push-notification-for-post-and-buddypress"
    	)
	); ?>
</h1>
<?php
	$pnfpb_tab_config_active = "nav-tab-active";
	require_once( plugin_dir_path( __FILE__ ) . 'push_admin_menu_list.php' );
?>

<div class="pnfpb_column_left_900">
	<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
    	<?php settings_fields("pnfpb_icfcm_group_config"); ?>
    	<?php do_settings_sections("pnfpb_icfcm_group_config"); ?>
		<?php
			$pnfpb_sa = false;
			if (
    			get_option("pnfpb_sa_json_data") == false ||
    			get_option("pnfpb_sa_json_data") == ""
			) {
    			$pnfpb_sa = false;
			} else {
    			$pnfpb_sa = true;
			}
			$webpush_option = get_option("pnfpb_webpush_push");
			$webpush_firebase = get_option("pnfpb_webpush_push_firebase");
			$webpush_vapid = '';
			if ($webpush_option === '1' || $webpush_option === '2' || $webpush_firebase === '1') {
				$webpush_vapid_public_key = get_option("pnfpb_web_push_vapid_public_key");
				$webpush_vapid_private_key = get_option("pnfpb_web_push_vapid_private_key");
				if (!$webpush_vapid_public_key || $webpush_vapid_public_key === null || $webpush_vapid_public_key === '' 
					|| !$webpush_vapid_private_key || $webpush_vapid_private_key === null || $webpush_vapid_private_key === '') {
					try {
						$vapidKeys = VAPID::createVapidKeys();
						$publicKey = $vapidKeys['publicKey'];
						$privateKey = $vapidKeys['privateKey'];
						
						update_option("pnfpb_web_push_vapid_public_key",$publicKey);
						update_option("pnfpb_web_push_vapid_private_key",$privateKey);

					} catch (Exception $e) {
						//error_log("Error generating VAPID keys: " . $e->getMessage() . "\n");
					}					
				}
			}
		
			/* verify whether web-push turned off */
			$pnfpb_disabled_push = "0";
			if (get_option("pnfpb_webpush_push") === false ) {
				$pnfpb_disabled_push = "3";
			} else {
				$pnfpb_disabled_push = get_option("pnfpb_webpush_push");
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
		require_once( plugin_dir_path( __FILE__ ) . 'pnfpb_admin_push_notification_configuration_content.php' );
		?>		
	</form>
</div>
<div id="pnfpb-admin-right_sidebar" class="pnfpb_column_left_300 pnfpb-admin-right_sidebar" >
	<ol>
		<li>
			<?php echo esc_html(
				__("To enable Post, custom post, BuddyPress push notifications go to ", "push-notification-for-post-and-buddypress")
			); ?>
			<a href="https://cdn75.indiacities.in/wp-admin/admin.php?page=pnfpb-icfcm-slug">
				<?php echo esc_html(
					__("Options tab", "push-notification-for-post-and-buddypress")
				); ?>
			</a> 
		</li>
		<li>
			<?php echo esc_html(
				__("Progressive Web App settings are in ", "push-notification-for-post-and-buddypress")
			); ?>
			<a href="https://cdn75.indiacities.in/wp-admin/admin.php?page=pnfpb_icfm_pwa_app_settings">
				<?php echo esc_html(
					__("PWA tab", "push-notification-for-post-and-buddypress")
				); ?>
			</a> 
		</li>		
	</ol>
	<h4>
		<?php echo esc_html(
     		__("Need Help?", "push-notification-for-post-and-buddypress")
 		); ?>
	</h4>
	<ol>
		<li>
			<?php echo esc_html(
				__("Required PHP version 8.1 or above", "push-notification-for-post-and-buddypress")
			); ?>		
		</li>		
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