//
//Script to send push notification using Firebase
//
//@since 1.0.0
//
"use strict";

Object.defineProperty(exports, "__esModule", { value: true });

import { getApp, initializeApp } from 'firebase/app';
import { deleteToken, getMessaging, getToken, isSupported } from "firebase/messaging";

import { __ } from '@wordpress/i18n';

import $ from "jquery";

import 'jquery-ui-dist/jquery-ui';


var $j = $.noConflict();

var frontendsubscriptionOptions;

var pnfpbuserid;

if (window.webkit && window.webkit.messageHandlers && window.webkit.messageHandlers.pnfpbuserid) {
	window.webkit.messageHandlers.pnfpbuserid.postMessage({
				  "message": pnfpb_ajax_object_push.userid
	});
}

var deviceid = '100000000000';

var vapidKey = '';

var pnfpb_ic_custom_click_action_url = '';

var firebaseConfig = {};

var firebaseApp;
			
var messaging;

var hasFirebaseMessagingSupport;

var pnfpb_bell_prompt_processing = '';

var pnfpb_subscription_options = '0';

function createFirebaseApp(config) {
    try {
        return getApp()
    } catch {
        return initializeApp(config)
    }
}

var pnfpb_pushtoken_fromflutter ;
var pnfpb_pushtoken_fromAndroid;
var Android;


var pnfpb_bell_icon_subscribe_push_type_checkbox = [];
var pnfpb_bell_icon_subscribe_custom_post_checkbox = [];


var pnfpb_bell_icon_subscription_options_custom_prompt = '10000000000000';


var pnfpb_bell_icon_prompt_subscribe_push_type_checkbox = [];
var pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox = [];


var pnfpb_front_end_settings = [];

var pnfpb_front_end_settings_custom_post_types = ['0','0','0','0','0','0','0','0','0','0','0','1'];

var pnfpb_shortcode_settings_custom_post_types = [];

var pnfpb_bell_icon_prompt_subscription_options_custom_prompt = '10000000000000';

var pnfpb_custom_post_types = JSON.parse(pnfpb_ajax_object_push.pnfpb_show_custom_post_types);


for (var pnfpb_custom_type_element = 0; pnfpb_custom_type_element < pnfpb_custom_post_types.length; pnfpb_custom_type_element++) {

	if (pnfpb_custom_post_types[pnfpb_custom_type_element] !== 'buddypress') {

		pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox.push('0');

		pnfpb_bell_icon_subscribe_custom_post_checkbox.push('0');

	}

}

var pnfpb_show_push_notify_types = JSON.parse(pnfpb_ajax_object_push.pnfpb_show_push_notify_types);

var pnfpb_front_end_settings_push_notify_types = JSON.parse(pnfpb_ajax_object_push.pnfpb_front_end_settings_push_notify_types);

var pnfpb_show_push_notify_admin_types = ['activities','comments','mycomments','privatemessage','newmember','friend_request','friend_accept','avatar_change','coverimage_change'];


$j(function() {
	
//const { __ } = wp.i18n;

var data = {
	action: 'icpushcallback',
	device_id:'',
	subscriptionoptions:'',
	pushtype: 'icfirebasecred'
};

let deferredPrompt;

var PNFPBcustominstallprompt = '';

var standalone = window.navigator.standalone,
  userAgent = window.navigator.userAgent.toLowerCase(),
  safari_pnfpb =/^(?!.*chrome).*safari/i.test(userAgent),
  ios_pnfpb = /iphone|ipod|ipad/.test(userAgent);
	
var pnfpb_webview = false;
var pnfpb_ios_browser = false;

if (!standalone && safari_pnfpb) {
    // safari_pnfpb
    pnfpb_webview = false;
	pnfpb_ios_browser = true;
  } else if (!standalone && !safari_pnfpb) {
    // ios_pnfpb webview
    pnfpb_webview = true;
	//PNFPB_from_Java_androidapp();
	//PNFPB_from_Flutter_mobileapp();	  	
  };

  if (userAgent.includes('wv') && ios_pnfpb) {
    // Android webview
    pnfpb_webview = true;
	//PNFPB_from_Java_androidapp();
	//PNFPB_from_Flutter_mobileapp();	  
  } else {
    // Chrome
    pnfpb_webview = false;
  }


if (pnfpb_ios_browser) {

	$j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").show();

	$j( ".pnfpb_pwa_shortcode_box" ).parent(".widget_block").show();

	$j(".pnfpb_pwa_shortcode_box").show();
	
	$j( ".pnfpb_pwa_ios_button" ).on("click", () => {

        var pnfpb_screenWidth, pnfpb_screenHeight, pnfpb_dialogWidth, pnfpb_dialogHeight, pnfpb_isDesktop;    
        pnfpb_screenWidth = window.screen.width;
        pnfpb_screenHeight = window.screen.height;    

        if (pnfpb_screenWidth < 500) {
            pnfpb_dialogWidth = pnfpb_screenWidth * .95;
            pnfpb_dialogHeight = pnfpb_screenHeight * .95;
        } else {
            pnfpb_dialogWidth = 500;
            pnfpb_dialogHeight = 500;
            pnfpb_isDesktop = true;
        }		

		$j( "#pnfpb-pwa-dialog-ios" ).dialog({
			autoOpen: true,
			resizable: false,
			closeText : '',
			open: function(event, ui) {
			},			
            width: pnfpb_dialogWidth,
			maxWidth:600,
            closeOnEscape: false,
			draggable: false,
			modal: true,
			buttons: [
			{
				text: 'Ok',
				open: function() {
					$j(this).attr('style','font-weight:bold;color:white;background-color:blue;border:0px');
				},
				click: function() {			
					$j( this ).dialog( "close" );
				}
			}
			]
		});	

	});

}

if (pnfpb_ios_browser && pnfpb_ajax_object_push.pwainstallpromptenabled === '1' ) {

	let name = 'PNFPB_pwa_prompt' + "=";

	let decodedCookie = decodeURIComponent(document.cookie);

	let ca = decodedCookie.split(';');

	for(let i = 0; i <ca.length; i++) {

		let c = ca[i];

		while (c.charAt(0) == ' ') {

			  c = c.substring(1);

		}

		if (c.indexOf(name) == 0) {

			if (c.substring(name.length, c.length) !== 'Thu, 01 Jan 2029 00:00:00 UTC') {

				PNFPBcustominstallprompt = c.substring(name.length, c.length);

			}			
		}
	}
	
	if (PNFPBcustominstallprompt === '') {

		$j('.pnfpb-pwa-dialog-ios-container').show();

		$j('#pnfpb-pwa-dialog-ios-cancel').on( "click", function() {

			$j('.pnfpb-pwa-dialog-ios-container').hide();

			const pnfpb_d = new Date();

			const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_show_again_days);

			pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));

			let expires = "expires="+ pnfpb_d.toUTCString();

			document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";					

		});
	}

}

window.addEventListener('beforeinstallprompt', (e) => {

	e.preventDefault();

	deferredPrompt = e;

	if (deferredPrompt && $j(".pnfpb_pwa_shortcode_box").length) {

		$j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").show();

		$j( ".pnfpb_pwa_shortcode_box" ).parent(".widget_block").show();

		$j(".pnfpb_pwa_shortcode_box").show();

	} else  {

		$j(".pnfpb_pwa_shortcode_box").hide();

		$j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").hide();

		$j( ".pnfpb_pwa_shortcode_box" ).parent(".widget_block").hide();

	}
	
	if (pnfpb_ajax_object_push.pwainstallpromptenabled === '1' || $j('.pnfpb-pwa-dialog-container').length) {

		$j('.pnfpb-pwa-dialog-container').hide();
	}

	let name = 'PNFPB_pwa_prompt' + "=";

	let decodedCookie = decodeURIComponent(document.cookie);

	let ca = decodedCookie.split(';');

	for(let i = 0; i <ca.length; i++) {

		let c = ca[i];

		while (c.charAt(0) == ' ') {

			  c = c.substring(1);

		}

		if (c.indexOf(name) == 0) {

			if (c.substring(name.length, c.length) !== 'Thu, 01 Jan 2029 00:00:00 UTC') {

				PNFPBcustominstallprompt = c.substring(name.length, c.length);


				if (pnfpb_ajax_object_push.pwainstallpromptenabled === '1' || $j('.pnfpb-pwa-dialog-container').length) {

					$j('.pnfpb-pwa-dialog-container').hide();

				}				

			}			
		}
	}	

	$j( ".pnfpb_pwa_button" ).on("click", () => {

		$j(".pnfpb-pwa-ios-message-layout").hide();
		$j(".pnfpb-pwa-ios-message-container").hide();	

		if (deferredPrompt) {

			deferredPrompt.prompt();
			deferredPrompt.userChoice.then((response) => {
				if (response.outcome === 'accepted') {
					console.log(__('User accepted PWA installation','PNFPB_TD'));
					//document.cookie = "PNFPB_pwa_prompt=; expires=Thu, 01 Jan 2029 00:00:00 UTC; path=/;";	
					if ($j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").length) {
						$j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").hide();
					}
					$j(".pnfpb_pwa_shortcode_box").hide();
					deferredPrompt = null;
				}
				   else {
					   console.log(__('User did not accept PWA installation. No thanks, I am good!','PNFPB_TD'));
					const pnfpb_d = new Date();
					const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_show_again_days);
					pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
					let expires = "expires="+ pnfpb_d.toUTCString();
					document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";						
					deferredPrompt = null;
					location.reload();
					if ($j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").length) {						
						$j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").show();
					}
					$j(".pnfpb_pwa_shortcode_box").show();
				}
			})
		
		}
		else 
		{
			if (pnfpb_ios_browser) {

				$j(".pnfpb-pwa-ios-message-layout").show();

				$j(".pnfpb-pwa-ios-message-container").show();

			} else {

				$j( ".pnfpb_pwa_ios_button" ).on("click", () => {

					var pnfpb_screenWidth, pnfpb_screenHeight, pnfpb_dialogWidth, pnfpb_dialogHeight, pnfpb_isDesktop;    
					pnfpb_screenWidth = window.screen.width;
					pnfpb_screenHeight = window.screen.height;    
			
					if (pnfpb_screenWidth < 500) {
						pnfpb_dialogWidth = pnfpb_screenWidth * .95;
						pnfpb_dialogHeight = pnfpb_screenHeight * .95;
					} else {
						pnfpb_dialogWidth = 500;
						pnfpb_dialogHeight = 500;
						pnfpb_isDesktop = true;
					}		
			
					$j( "#pnfpb-pwa-dialog-ios" ).dialog({
						autoOpen: true,
						resizable: false,
						closeText : '',
						open: function(event, ui) {
						},			
						width: pnfpb_dialogWidth,
						maxWidth:600,
						closeOnEscape: false,
						draggable: false,
						modal: true,
						buttons: [
						{
							text: 'Ok',
							open: function() {
								$j(this).attr('style','font-weight:bold;color:white;background-color:blue;border:0px');
							},
							click: function() {			
								$j( this ).dialog( "close" );
							}
						}
						]
					});	
			
				})
			}			
		}
	})

	if (deferredPrompt && pnfpb_ajax_object_push.pwainstallpromptenabled === '1' && PNFPBcustominstallprompt == '') {
		$j('.pnfpb-pwa-dialog-container').show();
		$j('#pnfpb-pwa-dialog-subscribe').on( "click", async function() {
			$j('.pnfpb-pwa-dialog-container').hide();
				if (deferredPrompt) {
					deferredPrompt.prompt();
					deferredPrompt.userChoice.then((response) => {
						if (response.outcome === 'accepted') {
							console.log(__('User accepted PWA installation','PNFPB_TD'));
							//document.cookie = "PNFPB_pwa_prompt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
							$j(".pnfpb_pwa_shortcode_box").hide();
							deferredPrompt = null;								
						}
						else {
							if (response.outcome === 'dismissed') {
								console.log(__('User did not accept PWA installation.No thanks, I am good!','PNFPB_TD'));
								const pnfpb_d = new Date();
								const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_show_again_days);
								  pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
								  let expires = "expires="+ pnfpb_d.toUTCString();
								  document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
								deferredPrompt = null;
								location.reload();
							}
						}
					})
				}
		});

		$j('#pnfpb-pwa-dialog-cancel').on( "click", function() {
			$j('.pnfpb-pwa-dialog-container').hide();
			const pnfpb_d = new Date();
			const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_show_again_days);
			  pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
			  let expires = "expires="+ pnfpb_d.toUTCString();
			document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
				
		});
	} else {
		if (deferredPrompt && pnfpb_ajax_object_push.pwadesktopinstallpromptenabled === '1' && PNFPBcustominstallprompt == '' && !pnfpb_webview) {
			$j('.pnfpb-pwa-dialog-container').show();
			$j('#pnfpb-pwa-dialog-subscribe').on( "click", async function() {
				$j('.pnfpb-pwa-dialog-container').hide();
					if (deferredPrompt) {
						deferredPrompt.prompt();
						deferredPrompt.userChoice.then((response) => {
							if (response.outcome === 'accepted') {
								console.log(__('User accepted PWA installation','PNFPB_TD'));
								//document.cookie = "PNFPB_pwa_prompt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
								$j(".pnfpb_pwa_shortcode_box").hide();
								deferredPrompt = null;								
							}
							else {
								if (response.outcome === 'dismissed') {
									console.log(__('User did not accept PWA installation.No thanks, I am good!','PNFPB_TD'));
									const pnfpb_d = new Date();
									const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_show_again_days);
									  pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
									  let expires = "expires="+ pnfpb_d.toUTCString();
									  document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
									deferredPrompt = null;
									location.reload();
								}
							}
						})
					}
			});
	
			$j('#pnfpb-pwa-dialog-cancel').on( "click", function() {
				$j('.pnfpb-pwa-dialog-container').hide();
				const pnfpb_d = new Date();
				const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_show_again_days);
				  pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
				  let expires = "expires="+ pnfpb_d.toUTCString();
				document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
					
			});			
		} else {
			if (deferredPrompt && pnfpb_ajax_object_push.pwamobileinstallpromptenabled === '1' && PNFPBcustominstallprompt == '' && pnfpb_webview) {
				$j('.pnfpb-pwa-dialog-container').show();
				$j('#pnfpb-pwa-dialog-subscribe').on( "click", async function() {
					$j('.pnfpb-pwa-dialog-container').hide();
					if (deferredPrompt) {
						deferredPrompt.prompt();
						deferredPrompt.userChoice.then((response) => {
							if (response.outcome === 'accepted') {
								console.log(__('User accepted PWA installation','PNFPB_TD'));
								//document.cookie = "PNFPB_pwa_prompt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
								$j(".pnfpb_pwa_shortcode_box").hide();
								deferredPrompt = null;								
							}
							else {
								if (response.outcome === 'dismissed') {
									console.log(__('User did not accept PWA installation.No thanks, I am good!','PNFPB_TD'));
									const pnfpb_d = new Date();
									const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_show_again_days);
									  pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
									  let expires = "expires="+ pnfpb_d.toUTCString();
									  document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
									deferredPrompt = null;
									location.reload();
								}
							}
						})
					}
				});
	
				$j('#pnfpb-pwa-dialog-cancel').on( "click", function() {
					$j('.pnfpb-pwa-dialog-container').hide();
					const pnfpb_d = new Date();
					const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_show_again_days);
					pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
				 	 let expires = "expires="+ pnfpb_d.toUTCString();
					document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
					
				});
			} else {
				if (deferredPrompt && pnfpb_ajax_object_push.pwapixelsinstallpromptenabled === '1' && PNFPBcustominstallprompt == '' && window.innerWidth > pnfpb_ajax_object_push.pwapixelsinputinstallpromptenabled) {
					$j('.pnfpb-pwa-dialog-container').show();
					$j('#pnfpb-pwa-dialog-subscribe').on( "click", async function() {
						$j('.pnfpb-pwa-dialog-container').hide();
						if (deferredPrompt) {
							deferredPrompt.prompt();
							deferredPrompt.userChoice.then((response) => {
								if (response.outcome === 'accepted') {
									console.log(__('User accepted PWA installation','PNFPB_TD'));
									//document.cookie = "PNFPB_pwa_prompt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
									$j(".pnfpb_pwa_shortcode_box").hide();
									deferredPrompt = null;								
								}
								else {
									if (response.outcome === 'dismissed') {
										console.log(__('User did not accept PWA installation.No thanks, I am good!','PNFPB_TD'));
										const pnfpb_d = new Date();
										const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_show_again_days);
										pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
										  let expires = "expires="+ pnfpb_d.toUTCString();
										  document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
											deferredPrompt = null;
											location.reload();
									}
								}
							})
						}
					});
		
					$j('#pnfpb-pwa-dialog-cancel').on( "click", function() {
						$j('.pnfpb-pwa-dialog-container').hide();
						const pnfpb_d = new Date();
						const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_show_again_days);
						pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
						  let expires = "expires="+ pnfpb_d.toUTCString();
							document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
						
					});

				} else {
						if (pnfpb_ios_browser) {
							$j( ".pnfpb_pwa_ios_button" ).on("click", () => {

								var pnfpb_screenWidth, pnfpb_screenHeight, pnfpb_dialogWidth, pnfpb_dialogHeight, pnfpb_isDesktop;    
								pnfpb_screenWidth = window.screen.width;
								pnfpb_screenHeight = window.screen.height;    
						
								if (pnfpb_screenWidth < 500) {
									pnfpb_dialogWidth = pnfpb_screenWidth * .95;
									pnfpb_dialogHeight = pnfpb_screenHeight * .95;
								} else {
									pnfpb_dialogWidth = 500;
									pnfpb_dialogHeight = 500;
									pnfpb_isDesktop = true;
								}		
						
								$j( "#pnfpb-pwa-dialog-ios" ).dialog({
									autoOpen: true,
									resizable: false,
									closeText : '',
									open: function(event, ui) {
									},			
									width: pnfpb_dialogWidth,
									maxWidth:600,
									closeOnEscape: false,
									draggable: false,
									modal: true,
									buttons: [
									{
										text: 'Ok',
										open: function() {
											$j(this).attr('style','font-weight:bold;color:white;background-color:blue;border:0px');
										},
										click: function() {			
											$j( this ).dialog( "close" );
										}
									}
									]
								});	
						
							});					
						}
					}

				}

			}
		}	
	});

window.addEventListener('appinstalled', function(evt) {

	var pnfpb_screenWidth, pnfpb_screenHeight, pnfpb_dialogWidth, pnfpb_dialogHeight, pnfpb_isDesktop;    
	pnfpb_screenWidth = window.screen.width;
	pnfpb_screenHeight = window.screen.height;    

	if (pnfpb_screenWidth < 500) {
		pnfpb_dialogWidth = pnfpb_screenWidth * .95;
		pnfpb_dialogHeight = pnfpb_screenHeight * .95;
	} else {
		pnfpb_dialogWidth = 500;
		pnfpb_dialogHeight = 500;
		pnfpb_isDesktop = true;
	}		

	$j("#pnfpb-pwa-dialog-app-installed" ).dialog({
		autoOpen: true,
		resizable: false,
		closeText : '',
		open: function(event, ui) {
		},			
		width: pnfpb_dialogWidth,
		maxWidth:600,
		closeOnEscape: false,
		draggable: false,
		modal: true,
		buttons: [
		{
			text: 'Ok',
			open: function() {
				$j(this).attr('style','font-weight:bold;color:white;background-color:blue;border:0px');
			},
			click: function() {			
				$j( this ).dialog( "close" );
			}
		}
		]
	})
});

