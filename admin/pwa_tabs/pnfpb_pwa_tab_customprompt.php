<?php
/* PWA Sub-tab: Custom Prompt
 * Included by pnfpb_admin_pwa_app_settings.php
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<div id="pnfpb-pwa-custom-prompt" class="pnfpb-pwa-settings-tab">

	<!-- Section: Visibility -->
	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-admin-comments pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'Install Prompt Visibility', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Control when and on which devices the custom PWA install prompt is shown.', 'push-notification-for-post-and-buddypress' ); ?></p>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-comments"></span>
					<?php esc_html_e( 'Enable Custom Prompt', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<label class="pnfpb_switch">
						<input id="pnfpb_ic_pwa_app_custom_prompt_enable"
							   name="pnfpb_ic_pwa_app_custom_prompt_enable"
							   type="checkbox" value="1"
							   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_pwa_app_custom_prompt_enable' ) ) ); ?> />
						<span class="pnfpb_slider round"></span>
					</label>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Show install prompt on all supported devices.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-calendar-alt"></span>
					<?php esc_html_e( 'Re-show After (days)', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_fcm_pwa_show_again_days"
						   id="pnfpb_ic_fcm_pwa_show_again_days"
						   name="pnfpb_ic_fcm_pwa_show_again_days"
						   type="number" min="1"
						   value="<?php
							$_pnfpb_v = get_option( 'pnfpb_ic_fcm_pwa_show_again_days' );
							echo esc_html( $_pnfpb_v ? $_pnfpb_v : '7' );
						?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Days to wait before re-showing the prompt after it is dismissed.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

		</div>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--3col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-desktop"></span>
					<?php esc_html_e( 'Desktop Only', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<label class="pnfpb_switch">
						<input id="pnfpb_ic_pwa_app_desktop_custom_prompt_enable"
							   name="pnfpb_ic_pwa_app_desktop_custom_prompt_enable"
							   type="checkbox" value="1"
							   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_pwa_app_desktop_custom_prompt_enable' ) ) ); ?> />
						<span class="pnfpb_slider round"></span>
					</label>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Show only on desktop browsers.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-smartphone"></span>
					<?php esc_html_e( 'Mobile / Tablet Only', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<label class="pnfpb_switch">
						<input id="pnfpb_ic_pwa_app_mobile_custom_prompt_enable"
							   name="pnfpb_ic_pwa_app_mobile_custom_prompt_enable"
							   type="checkbox" value="1"
							   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_pwa_app_mobile_custom_prompt_enable' ) ) ); ?> />
						<span class="pnfpb_slider round"></span>
					</label>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Show only on mobile and tablet browsers.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-image-crop"></span>
					<?php esc_html_e( 'Min Width (px)', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control" style="display:flex;align-items:center;gap:10px;">
					<label class="pnfpb_switch">
						<input id="pnfpb_ic_pwa_app_pixels_custom_prompt_enable"
							   name="pnfpb_ic_pwa_app_pixels_custom_prompt_enable"
							   type="checkbox" value="1"
							   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_pwa_app_pixels_custom_prompt_enable' ) ) ); ?> />
						<span class="pnfpb_slider round"></span>
					</label>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable"
						   id="pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable"
						   name="pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable"
						   type="number" min="0" style="width:90px;"
						   value="<?php echo esc_html( get_option( 'pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable' ) ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Show only on devices wider than this many pixels.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

		</div>
	</section>

	<!-- Section: Prompt Text & Buttons -->
	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-editor-quote pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'Prompt Text & Buttons', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Customize the text shown inside the install prompt dialog.', 'push-notification-for-post-and-buddypress' ); ?></p>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--3col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-editor-textcolor"></span>
					<?php esc_html_e( 'Prompt Message', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_pwa_prompt_text"
						   name="pnfpb_ic_fcm_pwa_prompt_text"
						   type="text"
						   value="<?php
							$_pnfpb_v = get_option( 'pnfpb_ic_fcm_pwa_prompt_text' );
							echo esc_html( $_pnfpb_v ? $_pnfpb_v : __( 'Would like to install our app?', 'push-notification-for-post-and-buddypress' ) );
						?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Main message shown in the install dialog.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-yes-alt"></span>
					<?php esc_html_e( 'Install Button Text', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_pwa_prompt_confirm_button"
						   name="pnfpb_ic_fcm_pwa_prompt_confirm_button"
						   type="text"
						   value="<?php
							$_pnfpb_v = get_option( 'pnfpb_ic_fcm_pwa_prompt_confirm_button' );
							echo esc_html( $_pnfpb_v ? $_pnfpb_v : __( 'Install', 'push-notification-for-post-and-buddypress' ) );
						?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Label for the confirm/install button.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-no"></span>
					<?php esc_html_e( 'Cancel Button Text', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_pwa_prompt_cancel_button"
						   name="pnfpb_ic_fcm_pwa_prompt_cancel_button"
						   type="text"
						   value="<?php
							$_pnfpb_v = get_option( 'pnfpb_ic_fcm_pwa_prompt_cancel_button' );
							echo esc_html( $_pnfpb_v ? $_pnfpb_v : __( 'Cancel', 'push-notification-for-post-and-buddypress' ) );
						?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Label for the dismiss/cancel button.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

		</div>
	</section>

	<!-- Section: Prompt Colors -->
	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-art pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'Prompt Colors', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Customize the color scheme of the install prompt dialog.', 'push-notification-for-post-and-buddypress' ); ?></p>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-appearance"></span>
					<?php esc_html_e( 'Button Background Color', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_pwa_prompt_button_background"
						   id="pnfpb_ic_fcm_pwa_prompt_button_background"
						   name="pnfpb_ic_fcm_pwa_prompt_button_background"
						   type="color" required="required"
						   value="<?php
							$_pnfpb_v = get_option( 'pnfpb_ic_fcm_pwa_prompt_button_background' );
							echo esc_attr( $_pnfpb_v ? $_pnfpb_v : '#ffffff' );
						?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-appearance"></span>
					<?php esc_html_e( 'Button Text Color', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_pwa_prompt_button_text_color"
						   id="pnfpb_ic_fcm_pwa_prompt_button_text_color"
						   name="pnfpb_ic_fcm_pwa_prompt_button_text_color"
						   type="color" required="required"
						   value="<?php
							$_pnfpb_v = get_option( 'pnfpb_ic_fcm_pwa_prompt_button_text_color' );
							echo esc_attr( $_pnfpb_v ? $_pnfpb_v : '#161515' );
						?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-appearance"></span>
					<?php esc_html_e( 'Dialog Background Color', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_pwa_prompt_dialog_background"
						   id="pnfpb_ic_fcm_pwa_prompt_dialog_background"
						   name="pnfpb_ic_fcm_pwa_prompt_dialog_background"
						   type="color" required="required"
						   value="<?php
							$_pnfpb_v = get_option( 'pnfpb_ic_fcm_pwa_prompt_dialog_background' );
							echo esc_attr( $_pnfpb_v ? $_pnfpb_v : '#ffffff' );
						?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-editor-textcolor"></span>
					<?php esc_html_e( 'Dialog Text Color', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_pwa_prompt_text_color"
						   id="pnfpb_ic_fcm_pwa_prompt_text_color"
						   name="pnfpb_ic_fcm_pwa_prompt_text_color"
						   type="color" required="required"
						   value="<?php
							$_pnfpb_v = get_option( 'pnfpb_ic_fcm_pwa_prompt_text_color' );
							echo esc_attr( $_pnfpb_v ? $_pnfpb_v : '#161515' );
						?>" />
				</div>
			</div>

		</div>
	</section>

	<!-- Section: Post-Install Dialog -->
	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-yes-alt pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'Post-Install Confirmation', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Customize the popup shown after the app has been installed successfully.', 'push-notification-for-post-and-buddypress' ); ?></p>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-heading"></span>
					<?php esc_html_e( 'Title', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb-pwa-dialog-app-installed_text"
						   name="pnfpb-pwa-dialog-app-installed_text"
						   type="text" maxlength="100"
						   value="<?php
							$_pnfpb_v = get_option( 'pnfpb-pwa-dialog-app-installed_text' );
							echo esc_html( $_pnfpb_v ? $_pnfpb_v : __( 'App installed successfully', 'push-notification-for-post-and-buddypress' ) );
						?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-text-page"></span>
					<?php esc_html_e( 'Description', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb-pwa-dialog-app-installed_description"
						   name="pnfpb-pwa-dialog-app-installed_description"
						   type="text" maxlength="500"
						   value="<?php
							$_pnfpb_v = get_option( 'pnfpb-pwa-dialog-app-installed_description' );
							echo esc_html( $_pnfpb_v ? $_pnfpb_v : __( 'Progressive Web App (PWA) is installed successfully. It will also work in offline', 'push-notification-for-post-and-buddypress' ) );
						?>" />
				</div>
			</div>

		</div>

		<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-top:16px;">
			<span class="dashicons dashicons-info pnfpb-info-box__icon"></span>
			<div>
				<strong><?php esc_html_e( 'Browser Support', 'push-notification-for-post-and-buddypress' ); ?></strong>
				<p><?php esc_html_e( 'PWA is supported by Chrome (Desktop & Mobile), Edge, Opera for Android, Edge for Android, Brave, and Samsung Internet. Firefox desktop has limited support.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>
		</div>

	</section>

</div>
