<?php
/* PWA Sub-tab: iOS Splashscreen
 * Included by pnfpb_admin_pwa_app_settings.php
 *
 * Splash screen sizes for Apple iOS / macOS devices.
 * All upload button IDs, hidden input IDs, and preview div IDs are preserved
 * exactly as required by the existing JavaScript.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<div id="pnfpb-pwa-splashscreen-ios" class="pnfpb-pwa-settings-tab">

	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-tablet pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'iOS Splash Screens', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Upload splash-screen images for each Apple device resolution. These display while the PWA is loading on iPhone, iPad, and macOS.', 'push-notification-for-post-and-buddypress' ); ?></p>

		<?php
		/**
		 * Helper: render a single splash-screen upload card.
		 *
		 * @param string $size_label  Human-readable size e.g. "640×1136 px"
		 * @param string $key         Option key suffix e.g. "640_1136"
		 */
		function pnfpb_render_splash_card( $size_label, $key ) {
			$btn_id     = 'pnfpb_ic_fcm_pwa_upload_splashscreen_' . $key;
			$input_id   = $btn_id . '_value';
			$preview_id = $input_id . '_preview';
			$opt_value  = get_option( $input_id );
			?>
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-tablet"></span>
					<?php echo esc_html( $size_label ); ?>
				</div>
				<div class="pnfpb-field-card__control" style="display:flex;flex-direction:column;gap:10px;">
					<div>
						<input type="button"
							   value="<?php esc_attr_e( 'Select Image', 'push-notification-for-post-and-buddypress' ); ?>"
							   id="<?php echo esc_attr( $btn_id ); ?>"
							   class="<?php echo esc_attr( $btn_id ); ?> button" />
						<input type="hidden"
							   id="<?php echo esc_attr( $input_id ); ?>"
							   name="<?php echo esc_attr( $input_id ); ?>"
							   value="<?php echo $opt_value ? esc_attr( $opt_value ) : ''; ?>" />
					</div>
					<div id="<?php echo esc_attr( $preview_id ); ?>"
						 style="background-image:url(<?php echo $opt_value ? esc_url( $opt_value ) : ''; ?>);width:60px;height:100px;border-radius:6px;background-position:center;background-repeat:no-repeat;background-size:cover;border:1px solid #E5E7EB;">
					</div>
				</div>
			</div>
			<?php
		}
		?>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--3col">
			<?php pnfpb_render_splash_card( '640×1136 px (iPhone 5/SE)', '640_1136' ); ?>
			<?php pnfpb_render_splash_card( '750×1294 px (iPhone 6/7/8)', '750_1294' ); ?>
			<?php pnfpb_render_splash_card( '1242×2148 px (iPhone Plus)', '1242_2148' ); ?>
			<?php pnfpb_render_splash_card( '1125×2436 px (iPhone X)', '1125_2436' ); ?>
			<?php pnfpb_render_splash_card( '1536×2048 px (iPad / iPad mini)', '1536_2048' ); ?>
			<?php pnfpb_render_splash_card( '1668×2224 px (iPad Pro 10.5")', '1668_2224' ); ?>
			<?php pnfpb_render_splash_card( '2048×2732 px (iPad Pro 12.9")', '2048_2732' ); ?>
		</div>

	</section>

</div>
