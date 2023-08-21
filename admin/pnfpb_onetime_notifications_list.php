	<h1 class="pnfpb_ic_push_settings_header"><?php echo __("PNFPB - Push notifications list",'PNFPB_TD');?></h1>
	<div class="pnfpb_admin_top_menu">
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb-icfcm-slug" class="tab"><?php echo __("Push Settings",'PNFPB_TD');?></a>
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_device_tokens_list" class="tab"><?php echo __("Device tokens",'PNFPB_TD');?></a>
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_pwa_app_settings" class="tab "><?php echo __("PWA",'PNFPB_TD');?></a>
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfmtest_notification" class="tab "><?php echo __("One time push",'PNFPB_TD');?></a>
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc" class="tab active"><?php echo __("Notifications",'PNFPB_TD');?></a>
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_frontend_settings" class="tab"><?php echo __("Frontend settings",'PNFPB_TD');?></a>
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_button_settings" class="tab "><?php echo __("Customize buttons",'PNFPB_TD');?></a>
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_integrate_app" class="tab "><?php echo __("Mobile app",'PNFPB_TD');?></a>
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="tab "><?php echo __("NGINX",'PNFPB_TD');?></a>
		<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_action_scheduler" class="tab "><?php echo __("Action Scheduler",'PNFPB_TD');?></a>
	</div>
	<div class="pnfpb_column_1200">
		<div class="wrap">
			<div class="pnfpb_row">
  				<div class="pnfpb_column_400">					
					<h2><?php echo __("List of one time Push notifications",'PNFPB_TD');?></h2>
					<h4><?php echo __("Edit/Resend link will redirect to one time push notification form, so that same content/modified content can be send as push notification<br/>Delete link is to delete push notification entry<br />More actions link will show details of in action scheduler page, Hovering over the entry on action scheduler will show options to Run-now or Cancel the scheduled push notification",'PNFPB_TD');?></h4>
				</div>
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