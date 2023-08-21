var pnfpb_onesignal_userid;

pnfpb_onesignal_userid = pnfpb_ajax_object_onesignal_push.userid;
console.log(pnfpb_onesignal_userid);
OneSignal.push(function() {
  OneSignal.setExternalUserId(pnfpb_onesignal_userid);
});
OneSignal.push(function() {
  OneSignal.getExternalUserId().then(function(externalUserId){
    console.log("externalUserId: ", externalUserId);
  });
});

const { setExternalUserId } = WTN.OneSignal;

setExternalUserId(pnfpb_onesignal_userid);
