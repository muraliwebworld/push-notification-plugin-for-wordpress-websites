/**
* Script to Subscribe push notification for particular BuddyPress Group users using Firebase
* To send push notification only for members belonging to group
* @since 1.8
*/
var $j = jQuery.noConflict();
var groupid;	
$j(document).ready(function() {
			if (firebase.messaging.isSupported()) {
			var groupId =  '0';
			const messaging = firebase.messaging();
  			//Notification.requestPermission().then((permission) => {
            if (Notification.permission === 'granted') {
                        messaging.getToken().then((currentToken) => {
						if (currentToken) {
						deviceid = currentToken;
								$j(".group-button").on("click",".join-group", function() {
									var join_group_string_array = $j(this).parent().attr('id').split("-");
									if (join_group_string_array.length > 0) {
										var join_group_id = join_group_string_array[1];
										if (groupid) {
											groupid.postMessage(join_group_id);
										}										
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
										if (groupid) {
											groupid.postMessage(leave_group_id);
										}										
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
								
										        	$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
										            
										                //console.log(response);
										        
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
										if (groupid) {
											groupid.postMessage(join_group_id);
										}											
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
										if (groupid) {
											groupid.postMessage(leave_group_id);
										}										
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
								
										        	$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
										            
										                //console.log(response);
										        
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
									if (groupid) {
										groupid.postMessage(groupId);
									}									
									var unsubscribebuttonname = '.unsubscribegroupbutton-'+groupId;
									var subscribebuttonname = '.subscribegroupbutton-'+groupId;
									var unsubscribebuttonid = '#unsubscribegroupbutton-'+groupId;
									var subscribebuttonid = '#subscribegroupbutton-'+groupId;										
									if( $j("#pnfpb_group_users_subscribe_dialog_confirm").length ) {
									//console.log('dialog');
									}
									else
									{
										$j(this).append( '<div id="pnfpb_group_users_subscribe_dialog_confirm" class="pnfpb_group_users_subscribe_dialog_confirm" title="Subscribe notification?" style="display:none;"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Do you want to Subscribe push notification for this group?</div><div id="pnfpb-group-unsubscribe-dialog" title="Push notification status"><div id="pnfpb-group-unsubscribe-alert-msg" class="pnfpb-group-unsubscribe-alert-msg"></div></div>' );
									}
						        	$j( "#pnfpb_group_users_subscribe_dialog_confirm" ).dialog({  
							        	resizable: false,
							        	modal: true,
							        	buttons: {
								        	"Subscribe notifications for this group": function() {
									        	if (currentToken) {
							   
										        	deviceid = currentToken;
										        	//console.log(deviceid);
							
										        	var data = {
											        	action: 'icpushcallback',
											        	device_id:deviceid,
														bpgroup_id:groupId,
											        	pushtype: 'subscribe-group-button'
										        	};
								
										        	$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
										            
										                //console.log(response);
										        
			                                            if (response != 'fail')
			                                            {
    	                                                    if (response != 'duplicate'){
    	                                                        
			       			                                    $j(".pnfpb-group-unsubscribe-alert-msg").html("<p>Your device is subscribed for push notifications for this group.</p>");
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
										    $j( this ).dialog( "close" );
								        },
								        Cancel: function() {
									        $j( this ).dialog( "close" );
								        }
							        }
    						    })
								})
		    					$j(document).on( "click",".unsubscribe-notification-group", function(e) {
									e.preventDefault();
									groupId = $j(this).attr("data-group-id");
									if (groupid) {
										groupid.postMessage(groupId);
									}									
									var unsubscribebuttonname = '.unsubscribegroupbutton-'+groupId;
									var subscribebuttonname = '.subscribegroupbutton-'+groupId;
									var unsubscribebuttonid = '#unsubscribegroupbutton-'+groupId;
									var subscribebuttonid = '#subscribegroupbutton-'+groupId;
									if( $j("#pnfpb_group_users_unsubscribe_dialog_confirm").length ) {
									//console.log('dialog');
									}
									else
									{
										$j(this).append( '<div id="pnfpb_group_users_unsubscribe_dialog_confirm" class="pnfpb_group_users_unsubscribe_dialog_confirm" title="Remove push notification?" style="display:none;"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Do you want to Remove push notification from this group?</div><div id="pnfpb-group-unsubscribe-dialog" title="Push notification status"><div id="pnfpb-group-unsubscribe-alert-msg" class="pnfpb-group-unsubscribe-alert-msg"></div></div>' );
									}								
						        	$j( "#pnfpb_group_users_unsubscribe_dialog_confirm" ).dialog({  
							        	resizable: false,
							        	modal: true,
							        	buttons: {
								        	"Remove push notifications for this group": function() {
									        	if (currentToken) {
							   
										        	deviceid = currentToken;
										        	//console.log(deviceid);
							
										        	var data = {
											        	action: 'icpushcallback',
											        	device_id:deviceid,
														bpgroup_id:groupId,
											        	pushtype: 'unsubscribe-group-button'
										        	};
								
										        	$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
										            
										                //console.log(response);
										        
			                                            if (response != 'fail')
			                                            {
    	                                                    if (response != 'duplicate'){
    	                                                        
																$j(unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
																$j(subscribebuttonname).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
																$j(unsubscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
																$j(subscribebuttonid).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
																
																$j(".pnfpb-group-unsubscribe-alert-msg").html("<p>Your device is un-subscribed for push notifications for this group.</p>");
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
										    $j( this ).dialog( "close" );
								        },
								        Cancel: function() {
									        $j( this ).dialog( "close" );
								        }
							        }
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
					//console.log(e);
							
					$j(".pnfpb-group-unsubscribe-alert-msg").html("<p>UnSubscribe/Subscribe failed..try again ..Please!! </p>");
							
					$j( "#pnfpb-group-unsubscribe-dialog" ).dialog(); 
		    		$j(document).on( "click",".subscribe-notification-group", function(e) {
						e.preventDefault();
						groupId = $j(this).attr("data-group-id");
						if (groupid) {
							groupid.postMessage(groupId);
						}
					});
					
                  }
                    
				//})
			}
			else
			{
				console.log('This browser does not support PUSHAPI Firebase messaging!!!');
				
		    		$j(document).on( "click",".subscribe-notification-group", function(e) {
						e.preventDefault();
						groupId = $j(this).attr("data-group-id");
						if (groupid) {
							groupid.postMessage(groupId);
						}
					});				
			}

});
