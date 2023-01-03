# push notification plugin for wordpress websites and Progressive Web App (PWA) generator<br/>
This plugin is to generate Push notifications for Post, custom post types, for BuddyPress activities using Firebase and to generate Progressive Web App (PWA) with offline mode facility.<br/><br/>
# Features in this WordPress plugin<br/>
Push notification using Firebase Cloud Messaging credentials when new post/BuddyPress/BBpress/activities/custom post type published.<br/>
To send push Notification to all BuddyPress users when new BuddyPress activities or comments are published.<br/>
To send push Notifications only for BuddyPress Group Members when group activities are published.<br/>
To send push notifications for private messages in BuddyPress users. Private message notification will be sent only to the recipient id sent by sender.<br/>
To send push Notification to all users when new post or custom post types are published using Firebase Cloud Messaging.<br/>
# Integrate Native mobile apps like Flutter mobile app with this WordPress plugin
New API to send push notification subscription from Native mobile apps like Flutter mobile app to WordPress backend and to send push notifications from WordPress to Native mobile app using Firebase.
1. Generate secret key in mobile app tab to communicate between mobile app(in Integrate app api tab plugin settings)
2. REST api to send subscription token from Mobile Flutter app using WebView to this WordPress plugin to store it in WordPress db to send push notification whenever new activities/post are published.

Note:- All REST api code is already included in the code, below is only for reference as guide,

REST API using POST method, to send push notification in secured way using AES 256 cryptography encryption method to avoid spams

REST API url post method to send push notification
https://domainname.com/wp-json/PNFPBpush/v1/subscriptiontoken

Input parameters in body in http post method in Flutter APP,
token – it should be encrypted according to AES 256 cryptography standards,

Following is sample code in dart Flutter AES 256 encryption and hash generation using AES 256 cryptography to send push notification subscription token in encrypted manner to this plugin - WordPress backend

```dart
String strPwd = "16234hgJKLmllpdcd09b2bc37293"; //secret key generated in step 1 above

      GlobalData.pushtoken = token.toString();

      final iv = EncryptPack.IV.fromLength(16);

      final key = EncryptPack.Key.fromUtf8(strPwd); //hardcode

      final encrypter = EncryptPack.Encrypter(EncryptPack.AES(key, mode: EncryptPack.AESMode.cbc));

      final encrypted = encrypter.encrypt(token.toString(), iv: iv);

      var hmacSha256 = CryptoPack.Hmac(CryptoPack.sha256,ConvertPack.utf8.encode(strPwd)); // HMAC-SHA256

      var hmacstring = hmacSha256.convert(ConvertPack.utf8.encode(token.toString()));

      var encryptedsubscription = encrypted.base64+":"+iv.base64+":"+hmacstring.toString()+":"+hmacstring.toString();
```

Using secret key generated from step 1, enter secret key in flutter app code as below in push_notification_manager.dart file (attached link for lib folder),

store token in global variable for other user
Generate envrypted token as mentioned below using below coding (AES 256 cryptography encryption)
Once plugin receives this token, it will unencrypt using the secret key generate and compare hash code to confirm it is sent from Flutter app

