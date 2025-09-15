# Push Notification WordPress plugin for websites, Android and IOS mobile apps with Progressive Web App (PWA)<br/>
WordPress plugin to send push notifications using Firebase Cloud Messaging (FCM) to websites, Android / iOS mobile apps. It sends push notifications using Firebase Cloud Messaging (FCM) using legacy or latest version of httpv1 Firebase api or users can select Onesignal / Progressier / webtoapp as push notification providers. It has REST API facility to integrate with native/hybrid Android / iOS mobile apps for push notifications. It has facility to generate PWA - Progressive Web App. This plugin is able to send push notification to more than 200,000 subscribers unlimited push notifications using background action scheduler.<br/><br/>

## Download this plugin<br/>
https://wordpress.org/plugins/push-notification-for-post-and-buddypress/<br/>

# Features

## Push notifications providers

### Plugin allows to choose different push notification providers<br/>

1. Firebase (Free push notifications for desktop, PWA and mobile apps)<br/>
2. web-push (self-hosted)
3. Onesignal (Free push notification for desktop, PWA and mobile apps)<br/>
4. Progressier (Push notifications for PWA)<br/>
5. webtoapp (Push notifications for Mobile apps)<br/>
(Plugin allows to send push notifications to both Firebase/Onesignal and webtoapp users simultaneously)<br/>

### Plugin sends Push notifications for following,<br/>

1. New post/custom post type published (including bbpress).<br/>
2. New BuddyPress activities published.<br/>
3. New BuddyPress group activity published (only to members of group).<br/>
4. Notifications for BuddyPress mentions in activities.(only to recipient).<br/>
5. BuddyPress group invite sent (only to recipient).<br/>
6. BuddyPress group details updated.<br/>
7. New Buddypress comments published.<br/>
8. New BuddyPress message or private messages (only to recipient).<br/>
(It is also compatible with Bettermessages plugin).<br/>
9. New BuddyPress member joined.<br/>
10. For Friend request in BuddyPress (only to recipient).<br/>
11. Friendship accepted in BuddyPress (only to requestor).<br/>
12. User avatar change in BuddyPress.<br/>
13. Cover image change in BuddyPress.<br/>
14. Supports Push notifications for BuddyBoss and Better Messages plugins<br/>
15. Woocommerce custom post type push notifications.<br/>
16. Ability to process more than 200,000 subscribers unlimited push notifications using background action scheduler.<br/>

### Admin only push notifications (only to administrators)<br/>
1. When contact form(contactform7 plugin) submitted.<br/>
2. When new user registered in site.<br/>

### Notifications only for loggedin users<br/>
Enable/Disable option in admin settings to send push notifications using Firebase httpv1 or Onesignal only for loggedin users.<br/>

### Custom popup and Bell prompt to subscribe push notifications with subscription options<br/>
Enable/Disable custom prompt with icon to subscribe/unsubscribe push notifications in front end in admin settings.<br/>
Choose Horizontal or Vertical custom prompt style and customize the text, color and button.<br/>
Enable/Disable Bell prompt icon to subscribe/unsubscribe notifications. Front end users will be able to subscribe to particular category like post, activity, comments, friendship request/accept, other options while subscribing for first time or if user wants to update subscribe options from bell prompt at any time it is needed.<br/>

## Shortcodes<br/>
For front end users bell-icon Shortcode [subscribe_PNFPB_push_notification] is available to Subscribe/Unsubscribe push notifications<br/>
PWA - Progressive Web App install shortcode [PNFPB_PWA_PROMPT] <br/>
Use shortcode [member name] and [group name] in push notification title and custom content to display user name in title/content in push notifications, similarly for BuddyPress group activities [group name] place holder is available to display group name in title/content in push notifications.<br/>

## Subscribe/Unsubscribe various push notifications in front end<br/>
Front end push notification menu is available for BuddyPress Front end users to subscribe/unsubscribe various push notifications according to their choices. This menu is available in user profile – settings area. For other users, shortcode is available to display subscription menu for Front end users to subscribe/unsubscribe various push notifications according to their choices.<br/>

## Scheduling Push notification<br/>
It allows Scheduled Push notifications to send push notifications hourly(every hour), twice daily(2 times per day), daily, weekly as per WordPress CRON. It also provides option to schedule push notification in background using action scheduler, this will be useful to send notification more than 100000 subscribers simultaneously in background mode.<br/>
Push notification scheduling is available for On demand/One time, WordPress Post, BuddyPress activities, BuddyPress group activities and for BuddyPress comments.<br/>

