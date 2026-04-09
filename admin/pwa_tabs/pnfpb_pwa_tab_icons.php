<?php
/* PWA Sub-tab: Icons
 * Included by pnfpb_admin_pwa_app_settings.php
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<div id="pnfpb-pwa-icons" class="pnfpb-pwa-settings-tab">

	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-format-image pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'App Icons', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Upload two PWA icons — a small icon for notifications and a large icon for app stores, splash screens, and install prompts.', 'push-notification-for-post-and-buddypress' ); ?></p>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<!-- Icon 1: 132×132 -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-format-image"></span>
					<?php esc_html_e( 'Icon 1 (132×132 px)', 'push-notification-for-post-and-buddypress' ); ?>
					<span style="color:#EF4444;margin-left:2px;">*</span>
				</div>
				<div class="pnfpb-field-card__control" style="display:flex;flex-direction:column;gap:10px;">
					<div>
						<input type="button"
							   value="<?php esc_attr_e( 'Select Icon', 'push-notification-for-post-and-buddypress' ); ?>"
							   id="pnfpb_ic_fcm_pwa_upload_button_132"
							   class="pnfpb_ic_push_pwa_settings_upload_icon button" />
						<input type="hidden"
							   id="pnfpb_ic_fcm_pwa_upload_icon_132"
							   name="pnfpb_ic_fcm_pwa_upload_icon_132"
							   value="<?php
								$_pnfpb_v = get_option( 'pnfpb_ic_fcm_pwa_upload_icon_132' );
								echo esc_attr( $_pnfpb_v ? $_pnfpb_v : plugin_dir_url( __DIR__ ) . 'public/img/icon_132.png' );
							?>" />
					</div>
					<div id="pnfpb_ic_fcm_pwa_upload_preview_132"
						 style="background-image:url(<?php
							$_pnfpb_v = get_option( 'pnfpb_ic_fcm_pwa_upload_icon_132' );
							echo esc_url( $_pnfpb_v ? $_pnfpb_v : plugin_dir_url( __DIR__ ) . 'public/img/icon_132.png' );
						?>);width:80px;height:80px;border-radius:8px;background-position:center;background-repeat:no-repeat;background-size:cover;border:1px solid #E5E7EB;">
					</div>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Used for push notifications and icon contexts. PNG recommended. Required.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<!-- Icon 2: 512×512 -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-format-image"></span>
					<?php esc_html_e( 'Icon 2 (512×512 px)', 'push-notification-for-post-and-buddypress' ); ?>
					<span style="color:#EF4444;margin-left:2px;">*</span>
				</div>
				<div class="pnfpb-field-card__control" style="display:flex;flex-direction:column;gap:10px;">
					<div>
						<input type="button"
							   value="<?php esc_attr_e( 'Select Icon', 'push-notification-for-post-and-buddypress' ); ?>"
							   id="pnfpb_ic_fcm_pwa_upload_button_512"
							   class="pnfpb_ic_push_pwa_settings_upload_icon button" />
						<input type="hidden"
							   id="pnfpb_ic_fcm_pwa_upload_icon_512"
							   name="pnfpb_ic_fcm_pwa_upload_icon_512"
							   value="<?php
								$_pnfpb_v = get_option( 'pnfpb_ic_fcm_pwa_upload_icon_512' );
								echo esc_attr( $_pnfpb_v ? $_pnfpb_v : plugin_dir_url( __DIR__ ) . 'public/img/icon.png' );
							?>" />
					</div>
					<div id="pnfpb_ic_fcm_pwa_upload_preview_512"
						 style="background-image:url(<?php
							$_pnfpb_v = get_option( 'pnfpb_ic_fcm_pwa_upload_icon_512' );
							echo esc_url( $_pnfpb_v ? $_pnfpb_v : plugin_dir_url( __DIR__ ) . 'public/img/icon.png' );
						?>);width:80px;height:80px;border-radius:8px;background-position:center;background-repeat:no-repeat;background-size:cover;border:1px solid #E5E7EB;">
					</div>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Used for install prompts, splash screens, and app stores. PNG recommended. Required.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

		</div>
	</section>

</div>
