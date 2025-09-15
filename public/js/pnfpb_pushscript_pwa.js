/* This script is to update push notification subscriptions for mobile app webview */

var frontendsubscriptionOptions;

var pnfpbuserid;

var vapidKey = '';

var firebaseConfig;

var firebaseApp;

var messaging;

var hasFirebaseMessagingSupport;

var pnfpb_pushtoken_fromAndroid;

var pnfpb_pushtoken_fromflutter;

var pnfpbshortcodeactive;

var pnfpb_custom_post_types_mobile_app = JSON.parse(pnfpb_ajax_object_mobile_app_interface_script.pnfpb_show_custom_post_types);

const { __ } = wp.i18n;

var standalone = window.navigator.standalone,
userAgent = window.navigator.userAgent.toLowerCase(),
safari_pnfpb = /safari/.test(userAgent),
ios_pnfpb = /iphone|ipod|ipad/.test(userAgent);

var pnfpb_webview = false;

if (ios_pnfpb) {
if (!standalone && safari_pnfpb) {
  // Safari
  pnfpb_webview = false;
} else if (!standalone && !safari_pnfpb) {
  // iOS webview
  pnfpb_webview = true;
  PNFPB_from_Java_androidapp('');
  PNFPB_from_Flutter_mobileapp();	  	
};
} else {
if (userAgent.includes('wv')) {
  // Android webview
  pnfpb_webview = true;
  PNFPB_from_Java_androidapp('');
  PNFPB_from_Flutter_mobileapp();	  
} else {
  // Chrome
  pnfpb_webview = false;
}
};

if (window.webkit && window.webkit.messageHandlers && window.webkit.messageHandlers.pnfpbuserid) {
	window.webkit.messageHandlers.pnfpbuserid.postMessage({
				  "message": pnfpb_ajax_object_mobile_app_interface_script.userid
	});
}

function PNFPB_from_Flutter_mobileapp(pushtoken) {
	
	pnfpb_pushtoken_fromflutter = pushtoken;
 
	if (pnfpbuserid) {

		pnfpbuserid.postMessage(pnfpb_ajax_object_mobile_app_interface_script.userid);
	
	}
	
 	return pnfpb_pushtoken_fromflutter;
	
}

function PNFPB_from_Java_androidapp(pushtoken) {
	
	if (pnfpbuserid) {
 
		pnfpbuserid.postMessage(pnfpb_ajax_object_mobile_app_interface_script.userid);
	
	}
	
	if (Android) {
	 
		pnfpb_pushtoken_fromAndroid = Android.getFromAndroid();
				
	}
	
}