# Scheduling push notifications<br/>
It allows to Schedule Push notifications to send as per below schedule using WordPress CRON scheduler 
hourly(every hour)<br/>,twice daily(2 times per day)<br />, daily<br />, weekly<br />
Firebase PUSH API is not compatible with Safari browsers and push notification using firebase push api will not work in Safari browsers. For Safari browsers,this plugin will display console log messages to indicate the browser is not supported for push api.<br/>
Service workers are created on the fly for Firebase Cloud Messaging while activating the plugin<br/>
In addition to default subscription from browser, following shortcode can also be used to display toggle subscription button.<br/>
New Shortcode [subscribe_PNFPB_push_notification] to display Subscribe/Unsubscribe push notification toggle button.<br/>
Using above shortcode, toggle button to subscribe/unsubscribe can be added to sidebar or any other locations according to your need.<br/>
The shortcode [subscribe_PNFPB_push_notification] is optional, it is a additional facility to subscribe to push notification inaddition to default option from browser.<br/><br/>
# Progressive Web App (PWA)<br/>
This plugin generates PWA app based on settings in plugin admin area. Admin users will be able to enable/disable PWA app and will be customize PWA app with app name, app icon, app theme color, background color and list of pages to be included in offline cache for web app offline mode. If pages are included for offline cache then users will be able to view those pages in offline mode without internet if page is not stored in cache then default offline page will be displayed. Progressive Web Apps are supported by Chrome(Desktop,Mobile) browser, Edge browser, Firefox for android, Opera for android. Firefox for desktop will not support PWA.<br/><br/>
# On demand or One time push notification to all subscribers <br/>
Go to plugin admin area on demand push notification to send notification with image to all subscribers<br/><br/>
# Download this plugin<br/>
https://wordpress.org/plugins/push-notification-for-post-and-buddypress/<br/><br/>
# How to configure plugin<br/>
Following are steps to configure the plugin,<br/>
1. Download the plugin<br/>
2. Activate the plugin<br/>
3. Go to settings of the plugin (in admin menu -> Settings -> Push Notification using FCM)<br/>
4. Enable/Disable push notification settings for post, custom post types, BuddyPress activities all users or only for BuddyPress Group Members and for BuddyPress comments.<br/>
5.When BuddyPress Group Members option is enabled, it will send push notification only to users who joined in Group/to Particular group members.<br/>
5.1. When Buddypress private message notification is enabled, Private message notification will be sent only to the recipient id sent by sender. Admin can customize the text for push notification title from admin options.<br/>
6. Configure Firebase settings as per below steps,<br/>
7. Sign in to Firebase, then open your project click settings icon & select Project settings<br/>
8. To get Firebase server key, select project settings from Firebase account, go to cloud messaging tab, get server key fill below first field under firebase configuration<br/>
9. For remaining fields, you need to get it from your Firebase web app. All fields are required to configure FireBase push notification.<br/>
10. In the Your apps card, select the nickname of the Firebase web app for which you need a config object.<br/>
11.Select Config from the Firebase SDK snippet pane and fill below fields<br/>
After saving below fields, it will ask to allow notification for this website in browser default popup, click on allow notification to get notifications<br/>
After completing above steps, push notification will be displayed based on option selected for posts/buddypress while publishing posts or custom post types or during new BuddyPress activities or comments.<br/>
New Shortcode [subscribe_PNFPB_push_notification] can also be used to display Subscribe/Unsubscribe push notification toggle button. It is a additional facility in addition to default option from browser to subscribe/unsubscribe push notifications.<br/><br/>
# Progressive Web App (PWA) settings<br/>
14. Go to PWA settings in plugin admin area and fill all required fields to customize and generate PWA app with offline facility.If pages are included for offline cache then users will be able to view those pages in offline mode without internet if page is not stored in cache then default offline page will be displayed.<br/>
# Screenshots
![screenshot-1push](https://user-images.githubusercontent.com/32461311/132991104-5a7cfbf4-19dd-4129-8d8a-279fb00876a0.png)
![screenshot-2](https://user-images.githubusercontent.com/32461311/133961443-aeb7765e-7ac5-4f08-943f-ab281cf3f25f.png)
![screenshot-7](https://user-images.githubusercontent.com/32461311/133961446-a4d6d0fd-3d34-4380-ac8f-44cbbc4d1f88.png)
![screenshot-6push](https://user-images.githubusercontent.com/32461311/132991099-e0ccd6df-0830-4af6-914e-2560ee1e07f3.png)
![push-private-message2](https://user-images.githubusercontent.com/32461311/132991198-93bd9c69-8b89-46ee-8c7f-c8e41af0e83c.png)
