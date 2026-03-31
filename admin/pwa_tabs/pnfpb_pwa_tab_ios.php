<?php
/* PWA Sub-tab: iOS Devices
 * Included by pnfpb_admin_pwa_app_settings.php
 */
?>
<div id="pnfpb-pwa-ios-devices" class="pnfpb-pwa-settings-tab">

	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-smartphone pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'iOS Install Prompt', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Safari on iOS does not support the standard install prompt. This section shows a custom banner with manual install instructions.', 'push-notification-for-post-and-buddypress' ); ?></p>

		<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-bottom:20px;">
			<span class="dashicons dashicons-info pnfpb-info-box__icon"></span>
			<div>
				<strong><?php esc_html_e( 'How to install on iOS (Safari)', 'push-notification-for-post-and-buddypress' ); ?></strong>
				<ul style="list-style:disc;padding-left:18px;margin:6px 0 0;">
					<li><?php esc_html_e( 'Open the website in Safari (iOS/iPadOS).', 'push-notification-for-post-and-buddypress' ); ?></li>
					<li><?php esc_html_e( 'Tap the Share icon at the bottom of the screen.', 'push-notification-for-post-and-buddypress' ); ?></li>
					<li><?php esc_html_e( 'Scroll down in the share sheet and tap "Add to Home Screen".', 'push-notification-for-post-and-buddypress' ); ?></li>
					<li><?php esc_html_e( 'Give the app a name and tap "Add".', 'push-notification-for-post-and-buddypress' ); ?></li>
					<li><?php esc_html_e( 'The app icon will appear on your home screen.', 'push-notification-for-post-and-buddypress' ); ?></li>
					<li><?php esc_html_e( 'Open the app from the home screen — it will run in standalone mode.', 'push-notification-for-post-and-buddypress' ); ?></li>
				</ul>
			</div>
		</div>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-dismiss"></span>
					<?php esc_html_e( 'Disable iOS Prompt', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<label class="pnfpb_switch">
						<input id="pnfpb_ic_ios_pwa_prompt_disable"
							   name="pnfpb_ic_ios_pwa_prompt_disable"
							   type="checkbox" value="1"
							   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_ios_pwa_prompt_disable' ) ) ); ?> />
						<span class="pnfpb_slider round"></span>
					</label>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Turn off the iOS-specific install banner entirely.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-calendar-alt"></span>
					<?php esc_html_e( 'Re-show After (days)', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_ios_pwa_prompt_reappear"
						   name="pnfpb_ic_ios_pwa_prompt_reappear"
						   type="number" min="1"
						   value="<?php
							$_pnfpb_v = get_option( 'pnfpb_ic_ios_pwa_prompt_reappear' );
							echo esc_html( $_pnfpb_v ? $_pnfpb_v : '7' );
						?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Days before showing the iOS prompt again after dismissal.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

		</div>

	</section>

	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-format-chat pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'Banner Appearance', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Customize the text and colors of the iOS install instruction banner.', 'push-notification-for-post-and-buddypress' ); ?></p>

		<div class="pnfpb-field-card" style="margin-bottom:16px;">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-text-page"></span>
				<?php esc_html_e( 'Install Instructions', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<textarea class="pnfpb_ic_push_settings_table_value_column_input_field"
						  id="pnfpb-pwa-ios-message"
						  name="pnfpb-pwa-ios-message"
						  rows="3"
						  style="width:100%;"><?php
					$_pnfpb_v = get_option( 'pnfpb-pwa-ios-message' );
					echo esc_textarea( $_pnfpb_v ? $_pnfpb_v : __( "To install app on your device, tap the Share button in Safari. Scroll down and select 'Add to Home Screen'. Then tap 'Add' to place the app icon on your Home Screen.", 'push-notification-for-post-and-buddypress' ) );
				?></textarea>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Instructional text displayed in the iOS banner to guide users.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-appearance"></span>
					<?php esc_html_e( 'Banner Background Color', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_pwa_ios_prompt_dialog_background"
						   id="pnfpb_ic_fcm_pwa_ios_prompt_dialog_background"
						   name="pnfpb_ic_fcm_pwa_ios_prompt_dialog_background"
						   type="color" required="required"
						   value="<?php
							$_pnfpb_v = get_option( 'pnfpb_ic_fcm_pwa_ios_prompt_dialog_background' );
							echo esc_attr( $_pnfpb_v ? $_pnfpb_v : '#000000' );
						?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-editor-textcolor"></span>
					<?php esc_html_e( 'Banner Text Color', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_pwa_ios_prompt_text_color"
						   id="pnfpb_ic_fcm_pwa_ios_prompt_text_color"
						   name="pnfpb_ic_fcm_pwa_ios_prompt_text_color"
						   type="color" required="required"
						   value="<?php
							$_pnfpb_v = get_option( 'pnfpb_ic_fcm_pwa_ios_prompt_text_color' );
							echo esc_attr( $_pnfpb_v ? $_pnfpb_v : '#ffffff' );
						?>" />
				</div>
			</div>

		</div>

	</section>

	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-shortcode pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'Customize Shortcode', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Use the shortcode customizer to change the appearance of the PWA install button on any page.', 'push-notification-for-post-and-buddypress' ); ?></p>
		<div>
			<a class="button button-secondary"
			   href="<?php echo esc_url( admin_url( 'admin.php?page=pnfpb_icfm_button_settings#pwa-install-shortcode-customize-section' ) ); ?>">
				<span class="dashicons dashicons-admin-appearance" style="vertical-align:middle;"></span>
				<?php esc_html_e( 'Customize Shortcode Button', 'push-notification-for-post-and-buddypress' ); ?>
			</a>
		</div>
	</section>

</div>
