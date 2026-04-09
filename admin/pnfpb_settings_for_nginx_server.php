<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<h1 class="pnfpb_ic_push_settings_header"><?php echo esc_html( __( "PNFPB - NGINX Server Settings", "push-notification-for-post-and-buddypress" ) ); ?></h1>
<?php
	$pnfpb_tab_nginx_active = "nav-tab-active";
	require_once( plugin_dir_path( __FILE__ ) . 'push_admin_menu_list.php' );
?>

<div class="pnfpb_column_1200">

	<!-- ===== Info box ===== -->
	<div class="pnfpb-info-box pnfpb-info-box--blue">
		<span class="dashicons dashicons-performance pnfpb-info-box__icon"></span>
		<div>
			<strong><?php esc_html_e( "NGINX / Static File Mode", "push-notification-for-post-and-buddypress" ); ?></strong>
			<p><?php echo esc_html( PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION ); ?></p>
		</div>
	</div>

	<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
		<?php settings_fields( "pnfpb_icfcm_nginx" ); ?>
		<?php do_settings_sections( "pnfpb_icfcm_nginx" ); ?>

		<?php
		/* When static mode is OFF, clean up any previously created physical files */
		if ( get_option( "pnfpb_ic_nginx_static_files_enable" ) != "1" ) {
			global $wp_filesystem;
			if ( empty( $wp_filesystem ) ) {
				require_once trailingslashit( ABSPATH ) . "wp-admin/includes/file.php";
				WP_Filesystem();
			}

			$pnfpb_swresponse = wp_remote_head( home_url( "/" ) . "pnfpb_icpush_pwa_sw.js", [ "sslverify" => false ] );
			if ( 200 === wp_remote_retrieve_response_code( $pnfpb_swresponse ) ) {
				$wp_filesystem->delete( trailingslashit( get_home_path() ) . "pnfpb_icpush_pwa_sw.js" );
			}

			$pnfpb_firebase_swresponse = wp_remote_head( home_url( "/" ) . "firebase-messaging-sw.js", [ "sslverify" => false ] );
			if ( 200 === wp_remote_retrieve_response_code( $pnfpb_firebase_swresponse ) ) {
				$wp_filesystem->delete( trailingslashit( get_home_path() ) . "firebase-messaging-sw.js" );
			}

			if ( get_option( "pnfpb_ic_pwa_app_enable" ) === "1" ) {
				$pnfpb_pwa_manifest_response = wp_remote_head( home_url( "/" ) . "pnfpbmanifest.json", [ "sslverify" => false ] );
				if ( 200 === wp_remote_retrieve_response_code( $pnfpb_pwa_manifest_response ) ) {
					$wp_filesystem->delete( trailingslashit( get_home_path() ) . "pnfpbmanifest.json" );
				}
			}
		}
		?>

		<!-- ===== Section: Static Files Toggle ===== -->
		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-admin-settings pnfpb-settings-section__icon"></span>
				<?php esc_html_e( "Static Service Worker & PWA Manifest", "push-notification-for-post-and-buddypress" ); ?>
			</h3>
			<p class="pnfpb-settings-section__desc"><?php esc_html_e( "Enable this option when your server is NGINX-based and cannot serve dynamically generated (PHP) files from the web root.", "push-notification-for-post-and-buddypress" ); ?></p>

			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-admin-site-alt3"></span>
						<?php esc_html_e( "Enable Static Files Mode", "push-notification-for-post-and-buddypress" ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<label class="pnfpb_switch">
							<input id="pnfpb_ic_nginx_static_files_enable"
								   name="pnfpb_ic_nginx_static_files_enable"
								   type="checkbox" value="1"
								   <?php checked( "1", esc_attr( get_option( "pnfpb_ic_nginx_static_files_enable" ) ) ); ?> />
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( "When enabled, the plugin writes physical .js and .json files to the web root instead of serving them via PHP.", "push-notification-for-post-and-buddypress" ); ?></p>
				</div>

				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-info-outline"></span>
						<?php esc_html_e( "How to Regenerate Files", "push-notification-for-post-and-buddypress" ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<ol style="margin:0;padding-left:18px;font-size:13px;color:#374151;line-height:1.8;">
							<li><?php esc_html_e( "Switch this option OFF and save.", "push-notification-for-post-and-buddypress" ); ?></li>
							<li><?php esc_html_e( "Switch it ON again and save.", "push-notification-for-post-and-buddypress" ); ?></li>
						</ol>
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( "Do this whenever push notification or PWA admin settings are changed so that the service worker and manifest files are regenerated.", "push-notification-for-post-and-buddypress" ); ?></p>
				</div>

			</div>

			<div class="pnfpb-info-box" style="background:#FFFBEB;border-left-color:#F59E0B;margin-top:16px;">
				<span class="dashicons dashicons-info pnfpb-info-box__icon" style="color:#F59E0B;"></span>
				<div>
					<p style="margin:0;font-size:13px;color:#374151;"><?php echo esc_html( PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION2 ); ?></p>
				</div>
			</div>

			<div class="pnfpb-save-wrap">
				<?php submit_button( __( "Save Changes", "push-notification-for-post-and-buddypress" ), "pnfpb_ic_push_save_configuration_button" ); ?>
			</div>
		</section>

	</form>
</div>
<?php
