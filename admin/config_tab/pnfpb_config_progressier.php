<?php
/**
 * Progressier configuration provider panel — modern card/grid layout.
 *
 * Included by pnfpb_admin_push_notification_configuration_content.php.
 *
 * @since 2.30.0
 */
?>
<div id="pnfpb_ic_progressier_configuration" class="pnfpb_ic_progressier_configuration pnfpb_config_tab_content pnfpb-provider-panel">

	<div class="pnfpb-provider-panel-header pnfpb-provider-panel-header--progressier">
		<div class="pnfpb-provider-panel-header-icon">
			<span class="dashicons dashicons-performance"></span>
		</div>
		<div class="pnfpb-provider-panel-header-text">
			<h3><?php esc_html_e( 'Progressier Configuration', 'push-notification-for-post-and-buddypress' ); ?></h3>
			<p><?php esc_html_e( 'Paid · Requires Progressier API Key · PWA-ready', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>
	</div>

	<div class="pnfpb-provider-panel-body">

		<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-bottom:8px;">
			<span class="dashicons dashicons-info"></span>
			<?php esc_html_e( 'Enabling Progressier requires a Progressier API key from your Progressier account.', 'push-notification-for-post-and-buddypress' ); ?>
		</div>
		<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-bottom:16px;">
			<span class="dashicons dashicons-info"></span>
			<?php esc_html_e( 'Only one provider (Firebase, OneSignal, or Progressier) can be active at a time. Enabling Progressier disables Firebase and OneSignal.', 'push-notification-for-post-and-buddypress' ); ?>
		</div>

		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-performance pnfpb-settings-section__icon"></span>
				<?php esc_html_e( 'Progressier Settings', 'push-notification-for-post-and-buddypress' ); ?>
			</h3>

			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

				<!-- Enable toggle — full width -->
				<div class="pnfpb-field-card" style="grid-column:1/-1;">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-performance"></span>
						<label for="pnfpb_progressier_push"><?php esc_html_e( 'Use Progressier as Push Notification Provider', 'push-notification-for-post-and-buddypress' ); ?></label>
					</div>
					<div class="pnfpb-field-card__control">
						<label class="pnfpb_switch">
							<input id="pnfpb_progressier_push"
								   name="pnfpb_progressier_push"
								   type="checkbox" value="1"
								   <?php checked( '1', get_option( 'pnfpb_progressier_push' ) ); ?> />
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( 'When enabled, Progressier will send push notifications instead of Firebase. Posts, custom post types, BuddyPress activities, group activities, private messages, and friendship events are supported.', 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>

				<!-- Progressier API Key -->
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-admin-network"></span>
						<label for="pnfpb_ic_fcm_progressier_api_key"><?php esc_html_e( 'Progressier API Key', 'push-notification-for-post-and-buddypress' ); ?></label>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field"
							   id="pnfpb_ic_fcm_progressier_api_key" name="pnfpb_ic_fcm_progressier_api_key"
							   type="text"
							   value="<?php echo esc_attr( get_option( 'pnfpb_ic_fcm_progressier_api_key' ) ); ?>" />
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Obtain your API key from your Progressier account dashboard.', 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>

				<!-- Limitations notice — full width -->
				<div class="pnfpb-field-card" style="grid-column:1/-1;">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-warning"></span>
						<?php esc_html_e( 'Feature Limitations', 'push-notification-for-post-and-buddypress' ); ?>
					</div>
					<div class="pnfpb-field-card__control" style="flex-direction:column;align-items:flex-start;gap:6px;font-size:13px;color:#50575e;">
						<p style="margin:0;"><?php esc_html_e( 'Custom bell prompt, renotify, replace notification, and notification-only-for-logged-in-users options are not available for Progressier.', 'push-notification-for-post-and-buddypress' ); ?></p>
						<p style="margin:0;"><?php esc_html_e( 'New member joined, group details update, group invitation, avatar change, and cover image change notifications are not available for Progressier.', 'push-notification-for-post-and-buddypress' ); ?></p>
					</div>
				</div>

			</div><!-- /.pnfpb-settings-grid -->
		</section>

	</div><!-- /.pnfpb-provider-panel-body -->
</div><!-- /#pnfpb_ic_progressier_configuration -->
