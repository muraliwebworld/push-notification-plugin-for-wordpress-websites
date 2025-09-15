/**
* Upload custom icon for pwa app from plugin settings area.
*
*
* @since 1.64
*/
var $j = jQuery.noConflict();

$j(function() {
	
	const { __ } = wp.i18n;
    
	$j('.pnfpb_icfcm_service_account_upload').on('change',function(e) {
        file_data = $j(this).prop('files')[0];
        form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('action', 'icpushadmincallback');
		form_data.append('calltype', 'pnfpb_service_account_upload');
        form_data.append('nonce', pnfpb_ajax_admin_service_account_push_object.pnfpb_nonce);
        $j.ajax({
            url: pnfpb_ajax_admin_service_account_push_object.ajax_url,
            type: 'post',
            action: 'icpushadmincallback',
            calltype: 'pnfpb_service_account_upload',
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {
              	console.log(response);
				if (response !== 'failed' && response !== 'Security validation failed.' && response !== 'wp_filesystem upload failed') {
					$j('.pnfpb_icfcm_service_account_upload_message').css('color','red');
					$j('.pnfpb_icfcm_service_account_upload_message').html('<b>Service account file uploaded successfully.</b>');
				} else {
					$j('.pnfpb_icfcm_service_account_upload_message').css('color','red');
					$j('.pnfpb_icfcm_service_account_upload_message').html(response);					
				}
            }
        });
		
	});

	var pnfpb_selectedItems_array = [];
	$j('.pnfpb_ic_on_demand_push_select_user').autocomplete({
		source: function(request, response){
			$j.ajax({
				url: pnfpb_ajax_admin_service_account_push_object.ajax_url,
				type: 'POST',
				data : {
						action: 'icpushadmincallback',
						calltype: 'pnfpb_ondemand_push_select_user',
						nonce: pnfpb_ajax_admin_service_account_push_object.pnfpb_nonce,
						pnfpb_ic_on_demand_push_select_user: request.term
				},
				success: function (response_data) {
        			response( $j.map( response_data, function( item ) {
					  return {
						label: item.label, // Display the name
						value: item.value,  // Use the ID as the value
						email: item.email // Store the email for later use
					  };
        			}));				
				},
				error: function(errorThrown){
					console.log(errorThrown);
				}				
			})
		},
		minLength: 2, // Minimum characters before triggering autocomplete
  		create: function () {
   			$j(this).data('ui-autocomplete')._renderItem = function (ul, item) {
      			return $j('<li>')
        		.append( "<div>" + item.label + " - " + item.email + "</div>" ) // Customize the display
        		.appendTo( ul );
    		};
  		},		
		select: function(event, ui) {
			// Handle selection (e.g., redirect to user profile)
			var item = ui.item.value;
			$j('#pnfpb_ic_on_demand_push_select_user').val(ui.item.label+ " - " + ui.item.email);
          	if (pnfpb_selectedItems_array.indexOf(item) === -1) {
            	pnfpb_selectedItems_array.push(item);
            	$j("#pnfpb_ic_user_selected_items").append(
                	'<span class="pnfpb-notification-user-selected-item" data-item="' + ui.item.value + '">' + ui.item.label+ " - " + ui.item.email +
                	'<span class="pnfpb-notification-user-remove-item" data-item="' + ui.item.value + '">X</span></span>'
            	);
            	$j(this).val("");
				$j('#pnfpb_ic_on_demand_push_select_user_ids').val(pnfpb_selectedItems_array);
          	}			
			return false;
		}
	});
	$j("#pnfpb_ic_user_selected_items").on("click", ".pnfpb-notification-user-remove-item", function() {
		var itemToRemove = $j(this).data("item");
		pnfpb_selectedItems_array = pnfpb_selectedItems_array.filter(item => item !== itemToRemove);
		$j(this).parent().remove();
	});	
	
});