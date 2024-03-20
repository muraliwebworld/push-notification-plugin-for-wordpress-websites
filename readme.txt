=== Push Notification for Post and BuddyPress ===
Contributors: murali-indiacitys
Author URI: https://www.muraliwebworld.com
Tags:  push notification,mobile app,progressive web app,buddypress,firebase
Donate link: https://www.muraliwebworld.com/support-to-push-notification-plugin-for-buddypress-and-for-post/
Requires at least: 5.0
Tested up to: 6.4
Requires PHP: 7.4
Stable tag: 1.81
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

To send Push notifications for WordPress websites with Post/custom post, BuddyPress activities, for Android/IOS mobile apps and to generate PWA.

== Description ==

It sends push notifications to desktop, android/ios mobile apps using Firebase Cloud Messaging (FCM) with latest version Firebase API httpv1 or with legacy Firebase api or users can select Onesignal as push notification provider. It has REST API facility to integrate with native/hybrid Android/iOS mobile apps for push notifications. It sends notification whenever new WordPress post, custom post types,new BuddyPress activities,comments published. It has facility to generate PWA - Progressive Web App. This plugin is able to send push notification to more than 200,000 subscribers unlimited push notifications using background action scheduler.

**Plugin features:-** 
To send Push notifications for following,

1. New post/custom post type published (including bbpress).
2. New BuddyPress activities published.
3. New BuddyPress group activity published (only to members of group).
4. Notifications for BuddyPress mentions in activities.(only to recipient).
5. BuddyPress group invite sent (only to recipient).
6. BuddyPress group details updated.
7. New Buddypress comments published.
8. New BuddyPress message or private messages (only to recipient).
(It is also compatible with Bettermessages plugin).
9. New BuddyPress member joined.
10. For Friend request in BuddyPress (only to recipient).
11. Friendship accepted in BuddyPress (only to requestor).
12. User avatar change in BuddyPress.
13. Cover image change in BuddyPress.
14. Woocommerce custom post type push notifications.

Following are Admin only push notifications, only sent to admins.
1. When contact form(contactform7 plugin) submitted.
2. When new user registered in site.

= Notifications only for loggedin users =
Enable/Disable option in admin settings to send push notifications only for loggedin users. If you use httpv1 firebase version and if you enable this option by having old subscriptions then all users must re-subscribe. If you use legacy Firebase api then no need to re-subscribe.

= Custom popup and Bell prompt to subscribe push notifications with subscription options =
Enable/Disable custom prompt with icon to subscribe/unsubscribe push notifications in front end in admin settings.
Choose Horizontal or Vertical custom prompt style and customize the text, color and button.
Enable/Disable Bell prompt icon to subscribe/unsubscribe notifications. This option can be customized with custom icon and text in admin settings with local languages.
Custom prompt and Bell icon includes subscription option along with subscribe/unsubscribe button. Front end users will be able to subscribe to particular category like post, activity, comments, friendship request/accept, other options while subscribing for first time or if user wants to update subscribe options from bell prompt at any time it is needed.
Subscription options in bell prompt and in custom prompt shall be enabled/disabled in plugin admin settings under push settings tab -> under customization of custom and bell prompt.

= Shortcodes =
Use shortcode [member name] and [group name] in push notification title and custom content to display user name in title/content in push notifications, similarly for BuddyPress group activities [group name] place holder is available to display group name in title/content in push notifications.
For front end users Shortcode [subscribe_PNFPB_push_notification] is available to Subscribe/Unsubscribe push notifications

= Push notification providers Firebase  or Onesignal =
Options to use Firebase as push notification provider or to use onesignal as push notification provider are available in admin settings area.

= Subscribe/Unsubscribe various push notifications in front end = 
Front end push notification menu is available for BuddyPress Front end users to subscribe/unsubscribe various push notifications according to their choices. This menu is available in user profile - settings area. For other users, shortcode is available to display subscription menu for Front end users to subscribe/unsubscribe various push notifications according to their choices.

