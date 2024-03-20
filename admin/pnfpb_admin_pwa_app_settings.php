<?php
/**
* Plugin settings area to generate Progressive Web App with offline mode facility
*
* @since 1.20
*/
?>
<h1 class="pnfpb_ic_push_settings_header"><?php echo __("PNFPB - PWA (Progressive Web App) settings",PNFPB_TD);?></h1>
<div class="pnfpb_admin_top_menu">
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb-icfcm-slug" class="tab"><?php echo __("Push Settings",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_device_tokens_list" class="tab "><?php echo __("Device tokens",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_pwa_app_settings" class="tab active"><?php echo __("PWA",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfmtest_notification" class="tab "><?php echo __("One time push",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc" class="tab"><?php echo __("Notifications",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_frontend_settings" class="tab"><?php echo __("Frontend settings",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_button_settings" class="tab "><?php echo __("Customize buttons",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_integrate_app" class="tab "><?php echo __("Mobile app",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="tab "><?php echo __("NGINX",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1" class="tab "><?php echo __("Action Scheduler",PNFPB_TD);?></a>
</div>
<div class="pnfpb_column_1200">
<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
	
    <?php settings_fields( 'pnfpb_icfcm_pwa'); ?>
    <?php do_settings_sections( 'pnfpb_icfcm_pwa' ); ?>
	
	<h2 class="pnfpb_ic_push_pwa_settings_header2">
		<?php echo __("Below settings are to generate Progressive Web App(PWA) with offline facility",PNFPB_TD);?>
	</h2>
	<ul>
		<li><?php echo __("<b>PWA can also be installed using shortcode option [PNFPB_PWA_PROMPT] in below compatible browsers. Customize this shortcode button/text in button customization tab - admin settings of this plugin</b>",PNFPB_TD);?></li>
		<li><?php echo __("<b>PWA will work only in chrome, edge browsers and in android app chrome,firefox and other compatible browsers</b>",PNFPB_TD);?></li>
		<li><?php echo __("<b>PWA may not be compatible in IOS and IPAD browsers. In IOS/IPAD devices use add to home screen to install PWA</b>",PNFPB_TD);?></li>	
		<li><?php echo __("All below fields are required to generate Progressive Web App (PWA). Additionally, Enable/disable PWA app by selecting appropriate check box and Enter appropriate URLs to store in cache for offline PWA app, selected pages can be viewed in offline without internet. In offline mode, if page is not available/stored in cache then 404 offline page will be displayed",PNFPB_TD);?></li>
	</ul>
	<table class="pnfpb_ic_push_settings_table widefat fixed">
    	<tbody>
			<tr class="pnfpb_ic_push_settings_table_row">
				<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
				<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">				
							<label for="pnfpb_ic_pwa_app_enable"><?php echo __("Enable/Disable PWA*",'PNFPB_TD');?></label>									<label class="pnfpb_switch">
								<input  id="pnfpb_ic_pwa_app_enable" name="pnfpb_ic_pwa_app_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_pwa_app_enable' ) ); ?>  />	
								<span class="pnfpb_slider round"></span>
							</label>
						</div>
					</div>
				</div>
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_name">
						<?php echo __("PWA (web App) name*<br/> (max 50 characters)",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_app_name" name="pnfpb_ic_pwa_app_name" type="text" maxlength="50" value="<?php if (get_option( 'pnfpb_ic_pwa_app_name' )) {echo get_option( 'pnfpb_ic_pwa_app_name' );} else { echo substr(get_bloginfo( 'name' ),0,50);} ?>" required="required" />					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_shortname">
						<?php echo __("PWA short name*<br/> (max 25 characters)",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_app_shortname" name="pnfpb_ic_pwa_app_shortname" type="text" maxlength="25" value="<?php if (get_option( 'pnfpb_ic_pwa_app_shortname' )) {echo get_option( 'pnfpb_ic_pwa_app_shortname' );} else { echo substr(get_bloginfo( 'name' ),0,25);} ?>" required="required" />					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_theme_color">
						<?php echo __("PWA theme color*",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_push_pwa_color" id="pnfpb_ic_pwa_theme_color" name="pnfpb_ic_pwa_theme_color" type="color" value="<?php if (get_option( 'pnfpb_ic_pwa_theme_color' )) {echo get_option( 'pnfpb_ic_pwa_theme_color' ); } else { echo '#161515';}?>" required="required" />					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_backgroundcolor">
						<?php echo __("PWA background color*",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_push_pwa_color" id="pnfpb_ic_pwa_app_backgroundcolor" name="pnfpb_ic_pwa_app_backgroundcolor" type="color" value="<?php if (get_option( 'pnfpb_ic_pwa_app_backgroundcolor' )) {echo get_option( 'pnfpb_ic_pwa_app_backgroundcolor' );} else { echo '#ffffff';}?>" required="required" />					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_display">
						<?php echo __("PWA display format*",PNFPB_TD);?>
					</label>
					<br/>
					<select name="pnfpb_ic_pwa_app_display" id="pnfpb_ic_pwa_app_display" required="required">
						<option value="standalone" <?php if (get_option( 'pnfpb_ic_pwa_app_display' ) === 'standalone'){ echo 'selected';} else {echo '';} ?>><?php echo __("standalone",PNFPB_TD);?></option>
						<option value="fullscreen" <?php if (get_option( 'pnfpb_ic_pwa_app_display' ) === 'fullscreen'){ echo 'selected';} else {echo '';} ?>><?php echo __("fullscreen",PNFPB_TD);?></option>
						<option value="minimal-ui" <?php if (get_option( 'pnfpb_ic_pwa_app_display' ) === 'minimal-ui'){ echo 'selected';} else {echo '';} ?>><?php echo __("minimal-ui",PNFPB_TD);?></option>
					</select>					
				</td>
			</tr>
			<tr>
				<td>
					<?php 
						echo __( 'PWA icon size must be exactly as specified below for icon1 and icon2(132x132 and 512x512) otherwise it will use default plugin icons', 'PNFPB_TD' ); 
					?>
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<div class="pnfpb_column_400">
            		<table>
						<tr>
                			<td class="column-columnname">
								<label for="pnfpb_ic_fcm_pwa_upload_icon_132">
									<?php echo __("PWA Icon1*<br/>( Must be 132x132 pixels)",PNFPB_TD);?>
								</label>								
                    			<input type="button" value="<?php echo __("Add PWA Icon",PNFPB_TD);?>" id="pnfpb_ic_fcm_pwa_upload_button_132" class="pnfpb_ic_push_pwa_settings_upload_icon" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_icon_132" name="pnfpb_ic_fcm_pwa_upload_icon_132" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_icon_132' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_icon_132' );} else { echo plugin_dir_url( __DIR__ ).'public/img/icon_132.png';} ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_preview_132" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_icon_132' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_icon_132' );} else { echo plugin_dir_url( __DIR__).'public/img/icon_132.png';} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;margin:0px auto;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
					</table>
					</div>
					<div class="pnfpb_column_400">
            		<table>
						<tr>
                			<td class="column-columnname">
								<label for="pnfpb_ic_fcm_pwa_upload_icon_512">
									<?php echo __(" PWA Icon2*<br/>( Must be 512x512 pixels)",PNFPB_TD);?>
								</label>								
                    			<input type="button" value="<?php echo __("Add PWA Icon",PNFPB_TD);?>" id="pnfpb_ic_fcm_pwa_upload_button_512" class="pnfpb_ic_push_pwa_settings_upload_icon" />
                    			<input type="hidden" id="pnfpb_ic_fcm_pwa_upload_icon_512" name="pnfpb_ic_fcm_pwa_upload_icon_512" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_icon_512' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_icon_512' );} else { echo plugin_dir_url( __DIR__ ).'public/img/icon.png';} ?>" />
                			</td>
						</tr>
						<tr>
                			<td class="column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_pwa_upload_preview_512" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_icon_512' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_icon_512' );} else { echo plugin_dir_url( __DIR__ ).'public/img/icon.png';} ?>);width:100px; height:100px;overflow:hidden;border-radius:0%;margin:0px auto;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
					</table>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<?php
						echo __( '<b>Below options are for offline facility for PWA - web app</b>', 'PNFPB_TD' );
					?>	
				</td>
			</tr>
			<tr>
				<td>
					<?php
						echo __( '<b>Home page url to be cached for offline use(*required)</b>', 'PNFPB_TD' );
					?>
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_offline_url1">
						<?php echo __("Enter url*",PNFPB_TD);?>
					</label>
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
				</td>
			</tr>
			<tr>
				<td>
					<?php
						echo __('<b>Default url for offline if page is not available in cache(*required)</b>', 'PNFPB_TD' );
					?>
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_offline_url2">
						<?php echo __("Enter url*",PNFPB_TD);?>
					</label>
					<br/>
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
				</td>
			</tr>
			<tr>
				<td>
					<?php
						echo __('<b>Other extra pages to be cached for offline use/to be stored in cache(Optional)</b>', 'PNFPB_TD' );
					?>
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_offline_url3">
						<?php echo __("website page url to be cached for offline",PNFPB_TD);?>
					</label>
					<br/>
					<select id="pnfpb_ic_pwa_app_offline_url3" name="pnfpb_ic_pwa_app_offline_url3" >
					<?php
					if( $pages = get_pages() ){
						echo '<option value="">Select page</option>';	        							foreach( $pages as $page ){
							echo '<option value="' . get_page_link( $page->ID ) . '" ' . selected(get_page_link( $page->ID ), get_option( 'pnfpb_ic_pwa_app_offline_url3' ) ) . '>' . $page->post_title . '</option>';						
       					}
    				}
					?>
				</select>	
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
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
				</td>
    		</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
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
				</td>
			</tr>
			<tr>
				<td>
					<?php
						echo __('<b>List of urls to be excluded from offline cache separted by comma. Please note that enter list of urls to be excluded separated with comma</b>', 'PNFPB_TD' );
					?>
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
  					<div class="pnfpb_row">
						<div class="pnfpb_column_400">
    						<div class="pnfpb_card">						
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
				</td>
			</tr>
			<tr>
				<td>
					<?php
						echo __('<b>List of urls to be excluded from offline cache separted by comma. Please note that enter list of urls to be excluded separated with comma</b>', 'PNFPB_TD' );
					?>
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_excludeurls">			
						<?php echo __("List of urls to be excluded from cache separated by comma",PNFPB_TD);?>
						<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_app_excludeurls" name="pnfpb_ic_pwa_app_excludeurls" type="text" value="<?php if (get_option( 'pnfpb_ic_pwa_app_excludeurls' )) {echo get_option( 'pnfpb_ic_pwa_app_excludeurls' );}?>" />
					</label>
				</td>
			</tr>
	
			<tr class="pnfpb_ic_push_settings_table_row">
				<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<div class="pnfpb_row">
						<?php echo '<div class="pnfpb_column_full"><b>&nbsp;&nbsp;&nbsp;'.__("Custom install prompt for PWA",PNFPB_TD).'</b></div>';?>
  						<div class="pnfpb_column_400">
    						<div class="pnfpb_card">
								<label for="pnfpb_ic_pwa_app_custom_prompt_enable">
									<?php echo __("Custom prompt for all devices",'PNFPB_TD');?>
								</label>
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_pwa_app_custom_prompt_enable" name="pnfpb_ic_pwa_app_custom_prompt_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_pwa_app_custom_prompt_enable' ) ); ?>  />
									<span class="pnfpb_slider round"></span>
								</label>
							</div>
						</div>
						<div class="pnfpb_column_400">
							<p><?php echo __("If cancel button is pressed while subscribing, show custom prompt after below number of days",'PNFPB_TD');?></p>
							<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_pwa_show_again_days" name="pnfpb_ic_fcm_pwa_show_again_days" type="number" value="<?php if(get_option( 'pnfpb_ic_fcm_pwa_show_again_days' )) {echo get_option( 'pnfpb_ic_fcm_pwa_show_again_days' );} else { echo "7";} ?>"/>
						</div>
  						<div class="pnfpb_column_400">
    						<div class="pnfpb_card">								
								<label for="pnfpb_ic_pwa_app_desktop_custom_prompt_enable">
									<?php echo __("Only for desktop devices",'PNFPB_TD');?>
								</label>
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_pwa_app_desktop_custom_prompt_enable" name="pnfpb_ic_pwa_app_desktop_custom_prompt_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_pwa_app_desktop_custom_prompt_enable' ) ); ?>  />
									<span class="pnfpb_slider round"></span>
								</label>
							</div>
						</div>
  						<div class="pnfpb_column_400">
    						<div class="pnfpb_card">								
								<label for="pnfpb_ic_pwa_app_mobile_custom_prompt_enable">
									<?php echo __("Only for mobile/tablet devices",'PNFPB_TD');?>
								</label>
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_pwa_app_mobile_custom_prompt_enable" name="pnfpb_ic_pwa_app_mobile_custom_prompt_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_pwa_app_mobile_custom_prompt_enable' ) ); ?>  />
									<span class="pnfpb_slider round"></span>
								</label>
							</div>
						</div>
  						<div class="pnfpb_column_400">
    						<div class="pnfpb_card">								
								<label for="pnfpb_ic_pwa_app_pixels_custom_prompt_enable">
									<?php echo __("For devices width greater than entered pixels",'PNFPB_TD');?>
								</label>
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_pwa_app_pixels_custom_prompt_enable" name="pnfpb_ic_pwa_app_pixels_custom_prompt_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_pwa_app_pixels_custom_prompt_enable' ) ); ?>  />
									<span class="pnfpb_slider round"></span>									
								</label>
								<input  class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable" id="pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable" name="pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable" type="number" value="<?php if(get_option( 'pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable' )) {echo get_option( 'pnfpb_ic_pwa_app_pixels_input_custom_prompt_enable' );} ?>"  />Pixels								
							</div>							
						</div>
					</div>
					<div class="pnfpb_row">
 						<div class="pnfpb_column_400">
								<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_pwa_prompt_text"><?php echo __("Below customize options are for custom PWA install prompt",'PNFPB_TD');?></label><br/>							
								<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_pwa_prompt_text"><?php echo __("Custom text to for PWA custom prompt",'PNFPB_TD');?></label><br/>
								<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_pwa_prompt_text" name="pnfpb_ic_fcm_pwa_prompt_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_pwa_prompt_text' )) {echo get_option( 'pnfpb_ic_fcm_pwa_prompt_text' );} else { echo __("Would like to install our app?",'PNFPB_TD');} ?>"  />					
								<br/><br /><p><?php echo __("PWA custom install prompt confirmation button text",'PNFPB_TD');?></p>	
								<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_pwa_prompt_confirm_button" name="pnfpb_ic_fcm_pwa_prompt_confirm_button" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_pwa_prompt_confirm_button' )) {echo get_option( 'pnfpb_ic_fcm_pwa_prompt_confirm_button' );} else { echo __("Install",'PNFPB_TD');} ?>"  />
								<br/><br /><p><?php echo __("PWA custom install prompt cancel button text",'PNFPB_TD');?></p>	
								<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_pwa_prompt_cancel_button" name="pnfpb_ic_fcm_pwa_prompt_cancel_button" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_pwa_prompt_cancel_button' )) {echo get_option( 'pnfpb_ic_fcm_pwa_prompt_cancel_button' );} else { echo __("Cancel",'PNFPB_TD');} ?>"  />
								<br /><br/><p><?php echo __("PWA custom install prompt Button background color",'PNFPB_TD');?></p>
								<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_pwa_prompt_button_background" id="pnfpb_ic_fcm_pwa_prompt_button_background" name="pnfpb_ic_fcm_pwa_prompt_button_background" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_prompt_button_background' )) {echo get_option( 'pnfpb_ic_fcm_pwa_prompt_button_background' ); } else { echo '#ffffff';}?>" required="required" />					
								<br /><br/><p><?php echo __("PWA custom install prompt dialog box background color",'PNFPB_TD');?></p>
								<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_pwa_prompt_dialog_background" id="pnfpb_ic_fcm_pwa_prompt_dialog_background" name="pnfpb_ic_fcm_pwa_prompt_dialog_background" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_prompt_dialog_background' )) {echo get_option( 'pnfpb_ic_fcm_pwa_prompt_dialog_background' ); } else { echo '#ffffff';}?>" required="required" />					
								<br /><br/><p><?php echo __("PWA custom install prompt dialog Text color",'PNFPB_TD');?></p>
								<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_pwa_prompt_text_color" id="pnfpb_ic_fcm_pwa_prompt_text_color" name="pnfpb_ic_fcm_pwa_prompt_text_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_prompt_text_color' )) {echo get_option( 'pnfpb_ic_fcm_pwa_prompt_text_color' ); } else { echo '#161515';}?>" required="required" />
								<br /><br/><p><?php echo __("PWA custom install prompt button Text color",'PNFPB_TD');?></p>
								<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_pwa_prompt_button_text_color" id="pnfpb_ic_fcm_pwa_prompt_button_text_color" name="pnfpb_ic_fcm_pwa_prompt_button_text_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_pwa_prompt_button_text_color' )) {echo get_option( 'pnfpb_ic_fcm_pwa_prompt_button_text_color' ); } else { echo '#161515';}?>" required="required" />
							</div>
					</div>
				</td>
			</tr>			
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb-pwa-dialog-app-installed_text">
						<?php echo __("PWA after installed confirmation popup header text",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb-pwa-dialog-app-installed_text" name="pnfpb-pwa-dialog-app-installed_text" type="text" maxlength="100" value="<?php if (get_option( 'pnfpb-pwa-dialog-app-installed_text' )) {echo get_option( 'pnfpb-pwa-dialog-app-installed_text' );} else { echo __("App installed successfully",PNFPB_TD);} ?>" />					
				</td>
			</tr>			
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb-pwa-dialog-app-installed_text">
						<?php echo __("PWA after installed confirmation popup description",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb-pwa-dialog-app-installed_description" name="pnfpb-pwa-dialog-app-installed_description" type="text" maxlength="500" value="<?php if (get_option( 'pnfpb-pwa-dialog-app-installed_description' )) {echo get_option( 'pnfpb-pwa-dialog-app-installed_description' );} else { echo __("Progressive Web App (PWA) is installed successfully. It will also work in offline",PNFPB_TD);} ?>" />					
				</td>
			</tr>			
			<tr>
				<td>
					<?php
						echo __("<b>All fields marked with '*' are required fields, Please verify before submitting the changes</b>",PNFPB_TD);
					?>
				</td>
			</tr>
			<tr>
				<td>
					<?php
						echo __("<b>Progressive Web Apps are supported by Chrome(Desktop,Mobile) browser, Edge browser, Firefox for android, Opera for android,Edge for Android, Brave for Android and Samsung Interent except Firefox for desktop</b>",PNFPB_TD);
					?>
				</td>
			</tr>
    		<tr>
				<td class="column-columnname">
					<div class="pnfpb_column_full"><?php submit_button(__('Save changes',PNFPB_TD),'pnfpb_ic_push_save_configuration_button'); ?></div>
				</td>
    		</tr>
   		</tbody>
	</table>
</form>
</div>