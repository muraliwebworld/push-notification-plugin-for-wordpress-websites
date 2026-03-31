<?php
global $wpdb;
if (
	( isset( $_POST["_wpnonce"] ) ) && ( isset( $_POST["submit"] ) || isset( $_POST["disable_sw_file"] ) ) &&
	( ! wp_verify_nonce( esc_attr( sanitize_text_field( wp_unslash( $_POST["_wpnonce"] ) ) ), "pnfpb_integrate_mobile_app_settings" ) )
) {
	die( "wnonce failure" );
} else {
	if ( isset( $_POST["submit"] ) ) {
		$pnfpb_bytes = random_bytes( 16 );
		update_option( "PNFPB_icfcm_integrate_app_secret_code", bin2hex( $pnfpb_bytes ) );
	}

	if (
		isset( $_POST["disable_sw_file"] ) &&
		get_option( "pnfpb_ic_disable_serviceworker_pwa_pushnotification" ) === "1"
	) {
		update_option( "pnfpb_ic_disable_serviceworker_pwa_pushnotification", null );
	} else {
		if ( isset( $_POST["disable_sw_file"] ) ) {
			update_option( "pnfpb_ic_disable_serviceworker_pwa_pushnotification", "1" );
		}
	}
}
?>
<h1 class="pnfpb_ic_push_settings_header"><?php echo esc_html( __( "PNFPB - Mobile App Integration", "push-notification-for-post-and-buddypress" ) ); ?></h1>
<?php
	$pnfpb_tab_mobileapp_active = "nav-tab-active";
	require_once( plugin_dir_path( __FILE__ ) . 'push_admin_menu_list.php' );
	$pnfpb_nonce = wp_create_nonce( "pnfpb_integrate_mobile_app_settings" );
?>