= Scheduling Push notification =
It allows Scheduled Push notifications to send push notifications hourly(every hour), twice daily(2 times per day), daily, weekly as per WordPress CRON. It also provides option to schedule push notification in background using action scheduler, this will be useful to send notification more than 100000 subscribers simultaneously in background mode.
Push notification scheduling is available for On demand/One time, WordPress Post, BuddyPress activities, BuddyPress group activities and for BuddyPress comments.

= REST API =
REST API to connect mobile native/hybrid apps to send push notification from WordPress site to both mobile apps and WordPress sites.
Using this REST API WordPress site gets Firebase Push Notification subscription token from Mobile app(Android/Ios). 
This allows to send push notifications to WordPress site users as well as to Native mobile app Android/ios users.
REST API url is https:/<domain>/wp-json/PNFPBpush/v1/subscriptiontoken

= HOW TO USE PLUGIN API TO INTEGRATE MOBILE APP PUSH NOTIFICATION =
Sample code libraries containing how to use this plugin REST API to integrate with Android and IOS mobile apps
[Android app code to integrate with this plugin](https://github.com/muraliwebworld/android-app-to-integrate-push-notification-wordpress-plugin/)
[IOS app code to integrate with this plugin](https://github.com/muraliwebworld/ios-swift-app-to-integrate-push-notification-wordpress-plugin/)

Refer video tutorial under "How to use this plugin" section to configure Firebase options in plugin admin area.
	
= PWA =
This plugin has facility to generate Progressive Web App (PWA).
Progressive Web Apps are supported by Chrome(Desktop,Mobile) browser, Edge browser, Firefox for android, Opera for android. Firefox for desktop will not support PWA. 
Go to plugin settings page to enable/disable PWA app and to customize PWA app with app name, app icon, app theme color, background color for PWA and list of pages to be included in offline cache for web app offline mode.
	
= Extra settings for NGINX server =
If server is NGINX and not able to create dynamic service worker file https:/<domain>/pnfpb_icpush_pwa_sw.js & PWA manifest json file https:/<domain>/pnfpbmanifest.json then go to plugin settings->nginx tab, enable static file creation option, it will create required static service worker file, PWA manifest json files in root folder. This option is applicable only if hosting/server is based on NGINX and not creating dynamic service worker file, manifest json files. By default, this plugin creates dynamic service worker file and PWA manifest json file. 

This plugin uses Firebase Cloud Messaging to send push notification using Firebase registration credentials which is free of cost.

** Video tutorial showing how to configure Firebase for this plugin **
	
[youtube https://www.youtube.com/watch?v=02oymYLt3qo]

== Installation ==

Following are steps to configure the plugin,

1. Download the plugin

2. Activate the plugin

3. Go to settings of the plugin (in admin menu -> Settings -> Push Notification using FCM)

4. Enable/Disable push notification when new item published in following,

	4.a. new post types published,
	4.b. new custom post types published,
	4.c. BuddyPress activities,
	4.d. BuddyPress Group members,
	4.e. BuddyPress messages,
	4.f. BuddyPress comments
	4.g. New BuddyPress member joined
	4.h. Friend request in BuddyPress
	4.i. Friendship accepted in BuddyPress
	4.j. User avatar change in BuddyPress
	4.k. Cover image change in BuddyPress
	4.l. Group invite
	4.m. Group details update
	4.n. Contactform7 submitted (Admin notification)
	4.o. New user registration (Admin notification)	

= Scheduling push notifications =

5.Optionally it allows to Schedule push notifications for post types,BuddyPress new activities, BuddyPress new Group activities and for BuddyPress new comments. Push notifications can be scheduled in following schedules. Go to admin settings and schedule it accordingly.Schedule push notifications in Hourly, twice daily,daily,weekly schedules. If schedule is off then push notification will be sent whenever new item is published in corresponding post types/BuddyPress activities/messages/comments.
6.When BuddyPress Group Members option is enabled, it will send push notification only to users who joined in Group/to Particular group members.
7.When Buddypress private message notification is enabled, Private message notification will be sent only to the recipient id sent by sender. Admin can customize the text for push notification title from admin options.

= Firebase configuration =

** Video tutorial showing how to configure Firebase for this plugin **
	
[youtube https://www.youtube.com/watch?v=02oymYLt3qo]

8. Configure Firebase settings as per below steps,

= Firebase configuration setup in plugin admin settings =
Sign in to Firebase, then open your project, click settings icon & select Project settings

= To get Firebase server key (for field 1 in admin firebase settings) =
project settings > cloud messaging tab > get server key or add server key button to get server key

= To get Firebase config fields (for fields 2 to 8 in admin firebase settings) =
If you do not have web app, Create a new web app. After creating a new app, it will show firebase config fields
Project settings > General under your apps section > click on config button to view configuration fields 

= To get Firebase public key (for field 9 in admin firebase settings) =
Open the Cloud Messaging tab of the Firebase console Settings pane and scroll to the Web configuration section.
In the Web Push certificates tab, click Generate Key Pair. The console displays a notice that the key pair was generated, and displays the public key string and date added.
(If you already Generated key pair then no need to generate it again)

= Progressive Web App (PWA) settings =
9. Go to PWA settings in plugin admin area and fill all required fields to customize and generate PWA app with offline facility.If pages are included for offline cache then users will be able to view those pages in offline mode without internet if page is not stored in cache then default offline page will be displayed.if all urls needs to be excluded from offline PWA cache then enable exclude all urls option in PWA settings.

10. Go to on-demand push notification admin panel to send push notification from admin panel to all subscribers whenever it required.

After saving below fields, it will ask to allow notification for this website in browser default popup, click on allow notification to get notifications

Push notifications will better work in normal browser not in cognito private browser as it requires service worker registrations to display push notification.

After completing above steps, push notification will be displayed based on option selected for posts/buddypress while publishing posts or custom post types or during new BuddyPress activities or comments.

11.For front end users Shortcode [subscribe_PNFPB_push_notification] is available to Subscribe/Unsubscribe push notifications for following

	11.1. Subscribe all notifications
	11.2. Subscribe to all new post/new BuddyPress activity notifications
	11.3. Subscribe to all new comments for post,BuddyPress activities notifications
	11.4. Subscribe to new comments notifications only from My BuddyPress activities or My post based on Post Author id/BuddyPress activity Author id
	11.5. New BuddyPress member joined
	11.6. Friend request in BuddyPress
	11.7. Friendship accepted in BuddyPress
	11.8. User avatar change in BuddyPress
	11.9. Cover image change in BuddyPress
	11.10. Unsubscribe all notifications

Front end users/customers can opt/remove for various push notifications listed above according to their own choice.
	
12. Shortcode [PNFPB_PWA_PROMPT] to create button to install PWA. If user clicks this button, it will show default prompt to install PWA. This shortcode can be placed anywhere or in sidebar according to convenience. 

== Frequently Asked Questions ==

= Do you have any questions? =

[Submit or contact us with your question here](https://www.muraliwebworld.com/groups/wordpress-plugins-by-muralidharan-indiacitys-com-technologies/forum/topic/push-notification-for-post-and-buddypress/) (or) [Please contact us here with your query.](https://indiacitys.com/#contact) (or) Submit your question in plugin forum

== Screenshots ==

1. Push notification in Mobile
2. Desktop push notification
3. Plugin settings for push notification in admin area
4. Plugin settings for push notification with BuddyPress options in admin area
5. Shortcode push notification options for front-end users to opt for various notifications
6. BuddyPress Group members can subscribe/remove push notification for every group
7. Admin page showing list of tokens subscribed
8. Progressive Web App admin settings page
9. On demand push notification page in plugin settings area
10.Customize plugin buttons
11.API for mobile app which are using webview
12.Special settings for NGINX based server

== Changelog ==
= 1.81 version Mar 15 2024 =
New feature: New admin settings field added for number of days to show custom prompt for push notification again for front end users who cancels push notification in custom prompt.
PWA New feature: New admin settings field added for number of days to show PWA custom prompt for push notification again for front end users who cancels push notification in PWA custom prompt.
Update: Removed please wait processing message while subscribing notification.
Update: Optimized subscription of push notifications from custom prompt/bell icons.
Bug fix: Fix problems related to browser check logic to be compatible with Elementor and other plugins
Bug fix: Fixed problems related to duplicate notification for my comments push notifications
Update: PWA cache will not be enabled automatically, unless exclude all urls in PWA settings field set to OFF manually.
Bug fix: Resolved problem related to threadid(private messages),click url fields for webview app push notification - friendship request,accepted,private messages.

= 1.80 version Mar 4 2024 =
Updated readme.txt. refer below change log for 1.79 changes.

= 1.79 version Mar 4 2024 =
New feature: Various Subscription options are included in custom prompt, bell icon while subscribing for push notification first time. Users will be able to select subscription options while subscribing for the first time from custom prompt/bell icon. From bell icon, front end users will be able to modify subscription options whenever it is needed. Subscription option can be turned on/off to include/exclude in custom prompt or in bell icon from admin settings.
Bug fix: Removed unwanted console messages in mobile webview javascripts.
New feature: Included [[group name]] place holder for group title, group content push notification.
New feature: If Buddypress followers plugin installed then notification can be sent only to followers for buddypress activities/group activities/comments.
= 1.78 version Feb 13 2024 =
Bug fix for webview mobile app: Fixed problems related to android/ios mobile app push notification subscription option update to database, saving front end subscription options in webview app.
Bug fix for Firebase httpv1 version: Fixed problem in admin settings on uploading service account json file to enable firebase httpv1 version api independent of other firebase settings.
Bug fix for BuddyBoss users: Updated logic to send notifications for activity comments only to liked users for particular activity.
Bug fix for BuddyBoss users: Updated logic in group forum activities to send notifications only for subscribed users for particular forum.
Bug fix for onesignal users: Updated logic to control onesignal push notifications based on admin options enabled for various push notifications in plugin admin page.
Update: Info message showing subscribe for push notifications in frontend push notification subscription control menu under profile->settings, when user is not subscribed for push notification.

= 1.77 version Dec 02 2023 =
New feature: New custom prompt styles introduced to display prompt in horizontal pattern, vertical pattern to subscribe push notifications.
Customization of prompt is available in admin settings of custom prompt. Bell icon prompt will work with or without custom prompt.
Enable custom prompt style to display custom prompt and enable/disable Bell icon prompt to display/hide Bell icon format in admin settings.
Bug fix: Resolved problems related to Friendship request/accept notifications.
Bug fix: Fixed problems related to Notifications for logged in only users.

= 1.76 version November 16 2023 =
Bug fix: Resolved private message notifications for mobile app/webview app.
= 1.75 version November 12 2023 =
Compatible with WordPress 6.4
Bug fix: Resolved warning messages in sql query in one time push notifications list tab in admin settings related to orderby.
= 1.74 version 11 11 2023 =
Bug fix: Resolved problems related to webview mobile app notifications for ondemand/one time push notifications.
= 1.73 version 02 Nov 2023 =
New feature: New option in admin settings to send push notifications only for loggedin users for Firebase based notifications. If you enable this for httpv1 firebase notifications then all subscriptions needs to be subscribed again, for legacy firebase api, no need to resubscribe subscriptions.
New feature: New option adminsettings for onesignal based notifications to send push notifications only for loggedin users. It will send notifications based on id for every subscribed users.
Update: Shortcode button and frontend push notifications settings will appear based on admin settings to send push notifications only for loggedin users.
Bug fix: Fixed problem related to post and custom post type notifications related to metabox checkbox in new post/post edit page to validate based on edit page or in front end to send notifications accordingly. For front end related post it will work based on admin post enabled settings and for admin new/edit post page, it will work based on metabox checkbox enabled/disabled.
Bug fix: Fixed problem related to mycomments notification using Firebase httpv1 version.
Bug fix: Fixed problem on private messages notification for webview using Firebase httpv1 version.
Bug fix: Fixed problem on Firebase httpv1 notifications for webview.
Bug fix: Fixed problem related to onesignal on demand push notifications to work independent of Firebase settings in PNFPB admin settings. If you enable onesignal has push notification provider then ondemand push notification will work without filling firebase credentials independently using Onesignal credentials.
= 1.71 version 20 Oct 2023 =
Update: Allow push notification for post when meta box for notification is turned on irrespective of admin settings.
Bug fix: Fixed problems in Group push notification using Firebase httpv1 version.
For Shortcode [[subscribe_PNFPB_push_notification]]
Bug fix: Shortcode button text changes during subscribe/unsubscribe notification.
Update: In Shortcode – Loading spinner added while subscribing and unsubscribing notification.
Update: In Shortcode – Close button added in confirmation dialog.
Bug fix: Rectified problem related to wrongly displayed subscription option updated text for last checkbox option in shortcode. Updated code to display correct text for that option.
Update: Shortcode push notifications options will be displayed as per settings enabled in admin push settings for frontend users.
= 1.70 version – 8 Oct 2023 changes =
BuddyPress Mentions push notifications – one to one notification only to user mentioned in BuddyPress activity
Scheduling notifications changes to delete old data when it is reset/switched off.
Merged cron schedule notifications with action scheduler to schedule notifications in background.
Admin panel changes for scheduling notifications.
Links to action scheduler tab in admin panel to view list of scheduled notifications for BuddyPress activities/group activities/comments and for post, custom post types.
Scheduling notifications changes to start at entered time instead of immediate start.
Customise options for Frontend Custom prompt to subscribe/unsubscribe notifications are added in admin push settings panel to customise button text for custom prompt, customise display message text in custom prompt.
New meta box with checkbox added for every post/page to send or not to send push notifications while creating post.
Admin settings to enable BuddyPress comments notifications only for author of particular activity (comment notifications only for My post/My activities).
PWA install prompt shortcake will work independent of custom prompt of PWA.
PWA custom install prompt can be enabled/disabled for desktop/mobile/tablet/according to screen size. Various custom options added in PWA settings tab.
= For all older releases, details are available in below link =
[Old release version details are available here](https://www.pnfpb.com/release-notes-pnfpb-plugin-push-notification-for-post-and-buddypress/)


== Upgrade Notice ==
* New feature: New admin settings field added for number of days to show custom prompt for push notification again for front end users who cancels push notification in custom prompt.
PWA New feature: New admin settings field added for number of days to show PWA custom prompt for push notification again for front end users who cancels push notification in PWA custom prompt.
* Update: Removed please wait processing message while subscribing notification.
* Update: Optimized subscription of push notifications from custom prompt/bell icons.
* Bug fix: Fix problems related to browser check logic to be compatible with Elementor and other plugins
* Bug fix: Fixed problems related to duplicate notification for my comments push notifications
* Update: PWA cache will not be enabled automatically, unless exclude all urls in PWA settings field set to OFF manually.
* Bug fix: Resolved problem related to threadid(private messages),click url fields for webview app push notification - friendship request,accepted,private messages.
* New feature: Various Subscription options are included in custom prompt, bell icon while subscribing for push notification first time. Users will be able to select subscription options while subscribing for the first time from custom prompt/bell icon. From bell icon, front end users will be able to modify subscription options whenever it is needed. Subscription option can be turned on/off to include/exclude in custom prompt or in bell icon from admin settings.
* Bug fix: Removed unwanted console messages in mobile webview javascripts.
* New feature: Included [group name] place holder for group title push notification.
* New feature: If Buddypress followers plugin installed then notification can be sent only to followers for buddypress activities/group activities/comments.
* Bug fix for webview mobile app: Fixed problems related to android/ios mobile app push notification subscription option update to database, saving front end subscription options in webview app.
* Bug fix for Firebase httpv1 version: Fixed problem in admin settings on uploading service account json file to enable firebase httpv1 version api independent of other firebase settings.
* Bug fix for BuddyBoss users: Updated logic to send notifications for activity comments only to liked users for particular activity.
* Bug fix for BuddyBoss users: Updated logic in group forum activities to send notifications only for subscribed users for particular forum.
* Bug fix for onesignal users: Updated logic to control onesignal push notifications based on admin options enabled for various push notifications in plugin admin page. 
* New feature: New custom prompt styles introduced to display prompt in horizontal pattern, vertical pattern to subscribe push notifications. 
Customization of prompt is available in admin settings of custom prompt. Bell icon prompt will work with or without custom prompt.
[Old release version details are available here](https://www.pnfpb.com/release-notes-pnfpb-plugin-push-notification-for-post-and-buddypress/)