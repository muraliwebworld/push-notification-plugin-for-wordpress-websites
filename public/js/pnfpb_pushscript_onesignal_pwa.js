var pnfpb_onesignal_userid;

const { __ } = wp.i18n;

pnfpb_onesignal_userid = pnfpb_ajax_object_onesignal_push.userid;

var pnfpb_onesignal_userid_os = pnfpb_onesignal_userid;

if (pnfpb_onesignal_userid === '1') {
	
	pnfpb_onesignal_userid_os = '1pnfpbadm';
	
}



var standalone = window.navigator.standalone,
  userAgent = window.navigator.userAgent.toLowerCase(),
  safari = /safari/.test(userAgent),
  ios = /iphone|ipod|ipad/.test(userAgent);
	
var pnfpb_webview = false;

if (ios) {
  if (!standalone && safari) {
    // Safari
    pnfpb_webview = false;
  } else if (!standalone && !safari) {
    // iOS webview
    pnfpb_webview = true;
  	
  };
} else {
  if (userAgent.includes('wv')) {
    // Android webview
    pnfpb_webview = true;
  } else {
    // Chrome
    pnfpb_webview = false;
  }
};

//console.log(pnfpb_webview);

var $j = jQuery.noConflict();

$j(document).ready(function() {
	
	var pnfpbonesignalid = parseInt(pnfpb_onesignal_userid)
	
 	if (pnfpb_webview) {
		
		const { setExternalUserId } = WTN.OneSignal;

		setExternalUserId(pnfpb_onesignal_userid_os);		
		
		const { getPlayerId } = WTN.OneSignal;
		
		getPlayerId().then(function(playerId) {
			
  			if(playerId){
    			// handle for playerId
				if (pnfpb_onesignal_userid) {
					var data = {
						action: 'icpushcallback',
						onesignal_externalid:pnfpbonesignalid,
						pushtype: 'onesignal_subscribed_users'
					};	
					$j.post(pnfpb_ajax_object_onesignal_push.ajax_url, data, function(responseajax) {
						console.log(responseajax);
					});
				}
 	 		}
			
		});
	}
	else 
	{
		
		OneSignal.push(function() {
			
			//console.log(pnfpb_onesignal_userid_os);
			//console.log(typeof OneSignal.login);
			//console.log(typeof OneSignal.setExternalUserId);
			
			if (typeof OneSignal.login === "function" && pnfpb_onesignal_userid_os != '0') { 
				
  				OneSignal.login(pnfpb_onesignal_userid_os);
				
					var data = {
						action: 'icpushcallback',
						onesignal_externalid:pnfpb_onesignal_userid_os,
						pushtype: 'onesignal_subscribed_users'
					};
							
					$j.post(pnfpb_ajax_object_onesignal_push.ajax_url, data, function(responseajax) {
						
					});
				
			} else {
				if (typeof OneSignal.setExternalUserId === "function"  && pnfpb_onesignal_userid_os != '0') {
					
					OneSignal.setExternalUserId(pnfpb_onesignal_userid_os);
					
					var data = {
						action: 'icpushcallback',
						onesignal_externalid:pnfpb_onesignal_userid_os,
						pushtype: 'onesignal_subscribed_users'
					};
							
					$j.post(pnfpb_ajax_object_onesignal_push.ajax_url, data, function(responseajax) {
						
					});	
					
				}
			}
		});
		
	}
	
	var currentToken = 'onesignal@N';
	
	$j(".group-button").on("click",".join-group", function() {
		var join_group_string_array = $j(this).parent().attr('id').split("-");
		if (join_group_string_array.length > 0) {
			var join_group_id = join_group_string_array[1];
			var join_group_unsubscribebuttonname = '.unsubscribegroupbutton-'+join_group_id;
			var join_group_subscribebuttonname = '.subscribegroupbutton-'+join_group_id;
			var join_group_unsubscribebuttonid = '#unsubscribegroupbutton-'+join_group_id;
			var join_group_subscribebuttonid = '#subscribegroupbutton-'+join_group_id;																											$j(join_group_subscribebuttonname).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
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
								
			$j.post(pnfpb_ajax_object_onesignal_push.ajax_url, data, function(response) {
							        
			   if (response != 'fail')
			   {
    	           if (response != 'duplicate') {
					   
					$j(leave_group_subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
					   
					$j(leave_group_unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
					   
			       }
			       else
			       {
			           
			         console.log(__("Push notification unsubscription failed..try again!!",'PNFPB_TD'));
					   
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
			$j(join_group_unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );																		$j(join_group_subscribebuttonid).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
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
			
			var deviceid = currentToken;
			
			var data = {
				action: 'icpushcallback',
				device_id:deviceid,
				bpgroup_id:leave_group_id,
				pushtype: 'unsubscribe-group-button'
			};
								
			$j.post(pnfpb_ajax_object_onesignal_push.ajax_url, data, function(response) {
									        
			     if (response != 'fail')
			     {
    	             if (response != 'duplicate') {
    	                                                        
						$j(leave_group_subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
						$j(leave_group_unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
						 
			          }
			          else
			          {
			           
			              console.log(__("Push notification unsubscription failed..try again!!",'PNFPB_TD'));
			           }

			     }

							
			});	
		}
	});
	
	var pnfpb_subscribe_notification_group_element =  document.getElementsByClassName("subscribe-notification-group");
	
	var pnfpb_group_users_subscribe_dialog_confirm =  document.getElementById("pnfpb_group_users_subscribe_dialog_confirm");
	
	if( typeof(pnfpb_subscribe_notification_group_element) != 'undefined' && pnfpb_subscribe_notification_group_element != null ) {
				
		$j(document).on( "click",".subscribe-notification-group", function(e) {
			
			e.preventDefault();
			var groupId = $j(this).attr("data-group-id");
			var unsubscribebuttonname = '.unsubscribegroupbutton-'+groupId;
			var subscribebuttonname = '.subscribegroupbutton-'+groupId;
			var unsubscribebuttonid = '#unsubscribegroupbutton-'+groupId;
			var subscribebuttonid = '#subscribegroupbutton-'+groupId;
			
			if( typeof(pnfpb_group_users_subscribe_dialog_confirm) === 'undefined' || pnfpb_group_users_subscribe_dialog_confirm === null ) {

				$j(this).append( '<div id="pnfpb_group_users_subscribe_dialog_confirm" class="pnfpb_group_users_subscribe_dialog_confirm" title="Subscribe" style="display:none;"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>'+pnfpb_ajax_object_onesignal_push.group_subscribe_dialog_text+'</div><div id="pnfpb-group-unsubscribe-dialog" title="Confirmation"><div id="pnfpb-group-unsubscribe-alert-msg" class="pnfpb-group-unsubscribe-alert-msg"></div></div>' );
				
			}
			
 			var subscribe_button_text = pnfpb_ajax_object_onesignal_push.subscribe_button_text;
			
			var deviceid = currentToken;
			
			$j( "#pnfpb_group_users_subscribe_dialog_confirm" ).dialog({  
				resizable: false,
				height: "auto",
				closeText : '',
			   	modal: true,
			   	buttons: [{
      				text: subscribe_button_text,
					open: function() {
						$j(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_onesignal_push.subscribe_button_text_color+';background-color:'+pnfpb_ajax_object_onesignal_push.subscribe_button_color+';border:0px');
					},
      				click: function() {
						const d = new Date();
						d.setTime(d.getTime() + (365*24*60*60*1000));
						let expires = "expires="+ d.toUTCString();
						var cookievalue = "pnfpb_group_push_notification_"+groupId + "=" + "expiretime" + ";" + expires + ";path=/";
						document.cookie = cookievalue;
									
						if (window.webkit && window.webkit.messageHandlers && window.webkit.messageHandlers.subscribeGroupid) {
       						window.webkit.messageHandlers.subscribeGroupid.postMessage({
                     			"message": groupId
       						});
						}									
									
						var data = {
							action: 'icpushcallback',
							device_id:deviceid,
							bpgroup_id:groupId,
							pushtype: 'subscribe-group-button'
						};
								
						$j.post(pnfpb_ajax_object_onesignal_push.ajax_url, data, function(response) {
							
							$j(".pnfpb-group-unsubscribe-alert-msg").html("<p>"+pnfpb_ajax_object_onesignal_push.group_subscribe_dialog_text_confirm+"</p>");
			       			$j( "#pnfpb-group-unsubscribe-dialog" ).dialog();
							$j(subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
							$j(unsubscribebuttonname).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
							$j(subscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
							$j(unsubscribebuttonid).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );	
							$j( "#pnfpb_group_users_subscribe_dialog_confirm" ).dialog("close");
							
						})

					},
					Cancel: function() {
						$j( "#pnfpb_group_users_subscribe_dialog_confirm" ).dialog("close");
					}
				}]
    		})

		});
	}
	
	var pnfpb_unsubscribe_notification_group_element =  document.getElementsByClassName("unsubscribe-notification-group");
	
	var pnfpb_group_users_unsubscribe_dialog_confirm =  document.getElementById("pnfpb_group_users_unsubscribe_dialog_confirm");
				
	if( typeof(pnfpb_unsubscribe_notification_group_element) != 'undefined' && pnfpb_unsubscribe_notification_group_element != null ) {
					
		$j(document).on( "click",".unsubscribe-notification-group", function(e) {
			
			e.preventDefault();
			var groupId = $j(this).attr("data-group-id");
			document.cookie = "pnfpb_group_push_notification_"+groupId + "; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;"				
			var unsubscribebuttonname = '.unsubscribegroupbutton-'+groupId;
			var subscribebuttonname = '.subscribegroupbutton-'+groupId;
			var unsubscribebuttonid = '#unsubscribegroupbutton-'+groupId;
			var subscribebuttonid = '#subscribegroupbutton-'+groupId;
			
			if(typeof(pnfpb_group_users_unsubscribe_dialog_confirm) === 'undefined' || pnfpb_group_users_unsubscribe_dialog_confirm === null ) {

				$j(this).append( '<div id="pnfpb_group_users_unsubscribe_dialog_confirm" class="pnfpb_group_users_unsubscribe_dialog_confirm" title="Unsubscribe" style="display:none;"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>'+pnfpb_ajax_object_onesignal_push.group_unsubscribe_dialog_text+'</div><div id="pnfpb-group-unsubscribe-dialog" title="Confirmation"><div id="pnfpb-group-unsubscribe-alert-msg" class="pnfpb-group-unsubscribe-alert-msg"></div></div>' );
				
			}
			
			var unsubscribe_button_text = pnfpb_ajax_object_onesignal_push.unsubscribe_button_text;
			
			var deviceid = currentToken;
			
			$j( "#pnfpb_group_users_unsubscribe_dialog_confirm" ).dialog({  
				resizable: false,
				height: "auto",
				closeText : '',
				modal: true,
				buttons: [{
      				text: unsubscribe_button_text,
					open: function() {
						$j(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_onesignal_push.subscribe_button_text_color+';background-color:'+pnfpb_ajax_object_onesignal_push.subscribe_button_color+';border:0px');
					},
      				click: function() {
								
						if (window.webkit && window.webkit.messageHandlers && window.webkit.messageHandlers.unsubscribeGroupid) {
       						window.webkit.messageHandlers.unsubscribeGroupid.postMessage({
                     			"message": groupId
       						});
						}								
								
						if (currentToken) {
							   
							deviceid = currentToken;
							
							var data = {
								action: 'icpushcallback',
								device_id:deviceid,
								bpgroup_id:groupId,
								pushtype: 'unsubscribe-group-button'
							};
								
							$j.post(pnfpb_ajax_object_onesignal_push.ajax_url, data, function(response) {
										            
			                	if (response != 'fail')
			                    {
    	                           if (response != 'duplicate'){
    	                                                        
										$j(unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
										$j(subscribebuttonname).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
										$j(unsubscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
										$j(subscribebuttonid).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
																
										$j(".pnfpb-group-unsubscribe-alert-msg").html("<p>"+pnfpb_ajax_object_onesignal_push.group_unsubscribe_dialog_text_confirm+"</p>");
																
										$j( "#pnfpb-group-unsubscribe-dialog" ).dialog();
																
			                        }
			                        else
			                        {
			                             console.log(__("Push notification unsubscription failed..try again!!",'PNFPB_TD'));
			                         }

			                       }
			                       else
			                       {           
                                        $j(".pnfpb-group-unsubscribe-alert-msg").html(__("Push notification unsubscription failed..try again!!",'PNFPB_TD'));
                                                            
                                         $j( "#pnfpb-group-unsubscribe-dialog" ).dialog();

			                             console.log(__("device update failed",'PNFPB_TD'));
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
	}	

	var pnfpb_push_notification_frontend_settings_element =  document.getElementsByClassName("pnfpb_push_notification_frontend_settings_submit");
	
	if (pnfpb_ajax_object_onesignal_push.userid > 0 && typeof(pnfpb_push_notification_frontend_settings_element) != 'undefined' && pnfpb_push_notification_frontend_settings_element != null) {
			
		
		var subscriptionoptions = '00000000001';
		var subscribeallshortcode = '0';
		var subscribepostactivitiesshortcode = '0';
		var subscribeallcommentsshortcode = '0';
		var subscribemypostshortcode = '0';
		var subscribeprivatemessagesshortcode = '0';
		var subscribenewmembershortcode = '0';
		var subscribefriendshiprequestshortcode = '0';
		var subscribefriendshipacceptshortcode = '0';
		var subscribeuseravatarshortcode = '0';
		var subscribecoverimageshortcode = '0';
		var subscribegroupinviteshortcode = '0';
		var subscribegroupdetailsshortcode = '0';
		var unsubscribeallshortcode = '0';
		var subscribeactivitiesshortcode = '0';
		
		var data = {
			action: 'icpushcallback',
			onesignal_get_subscriptionoptions_id:pnfpbonesignalid,
			pushtype: 'onesignal_get_frontend_subscriptions'
		};
							
		$j.post(pnfpb_ajax_object_onesignal_push.ajax_url, data, function(responseajax) {
					
					var response = JSON.parse(responseajax);
												
					var subscriptionoptions = response.subscriptionoptions;
			
					if (subscriptionoptions === null) {
						subscriptionoptions = '1000000000000';
					}
					
					var subscriptionoptionsarray = subscriptionoptions.split('');
					
					if (subscriptionoptionsarray.length >= 4)
					{
						if (subscriptionoptionsarray[1] === '1'  || subscriptionoptionsarray[0] === '1')
						{
  							$j('#pnfpb_ic_fcm_front_post_enable').prop('checked', true);
						}
						else 
						{
							$j('#pnfpb_ic_fcm_front_post_enable').prop('checked', false);
						}
									
						if ((subscriptionoptionsarray[11] && subscriptionoptionsarray[11] === '1') || subscriptionoptionsarray[0] === '1')
						{
  							$j('#pnfpb_ic_fcm_front_bactivity_enable').prop('checked', true);

						}
						else 
						{
							$j('#pnfpb_ic_fcm_front_bactivity_enable').prop('checked', false);
						}									
							
						if (subscriptionoptionsarray[2] === '1' || subscriptionoptionsarray[0] === '1')
						{
  							$j('#pnfpb_ic_fcm_front_bcomment_enable').prop('checked', true);
						}
						else 
						{
							$j('#pnfpb_ic_fcm_front_bcomment_enable').prop('checked', false);
						}
								
						if (subscriptionoptionsarray[3] === '1' || subscriptionoptionsarray[0] === '1')
						{
  							$j('#pnfpb_ic_fcm_front_mybcomment_enable').prop('checked', true);
						}
						else 
						{
							$j('#pnfpb_ic_fcm_front_mybcomment_enable').prop('checked', false);
						}								
							
						if ((subscriptionoptionsarray[4] && subscriptionoptionsarray[4] === '1') || subscriptionoptionsarray[0] === '1')
						{
  							$j('#pnfpb_ic_fcm_front_bprivatemessage_enable').prop('checked', true);

						}
						else 
						{
							$j('#pnfpb_ic_fcm_front_bprivatemessage_enable').prop('checked', false);
						}
															
															
						if ((subscriptionoptionsarray[5] && subscriptionoptionsarray[5] === '1') || subscriptionoptionsarray[0] === '1')
						{
  							$j('#pnfpb_ic_fcm_front_new_member_enable').prop('checked', true);

						}
						else 
						{
							$j('#pnfpb_ic_fcm_front_new_member_enable').prop('checked', false);
						}
															
						if ((subscriptionoptionsarray[6] && subscriptionoptionsarray[6] === '1') || subscriptionoptionsarray[0] === '1')
						{
  							$j('#pnfpb_ic_fcm_front_friendship_request_enable').prop('checked', true);

						}
						else 
						{
							$j('#pnfpb_ic_fcm_front_friendship_request_enable').prop('checked', false);
						}
															
						if ((subscriptionoptionsarray[7] && subscriptionoptionsarray[7] === '1') || subscriptionoptionsarray[0] === '1')
						{
  							$j('#pnfpb_ic_fcm_front_friendship_accept_enable').prop('checked', true);

						}
						else 
						{
							$j('#pnfpb_ic_fcm_front_friendship_accept_enable').prop('checked', false);
						}
															
						if ((subscriptionoptionsarray[8] && subscriptionoptionsarray[8] === '1') || subscriptionoptionsarray[0] === '1')
						{
  							$j('#pnfpb_ic_fcm_front_avatar_change_enable').prop('checked', true);

						}
						else 
						{
							$j('#pnfpb_ic_fcm_front_avatar_change_enable').prop('checked', false);
						}
															
						if ((subscriptionoptionsarray[9] && subscriptionoptionsarray[9] === '1') || subscriptionoptionsarray[0] === '1')
						{
  							$j('#pnfpb_ic_fcm_front_cover_image_change_enable').prop('checked', true);

						}
						else 
						{
							$j('#pnfpb_ic_fcm_front_cover_image_change_enable').prop('checked', false);
						}
											
						if ((subscriptionoptionsarray[12] && subscriptionoptionsarray[12] === '1') || subscriptionoptionsarray[0] === '1')
						{
  							$j('#pnfpb_ic_fcm_front_group_details_update_enable').prop('checked', true);

						}
						else 
						{
							$j('#pnfpb_ic_fcm_front_group_details_update_enable').prop('checked', false);
						}
											
						if ((subscriptionoptionsarray[13] && subscriptionoptionsarray[13] === '1') || subscriptionoptionsarray[0] === '1')
						{
  							$j('#pnfpb_ic_fcm_front_group_invite_enable').prop('checked', true);
						}
						else 
						{
							$j('#pnfpb_ic_fcm_front_group_invite_enable').prop('checked', false);
						}											
					}					
					
					$j(".pnfpb_push_notification_frontend_settings_submit").on( "click", function(event) {
			
					event.preventDefault();
			
					$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
					$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('error');
					$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('info');
					$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Processing...','PNFPB_TD'));
					$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');										
			

					if ($j('#pnfpb_ic_fcm_front_post_enable').is(":checked"))
					{
						subscribepostactivitiesshortcode = '1';
					}
					else 
					{
						subscribepostactivitiesshortcode = '0';
					}
						
					if ($j('#pnfpb_ic_fcm_front_bactivity_enable').is(":checked"))
					{
						subscribeactivitiesshortcode = '1';
					}
					else 
					{
						subscribeactivitiesshortcode = '0';
					}							
						
					if ($j('#pnfpb_ic_fcm_front_bcomment_enable').is(":checked"))
					{
						subscribeallcommentsshortcode = '1';
						subscribemypostshortcode = '0';
					}
					else 
					{
						subscribeallcommentsshortcode = '0';
					}
			
					if ($j('#pnfpb_ic_fcm_front_mybcomment_enable').is(":checked"))
					{
						subscribemypostshortcode = '1';
						subscribeallcommentsshortcode = '0';
					}
					else 
					{
						subscribemypostshortcode = '0';
					}				
						
					if ($j('#pnfpb_ic_fcm_front_bprivatemessage_enable').is(":checked"))
					{
						subscribeprivatemessagesshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';			
								
					}
					else 
					{
						subscribeprivatemessagesshortcode = '0';
					}
						
					if ($j('#pnfpb_ic_fcm_front_new_member_enable').is(":checked"))
					{
						subscribenewmembershortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
					}
					else 
					{

						subscribenewmembershortcode = '0';
					}
						
					if ($j('#pnfpb_ic_fcm_front_friendship_request_enable').is(":checked"))
					{
						subscribefriendshiprequestshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
					}
					else 
					{
						subscribefriendshiprequestshortcode = '0';
					}
						
					if ($j('#pnfpb_ic_fcm_front_friendship_accept_enable').is(":checked"))
					{
						subscribefriendshipacceptshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
					}
					else 
					{
						subscribefriendshipacceptshortcode = '0';
					}
						
					if ($j('#pnfpb_ic_fcm_front_avatar_change_enable').is(":checked"))
					{
						subscribeuseravatarshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
					}
					else 
					{
						subscribeuseravatarshortcode = '0';
					}
						
					if ($j('#pnfpb_ic_fcm_front_cover_image_change_enable').is(":checked"))
					{
						subscribecoverimageshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
					}
					else 
					{
						subscribecoverimageshortcode = '0';
					}
			
					if ($j('#pnfpb_ic_fcm_front_group_invite_enable').is(":checked"))
					{
						subscribegroupinviteshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
					}
					else 
					{
						subscribegroupinviteshortcode = '0';
					}
			
					if ($j('#pnfpb_ic_fcm_front_group_details_update_enable').is(":checked"))
					{
						subscribegroupdetailsshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
					}
					else 
					{
						subscribegroupdetailsshortcode = '0';
					}				
			
					subscriptionoptions = subscribeallshortcode + subscribepostactivitiesshortcode + subscribeallcommentsshortcode + subscribemypostshortcode + subscribeprivatemessagesshortcode + subscribenewmembershortcode + subscribefriendshiprequestshortcode + subscribefriendshipacceptshortcode + subscribeuseravatarshortcode + subscribecoverimageshortcode + unsubscribeallshortcode + subscribeactivitiesshortcode + subscribegroupdetailsshortcode + subscribegroupinviteshortcode;
						
					var data = {
						action: 'icpushcallback',
						onesignal_subscriptionoptions:subscriptionoptions,
						pushtype: 'onesignal_frontend_subscriptions'
					};
							
					$j.post(pnfpb_ajax_object_onesignal_push.ajax_url, data, function(responseajax) {
					
						var response = JSON.parse(responseajax);
												
						subscriptionoptions = response.subscriptionoptions;

						var subscriptionoptionsarray = [];
												
						if (subscriptionoptions) {
							subscriptionoptionsarray = subscriptionoptions.split('');
						}								

						if (subscriptionoptionsarray.length >= 11)
						{
							$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('error');
							$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('info');
							$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('success');
							$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');
							$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Your notification settings have been saved','PNFPB_TD'));
					
							if (subscriptionoptionsarray[1] === '1')
							{
								$j('#pnfpb_ic_fcm_front_post_enable').prop('checked', true);
							}
							else 
							{
								$j('#pnfpb_ic_fcm_front_post_enable').prop('checked', false);
							}
								
							if (subscriptionoptionsarray[11] === '1')
							{
								$j('#pnfpb_ic_fcm_front_bactivity_enable').prop('checked', true);

							}
							else 
							{
								$j('#pnfpb_ic_fcm_front_bactivity_enable').prop('checked', false);
							}									
						
							if (subscriptionoptionsarray[2] === '1')
							{
								$j('#pnfpb_ic_fcm_front_bcomment_enable').prop('checked', true);
							}
							else 
							{
								$j('#pnfpb_ic_fcm_front_bcomment_enable').prop('checked', false);
							}
								
							if (subscriptionoptionsarray[3] === '1')
							{
								$j('#pnfpb_ic_fcm_front_mybcomment_enable').prop('checked', true);
							}
							else 
							{
								$j('#pnfpb_ic_fcm_front_mybcomment_enable').prop('checked', false);
							}									
						
							if (subscriptionoptionsarray[4] === '1')
							{
								$j('#pnfpb_ic_fcm_front_bprivatemessage_enable').prop('checked', true);

							}
							else 
							{
								$j('#pnfpb_ic_fcm_front_bprivatemessage_enable').prop('checked', false);
							}
														
														
							if (subscriptionoptionsarray[5] === '1')
							{
								$j('#pnfpb_ic_fcm_front_new_member_enable').prop('checked', true);

							}
							else 
							{
								$j('#pnfpb_ic_fcm_front_new_member_enable').prop('checked', false);
							}
														
							if (subscriptionoptionsarray[6] === '1')
							{
								$j('#pnfpb_ic_fcm_front_friendship_request_enable').prop('checked', true);

							}
							else 
							{
								$j('#pnfpb_ic_fcm_front_friendship_request_enable').prop('checked', false);
							}
														
							if (subscriptionoptionsarray[7] === '1')
							{
								$j('#pnfpb_ic_fcm_front_friendship_accept_enable').prop('checked', true);

							}
							else 
							{
								$j('#pnfpb_ic_fcm_front_friendship_accept_enable').prop('checked', false);
							}
														
							if (subscriptionoptionsarray[8] === '1')
							{
								$j('#pnfpb_ic_fcm_front_avatar_change_enable').prop('checked', true);

							}
							else 
							{
								$j('#pnfpb_ic_fcm_front_avatar_change_enable').prop('checked', false);
							}
														
							if (subscriptionoptionsarray[9] === '1')
							{
								$j('#pnfpb_ic_fcm_front_cover_image_change_enable').prop('checked', true);

							}
							else 
							{
								$j('#pnfpb_ic_fcm_front_cover_image_change_enable').prop('checked', false);
							}
								
							if (subscriptionoptionsarray[13] === '1')
							{
								$j('#pnfpb_ic_fcm_front_group_invite_enable').prop('checked', true);

							}
							else 
							{
								$j('#pnfpb_ic_fcm_front_group_invite_enable').prop('checked', false);
							}
								
							if (subscriptionoptionsarray[12] === '1')
							{
								$j('#pnfpb_ic_fcm_front_group_details_update_enable').prop('checked', true);

							}
							else 
							{
								$j('#pnfpb_ic_fcm_front_group_details_update_enable').prop('checked', false);
							}									

						}
						else 
						{
							$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
							$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('error');
							$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Error in saving notification settings','PNFPB_TD'));
							$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');
						}
					})
				})
			})

    }	
	
	OneSignal.push(function() {
  		OneSignal.getExternalUserId().then(function(externalUserId){
			//console.log(externalUserId);
			if (pnfpb_onesignal_userid) {
				var data = {
					action: 'icpushcallback',
					onesignal_externalid:pnfpbonesignalid,
					pushtype: 'onesignal_subscribed_users'
				};
								
				$j.post(pnfpb_ajax_object_onesignal_push.ajax_url, data, function(responseajax) {

		
				})
			}					
  		})
	})
})