## REST API<br/>
REST API to connect mobile native/hybrid apps to send push notification from WordPress site to both mobile apps and WordPress sites.<br/>
Using this REST API WordPress site gets Firebase Push Notification subscription token from Mobile app(Android/Ios).<br/>
This allows to send push notifications to WordPress site users as well as to Native mobile app Android/ios users.<br/>
REST API url is https://wp-json/PNFPBpush/v1/subscriptiontoken<br/>

### HOW TO USE PLUGIN API TO INTEGRATE MOBILE APP PUSH NOTIFICATION<br/>
Android app code to integrate with this plugin<br/>
IOS app code to integrate with this plugin<br/>

Refer video tutorial under “How to use this plugin” section to configure Firebase options in plugin admin area.<br/>

## PWA Progressive Web App<br/>
This plugin has facility to generate Progressive Web App (PWA). It also supports Progressier PWA.<br/>
Go to plugin settings page to enable/disable PWA app and to customize PWA app with app name, app icon, app theme color, background color for PWA and list of pages to be included in offline cache for web app offline mode.<br/>

## Extra settings for NGINX server<br/>
If server is NGINX and not able to create dynamic service worker file https://pnfpb_icpush_pwa_sw.js & PWA manifest json file https://pnfpbmanifest.json then go to plugin settings->nginx tab, enable static file creation option, it will create required static service worker file, PWA manifest json files in root folder. This option is applicable only if hosting/server is based on NGINX and not creating dynamic service worker file, manifest json files. By default, this plugin creates dynamic service worker file and PWA manifest json file.<br/>

This plugin uses Firebase Cloud Messaging to send push notification using Firebase registration credentials which is free of cost.<br/>

## Plugin Demo site<br/>
https://www.muraliwebworld.com <br/>

### Video tutorial showing how to configure Firebase for this plugin<br /><br/>
	
https://www.youtube.com/watch?v=02oymYLt3qo <br />
	
### Integrate Native mobile apps like Flutter mobile app with this WordPress plugin<br />
New API to send push notification subscription from Native mobile apps like Flutter mobile app to WordPress backend and to send push notifications from WordPress to Native mobile app using Firebase.<br/>
1. Generate secret key in mobile app tab to communicate between mobile app(in Integrate app api tab plugin settings)<br/>
2. REST api to send subscription token from Mobile Flutter app using WebView to this WordPress plugin to store it in WordPress db to send push notification whenever new activities/post are published.<br/>

Note:- All REST api code is already included in the code, below is only for reference as guide,<br/>

REST API using POST method, to send push notification in secured way using AES 256 cryptography encryption method to avoid spams<br/>

REST API url post method to send push notification<br/>
https://domainname.com/wp-json/PNFPBpush/v1/subscriptiontoken<br/>

Input parameters in body in http post method in Flutter APP,<br/>
token – it should be encrypted according to AES 256 cryptography standards,<br/>

Following is sample code in dart Flutter AES 256 encryption and hash generation using AES 256 cryptography to send push notification subscription token in encrypted manner to this plugin - WordPress backend<br/>

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

Using secret key generated from step 1, enter secret key in flutter app code as below in push_notification_manager.dart file (attached link for lib folder),<br/>

store token in global variable for other user<br/>
Generate envrypted token as mentioned below using below coding (AES 256 cryptography encryption)<br/>
Once plugin receives this token, it will unencrypt using the secret key generate and compare hash code to confirm it is sent from Flutter app<br/>

## Scheduling push notifications<br/>
It allows to Schedule Push notifications to send as per below schedule using WordPress CRON scheduler 
hourly(every hour)<br/>,twice daily(2 times per day)<br />, daily<br />, weekly<br />
Firebase PUSH API is not compatible with Safari browsers and push notification using firebase push api will not work in Safari browsers. For Safari browsers,this plugin will display console log messages to indicate the browser is not supported for push api.<br/>
Service workers are created on the fly for Firebase Cloud Messaging while activating the plugin<br/>
In addition to default subscription from browser, following shortcode can also be used to display toggle subscription button.<br/>
New Shortcode [subscribe_PNFPB_push_notification] to display Subscribe/Unsubscribe push notification toggle button.<br/>
Using above shortcode, toggle button to subscribe/unsubscribe can be added to sidebar or any other locations according to your need.<br/>
The shortcode [subscribe_PNFPB_push_notification] is optional, it is a additional facility to subscribe to push notification inaddition to default option from browser.<br/>

## On demand or One time push notification to all subscribers <br/>
Go to plugin admin area on demand push notification to send one time notification or to schedule multiple one time notifications to start at different date and time or schedule multiple campaigns to start at different date and time with image to all subscribers<br/>

## How to configure plugin<br/>
https://wordpress.org/plugins/push-notification-for-post-and-buddypress/<br/>