if (pnfpb_webview) {

	var $jwebview = jQuery.noConflict();

	$jwebview(document).ready(function() {

		var data = {
			action: 'icpushcallback',
			device_id:'',
			subscriptionoptions:'',
			nonce: pnfpb_ajax_object_mobile_app_interface_script.nonce,
			pushtype: 'icfirebasecred'
		};
		

		$jwebview.post(pnfpb_ajax_object_mobile_app_interface_script.ajax_url, data, async function(responseajax) {
			

			var firebasecredentialsobject = JSON.parse(responseajax);
			
					
			if (firebasecredentialsobject.apiKey && firebasecredentialsobject.apiKey != '') {
				
					firebaseConfig = {
						apiKey: firebasecredentialsobject.apiKey,
						authDomain: firebasecredentialsobject.authDomain,
						databaseURL: firebasecredentialsobject.databaseURL,
						projectId: firebasecredentialsobject.projectId,
						storageBucket: firebasecredentialsobject.storageBucket,
						messagingSenderId: firebasecredentialsobject.messagingSenderId,
						appId: firebasecredentialsobject.appId
					};
		
					vapidKey = firebasecredentialsobject.publicKey
				

					checkdeviceid_webview('');
				
					if ($jwebview(".pnfpb-push-subscribe-icon-shortcode").length) {

						mobileapp_subscribe_shortcode();
						
					}

					frontend_subscription_menu_webview('');
				
				if( $jwebview(".subscribe-notification-group").length ) {
				
					$jwebview(document).on( "click",".subscribe-notification-group", function(e) {
						e.preventDefault();
						var groupId = $jwebview(this).attr("data-group-id");
						var unsubscribebuttonname = '.unsubscribegroupbutton-'+groupId;
						var subscribebuttonname = '.subscribegroupbutton-'+groupId;
						var unsubscribebuttonid = '#unsubscribegroupbutton-'+groupId;
						var subscribebuttonid = '#subscribegroupbutton-'+groupId;										
						if( $jwebview("#pnfpb_group_users_subscribe_dialog_confirm").length === 0 ) {

							$jwebview(this).append( '<div id="pnfpb_group_users_subscribe_dialog_confirm" class="pnfpb_group_users_subscribe_dialog_confirm" title="Subscribe" style="display:none;"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>'+pnfpb_ajax_object_mobile_app_interface_script.group_subscribe_dialog_text+'</div><div id="pnfpb-group-unsubscribe-dialog" title="Confirmation"><div id="pnfpb-group-unsubscribe-alert-msg" class="pnfpb-group-unsubscribe-alert-msg"></div></div>' );
						}
 						var subscribe_button_text = pnfpb_ajax_object_mobile_app_interface_script.subscribe_button_text;
						$jwebview( "#pnfpb_group_users_subscribe_dialog_confirm" ).dialog({  
							resizable: false,
							height: "auto",
							closeText : '',
			   				modal: true,
			   				buttons: [{
      							text: subscribe_button_text,
								open: function() {
								$jwebview(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_mobile_app_interface_script.subscribe_button_text_color+';background-color:'+pnfpb_ajax_object_mobile_app_interface_script.subscribe_button_color+';border:0px');
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
									
									if (subscribeGroupid) {
										subscribeGroupid.postMessage(groupId);
									}								
									$jwebview(".pnfpb-group-unsubscribe-alert-msg").html("<p>"+pnfpb_ajax_object_mobile_app_interface_script.group_subscribe_dialog_text_confirm+"</p>");
			       			    	$jwebview( "#pnfpb-group-unsubscribe-dialog" ).dialog();
									$jwebview(subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
									$jwebview(unsubscribebuttonname).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
									$jwebview(subscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
									$jwebview(unsubscribebuttonid).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );														
						 	 		$jwebview( "#pnfpb_group_users_subscribe_dialog_confirm" ).dialog("close");
								},
								Cancel: function() {
									$jwebview( "#pnfpb_group_users_subscribe_dialog_confirm" ).dialog("close");
								}
							}]
    					})

					});
				}
				
				if( $jwebview(".unsubscribe-notification-group").length ) {
					
		    		$jwebview(document).on( "click",".unsubscribe-notification-group", function(e) {
						e.preventDefault();
						var groupId = $jwebview(this).attr("data-group-id");
						document.cookie = "pnfpb_group_push_notification_"+groupId + "; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;"				
						var unsubscribebuttonname = '.unsubscribegroupbutton-'+groupId;
						var subscribebuttonname = '.subscribegroupbutton-'+groupId;
						var unsubscribebuttonid = '#unsubscribegroupbutton-'+groupId;
						var subscribebuttonid = '#subscribegroupbutton-'+groupId;
						if( $jwebview("#pnfpb_group_users_unsubscribe_dialog_confirm").length === 0 ) {

							$jwebview(this).append( '<div id="pnfpb_group_users_unsubscribe_dialog_confirm" class="pnfpb_group_users_unsubscribe_dialog_confirm" title="Unsubscribe" style="display:none;"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>'+pnfpb_ajax_object_mobile_app_interface_script.group_unsubscribe_dialog_text+'</div><div id="pnfpb-group-unsubscribe-dialog" title="Confirmation"><div id="pnfpb-group-unsubscribe-alert-msg" class="pnfpb-group-unsubscribe-alert-msg"></div></div>' );
						}
						var unsubscribe_button_text = pnfpb_ajax_object_mobile_app_interface_script.unsubscribe_button_text;									
						$jwebview( "#pnfpb_group_users_unsubscribe_dialog_confirm" ).dialog({  
							resizable: false,
							height: "auto",
							closeText : '',
					    	modal: true,
							buttons: [{
      							text: unsubscribe_button_text,
								open: function() {
									$jwebview(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_mobile_app_interface_script.subscribe_button_text_color+';background-color:'+pnfpb_ajax_object_mobile_app_interface_script.subscribe_button_color+';border:0px');
								},
      							click: function() {
								
									if (window.webkit && window.webkit.messageHandlers && window.webkit.messageHandlers.unsubscribeGroupid) {
       									window.webkit.messageHandlers.unsubscribeGroupid.postMessage({
                     						"message": groupId
       									});
									}								
								
									if (unsubscribeGroupid) {
										unsubscribeGroupid.postMessage(groupId);
									}								
									$jwebview(unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
									$jwebview(subscribebuttonname).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
									$jwebview(unsubscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
									$jwebview(subscribebuttonid).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
									$jwebview(".pnfpb-group-unsubscribe-alert-msg").html("<p>"+pnfpb_ajax_object_mobile_app_interface_script.group_unsubscribe_dialog_text_confirm+"</p>");
									$jwebview( "#pnfpb-group-unsubscribe-dialog" ).dialog();
									$jwebview("#pnfpb_group_users_unsubscribe_dialog_confirm").dialog("close");
								},
								Cancel: function() {
									$jwebview( "#pnfpb_group_users_unsubscribe_dialog_confirm" ).dialog( "close" );
								}
							}]
						})
					})				
				}

			} else {
				
				$jwebview('.pnfpb_bell_icon_custom_prompt_loader').hide();
					
				$jwebview('.pnfpb_frontend_subscriptions_options_menu_all').show();	
			}
		});
		
		async function frontend_subscription_menu_webview(refreshedToken) {

			if (pnfpb_webview) {

				//For webview mobile apps send subscriptionoptions from webview to app
				//
			
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
				var subscribemarkasfavouriteshortcode = '0';
				var unsubscribeallshortcode = '0';
				var subscribeactivitiesshortcode = '0';	
				
				var deviceid = false;
				
				if (pnfpb_pushtoken_fromflutter && pnfpb_pushtoken_fromflutter != '') {
			   
					deviceid = pnfpb_pushtoken_fromflutter;

				}

				if (pnfpb_pushtoken_fromAndroid  && pnfpb_pushtoken_fromAndroid != '') {
			   
					deviceid = pnfpb_pushtoken_fromAndroid;

				}				
			
				$jwebview(".pnfpb_push_notification_frontend_settings_submit").on( "click", function(event) {

					$jwebview('.pnfpb_bell_icon_custom_prompt_loader_frontend').show();
					
					$jwebview('.pnfpb_frontend_subscriptions_options_menu_all').hide();
					
					event.preventDefault();
		
					$jwebview('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
					$jwebview('.pnfpb_ic_front_push_notification_settings_messages').removeClass('error');
					$jwebview('.pnfpb_ic_front_push_notification_settings_messages').addClass('info');
					$jwebview('.pnfpb_ic_front_push_notification_settings_text').html(__('Processing...',"push-notification-for-post-and-buddypress"));
					$jwebview('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');										
		

					if ($jwebview('#pnfpb_ic_fcm_front_post_enable').is(":checked"))
					{
						subscribepostactivitiesshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';							
					}
					else 
					{
						subscribepostactivitiesshortcode = '0';
					}
					
					if ($jwebview('#pnfpb_ic_fcm_front_bactivity_enable').is(":checked"))
					{
						subscribeactivitiesshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';							
					
					}
					else 
					{
						subscribeactivitiesshortcode = '0';
					}							
					
					if ($jwebview('#pnfpb_ic_fcm_front_bcomment_enable').is(":checked"))
					{
						subscribeallcommentsshortcode = '1';
						subscribemypostshortcode = '0';
					}
					else 
					{
						subscribeallcommentsshortcode = '0';
					}
				
					if ($jwebview('#pnfpb_ic_fcm_front_bprivatemessage_enable').is(":checked"))
					{
						subscribeprivatemessagesshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';			
							
					}
					else 
					{
						subscribeprivatemessagesshortcode = '0';
					}
					
					if ($jwebview('#pnfpb_ic_fcm_front_new_member_enable').is(":checked"))
					{
						subscribenewmembershortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
					}
					else 
					{

						subscribenewmembershortcode = '0';
					}
					
					if ($jwebview('#pnfpb_ic_fcm_front_friendship_request_enable').is(":checked"))
					{
						subscribefriendshiprequestshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
					}
					else 
					{
						subscribefriendshiprequestshortcode = '0';
					}
					
					if ($jwebview('#pnfpb_ic_fcm_front_friendship_accept_enable').is(":checked"))
					{
						subscribefriendshipacceptshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
					}
					else 
					{
						subscribefriendshipacceptshortcode = '0';
					}
					
					if ($jwebview('#pnfpb_ic_fcm_front_avatar_change_enable').is(":checked"))
					{
						subscribeuseravatarshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
					}
					else 
					{
						subscribeuseravatarshortcode = '0';
					}
					
					if ($jwebview('#pnfpb_ic_fcm_front_cover_image_change_enable').is(":checked"))
					{
						subscribecoverimageshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
					}
					else 
					{
						subscribecoverimageshortcode = '0';
					}
		
					if ($jwebview('#pnfpb_ic_fcm_front_group_invite_enable').is(":checked"))
					{
						subscribegroupinviteshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
					}
					else 
					{
						subscribegroupinviteshortcode = '0';
					}
		
					if ($jwebview('#pnfpb_ic_fcm_front_group_details_update_enable').is(":checked"))
					{
						subscribegroupdetailsshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
					}
					else 
					{
						subscribegroupdetailsshortcode = '0';
					}
					
					if ($jwebview('#pnfpb_ic_fcm_front_favourite_enable').is(":checked"))
					{
						subscribemarkasfavouriteshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
					}
					else 
					{
						subscribemarkasfavouriteshortcode = '0';
					}					
					
					var frontend_custom_post_types_mobile_app = '';
					
					var pnfpb_custom_post_types_subscriptions = [];
					
					if (pnfpb_custom_post_types_mobile_app.length > 0) {

						for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types_mobile_app.length; pnfpb_post_type_element++) {
	
							if ($jwebview('.pnfpb_ic_fcm_front_subscription_'+pnfpb_custom_post_types_mobile_app[pnfpb_post_type_element]+'_enable').is(":checked"))
							{
	
								pnfpb_custom_post_types_subscriptions[pnfpb_post_type_element] = '1';
				
								subscribeallshortcode = '0'; 
								unsubscribeallshortcode = '0';
																		
							}
							else 
							{
								pnfpb_custom_post_types_subscriptions[pnfpb_post_type_element] = '0';
							}								

						}
	
					}					
					
					if (pnfpb_custom_post_types_subscriptions.length > 0) {

						for (var pnfpb_post_type_element = 0; pnfpb_post_type_element <= 10; pnfpb_post_type_element++) {
							
							if (pnfpb_post_type_element <  pnfpb_custom_post_types_subscriptions.length && pnfpb_custom_post_types_subscriptions[pnfpb_post_type_element] ) {

								frontend_custom_post_types_mobile_app  = frontend_custom_post_types_mobile_app + pnfpb_custom_post_types_subscriptions[pnfpb_post_type_element];
								
							} else {
								
								frontend_custom_post_types_mobile_app  = frontend_custom_post_types_mobile_app + '0';
							}
								
						}

					}	else {
						
						frontend_custom_post_types_mobile_app = '0000000000';
						
					}				
		
					subscriptionoptions = subscribeallshortcode + subscribepostactivitiesshortcode + subscribeallcommentsshortcode + subscribemypostshortcode + subscribeprivatemessagesshortcode + subscribenewmembershortcode + subscribefriendshiprequestshortcode + subscribefriendshipacceptshortcode + unsubscribeallshortcode + subscribeuseravatarshortcode + subscribecoverimageshortcode + subscribeactivitiesshortcode + subscribegroupdetailsshortcode + subscribegroupinviteshortcode + frontend_custom_post_types_mobile_app + subscribemarkasfavouriteshortcode;					

		
					if (window.webkit && window.webkit.messageHandlers && window.webkit.messageHandlers.frontendsubscriptionOptions) {
					   window.webkit.messageHandlers.frontendsubscriptionOptions.postMessage({
						 "message": subscriptionoptions
					   });
					}
		
					if (frontendsubscriptionOptions && deviceid) {
			
						frontendsubscriptionOptions.postMessage(subscriptionoptions);
						
						var data = {
							action: 'icpushcallback',
							device_id:deviceid,
							subscriptionoptions:subscriptionoptions,
							nonce: pnfpb_ajax_object_mobile_app_interface_script.nonce,
							pushtype: 'subscribe-button'
						};
									
						$jwebview.post(pnfpb_ajax_object_mobile_app_interface_script.ajax_url, data, function(responseajax) {
							
								$jwebview('.pnfpb_bell_icon_custom_prompt_loader_frontend').hide();
							
								$jwebview('.pnfpb_frontend_subscriptions_options_menu_all').show();
	
								var response = JSON.parse(responseajax);						
			
								$jwebview('.pnfpb_ic_front_push_notification_settings_messages').removeClass('error');
								$jwebview('.pnfpb_ic_front_push_notification_settings_messages').removeClass('info');
								$jwebview('.pnfpb_ic_front_push_notification_settings_messages').addClass('success');
								$jwebview('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');
								$jwebview('.pnfpb_ic_front_push_notification_settings_text').html(__('Your notification settings have been saved',"push-notification-for-post-and-buddypress"));	
						});
					}
					else 
					{
						if ((pnfpb_pushtoken_fromflutter && pnfpb_pushtoken_fromflutter !== '') || (pnfpb_pushtoken_fromAndroid && pnfpb_pushtoken_fromAndroid != '')) {
							
							$jwebview('.pnfpb_bell_icon_custom_prompt_loader_frontend').hide();
							$jwebview('.pnfpb_frontend_subscriptions_options_menu_all').show();
							$jwebview('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
							$jwebview('.pnfpb_ic_front_push_notification_settings_messages').addClass('error');
							$jwebview('.pnfpb_ic_front_push_notification_settings_text').html(__('Error in saving notification settings',"push-notification-for-post-and-buddypress"));
							$jwebview('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');
							
						} else {
							
							if (frontendsubscriptionOptions) {
								frontendsubscriptionOptions.postMessage(subscriptionoptions);
							}
									
							$jwebview('.pnfpb_ic_front_push_notification_settings_messages').removeClass('error');
							$jwebview('.pnfpb_ic_front_push_notification_settings_messages').removeClass('info');
							$jwebview('.pnfpb_ic_front_push_notification_settings_messages').addClass('success');
							$jwebview('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');
							$jwebview('.pnfpb_ic_front_push_notification_settings_text').html(__('Your notification settings have been saved',"push-notification-for-post-and-buddypress"));
						}
					}
				})							
		
			}
			else 
			{
				$jwebview('.pnfpb_bell_icon_custom_prompt_loader_frontend').hide();
				$jwebview('.pnfpb_frontend_subscriptions_options_menu_all').show();
				$jwebview('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
				$jwebview('.pnfpb_ic_front_push_notification_settings_messages').removeClass('info');
				$jwebview('.pnfpb_ic_front_push_notification_settings_messages').addClass('error');
				$jwebview('.pnfpb_ic_front_push_notification_settings_text').html(__('Notification permission not granted by user. Error in saving notification settings',"push-notification-for-post-and-buddypress"));
				$jwebview('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');	
			}
		}

		async function checkdeviceid_webview() {
			
			var pnfpb_bell_icon_shortcode_subscribe_favourite_checkbox = '';

			var pnfpb_bell_icon_prompt_subscribe_push_type_checkbox = ['1','0','0','0','0','0','0','0','0','0','0','0','0','0'];

			var pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox = [];

			var pnfpb_bell_icon_subscribe_push_type_checkbox = [];

			var pnfpb_bell_icon_subscribe_custom_post_checkbox = [];				

			var pnfpb_custom_post_types = JSON.parse(pnfpb_ajax_object_mobile_app_interface_script.pnfpb_show_custom_post_types);


			for (var pnfpb_custom_type_element = 0; pnfpb_custom_type_element < pnfpb_custom_post_types.length; pnfpb_custom_type_element++) {

				if (pnfpb_custom_post_types[pnfpb_custom_type_element] !== 'buddypress') {

					pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox.push('0');

					pnfpb_bell_icon_subscribe_custom_post_checkbox.push('0');

				}

			}

			var pnfpb_show_push_notify_types = JSON.parse(pnfpb_ajax_object_mobile_app_interface_script.pnfpb_show_push_notify_types);					
			
			var isadminpage = 'no';
						
			if (window.location.href.match('wp-admin') !== null) {
				isadminpage = 'yes';
			}			
			deviceid = '';
			
			$jwebview('.pnfpb_bell_icon_custom_prompt_loader_frontend').show();
							
			$jwebview('.pnfpb_frontend_subscriptions_options_menu_all').hide();
		
			if( $jwebview(".pnfpb-push-subscribe-icon-shortcode").length || $jwebview(".pnfpb_push_notification_frontend_settings_submit").length )
			{
				pnfpbshortcodeactive = 'yes';
			}						
		
			if (pnfpb_pushtoken_fromflutter && pnfpb_pushtoken_fromflutter != '') {
			   
				deviceid = pnfpb_pushtoken_fromflutter;

			}

			if (pnfpb_pushtoken_fromAndroid  && pnfpb_pushtoken_fromAndroid != '') {
			   
				deviceid = pnfpb_pushtoken_fromAndroid;

			}
			
			var pnfpb_bell_icon_subscribe_push_type_checkbox = ['1','0','0','0','0','0','0','0','0','0','0','0','0','0'];

			var pnfpb_bell_icon_subscription_options_custom_prompt = '10000000000000';

			var pnfpb_bell_icon_prompt_subscription_options_custom_prompt = '10000000000000';

			var pnfpb_bell_icon_prompt_subscribe_push_type_checkbox = ['1','0','0','0','0','0','0','0','0','0','0','0','0','0'];

			$jwebview('.pnfpb-push-subscribe-icon-shortcode').show();

	
			var data = {
				action: 'icpushcallback',
				device_id:deviceid,
				isadminpage:isadminpage,
				pnfpbshortcodeactive:pnfpbshortcodeactive,
				nonce: pnfpb_ajax_object_mobile_app_interface_script.nonce,
				pnfpb_endpoint:'',
				pnfpb_options:vapidKey,								
				pushtype: 'checkdeviceid'
			};
				
			$jwebview.post(pnfpb_ajax_object_mobile_app_interface_script.ajax_url, data, function(response) {
				
				var responseobject = JSON.parse(response);	

				subscriptionoptions = responseobject.subscriptionoptions;
			
				subscriptionoptionsarray = subscriptionoptions.split('');
										
				if (subscriptionoptionsarray.length >= 4)
				{
		
					if (subscriptionoptionsarray[1] === '1'  || subscriptionoptionsarray[0] === '1')
					{
					  	$jwebview('#pnfpb_ic_fcm_front_post_enable').prop('checked', true);
					}
					else 
					{
						$jwebview('#pnfpb_ic_fcm_front_post_enable').prop('checked', false);
					}
					
					if ((subscriptionoptionsarray[11] && subscriptionoptionsarray[11] === '1') || subscriptionoptionsarray[0] === '1')
					{
					  	$jwebview('#pnfpb_ic_fcm_front_bactivity_enable').prop('checked', true);

					}
					else 
					{
						$jwebview('#pnfpb_ic_fcm_front_bactivity_enable').prop('checked', false);
					}									
			
					if (subscriptionoptionsarray[2] === '1' || subscriptionoptionsarray[3] === '1' || subscriptionoptionsarray[0] === '1')
					{
					  	$jwebview('#pnfpb_ic_fcm_front_bcomment_enable').prop('checked', true);
					}
					else 
					{
						$jwebview('#pnfpb_ic_fcm_front_bcomment_enable').prop('checked', false);
					}
			
					if ((subscriptionoptionsarray[4] && subscriptionoptionsarray[4] === '1') || subscriptionoptionsarray[0] === '1')
					{
					  	$jwebview('#pnfpb_ic_fcm_front_bprivatemessage_enable').prop('checked', true);

					}
					else 
					{
						$jwebview('#pnfpb_ic_fcm_front_bprivatemessage_enable').prop('checked', false);
					}
											
											
					if ((subscriptionoptionsarray[5] && subscriptionoptionsarray[5] === '1') || subscriptionoptionsarray[0] === '1')
					{
					  	$jwebview('#pnfpb_ic_fcm_front_new_member_enable').prop('checked', true);

					}
					else 
					{
						$jwebview('#pnfpb_ic_fcm_front_new_member_enable').prop('checked', false);
					}
											
					if ((subscriptionoptionsarray[6] && subscriptionoptionsarray[6] === '1') || subscriptionoptionsarray[0] === '1')
					{
					  	$jwebview('#pnfpb_ic_fcm_front_friendship_request_enable').prop('checked', true);

					}
					else 
					{
						$jwebview('#pnfpb_ic_fcm_front_friendship_request_enable').prop('checked', false);
					}
											
					if ((subscriptionoptionsarray[7] && subscriptionoptionsarray[7] === '1') || subscriptionoptionsarray[0] === '1')
					{
					  	$jwebview('#pnfpb_ic_fcm_front_friendship_accept_enable').prop('checked', true);

					}
					else 
					{
						$jwebview('#pnfpb_ic_fcm_front_friendship_accept_enable').prop('checked', false);
					}
											
					if ((subscriptionoptionsarray[9] && subscriptionoptionsarray[9] === '1') || subscriptionoptionsarray[0] === '1')
					{
					  	$jwebview('#pnfpb_ic_fcm_front_avatar_change_enable').prop('checked', true);

					}
					else 
					{
						$jwebview('#pnfpb_ic_fcm_front_avatar_change_enable').prop('checked', false);
					}
												
					if ((subscriptionoptionsarray[10] && subscriptionoptionsarray[10] === '1') || subscriptionoptionsarray[0] === '1')
					{
					  	$jwebview('#pnfpb_ic_fcm_front_cover_image_change_enable').prop('checked', true);

					}
					else 
					{
						$jwebview('#pnfpb_ic_fcm_front_cover_image_change_enable').prop('checked', false);
					}
				
					if ((subscriptionoptionsarray[12] && subscriptionoptionsarray[12] === '1') || subscriptionoptionsarray[0] === '1')
					{
					  	$jwebview('#pnfpb_ic_fcm_front_group_details_update_enable').prop('checked', true);

					}
					else 
					{
						$jwebview('#pnfpb_ic_fcm_front_group_details_update_enable').prop('checked', false);
					}
							
					if ((subscriptionoptionsarray[13] && subscriptionoptionsarray[13] === '1') || subscriptionoptionsarray[0] === '1')
					{
					 	$jwebview('#pnfpb_ic_fcm_front_group_invite_enable').prop('checked', true);

					}
					else 
					{
						$jwebview('#pnfpb_ic_fcm_front_group_invite_enable').prop('checked', false);
					}
					
					if ((subscriptionoptionsarray[25] && subscriptionoptionsarray[25] === '1') || subscriptionoptionsarray[0] === '1')
					{
					 	$jwebview('#pnfpb_ic_fcm_front_favourite_enable').prop('checked', true);

					}
					else 
					{
						$jwebview('#pnfpb_ic_fcm_front_favourite_enable').prop('checked', false);
					}					
					
					if (subscriptionoptionsarray.length > 14) {

						var subscription_options_element = 14;

						for (var pnfpb_frontend_post_type_element = 0; pnfpb_frontend_post_type_element < pnfpb_custom_post_types_mobile_app.length; pnfpb_frontend_post_type_element++) {
	
							if (subscriptionoptionsarray[subscription_options_element] === '1'  || subscriptionoptionsarray[0] === '1')
							{
								$jwebview('.pnfpb_ic_fcm_front_subscription_'+pnfpb_custom_post_types_mobile_app[pnfpb_frontend_post_type_element]+'_enable').prop('checked', true);
														
							}
							else 
							{
								$jwebview('.pnfpb_ic_fcm_front_subscription_'+pnfpb_custom_post_types_mobile_app[pnfpb_frontend_post_type_element]+'_enable').prop('checked', false);

							}
														
							subscription_options_element++;

						}

					}

				}
				
				$jwebview('.pnfpb_bell_icon_custom_prompt_loader_frontend').hide();
							
				$jwebview('.pnfpb_frontend_subscriptions_options_menu_all').show();
			
				if( $jwebview(".pnfpb-push-subscribe-icon-shortcode").length) {

					if (subscriptionoptionsarray[0] === '1')
					{

						$jwebview('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked', true);


						pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '1';

					}
					else 
					{

						$jwebview('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked', false);


						pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';

					}

					if (subscriptionoptionsarray[25] && subscriptionoptionsarray[25] === '1')
					{
						$jwebview('#pnfpb_bell_icon_prompt_subscription_favourite_enable_shortcode').prop('checked', true);

					}
					else 
					{
						$jwebview('#pnfpb_bell_icon_prompt_subscription_favourite_enable_shortcode').prop('checked', false);
					}												

					if (subscriptionoptionsarray[12] === '1' && subscriptionoptionsarray[0] !== '1')
					{

						$jwebview('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable_shortcode').prop('checked', true);


						pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '1';

					}
					else 
					{

						$jwebview('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable_shortcode').prop('checked', false);


						pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '0';

					}

					if (subscriptionoptionsarray[13] === '1' && subscriptionoptionsarray[0] !== '1')
					{

						$jwebview('.pnfpb_bell_icon_prompt_subscription_group_invite_enable_shortcode').prop('checked', true);


						pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '1';

					}
					else 
					{

						$jwebview('.pnfpb_bell_icon_prompt_subscription_group_invite_enable_shortcode').prop('checked', false);


						pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '0';

					}

					if (subscriptionoptionsarray.length > 0) {

						for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < 12; pnfpb_post_type_element++) {

							if (pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'unsubscribe-all' && pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'all') {	

								if (subscriptionoptionsarray[pnfpb_post_type_element] === '1' && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
								{
									$jwebview('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable_shortcode').prop('checked', true);

									pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_post_type_element] = '1';

								}
								else 
								{
									if (subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1') {

										$jwebview('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable_shortcode').prop('checked', false);

										pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_post_type_element] = '0';

									}															
								}

							} else {

								if (pnfpb_show_push_notify_types[pnfpb_post_type_element] === 'all' && subscriptionoptionsarray[0] === '1' )
								{

									$jwebview('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[0]+'_enable_shortcode').prop('checked', true);

									pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';

								} else {

									if (subscriptionoptionsarray[8] === '1' ) {

										pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';

									}
								}

							}


						}

					}													

					if (subscriptionoptionsarray.length > 14) {

						var subscription_options_element = 14;

						for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {


							if (subscriptionoptionsarray[subscription_options_element] === '1' && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
							{
								$jwebview('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable_shortcode').prop('checked', true);


								pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
							}
							else 
							{
								$jwebview('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable_shortcode').prop('checked', false);


								pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
							}

							subscription_options_element++;

						}

					}

					$jwebview('.pnfpb_bell_icon_custom_prompt_loader_shortcode').hide();

					$jwebview('.pnfpb-push-subscribe-options-button-container-shortcode').show();

					$jwebview('.pnfpb-push-subscribe-button-shortcode').prop('disabled', false);

					$jwebview('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', false);													
				}
			})		
		}

		async function mobileapp_subscribe_shortcode() {
			
			if( $jwebview(".pnfpb-push-subscribe-icon-shortcode").length  && 
			   ((pnfpb_pushtoken_fromflutter && pnfpb_pushtoken_fromflutter !== '') || 
				(pnfpb_pushtoken_fromAndroid && pnfpb_pushtoken_fromAndroid != ''))) {
				
				var pnfpb_bell_icon_shortcode_subscribe_favourite_checkbox = '';

				var pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox = [];
				
				var pnfpb_bell_icon_prompt_subscribe_push_type_checkbox = ['1','0','0','0','0','0','0','0','0','0','0','0','0','0'];

				var pnfpb_bell_icon_subscribe_push_type_checkbox = [];

				var pnfpb_bell_icon_subscribe_custom_post_checkbox = [];				

				var pnfpb_custom_post_types = JSON.parse(pnfpb_ajax_object_mobile_app_interface_script.pnfpb_show_custom_post_types);

				for (var pnfpb_custom_type_element = 0; pnfpb_custom_type_element < pnfpb_custom_post_types.length; pnfpb_custom_type_element++) {

					if (pnfpb_custom_post_types[pnfpb_custom_type_element] !== 'buddypress') {

						pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox.push('0');

						pnfpb_bell_icon_subscribe_custom_post_checkbox.push('0');

					}

				}

				var pnfpb_show_push_notify_types = JSON.parse(pnfpb_ajax_object_mobile_app_interface_script.pnfpb_show_push_notify_types);
	
				var subscriptionoptions = '00000000000';
			
				var subscriptionoptionsarray = subscriptionoptions.split('');
						
				pnfpbshortcodeactive = 'no';
			
				var isadminpage = 'no';
			
				if (window.location.href.match('wp-admin') !== null) {
					
					isadminpage = 'yes';
					
				}
			
				if( $jwebview(".pnfpb-push-subscribe-icon-shortcode").length )
				{
					pnfpbshortcodeactive = 'yes';
				}
			
				deviceid = false;
				
				if (pnfpb_pushtoken_fromflutter) {
								   
					deviceid = pnfpb_pushtoken_fromflutter;
					
				}
				
				if (pnfpb_pushtoken_fromAndroid) {
								   
					deviceid = pnfpb_pushtoken_fromAndroid;
					
				}
				
				$jwebview('.pnfpb_shortcode_popup_close').on( "click", function(event) {

					event.stopPropagation(); 

					event.preventDefault();

					$jwebview('.pnfpb-push-subscribe-button-layout-shortcode').hide();

				});				
				
		
				
				var pnfpb_popup_subscribe_text = __("You are subscribed to push notification",'push-notification-for-post-and-buddypress');

				if (pnfpb_ajax_object_mobile_app_interface_script.pnfpb_ic_fcm_popup_subscribe_message && pnfpb_ajax_object_mobile_app_interface_script.pnfpb_ic_fcm_popup_subscribe_message != '') {

					pnfpb_popup_subscribe_text = pnfpb_ajax_object_mobile_app_interface_script.pnfpb_ic_fcm_popup_subscribe_message;

				}

				var pnfpb_popup_unsubscribe_text = __("Push notification not subscribed",'push-notification-for-post-and-buddypress');

				if (pnfpb_ajax_object_mobile_app_interface_script.pnfpb_ic_fcm_popup_unsubscribe_message && pnfpb_ajax_object_mobile_app_interface_script.pnfpb_ic_fcm_popup_unsubscribe_message != '') {

					pnfpb_popup_unsubscribe_text = pnfpb_ajax_object_mobile_app_interface_script.pnfpb_ic_fcm_popup_unsubscribe_message;

				}

				var pnfpb_popup_wait_message = __("Please wait...processing",'push-notification-for-post-and-buddypress');

				if (pnfpb_ajax_object_mobile_app_interface_script.pnfpb_ic_fcm_popup_wait_message && pnfpb_ajax_object_mobile_app_interface_script.pnfpb_ic_fcm_popup_wait_message != '') {

					pnfpb_popup_wait_message = pnfpb_ajax_object_mobile_app_interface_script.pnfpb_ic_fcm_popup_wait_message;

				}

				var pnfpb_popup_subscribe_button = __("Subscribe",'push-notification-for-post-and-buddypress');

				if (pnfpb_ajax_object_mobile_app_interface_script.pnfpb_ic_fcm_popup_subscribe_button && pnfpb_ajax_object_mobile_app_interface_script.pnfpb_ic_fcm_popup_subscribe_button != '') {

					pnfpb_popup_subscribe_button = pnfpb_ajax_object_mobile_app_interface_script.pnfpb_ic_fcm_popup_subscribe_button;

				}

				var pnfpb_popup_unsubscribe_button = __("Unsubscribe",'push-notification-for-post-and-buddypress');

				if (pnfpb_ajax_object_mobile_app_interface_script.pnfpb_ic_fcm_popup_unsubscribe_button && pnfpb_ajax_object_mobile_app_interface_script.pnfpb_ic_fcm_popup_unsubscribe_button != '') {

					pnfpb_popup_unsubscribe_button = pnfpb_ajax_object_mobile_app_interface_script.pnfpb_ic_fcm_popup_unsubscribe_button;

				}

				var pnfpb_push_subscribe_options_button = __("Update",'push-notification-for-post-and-buddypress');

				if (pnfpb_ajax_object_mobile_app_interface_script.pnfpb_push_subscribe_options_button && pnfpb_ajax_object_mobile_app_interface_script.pnfpb_push_subscribe_options_button != '') {

					pnfpb_push_subscribe_options_button = pnfpb_ajax_object_mobile_app_interface_script.pnfpb_push_subscribe_options_button;

				}
			
				if (deviceid && $jwebview(".pnfpb-push-subscribe-icon-shortcode").length) {

					$jwebview('.pnfpb_bell_icon_custom_prompt_loader_shortcode').show();

					$jwebview('.pnfpb-push-subscribe-options-button-container-shortcode').hide();

					$jwebview('.pnfpb-push-subscribe-button-shortcode').prop('disabled', true);

					$jwebview('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', true);
					
					$jwebview('.pnfpb-push-subscribe-button-shortcode').hide();
								   
								
					var data = {
						action: 'icpushcallback',
						nonce: pnfpb_ajax_object_mobile_app_interface_script.nonce,
						device_id:deviceid,
						isadminpage:isadminpage,
						pnfpbshortcodeactive:pnfpbshortcodeactive,
						pushtype: 'checkdeviceid'
					};
									
					$jwebview.post(pnfpb_ajax_object_mobile_app_interface_script.ajax_url, data, function(response) {
	
							
						var responseobject = JSON.parse(response);	
	
						subscriptionoptions = responseobject.subscriptionoptions;
								
						subscriptionoptionsarray = subscriptionoptions.split('');
	
						if( $jwebview(".pnfpb-push-subscribe-icon-shortcode").length) {

							if (subscriptionoptionsarray[0] === '1')
							{

								$jwebview('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked', true);


								pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '1';

							}
							else 
							{

								$jwebview('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked', false);


								pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';

							}

							if (subscriptionoptionsarray[25] && subscriptionoptionsarray[25] === '1')
							{
								$jwebview('#pnfpb_bell_icon_prompt_subscription_favourite_enable_shortcode').prop('checked', true);

							}
							else 
							{
								$jwebview('#pnfpb_bell_icon_prompt_subscription_favourite_enable_shortcode').prop('checked', false);
							}												

							if (subscriptionoptionsarray[12] === '1' && subscriptionoptionsarray[0] !== '1')
							{

								$jwebview('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable_shortcode').prop('checked', true);


								pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '1';

							}
							else 
							{

								$jwebview('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable_shortcode').prop('checked', false);


								pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '0';

							}

							if (subscriptionoptionsarray[13] === '1' && subscriptionoptionsarray[0] !== '1')
							{

								$jwebview('.pnfpb_bell_icon_prompt_subscription_group_invite_enable_shortcode').prop('checked', true);


								pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '1';

							}
							else 
							{

								$jwebview('.pnfpb_bell_icon_prompt_subscription_group_invite_enable_shortcode').prop('checked', false);


								pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '0';

							}

							if (subscriptionoptionsarray.length > 0) {

								for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < 12; pnfpb_post_type_element++) {

									if (pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'unsubscribe-all' && pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'all') {	

										if (subscriptionoptionsarray[pnfpb_post_type_element] === '1' && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
										{
											$jwebview('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable_shortcode').prop('checked', true);

											pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_post_type_element] = '1';

										}
										else 
										{
											if (subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1') {

												$jwebview('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable_shortcode').prop('checked', false);

												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_post_type_element] = '0';

											}															
										}

									} else {

										if (pnfpb_show_push_notify_types[pnfpb_post_type_element] === 'all' && subscriptionoptionsarray[0] === '1' )
										{

											$jwebview('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[0]+'_enable_shortcode').prop('checked', true);

											pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '1';

										} else {

											if (subscriptionoptionsarray[8] === '1' ) {

												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '1';

											}
										}

									}


								}

							}													

							if (subscriptionoptionsarray.length > 14) {

								var subscription_options_element = 14;

								for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {


									if (subscriptionoptionsarray[subscription_options_element] === '1' && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
									{
										$jwebview('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable_shortcode').prop('checked', true);


										pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
									}
									else 
									{
										$jwebview('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable_shortcode').prop('checked', false);


										pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
									}

									subscription_options_element++;

								}


							}

							$jwebview('.pnfpb_bell_icon_custom_prompt_loader_shortcode').hide();

							$jwebview('.pnfpb-push-subscribe-options-button-container-shortcode').show();

							$jwebview('.pnfpb-push-subscribe-button-shortcode').prop('disabled', false);

							$jwebview('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', false);													
						}
									
					}).catch((err) => {
						console.log(__('An error occurred while subscribing push notification. ','push-notification-for-post-and-buddypress'), err);
						$jwebview('.pnfpb_bell_icon_custom_prompt_loader_shortcode').hide();

						$jwebview('.pnfpb-push-subscribe-options-button-container-shortcode').show();

						$jwebview('.pnfpb-push-subscribe-button-shortcode').prop('disabled', false);

						$jwebview('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', false);							
					});
								
				}

				var subscriptionoptions = '0000000000000';
			  	var unsubscribeallshortcode = '1';
				var subscribemypostshortcode = '0';
				var subscribeallcommentsshortcode = '0';
				var subscribeprivatemessagesshortcode = '0';
				var subscribenewmembershortcode = '0';
				var subscribefriendshiprequestshortcode = '0';
				var subscribefriendshipacceptshortcode = '0';
				var subscribeuseravatarshortcode = '0';
				var subscribecoverimageshortcode = '0';
				var subscribepostactivitiesshortcode = '0';
				var subscribeactivitiesshortcode = '0';
				var subscribegroupdetailsshortcode = '0'; 
				var subscribegroupinviteshortcode = '0'; 
				var subscribeallshortcode = '0';
			
				$jwebview('.pnfpb-push-status-text-shortcode').removeClass("pnfpb-push-status-text-opened-shortcode");

				$jwebview('.pnfpb-push-subscribe-icon-shortcode').on( "click", function(event) {

					event.stopPropagation(); 

					event.preventDefault();

					pnfpb_bell_icon_prompt_subscription_options_custom_prompt = '10000000000000';

					pnfpb_subscription_options = '';

					$jwebview('.pnfpb-push-subscribe-button-layout-shortcode').toggle();

					$jwebview('.pnfpb-push-status-text-shortcode').removeClass("pnfpb-push-status-text-opened-shortcode");

					if ($jwebview('.pnfpb-push-subscribe-button-layout-shortcode').is(':visible')) {

						$jwebview('.pnfpb-push-subscribe-button-layout-shortcode').addClass("pnfpb-push-subscribe-button-layout-opened-shortcode");	

					}
					else {

						$jwebview('.pnfpb-push-subscribe-button-layout-shortcode').removeClass("pnfpb-push-subscribe-button-layout-opened-shortcode");

					}

					$jwebview('.pnfpb-push-subscribe-button-shortcode').text(__('Please wait...verifying status','push-notification-for-post-and-buddypress'));

					if (subscriptionoptionsarray.length > 14) {

						$jwebview('.pnfpb-push-subscribe-options-button-shortcode').text(pnfpb_push_subscribe_options_button);


						if ($jwebview('.pnfpb-push-subscribe-options-button-container-shortcode').length) {

							$jwebview('.pnfpb-push-subscribe-options-button-container-shortcode').show();
						}

						$jwebview('.pnfpb-push-subscribe-button-shortcode').text(pnfpb_popup_unsubscribe_button);

						$jwebview('.pnfpb-push-subscribe-button-shortcode').hide();

						$jwebview('.pnfpb-push-subscribe-button-shortcode').removeClass("pnfpb-popup-subscribe-class-shortcode");

						$jwebview('.pnfpb-push-subscribe-button-shortcode').addClass("pnfpb-popup-unsubscribe-class-shortcode");

						pnfpb_subscription_options = '';

					} else {

						$jwebview('.pnfpb-push-subscribe-button-shortcode').text(pnfpb_popup_subscribe_button);

						$jwebview('.pnfpb-push-subscribe-button-shortcode').hide();

						$jwebview('.pnfpb-push-subscribe-button-shortcode').addClass("pnfpb-popup-subscribe-class-shortcode");

						$jwebview('.pnfpb-push-subscribe-button-shortcode').removeClass("pnfpb-popup-unsubscribe-class-shortcode");
					}


					$jwebview('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').off().on('click',function(event) {


						if ($jwebview('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').is(":checked"))
						{

							pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '1';

							if (pnfpb_show_push_notify_types.length > 0) {

								for (var pnfpb_notify_type_element = 1; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {

									pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_notify_type_element] = '0';

								}

							}

							$jwebview('.pnfpb_bell_icon_prompt_subscription_post_enable_shortcode').prop('checked',false);

							$jwebview('.pnfpb_bell_icon_prompt_subscription_activity_enable_shortcode').prop('checked',false);

							$jwebview('.pnfpb_bell_icon_prompt_subscription_all_comments_enable_shortcode').prop('checked',false);

							$jwebview('.pnfpb_bell_icon_prompt_subscription_my_comments_enable_shortcode').prop('checked',false);

							$jwebview('.pnfpb_bell_icon_prompt_subscription_private_message_enable_shortcode').prop('checked',false);

							$jwebview('.pnfpb_bell_icon_prompt_subscription_new_member_enable_shortcode').prop('checked',false);

							$jwebview('.pnfpb_bell_icon_prompt_subscription_friendship_request_enable_shortcode').prop('checked',false);

							$jwebview('.pnfpb_bell_icon_prompt_subscription_friendship_accepted_enable_shortcode').prop('checked',false);

							$jwebview('.pnfpb_bell_icon_prompt_subscription_avatar_change_enable_shortcode').prop('checked',false);

							$jwebview('.pnfpb_bell_icon_prompt_subscription_cover_image_change_enable_shortcode').prop('checked',false);

							$jwebview('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable_shortcode').prop('checked',false);

							$jwebview('.pnfpb_bell_icon_prompt_subscription_group_invite_enable_shortcode').prop('checked',false);

							if (pnfpb_custom_post_types.length > 0) {

								for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {

									$jwebview('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable_shortcode').prop('checked',false);

									var pnfpb_index = $jwebview('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable_shortcode').attr("pnfpb_index");

									pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';

								}
							}


						}
						else 
						{


							pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
						}								
					});

					$jwebview('.pnfpb_bell_icon_prompt_subscription_favourite_enable_shortcode').off().on('click',function(event) {


						if ($jwebview('.pnfpb_bell_icon_prompt_subscription_favourite_enable_shortcode').is(":checked"))
						{


							$jwebview('.pnfpb_bell_icon_shortcode_subscription_all_enable').prop('checked',false);

							pnfpb_bell_icon_shortcode_subscribe_favourite_checkbox = '1';


						}
						else 
						{
							pnfpb_bell_icon_shortcode_subscribe_favourite_checkbox = '0';
						}								
					});				

					$jwebview('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable_shortcode').off().on('click',function(event) {


						if ($jwebview('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable_shortcode').is(":checked"))
						{


							$jwebview('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked',false);
							pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '1';


						}
						else 
						{
							pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '0';
						}								
					});

					$jwebview('.pnfpb_bell_icon_prompt_subscription_group_invite_enable_shortcode').off().on('click',function(event) {


						if ($jwebview('.pnfpb_bell_icon_prompt_subscription_group_invite_enable_shortcode').is(":checked"))
						{


							$jwebview('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked',false);
							pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '1';


						}
						else 
						{

							pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '0';
						}								
					});				

					if (pnfpb_show_push_notify_types.length > 0) {

						for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 12; pnfpb_notify_type_element++) {

							if (pnfpb_show_push_notify_types[pnfpb_notify_type_element] !== 'all') {

								$jwebview('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_notify_type_element]+'_enable_shortcode').off().on('click',function(event) {

									var pnfpb_selector = '.'+$jwebview(this).attr("class");

									var pnfpb_index = $jwebview(this).attr("pnfpb_index");

									if ($jwebview(pnfpb_selector).is(":checked"))
									{

										pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_index] = '1';


										if (pnfpb_notify_type_element > 0) {

											pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';

											$jwebview('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked',false);

										}

									}
									else 
									{

										pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_index] = '0';

									}


								});
							}								

						}

					}

					if (pnfpb_custom_post_types.length > 0) {

						for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {

							$jwebview('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable_shortcode').off().on('click',function(event) {

								var pnfpb_selector = '.'+$jwebview(this).attr("class");

								var pnfpb_index = $jwebview(this).attr("pnfpb_index");

								if ($jwebview(pnfpb_selector).is(":checked"))
								{

									pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';

									pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';

									$jwebview('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked',false);


								}
								else 
								{

									pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '0';


								}


							});								

						}

					}

					$jwebview('.pnfpb-push-subscribe-options-button-shortcode').off().on( "click", async (event) => {

						event.stopPropagation(); 

						event.preventDefault();	

						$jwebview('.pnfpb_bell_icon_custom_prompt_loader_shortcode').show();

						$jwebview('.pnfpb-push-subscribe-button-shortcode').prop('disabled', true);

						$jwebview('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', true);

						var pnfpb_bell_icon_prompt_subscription_options = '';

						if (pnfpb_show_push_notify_types.length > 0) {

							for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {

								pnfpb_bell_icon_prompt_subscription_options = pnfpb_bell_icon_prompt_subscription_options+pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_notify_type_element];

							}

						}

						if (pnfpb_custom_post_types.length > 0) {

							for (var pnfpb_post_type_element = 0; pnfpb_post_type_element <= 10; pnfpb_post_type_element++) {

								if (pnfpb_post_type_element < pnfpb_custom_post_types.length && pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element]) {

									pnfpb_bell_icon_prompt_subscription_options = pnfpb_bell_icon_prompt_subscription_options+pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element];

								} else {

									pnfpb_bell_icon_prompt_subscription_options = pnfpb_bell_icon_prompt_subscription_options+'0';
								}

							}

						}

						pnfpb_bell_icon_prompt_subscription_options = pnfpb_bell_icon_prompt_subscription_options+pnfpb_bell_icon_shortcode_subscribe_favourite_checkbox;

						if (deviceid) {

							var data = {
								action: 'icpushcallback',
								device_id:deviceid,
								subscriptionoptions:pnfpb_bell_icon_prompt_subscription_options,
								nonce: pnfpb_ajax_object_mobile_app_interface_script.nonce,
								pushtype: 'subscribe-button'
							};

							$jwebview.post(pnfpb_ajax_object_mobile_app_interface_script.ajax_url, data, function(responseajax) {

								var response = JSON.parse(responseajax);

								pnfpb_subscription_options = response.subscriptionoptions;

								$jwebview('.pnfpb_bell_icon_custom_prompt_loader_shortcode').hide();

								$jwebview('.pnfpb-push-subscribe-options-button-shortcode').show();

								$jwebview('.pnfpb-push-subscribe-options-button-container-shortcode').show();

								$jwebview('.pnfpb-push-subscribe-button-shortcode').prop('disabled', false);

								$jwebview('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', false);								

								$jwebview('.pnfpb-push-status-text-shortcode').text(__('Subscription options updated','push-notification-for-post-and-buddypress'));

								$jwebview('.pnfpb-push-status-text-shortcode').addClass("pnfpb-push-status-text-opened-shortcode");


							});
						}

					});				

				});
	
			}	 
		 
		}

	});
}