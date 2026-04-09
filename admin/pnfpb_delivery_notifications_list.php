<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<h1 class="pnfpb_ic_push_settings_header">
	<span class="dashicons dashicons-chart-bar" style="font-size:26px;width:26px;height:26px;color:#1D4ED8;margin-top:3px;"></span>
	<?php echo esc_html(
     	__(
         	"PNFPB - Push Notification Reports",
         	"push-notification-for-post-and-buddypress"
     	)
 	); ?>
</h1>
<?php
	$pnfpb_tab_reportdelivery_active = "nav-tab-active";
	require_once( plugin_dir_path( __FILE__ ) . 'push_admin_menu_list.php' );
?>
<?php
// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery
// --- Summary stats cards ---
global $wpdb;
$pnfpb_total_sent      = (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}pnfpb_ic_total_statistics_notifications" );
$pnfpb_total_delivered = (int) $wpdb->get_var( "SELECT SUM(total_delivery_confirmation) FROM {$wpdb->prefix}pnfpb_ic_total_statistics_notifications" );
$pnfpb_total_read      = (int) $wpdb->get_var( "SELECT SUM(total_open_confirmation) FROM {$wpdb->prefix}pnfpb_ic_total_statistics_notifications" );
$pnfpb_delivery_rate   = $pnfpb_total_sent > 0 ? round( ( $pnfpb_total_delivered / max( $pnfpb_total_sent, 1 ) ) * 100, 1 ) : 0;
$pnfpb_read_rate       = $pnfpb_total_delivered > 0 ? round( ( $pnfpb_total_read / max( $pnfpb_total_delivered, 1 ) ) * 100, 1 ) : 0;
?>
<div class="pnfpb-stats-cards">
	<div class="pnfpb-stat-card pnfpb-stat-card--sent">
		<div class="pnfpb-stat-card__icon"><span class="dashicons dashicons-bell"></span></div>
		<div class="pnfpb-stat-card__body">
			<div class="pnfpb-stat-card__value"><?php echo esc_html( number_format_i18n( $pnfpb_total_sent ) ); ?></div>
			<div class="pnfpb-stat-card__label"><?php esc_html_e( 'Total Sent', 'push-notification-for-post-and-buddypress' ); ?></div>
		</div>
	</div>
	<div class="pnfpb-stat-card pnfpb-stat-card--delivered">
		<div class="pnfpb-stat-card__icon"><span class="dashicons dashicons-yes-alt"></span></div>
		<div class="pnfpb-stat-card__body">
			<div class="pnfpb-stat-card__value"><?php echo esc_html( number_format_i18n( $pnfpb_total_delivered ) ); ?></div>
			<div class="pnfpb-stat-card__label"><?php esc_html_e( 'Total Delivered', 'push-notification-for-post-and-buddypress' ); ?></div>
			<div class="pnfpb-stat-card__rate"><?php echo esc_html( $pnfpb_delivery_rate ); ?>% <?php esc_html_e( 'delivery rate', 'push-notification-for-post-and-buddypress' ); ?></div>
		</div>
	</div>
	<div class="pnfpb-stat-card pnfpb-stat-card--read">
		<div class="pnfpb-stat-card__icon"><span class="dashicons dashicons-visibility"></span></div>
		<div class="pnfpb-stat-card__body">
			<div class="pnfpb-stat-card__value"><?php echo esc_html( number_format_i18n( $pnfpb_total_read ) ); ?></div>
			<div class="pnfpb-stat-card__label"><?php esc_html_e( 'Total Read / Opened', 'push-notification-for-post-and-buddypress' ); ?></div>
			<div class="pnfpb-stat-card__rate"><?php echo esc_html( $pnfpb_read_rate ); ?>% <?php esc_html_e( 'open rate', 'push-notification-for-post-and-buddypress' ); ?></div>
		</div>
	</div>
</div>
<div class="pnfpb-info-box" style="margin-bottom:8px;">
	<span class="pnfpb-info-box__icon dashicons dashicons-info-outline" style="color:#3B82F6;"></span>
	<div>
		<strong><?php esc_html_e( 'Firebase &amp; Web-Push only', 'push-notification-for-post-and-buddypress' ); ?></strong> &mdash;
		<?php esc_html_e( 'Delivery and read tracking applies to web-browser, mobile-browser, PWA, Android and iOS mobile-app notifications. Turn ON/OFF tracking in the OPTIONS tab.', 'push-notification-for-post-and-buddypress' ); ?>
	</div>
