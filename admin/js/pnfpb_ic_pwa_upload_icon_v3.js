 
/**
* Upload custom icon for pwa app from plugin settings area.
* Customize push notification settings in plugin settings area.
*
* @since 1.20
*/
var $j = jQuery.noConflict();

$j(document).ready(function() {
	
	const { __ } = wp.i18n;
    
	var mediaUploader_132;
	var mediaUploader_512;
	var shortcut1_mediaUploader_132;
	var shortcut1_mediaUploader_512;
	var shortcut2_mediaUploader_132;
	var shortcut2_mediaUploader_512;	
	var mediaUploader_desktop;
	var mediaUploader_mobile;
	var mediaUploader_splashscreen_640_1136;
	var mediaUploader_splashscreen_750_1294;
	var mediaUploader_splashscreen_1242_2148;
	var mediaUploader_splashscreen_1125_2436;
	var mediaUploader_splashscreen_1536_2048;
	var mediaUploader_splashscreen_1668_2224;
	var mediaUploader_splashscreen_2048_2732;
	
  	var pnfpb_hash = window.location.hash;
	
	if (pnfpb_hash && (pnfpb_hash === '#pnfpb-pwa-display' ||  pnfpb_hash === '#pnfpb-pwa-icons' ||   pnfpb_hash === '#pnfpb-pwa-screenshots' ||   pnfpb_hash === '#pnfpb-pwa-splashscreen-ios' ||   pnfpb_hash === '#pnfpb-pwa-cache' ||   pnfpb_hash === '#pnfpb-pwa-custom-prompt' ||   pnfpb_hash === '#pnfpb-pwa-protocol-handler' ||   pnfpb_hash === '#pnfpb-pwa-ios-devices' ||   pnfpb_hash === '#pnfpb-pwa-shortcode')) {
		
		$j('#pnfpb-pwa-tabs > a').removeClass('nav-tab-active');
		$j('.pnfpb-pwa-settings-tab').removeClass('active');
  		$j('.pnfpb-pwa-tabs > a[href="' + pnfpb_hash + '"]').addClass('nav-tab-active');
		var pnfpb_selector_tabs = $j('.pnfpb-pwa-tabs > a[href="' + pnfpb_hash + '"]').attr('href');
		$j(pnfpb_selector_tabs).addClass('active');		
		
	}

	
	$j('#pnfpb_ic_fcm_pwa_upload_button_132').on('click',function(e) {
		e.preventDefault();
		if( mediaUploader_132 ){
			mediaUploader_132.open();
			return;
		}
		
		mediaUploader_132 = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture',"push-notification-for-post-and-buddypress"),
			button: {
				text: __('Select a Picture',"push-notification-for-post-and-buddypress")
			},
			multiple: false
		});
		
		mediaUploader_132.on('select', function(){
			attachment = mediaUploader_132.state().get('selection').first().toJSON();
			var imagewidth = attachment.width;
			var imageheight = attachment.height;
			if (imagewidth === 132 && imageheight === 132){
				$j('#pnfpb_ic_fcm_pwa_upload_preview_132').text('');
				$j('#pnfpb_ic_fcm_pwa_upload_icon_132').val(attachment.url);
				$j('#pnfpb_ic_fcm_pwa_upload_preview_132').css('background-image','url(' + attachment.url + ')');
			}
			else
			{
				$j('#pnfpb_ic_fcm_pwa_upload_preview_132').css('background-image','none');
				$j('#pnfpb_ic_fcm_pwa_upload_preview_132').text('Image size must be 132x132 pixels');
			}
		});
		
		mediaUploader_132.open();
		
	});
	
	$j('#pnfpb_ic_fcm_pwa_upload_button_512').on('click',function(e) {
		e.preventDefault();
		if( mediaUploader_512 ){
			mediaUploader_512.open();
			return;
		}
		
		mediaUploader_512 = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture',"push-notification-for-post-and-buddypress"),
			button: {
				text: __('Select a Picture',"push-notification-for-post-and-buddypress")
			},
			multiple: false
		});
		
		mediaUploader_512.on('select', function(){
			attachment = mediaUploader_512.state().get('selection').first().toJSON();
			var imagewidth = attachment.width;
			var imageheight = attachment.height;
			if (imagewidth === 512 && imageheight === 512){
				$j('#pnfpb_ic_fcm_pwa_upload_preview_512').text('');
				$j('#pnfpb_ic_fcm_pwa_upload_icon_512').val(attachment.url);
				$j('#pnfpb_ic_fcm_pwa_upload_preview_512').css('background-image','url(' + attachment.url + ')');
			}
			else
			{
				$j('#pnfpb_ic_fcm_pwa_upload_preview_512').css('background-image','none');
				$j('#pnfpb_ic_fcm_pwa_upload_preview_512').text('Image size must be 512x512 pixels');	
			}
		});
		
		mediaUploader_512.open();
		
	});
	
	$j('#pnfpb_ic_fcm_pwa_shortcut1_upload_button_132').on('click',function(e) {
		e.preventDefault();
		if( shortcut1_mediaUploader_132 ){
			shortcut1_mediaUploader_132.open();
			return;
		}
		
		shortcut1_mediaUploader_132 = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture',"push-notification-for-post-and-buddypress"),
			button: {
				text: __('Select a Picture',"push-notification-for-post-and-buddypress")
			},
			multiple: false
		});
		
		shortcut1_mediaUploader_132.on('select', function(){
			attachment = shortcut1_mediaUploader_132.state().get('selection').first().toJSON();
			var imagewidth = attachment.width;
			var imageheight = attachment.height;
			if (imagewidth === 132 && imageheight === 132){
				$j('#pnfpb_ic_fcm_pwa_shortcut1_upload_preview_132').text('');
				$j('#pnfpb_ic_fcm_pwa_shortcut1_upload_icon_132').val(attachment.url);
				$j('#pnfpb_ic_fcm_pwa_shortcut1_upload_preview_132').css('background-image','url(' + attachment.url + ')');
			}
			else
			{
				$j('#pnfpb_ic_fcm_pwa_shortcut1_upload_preview_132').css('background-image','none');
				$j('#pnfpb_ic_fcm_pwa_shortcut1_upload_preview_132').text('Image size must be 132x132 pixels');
			}
		});
		
		shortcut1_mediaUploader_132.open();
		
	});
	
	$j('#pnfpb_ic_fcm_pwa_shortcut1_upload_button_512').on('click',function(e) {
		e.preventDefault();
		if( shortcut1_mediaUploader_512 ){
			shortcut1_mediaUploader_512.open();
			return;
		}
		
		shortcut1_mediaUploader_512 = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture',"push-notification-for-post-and-buddypress"),
			button: {
				text: __('Select a Picture',"push-notification-for-post-and-buddypress")
			},
			multiple: false
		});
		
		shortcut1_mediaUploader_512.on('select', function(){
			attachment = shortcut1_mediaUploader_512.state().get('selection').first().toJSON();
			var imagewidth = attachment.width;
			var imageheight = attachment.height;
			if (imagewidth === 512 && imageheight === 512){
				$j('#pnfpb_ic_fcm_pwa_shortcut1_upload_preview_512').text('');
				$j('#pnfpb_ic_fcm_pwa_shortcut1_upload_icon_512').val(attachment.url);
				$j('#pnfpb_ic_fcm_pwa_shortcut1_upload_preview_512').css('background-image','url(' + attachment.url + ')');
			}
			else
			{
				$j('#pnfpb_ic_fcm_pwa_shortcut1_upload_preview_512').css('background-image','none');
				$j('#pnfpb_ic_fcm_pwa_shortcut1_upload_preview_512').text('Image size must be 512x512 pixels');	
			}
		});
		
		shortcut1_mediaUploader_512.open();
		
	});
	
	$j('#pnfpb_ic_fcm_pwa_shortcut2_upload_button_132').on('click',function(e) {
		e.preventDefault();
		if( shortcut2_mediaUploader_132 ){
			shortcut2_mediaUploader_132.open();
			return;
		}
		
		shortcut2_mediaUploader_132 = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture',"push-notification-for-post-and-buddypress"),
			button: {
				text: __('Select a Picture',"push-notification-for-post-and-buddypress")
			},
			multiple: false
		});
		
		shortcut2_mediaUploader_132.on('select', function(){
			attachment = shortcut2_mediaUploader_132.state().get('selection').first().toJSON();
			var imagewidth = attachment.width;
			var imageheight = attachment.height;
			if (imagewidth === 132 && imageheight === 132){
				$j('#pnfpb_ic_fcm_pwa_shortcut2_upload_preview_132').text('');
				$j('#pnfpb_ic_fcm_pwa_shortcut2_upload_icon_132').val(attachment.url);
				$j('#pnfpb_ic_fcm_pwa_shortcut2_upload_preview_132').css('background-image','url(' + attachment.url + ')');
			}
			else
			{
				$j('#pnfpb_ic_fcm_pwa_shortcut2_upload_preview_132').css('background-image','none');
				$j('#pnfpb_ic_fcm_pwa_shortcut2_upload_preview_132').text('Image size must be 132x132 pixels');
			}
		});
		
		shortcut2_mediaUploader_132.open();
		
	});
	
	$j('#pnfpb_ic_fcm_pwa_shortcut2_upload_button_512').on('click',function(e) {
		e.preventDefault();
		if( shortcut2_mediaUploader_512 ){
			shortcut2_mediaUploader_512.open();
			return;
		}
		
		shortcut2_mediaUploader_512 = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture',"push-notification-for-post-and-buddypress"),
			button: {
				text: __('Select a Picture',"push-notification-for-post-and-buddypress")
			},
			multiple: false
		});
		
		shortcut2_mediaUploader_512.on('select', function(){
			attachment = shortcut2_mediaUploader_512.state().get('selection').first().toJSON();
			var imagewidth = attachment.width;
			var imageheight = attachment.height;
			if (imagewidth === 512 && imageheight === 512){
				$j('#pnfpb_ic_fcm_pwa_shortcut2_upload_preview_512').text('');
				$j('#pnfpb_ic_fcm_pwa_shortcut2_upload_icon_512').val(attachment.url);
				$j('#pnfpb_ic_fcm_pwa_shortcut2_upload_preview_512').css('background-image','url(' + attachment.url + ')');
			}
			else
			{
				$j('#pnfpb_ic_fcm_pwa_shortcut2_upload_preview_512').css('background-image','none');
				$j('#pnfpb_ic_fcm_pwa_shortcut2_upload_preview_512').text('Image size must be 512x512 pixels');	
			}
		});
		
		shortcut2_mediaUploader_512.open();
		
	});	
	
	$j('#pnfpb_ic_fcm_pwa_upload_screenshot_desktop').on('click',function(e) {
		e.preventDefault();
		if( mediaUploader_desktop ){
			mediaUploader_desktop.open();
			return;
		}
		
		mediaUploader_desktop = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture',"push-notification-for-post-and-buddypress"),
			button: {
				text: __('Select a Picture',"push-notification-for-post-and-buddypress")
			},
			multiple: false
		});
		
		mediaUploader_desktop.on('select', function(){
			attachment = mediaUploader_desktop.state().get('selection').first().toJSON();
			var imagewidth = attachment.width;
			var imageheight = attachment.height;
			$j('#pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value_preview').text('');
			$j('#pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value').val(attachment.url);
			$j('#pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value_preview').css('background-image','url(' + attachment.url + ')');
		});
		
		mediaUploader_desktop.open();
		
	});
	
	$j('#pnfpb_ic_fcm_pwa_upload_screenshot_mobile').on('click',function(e) {
		e.preventDefault();
		if( mediaUploader_mobile ){
			mediaUploader_mobile.open();
			return;
		}
		
		mediaUploader_mobile = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture',"push-notification-for-post-and-buddypress"),
			button: {
				text: __('Select a Picture',"push-notification-for-post-and-buddypress")
			},
			multiple: false
		});
		
		mediaUploader_mobile.on('select', function(){
			attachment = mediaUploader_mobile.state().get('selection').first().toJSON();
			var imagewidth = attachment.width;
			var imageheight = attachment.height;
			$j('#pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value_preview').text('');
			$j('#pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value').val(attachment.url);
			$j('#pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value_preview').css('background-image','url(' + attachment.url + ')');
		});
		
		mediaUploader_mobile.open();
		
	});
	
	$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136').on('click',function(e) {
		e.preventDefault();
		if( mediaUploader_splashscreen_640_1136 ){
			mediaUploader_splashscreen_640_1136.open();
			return;
		}
		
		mediaUploader_splashscreen_640_1136 = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture',"push-notification-for-post-and-buddypress"),
			button: {
				text: __('Select a Picture',"push-notification-for-post-and-buddypress")
			},
			multiple: false
		});
		
		mediaUploader_splashscreen_640_1136.on('select', function(){
			attachment = mediaUploader_splashscreen_640_1136.state().get('selection').first().toJSON();
			var imagewidth = attachment.width;
			var imageheight = attachment.height;
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value_preview').text('');
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value').val(attachment.url);
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_640_1136_value_preview').css('background-image','url(' + attachment.url + ')');
		});
		
		mediaUploader_splashscreen_640_1136.open();
		
	});	
	
	$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294').on('click',function(e) {
		e.preventDefault();
		if( mediaUploader_splashscreen_750_1294 ){
			mediaUploader_splashscreen_750_1294.open();
			return;
		}
		
		mediaUploader_splashscreen_750_1294 = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture',"push-notification-for-post-and-buddypress"),
			button: {
				text: __('Select a Picture',"push-notification-for-post-and-buddypress")
			},
			multiple: false
		});
		
		mediaUploader_splashscreen_750_1294.on('select', function(){
			attachment = mediaUploader_splashscreen_750_1294.state().get('selection').first().toJSON();
			var imagewidth = attachment.width;
			var imageheight = attachment.height;
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value_preview').text('');
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value').val(attachment.url);
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_750_1294_value_preview').css('background-image','url(' + attachment.url + ')');
		});
		
		mediaUploader_splashscreen_750_1294.open();
		
	});	
	
	$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148').on('click',function(e) {
		e.preventDefault();
		if( mediaUploader_splashscreen_1242_2148 ){
			mediaUploader_splashscreen_1242_2148.open();
			return;
		}
		
		mediaUploader_splashscreen_1242_2148 = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture',"push-notification-for-post-and-buddypress"),
			button: {
				text: __('Select a Picture',"push-notification-for-post-and-buddypress")
			},
			multiple: false
		});
		
		mediaUploader_splashscreen_1242_2148.on('select', function(){
			attachment = mediaUploader_splashscreen_1242_2148.state().get('selection').first().toJSON();
			var imagewidth = attachment.width;
			var imageheight = attachment.height;
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value_preview').text('');
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value').val(attachment.url);
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_1242_2148_value_preview').css('background-image','url(' + attachment.url + ')');
		});
		
		mediaUploader_splashscreen_1242_2148.open();
		
	});	
	
	$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436').on('click',function(e) {
		e.preventDefault();
		if( mediaUploader_splashscreen_1125_2436 ){
			mediaUploader_splashscreen_1125_2436.open();
			return;
		}
		
		mediaUploader_splashscreen_1125_2436 = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture',"push-notification-for-post-and-buddypress"),
			button: {
				text: __('Select a Picture',"push-notification-for-post-and-buddypress")
			},
			multiple: false
		});
		
		mediaUploader_splashscreen_1125_2436.on('select', function(){
			attachment = mediaUploader_splashscreen_1125_2436.state().get('selection').first().toJSON();
			var imagewidth = attachment.width;
			var imageheight = attachment.height;
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_value_preview').text('');
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_value').val(attachment.url);
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_1125_2436_value_preview').css('background-image','url(' + attachment.url + ')');
		});
		
		mediaUploader_splashscreen_1125_2436.open();
		
	});	
	
	$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048').on('click',function(e) {
		e.preventDefault();
		if( mediaUploader_splashscreen_1536_2048 ){
			mediaUploader_splashscreen_1536_2048.open();
			return;
		}
		
		mediaUploader_splashscreen_1536_2048 = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture',"push-notification-for-post-and-buddypress"),
			button: {
				text: __('Select a Picture',"push-notification-for-post-and-buddypress")
			},
			multiple: false
		});
		
		mediaUploader_splashscreen_1536_2048.on('select', function(){
			attachment = mediaUploader_splashscreen_1536_2048.state().get('selection').first().toJSON();
			var imagewidth = attachment.width;
			var imageheight = attachment.height;
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_value_preview').text('');
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_value').val(attachment.url);
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_1536_2048_value_preview').css('background-image','url(' + attachment.url + ')');
		});
		
		mediaUploader_splashscreen_1536_2048.open();
		
	});	
	
	$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224').on('click',function(e) {
		e.preventDefault();
		if( mediaUploader_splashscreen_1668_2224 ){
			mediaUploader_splashscreen_1668_2224.open();
			return;
		}
		
		mediaUploader_splashscreen_1668_2224 = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture',"push-notification-for-post-and-buddypress"),
			button: {
				text: __('Select a Picture',"push-notification-for-post-and-buddypress")
			},
			multiple: false
		});
		
		mediaUploader_splashscreen_1668_2224.on('select', function(){
			attachment = mediaUploader_splashscreen_1668_2224.state().get('selection').first().toJSON();
			var imagewidth = attachment.width;
			var imageheight = attachment.height;
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_value_preview').text('');
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_value').val(attachment.url);
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_1668_2224_value_preview').css('background-image','url(' + attachment.url + ')');
		});
		
		mediaUploader_splashscreen_1668_2224.open();
		
	});	
	
	$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732').on('click',function(e) {
		e.preventDefault();
		if( mediaUploader_splashscreen_2048_2732 ){
			mediaUploader_splashscreen_2048_2732.open();
			return;
		}
		
		mediaUploader_splashscreen_2048_2732 = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture',"push-notification-for-post-and-buddypress"),
			button: {
				text: __('Select a Picture',"push-notification-for-post-and-buddypress")
			},
			multiple: false
		});
		
		mediaUploader_splashscreen_2048_2732.on('select', function(){
			attachment = mediaUploader_splashscreen_2048_2732.state().get('selection').first().toJSON();
			var imagewidth = attachment.width;
			var imageheight = attachment.height;
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_value_preview').text('');
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_value').val(attachment.url);
			$j('#pnfpb_ic_fcm_pwa_upload_splashscreen_2048_2732_value_preview').css('background-image','url(' + attachment.url + ')');
		});
		
		mediaUploader_splashscreen_2048_2732.open();
		
	});
	
    if (window.location.hash) {
        var pnfpb_hash = window.location.hash;
        $j('html, body').animate({
            scrollTop :  $j(pnfpb_hash).offset().top
        }, 500);
    };
	
	
    $j("#pnfpb-pwa-category-tabs > a").on('click touchstart', function(event){
            event.preventDefault();
            event.stopPropagation();

            if( $j(this).hasClass('nav-tab-active') ) return false;
		
            var pnfpb_selector_category_tabs = $j(this).attr('href');
            window.history.pushState("", "", pnfpb_selector_category_tabs);

            $j('#pnfpb-pwa-category-tabs > a').removeClass('nav-tab-active');
            $j('.pnfpb-category-pwa-settings-tab').removeClass('active');

            $j(this).addClass('nav-tab-active');
            $j(pnfpb_selector_category_tabs).addClass('active');
    });
	
    $j("#pnfpb-pwa-tabs > a").on('click touchstart', function(event){
            event.preventDefault();
            event.stopPropagation();

            if( $j(this).hasClass('nav-tab-active') ) return false;

            var pnfpb_selector_tabs = $j(this).attr('href');
            window.history.pushState("", "", pnfpb_selector_tabs);

            $j('#pnfpb-pwa-tabs > a').removeClass('nav-tab-active');
            $j('.pnfpb-pwa-settings-tab').removeClass('active');

            $j(this).addClass('nav-tab-active');
            $j(pnfpb_selector_tabs).addClass('active');
    });
	
	var pnfpb_protocol_handler_pwa_counter = 1;
	
	$j('.pnfpb_pwa_card_protocol_root').each(function () {
		
    	pnfpb_protocol_handler_pwa_counter++;
		
	});
	
	$j(".pnfpb_ic_push_add_protocol_button").on('click touchstart', function(event) {
		
            event.preventDefault();
            event.stopPropagation();
			
			$j('.pnfpb_ic_pwa_protocol-handler-list').append('<div class="pnfpb_ic_pwa_protocol"><label class="pnfpb_ic_pwa_protocol-handler-element" for="pnfpb_ic_pwa_protocol-name"><b>'+__("Protocol handler ","push-notification-for-post-and-buddypress")+'<span>'+pnfpb_protocol_handler_pwa_counter+'</span></b></label><div class="pnfpb_ic_push_remove_protocol_button_divider"><input type="button" name="pnfpb_ic_push_remove_protocol_button" id="pnfpb_ic_push_remove_protocol_button" class="button pnfpb_ic_push_remove_protocol_button" value="'+__("Delete","push-notification-for-post-and-buddypress")+'"></div><div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname pnfpb_pwa_card_protocol_root"><div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname pnfpb_pwa_card_protocol_child"><label for="pnfpb_ic_pwa_protocol-name">'+__("Protocol","push-notification-for-post-and-buddypress")+'</label><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_protocol_name" name="pnfpb_ic_pwa_protocol_name[]" placeholder="web+jnglstore" type="text" value="" /></div><div class="pnfpb_ic_push_pwa_settings_table_value_column column-columnname pnfpb_pwa_card_protocol_child"><label for="pnfpb_ic_pwa_protocol-url">'+ __("Url","push-notification-for-post-and-buddypress")+'</label><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_pwa_protocol_url" name="pnfpb_ic_pwa_protocol_url[]" placeholder="/shop?for=%s"  type="text" value="" /></div></div></div>');
		
			pnfpb_protocol_handler_pwa_counter++;
		
	});

	$j(document).on('click touchstart', ".pnfpb_ic_push_remove_protocol_button" ,function(event) {
		
            event.preventDefault();
            event.stopPropagation();

			
			$j(this).closest(".pnfpb_ic_pwa_protocol").remove();
		
			pnfpb_protocol_handler_pwa_counter = pnfpb_protocol_handler_pwa_counter-1;
		
			var pnfpb_pwa_protocol_element_counter = 1;
		
			$j('.pnfpb_ic_pwa_protocol-handler-element').each(function () {
				
    			$j(this).find('span').html(pnfpb_pwa_protocol_element_counter);
				
    			pnfpb_pwa_protocol_element_counter++;
				
			});
		
	
	});

	$j('.pnfpb_admin_notice > .notice-dismiss').on('click',function() {
		
		
		var data = {
			action: 'icpushadmincallback'
		};
								
		$j.post(pnfpb_ajax_object_pwa_upload_icon.ajax_url, data, function(response) {
			
			$j('.pnfpb_admin_notice .is-dismissable').hide();
			
		});
		
		
		
	});
		
	
});

	function toggle_post_type_content_form() {
		
		const { __ } = wp.i18n;
		
  		$j('.pnfpb_ic_post_type_content_form').toggle();
		
		if ($j('.pnfpb_ic_post_type_content_form').is(':visible')) {
			
			$j('.pnfpb_post_type_content_button').text(__('Hide form',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_post_type_content_button').text(__('Customize',"push-notification-for-post-and-buddypress"));
		}		
	}


	function toggle_activity_content_form() {
		
		const { __ } = wp.i18n;
		
  		$j('.pnfpb_ic_activity_content_form').toggle();
		
		if ($j('.pnfpb_ic_activity_content_form').is(':visible')) {
			
			$j('.pnfpb_activity_form_button').text(__('Hide form',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_activity_form_button').text(__('Customize',"push-notification-for-post-and-buddypress"));
		}		
	}

	function toggle_comments_content_form() {
		
		const { __ } = wp.i18n;

		$j('.pnfpb_ic_comments_content_form').toggle();
		
		if ($j('.pnfpb_ic_comments_content_form').is(':visible')) {
			
			$j('.pnfpb_comments_content_button').text(__('Hide form',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_comments_content_button').text(__('Customize',"push-notification-for-post-and-buddypress"));
		}		
	}

	function toggle_private_message_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_private_message_form').toggle();
		
		if ($j('.pnfpb_ic_private_message_form').is(':visible')) {
			
			$j('.pnfpb_private_message_button').text(__('Hide form',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_private_message_button').text(__('Customize',"push-notification-for-post-and-buddypress"));
		}
		
	}

	function toggle_new_member_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_new_member_form').toggle();
		
		if ($j('.pnfpb_ic_new_member_form').is(':visible')) {
			
			$j('.pnfpb_new_member_button').text(__('Hide form',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_new_member_button').text(__('Customize',"push-notification-for-post-and-buddypress"));
		}
		
	}

	function toggle_friendship_request_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_friendship_request_form').toggle();
		
		if ($j('.pnfpb_ic_friendship_request_form').is(':visible')) {
			
			$j('.pnfpb_friendship_request_button').text(__('Hide form',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_friendship_request_button').text(__('Customize',"push-notification-for-post-and-buddypress"));
		}
		
	}


	function toggle_friendship_accept_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_friendship_accept_form').toggle();
		
		if ($j('.pnfpb_ic_friendship_accept_form').is(':visible')) {
			
			$j('.pnfpb_friendship_accept_button').text(__('Hide form',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_friendship_accept_button').text(__('Customize',"push-notification-for-post-and-buddypress"));
		}
		
	}


	function toggle_avatar_change_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_avatar_change_form').toggle();
		
		if ($j('.pnfpb_ic_avatar_change_form').is(':visible')) {
			
			$j('.pnfpb_avatar_change_button').text(__('Hide form',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_avatar_change_button').text(__('Customize',"push-notification-for-post-and-buddypress"));
		}
		
	}

	function toggle_cover_image_change_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_cover_image_change_form').toggle();
		
		if ($j('.pnfpb_ic_cover_image_change_form').is(':visible')) {
			
			$j('.pnfpb_cover_image_change_button').text(__('Hide form',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_cover_image_change_button').text(__('Customize',"push-notification-for-post-and-buddypress"));
		}
		
	}


	function toggle_group_invitation_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_group_invitation_form').toggle();
		
		if ($j('.pnfpb_ic_group_invitation_form').is(':visible')) {
			
			$j('.pnfpb_group_invitation_button').text(__('Hide form',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_group_invitation_button').text(__('Customize',"push-notification-for-post-and-buddypress"));
		}
		
	}


	function toggle_group_details_updated_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_group_details_updated_form').toggle();
		
		if ($j('.pnfpb_ic_group_details_updated_form').is(':visible')) {
			
			$j('.pnfpb_group_details_updated_button').text(__('Hide form',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_group_details_updated_button').text(__('Customize',"push-notification-for-post-and-buddypress"));
		}
		
	}

	function toggle_new_user_registration_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_new_user_registration_form').toggle();
		
		if ($j('.pnfpb_ic_new_user_registration_form').is(':visible')) {
			
			$j('.pnfpb_new_user_registration_button').text(__('Hide form',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_new_user_registration_button').text(__('Customize',"push-notification-for-post-and-buddypress"));
		}
		
	}

	function toggle_contact_form7_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_contact_form7_form').toggle();
		
		if ($j('.pnfpb_ic_contact_form7_form').is(':visible')) {
			
			$j('.pnfpb_contact_form7_button').text(__('Hide form',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_contact_form7_button').text(__('Customize',"push-notification-for-post-and-buddypress"));
		}
		
	}

	function toggle_mark_favourite_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_mark_favourite_form').toggle();
		
		if ($j('.pnfpb_ic_mark_favourite_form').is(':visible')) {
			
			$j('.pnfpb_mark_favourite_button').text(__('Hide form',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_mark_favourite_button').text(__('Customize',"push-notification-for-post-and-buddypress"));
		}
		
	}

    $j("#pnfpb-config-tabs > a").on('click touchstart', function(event){
            event.preventDefault();
            event.stopPropagation();

            if( $j(this).hasClass('nav-tab-active') ) return false;

            var pnfpb_config_selector_tabs = $j(this).attr('href');
            window.history.pushState("", "", pnfpb_config_selector_tabs);

            $j('#pnfpb-config-tabs > a').removeClass('nav-tab-active');
            $j('.pnfpb_config_tab_content').removeClass('active');

            $j(this).addClass('nav-tab-active');
            $j(pnfpb_config_selector_tabs).addClass('active');
    });

	function toggle_onesignal_configuration() {
		
		const { __ } = wp.i18n;
		
  		$j('.pnfpb_ic_onesignal_configuration').toggle();
		
		if ($j('.pnfpb_ic_onesignal_configuration').is(':visible')) {
			
			$j('.pnfpb_ic_firebase_configuration').hide();
			
			$j('.pnfpb_ic_progressier_configuration').hide();
			
			$j('.pnfpb_ic_webtoapp_configuration').hide();
			
			$j('.pnfpb_ic_firebase_configuration_button').text(__('Firebase configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_onesignal_configuration_button').text(__('Onesignal configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_progressier_configuration_button').text(__('Progressier configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_webtoapp_configuration_button').text(__('Webtoapp.design configuration',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_ic_firebase_configuration').show();
			
			$j('.pnfpb_ic_firebase_configuration_button').text(__('Firebase configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_onesignal_configuration_button').text(__('Onesignal configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_progressier_configuration_button').text(__('Progressier configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_webtoapp_configuration_button').text(__('Webtoapp.design configuration',"push-notification-for-post-and-buddypress"));
			
		}	
		
	}

	function toggle_progressier_configuration() {
		
		const { __ } = wp.i18n;
		
  		$j('.pnfpb_ic_progressier_configuration').toggle();
		
		if ($j('.pnfpb_ic_progressier_configuration').is(':visible')) {
			
			$j('.pnfpb_ic_firebase_configuration').hide();
			
			$j('.pnfpb_ic_onesignal_configuration').hide();
			
			$j('.pnfpb_ic_webtoapp_configuration').hide();
			
			$j('.pnfpb_ic_firebase_configuration_button').text(__('Firebase configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_onesignal_configuration_button').text(__('Onesignal configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_progressier_configuration_button').text(__('Progressier configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_webtoapp_configuration_button').text(__('Webtoapp.design configuration',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_ic_firebase_configuration').show();
			
			$j('.pnfpb_ic_firebase_configuration_button').text(__('Firebase configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_onesignal_configuration_button').text(__('Onesignal configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_progressier_configuration_button').text(__('Progressier configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_webtoapp_configuration_button').text(__('Webtoapp.design configuration',"push-notification-for-post-and-buddypress"));
			
		}	
		
	}

	function toggle_webtoapp_configuration() {
		
		const { __ } = wp.i18n;
		
  		$j('.pnfpb_ic_webtoapp_configuration').toggle();
		
		if ($j('.pnfpb_ic_webtoapp_configuration').is(':visible')) {
			
			$j('.pnfpb_ic_firebase_configuration').hide();
			
			$j('.pnfpb_ic_onesignal_configuration').hide();
			
			$j('.pnfpb_ic_progressier_configuration').hide();
			
			$j('.pnfpb_ic_firebase_configuration_button').text(__('Firebase configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_onesignal_configuration_button').text(__('Onesignal configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_progressier_configuration_button').text(__('Progressier configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_webtoapp_configuration_button').text(__('Webtoapp.design configuration',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_ic_firebase_configuration').show();
			
			$j('.pnfpb_ic_firebase_configuration_button').text(__('Firebase configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_onesignal_configuration_button').text(__('Onesignal configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_progressier_configuration_button').text(__('Progressier configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_webtoapp_configuration_button').text(__('Webtoapp.design configuration',"push-notification-for-post-and-buddypress"));
			
		}	
		
	}


	function toggle_firebase_configuration() {
		
		const { __ } = wp.i18n;
		
  		$j('.pnfpb_ic_firebase_configuration').toggle();
		
		
		if ($j('.pnfpb_ic_firebase_configuration').is(':visible')) {
			
			$j('.pnfpb_ic_onesignal_configuration').hide();
			
			$j('.pnfpb_ic_progressier_configuration').hide();
			
			$j('.pnfpb_ic_webtoapp_configuration').hide();
			
			$j('.pnfpb_ic_onesignal_configuration_button').text(__('Onesignal configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_firebase_configuration_button').text(__('Firebase configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_progressier_configuration_button').text(__('Progressier configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_webtoapp_configuration_button').text(__('Webtoapp.design configuration',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_ic_onesignal_configuration').show();
			
			$j('.pnfpb_ic_onesignal_configuration_button').text(__('Onesignal configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_firebase_configuration_button').text(__('Firebase configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_progressier_configuration_button').text(__('Progressier configuration',"push-notification-for-post-and-buddypress"));
			
			$j('.pnfpb_ic_webtoapp_configuration_button').text(__('Webtoapp.design configuration',"push-notification-for-post-and-buddypress"));
		}	
		
	}

	function toggle_firebase_configuration_help() {
		
		const { __ } = wp.i18n;
		
  		$j('.pnfpb_ic_firebase_configuration_help').toggle();
		
		if ($j('.pnfpb_ic_firebase_configuration_help').is(':hidden')) {
			
			$j('.pnfpb_ic_firebase_configuration_help_button').html(__('Tutorial on Firebase',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_ic_firebase_configuration_help_button').html(__('Hide Firebase Tutorial',"push-notification-for-post-and-buddypress"));
		}	
		
	}

	function toggle_custom_push_prompt_form() {
		
		const { __ } = wp.i18n;
		
  		$j('.pnfpb_ic_push_prompt_form').toggle();
		
		if ($j('.pnfpb_ic_push_prompt_form').is(':visible')) {
			
			$j('.pnfpb_custom_push_prompt_button').text(__('Hide form',"push-notification-for-post-and-buddypress"));
			
		}
		else
		{
			$j('.pnfpb_custom_push_prompt_button').text(__('Customize',"push-notification-for-post-and-buddypress"));
		}		
	}
