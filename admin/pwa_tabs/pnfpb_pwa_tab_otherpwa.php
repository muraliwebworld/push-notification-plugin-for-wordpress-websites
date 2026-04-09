<?php
/* PWA Category-tab: Other PWA (SuperPWA integration)
 * Included by pnfpb_admin_pwa_app_settings.php
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<div id="pnfpb-pwa-other-tab-name" class="pnfpb-other-pwa-settings-tab pnfpb-category-pwa-settings-tab">

	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-rest-api pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'SuperPWA Integration', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Integrate PNFPB push notifications with an existing SuperPWA service worker.', 'push-notification-for-post-and-buddypress' ); ?></p>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col" style="margin-bottom:20px;">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-plugins"></span>
					<?php esc_html_e( 'Enable SuperPWA Integration', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<label class="pnfpb_switch">
						<input id="pnfpb_integrate_service_worker_in_another_plugin"
							   name="pnfpb_integrate_service_worker_in_another_plugin"
							   type="checkbox" value="1"
							   <?php checked( '1', esc_attr( get_option( 'pnfpb_integrate_service_worker_in_another_plugin' ) ) ); ?> />
						<span class="pnfpb_slider round"></span>
					</label>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Merge PNFPB service worker code into SuperPWA\'s service worker.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

		</div>

		<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-bottom:20px;">
			<span class="dashicons dashicons-info pnfpb-info-box__icon"></span>
			<div>
				<strong><?php esc_html_e( 'Integration Notes', 'push-notification-for-post-and-buddypress' ); ?></strong>
				<ul style="list-style:disc;padding-left:18px;margin:6px 0 0;">
					<li><?php esc_html_e( 'Requires the SuperPWA plugin to be active.', 'push-notification-for-post-and-buddypress' ); ?></li>
					<li><?php esc_html_e( 'Hooks into SuperPWA\'s superpwa_sw_template filter.', 'push-notification-for-post-and-buddypress' ); ?></li>
					<li><?php esc_html_e( 'PNFPB will apply its push notification logic on top of the SuperPWA service worker.', 'push-notification-for-post-and-buddypress' ); ?></li>
					<li><?php esc_html_e( 'Only enable this if you are already using the SuperPWA plugin and do not use the built-in PWA tab.', 'push-notification-for-post-and-buddypress' ); ?></li>
				</ul>
			</div>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-editor-code"></span>
				<?php esc_html_e( 'Custom Service Worker Hook', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<p class="pnfpb-field-card__desc" style="margin-bottom:10px;"><?php esc_html_e( 'Add the following code to your theme\'s functions.php to wire the integration.', 'push-notification-for-post-and-buddypress' ); ?></p>
			<div class="pnfpb-field-card__control">
				<pre style="background:#1e1e1e;color:#d4d4d4;padding:16px;border-radius:6px;overflow-x:auto;font-size:12px;line-height:1.6;"><code>$superpwa_sw_code = ob_get_clean();
if ( get_option( 'pnfpb_integrate_service_worker_in_another_plugin' ) === '1' ) {
    $superpwa_sw_code = apply_filters( 'superpwa_sw_template', $superpwa_sw_code );
    return apply_filters( 'pnfpb_service_worker_extension', $superpwa_sw_code );
} else {
    return apply_filters( 'superpwa_sw_template', $superpwa_sw_code );
}</code></pre>
			</div>
		</div>

	</section>

</div>
