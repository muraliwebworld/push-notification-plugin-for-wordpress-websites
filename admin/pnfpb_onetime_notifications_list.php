	<h1 class="pnfpb_ic_push_settings_header"><?php echo __("PNFPB - Push notifications list",'PNFPB_TD');?></h1>
	<div class="nav-tab-wrapper">
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb-icfcm-slug" class="nav-tab tab"><?php echo __("Push Settings",'PNFPB_TD');?></a>
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_device_tokens_list" class="nav-tab tab"><?php echo __("Device tokens",'PNFPB_TD');?></a>
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_pwa_app_settings" class="nav-tab tab "><?php echo __("PWA",'PNFPB_TD');?></a>
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfmtest_notification" class="nav-tab tab "><?php echo __("Send push notification",'PNFPB_TD');?></a>
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc" class="nav-tab nav-tab-active tab active"><?php echo __("Push Notifications list",'PNFPB_TD');?></a>
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_frontend_settings" class="nav-tab tab"><?php echo __("Frontend subscription settings",'PNFPB_TD');?></a>
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_button_settings" class="nav-tab tab "><?php echo __("Customize buttons",'PNFPB_TD');?></a>
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_integrate_app" class="nav-tab tab "><?php echo __("Integrate Mobile app",'PNFPB_TD');?></a>
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="nav-tab tab "><?php echo __("NGINX",'PNFPB_TD');?></a>
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1" class="nav-tab tab "><?php echo __("Action Scheduler",'PNFPB_TD');?></a>
	</div>
	<div class="pnfpb_column_1200">
		<div class="wrap">
			<div class="pnfpb_row">
  				<div class="pnfpb_column_400">					
					<h2><?php echo __("List of one time Push notifications",'PNFPB_TD');?></h2>
					<h4><?php echo __("Edit/Resend link will redirect to one time push notification form, so that same content/modified content can be send as push notification<br/>Delete link is to delete push notification entry<br />More actions link will show details of in action scheduler page, Hovering over the entry on action scheduler will show options to Run-now or Cancel the scheduled push notification",'PNFPB_TD');?></h4>
				</div>
			</div>
			<div  class="pnfpb_row">
			<ul class="subsubsub">
				<li class="all">
					<a href="/wp-admin/admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc">All</a>
				</li> | 
				<li class="ondemand">
					<a href="/wp-admin/admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc&scheduled_type=onetime"><?php echo __("On demand",'PNFPB_TD');?></a>
				</li> | 
				<li class="singleschedule">
					<a href="/wp-admin/admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc&scheduled_type=single"><?php echo __("Single/One time schedule",'PNFPB_TD');?></a>
				</li> | 
				<li class="recurringschedule">
					<a href="/wp-admin/admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc&scheduled_type=recurring"><?php echo __("Recurring schedule",'PNFPB_TD');?></a>
				</li> |
				<li class="recurringschedule">
					<a href="/wp-admin/admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc&scheduled_status=complete"><?php echo __("Complete",'PNFPB_TD');?></a>
				</li> |
				<li class="recurringschedule">
					<a href="/wp-admin/admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc&scheduled_type=draft"><?php echo __("Draft",'PNFPB_TD');?></a>
				</li> |
				<li class="recurringschedule">
					<a href="/wp-admin/admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc&scheduled_status=pending"><?php echo __("Pending (scheduled for future date)",'PNFPB_TD');?></a>
				</li>				
			</ul>
			</div>
			<div  class="pnfpb_row">
			<?php
				if (isset($_GET['scheduled_type']) && $_GET['scheduled_type'] === 'onetime') {
					echo '<h3>'.__('On demand push notifications list','PNFPB_TD').'</h3>';
				}
				if (isset($_GET['scheduled_type']) && $_GET['scheduled_type'] === 'single') {
					echo '<h3>'.__('Single/One time schedule push notifications','PNFPB_TD').'</h3>';
				}
				if (isset($_GET['scheduled_type']) && $_GET['scheduled_type'] === 'recurring') {
					echo '<h3>'.__('Recurring schedule push notifications','PNFPB_TD').'</h3>';
				}
				if (isset($_GET['scheduled_type']) && $_GET['scheduled_type'] === 'draft') {
					echo '<h3>'.__('Draft push notification list to be sent future','PNFPB_TD').'</h3>';
				}
				if (isset($_GET['scheduled_status']) && $_GET['scheduled_status'] === 'complete') {
					echo '<h3>'.__('Completed schedule list of push notifications','PNFPB_TD').'</h3>';
				}
				if (isset($_GET['scheduled_status']) && $_GET['scheduled_status'] === 'pending') {
					echo '<h3>'.__('Pending/upcoming/future scheduled list of push notifications','PNFPB_TD').'</h3>';
				}			
			?>		
			</div>
			<div id="poststuff">
				<div id="post-body" class="metabox-holder">
					<div id="post-body-content">
						<div class="meta-box-sortables ui-sortable">
							<form method="post">
									<?php
										if( isset( $_REQUEST ["s"]) ){
											$this->pushnotifications_obj->prepare_items( $_REQUEST ["s"]);
										}
										else 
										{
											$this->pushnotifications_obj->prepare_items();
										}
										$this->pushnotifications_obj->pnfpb_url_scheme_start();
										$this->pushnotifications_obj->search_box('Search', 'pnfpb_push_notifications_search');
										$this->pushnotifications_obj->display();
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