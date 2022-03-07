/**
* Script to Unsubscribe push notification using Firebase
*
* @since 1.0.0
*/
//pnfpb_ajax_object_unsubscribe_push.homeurl+
var $j = jQuery.noConflict();

$j(document).ready(function() {
	
navigator.serviceWorker.register(pnfpb_ajax_object_unsubscribe_push.homeurl+'/pnfpb_icpush_pwa_sw.js',{scope:pnfpb_ajax_object_unsubscribe_push.homeurl+'/'}).then(function(registration) {
   
     if( $j(".pnfpb_unsubscribe_button").length )
     {
		if (firebase.messaging.isSupported()){
			navigator.serviceWorker.ready.then(function (registration) {	
	        // [START get_messaging_object]
            // Retrieve Firebase Messaging object.
            const messaging = firebase.messaging();
            // [END get_messaging_object]
            // [START set_public_vapid_key]
            // Add the public key generated from the console here.
            //messaging.usePublicVapidKey(pnfpb_ajax_object_unsubscribe_push.publicKey);
            // [END set_public_vapid_key]
		    $j(".pnfpb_unsubscribe_button").on( "click", function() {
		                
				            
                if (Notification.permission === 'granted') {
                            
                        messaging.getToken({serviceWorkerRegistration: registration, vapidKey:pnfpb_ajax_object_unsubscribe_push.publicKey }).then((currentToken) => {
                                
						
								var unsubscribebuttontext = pnfpb_ajax_object_unsubscribe_push.unsubscribe_button_text;

						        $j( "#pnfpb_unsubscribe_dialog_confirm" ).dialog({
									resizable: false,
									height: "auto",
									width: 300,									
							        modal: true,
							        buttons: [{
      									text: unsubscribebuttontext,
										open: function() {
											$j(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_unsubscribe_push.subscribe_button_text_color+';background-color:'+pnfpb_ajax_object_unsubscribe_push.subscribe_button_color+';border:0px');											
            							},
            							click: function() {												
									        if (currentToken) {
							   
										        deviceid = currentToken;
							
										        var data = {
											        action: 'unsubscribepush',
											        device_id:deviceid
										        };
								
										        $j.post(pnfpb_ajax_object_unsubscribe_push.ajax_url, data, function(response) {
										        

											        if (response == 'unsubscribed')
											        {
											            
		       			                                    if( $j(".pnfpb_unsubscribe_button").length )
                                                            {
                                                                $j(".pnfpb_unsubscribe_button").hide();
                                                            }
                                                                            
                                                            if( $j(".pnfpb_subscribe_button").length )
                                                            {
                                                                $j(".pnfpb_subscribe_button").show();
															}
															$j( "#pnfpb-unsubscribe-dialog" ).dialog();
														
							                                $j(".pnfpb-unsubscribe-alert-msg").html(pnfpb_ajax_object_unsubscribe_push.unsubscribe_dialog_text_confirm);														
														
											            } else {
											            
		       			                                    if( $j(".pnfpb_unsubscribe_button").length )
                                                            {
                                                                $j(".pnfpb_unsubscribe_button").hide();
                                                            }
                                                                            
                                                            if( $j(".pnfpb_subscribe_button").length )
                                                            {
                                                                $j(".pnfpb_subscribe_button").show();
                                                            }			       			                                                
											            

												            $j(".pnfpb-unsubscribe-alert-msg").html("<p>UnSubscribe failed..try again..Please!!</p>");
							
												            $j( "#pnfpb-unsubscribe-dialog" ).dialog();
							
											            }
								
										        });
							
									        }
											$j( "#pnfpb_unsubscribe_dialog_confirm" ).dialog( "close" );
								        },
								        Cancel: function() {
									        $j( "#pnfpb_unsubscribe_dialog_confirm" ).dialog( "close" );
								        }
							        }]
    						    });
    						    
    						    $j('#pnfpb_unsubscribe_dialog_confirm').on('dialogclose', function(event) {
                                    $j(".pnfpb-unsubscribe-alert-msg").html("");
                                    $j(".pnfpb-subscribe-alert-msg").html("");
                                });
						
                        });
                        
                   }
                   else
                   {
                        
			       	    if( $j(".pnfpb_unsubscribe_button").length )
                        {
                            $j(".pnfpb_unsubscribe_button").show();
                        }
                                                                            
                        if( $j(".pnfpb_subscribe_button").length )
                        {
                            $j(".pnfpb_subscribe_button").hide();
                        }			       			                                                
                        
						
						$j(".pnfpb-unsubscribe-alert-msg").html("<p>UnSubscribe failed..try again or Subscribe again..Please!! - </p>");
							
						$j( "#pnfpb-unsubscribe-dialog" ).dialog();                        
                  }
                    
				})
				    
		    })
			}
			else
			{
				console.log('This browser does not support PUSHAPI Firebase messaging!!!')
			}			
        }
	})
	
});