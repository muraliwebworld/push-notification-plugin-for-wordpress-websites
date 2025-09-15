<?php
/* Push notifications settings admin tabs
 * @since 2.20.0
*/
?>
<div class="nav-tab-wrapper">
	<a href="<?php echo esc_url(
     admin_url()."admin.php?page=pnfpb-push-notification-configuration-slug"); ?>" 
	   class="nav-tab tab <?php echo isset($pnfpb_tab_config_active) ? esc_attr($pnfpb_tab_config_active) : '';?>">
		<?php echo esc_html(
    		__("Configuration", "push-notification-for-post-and-buddypress")
		); ?>
	</a>	
	<a href="<?php echo esc_url(
     admin_url()."admin.php?page=pnfpb-icfcm-slug"); ?>" 
	   class="nav-tab tab <?php echo isset($pnfpb_tab_settings_active) ? esc_attr($pnfpb_tab_settings_active) : '';?>">
		<?php echo esc_html(
    		__("Options", "push-notification-for-post-and-buddypress")
		); ?>
	</a>
	<a href="<?php echo esc_url(
     	admin_url()."admin.php?page=pnfpb_icfmtest_notification"); ?>"
	   	class="nav-tab tab <?php echo isset($pnfpb_tab_sendpush_active) ? esc_attr($pnfpb_tab_sendpush_active) : '';?>">
			<?php echo esc_html(
    			__("Send push", "push-notification-for-post-and-buddypress")
			); ?>
	</a>
	<a href="<?php echo esc_url(
     	admin_url()."admin.php?page=pnfpb_icfm_delivery_notifications_list&orderby=id&order=desc"); ?>"
	   class=" nav-tab tab <?php echo isset($pnfpb_tab_adminpush_active) ? esc_attr($pnfpb_tab_adminpush_active) : '';?>">
			<?php echo esc_html(
    			__("Reports", "push-notification-for-post-and-buddypress")
			); ?>
	</a>
	<a href="<?php echo esc_url(
     	admin_url()."admin.php?page=pnfpb_icfm_pwa_app_settings"); ?>" 
		class="nav-tab tab <?php echo isset($pnfpb_tab_pwa_active) ? esc_attr($pnfpb_tab_pwa_active) : '';?>">
			<?php echo esc_html(
    			__("PWA", "push-notification-for-post-and-buddypress")
			); ?>
	</a>	
	<a href="<?php echo esc_url(
     	admin_url()."admin.php?page=pnfpb_icfm_device_tokens_list"); ?>" 
	   	class="nav-tab tab <?php echo isset($pnfpb_tab_tokens_active) ? esc_attr($pnfpb_tab_tokens_active) : '';?>">
			<?php echo esc_html(
    			__("Tokens", "push-notification-for-post-and-buddypress")
			); ?>
	</a>
	<a href="<?php echo esc_url(
     	admin_url()."admin.php?page=pnfpb_icfm_frontend_settings"); ?>"
	   class="nav-tab tab <?php echo isset($pnfpb_tab_frontend_active) ? esc_attr($pnfpb_tab_frontend_active) : '';?>">
			<?php echo esc_html(
    			__(
        			"Frontend settings",
        			"push-notification-for-post-and-buddypress"
    			)
			); ?>
	</a>
	<a href="<?php echo esc_url(
     	admin_url()."admin.php?page=pnfpb_icfm_shortcode_settings"); ?>"
	   class="nav-tab tab <?php echo isset($pnfpb_tab_shortcode_active) ? esc_attr($pnfpb_tab_shortcode_active) : '';?>">
			<?php echo esc_html(
    			__("Shortcodes", "push-notification-for-post-and-buddypress")
			); ?>
	</a>		
	<a href="<?php echo esc_url(
     	admin_url()."admin.php?page=pnfpb_icfm_button_settings"); ?>"
	   class="nav-tab tab <?php echo isset($pnfpb_tab_buttons_active) ? esc_attr($pnfpb_tab_buttons_active) : '';?>">
			<?php echo esc_html(
    			__("Buttons", "push-notification-for-post-and-buddypress")
			); ?>
	</a>
	<a href="<?php echo esc_url(
     	admin_url()."admin.php?page=pnfpb_icfm_integrate_app"); ?>" 
	   	class="nav-tab tab <?php echo isset($pnfpb_tab_mobileapp_active) ? esc_attr($pnfpb_tab_mobileapp_active) : '';?>">
			<?php echo esc_html(
    			__("Mobile app", "push-notification-for-post-and-buddypress")
			); ?>
	</a>
	<a href="<?php echo esc_url(
     admin_url()."admin.php?page=pnfpb_icfm_settings_for_ngnix_server"); ?>"
	   class="nav-tab tab <?php echo isset($pnfpb_tab_nginx_active) ? esc_attr($pnfpb_tab_nginx_active) : '';?>">
			<?php echo esc_html(
    			__("NGINX", "push-notification-for-post-and-buddypress")
			); ?>
	</a>
	<a href="<?php echo esc_url(
     	admin_url()."admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1"); ?>"
	   class="nav-tab tab <?php echo isset($pnfpb_tab_as_active) ? esc_attr($pnfpb_tab_as_active) : '';?>">
			<?php echo esc_html(
    			__("ActionScheduler", "push-notification-for-post-and-buddypress")
			); ?>
	</a>
</div>