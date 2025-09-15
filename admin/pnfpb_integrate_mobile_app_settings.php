<?php
global $wpdb;
if (
	(isset($_POST["_wpnonce"])) && (isset($_POST["submit"]) || isset($_POST["disable_sw_file"])) &&
	(!wp_verify_nonce(esc_attr(sanitize_text_field(wp_unslash($_POST["_wpnonce"]))), "pnfpb_integrate_mobile_app_settings"))
) {
	die("wnonce failure");
} else {
	if (isset($_POST["submit"])) {
		$bytes = random_bytes(16);
		update_option(
			"PNFPB_icfcm_integrate_app_secret_code",
			bin2hex($bytes)
		);
	}

	if (
		isset($_POST["disable_sw_file"]) &&
		get_option(
			"pnfpb_ic_disable_serviceworker_pwa_pushnotification"
		) === "1"
	) {
		update_option(
			"pnfpb_ic_disable_serviceworker_pwa_pushnotification",
			null
		);
	} else {
		if (isset($_POST["disable_sw_file"])) {
			update_option(
				"pnfpb_ic_disable_serviceworker_pwa_pushnotification",
				"1"
			);
		}
	}
}
?>

<h1 class="pnfpb_ic_push_settings_header"><?php echo esc_html(
	__(
		"PNFPB - API for Mobile app integration",
		"push-notification-for-post-and-buddypress"
	)
); ?></h1>
<?php
$pnfpb_tab_mobileapp_active = "nav-tab-active";
require_once( plugin_dir_path( __FILE__ ) . 'push_admin_menu_list.php' );
?>

<div class="pnfpb_column_1200">
	<h2 class="pnfpb_ic_push_settings_header2"><?php echo esc_html(
	__(
		"Generate secret key for Android/Ios app integration",
		"push-notification-for-post-and-buddypress"
	)
); ?></h2>
	<h4 class="pnfpb_ic_push_settings_header2"><?php echo esc_html(
	__(
		"This secret key will be used to get subscription token in secured manner from Android/Ios app to store it in WordPress Database table to send push notifications for app users",
		"push-notification-for-post-and-buddypress"
	)
); ?></h4>
	<h4 class="pnfpb_ic_push_settings_header2"><?php echo esc_html(
	__(
		"Use this secret key in http post request using this rest api from app",
		"push-notification-for-post-and-buddypress"
	)
); ?></h4>
	<?php
		$pnfpb_nonce = wp_create_nonce("pnfpb_integrate_mobile_app_settings");
	?>
	<form method="post" enctype="multipart/form-data" class="form-field">
		<table class="pnfpb_ic_push_settings_table widefat fixed">
			<tbody>
				<tr  class="pnfpb_ic_push_settings_table_row">
					<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
						<div>
							<input type="hidden" name="_wpnonce" value="<?php echo esc_html($pnfpb_nonce); ?>" />
							<?php
								$pnfpb_nonce = wp_create_nonce("pnfpb_integrate_mobile_app_settings");
							?>
							<input type="hidden" name="_wpnonce" value="<?php echo esc_html($pnfpb_nonce); ?>" />
							<?php submit_button(
							__(
								"Generate/Change secret key",
								"push-notification-for-post-and-buddypress"
							),
							"primary"
							); ?>
						</div>
						<label>
							<?php echo esc_html(get_option("PNFPB_icfcm_integrate_app_secret_code")); ?>
						</label>
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
		<h4><?php echo esc_html(
	__(
		"Mobile app integration help on github respository",
		"push-notification-for-post-and-buddypress"
	)
); ?></h4>
		<ol>
			<li><a href="https://github.com/muraliwebworld/android-app-to-integrate-push-notification-wordpress-plugin" target="_blank"><?php echo esc_html(
	__(
		"Procedure/Sample code to Integrate Android mobile app with this plugin using API",
		"push-notification-for-post-and-buddypress"
	)
); ?></a></li>
			<li><a href="https://github.com/muraliwebworld/ios-swift-app-to-integrate-push-notification-wordpress-plugin" target="_blank"><?php echo esc_html(
	__(
		"Procedure/Sample code to Integrate IOS mobile app with this plugin using API",
		"push-notification-for-post-and-buddypress"
	)
); ?></a></li>
		</ol>
	</div>
	<br /><br />			
	<div><h2 class="pnfpb_ic_push_settings_header"><?php echo esc_html(
	__(
		"Disable push notification service worker file and PWA",
		"push-notification-for-post-and-buddypress"
	)
); ?></h2></div>
	<?php if (
	get_option("pnfpb_ic_disable_serviceworker_pwa_pushnotification") === "1"
) { ?>
	<p class="pnfpb_ic_red_color_text"><b><?php echo esc_html(
	__(
		"Currently, Service worker file is disabled/not created. if you need push notification and PWA in website, please enable service worker file using below option",
		"push-notification-for-post-and-buddypress"
	)
); ?></b></p>
	<?php } ?>
	<form method="post" enctype="multipart/form-data" class="form-field">
		<table class="pnfpb_ic_push_settings_table widefat fixed">
			<tbody>
				<tr  class="pnfpb_ic_push_settings_table_row">
					<td class="column-columnname">
						<?php
							if (get_option("pnfpb_ic_disable_serviceworker_pwa_pushnotification") === "1") 
							{ 
						?> 
							<div class="col-sm-10">
								<input type="hidden" name="_wpnonce" value="<?php echo esc_html($pnfpb_nonce); ?>" />
								<?php submit_button(
									__(
										"Enable service worker file",
										"push-notification-for-post-and-buddypress"
									),
									"primary",
									"disable_sw_file"
								); ?>
							</div>
					<?php 
						} 
						else 
						{ 
					?>
						<div class="col-sm-10">
								<?php submit_button(
							__(
								"Disable service worker file",
								"push-notification-for-post-and-buddypress"
							),
							"primary",
							"disable_sw_file"
							); ?>
						</div>		
					<?php } ?>
						<ul>
							<li>
								<?php echo esc_html(
								__(
									"This option will disable service worker file, it will switch off push notification service as well as it will switch off PWA. Use this option only, if you want to use this plugin for push notification services via REST API (example: for mobile app using WebView)",
									"push-notification-for-post-and-buddypress"
								)
								); ?>
							</li>
						</ul>
					</td>							
				</tr>							
			</tbody>
		</table>
	</form>
	<br/>
</div>