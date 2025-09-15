<?php
if (!class_exists("WP_List_Table")) {
    require_once ABSPATH . "wp-admin/includes/class-wp-list-table.php";
}

// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

if (!class_exists("PNFPB_ICFM_delivery_notifications_List")) {
    class PNFPB_ICFM_delivery_notifications_List extends WP_List_Table
    {
        public $pre_name = "PNFPB_delivery_list_";

        private $table_data;

        /** Class constructor */
        public function __construct()
        {
            parent::__construct([
                "singular" => __(
                    "DeliveredNotification",
                    "push-notification-for-post-and-buddypress"
                ), //singular name of the listed records
                "plural" => __(
                    "DeliveredNotifications",
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
        public static function get_delivery_notifications(
            $per_page = 20,
            $page_number = 1,
            $search = "",

        ) {
            global $wpdb;

			if (
                !empty($search) &&
                is_numeric($search) 
            ) {
                $sql = "SELECT * FROM {$wpdb->prefix}pnfpb_ic_total_statistics_notifications WHERE notificationid = {$search} OR title = {$search} OR content LIKE '%{$search}%'";
            } else {
                if (
                    !empty($search) &&
                    !is_numeric($search) 
                ) {
                    $sql = "SELECT * FROM {$wpdb->prefix}pnfpb_ic_total_statistics_notifications WHERE title LIKE '%{$search}%' OR content LIKE '%{$search}%'";
                } else {
                    $sql = "SELECT * FROM {$wpdb->prefix}pnfpb_ic_total_statistics_notifications";
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

		/**
         * Delete a customer record.
         *
         * @param int $id device token ID
         */
        public static function delete_delivery_notification(
            $id
        ) {
            global $wpdb;

            $wpdb->delete(
                "{$wpdb->prefix}pnfpb_ic_total_statistics_notifications",

                ["id" => $id],

                ["%d"]
            );
        }

        /**
         * Returns the count of records in the database.
         *
         * @return null|string
         */
        public static function record_count()
        {
            global $wpdb;

            $sql = "SELECT COUNT(*) FROM {$wpdb->prefix}pnfpb_ic_total_statistics_notifications";

            return $wpdb->get_var($sql);
        }

        /** Text displayed when no device token data is available */
        public function no_items()
        {
            esc_html_e(
                "No data",
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
                case "notificationid":
					return $item[$column_name];
				case "title":
				case "content":
				case "total_delivery_confirmation":
				case "total_open_confirmation":
                    return $item[$column_name];
                default:
                    return print_r($item, true); //Show the whole array for troubleshooting purposes
            }
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
         * Render the date and time field
         *
         * @param array $item
         *
         * @return date and time
         */
        function column_datetime($item)
        {
			$formattedDate = date('Y-m-d H:i:s', $item['notificationid']);

            return $formattedDate;
        }		

        public function row_actions($actions, $always_visible = false)
        {
            return parent::row_actions($actions, true);
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
				"notificationid" => __("Notification <br/> id", "push-notification-for-post-and-buddypress"),
				"datetime" => __("Date &<br/> Time", "push-notification-for-post-and-buddypress"),
                "title" => __(
                    "Title",
                    "push-notification-for-post-and-buddypress"
                ),
                "content" => __(
                    "Content",
                    "push-notification-for-post-and-buddypress"
                ),
                "total_delivery_confirmation" => __(
                    "Delivery <br/> count",
                    "push-notification-for-post-and-buddypress"
                ),
                "total_open_confirmation" => __(
                    "Read <br/> count",
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
				"notificationid" => ["notificationid", true],
				"datetime" => ["notificationid", true],
				"notification_auth_token" => ["notification_auth_token", true],
                "title" => ["title", true],
                "content" => ["content", true],
				"total_delivery_confirmation" => ["total_delivery_confirmation", true],
				"total_open_confirmation" => ["total_open_confirmation", true],
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
			if (isset($_REQUEST["_wpnonce"]) && !wp_verify_nonce(sanitize_text_field(wp_unslash($_REQUEST["_wpnonce"])), "pnfpb_search_delivery_pushnotification")) {
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

				//$_SERVER['REQUEST_URI'] = remove_query_arg( '_wp_http_referer', $_SERVER['REQUEST_URI'] );

				if (isset($_REQUEST["s"])) {
					$this->items = self::get_delivery_notifications(
						$per_page,
						$current_page,
						sanitize_text_field(wp_unslash($_REQUEST["s"])),
						""
					);
					$total_items_search = self::get_delivery_notifications(
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

					$this->items = self::get_delivery_notifications(
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
                mb_strpos($url, "?page=pnfpb_icfm_delivery_notifications_list") !==
                    false &&
                isset($_REQUEST["s"])
            ) {
                $search_nonce = wp_create_nonce(
                    "pnfpb_search_delivery_pushnotification"
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
            // If the delete bulk action is triggered
            if (
                (isset($_REQUEST["action"]) &&
                    $_REQUEST["action"] == "bulk-delete") ||
                (isset($_REQUEST["action2"]) &&
                    $_REQUEST["action2"] == "bulk-delete")
            ) {
				
				$delete_nonce = '';
				if (isset($_REQUEST["_wpnonce"])) {
					$delete_nonce = esc_attr(
						sanitize_text_field(wp_unslash($_REQUEST["_wpnonce"]))
					);
				}				
                if (!wp_verify_nonce($delete_nonce, "pnfpb_delivery_report-bulk_delete_items")) {
                    die("wnonce failure");
                } else {				
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

							self::delete_delivery_notification(
								absint($id)
							);
						}
					}
				}
            }
        }
    }
} else {
    exit();
}
?>