$j.post(pnfpb_ajax_object_push.ajax_url, data, async function(responseajax) {

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

			pnfpb_ic_custom_click_action_url = firebasecredentialsobject.click_action_url;

			firebaseApp = createFirebaseApp(firebaseConfig)
			
			messaging = getMessaging(firebaseApp);

			
			hasFirebaseMessagingSupport = await isSupported();	


	if ((window.location.hash).length > 1 && window.location.href.includes("acomment")) {
	    let interval = setInterval(() => 
    	{
        	let el = document.querySelector(window.location.hash);
        	if (el)
        	{
      			$j("html,body").animate({
        			scrollTop: $j('*[id="'+(window.location.hash).replace("#", "")+'"]').offset().top-70
      			}, 1000);
            	clearInterval(interval);
        	}
    	}, 100);
	}

var notificationclickurl = '';

var deviceid = '';

var homeurl = pnfpb_ajax_object_push.homeurl;
	
if (pnfpb_ajax_object_push.pwainstallbuttontext === '') {
	pnfpb_ajax_object_push.pwainstallbuttontext = __('Install PWA app','PNFPB_TD');
}

if (pnfpb_ajax_object_push.pwainstallheadertext === '') {
	pnfpb_ajax_object_push.pwainstallheadertext = __('Install our PWA app with offline functionality','PNFPB_TD');
}

if (pnfpb_ajax_object_push.pwainstalltext === '') {
	pnfpb_ajax_object_push.pwainstalltext = __('Install PWA','PNFPB_TD');
}

if (pnfpb_ajax_object_push.pwainstallbuttoncolor === '') {
	pnfpb_ajax_object_push.pwainstallbuttoncolor = '#ff0000';
}

if (pnfpb_ajax_object_push.pwainstallbuttontextcolor === '') {
	pnfpb_ajax_object_push.pwainstallbuttontextcolor = '#ffffff';
}

	
var standalone = window.navigator.standalone,
  userAgent = window.navigator.userAgent.toLowerCase(),
  safari_pnfpb = /^(?!.*chrome).*safari/i.test(userAgent),
  ios_pnfpb = /iphone|ipod|ipad/.test(userAgent);
	
var pnfpb_webview = false;

if (ios_pnfpb) {
  if (!standalone && safari_pnfpb) {
    // safari_pnfpb
    pnfpb_webview = false;
  } else if (!standalone && !safari_pnfpb) {
    // ios_pnfpb webview
    pnfpb_webview = true;
	//PNFPB_from_Java_androidapp();
	//PNFPB_from_Flutter_mobileapp();	  	
  };
} else {
  if (userAgent.includes('wv')) {
    // Android webview
    pnfpb_webview = true;
	//PNFPB_from_Java_androidapp();
	//PNFPB_from_Flutter_mobileapp();	  
  } else {
    // Chrome
    pnfpb_webview = false;
  }
};
	
if (pnfpb_ajax_object_push.pwaapponlyenable === '1') {
	navigator.serviceWorker.register(homeurl+'/pnfpb_icpush_pwa_sw.js',{scope:homeurl+'/'}).then(function(registration) {
    	registration.update();	
     	// If updatefound is fired, it means that there's
      	// a new service worker being installed.
      	//var installingWorker = registration.installing;
      registration.onupdatefound = () => {
        var installingWorker = registration.installing;
        installingWorker.onstatechange = () => {
          if (installingWorker.state === 'installed') {
            if (navigator.serviceWorker.controller) {
              // At this point, the old content will have been purged and
              // the fresh content will have been added to the cache.
              // It's the perfect time to display a "New content is
              // available; please refresh." message in your web app.
              console.log(__('New content is available; please refresh.','PNFPB_TD'));
             
            } else {
              // At this point, everything has been precached.
              // It's the perfect time to display a
              // "Content is cached for offline use." message.
              console.log(__('Content is cached for offline use','PNFPB_TD'));
            }
          }
        }
      }
	})
	}
	else
	{
	
		if ('serviceWorker' in navigator && hasFirebaseMessagingSupport) {
			navigator.serviceWorker.register(homeurl+'/pnfpb_icpush_pwa_sw.js',{scope:homeurl+'/'}).then(async function(registration) {
    			registration.update();	
     			// If updatefound is fired, it means that there's
      			// a new service worker being installed.
      			//var installingWorker = registration.installing;
      			registration.onupdatefound = () => {
        			var installingWorker = registration.installing;
        			installingWorker.onstatechange = () => {
          				if (installingWorker.state === 'installed') {
            				if (navigator.serviceWorker.controller) {
              					// At this point, the old content will have been purged and
              					// the fresh content will have been added to the cache.
              					// It's the perfect time to display a "New content is
              					// available; please refresh." message in your web app.
              					console.log(__('New content is available; please refresh.','PNFPB_TD'));
             
            				} else {
              					// At this point, everything has been precached.
              					// It's the perfect time to display a
              					// "Content is cached for offline use." message.
              					console.log(__('Content is cached for offline use','PNFPB_TD'));
            				}
     
          				}
        			}
     			}

				
				if( $j(".pnfpb_subscribe_button").length )
				{
					 $j(".pnfpb_subscribe_button").show();
				}
				
				var isuserloggedin = false;

				if (pnfpb_ajax_object_push.notify_loggedin === '1' && pnfpb_ajax_object_push.isloggedin === '1' && parseInt(pnfpb_ajax_object_push.userid) > 0) {

					isuserloggedin = true;
				}
	
				if ('serviceWorker' in navigator && 'PushManager' in window && hasFirebaseMessagingSupport && ((pnfpb_ajax_object_push.notify_loggedin === '1' && isuserloggedin) || (pnfpb_ajax_object_push.notify_loggedin !== '1') )) {
		
					navigator.serviceWorker.ready.then(async (serviceWorkerRegistration) => {

						messaging = getMessaging(firebaseApp);

						if (pnfpb_ajax_object_push.pnfpb_push_prompt === '1') {

							await pnfpb_show_permission_dialog(serviceWorkerRegistration,'');
	
						}
						
						serviceWorkerRegistration.pushManager.getSubscription().then(async function (subscription) {


						if (pnfpb_ajax_object_push.pnfpb_push_prompt !== '1') {

							if (!subscription) 
							{
								await requestPermission(serviceWorkerRegistration);
							}
							else
							{
                   				await checkdeviceid(serviceWorkerRegistration,subscription); 
							}
						}

						if (hasFirebaseMessagingSupport && subscription) 
						{
							// [START get_messaging_object]
							// Retrieve Firebase Messaging object.
							//messaging = firebase.messaging();
							// [END get_messaging_object]
							// [START set_public_vapid_key]
							// Add the public key generated from the console here.
							//messaging.usePublicVapidKey(pnfpb_ajax_object_push.publicKey);
							// [END set_public_vapid_key]
				
							// IDs of divs that display Instance ID token UI or request permission UI.
							const tokenDivId = 'token_div';

							const permissionDivId = 'permission_div';
							
							// [START refresh_token]
							// Callback fired if Instance ID token is updated.
							//messaging.onTokenRefresh(() => {
							getToken(messaging,{serviceWorkerRegistration:serviceWorkerRegistration,vapidKey:vapidKey }).then(async function (refreshedToken) {
				
								if (refreshedToken) {

									sendTokenToServer(refreshedToken);

									shortcode_subscription_menu(refreshedToken);

									frontend_subscription_menu(refreshedToken);

								}	
				
								// Subscribe the devices corresponding to the registration tokens to the
								// topic.
		
								// Indicate that the new Instance ID token has not yet been sent to the
								// app server.
									
								// Send Instance ID token to app server.
									
								// [START_EXCLUDE]
								// Display new Instance ID token and clear UI of all previous messages.
								//resetUI();
								// [END_EXCLUDE]
							}).catch((err) => {

								console.log(__('Unable to retrieve refreshed token ','PNFPB_TD'), err);

								//showToken(__('Unable to retrieve refreshed token ','PNFPB_TD'), err);
								// alert('Unable to retrieve refreshed token from cloud messaging service '+err);
							});
								//});
							  	// [END refresh_token]
				
							  	// [START receive_message]
							  	// Handle incoming messages. Called when:
							  	// - a message is received while the app has focus
							 	// - the user clicks on an app notification created by a service worker
							  	//   `messaging.setBackgroundMessageHandler` handler.
						}
						else
						{
							if( $j(".pnfpb_subscribe_button").length && !pnfpb_webview)
							{
								console.log(__("Browser notification permission not granted or blocked!!!",'PNFPB_TD'));

								frontend_subscription_menu('');
				
							} 
						}

						/*if (hasFirebaseMessagingSupport && pnfpb_ajax_object_push.pnfpb_hide_foreground_notification !== '1') 
						{
							//messaging = getMessaging(firebaseApp);														
							onMessage(messaging,(payload) => {
								//console.log('Foreground push Message received. ', payload);
								// [START_EXCLUDE]
								// Update the UI to include the received message.
								//appendMessage(payload);
								//alert(payload.notification.click_action);
				
								const notification_foreground = payload.notification;
								// Customize notification here
								const notificationTitle = notification_foreground.title;

								//console.log(payload);
				
								const notificationOptions = {
									body: notification_foreground.body,
									icon: notification_foreground.icon,
									image: notification_foreground.image,
									data: {
										url: payload.data.click_url
									},
									tag: 'renotify',
									renotify: true	 
								};
								var notificationclickurl = payload.data.click_url;

								//console.log(notificationclickurl);
				
								if (!("Notification" in window)) {
									console.log(__("This browser does not support system notifications",'PNFPB_TD'));
								}
								// Let's check whether notification permissions have already been granted
								else
								{
									if (Notification.permission === "granted") {
										// If it's okay let's create a notification
										try {
												var notification = new Notification(notificationTitle, {
												body: notification_foreground.body,
												icon: notification_foreground.icon,
												image: notification_foreground.image,
												data: {
													url: payload.data.click_url
												}
											});
											notification.onclick = function(event) {
												event.preventDefault(); //prevent the browser from focusing the Notification's tab
												console.log(event);
												if (event.action === "read_more") {
													window.open(notificationclickurl, '_blank');
												} else {
													if (event.action === "custom_url") {
														if (pnfpb_ic_custom_click_action_url && pnfpb_ic_custom_click_action_url != '') {
															window.open(pnfpb_ic_custom_click_action_url, '_blank');
														}
													} else {
														if (event.action === "close_notification") {
															event.notification.close();
														} else {
															window.open(notificationclickurl, '_blank');
														}
													}
												}
												notification.close();
											}
										} catch (err) {
											//try { //Need this part as on Android we can only display notifications thru the serviceworker
												if ('serviceWorker' in navigator) {
													navigator.serviceWorker.register(homeurl+'/pnfpb_icpush_pwa_sw.js',{scope:homeurl+'/'}).then(function(registration) {
														registration.showNotification(notificationTitle, notificationOptions);
													}).catch(function(err) {
														console.log(__("Service Worker Failed to Register foreground notification",'PNFPB_TD'), err);
													})
								
												}
												else
												{
													console.log(__('service workers not supported in this browser !!!','PNFPB_TD'), err);
												//}
							
											//} catch (err1) {
											//		console.log(err1.message);
											//}
										}
									}
								}	
										// [END_EXCLUDE]
							})
							
						}
						else
						{
							//console.log(__('This browser does not support PUSHAPI Firebase messaging!!!','PNFPB_TD'));
							frontend_subscription_menu('');
						}*/						
						
        			})
					.catch((err) => {
						console.error(err);
						frontend_subscription_menu('');
			
				  	});		
				})
				.catch((err) => {
					//console.error('Error during getSubscription()');
					console.error(err);
					frontend_subscription_menu('');
			  	});			
				}
				else
				{

					if( $j(".pnfpb_push_notification_frontend_settings_submit").length && !pnfpb_webview)
					{
						frontend_subscription_menu('');
						console.log(__("Browser notification permission not granted or blocked!!!",'PNFPB_TD'));
		
					}					

				}
			})
		
		}
		else {
			
			console.log('check-webview-deviceid');
	
		}
	
	}

	async function pnfpb_show_permission_dialog(registration,subscription) {

		pnfpb_bell_icon_subscribe_push_type_checkbox = ['1','0','0','0','0','0','0','0','0','0','0','0','0','0'];

		pnfpb_bell_icon_subscription_options_custom_prompt = '10000000000000';

		pnfpb_bell_icon_prompt_subscription_options_custom_prompt = '10000000000000';

		pnfpb_bell_icon_prompt_subscribe_push_type_checkbox = ['1','0','0','0','0','0','0','0','0','0','0','0','0','0'];

		if ((pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_on_off === '1' && (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1' || pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2' )) && pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style3 !== '1' ) {

			$j('.pnfpb-push-subscribe-icon').hide();

			if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
			
				$j('.pnfpb-popup-customprompt-transistion-confirmation').hide();

				if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {

					$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("animation-name", "slideDown");

					$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("-webkit-animation-name", "slideDown");

				}

				if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {

					$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("animation-name", "slideUp");

					$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("-webkit-animation-name", "slideUp");
					
				}

			} else {

				if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {

					if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {

						$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("animation-name", "slideDown");

						$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("-webkit-animation-name", "slideDown");

					}


					if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {

						$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("animation-name", "slideUp");

						$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("-webkit-animation-name", "slideUp");
						
					}
						

					$j('.pnfpb-popup-customprompt-vertical-transistion-confirmation').hide();

				}

			}

			let name = 'PNFPB_custom_prompt' + "=";

			let PNFPB_custom_prompt_display = 'ON';

			let decodedCookie = decodeURIComponent(document.cookie);
		
			let ca = decodedCookie.split(';');
		
			for(let i = 0; i <ca.length; i++) {
		
				let c = ca[i];
		
				while (c.charAt(0) == ' ') {
		
					  c = c.substring(1);
		
				}
		
				if (c.indexOf(name) == 0) {

					const pnfpb_custom_prompt_currentDate = new Date();

					pnfpb_custom_prompt_currentDate.setTime(pnfpb_custom_prompt_currentDate.getTime());

					let pnfpb_custom_prompt_cookieDate = c.substring(name.length, c.length).getTime();
		
					if (pnfpb_custom_prompt_cookieDate > pnfpb_custom_prompt_currentDate.getTime()) {
		
						PNFPB_custom_prompt_display = 'OFF';
		
		
						if (pnfpb_ajax_object_push.pwainstallpromptenabled === '1' || $j('.pnfpb-pwa-dialog-container').length) {
		
							$j('.pnfpb-pwa-dialog-container').hide();
		
						}				
		
					}			
				}
			}

			registration.pushManager.getSubscription().then(async function (subscription) {

				if (!subscription && Notification.permission !== "denied" && Notification.permission !== "granted") {

					if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1' && PNFPB_custom_prompt_display === 'ON') {

						$j('.pnfpb-popup-customprompt-container').show();

						pnfpb_bell_icon_subscription_options_custom_prompt = '';

						$j('.pnfpb_bell_icon_subscription_all_enable').off().on('click',function(event) {

			
							if ($j('.pnfpb_bell_icon_subscription_all_enable').is(":checked"))
							{
	
	
								pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';
	
								if (pnfpb_show_push_notify_types.length > 0) {
	
									for (var pnfpb_notify_type_element = 1; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {
	
										pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element] = '0';
	
									}
	
								}
							
								$j('.pnfpb_bell_icon_subscription_post_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_activity_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_all_comments_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_my_comments_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_private_message_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_new_member_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_friendship_request_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_friendship_accepted_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_avatar_change_enable').prop('checked',false);
								
								$j('.pnfpb_bell_icon_subscription_cover_image_change_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked',false);
	
								if (pnfpb_custom_post_types.length > 0) {
	
									for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
	
										$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
	
										var pnfpb_index = $j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').attr("pnfpb_index");
	
										pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
										
									}
								}
		
		
							}
							else 
							{
	
	
								pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
							}								
						});
						
						
						$j('.pnfpb_bell_icon_subscription_group_details_update_enable').off().on('click',function(event) {
		
				
							if ($j('.pnfpb_bell_icon_subscription_group_details_update_enable').is(":checked"))
							{
	
							
								$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

								pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '1';
		
																
							}
							else 
							{
								pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '0';
							}								
						});
						
						$j('.pnfpb_bell_icon_subscription_group_invite_enable').off().on('click',function(event) {
		
				
							if ($j('.pnfpb_bell_icon_subscription_group_invite_enable').is(":checked"))
							{
	
							
								$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

								pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '1';
		
																	
							}
							else 
							{
	
								pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '0';
							}								
						});									


						if (pnfpb_show_push_notify_types.length > 0) {

							for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 12; pnfpb_notify_type_element++) {

								if (pnfpb_show_push_notify_types[pnfpb_notify_type_element] !== 'all') {
	
									$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_notify_type_element]+'_enable').off().on('click',function(event) {
	
										var pnfpb_selector = '.'+$(this).attr("class");
	
										var pnfpb_index = $(this).attr("pnfpb_index");
	
										if ($j(pnfpb_selector).is(":checked"))
										{
	
											pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '1';
	
										
											if (pnfpb_notify_type_element > 0) {
				
												pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
									
												$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
	
											}
																	
										}
										else 
										{
	
											pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '0';
	
										}
									
	
									});
								}								
	
							}

						}						

						if (pnfpb_custom_post_types.length > 0) {

							for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {

								$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);

								$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').off().on('click',function(event) {
		
				
									if ($j(this).is(":checked"))
									{

										pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
				
										pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
									
										$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
				
																		
									}
									else 
									{
										pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
									}								
								});								

							}

						}

						
						if (pnfpb_show_push_notify_types.length > 0) {

							for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < pnfpb_show_push_notify_types.length; pnfpb_notify_type_element++) {

								pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element];
								
							}

						}

						if (pnfpb_custom_post_types.length > 0) {

							for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {

								pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element];
								
							}

						}
	

						$j('.pnfpb-popup-customprompt-transistion-allow-button').off().on( "click", async (event) => {

							$j('.pnfpb-popup-customprompt-container').hide();

							await requestPermission(registration,'',pnfpb_bell_icon_subscription_options_custom_prompt);						

						});						

						$j('.pnfpb-popup-customprompt-transistion-cancel-button').off().on( "click", async (event) => {

							const pnfpb_d = new Date();
							const pnfpb_custom_prompt_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_custom_prompt_show_again_days);
							pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_custom_prompt_show_again_days*24*60*60*1000));
							let expires = "expires="+ pnfpb_d.toUTCString();
							document.cookie = "PNFPB_custom_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";

							if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {

								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
							
									$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("animation-name", "slideDownOut");
				
									$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");

								}

								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
				
									$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("animation-name", "slideDownOut");
				
									$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
									
								}
				
							}
				
							if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {

								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
				
									$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("animation-name", "slideUpOut");
				
									$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");

								}

								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
				
									$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("animation-name", "slideUpOut");
				
									$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
									
								}
				
							}

							$j('.pnfpb-popup-customprompt-container').hide();

						});

					} else {

						if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2' && PNFPB_custom_prompt_display === 'ON') {

							$j('.pnfpb-popup-customprompt-vertical-container').show();

							pnfpb_bell_icon_subscription_options_custom_prompt = '';


							$j('.pnfpb_bell_icon_subscription_all_enable').off().on('click',function(event) {

			
								if ($j('.pnfpb_bell_icon_subscription_all_enable').is(":checked"))
								{
		
		
									pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';
		
									if (pnfpb_show_push_notify_types.length > 0) {
		
										for (var pnfpb_notify_type_element = 1; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {
		
											pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element] = '0';
		
										}
		
									}
								
									$j('.pnfpb_bell_icon_subscription_post_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_activity_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_all_comments_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_my_comments_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_private_message_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_new_member_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_friendship_request_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_friendship_accepted_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_avatar_change_enable').prop('checked',false);
									
									$j('.pnfpb_bell_icon_subscription_cover_image_change_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked',false);
		
									if (pnfpb_custom_post_types.length > 0) {
		
										for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
		
											$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
		
											var pnfpb_index = $j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').attr("pnfpb_index");
		
											pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
											
										}
									}
			
			
								}
								else 
								{
		
		
									pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
								}								
							});
							
							
							$j('.pnfpb_bell_icon_subscription_group_details_update_enable').off().on('click',function(event) {
			
					
								if ($j('.pnfpb_bell_icon_subscription_group_details_update_enable').is(":checked"))
								{
		
								
									$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

									pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '1';
			
																	
								}
								else 
								{
									pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '0';
								}								
							});
							
							$j('.pnfpb_bell_icon_subscription_group_invite_enable').off().on('click',function(event) {
			
					
								if ($j('.pnfpb_bell_icon_subscription_group_invite_enable').is(":checked"))
								{
		
								
									$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

									pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '1';
			
																		
								}
								else 
								{
		
									pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '0';
								}								
							});										


								if (pnfpb_show_push_notify_types.length > 0) {

									for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 12; pnfpb_notify_type_element++) {

										if (pnfpb_show_push_notify_types[pnfpb_notify_type_element] !== 'all') {
			
											$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_notify_type_element]+'_enable').off().on('click',function(event) {
			
												var pnfpb_selector = '.'+$(this).attr("class");
			
												var pnfpb_index = $(this).attr("pnfpb_index");
			
												if ($j(pnfpb_selector).is(":checked"))
												{
			
													pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '1';
			
												
													if (pnfpb_notify_type_element > 0) {
						
														pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
											
														$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
			
													}
																			
												}
												else 
												{
			
													pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '0';
			
												}
											
			
											});
										}								
			
									}
		
								}										

								if (pnfpb_custom_post_types.length > 0) {

									for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
		
										$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
		
										$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').off().on('click',function(event) {
						
											if ($j(this).is(":checked"))
											{
		
												pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
						
												pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
											
												$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
						
																				
											}
											else 
											{

												pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';

											}

										});								
		
									}
		
								}								

								if (pnfpb_show_push_notify_types.length > 0) {

									for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < pnfpb_show_push_notify_types.length; pnfpb_notify_type_element++) {
		
										pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element];
										
									}
		
								}

								if (pnfpb_custom_post_types.length > 0) {

									for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
		
										pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element];
										
									}
		
								}		
	

							$j('.pnfpb-popup-customprompt-vertical-transistion-allow-button').off().on( "click", async (event) => {

								$j('.pnfpb-popup-customprompt-vertical-container').hide();

								await requestPermission(registration,'',pnfpb_bell_icon_subscription_options_custom_prompt);	

							});						
	
							$j('.pnfpb-popup-customprompt-vertical-transistion-cancel-button').off().on( "click", async (event) => {

								const pnfpb_d = new Date();

								const pnfpb_custom_prompt_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_custom_prompt_show_again_days);

								pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_custom_prompt_show_again_days*24*60*60*1000));

								let expires = "expires="+ pnfpb_d.toUTCString();

								document.cookie = "PNFPB_custom_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
								
								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {

									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
								
										$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("animation-name", "slideDownOut");
					
										$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
	
									}
	
									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
					
										$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("animation-name", "slideDownOut");
					
										$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
										
									}
					
								}
					
								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {
	
									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
					
										$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("animation-name", "slideUpOut");
					
										$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
	
									}
	
									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
					
										$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("animation-name", "slideUpOut");
					
										$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
										
									}
					
								}								
	
								$j('.pnfpb-popup-customprompt-vertical-container').hide();
		
							});						

						}

					}

				} else {

					if (!subscription && Notification.permission !== "denied" && Notification.permission === "granted") {

						await requestPermission(registration);

					} else {

						if (subscription) {

							await checkdeviceid(registration,subscription);

						}

					}
				}
				
			});

		} else {

		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_on_off === '1' && (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1' || pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2' ) ) {

			$j('.pnfpb-push-subscribe-icon').hide();

			if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
			
				$j('.pnfpb-popup-customprompt-transistion-confirmation').hide();

				if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {

					$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("animation-name", "slideDown");

					$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("-webkit-animation-name", "slideDown");

				}

				if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {

					$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("animation-name", "slideUp");

					$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("-webkit-animation-name", "slideUp");
					
				}

			} else {

				if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {

					if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {

						$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("animation-name", "slideDown");

						$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("-webkit-animation-name", "slideDown");

					}


					if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {

						$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("animation-name", "slideUp");

						$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("-webkit-animation-name", "slideUp");
						
					}
						

					$j('.pnfpb-popup-customprompt-vertical-transistion-confirmation').hide();

				}

			}

			let name = 'PNFPB_custom_prompt' + "=";

			let PNFPB_custom_prompt_display = 'ON';

			let decodedCookie = decodeURIComponent(document.cookie);
		
			let ca = decodedCookie.split(';');
		
			for(let i = 0; i <ca.length; i++) {
		
				let c = ca[i];
		
				while (c.charAt(0) == ' ') {
		
					  c = c.substring(1);
		
				}
		
				if (c.indexOf(name) == 0) {

					const pnfpb_custom_prompt_currentDate = new Date();

					pnfpb_custom_prompt_currentDate.setTime(pnfpb_custom_prompt_currentDate.getTime());

					let pnfpb_custom_prompt_cookieDate = c.substring(name.length, c.length).getTime();
		
					if (pnfpb_custom_prompt_cookieDate > pnfpb_custom_prompt_currentDate.getTime()) {
		
						PNFPB_custom_prompt_display = 'OFF';
		
		
						if (pnfpb_ajax_object_push.pwainstallpromptenabled === '1' || $j('.pnfpb-pwa-dialog-container').length) {
		
							$j('.pnfpb-pwa-dialog-container').hide();
		
						}				
		
					}			
				}
			}
					

			registration.pushManager.getSubscription().then(async function (subscription) {

				if (!subscription && Notification.permission !== "denied" && Notification.permission !== "granted") {

					if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1' && PNFPB_custom_prompt_display === 'ON') {

						$j('.pnfpb-popup-customprompt-container').show();

						pnfpb_bell_icon_subscription_options_custom_prompt = '';

						$j('.pnfpb_bell_icon_subscription_all_enable').off().on('click',function(event) {

			
							if ($j('.pnfpb_bell_icon_subscription_all_enable').is(":checked"))
							{
	
	
								pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';
	
								if (pnfpb_show_push_notify_types.length > 0) {
	
									for (var pnfpb_notify_type_element = 1; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {
	
										pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element] = '0';
	
									}
	
								}
							
								$j('.pnfpb_bell_icon_subscription_post_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_activity_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_all_comments_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_my_comments_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_private_message_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_new_member_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_friendship_request_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_friendship_accepted_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_avatar_change_enable').prop('checked',false);
								
								$j('.pnfpb_bell_icon_subscription_cover_image_change_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked',false);
	
								if (pnfpb_custom_post_types.length > 0) {
	
									for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
	
										$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
	
										var pnfpb_index = $j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').attr("pnfpb_index");
	
										pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
										
									}
								}
		
		
							}
							else 
							{
	
	
								pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
							}								
						});
						
						
						$j('.pnfpb_bell_icon_subscription_group_details_update_enable').off().on('click',function(event) {
		
				
							if ($j('.pnfpb_bell_icon_subscription_group_details_update_enable').is(":checked"))
							{
	
							
								$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

								pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '1';
		
																
							}
							else 
							{
								pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '0';
							}								
						});
						
						$j('.pnfpb_bell_icon_subscription_group_invite_enable').off().on('click',function(event) {
		
				
							if ($j('.pnfpb_bell_icon_subscription_group_invite_enable').is(":checked"))
							{
	
							
								$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

								pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '1';
		
																	
							}
							else 
							{
	
								pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '0';
							}								
						});									


						if (pnfpb_show_push_notify_types.length > 0) {

							for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 12; pnfpb_notify_type_element++) {

								if (pnfpb_show_push_notify_types[pnfpb_notify_type_element] !== 'all') {
	
									$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_notify_type_element]+'_enable').off().on('click',function(event) {
	
										var pnfpb_selector = '.'+$(this).attr("class");
	
										var pnfpb_index = $(this).attr("pnfpb_index");
	
										if ($j(pnfpb_selector).is(":checked"))
										{
	
											pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '1';
	
										
											if (pnfpb_notify_type_element > 0) {
				
												pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
									
												$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
	
											}
																	
										}
										else 
										{
	
											pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '0';
	
										}
									
	
									});
								}								
	
							}
	
						}									

						if (pnfpb_custom_post_types.length > 0) {

								for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
	
									$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
	
									$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').off().on('click',function(event) {
			
					
										if ($j(this).is(":checked"))
										{
	
											pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
					
											pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
										
											$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
					
																			
										}
										else 
										{
											pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
										}                               
									});                             
	
								}
	
						}                               

							

						$j('.pnfpb-popup-customprompt-transistion-allow-button').off().on( "click", async (event) => {

							pnfpb_bell_icon_subscription_options_custom_prompt = '';

							if (pnfpb_show_push_notify_types.length > 0) {

								for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < pnfpb_show_push_notify_types.length; pnfpb_notify_type_element++) {
	
									pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element];
									
								}
	
							}

							if (pnfpb_custom_post_types.length > 0) {

								for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
	
									pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element];
									
								}
	
							}							
							
							$j('.pnfpb-popup-customprompt-container').hide();

							await requestPermission(registration,'',pnfpb_bell_icon_subscription_options_custom_prompt);						

						});						

						$j('.pnfpb-popup-customprompt-transistion-cancel-button').off().on( "click", async (event) => {

							const pnfpb_d = new Date();

							const pnfpb_custom_prompt_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_custom_prompt_show_again_days);

							pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_custom_prompt_show_again_days*24*60*60*1000));

							let expires = "expires="+ pnfpb_d.toUTCString();

							document.cookie = "PNFPB_custom_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
							
							if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {

								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
							
									$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("animation-name", "slideDownOut");
				
									$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");

								}

								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
				
									$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("animation-name", "slideDownOut");
				
									$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
									
								}
				
							}
				
							if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {

								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
				
									$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("animation-name", "slideUpOut");
				
									$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");

								}

								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
				
									$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("animation-name", "slideUpOut");
				
									$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
									
								}
				
							}							

							$j('.pnfpb-popup-customprompt-container').hide();
	
						});

					} else {

						if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2' && PNFPB_custom_prompt_display === 'ON') {

	
							$j('.pnfpb-popup-customprompt-vertical-container').show();

							pnfpb_bell_icon_subscription_options_custom_prompt = '';

							$j('.pnfpb_bell_icon_subscription_all_enable').off().on('click',function(event) {

			
								if ($j('.pnfpb_bell_icon_subscription_all_enable').is(":checked"))
								{
		
		
									pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';
		
									if (pnfpb_show_push_notify_types.length > 0) {
		
										for (var pnfpb_notify_type_element = 1; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {
		
											pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element] = '0';
		
										}
		
									}
								
									$j('.pnfpb_bell_icon_subscription_post_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_activity_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_all_comments_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_my_comments_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_private_message_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_new_member_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_friendship_request_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_friendship_accepted_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_avatar_change_enable').prop('checked',false);
									
									$j('.pnfpb_bell_icon_subscription_cover_image_change_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked',false);
		
									if (pnfpb_custom_post_types.length > 0) {
		
										for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
		
											$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
		
											var pnfpb_index = $j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').attr("pnfpb_index");
		
											pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
											
										}
									}
			
			
								}
								else 
								{
		
		
									pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
								}								
							});
							
							
							$j('.pnfpb_bell_icon_subscription_group_details_update_enable').off().on('click',function(event) {
			
					
								if ($j('.pnfpb_bell_icon_subscription_group_details_update_enable').is(":checked"))
								{
		
								
									$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

									pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '1';
			
																	
								}
								else 
								{
									pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '0';
								}								
							});
							
							$j('.pnfpb_bell_icon_subscription_group_invite_enable').off().on('click',function(event) {
			
					
								if ($j('.pnfpb_bell_icon_subscription_group_invite_enable').is(":checked"))
								{
		
								
									$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

									pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '1';
			
																		
								}
								else 
								{
		
									pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '0';
								}								
							});			
								

								if (pnfpb_show_push_notify_types.length > 0) {

									for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 12; pnfpb_notify_type_element++) {

										if (pnfpb_show_push_notify_types[pnfpb_notify_type_element] !== 'all') {
			
											$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_notify_type_element]+'_enable').off().on('click',function(event) {
			
												var pnfpb_selector = '.'+$(this).attr("class");
			
												var pnfpb_index = $(this).attr("pnfpb_index");
			
												if ($j(pnfpb_selector).is(":checked"))
												{
			
													pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '1';
			
												
													if (pnfpb_notify_type_element > 0) {
						
														pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
											
														$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
			
													}
																			
												}
												else 
												{
			
													pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '0';
			
												}
											
			
											});
										}								
			
									}
		
								}										

                                if (pnfpb_custom_post_types.length > 0) {

                                    for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
        
                                        $j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
        
                                        $j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').off().on('click',function(event) {
                        
                                            if ($j(this).is(":checked"))
                                            {
        
                                                pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
                        
                                                pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
                                            
                                                $j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
                        
                                                                                
                                            }
                                            else 
                                            {

                                                pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';

                                            }

                                        });                             
        
                                    }
        
                                }     								
						
							

							$j('.pnfpb-popup-customprompt-vertical-transistion-allow-button').off().on( "click", async (event) => {

								//pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscribe_all_checkbox + pnfpb_bell_icon_subscribe_post_checkbox + pnfpb_bell_icon_subscribe_all_comments_checkbox + pnfpb_bell_icon_subscribe_my_comments_checkbox + pnfpb_bell_icon_subscribe_private_message_checkbox + pnfpb_bell_icon_subscribe_new_member_checkbox + pnfpb_bell_icon_subscribe_friendship_request_checkbox  + pnfpb_bell_icon_subscribe_friendship_accepted_checkbox  + pnfpb_bell_icon_subscribe_avatar_change_checkbox + pnfpb_bell_icon_subscribe_cover_image_checkbox + '0' + pnfpb_bell_icon_subscribe_activity_checkbox + pnfpb_bell_icon_subscribe_group_details_checkbox + pnfpb_bell_icon_subscribe_group_invite_checkbox;

								pnfpb_bell_icon_subscription_options_custom_prompt = '';

								if (pnfpb_show_push_notify_types.length > 0) {

									for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < pnfpb_show_push_notify_types.length; pnfpb_notify_type_element++) {
		
										pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element];
										
									}
		
								}

								if (pnfpb_custom_post_types.length > 0) {

                                    for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
        
                                        pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element];
                                        
                                    }
        
                                }

								$j('.pnfpb-popup-customprompt-vertical-container').hide();

								await requestPermission(registration,'',pnfpb_bell_icon_subscription_options_custom_prompt);	

							});						
	
							$j('.pnfpb-popup-customprompt-vertical-transistion-cancel-button').off().on( "click", async (event) => {

								const pnfpb_d = new Date();

								const pnfpb_custom_prompt_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_custom_prompt_show_again_days);

								pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_custom_prompt_show_again_days*24*60*60*1000));

								let expires = "expires="+ pnfpb_d.toUTCString();

								document.cookie = "PNFPB_custom_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
								
								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {

									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
								
										$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("animation-name", "slideDownOut");
					
										$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
	
									}
	
									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
					
										$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("animation-name", "slideDownOut");
					
										$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
										
									}
					
								}
					
								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {
	
									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
					
										$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("animation-name", "slideUpOut");
					
										$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
	
									}
	
									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
					
										$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("animation-name", "slideUpOut");
					
										$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
										
									}
					
								}								
	
								$j('.pnfpb-popup-customprompt-vertical-container').hide();

							});						

						}

					}

				} else {

					if (subscription) {

						await checkdeviceid(registration,subscription);

					}
					
				}
			});		
		} 

		$j('.pnfpb-push-subscribe-icon').show();

		var pnfpb_popup_subscribe_text = __("You are subscribed to push notification",'PNFPB_TD');

		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_message && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_message != '') {

			pnfpb_popup_subscribe_text = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_message;

		}

		var pnfpb_popup_unsubscribe_text = __("Push notification not subscribed",'PNFPB_TD');

		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_message && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_message != '') {

			pnfpb_popup_unsubscribe_text = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_message;
			
		}

		var pnfpb_popup_wait_message = __("Please wait...processing",'PNFPB_TD');

		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_wait_message && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_wait_message != '') {

			pnfpb_popup_wait_message = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_wait_message;
			
		}
		
		var pnfpb_popup_subscribe_button = __("Subscribe",'PNFPB_TD');

		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_button && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_button != '') {

			pnfpb_popup_subscribe_button = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_button;
			
		}

		var pnfpb_popup_unsubscribe_button = __("Unsubscribe",'PNFPB_TD');

		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_button && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_button != '') {

			pnfpb_popup_unsubscribe_button = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_button;
			
		}
		
		var pnfpb_push_subscribe_options_button = __("Update",'PNFPB_TD');

		if (pnfpb_ajax_object_push.pnfpb_push_subscribe_options_button && pnfpb_ajax_object_push.pnfpb_push_subscribe_options_button != '') {

			pnfpb_push_subscribe_options_button = pnfpb_ajax_object_push.pnfpb_push_subscribe_options_button;
			
		}


		registration.pushManager.getSubscription().then(async function (subscription) {	

			if (subscription) {

				await checkdeviceid(registration,subscription);

			} 

		});		

		$j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");

		$j('.pnfpb-push-subscribe-icon').on( "mouseenter", function(event) {

			$j('.pnfpb-push-status-text').text(__('Verifying subscription status...','PNFPB_TD'));

			navigator.serviceWorker.ready.then((serviceWorkerRegistration) => {

				serviceWorkerRegistration.pushManager.getSubscription().then(async function (subscription) {

					if (subscription && pnfpb_bell_prompt_processing !== '1') {

						$j('.pnfpb-push-status-text').text(pnfpb_popup_subscribe_text);
						$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");

					}
					else {

						if (pnfpb_bell_prompt_processing === '1') {

							$j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");

						} else {

							$j('.pnfpb-push-status-text').text(pnfpb_popup_unsubscribe_text);
							$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");

						}

					}
					
				})

			});

		}).on( "mouseleave", function() {

			$j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");

		});

		$j('.pnfpb-push-subscribe-icon').on( "click", function(event) {
	
			event.stopPropagation(); 
	
			event.preventDefault();


			pnfpb_bell_icon_prompt_subscription_options_custom_prompt = '10000000000000';
			
			pnfpb_subscription_options = '';

	
			$j('.pnfpb-push-subscribe-button-layout').toggle();

			$j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");

			if ($('.pnfpb-push-subscribe-button-layout').is(':visible')) {

				$j('.pnfpb-push-subscribe-button-layout').addClass("pnfpb-push-subscribe-button-layout-opened");	

			}
			else {

				$j('.pnfpb-push-subscribe-button-layout').removeClass("pnfpb-push-subscribe-button-layout-opened");

			}

			$j('.pnfpb-push-subscribe-button').text(__('Please wait...verifying status','PNFPB_TD'));
	
			registration.pushManager.getSubscription().then(async function (subscription) {

				if (subscription) {

					$j('.pnfpb-push-subscribe-options-button').text(pnfpb_push_subscribe_options_button);

					$j('.pnfpb-push-subscribe-options-button').hide();

					if ($j('.pnfpb-push-subscribe-options-button-container').length) {

						$j('.pnfpb-push-subscribe-options-button-container').show();
					}

					$j('.pnfpb-push-subscribe-button').text(pnfpb_popup_unsubscribe_button);

					$j('.pnfpb-push-subscribe-button').show();

					$j('.pnfpb-push-subscribe-button').removeClass("pnfpb-popup-subscribe-class");

					$j('.pnfpb-push-subscribe-button').addClass("pnfpb-popup-unsubscribe-class");

					pnfpb_subscription_options = '';
					
					await checkdeviceid(registration,subscription);

					if ($j('.pnfpb-push-subscribe-options-button-container').length) {

						$j('.pnfpb-push-subscribe-options-button').show();

					}
					
					$j('.pnfpb_bell_icon_prompt_subscription_all_enable').off().on('click',function(event) {

			
						if ($j('.pnfpb_bell_icon_prompt_subscription_all_enable').is(":checked"))
						{


							pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '1';

							if (pnfpb_show_push_notify_types.length > 0) {

								for (var pnfpb_notify_type_element = 1; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {

									pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_notify_type_element] = '0';

								}

							}
						
							$j('.pnfpb_bell_icon_prompt_subscription_post_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_activity_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_all_comments_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_my_comments_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_private_message_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_new_member_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_friendship_request_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_friendship_accepted_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_avatar_change_enable').prop('checked',false);
							
							$j('.pnfpb_bell_icon_prompt_subscription_cover_image_change_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable').prop('checked',false);

							if (pnfpb_custom_post_types.length > 0) {

								for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {

									$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);

									var pnfpb_index = $j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').attr("pnfpb_index");

									pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
									
								}
							}
	
	
						}
						else 
						{


							pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
						}								
					});
					
					
					$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable').off().on('click',function(event) {
	
			
						if ($j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable').is(":checked"))
						{

						
							$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);
							pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '1';
	
															
						}
						else 
						{
							pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '0';
						}								
					});
					
					$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable').off().on('click',function(event) {
	
			
						if ($j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable').is(":checked"))
						{

						
							$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);
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

								$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_notify_type_element]+'_enable').off().on('click',function(event) {

									var pnfpb_selector = '.'+$(this).attr("class");

									var pnfpb_index = $(this).attr("pnfpb_index");

									if ($j(pnfpb_selector).is(":checked"))
									{

										pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_index] = '1';

									
										if (pnfpb_notify_type_element > 0) {
			
											pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
								
											$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);

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

							$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').off().on('click',function(event) {
	
								var pnfpb_selector = '.'+$(this).attr("class");

								var pnfpb_index = $(this).attr("pnfpb_index");

								if ($j(pnfpb_selector).is(":checked"))
								{

									pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';

									pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
								
									$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);
			
					
								}
								else 
								{
									
									pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '0';


								}


							});								

						}

					}					
	
					$j('.pnfpb-push-subscribe-options-button').off().on( "click", async (event) => {
	
						event.stopPropagation(); 
						
						event.preventDefault();	
						
						$j('.pnfpb_bell_icon_custom_prompt_loader').show();
	
						$j('.pnfpb_bell_icon_subscription_options_container').hide();					
	
						$j('.pnfpb-push-subscribe-options-button').hide();
	
						var pnfpb_bell_icon_prompt_subscription_options = '';
	
						if (pnfpb_show_push_notify_types.length > 0) {

							for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {

								pnfpb_bell_icon_prompt_subscription_options = pnfpb_bell_icon_prompt_subscription_options+pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_notify_type_element];
								
							}

						}

						if (pnfpb_custom_post_types.length > 0) {

							for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {

								pnfpb_bell_icon_prompt_subscription_options = pnfpb_bell_icon_prompt_subscription_options+pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element];
								
							}

						}
						

						getToken(messaging,{serviceWorkerRegistration:registration,vapidKey:vapidKey }).then(async function (refreshedToken) {		
			
							if (refreshedToken) {
		   
								deviceid = refreshedToken;
		
								var data = {
									action: 'icpushcallback',
									device_id:deviceid,
									subscriptionoptions:pnfpb_bell_icon_prompt_subscription_options,
									pushtype: 'subscribe-button'
								};
			
								$j.post(pnfpb_ajax_object_push.ajax_url, data, function(responseajax) {
								
									var response = JSON.parse(responseajax);
								
									pnfpb_subscription_options = response.subscriptionoptions;
	
									$j('.pnfpb_bell_icon_custom_prompt_loader').hide();
	
									$j('.pnfpb-push-subscribe-options-button').show();
	
									$j('.pnfpb_bell_icon_subscription_options_container').show();		
	
									$j('.pnfpb-push-status-text').text(__('Subscription options updated','PNFPB_TD'));
	
									$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");
	
		
								});
							}
						});
	
					});					
					

				} else  {

					if ($j('.pnfpb-push-subscribe-options-button-container').length) {

						$j('.pnfpb-push-subscribe-options-button-container').show();

						$j('.pnfpb-push-subscribe-options-button').show();

					}

					$j('.pnfpb-push-subscribe-button').text(pnfpb_popup_subscribe_button);

					$j('.pnfpb-push-subscribe-button').show();

					$j('.pnfpb-push-subscribe-button').removeClass("pnfpb-popup-unsubscribe-class");

					$j('.pnfpb-push-subscribe-button').addClass("pnfpb-popup-subscribe-class");					

				}




	
				$j('.pnfpb-popup-unsubscribe-class').off().on( "click", async (event) => {

					var subscribetext = $j('.pnfpb-push-subscribe-button').text();

					event.stopPropagation(); 
	
					event.preventDefault();
					
					$j('.pnfpb-push-subscribe-button-layout').hide();

					pnfpb_bell_prompt_processing = '1';

					registration.pushManager.getSubscription().then(async (subscription) => {

						if (subscription) {

							$j('.pnfpb-push-status-text').text(pnfpb_popup_wait_message);

							$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");	

							getToken(messaging,{serviceWorkerRegistration:registration,vapidKey:vapidKey }).then(async (refreshedToken) => {

								subscription.unsubscribe().then((successful) => {

								  	deleteToken(messaging).then(function (deleteTokenstatus) {

										if (deleteTokenstatus) {

											var pnfpbshortcodeactive = 'no';

											var isadminpage = 'no';
											
											if (window.location.href.match('wp-admin') !== null) {
												isadminpage = 'yes';
											}
											
											if( $j(".pnfpb_subscribe_button").length || $j(".pnfpb_push_notification_frontend_settings_submit").length )
											{
												pnfpbshortcodeactive = 'yes';
											}	
											
											var data = {
												action: 'icpushcallback',
												device_id:refreshedToken,
												isadminpage:isadminpage,
												pnfpbshortcodeactive:pnfpbshortcodeactive,
												pushtype: 'deletepushtoken'
											};
												
											$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
							
												var responseobject = JSON.parse(response);

												pnfpb_bell_prompt_processing = '';
											
												if (responseobject.subscriptionstatus === 'deleted') {
											
													console.log(__('Push subscription token deleted successfully','PNFPB_TD'));
											
												}
												else {
													console.log(__('Push subscription token deletion failed in database','PNFPB_TD'));
												}

												$j('.pnfpb-push-subscribe-button').text(pnfpb_popup_subscribe_button);

												$j('.pnfpb-push-subscribe-button').removeClass("pnfpb-popup-unsubscribe-class");

												$j('.pnfpb-push-subscribe-button').addClass("pnfpb-popup-subscribe-class");

												$j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");	

												$j('.pnfpb-push-status-text').text(pnfpb_popup_unsubscribe_text);
	
												$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");
												

												pnfpb_bell_icon_subscribe_push_type_checkbox = ['1','0','0','0','0','0','0','0','0','0','0','0','0','0'];
										
												pnfpb_bell_icon_subscription_options_custom_prompt = '10000000000000';
												
										
												pnfpb_bell_icon_prompt_subscription_options_custom_prompt = '10000000000000';
												
												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox = ['1','0','0','0','0','0','0','0','0','0','0','0','0','0'];
											
											});												
	

										}
	
									}).catch((e) => {

										pnfpb_bell_prompt_processing = '';

										console.log(__("Unsubscribe token failed",'PNFPB_TD'));

									});
								}).catch((e) => {

									pnfpb_bell_prompt_processing = '';

									console.log(__("Unsubscribe token failed",'PNFPB_TD'));

								});
							})
						}
					}).catch((e) => {

						pnfpb_bell_prompt_processing = '';

						console.log(__("Unsubscribe subscription failed",'PNFPB_TD'));

					});
				});							
								
				$j('.pnfpb-popup-subscribe-class').off().on( "click", async (event) => {

					event.stopPropagation(); 
	
					event.preventDefault();

					var subscribetext = $j('.pnfpb-push-subscribe-button').text();

					pnfpb_bell_prompt_processing = '1';

					if (!subscription) {

						$j('.pnfpb-push-subscribe-button-layout').hide();

						$j('.pnfpb-push-subscribe-button').hide();
						
						$j('.pnfpb-push-subscribe-options-button').hide();						

						$j('.pnfpb-push-status-text').text(pnfpb_popup_wait_message);

						$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");

						var pnfpb_ic_fcm_custom_prompt_subscribe_text = __("We would like to show you notifications for the latest news and updates",'PNFPB_TD');
	
						if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribe_text && pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribe_text != '') {
					
							pnfpb_ic_fcm_custom_prompt_subscribe_text = pnfpb_ajax_object_push.pnfpb_prompt_subscribe_text;
							
						}						
						
						if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_on_off === '1' && (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style	 === '1' || pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2' )) {

							if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {

								$j('.pnfpb-popup-customprompt-transistion-body-message').text(pnfpb_ic_fcm_custom_prompt_subscribe_text);

								$j('.pnfpb-popup-customprompt-transistion-confirmation').hide();
						
								$j('.pnfpb-popup-customprompt-container').show();

								$j('.pnfpb-popup-customprompt-transistion').show();

								pnfpb_bell_icon_subscription_options_custom_prompt = '';

								$j('.pnfpb_bell_icon_subscription_all_enable').off().on('click',function(event) {
	
				
									if ($j('.pnfpb_bell_icon_subscription_all_enable').is(":checked"))
									{
			
			
										pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';
			
										if (pnfpb_show_push_notify_types.length > 0) {
			
											for (var pnfpb_notify_type_element = 1; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {
			
												pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element] = '0';
			
											}
			
										}
									
										$j('.pnfpb_bell_icon_subscription_post_enable').prop('checked',false);
				
										$j('.pnfpb_bell_icon_subscription_activity_enable').prop('checked',false);
				
										$j('.pnfpb_bell_icon_subscription_all_comments_enable').prop('checked',false);
				
										$j('.pnfpb_bell_icon_subscription_my_comments_enable').prop('checked',false);
				
										$j('.pnfpb_bell_icon_subscription_private_message_enable').prop('checked',false);
				
										$j('.pnfpb_bell_icon_subscription_new_member_enable').prop('checked',false);
				
										$j('.pnfpb_bell_icon_subscription_friendship_request_enable').prop('checked',false);
				
										$j('.pnfpb_bell_icon_subscription_friendship_accepted_enable').prop('checked',false);
				
										$j('.pnfpb_bell_icon_subscription_avatar_change_enable').prop('checked',false);
										
										$j('.pnfpb_bell_icon_subscription_cover_image_change_enable').prop('checked',false);
				
										$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked',false);
				
										$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked',false);
			
										if (pnfpb_custom_post_types.length > 0) {
			
											for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
			
												$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
			
												var pnfpb_index = $j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').attr("pnfpb_index");
			
												pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
												
											}
										}
				
				
									}
									else 
									{
			
			
										pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
									}								
								});
								
								
								$j('.pnfpb_bell_icon_subscription_group_details_update_enable').off().on('click',function(event) {
				
						
									if ($j('.pnfpb_bell_icon_subscription_group_details_update_enable').is(":checked"))
									{
			
									
										$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
	
										pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '1';
				
																		
									}
									else 
									{
										pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '0';
									}								
								});
								
								$j('.pnfpb_bell_icon_subscription_group_invite_enable').off().on('click',function(event) {
				
						
									if ($j('.pnfpb_bell_icon_subscription_group_invite_enable').is(":checked"))
									{
			
									
										$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
	
										pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '1';
				
																			
									}
									else 
									{
			
										pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '0';
									}								
								});			
									
	
									if (pnfpb_show_push_notify_types.length > 0) {
	
										for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 12; pnfpb_notify_type_element++) {
	
											if (pnfpb_show_push_notify_types[pnfpb_notify_type_element] !== 'all') {
				
												$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_notify_type_element]+'_enable').off().on('click',function(event) {
				
													var pnfpb_selector = '.'+$(this).attr("class");
				
													var pnfpb_index = $(this).attr("pnfpb_index");
				
													if ($j(pnfpb_selector).is(":checked"))
													{
				
														pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '1';
				
													
														if (pnfpb_notify_type_element > 0) {
							
															pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
												
															$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
				
														}
																				
													}
													else 
													{
				
														pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '0';
				
													}
												
				
												});
											}								
				
										}
			
									}										
	
									if (pnfpb_custom_post_types.length > 0) {
	
										for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
			
											$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
			
											$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').off().on('click',function(event) {
							
												if ($j(this).is(":checked"))
												{
			
													pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
							
													pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
												
													$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
							
																					
												}
												else 
												{
	
													pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
	
												}
	
											});                             
			
										}
			
									}     														
		
								$j('.pnfpb-popup-customprompt-transistion-allow-button').off().on( "click", async (event) => {

						
									//var pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscribe_all_checkbox + pnfpb_bell_icon_subscribe_post_checkbox + pnfpb_bell_icon_subscribe_all_comments_checkbox + pnfpb_bell_icon_subscribe_my_comments_checkbox + pnfpb_bell_icon_subscribe_private_message_checkbox + pnfpb_bell_icon_subscribe_new_member_checkbox + pnfpb_bell_icon_subscribe_friendship_request_checkbox  + pnfpb_bell_icon_subscribe_friendship_accepted_checkbox  + pnfpb_bell_icon_subscribe_avatar_change_checkbox + pnfpb_bell_icon_subscribe_cover_image_checkbox + '0' + pnfpb_bell_icon_subscribe_activity_checkbox + pnfpb_bell_icon_subscribe_group_details_checkbox + pnfpb_bell_icon_subscribe_group_invite_checkbox;

									var pnfpb_bell_icon_subscription_options = '';

									if (pnfpb_show_push_notify_types.length > 0) {

										for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < pnfpb_show_push_notify_types.length; pnfpb_notify_type_element++) {
			
											pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element];
											
										}
			
									}
			
									if (pnfpb_custom_post_types.length > 0) {
			
										for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
			
											pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element];
											
										}
			
									}	

									$j('.pnfpb-popup-customprompt-container').hide();

									pnfpb_bell_prompt_processing = '1';

									await requestPermission(registration,'',pnfpb_bell_icon_subscription_options);						
		
								});						
		
								$j('.pnfpb-popup-customprompt-transistion-cancel-button').off().on( "click", async (event) => {

									$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("animation-name", "slideDownOut");
						
									$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
		
									$j('.pnfpb-popup-customprompt-container').hide();
		
								});
		
							} else {
		
								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {

									$j('.pnfpb-popup-customprompt-transistion-body-message').text(pnfpb_ic_fcm_custom_prompt_subscribe_text);

									$j('.pnfpb-popup-customprompt-vertical-transistion-confirmation').hide();
		
									$j('.pnfpb-popup-customprompt-vertical-container').show();

									$j('.pnfpb-popup-customprompt-vertical-transistion').show();

									pnfpb_bell_icon_subscription_options_custom_prompt = '';

									$j('.pnfpb_bell_icon_subscription_all_enable').off().on('click',function(event) {
		
					
										if ($j('.pnfpb_bell_icon_subscription_all_enable').is(":checked"))
										{
				
				
											pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';
				
											if (pnfpb_show_push_notify_types.length > 0) {
				
												for (var pnfpb_notify_type_element = 1; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {
				
													pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element] = '0';
				
												}
				
											}
										
											$j('.pnfpb_bell_icon_subscription_post_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_subscription_activity_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_subscription_all_comments_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_subscription_my_comments_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_subscription_private_message_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_subscription_new_member_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_subscription_friendship_request_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_subscription_friendship_accepted_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_subscription_avatar_change_enable').prop('checked',false);
											
											$j('.pnfpb_bell_icon_subscription_cover_image_change_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked',false);
				
											if (pnfpb_custom_post_types.length > 0) {
				
												for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
				
													$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
				
													var pnfpb_index = $j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').attr("pnfpb_index");
				
													pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
													
												}
											}
					
					
										}
										else 
										{
				
				
											pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
										}								
									});
									
									
									$j('.pnfpb_bell_icon_subscription_group_details_update_enable').off().on('click',function(event) {
					
							
										if ($j('.pnfpb_bell_icon_subscription_group_details_update_enable').is(":checked"))
										{
				
										
											$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
		
											pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '1';
					
																			
										}
										else 
										{
											pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '0';
										}								
									});
									
									$j('.pnfpb_bell_icon_subscription_group_invite_enable').off().on('click',function(event) {
					
							
										if ($j('.pnfpb_bell_icon_subscription_group_invite_enable').is(":checked"))
										{
				
										
											$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
		
											pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '1';
					
																				
										}
										else 
										{
				
											pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '0';
										}								
									});			
										
		
										if (pnfpb_show_push_notify_types.length > 0) {
		
											for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 12; pnfpb_notify_type_element++) {
		
												if (pnfpb_show_push_notify_types[pnfpb_notify_type_element] !== 'all') {
					
													$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_notify_type_element]+'_enable').off().on('click',function(event) {
					
														var pnfpb_selector = '.'+$(this).attr("class");
					
														var pnfpb_index = $(this).attr("pnfpb_index");
					
														if ($j(pnfpb_selector).is(":checked"))
														{
					
															pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '1';
					
														
															if (pnfpb_notify_type_element > 0) {
								
																pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
													
																$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
					
															}
																					
														}
														else 
														{
					
															pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '0';
					
														}
													
					
													});
												}								
					
											}
				
										}										
		
										if (pnfpb_custom_post_types.length > 0) {
		
											for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
				
												$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
				
												$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').off().on('click',function(event) {
								
													if ($j(this).is(":checked"))
													{
				
														pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
								
														pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
													
														$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
								
																						
													}
													else 
													{
		
														pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
		
													}
		
												});                             
				
											}
				
										}     															
		
									$j('.pnfpb-popup-customprompt-vertical-transistion-allow-button').off().on( "click", async (event) => {

		
										var pnfpb_bell_icon_subscription_options = '';

										if (pnfpb_show_push_notify_types.length > 0) {
	
											for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < pnfpb_show_push_notify_types.length; pnfpb_notify_type_element++) {
				
												pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element];
												
											}
				
										}
				
										if (pnfpb_custom_post_types.length > 0) {
				
											for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
				
												pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element];
												
											}
				
										}
										
										$j('.pnfpb-popup-customprompt-vertical-container').hide();

										pnfpb_bell_prompt_processing = '1';

										await requestPermission(registration,'',pnfpb_bell_icon_subscription_options);	
		
									});						
			
									$j('.pnfpb-popup-customprompt-vertical-transistion-cancel-button').off().on( "click", async (event) => {

										$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("animation-name", "slideDownOut");
							
										$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");

										$j('.pnfpb-popup-customprompt-vertical-container').hide();
			
									})
		
								}
		
							}							

						} else {

							var pnfpb_bell_icon_subscription_options = '';

							$j('.pnfpb_bell_icon_prompt_subscription_all_enable').off().on('click',function(event) {

			
								if ($j('.pnfpb_bell_icon_prompt_subscription_all_enable').is(":checked"))
								{
		
		
									pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '1';
		
									if (pnfpb_show_push_notify_types.length > 0) {
		
										for (var pnfpb_notify_type_element = 1; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {
		
											pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_notify_type_element] = '0';
		
										}
		
									}
								
									$j('.pnfpb_bell_icon_prompt_subscription_post_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_prompt_subscription_activity_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_prompt_subscription_all_comments_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_prompt_subscription_my_comments_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_prompt_subscription_private_message_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_prompt_subscription_new_member_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_prompt_subscription_friendship_request_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_prompt_subscription_friendship_accepted_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_prompt_subscription_avatar_change_enable').prop('checked',false);
									
									$j('.pnfpb_bell_icon_prompt_subscription_cover_image_change_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable').prop('checked',false);
		
									if (pnfpb_custom_post_types.length > 0) {
		
										for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
		
											$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
		
											var pnfpb_index = $j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').attr("pnfpb_index");
		
											pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
											
										}
									}
			
			
								}
								else 
								{
		
		
									pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
								}								
							});
							
							
							$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable').off().on('click',function(event) {
			
					
								if ($j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable').is(":checked"))
								{
		
								
									$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);
									pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '1';
			
																	
								}
								else 
								{
									pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '0';
								}								
							});
							
							$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable').off().on('click',function(event) {
			
					
								if ($j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable').is(":checked"))
								{
		
								
									$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);
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
		
										$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_notify_type_element]+'_enable').off().on('click',function(event) {
		
											var pnfpb_selector = '.'+$(this).attr("class");
		
											var pnfpb_index = $(this).attr("pnfpb_index");
		
											if ($j(pnfpb_selector).is(":checked"))
											{
		
												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_index] = '1';
		
											
												if (pnfpb_notify_type_element > 0) {
					
													pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
										
													$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);
		
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
		
									$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').off().on('click',function(event) {
			
										var pnfpb_selector = '.'+$(this).attr("class");
		
										var pnfpb_index = $(this).attr("pnfpb_index");
		
										if ($j(pnfpb_selector).is(":checked"))
										{
		
											pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
		
											pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
										
											$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);
					
							
										}
										else 
										{
											
											pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '0';
		
		
										}
		
		
									});								
		
								}
		
							}					
		

							if (pnfpb_show_push_notify_types.length > 0) {

								for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < pnfpb_show_push_notify_types.length; pnfpb_notify_type_element++) {
	
									pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_notify_type_element];
									
								}
	
							}
	
							if (pnfpb_custom_post_types.length > 0) {
	
								for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
	
									pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element];
									
								}
	
							}							
							
							pnfpb_bell_prompt_processing = '1';

							await requestPermission(registration,'',pnfpb_bell_icon_subscription_options);

						}
				

					}
			
				})							
	
			})
	
		});
	
		} 
	
	}
			

