var pnfpb_onesignal_userid;

pnfpb_onesignal_userid = pnfpb_ajax_object_onesignal_push.userid;
pnfpb_onesignal_userid_os = pnfpb_onesignal_userid;
if (pnfpb_onesignal_userid === '1') {
	pnfpb_onesignal_userid_os = '1pnfpbadm';
}
OneSignal.push(function() {
  OneSignal.setExternalUserId(pnfpb_onesignal_userid_os);
});
OneSignal.push(function() {
  OneSignal.getExternalUserId().then(function(externalUserId){
    console.log("externalUserId: ", externalUserId);
  });
});

const { setExternalUserId } = WTN.OneSignal;

setExternalUserId(pnfpb_onesignal_userid_os);

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
	PNFPB_from_Java_androidapp();
	PNFPB_from_Flutter_mobileapp();	  	
  };
} else {
  if (userAgent.includes('wv')) {
    // Android webview
    pnfpb_webview = true;
	PNFPB_from_Java_androidapp();
	PNFPB_from_Flutter_mobileapp();	  
  } else {
    // Chrome
    pnfpb_webview = false;
  }
};


var $j = jQuery.noConflict();

$j(document).ready(function() {
	
	var pnfpbonesignalid = parseInt(pnfpb_onesignal_userid);
	
	
 	if (pnfpb_webview) {
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
	OneSignal.push(function() {
  		OneSignal.getExternalUserId().then(function(externalUserId){
			console.log(externalUserId);
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
  		});
	});
});
