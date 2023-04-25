<?php

if ( !class_exists( 'PNFPB_ICFM_admin_bar_menu_class' ) ) {

	class PNFPB_ICFM_admin_bar_menu_class {
		
		public function pnfpb_admin_bar_menu_register( WP_Admin_Bar $wp_admin_bar ) {
			
			$items = (array) apply_filters(
				
            	'pnfpb_icfm_admin_adminbarmenu_register',
            	[
                	'pnfpb_admin_main_menu',
                	'pnfpb_admin_push_settings_menu',
					'pnfpb_admin_send_push_notification_menu',
					'pnfpb_admin_pwa_menu'
            	],
            	$wp_admin_bar
				
        	);

        	foreach ( $items as $item ) {

            	$this->{ $item }( $wp_admin_bar );

            	do_action( "pnfpb_icfm_admin_adminbarmenu_register_{$item}_after", $wp_admin_bar );
        	}
		}
    	/**
     	* Render primary top-level admin bar menu item.
     	*
     	* @since 1.58.0
     	*
     	* @param WP_Admin_Bar $wp_admin_bar WordPress Admin Bar object.
     	*/
   		public function pnfpb_admin_main_menu( WP_Admin_Bar $wp_admin_bar ) {

        	$wp_admin_bar->add_menu(
            	[
                	'id'    => 'pnfpb-ic-fcm-main-menu',
                	'title' => esc_html__('PNFPB', 'PNFPB_TD' ) ,
                	'href'  => admin_url( 'admin.php?page=pnfpb-icfcm-slug' ),
            	]
        	);
    	}

    	/**
     	* Render Notifications admin bar menu item.
     	*
     	* @since 1.58.0
     	*
     	* @param WP_Admin_Bar $wp_admin_bar WordPress Admin Bar object.
     	*/
    	public function pnfpb_admin_push_settings_menu( WP_Admin_Bar $wp_admin_bar ) {

        	$wp_admin_bar->add_menu(
            	[
                	'parent' => 'pnfpb-ic-fcm-main-menu',
                	'id'     => 'pnfpb-ic-fcm-push-settings-menu',
                	'title'  => esc_html__( 'Push Notification settings', 'PNFPB_TD' ) ,
                	'href'   => admin_url( 'admin.php?page=pnfpb-icfcm-slug' ),
            	]
        	);
    	}
		
    	/**
     	* Render Notifications admin bar menu item.
     	*
     	* @since 1.58.0
     	*
     	* @param WP_Admin_Bar $wp_admin_bar WordPress Admin Bar object.
     	*/
    	public function pnfpb_admin_send_push_notification_menu( WP_Admin_Bar $wp_admin_bar ) {

        	$wp_admin_bar->add_menu(
            	[
                	'parent' => 'pnfpb-ic-fcm-main-menu',
                	'id'     => 'pnfpb-ic-fcm-send-push-menu',
                	'title'  => esc_html__( 'Send push notification', 'PNFPB_TD' ) ,
                	'href'   => admin_url( 'admin.php?page=pnfpb_icfmtest_notification' ),
            	]
        	);
    	}
		
    	/**
     	* Render Notifications admin bar menu item.
     	*
     	* @since 1.58.0
     	*
     	* @param WP_Admin_Bar $wp_admin_bar WordPress Admin Bar object.
     	*/
    	public function pnfpb_admin_pwa_menu( WP_Admin_Bar $wp_admin_bar ) {

        	$wp_admin_bar->add_menu(
            	[
                	'parent' => 'pnfpb-ic-fcm-main-menu',
                	'id'     => 'pnfpb-ic-fcm-pwa-menu',
                	'title'  => esc_html__( 'PWA', 'PNFPB_TD' ) ,
                	'href'   => admin_url( 'admin.php?page=pnfpb_icfm_pwa_app_settings' ),
            	]
        	);
    	}		
	}
}

?>