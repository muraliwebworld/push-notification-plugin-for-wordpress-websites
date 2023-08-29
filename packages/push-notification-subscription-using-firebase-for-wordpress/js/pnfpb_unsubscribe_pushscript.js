/**
* Script to Unsubscribe push notification using Firebase
*
* @since 1.0.0
*/
var $j = jQuery.noConflict();

$j(document).ready(function() {
    
        if( $j(".pnfpb_unsubscribe_button").length )
        {
			if (firebase.messaging.isSupported()){
	        // [START get_messaging_object]
            // Retrieve Firebase Messaging object.
            const messaging = firebase.messaging();
            // [END get_messaging_object]
            // [START set_public_vapid_key]
            // Add the public key generated from the console here.
            //messaging.usePublicVapidKey(pnfpb_ajax_object_unsubscribe_push.publicKey);
            // [END set_public_vapid_key]
		    $j(".pnfpb_unsubscribe_button").on( "click", function() {
		                
				//Notification.requestPermission().then((permission) => {
				            
                if (Notification.permission === 'granted') {
                            
                        messaging.getToken().then((currentToken) => {
                                
 					            $j(".pnfpb-unsubscribe-notifications").show();

						        $j( "#pnfpb_unsubscribe_dialog_confirm" ).dialog({  
							        resizable: false,
							        modal: true,
							        buttons: {
								        "Unsubscribe": function() {
									        if (currentToken) {
							   
										        deviceid = currentToken;
										        //console.log(deviceid);
							
										        var data = {
											        action: 'unsubscribepush',
											        device_id:deviceid
										        };
								
										        $j.post(pnfpb_ajax_object_unsubscribe_push.ajax_url, data, function(response) {
										        
										            //console.log(response);

											        if (response == 'unsubscribed')
											        {
											            
											            	if ('serviceWorker' in navigator && 'PushManager' in window) {
		
		                                                        navigator.serviceWorker.ready.then(function (registration) {
			
                                                                    registration.pushManager.getSubscription().then(function (subscription) {
			   
                                                                        if (!subscription) {
                                                                            
                                                                            
                                                                            if( $j(".pnfpb_unsubscribe_button").length )
                                                                            {
                                                                                $j(".pnfpb_unsubscribe_button").hide();
                                                                            }
                                                                            
                                                                            if( $j(".pnfpb_subscribe_button").length )
                                                                            {
                                                                                $j(".pnfpb_subscribe_button").show();
                                                                            }			       			                                                
												            
										
													                        $j(".pnfpb-unsubscribe-alert-msg").html("<p>UnSubscribe failed..try again..Please!! - </p>");
							
													                        $j( "#pnfpb-unsubscribe-dialog" ).dialog();

												                            
                                                                        }
                                                                        
                                                                        else
                                                                        {

												                            subscription.unsubscribe().then(function () {
												            
			       			                                                        if( $j(".pnfpb_unsubscribe_button").length )
                                                                                    {
                                                                                        $j(".pnfpb_unsubscribe_button").hide();
                                                                                    }
                                                                            
                                                                                    if( $j(".pnfpb_subscribe_button").length )
                                                                                    {
                                                                                        $j(".pnfpb_subscribe_button").show();
                                                                                    }			       			                                                
												            
							
													                                $j( "#pnfpb-unsubscribe-dialog" ).dialog();
						
													                                $j(".pnfpb-unsubscribe-alert-msg").html("<p>Your device is unsubscribed from push notifications.</p>");
						
													                                console.log("unsubscribed");
										
												                            }).catch(function (error) {
												            
			       			                                                        if( $j(".pnfpb_unsubscribe_button").length )
                                                                                    {
                                                                                        $j(".pnfpb_unsubscribe_button").show();
                                                                                    }
                                                                            
                                                                                    if( $j(".pnfpb_subscribe_button").length )
                                                                                    {
                                                                                        $j(".pnfpb_subscribe_button").hide();
                                                                                    }			       			                                                
												            
										
													                                $j(".pnfpb-unsubscribe-alert-msg").html("<p>UnSubscribe failed..try again..Please!! - </p>");
							
													                               $j( "#pnfpb-unsubscribe-dialog" ).dialog();
										
												                            });	
												            
			       			
													                               
                                                                        }
                                                                        
                                                                    });
                                                                    
		                                                        });
		                                                        
											            	}
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
										    $j( this ).dialog( "close" );
								        },
								        Cancel: function() {
									        $j( this ).dialog( "close" );
								        }
							        }
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
                        
						//console.log(e);
							
						$j(".pnfpb-unsubscribe-alert-msg").html("<p>UnSubscribe failed..try again or Subscribe again..Please!! - </p>");
							
						$j( "#pnfpb-unsubscribe-dialog" ).dialog();                        
                  }
                    
				//});
				    
		    });
			}
			else
			{
				console.log('This browser does not support PUSHAPI Firebase messaging!!!')
			}			
        }


	
});