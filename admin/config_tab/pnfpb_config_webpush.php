<?php
/**
 * Web-Push (self-hosted) configuration provider panel — modern card/grid layout.
 *
 * Included by pnfpb_admin_push_notification_configuration_content.php.
 * Variables available from parent scope: $pnfpb_disabled_push
 *
 * @since 2.30.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<div id="pnfpb_ic_webpush_configuration" class="pnfpb_ic_webpush_configuration pnfpb_config_tab_content pnfpb-provider-panel">

	<div class="pnfpb-provider-panel-header pnfpb-provider-panel-header--webpush">
		<div class="pnfpb-provider-panel-header-icon">
			<span class="dashicons dashicons-bell"></span>
		</div>
		<div class="pnfpb-provider-panel-header-text">
			<h3><?php esc_html_e( 'Web-Push (Self-hosted) Configuration', 'push-notification-for-post-and-buddypress' ); ?></h3>
			<p><?php esc_html_e( 'Free · Browser & PWA Subscriptions · VAPID Keys', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>
	</div>

	<div class="pnfpb-provider-panel-body">

		<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-bottom:16px;">
			<span class="dashicons dashicons-info"></span>
			<?php esc_html_e( 'Web-Push also works alongside Firebase — e.g. Web-Push handles browser/PWA subscriptions while Firebase handles native/hybrid mobile apps on Play Store / App Store.', 'push-notification-for-post-and-buddypress' ); ?>
		</div>

		<!-- Web-Push Mode selection -->
		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-controls-play pnfpb-settings-section__icon"></span>
				<?php esc_html_e( 'Web-Push Mode', 'push-notification-for-post-and-buddypress' ); ?>
			</h3>

			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

				<!-- Radio group — full width -->
				<div class="pnfpb-field-card" style="grid-column:1/-1;">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-admin-settings"></span>
						<?php esc_html_e( 'Select Web-Push Mode', 'push-notification-for-post-and-buddypress' ); ?>
					</div>
					<div class="pnfpb-field-card__control" style="flex-direction:column;align-items:flex-start;gap:12px;">

						<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;">
							<input style="width:16px;height:16px;cursor:pointer;"
								   id="pnfpb_webpush_push_disable"
								   name="pnfpb_webpush_push"
								   type="radio" value="3"
								   <?php checked( '3', $pnfpb_disabled_push ); ?> />
							<?php esc_html_e( 'Disable Web-Push (turns off all web-push notifications)', 'push-notification-for-post-and-buddypress' ); ?>
						</label>

						<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;">
							<input style="width:16px;height:16px;cursor:pointer;"
								   id="pnfpb_webpush_push_auto"
								   name="pnfpb_webpush_push"
								   type="radio" value="1"
								   <?php checked( '1', esc_attr( get_option( 'pnfpb_webpush_push' ) ) ); ?> />
							<?php esc_html_e( 'Enable Web-Push with auto-generated VAPID keys', 'push-notification-for-post-and-buddypress' ); ?>
						</label>

						<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;">
							<input style="width:16px;height:16px;cursor:pointer;"
								   id="pnfpb_webpush_push_firebase"
								   name="pnfpb_webpush_push"
								   type="radio" value="2"
								   <?php checked( '2', esc_attr( get_option( 'pnfpb_webpush_push' ) ) ); ?> />
							<?php esc_html_e( 'Enable Web-Push with Firebase VAPID keys (use when migrating from Firebase)', 'push-notification-for-post-and-buddypress' ); ?>
						</label>

					</div>
				</div>

			</div><!-- /.pnfpb-settings-grid -->
		</section>

		<!-- Firebase VAPID keys (option 2 only) -->
		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-lock pnfpb-settings-section__icon"></span>
				<?php esc_html_e( 'Firebase VAPID Keys', 'push-notification-for-post-and-buddypress' ); ?>
			</h3>

			<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-bottom:16px;">
				<span class="dashicons dashicons-info"></span>
				<?php esc_html_e( 'The fields below are required only when "Enable with Firebase VAPID keys" (option 3) is selected above — used when migrating notification subscriptions from Firebase to Web-Push.', 'push-notification-for-post-and-buddypress' ); ?>
			</div>

			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

				<!-- Firebase Public VAPID Key -->
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-admin-network"></span>
						<label for="pnfpb_webpush_firebase_public_key"><?php esc_html_e( 'Firebase Public VAPID Key', 'push-notification-for-post-and-buddypress' ); ?></label>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field"
							   id="pnfpb_webpush_firebase_public_key" name="pnfpb_webpush_firebase_public_key"
							   type="text"
							   value="<?php echo esc_attr( get_option( 'pnfpb_webpush_firebase_public_key' ) ); ?>" />
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Firebase console → Project settings → Cloud Messaging → Web configuration → Web Push Certificate.', 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>

				<!-- Firebase Private VAPID Key -->
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-lock"></span>
						<label for="pnfpb_webpush_firebase_private_key"><?php esc_html_e( 'Firebase Private VAPID Key', 'push-notification-for-post-and-buddypress' ); ?></label>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field"
							   id="pnfpb_webpush_firebase_private_key" name="pnfpb_webpush_firebase_private_key"
							   type="password"
							   value="<?php echo esc_attr( get_option( 'pnfpb_webpush_firebase_private_key' ) ); ?>" />
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Firebase console → Project settings → Cloud Messaging → Web configuration → Web Push Certificate → Show private key.', 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>

			</div><!-- /.pnfpb-settings-grid -->
		</section>

		<!-- Enable alongside Firebase -->
		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-share pnfpb-settings-section__icon"></span>
				<?php esc_html_e( 'Combined Delivery', 'push-notification-for-post-and-buddypress' ); ?>
			</h3>

			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

				<div class="pnfpb-field-card" style="grid-column:1/-1;">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-cloud"></span>
						<label for="pnfpb_webpush_push_firebase_toggle"><?php esc_html_e( 'Enable Web-Push Alongside Firebase', 'push-notification-for-post-and-buddypress' ); ?></label>
					</div>
					<div class="pnfpb-field-card__control">
						<label class="pnfpb_switch">
							<input id="pnfpb_webpush_push_firebase_toggle"
								   name="pnfpb_webpush_push_firebase"
								   type="checkbox" value="1"
								   <?php checked( '1', get_option( 'pnfpb_webpush_push_firebase' ) ); ?> />
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( 'When enabled, Web-Push sends notifications to desktop/mobile browser subscriptions while Firebase handles native mobile apps on Play Store/App Store.', 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>

			</div><!-- /.pnfpb-settings-grid -->
		</section>

	</div><!-- /.pnfpb-provider-panel-body -->
</div><!-- /#pnfpb_ic_webpush_configuration -->
