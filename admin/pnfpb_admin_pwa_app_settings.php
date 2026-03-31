<?php
/**
 * Plugin settings page — Progressive Web App (PWA)
 *
 * @since 1.20
 */
?>
<h1 class="pnfpb_ic_push_settings_header"><?php esc_html_e( 'PNFPB - PWA (Progressive Web App) Settings', 'push-notification-for-post-and-buddypress' ); ?></h1>
<?php
$pnfpb_tab_pwa_active = 'nav-tab-active';
require_once plugin_dir_path( __FILE__ ) . 'push_admin_menu_list.php';

$pnfpb_allowed_html = [
	'option' => [
		'value'    => [],
		'selected' => [],
	],
];

/* Protocol handler arrays (used by pnfpb_pwa_tab_protocol.php) */
$pnfpb_ic_pwa_protocol_name_array = get_option( 'pnfpb_ic_pwa_protocol_name' );
if ( ! is_array( $pnfpb_ic_pwa_protocol_name_array ) || empty( $pnfpb_ic_pwa_protocol_name_array ) ) {
	$pnfpb_ic_pwa_protocol_name_array = [ ' ' ];
}
$pnfpb_ic_pwa_protocol_url_array = get_option( 'pnfpb_ic_pwa_protocol_url' );
if ( ! is_array( $pnfpb_ic_pwa_protocol_url_array ) || empty( $pnfpb_ic_pwa_protocol_url_array ) ) {
	$pnfpb_ic_pwa_protocol_url_array = [ ' ' ];
}
?>

