 
/**
* Upload custom icon for pwa app from plugin settings area.
*
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