async function shortcode_subscription_menu(refreshedToken) {
    if( $j(".pnfpb_subscribe_button").length )
    {
	  if ("serviceWorker" in navigator && refreshedToken && refreshedToken != '') {
		navigator.serviceWorker.ready.then(function (registration) {	
	        // [START get_messaging_object]
            // Retrieve Firebase Messaging object.
            // [END get_messaging_object]
            // [START set_public_vapid_key]
            // Add the public key generated from the console here.
            // [END set_public_vapid_key]

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
			var unsubscribeallshortcode = '0';
			
		    $j(".pnfpb_subscribe_button").on( "click", async function(event) {

				event.preventDefault();

				getToken(messaging,{serviceWorkerRegistration:registration,vapidKey:vapidKey }).then(async function (refreshedToken) {

					if (refreshedToken) {												

						shortcode_subscription_options(refreshedToken);

					}
					else
					{
						console.log(__("Notification from permission not granted or blocked!!!",'PNFPB_TD'));
	 
						if (!pnfpb_webview) {
							shortcode_subscription_options('');
							await requestPermission(registration,'shortcode','10000000000000');

						}
							
					}						
				}).catch( async (err)  => {
					console.log(__('Unable to retrieve refreshed token ','PNFPB_TD'), err);
					if (!pnfpb_webview) {
						navigator.serviceWorker.ready.then(function (registration) {
							$j(".pnfpb_subscribe_button").on( "click", async function(event) {
								event.preventDefault();
								shortcode_subscription_options('');
								getToken(messaging,{serviceWorkerRegistration:registration,vapidKey:vapidKey }).then(async function (refreshedToken) {
									if (refreshedToken) {

										$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',true);
										shortcode_subscription_options(refreshedToken);
			
									}
									else
									{							
										shortcode_subscription_options('');
										await requestPermission(registration,'shortcode','10000000000000');
									}
								})
							})
						})
					}
				});
		        
			})
		}) 
	  } else  {
		if ("serviceWorker" in navigator) {
				if (!pnfpb_webview) {
					navigator.serviceWorker.ready.then(function (registration) {
							$j(".pnfpb_subscribe_button").on( "click", async function(event) {
							event.preventDefault();
							shortcode_subscription_options('');
							getToken(messaging,{serviceWorkerRegistration:registration,vapidKey:vapidKey }).then(async function (refreshedToken) {
								if (refreshedToken) {

									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',true);
									shortcode_subscription_options(refreshedToken);
		
								}
								else
								{									
									shortcode_subscription_options('');
									await requestPermission(registration,'shortcode','10000000000000');
								}
							})
						})
					});
				}

		}
		else {
			console.log('Service worker not present');
		}
		console.log(__("Notification from permission not granted or blocked!!!",'PNFPB_TD'));
	  }
	} 
}

