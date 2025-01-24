<?php
/*
* Firebase, Onesignal, Progressier and webtoapp configuration settings fields for push notification
* @Since 2.08
*/
?>
<h2 class="pnfpb_ic_push_settings_header2">
<?php echo esc_html(
    __(
        "Use Firebase (or) Onesignal (or) Progressier (and / or) webtoapp.design as push notification provider",
        "push-notification-for-post-and-buddypress"
    )
); ?>
</h2>
<p>
<?php echo esc_html(
    __(
        "webtoapp.design push notification is for Android/IOS mobile app, if webtoapp.design push notifications is enabled then it will also work along with Firebase/Onesignal notifications by enabling Firebase/Onesignal along with webtoapp.design to send notifications to desktop also to mobile app generated from webtoapp.design",
        "push-notification-for-post-and-buddypress"
    )
); ?>
</p>
<div class="pnfpb_column_full">
<button type="button" 
        class="pnfpb_ic_firebase_configuration_help_button" 
        onclick="toggle_firebase_configuration_help()">
    <?php echo esc_html(__("Tutorial on Firebase", "push-notification-for-post-and-buddypress")); ?>
</button>
</div>
<div class="pnfpb_ic_firebase_configuration_help">
<a href="https://www.youtube.com/watch?v=02oymYLt3qo" target="_blank">
    <?php echo esc_html(
         __(
             "Watch this tutorial on Firebase settings and configuration",
             "push-notification-for-post-and-buddypress"
         )
     ); ?>
</a>
<ul>
    <li>
        <?php echo esc_html(
              __(
                  "Sign in to Firebase, then open your project, click settings icon & select Project settings",
                  "push-notification-for-post-and-buddypress"
              )
          ); ?>
    </li>
    <li>
        <?php echo esc_html(
              __(
              "To get Firebase server key (for field 1 in admin firebase settings)",
              "push-notification-for-post-and-buddypress"
              )
          ); ?>
    </li>
    <li>
        <?php echo esc_html(
              __(
              "project settings > cloud messaging tab > get server key or add server key button to get server key",
              "push-notification-for-post-and-buddypress"
              )
          ); ?>
    </li>
    <li>
        <?php echo esc_html(
              __(
              "To get Firebase config fields (for fields 2 to 8 in admin firebase settings)",
              "push-notification-for-post-and-buddypress"
              )
          ); ?>
    </li>
    <li>
        <?php echo esc_html(
              __(
              "If you do not have web app, Create a new web app. After creating a new app, it will show firebase config fields",
              "push-notification-for-post-and-buddypress"
              )
          ); ?>
    </li>
    <li>
        <?php echo esc_html(
              __(
              "Project settings > General under your apps section > click on config button to view configuration fields",
              "push-notification-for-post-and-buddypress"
              )
          ); ?>
    </li> 
    <li>
        <?php echo esc_html(
              __(
                  "To get Firebase public key (for field 9 in admin firebase settings)",
                  "push-notification-for-post-and-buddypress"
              )
          ); ?>
    </li>
    <li>
        <?php echo esc_html(
              __(
                  "Open the Cloud Messaging tab of the Firebase console Settings pane and scroll to the Web configuration section",
                  "push-notification-for-post-and-buddypress"
              )
          ); ?>
    </li>
    <li><?php echo esc_html(
  __(
      "project settings > cloud messaging tab > Under web push certificates > Generate key pair to get public key",
      "push-notification-for-post-and-buddypress"
  )
); ?></li>
    <li><?php echo esc_html(
  __(
      "In the Web Push certificates tab, click Generate Key Pair. The console displays a notice that the key pair was generated, and displays the public key string and date added",
      "push-notification-for-post-and-buddypress"
  )
); ?></li>
    <li><?php echo esc_html(
  __(
      "If you already Generated key pair then no need to generate it again",
      "push-notification-for-post-and-buddypress"
  )
); ?></li>
    <li><?php echo esc_html(
  __(
      "After saving below fields, you will get browser prompt asking to allow notification for this website, click on allow notification",
      "push-notification-for-post-and-buddypress"
  )
); ?></li>
    <li><?php echo esc_html(
  __(
      "After completing above steps, push notification will work based on option selected for posts/buddypress",
      "push-notification-for-post-and-buddypress"
  )
); ?></li>
</ul>
</div>
<div class="pnfpb_column_full">
<button type="button" class="pnfpb_ic_firebase_configuration_button" 
    onclick="toggle_firebase_configuration()">
    <?php echo esc_html(
           __("Firebase configuration", "push-notification-for-post-and-buddypress")
       ); ?>