Following are steps to configure the plugin,<br/>
1. Download the plugin<br/>
2. Activate the plugin<br/>
3. Go to settings of the plugin (in admin menu -> Settings -> Push Notification using FCM)<br/>
4. Enable/Disable push notification for following,<br/>
      4.a. new post types,<br/>
	4.b. new custom post types (including bbpress),<br/>
	4.c. BuddyPress activities,<br/>
	4.d. BuddyPress Group members,<br/>
	4.e. BuddyPress messages,<br/>
	4.f. BuddyPress comments<br/>
	4.g. New BuddyPress member joined<br/>
	4.h. Friend request in BuddyPress<br/>
	4.i. Friendship accepted in BuddyPress<br/>
	4.j. User avatar change in BuddyPress<br/>
	4.k. Cover image change in BuddyPress<br/>
      When BuddyPress Group Members option is enabled, it will send push notification only to users who joined in Group/to Particular group members.<br/>
      When Buddypress private message notification is enabled, Private message notification will be sent only to the recipient id sent by sender. Admin can customize the text for push notification title from admin options.<br/>
6. Configure Firebase settings as per below steps,<br/>
7. Sign in to Firebase, then open your project click settings icon & select Project settings<br/>
8. To get Firebase server key, select project settings from Firebase account, go to cloud messaging tab, get server key fill below first field under firebase configuration<br/>
9. For remaining fields, you need to get it from your Firebase web app. All fields are required to configure FireBase push notification.<br/>
10. In the Your apps card, select the nickname of the Firebase web app for which you need a config object.<br/>
11. Select Config from the Firebase SDK snippet pane and fill below fields<br/>
12. After saving below fields, it will ask to allow notification for this website in browser default popup, click on allow notification to get notifications<br/>
After completing above steps, push notification will be displayed based on option selected for posts/buddypress while publishing posts or custom post types or during new BuddyPress activities or comments.<br/>
13. New Shortcode [subscribe_PNFPB_push_notification] can also be used to display Subscribe/Unsubscribe push notification toggle button. It is a additional facility in addition to default option from browser to subscribe/unsubscribe push notifications.<br/><br/>
14. Go to PWA settings in plugin admin area and fill all required fields to customize and generate PWA app with offline facility.If pages are included for offline cache th
en users will be able to view those pages in offline mode without internet if page is not stored in cache then default offline page will be displayed.<br/>

## Screenshots
<img width="1600" height="900" alt="screenshot-13" src="https://github.com/user-attachments/assets/d579d7b5-4dea-4215-9514-82f0c6aadbf8" />
<img width="1600" height="900" alt="screenshot-12" src="https://github.com/user-attachments/assets/6865e31a-3920-43cc-8846-a106272368e6" />
<img width="1600" height="900" alt="screenshot-11" src="https://github.com/user-attachments/assets/c4020547-9874-4e8e-98af-711bb4f6b931" />
<img width="1920" height="1080" alt="screenshot-10" src="https://github.com/user-attachments/assets/9cc6139c-dfaf-44ac-a1bc-67d39c8005b0" />
<img width="1920" height="1080" alt="screenshot-9" src="https://github.com/user-attachments/assets/df796f9e-35aa-4d3d-874e-5e3dec1897a2" />
<img width="1920" height="1080" alt="screenshot-8" src="https://github.com/user-attachments/assets/58995631-639c-4de1-ab95-1fff3d92b68f" />
<img width="1920" height="1080" alt="screenshot-7" src="https://github.com/user-attachments/assets/24f19e4d-1706-4a8c-a200-5d600af5f94d" />
<img width="1920" height="1080" alt="screenshot-6" src="https://github.com/user-attachments/assets/f0aad694-b45d-4397-9aa5-9f4ea2d5e87d" />
<img width="1920" height="1080" alt="screenshot-5" src="https://github.com/user-attachments/assets/753bd4ba-86f3-4315-8f61-d4fa9f2ac523" />
<img width="1920" height="1080" alt="screenshot-4" src="https://github.com/user-attachments/assets/12f4f882-c5b7-4740-a2b6-565bb82292c8" />
<img width="1920" height="1080" alt="screenshot-4-1" src="https://github.com/user-attachments/assets/a4b51989-2019-4aee-9a8d-191fed2cee4f" />
<img width="1920" height="1080" alt="screenshot-3" src="https://github.com/user-attachments/assets/732635fa-faad-4661-bbe5-61de8105c3d9" />
<img width="1920" height="1080" alt="screenshot-2" src="https://github.com/user-attachments/assets/92460932-4f39-427b-9ed8-02265c0adfc3" />
<img width="1080" height="2160" alt="screenshot-1" src="https://github.com/user-attachments/assets/993e7b45-a621-4fd2-9fb3-3cc228c885dc" />