function shortcode_subscription_options(refreshedToken) {
	if (!refreshedToken || refreshedToken === '') {

		if ($j(".ui-dialog").is(":visible") && $j( "#pnfpb_subscribe_dialog_confirm" ).dialog('isOpen') === true) {

			$j( "#pnfpb_subscribe_dialog_confirm" ).dialog( "close" );
			
		}		

		$j(".pnfpb-subscribe-notifications").show();
		$j(".pnfpb_subscribe_dialog_confirm_heading_notoken").show();
		$j(".pnfpb_subscribe_dialog_confirm_heading_token").hide();	
		
		$j( "#pnfpb_subscribe_dialog_confirm" ).dialog({
			autoOpen: true, 
			resizable: true,
			width: 300,
			position: { my: 'top', at: 'top+40' },
			closeText : '',
			open: function(event, ui) {
				$j(this).css("height", "400px");
			},									
			modal: true,
			 create: function(event, ui) {
				  $j("body").css({ overflow: 'hidden' })
			 },
			 beforeClose: function(event, ui) {
				  $j("body").css({ overflow: 'inherit' })
			 },									
			buttons: [
			{ 	
				text: pnfpb_cancel_button_text,
				   open: function() {
					$j(this).attr('style','font-weight:normal;color:#000000;background-color:#dddddd;border:0px');
				},
				click: function() {
					$j(this).dialog( "close" );
			}}]
		});		

	} else  {

		if ($j(".ui-dialog").is(":visible") && $j( "#pnfpb_subscribe_dialog_confirm" ).dialog('isOpen') === true) {

			$j( "#pnfpb_subscribe_dialog_confirm" ).dialog( "close" );

		}

		var subscriptionoptions = '10000000000';
		var subscribeallshortcode = '0';
		var subscribepostactivitiesshortcode = '0';
		var subscribeactivitiesshortcode = '0';
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

		$j(".pnfpb-subscribe-notifications").show();
							
		if ($j('#pnfpb_ic_subscribe_all_shortcode_enable').is(":checked"))
		{
		  	subscribeallshortcode = '1';
		}
		else 
		{
			subscribeallshortcode = '0';
		}
	
		if ($j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').is(":checked"))
		{
		  	subscribepostactivitiesshortcode = '1';
		}
		else 
		{
			subscribepostactivitiesshortcode = '0';
		}

		if ($j('#pnfpb_ic_subscribe_activities_shortcode_enable').is(":checked"))
		{
		  	subscribeactivitiesshortcode = '1';
		}
		else 
		{
			subscribeactivitiesshortcode = '0';
		}		
	
		if ($j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').is(":checked"))
		{
		  	subscribeallcommentsshortcode = '1';
		}
		else 
		{
			subscribeallcommentsshortcode = '0';
		}
	
		if ($j('#pnfpb_ic_subscribe_private_message_shortcode_enable').is(":checked"))
		{
			subscribeprivatemessagesshortcode = '1';
			subscribeallshortcode = '0'; 
			unsubscribeallshortcode = '0';
			
			$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
			$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
			
		}
		else 
		{
			subscribeprivatemessagesshortcode = '0';
		}
	
		if ($j('#pnfpb_ic_subscribe_new_member_shortcode_enable').is(":checked"))
		{
			subscribenewmembershortcode = '1';
			subscribeallshortcode = '0'; 
			unsubscribeallshortcode = '0';
			
			$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
			$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
			
		}
		else 
		{

			subscribenewmembershortcode = '0';
		}
	
		if ($j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').is(":checked"))
		{
			subscribefriendshiprequestshortcode = '1';
			subscribeallshortcode = '0'; 
			unsubscribeallshortcode = '0';
			
			$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
			$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
			
		}
		else 
		{
			subscribefriendshiprequestshortcode = '0';
		}
	
		if ($j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').is(":checked"))
		{
			subscribefriendshipacceptshortcode = '1';
			subscribeallshortcode = '0'; 
			unsubscribeallshortcode = '0';
			
			$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
			$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
			
		}
		else 
		{
			subscribefriendshipacceptshortcode = '0';
		}
	
		if ($j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').is(":checked"))
		{
			subscribeuseravatarshortcode = '1';
			subscribeallshortcode = '0'; 
			unsubscribeallshortcode = '0';
			
			$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
			$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
			
		}
		else 
		{
			subscribeuseravatarshortcode = '0';
		}
	
		if ($j('#pnfpb_ic_subscribe_cover_image_shortcode_enable').is(":checked"))
		{
			subscribecoverimageshortcode = '1';
			subscribeallshortcode = '0'; 
			unsubscribeallshortcode = '0';
			
			$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
			$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
			
		}
		else 
		{
			subscribecoverimageshortcode = '0';
		}
		
		if ($j('#pnfpb_ic_subscribe_group_details_update_shortcode_enable').is(":checked"))
		{
			subscribegroupdetailsshortcode = '1';
			subscribeallshortcode = '0'; 
			unsubscribeallshortcode = '0';

		
			$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
			$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
		}
		else 
		{
			subscribegroupdetailsshortcode = '0';
		}		
	
		if ($j('#pnfpb_ic_subscribe_group_invite_shortcode_enable').is(":checked"))
		{
			subscribegroupinviteshortcode = '1';
			subscribeallshortcode = '0'; 
			unsubscribeallshortcode = '0';

			$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
			$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
		}
		else 
		{
			subscribegroupinviteshortcode = '0';
		}		
	
	
		if ($j('#pnfpb_ic_subscribe_my_post_shortcode_enable').is(":checked") && pnfpb_ajax_object_push.isloggedin === 1)
		{
			$j('.pnfpb_ic_subscribe_my_post_shortcode_label_checkbox').html(__("Subscribe notifications on comments from my Posts/my BuddyPress activities",'PNFPB_TD'));
			$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('disabled',false);								
		  	subscribemypostshortcode = '1';
		}
		else 
		{
			subscribemypostshortcode = '0';
			if (pnfpb_ajax_object_push.isloggedin != 1) {
				$j('.pnfpb_ic_subscribe_my_post_shortcode_label_checkbox').html(__("Login required to subscribe notifications on comments from my Posts/my BuddyPress activities",'PNFPB_TD'));
				$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('disabled',true);
			}
			else 
			{
				$j('.pnfpb_ic_subscribe_my_post_shortcode_label_checkbox').html(__("Subscribe notifications on comments from my Posts/my BuddyPress activities",'PNFPB_TD'));
				$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('disabled',false);										
			}
		}
	
		if ($j('#pnfpb_ic_unsubscribe_all_shortcode_enable').is(":checked"))
		{
		  	unsubscribeallshortcode = '1';
		}
		else 
		{
			unsubscribeallshortcode = '0';
		}
	
		if ($j("#pnfpb_ic_subscribe_private_message_shortcode_enable").on('click',function() {
		
			if ($j('#pnfpb_ic_subscribe_private_message_shortcode_enable').is(":checked"))
			{
			  	subscribeprivatemessagesshortcode = '1';
				subscribeallshortcode = '0'; 
				unsubscribeallshortcode = '0';
			
				$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
				$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
			
			}
			else 
			{
				subscribeprivatemessagesshortcode = '0';
			}								
		}));
	

	
		if ($j('#pnfpb_ic_subscribe_all_shortcode_enable').on('click',function() {
		
			if ($j('#pnfpb_ic_subscribe_all_shortcode_enable').is(":checked"))
			{
				subscribeallshortcode = '1';
				subscribemypostshortcode = '0';
				subscribeallcommentsshortcode = '0';
				subscribepostactivitiesshortcode = '0';
				subscribeactivitiesshortcode = '0';
				subscribeprivatemessagesshortcode = '0';
				subscribenewmembershortcode = '0';
				subscribefriendshiprequestshortcode = '0';
				subscribefriendshipacceptshortcode = '0';
				subscribeuseravatarshortcode = '0';
				subscribecoverimageshortcode = '0';
			
				unsubscribeallshortcode = '0';	
			
				$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_activities_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_group_details_update_shortcode_enable').prop('checked', false);
				$j('#pnfpb_ic_subscribe_group_invite_shortcode_enable').prop('checked', false);	
			
			}
			else 
			{
				subscribeallshortcode = '0';
			}								
		}));

		if (pnfpb_custom_post_types.length > 0) {

			for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {

				if ($j(this).is(":checked"))
				{

					pnfpb_shortcode_settings_custom_post_types[pnfpb_post_type_element] = '1';
					subscribeallshortcode = '0'; 
					unsubscribeallshortcode = '0';
														
				}
				else 
				{
					pnfpb_shortcode_settings_custom_post_types[pnfpb_post_type_element] = '0';
				}
				
				if ($j('#pnfpb_ic_subscribe'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_shortcode_enable').on('click',function() {
		
					if ($j(this).is(":checked"))
					{
						pnfpb_shortcode_settings_custom_post_types[pnfpb_post_type_element] = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';	
					
						$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
						$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);									
					}
					else 
					{
						pnfpb_shortcode_settings_custom_post_types[pnfpb_post_type_element] = '0';
					}								
				}));				

			}

		}		
		
		if ($j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').on('click',function() {
		
			if ($j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').is(":checked"))
			{
			  	subscribepostactivitiesshortcode = '1';
				subscribeallshortcode = '0'; 
				unsubscribeallshortcode = '0';	
			
				$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
				$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);									
			}
			else 
			{
				subscribepostactivitiesshortcode = '0';
			}								
		}));

		if ($j('#pnfpb_ic_subscribe_activities_shortcode_enable').on('click',function() {
		
			if ($j('#pnfpb_ic_subscribe_activities_shortcode_enable').is(":checked"))
			{
			  	subscribeactivitiesshortcode = '1';
				subscribeallshortcode = '0'; 
				unsubscribeallshortcode = '0';	
			
				$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
				$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);									
			}
			else 
			{
				subscribeactivitiesshortcode = '0';
			}								
		}));		
	
	
		if ($j('#pnfpb_ic_subscribe_new_member_shortcode_enable').on('click',function() {

			if ($j('#pnfpb_ic_subscribe_new_member_shortcode_enable').is(":checked"))
			{
			  	subscribenewmembershortcode = '1';
				subscribeallshortcode = '0'; 
				unsubscribeallshortcode = '0';
			
				$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
				$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
			
			}
			else 
			{

				subscribenewmembershortcode = '0';
			}								
		}));	
	
		if ($j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').on('click',function() {
		
			if ($j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').is(":checked"))
			{
			  	subscribefriendshiprequestshortcode = '1';
				subscribeallshortcode = '0'; 
				unsubscribeallshortcode = '0';
			
				$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
				$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
			
			}
			else 
			{
				subscribefriendshiprequestshortcode = '0';
			}								
		}));
	
		if ($j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').on('click',function() {
		
			if ($j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').is(":checked"))
			{
			  	subscribefriendshipacceptshortcode = '1';
				subscribeallshortcode = '0'; 
				unsubscribeallshortcode = '0';
			
				$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
				$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
			
			}
			else 
			{
				subscribefriendshipacceptshortcode = '0';
			}								
		}));
	
		if ($j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').on('click',function() {
		
			if ($j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').is(":checked"))
			{
			  	subscribeuseravatarshortcode = '1';
				subscribeallshortcode = '0'; 
				unsubscribeallshortcode = '0';
			
				$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
				$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
			
			}
			else 
			{
				subscribeuseravatarshortcode = '0';
			}								
		}));
	
		if ($j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').on('click',function() {
		
			if ($j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').is(":checked"))
			{
			 	subscribecoverimageshortcode = '1';
				subscribeallshortcode = '0'; 
				unsubscribeallshortcode = '0';
			
				$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
				$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
			
			}
			else 
			{
				subscribecoverimageshortcode = '0';
			}								
		}));							
	
	
		if ($j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').on('click',function() {
		
			if ($j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').is(":checked"))
			{
			  	subscribeallcommentsshortcode = '1';
				subscribemypostshortcode = '0';
				subscribeallshortcode = '0'; 
				unsubscribeallshortcode = '0';
			
			
				$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
				$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
			
			}
			else 
			{
				subscribeallcommentsshortcode = '0';
			}								
		}));
	
		if ($j('#pnfpb_ic_subscribe_my_post_shortcode_enable').on('click',function() {
		
			if ($j('#pnfpb_ic_subscribe_my_post_shortcode_enable').is(":checked"))
			{
			  	subscribemypostshortcode = '1';
				subscribeallcommentsshortcode = '0';
				subscribeallshortcode = '0'; 
				unsubscribeallshortcode = '0';

			
				$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
				$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
			}
			else 
			{
				subscribemypostshortcode = '0';
			}								
		}));

		if ($j('#pnfpb_ic_subscribe_group_details_update_shortcode_enable').on('click',function() {
		
			if ($j('#pnfpb_ic_subscribe_group_details_update_shortcode_enable').is(":checked"))
			{
				subscribegroupdetailsshortcode = '1';
				subscribeallshortcode = '0'; 
				unsubscribeallshortcode = '0';

			
				$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
				$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
			}
			else 
			{
				subscribegroupdetailsshortcode = '0';
			}								
		}));
		
		if ($j('#pnfpb_ic_subscribe_group_invite_shortcode_enable').on('click',function() {
		
			if ($j('#pnfpb_ic_subscribe_group_invite_shortcode_enable').is(":checked"))
			{
				subscribegroupinviteshortcode = '1';
				subscribeallshortcode = '0'; 
				unsubscribeallshortcode = '0';

				$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
				$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
			}
			else 
			{
				subscribegroupinviteshortcode = '0';
			}								
		}));		
	
		if ($j('#pnfpb_ic_unsubscribe_all_shortcode_enable').on('click',function() {
		
			if ($j('#pnfpb_ic_unsubscribe_all_shortcode_enable').is(":checked"))
			{
			  	unsubscribeallshortcode = '1';
				subscribemypostshortcode = '0';
				subscribeallcommentsshortcode = '0';
				subscribeprivatemessagesshortcode = '0';
				subscribenewmembershortcode = '0';
				subscribefriendshiprequestshortcode = '0';
				subscribefriendshipacceptshortcode = '0';
				subscribeuseravatarshortcode = '0';
				subscribecoverimageshortcode = '0';
				subscribepostactivitiesshortcode = '0';
				subscribeactivitiesshortcode = '0'; 
				subscribeallshortcode = '0';
				subscribegroupinviteshortcode = '0';
				subscribegroupdetailsshortcode = '0';

			
				$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_activities_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').prop('checked',false);
				$j('#pnfpb_ic_subscribe_group_details_update_shortcode_enable').prop('checked', false);
				$j('#pnfpb_ic_subscribe_group_invite_shortcode_enable').prop('checked', false);													
			}
			else 
			{
				unsubscribeallshortcode = '0';
			}								
		}));
		

		
			
	
	
		var pnfpb_subscribe_button_text = pnfpb_ajax_object_push.save_button_text;
		var pnfpb_cancel_button_text = pnfpb_ajax_object_push.cancel_button_text;
		var pnfpb_subscribe_text_confirm = pnfpb_ajax_object_push.subscribe_dialog_text_confirm;
		var pnfpb_unsubscribe_text_confirm = pnfpb_ajax_object_push.unsubscribe_dialog_text_confirm;

		$j(".pnfpb_subscribe_dialog_confirm_heading_notoken").hide();
		$j(".pnfpb_subscribe_dialog_confirm_heading_token").show();	
		
	
		$j( "#pnfpb_subscribe_dialog_confirm" ).dialog({
			autoOpen: true, 
			resizable: true,
			width: 300,
			position: { my: 'top', at: 'top+40' },
			closeText : '',
			open: function(event, ui) {
				$j(this).css("height", "400px");
			},									
			modal: true,
			 create: function(event, ui) {
				  $j("body").css({ overflow: 'hidden' })
			 },
			 beforeClose: function(event, ui) {
				  $j("body").css({ overflow: 'inherit' })
			 },									
			buttons: [
			{ 	
				text: pnfpb_cancel_button_text,
				   open: function() {
					$j(this).attr('style','font-weight:normal;color:#000000;background-color:#dddddd;border:0px');
				},
				click: function() {
					 $j(this).dialog( "close" );
			}},
			{
				text: pnfpb_subscribe_button_text,
				   open: function() {
					$j(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_push.subscribe_button_text_color+';background-color:'+pnfpb_ajax_object_push.subscribe_button_color+';border:0px');
				},
				click: function() {

					$j(".pnfpb-unsubscribe-alert-msg").html('<div class="pnfpbloader"></div>');

					$j( "#pnfpb-unsubscribe-dialog" ).dialog({ closeText:'', buttons: []});

					subscriptionoptions = subscribeallshortcode + subscribepostactivitiesshortcode + subscribeallcommentsshortcode + subscribemypostshortcode + subscribeprivatemessagesshortcode + subscribenewmembershortcode + subscribefriendshiprequestshortcode + subscribefriendshipacceptshortcode + unsubscribeallshortcode + subscribeuseravatarshortcode + subscribecoverimageshortcode + subscribeactivitiesshortcode + subscribegroupinviteshortcode + subscribegroupdetailsshortcode;
					
					if (pnfpb_custom_post_types.length > 0) {

						for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
			
							subscriptionoptions  = subscriptionoptions + pnfpb_shortcode_settings_custom_post_types[pnfpb_post_type_element];
							
						}
			
					}

					if (refreshedToken) {
	   
						deviceid = refreshedToken;
	
						var data = {
							action: 'icpushcallback',
							device_id:deviceid,
							subscriptionoptions:subscriptionoptions,
							pushtype: 'subscribe-button'
						};
		
						$j.post(pnfpb_ajax_object_push.ajax_url, data, function(responseajax) {
							
								var response = JSON.parse(responseajax);
							
								subscriptionoptions = response.subscriptionoptions;
								
								var subscriptionoptionsarray = [];
							
								if (subscriptionoptions) {

									subscriptionoptionsarray = subscriptionoptions.split('');
								}
								
								if (subscriptionoptionsarray.length >= 14)
								{

									if (subscriptionoptionsarray[0] === '1')
									{
										$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked', true);
										$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', false);
										$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked',false);
										$j('#pnfpb_ic_subscribe_activities_shortcode_enable').prop('checked',false);
										$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
										$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);
										$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', false);
										$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', false);
										$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', false);
										$j('#pnfpb_ic_subscribe_friendship_accept_shortcode_enable').prop('checked', false);
										$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', false);
										$j('#pnfpb_ic_subscribe_cover_image_shortcode_enable').prop('checked', false);
										$j('#pnfpb_ic_subscribe_group_details_update_shortcode_enable').prop('checked', false);
										$j('#pnfpb_ic_subscribe_group_invite_shortcode_enable').prop('checked', false);

									}
									else 
									{
										$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked', false);
									}
	
									if (subscriptionoptionsarray[1] === '1'  && subscriptionoptionsarray[10] !== '1' && subscriptionoptionsarray[8] !== '1')
									{
										$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked', true);
										$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
										$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
									}
									else 
									{
										$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked', false);
									}

									if (subscriptionoptionsarray[11] === '1'  && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
									{
										$j('#pnfpb_ic_subscribe_activities_shortcode_enable').prop('checked', true);
										$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
										$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
									}
									else 
									{
										$j('#pnfpb_ic_subscribe_activities_shortcode_enable').prop('checked', false);
									}									
	
									if (subscriptionoptionsarray[2] === '1'  && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
									{
										$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked', true);
										$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
										$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
									}
									else 
									{
										$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked', false);
									}
	
									if (subscriptionoptionsarray[3] === '1'  && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
									{
										  $j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked', true);
										$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
										$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
									}
									else 
									{
										$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked', false);
									}
									
									if (subscriptionoptionsarray[4] === '1'  && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
									{
										$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', true);
										$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
										$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
									}
									else 
									{
										$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', false);
									}
									
									if (subscriptionoptionsarray[5] === '1'  && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
									{
										$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', true);
										$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
										$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
									}
									else 
									{
										$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', false);
									}
									
									if (subscriptionoptionsarray[6] === '1'  && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
									{
										$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', true);
										$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
										$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
									}
									else 
									{
										$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', false);
									}
									
									if (subscriptionoptionsarray[7] === '1'  && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[10] !== '1')
									{
										$j('#pnfpb_ic_subscribe_friendship_accept_shortcode_enable').prop('checked', true);
										$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
										$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
									}
									else 
									{
										$j('#pnfpb_ic_subscribe_friendship_accept_shortcode_enable').prop('checked', false);
									}
									
									if (subscriptionoptionsarray[8] === '1'  && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
									{
										$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', true);
										$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
										$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
									}
									else 
									{
										$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', false);
									}
									
									if (subscriptionoptionsarray[9] === '1'  && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
									{
										$j('#pnfpb_ic_subscribe_cover_image_shortcode_enable').prop('checked', true);
										$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
										$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
									}
									else 
									{
										$j('#pnfpb_ic_subscribe_cover_image_shortcode_enable').prop('checked', false);
									}															

									if (subscriptionoptionsarray[10] === '1'  && subscriptionoptionsarray[0] !== '1')
									{
										$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', true);
										$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);
										$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked',false);
										$j('#pnfpb_ic_subscribe_activities_shortcode_enable').prop('checked',false);
										$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
										$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);
										$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', false);
										$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', false);
										$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', false);
										$j('#pnfpb_ic_subscribe_friendship_accept_shortcode_enable').prop('checked', false);
										$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', false);
										$j('#pnfpb_ic_subscribe_cover_image_shortcode_enable').prop('checked', false);
										$j('#pnfpb_ic_subscribe_group_details_update_shortcode_enable').prop('checked', false);
										$j('#pnfpb_ic_subscribe_group_invite_shortcode_enable').prop('checked', false);

									}
									else 
									{
										$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', false);
									}

									if (subscriptionoptionsarray[12] && subscriptionoptionsarray[12] === '1'  && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
									{
										$j('#pnfpb_ic_subscribe_group_details_update_shortcode_enable').prop('checked', true);
										$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
										$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);							
				
									}
									else 
									{
										$j('#pnfpb_ic_subscribe_group_details_update_shortcode_enable').prop('checked', false);
									}
											
									if (subscriptionoptionsarray[13] && subscriptionoptionsarray[13] === '1')
									{
										$j('#pnfpb_ic_subscribe_group_invite_shortcode_enable').prop('checked', true);
										$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
										$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);							
				
									}
									else 
									{
										$j('#pnfpb_ic_subscribe_group_invite_shortcode_enable').prop('checked', false);
									}
									
									if (subscriptionoptionsarray.length > 14) {

										var subscription_options_element = 14;

										for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {

											if (subscriptionoptionsarray[subscription_options_element] === '1' && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
											{
												$j('#pnfpb_ic_subscribe_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_shortcode_enable').prop('checked', true);

												$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
												$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);		
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_shortcode_enable').prop('checked', false);

											}
										
											subscription_options_element++;

										}

									}
																		
								}
					
								if (response.subscriptionstatus != 'fail')
								{
									if (response.subscriptionstatus != 'duplicate'){
										
											navigator.serviceWorker.ready.then(function (registration) {

												registration.pushManager.getSubscription().then(function (subscription) {
													
													if (!subscription) 
													{				                                                        
												
														   registration.pushManager.subscribe({
															userVisibleOnly: true,
															applicationServerKey: urlBase64ToUint8Array(vapidKey)
														   }).then(function (subscription) {

													
															if ( response.subscriptionoptions !== '00000000000' && response.subscriptionoptions !== '00000000001' && response.subscriptionoptions !== '' && response.subscriptionoptions !== null) 
															{
																$j(".pnfpb-unsubscribe-alert-msg").html("<p>"+pnfpb_unsubscribe_text_confirm+"</p>");
	
																if( $j(".pnfpb_subscribe_button").length )
																{
																	   $j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.unsubscribe_button_text_shortcode);
																 }
															}
															else 
															{
																	$j(".pnfpb-unsubscribe-alert-msg").html("<p>"+pnfpb_subscribe_text_confirm+"</p>");
	
																	if( $j(".pnfpb_subscribe_button").length )
																	{
																		$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text_shortcode);
																	}																
															}			       			                                                
													   
												   
															$j( "#pnfpb-unsubscribe-dialog" ).dialog(
																{ 
																	closeText:'',
																	buttons: [
																		{ 	
																			text: pnfpb_ajax_object_push.shortcode_close_button_text,
																			   open: function() {
																				$j(this).attr('style','font-weight:normal;color:#000000;background-color:#dddddd;border:0px');
																			},
																			click: function() {
																				 $j(this).dialog( "close" );
																				 $(this).dialog('destroy');
																		}},
																	]																	
																}
															);
													   
														}).catch(function () {

													
															if( $j(".pnfpb_subscribe_button").length )
															{
																$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text_shortcode);
															}			       			                                                


															$j(".pnfpb-unsubscribe-alert-msg").html(__("cloud messaging push notification - device update failed",'PNFPB_TD'));
													
															$j( "#pnfpb-unsubscribe-dialog" ).dialog(
																{ 
																	closeText:'',
																	buttons: [
																		{ 	
																			text: pnfpb_ajax_object_push.shortcode_close_button_text,
																			   open: function() {
																				$j(this).attr('style','font-weight:normal;color:#000000;background-color:#dddddd;border:0px');
																			},
																			click: function() {
																				 $j(this).dialog( "close" );
																				 $(this).dialog('destroy');
																		}},
																	]																	
																}
															);

														});
														
													}
													else
													{
														
													
														if( $j(".pnfpb_subscribe_button").length )
														{
																$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.unsubscribe_button_text_shortcode);
														}			       			                                                
														if ( subscriptionoptions !== '00000000000' && subscriptionoptions !== '00000000001' && subscriptionoptions !== '' && subscriptionoptions !== null) 
														{
															$j(".pnfpb-unsubscribe-alert-msg").html("<p>"+pnfpb_subscribe_text_confirm+"</p>");

															if( $j(".pnfpb_subscribe_button").length )
															{
														   		$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.unsubscribe_button_text_shortcode);
															 }
														}
														else 
														{
																$j(".pnfpb-unsubscribe-alert-msg").html("<p>"+pnfpb_unsubscribe_text_confirm+"</p>");

																if( $j(".pnfpb_subscribe_button").length )
																{
																	$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text_shortcode);
																}																
														}
													   
														$j( "#pnfpb-unsubscribe-dialog" ).dialog(
															{ 
																closeText:'',
																buttons: [
																	{ 	
																		text: pnfpb_ajax_object_push.shortcode_close_button_text,
																		   open: function() {
																			$j(this).attr('style','font-weight:normal;color:#000000;background-color:#dddddd;border:0px');
																		},
																		click: function() {
																			 $j(this).dialog( "close" );
																			 $(this).dialog('destroy');
																	}},
																]																	
															}
														);
													}
													
												});
												
											});

										}
										else
										{

											if ( subscriptionoptions !== '00000000000' && subscriptionoptions !== '00000000001' && subscriptionoptions !== '' && subscriptionoptions !== null) 
											{

												if( $j(".pnfpb_subscribe_button").length )
												{
											  	 	$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.unsubscribe_button_text_shortcode);
												}
												
											}
											else 
											{

												if( $j(".pnfpb_subscribe_button").length )
												{
											  	 	$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text_shortcode);
												}												

											}


											console.log(__("Already subscribed...device id already exists...not updated",'PNFPB_TD'));
										}

								}
								else
								{

													
									if( $j(".pnfpb_subscribe_button").length )
									{
										$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text_shortcode);
									}
									
									$j(".pnfpb-unsubscribe-alert-msg").html("<p>Push notification subscription failed..try again!!</p>");
									
									$j( "#pnfpb-unsubscribe-dialog" ).dialog(
										{ 
											closeText:'',
											buttons: [
												{ 	
													text: pnfpb_ajax_object_push.shortcode_close_button_text,
													   open: function() {
														$j(this).attr('style','font-weight:normal;color:#000000;background-color:#dddddd;border:0px');
													},
													click: function() {
														 $j(this).dialog( "close" );
														 $(this).dialog('destroy');
												}},
											]																	
										}
									);

									console.log(__("device update failed",'PNFPB_TD'));
								}
	
						});
	
					} else {
						console.log(__('No refreshed token from Firebase','PNFPB_TD'));
					}									

				},
			}]
		});
		
		$j('#pnfpb_subscribe_dialog_confirm').on('dialogclose', function(event) {
			$j(".pnfpb-unsubscribe-alert-msg").html("");
			$j(".pnfpb-subscribe-alert-msg").html("");
		});
	}
}

