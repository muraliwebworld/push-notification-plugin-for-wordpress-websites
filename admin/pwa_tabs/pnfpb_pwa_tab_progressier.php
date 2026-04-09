<?php
/* PWA Category-tab: Progressier (third-party PWA)
 * Included by pnfpb_admin_pwa_app_settings.php
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<div id="pnfpb-pwa-thirdparty-tab-name" class="pnfpb-thirdparty-pwa-settings-tab pnfpb-category-pwa-settings-tab">

	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-cloud pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'Progressier PWA', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc">
			<?php
			printf(
				/* translators: %s: Progressier website link */
				esc_html__( 'Use %s as the PWA provider instead of the built-in PWA engine. Enter your Progressier App ID from your Progressier dashboard.', 'push-notification-for-post-and-buddypress' ),
				'<a href="https://progressier.com" target="_blank" rel="noopener noreferrer">Progressier</a>'
			);
			?>
		</p>

		<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-bottom:20px;">
			<span class="dashicons dashicons-info pnfpb-info-box__icon"></span>
			<div>
				<strong><?php esc_html_e( 'Finding your App ID', 'push-notification-for-post-and-buddypress' ); ?></strong>
				<p style="margin:6px 0 0;">
					<?php esc_html_e( 'Your App ID is the second segment of your Progressier script URL. For example, in:', 'push-notification-for-post-and-buddypress' ); ?><br />
					<code>https://progressier.app/<strong>appid</strong>/progressier.json</code><br />
					<?php esc_html_e( 'the App ID is the value shown in bold above.', 'push-notification-for-post-and-buddypress' ); ?>
				</p>
			</div>
		</div>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-cloud"></span>
					<?php esc_html_e( 'Enable Progressier PWA', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<label class="pnfpb_switch">
						<input id="pnfpb_ic_thirdparty_pwa_app_enable"
							   name="pnfpb_ic_thirdparty_pwa_app_enable"
							   type="checkbox" value="1"
							   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_thirdparty_pwa_app_enable' ) ) ); ?> />
						<span class="pnfpb_slider round"></span>
					</label>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Load Progressier as the PWA engine. Disable the Native PWA tab when using this.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-network"></span>
					<?php esc_html_e( 'Progressier App ID', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_pwa_thirdparty_app_id"
						   name="pnfpb_ic_pwa_thirdparty_app_id"
						   type="text" maxlength="50"
						   placeholder="<?php esc_attr_e( 'Enter your Progressier App ID', 'push-notification-for-post-and-buddypress' ); ?>"
						   value="<?php echo esc_attr( get_option( 'pnfpb_ic_pwa_thirdparty_app_id' ) ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Found in: https://progressier.app/{app-id}/progressier.json', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

		</div>

	</section>

</div>
