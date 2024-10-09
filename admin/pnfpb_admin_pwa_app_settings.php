<?php
/**
* Plugin settings area to generate Progressive Web App with offline mode facility
*
* @since 1.20
*/
?>
<h1 class="pnfpb_ic_push_settings_header"><?php echo __("PNFPB - PWA (Progressive Web App) settings",PNFPB_TD);?></h1>
<div class="nav-tab-wrapper">
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb-icfcm-slug" class="tab nav-tab"><?php echo __("Push Settings",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_device_tokens_list" class="nav-tab tab "><?php echo __("Device tokens",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_pwa_app_settings" class="nav-tab nav-tab-active tab active"><?php echo __("PWA",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfmtest_notification" class="nav-tab tab "><?php echo __("Send push notification",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc" class="nav-tab tab"><?php echo __("Push Notifications list",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_frontend_settings" class="nav-tab tab"><?php echo __("Frontend subscription settings",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_button_settings" class="nav-tab tab "><?php echo __("Customize buttons",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_integrate_app" class="nav-tab tab "><?php echo __("Integrate Mobile app",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="nav-tab tab "><?php echo __("NGINX",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1" class="nav-tab tab "><?php echo __("Action Scheduler",PNFPB_TD);?></a>
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
		<?php echo __("PNFPB - Progressive Web App(PWA) settings (or) Integrate with Progressier PWA",PNFPB_TD);?>
	</h2>

	<div class="nav-tab-wrapper pnfpb-pwa-category-tabs" id="pnfpb-pwa-category-tabs">
		<a class="nav-tab nav-tab-active" id="pnfpb-pwa-native-tab" href="#pnfpb-pwa-native-tab-name"><?php echo __("PNFPB PWA settings",'PNFPB_TD');?></a>
		<a class="nav-tab" id="pnfpb-pwa-thirdparty-tab" href="#pnfpb-pwa-thirdparty-tab-name"><?php echo __("Integrate with Progressier PWA",'PNFPB_TD');?></a>
	</div>
		
	<div id="pnfpb-pwa-native-tab-name" class="pnfpb-native-pwa-settings-tab pnfpb-category-pwa-settings-tab active">

		<table id="pnfpb-pwa-tabs" class="pnfpb_ic_push_settings_table widefat fixed">
    		<tbody>
				<tr class="pnfpb_ic_push_settings_table_row">
					<td>
						<ul>
							<li class="pnfpb-admin-right_sidebar"><?php echo "<b>".__("Fields in below tabs App name, display & color, icons and screenshots are required to generate Progressive Web App (PWA)",PNFPB_TD)."</b>";?></li>
							<li><?php echo "<b>".__("For Apple ios devices, PWA compatiable from ios 17.0 version onwards",PNFPB_TD)."</b>";?></li>			
						</ul>						
					</td>
				</tr>
				<tr class="pnfpb_ic_push_settings_table_row">
					<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
						<div class="pnfpb_row">
  							<div class="pnfpb_column">
    							<div class="pnfpb_card">				
									<label for="pnfpb_ic_pwa_app_enable"><?php echo __("Enable/Disable PWA*",'PNFPB_TD');?></label>
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
        	<a class="nav-tab nav-tab-active" id="pnfpb-pwa-name-tab" href="#pnfpb-pwa-name"><?php echo __("App Name",'PNFPB_TD');?></a>
        	<a class="nav-tab" id="pnfpb-pwa-display-tab" href="#pnfpb-pwa-display"><?php echo __("Display & Color",'PNFPB_TD');?></a>
       	 	<a class="nav-tab" id="pnfpb-pwa-icon-tab" href="#pnfpb-pwa-icons"><?php echo __("Icons",'PNFPB_TD');?></a>
        	<a class="nav-tab" id="pnfpb-pwa-screenshot-tab" href="#pnfpb-pwa-screenshots"><?php echo __("Screenshots",'PNFPB_TD');?></a>
			<a class="nav-tab" id="pnfpb-pwa-splashscreen-ios-tab" href="#pnfpb-pwa-splashscreen-ios"><?php echo __("Splashscreen for ios",'PNFPB_TD');?></a>			
        	<a class="nav-tab" id="pnfpb-pwa-offline-cache-tab" href="#pnfpb-pwa-cache"><?php echo __("Cache",'PNFPB_TD');?></a>
        	<a class="nav-tab" id="pnfpb-pwa-custom-prompt-tab" href="#pnfpb-pwa-custom-prompt"><?php echo __("Custom Prompt",'PNFPB_TD');?></a>
			<a class="nav-tab" id="pnfpb-pwa-protocol-handler-tab" href="#pnfpb-pwa-protocol-handler"><?php echo __("Protocol Handler",'PNFPB_TD');?></a>
			<a class="nav-tab" id="pnfpb-pwa-ios-devices-tab" href="#pnfpb-pwa-ios-devices"><?php echo __("ios iphone/ipad",'PNFPB_TD');?></a>
			<a class="nav-tab" id="pnfpb-pwa-shortcode-tab" href="#pnfpb-pwa-shortcode"><?php echo __("Shortcode",'PNFPB_TD');?></a>
    	</div>					
    	<div id="pnfpb-pwa-name" class="pnfpb-pwa-settings-tab active">
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb_ic_pwa_app_name">
					<?php echo __("PWA (web App) name*<br/> (max 50 characters)",PNFPB_TD);?>
				</label>
				<br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_app_name" name="pnfpb_ic_pwa_app_name" type="text" maxlength="50" value="<?php if (get_option( 'pnfpb_ic_pwa_app_name' )) {echo get_option( 'pnfpb_ic_pwa_app_name' );} else { echo substr(get_bloginfo( 'name' ),0,50);} ?>" required="required" />					
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb_ic_pwa_app_shortname">
					<?php echo __("PWA short name*<br/> (max 25 characters)",PNFPB_TD);?>
				</label>
				<br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_app_shortname" name="pnfpb_ic_pwa_app_shortname" type="text" maxlength="25" value="<?php if (get_option( 'pnfpb_ic_pwa_app_shortname' )) {echo get_option( 'pnfpb_ic_pwa_app_shortname' );} else { echo substr(get_bloginfo( 'name' ),0,25);} ?>" required="required" />					
			</div>
		</div>
    	<div id="pnfpb-pwa-display" class="pnfpb-pwa-settings-tab">
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb_ic_pwa_theme_color">
					<?php echo __("PWA theme color*",PNFPB_TD);?>
				</label>
				<br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_push_pwa_color" id="pnfpb_ic_pwa_theme_color" name="pnfpb_ic_pwa_theme_color" type="color" value="<?php if (get_option( 'pnfpb_ic_pwa_theme_color' )) {echo get_option( 'pnfpb_ic_pwa_theme_color' ); } else { echo '#161515';}?>" required="required" />					
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb_ic_pwa_app_backgroundcolor">
					<?php echo __("PWA background color*",PNFPB_TD);?>
				</label>
				<br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_push_pwa_color" id="pnfpb_ic_pwa_app_backgroundcolor" name="pnfpb_ic_pwa_app_backgroundcolor" type="color" value="<?php if (get_option( 'pnfpb_ic_pwa_app_backgroundcolor' )) {echo get_option( 'pnfpb_ic_pwa_app_backgroundcolor' );} else { echo '#ffffff';}?>" required="required" />					
			</div>
    		<div class="pnfpb_ic_push_settings_table_row">				
        		<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
					<label for="pnfpb_ic_pwa_app_display">
						<?php echo __("PWA display format*",PNFPB_TD);?>
					</label>
					<br/>
					<select name="pnfpb_ic_pwa_app_display" id="pnfpb_ic_pwa_app_display" required="required">
						<option value="standalone" <?php if (get_option( 'pnfpb_ic_pwa_app_display' ) === 'standalone'){ echo 'selected';} else {echo '';} ?>><?php echo __("standalone",PNFPB_TD);?></option>
						<option value="fullscreen" <?php if (get_option( 'pnfpb_ic_pwa_app_display' ) === 'fullscreen'){ echo 'selected';} else {echo '';} ?>><?php echo __("fullscreen",PNFPB_TD);?></option>
						<option value="minimal-ui" <?php if (get_option( 'pnfpb_ic_pwa_app_display' ) === 'minimal-ui'){ echo 'selected';} else {echo '';} ?>><?php echo __("minimal-ui",PNFPB_TD);?></option>
					</select>					
				</div>
			</div>
		</div>
		<div id="pnfpb-pwa-icons" class="pnfpb-pwa-settings-tab">
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<?php 
					echo __( 'PWA icon size must be exactly as specified below for icon1 and icon2(132x132 and 512x512) otherwise it will use default plugin icons', 'PNFPB_TD' ); 
								?>
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<div class="">
            		<table>
						<tr>
                			<td class="column-columnname">
								<label for="pnfpb_ic_fcm_pwa_upload_icon_132">
									<?php echo __("PWA Icon-1*<br/>( Must be 132x132 pixels)",PNFPB_TD);?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo __("Add PWA Icon",PNFPB_TD);?>" id="pnfpb_ic_fcm_pwa_upload_button_132" class="pnfpb_ic_push_pwa_settings_upload_icon" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_icon_132" name="pnfpb_ic_fcm_pwa_upload_icon_132" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_icon_132' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_icon_132' );} else { echo plugin_dir_url( __DIR__ ).'public/img/icon_132.png';} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_preview_132" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_icon_132' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_icon_132' );} else { echo plugin_dir_url( __DIR__).'public/img/icon_132.png';} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
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
									<?php echo __(" PWA Icon-2*<br/>( Must be 512x512 pixels)",PNFPB_TD);?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">												
                    			<input type="button" value="<?php echo __("Add PWA Icon",PNFPB_TD);?>" id="pnfpb_ic_fcm_pwa_upload_button_512" class="pnfpb_ic_push_pwa_settings_upload_icon" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_icon_512" name="pnfpb_ic_fcm_pwa_upload_icon_512" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_icon_512' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_icon_512' );} else { echo plugin_dir_url( __DIR__ ).'public/img/icon.png';} ?>" />
                			</td>
						</tr>
						<tr>
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_preview_512" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_icon_512' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_icon_512' );} else { echo plugin_dir_url( __DIR__ ).'public/img/icon.png';} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
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
					echo __( 'Upload Screenshot of Desktop version of site and Screenshot of Mobile version of site. Screenshots are mandatory for PWA', 'PNFPB_TD' ); 
				?>
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<div>
            		<table class="pnfpb_pwa_table">
						<tr>
                			<td class="column-columnname">
								<label for="pnfpb_ic_fcm_pwa_upload_screenshot_desktop">
									<?php echo __("PWA Desktop Screenshot*<br/>( Wide screenshot - Desktop version of site 1280x780 px)",PNFPB_TD);?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo __("Upload screenshot of Desktop version of site",PNFPB_TD);?>" id="pnfpb_ic_fcm_pwa_upload_screenshot_desktop" class="pnfpb_ic_fcm_pwa_upload_screenshot_desktop" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value" name="pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value' );} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value' );} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
						<tr>
							<td  class="column-columnname">
        						<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
									<label for="pnfpb_ic_fcm_pwa_upload_screenshot_desktop_label">
										<?php echo __("Label for desktop screenshot",PNFPB_TD);?>
									</label>
									<br/>
									<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_pwa_upload_screenshot_desktop_label" name="pnfpb_ic_fcm_pwa_upload_screenshot_desktop_label" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_desktop_label' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_desktop_label' );} else { echo "Homescreen of Awesome App";} ?>" required="required" />					
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
									<?php echo __("PWA Mobile Screenshot*<br/>( Narrow format screenshot - mobile version of site)",PNFPB_TD);?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo __("Upload screenshot of Mobile version of site",PNFPB_TD);?>" id="pnfpb_ic_fcm_pwa_upload_screenshot_mobile" class="pnfpb_ic_fcm_pwa_upload_screenshot_mobile" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value" name="pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value' );} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value' );} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
						<tr>
							<td  class="column-columnname">
        						<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
									<label for="pnfpb_ic_fcm_pwa_upload_screenshot_mobile_label">
										<?php echo __("Label for mobile screenshot",PNFPB_TD);?>
									</label>
									<br/>
									<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_pwa_upload_screenshot_mobile_label" name="pnfpb_ic_fcm_pwa_upload_screenshot_mobile_label" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_mobile_label' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_screenshot_mobile_label' );} else { echo "List of Awesome Resources available in Awesome App";} ?>" required="required" />					
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
					echo __( 'Splash screen for Apple macos,ios devices', 'PNFPB_TD' ); 
				?>
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<div>
            		<table class="pnfpb_pwa_table">
						<tr>
                			<td class="column-columnname">
								<label for="pnfpb_ic_fcm_pwa_upload_screenshot_desktop">
									<?php echo __("Splash screen icon for devices with 640x1136px",PNFPB_TD);?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo __("Upload Splash screen icon in size 640x1136px",PNFPB_TD);?>" id="pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136" class="pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value" name="pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value' );} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value' );} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
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
									<?php echo __("Splash screen icon in size 750x1294px",PNFPB_TD);?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo __("Upload Splash screen icon in size 640x1136px",PNFPB_TD);?>" id="pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294" class="pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value" name="pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value' );} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value' );} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
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
									<?php echo __("Splash screen icon in size 1242x2148px",PNFPB_TD);?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo __("Upload Splash screen icon in size 1242x2148px",PNFPB_TD);?>" id="pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148" class="pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2146_value" name="pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value' );} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value' );} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
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
									<?php echo __("Splash screen icon in size 1125x2436px",PNFPB_TD);?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo __("Upload Splash screen icon in size 1125x2436px",PNFPB_TD);?>" id="pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436" class="pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_value" name="pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_value" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_value' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_value' );} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_value_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_desktop_value' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_desktop_value' );} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
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
									<?php echo __("Splash screen icon in size 1536x2048px",PNFPB_TD);?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo __("Upload Splash screen icon in size 1536x2048px",PNFPB_TD);?>" id="pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048" class="pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_value" name="pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_value" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_value' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_value' );} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_value_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_desktop_value' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_desktop_value' );} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
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
									<?php echo __("Splash screen icon in size 1668x2224px",PNFPB_TD);?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo __("Upload Splash screen icon in size 1668x2224px",PNFPB_TD);?>" id="pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224" class="pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_value" name="pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_value" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_value' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_value' );} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_value_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_desktop_value' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_desktop_value' );} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
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
									<?php echo __("Splash screen icon in size 2048x2732px",PNFPB_TD);?>
								</label>
							</td>
						</tr>
						<tr>
							<td class="column-columnname">
                    			<input type="button" value="<?php echo __("Upload Splash screen icon in size 2048x2732px",PNFPB_TD);?>" id="pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732" class="pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_value" name="pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_value" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_value' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_value' );} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_value_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_desktop_value' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_desktop_value' );} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;background-position:center center;background-repeat:no-repeat;background-size:cover;">
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
					echo '<b>'.__( 'Below options are for offline facility for PWA - web app', 'PNFPB_TD' ).'</b><br/><b>'.__( '<b>Home page url to be cached for offline use(*required)</b>', 'PNFPB_TD' ).'</b>';
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
							echo '<option value="' . get_home_url() . '"'.$homeurlselected.'>'.__('Home page', 'PNFPB_TD' ).'</option>';	        		
							foreach( $pages as $page ){
								echo '<option value="' . get_page_link( $page->ID ) . '" ' . selected( get_page_link( $page->ID ), get_option( 'pnfpb_ic_pwa_app_offline_url1' ) ) . '>' . $page->post_title . '</option>';						
       						}
    					}
					?>
				</select>
			</div>
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<?php
					echo __('<b>Default url for offline if page is not available in cache(*required)</b>', 'PNFPB_TD' );
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
						echo '<option value="' . get_home_url() . '"'.$homeurlselected.'>'.__('Home page', 'PNFPB_TD' ).'</option>';	        		
						foreach( $pages as $page ){
						echo '<option value="' . get_page_link( $page->ID ) . '" ' . selected( get_page_link( $page->ID ), get_option( 'pnfpb_ic_pwa_app_offline_url2' ) ) . '>' . $page->post_title . '</option>';						
       					}
    				}
					?>
				</select>					
			</div>
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<?php
					echo __('<b>Other extra pages to be cached for offline use/to be stored in cache(Optional)</b>', 'PNFPB_TD' );
				?>
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb_ic_pwa_app_offline_url3">
					<?php echo __("website page url to be cached for offline",PNFPB_TD);?>
				</label>
				<br/>
				<select id="pnfpb_ic_pwa_app_offline_url3" name="pnfpb_ic_pwa_app_offline_url3" >
					<?php
						if( $pages = get_pages() ){
							echo '<option value="">Select page</option>';	        							
							foreach( $pages as $page ){
								echo '<option value="' . get_page_link( $page->ID ) . '" ' . selected(get_page_link( $page->ID ), get_option( 'pnfpb_ic_pwa_app_offline_url3' ) ) . '>' . $page->post_title . '</option>';						
       						}
    					}
					?>
				</select>	
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb_ic_pwa_app_offline_url4">
					<?php echo __("website page url to be cached for offline",PNFPB_TD);?>
				</label>
				<br/>
				<select id="pnfpb_ic_pwa_app_offline_url4" name="pnfpb_ic_pwa_app_offline_url4" >
					<?php
					if( $pages = get_pages() ){
							echo '<option value="">Select page</option>';        		
							foreach( $pages as $page ){
								echo '<option value="' . get_page_link( $page->ID ) . '" ' . selected( get_page_link( $page->ID ), get_option( 'pnfpb_ic_pwa_app_offline_url4' ) ) . '>' . $page->post_title . '</option>';						
       						}
    					}
					?>
				</select>					
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb_ic_pwa_app_offline_url5">
					<?php echo __("website page url to be cached for offline",PNFPB_TD);?>
				</label>
				<br/>
				<select id="pnfpb_ic_pwa_app_offline_url5" name="pnfpb_ic_pwa_app_offline_url5" >
					<?php
						if( $pages = get_pages() ){
							echo '<option value="">Select page</option>';       		
							foreach( $pages as $page ){
								echo '<option value="' . get_page_link( $page->ID ) . '" ' . selected( get_page_link( $page->ID ), get_option( 'pnfpb_ic_pwa_app_offline_url5' ) ) . '>' . $page->post_title . '</option>';						
       						}
    					}
					?>
				</select>					
			</div>
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<?php
					echo __('<b>List of urls to be excluded from offline cache separted by comma. Please note that enter list of urls to be excluded separated with comma</b>', 'PNFPB_TD' );
				?>
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
  				<div class="pnfpb_row">
					<div class="">
    					<div class="pnfpb_pwa_card">						
							<label class="pnfpb_ic_push_settings_table_label_checkbox">
								<?php echo __("Exclude all Urls from PWA offline cache",'PNFPB_TD');?>
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
				<?php
					echo __('<b>List of urls to be excluded from offline cache separted by comma. Please note that enter list of urls to be excluded separated with comma</b>', 'PNFPB_TD' );
				?>
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb_ic_pwa_app_excludeurls">			
					<?php echo __("List of urls to be excluded from cache separated by comma",PNFPB_TD);?>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_app_excludeurls" name="pnfpb_ic_pwa_app_excludeurls" type="text" value="<?php if (get_option( 'pnfpb_ic_pwa_app_excludeurls' )) {echo get_option( 'pnfpb_ic_pwa_app_excludeurls' );}?>" />
				</label>
			</div>
		</div>
		<div id="pnfpb-pwa-custom-prompt" class="pnfpb-pwa-settings-tab">
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
    			<div class="pnfpb_pwa_card">
					<label for="pnfpb_ic_pwa_app_custom_prompt_enable" class="pnfpb_ic_push_pwa_custom_prompt_divider">
						<?php echo __("Custom prompt for all devices",'PNFPB_TD');?>
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
						<?php echo __("If cancelled, show custom prompt after number of days",'PNFPB_TD');?>
					</label>
					<label>
						<input  class="pnfpb_ic_fcm_pwa_show_again_days" id="pnfpb_ic_fcm_pwa_show_again_days" name="pnfpb_ic_fcm_pwa_show_again_days" type="number" value="<?php if(get_option( 'pnfpb_ic_fcm_pwa_show_again_days' )) {echo get_option( 'pnfpb_ic_fcm_pwa_show_again_days' );} else { echo "7";} ?>"/>
					</label>
				</div>
			</div>
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<div class="pnfpb_pwa_card">
					<label class="pnfpb_ic_push_pwa_custom_prompt_divider">
						<?php echo __("Only for desktop devices",'PNFPB_TD');?>
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
						<?php echo __("Only for mobile/tablet devices",'PNFPB_TD');?>
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
						<?php echo __("Devices greater than pixels",'PNFPB_TD');?>
					</label>								
					<label class="pnfpb_switch">
						<input  id="pnfpb_ic_pwa_app_pixels_custom_prompt_enable" name="pnfpb_ic_pwa_app_pixels_custom_prompt_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_pwa_app_pixels_custom_prompt_enable' ) ); ?>  />
						<span class="pnfpb_slider round"></span>									
					</label>
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable" id="pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable" name="pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable" type="number" value="<?php if(get_option( 'pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable' )) {echo get_option( 'pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable' );} ?>"  /> 
					<label><?php echo __(" (in pixels)",'PNFPB_TD');?> </label>								
				</div>							
			</div>
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_pwa_prompt_text"><?php echo __("Customize PWA install prompt",'PNFPB_TD');?></label><br/><br/>						
				<label for="pnfpb_ic_fcm_pwa_prompt_text"><?php echo __("Custom text to for PWA custom prompt",'PNFPB_TD');?></label><br/>
				<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_pwa_prompt_text" name="pnfpb_ic_fcm_pwa_prompt_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_pwa_prompt_text' )) {echo get_option( 'pnfpb_ic_fcm_pwa_prompt_text' );} else { echo __("Would like to install our app?",'PNFPB_TD');} ?>"  />					
				<br/><br /><label><?php echo __("PWA custom install prompt confirmation button text",'PNFPB_TD');?></label><br/>	
				<input  class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_push_pwa_custom_prompt_divider" id="pnfpb_ic_fcm_pwa_prompt_confirm_button" name="pnfpb_ic_fcm_pwa_prompt_confirm_button" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_pwa_prompt_confirm_button' )) {echo get_option( 'pnfpb_ic_fcm_pwa_prompt_confirm_button' );} else { echo __("Install",'PNFPB_TD');} ?>"  />
				<br/><br /><label><?php echo __("PWA custom install prompt cancel button text",'PNFPB_TD');?></label><br/>	
				<input  class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_push_pwa_custom_prompt_divider" id="pnfpb_ic_fcm_pwa_prompt_cancel_button" name="pnfpb_ic_fcm_pwa_prompt_cancel_button" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_pwa_prompt_cancel_button' )) {echo get_option( 'pnfpb_ic_fcm_pwa_prompt_cancel_button' );} else { echo __("Cancel",'PNFPB_TD');} ?>"  />
				<br /><br/><label><?php echo __("PWA custom install prompt Button background color",'PNFPB_TD');?></label><br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_pwa_prompt_button_background pnfpb_ic_push_pwa_custom_prompt_divider" id="pnfpb_ic_fcm_pwa_prompt_button_background" name="pnfpb_ic_fcm_pwa_prompt_button_background" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_prompt_button_background' )) {echo get_option( 'pnfpb_ic_fcm_pwa_prompt_button_background' ); } else { echo '#ffffff';}?>" required="required" />					
				<br /><br/><label><?php echo __("PWA custom install prompt dialog box background color",'PNFPB_TD');?></label><br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_pwa_prompt_dialog_background pnfpb_ic_push_pwa_custom_prompt_divider" id="pnfpb_ic_fcm_pwa_prompt_dialog_background" name="pnfpb_ic_fcm_pwa_prompt_dialog_background" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_prompt_dialog_background' )) {echo get_option( 'pnfpb_ic_fcm_pwa_prompt_dialog_background' ); } else { echo '#ffffff';}?>" required="required" />					
				<br /><br/><label><?php echo __("PWA custom install prompt dialog Text color",'PNFPB_TD');?></label><br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_pwa_prompt_text_color pnfpb_ic_push_pwa_custom_prompt_divider" id="pnfpb_ic_fcm_pwa_prompt_text_color" name="pnfpb_ic_fcm_pwa_prompt_text_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_prompt_text_color' )) {echo get_option( 'pnfpb_ic_fcm_pwa_prompt_text_color' ); } else { echo '#161515';}?>" required="required" />
				<br /><br/><label><?php echo __("PWA custom install prompt button Text color",'PNFPB_TD');?></label><br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_pwa_prompt_button_text_color pnfpb_ic_push_pwa_custom_prompt_divider" id="pnfpb_ic_fcm_pwa_prompt_button_text_color" name="pnfpb_ic_fcm_pwa_prompt_button_text_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_prompt_button_text_color' )) {echo get_option( 'pnfpb_ic_fcm_pwa_prompt_button_text_color' ); } else { echo '#161515';}?>" required="required" />
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb-pwa-dialog-app-installed_text">
					<?php echo __("PWA after installed confirmation popup header text",PNFPB_TD);?>
				</label>
				<br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb-pwa-dialog-app-installed_text" name="pnfpb-pwa-dialog-app-installed_text" type="text" maxlength="100" value="<?php if (get_option( 'pnfpb-pwa-dialog-app-installed_text' )) {echo get_option( 'pnfpb-pwa-dialog-app-installed_text' );} else { echo __("App installed successfully",PNFPB_TD);} ?>" />					
			</div>
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb-pwa-dialog-app-installed_text">
					<?php echo __("PWA after installed confirmation popup description",PNFPB_TD);?>
				</label>
				<br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb-pwa-dialog-app-installed_description" name="pnfpb-pwa-dialog-app-installed_description" type="text" maxlength="500" value="<?php if (get_option( 'pnfpb-pwa-dialog-app-installed_description' )) {echo get_option( 'pnfpb-pwa-dialog-app-installed_description' );} else { echo __("Progressive Web App (PWA) is installed successfully. It will also work in offline",PNFPB_TD);} ?>" />					
			</div>
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<?php
					echo __("<b>All fields marked with '*' are required fields, Please verify before submitting the changes</b>",PNFPB_TD);
				?>
			</div>
			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<?php
					echo __("<b>Progressive Web Apps are supported by Chrome(Desktop,Mobile) browser, Edge browser, Firefox for android, Opera for android,Edge for Android, Brave for Android and Samsung Interent except Firefox for desktop</b>",PNFPB_TD);
				?>
			</div>
		</div>
    	<div id="pnfpb-pwa-protocol-handler" class="pnfpb-pwa-settings-tab">
        	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
				<label for="pnfpb_ic_pwa_protocol-name">
					<?php echo "<b>".__("List of Protocol handlers",PNFPB_TD)."</b><br/>";?>
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
						<?php echo "<b>".__("Protocol handler ",PNFPB_TD)."<span>".strval($pnfpb_pwa_protocol_count+1)."</span></b>";?>
					</label>
					<input type="button" name="pnfpb_ic_push_remove_protocol_button" id="pnfpb_ic_push_remove_protocol_button" class="button pnfpb_ic_push_remove_protocol_button" value="<?php echo __("Delete",PNFPB_TD); ?>">							
        			<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname pnfpb_pwa_card_protocol_root">
						<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname pnfpb_pwa_card_protocol_child">
							<label for="pnfpb_ic_pwa_protocol-name">
								<?php echo __("Protocol",PNFPB_TD);?>
							</label>
							<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_protocol_name_<?php echo $pnfpb_pwa_protocol_count+1; ?>" name="pnfpb_ic_pwa_protocol_name[]" type="text" placeholder="web+jnglstore" value="<?php if (trim($pnfpb_ic_pwa_protocol_name_array[$pnfpb_pwa_protocol_count]) != '') {echo $pnfpb_ic_pwa_protocol_name_array[$pnfpb_pwa_protocol_count];} ?>" />
						</div>
						<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname pnfpb_pwa_card_protocol_child">
							<label for="pnfpb_ic_pwa_protocol-url">
								<?php echo __("Url",PNFPB_TD);?>
							</label>
							<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_protocol_url_<?php echo $pnfpb_pwa_protocol_count+1; ?>" name="pnfpb_ic_pwa_protocol_url[]" type="text" placeholder="/shop?for=%s" value="<?php if (trim($pnfpb_ic_pwa_protocol_url_array[$pnfpb_pwa_protocol_count]) != '') {echo $pnfpb_ic_pwa_protocol_url_array[$pnfpb_pwa_protocol_count];} ?>" />
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
				<li><?php echo "<b>".__("Installation instructions for Apple devices iphone/ipad/macos",PNFPB_TD)."</b>";?></li>
				<li><?php echo __("In phone/ipad browser, click on share icon in browser",PNFPB_TD);?></li>
				<li><?php echo __("Select add to home screen in ios devices or add to dock in macos",PNFPB_TD);?></li>
				<li><?php echo __("Same above instruction will be shown to frontend ios iphone/ipad device users using PWA custom prompt (when it is turned on) or when shortcode button is clicked by frontend ios device users",PNFPB_TD);?></li>
				<li><?php echo __("For ios devices(iphone/ipad), Push notification will work only thorugh PWA",PNFPB_TD);?></li>
				<li><?php echo __("For other devices macos,android,windows desktop, push notification will work normally",PNFPB_TD);?></li>
				<li><?php echo "<b>".__("Shortcode [PNFPB_PWA_PROMPT] is available for PWA. When it is clicked on for ios devices, it will show above instruction. For other devices it will install PWA normally",PNFPB_TD)."</b>";?></li>					
			</ul>
			<div>
				<label for="pnfpb-pwa-ios-message">
					<?php echo __("Customize PWA installation instruction for ios device users",PNFPB_TD);?>
				</label>				
				<textarea class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb-pwa-ios-message" name="pnfpb-pwa-ios-message" type="text"  rows="3"><?php if (get_option( 'pnfpb-pwa-ios-message' )) {echo get_option( 'pnfpb-pwa-ios-message' );} else { echo __("Install our app using add to home screen in browser. In phone/ipad browser, click on share icon in browser and select add to home screen in ios devices or add to dock in macos ",PNFPB_TD);} ?></textarea>						
			</div>
			<ul>
				<li><a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_button_settings#pwa-install-shortcode-customize-section"><?php echo __("Customize PWA install shortcode button",PNFPB_TD);?></a></li>
			</ul>			
		</div>
		<div id="pnfpb-pwa-shortcode" class="pnfpb-pwa-settings-tab">
			<ul>
				<li><?php echo "<b>".__("Shortcode [PNFPB_PWA_PROMPT] is available to display PWA install button",PNFPB_TD)."</b>";?></li>
				<li><?php echo __("If install button is clicked then it will display prompt to install Progressive Web App(PWA)",PNFPB_TD);?></li>
				<li><?php echo __("Once it is installed then PWA shortcode install button will not appear",PNFPB_TD);?></li>
				<li><?php echo __("PWA Shortcode install button will appear only when PWA is not installed",PNFPB_TD);?></li>
				<li><?php echo __("Customization options are available under customization tab",PNFPB_TD);?></li>
				<li><a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_button_settings#pwa-install-shortcode-customize-section"><?php echo __("Customize PWA install shortcode button",PNFPB_TD);?></a></li>
			</ul>
		</div>		
	</div>
	<div id="pnfpb-pwa-thirdparty-tab-name" class="pnfpb-thirdparty-pwa-settings-tab pnfpb-category-pwa-settings-tab">
		<div id="pnfpb-thirdparty-pwa-tabs" class="pnfpb_ic_push_settings_table widefat fixed">
			<div class="pnfpb_row">
  				<div class="pnfpb_column">
    				<div class="pnfpb_card">				
						<label for="pnfpb_ic_thirdparty_pwa_app_enable"><?php echo __("Enable/Disable Progressier PWA",'PNFPB_TD');?></label>
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
				<?php echo __("Enter Progressier app id <br/>(only app id, do not enter url)",PNFPB_TD);?>
			</label>
			<br/>
			<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_thirdparty_app_id" name="pnfpb_ic_pwa_thirdparty_app_id" type="text" maxlength="50" value="<?php if (get_option( 'pnfpb_ic_pwa_thirdparty_app_id' )) {echo get_option( 'pnfpb_ic_pwa_thirdparty_app_id' );} else { echo get_option( 'pnfpb_ic_pwa_thirdparty_app_id' );} ?>" />
			<br/><br/>
			<label for="pnfpb_ic_pwa_thirdparty_app_id">
				<?php echo __("(usually as second qualifier before filename) <br/>(example like https://progressier.app/appid/progressier.json, in this url, app id is in second qualifier)<br/>(or) go to settings in progressier dashboard->select lastmenu->app id",PNFPB_TD);?>
			</label>			
		</div>
	</div>
	<div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname">
		<div class="pnfpb_column_full_pwa"><?php submit_button(__('Save changes',PNFPB_TD),'pnfpb_ic_push_save_configuration_button'); ?></div>
	</div>		
	</form>
</div>