</button>
<button type="button" class="pnfpb_ic_or_button">
    <?php echo esc_html(
           __(" (or) ", "push-notification-for-post-and-buddypress")
           ); 
    ?>
</button>
<button type="button" 
    class="pnfpb_ic_onesignal_configuration_button" 
    onclick="toggle_onesignal_configuration()">
    <?php echo esc_html(
           __(
               "Onesignal configuration",
               "push-notification-for-post-and-buddypress"
           )
       ); ?>
</button>
<button type="button" class="pnfpb_ic_or_button">
    <?php echo esc_html(
           __(" (or) ", "push-notification-for-post-and-buddypress")
       ); ?>
</button>
<button type="button" class="pnfpb_ic_progressier_configuration_button" 
    onclick="toggle_progressier_configuration()">
    <?php echo esc_html(
           __(
               "Progressier configuration",
               "push-notification-for-post-and-buddypress"
           )
       ); ?>
</button>
<button type="button" class="pnfpb_ic_or_button">
    <?php echo esc_html(
           __(" (and / or) ", "push-notification-for-post-and-buddypress")
           ); ?>
</button>
<button type="button" class="pnfpb_ic_webtoapp_configuration_button" 
    onclick="toggle_webtoapp_configuration()">
    <?php echo esc_html(
           __(
               "Webtoapp.design configuration",
               "push-notification-for-post-and-buddypress"
           )
       ); ?>
</button>
</div>
<div class="pnfpb_ic_firebase_configuration">
<p>
    <?php echo esc_html(
    __(
        "If Firebase is used for push notification then for Firebase configuration",
        "push-notification-for-post-and-buddypress"
    )
    ); ?>
    <b>
        <?php echo esc_html(__("all fields are required except database url. Please follow above tutorial for configuration","push-notification-for-post-and-buddypress")); ?>
    </b>