<div class="pnfpb_column_1200">

	<!-- ===== Info box ===== -->
	<div class="pnfpb-info-box pnfpb-info-box--blue">
		<span class="dashicons dashicons-smartphone pnfpb-info-box__icon"></span>
		<div>
			<strong><?php esc_html_e( "Android & iOS App Integration", "push-notification-for-post-and-buddypress" ); ?></strong>
			<p><?php esc_html_e( "Use the secret key below in an HTTP POST request from your mobile app to securely store the FCM subscription token in the WordPress database. Once stored, your site can send push notifications to native app users.", "push-notification-for-post-and-buddypress" ); ?></p>
		</div>
	</div>

	<!-- ===== Section 1: Secret Key ===== -->
	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-admin-network pnfpb-settings-section__icon"></span>
			<?php esc_html_e( "API Secret Key", "push-notification-for-post-and-buddypress" ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( "Generate a secret key to authenticate token requests from your Android/iOS app. Regenerate any time to invalidate the previous key.", "push-notification-for-post-and-buddypress" ); ?></p>

		<form method="post" enctype="multipart/form-data" class="form-field">
			<input type="hidden" name="_wpnonce" value="<?php echo esc_html( $pnfpb_nonce ); ?>" />
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-lock"></span>
						<?php esc_html_e( "Current Secret Key", "push-notification-for-post-and-buddypress" ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<?php $pnfpb_key = get_option( "PNFPB_icfcm_integrate_app_secret_code" ); ?>
						<?php if ( $pnfpb_key ) : ?>
						<code style="display:block;word-break:break-all;background:#F3F4F6;padding:8px 10px;border-radius:6px;font-size:12.5px;color:#374151;border:1px solid #E5E7EB;"><?php echo esc_html( $pnfpb_key ); ?></code>
						<?php else : ?>
						<p style="color:#9CA3AF;font-size:13px;margin:0;"><?php esc_html_e( "No key generated yet. Click the button to generate one.", "push-notification-for-post-and-buddypress" ); ?></p>
						<?php endif; ?>
					</div>
				</div>

				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-update"></span>
						<?php esc_html_e( "Generate / Regenerate Key", "push-notification-for-post-and-buddypress" ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<?php submit_button( __( "Generate / Change Secret Key", "push-notification-for-post-and-buddypress" ), "primary" ); ?>
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( "Generating a new key will immediately invalidate the previous one.", "push-notification-for-post-and-buddypress" ); ?></p>
				</div>

			</div>
		</form>
	</section>

	<!-- ===== Section 2: REST API Endpoint ===== -->
	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-rest-api pnfpb-settings-section__icon"></span>
			<?php esc_html_e( "REST API Endpoint", "push-notification-for-post-and-buddypress" ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( "Use this endpoint in your app to submit the FCM device token via HTTP POST.", "push-notification-for-post-and-buddypress" ); ?></p>
		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-networking"></span>
					<?php esc_html_e( "Subscription Token Endpoint", "push-notification-for-post-and-buddypress" ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<code style="display:block;word-break:break-all;background:#F3F4F6;padding:8px 10px;border-radius:6px;font-size:12.5px;color:#374151;border:1px solid #E5E7EB;"><?php echo esc_url( home_url( "/wp-json/PNFPBpush/v1/subscriptiontoken" ) ); ?></code>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( "HTTP method: POST. Include the secret key in the request body.", "push-notification-for-post-and-buddypress" ); ?></p>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-book-alt"></span>
					<?php esc_html_e( "SDK Integration Guides", "push-notification-for-post-and-buddypress" ); ?>
				</div>
				<div class="pnfpb-field-card__control" style="display:flex;flex-direction:column;gap:8px;">
					<a href="https://github.com/muraliwebworld/android-app-to-integrate-push-notification-wordpress-plugin"
					   target="_blank" rel="noopener noreferrer"
					   style="display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:600;color:#2563EB;text-decoration:none;">
						<span class="dashicons dashicons-android" style="font-size:15px;width:15px;height:15px;"></span>
						<?php esc_html_e( "Android Integration Guide", "push-notification-for-post-and-buddypress" ); ?>
						<span class="dashicons dashicons-external" style="font-size:12px;width:12px;height:12px;"></span>
					</a>
					<a href="https://github.com/muraliwebworld/ios-swift-app-to-integrate-push-notification-wordpress-plugin"
					   target="_blank" rel="noopener noreferrer"
					   style="display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:600;color:#2563EB;text-decoration:none;">
						<span class="dashicons dashicons-tablet" style="font-size:15px;width:15px;height:15px;"></span>
						<?php esc_html_e( "iOS (Swift) Integration Guide", "push-notification-for-post-and-buddypress" ); ?>
						<span class="dashicons dashicons-external" style="font-size:12px;width:12px;height:12px;"></span>
					</a>
					<a href="https://www.muraliwebworld.com/groups/wordpress-plugins-by-muralidharan-indiacitys-com-technologies/forum/topic/integrate-push-notification-for-post-buddypress-wp-in-mobile-app-webview/"
					   target="_blank" rel="noopener noreferrer"
					   style="display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:600;color:#2563EB;text-decoration:none;">
						<span class="dashicons dashicons-format-chat" style="font-size:15px;width:15px;height:15px;"></span>
						<?php esc_html_e( "Community Forum & Docs", "push-notification-for-post-and-buddypress" ); ?>
						<span class="dashicons dashicons-external" style="font-size:12px;width:12px;height:12px;"></span>
					</a>
				</div>
			</div>

		</div>
	</section>

	<!-- ===== Section 3: Service Worker / PWA ===== -->
	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-admin-tools pnfpb-settings-section__icon"></span>
			<?php esc_html_e( "Service Worker & PWA", "push-notification-for-post-and-buddypress" ); ?>
		</h3>

		<?php if ( get_option( "pnfpb_ic_disable_serviceworker_pwa_pushnotification" ) === "1" ) : ?>
		<div class="pnfpb-info-box" style="background:#FEF2F2;border-left-color:#EF4444;margin-bottom:16px;">
			<span class="dashicons dashicons-warning pnfpb-info-box__icon" style="color:#EF4444;"></span>
			<div>
				<strong style="color:#7F1D1D;"><?php esc_html_e( "Service Worker is Currently Disabled", "push-notification-for-post-and-buddypress" ); ?></strong>
				<p><?php esc_html_e( "Push notifications and PWA are switched off. Click the button below to re-enable the service worker file.", "push-notification-for-post-and-buddypress" ); ?></p>
			</div>
		</div>
		<?php endif; ?>

		<form method="post" enctype="multipart/form-data" class="form-field">
			<input type="hidden" name="_wpnonce" value="<?php echo esc_html( $pnfpb_nonce ); ?>" />
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-admin-generic"></span>
						<?php if ( get_option( "pnfpb_ic_disable_serviceworker_pwa_pushnotification" ) === "1" ) : ?>
						<?php esc_html_e( "Service Worker: Disabled", "push-notification-for-post-and-buddypress" ); ?>
						<?php else : ?>
						<?php esc_html_e( "Service Worker: Enabled", "push-notification-for-post-and-buddypress" ); ?>
						<?php endif; ?>
					</div>
					<div class="pnfpb-field-card__control">
						<?php if ( get_option( "pnfpb_ic_disable_serviceworker_pwa_pushnotification" ) === "1" ) : ?>
						<?php submit_button( __( "Enable Service Worker File", "push-notification-for-post-and-buddypress" ), "primary", "disable_sw_file" ); ?>
						<?php else : ?>
						<?php submit_button( __( "Disable Service Worker File", "push-notification-for-post-and-buddypress" ), "secondary", "disable_sw_file" ); ?>
						<?php endif; ?>
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( "Disabling stops push notification and PWA. Use this only when running this plugin exclusively via REST API (e.g. WebView-based mobile apps).", "push-notification-for-post-and-buddypress" ); ?></p>
				</div>

			</div>
		</form>
	</section>

</div>
