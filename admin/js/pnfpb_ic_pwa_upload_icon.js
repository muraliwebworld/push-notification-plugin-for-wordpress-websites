 
/**
* Upload custom icon for pwa app from plugin settings area.
* Customize push notification settings in plugin settings area.
*
* @since 1.20
*/
var $j = jQuery.noConflict();

$j(document).ready(function() {
    
	var mediaUploader_132;
	var mediaUploader_512;
	
	$j('#pnfpb_ic_fcm_pwa_upload_button_132').on('click',function(e) {
		e.preventDefault();
		if( mediaUploader_132 ){
			mediaUploader_132.open();
			return;
		}
		
		mediaUploader_132 = wp.media.frames.file_frame = wp.media({
			title: 'Select a Picture',
			button: {
				text: 'Select Picture'
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
			title: 'Select a Picture',
			button: {
				text: 'Select Picture'
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
	
});

	function toggle_activity_content_form() {
		
  		$j('.pnfpb_ic_activity_content_form').toggle();
		
		if ($j('.pnfpb_ic_activity_content_form').is(':visible')) {
			
			$j('.pnfpb_activity_form_button').text('Hide form');
			
		}
		else
		{
			$j('.pnfpb_activity_form_button').text('Customize');
		}		
	}

	function toggle_comments_content_form() {

		$j('.pnfpb_ic_comments_content_form').toggle();
		
		if ($j('.pnfpb_ic_comments_content_form').is(':visible')) {
			
			$j('.pnfpb_comments_content_button').text('Hide form');
			
		}
		else
		{
			$j('.pnfpb_comments_content_button').text('Customize');
		}		
	}

	function toggle_private_message_form() {
	
  		$j('.pnfpb_ic_private_message_form').toggle();
		
		if ($j('.pnfpb_ic_private_message_form').is(':visible')) {
			
			$j('.pnfpb_private_message_button').text('Hide form');
			
		}
		else
		{
			$j('.pnfpb_private_message_button').text('Customize');
		}
		
	}

	function toggle_new_member_form() {
	
  		$j('.pnfpb_ic_new_member_form').toggle();
		
		if ($j('.pnfpb_ic_new_member_form').is(':visible')) {
			
			$j('.pnfpb_new_member_button').text('Hide form');
			
		}
		else
		{
			$j('.pnfpb_new_member_button').text('Customize');
		}
		
	}

	function toggle_friendship_request_form() {
	
  		$j('.pnfpb_ic_friendship_request_form').toggle();
		
		if ($j('.pnfpb_ic_friendship_request_form').is(':visible')) {
			
			$j('.pnfpb_friendship_request_button').text('Hide form');
			
		}
		else
		{
			$j('.pnfpb_friendship_request_button').text('Customize');
		}
		
	}


	function toggle_friendship_accept_form() {
	
  		$j('.pnfpb_ic_friendship_accept_form').toggle();
		
		if ($j('.pnfpb_ic_friendship_accept_form').is(':visible')) {
			
			$j('.pnfpb_friendship_accept_button').text('Hide form');
			
		}
		else
		{
			$j('.pnfpb_friendship_accept_button').text('Customize');
		}
		
	}


	function toggle_avatar_change_form() {
	
  		$j('.pnfpb_ic_avatar_change_form').toggle();
		
		if ($j('.pnfpb_ic_avatar_change_form').is(':visible')) {
			
			$j('.pnfpb_avatar_change_button').text('Hide form');
			
		}
		else
		{
			$j('.pnfpb_avatar_change_button').text('Customize');
		}
		
	}

	function toggle_cover_image_change_form() {
	
  		$j('.pnfpb_ic_cover_image_change_form').toggle();
		
		if ($j('.pnfpb_ic_cover_image_change_form').is(':visible')) {
			
			$j('.pnfpb_cover_image_change_button').text('Hide form');
			
		}
		else
		{
			$j('.pnfpb_cover_image_change_button').text('Customize');
		}
		
	}

	function toggle_firebase_configuration() {
		
  		$j('.pnfpb_ic_firebase_configuration').toggle();
		
		if ($j('.pnfpb_ic_firebase_configuration').is(':visible')) {
			
			$j('.pnfpb_ic_firebase_configuration_button').text('Hide Firebase configuration');
			
		}
		else
		{
			$j('.pnfpb_ic_firebase_configuration_button').text('Update Firebase configuration');
		}	
		
	}

	function toggle_firebase_configuration_help() {
		
  		$j('.pnfpb_ic_firebase_configuration_help').toggle();
		
		if ($j('.pnfpb_ic_firebase_configuration_help').is(':visible')) {
			
			$j('.pnfpb_ic_firebase_configuration_help_button').text('Hide Firebase Tutorial');
			
		}
		else
		{
			$j('.pnfpb_ic_firebase_configuration_help_button').text('Tutorial on Firebase');
		}	
		
	}