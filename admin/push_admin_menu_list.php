<?php
/**
 * Push Notification plugin — top-level admin navigation tabs.
 *
 * Each entry: url, label (i18n string), dashicons class, slug (CSS modifier),
 * active variable (set by the including page when that tab is current).
 *
 * @since 2.20.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$pnfpb_top_tabs_data = array(
	array(
		'url'    => admin_url( 'admin.php?page=pnfpb-push-notification-configuration-slug' ),
		'label'  => __( 'Configuration', 'push-notification-for-post-and-buddypress' ),
		'icon'   => 'dashicons-admin-settings',
		'slug'   => 'config',
		'active' => isset( $pnfpb_tab_config_active )   ? $pnfpb_tab_config_active   : '',
	),
		array(
			'url'    => admin_url( 'admin.php?page=pnfpb_icfm_ai_assistant_settings' ),
			'label'  => __( 'AI assistant', 'push-notification-for-post-and-buddypress' ),
			'icon'   => 'dashicons-art',
			'slug'   => 'aiassistant',
			'active' => isset( $pnfpb_tab_ai_active )      ? $pnfpb_tab_ai_active      : '',
		),
	array(
		'url'    => admin_url( 'admin.php?page=pnfpb-icfcm-slug' ),
		'label'  => __( 'Options', 'push-notification-for-post-and-buddypress' ),
		'icon'   => 'dashicons-admin-generic',
		'slug'   => 'options',
		'active' => isset( $pnfpb_tab_settings_active ) ? $pnfpb_tab_settings_active : '',
	),
	array(
		'url'    => admin_url( 'admin.php?page=pnfpb_icfmtest_notification' ),
		'label'  => __( 'Send Push', 'push-notification-for-post-and-buddypress' ),
		'icon'   => 'dashicons-megaphone',
		'slug'   => 'sendpush',
		'active' => isset( $pnfpb_tab_sendpush_active ) ? $pnfpb_tab_sendpush_active : '',
	),
	array(
		'url'    => admin_url( 'admin.php?page=pnfpb_icfm_delivery_notifications_list&orderby=id&order=desc' ),
		'label'  => __( 'Reports', 'push-notification-for-post-and-buddypress' ),
		'icon'   => 'dashicons-chart-bar',
		'slug'   => 'reports',
		'active' => isset( $pnfpb_tab_adminpush_active ) ? $pnfpb_tab_adminpush_active : '',
	),
	array(
		'url'    => admin_url( 'admin.php?page=pnfpb_icfm_pwa_app_settings' ),
		'label'  => __( 'PWA', 'push-notification-for-post-and-buddypress' ),
		'icon'   => 'dashicons-smartphone',
		'slug'   => 'pwa',
		'active' => isset( $pnfpb_tab_pwa_active )      ? $pnfpb_tab_pwa_active      : '',
	),
	array(
		'url'    => admin_url( 'admin.php?page=pnfpb_icfm_device_tokens_list' ),
		'label'  => __( 'Tokens', 'push-notification-for-post-and-buddypress' ),
		'icon'   => 'dashicons-lock',
		'slug'   => 'tokens',
		'active' => isset( $pnfpb_tab_tokens_active )   ? $pnfpb_tab_tokens_active   : '',
	),
	array(
		'url'    => admin_url( 'admin.php?page=pnfpb_icfm_frontend_settings' ),
		'label'  => __( 'Frontend', 'push-notification-for-post-and-buddypress' ),
		'icon'   => 'dashicons-admin-appearance',
		'slug'   => 'frontend',
		'active' => isset( $pnfpb_tab_frontend_active ) ? $pnfpb_tab_frontend_active : '',
	),
	array(
		'url'    => admin_url( 'admin.php?page=pnfpb_icfm_shortcode_settings' ),
		'label'  => __( 'Shortcodes', 'push-notification-for-post-and-buddypress' ),
		'icon'   => 'dashicons-shortcode',
		'slug'   => 'shortcodes',
		'active' => isset( $pnfpb_tab_shortcode_active ) ? $pnfpb_tab_shortcode_active : '',
	),
	array(
		'url'    => admin_url( 'admin.php?page=pnfpb_icfm_button_settings' ),
		'label'  => __( 'Buttons', 'push-notification-for-post-and-buddypress' ),
		'icon'   => 'dashicons-button',
		'slug'   => 'buttons',
		'active' => isset( $pnfpb_tab_buttons_active )  ? $pnfpb_tab_buttons_active  : '',
	),
	array(
		'url'    => admin_url( 'admin.php?page=pnfpb_icfm_integrate_app' ),
		'label'  => __( 'Mobile App', 'push-notification-for-post-and-buddypress' ),
		'icon'   => 'dashicons-tablet',
		'slug'   => 'mobileapp',
		'active' => isset( $pnfpb_tab_mobileapp_active ) ? $pnfpb_tab_mobileapp_active : '',
	),
	array(
		'url'    => admin_url( 'admin.php?page=pnfpb_icfm_settings_for_ngnix_server' ),
		'label'  => __( 'NGINX', 'push-notification-for-post-and-buddypress' ),
		'icon'   => 'dashicons-admin-network',
		'slug'   => 'nginx',
		'active' => isset( $pnfpb_tab_nginx_active )    ? $pnfpb_tab_nginx_active    : '',
	),
	array(
		'url'    => admin_url( 'admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1' ),
		'label'  => __( 'Scheduler', 'push-notification-for-post-and-buddypress' ),
		'icon'   => 'dashicons-clock',
		'slug'   => 'scheduler',
		'active' => isset( $pnfpb_tab_as_active )       ? $pnfpb_tab_as_active       : '',
	),
);
?>
<nav class="nav-tab-wrapper pnfpb-main-nav-bar"
	 aria-label="<?php esc_attr_e( 'Push Notification Settings', 'push-notification-for-post-and-buddypress' ); ?>">
<?php foreach ( $pnfpb_top_tabs_data as $pnfpb_tab ) :
	$pnfpb_is_active = ! empty( $pnfpb_tab['active'] );
	$pnfpb_tab_classes = implode( ' ', array_filter( array(
		'nav-tab',
		'pnfpb-main-tab',
		'pnfpb-main-tab--' . $pnfpb_tab['slug'],
		$pnfpb_is_active ? 'nav-tab-active pnfpb-main-tab--active' : '',
	) ) );
?>
	<a href="<?php echo esc_url( $pnfpb_tab['url'] ); ?>"
	   class="<?php echo esc_attr( $pnfpb_tab_classes ); ?>"
	   <?php echo $pnfpb_is_active ? 'aria-current="page"' : ''; ?>>
		<span class="pnfpb-main-tab__icon" aria-hidden="true">
			<span class="dashicons <?php echo esc_attr( $pnfpb_tab['icon'] ); ?>"></span>
		</span>
		<span class="pnfpb-main-tab__label">
			<?php echo esc_html( $pnfpb_tab['label'] ); ?>
		</span>
	</a>
<?php endforeach; ?>
</nav>