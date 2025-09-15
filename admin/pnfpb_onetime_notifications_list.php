	<h1 class="pnfpb_ic_push_settings_header"><?php echo esc_html(
     __(
         "PNFPB - Push Notification reports",
         "push-notification-for-post-and-buddypress"
     )
 ); ?></h1>
<?php
	$pnfpb_tab_pushlist_active = "nav-tab-active";
	require_once( plugin_dir_path( __FILE__ ) . 'push_admin_menu_list.php' );
?>
<div id="pnfpb-notifications-list" class="pnfpb_ic_push_settings_table pnfpb_notifications_list">
	<h2>
		<?php echo esc_html(
	__(
		"Push notifications list and delivery statistics",
		"push-notification-for-post-and-buddypress"
	)
); ?>
	</h2>
</div>

<div class="nav-tab-wrapper">
	<a class="nav-tab" href="<?php echo esc_url(
	admin_url()."admin.php?page=pnfpb_icfm_delivery_notifications_list&orderby=id&order=desc"); ?>">
		<?php echo esc_html(__("Delivery and read report", "push-notification-for-post-and-buddypress")); ?>
	</a>		
	<a class="nav-tab" href="<?php echo esc_url(
	admin_url()."admin.php?page=pnfpb_icfm_browser_delivery_notifications_list&orderby=id&order=desc"); ?>">
		<?php echo esc_html(__("Delivery report with browser details", "push-notification-for-post-and-buddypress")); ?>
	</a>
	<a id="pnfpb-Notificationdefault" class="nav-tab nav-tab-active" href="<?php echo esc_url(
	admin_url()."admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc"); ?>">
		<?php echo esc_html(__("Notifications sent from admin", "push-notification-for-post-and-buddypress")); ?>
	</a>
</div>

