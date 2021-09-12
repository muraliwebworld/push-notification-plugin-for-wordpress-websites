/**
* Upload custom icon for push notification from plugin settings area.
*
*
* @since 1.0.0
*/
var $j = jQuery.noConflict();
$j(document).ready(function() {
    
	var mediaUploader;
	
	$j('#pnfpb_ic_fcm_upload_button').on('click',function(e) {
		e.preventDefault();
		if( mediaUploader ){
			mediaUploader.open();
			return;
		}
		
		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Select a Picture',
			button: {
				text: 'Select Picture'
			},
			multiple: false
		});
		
		mediaUploader.on('select', function(){
			attachment = mediaUploader.state().get('selection').first().toJSON();
			$j('#pnfpb_ic_fcm_upload_icon').val(attachment.url);
			$j('#pnfpb_ic_fcm_upload_preview').css('background-image','url(' + attachment.url + ')');
		});
		
		mediaUploader.open();
		
	});
	
});