</div>

<nav class="nav-tab-wrapper pnfpb-reports-sub-bar"
	 aria-label="<?php esc_attr_e( 'Report type', 'push-notification-for-post-and-buddypress' ); ?>">
	<a class="nav-tab pnfpb-sub-tab pnfpb-sub-tab--delivery nav-tab-active"
	   id="pnfpb-Notificationdefault" aria-current="page"
	   href="<?php echo esc_url( admin_url( 'admin.php?page=pnfpb_icfm_delivery_notifications_list&orderby=id&order=desc' ) ); ?>">
		<span class="pnfpb-sub-tab__icon" aria-hidden="true">
			<span class="dashicons dashicons-chart-line"></span>
		</span>
		<span class="pnfpb-sub-tab__label">
			<?php echo esc_html( __( 'Delivery &amp; Read Report', 'push-notification-for-post-and-buddypress' ) ); ?>
		</span>
	</a>
	<a class="nav-tab pnfpb-sub-tab pnfpb-sub-tab--browser"
	   href="<?php echo esc_url( admin_url( 'admin.php?page=pnfpb_icfm_browser_delivery_notifications_list&orderby=id&order=desc' ) ); ?>">
		<span class="pnfpb-sub-tab__icon" aria-hidden="true">
			<span class="dashicons dashicons-desktop"></span>
		</span>
		<span class="pnfpb-sub-tab__label">
			<?php echo esc_html( __( 'Browser Details', 'push-notification-for-post-and-buddypress' ) ); ?>
		</span>
	</a>
	<a class="nav-tab pnfpb-sub-tab pnfpb-sub-tab--adminpush"
	   href="<?php echo esc_url( admin_url( 'admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc' ) ); ?>">
		<span class="pnfpb-sub-tab__icon" aria-hidden="true">
			<span class="dashicons dashicons-megaphone"></span>
		</span>
		<span class="pnfpb-sub-tab__label">
			<?php echo esc_html( __( 'Sent from Admin', 'push-notification-for-post-and-buddypress' ) ); ?>
		</span>
	</a>
	<a class="nav-tab pnfpb-sub-tab pnfpb-sub-tab--analytics"
	   href="<?php echo esc_url( admin_url( 'admin.php?page=pnfpb_icfm_analytics_notifications' ) ); ?>">
		<span class="pnfpb-sub-tab__icon" aria-hidden="true">
			<span class="dashicons dashicons-chart-area"></span>
		</span>
		<span class="pnfpb-sub-tab__label">
			<?php echo esc_html( __( 'Analytics Chart', 'push-notification-for-post-and-buddypress' ) ); ?>
		</span>
	</a>
</nav>

<div id="pnfpb-deliveryConfirmation" class="pnfpb_notification_list_tabcontent pnfpb_ic_push_settings_table">
	<div class="pnfpb_column_1200">
		<div class="wrap">
			<div class="pnfpb_row">
				<div class="pnfpb_column_400">					
					<h2>
						<?php echo esc_html(
			 			__(
				 			"Delivered and read report for all push notifications sent using Firebase",
				 			"push-notification-for-post-and-buddypress"
			 			)
		 				); ?>
					</h2>
				</div>
			</div>
			<div id="poststuff">
				<div id="post-body" class="metabox-holder">
					<div id="post-body-content">
						<div class="meta-box-sortables ui-sortable">
							<form method="post">
								<?php
								$this->pushnotifications_delivered_obj->prepare_items();
								$this->pushnotifications_delivered_obj->pnfpb_url_scheme_start();
								$this->pushnotifications_delivered_obj->search_box(
									"Search",
									"pnfpb_push_notifications_search"
								);
								$this->pushnotifications_delivered_obj->display();
								wp_nonce_field( 'pnfpb_delivery_report-bulk_delete_items' ); // Action name for the nonce
								wp_nonce_field( 'pnfpb_search_delivery_pushnotification', '_wpnonce' );
								$this->pushnotifications_delivered_obj->pnfpb_url_scheme_stop();
								?>
							</form>
						</div>
					</div>
				</div>
				<br class="clear">
			</div>
		</div>
	</div>
</div>
