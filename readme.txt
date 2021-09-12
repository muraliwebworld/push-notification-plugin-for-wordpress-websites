=== Push Notification for Post and BuddyPress ===
Contributors: murali-indiacitys
Author URI: https://www.indiacitys.com
Plugin URL: https://www.indiacitys.com
Tags:  Push notification using FCM for Post, BuddyPress push notification, Push notification using FCM for Custom Post types, Firebase push notification for WordPress, WordPress Free Push Notification for post and BuddyPress
Donate link: https://www.indiacitys.com
Requires at least: 5.0
Tested up to: 5.7
Requires PHP: 7.0
Stable tag: 1.13
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin will add Push notification for Post, custom post types and for BuddyPress activities using Firebase.

== Description ==

This Plugin is designed subscribe users for push notification and to send push notification using Firebase Cloud Messaging whenever new WordPress post published, WordPress custom post types published and for new BuddyPress activities and also for comments posted in BuddyPress activities.

**Plugin features:-** 
Push notification using Firebase Cloud Messaging credentials when new post/BuddyPress/BBpress/activities/custom post type published.
To send push Notification to all BuddyPress users when new BuddyPress activities or comments are published.
To send push Notifications only for BuddyPress Group Members when group activities are published.
To send push notifications for private messages in BuddyPress users. Private message notification will be sent only to the recipient id sent by sender.
To send push Notification to all users when new post or custom post types are published using Firebase Cloud Messaging.
Firebase PUSH API is not compatible with Safari browsers and push notification using firebase push api will not work in Safari browsers. For Safari browsers,this plugin will display console log messages to indicate the browser is not supported for push api.

Service workers are created on the fly for Firebase Cloud Messaging while activating the plugin
In addition to default subscription from browser, following shortcode can also be used to display toggle subscription button.
New Shortcode [subscribe_PNFPB_push_notification] to display Subscribe/Unsubscribe push notification toggle button.
Using above shortcode, toggle button to subscribe/unsubscribe can be added to sidebar or any other locations according to your need.
The shortcode [subscribe_PNFPB_push_notification] is optional, it is a additional facility to subscribe to push notification inaddition to default option from browser.

**How to use Plugin:-**

Following are steps to configure the plugin,
1. Download the plugin
2. Activate the plugin
3. Go to settings of the plugin (in admin menu -> Settings -> Push Notification using FCM)
4. Enable/Disable push notification settings for post, custom post types, BuddyPress activities all users or only for BuddyPress Group Members and for BuddyPress comments.
5.When BuddyPress Group Members option is enabled, it will send push notification only to users who joined in Group/to Particular group members.
5.1. When Buddypress private message notification is enabled, Private message notification will be sent only to the recipient id sent by sender. Admin can customize the text for push notification title from admin options.
6. Configure Firebase settings as per below steps,
7. Sign in to Firebase, then open your project click settings icon & select Project settings
8. To get Firebase server key, select project settings from Firebase account, go to cloud messaging tab, get server key fill below first field under firebase configuration
9. For remaining fields, you need to get it from your Firebase web app. All fields are required to configure FireBase push notification.
10. In the Your apps card, select the nickname of the Firebase web app for which you need a config object.
11.Select Config from the Firebase SDK snippet pane and fill below fields

After saving below fields, it will ask to allow notification for this website in browser default popup, click on allow notification to get notifications

After completing above steps, push notification will be displayed based on option selected for posts/buddypress while publishing posts or custom post types or during new BuddyPress activities or comments.

11. New Shortcode [subscribe_PNFPB_push_notification] can also be used to display Subscribe/Unsubscribe push notification toggle button. It is a additional facility in addition to default option from browser to subscribe/unsubscribe push notifications.


== Installation ==

Following are steps to configure the plugin,
1. Download the plugin
2. Activate the plugin
3. Go to settings of the plugin (in admin menu -> Settings -> Push Notification using FCM)
4. Enable/Disable push notification settings for post, custom post types, BuddyPress activities/BuddyPress Group members and for BuddyPress comments.
5.When BuddyPress Group Members option is enabled, it will send push notification only to users who joined in Group/to Particular group members.
5.1.When Buddypress private message notification is enabled, Private message notification will be sent only to the recipient id sent by sender. Admin can customize the text for push notification title from admin options.
6. Configure Firebase settings as per below steps,
7. Sign in to Firebase, then open your project click settings icon & select Project settings
8. To get Firebase server key, select project settings from Firebase account, go to cloud messaging tab, get server key fill below first field under firebase configuration
9. For remaining fields, you need to get it from your Firebase web app. All fields are required to configure FireBase push notification.
10. In the Your apps card, select the nickname of the Firebase web app for which you need a config object.
11.Select Config from the Firebase SDK snippet pane and fill below fields

After saving below fields, it will ask to allow notification for this website in browser default popup, click on allow notification to get notifications

Push notifications will better work in normal browser not in cognito private browser as it requires service worker registrations to display push notification.