async function frontend_subscription_menu(refreshedToken) {

    if( $j(".pnfpb_push_notification_frontend_settings_submit").length )
    {
		if (!pnfpb_webview && hasFirebaseMessagingSupport && 'serviceWorker' in navigator && Notification.permission === 'granted') {

			navigator.serviceWorker.ready.then(function (registration) {

				registration.pushManager.getSubscription().then(async function (subscription) {

					if (subscription) {
				
	        		// [START get_messaging_object]
            		// Retrieve Firebase Messaging object.
            		// [END get_messaging_object]
            		// [START set_public_vapid_key]
            		// Add the public key generated from the console here.
            		// [END set_public_vapid_key]

					var frontend_subscriptionoptions = '';

			
					pnfpb_front_end_settings = ['0','0','0','0','0','0','0','0','0','0','0','0','0','0'];

		
		    		$j(".pnfpb_push_notification_frontend_settings_submit").on( "click", function(event) {
				
						frontend_subscriptionoptions = '';

						pnfpb_front_end_settings = ['0','0','0','0','0','0','0','0','0','0','0','0','0','0'];
				
						event.preventDefault();
				
						$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
						$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('error');
						$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('info');
						$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Processing...','PNFPB_TD'));
						$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');										
		        

			
						if ($j('#pnfpb_ic_fcm_front_group_invite_enable').is(":checked"))
						{

							pnfpb_front_end_settings[13] = '1';
						}
						else 
						{

							pnfpb_front_end_settings[13] = '0';
						}
				
						if ($j('#pnfpb_ic_fcm_front_group_details_update_enable').is(":checked"))
						{

							pnfpb_front_end_settings[12] = '1';
						}
						else 
						{

							pnfpb_front_end_settings[12] = '0';
						}
						
						if (pnfpb_front_end_settings_push_notify_types.length > 0) {

							for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 12; pnfpb_notify_type_element++) {

								if (pnfpb_front_end_settings_push_notify_types[pnfpb_notify_type_element] !== 'unsubscribe-all' && pnfpb_front_end_settings_push_notify_types[pnfpb_notify_type_element] !== 'all') {
	
									if ($j('.pnfpb_ic_fcm_front_'+pnfpb_front_end_settings_push_notify_types[pnfpb_notify_type_element]+'_enable').is(":checked"))
									{
	
										pnfpb_front_end_settings[pnfpb_notify_type_element] = '1';
	
										if (pnfpb_notify_type_element > 0) {
				
											pnfpb_front_end_settings[0] = '0';

											pnfpb_front_end_settings[8] = '0';
	
										}
										else 
										{
	
											pnfpb_front_end_settings[pnfpb_notify_type_element] = '0';
	
										}

									}
								}
							}
	
						}
						
						if (pnfpb_custom_post_types.length > 0) {

							for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
	
								if ($j('.pnfpb_ic_fcm_front_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').is(":checked"))
								{
	
									pnfpb_custom_post_types[pnfpb_post_type_element] = '1';
				
									pnfpb_front_end_settings[0] = '0';

									pnfpb_front_end_settings[8] = '0';
																		
								}
								else 
								{
									pnfpb_custom_post_types[pnfpb_post_type_element] = '0';
								}								

							}
	
						}



						if (pnfpb_front_end_settings_push_notify_types.length > 0) {

							for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {

								frontend_subscriptionoptions = frontend_subscriptionoptions+pnfpb_front_end_settings[pnfpb_notify_type_element];
								
							}

						}

						if (pnfpb_custom_post_types.length > 0) {

							for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {

								frontend_subscriptionoptions  = frontend_subscriptionoptions + pnfpb_custom_post_types[pnfpb_post_type_element];
								
							}

						}						


				
                		if (hasFirebaseMessagingSupport && 'serviceWorker' in navigator && Notification.permission === 'granted') {
					
				  			navigator.serviceWorker.ready.then(function (registration) {
							
								if (refreshedToken) {
							 
									deviceid = refreshedToken;
							
									var data = {
										action: 'icpushcallback',
								   			device_id:deviceid,
											subscriptionoptions:frontend_subscriptionoptions,
											pushtype: 'subscribe-button'
									};
								
									$j.post(pnfpb_ajax_object_push.ajax_url, data, function(responseajax) {

										var response = JSON.parse(responseajax);
													
										frontend_subscriptionoptions = response.subscriptionoptions;

										var subscriptionoptionsarray = [];
													
										if (frontend_subscriptionoptions && frontend_subscriptionoptions !== '') {
											subscriptionoptionsarray = frontend_subscriptionoptions.split('');
										} else {
											frontend_subscriptionoptions = '1000000000000';
											subscriptionoptionsarray = frontend_subscriptionoptions.split('');
										}								

										if (subscriptionoptionsarray.length >= 10)
										{
											$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('error');
											$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('info');
											$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('success');
											$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');
											$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Your notification settings have been saved','PNFPB_TD'));
						
								
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
	
												if (subscriptionoptionsarray.length > 0) {
	
	
													for (var pnfpb_frontend_settings_element = 0; pnfpb_frontend_settings_element < 12; pnfpb_frontend_settings_element++) {
		
														if (pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element] !== 'unsubscribe-all' && pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element] !== 'all')  {
	

															if (subscriptionoptionsarray[pnfpb_frontend_settings_element] === '1'  || subscriptionoptionsarray[0] === '1')
															{
																
																$j('.pnfpb_ic_fcm_front_'+pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element]+'_enable').prop('checked', true);
	
																//pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_post_type_element] = '1';
															}
															else 
															{
																$j('.pnfpb_ic_fcm_front_'+pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element]+'_enable').prop('checked', false);
	
																//pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_post_type_element] = '0';
															}
														
														} 
	
													}
	
												}													
													
												if (subscriptionoptionsarray.length > 14) {
	
													var subscription_options_element = 14;
	
													for (var pnfpb_frontend_post_type_element = 0; pnfpb_frontend_post_type_element < pnfpb_custom_post_types.length; pnfpb_frontend_post_type_element++) {
		
														if (subscriptionoptionsarray[subscription_options_element] === '1'  || subscriptionoptionsarray[0] === '1')
														{
															$j('.pnfpb_ic_fcm_front_subscription_'+pnfpb_custom_post_types[pnfpb_frontend_post_type_element]+'_enable').prop('checked', true);
	
															//pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
														}
														else 
														{
															$j('.pnfpb_ic_fcm_front_subscription_'+pnfpb_custom_post_types[pnfpb_frontend_post_type_element]+'_enable').prop('checked', false);
	
															//pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
														}
															
														subscription_options_element++;
	
													}
	
											
	
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
								}
								else 
								{
									$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
									$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('error');
									$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('info');
									$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Processing...','PNFPB_TD'));
									$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');														
								}
				  			})
						}
						else 
						{
							$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
							$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('info');
							$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('error');
							$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Notification permission not granted by user. Error in saving notification settings','PNFPB_TD'));
							$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');	
						}
					})
				} else {
					$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
					$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('error');
					$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Please subscribe to push notification to use this menu','PNFPB_TD'));
					$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');			
				}
				})
    			.catch((err) => {
					console.error(`Error during getSubscription(): ${err}`);
				  $j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
				  $j('.pnfpb_ic_front_push_notification_settings_messages').addClass('error');
				  $j('.pnfpb_ic_front_push_notification_settings_text').html(__('Please subscribe to push notification to use this menu','PNFPB_TD'));
				  $j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');					
			  });					
			})
			.catch((err) => {
				console.error('Error during getSubscription(): ${err}');
			  	$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
			  	$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('error');
			  	$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Please subscribe to push notification to use this menu','PNFPB_TD'));
			  	$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');					
		  	});				
		} 
		else 
		{
			if (!pnfpb_webview) 
			{
				console.error('Error during getSubscription()');
				$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
				$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('error');
				$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Please subscribe to push notification to use this menu','PNFPB_TD'));
				$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');

			}
		}
	
	}

}

  
  // Send the Instance ID token your application server, so that it can:
  // - send messages back to this app
  // - subscribe/unsubscribe the token from topics
