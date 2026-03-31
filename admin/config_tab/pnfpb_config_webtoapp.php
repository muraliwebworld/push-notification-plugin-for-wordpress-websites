<?php
/**
 * Webtoapp.design configuration provider panel — modern card/grid layout.
 *
 * Included by pnfpb_admin_push_notification_configuration_content.php.
 *
 * @since 2.30.0
 */
?>
<div id="pnfpb_ic_webtoapp_configuration" class="pnfpb_ic_webtoapp_configuration pnfpb_config_tab_content pnfpb-provider-panel">

	<div class="pnfpb-provider-panel-header pnfpb-provider-panel-header--webtoapp">
		<div class="pnfpb-provider-panel-header-icon">
			<span class="dashicons dashicons-smartphone"></span>
		</div>
		<div class="pnfpb-provider-panel-header-text">
			<h3><?php esc_html_e( 'Webtoapp.design Configuration', 'push-notification-for-post-and-buddypress' ); ?></h3>
			<p><?php esc_html_e( 'Paid · Android & iOS Mobile App · Works alongside Firebase/OneSignal', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>
	</div>

	<div class="pnfpb-provider-panel-body">

		<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-bottom:8px;">
			<span class="dashicons dashicons-info"></span>
			<?php esc_html_e( 'Webtoapp.design push notifications target Android/iOS mobile apps. When enabled, it works alongside Firebase/OneSignal — enabling Firebase/OneSignal alongside Webtoapp.design sends notifications to both desktop and the Webtoapp.design mobile app.', 'push-notification-for-post-and-buddypress' ); ?>
		</div>
		<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-bottom:16px;">
			<span class="dashicons dashicons-info"></span>
			<?php esc_html_e( 'Enabling Webtoapp.design requires a Webtoapp.design API key from your account.', 'push-notification-for-post-and-buddypress' ); ?>
		</div>

		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-smartphone pnfpb-settings-section__icon"></span>
				<?php esc_html_e( 'Webtoapp.design Settings', 'push-notification-for-post-and-buddypress' ); ?>
			</h3>

			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

				<!-- Enable toggle — full width -->
				<div class="pnfpb-field-card" style="grid-column:1/-1;">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-smartphone"></span>
						<label for="pnfpb_webtoapp_push"><?php esc_html_e( 'Use Webtoapp.design to Send Push Notifications', 'push-notification-for-post-and-buddypress' ); ?></label>
					</div>
					<div class="pnfpb-field-card__control">
						<label class="pnfpb_switch">
							<input id="pnfpb_webtoapp_push"
								   name="pnfpb_webtoapp_push"
								   type="checkbox" value="1"
								   <?php checked( '1', get_option( 'pnfpb_webtoapp_push' ) ); ?> />
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( 'When enabled, Webtoapp.design will send push notifications. Posts, custom post types, BuddyPress activities, group activities, private messages, and friendship events are supported.', 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>

				<!-- Webtoapp API Key -->
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-admin-network"></span>
						<label for="pnfpb_ic_fcm_webtoapp_api_key"><?php esc_html_e( 'Webtoapp.design API Key', 'push-notification-for-post-and-buddypress' ); ?></label>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field"
							   id="pnfpb_ic_fcm_webtoapp_api_key" name="pnfpb_ic_fcm_webtoapp_api_key"
							   type="text"
							   value="<?php echo esc_attr( get_option( 'pnfpb_ic_fcm_webtoapp_api_key' ) ); ?>" />
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Obtain your API key from your Webtoapp.design account.', 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>

				<!-- Limitations notice — full width -->
				<div class="pnfpb-field-card" style="grid-column:1/-1;">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-warning"></span>
						<?php esc_html_e( 'Feature Limitations', 'push-notification-for-post-and-buddypress' ); ?>
					</div>
					<div class="pnfpb-field-card__control" style="flex-direction:column;align-items:flex-start;gap:6px;font-size:13px;color:#50575e;">
						<p style="margin:0;"><?php esc_html_e( 'Custom bell prompt, renotify, replace notification, and notification-only-for-logged-in-users options are not available for Webtoapp.design.', 'push-notification-for-post-and-buddypress' ); ?></p>
						<p style="margin:0;"><?php esc_html_e( 'New member joined, group details update, group invitation, avatar change, and cover image change notifications are not available for Webtoapp.design.', 'push-notification-for-post-and-buddypress' ); ?></p>
					</div>
				</div>

			</div><!-- /.pnfpb-settings-grid -->
		</section>

	</div><!-- /.pnfpb-provider-panel-body -->
</div><!-- /#pnfpb_ic_webtoapp_configuration -->