</p>			
<table class="pnfpb_ic_push_firebase_settings_table widefat fixed">
    <tbody>
        <tr  class="pnfpb_ic_push_settings_table_row">
            <td class="pnfpb_ic_push_settings_table_label_column column-columnname">
                <label for="pnfpb_ic_fcm_api">
                    <?php echo esc_html(
                    __(
                        "Firebase API Key",
                        "push-notification-for-post-and-buddypress"
                    )
                    ); ?>
                </label>
                <br/>
                <input class="pnfpb_ic_push_settings_table_value_column_input_field" 
                    id="pnfpb_ic_fcm_api" 
                    name="pnfpb_ic_fcm_api" 
                    type="text" 
                    value="<?php echo esc_attr(
                        get_option("pnfpb_ic_fcm_api")
                    ); ?>" 
                />
            </td>
        </tr>
           <tr class="pnfpb_ic_push_settings_table_row">
            <td class="pnfpb_ic_push_settings_table_label_column column-columnname">
                <label for="pnfpb_ic_fcm_authdomain">
                    <?php echo esc_html(
                        __(
                            "Firebase Auth domain",
                            "push-notification-for-post-and-buddypress"
                        )
                    ); ?>
                </label>
                <br/>
                <input class="pnfpb_ic_push_settings_table_value_column_input_field" 
                    id="pnfpb_ic_fcm_authdomain" 
                    name="pnfpb_ic_fcm_authdomain" 
                    type="text" 
                    value="<?php echo esc_attr(
                        get_option("pnfpb_ic_fcm_authdomain")
                    ); ?>" 
                />
            </td>
        </tr>
           <tr class="pnfpb_ic_push_settings_table_row">
            <td class="pnfpb_ic_push_settings_table_label_column column-columnname">
                <label for="pnfpb_ic_fcm_databaseurl">
                    <?php echo esc_html(
                        __(
                            "Firebase Database url (optional)",
                            "push-notification-for-post-and-buddypress"
                        )
                    ); ?>
                </label>
                <br/>
                <input class="pnfpb_ic_push_settings_table_value_column_input_field" 
                    id="pnfpb_ic_fcm_databaseurl" 
                    name="pnfpb_ic_fcm_databaseurl" 
                    type="text" value="<?php echo esc_attr(
                        get_option("pnfpb_ic_fcm_databaseurl")
                    ); ?>" 
                />
            </td>
        </tr>
           <tr class="pnfpb_ic_push_settings_table_row">
            <td class="pnfpb_ic_push_settings_table_label_column column-columnname">
                <label for="pnfpb_ic_fcm_projectid">
                    <?php echo esc_html(
                        __(
                            "Firebase Project id",
                            "push-notification-for-post-and-buddypress"
                        )
                    ); ?>
                </label>
                <br/>
                <input class="pnfpb_ic_push_settings_table_value_column_input_field"  
                    id="pnfpb_ic_fcm_projectid" 
                    name="pnfpb_ic_fcm_projectid" 
                    type="text" value="<?php echo esc_attr(
                            get_option("pnfpb_ic_fcm_projectid")
                    ); ?>" 
                />
            </td>
            </tr>
            <tr class="pnfpb_ic_push_settings_table_row">
                <td class="pnfpb_ic_push_settings_table_label_column column-columnname">
                    <label for="pnfpb_ic_fcm_storagebucket">
                        <?php echo esc_html(
                            __(
                                "Firebase Storage Bucket",
                                "push-notification-for-post-and-buddypress"
                            )
                        ); ?>
                    </label>
                    <br/>
                    <input class="pnfpb_ic_push_settings_table_value_column_input_field"  
                        id="pnfpb_ic_fcm_storagebucket" 
                        name="pnfpb_ic_fcm_storagebucket" 
                        type="text" 
                        value="<?php echo esc_attr(
                            get_option("pnfpb_ic_fcm_storagebucket")
                        ); ?>" 
                    />
                </td>
                </tr>
            <tr class="pnfpb_ic_push_settings_table_row">
                <td class="pnfpb_ic_push_settings_table_label_column column-columnname">
                    <label for="pnfpb_ic_fcm_messagingsenderid">
                        <?php echo esc_html(
                            __(
                                "Firebase Messaging Sender id",
                                "push-notification-for-post-and-buddypress"
                            )
                        ); ?>
                    </label>
                    <br/>
                    <input class="pnfpb_ic_push_settings_table_value_column_input_field"  
                    id="pnfpb_ic_fcm_messagingsenderid" 
                    name="pnfpb_ic_fcm_messagingsenderid" 
                    type="text" value="<?php echo esc_attr(
                        get_option("pnfpb_ic_fcm_messagingsenderid")
                    ); ?>" />
                </td>
            </tr>
            <tr class="pnfpb_ic_push_settings_table_row">
                <td class="pnfpb_ic_push_settings_table_label_column column-columnname">
                    <label for="pnfpb_ic_fcm_appid">
                        <?php echo esc_html(
                            __(
                                    "Firebase App id",
                                "push-notification-for-post-and-buddypress"
                            )
                        ); ?>
                    </label>
                    <br/>
                    <input class="pnfpb_ic_push_settings_table_value_column_input_field" 
                    id="pnfpb_ic_fcm_appid" 
                    name="pnfpb_ic_fcm_appid" 
                    type="text" value="<?php echo esc_attr(
                        get_option("pnfpb_ic_fcm_appid")
                    ); ?>" />
                </td>
            </tr>
            <tr class="pnfpb_ic_push_settings_table_row">
                <td class="pnfpb_ic_push_settings_table_label_column column-columnname">
                    <label for="pnfpb_ic_fcm_publickey">
                        <?php echo esc_html(
                        __(
                                "Firebase Web Push certificate (from cloudmessaging tab in Firebase console)",
                            "push-notification-for-post-and-buddypress"
                        )
                        ); ?>
                    </label>
                    <br/>
                    <input class="pnfpb_ic_push_settings_table_value_column_input_field" 
                    id="pnfpb_ic_fcm_publickey" 
                    name="pnfpb_ic_fcm_publickey" 
                    type="text" value="<?php echo esc_attr(
                        get_option("pnfpb_ic_fcm_publickey")
                    ); ?>" />
                </td>
            </tr>
            <tr class="pnfpb_ic_push_settings_table_row">
                <td class="pnfpb_ic_push_settings_table_label_column column-columnname">
                    <label for="pnfpb_ic_fcm_upload_icon">
                        <?php echo esc_html(
                            __(
                                "FCM Push Icon(16x16 pixels)",
                                "push-notification-for-post-and-buddypress"
                            )
                        ); ?>
                    </label>
                    <br/>          
                    <table>
                        <tr>
                            <td class="column-columnname">
                                <input type="button" value="<?php echo esc_attr(
                                    __(
                                           "Upload Icon",
                                        "push-notification-for-post-and-buddypress"
                                        )
                                    ); ?>" id="pnfpb_ic_fcm_upload_button" class="pnfpb_ic_push_settings_upload_icon" />
                                    <input type="hidden" id="pnfpb_ic_fcm_upload_icon" 
                                    name="pnfpb_ic_fcm_upload_icon" 
                                    value="<?php echo esc_attr(
                                        get_option("pnfpb_ic_fcm_upload_icon")
                                    ); ?>" 
                                />
                            </td>
                        </tr>
                        <tr>
                            <td class="column-columnname">
                                <div style="display:block;width:100%; overflow:hidden; text-align:center;">
                                    <div id="pnfpb_ic_fcm_upload_preview" style="background-image: url(<?php echo esc_url(
                            get_option("pnfpb_ic_fcm_upload_icon")
                        ); ?>);width:32px; height:32px;overflow:hidden;border-radius:50%;margin:20px auto;background-position:center center;background-repeat:no-repeat;background-size:cover;">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>				
          </tbody>
    </table>
