	<h1 class="pnfpb_ic_push_settings_header">
	<span class="dashicons dashicons-desktop" style="font-size:26px;width:26px;height:26px;color:#0D9488;margin-top:3px;"></span>
	<?php echo esc_html(
     __(
         "PNFPB - Push Notification Reports",
         "push-notification-for-post-and-buddypress"
     )
 ); ?></h1>
<?php
	$pnfpb_tab_reportbrowser_active = "nav-tab-active";
	require_once( plugin_dir_path( __FILE__ ) . 'push_admin_menu_list.php' );
?>

<div class="pnfpb-info-box" style="margin-bottom:8px;">
	<span class="pnfpb-info-box__icon dashicons dashicons-info-outline" style="color:#0D9488;"></span>
	<div>
		<strong><?php esc_html_e( 'Per-device browser breakdown', 'push-notification-for-post-and-buddypress' ); ?></strong> &mdash;
		<?php esc_html_e( 'Each row shows delivery and open status for a specific device / browser / app. Icons indicate the browser and device type. Hover an icon for full details.', 'push-notification-for-post-and-buddypress' ); ?>
	</div>
</div>

<nav class="nav-tab-wrapper pnfpb-reports-sub-bar"
	 aria-label="<?php esc_attr_e( 'Report type', 'push-notification-for-post-and-buddypress' ); ?>">
	<a class="nav-tab pnfpb-sub-tab pnfpb-sub-tab--delivery"
	   id="pnfpb-Notificationdefault"
	   href="<?php echo esc_url( admin_url( 'admin.php?page=pnfpb_icfm_delivery_notifications_list&orderby=id&order=desc' ) ); ?>">
		<span class="pnfpb-sub-tab__icon" aria-hidden="true">
			<span class="dashicons dashicons-chart-line"></span>
		</span>
		<span class="pnfpb-sub-tab__label">
			<?php echo esc_html( __( 'Delivery &amp; Read Report', 'push-notification-for-post-and-buddypress' ) ); ?>
		</span>
	</a>
	<a class="nav-tab pnfpb-sub-tab pnfpb-sub-tab--browser nav-tab-active"
	   aria-current="page"
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
<div id="pnfpb-browserdeliveryConfirmation" class="pnfpb_notification_list_tabcontent pnfpb_ic_push_settings_table">
	<div class="pnfpb_column_1200">
		<div class="wrap">
			<div class="pnfpb_row">
				<div class="pnfpb_column_400">					
						<h2><?php echo esc_html(
			 	__(
				 "Below report shows Notification delivered report with browser details for all push notifications sent using Firebase",
				 "push-notification-for-post-and-buddypress"
			 	)
		 	); ?></h2>
			</div>
			</div>
			<div id="poststuff">
				<div id="post-body" class="metabox-holder">
					<div id="post-body-content">
						<div class="meta-box-sortables ui-sortable">
							<form method="post">
								<?php
								   $this->pushnotification_browser_delivered_obj->prepare_items();
								   $this->pushnotification_browser_delivered_obj->pnfpb_url_scheme_start();
								   $this->pushnotification_browser_delivered_obj->search_box(
									   "Search",
									   "pnfpb_push_notifications_search"
								   );
								   $this->pushnotification_browser_delivered_obj->display();
								   wp_nonce_field( 'pnfpb_browser_delivery_report-bulk_delete_items' ); // Action name for the nonce
								   wp_nonce_field( 'pnfpb_search_browser_delivery_pushnotification', '_wpnonce' );
								   $this->pushnotification_browser_delivered_obj->pnfpb_url_scheme_stop();
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