After completing above steps, push notification will be displayed based on option selected for posts/buddypress while publishing posts or custom post types or during new BuddyPress activities or comments.

11. New Shortcode [subscribe_PNFPB_push_notification] can also be used to display Subscribe/Unsubscribe push notification toggle button. It is a additional facility in addition to default option from browser to subscribe/unsubscribe push notifications.

== Frequently Asked Questions ==

= Do you have any questions? =

[Please contact us here with your query.](https://indiacitys.com/#contact)

== Screenshots ==

1. Screen showing list of push notifications in desktop
2. Settings page to configure plugin with FireBase and other settings
3. Admin area menu for this plugin
4. Shortcode to display subscribe/unsubscribe toggle button
5. Shortcode to display unsubscribe/subscribe toggle button
6. BuddyPress Group members can subscribe/remove push notification for every group

== Changelog ==
= 1.13 =
New features added to send push notifications for private messages in BuddyPress only to receiver's id.
When Buddypress private message notification is enabled, Private message notification will be sent only to the recipient id sent by sender. Admin can customize the text for push notification title from admin options.
Foreground push notification in android browser when browser is in focus along with background push notification(which is already in old release).
= 1.12 =
Removed alert dialogs for service worker registration failed, replaced with console logs.
Firebase PUSH api will work in Chrome,Edge,Firefox and other major browsers except Safari.
Firebase PUSH API is not compatible with Safari browsers and push notification using firebase push api will not work in Safari browsers. 
For Safari browsers,this plugin will display console log messages to indicate the browser is not supported for push api.
= 1.11 =
Changes to BuddyPress Group member push notification subscription/unsubscription.
Changes to Compatiable with buddyx theme, buddypress template packs - legacy and BuddyPress Nouveau.
Fixed - Push Notification permission to ask only with user gesture and removed request permission without user gesture 
= 1.10 =
New feature added - BuddyPress Group members can subscribe/remove push notification for every group.
When BuddyPress Group Members option is enabled, it will send push notification only to users who joined in Group/to Particular group members.
= 1.9 =
Compatible upto WordPress Version 5.6

= 1.8 =
New feature added - BuddyPress Group members can subscribe/remove push notification for every group.
When BuddyPress Group Members option is enabled, it will send push notification only to users who joined in Group/to Particular group members.
Compatible upto WordPress Version 5.6
= 1.7 =
Fixed warnings related to sourcemapping firebase core javascript
Updated firebase core modules
Push notifications will better work in normal browser not in cognito private browser as it requires service worker registrations to display push notification.
This plugin requires firebase credentials to be filled in plugin admin area to get push notifications from FireBase. Please refer plugin documentation
Updated subscribe and unsubscribe javascript files compatible with latest jquery

= 1.6 =
Updated firebase core modules
Compatible upto WordPress Version 5.5.1. Updated author URL.

= 1.5 =
Compatible upto WordPress Version 5.5.1. Updated author URL.

= 1.4 =
Compatible upto WordPress Version 5.4.2. Updated author URL.

= 1.3 =
Compatible and tested upto WordPress Version 5.4.2

= 1.2 = 
* Added new shortcode [subscribe_PNFPB_push_notification] to unsubscribe push notifications.
* Removed manifest.json file generation as it is required by old generation.

= 1.1.1 = 
* Added new shortcode [subscribe_PNFPB_push_notification] to unsubscribe push notifications.
* Removed manifest.json file generation as it is required by old generation.

= 1.1 =
* Updated with link to the settings on the Plugins screen.

= 1.0 =
* Initial version.


== Upgrade Notice ==
* New features added to send push notifications for private messages in BuddyPress only to receiver's id.
When Buddypress private message notification is enabled, Private message notification will be sent only to the recipient id sent by sender. Admin can customize the text for push notification title from admin options.
Foreground push notification in android browser when browser is in focus along with background push notification(which is already in old release).
* Removed alert dialogs for service worker registration failed, replaced with console logs.
* Firebase PUSH API is not compatible with Safari browsers and push notification using firebase push api will not work in Safari browsers. 
* For Safari browsers,this plugin will display console log messages to indicate the browser is not supported for push api.
* Changes to BuddyPress Group member push notification subscription/unsubscription.
* Changes to Compatiable with buddyx theme, buddypress template packs - legacy and BuddyPress Nouveau.
* Fixed - Push Notification permission to ask only with user gesture and removed request permission without user gesture 
* New feature added - BuddyPress Group members can subscribe/remove push notification for every group.
When BuddyPress Group Members option is enabled, it will send push notification only to users who joined in Group/to Particular group members.Compatible and tested upto WordPress Version 5.6
* Compatible and tested upto WordPress Version 5.5.1
* Compatible and tested upto WordPress Version 5.4.2
* Added new shortcode [subscribe_PNFPB_push_notification] to unsubscribe push notifications.
* Removed manifest.json file generation as it is required by old generation.
* Updated with link to the settings on the Plugins screen.
Initial version