function sendTokenToServer(currentToken) {
    if (!isTokenSentToServer()) {
      console.log(__('Sending token to server...','PNFPB_TD'));
      // TODO(developer): Send the current token to your server.
      setTokenSentToServer(true);
	  return '';
    } else {
      console.log(__('Token already sent to server so won\'t send it again ' +
          'unless it changes','PNFPB_TD'));
	  return '';
    }

  }

function isTokenSentToServer() {
    return window.localStorage.getItem('sentToServer') === '1';
  }

function setTokenSentToServer(sent) {
    window.localStorage.setItem('sentToServer', sent ? '1' : '0');
  }
  
function urlBase64ToUint8Array(base64String) {
  const padding = '='.repeat((4 - base64String.length % 4) % 4);
  const base64 = (base64String + padding)
    .replace(/\-/g, '+')
    .replace(/_/g, '/')
  ;
  const rawData = window.atob(base64);
  return Uint8Array.from([...rawData].map((char) => char.charCodeAt(0)));
}
		


async function requestPermission(registration,shortcode_field='',subscription_options='10000000000000') {

	pnfpb_bell_prompt_processing = '1';

	if (!("Notification" in window)) {
		// Check if the browser supports notifications
		console.log("This browser does not support desktop notification");
	  } else if (Notification.permission === "granted") {
		// Check whether notification permissions have already been granted;
		// if so, create a notification
		console.log("Notification permission already granted");
		granted_permission_process(registration,"granted", shortcode_field,subscription_options,'already_granted')
	  } else if (Notification.permission !== "denied") {
		// We need to ask the user for permission
		console.log("Request for notification permission ");
		Notification.requestPermission().then((permission) => {
		  // If the user accepts, let's create a notification
		  if (permission === "granted") {
			granted_permission_process(registration,permission, shortcode_field,subscription_options,'newly_granted');
			// …
		  }
		});
	  } else if (Notification.permission === "denied") {

		var pnfpb_screenWidth, pnfpb_screenHeight, pnfpb_dialogWidth, pnfpb_dialogHeight, pnfpb_isDesktop;    
		pnfpb_screenWidth = window.screen.width;
		pnfpb_screenHeight = window.screen.height;    
	
		if (pnfpb_screenWidth < 500) {
			pnfpb_dialogWidth = pnfpb_screenWidth * .95;
			pnfpb_dialogHeight = pnfpb_screenHeight * .95;
		} else {
			pnfpb_dialogWidth = 500;
			pnfpb_dialogHeight = 500;
			pnfpb_isDesktop = true;
		}		
	
		$j("#pnfpb-push-notification-blocked" ).dialog({
			autoOpen: true,
			resizable: false,
			closeText : '',
			open: function(event, ui) {
			},			
			width: pnfpb_dialogWidth,
			maxWidth:600,
			closeOnEscape: false,
			draggable: false,
			modal: true,
			buttons: [
			{
				text: 'Ok',
				open: function() {
					$j(this).attr('style','font-weight:bold;color:white;background-color:blue;border:0px');
				},
				click: function() {			
					$j( this ).dialog( "close" );
				}
			}
			]
		})		

	  }

    // [END request_permission]
  }

 
  	async function granted_permission_process(registration,pnfpb_permission,shortcode_field,subscription_options,permission_granted_check) {


		var pnfpb_popup_subscribe_text = __("You are subscribed to push notification",'PNFPB_TD');

		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_message && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_message != '') {
	
			pnfpb_popup_subscribe_text = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_message;
	
		}
	
		var pnfpb_popup_unsubscribe_text = __("Push notification not subscribed",'PNFPB_TD');
	
		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_message && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_message != '') {
	
			pnfpb_popup_unsubscribe_text = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_message;
			
		}
	
		var pnfpb_popup_wait_message = __("Please wait...processing",'PNFPB_TD');
	
		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_wait_message && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_wait_message != '') {
	
			pnfpb_popup_wait_message = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_wait_message;
			
		}
	
		var pnfpb_ic_fcm_custom_prompt_subscribe_text = __("We would like to show you notifications for the latest news and updates",'PNFPB_TD');
	
		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribe_text && pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribe_text != '') {
	
			pnfpb_ic_fcm_custom_prompt_subscribe_text = pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribe_text;
			
		}
	
		var pnfpb_ic_fcm_custom_prompt_subscribed_text = __("You are subscribed to push notifications",'PNFPB_TD');
	
		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribed_text && pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribed_text != '') {
	
			pnfpb_ic_fcm_custom_prompt_subscribed_text = pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribed_text;
			
		}	
		
		var pnfpb_popup_subscribe_button = __("Subscribe",'PNFPB_TD');
	
		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_button && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_button != '') {
	
			pnfpb_popup_subscribe_button = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_button;
			
		}
	
		var pnfpb_popup_unsubscribe_button = __("Unsubscribe",'PNFPB_TD');
	
		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_button && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_button != '') {
	
			pnfpb_popup_unsubscribe_button = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_button;
			
		}			

		if (pnfpb_permission === 'granted') {


			if( $j(".pnfpb-push-subscribe-button").length && pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_on_off !== '1') {
	
				$j('.pnfpb_bell_icon_custom_prompt_loader').show();
	
				$j('.pnfpb_bell_icon_prompt_subscription_options_container').hide();
	
				$j('.pnfpb-push-status-text').text(pnfpb_popup_wait_message);
	
				$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");
				
			}
	
			if ( $j(".pnfpb-popup-customprompt-container").length && pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_on_off === '1' && pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1' ) {
	
				$j('.pnfpb-popup-customprompt-transistion-cancel-button').hide();
	
				$j('.pnfpb-popup-customprompt-transistion-allow-button').hide();

				if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_confirmation_message_on_off !== '1' && permission_granted_check === 'newly_granted') {

					$j('.pnfpb-popup-customprompt-container').show();

					$j('.pnfpb_custom_prompt_loader').show();

				}
	
			}
	
			if ( $j(".pnfpb-popup-customprompt-vertical-container").length && pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_on_off === '1' && pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2' ) {
	
				$j('.pnfpb-popup-customprompt-vertical-transistion-cancel-button').hide();
	
				$j('.pnfpb-popup-customprompt-vertical-transistion-allow-button').hide();

				if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_confirmation_message_on_off !== '1' && permission_granted_check === 'newly_granted') {

					$j('.pnfpb-popup-customprompt-vertical-container').show();

					$j('.pnfpb_custom_prompt_loader').show();

				}
	
			}
			
			  
			navigator.serviceWorker.ready.then((serviceWorkerRegistration) => {
	
				serviceWorkerRegistration.pushManager.subscribe({
											
						userVisibleOnly: true,
											
						applicationServerKey: urlBase64ToUint8Array(vapidKey)
											
				}).then(function (subscription) {
	
					if (subscription) {

						getToken(messaging,{serviceWorkerRegistration:serviceWorkerRegistration,vapidKey:vapidKey }).then((currentToken) => {
			   
							if (currentToken) {

								pnfpb_bell_prompt_processing = '';

								if ( $j(".pnfpb-popup-customprompt-container").length && pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_on_off === '1' && pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1' ) {
	
									$j('.pnfpb_custom_prompt_loader').hide();
									
									$j('.pnfpb-popup-customprompt-transistion').hide();
	
									$j('.pnfpb-popup-customprompt-transistion-cancel-button').show();	
	
									$j('.pnfpb-popup-customprompt-transistion-allow-button').show();										
	
									$j('.pnfpb-popup-customprompt-transistion-confirmation > .pnfpb-popup-customprompt-transistion-body > .pnfpb-popup-customprompt-transistion-body-message').text(pnfpb_ic_fcm_custom_prompt_subscribed_text);
	
									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_confirmation_message_on_off === '1' && permission_granted_check === 'already_granted') {
									
										$j('.pnfpb-popup-customprompt-container').hide();

									} else {

										$j('.pnfpb-popup-customprompt-transistion-confirmation').show();

										$j('.pnfpb-popup-customprompt-container').show();

									}
	
									$j('.pnfpb-popup-customprompt-transistion-close-button').off().on( "click", async (event) => {
	
										if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {
	
											if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
										
												$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("animation-name", "slideDownOut");
							
												$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
			
											}
			
											if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
							
												$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("animation-name", "slideDownOut");
							
												$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
												
											}
							
										}
							
										if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {
			
											if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
							
												$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("animation-name", "slideUpOut");
							
												$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
			
											}
			
											if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
							
												$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("animation-name", "slideUpOut");
							
												$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
												
											}
							
										}											
	
										$j('.pnfpb-popup-customprompt-container').hide();
				
									});

									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_confirmation_message_on_off === '1') {

										$j('.pnfpb-popup-customprompt-container').hide();
									}
									else {

										$j('.pnfpb-popup-customprompt-container').hide().show('slow').delay(4000).hide('slow');

										$j('.pnfpb-popup-customprompt-container').show();

									}	
									
								}
	
								if ( $j(".pnfpb-popup-customprompt-vertical-container").length && pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_on_off === '1' && pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2' ) {
	
									$j('.pnfpb_custom_prompt_loader').hide();
									
									$j('.pnfpb-popup-customprompt-vertical-transistion').hide();
	
									$j('.pnfpb-popup-customprompt-vertical-transistion-cancel-button').show();	
	
									$j('.pnfpb-popup-customprompt-vertical-transistion-allow-button').show();										
	
									$j('.pnfpb-popup-customprompt-vertical-transistion-confirmation > .pnfpb-popup-customprompt-transistion-body > .pnfpb-popup-customprompt-vertical-transistion-body-message').text(pnfpb_ic_fcm_custom_prompt_subscribed_text);

									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_confirmation_message_on_off === '1') {
	
										$j('.pnfpb-popup-customprompt-vertical-container').hide();

									} else {
										
										$j('.pnfpb-popup-customprompt-vertical-transistion-confirmation').show();

										$j('.pnfpb-popup-customprompt-vertical-container').show();

									}
	
									$j('.pnfpb-popup-customprompt-vertical-transistion-close-button').off().on( "click", async (event) => {
	
										if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {
	
											if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
										
												$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("animation-name", "slideDownOut");
							
												$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
			
											}
			
											if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
							
												$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("animation-name", "slideDownOut");
							
												$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
												
											}
							
										}
							
										if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {
			
											if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
							
												$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("animation-name", "slideUpOut");
							
												$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
			
											}
			
											if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
							
												$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("animation-name", "slideUpOut");
							
												$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
												
											}
							
										}											
	
										$j('.pnfpb-popup-customprompt-vertical-container').hide();
				
									});

									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_confirmation_message_on_off === '1') {

										$j('.pnfpb-popup-customprompt-vertical-container').hide();

									}
									else {

										$j('.pnfpb-popup-customprompt-vertical-container').hide().show('slow').delay(4000).hide('slow');

										$j('.pnfpb-popup-customprompt-vertical-container').show();

									}
	
									
								}						
	
	
								if( $j(".pnfpb-push-subscribe-button").length && (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style3 === '1' )) {
	
									$j('.pnfpb_bell_icon_custom_prompt_loader').hide();

									$j('.pnfpb-push-subscribe-button').show();
			
									$j('.pnfpb-push-subscribe-options-button').show();													
	
									$j('.pnfpb_bell_icon_prompt_subscription_options_container').show();

									$j('.pnfpb-push-subscribe-button').text(pnfpb_popup_unsubscribe_button);
	
									$j('.pnfpb-push-subscribe-button').removeClass("pnfpb-popup-subscribe-class");
			   
									$j('.pnfpb-push-subscribe-button').addClass("pnfpb-popup-unsubscribe-class");
	
									$j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");	
						   
									$j('.pnfpb-push-status-text').text(pnfpb_popup_subscribe_text);
						   
									$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");								
									
									$j("#ic-notification-button").hide();
								}								

	
							  	deviceid = currentToken;
			  
								var pnfpbshortcodeactive = 'no';
			  
								var isadminpage = 'no';
			  
								if (window.location.href.match('wp-admin') !== null) {
									isadminpage = 'yes';
								}
			
		
								var data = {
								action: 'icpushcallback',
								device_id:deviceid,
								isadminpage:isadminpage,
								subscriptionoptions:subscription_options,
								pnfpbshortcodeactive:pnfpbshortcodeactive,
								pnfpb_endpoint:subscription.endpoint,
								pnfpb_options:subscription.options.applicationServerKey,
								pushtype:'normal'
								};

								$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {

									pnfpb_bell_prompt_processing = '';
				
									var responseobject = JSON.parse(response);
					
								   	if (responseobject.subscriptionstatus != 'fail')
								   	{
										if (responseobject.subscriptionstatus != 'duplicate') {
											
											var subscriptionoptions = responseobject.subscriptionoptions;
							
											var subscriptionoptionsarray = subscriptionoptions.split('');
											
											if (subscriptionoptionsarray.length >= 4)
											{
							
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
			
														if (subscriptionoptionsarray.length > 0) {
			
															for (var pnfpb_frontend_settings_element = 0; pnfpb_frontend_settings_element < 12; pnfpb_frontend_settings_element++) {
				
																if (pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element] !== 'unsubscribe-all' && pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element] !== 'all')  {
			
																	if (subscriptionoptionsarray[pnfpb_frontend_settings_element] === '1'  || subscriptionoptionsarray[0] === '1')
																	{
																		
																		$j('.pnfpb_ic_fcm_front_'+pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element]+'_enable').prop('checked', true);
			
																		//pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_post_type_element] = '1';
																	}
																	else 
																	{
																		$j('.pnfpb_ic_fcm_front_'+pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element]+'_enable').prop('checked', false);
			
																		//pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_post_type_element] = '0';
																	}
																
																} 
			
															}
			
														}													
															
														if (subscriptionoptionsarray.length > 14) {
			
															var subscription_options_element = 14;
			
															for (var pnfpb_frontend_post_type_element = 0; pnfpb_frontend_post_type_element < pnfpb_custom_post_types.length; pnfpb_frontend_post_type_element++) {
				
																if (subscriptionoptionsarray[subscription_options_element] === '1'  || subscriptionoptionsarray[0] === '1')
																{
																	$j('.pnfpb_ic_fcm_front_subscription_'+pnfpb_custom_post_types[pnfpb_frontend_post_type_element]+'_enable').prop('checked', true);
			
																	//pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
																}
																else 
																{
																	$j('.pnfpb_ic_fcm_front_subscription_'+pnfpb_custom_post_types[pnfpb_frontend_post_type_element]+'_enable').prop('checked', false);
			
																	//pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
																}
																	
																subscription_options_element++;
			
															}
			
													
			
														}				

											}

											if( $j(".pnfpb_bell_icon_subscription_options_container").length) 
											{
	
												if (subscriptionoptionsarray[12] === '1')
													{
		
														$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked', true);
		
		
														pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '1';
		
													}
													else 
													{
														$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked', false);
		
		
														pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '0';
		
													}
													
													if (subscriptionoptionsarray[13] === '1')
													{
														$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked', true);
		
		
														pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '1';
		
													}
													else 
													{
														$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked', false);
		
		
														pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '0';
		
													}
													
													if (subscriptionoptionsarray.length > 0) {
		
														for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < 12; pnfpb_post_type_element++) {
		
															if (pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'unsubscribe-all' && pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'all') {		
																
	
																if (subscriptionoptionsarray[pnfpb_post_type_element] === '1' && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
																{
																	$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable').prop('checked', true);
		
																	pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_post_type_element] = '1';
		
														
																}
																else 
																{
																	$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable').prop('checked', false);
		
																	pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_post_type_element] = '0';
		
															
																}
															
															} else {
		
																if (pnfpb_show_push_notify_types[pnfpb_post_type_element] === 'all' && subscriptionoptionsarray[0] === '1' )
																{
		
																	$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[0]+'_enable').prop('checked', true);
		
																	pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';
		
																} else {
		
																	if (subscriptionoptionsarray[8] === '1') {
																	
																		pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';
		
																	}
																}
		
															}
		
			
														}
		
													}													
													
													if (subscriptionoptionsarray.length > 14) {
		
														var subscription_options_element = 14;
		
														for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
		
		
															if (subscriptionoptionsarray[subscription_options_element] === '1'  && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
															{
																$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked', true);
		
																pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
															}
															else 
															{
																$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked', false);
		
																pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
															}
															
															subscription_options_element++;
		
														}
		
	
													}
												
											}
												
											if( $j(".pnfpb_bell_icon_prompt_subscription_options_container").length) {
	

													if (subscriptionoptionsarray.length > 0) {

														for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_show_push_notify_types.length; pnfpb_post_type_element++) {
		
															if (subscriptionoptionsarray[pnfpb_post_type_element] === '1')
															{
																$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable').prop('checked', true);

																pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_post_type_element] = '1';
															}
															else 
															{
																$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable').prop('checked', false);

																pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_post_type_element] = '0';
															}
															

														}

													}													
													
													if (subscriptionoptionsarray.length > 14) {

														var subscription_options_element = 14;

														for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
		
															if (subscriptionoptionsarray[subscription_options_element] === '1' && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
															{
																$j('.pnfpb_bell_icon_promt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked', true);

																pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
															}
															else 
															{
																$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked', false);

																pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
															}
															
															subscription_options_element++;

														}

													}

											}												
								
											if( $j(".pnfpb_subscribe_button").length && shortcode_field === 'shortcode') {
	
													navigator.serviceWorker.ready.then((serviceWorkerRegistration) => {
	
														getToken(messaging,{serviceWorkerRegistration:serviceWorkerRegistration,vapidKey:vapidKey }).then(async function (refreshedToken) {
					
															if (refreshedToken) {												
																$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',true);
																shortcode_subscription_options(refreshedToken);
	
															}
														})
	
													})
	
											}
											   
																   
									}
								else
								{
									pnfpb_bell_prompt_processing = '';
	
									if( $j(".pnfpb_subscribe_button").length )
									{
										$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.unsubscribe_button_text_shortcode);
									}
									
									if( $j(".pnfpb-push-subscribe-button").length )
									{									
										$j('.pnfpb-push-subscribe-button').show();
						
										$j('.pnfpb-push-subscribe-options-button').show();

									}
						   
									console.log(__("Already subscribed...device id already exists...not updated",'PNFPB_TD'));
								}
	
						   }	
						   else
						   {

								pnfpb_bell_prompt_processing = '';

								if( $j(".pnfpb-push-subscribe-button").length )
								{									
									$j('.pnfpb-push-subscribe-button').show();
					
									$j('.pnfpb-push-subscribe-options-button').show();

								}
	
							   console.log(__("device update failed",'PNFPB_TD'));
						   }			
				});
	
	
			  } else {
					// Show permission request.
					console.log(__('No Instance ID token available. Request permission to generate one.','PNFPB_TD'));
					// Show permission UI.
					setTokenSentToServer(false);

					pnfpb_bell_prompt_processing = '';

					$j('.pnfpb-popup-customprompt-container').hide();

					$j('.pnfpb-popup-customprompt-vertical-container').hide();

					if( $j(".pnfpb-push-subscribe-button").length )
					{									
						$j('.pnfpb-push-subscribe-button').show();
		
						$j('.pnfpb-push-subscribe-options-button').show();

					}				
			  }
		
		
			}).catch((err) => {
			  		console.log(__('An error occurred while retrieving token. ','PNFPB_TD'), err);

				  	setTokenSentToServer(false);

					  pnfpb_bell_prompt_processing = '';

					  $j('.pnfpb-popup-customprompt-container').hide();

					  $j('.pnfpb-popup-customprompt-vertical-container').hide();

				 	if( $j(".pnfpb-push-subscribe-button").length )
					{									
						$j('.pnfpb-push-subscribe-button').show();
		
						$j('.pnfpb-push-subscribe-options-button').show();

					}				  
			});
	
			// TODO(developer): Retrieve an Instance ID token for use with FCM.
			// [START_EXCLUDE]
			// In many cases once an app has been granted notification permission,
			// it should update its UI reflecting this.
			// [END_EXCLUDE]
			} else {

				$j('.pnfpb-popup-customprompt-container').hide();

				$j('.pnfpb-popup-customprompt-vertical-container').hide();

				console.log(__('An error occurred while subscribing push notification in browser ','PNFPB_TD'));

				if( $j(".pnfpb-push-subscribe-button").length )
					{									
						$j('.pnfpb-push-subscribe-button').show();
		
						$j('.pnfpb-push-subscribe-options-button').show();

					}	
			}
	
			}).catch((err) => {

				console.log(__('An error occurred in getting subscription ','PNFPB_TD'), err);

				setTokenSentToServer(false);

				pnfpb_bell_prompt_processing = '';

				$j('.pnfpb-popup-customprompt-container').hide();

				$j('.pnfpb-popup-customprompt-vertical-container').hide();

			   if( $j(".pnfpb-push-subscribe-button").length )
			  {									
				  $j('.pnfpb-push-subscribe-button').show();
  
				  $j('.pnfpb-push-subscribe-options-button').show();

			  }				

			})

			}).catch((err) => {

				console.log(__('An error occurred in getting registration','PNFPB_TD'), err);

				setTokenSentToServer(false);

				pnfpb_bell_prompt_processing = '';

				$j('.pnfpb-popup-customprompt-container').hide();

				$j('.pnfpb-popup-customprompt-vertical-container').hide();

			   if( $j(".pnfpb-push-subscribe-button").length )
			  {									
				  $j('.pnfpb-push-subscribe-button').show();
  
				  $j('.pnfpb-push-subscribe-options-button').show();

			  }				

			})
		  } else {
				console.log(__('Unable to get permission to notify.','PNFPB_TD'));
				$j('.pnfpb-push-dialog-container').hide();
				const pnfpb_d = new Date();
				const pnfpb_custom_prompt_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_custom_prompt_show_again_days);
			  	pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_custom_prompt_show_again_days*24*60*60*58000));
			  	let expires = "expires="+ pnfpb_d.toUTCString();
			  	document.cookie = "PNFPB_push_notification_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
			  
			  	pnfpb_bell_prompt_processing = '';

				  $j('.pnfpb-popup-customprompt-container').hide();

				  $j('.pnfpb-popup-customprompt-vertical-container').hide();

				if( $j(".pnfpb-push-subscribe-button").length )
				{									
					$j('.pnfpb-push-subscribe-button').show();
	
					$j('.pnfpb-push-subscribe-options-button').show();

				}			  
		  }		
	
	}

 async function checkdeviceid(registration,subscription) {

		if (!pnfpb_webview && hasFirebaseMessagingSupport && 'serviceWorker' in navigator ) {

			registration.pushManager.getSubscription().then((subscription) => {

					var subscriptionoptions = '100000000000';
					var subscriptionoptionsarray = subscriptionoptions.split('');
					
					var pnfpbshortcodeactive = 'no';
					var isadminpage = 'no';
					if (window.location.href.match('wp-admin') !== null) {
						isadminpage = 'yes';
					}
        			if( $j(".pnfpb_subscribe_button").length || $j(".pnfpb_push_notification_frontend_settings_submit").length )
        			{
						pnfpbshortcodeactive = 'yes';
					}
					
					if( $j(".pnfpb-push-subscribe-button").length  ) {

						$j('.pnfpb_bell_icon_custom_prompt_loader').show();

						$j('.pnfpb_bell_icon_prompt_subscription_options_container').hide();

						$j('.pnfpb-push-subscribe-options-button').hide();

					}
					
					deviceid = '';

					if (hasFirebaseMessagingSupport && Notification.permission === 'granted') {

						
						getToken(messaging,{serviceWorkerRegistration:registration,vapidKey:vapidKey }).then((currentToken) => {

							// Subscribe the devices corresponding to the registration tokens to the
							// topic.

							
							if (currentToken) {

							   
								deviceid = currentToken;
  
								
								var data = {
									action: 'icpushcallback',
									device_id:deviceid,
									isadminpage:isadminpage,
									pnfpbshortcodeactive:pnfpbshortcodeactive,
									pnfpb_endpoint:subscription.endpoint,
									pnfpb_options:vapidKey,									
									pushtype: 'checkdeviceid'
					    		};
								
								$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
							
										var responseobject = JSON.parse(response);	

										subscriptionoptions = responseobject.subscriptionoptions;

										pnfpb_subscription_options = subscriptionoptions;
							
										subscriptionoptionsarray = subscriptionoptions.split('');

										if( $j(".pnfpb-push-subscribe-button").length  ) {

											$j('.pnfpb_bell_icon_custom_prompt_loader').hide();

											$j(".pnfpb-push-subscribe-button").show();

											$j('.pnfpb_bell_icon_prompt_subscription_options_container').show();

											$j('.pnfpb-push-subscribe-options-button').show();
					
										}
														
										if (subscriptionoptionsarray.length >= 4)
										{
						
										
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

											if (subscriptionoptionsarray.length > 0) {

												for (var pnfpb_frontend_settings_element = 0; pnfpb_frontend_settings_element < 12; pnfpb_frontend_settings_element++) {
	
													if (pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element] !== 'unsubscribe-all' && pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element] !== 'all')  {

														if (subscriptionoptionsarray[pnfpb_frontend_settings_element] === '1'  || subscriptionoptionsarray[0] === '1')
														{
															
															$j('.pnfpb_ic_fcm_front_'+pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element]+'_enable').prop('checked', true);

															//pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_post_type_element] = '1';
														}
														else 
														{
															$j('.pnfpb_ic_fcm_front_'+pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element]+'_enable').prop('checked', false);

															//pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_post_type_element] = '0';
														}
													
													} 

												}

											}													
												
											if (subscriptionoptionsarray.length > 14) {

												var subscription_options_element = 14;

												for (var pnfpb_frontend_post_type_element = 0; pnfpb_frontend_post_type_element < pnfpb_custom_post_types.length; pnfpb_frontend_post_type_element++) {
	
													if (subscriptionoptionsarray[subscription_options_element] === '1'  || subscriptionoptionsarray[0] === '1')
													{
														$j('.pnfpb_ic_fcm_front_subscription_'+pnfpb_custom_post_types[pnfpb_frontend_post_type_element]+'_enable').prop('checked', true);

														//pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
													}
													else 
													{
														$j('.pnfpb_ic_fcm_front_subscription_'+pnfpb_custom_post_types[pnfpb_frontend_post_type_element]+'_enable').prop('checked', false);

														//pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
													}
														
													subscription_options_element++;

												}

										

											}											

										}

										if( $j(".pnfpb_subscribe_button").length) {

											if (subscriptionoptionsarray[0] === '1' && subscriptionoptionsarray[8] !== '1')
											{
  												$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked', false);
											}
							
											if (subscriptionoptionsarray[1] === '1'  && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
											{
  												$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked', false);
											}

											if (subscriptionoptionsarray[11] === '1'  && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
											{
												$j('#pnfpb_ic_subscribe_activities_shortcode_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_activities_shortcode_enable').prop('checked', false);
											}											
							
											if (subscriptionoptionsarray[2] === '1' && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
											{
  												$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked', false);
											}
							
											if (subscriptionoptionsarray[3] === '1' && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
											{
  												$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked', false);
											}
							
											if (subscriptionoptionsarray[4] === '1' && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
											{
  												$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', false);
											}
							
											if (subscriptionoptionsarray[5] === '1' && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
											{
  												$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', false);
											}
							
											if (subscriptionoptionsarray[6] === '1'  && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
											{
  												$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', false);
											}
							
											if (subscriptionoptionsarray[7] === '1' && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
											{
  												$j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').prop('checked', false);
											}
							
											if (subscriptionoptionsarray[10] === '1' && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
											{
  												$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', false);
											}
							
											if (subscriptionoptionsarray[9] === '1' && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
											{
  												$j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').prop('checked', false);
											}							

											if (subscriptionoptionsarray[8] === '1' && subscriptionoptionsarray[0] !== '1')
											{
  												$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', false);
											}

											if (subscriptionoptionsarray[12] === '1' && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
												{
													  $j('#pnfpb_ic_subscribe_group_details_update_shortcode_enable').prop('checked', true);
												}
												else 
												{
													$j('#pnfpb_ic_subscribe_group_details_update_shortcode_enable').prop('checked', false);
												}
								
												if (subscriptionoptionsarray[13] === '1' && subscriptionoptionsarray[0] !== '1' && subscriptionoptionsarray[8] !== '1')
												{
													  $j('#pnfpb_ic_subscribe_group_invite_shortcode_enable').prop('checked', true);
												}
												else 
												{
													$j('#pnfpb_ic_subscribe_group_invite_shortcode_enable').prop('checked', false);
												}											

											
											if (subscriptionoptionsarray.length > 14) {

												var subscription_options_element = 14;
		
												for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
		
													if (subscriptionoptionsarray[subscription_options_element] === '1')
													{
														$j('#pnfpb_ic_subscribe_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_shortcode_enable').prop('checked', true);
		
														$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
														$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);		
													}
													else 
													{
														$j('#pnfpb_ic_subscribe_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_shortcode_enable').prop('checked', false);
		
													}
												
													subscription_options_element++;
		
												}
		
											}
																				
										        
			                				if ((subscriptionoptions !== '00000000000' && subscriptionoptions !== '00000000001' && subscriptionoptions !== '' && subscriptionoptions !== null) && responseobject.subscriptionstatus === 'subscribed')
			                				{


                                				if( $j(".pnfpb_subscribe_button").length )
                                				{
													
	                                				$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.unsubscribe_button_text_shortcode);
                               	 				}			                             
			                				}
			                				else
			                				{
						
                                				if( $j(".pnfpb_subscribe_button").length )
                                				{
	                                				$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text_shortcode);
                                				}			                    
			               	 				}
										}

										if( $j(".pnfpb_bell_icon_subscription_options_container").length) {
				

											if (subscriptionoptionsarray[12] === '1')
											{

												$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked', true);


												pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '1';

											}
											else 
											{
												$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked', false);


												pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '0';

											}
											
											if (subscriptionoptionsarray[13] === '1')
											{
												$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked', true);


												pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '1';

											}
											else 
											{
												$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked', false);


												pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '0';

											}
											
											if (subscriptionoptionsarray.length > 0) {

												for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < 12; pnfpb_post_type_element++) {

													if (pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'unsubscribe-all' && pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'all') {		
														
														if (subscriptionoptionsarray[pnfpb_post_type_element] === '1' && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
														{
															$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable').prop('checked', true);

															pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_post_type_element] = '1';
										
														}
														else 
														{
															$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable').prop('checked', false);

															pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_post_type_element] = '0';
										
														}
													
													} else {

														if (pnfpb_show_push_notify_types[pnfpb_post_type_element] === 'all' && subscriptionoptionsarray[0] === '1' )
														{

															$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[0]+'_enable').prop('checked', true);

															pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';

														} else {

															if (subscriptionoptionsarray[8] === '1') {
															
																pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';

															}
														}

													}

												}

											}													
											
											if (subscriptionoptionsarray.length > 14) {

												var subscription_options_element = 14;

												for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {

													if (subscriptionoptionsarray[subscription_options_element] === '1'  && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
													{
														$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked', true);


														pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
													}
													else 
													{
														$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked', false);


														pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
													}
													
													subscription_options_element++;

												}


											}									
										
										}
										
										if( $j(".pnfpb_bell_icon_prompt_subscription_options_container").length) {

											if (subscriptionoptionsarray[0] === '1')
												{
	
													$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked', true);
	
	
													pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '1';
	
												}
												else 
												{
	
													$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked', false);
	
		
													pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
	
												}

											if (subscriptionoptionsarray[12] === '1' && subscriptionoptionsarray[0] !== '1')
											{

												$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable').prop('checked', true);


												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '1';

											}
											else 
											{

												$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable').prop('checked', false);


												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '0';

											}
											
											if (subscriptionoptionsarray[13] === '1' && subscriptionoptionsarray[0] !== '1')
											{

												$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable').prop('checked', true);


												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '1';

											}
											else 
											{

												$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable').prop('checked', false);


												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '0';

											}

											if (subscriptionoptionsarray.length > 0) {

												for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < 12; pnfpb_post_type_element++) {

													if (pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'unsubscribe-all' && pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'all') {	
														
														if (subscriptionoptionsarray[pnfpb_post_type_element] === '1' && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
														{
															$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable').prop('checked', true);

															pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_post_type_element] = '1';

												
														}
														else 
														{
															if (subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1') {

																$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable').prop('checked', false);

																pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_post_type_element] = '0';

															}															
														}
													
													} else {

														if (pnfpb_show_push_notify_types[pnfpb_post_type_element] === 'all' && subscriptionoptionsarray[0] === '1' )
														{

															$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[0]+'_enable').prop('checked', true);

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
														$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked', true);


														pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
													}
													else 
													{
														$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked', false);


														pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
													}
													
													subscription_options_element++;

												}


											}
											
											
										
										}												

							
									});
								
								}
							
						})
						
					}
					else 
					{
						
						var isadminpage = 'no';
						
						if (window.location.href.match('wp-admin') !== null) {
							isadminpage = 'yes';
						}			
						deviceid = '';
						
						if( $j(".pnfpb_subscribe_button").length || $j(".pnfpb_push_notification_frontend_settings_submit").length )
						{
							pnfpbshortcodeactive = 'yes';
						}						
						
						if (pnfpb_pushtoken_fromflutter && pnfpb_pushtoken_fromflutter != '') {
							   
							deviceid = pnfpb_pushtoken_fromflutter;
				
						}
		
						if (pnfpb_pushtoken_fromAndroid  && pnfpb_pushtoken_fromAndroid != '') {
							   
							deviceid = pnfpb_pushtoken_fromAndroid;
				
						}						
								
						var data = {
							action: 'icpushcallback',
							device_id:deviceid,
							isadminpage:isadminpage,
							pnfpbshortcodeactive:pnfpbshortcodeactive,
							pnfpb_endpoint:subscription.endpoint,
							pnfpb_options:vapidKey,								
							pushtype: 'checkdeviceid'
					    };
								
						$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {

	
							var responseobject = JSON.parse(response);	

							subscriptionoptions = responseobject.subscriptionoptions;
							
							subscriptionoptionsarray = subscriptionoptions.split('');
														
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
							
							if( $j(".pnfpb_subscribe_button").length) { 

								if (subscriptionoptionsarray[0] === '1')
								{
  									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked', false);
								}
							
								if (subscriptionoptionsarray[1] === '1')
								{
  									$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked', false);
								}
							
								if (subscriptionoptionsarray[2] === '1')
								{
  									$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked', false);
								}
							
								if (subscriptionoptionsarray[3] === '1')
								{
  									$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked', false);
								}
							
								if (subscriptionoptionsarray[4] === '1')
								{
  									$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', false);
								}
							
								if (subscriptionoptionsarray[5] === '1')
								{
  									$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', false);
								}
							
								if (subscriptionoptionsarray[6] === '1')
								{
  									$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', false);
								}
							
								if (subscriptionoptionsarray[7] === '1')
								{
  									$j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').prop('checked', false);
								}
							
								if (subscriptionoptionsarray[8] === '1')
								{
  									$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', false);
								}
							
								if (subscriptionoptionsarray[9] === '1')
								{
  									$j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').prop('checked', false);
								}							

								if (subscriptionoptionsarray[10] === '1')
								{
  									$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', false);
								}							
							
									        
								if ((subscriptionoptions !== '00000000000' && subscriptionoptions !== '00000000001' && subscriptionoptions !== '' && subscriptionoptions !== null) && responseobject.subscriptionstatus === 'subscribed')
			               	 	{
		
                     				if( $j(".pnfpb_subscribe_button").length )
                                	{
	                                	$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.unsubscribe_button_text_shortcode);
									 }			                             
			                	}
			                	else
			                	{
 					
                                	if( $j(".pnfpb_subscribe_button").length )
                               	 	{
	                                	$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text_shortcode);
                                	}			                    
			               	 	}
							}
						})
						
					}
			})
		}
        
    }

 	// Listen to service worker messages sent via postMessage()
	navigator.serviceWorker.addEventListener('message', (event) => {
		if (!event.data.action) {
	  		return
		}
  
		switch (event.data.action) {
	  		case 'pnfpb-readmore-notificationclick':
				window.location.href = event.data.url
				break
	  			// no default
			}
  	})	


}

});
  // END jQuery ready function
});