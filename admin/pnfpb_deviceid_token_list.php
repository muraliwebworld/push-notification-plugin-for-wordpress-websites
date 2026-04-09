<?php
/*********************************************************************************
* Admin page to list and manage device tokens
* Device id list table to show list of Firebase subscription tokens for every user
*********************************************************************************/
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery
if (
	((isset($_POST["_wp_device_index_nonce"])) && (isset($_POST["pnfpb_create_subscription_index"]))) &&
	(!wp_verify_nonce(esc_attr(sanitize_text_field(wp_unslash($_POST["_wp_device_index_nonce"]))), "pnfpb_index_subscription_tokens"))
) {
	die("wnonce failure");
} else {
	global $wpdb;
	if (isset($_POST["pnfpb_create_subscription_index"])) {
		$action_scheduler_status = as_schedule_single_action( time()+2, 'PNFPB_create_index_for_deviceid_action',[] );
        if ($action_scheduler_status) {
				update_option('pnfpb_index_status_of_device_token_table', 'in_progress');
				update_option('pnfpb_index_jobid_of_device_token_table', $action_scheduler_status);
		?>
    			<div class="notice notice-success is-dismissible">
					<p>
						<?php echo esc_html(__("Indexing of device token subscription table scheduled successfully.", "push-notification-for-post-and-buddypress"))?>
					</p>
					<a href="<?php echo esc_url(admin_url()."admin.php?page=pnfpb_icfm_action_scheduler&orderby=schedule&order=desc&s=PNFPB&action=-1&paged=1&action2=-1"); ?>">
						<?php echo esc_html(__("Action scheduler task id is ",
					"push-notification-for-post-and-buddypress").$action_scheduler_status)?>
					</a>
    			</div>
		<?php } else {
			update_option('pnfpb_index_status_of_device_token_table', '');
            $error_message = "";
            if (is_wp_error($action_scheduler_status)) {
                $error_message = $action_scheduler_status->get_error_message();
            }
            ?>
	    			<div class="notice notice-error is-dismissible">
        				<p>
							<?php esc_html_e(
                				"CRON Error...in scheduling notification. Please try again",
               					 "push-notification-for-post-and-buddypress"
            				); ?>
						</p>
						<?php if ($error_message != "") { ?>
						<p>
							<?php echo esc_html($error_message); ?>
						</p>
						<?php } ?>
    				</div>
		<?php }		
	}
}

if (get_option('pnfpb_index_status_of_device_token_table') === false || (get_option('pnfpb_index_status_of_device_token_table') === '' || get_option('pnfpb_index_status_of_device_token_table') !== 'complete' && get_option('pnfpb_index_status_of_device_token_table') !== 'in_progress')) {
	$dbname = $wpdb->dbname;
	$pnfpb_table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	$index_names = $wpdb->get_results($wpdb->prepare("SHOW INDEXES FROM %i",$pnfpb_table_name));
	$index_name_exists = false;
	if (is_array($index_names) ) {
		foreach ($index_names as $index_name) {
			if (isset($index_name->Key_name) && $index_name->Key_name === 'idx_device_id') {
				$index_name_exists = true;
			}
		}
	}
	if (!$index_name_exists) {
?>
			<div class="pnfpb_column_1200">
				<div class="pnfpb-info-box pnfpb-info-box--warning" style="margin-bottom:12px;">
					<span class="pnfpb-info-box__icon dashicons dashicons-performance" style="color:#B45309;"></span>
					<div>
						<strong><?php esc_html_e( 'One-time database index required', 'push-notification-for-post-and-buddypress' ); ?></strong><br>
						<?php esc_html_e( 'Create an index on the subscription token table to improve query performance when you have more than 20,000 subscribers.', 'push-notification-for-post-and-buddypress' ); ?>
						<br><em><small><?php esc_html_e( 'Take a database backup first and run this during low-traffic hours or with maintenance mode enabled.', 'push-notification-for-post-and-buddypress' ); ?></small></em>
						<br><em><small><?php esc_html_e( 'This is a one-time option, visible only for sites upgraded from plugin version 3.08 or earlier.', 'push-notification-for-post-and-buddypress' ); ?></small></em>
					</div>
				</div>
				<form method="post" enctype="multipart/form-data" class="form-field" style="margin-top:10px;">
					<div>
						<?php
						$pnfpb_nonce = wp_create_nonce("pnfpb_index_subscription_tokens");
						?>
						<input type="hidden" name="_wp_device_index_nonce" value="<?php echo esc_html($pnfpb_nonce); ?>" />
						<?php submit_button(
				__(
					"Create Device token index",
					"push-notification-for-post-and-buddypress"
				),
				"primary",
				"pnfpb_create_subscription_index"
			); ?>
					</div>
				</form>
			</div>
<?php	}
 } else {
	if (get_option('pnfpb_index_status_of_device_token_table') === 'in_progress') {
		$action_scheduler_status = get_option('pnfpb_index_jobid_of_device_token_table');
	?>
    			<div class="notice notice-success is-dismissible">
					<p>
						<?php echo esc_html(__("Indexing of device token subscription table is in progress.", "push-notification-for-post-and-buddypress"))?>
					</p>
					<a href="<?php echo esc_url(admin_url()."admin.php?page=pnfpb_icfm_action_scheduler&orderby=schedule&order=desc&s=PNFPB&action=-1&paged=1&action2=-1"); ?>">
						<?php echo esc_html(__("Action scheduler task id is ").$action_scheduler_status)?>
					</a>
    			</div>
<?php
	}
} ?>

