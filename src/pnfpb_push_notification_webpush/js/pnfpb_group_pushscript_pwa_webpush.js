//
// Script to Subscribe push notification for particular BuddyPress Group users using Firebase
// To send push notification only for members belonging to group
// @since 1.8
//
import { __ } from '@wordpress/i18n';
import $ from 'jquery';
import 'jquery-ui-dist/jquery-ui';

var $j = $.noConflict();

var unsubscribeGroupid;
var subscribeGroupid;
var pnfpb_pushtoken_fromflutter = '';

var standalone_group_pwa = window.navigator.standalone;
var userAgent_group_pwa = window.navigator.userAgent.toLowerCase();
var safari_group_pwa = /safari/.test(userAgent_group_pwa);
var ios_group_pwa = /iphone|ipod|ipad/.test(userAgent_group_pwa);
	
var pnfpb_webview = false;

if (ios_group_pwa) {
  if (!standalone_group_pwa && safari_group_pwa) {
    // Safari
    pnfpb_webview = false;
  } else if (!standalone_group_pwa && !safari_group_pwa) {
    // iOS webview
    pnfpb_webview = true;
  };
} else {
  if (userAgent_group_pwa.includes('wv')) {
    // Android webview
    pnfpb_webview = true;
  } else {
    // Chrome
    pnfpb_webview = false;
  }
};

var firebaseConfig = {};

var firebaseApp;
			
var messaging;

var hasFirebaseMessagingSupport_group;

var deviceid = '100000000000';

var vapidKey = '';