<div id="pnfpb-adminNotificationlist" class="pnfpb_notification_list_tabcontent pnfpb_ic_push_settings_table">
	<div class="pnfpb_column_1200">
		<div class="wrap">
			<div class="pnfpb_row">
  				<div class="pnfpb_column_400">					
					<h2><?php echo esc_html(
         __(
             "List of one time Push notifications",
             "push-notification-for-post-and-buddypress"
         )
     ); ?></h2>
					<h4><?php echo wp_kses_post(
         __(
             "Edit/Resend link will redirect to one time push notification form, so that same content/modified content can be send as push notification<br/>Delete link is to delete push notification entry<br />More actions link will show details of in action scheduler page, Hovering over the entry on action scheduler will show options to Run-now or Cancel the scheduled push notification",
             "push-notification-for-post-and-buddypress"
         )
     ); ?></h4>
				</div>
			</div>
			<?php $scheduled_type_nonce = wp_create_nonce(
       "pnfpb_scheduled_type_pushnotification"
   ); ?>
			<div  class="pnfpb_row">
			<ul class="subsubsub">
				<li class="all">
					<a href="/wp-admin/admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc">All</a>
				</li> | 
				<li class="ondemand">
					<a href="/wp-admin/admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc&scheduled_type=onetime&_wpnonce=<?php echo esc_html(
         $scheduled_type_nonce
     ); ?>"><?php echo esc_html(
    __("On demand", "push-notification-for-post-and-buddypress")
); ?></a>
				</li> | 
				<li class="singleschedule">
					<a href="/wp-admin/admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc&scheduled_type=single&_wpnonce=<?php echo esc_html(
         $scheduled_type_nonce
     ); ?>"><?php echo esc_html(
    __("Single/One time schedule", "push-notification-for-post-and-buddypress")
); ?></a>
				</li> | 
				<li class="recurringschedule">
					<a href="/wp-admin/admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc&scheduled_type=recurring&_wpnonce=<?php echo esc_html(
         $scheduled_type_nonce
     ); ?>"><?php echo esc_html(
    __("Recurring schedule", "push-notification-for-post-and-buddypress")
); ?></a>
				</li> |
				<li class="recurringschedule">
					<a href="/wp-admin/admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc&scheduled_status=complete&_wpnonce=<?php echo esc_html(
         $scheduled_type_nonce
     ); ?>"><?php echo esc_html(
    __("Complete", "push-notification-for-post-and-buddypress")
); ?></a>
				</li> |
				<li class="recurringschedule">
					<a href="/wp-admin/admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc&scheduled_type=draft&_wpnonce=<?php echo esc_html(
         $scheduled_type_nonce
     ); ?>"><?php echo esc_html(
    __("Draft", "push-notification-for-post-and-buddypress")
); ?></a>
				</li> |
				<li class="recurringschedule">
					<a href="/wp-admin/admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc&scheduled_status=pending&_wpnonce=<?php echo esc_html(
         $scheduled_type_nonce
     ); ?>"><?php echo esc_html(
    __(
        "Pending (scheduled for future date)",
        "push-notification-for-post-and-buddypress"
    )
); ?></a>
				</li>				
			</ul>
			</div>
			<div  class="pnfpb_row">
			<?php
   $nonce = "";

   if (isset($_REQUEST["_wpnonce"])) {
       $nonce = esc_attr(
           sanitize_text_field(wp_unslash($_REQUEST["_wpnonce"]))
       );
   }

   if (
       isset($_GET["scheduled_type"]) &&
       !wp_verify_nonce($nonce, "pnfpb_scheduled_type_pushnotification")
   ) {
       die("wnonce failure");
   } else {
       if (
           isset($_GET["scheduled_type"]) &&
           sanitize_text_field(
               wp_unslash($_GET["scheduled_type"]) === "onetime"
           )
       ) {
           echo esc_html(
                   __(
                       "On demand push notifications list",
                       "push-notification-for-post-and-buddypress"
                   )
               );
       }
       if (
           isset($_GET["scheduled_type"]) &&
           sanitize_text_field(wp_unslash($_GET["scheduled_type"]) === "single")
       ) {
           echo esc_html(
                   __(
                       "Single/One time schedule push notifications",
                       "push-notification-for-post-and-buddypress"
                   )
               );
       }
       if (
           isset($_GET["scheduled_type"]) &&
           sanitize_text_field(
               wp_unslash($_GET["scheduled_type"]) === "recurring"
           )
       ) {
           echo esc_html(
                   __(
                       "Recurring schedule push notifications",
                       "push-notification-for-post-and-buddypress"
                   )
               );
       }
       if (
           isset($_GET["scheduled_type"]) &&
           sanitize_text_field(wp_unslash($_GET["scheduled_type"]) === "draft")
       ) {
           echo esc_html(
                   __(
                       "Draft push notification list to be sent future",
                       "push-notification-for-post-and-buddypress"
                   )
               );
       }
       if (
           isset($_GET["scheduled_status"]) &&
           sanitize_text_field(
               wp_unslash($_GET["scheduled_status"]) === "complete"
           )
       ) {
           echo esc_html(
                   __(
                       "Completed schedule list of push notifications",
                       "push-notification-for-post-and-buddypress"
                   )
               );
       }
       if (
           isset($_GET["scheduled_status"]) &&
           sanitize_text_field(
               wp_unslash($_GET["scheduled_status"]) === "pending"
           )
       ) {
           echo esc_html(
                   __(
                       "Pending/upcoming/future scheduled list of push notifications",
                       "push-notification-for-post-and-buddypress"
                   )
               );
       }
   }
   ?>		
			</div>
			<div id="poststuff">
				<div id="post-body" class="metabox-holder">
					<div id="post-body-content">
						<div class="meta-box-sortables ui-sortable">
							<form method="post">
								<?php
            					$this->pushnotifications_obj->prepare_items();
        						$this->pushnotifications_obj->pnfpb_url_scheme_start();
        						$this->pushnotifications_obj->search_box(
            						"Search",
            						"pnfpb_push_notifications_search"
        						);
        						$this->pushnotifications_obj->display();
								wp_nonce_field( 'pnfpb_onetime_notifications_list', '_wpnonce' );
        						$this->pushnotifications_obj->pnfpb_url_scheme_stop();
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