<div class="pnfpb_column_1200">

	<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-bottom:20px;">
		<span class="dashicons dashicons-info pnfpb-info-box__icon"></span>
		<div>
			<strong><?php esc_html_e( 'Required fields', 'push-notification-for-post-and-buddypress' ); ?></strong>
			<p>
				<?php esc_html_e( 'App Name, Short Name, Start URL, Display, Colors, Icons, and Screenshots are required for a valid PWA manifest.', 'push-notification-for-post-and-buddypress' ); ?>
				<?php esc_html_e( 'For Apple iOS devices, PWA is fully supported from iOS 17.0 onwards.', 'push-notification-for-post-and-buddypress' ); ?>
			</p>
		</div>
	</div>

	<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">

		<?php settings_fields( 'pnfpb_icfcm_pwa' ); ?>
		<?php do_settings_sections( 'pnfpb_icfcm_pwa' ); ?>

		<!-- ====== Outer category tabs ====== -->
		<div class="nav-tab-wrapper pnfpb-pwa-category-tabs" id="pnfpb-pwa-category-tabs">
			<a class="nav-tab nav-tab-active" id="pnfpb-pwa-native-tab" href="#pnfpb-pwa-native-tab-name">
				<span class="pnfpb-pwa-cat-icon" aria-hidden="true">
					<span class="dashicons dashicons-smartphone"></span>
				</span>
				<span class="pnfpb-pwa-cat-label">
					<?php esc_html_e( 'PNFPB PWA settings', 'push-notification-for-post-and-buddypress' ); ?>
				</span>
			</a>
			<a class="nav-tab" id="pnfpb-pwa-other-tab" href="#pnfpb-pwa-other-tab-name">
				<span class="pnfpb-pwa-cat-icon" aria-hidden="true">
					<span class="dashicons dashicons-admin-plugins"></span>
				</span>
				<span class="pnfpb-pwa-cat-label">
					<?php esc_html_e( 'Integrate with SuperPWA &amp; Other PWA plugins', 'push-notification-for-post-and-buddypress' ); ?>
				</span>
			</a>
			<a class="nav-tab" id="pnfpb-pwa-thirdparty-tab" href="#pnfpb-pwa-thirdparty-tab-name">
				<span class="pnfpb-pwa-cat-icon" aria-hidden="true">
					<span class="dashicons dashicons-cloud"></span>
				</span>
				<span class="pnfpb-pwa-cat-label">
					<?php esc_html_e( 'Integrate with Progressier PWA', 'push-notification-for-post-and-buddypress' ); ?>
				</span>
			</a>
		</div>

		<!-- ====== Native PWA panel ====== -->
		<div id="pnfpb-pwa-native-tab-name" class="pnfpb-native-pwa-settings-tab pnfpb-category-pwa-settings-tab active">

			<!-- Enable PWA toggle -->
			<section class="pnfpb-settings-section">
				<h3 class="pnfpb-settings-section__title">
					<span class="dashicons dashicons-smartphone pnfpb-settings-section__icon"></span>
					<?php esc_html_e( 'PWA Status', 'push-notification-for-post-and-buddypress' ); ?>
				</h3>
				<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">
					<div class="pnfpb-field-card">
						<div class="pnfpb-field-card__label">
							<span class="dashicons dashicons-smartphone"></span>
							<?php esc_html_e( 'Enable PWA', 'push-notification-for-post-and-buddypress' ); ?>
							<span style="color:#cc1818;">*</span>
						</div>
						<div class="pnfpb-field-card__control">
							<label class="pnfpb_switch">
								<input id="pnfpb_ic_pwa_app_enable"
									   name="pnfpb_ic_pwa_app_enable"
									   type="checkbox" value="1"
									   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_pwa_app_enable' ) ) ); ?> />
								<span class="pnfpb_slider round"></span>
							</label>
						</div>
						<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Activate the built-in PWA engine and generate the web app manifest.', 'push-notification-for-post-and-buddypress' ); ?></p>
					</div>
				</div>
			</section>

			<!-- ====== Inner PWA sub-tabs nav ====== -->
			<div class="nav-tab-wrapper pnfpb-pwa-tabs" id="pnfpb-pwa-tabs">
				<a class="nav-tab nav-tab-active" id="pnfpb-pwa-name-tab" href="#pnfpb-pwa-name">
					<span class="pnfpb-pwa-inner-icon" aria-hidden="true"><span class="dashicons dashicons-info-outline"></span></span>
					<span class="pnfpb-pwa-inner-label"><?php esc_html_e( 'App basics', 'push-notification-for-post-and-buddypress' ); ?></span>
				</a>
				<a class="nav-tab" id="pnfpb-pwa-display-tab" href="#pnfpb-pwa-display">
					<span class="pnfpb-pwa-inner-icon" aria-hidden="true"><span class="dashicons dashicons-visibility"></span></span>
					<span class="pnfpb-pwa-inner-label"><?php esc_html_e( 'Display', 'push-notification-for-post-and-buddypress' ); ?></span>
				</a>
				<a class="nav-tab" id="pnfpb-pwa-icon-tab" href="#pnfpb-pwa-icons">
					<span class="pnfpb-pwa-inner-icon" aria-hidden="true"><span class="dashicons dashicons-format-image"></span></span>
					<span class="pnfpb-pwa-inner-label"><?php esc_html_e( 'Icons', 'push-notification-for-post-and-buddypress' ); ?></span>
				</a>
				<a class="nav-tab" id="pnfpb-pwa-screenshot-tab" href="#pnfpb-pwa-screenshots">
					<span class="pnfpb-pwa-inner-icon" aria-hidden="true"><span class="dashicons dashicons-camera"></span></span>
					<span class="pnfpb-pwa-inner-label"><?php esc_html_e( 'Screenshots', 'push-notification-for-post-and-buddypress' ); ?></span>
				</a>
				<a class="nav-tab" id="pnfpb-pwa-splashscreen-ios-tab" href="#pnfpb-pwa-splashscreen-ios">
					<span class="pnfpb-pwa-inner-icon" aria-hidden="true"><span class="dashicons dashicons-tablet"></span></span>
					<span class="pnfpb-pwa-inner-label"><?php esc_html_e( 'ios Splashscreen', 'push-notification-for-post-and-buddypress' ); ?></span>
				</a>
				<a class="nav-tab" id="pnfpb-pwa-shortcuts-tab" href="#pnfpb-pwa-shortcuts">
					<span class="pnfpb-pwa-inner-icon" aria-hidden="true"><span class="dashicons dashicons-menu"></span></span>
					<span class="pnfpb-pwa-inner-label"><?php esc_html_e( 'Shortcuts', 'push-notification-for-post-and-buddypress' ); ?></span>
				</a>
				<a class="nav-tab" id="pnfpb-pwa-offline-cache-tab" href="#pnfpb-pwa-cache">
					<span class="pnfpb-pwa-inner-icon" aria-hidden="true"><span class="dashicons dashicons-database"></span></span>
					<span class="pnfpb-pwa-inner-label"><?php esc_html_e( 'Cache', 'push-notification-for-post-and-buddypress' ); ?></span>
				</a>
				<a class="nav-tab" id="pnfpb-pwa-custom-prompt-tab" href="#pnfpb-pwa-custom-prompt">
					<span class="pnfpb-pwa-inner-icon" aria-hidden="true"><span class="dashicons dashicons-admin-comments"></span></span>
					<span class="pnfpb-pwa-inner-label"><?php esc_html_e( 'Custom Prompt', 'push-notification-for-post-and-buddypress' ); ?></span>
				</a>
				<a class="nav-tab" id="pnfpb-pwa-protocol-handler-tab" href="#pnfpb-pwa-protocol-handler">
					<span class="pnfpb-pwa-inner-icon" aria-hidden="true"><span class="dashicons dashicons-admin-links"></span></span>
					<span class="pnfpb-pwa-inner-label"><?php esc_html_e( 'Protocol', 'push-notification-for-post-and-buddypress' ); ?></span>
				</a>
				<a class="nav-tab" id="pnfpb-pwa-ios-devices-tab" href="#pnfpb-pwa-ios-devices">
					<span class="pnfpb-pwa-inner-icon" aria-hidden="true"><span class="dashicons dashicons-phone"></span></span>
					<span class="pnfpb-pwa-inner-label"><?php esc_html_e( 'ios iphone/ipad', 'push-notification-for-post-and-buddypress' ); ?></span>
				</a>
				<a class="nav-tab" id="pnfpb-pwa-shortcode-tab" href="#pnfpb-pwa-shortcode">
					<span class="pnfpb-pwa-inner-icon" aria-hidden="true"><span class="dashicons dashicons-shortcode"></span></span>
					<span class="pnfpb-pwa-inner-label"><?php esc_html_e( 'Shortcode', 'push-notification-for-post-and-buddypress' ); ?></span>
				</a>
			</div>

			<!-- ====== Inner PWA sub-tab panes ====== -->
			<?php require_once plugin_dir_path( __FILE__ ) . 'pwa_tabs/pnfpb_pwa_tab_basics.php'; ?>
			<?php require_once plugin_dir_path( __FILE__ ) . 'pwa_tabs/pnfpb_pwa_tab_display.php'; ?>
			<?php require_once plugin_dir_path( __FILE__ ) . 'pwa_tabs/pnfpb_pwa_tab_icons.php'; ?>
			<?php require_once plugin_dir_path( __FILE__ ) . 'pwa_tabs/pnfpb_pwa_tab_screenshots.php'; ?>
			<?php require_once plugin_dir_path( __FILE__ ) . 'pwa_tabs/pnfpb_pwa_tab_splashscreen.php'; ?>
			<?php require_once plugin_dir_path( __FILE__ ) . 'pwa_tabs/pnfpb_pwa_tab_shortcuts.php'; ?>
			<?php require_once plugin_dir_path( __FILE__ ) . 'pwa_tabs/pnfpb_pwa_tab_cache.php'; ?>
			<?php require_once plugin_dir_path( __FILE__ ) . 'pwa_tabs/pnfpb_pwa_tab_customprompt.php'; ?>
			<?php require_once plugin_dir_path( __FILE__ ) . 'pwa_tabs/pnfpb_pwa_tab_protocol.php'; ?>
			<?php require_once plugin_dir_path( __FILE__ ) . 'pwa_tabs/pnfpb_pwa_tab_ios.php'; ?>
			<?php require_once plugin_dir_path( __FILE__ ) . 'pwa_tabs/pnfpb_pwa_tab_shortcode.php'; ?>

		</div><!-- /pnfpb-pwa-native-tab-name -->

		<!-- ====== SuperPWA / Other panel ====== -->
		<?php require_once plugin_dir_path( __FILE__ ) . 'pwa_tabs/pnfpb_pwa_tab_otherpwa.php'; ?>

		<!-- ====== Progressier panel ====== -->
		<?php require_once plugin_dir_path( __FILE__ ) . 'pwa_tabs/pnfpb_pwa_tab_progressier.php'; ?>

		<!-- ====== Save button ====== -->
		<div class="pnfpb-save-wrap">
			<?php submit_button( __( 'Save changes', 'push-notification-for-post-and-buddypress' ), 'pnfpb_ic_push_save_configuration_button' ); ?>
		</div>

	</form>

</div><!-- /pnfpb_column_1200 -->
