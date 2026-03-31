<?php
/* PWA Sub-tab: Shortcode
 * Included by pnfpb_admin_pwa_app_settings.php
 */
?>
<div id="pnfpb-pwa-shortcode" class="pnfpb-pwa-settings-tab">

	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-shortcode pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'PWA Install Shortcode', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc">
			<?php esc_html_e( 'Use the shortcode', 'push-notification-for-post-and-buddypress' ); ?>
			<code>[PNFPB_PWA_PROMPT]</code>
			<?php esc_html_e( 'to embed a PWA install button anywhere on your site.', 'push-notification-for-post-and-buddypress' ); ?>
		</p>

		<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-bottom:20px;">
			<span class="dashicons dashicons-info pnfpb-info-box__icon"></span>
			<div>
				<strong><?php esc_html_e( 'How it works', 'push-notification-for-post-and-buddypress' ); ?></strong>
				<ul style="list-style:disc;padding-left:18px;margin:6px 0 0;">
					<li><?php esc_html_e( 'Displays a styled PWA install button on any post or page.', 'push-notification-for-post-and-buddypress' ); ?></li>
					<li><?php esc_html_e( 'Automatically hides after the app has been installed.', 'push-notification-for-post-and-buddypress' ); ?></li>
					<li><?php esc_html_e( 'Only visible when the PWA is not yet installed.', 'push-notification-for-post-and-buddypress' ); ?></li>
					<li><?php esc_html_e( 'Button appearance and text can be customized under the Customization tab.', 'push-notification-for-post-and-buddypress' ); ?></li>
				</ul>
			</div>
		</div>

		<div>
			<a class="button button-secondary"
			   href="<?php echo esc_url( admin_url( 'admin.php?page=pnfpb_icfm_button_settings#pwa-install-shortcode-customize-section' ) ); ?>">
				<span class="dashicons dashicons-admin-appearance" style="vertical-align:middle;"></span>
				<?php esc_html_e( 'Customize Shortcode Button', 'push-notification-for-post-and-buddypress' ); ?>
			</a>
		</div>

	</section>

</div>