</div>		
<div class="pnfpb_ic_onesignal_configuration">
    <h3>
        <?php echo esc_html(
               __(
                   "Onesignal push notification configuration",
                   "push-notification-for-post-and-buddypress"
               )
           ); ?>	
    </h3>
    <p>
        <?php echo esc_html(
               __(
                   "If Onesignal is enabled then, <b>it requires onesignal wordpress plugin installed and activated with required configuration</b>",
                   "push-notification-for-post-and-buddypress"
               )
           ); ?>
    </p>		
    <p>
        <?php echo esc_html(
               __(
               "(Either Firebase or Onesignal or Progressier can be used as push notification provider. If onesignal is enabled then Firebase & Progressier will be disabled.<br/>It requires onesignal WordPress plugin installed with required configuration )",
               "push-notification-for-post-and-buddypress"
               )
           ); ?>
    </p>		
    <table class="pnfpb_ic_push_notification_settings_table widefat fixed" cellspacing="0">
        <tbody>
            <tr class="pnfpb_ic_push_settings_table_row">
                <td class="pnfpb_ic_push_settings_table_column column-columnname">
                    <div class="pnfpb_row">
                        <div class="pnfpb_column_400">
                            <div class="pnfpb_card">
                                <label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_onesignal_push">
                                    <label class="pnfpb_switch">
                                        <input  id="pnfpb_onesignal_push" 
                                               name="pnfpb_onesignal_push" 
                                               type="checkbox" 
                                               value="1" <?php checked(
                                                       "1",
                                                       get_option("pnfpb_onesignal_push")
                                                   ); ?>  
                                        />
                                        <span class="pnfpb_slider round"></span>
                                    </label>
                                    <?php echo esc_html(
                                               __(
                                                   "Use ONESIGNAL to send PUSH notification instead of FIREBASE",
                                                   "push-notification-for-post-and-buddypress"
                                               )); 
                                    ?>
                                </label>
                            </div>
                            <div>
                                <?php echo esc_html(
                                     __(
                                         "If enabled, it will use onesignal to send push notification provided ONESIGNAL Push notification installed and activated in your site. It will take onesignal credentials entered in ONESIGNAL push notification plugin",
                                         "push-notification-for-post-and-buddypress"
                                     )
                                 ); ?>								
                            </div>						
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="pnfpb_ic_progressier_configuration">
    <h3>
        <?php echo esc_html(
               __(
                   "Progressier push notification configuration",
                   "push-notification-for-post-and-buddypress"
               )
           ); ?>	
    </h3>
    <p>
        <?php echo esc_html(
           __(
               "If Progressier is enabled then, <b>it requires Progressier api key from your Progressier account</b>",
               "push-notification-for-post-and-buddypress"
           )
           ); ?>
    </p>		
    <p>
        <?php echo esc_html(
           __(
              "(Either Firebase or Onesignal or Progressier can be used as push notification provider. If Progressier is enabled then Firebase & Onesignal will be disabled)",
               "push-notification-for-post-and-buddypress"
           )
       ); ?>
    </p>		
    <table class="pnfpb_ic_push_notification_settings_table widefat fixed" cellspacing="0">
        <tbody>
            <tr class="pnfpb_ic_push_settings_table_row">
                <td class="pnfpb_ic_push_settings_table_column column-columnname">
                    <div class="pnfpb_row">
                        <div class="pnfpb_column_400">
                            <div class="pnfpb_card">
                                <label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_onesignal_push">
                                    <label class="pnfpb_switch">
                                        <input  id="pnfpb_progressier_push" 
                                               name="pnfpb_progressier_push" 
                                               type="checkbox" 
                                               value="1" <?php checked(
                                                       "1",
                                                       get_option("pnfpb_progressier_push")
                                           ); ?>  />
                                        <span class="pnfpb_slider round"></span>
                                    </label>
                                    <?php echo esc_html(
                                           __(
                                               "Use Progressier to send PUSH notification instead of FIREBASE",
                                               "push-notification-for-post-and-buddypress"
                                           )
                                       ); ?>
                                </label>
                            </div>
                            <div>
                                <?php echo esc_html(
                                     __(
                                     "If enabled, it will use Progressier to send push notification. Progressier notification has limited features",
                                     "push-notification-for-post-and-buddypress"
                                     )
                                 ); ?>
                                <br />
                                <?php echo esc_html(
                                     __(
                                         "Post, Custom post types, BuddyPress Activities, Group activities, Private message, Friendship request/accept and Front end BuddyPress notification settings are available for Progressier push notification",
                                         "push-notification-for-post-and-buddypress"
                                     )
                                 ); ?>
                                <br />
                            </div>						
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="pnfpb_ic_push_settings_table_row">
                <td class="pnfpb_ic_push_settings_table_label_column column-columnname">
                    <label for="pnfpb_ic_fcm_progressier_api_key">
                        <?php echo esc_html(
                              __("Progressier API key", "push-notification-for-post-and-buddypress")
                          ); ?>
                    </label>
                    <br/>
                    <input class="pnfpb_ic_push_settings_table_value_column_input_field"  
                           id="pnfpb_ic_fcm_progressier_api_key" 
                           name="pnfpb_ic_fcm_progressier_api_key" 
                           type="text" 
                           value="<?php echo esc_attr(
                                  get_option("pnfpb_ic_fcm_progressier_api_key")
                              ); ?>" 
                    />
                </td>
            </tr>
            <tr class="pnfpb_ic_push_settings_table_row">
                <td class="pnfpb_ic_push_settings_table_label_column column-columnname">
                    <div class="pnfpb_column_full">
                        <?php echo esc_html(
                               __(
                                   "Custom bell prompt, renotify, replace notification and notification only for logged in users options are not available for Progressier",
                                   "push-notification-for-post-and-buddypress"
                               )
                           ); ?>
                        <br />
                        <?php echo esc_html(
                               __(
                                   "New member joined, Group details update, Group invitation, Avatar change, Cover image change notification are not available for Progressier",
                                   "push-notification-for-post-and-buddypress"
                               )
                           ); ?>	
                    </div>					
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="pnfpb_ic_webtoapp_configuration">
    <h3>
        <?php echo esc_html(
               __(
                   "Webtoapp.design push notification configuration",
                   "push-notification-for-post-and-buddypress"
               )
           ); ?>	
    </h3>
    <p>
        <?php echo esc_html(
               __(
                   "If Webtoapp.design is enabled then, <b>it requires webtoapp api key from your webtoapp.design account</b>",
                   "push-notification-for-post-and-buddypress"
               )
           ); ?>
    </p>
    <p>
        <?php echo esc_html(
               __(
                   "Get webtoapp.design API key here",
                   "push-notification-for-post-and-buddypress"
               )
           ); ?>
    </p>
    <p>
        <?php echo esc_html(
              __(
                  "<b>webtoapp.design</b> push notification is for Android/IOS mobile app, if webtoapp.design push notifications is enabled then it will also work along with Firebase/Onesignal notifications by enabling Firebase/Onesignal along with webtoapp.design to send notifications to desktop also to mobile app generated from webtoapp.design",
              "push-notification-for-post-and-buddypress"
              )
          ) ; ?>
    </p>		
    <table class="pnfpb_ic_push_notification_settings_table widefat fixed" cellspacing="0">
        <tbody>
            <tr class="pnfpb_ic_push_settings_table_row">
                <td class="pnfpb_ic_push_settings_table_column column-columnname">
                    <div class="pnfpb_row">
                        <div class="pnfpb_column_400">
                            <div class="pnfpb_card">
                                <label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_onesignal_push">
                                    <label class="pnfpb_switch">
                                        <input  id="pnfpb_webtoapp_push" 
                                               name="pnfpb_webtoapp_push" 
                                               type="checkbox" 
                                               value="1" <?php checked(
                                                       "1",
                                                       get_option("pnfpb_webtoapp_push")
                                               ); ?>  
                                        />
                                        <span class="pnfpb_slider round"></span>
                                    </label>
                                        <?php echo esc_html(
                                               __(
                                                   "Use Webtoapp.design to send PUSH notification",
                                                   "push-notification-for-post-and-buddypress"
                                               )
                                           ); ?>
                                </label>
                            </div>
                            <div>
                                <?php echo esc_html(
                                     __(
                                         "If enabled, it will use Webtoapp.design to send push notification",
                                         "push-notification-for-post-and-buddypress"
                                     )
                                 ); ?>
                                <br />
                                <?php echo esc_html(
                                     __(
                                         "Post, Custom post types, BuddyPress Activities, Group activities, Private message, Friendship request/accept and Front end BuddyPress notification settings are available for Webtoapp.design push notification",
                                         "push-notification-for-post-and-buddypress"
                                     )
                                 ); ?>
                                <br />
                            </div>						
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="pnfpb_ic_push_settings_table_row">
                <td class="pnfpb_ic_push_settings_table_label_column column-columnname">
                    <label for="pnfpb_ic_fcm_webtoapp_api_key">
                        <?php echo esc_html(
                              __(
                                  "Webtoapp.design API key",
                                  "push-notification-for-post-and-buddypress"
                              )
                          ); ?></label>
                    <br/>
                    <input class="pnfpb_ic_push_settings_table_value_column_input_field"  
                           id="pnfpb_ic_fcm_webtoapp_api_key" 
                           name="pnfpb_ic_fcm_webtoapp_api_key" 
                           type="text" 
                           value="<?php echo esc_attr(
                                  get_option("pnfpb_ic_fcm_webtoapp_api_key")
                          ); ?>" 
                    />
                </td>
            </tr>
            <tr class="pnfpb_ic_push_settings_table_row">
                <td class="pnfpb_ic_push_settings_table_label_column column-columnname">
                    <div class="pnfpb_column_full">
                        <?php echo esc_html(
                               __(
                                   "Custom bell prompt, renotify, replace notification and notification only for logged in users options are not available for webtoapp",
                                   "push-notification-for-post-and-buddypress"
                               )
                           ); ?>
                        <br />
                        <?php echo esc_html(
                               __(
                                   "New member joined, Group details update, Group invitation, Avatar change, Cover image change notification are not available for webtoapp",
                                   "push-notification-for-post-and-buddypress"
                               )
                           ); ?>	
                    </div>					
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="pnfpb_column_full">
	<?php submit_button(
     	__("Save changes", "push-notification-for-post-and-buddypress"),
     	"pnfpb_ic_push_save_configuration_button"
 	); ?>
</div>