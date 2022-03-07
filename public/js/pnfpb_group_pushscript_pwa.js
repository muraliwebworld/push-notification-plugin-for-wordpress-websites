/**
* Script to Subscribe push notification for particular BuddyPress Group users using Firebase
* To send push notification only for members belonging to group
* @since 1.8
*/

var $j = jQuery.noConflict();
var unsubscribeGroupid;
var subscribeGroupid
var pnfpb_pushtoken_fromflutter = '';

$j(document).ready(function() {

	navigator.serviceWorker.register(pnfpb_ajax_object_group_push.homeurl+'/pnfpb_icpush_pwa_sw.js',{scope:pnfpb_ajax_object_group_push.homeurl+'/'}).then(function(registration) {

		if (firebase.messaging.isSupported()) {
			navigator.serviceWorker.ready.then(function (registration) {				
				var groupId =  '0';
				const messaging = firebase.messaging();
            	if (Notification.permission === 'granted') {
                        messaging.getToken({serviceWorkerRegistration: registration, vapidKey:pnfpb_ajax_object_group_push.publicKey }).then((currentToken) => {
						if (currentToken) {
						deviceid = currentToken;
								$j(".group-button").on("click",".join-group", function() {
									var join_group_string_array = $j(this).parent().attr('id').split("-");
									if (join_group_string_array.length > 0) {
										var join_group_id = join_group_string_array[1];
										var join_group_unsubscribebuttonname = '.unsubscribegroupbutton-'+join_group_id;
										var join_group_subscribebuttonname = '.subscribegroupbutton-'+join_group_id;
										var join_group_unsubscribebuttonid = '#unsubscribegroupbutton-'+join_group_id;
										var join_group_subscribebuttonid = '#subscribegroupbutton-'+join_group_id;																				$j(join_group_subscribebuttonname).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
										$j(join_group_unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
										$j(join_group_subscribebuttonid).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
										$j(join_group_unsubscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );										
									}
								});
							
								$j(".group-button").on("click",".leave-group", function() {
									var leave_group_string_array = $j(this).parent().attr('id').split("-");
									if (leave_group_string_array.length > 0) {
										var leave_group_id = leave_group_string_array[1];
										var leave_group_unsubscribebuttonname = '.unsubscribegroupbutton-'+leave_group_id;
										var leave_group_subscribebuttonname = '.subscribegroupbutton-'+leave_group_id;
										var leave_group_unsubscribebuttonid = '#unsubscribegroupbutton-'+leave_group_id;
										var leave_group_subscribebuttonid = '#subscribegroupbutton-'+leave_group_id;
										$j(leave_group_subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
										$j(leave_group_unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
										$j(leave_group_subscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
										$j(leave_group_unsubscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
										
									}
									if (currentToken) {
										        	deviceid = currentToken;
										        	var data = {
											        	action: 'icpushcallback',
											        	device_id:deviceid,
														bpgroup_id:leave_group_id,
											        	pushtype: 'unsubscribe-group-button'
										        	};
								
										        	$j.post(pnfpb_ajax_object_group_push.ajax_url, data, function(response) {
										            
							        
			                                            if (response != 'fail')
			                                            {
    	                                                    if (response != 'duplicate'){
    	                                                        
																	$j(leave_group_subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
																	$j(leave_group_unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
			                                                    }
			                                                    else
			                                                    {
			           
			                                                        console.log("Push notification unsubscription failed..try again!!");
			                                                    }

			                                            }

							
										        });	
									}
								});	


								$j(document).on("click",".join-group", function() {
									var join_group_string_array = $j(this).parent().attr('id').split("-");
									if (join_group_string_array.length > 0) {
										var join_group_id = join_group_string_array[1];
										var join_group_unsubscribebuttonname = '.unsubscribegroupbutton-'+join_group_id;
										var join_group_subscribebuttonname = '.subscribegroupbutton-'+join_group_id;
										var join_group_unsubscribebuttonid = '#unsubscribegroupbutton-'+join_group_id;
										var join_group_subscribebuttonid = '#subscribegroupbutton-'+join_group_id;
										$j(join_group_subscribebuttonname).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
										$j(join_group_unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );											$j(join_group_subscribebuttonid).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
										$j(join_group_unsubscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );	
									}
								});
							
								$j(document).on("click",".leave-group", function() {
									var leave_group_string_array = $j(this).parent().attr('id').split("-");
									if (leave_group_string_array.length > 0) {
										var leave_group_id = leave_group_string_array[1];
										var leave_group_unsubscribebuttonname = '.unsubscribegroupbutton-'+leave_group_id;
										var leave_group_subscribebuttonname = '.subscribegroupbutton-'+leave_group_id;
										var leave_group_unsubscribebuttonid = '#unsubscribegroupbutton-'+leave_group_id;
										var leave_group_subscribebuttonid = '#subscribegroupbutton-'+leave_group_id;
										$j(leave_group_subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
										$j(leave_group_unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
										$j(leave_group_subscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
										$j(leave_group_unsubscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
										
									}
									if (currentToken) {
										        	deviceid = currentToken;
										        	var data = {
											        	action: 'icpushcallback',
											        	device_id:deviceid,
														bpgroup_id:leave_group_id,
											        	pushtype: 'unsubscribe-group-button'
										        	};
								
										        	$j.post(pnfpb_ajax_object_group_push.ajax_url, data, function(response) {
										            
									        
			                                            if (response != 'fail')
			                                            {
    	                                                    if (response != 'duplicate'){
    	                                                        
																	$j(leave_group_subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
																	$j(leave_group_unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
			                                                    }
			                                                    else
			                                                    {
			           
			                                                        console.log("Push notification unsubscription failed..try again!!");
			                                                    }

			                                            }

							
										        });	
									}
								});	
							
							
							
		    					$j(document).on( "click",".subscribe-notification-group", function(e) {
									e.preventDefault();
									groupId = $j(this).attr("data-group-id");
									var unsubscribebuttonname = '.unsubscribegroupbutton-'+groupId;
									var subscribebuttonname = '.subscribegroupbutton-'+groupId;
									var unsubscribebuttonid = '#unsubscribegroupbutton-'+groupId;
									var subscribebuttonid = '#subscribegroupbutton-'+groupId;										
									if( $j("#pnfpb_group_users_subscribe_dialog_confirm").length ) {
									//console.log('dialog');
									}
									else
									{
										$j(this).append( '<div id="pnfpb_group_users_subscribe_dialog_confirm" class="pnfpb_group_users_subscribe_dialog_confirm" title="Subscribe" style="display:none;"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>'+pnfpb_ajax_object_group_push.group_subscribe_dialog_text+'</div><div id="pnfpb-group-unsubscribe-dialog" title="Confirmation"><div id="pnfpb-group-unsubscribe-alert-msg" class="pnfpb-group-unsubscribe-alert-msg"></div></div>' );
									}
 									var subscribe_button_text = pnfpb_ajax_object_group_push.subscribe_button_text;
						        	$j( "#pnfpb_group_users_subscribe_dialog_confirm" ).dialog({  
										resizable: false,
										height: "auto",
							        	modal: true,
							        	buttons: [{
      										text: subscribe_button_text,
											open: function() {
												$j(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_group_push.subscribe_button_text_color+';background-color:'+pnfpb_ajax_object_group_push.subscribe_button_color+';border:0px');
											},
      										click: function() {												
									        	if (currentToken) {
							   
										        	deviceid = currentToken;
										        	//console.log(deviceid);
							
										        	var data = {
											        	action: 'icpushcallback',
											        	device_id:deviceid,
														bpgroup_id:groupId,
											        	pushtype: 'subscribe-group-button'
										        	};
								
										        	$j.post(pnfpb_ajax_object_group_push.ajax_url, data, function(response) {
										            
										        
			                                            if (response != 'fail')
			                                            {
    	                                                    if (response != 'duplicate'){
    	                                                        
			       			                                    $j(".pnfpb-group-unsubscribe-alert-msg").html("<p>"+pnfpb_ajax_object_group_push.group_subscribe_dialog_text_confirm+"</p>");
			       			                                    $j( "#pnfpb-group-unsubscribe-dialog" ).dialog();
																$j(subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
																$j(unsubscribebuttonname).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
																$j(subscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
																$j(unsubscribebuttonid).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
																
			                                                 }
			                                                 else
			                                                 {
			                                                    console.log("Already subscribed...device id already exists...not updated");
			                                                 }

			                                            }
			                                            else
			                                            {

                                                           
                                                            $j(".pnfpb-group-unsubscribe-alert-msg").html("<p>Push notification subscription failed..try again!!</p>");
                                                            
                                                            $j( "#pnfpb-group-unsubscribe-dialog" ).dialog();

			                                                console.log("device update failed");
			                                            }
							
										        });
							
									        }									
											$j( "#pnfpb_group_users_subscribe_dialog_confirm" ).dialog("close");
								        },
								        Cancel: function() {
									        $j( "#pnfpb_group_users_subscribe_dialog_confirm" ).dialog("close");
								        }
							        }]
    						    })
								})
		    					$j(document).on( "click",".unsubscribe-notification-group", function(e) {
									e.preventDefault();
									groupId = $j(this).attr("data-group-id");
									var unsubscribebuttonname = '.unsubscribegroupbutton-'+groupId;
									var subscribebuttonname = '.subscribegroupbutton-'+groupId;
									var unsubscribebuttonid = '#unsubscribegroupbutton-'+groupId;
									var subscribebuttonid = '#subscribegroupbutton-'+groupId;
									if( $j("#pnfpb_group_users_unsubscribe_dialog_confirm").length ) {
									//console.log('dialog');
									}
									else
									{
										$j(this).append( '<div id="pnfpb_group_users_unsubscribe_dialog_confirm" class="pnfpb_group_users_unsubscribe_dialog_confirm" title="Unsubscribe" style="display:none;"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>'+pnfpb_ajax_object_group_push.group_unsubscribe_dialog_text+'</div><div id="pnfpb-group-unsubscribe-dialog" title="Confirmation"><div id="pnfpb-group-unsubscribe-alert-msg" class="pnfpb-group-unsubscribe-alert-msg"></div></div>' );
									}
									var unsubscribe_button_text = pnfpb_ajax_object_group_push.unsubscribe_button_text;									
						        	$j( "#pnfpb_group_users_unsubscribe_dialog_confirm" ).dialog({  
										resizable: false,
										height: "auto",
							        	modal: true,
							        	buttons: [{
      										text: unsubscribe_button_text,
											open: function() {
												$j(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_group_push.subscribe_button_text_color+';background-color:'+pnfpb_ajax_object_group_push.subscribe_button_color+';border:0px');
											},
      										click: function() {	
									        	if (currentToken) {
							   
										        	deviceid = currentToken;
							
										        	var data = {
											        	action: 'icpushcallback',
											        	device_id:deviceid,
														bpgroup_id:groupId,
											        	pushtype: 'unsubscribe-group-button'
										        	};
								
										        	$j.post(pnfpb_ajax_object_group_push.ajax_url, data, function(response) {
										            
									        
			                                            if (response != 'fail')
			                                            {
    	                                                    if (response != 'duplicate'){
    	                                                        
																$j(unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
																$j(subscribebuttonname).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
																$j(unsubscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
																$j(subscribebuttonid).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
																
																$j(".pnfpb-group-unsubscribe-alert-msg").html("<p>"+pnfpb_ajax_object_group_push.group_unsubscribe_dialog_text_confirm+"</p>");
																
																$j( "#pnfpb-group-unsubscribe-dialog" ).dialog();
																
			                                                  }
			                                                  else
			                                                  {
			           
			                                                        console.log("Push notification unsubscription failed..try again!!");
			                                                    }

			                                            }
			                                            else
			                                            {

                                                           
                                                            $j(".pnfpb-group-unsubscribe-alert-msg").html("<p>Push notification unsubscription failed..try again!!</p>");
                                                            
                                                            $j( "#pnfpb-group-unsubscribe-dialog" ).dialog();

			                                                console.log("device update failed");
			                                            }
							
										        });
							
									        }
											$j("#pnfpb_group_users_unsubscribe_dialog_confirm").dialog("close");
								        },
								        Cancel: function() {
									        $j( "#pnfpb_group_users_unsubscribe_dialog_confirm" ).dialog( "close" );
								        }
							        }]
    						    })
								})
							
						
    						    $j('#pnfpb_group_users_unsubscribe_dialog_confirm').on('dialogclose', function(event) {
                                    $j(".pnfpb-group-unsubscribe-alert-msg").html("");
                                    $j(".pnfpb-group-subscribe-alert-msg").html("");
                                });							
    						    $j('#pnfpb_group_users_subscribe_dialog_confirm').on('dialogclose', function(event) {
                                    $j(".pnfpb-group-unsubscribe-alert-msg").html("");
                                    $j(".pnfpb-group-subscribe-alert-msg").html("");
                                });
							
 			
			                             
						
						}
                        });
                        
                  }
                  else
                  {
							
					$j(".pnfpb-group-unsubscribe-alert-msg").html("<p>UnSubscribe/Subscribe failed..try again ..Please!! </p>");
							
					$j( "#pnfpb-group-unsubscribe-dialog" ).dialog();                        
                  }
                    
				})
			}
			else
			{
				if (pnfpb_pushtoken_fromflutter !== '') {
					console.log('This browser does not support PUSHAPI Firebase messaging!!!');
					$j(document).on( "click",".subscribe-notification-group", function(e) {
						e.preventDefault();
						groupId = $j(this).attr("data-group-id");
						var unsubscribebuttonname = '.unsubscribegroupbutton-'+groupId;
						var subscribebuttonname = '.subscribegroupbutton-'+groupId;
						var unsubscribebuttonid = '#unsubscribegroupbutton-'+groupId;
						var subscribebuttonid = '#subscribegroupbutton-'+groupId;										
						if( $j("#pnfpb_group_users_subscribe_dialog_confirm").length ) {
							//console.log('dialog');
						}
						else
						{
							$j(this).append( '<div id="pnfpb_group_users_subscribe_dialog_confirm" class="pnfpb_group_users_subscribe_dialog_confirm" title="Subscribe" style="display:none;"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>'+pnfpb_ajax_object_group_push.group_subscribe_dialog_text+'</div><div id="pnfpb-group-unsubscribe-dialog" title="Confirmation"><div id="pnfpb-group-unsubscribe-alert-msg" class="pnfpb-group-unsubscribe-alert-msg"></div></div>' );
						}
 						var subscribe_button_text = pnfpb_ajax_object_group_push.subscribe_button_text;
						$j( "#pnfpb_group_users_subscribe_dialog_confirm" ).dialog({  
							resizable: false,
							height: "auto",
			   				modal: true,
			   				buttons: [{
      							text: subscribe_button_text,
								open: function() {
								$j(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_group_push.subscribe_button_text_color+';background-color:'+pnfpb_ajax_object_group_push.subscribe_button_color+';border:0px');
											},
      							click: function() {
									const d = new Date();
									d.setTime(d.getTime() + (365*24*60*60*1000));
									let expires = "expires="+ d.toUTCString();
									var cookievalue = "pnfpb_group_push_notification_"+groupId + "=" + "expiretime" + ";" + expires + ";path=/";
									document.cookie = cookievalue;
									if (subscribeGroupid) {
										subscribeGroupid.postMessage(groupId);
									}								
									$j(".pnfpb-group-unsubscribe-alert-msg").html("<p>"+pnfpb_ajax_object_group_push.group_subscribe_dialog_text_confirm+"</p>");
			       			    	$j( "#pnfpb-group-unsubscribe-dialog" ).dialog();
									$j(subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
									$j(unsubscribebuttonname).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
									$j(subscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
									$j(unsubscribebuttonid).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );														
						 	 $j( "#pnfpb_group_users_subscribe_dialog_confirm" ).dialog("close");
							},
							Cancel: function() {
								$j( "#pnfpb_group_users_subscribe_dialog_confirm" ).dialog("close");
							}
						}]
    				})

				});
					
		    	$j(document).on( "click",".unsubscribe-notification-group", function(e) {
					e.preventDefault();
					groupId = $j(this).attr("data-group-id");
					document.cookie = "pnfpb_group_push_notification_"+groupId + "; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;"				
					var unsubscribebuttonname = '.unsubscribegroupbutton-'+groupId;
					var subscribebuttonname = '.subscribegroupbutton-'+groupId;
					var unsubscribebuttonid = '#unsubscribegroupbutton-'+groupId;
					var subscribebuttonid = '#subscribegroupbutton-'+groupId;
					if( $j("#pnfpb_group_users_unsubscribe_dialog_confirm").length ) {
						//console.log('dialog');
					}
					else
					{
						$j(this).append( '<div id="pnfpb_group_users_unsubscribe_dialog_confirm" class="pnfpb_group_users_unsubscribe_dialog_confirm" title="Unsubscribe" style="display:none;"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>'+pnfpb_ajax_object_group_push.group_unsubscribe_dialog_text+'</div><div id="pnfpb-group-unsubscribe-dialog" title="Confirmation"><div id="pnfpb-group-unsubscribe-alert-msg" class="pnfpb-group-unsubscribe-alert-msg"></div></div>' );
					}
					var unsubscribe_button_text = pnfpb_ajax_object_group_push.unsubscribe_button_text;									
					$j( "#pnfpb_group_users_unsubscribe_dialog_confirm" ).dialog({  
						resizable: false,
						height: "auto",
					    modal: true,
						buttons: [{
      						text: unsubscribe_button_text,
							open: function() {
								$j(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_group_push.subscribe_button_text_color+';background-color:'+pnfpb_ajax_object_group_push.subscribe_button_color+';border:0px');
							},
      						click: function() {
								if (unsubscribeGroupid) {
									unsubscribeGroupid.postMessage(groupId);
								}								
								$j(unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
								$j(subscribebuttonname).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
								$j(unsubscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
								$j(subscribebuttonid).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
								$j(".pnfpb-group-unsubscribe-alert-msg").html("<p>"+pnfpb_ajax_object_group_push.group_unsubscribe_dialog_text_confirm+"</p>");
								$j( "#pnfpb-group-unsubscribe-dialog" ).dialog();
								$j("#pnfpb_group_users_unsubscribe_dialog_confirm").dialog("close");
							},
						Cancel: function() {
							$j( "#pnfpb_group_users_unsubscribe_dialog_confirm" ).dialog( "close" );
						}
					}]
				})
			})				
		}		
	}

})

	

/*function PNFPB_from_Flutter_mobileapp(pushtoken) {
	
 pnfpb_pushtoken_fromflutter = pushtoken;
	
 return pnfpb_pushtoken_fromflutter;
	
}*/
	

});
