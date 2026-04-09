<?php
/*
 * Customize Frontend custom push prompt - admin settings
 * @since 2.08
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

<?php /* ─── Section: Custom Push Prompt ─────────────────────────────────── */ ?>
<section class="pnfpb-settings-section">
	<h3 class="pnfpb-settings-section__title">
		<span class="dashicons dashicons-bell pnfpb-settings-section__icon"></span>
		<?php esc_html_e( 'Custom Push Prompt', 'push-notification-for-post-and-buddypress' ); ?>
	</h3>
	<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Customizable subscription prompt. Required for Apple devices, PWA, and Firefox Android.', 'push-notification-for-post-and-buddypress' ); ?></p>

	<div class="pnfpb-settings-grid">
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-visibility"></span>
				<?php esc_html_e( 'Show Custom Prompt', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_push_prompt_enable" name="pnfpb_ic_fcm_push_prompt_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', get_option( 'pnfpb_ic_fcm_push_prompt_enable' ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
				<button type="button" class="pnfpb_custom_push_prompt_button button button-secondary"
						onclick="toggle_custom_push_prompt_form()">
					<?php esc_html_e( 'Customize', 'push-notification-for-post-and-buddypress' ); ?>
				</button>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Show custom subscription prompt to site visitors.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>
	</div>
</section>

<?php /* ─── Hidden Customization Panel ──────────────────────────────────── */ ?>
<div class="pnfpb_ic_push_prompt_form">

	<?php /* ── Sub-section: Prompt Style ─────────────────────── */ ?>
	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-art pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'Prompt Style', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Select a prompt layout and optionally enable the floating Bell icon.', 'push-notification-for-post-and-buddypress' ); ?></p>

		<div class="pnfpb-settings-grid" style="grid-template-columns:repeat(3,1fr);gap:16px;">

			<!-- Style 1 -->
			<div class="pnfpb-field-card" style="align-items:center;text-align:center;">
				<div class="pnfpb-push-msg-model-outer-container" style="margin-bottom:12px;">
					<div class="pnfpb-push-msg-model-container">
						<div class="pnfpb-push-model-icon"><div class="pnfpb-push-msg-model-square"></div></div>
						<div class="pnfpb-push-msg-model-text-layout">
							<div class="pnfpb-push-msg-model-text-long-line"></div>
							<div class="pnfpb-push-msg-model-text-line"></div>
							<div class="pnfpb-push-msg-model-cancel-button"></div>
							<div class="pnfpb-push-msg-model-yes-button"></div>
						</div>
					</div>
				</div>
				<div class="pnfpb-field-card__label" style="justify-content:center;">
					<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container pnfpb_padding_top_8">
						<?php esc_html_e( 'Prompt Style 1', 'push-notification-for-post-and-buddypress' ); ?>
						<input id="pnfpb_ic_fcm_prompt_style_1" name="pnfpb_ic_fcm_prompt_style"
							   type="radio" value="1"
							   <?php checked( '1', get_option( 'pnfpb_ic_fcm_prompt_style' ) ); ?> />
						<span class="pnfpb_checkmark pnfpb_margin_top_6"></span>
					</label>
				</div>
			</div>

			<!-- Style 2 -->
			<div class="pnfpb-field-card" style="align-items:center;text-align:center;">
				<div class="pnfpb-push-msg-model-outer-container" style="margin-bottom:12px;">
					<div class="pnfpb-push-msg-vertical-model-container">
						<div class="pnfpb-push-msg-vertical-model-text-layout">
							<div class="pnfpb-push-vertical-model-icon"><div class="pnfpb-push-msg-model-square"></div></div>
							<div class="pnfpb-push-msg-vertical-model-text-long-line"></div>
							<div class="pnfpb-push-msg-vertical-model-text-line"></div>
							<div class="pnfpb-push-msg-vertical-model-cancel-button"></div>
							<div class="pnfpb-push-msg-vertical-model-yes-button"></div>
						</div>
					</div>
				</div>
				<div class="pnfpb-field-card__label" style="justify-content:center;">
					<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container pnfpb_padding_top_8">
						<?php esc_html_e( 'Prompt Style 2', 'push-notification-for-post-and-buddypress' ); ?>
						<input id="pnfpb_ic_fcm_prompt_style_2" name="pnfpb_ic_fcm_prompt_style"
							   type="radio" value="2"
							   <?php checked( '2', get_option( 'pnfpb_ic_fcm_prompt_style' ) ); ?> />
						<span class="pnfpb_checkmark pnfpb_margin_top_6"></span>
					</label>
				</div>
			</div>

			<!-- Bell prompt toggle -->
			<div class="pnfpb-field-card" style="align-items:center;text-align:center;">
				<div class="pnfpb-push-msg-model-outer-container" style="margin-bottom:12px;">
					<div class="pnfpb-push-msg-vertical-model-container">
						<div class="pnfpb-push-msg-vertical-model-text-layout">
							<div class="pnfpb-push-vertical-model-bell">
								<div class="pnfpb-push-msg-vertical-model-bell-square">
									<a href="#">
										<img src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . 'public/img/pushbell-pnfpb.png' ); ?>"
											 width="30" height="30" alt="bell" />
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="pnfpb-field-card__label" style="justify-content:center;">
					<?php esc_html_e( 'Bell Prompt', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control" style="justify-content:center;">
					<label class="pnfpb_switch">
						<input id="pnfpb_ic_fcm_prompt_style3" name="pnfpb_ic_fcm_prompt_style3"
							   type="checkbox" value="1"
							   <?php checked( '1', get_option( 'pnfpb_ic_fcm_prompt_style3' ) ); ?> />
						<span class="pnfpb_slider round"></span>
					</label>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Enable floating bell icon on the site.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<!-- Prompt style on/off toggle -->
			<div class="pnfpb-field-card" style="grid-column:1/-1;">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-controls-play"></span>
					<?php esc_html_e( 'Enable Prompt Style', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<label class="pnfpb_switch">
						<input id="pnfpb_ic_fcm_prompt_on_off" name="pnfpb_ic_fcm_prompt_on_off"
							   type="checkbox" value="1"
							   <?php checked( '1', get_option( 'pnfpb_ic_fcm_prompt_on_off' ) ); ?> />
						<span class="pnfpb_slider round"></span>
					</label>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'If disabled, the browser native prompt is used instead of the custom modal.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

		</div>
	</section>

	<?php /* ── Sub-section: Customize Popup Prompt ─────────────────────── */ ?>
	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-admin-customizer pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'Customize Popup Prompt (Style 1 & 2)', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<!-- Icon Upload -->
			<div class="pnfpb-field-card" style="grid-column:1/-1;">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-format-image"></span>
					<?php esc_html_e( 'Custom Prompt Icon (recommended 80×80 px)', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<button id="pnfpb_ic_fcm_popup_custom_prompt_icon"
							class="pnfpb_ic_push_settings_upload_icon button button-secondary">
						<?php esc_html_e( 'Upload Icon', 'push-notification-for-post-and-buddypress' ); ?>
					</button>
					<input type="hidden"
						   id="pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon"
						   name="pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon' ); echo $v ? esc_attr( $v ) : esc_url( plugin_dir_url( __DIR__ ) . 'public/img/pushbell-pnfpb.png' ); ?>" />
					<div id="pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon_preview"
						 style="width:40px;height:40px;border-radius:50%;background-size:cover;background-position:center;background-image:url(<?php $v = get_option( 'pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon' ); echo $v ? esc_url( $v ) : esc_url( plugin_dir_url( __DIR__ ) . 'public/img/pushbell-pnfpb.png' ); ?>);"></div>
				</div>
			</div>

			<!-- Animation style -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-dashicons-controls-repeat"></span>
					<?php esc_html_e( 'Animation Style', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<select id="pnfpb_ic_fcm_custom_prompt_animation" name="pnfpb_ic_fcm_custom_prompt_animation">
						<option value="slideDown" <?php selected( 'slideDown', get_option( 'pnfpb_ic_fcm_custom_prompt_animation' ) ); ?>>
							<?php esc_html_e( 'Slide Down', 'push-notification-for-post-and-buddypress' ); ?>
						</option>
						<option value="slideUp" <?php selected( 'slideUp', get_option( 'pnfpb_ic_fcm_custom_prompt_animation' ) ); ?>>
							<?php esc_html_e( 'Slide Up', 'push-notification-for-post-and-buddypress' ); ?>
						</option>
					</select>
				</div>
			</div>

			<!-- Show again after N days -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-calendar-alt"></span>
					<?php esc_html_e( 'Re-show After Cancel (days)', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_custom_prompt_show_again_days"
						   name="pnfpb_ic_fcm_custom_prompt_show_again_days"
						   type="number" min="1"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_custom_prompt_show_again_days' ); echo esc_attr( $v ? $v : '7' ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Number of days before re-showing the prompt after a user clicks Cancel.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<!-- Header text line 1 -->
			<div class="pnfpb-field-card" style="grid-column:1/-1;">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-editor-paragraph"></span>
					<?php esc_html_e( 'Header Text (Line 1)', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<textarea class="pnfpb_ic_push_settings_table_value_column_input_field"
							  id="pnfpb_ic_fcm_custom_prompt_header_text"
							  name="pnfpb_ic_fcm_custom_prompt_header_text"><?php $v = get_option( 'pnfpb_ic_fcm_custom_prompt_header_text' ); echo $v ? esc_textarea( $v ) : esc_textarea( __( 'We would like to show you notifications for the latest news and updates.', 'push-notification-for-post-and-buddypress' ) ); ?></textarea>
				</div>
			</div>

			<!-- Header text line 2 -->
			<div class="pnfpb-field-card" style="grid-column:1/-1;">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-editor-paragraph"></span>
					<?php esc_html_e( 'Header Text (Line 2)', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<textarea class="pnfpb_ic_push_settings_table_value_column_input_field"
							  id="pnfpb_ic_fcm_custom_prompt_header_text_line_2"
							  name="pnfpb_ic_fcm_custom_prompt_header_text_line_2"><?php echo esc_textarea( get_option( 'pnfpb_ic_fcm_custom_prompt_header_text_line_2', '' ) ); ?></textarea>
				</div>
			</div>

			<!-- Confirmation message -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-yes-alt"></span>
					<?php esc_html_e( 'Subscribed Confirmation Message', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<textarea class="pnfpb_ic_push_settings_table_value_column_input_field"
							  id="pnfpb_ic_fcm_custom_prompt_subscribed_text"
							  name="pnfpb_ic_fcm_custom_prompt_subscribed_text"><?php $v = get_option( 'pnfpb_ic_fcm_custom_prompt_subscribed_text' ); echo $v ? esc_textarea( $v ) : esc_textarea( __( 'You are subscribed to notifications', 'push-notification-for-post-and-buddypress' ) ); ?></textarea>
				</div>
			</div>

			<!-- Hide confirmation message -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-hidden"></span>
					<?php esc_html_e( 'Hide Confirmation Message', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<label class="pnfpb_switch">
						<input id="pnfpb_custom_prompt_confirmation_message_on_off"
							   name="pnfpb_custom_prompt_confirmation_message_on_off"
							   type="checkbox" value="1"
							   <?php checked( '1', get_option( 'pnfpb_custom_prompt_confirmation_message_on_off' ) ); ?> />
						<span class="pnfpb_slider round"></span>
					</label>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Hide the confirmation message that appears after a user subscribes.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<!-- Wait message (popup) -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-clock"></span>
					<?php esc_html_e( 'Wait Message', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_custom_prompt_popup_wait_message"
						   name="pnfpb_ic_fcm_custom_prompt_popup_wait_message"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_custom_prompt_popup_wait_message' ); echo esc_attr( $v ? $v : __( 'Please wait...processing', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<!-- Show subscription options -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-list-view"></span>
					<?php esc_html_e( 'Show Subscription Options', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<label class="pnfpb_switch">
						<input id="pnfpb_custom_prompt_options_on_off" name="pnfpb_custom_prompt_options_on_off"
							   type="checkbox" value="1"
							   <?php checked( '1', get_option( 'pnfpb_custom_prompt_options_on_off' ) ); ?> />
						<span class="pnfpb_slider round"></span>
					</label>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Show subscription category selector button in the popup prompt.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

		</div>

		<h4 style="margin:20px 0 8px;"><?php esc_html_e( 'Allow Button', 'push-notification-for-post-and-buddypress' ); ?></h4>
		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-art"></span>
					<?php esc_html_e( 'Allow Button Text Color', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_custom_prompt_allow_button_background"
						   id="pnfpb_ic_fcm_custom_prompt_allow_button_text_color"
						   name="pnfpb_ic_fcm_custom_prompt_allow_button_text_color"
						   type="color"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_custom_prompt_allow_button_text_color' ); echo esc_attr( $v ? $v : '#ffffff' ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-color-picker"></span>
					<?php esc_html_e( 'Allow Button Background Color', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_custom_prompt_allow_button_background"
						   id="pnfpb_ic_fcm_push_custom_prompt_allow_button_background"
						   name="pnfpb_ic_fcm_push_custom_prompt_allow_button_background"
						   type="color"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_push_custom_prompt_allow_button_background' ); echo esc_attr( $v ? $v : '#0078d1' ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-editor-textcolor"></span>
					<?php esc_html_e( 'Allow Button Text', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_custom_prompt_allow_button_text"
						   name="pnfpb_ic_fcm_custom_prompt_allow_button_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_custom_prompt_allow_button_text' ); echo esc_attr( $v ? $v : __( 'Allow', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

		</div>

		<h4 style="margin:20px 0 8px;"><?php esc_html_e( 'Cancel Button', 'push-notification-for-post-and-buddypress' ); ?></h4>
		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-art"></span>
					<?php esc_html_e( 'Cancel Button Text Color', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_custom_prompt_cancel_button_background"
						   id="pnfpb_ic_fcm_custom_prompt_cancel_button_text_color"
						   name="pnfpb_ic_fcm_custom_prompt_cancel_button_text_color"
						   type="color"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_custom_prompt_cancel_button_text_color' ); echo esc_attr( $v ? $v : '#0078d1' ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-color-picker"></span>
					<?php esc_html_e( 'Cancel Button Background Color', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_custom_prompt_cancel_button_background"
						   id="pnfpb_ic_fcm_push_custom_prompt_cancel_button_background"
						   name="pnfpb_ic_fcm_push_custom_prompt_cancel_button_background"
						   type="color"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_push_custom_prompt_cancel_button_background' ); echo esc_attr( $v ? $v : '#ffffff' ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-editor-textcolor"></span>
					<?php esc_html_e( 'Cancel Button Text', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_custom_prompt_cancel_button_text"
						   name="pnfpb_ic_fcm_custom_prompt_cancel_button_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_custom_prompt_cancel_button_text' ); echo esc_attr( $v ? $v : __( 'Cancel', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

		</div>

		<h4 style="margin:20px 0 8px;"><?php esc_html_e( 'Close Button', 'push-notification-for-post-and-buddypress' ); ?></h4>
		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-art"></span>
					<?php esc_html_e( 'Close Button Text Color', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_custom_prompt_close_button_background"
						   id="pnfpb_ic_fcm_custom_prompt_close_button_text_color"
						   name="pnfpb_ic_fcm_custom_prompt_close_button_text_color"
						   type="color"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_custom_prompt_close_button_text_color' ); echo esc_attr( $v ? $v : '#0078d1' ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-color-picker"></span>
					<?php esc_html_e( 'Close Button Background Color', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_custom_prompt_close_button_background"
						   id="pnfpb_ic_fcm_push_custom_prompt_close_button_background"
						   name="pnfpb_ic_fcm_push_custom_prompt_close_button_background"
						   type="color"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_push_custom_prompt_close_button_background' ); echo esc_attr( $v ? $v : '#ffffff' ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-editor-textcolor"></span>
					<?php esc_html_e( 'Close Button Text', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_custom_prompt_close_button_text"
						   name="pnfpb_ic_fcm_custom_prompt_close_button_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_custom_prompt_close_button_text' ); echo esc_attr( $v ? $v : __( 'Close', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

		</div>
	</section>

	<?php /* ── Sub-section: Customize Bell Prompt ─────────────────────── */ ?>
	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-bell pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'Customize Bell Prompt', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<!-- Bell Icon Upload -->
			<div class="pnfpb-field-card" style="grid-column:1/-1;">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-format-image"></span>
					<?php esc_html_e( 'Bell Icon (32×32 px)', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<button id="pnfpb_ic_fcm_popup_icon" class="pnfpb_ic_push_settings_upload_icon button button-secondary">
						<?php esc_html_e( 'Upload Icon', 'push-notification-for-post-and-buddypress' ); ?>
					</button>
					<input type="hidden"
						   id="pnfpb_ic_fcm_popup_subscribe_button_icon"
						   name="pnfpb_ic_fcm_popup_subscribe_button_icon"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_popup_subscribe_button_icon' ); echo $v ? esc_attr( $v ) : esc_url( plugin_dir_url( __DIR__ ) . 'public/img/pushbell-pnfpb.png' ); ?>" />
					<div id="pnfpb_ic_fcm_popup_subscribe_button_icon_preview"
						 style="width:40px;height:40px;border-radius:50%;background-size:cover;background-position:center;background-image:url(<?php $v = get_option( 'pnfpb_ic_fcm_popup_subscribe_button_icon' ); echo $v ? esc_url( $v ) : esc_url( plugin_dir_url( __DIR__ ) . 'public/img/pushbell-pnfpb.png' ); ?>);"></div>
				</div>
			</div>

			<!-- Bell prompt header text -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-editor-paragraph"></span>
					<?php esc_html_e( 'Bell Prompt Header Text', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_popup_header_text" name="pnfpb_ic_fcm_popup_header_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_popup_header_text' ); echo esc_attr( $v ? $v : __( 'Manage push notifications', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<!-- Subscribe button text color -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-art"></span>
					<?php esc_html_e( 'Subscribe Button Text Color', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_prompt_button_background"
						   id="pnfpb_ic_fcm_popup_subscribe_button_text_color"
						   name="pnfpb_ic_fcm_popup_subscribe_button_text_color"
						   type="color"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_popup_subscribe_button_text_color' ); echo esc_attr( $v ? $v : '#ffffff' ); ?>" />
				</div>
			</div>

			<!-- Subscribe button background -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-color-picker"></span>
					<?php esc_html_e( 'Subscribe Button Background Color', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_prompt_button_background"
						   id="pnfpb_ic_fcm_popup_subscribe_button_color"
						   name="pnfpb_ic_fcm_popup_subscribe_button_color"
						   type="color"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_popup_subscribe_button_color' ); echo esc_attr( $v ? $v : '#e54b4d' ); ?>" />
				</div>
			</div>

			<!-- Subscribe text -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-editor-textcolor"></span>
					<?php esc_html_e( 'Subscribe Button Text', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_popup_subscribe_button" name="pnfpb_ic_fcm_popup_subscribe_button"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_popup_subscribe_button' ); echo esc_attr( $v ? $v : __( 'Subscribe', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<!-- Unsubscribe text -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-editor-textcolor"></span>
					<?php esc_html_e( 'Unsubscribe Button Text', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_popup_unsubscribe_button" name="pnfpb_ic_fcm_popup_unsubscribe_button"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_popup_unsubscribe_button' ); echo esc_attr( $v ? $v : __( 'Unsubscribe', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<!-- Hover: subscribed message -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-yes-alt"></span>
					<?php esc_html_e( 'Subscribed Hover Message', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_popup_subscribe_message" name="pnfpb_ic_fcm_popup_subscribe_message"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_popup_subscribe_message' ); echo esc_attr( $v ? $v : __( 'You are subscribed to push notification', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Tooltip shown when hovering the bell icon while subscribed.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<!-- Hover: not subscribed message -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-dismiss"></span>
					<?php esc_html_e( 'Not Subscribed Hover Message', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_popup_unsubscribe_message" name="pnfpb_ic_fcm_popup_unsubscribe_message"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_popup_unsubscribe_message' ); echo esc_attr( $v ? $v : __( 'Push notification not subscribed', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Tooltip shown when hovering the bell icon while NOT subscribed.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<!-- Bell wait message -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-clock"></span>
					<?php esc_html_e( 'Wait Message', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_popup_wait_message" name="pnfpb_ic_fcm_popup_wait_message"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_popup_wait_message' ); echo esc_attr( $v ? $v : __( 'Please wait...processing', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<!-- Bell - show subscription options -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-list-view"></span>
					<?php esc_html_e( 'Show Subscription Options Button', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<label class="pnfpb_switch">
						<input id="pnfpb_bell_icon_prompt_options_on_off" name="pnfpb_bell_icon_prompt_options_on_off"
							   type="checkbox" value="1"
							   <?php $v = get_option( 'pnfpb_bell_icon_prompt_options_on_off', '0' ); if ( $v === '0' || $v === '1' ) { echo 'checked'; } ?> />
						<span class="pnfpb_slider round"></span>
					</label>
				</div>
			</div>

		</div>
	</section>

	<?php /* ── Sub-section: Subscription Options ─────────────────────── */ ?>
	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-editor-ul pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'Subscription Options — Labels & Colors', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Customize the text and colors shown in the subscription options panel (bell icon and popup prompt).', 'push-notification-for-post-and-buddypress' ); ?></p>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-editor-textcolor"></span>
					<?php esc_html_e( 'Update Button Text', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_update_text"
						   name="pnfpb_bell_icon_subscription_option_update_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_update_text' ); echo esc_attr( $v ? $v : __( 'Update', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-art"></span>
					<?php esc_html_e( 'Update Button Text Color', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_update_text_color"
						   name="pnfpb_bell_icon_subscription_option_update_text_color"
						   type="color"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_update_text_color' ); echo esc_attr( $v ? $v : '#ffffff' ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-color-picker"></span>
					<?php esc_html_e( 'Update Button Background Color', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_update_background_color"
						   name="pnfpb_bell_icon_subscription_option_update_background_color"
						   type="color"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_update_background_color' ); echo esc_attr( $v ? $v : '#135e96' ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-color-picker"></span>
					<?php esc_html_e( 'Option List Background Color', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_list_background_color"
						   name="pnfpb_bell_icon_subscription_option_list_background_color"
						   type="color"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_list_background_color' ); echo esc_attr( $v ? $v : '#cccccc' ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-art"></span>
					<?php esc_html_e( 'Option List Text Color', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_list_text_color"
						   name="pnfpb_bell_icon_subscription_option_list_text_color"
						   type="color"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_list_text_color' ); echo esc_attr( $v ? $v : '#000000' ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-art"></span>
					<?php esc_html_e( 'Option List Checkbox Color', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_list_checkbox_color"
						   name="pnfpb_bell_icon_subscription_option_list_checkbox_color"
						   type="color"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_list_checkbox_color' ); echo esc_attr( $v ? $v : '#135e96' ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card" style="grid-column:1/-1;">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-yes-alt"></span>
					<?php esc_html_e( 'Update Confirmation Message', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_update_confirmation_message"
						   name="pnfpb_bell_icon_subscription_option_update_confirmation_message"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_update_confirmation_message' ); echo esc_attr( $v ? $v : __( 'subscription updated', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

		</div>

		<h4 style="margin:20px 0 8px;"><?php esc_html_e( 'Category Label Text', 'push-notification-for-post-and-buddypress' ); ?></h4>
		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label"><?php esc_html_e( 'All', 'push-notification-for-post-and-buddypress' ); ?></div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_all_text_label"
						   name="pnfpb_bell_icon_subscription_option_all_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_all_text' ); echo esc_attr( $v ? $v : __( 'All', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label"><?php esc_html_e( 'Post', 'push-notification-for-post-and-buddypress' ); ?></div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_post_text"
						   name="pnfpb_bell_icon_subscription_option_post_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_post_text' ); echo esc_attr( $v ? $v : __( 'Post', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<?php
			$args          = array( 'public' => true, '_builtin' => false );
			$custposttypes = get_post_types( $args, 'names', 'and' );
			foreach ( $custposttypes as $post_type ) :
				if ( $post_type !== 'buddypress' && $post_type !== 'post' ) :
			?>
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label"><?php echo esc_html( ucwords( $post_type ) ); ?></div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="<?php echo esc_attr( 'pnfpb_bell_icon_subscription_option_' . $post_type . '_text' ); ?>"
						   name="<?php echo esc_attr( 'pnfpb_bell_icon_subscription_option_' . $post_type . '_text' ); ?>"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_' . $post_type . '_text' ); echo esc_attr( $v ? $v : ucwords( $post_type ) ); ?>" />
				</div>
			</div>
			<?php
				endif;
			endforeach;
			?>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label"><?php esc_html_e( 'Activity', 'push-notification-for-post-and-buddypress' ); ?></div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_activity_text"
						   name="pnfpb_bell_icon_subscription_option_activity_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_activity_text' ); echo esc_attr( $v ? $v : __( 'Activity', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label"><?php esc_html_e( 'All Comments', 'push-notification-for-post-and-buddypress' ); ?></div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_all_comments_text"
						   name="pnfpb_bell_icon_subscription_option_all_comments_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_all_comments_text' ); echo esc_attr( $v ? $v : __( 'All Comments', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label"><?php esc_html_e( 'My Comments', 'push-notification-for-post-and-buddypress' ); ?></div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_my_comments_text"
						   name="pnfpb_bell_icon_subscription_option_my_comments_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_my_comments_text' ); echo esc_attr( $v ? $v : __( 'My Comments', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label"><?php esc_html_e( 'Private Message', 'push-notification-for-post-and-buddypress' ); ?></div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_private_message_text"
						   name="pnfpb_bell_icon_subscription_option_private_message_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_private_message_text' ); echo esc_attr( $v ? $v : __( 'Private Message', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label"><?php esc_html_e( 'New Member Joined', 'push-notification-for-post-and-buddypress' ); ?></div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_new_member_joined_text"
						   name="pnfpb_bell_icon_subscription_option_new_member_joined_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_new_member_joined_text' ); echo esc_attr( $v ? $v : __( 'New Member joined', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label"><?php esc_html_e( 'Friendship Request', 'push-notification-for-post-and-buddypress' ); ?></div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_friendship_request_text"
						   name="pnfpb_bell_icon_subscription_option_friendship_request_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_friendship_request_text' ); echo esc_attr( $v ? $v : __( 'Friendship request', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label"><?php esc_html_e( 'Friendship Accepted', 'push-notification-for-post-and-buddypress' ); ?></div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_friendship_accepted_text"
						   name="pnfpb_bell_icon_subscription_option_friendship_accepted_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_friendship_accepted_text' ); echo esc_attr( $v ? $v : __( 'Friendship accepted', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label"><?php esc_html_e( 'Avatar Change', 'push-notification-for-post-and-buddypress' ); ?></div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_avatar_change_text"
						   name="pnfpb_bell_icon_subscription_option_avatar_change_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_avatar_change_text' ); echo esc_attr( $v ? $v : __( 'Avatar change', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label"><?php esc_html_e( 'Cover Image Change', 'push-notification-for-post-and-buddypress' ); ?></div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_cover_image_change_text"
						   name="pnfpb_bell_icon_subscription_option_cover_image_change_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_cover_image_change_text' ); echo esc_attr( $v ? $v : __( 'Cover image change', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label"><?php esc_html_e( 'Group Details Update', 'push-notification-for-post-and-buddypress' ); ?></div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_group_details_update_text"
						   name="pnfpb_bell_icon_subscription_option_group_details_update_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_group_details_update_text' ); echo esc_attr( $v ? $v : __( 'Group details update', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label"><?php esc_html_e( 'Group Invite', 'push-notification-for-post-and-buddypress' ); ?></div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_group_invite_text"
						   name="pnfpb_bell_icon_subscription_option_group_invite_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_group_invite_text' ); echo esc_attr( $v ? $v : __( 'Group invite', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label"><?php esc_html_e( 'Likes / Favourites', 'push-notification-for-post-and-buddypress' ); ?></div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_favourite_text"
						   name="pnfpb_bell_icon_subscription_option_favourite_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_favourite_text' ); echo esc_attr( $v ? $v : __( 'Likes/Favourites', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label"><?php esc_html_e( 'BP Followers', 'push-notification-for-post-and-buddypress' ); ?></div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_bell_icon_subscription_option_followers_text"
						   name="pnfpb_bell_icon_subscription_option_followers_text"
						   type="text"
						   value="<?php $v = get_option( 'pnfpb_bell_icon_subscription_option_followers_text' ); echo esc_attr( $v ? $v : __( 'BP Followers', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
			</div>

		</div>
	</section>

</div><!-- /.pnfpb_ic_push_prompt_form -->

<?php /* ─── Section: Advanced Notification Settings ─────────────────────── */ ?>
<section class="pnfpb-settings-section">
	<h3 class="pnfpb-settings-section__title">
		<span class="dashicons dashicons-admin-tools pnfpb-settings-section__icon"></span>
		<?php esc_html_e( 'Advanced Notification Settings', 'push-notification-for-post-and-buddypress' ); ?>
	</h3>

	<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-chart-bar"></span>
				<?php esc_html_e( 'Delivery & Read Reports', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_turnonoff_delivery_notifications"
						   name="pnfpb_ic_fcm_turnonoff_delivery_notifications"
						   type="checkbox" value="1"
						   <?php checked( '1', $pnfpb_ic_fcm_turnonoff_delivery_notifications ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Enable delivery and read reports for Firebase/web-push notifications.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-performance"></span>
				<?php esc_html_e( 'Asynchronous Mode', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_async_notifications" name="pnfpb_ic_fcm_async_notifications"
						   type="checkbox" value="1"
						   <?php checked( '1', $pnfpb_ic_fcm_async_notifications ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'All push notifications are sent asynchronously without interrupting the website flow.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-controls-repeat"></span>
				<?php esc_html_e( 'Replace Previous Notification', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_replace_notifications" name="pnfpb_ic_fcm_replace_notifications"
						   type="checkbox" value="1"
						   <?php checked( '1', get_option( 'pnfpb_ic_fcm_replace_notifications' ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Replace the previous notification with a newer one using the tag parameter (web push, excludes Safari).', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-no-alt"></span>
				<?php esc_html_e( 'Stop Re-notify After Replace', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_renotify_notification" name="pnfpb_ic_fcm_renotify_notification"
						   type="checkbox" value="1"
						   <?php checked( '1', get_option( 'pnfpb_ic_fcm_renotify_notification' ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'If tag-replace is enabled, users will not be re-alerted when a previous notification is replaced.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-lock"></span>
				<?php esc_html_e( 'Logged-in Users Only', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_loggedin_notify" name="pnfpb_ic_fcm_loggedin_notify"
						   type="checkbox" value="1"
						   <?php checked( '1', get_option( 'pnfpb_ic_fcm_loggedin_notify' ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Only send push notifications to users who are logged in.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

	</div>
</section>
