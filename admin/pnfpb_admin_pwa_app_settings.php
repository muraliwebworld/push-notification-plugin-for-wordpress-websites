<?php
/**
* Plugin settings area to generate Progressive Web App with offline mode facility
*
* @since 1.20
*/
?>

<h2 class="nav-tab-wrapper"><a href="options-general.php?page=pnfpb-icfcm-slug" class="nav-tab">Push notification</a><a href="options-general.php?page=pnfpb_icfm_device_tokens_list" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER);?></a><a href="options-general.php?page=pnfpb_icfm_pwa_app_settings" class="nav-tab nav-tab-active"><?php echo __(PNFPB_PLUGIN_NM_PWA_HEADER);?></a><a href="options-general.php?page=pnfpb_icfmtest_notification" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_ONDEMANDPUSH_HEADER);?></a><a href="options-general.php?page=pnfpb_icfm_button_settings" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_BUTTON_HEADER);?></a><a href="options-general.php?page=pnfpb_icfm_integrate_app" class="nav-tab"><?php echo 'Integrate app API';?></a></h2>

<h1 class="pnfpb_ic_push_settings_header"><?php echo __(PNFPB_PLUGIN_NM_PWA_SETTINGS,PNFPB_TD);?></h1>

<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
	
    <?php settings_fields( 'pnfpb_icfcm_pwa'); ?>
    <?php do_settings_sections( 'pnfpb_icfcm_pwa' ); ?>
	
	<h2 class="pnfpb_ic_push_pwa_settings_header2">
		<?php echo __(PNFPB_PLUGIN_PWA_SETTINGS,PNFPB_TD);?>
	</h2>
	<ul>
		<li><?php echo __(PNFPB_PLUGIN_PWA_SETTINGS_DESCRIPTION);?></li>
	</ul>
	<table class="pnfpb_ic_push_settings_table widefat fixed">
    	<tbody>
			<tr>
				<td>
					<b>Activate/deactivate PWA app</b>
				</td>
			</tr>		
			<tr class="pnfpb_ic_push_settings_table_row">
				<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_enable">
						<?php echo __("Enable/Disable<br/>PWA-Progressive web app*",'PNFPB_TD');?>
					</label>
					<input  id="pnfpb_ic_pwa_app_enable" name="pnfpb_ic_pwa_app_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_pwa_app_enable' ) ); ?>  />					
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
						<option value="standalone" <?php if (get_option( 'pnfpb_ic_pwa_app_backgroundcolor' ) === 'standalone'){ echo 'selected';} else {echo '';} ?>>standalone</option>
						<option value="fullscreen" <?php if (get_option( 'pnfpb_ic_pwa_app_backgroundcolor' ) === 'fullscreen'){ echo 'selected';} else {echo '';} ?>>fullscreen</option>
						<option value="minimal-ui" <?php if (get_option( 'pnfpb_ic_pwa_app_backgroundcolor' ) === 'minimal-ui'){ echo 'selected';} else {echo '';} ?>>minimal-ui</option>
						<option value="browser" <?php if (get_option( 'pnfpb_ic_pwa_app_backgroundcolor' ) === 'browser'){ echo 'selected';} else {echo '';} ?>>browser</option>
					</select>					
				</td>
			</tr>
			<tr><td><b>PWA icon size must be exactly as specified below for icon1 and icon2(132x132 and 512x512) otherwise it will use default plugin icons</b></td></tr>			
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_pwa_upload_icon_132">
						<?php echo __("PWA Icon1*<br/>( Must be 132x132 pixels)",PNFPB_TD);?>
					</label>
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">				
            		<table>
						<tr>
                			<td class="column-columnname">
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
					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_pwa_upload_icon_512">
						<?php echo __(" PWA Icon2*<br/>( Must be 512x512 pixels)",PNFPB_TD);?>
					</label>
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">	
            		<table>
						<tr>
                			<td class="column-columnname">
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
				</td>
			</tr>
			<tr><td><b>Below options are for offline facility for PWA - web app</b></td></tr>
			<tr><td><b>Home page url to be cached for offline use(*required)</b></td></tr>
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
		echo '<option value="' . get_home_url() . '"'.$homeurlselected.'> Home page</option>';	        		
		foreach( $pages as $page ){
			echo '<option value="' . get_page_link( $page->ID ) . '" ' . selected( get_page_link( $page->ID ), get_option( 'pnfpb_ic_pwa_app_offline_url1' ) ) . '>' . $page->post_title . '</option>';						
       	}
    }
	?>
				</select>
				</td>
			</tr>
			<tr><td><b>Default url for offline if page is not available in cache(*required)</b></td></tr>
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
						echo '<option value="' . get_home_url() . '"'.$homeurlselected.'> Home page</option>';	        		
						foreach( $pages as $page ){
						echo '<option value="' . get_page_link( $page->ID ) . '" ' . selected( get_page_link( $page->ID ), get_option( 'pnfpb_ic_pwa_app_offline_url2' ) ) . '>' . $page->post_title . '</option>';						
       					}
    				}
					?>
				</select>					
				</td>
			</tr>
			<tr><td><b>Other extra pages to be cached for offline use/to be stored in cache(Optional)</b></td></tr>
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
			<tr class="pnfpb_ic_push_settings_table_row">
				<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_excludeallurls">
						<?php echo __("Exclude all Urls from PWA offline cache<br/>(except offline page selected above)",'PNFPB_TD');?>
					</label>
					<input  id="pnfpb_ic_pwa_app_excludeallurls" name="pnfpb_ic_pwa_app_excludeallurls" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_pwa_app_excludeallurls' ) ); ?>  />				
				</td>
			</tr>			
			<tr><td><b>List of urls to be excluded from offline cache separted by comma. Please note that enter list of urls to be excluded separated with comma</b></td></tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_excludeurls">
						<?php echo __("List of urls to be excluded from cache separated by comma",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_app_excludeurls" name="pnfpb_ic_pwa_app_excludeurls" type="text" value="<?php if (get_option( 'pnfpb_ic_pwa_app_excludeurls' )) {echo get_option( 'pnfpb_ic_pwa_app_excludeurls' );}?>" />					
				</td>
			</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
				<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_custom_prompt_enable">
						<?php echo __("Enable/Disable<br/>PWA custom prompt install*",'PNFPB_TD');?>
					</label>
					<input  id="pnfpb_ic_pwa_app_custom_prompt_enable" name="pnfpb_ic_pwa_app_custom_prompt_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_pwa_app_custom_prompt_enable' ) ); ?>  />
					<br />
					<label for="pnfpb_ic_pwa_app_custom_prompt_popup">
						<?php echo __("POPUP type prompt ",'PNFPB_TD');?>
					</label>
					
					<input  id="pnfpb_ic_pwa_app_custom_prompt_popup" name="pnfpb_ic_pwa_app_custom_prompt_type" type="radio" value="1" <?php checked( '1', get_option( 'pnfpb_ic_pwa_app_custom_prompt_type' ) ); ?>  />
					
					<label for="pnfpb_ic_pwa_app_custom_prompt_snackbar">
						<?php echo __("Snackbar type prompt",'PNFPB_TD');?>
					</label>
					
					<input  id="pnfpb_ic_pwa_app_custom_prompt_snackbar" name="pnfpb_ic_pwa_app_custom_prompt_type" type="radio" value="2" <?php checked( '2', get_option( 'pnfpb_ic_pwa_app_custom_prompt_type' ) ); ?>  />					
					
				</td>
			</tr>			
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_prompt_header_text">
						<?php echo __("PWA Install prompt popup header text<br/> (max 50 characters)",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_prompt_header_text" name="pnfpb_ic_pwa_prompt_header_text" type="text" maxlength="50" value="<?php if (get_option( 'pnfpb_ic_pwa_prompt_header_text' )) {echo get_option( 'pnfpb_ic_pwa_prompt_header_text' );} else { echo "Install PWA app";} ?>" />					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_prompt_description">
						<?php echo __("PWA Install prompt popup App description",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_prompt_description" name="pnfpb_ic_pwa_prompt_description" type="text" maxlength="50" value="<?php if (get_option( 'pnfpb_ic_pwa_prompt_description' )) {echo get_option( 'pnfpb_ic_pwa_prompt_description' );} else { echo "Install our PWA app with offline functionality";} ?>"  />					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_prompt_install_button_text">
						<?php echo __("PWA Install popup install button text*",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_prompt_install_button_text" name="pnfpb_ic_pwa_prompt_install_button_text" type="text" maxlength="80" value="<?php if (get_option( 'pnfpb_ic_pwa_prompt_install_button_text' )) {echo get_option( 'pnfpb_ic_pwa_prompt_install_button_text' );} else { echo "Install PWA";} ?>"  />					
				</td>
			</tr>			
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_prompt_install_button_color">
						<?php echo __("PWA prompt install button background color",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_pwa_prompt_install_button_color pnfpb_ic_push_pwa_color" id="pnfpb_ic_pwa_prompt_install_button_color" name="pnfpb_ic_pwa_prompt_install_button_color" type="color" value="<?php if (get_option( 'pnfpb_ic_pwa_prompt_install_button_color' )) {echo get_option( 'pnfpb_ic_pwa_prompt_install_button_color' ); } else { echo '#ff0000';}?>" required="required" />					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_prompt_install_text_color">
						<?php echo __("PWA prompt install button text color",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_pwa_prompt_install_text_color pnfpb_ic_push_pwa_color" id="pnfpb_ic_pwa_prompt_install_text_color" name="pnfpb_ic_pwa_prompt_install_text_color" type="color" value="<?php if (get_option( 'pnfpb_ic_pwa_prompt_install_text_color' )) {echo get_option( 'pnfpb_ic_pwa_prompt_install_text_color' ); } else { echo '#ffffff';}?>"  />					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb-pwa-dialog-app-installed_text">
						<?php echo __("PWA after installed confirmation popup header text",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb-pwa-dialog-app-installed_text" name="pnfpb-pwa-dialog-app-installed_text" type="text" maxlength="100" value="<?php if (get_option( 'pnfpb-pwa-dialog-app-installed_text' )) {echo get_option( 'pnfpb-pwa-dialog-app-installed_text' );} else { echo "App installed successfully";} ?>" />					
				</td>
			</tr>			
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb-pwa-dialog-app-installed_text">
						<?php echo __("PWA after installed confirmation popup description",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb-pwa-dialog-app-installed_description" name="pnfpb-pwa-dialog-app-installed_description" type="text" maxlength="500" value="<?php if (get_option( 'pnfpb-pwa-dialog-app-installed_description' )) {echo get_option( 'pnfpb-pwa-dialog-app-installed_description' );} else { echo "Progressive Web App (PWA) is installed successfully. It will also work in offline";} ?>" />					
				</td>
			</tr>			
			<tr><td><b>All fields marked with "*" are required fields, Please verify before submitting the changes</b></td></tr>
			<tr><td><b>Progressive Web Apps are supported by Chrome(Desktop,Mobile) browser, Edge browser, Firefox for android, Opera for android,Edge for Android, Brave for Android and Samsung Interent except Firefox for desktop</b></td></tr>
    		<tr>
				<td class="column-columnname"> <div class="col-sm-10"><?php submit_button(); ?></div></td>
    		</tr>
   		</tbody>
	</table>
</form>