<div class="pnfpb_column_1200">
	<div class="wrap">
		<?php $pnfpb_total_tokens = PNFPB_ICFM_Device_tokens_List::record_count(); ?>
		<div class="pnfpb-stats-cards" style="margin-bottom:12px;">
			<div class="pnfpb-stat-card pnfpb-stat-card--tokens">
				<div class="pnfpb-stat-card__icon"><span class="dashicons dashicons-admin-network"></span></div>
				<div class="pnfpb-stat-card__body">
					<div class="pnfpb-stat-card__value"><?php echo esc_html( number_format_i18n( (int) $pnfpb_total_tokens ) ); ?></div>
					<div class="pnfpb-stat-card__label"><?php esc_html_e( 'Registered Tokens', 'push-notification-for-post-and-buddypress' ); ?></div>
					<div class="pnfpb-stat-card__rate"><?php esc_html_e( 'active push subscriptions', 'push-notification-for-post-and-buddypress' ); ?></div>
				</div>
			</div>
		</div>
		<div class="pnfpb-info-box pnfpb-info-box--warning" style="margin-bottom:12px;">
			<span class="pnfpb-info-box__icon dashicons dashicons-warning" style="color:#B45309;"></span>
			<div>
				<strong><?php esc_html_e( 'Do not delete tokens unnecessarily', 'push-notification-for-post-and-buddypress' ); ?></strong> &mdash;
				<?php esc_html_e( 'Deleting a token will prevent that user from receiving push notifications on that device until they re-subscribe.', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
		</div>
		<?php settings_fields("pnfpb_icfcm_token"); ?>
		<?php do_settings_sections("pnfpb_icfcm_token"); ?>					
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<div id="post-body-content">
					<div class="meta-box-sortables ui-sortable">
						<form method="post">
							<?php
							$this->devicetokens_obj->prepare_items();
							$this->devicetokens_obj->pnfpb_url_scheme_start();
							$this->devicetokens_obj->search_box(
								"Search",
								"pnfpb_device_token_search"
							);
							$this->devicetokens_obj->display();
							wp_nonce_field( 'pnfpb_icfcm_device_tokens_list', '_wpnonce' );
							$this->devicetokens_obj->pnfpb_url_scheme_stop();
							?>
						</form>
					</div>
				</div>
			</div>
			<br class="clear">
		</div>
		<div class="pnfpb_row">
			<div class="pnfpb_column_400">
				<p>
					<b><?php echo esc_html(
	__(
		"Subscription option code - details",
		"push-notification-for-post-and-buddypress"
	)
); ?> </b><br/>
					<?php echo esc_html(
	__(
		"if Subscription option is 1000000000000 means user subscribed all notifications",
		"push-notification-for-post-and-buddypress"
	)
); ?> <br/>
					<?php echo esc_html(
	__(
		' "1" in 1st position indicates - subscribed to all notifications',
		"push-notification-for-post-and-buddypress"
	)
); ?> <br/>
					<?php echo esc_html(
	__(
		' "1" in 2nd position indicates - subscribed to Post/custom post notifications',
		"push-notification-for-post-and-buddypress"
	)
); ?> <br/>
					<?php echo esc_html(
	__(
		' "1" in 3rd position indicates - subscribed to Comments notifications',
		"push-notification-for-post-and-buddypress"
	)
); ?> <br/>
					<?php echo esc_html(
	__(
		' "1" in 4th position indicates - subscribed to my-comments notifications',
		"push-notification-for-post-and-buddypress"
	)
); ?> <br/>
					<?php echo esc_html(
	__(
		' "1" in 5th position indicates - subscribed to new member notifications',
		"push-notification-for-post-and-buddypress"
	)
); ?> <br/>
					<?php echo esc_html(
	__(
		' "1" in 6th position indicates - subscribed to private message notifications',
		"push-notification-for-post-and-buddypress"
	)
); ?> <br/>
					<?php echo esc_html(
	__(
		' "1" in 7th position indicates - subscribed to friendship request notifications',
		"push-notification-for-post-and-buddypress"
	)
); ?> <br/>
					<?php echo esc_html(
	__(
		' "1" in 8th position indicates - subscribed to friendship accept notifications',
		"push-notification-for-post-and-buddypress"
	)
); ?> <br/>
					<?php echo esc_html(
	__(
		' "1" in 9th position indicates - Unsubscribed to all notifications',
		"push-notification-for-post-and-buddypress"
	)
); ?> <br/>
					<?php echo esc_html(
	__(
		' "1" in 10th position indicates - subscribed to profile avatar change notifications',
		"push-notification-for-post-and-buddypress"
	)
); ?> <br/>
					<?php echo esc_html(
	__(
		' "1" in 11th position indicates - subscribed to profile cover image change notifications',
		"push-notification-for-post-and-buddypress"
	)
); ?> <br/>
					<?php echo esc_html(
	__(
		' "1" in 12th position indicates - Subscribed to BuddyPress activities/group activities',
		"push-notification-for-post-and-buddypress"
	)
); ?> <br/>
					<?php echo esc_html(
	__(
		' "1" in 13th position indicates - subscribed to group invite notifications',
		"push-notification-for-post-and-buddypress"
	)
); ?> <br/>
					<?php echo esc_html(
	__(
		' "1" in 14th position indicates - subscribed to group details update notifications',
		"push-notification-for-post-and-buddypress"
	)
); ?> <br/>
				</p>
			</div>
		</div>					
	</div>
</div>
<?php
?>