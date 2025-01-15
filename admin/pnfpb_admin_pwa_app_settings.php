<?php
/**
* Plugin settings area to generate Progressive Web App with offline mode facility
*
* @since 1.20
*/
?>
<h1 class="pnfpb_ic_push_settings_header"><?php echo esc_html( __("PNFPB - PWA (Progressive Web App) settings","push-notification-for-post-and-buddypress"));?></h1>
<div class="nav-tab-wrapper">
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb-icfcm-slug" class="tab nav-tab"><?php echo esc_html( __("Push Settings","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_device_tokens_list" class="nav-tab tab "><?php echo esc_html( __("Device tokens","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_pwa_app_settings" class="nav-tab nav-tab-active tab active"><?php echo esc_html( __("PWA","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfmtest_notification" class="nav-tab tab "><?php echo esc_html( __("Send push notification","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc" class="nav-tab tab"><?php echo esc_html(__("Push Notifications list","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_frontend_settings" class="nav-tab tab"><?php echo esc_html( __("Frontend subscription settings","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_button_settings" class="nav-tab tab "><?php echo esc_html(__("Customize buttons","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_integrate_app" class="nav-tab tab "><?php echo esc_html(__("Integrate Mobile app","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="nav-tab tab "><?php echo esc_html(__("NGINX","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1" class="nav-tab tab "><?php echo esc_html(__("Action Scheduler","push-notification-for-post-and-buddypress"));?></a>
</div>
<div class="pnfpb_column_1200">
	<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
	
	<?php settings_fields( 'pnfpb_icfcm_pwa'); ?>
	
    <?php do_settings_sections( 'pnfpb_icfcm_pwa' ); ?>
	
	<?php
	
		$pnfpb_ic_pwa_protocol_name_array = array();
	
		$pnfpb_ic_pwa_protocol_url_array = array();
	
		if (get_option( 'pnfpb_ic_pwa_protocol_name' )) {
			
			$pnfpb_ic_pwa_protocol_name_array = get_option( 'pnfpb_ic_pwa_protocol_name' );
			
    		if (!is_array($pnfpb_ic_pwa_protocol_name_array)) {
				
        		$pnfpb_ic_pwa_protocol_name_array = array(' ');
				
    		}			
			
		} else { 
			
			$pnfpb_ic_pwa_protocol_name_array = array(' ');
			
		}
	
		if (get_option( 'pnfpb_ic_pwa_protocol_url' )) {
			
			$pnfpb_ic_pwa_protocol_url_array = get_option( 'pnfpb_ic_pwa_protocol_url' );
			
    		if (!is_array($pnfpb_ic_pwa_protocol_url_array)) {
				
        		$pnfpb_ic_pwa_protocol_url_array = array(' ');
				
    		}			
			
		} else { 
			
			$pnfpb_ic_pwa_protocol_url_array = array(' ');
			
		}	
	
	?>
	
	<h2 class="pnfpb_ic_push_pwa_settings_header2">
		<?php echo esc_html( __("PNFPB - Progressive Web App(PWA) settings (or) Integrate with Progressier PWA","push-notification-for-post-and-buddypress"));?>
	</h2>

	<div class="nav-tab-wrapper pnfpb-pwa-category-tabs" id="pnfpb-pwa-category-tabs">
		<a class="nav-tab nav-tab-active" id="pnfpb-pwa-native-tab" href="#pnfpb-pwa-native-tab-name"><?php echo esc_html( __("PNFPB PWA settings","push-notification-for-post-and-buddypress"));?></a>
		<a class="nav-tab" id="pnfpb-pwa-thirdparty-tab" href="#pnfpb-pwa-thirdparty-tab-name"><?php echo esc_html( __("Integrate with Progressier PWA","push-notification-for-post-and-buddypress"));?></a>
	</div>
		
	<div id="pnfpb-pwa-native-tab-name" class="pnfpb-native-pwa-settings-tab pnfpb-category-pwa-settings-tab active">

		<table id="pnfpb-pwa-tabs" class="pnfpb_ic_push_settings_table widefat fixed">
    		<tbody>
				<tr class="pnfpb_ic_push_settings_table_row">
					<td>
						<ul>
							<li class="pnfpb-admin-right_sidebar"><?php echo "<b>".esc_html( __("Fields in below tabs App name, display & color, icons and screenshots are required to generate Progressive Web App (PWA)","push-notification-for-post-and-buddypress"))."</b>";?></li>
							<li><?php echo "<b>".esc_html( __("For Apple ios devices, PWA compatiable from ios 17.0 version onwards","push-notification-for-post-and-buddypress"))."</b>";?></li>			
						</ul>						
					</td>
				</tr>
				<tr class="pnfpb_ic_push_settings_table_row">
					<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
						<div class="pnfpb_row">
  							<div class="pnfpb_column">
    							<div class="pnfpb_card">				
									<label for="pnfpb_ic_pwa_app_enable"><?php echo esc_html( __("Enable/Disable PWA*","push-notification-for-post-and-buddypress"));?></label>
									<label class="pnfpb_switch">
										<input  id="pnfpb_ic_pwa_app_enable" name="pnfpb_ic_pwa_app_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_pwa_app_enable' ) ); ?>  />	
										<span class="pnfpb_slider round"></span>
									</label>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="nav-tab-wrapper pnfpb-pwa-tabs" id="pnfpb-pwa-tabs">
        	<a class="nav-tab nav-tab-active" id="pnfpb-pwa-name-tab" href="#pnfpb-pwa-name"><?php echo esc_html( __("App Name","push-notification-for-post-and-buddypress"));?></a>
        	<a class="nav-tab" id="pnfpb-pwa-display-tab" href="#pnfpb-pwa-display"><?php echo esc_html( __("Display & Color","push-notification-for-post-and-buddypress"));?></a>
       	 	<a class="nav-tab" id="pnfpb-pwa-icon-tab" href="#pnfpb-pwa-icons"><?php echo esc_html( __("Icons","push-notification-for-post-and-buddypress"));?></a>
        	<a class="nav-tab" id="pnfpb-pwa-screenshot-tab" href="#pnfpb-pwa-screenshots"><?php echo esc_html( __("Screenshots","push-notification-for-post-and-buddypress"));?></a>
			<a class="nav-tab" id="pnfpb-pwa-splashscreen-ios-tab" href="#pnfpb-pwa-splashscreen-ios"><?php echo esc_html( __("Splashscreen for ios","push-notification-for-post-and-buddypress"));?></a>			
        	<a class="nav-tab" id="pnfpb-pwa-offline-cache-tab" href="#pnfpb-pwa-cache"><?php echo esc_html( __("Cache","push-notification-for-post-and-buddypress"));?></a>
        	<a class="nav-tab" id="pnfpb-pwa-custom-prompt-tab" href="#pnfpb-pwa-custom-prompt"><?php echo esc_html( __("Custom Prompt","push-notification-for-post-and-buddypress"));?></a>
			<a class="nav-tab" id="pnfpb-pwa-protocol-handler-tab" href="#pnfpb-pwa-protocol-handler"><?php echo esc_html( __("Protocol Handler","push-notification-for-post-and-buddypress"));?></a>
			<a class="nav-tab" id="pnfpb-pwa-ios-devices-tab" href="#pnfpb-pwa-ios-devices"><?php echo esc_html( __("ios iphone/ipad","push-notification-for-post-and-buddypress"));?></a>
			<a class="nav-tab" id="pnfpb-pwa-shortcode-tab" href="#pnfpb-pwa-shortcode"><?php echo esc_html( __("Shortcode","push-notification-for-post-and-buddypress"));?></a>
    	</div>					
    	<div id="pnfpb-pwa-name" class="pnfpb-pwa-settings-tab active">
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb_ic_pwa_app_name">
					<?php echo wp_kses_post( __("PWA (web App) name*<br/> (max 50 characters)","push-notification-for-post-and-buddypress"));?>
				</label>
				<br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_app_name" name="pnfpb_ic_pwa_app_name" type="text" maxlength="50" value="<?php if (get_option( 'pnfpb_ic_pwa_app_name' )) {echo esc_html(get_option( 'pnfpb_ic_pwa_app_name' ));} else { echo esc_html(substr(get_bloginfo( 'name' ),0,50));} ?>" required="required" />					
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb_ic_pwa_app_shortname">
					<?php echo wp_kses_post( __("PWA short name*<br/> (max 25 characters)","push-notification-for-post-and-buddypress"));?>
				</label>
				<br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_app_shortname" name="pnfpb_ic_pwa_app_shortname" type="text" maxlength="25" value="<?php if (get_option( 'pnfpb_ic_pwa_app_shortname' )) {echo esc_html(get_option( 'pnfpb_ic_pwa_app_shortname' ));} else { echo esc_html(substr(get_bloginfo( 'name' ),0,25));} ?>" required="required" />					
			</div>
		</div>
    	<div id="pnfpb-pwa-display" class="pnfpb-pwa-settings-tab">
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb_ic_pwa_theme_color">
					<?php echo esc_html( __("PWA theme color*","push-notification-for-post-and-buddypress"));?>
				</label>
				<br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_push_pwa_color" id="pnfpb_ic_pwa_theme_color" name="pnfpb_ic_pwa_theme_color" type="color" value="<?php if (get_option( 'pnfpb_ic_pwa_theme_color' )) {echo esc_html(get_option( 'pnfpb_ic_pwa_theme_color' )); } else { echo '#161515';}?>" required="required" />					
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb_ic_pwa_app_backgroundcolor">
					<?php echo esc_html( __("PWA background color*","push-notification-for-post-and-buddypress"));?>
				</label>
				<br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_push_pwa_color" id="pnfpb_ic_pwa_app_backgroundcolor" name="pnfpb_ic_pwa_app_backgroundcolor" type="color" value="<?php if (get_option( 'pnfpb_ic_pwa_app_backgroundcolor' )) {echo esc_html(get_option( 'pnfpb_ic_pwa_app_backgroundcolor' ));} else { echo '#ffffff';}?>" required="required" />					
			</div>
    		<div class="pnfpb_ic_push_settings_table_row">				
        		<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
					<label for="pnfpb_ic_pwa_app_display">
						<?php echo wp_kses_post( __("PWA display format*","push-notification-for-post-and-buddypress"));?>
					</label>
					<br/>
					<select name="pnfpb_ic_pwa_app_display" id="pnfpb_ic_pwa_app_display" required="required">
						<option value="standalone" <?php if (get_option( 'pnfpb_ic_pwa_app_display' ) === 'standalone'){ echo 'selected';} else {echo '';} ?>><?php echo esc_html( __("standalone","push-notification-for-post-and-buddypress"));?></option>
						<option value="fullscreen" <?php if (get_option( 'pnfpb_ic_pwa_app_display' ) === 'fullscreen'){ echo 'selected';} else {echo '';} ?>><?php echo esc_html( __("fullscreen","push-notification-for-post-and-buddypress"));?></option>
						<option value="minimal-ui" <?php if (get_option( 'pnfpb_ic_pwa_app_display' ) === 'minimal-ui'){ echo 'selected';} else {echo '';} ?>><?php echo esc_html( __("minimal-ui","push-notification-for-post-and-buddypress"));?></option>
					</select>					
				</div>
			</div>
		</div>
		<div id="pnfpb-pwa-icons" class="pnfpb-pwa-settings-tab">
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<?php 
					echo wp_kses_post( __( 'PWA icon size must be exactly as specified below for icon1 and icon2(132x132 and 512x512) otherwise it will use default plugin icons', "push-notification-for-post-and-buddypress" )); 
								?>
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<div class="">
            		<table>
						<tr>
                			<td class="column-columnname">
								<label for="pnfpb_ic_fcm_pwa_upload_icon_132">
									<?php echo wp_kses_post( __("PWA Icon-1*<br/>( Must be 132x132 pixels)","push-notification-for-post-and-buddypress"));?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo esc_html( __("Add PWA Icon","push-notification-for-post-and-buddypress"));?>" id="pnfpb_ic_fcm_pwa_upload_button_132" class="pnfpb_ic_push_pwa_settings_upload_icon" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_icon_132" name="pnfpb_ic_fcm_pwa_upload_icon_132" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_icon_132' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_icon_132' ));} else { echo esc_url(plugin_dir_url( __DIR__ ).'public/img/icon_132.png');} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_preview_132" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_icon_132' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_icon_132' ));} else { echo esc_url(plugin_dir_url( __DIR__).'public/img/icon_132.png');} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
					</table>
				</div>
				<div class="">
            		<table>
						<tr>
                			<td class="column-columnname">
								<label for="pnfpb_ic_fcm_pwa_upload_icon_512">
									<?php echo wp_kses_post( __(" PWA Icon-2*<br/>( Must be 512x512 pixels)","push-notification-for-post-and-buddypress"));?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">												
                    			<input type="button" value="<?php echo esc_html( __("Add PWA Icon","push-notification-for-post-and-buddypress"));?>" id="pnfpb_ic_fcm_pwa_upload_button_512" class="pnfpb_ic_push_pwa_settings_upload_icon" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_icon_512" name="pnfpb_ic_fcm_pwa_upload_icon_512" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_icon_512' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_icon_512' ));} else { echo esc_url(plugin_dir_url( __DIR__ ).'public/img/icon.png');} ?>" />
                			</td>
						</tr>
						<tr>
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_preview_512" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_icon_512' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_icon_512' ));} else { echo esc_url(plugin_dir_url( __DIR__ ).'public/img/icon.png');} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
					</table>
				</div>
			</div>
  		</div>
		<div id="pnfpb-pwa-screenshots" class="pnfpb-pwa-settings-tab">
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<?php 
					echo esc_html( __( 'Upload Screenshot of Desktop version of site and Screenshot of Mobile version of site. Screenshots are mandatory for PWA', "push-notification-for-post-and-buddypress" )); 
				?>
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<div>
            		<table class="pnfpb_pwa_table">
						<tr>
                			<td class="column-columnname">
								<label for="pnfpb_ic_fcm_pwa_upload_screenshot_desktop">
									<?php echo wp_kses_post( __("PWA Desktop Screenshot*<br/>( Wide screenshot - Desktop version of site 1280x780 px)","push-notification-for-post-and-buddypress"));?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo esc_html( __("Upload screenshot of Desktop version of site","push-notification-for-post-and-buddypress"));?>" id="pnfpb_ic_fcm_pwa_upload_screenshot_desktop" class="pnfpb_ic_fcm_pwa_upload_screenshot_desktop" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value" name="pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value' ));} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value' ));} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
						<tr>
							<td  class="column-columnname">
        						<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
									<label for="pnfpb_ic_fcm_pwa_upload_screenshot_desktop_label">
										<?php echo esc_html( __("Label for desktop screenshot","push-notification-for-post-and-buddypress"));?>
									</label>
									<br/>
									<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_pwa_upload_screenshot_desktop_label" name="pnfpb_ic_fcm_pwa_upload_screenshot_desktop_label" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_desktop_label' )) {echo esc_html(get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_desktop_label' ));} else { echo "Homescreen of Awesome App";} ?>" required="required" />					
								</div>
							</td>
						</tr>									
					</table>
				</div>
				<div>
            		<table class="pnfpb_pwa_table">
						<tr>
                			<td class="column-columnname">
								<label for="pnfpb_ic_fcm_pwa_upload_screenshot_mobile">
									<?php echo wp_kses_post( __("PWA Mobile Screenshot*<br/>( Narrow format screenshot - mobile version of site)","push-notification-for-post-and-buddypress"));?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo esc_html( __("Upload screenshot of Mobile version of site","push-notification-for-post-and-buddypress"));?>" id="pnfpb_ic_fcm_pwa_upload_screenshot_mobile" class="pnfpb_ic_fcm_pwa_upload_screenshot_mobile" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value" name="pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value' ));} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value' ));} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
						<tr>
							<td  class="column-columnname">
        						<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
									<label for="pnfpb_ic_fcm_pwa_upload_screenshot_mobile_label">
										<?php echo esc_html( __("Label for mobile screenshot","push-notification-for-post-and-buddypress"));?>
									</label>
									<br/>
									<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_pwa_upload_screenshot_mobile_label" name="pnfpb_ic_fcm_pwa_upload_screenshot_mobile_label" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_mobile_label' )) {echo esc_html(get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_mobile_label' ));} else { echo "List of Awesome Resources available in Awesome App";} ?>" required="required" />					
								</div>
							</td>
						</tr>									
					</table>
				</div>
			</div>
		</div>
		<div id="pnfpb-pwa-splashscreen-ios" class="pnfpb-pwa-settings-tab">
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<?php 
					echo esc_html( __( 'Splash screen for Apple macos,ios devices', "push-notification-for-post-and-buddypress" )); 
				?>
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<div>
            		<table class="pnfpb_pwa_table">
						<tr>
                			<td class="column-columnname">
								<label for="pnfpb_ic_fcm_pwa_upload_screenshot_desktop">
									<?php echo esc_html( __("Splash screen icon for devices with 640x1136px","push-notification-for-post-and-buddypress"));?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo esc_html( __("Upload Splash screen icon in size 640x1136px","push-notification-for-post-and-buddypress"));?>" id="pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136" class="pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value" name="pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value' ));} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value' ));} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
					</table>
				</div>
				<div>
            		<table class="pnfpb_pwa_table">
						<tr>
                			<td class="column-columnname">
								<label for="pnfpb_ic_fcm_pwa_upload_screenshot_desktop">
									<?php echo esc_html( __("Splash screen icon in size 750x1294px","push-notification-for-post-and-buddypress"));?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo esc_html( __("Upload Splash screen icon in size 640x1136px","push-notification-for-post-and-buddypress"));?>" id="pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294" class="pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value" name="pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value' ));} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value' ));} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
					</table>
				</div>
				<div>
            		<table class="pnfpb_pwa_table">
						<tr>
                			<td class="column-columnname">
								<label for="pnfpb_ic_fcm_pwa_upload_screenshot_desktop">
									<?php echo esc_html( __("Splash screen icon in size 1242x2148px","push-notification-for-post-and-buddypress"));?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo esc_html( __("Upload Splash screen icon in size 1242x2148px","push-notification-for-post-and-buddypress"));?>" id="pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148" class="pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2146_value" name="pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value' ));} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value' ));} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
					</table>
				</div>
				<div>
            		<table class="pnfpb_pwa_table">
						<tr>
                			<td class="column-columnname">
								<label for="pnfpb_ic_fcm_pwa_upload_screenshot_desktop">
									<?php echo esc_html( __("Splash screen icon in size 1125x2436px","push-notification-for-post-and-buddypress"));?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo esc_html( __("Upload Splash screen icon in size 1125x2436px","push-notification-for-post-and-buddypress"));?>" id="pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436" class="pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_value" name="pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_value" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_value' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_value' ));} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_value_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_desktop_value' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_desktop_value' ));} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
					</table>
				</div>
				<div>
            		<table class="pnfpb_pwa_table">
						<tr>
                			<td class="column-columnname">
								<label for="pnfpb_ic_fcm_pwa_upload_screenshot_desktop">
									<?php echo esc_html( __("Splash screen icon in size 1536x2048px","push-notification-for-post-and-buddypress"));?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo esc_html( __("Upload Splash screen icon in size 1536x2048px","push-notification-for-post-and-buddypress"));?>" id="pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048" class="pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_value" name="pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_value" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_value' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_value' ));} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_value_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_desktop_value' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_desktop_value' ));} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
					</table>
				</div>
				<div>
            		<table class="pnfpb_pwa_table">
						<tr>
                			<td class="column-columnname">
								<label for="pnfpb_ic_fcm_pwa_upload_screenshot_desktop">
									<?php echo esc_html( __("Splash screen icon in size 1668x2224px","push-notification-for-post-and-buddypress"));?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo esc_html( __("Upload Splash screen icon in size 1668x2224px","push-notification-for-post-and-buddypress"));?>" id="pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224" class="pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_value" name="pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_value" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_value' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_value' ));} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_value_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_desktop_value' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_desktop_value' ));} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
					</table>
				</div>
				<div>
            		<table class="pnfpb_pwa_table">
						<tr>
                			<td class="column-columnname">
								<label for="pnfpb_ic_fcm_pwa_upload_screenshot_desktop">
									<?php echo esc_html( __("Splash screen icon in size 2048x2732px","push-notification-for-post-and-buddypress"));?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo esc_html( __("Upload Splash screen icon in size 2048x2732px","push-notification-for-post-and-buddypress"));?>" id="pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732" class="pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_value" name="pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_value" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_value' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_value' ));} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_value_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_desktop_value' )) {echo esc_url(get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_desktop_value' ));} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
					</table>
				</div>				
			</div>
		</div>		
		<div id="pnfpb-pwa-cache" class="pnfpb-pwa-settings-tab">
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<?php
					echo '<b>'.wp_kses_post( __( 'Below options are for offline facility for PWA - web app', "push-notification-for-post-and-buddypress" )).'</b><br/><b>'.esc_html( __( 'Home page url to be cached for offline use(*required)', "push-notification-for-post-and-buddypress" )).'</b>';
					?>	
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<br/>
				<select  id="pnfpb_ic_pwa_app_offline_url1" name="pnfpb_ic_pwa_app_offline_url1" required="required">
					<?php
						$homeurlselected = '';
						if (get_option( 'pnfpb_ic_pwa_app_offline_url1' ) === get_home_url()){ 
							$homeurlselected = 'selected';
						}				
						if( $pages = get_pages() ){
							echo '<option value="' . esc_url(get_home_url()) . '"'.esc_url($homeurlselected).'>'.esc_html( __('Home page', "push-notification-for-post-and-buddypress" )).'</option>';	        		
							foreach( $pages as $page ){
								echo '<option value="' . esc_url(get_page_link( $page->ID )) . '" ' . selected( esc_url(get_page_link( $page->ID )), get_option( 'pnfpb_ic_pwa_app_offline_url1' ) ) . '>' . esc_html($page->post_title) . '</option>';						
       						}
    					}
					?>
				</select>
			</div>
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<?php
					echo esc_html( __('Default url for offline if page is not available in cache(*required)', "push-notification-for-post-and-buddypress" ));
				?>
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<select id="pnfpb_ic_pwa_app_offline_url2" name="pnfpb_ic_pwa_app_offline_url2" required="required">
					<?php
					$homeurlselected = '';
					if (get_option( 'pnfpb_ic_pwa_app_offline_url2' ) === get_home_url()){ 
						$homeurlselected = 'selected';
					}				
					if( $pages = get_pages() ){
						echo '<option value="' . esc_url(get_home_url()) . '"'.esc_html($homeurlselected).'>'.esc_html( __('Home page', "push-notification-for-post-and-buddypress" )).'</option>';	        		
						foreach( $pages as $page ){
						echo '<option value="' . esc_url(get_page_link( $page->ID )) . '" ' . selected( esc_url(get_page_link( $page->ID )), get_option( 'pnfpb_ic_pwa_app_offline_url2' ) ) . '>' . esc_html($page->post_title) . '</option>';						
       					}
    				}
					?>
				</select>					
			</div>
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<b>
				<?php
					echo esc_html( __('Other extra pages to be cached for offline use/to be stored in cache(Optional)', "push-notification-for-post-and-buddypress" ));
				?>
				</b>
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb_ic_pwa_app_offline_url3">
					<?php echo esc_html( __("website page url to be cached for offline","push-notification-for-post-and-buddypress"));?>
				</label>
				<br/>
				<select id="pnfpb_ic_pwa_app_offline_url3" name="pnfpb_ic_pwa_app_offline_url3" >
					<?php
						if( $pages = get_pages() ){
							echo '<option value="">Select page</option>';	        							
							foreach( $pages as $page ){
								echo '<option value="' . esc_url(get_page_link( $page->ID )) . '" ' . selected(esc_url(get_page_link( $page->ID )), get_option( 'pnfpb_ic_pwa_app_offline_url3' ) ) . '>' . esc_html($page->post_title) . '</option>';						
       						}
    					}
					?>
				</select>	
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb_ic_pwa_app_offline_url4">
					<?php echo esc_html( __("website page url to be cached for offline","push-notification-for-post-and-buddypress"));?>
				</label>
				<br/>
				<select id="pnfpb_ic_pwa_app_offline_url4" name="pnfpb_ic_pwa_app_offline_url4" >
					<?php
					if( $pages = get_pages() ){
							echo '<option value="">Select page</option>';        		
							foreach( $pages as $page ){
								echo '<option value="' . esc_url(get_page_link( $page->ID )) . '" ' . selected( esc_url(get_page_link( $page->ID )), get_option( 'pnfpb_ic_pwa_app_offline_url4' ) ) . '>' . esc_html($page->post_title) . '</option>';						
       						}
    					}
					?>
				</select>					
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb_ic_pwa_app_offline_url5">
					<?php echo esc_html( __("website page url to be cached for offline","push-notification-for-post-and-buddypress"));?>
				</label>
				<br/>
				<select id="pnfpb_ic_pwa_app_offline_url5" name="pnfpb_ic_pwa_app_offline_url5" >
					<?php
						if( $pages = get_pages() ){
							echo '<option value="">Select page</option>';       		
							foreach( $pages as $page ){
								echo '<option value="' . esc_url(get_page_link( $page->ID )) . '" ' . selected( esc_url(get_page_link( $page->ID )), get_option( 'pnfpb_ic_pwa_app_offline_url5' ) ) . '>' . esc_html($page->post_title) . '</option>';						
       						}
    					}
					?>
				</select>					
			</div>
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<b>
				<?php
					echo esc_html( __('List of urls to be excluded from offline cache separted by comma. Please note that enter list of urls to be excluded separated with comma', "push-notification-for-post-and-buddypress" ));
				?>
				</b>
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
  				<div class="pnfpb_row">
					<div class="">
    					<div class="pnfpb_pwa_card">						
							<label class="pnfpb_ic_push_settings_table_label_checkbox">
								<?php echo esc_html( __("Exclude all Urls from PWA offline cache","push-notification-for-post-and-buddypress"));?>
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_pwa_app_excludeallurls" name="pnfpb_ic_pwa_app_excludeallurls" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_pwa_app_excludeallurls' ) ); ?>  />
									<span class="pnfpb_slider round"></span>
								</label>
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<b>
				<?php
					echo esc_html( __('List of urls to be excluded from offline cache separted by comma. Please note that enter list of urls to be excluded separated with comma', "push-notification-for-post-and-buddypress" ));
				?>
				</b>
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb_ic_pwa_app_excludeurls">			
					<?php echo esc_html( __("List of urls to be excluded from cache separated by comma","push-notification-for-post-and-buddypress"));?>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_app_excludeurls" name="pnfpb_ic_pwa_app_excludeurls" type="text" value="<?php if (get_option( 'pnfpb_ic_pwa_app_excludeurls' )) {echo esc_url(get_option( 'pnfpb_ic_pwa_app_excludeurls' ));}?>" />
				</label>
			</div>
		</div>
		<div id="pnfpb-pwa-custom-prompt" class="pnfpb-pwa-settings-tab">
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
    			<div class="pnfpb_pwa_card">
					<label for="pnfpb_ic_pwa_app_custom_prompt_enable" class="pnfpb_ic_push_pwa_custom_prompt_divider">
						<?php echo esc_html( __("Custom prompt for all devices","push-notification-for-post-and-buddypress"));?>
					</label>								
					<label class="pnfpb_switch">
						<input  id="pnfpb_ic_pwa_app_custom_prompt_enable" name="pnfpb_ic_pwa_app_custom_prompt_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_pwa_app_custom_prompt_enable' ) ); ?>  />
							<span class="pnfpb_slider round"></span>
					</label>
				</div>
			</div>
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<div class="pnfpb_pwa_card">
					<label class="pnfpb_ic_push_pwa_custom_prompt_divider">
						<?php echo esc_html( __("If cancelled, show custom prompt after number of days","push-notification-for-post-and-buddypress"));?>
					</label>
					<label>
						<input  class="pnfpb_ic_fcm_pwa_show_again_days" id="pnfpb_ic_fcm_pwa_show_again_days" name="pnfpb_ic_fcm_pwa_show_again_days" type="number" value="<?php if(get_option( 'pnfpb_ic_fcm_pwa_show_again_days' )) {echo esc_html(get_option( 'pnfpb_ic_fcm_pwa_show_again_days' ));} else { echo "7";} ?>"/>
					</label>
				</div>
			</div>
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<div class="pnfpb_pwa_card">
					<label class="pnfpb_ic_push_pwa_custom_prompt_divider">
						<?php echo esc_html( __("Only for desktop devices","push-notification-for-post-and-buddypress"));?>
					</label>							
					<label class="pnfpb_switch">
						<input  id="pnfpb_ic_pwa_app_desktop_custom_prompt_enable" name="pnfpb_ic_pwa_app_desktop_custom_prompt_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_pwa_app_desktop_custom_prompt_enable' ) ); ?>  />
						<span class="pnfpb_slider round"></span>
					</label>
				</div>
			</div>
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
   				<div class="pnfpb_pwa_card">
					<label class="pnfpb_ic_push_pwa_custom_prompt_divider">
						<?php echo esc_html( __("Only for mobile/tablet devices","push-notification-for-post-and-buddypress"));?>
					</label>							
					<label class="pnfpb_switch">
						<input  id="pnfpb_ic_pwa_app_mobile_custom_prompt_enable" name="pnfpb_ic_pwa_app_mobile_custom_prompt_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_pwa_app_mobile_custom_prompt_enable' ) ); ?>  />
						<span class="pnfpb_slider round"></span>
					</label>
				</div>
			</div>
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
   				<div class="pnfpb_pwa_card">
					<label class="pnfpb_ic_push_pwa_custom_prompt_divider">
						<?php echo esc_html( __("Devices greater than pixels","push-notification-for-post-and-buddypress"));?>
					</label>								
					<label class="pnfpb_switch">
						<input  id="pnfpb_ic_pwa_app_pixels_custom_prompt_enable" name="pnfpb_ic_pwa_app_pixels_custom_prompt_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_pwa_app_pixels_custom_prompt_enable' ) ); ?>  />
						<span class="pnfpb_slider round"></span>									
					</label>
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable" id="pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable" name="pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable" type="number" value="<?php if(get_option( 'pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable' )) {echo esc_html(get_option( 'pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable' ));} ?>"  /> 
					<label><?php echo esc_html( __(" (in pixels)","push-notification-for-post-and-buddypress"));?> </label>								
				</div>							
			</div>
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_pwa_prompt_text"><?php echo esc_html( __("Customize PWA install prompt","push-notification-for-post-and-buddypress"));?></label><br/><br/>						
				<label for="pnfpb_ic_fcm_pwa_prompt_text"><?php echo esc_html( __("Custom text to for PWA custom prompt","push-notification-for-post-and-buddypress"));?></label><br/>
				<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_pwa_prompt_text" name="pnfpb_ic_fcm_pwa_prompt_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_pwa_prompt_text' )) {echo esc_html(get_option( 'pnfpb_ic_fcm_pwa_prompt_text' ));} else { echo esc_html( __("Would like to install our app?","push-notification-for-post-and-buddypress"));} ?>"  />					
				<br/><br /><label><?php echo esc_html( __("PWA custom install prompt confirmation button text","push-notification-for-post-and-buddypress"));?></label><br/>	
				<input  class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_push_pwa_custom_prompt_divider" id="pnfpb_ic_fcm_pwa_prompt_confirm_button" name="pnfpb_ic_fcm_pwa_prompt_confirm_button" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_pwa_prompt_confirm_button' )) {echo esc_html(get_option( 'pnfpb_ic_fcm_pwa_prompt_confirm_button' ));} else { echo esc_html( __("Install","push-notification-for-post-and-buddypress"));} ?>"  />
				<br/><br /><label><?php echo esc_html( __("PWA custom install prompt cancel button text","push-notification-for-post-and-buddypress"));?></label><br/>	
				<input  class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_push_pwa_custom_prompt_divider" id="pnfpb_ic_fcm_pwa_prompt_cancel_button" name="pnfpb_ic_fcm_pwa_prompt_cancel_button" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_pwa_prompt_cancel_button' )) {echo esc_html(get_option( 'pnfpb_ic_fcm_pwa_prompt_cancel_button' ));} else { echo esc_html( __("Cancel","push-notification-for-post-and-buddypress"));} ?>"  />
				<br /><br/><label><?php echo esc_html( __("PWA custom install prompt Button background color","push-notification-for-post-and-buddypress"));?></label><br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_pwa_prompt_button_background pnfpb_ic_push_pwa_custom_prompt_divider" id="pnfpb_ic_fcm_pwa_prompt_button_background" name="pnfpb_ic_fcm_pwa_prompt_button_background" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_prompt_button_background' )) {echo esc_html(get_option( 'pnfpb_ic_fcm_pwa_prompt_button_background' )); } else { echo '#ffffff';}?>" required="required" />					
				<br /><br/><label><?php echo esc_html( __("PWA custom install prompt dialog box background color","push-notification-for-post-and-buddypress"));?></label><br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_pwa_prompt_dialog_background pnfpb_ic_push_pwa_custom_prompt_divider" id="pnfpb_ic_fcm_pwa_prompt_dialog_background" name="pnfpb_ic_fcm_pwa_prompt_dialog_background" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_prompt_dialog_background' )) {echo esc_html(get_option( 'pnfpb_ic_fcm_pwa_prompt_dialog_background' )); } else { echo '#ffffff';}?>" required="required" />					
				<br /><br/><label><?php echo esc_html( __("PWA custom install prompt dialog Text color","push-notification-for-post-and-buddypress"));?></label><br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_pwa_prompt_text_color pnfpb_ic_push_pwa_custom_prompt_divider" id="pnfpb_ic_fcm_pwa_prompt_text_color" name="pnfpb_ic_fcm_pwa_prompt_text_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_prompt_text_color' )) {echo esc_html(get_option( 'pnfpb_ic_fcm_pwa_prompt_text_color' )); } else { echo '#161515';}?>" required="required" />
				<br /><br/><label><?php echo esc_html( __("PWA custom install prompt button Text color","push-notification-for-post-and-buddypress"));?></label><br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_pwa_prompt_button_text_color pnfpb_ic_push_pwa_custom_prompt_divider" id="pnfpb_ic_fcm_pwa_prompt_button_text_color" name="pnfpb_ic_fcm_pwa_prompt_button_text_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_prompt_button_text_color' )) {echo esc_html(get_option( 'pnfpb_ic_fcm_pwa_prompt_button_text_color' )); } else { echo '#161515';}?>" required="required" />
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb-pwa-dialog-app-installed_text">
					<?php echo esc_html( __("PWA after installed confirmation popup header text","push-notification-for-post-and-buddypress"));?>
				</label>
				<br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb-pwa-dialog-app-installed_text" name="pnfpb-pwa-dialog-app-installed_text" type="text" maxlength="100" value="<?php if (get_option( 'pnfpb-pwa-dialog-app-installed_text' )) {echo esc_html(get_option( 'pnfpb-pwa-dialog-app-installed_text' ));} else { echo esc_html( __("App installed successfully","push-notification-for-post-and-buddypress"));} ?>" />					
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb-pwa-dialog-app-installed_text">
					<?php echo esc_html( __("PWA after installed confirmation popup description","push-notification-for-post-and-buddypress"));?>
				</label>
				<br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb-pwa-dialog-app-installed_description" name="pnfpb-pwa-dialog-app-installed_description" type="text" maxlength="500" value="<?php if (get_option( 'pnfpb-pwa-dialog-app-installed_description' )) {echo esc_html(get_option( 'pnfpb-pwa-dialog-app-installed_description' ));} else { echo esc_html( __("Progressive Web App (PWA) is installed successfully. It will also work in offline","push-notification-for-post-and-buddypress"));} ?>" />					
			</div>
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<b>
				<?php
					echo esc_html( __("All fields marked with '*' are required fields, Please verify before submitting the changes","push-notification-for-post-and-buddypress"));
				?>
				</b>
			</div>
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<b>
				<?php
					echo esc_html( __("Progressive Web Apps are supported by Chrome(Desktop,Mobile) browser, Edge browser, Firefox for android, Opera for android,Edge for Android, Brave for Android and Samsung Interent except Firefox for desktop","push-notification-for-post-and-buddypress"));
				?>
				</b>
			</div>
		</div>
    	<div id="pnfpb-pwa-protocol-handler" class="pnfpb-pwa-settings-tab">
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb_ic_pwa_protocol-name">
					<?php echo "<b>".esc_html( __("List of Protocol handlers","push-notification-for-post-and-buddypress"))."</b><br/>";?>
					<a href="https://developer.mozilla.org/en-US/docs/Web/Manifest/protocol_handlers" target="_blank">Help on Protocol Handler</a>
				</label>
			</div>
			<div class="pnfpb_ic_pwa_protocol-handler-list pnfpb_ic_push_pwa_settings_table_value_column column-columnname">				
				<?php
				
					$pnfpb_pwa_protocol_count = 0;
				
					foreach ( $pnfpb_ic_pwa_protocol_name_array as $pnfpb_ic_pwa_protocol_name_element ) {
						
				?>
       			<div class="pnfpb_ic_pwa_protocol">
					<label class="pnfpb_ic_pwa_protocol-handler-element" for="pnfpb_ic_pwa_protocol-name">
						<?php echo "<b>".esc_html( __("Protocol handler ","push-notification-for-post-and-buddypress"))."<span>".esc_html(strval($pnfpb_pwa_protocol_count+1))."</span></b>";?>
					</label>
					<input type="button" name="pnfpb_ic_push_remove_protocol_button" id="pnfpb_ic_push_remove_protocol_button" class="button pnfpb_ic_push_remove_protocol_button" value="<?php echo esc_html( __("Delete","push-notification-for-post-and-buddypress")); ?>">							
        			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname pnfpb_pwa_card_protocol_root">
						<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname pnfpb_pwa_card_protocol_child">
							<label for="pnfpb_ic_pwa_protocol-name">
								<?php echo esc_html( __("Protocol","push-notification-for-post-and-buddypress"));?>
							</label>
							<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_protocol_name_<?php echo esc_html($pnfpb_pwa_protocol_count+1); ?>" name="pnfpb_ic_pwa_protocol_name[]" type="text" placeholder="web+jnglstore" value="<?php if (trim($pnfpb_ic_pwa_protocol_name_array[$pnfpb_pwa_protocol_count]) != '') {echo esc_html($pnfpb_ic_pwa_protocol_name_array[$pnfpb_pwa_protocol_count]);} ?>" />
						</div>
						<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname pnfpb_pwa_card_protocol_child">
							<label for="pnfpb_ic_pwa_protocol-url">
								<?php echo esc_html( __("Url","push-notification-for-post-and-buddypress"));?>
							</label>
							<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_protocol_url_<?php echo esc_html($pnfpb_pwa_protocol_count+1); ?>" name="pnfpb_ic_pwa_protocol_url[]" type="text" placeholder="/shop?for=%s" value="<?php if (trim($pnfpb_ic_pwa_protocol_url_array[$pnfpb_pwa_protocol_count]) != '') {echo esc_html($pnfpb_ic_pwa_protocol_url_array[$pnfpb_pwa_protocol_count]);} ?>" />
						</div>
					</div>
				</div>
				<?php
						
					$pnfpb_pwa_protocol_count++;
						
					}
				?>
			</div>
			<div class="pnfpb_ic_push_add_protocol_button_divider">
				<input type="button" name="pnfpb_ic_push_add_protocol_button" id="pnfpb_ic_push_add_protocol_button" class="button pnfpb_ic_push_add_protocol_button" value="Add protocol">
			</div>				
		</div>
		<div id="pnfpb-pwa-ios-devices" class="pnfpb-pwa-settings-tab">
			<ul>
				<li><?php echo "<b>".esc_html( __("Installation instructions for Apple devices iphone/ipad/macos","push-notification-for-post-and-buddypress"))."</b>";?></li>
				<li><?php echo esc_html( __("In phone/ipad browser, click on share icon in browser","push-notification-for-post-and-buddypress"));?></li>
				<li><?php echo esc_html( __("Select add to home screen in ios devices or add to dock in macos","push-notification-for-post-and-buddypress"));?></li>
				<li><?php echo esc_html( __("Same above instruction will be shown to frontend ios iphone/ipad device users using PWA custom prompt (when it is turned on) or when shortcode button is clicked by frontend ios device users","push-notification-for-post-and-buddypress"));?></li>
				<li><?php echo esc_html( __("For ios devices(iphone/ipad), Push notification will work only thorugh PWA","push-notification-for-post-and-buddypress"));?></li>
				<li><?php echo esc_html( __("For other devices macos,android,windows desktop, push notification will work normally","push-notification-for-post-and-buddypress"));?></li>
				<li><?php echo "<b>".esc_html( __("Shortcode [PNFPB_PWA_PROMPT] is available for PWA. When it is clicked on for ios devices, it will show above instruction. For other devices it will install PWA normally","push-notification-for-post-and-buddypress"))."</b>";?></li>					
			</ul>
			<div>
				<label for="pnfpb-pwa-ios-message">
					<?php echo esc_html( __("Customize PWA installation instruction for ios device users","push-notification-for-post-and-buddypress"));?>
				</label>				
				<textarea class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb-pwa-ios-message" name="pnfpb-pwa-ios-message" type="text"  rows="3"><?php if (get_option( 'pnfpb-pwa-ios-message' )) {echo esc_html(get_option( 'pnfpb-pwa-ios-message' ));} else { echo esc_html( __("Install our app using add to home screen in browser. In phone/ipad browser, click on share icon in browser and select add to home screen in ios devices or add to dock in macos ","push-notification-for-post-and-buddypress"));} ?></textarea>						
			</div>
			<ul>
				<li><a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_button_settings#pwa-install-shortcode-customize-section"><?php echo esc_html( __("Customize PWA install shortcode button","push-notification-for-post-and-buddypress"));?></a></li>
			</ul>			
		</div>
		<div id="pnfpb-pwa-shortcode" class="pnfpb-pwa-settings-tab">
			<ul>
				<li><?php echo "<b>".esc_html( __("Shortcode [PNFPB_PWA_PROMPT] is available to display PWA install button","push-notification-for-post-and-buddypress"))."</b>";?></li>
				<li><?php echo esc_html( __("If install button is clicked then it will display prompt to install Progressive Web App(PWA)","push-notification-for-post-and-buddypress"));?></li>
				<li><?php echo esc_html( __("Once it is installed then PWA shortcode install button will not appear","push-notification-for-post-and-buddypress"));?></li>
				<li><?php echo esc_html( __("PWA Shortcode install button will appear only when PWA is not installed","push-notification-for-post-and-buddypress"));?></li>
				<li><?php echo esc_html( __("Customization options are available under customization tab","push-notification-for-post-and-buddypress"));?></li>
				<li><a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_button_settings#pwa-install-shortcode-customize-section"><?php echo esc_html( __("Customize PWA install shortcode button","push-notification-for-post-and-buddypress"));?></a></li>
			</ul>
		</div>		
	</div>
	<div id="pnfpb-pwa-thirdparty-tab-name" class="pnfpb-thirdparty-pwa-settings-tab pnfpb-category-pwa-settings-tab">
		<div id="pnfpb-thirdparty-pwa-tabs" class="pnfpb_ic_push_settings_table widefat fixed">
			<div class="pnfpb_row">
  				<div class="pnfpb_column">
    				<div class="pnfpb_card">				
						<label for="pnfpb_ic_thirdparty_pwa_app_enable"><?php echo esc_html( __("Enable/Disable Progressier PWA","push-notification-for-post-and-buddypress"));?></label>
						<label class="pnfpb_switch">
							<input  id="pnfpb_ic_thirdparty_pwa_app_enable" name="pnfpb_ic_thirdparty_pwa_app_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_thirdparty_pwa_app_enable' ) ); ?>  />	
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
				</div>
			</div>
		</div>
        <div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
			<label for="pnfpb_ic_pwa_thirdparty_app_id">
				<?php echo wp_kses_post( __("Enter Progressier app id <br/>(only app id, do not enter url)","push-notification-for-post-and-buddypress"));?>
			</label>
			<br/>
			<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_thirdparty_app_id" name="pnfpb_ic_pwa_thirdparty_app_id" type="text" maxlength="50" value="<?php if (get_option( 'pnfpb_ic_pwa_thirdparty_app_id' )) {echo esc_html(get_option( 'pnfpb_ic_pwa_thirdparty_app_id' ));} else { echo esc_html(get_option( 'pnfpb_ic_pwa_thirdparty_app_id' ));} ?>" />
			<br/><br/>
			<label for="pnfpb_ic_pwa_thirdparty_app_id">
				<?php echo wp_kses_post( __("(usually as second qualifier before filename) <br/>(example like https://progressier.app/appid/progressier.json, in this url, app id is in second qualifier)<br/>(or) go to settings in progressier dashboard->select lastmenu->app id","push-notification-for-post-and-buddypress"));?>
			</label>			
		</div>
	</div>
	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
		<div class="pnfpb_column_full_pwa"><?php submit_button(__('Save changes',"push-notification-for-post-and-buddypress"),'pnfpb_ic_push_save_configuration_button'); ?></div>
	</div>		
	</form>
</div>