$j(function() {
	
	vapidKey = ""
		
	navigator.serviceWorker.register(pnfpb_ajax_object_push.homeurl+'/pnfpb_icpush_pwa_sw.js',{scope:pnfpb_ajax_object_push.homeurl+'/'}).then(function(registration) {

		var groupId =  '0';

		navigator.serviceWorker.ready.then((serviceWorkerRegistration) => {

			serviceWorkerRegistration.pushManager.getSubscription().then(async function (subscription) {

				if (subscription) {

					$j(".subscribegroupbutton").removeClass( "subscribe-init-display-off" );
					$j(".unsubscribegroupbutton").removeClass( "subscribe-init-display-off" );
					$j(".subscribe-notification-group").removeClass( "subscribe-init-display-off" );
					$j(".unsubscribe-notification-group").removeClass( "subscribe-init-display-off" );
					
					var leave_group_id = '0';

					var groupId = '0';

							var deviceid = '';
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
									leave_group_id = leave_group_string_array[1];
									var leave_group_unsubscribebuttonname = '.unsubscribegroupbutton-'+leave_group_id;
									var leave_group_subscribebuttonname = '.subscribegroupbutton-'+leave_group_id;
									var leave_group_unsubscribebuttonid = '#unsubscribegroupbutton-'+leave_group_id;
									var leave_group_subscribebuttonid = '#subscribegroupbutton-'+leave_group_id;
									$j(leave_group_subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
									$j(leave_group_unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
									$j(leave_group_subscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
									$j(leave_group_unsubscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
									
								}

								deviceid = '';

								var subscription_endpoint = '';
								var subscription_p256dh = '';
								var subscription_auth = '';

								if (subscription.endpoint) {
									subscription_endpoint = subscription.endpoint;
								}

								if (subscription.getKey("auth")) {
									const authBuffer = subscription.getKey('auth');
									const authUint8 = new Uint8Array(authBuffer);
									subscription_auth = btoa(String.fromCharCode.apply(null, authUint8));									
								}
																
								if (subscription.getKey("p256dh")) {
									const p256dhBuffer = subscription.getKey('p256dh');
									const p256dhUint8 = new Uint8Array(p256dhBuffer);
									subscription_p256dh = btoa(String.fromCharCode.apply(null, p256dhUint8));									
								}										
			
								var data = {
									action: 'icpushcallback',
									nonce: pnfpb_ajax_object_push.nonce,
									device_id:'',
									bpgroup_id:leave_group_id,
									pnfpb_endpoint:subscription_endpoint,
									pnfpb_options:subscription_p256dh,
									pnfpb_subscription_token:subscription_auth,
									pushtype: 'unsubscribe-group-button'
								};

								$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
								
									if (response != 'fail')
									{
										if (response != 'duplicate'){

												document.cookie = "pnfpb_group_push_notification_"+leave_group_id + "; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";	
											
												$j(leave_group_subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
												$j(leave_group_unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
											}
											else
											{
	
												console.log(__("Push notification unsubscription failed..try again!!",'push-notification-for-post-and-buddypress'));
											}
									}
		
								});	

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
									leave_group_id = leave_group_string_array[1];
									var leave_group_unsubscribebuttonname = '.unsubscribegroupbutton-'+leave_group_id;
									var leave_group_subscribebuttonname = '.subscribegroupbutton-'+leave_group_id;
									var leave_group_unsubscribebuttonid = '#unsubscribegroupbutton-'+leave_group_id;
									var leave_group_subscribebuttonid = '#subscribegroupbutton-'+leave_group_id;
									$j(leave_group_subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
									$j(leave_group_unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
									$j(leave_group_subscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
									$j(leave_group_unsubscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
									
								}
								deviceid = '';

								var subscription_endpoint = '';
								var subscription_p256dh = '';
								var subscription_auth = '';

								if (subscription.endpoint) {
									subscription_endpoint = subscription.endpoint;
								}

								if (subscription.getKey("auth")) {
									const authBuffer = subscription.getKey('auth');
									const authUint8 = new Uint8Array(authBuffer);
									subscription_auth = btoa(String.fromCharCode.apply(null, authUint8));									
								}
																
								if (subscription.getKey("p256dh")) {
									const p256dhBuffer = subscription.getKey('p256dh');
									const p256dhUint8 = new Uint8Array(p256dhBuffer);
									subscription_p256dh = btoa(String.fromCharCode.apply(null, p256dhUint8));									
								}

								var data = {
									action: 'icpushcallback',
									nonce: pnfpb_ajax_object_push.nonce,
									device_id:'',
									bpgroup_id:leave_group_id,
									pnfpb_endpoint:subscription_endpoint,
									pnfpb_options:subscription_p256dh,
									pnfpb_subscription_token:subscription_auth,
									pushtype: 'unsubscribe-group-button'
								};									

								$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
						
									if (response != 'fail')
									{
										if (response != 'duplicate'){
											
												document.cookie = "pnfpb_group_push_notification_"+leave_group_id + "; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";	
												$j(leave_group_subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
												$j(leave_group_unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
											}
											else
											{
												console.log(__("Push notification unsubscription failed..try again!!",'push-notification-for-post-and-buddypress'));
											}

									}
		
								});	

							});	
						
							$j(document).on( "click",".subscribe-notification-group", function(e) {

								e.preventDefault();

								groupId = $j(this).attr("data-group-id");
								var unsubscribebuttonname = '.unsubscribegroupbutton-'+groupId;
								var subscribebuttonname = '.subscribegroupbutton-'+groupId;
								var unsubscribebuttonid = '#unsubscribegroupbutton-'+groupId;
								var subscribebuttonid = '#subscribegroupbutton-'+groupId;

								if( $j("#pnfpb_group_users_subscribe_dialog_confirm").length ) {
								}
								else
								{
									$j(this).append( '<div id="pnfpb_group_users_subscribe_dialog_confirm" class="pnfpb_group_users_subscribe_dialog_confirm" title="Subscribe" style="display:none;"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>'+pnfpb_ajax_object_push.group_subscribe_dialog_text+'</div><div id="pnfpb-group-unsubscribe-dialog" title="Confirmation"><div id="pnfpb-group-unsubscribe-alert-msg" class="pnfpb-group-unsubscribe-alert-msg"></div></div>' );
								}

								var subscribe_button_text = pnfpb_ajax_object_push.subscribe_button_text;
								$j( "#pnfpb_group_users_subscribe_dialog_confirm" ).dialog({  
									resizable: false,
									height: "auto",
									closeText : '',
									modal: true,
									buttons: [{
										text: subscribe_button_text,
										open: function() {
											$j(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_push.subscribe_button_text_color+';background-color:'+pnfpb_ajax_object_push.subscribe_button_color+';border:0px');
										},
										click: function() {											
							
											deviceid = '';

											var subscription_endpoint = '';
											var subscription_p256dh = '';
											var subscription_auth = '';

											if (subscription.endpoint) {
												subscription_endpoint = subscription.endpoint;
											}

											if (subscription.getKey("auth")) {
												const authBuffer = subscription.getKey('auth');
												const authUint8 = new Uint8Array(authBuffer);
												subscription_auth = btoa(String.fromCharCode.apply(null, authUint8));									
											}
																			
											if (subscription.getKey("p256dh")) {
												const p256dhBuffer = subscription.getKey('p256dh');
												const p256dhUint8 = new Uint8Array(p256dhBuffer);
												subscription_p256dh = btoa(String.fromCharCode.apply(null, p256dhUint8));									
											}										
					
											var data = {
												action: 'icpushcallback',
												device_id:deviceid,
												bpgroup_id:groupId,
												pnfpb_endpoint:subscription_endpoint,
												pnfpb_options:subscription_p256dh,
												pnfpb_subscription_token:subscription_auth,												
												nonce: pnfpb_ajax_object_push.nonce,
												pushtype: 'subscribe-group-button'
											};
							
											$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
												
											
													if (response != 'fail')
													{
														if (response != 'duplicate'){

															$j(".pnfpb-group-unsubscribe-alert-msg").html("<p>"+pnfpb_ajax_object_push.group_subscribe_dialog_text_confirm+"</p>");
															$j( "#pnfpb-group-unsubscribe-dialog" ).dialog();
															$j(subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
															$j(unsubscribebuttonname).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
															$j(subscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
															$j(unsubscribebuttonid).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
															
															}
															else
															{
																console.log(__("Already subscribed...device id already exists...not updated",'push-notification-for-post-and-buddypress'));
															}

													}
													else
													{

														
														$j(".pnfpb-group-unsubscribe-alert-msg").html(__("Push notification subscription failed..try again!!",'push-notification-for-post-and-buddypress'));
														
														$j( "#pnfpb-group-unsubscribe-dialog" ).dialog();

														console.log(__("device update failed",'push-notification-for-post-and-buddypress'));
													}
						
											});
						
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
								}
								else
								{
									$j(this).append( '<div id="pnfpb_group_users_unsubscribe_dialog_confirm" class="pnfpb_group_users_unsubscribe_dialog_confirm" title="Unsubscribe" style="display:none;"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>'+pnfpb_ajax_object_push.group_unsubscribe_dialog_text+'</div><div id="pnfpb-group-unsubscribe-dialog" title="Confirmation"><div id="pnfpb-group-unsubscribe-alert-msg" class="pnfpb-group-unsubscribe-alert-msg"></div></div>' );
								}

								var unsubscribe_button_text = pnfpb_ajax_object_push.unsubscribe_button_text;

								$j( "#pnfpb_group_users_unsubscribe_dialog_confirm" ).dialog({  
									resizable: false,
									height: "auto",
									closeText : '',
									modal: true,
									buttons: [{
										text: unsubscribe_button_text,
										open: function() {
											$j(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_push.subscribe_button_text_color+';background-color:'+pnfpb_ajax_object_push.subscribe_button_color+';border:0px');
										},
										click: function() {	
							
											deviceid = '';

											var subscription_endpoint = '';
											var subscription_p256dh = '';
											var subscription_auth = '';

											if (subscription.endpoint) {
												subscription_endpoint = subscription.endpoint;
											}

											if (subscription.getKey("auth")) {
												const authBuffer = subscription.getKey('auth');
												const authUint8 = new Uint8Array(authBuffer);
												subscription_auth = btoa(String.fromCharCode.apply(null, authUint8));									
											}
																			
											if (subscription.getKey("p256dh")) {
												const p256dhBuffer = subscription.getKey('p256dh');
												const p256dhUint8 = new Uint8Array(p256dhBuffer);
												subscription_p256dh = btoa(String.fromCharCode.apply(null, p256dhUint8));									
											}										
						
											var data = {
												action: 'icpushcallback',
												nonce: pnfpb_ajax_object_push.nonce,
												device_id:'',
												bpgroup_id:groupId,
												pnfpb_endpoint:subscription_endpoint,
												pnfpb_options:subscription_p256dh,
												pnfpb_subscription_token:subscription_auth,
												pushtype: 'unsubscribe-group-button'
											};
							
											$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
										
												if (response != 'fail')
												{
													if (response != 'duplicate'){

														document.cookie = "pnfpb_group_push_notification_"+groupId + "; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";															
														
														$j(unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
														$j(subscribebuttonname).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
														$j(unsubscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
														$j(subscribebuttonid).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
														
														$j(".pnfpb-group-unsubscribe-alert-msg").html("<p>"+pnfpb_ajax_object_push.group_unsubscribe_dialog_text_confirm+"</p>");
														
														$j( "#pnfpb-group-unsubscribe-dialog" ).dialog();
														
														}
														else
														{
				
															console.log(__("Push notification unsubscription failed..try again!!",'push-notification-for-post-and-buddypress'));
														}

												}
												else
												{

													
													$j(".pnfpb-group-unsubscribe-alert-msg").html(__("Push notification unsubscription failed..try again!!",'push-notification-for-post-and-buddypress'));
													
													$j( "#pnfpb-group-unsubscribe-dialog" ).dialog();

													console.log(__("device update failed",'push-notification-for-post-and-buddypress'));
												}
						
											});
						
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
				else
				{
					$j(".pnfpb-group-unsubscribe-alert-msg").html(__("UnSubscribe/Subscribe failed..try again ..Please!!",'push-notification-for-post-and-buddypress'));

					$j( "#pnfpb-group-unsubscribe-dialog" ).dialog();                        
				}
			})

		})
                    
	})

});
