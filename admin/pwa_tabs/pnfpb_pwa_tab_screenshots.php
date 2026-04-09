<?php
/* PWA Sub-tab: Screenshots
 * Included by pnfpb_admin_pwa_app_settings.php
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<div id="pnfpb-pwa-screenshots" class="pnfpb-pwa-settings-tab">

	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-camera pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'App Screenshots', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Upload screenshots that appear in PWA install prompts and app stores. Provide one desktop and one mobile screenshot.', 'push-notification-for-post-and-buddypress' ); ?></p>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<!-- Desktop Screenshot -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-desktop"></span>
					<?php esc_html_e( 'Desktop Screenshot (1280×780 px)', 'push-notification-for-post-and-buddypress' ); ?>
					<span style="color:#EF4444;margin-left:2px;">*</span>
				</div>
				<div class="pnfpb-field-card__control" style="display:flex;flex-direction:column;gap:12px;">
					<div>
						<input type="button"
							   value="<?php esc_attr_e( 'Select Screenshot', 'push-notification-for-post-and-buddypress' ); ?>"
							   id="pnfpb_ic_fcm_pwa_upload_screenshot_desktop"
							   class="pnfpb_ic_fcm_pwa_upload_screenshot_desktop button" />
						<input type="hidden"
							   id="pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value"
							   name="pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value"
							   value="<?php echo esc_attr( get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value' ) ); ?>" />
					</div>
					<div id="pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value_preview"
						 style="background-image:url(<?php echo esc_url( get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value' ) ); ?>);width:120px;height:75px;border-radius:6px;background-position:center;background-repeat:no-repeat;background-size:cover;border:1px solid #E5E7EB;">
					</div>
					<div>
						<label for="pnfpb_ic_fcm_pwa_upload_screenshot_desktop_label"
							   style="font-size:12px;font-weight:600;color:#6B7280;display:block;margin-bottom:4px;">
							<?php esc_html_e( 'Screenshot Label', 'push-notification-for-post-and-buddypress' ); ?>
							<span style="color:#EF4444;">*</span>
						</label>
						<input class="pnfpb_ic_push_settings_table_value_column_input_field"
							   id="pnfpb_ic_fcm_pwa_upload_screenshot_desktop_label"
							   name="pnfpb_ic_fcm_pwa_upload_screenshot_desktop_label"
							   type="text"
							   required="required"
							   value="<?php
								$_pnfpb_v = get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_desktop_label' );
								echo esc_attr( $_pnfpb_v ? $_pnfpb_v : 'Homescreen of Awesome App' );
							?>" />
					</div>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Desktop screenshot at 1280×780 px. Required.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<!-- Mobile Screenshot -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-smartphone"></span>
					<?php esc_html_e( 'Mobile Screenshot', 'push-notification-for-post-and-buddypress' ); ?>
					<span style="color:#EF4444;margin-left:2px;">*</span>
				</div>
				<div class="pnfpb-field-card__control" style="display:flex;flex-direction:column;gap:12px;">
					<div>
						<input type="button"
							   value="<?php esc_attr_e( 'Select Screenshot', 'push-notification-for-post-and-buddypress' ); ?>"
							   id="pnfpb_ic_fcm_pwa_upload_screenshot_mobile"
							   class="pnfpb_ic_fcm_pwa_upload_screenshot_mobile button" />
						<input type="hidden"
							   id="pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value"
							   name="pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value"
							   value="<?php echo esc_attr( get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value' ) ); ?>" />
					</div>
					<div id="pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value_preview"
						 style="background-image:url(<?php echo esc_url( get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value' ) ); ?>);width:75px;height:120px;border-radius:6px;background-position:center;background-repeat:no-repeat;background-size:cover;border:1px solid #E5E7EB;">
					</div>
					<div>
						<label for="pnfpb_ic_fcm_pwa_upload_screenshot_mobile_label"
							   style="font-size:12px;font-weight:600;color:#6B7280;display:block;margin-bottom:4px;">
							<?php esc_html_e( 'Screenshot Label', 'push-notification-for-post-and-buddypress' ); ?>
							<span style="color:#EF4444;">*</span>
						</label>
						<input class="pnfpb_ic_push_settings_table_value_column_input_field"
							   id="pnfpb_ic_fcm_pwa_upload_screenshot_mobile_label"
							   name="pnfpb_ic_fcm_pwa_upload_screenshot_mobile_label"
							   type="text"
							   required="required"
							   value="<?php
								$_pnfpb_v = get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_mobile_label' );
								echo esc_attr( $_pnfpb_v ? $_pnfpb_v : 'List of Awesome Resources available in Awesome App' );
							?>" />
					</div>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Mobile screenshot shown in install prompts. Required.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

		</div>
	</section>

</div>
