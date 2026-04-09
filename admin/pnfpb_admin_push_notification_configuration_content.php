<?php
/**
 * Configuration tab — provider panel orchestrator.
 *
 * Renders the provider-selector tab bar and delegates each panel to its own
 * sub-file in admin/config_tab/.
 *
 * Variables injected by pnfpb_push_notifications_configuration.php (parent scope):
 *   $pnfpb_sa             — bool, whether a service-account JSON is stored
 *   $pnfpb_disabled_push  — string, current webpush radio value (1|2|3)
 *
 * @since 2.08
 * @updated 2.30.0 — split into config_tab/ sub-files with modern card layout
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<div class="pnfpb-config-intro">
	<div class="pnfpb-config-intro-icon">
		<span class="dashicons dashicons-admin-settings"></span>
	</div>
	<div class="pnfpb-config-intro-text">
		<h2><?php esc_html_e( 'Select Push Notification Provider', 'push-notification-for-post-and-buddypress' ); ?></h2>
		<p><?php esc_html_e( 'Firebase &amp; Web-Push are free. OneSignal (up to 10,000 subscribers free), Progressier and Webtoapp.design are paid/partially paid.', 'push-notification-for-post-and-buddypress' ); ?></p>
	</div>
</div>

<div id="pnfpb-config-tabs" class="pnfpb-provider-tabs-bar">
	<a href="#pnfpb_ic_firebase_configuration" id="pnfpb_ic_firebase_configuration_button"
	   class="nav-tab tab nav-tab-active tab-firebase">
		<span class="pnfpb-tab-icon"><span class="dashicons dashicons-cloud"></span></span>
		<span class="pnfpb-tab-label"><?php esc_html_e( 'Firebase', 'push-notification-for-post-and-buddypress' ); ?></span>
		<span class="pnfpb-tab-badge pnfpb-tab-badge--free"><?php esc_html_e( 'Free', 'push-notification-for-post-and-buddypress' ); ?></span>
	</a>
	<a href="#pnfpb_ic_webpush_configuration" id="pnfpb_ic_webpush_configuration_button"
	   class="nav-tab tab tab-webpush">
		<span class="pnfpb-tab-icon"><span class="dashicons dashicons-bell"></span></span>
		<span class="pnfpb-tab-label"><?php esc_html_e( 'Web-Push', 'push-notification-for-post-and-buddypress' ); ?></span>
		<span class="pnfpb-tab-badge pnfpb-tab-badge--free"><?php esc_html_e( 'Free', 'push-notification-for-post-and-buddypress' ); ?></span>
	</a>
	<a href="#pnfpb_ic_onesignal_configuration" id="pnfpb_ic_onesignal_configuration_button"
	   class="nav-tab tab tab-onesignal">
		<span class="pnfpb-tab-icon"><span class="dashicons dashicons-megaphone"></span></span>
		<span class="pnfpb-tab-label"><?php esc_html_e( 'OneSignal', 'push-notification-for-post-and-buddypress' ); ?></span>
		<span class="pnfpb-tab-badge pnfpb-tab-badge--mixed"><?php esc_html_e( 'Freemium', 'push-notification-for-post-and-buddypress' ); ?></span>
	</a>
	<a href="#pnfpb_ic_progressier_configuration" id="pnfpb_ic_progressier_configuration_button"
	   class="nav-tab tab tab-progressier">
		<span class="pnfpb-tab-icon"><span class="dashicons dashicons-performance"></span></span>
		<span class="pnfpb-tab-label"><?php esc_html_e( 'Progressier', 'push-notification-for-post-and-buddypress' ); ?></span>
		<span class="pnfpb-tab-badge pnfpb-tab-badge--paid"><?php esc_html_e( 'Paid', 'push-notification-for-post-and-buddypress' ); ?></span>
	</a>
	<a href="#pnfpb_ic_webtoapp_configuration" id="pnfpb_ic_webtoapp_configuration_button"
	   class="nav-tab tab tab-webtoapp">
		<span class="pnfpb-tab-icon"><span class="dashicons dashicons-smartphone"></span></span>
		<span class="pnfpb-tab-label"><?php esc_html_e( 'Webtoapp.design', 'push-notification-for-post-and-buddypress' ); ?></span>
		<span class="pnfpb-tab-badge pnfpb-tab-badge--paid"><?php esc_html_e( 'Paid', 'push-notification-for-post-and-buddypress' ); ?></span>
	</a>
</div>

<?php
require_once( plugin_dir_path( __FILE__ ) . 'config_tab/pnfpb_config_firebase.php' );
require_once( plugin_dir_path( __FILE__ ) . 'config_tab/pnfpb_config_webpush.php' );
require_once( plugin_dir_path( __FILE__ ) . 'config_tab/pnfpb_config_onesignal.php' );
require_once( plugin_dir_path( __FILE__ ) . 'config_tab/pnfpb_config_progressier.php' );
require_once( plugin_dir_path( __FILE__ ) . 'config_tab/pnfpb_config_webtoapp.php' );
?>

<div class="pnfpb-save-bar-config">
	<?php submit_button(
		__( 'Save changes', 'push-notification-for-post-and-buddypress' ),
		'pnfpb_ic_push_save_configuration_button'
	); ?>
</div>
