<?php
/**
 * Plugin settings area to send one time/on demand push notification to all subscribers
 *
 * @since 1.21
 */
?>

<h1 class="pnfpb_ic_push_settings_header"><?php echo esc_html(
	__(
		"PNFPB - On demand/one time push notification",
		"push-notification-for-post-and-buddypress"
	)
); ?></h1>
<?php
	$pnfpb_tab_sendpush_active = "nav-tab-active";
	require_once( plugin_dir_path( __FILE__ ) . 'push_admin_menu_list.php' );
	// Run processing logic: handles form submissions, DB queries, sets template variables.
	require( plugin_dir_path( __FILE__ ) . 'send_push_tab/pnfpb_ondemand_process.php' );
?>
<div class="pnfpb_column_1200">
	<h2 class="pnfpb_ic_push_settings_details"><?php echo esc_html(
		__(
			"To send on demand or one time push notification to all subscribers with image",
			"push-notification-for-post-and-buddypress"
		)
	); ?></h2>

	<?php include( plugin_dir_path( __FILE__ ) . 'send_push_tab/pnfpb_ondemand_form.php' ); ?>
</div>
