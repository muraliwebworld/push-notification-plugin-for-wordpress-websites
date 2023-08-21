//import https from 'https';
//import { google} from 'googleapis';
import * as admin from 'firebase-admin';

/*var firebaseConfig = {
    apiKey: pnfpb_ajax_object_push.apiKey,
    authDomain: pnfpb_ajax_object_push.authDomain,
    databaseURL: pnfpb_ajax_object_push.databaseURL,
    projectId: pnfpb_ajax_object_push.projectId,
    storageBucket: pnfpb_ajax_object_push.storageBucket,
    messagingSenderId: pnfpb_ajax_object_push.messagingSenderId,
    appId: pnfpb_ajax_object_push.appId
};*/

console.log(pnfpb_ajax_object_send_push.pnfpb_message_title);

admin.initializeApp({
  credential: admin.credential.cert(pnfpb_ajax_object_send_push.pnfpb_service_account_file)
});

admin.initializeApp();

// OPTION #2 <------

admin.initializeApp();

/*getAccessToken().then(function(accessToken) {
    console.log(accessToken);
});*/
/**
 * Get a valid access token.
 */
// [START retrieve_access_token]
/*function getAccessToken() {
    return new Promise(function(resolve, reject) {
      const key = require(pnfpb_ajax_object_send_push.pnfpb_service_account_file);
      const jwtClient = new google.auth.JWT(
        key.client_email,
        null,
        key.private_key,
        SCOPES,
        null
      );
      jwtClient.authorize(function(err, tokens) {
        if (err) {
          reject(err);
          return;
        }
        resolve(tokens.access_token);
      });
    });
  }*/
  // [END retrieve_access_token]