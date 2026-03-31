<?php
/**
 * OneSignal configuration provider panel — modern card/grid layout.
 *
 * Included by pnfpb_admin_push_notification_configuration_content.php.
 *
 * @since 2.30.0
 */
?>
<div id="pnfpb_ic_onesignal_configuration" class="pnfpb_ic_onesignal_configuration pnfpb_config_tab_content pnfpb-provider-panel">

	<div class="pnfpb-provider-panel-header pnfpb-provider-panel-header--onesignal">
		<div class="pnfpb-provider-panel-header-icon">
			<span class="dashicons dashicons-megaphone"></span>
		</div>
		<div class="pnfpb-provider-panel-header-text">
			<h3><?php esc_html_e( 'OneSignal Configuration', 'push-notification-for-post-and-buddypress' ); ?></h3>
			<p><?php esc_html_e( 'Freemium · Up to 10,000 subscribers free · Requires OneSignal plugin', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>
	</div>

	<div class="pnfpb-provider-panel-body">

		<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-bottom:8px;">
			<span class="dashicons dashicons-info"></span>
			<?php esc_html_e( 'Enabling OneSignal requires the OneSignal WordPress plugin to be installed and activated with its own configuration.', 'push-notification-for-post-and-buddypress' ); ?>
		</div>
		<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-bottom:16px;">
			<span class="dashicons dashicons-info"></span>
			<?php esc_html_e( 'Only one provider (Firebase, OneSignal, or Progressier) can be active at a time. Enabling OneSignal disables Firebase and Progressier.', 'push-notification-for-post-and-buddypress' ); ?>
		</div>

		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-megaphone pnfpb-settings-section__icon"></span>
				<?php esc_html_e( 'OneSignal Settings', 'push-notification-for-post-and-buddypress' ); ?>
			</h3>

			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

				<div class="pnfpb-field-card" style="grid-column:1/-1;">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-megaphone"></span>
						<label for="pnfpb_onesignal_push"><?php esc_html_e( 'Use OneSignal as Push Notification Provider', 'push-notification-for-post-and-buddypress' ); ?></label>
					</div>
					<div class="pnfpb-field-card__control">
						<label class="pnfpb_switch">
							<input id="pnfpb_onesignal_push"
								   name="pnfpb_onesignal_push"
								   type="checkbox" value="1"
								   <?php checked( '1', get_option( 'pnfpb_onesignal_push' ) ); ?> />
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( 'When enabled, OneSignal will send push notifications instead of Firebase. This uses credentials from the OneSignal plugin installed on your site.', 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>

			</div><!-- /.pnfpb-settings-grid -->
		</section>

	</div><!-- /.pnfpb-provider-panel-body -->
</div><!-- /#pnfpb_ic_onesignal_configuration -->
