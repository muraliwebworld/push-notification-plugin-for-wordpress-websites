<?php
if (!class_exists("WP_List_Table")) {
    require_once ABSPATH . "wp-admin/includes/class-wp-list-table.php";
}

// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

if (!class_exists("PNFPB_ICFM_onetime_push_notifications_List")) {
    class PNFPB_ICFM_onetime_push_notifications_List extends WP_List_Table
    {
        public $pre_name = "PNFPB_onetime_";

        private $table_data;

        /** Class constructor */
        public function __construct()
        {
            parent::__construct([
                "singular" => __(
                    "PushNotification",
                    "push-notification-for-post-and-buddypress"
                ), //singular name of the listed records
                "plural" => __(
                    "PushNotifications",
                    "push-notification-for-post-and-buddypress"
                ), //plural name of the listed records
                "ajax" => false, //does this table support ajax?
            ]);
        }

        /**
         * Retrieve Device tokens data from the database
         *
         * @param int $per_page
         * @param int $page_number
         *
         * @return mixed
         */
        public static function get_pushnotifications(
            $per_page = 20,
            $page_number = 1,
            $search = "",
            $schedule_type = "",
            $schedule_status = ""
        ) {
            global $wpdb;
            if (
                !empty($search) &&
                is_numeric($search) &&
                $schedule_type === ""
            ) {
                $sql = "SELECT * FROM {$wpdb->prefix}pnfpb_ic_schedule_push_notifications WHERE title = {$search} OR content LIKE '%{$search}%'";
            } else {
                if (
                    !empty($search) &&
                    !is_numeric($search) &&
                    $schedule_type === ""
                ) {
                    $sql = "SELECT * FROM {$wpdb->prefix}pnfpb_ic_schedule_push_notifications WHERE title LIKE '%{$search}%' OR content LIKE '%{$search}%'";
                } else {
                    if ($schedule_type != "" && $search != "") {
                        $sql = "SELECT * FROM {$wpdb->prefix}pnfpb_ic_schedule_push_notifications WHERE scheduled_type LIKE '%{$schedule_type}%' OR title LIKE '%{$search}%' OR content LIKE '%{$search}%'";
                    } else {
                        if ($schedule_type != "" && $search === "") {
                            $sql = "SELECT * FROM {$wpdb->prefix}pnfpb_ic_schedule_push_notifications WHERE scheduled_type LIKE '%{$schedule_type}%'";
                        } else {
                            if ($schedule_status != "") {
                                if ($schedule_status === "complete") {
                                    $sql = "SELECT {$wpdb->prefix}pnfpb_ic_schedule_push_notifications.id,{$wpdb->prefix}pnfpb_ic_schedule_push_notifications.action_scheduler_id,{$wpdb->prefix}pnfpb_ic_schedule_push_notifications.title,{$wpdb->prefix}pnfpb_ic_schedule_push_notifications.content,{$wpdb->prefix}pnfpb_ic_schedule_push_notifications.image_url,{$wpdb->prefix}pnfpb_ic_schedule_push_notifications.click_url,{$wpdb->prefix}pnfpb_ic_schedule_push_notifications.scheduled_timestamp,{$wpdb->prefix}pnfpb_ic_schedule_push_notifications.scheduled_type,{$wpdb->prefix}pnfpb_ic_schedule_push_notifications.status FROM {$wpdb->prefix}pnfpb_ic_schedule_push_notifications,{$wpdb->prefix}actionscheduler_actions WHERE {$wpdb->prefix}actionscheduler_actions.args LIKE CONCAT('%', {$wpdb->prefix}pnfpb_ic_schedule_push_notifications.action_scheduler_id,',',{$wpdb->prefix}pnfpb_ic_schedule_push_notifications.id, '%') AND {$wpdb->prefix}actionscheduler_actions.status LIKE '%{$schedule_status}%' AND NOT EXISTS (SELECT * FROM {$wpdb->prefix}actionscheduler_actions
                    WHERE {$wpdb->prefix}actionscheduler_actions.args LIKE CONCAT('%', {$wpdb->prefix}pnfpb_ic_schedule_push_notifications.action_scheduler_id,',',{$wpdb->prefix}pnfpb_ic_schedule_push_notifications.id, '%') AND {$wpdb->prefix}actionscheduler_actions.status LIKE '%pending%' ) ";
                                } else {
                                    $sql = "SELECT {$wpdb->prefix}pnfpb_ic_schedule_push_notifications.id,{$wpdb->prefix}pnfpb_ic_schedule_push_notifications.action_scheduler_id,{$wpdb->prefix}pnfpb_ic_schedule_push_notifications.title,{$wpdb->prefix}pnfpb_ic_schedule_push_notifications.content,{$wpdb->prefix}pnfpb_ic_schedule_push_notifications.image_url,{$wpdb->prefix}pnfpb_ic_schedule_push_notifications.click_url,{$wpdb->prefix}pnfpb_ic_schedule_push_notifications.scheduled_timestamp,{$wpdb->prefix}pnfpb_ic_schedule_push_notifications.scheduled_type,{$wpdb->prefix}pnfpb_ic_schedule_push_notifications.status FROM {$wpdb->prefix}pnfpb_ic_schedule_push_notifications,{$wpdb->prefix}actionscheduler_actions WHERE {$wpdb->prefix}actionscheduler_actions.args LIKE CONCAT('%', {$wpdb->prefix}pnfpb_ic_schedule_push_notifications.action_scheduler_id,',',{$wpdb->prefix}pnfpb_ic_schedule_push_notifications.id, '%') AND {$wpdb->prefix}actionscheduler_actions.status LIKE '%{$schedule_status}%'";
                                }
                            } else {
                                $sql = "SELECT * FROM {$wpdb->prefix}pnfpb_ic_schedule_push_notifications";
                            }
                        }
                    }
                }
            }

            if (!empty($_REQUEST["orderby"])) {
                $sql .= " ORDER BY " . esc_sql($_REQUEST["orderby"]);
                $sql .= !empty($_REQUEST["order"])
                    ? " " . esc_sql($_REQUEST["order"])
                    : " ASC";
            }

            if ($per_page > 0) {
                $sql .= " LIMIT $per_page";
                $sql .= " OFFSET " . ($page_number - 1) * $per_page;
            }

            $result = $wpdb->get_results($sql, "ARRAY_A");

            return $result;
        }

        public function PNFPB_onetime_push_notifications_list_add_column(
            $columns
        ) {
            $columns["action"] = "Action";

            return $columns;
        }

        /**
         * Delete a customer record.
         *
         * @param int $id device token ID
         */
        public static function delete_pushnotification(
            $id,
            $onetime_push_action_scheduler_id,
            $onetime_push_timestamp,
            $onetime_push_status
        ) {
            global $wpdb;

            $wpdb->delete(
                "{$wpdb->prefix}pnfpb_ic_schedule_push_notifications",

                ["id" => $id],

                ["%d"]
            );

            $selected_day_push_notification_cancel = date(
                "Y/m/d H:i:s",
                $onetime_push_timestamp
            );

            $pnfpb_selected_datetime_notification_cancel = new DateTime(
                $selected_day_push_notification_cancel,
                new DateTimeZone(wp_timezone_string())
            );

            $pnfpb_selected_datetime_notification_cancel = $pnfpb_selected_datetime_notification_cancel->setTimezone(
                new DateTimeZone("UTC")
            );

            $selected_recurring_schedule_formatted_notification_db = strtotime(
                $pnfpb_selected_datetime_notification_cancel->format(
                    "Y-m-d H:i:s"
                )
            );

            if ($onetime_push_action_scheduler_id != null) {
                as_unschedule_all_actions(
                    "PNFPB_ondemand_schedule_push_notification_hook",
                    [
                        $selected_recurring_schedule_formatted_notification_db,
                        $id,
                        "recurring",
                        $onetime_push_status,
                    ]
                );
            }
        }

        /**
         * Returns the count of records in the database.
         *
         * @return null|string
         */
        public static function record_count()
        {
            global $wpdb;

            $sql = "SELECT COUNT(*) FROM {$wpdb->prefix}pnfpb_ic_schedule_push_notifications";

            return $wpdb->get_var($sql);
        }

        /** Text displayed when no device token data is available */
        public function no_items()
        {
            esc_html_e(
                "No one time or scheduled push notifications sent",
                "push-notification-for-post-and-buddypress"
            );
        }

        /**
         * Render a column when no column specific method exist.
         *
         * @param array $item
         * @param string $column_name
         *
         * @return mixed
         */
        public function column_default($item, $column_name)
        {
            switch ($column_name) {
                case "id":
                case "title":
                case "content":
                    return $item[$column_name];
                case "image_url":
                    if ($item[$column_name] != "") {
                        $imgurl =
                            '<img src="' .
                            $item[$column_name] .
                            '" width="30px" height="30px" />';
                    } else {
                        $imgurl = "";
                    }
                    return $imgurl;
                case "click_url":
                    return $item[$column_name];
                case "scheduled_timestamp":
                    return date("Y/m/d H:i:s", $item[$column_name]);
                case "scheduled_type":
                case "status":
                case "action":
                    return $item[$column_name];
                default:
                    return print_r($item, true); //Show the whole array for troubleshooting purposes
            }
        }

        function column_scheduled_type($item)
        {
            $scheduled_type = $item["scheduled_type"];

            if ($item["scheduled_type"] === "onetime") {
                $scheduled_type = "On demand";
            }

            if ($item["scheduled_type"] === "single") {
                $scheduled_type = "One time schedule";
            }

            if ($item["scheduled_type"] === "recurring") {
                $scheduled_type = "Recurring schedule";
            }

            return $scheduled_type;
        }

        function column_scheduled_timestamp($item)
        {
            global $wpdb;

            $pnfpb_selected_datetime_ondemand = new DateTime();

            $pnfpb_selected_datetime_ondemand->setTimestamp(
                $item["scheduled_timestamp"]
            );

            $pnfpb_selected_datetime_ondemand->setTimezone(
                new DateTimeZone(wp_timezone_string())
            );

            $recurring_status =
                $pnfpb_selected_datetime_ondemand->format("Y-m-d H:i:s") .
                wp_kses_post(
                    __(
                        "<br/>(Local time)",
                        "push-notification-for-post-and-buddypress"
                    )
                );

            if (
                strtolower($item["status"]) !== "draft" &&
                $item["status"] !== "sent" &&
                $item["scheduled_type"] !== "onetime" &&
                $item["scheduled_type"] !== null
            ) {
                try {
                    if ($item["scheduled_type"] !== "recurring") {
                        $pnfpb_selected_datetime_onetime = new DateTime();

                        $pnfpb_selected_datetime_onetime->setTimestamp(
                            $item["action_scheduler_id"]
                        );

                        $pnfpb_selected_datetime_onetime->setTimezone(
                            new DateTimeZone(wp_timezone_string())
                        );

                        $recurring_status =
                            wp_kses_post(
                                __(
                                    "In Queue, scheduled for <br/>",
                                    "push-notification-for-post-and-buddypress"
                                )
                            ) .
                            $pnfpb_selected_datetime_onetime->format(
                                "Y-m-d H:i:s"
                            ) .
                            wp_kses_post(
                                __(
                                    "<br/>(Local time)",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                    } else {
                        $recurring_status = "In Queue";
                    }

                    $sql = "SELECT {$wpdb->prefix}actionscheduler_actions.scheduled_date_gmt FROM {$wpdb->prefix}pnfpb_ic_schedule_push_notifications,{$wpdb->prefix}actionscheduler_actions WHERE {$wpdb->prefix}actionscheduler_actions.args LIKE CONCAT('%', {$item["action_scheduler_id"]},',',{$item["id"]}, '%') AND {$wpdb->prefix}actionscheduler_actions.status LIKE '%complete%'";

                    if (!empty($_REQUEST["orderby"])) {
                        $sql .= " ORDER BY " . esc_sql($_REQUEST["orderby"]);
                        $sql .= !empty($_REQUEST["order"])
                            ? " " . esc_sql($_REQUEST["order"])
                            : " DESC";
                    }

                    $sql .= " LIMIT 1";

                    $result = $wpdb->get_results($sql, "ARRAY_A");

                    if (
                        count($result) > 0 &&
                        isset($result[0]["scheduled_date_gmt"])
                    ) {
                        $pnfpb_selected_datetime = new DateTime(
                            $result[0]["scheduled_date_gmt"],
                            new DateTimeZone("UTC")
                        );

                        $pnfpb_selected_datetime->setTimezone(
                            new DateTimeZone(wp_timezone_string())
                        );

                        $recurring_status =
                            $pnfpb_selected_datetime->format("Y-m-d H:i:s") .
                            wp_kses_post(
                                __(
                                    "<br/>(Local time)",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                    }
                } catch (Exception $e) {
                    error_log(serialize($e));
                }
            }
            return $recurring_status;
        }

        function column_status($item)
        {
            global $wpdb;

            $recurring_status = $item["status"];

            if ($item["scheduled_type"] === "recurring") {
                try {
                    $recurring_status = "In Queue";

                    $sql = "SELECT {$wpdb->prefix}actionscheduler_actions.scheduled_date_gmt FROM {$wpdb->prefix}pnfpb_ic_schedule_push_notifications,{$wpdb->prefix}actionscheduler_actions WHERE {$wpdb->prefix}actionscheduler_actions.args LIKE CONCAT('%', {$item["action_scheduler_id"]},',',{$item["id"]}, '%') AND {$wpdb->prefix}actionscheduler_actions.status LIKE '%pending%'";

                    if (!empty($_REQUEST["orderby"])) {
                        $sql .= " ORDER BY " . esc_sql($_REQUEST["orderby"]);
                        $sql .= !empty($_REQUEST["order"])
                            ? " " . esc_sql($_REQUEST["order"])
                            : " DESC";
                    }

                    $sql .= " LIMIT 1";

                    $result = $wpdb->get_results($sql, "ARRAY_A");

                    if (
                        count($result) > 0 &&
                        isset($result[0]["scheduled_date_gmt"])
                    ) {
                        $pnfpb_selected_datetime = new DateTime(
                            $result[0]["scheduled_date_gmt"],
                            new DateTimeZone("UTC")
                        );

                        $pnfpb_selected_datetime->setTimezone(
                            new DateTimeZone(wp_timezone_string())
                        );

                        $recurring_status =
                            esc_html(
                                __(
                                    "Scheduled.<br/>Next run is on ",
                                    "push-notification-for-post-and-buddypress"
                                )
                            ) .
                            $pnfpb_selected_datetime->format("Y/m/d H:i:s") .
                            esc_html(
                                __(
                                    "<br/>(Local time)",
                                    "push-notification-for-post-and-buddypress"
                                )
                            ) .
                            $item["status"];
                    } else {
                        $sql = "SELECT {$wpdb->prefix}actionscheduler_actions.scheduled_date_gmt FROM {$wpdb->prefix}pnfpb_ic_schedule_push_notifications,{$wpdb->prefix}actionscheduler_actions WHERE {$wpdb->prefix}actionscheduler_actions.args LIKE CONCAT('%', {$item["action_scheduler_id"]},',',{$item["id"]}, '%') AND {$wpdb->prefix}actionscheduler_actions.status LIKE '%complete%'";

                        if (!empty($_REQUEST["orderby"])) {
                            $sql .=
                                " ORDER BY " . esc_sql($_REQUEST["orderby"]);
                            $sql .= !empty($_REQUEST["order"])
                                ? " " . esc_sql($_REQUEST["order"])
                                : " DESC";
                        }

                        $sql .= " LIMIT 1";

                        $result = $wpdb->get_results($sql, "ARRAY_A");

                        if (
                            count($result) > 0 &&
                            isset($result[0]["scheduled_date_gmt"])
                        ) {
                            $pnfpb_selected_datetime = new DateTime(
                                $result[0]["scheduled_date_gmt"],
                                new DateTimeZone("UTC")
                            );

                            $pnfpb_selected_datetime->setTimezone(
                                new DateTimeZone(wp_timezone_string())
                            );

                            $recurring_status =
                                wp_kses_post(
                                    __(
                                        "Finished on <br/>",
                                        "push-notification-for-post-and-buddypress"
                                    )
                                ) .
                                $pnfpb_selected_datetime->format("Y-m-d H:i:s");
                        } else {
                            $sql = "SELECT {$wpdb->prefix}actionscheduler_actions.scheduled_date_gmt FROM {$wpdb->prefix}pnfpb_ic_schedule_push_notifications,{$wpdb->prefix}actionscheduler_actions WHERE {$wpdb->prefix}actionscheduler_actions.args LIKE CONCAT('%', {$item["action_scheduler_id"]},',',{$item["id"]}, '%') AND {$wpdb->prefix}actionscheduler_actions.status LIKE '%failed%'";

                            if (!empty($_REQUEST["orderby"])) {
                                $sql .=
                                    " ORDER BY " .
                                    esc_sql($_REQUEST["orderby"]);
                                $sql .= !empty($_REQUEST["order"])
                                    ? " " . esc_sql($_REQUEST["order"])
                                    : " DESC";
                            }

                            $sql .= " LIMIT 1";

                            $result = $wpdb->get_results($sql, "ARRAY_A");

                            if (
                                count($result) > 0 &&
                                isset($result[0]["scheduled_date_gmt"])
                            ) {
                                $pnfpb_selected_datetime = new DateTime(
                                    $result[0]["scheduled_date_gmt"],
                                    new DateTimeZone("UTC")
                                );

                                $pnfpb_selected_datetime->setTimezone(
                                    new DateTimeZone(wp_timezone_string())
                                );

                                $recurring_status =
                                    wp_kses_post(
                                        __(
                                            "Failed on <br/>",
                                            "push-notification-for-post-and-buddypress"
                                        )
                                    ) .
                                    $pnfpb_selected_datetime->format(
                                        "Y-m-d H:i:s"
                                    );
                            } else {
                                $sql = "SELECT {$wpdb->prefix}actionscheduler_actions.scheduled_date_gmt FROM {$wpdb->prefix}pnfpb_ic_schedule_push_notifications,{$wpdb->prefix}actionscheduler_actions WHERE {$wpdb->prefix}actionscheduler_actions.args LIKE CONCAT('%', {$item["action_scheduler_id"]},',',{$item["id"]}, '%') AND {$wpdb->prefix}actionscheduler_actions.status LIKE '%running%'";

                                if (!empty($_REQUEST["orderby"])) {
                                    $sql .=
                                        " ORDER BY " .
                                        esc_sql($_REQUEST["orderby"]);
                                    $sql .= !empty($_REQUEST["order"])
                                        ? " " . esc_sql($_REQUEST["order"])
                                        : " DESC";
                                }

                                $sql .= " LIMIT 1";

                                $result = $wpdb->get_results($sql, "ARRAY_A");

                                if (
                                    count($result) > 0 &&
                                    isset($result[0]["scheduled_date_gmt"])
                                ) {
                                    $pnfpb_selected_datetime = new DateTime(
                                        $result[0]["scheduled_date_gmt"],
                                        new DateTimeZone("UTC")
                                    );

                                    $pnfpb_selected_datetime->setTimezone(
                                        new DateTimeZone(wp_timezone_string())
                                    );

                                    $recurring_status =
                                        wp_kses_post(
                                            __(
                                                "In Queue - scheduled on <br/>",
                                                "push-notification-for-post-and-buddypress"
                                            )
                                        ) .
                                        $pnfpb_selected_datetime->format(
                                            "Y-m-d H:i:s"
                                        );
                                }
                            }
                        }
                    }
                } catch (Exception $e) {
                    error_log(serialize($e));
                }
            }
            return $recurring_status;
        }

        /**
         * Render the bulk edit checkbox
         *
         * @param array $item
         *
         * @return string
         */
        function column_cb($item)
        {
            return sprintf(
                '<input type="checkbox" name="bulk-delete[]" value="%s" />',
                $item["id"]
            );
        }

        /**
         * Render the bulk edit checkbox
         *
         * @param array $item
         *
         * @return string
         */
        function column_action($item)
        {
            $edit_nonce = wp_create_nonce("pnfpb_edit_pushnotification");
            $delete_nonce = wp_create_nonce("pnfpb_delete_pushnotification");
            $duplicate_nonce = wp_create_nonce(
                "pnfpb_duplicate_pushnotification"
            );
            $cancel_nonce = wp_create_nonce("pnfpb_cancel_pushnotification");

            if ($item["action_scheduler_id"] != null) {
                $actions = [
                    "edit" => sprintf(
                        '<a href="?page=%s&status=%s&action=%s&pushnotificationid=%s&_wpnonce=%s">%s</a>',
                        "pnfpb_icfmtest_notification",
                        $item["status"],
                        "edit",
                        esc_attr(absint($item["id"])),
                        esc_attr($edit_nonce),
                        esc_attr(__(
                            "Edit/Resend",
                            "push-notification-for-post-and-buddypress"
                        ))
                    ),
                    "delete" => sprintf(
                        '<a href="?page=%s&action=%s&pushnotificationid=%s&_wpnonce=%s&orderby=id&order=desc">%s</a><br /><br />',
                        "pnfpb_icfm_onetime_notifications_list",
                        "delete",
                        esc_attr(absint($item["id"])),
                        esc_attr($delete_nonce),
                        esc_attr(__(
                            "Delete",
                            "push-notification-for-post-and-buddypress"
                        ))
                    ),
                    "duplicate" => sprintf(
                        '<a href="?page=%s&action=%s&pushnotificationid=%s&_wpnonce=%s&orderby=id&order=desc">%s</a><br /><br />',
                        "pnfpb_icfm_onetime_notifications_list",
                        "duplicate",
                        esc_attr(absint($item["id"])),
                        esc_attr($duplicate_nonce),
                        esc_attr(__(
                            "Duplicate",
                            "push-notification-for-post-and-buddypress"
                        ))
                    ),
                    "cancel" => sprintf(
                        '<a href="?page=pnfpb_icfm_action_scheduler&status=pending&action=-1&action2=-1&_wpnonce=%s&s=%d&paged=1">%s</a>',
                        esc_attr($cancel_nonce),
                        esc_attr(absint($item["action_scheduler_id"])),
                        esc_attr(__(
                            "More actions...",
                            "push-notification-for-post-and-buddypress"
                        ))
                    ),
                ];
            } else {
                $actions = [
                    "edit" => sprintf(
                        '<a href="?page=%s&status=%s&action=%s&pushnotificationid=%s&_wpnonce=%s">%s</a>',
                        "pnfpb_icfmtest_notification",
                        $item["status"],
                        "edit",
                        esc_attr(absint($item["id"])),
                        esc_attr($edit_nonce),
                        esc_attr(__(
                            "Edit/Resend",
                            "push-notification-for-post-and-buddypress"
                        ))
                    ),
                    "delete" => sprintf(
                        '<a href="?page=%s&action=%s&pushnotificationid=%s&_wpnonce=%s&orderby=id&order=desc">%s</a>',
                        "pnfpb_icfm_onetime_notifications_list",
                        "delete",
                        esc_attr(absint($item["id"])),
                        esc_attr($delete_nonce),
                        esc_attr(__(
                            "Delete",
                            "push-notification-for-post-and-buddypress"
                        ))
                    ),
                    "duplicate" => sprintf(
                        '<a href="?page=%s&action=%s&pushnotificationid=%s&_wpnonce=%s&orderby=id&order=desc">%s</a><br /><br />',
                        "pnfpb_icfm_onetime_notifications_list",
                        "duplicate",
                        esc_attr(absint($item["id"])),
                        esc_attr($duplicate_nonce),
                        esc_attr(__(
                            "Duplicate",
                            "push-notification-for-post-and-buddypress"
                        ))
                    ),
                ];
            }
            return $this->row_actions($actions);
        }

        public function row_actions($actions, $always_visible = false)
        {
            return parent::row_actions($actions, true);
        }

        /**
         * Method for name column
         *
         * @param array $item an array of DB data
         *
         * @return string
         */
        function column_name($item)
        {
            $delete_nonce = wp_create_nonce("pnfpb_delete_pushnotification");

            $edit_nonce = wp_create_nonce("pnfpb_delete_pushnotification");

            $title = "<strong>" . $item["title"] . "</strong>";

            $actions = [
                "edit" => sprintf(
                    '<a href="?page=%s&title=%s&content=%s&image_url=%s&click_url=%s&orderby=id&_wpnonce=%s&order=desc">%s</a>',
                    "pnfpb_icfm_onetime_notifications_list",
                    $item["title"],
                    $item["content"],
                    $item["image_url"],
                    $item["click_url"],
                    esc_attr($edit_nonce),
                    esc_attr(__("Edit", "push-notification-for-post-and-buddypress"))
                ),
                "delete" => sprintf(
                    '<a href="?page=%s&action=%s&pushnotificationid=%s&_wpnonce=%s&orderby=id&order=desc">Delete</a>',
                    "pnfpb_icfm_onetime_notifications_list",
                    "delete",
                    esc_attr(absint($item["id"])),
                    esc_attr($delete_nonce)
                ),
            ];

            return $title . $this->row_actions($actions);
        }

        /**
         *  Associative array of columns
         *
         * @return array
         */
        function get_columns()
        {
            $columns = [
                "cb" => '<input type="checkbox" />',
                "id" => __("Id", "push-notification-for-post-and-buddypress"),
                "title" => __(
                    "Title",
                    "push-notification-for-post-and-buddypress"
                ),
                "content" => __(
                    "Content",
                    "push-notification-for-post-and-buddypress"
                ),
                "image_url" => __(
                    "Image url",
                    "push-notification-for-post-and-buddypress"
                ),
                "click_url" => __(
                    "Click url",
                    "push-notification-for-post-and-buddypress"
                ),
                "scheduled_timestamp" => __(
                    "Current run<br/>date & time",
                    "push-notification-for-post-and-buddypress"
                ),
                "scheduled_type" => __(
                    "Schedule type",
                    "push-notification-for-post-and-buddypress"
                ),
                "status" => __(
                    "Status",
                    "push-notification-for-post-and-buddypress"
                ),
                "action" => __(
                    "Action",
                    "push-notification-for-post-and-buddypress"
                ),
            ];

            return $columns;
        }

        /**
         * Columns to make sortable.
         *
         * @return array
         */
        public function get_sortable_columns()
        {
            $sortable_columns = [
                "id" => ["id", true],
                "title" => ["title", true],
                "content" => ["content", true],
                "image_url" => ["image_url", true],
                "click_url" => ["click_url", true],
                "scheduled_timestamp" => ["scheduled_timestamp", true],
                "scheduled_type" => ["scheduled_type", true],
            ];

            return $sortable_columns;
        }

        /**
         * Returns an associative array containing the bulk action
         *
         * @return array
         */
        public function get_bulk_actions()
        {
            $actions = [
                "bulk-delete" => "Delete",
            ];

            return $actions;
        }

        /**
         * Handles data query and filter, sorting, and pagination.
         */
        public function prepare_items($search = "")
        {
			if (isset($_REQUEST["_wpnonce"]) && !wp_verify_nonce(sanitize_text_field(wp_unslash($_REQUEST["_wpnonce"])), "pnfpb_onetime_notifications_list")) {
				die("wnonce failure");
			} else {			
				//data
				if (isset($_REQUEST["s"])) {
					$this->table_data = $this->get_table_data(
						sanitize_text_field(wp_unslash($_REQUEST["s"]))
					);
				} else {
					$this->table_data = $this->get_table_data($search);
				}

				$this->_column_headers = $this->get_column_info();

				/** Process bulk action */
				$this->process_bulk_action();

				$per_page = $this->get_items_per_page("records_per_page", 20);
				$current_page = $this->get_pagenum();
				$total_items = self::record_count();

				if (isset($_REQUEST["s"]) && !isset($_REQUEST["scheduled_type"])) {
					$this->items = self::get_pushnotifications(
						$per_page,
						$current_page,
						sanitize_text_field(wp_unslash($_REQUEST["s"])),
						""
					);
					$total_items_search = self::get_pushnotifications(
						0,
						$current_page,
						sanitize_text_field(wp_unslash($_REQUEST["s"])),
						""
					);
					$this->set_pagination_args([
						"total_items" => count($total_items_search), //WE have to calculate the total number of items
						"per_page" => $per_page, //WE have to determine how many items to show on a page
					]);
				} else {
					if (isset($_REQUEST["scheduled_type"])) {
						if (isset($_REQUEST["s"])) {
							$this->items = self::get_pushnotifications(
								$per_page,
								$current_page,
								sanitize_text_field(wp_unslash($_REQUEST["s"])),
								sanitize_text_field(
									wp_unslash($_REQUEST["scheduled_type"])
								)
							);
							$total_items_search = self::get_pushnotifications(
								0,
								$current_page,
								sanitize_text_field(wp_unslash($_REQUEST["s"])),
								sanitize_text_field(
									wp_unslash($_REQUEST["scheduled_type"])
								)
							);
							$this->set_pagination_args([
								"total_items" => count($total_items_search), //WE have to calculate the total number of items
								"per_page" => $per_page, //WE have to determine how many items to show on a page
							]);
						} else {
							$this->items = self::get_pushnotifications(
								$per_page,
								$current_page,
								"",
								sanitize_text_field(
									wp_unslash($_REQUEST["scheduled_type"])
								)
							);
							$total_items_search = self::get_pushnotifications(
								0,
								$current_page,
								"",
								sanitize_text_field(
									wp_unslash($_REQUEST["scheduled_type"])
								)
							);
							$this->set_pagination_args([
								"total_items" => count($total_items_search), //WE have to calculate the total number of items
								"per_page" => $per_page, //WE have to determine how many items to show on a page
							]);
						}
					} else {
						if (isset($_REQUEST["scheduled_status"])) {
							$this->items = self::get_pushnotifications(
								$per_page,
								$current_page,
								"",
								"",
								sanitize_text_field(
									wp_unslash($_REQUEST["scheduled_status"])
								)
							);
							$total_items_search = self::get_pushnotifications(
								0,
								$current_page,
								"",
								"",
								sanitize_text_field(
									wp_unslash($_REQUEST["scheduled_status"])
								)
							);
							$this->set_pagination_args([
								"total_items" => count($total_items_search), //WE have to calculate the total number of items
								"per_page" => $per_page, //WE have to determine how many items to show on a page
							]);
						} else {
							$this->items = self::get_pushnotifications(
								$per_page,
								$current_page,
								"",
								""
							);
							$this->set_pagination_args([
								"total_items" => $total_items, //WE have to calculate the total number of items
								"per_page" => $per_page, //WE have to determine how many items to show on a page
							]);
						}
					}
				}
			}
        }

        public function pnfpb_url_scheme_start()
        {
            add_filter("set_url_scheme", [$this, "pnfpb_url_scheme"], 10, 3);
        }

        public function pnfpb_url_scheme_stop()
        {
            remove_filter("set_url_scheme", [$this, "pnfpb_url_scheme"], 10);
        }

        public function pnfpb_url_scheme(
            string $url,
            string $scheme,
            $orig_scheme
        ) {
            if (
                !empty($url) &&
                mb_strpos($url, "?page=pnfpb_icfm_onetime_notifications_list") !==
                    false &&
                isset($_REQUEST["s"])
            ) {
                $search_nonce = wp_create_nonce(
                    "pnfpb_search_pushnotification"
                );

                $url = add_query_arg(
                    "s",
                    urlencode(sanitize_text_field(wp_unslash($_REQUEST["s"]))),
                    $url
                );

                $url = add_query_arg(
                    "_wpnonce",
                    urlencode($search_nonce),
                    $url
                );
            }
            return $url;
        }

        public function process_bulk_action()
        {
            //Detect when a bulk action is being triggered...
            if ("delete" === $this->current_action()) {
                // In our file that handles the request, verify the nonce.
                $nonce = esc_attr(
                    sanitize_text_field(wp_unslash($_REQUEST["_wpnonce"]))
                );

                if (!wp_verify_nonce($nonce, "pnfpb_delete_pushnotification")) {
                    die("wnonce failure");
                } else {
                    global $wpdb;

                    $notification_table_name =
                        $wpdb->prefix . "pnfpb_ic_schedule_push_notifications";

                    $push_notification_id = sanitize_text_field(
                        wp_unslash($_REQUEST["pushnotificationid"])
                    );

                    $notifications = $wpdb->get_results(
                        "SELECT * FROM {$notification_table_name} WHERE `id` = {$push_notification_id} "
                    );

                    if (count($notifications) > 0) {
                        foreach ($notifications as $notification) {
                            $onetime_push_id = $notification->id;
                            $onetime_push_action_scheduler_id =
                                $notification->action_scheduler_id;
                            $onetime_push_title = $notification->title;
                            $onetime_push_content = $notification->content;
                            $onetime_push_imageurl = $notification->image_url;
                            $onetime_push_clickurl = $notification->click_url;
                            $onetime_scheduled_type =
                                $notification->scheduled_type;
                            $onetime_push_timestamp =
                                $notification->scheduled_timestamp;
                            $onetime_push_status = $notification->status;
                        }

                        $occurence = "recurring";

                        if ($onetime_scheduled_type === "single") {
                            $occurence = "Onetime scheduled";
                        }

                        as_unschedule_all_actions(
                            "PNFPB_ondemand_schedule_push_notification_hook",
                            [
                                $onetime_push_action_scheduler_id,
                                $onetime_push_id,
                                $occurence,
                                $onetime_push_status,
                            ]
                        );

                        self::delete_pushnotification(
                            absint($push_notification_id),
                            $onetime_push_action_scheduler_id,
                            $onetime_push_timestamp,
                            $onetime_push_status
                        );
                    }
                }
            }

            if ("duplicate" === $this->current_action()) {
                $nonce = esc_attr(
                    sanitize_text_field(wp_unslash($_REQUEST["_wpnonce"]))
                );

                if (
                    !wp_verify_nonce($nonce, "pnfpb_duplicate_pushnotification")
                ) {
                    die("wnonce failure");
                } else {
                    global $wpdb;

                    $notification_table_name =
                        $wpdb->prefix . "pnfpb_ic_schedule_push_notifications";

                    $push_notification_id = sanitize_text_field(
                        wp_unslash($_REQUEST["pushnotificationid"])
                    );

                    $notifications = $wpdb->get_results(
                        "SELECT * FROM {$notification_table_name} WHERE `id` = {$push_notification_id} "
                    );

                    $onetime_recurring_day_number = null;
                    $onetime_recurring_month_number = null;
                    $onetime_recurring_day_name = null;

                    if (count($notifications) > 0) {
                        foreach ($notifications as $notification) {
                            $onetime_push_id = $notification->id;
                            $onetime_push_action_scheduler_id =
                                $notification->action_scheduler_id;
                            $onetime_push_title = $notification->title;
                            $onetime_push_content = $notification->content;
                            $onetime_push_imageurl = $notification->image_url;
                            $onetime_push_clickurl = $notification->click_url;
                            $onetime_push_timestamp =
                                $notification->scheduled_timestamp;
                            if ($notification->recurring_day_number != null) {
                                $onetime_recurring_day_number =
                                    $notification->recurring_day_number;
                            }

                            if ($notification->recurring_month_number != null) {
                                $onetime_recurring_month_number =
                                    $notification->recurring_month_number;
                            }

                            if ($notification->recurring_day_name != null) {
                                $onetime_recurring_day_name =
                                    $notification->recurring_day_name;
                            }
                            $onetime_push_status = $notification->status;
                        }

                        $bpuserid = 0;

                        if (is_user_logged_in()) {
                            $bpuserid = get_current_user_id();
                        }

                        $data = [
                            "userid" => $bpuserid,
                            "action_scheduler_id" => null,
                            "title" => $onetime_push_title,
                            "content" => $onetime_push_content,
                            "image_url" => $onetime_push_imageurl,
                            "click_url" => $onetime_push_clickurl,
                            "scheduled_timestamp" => $onetime_push_timestamp,
                            "recurring_day_number" => $onetime_recurring_day_number,
                            "recurring_month_number" => $onetime_recurring_month_number,
                            "recurring_day_name" => $onetime_recurring_day_name,
                            "status" => __(
                                "Draft",
                                "push-notification-for-post-and-buddypress"
                            ),
                        ];
                        $insertstatus = $wpdb->insert(
                            $notification_table_name,
                            $data
                        );
                    }
                }
            }

            if ("cancel" === $this->current_action()) {
                $nonce = esc_attr(
                    sanitize_text_field(wp_unslash($_REQUEST["_wpnonce"]))
                );

                if (!wp_verify_nonce($nonce, "pnfpb_cancel_pushnotification")) {
                    die("wnonce failure");
                } else {
                    $selected_day_push_notification_cancel = date(
                        "Y/m/d H:i:s",
                        $notification->scheduled_timestamp
                    );

                    $pnfpb_selected_datetime_notification_cancel = new DateTime(
                        $selected_day_push_notification_cancel,
                        new DateTimeZone(wp_timezone_string())
                    );

                    $pnfpb_selected_datetime_notification_cancel = $pnfpb_selected_datetime_notification_cancel->setTimezone(
                        new DateTimeZone("UTC")
                    );

                    $selected_recurring_schedule_formatted_notification_db = strtotime(
                        $pnfpb_selected_datetime_notification_cancel->format(
                            "Y-m-d H:i:s"
                        )
                    );
                    as_unschedule_all_actions(
                        "PNFPB_ondemand_schedule_push_notification_hook",
                        [
                            $selected_recurring_schedule_formatted_notification_db,
                            $onetime_push_id,
                            "recurring",
                            $notification->status,
                        ]
                    );
                }
            }

            // If the delete bulk action is triggered
            if (
                (isset($_REQUEST["action"]) &&
                    $_REQUEST["action"] == "bulk-delete") ||
                (isset($_REQUEST["action2"]) &&
                    $_REQUEST["action2"] == "bulk-delete")
            ) {
                $delete_ids = esc_sql($_REQUEST["bulk-delete"]);

                global $wpdb;

                // loop over the array of record IDs and delete them
                foreach ($delete_ids as $id) {
                    $notification_table_name =
                        $wpdb->prefix . "pnfpb_ic_schedule_push_notifications";

                    $notifications = $wpdb->get_results(
                        "SELECT * FROM {$notification_table_name} WHERE `id` = {$id} "
                    );

                    if (count($notifications) > 0) {
                        foreach ($notifications as $notification) {
                            $onetime_push_id = $notification->id;
                            $onetime_push_action_scheduler_id =
                                $notification->action_scheduler_id;
                            $onetime_push_title = $notification->title;
                            $onetime_push_content = $notification->content;
                            $onetime_push_imageurl = $notification->image_url;
                            $onetime_push_clickurl = $notification->click_url;
                            $onetime_push_timestamp =
                                $notification->scheduled_timestamp;
                            $onetime_push_status = $notification->status;
                        }

                        self::delete_pushnotification(
                            absint($id),
                            $onetime_push_action_scheduler_id,
                            $onetime_push_timestamp,
                            $onetime_push_status
                        );
                    }
                }
            }
        }
    }
} else {
    exit();
}
?>
