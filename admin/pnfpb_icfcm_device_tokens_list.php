<?php
if (!class_exists("WP_List_Table")) {
    require_once ABSPATH . "wp-admin/includes/class-wp-list-table.php";
}

// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

if (!class_exists("PNFPB_ICFM_Device_tokens_List")) {
    class PNFPB_ICFM_Device_tokens_List extends WP_List_Table
    {
        private $table_data;

        /** Class constructor */
        public function __construct()
        {
            parent::__construct([
                "singular" => __(
                    "Devicetoken",
                    "push-notification-for-post-and-buddypress"
                ), //singular name of the listed records
                "plural" => __(
                    "Devicetokens",
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
        public static function get_devicetokens(
            $per_page = 20,
            $page_number = 1,
            $search = ""
        ) {
            global $wpdb;

            if (!empty($search) && is_numeric($search)) {
                $sql = "SELECT * FROM {$wpdb->prefix}pnfpb_ic_subscribed_deviceids_web WHERE userid = {$search} OR device_id LIKE '%{$search}%' OR subscription_option LIKE '%{$search}%'";
            } else {
                if (!empty($search) && !is_numeric($search)) {
                    $sql = "SELECT * FROM {$wpdb->prefix}pnfpb_ic_subscribed_deviceids_web WHERE device_id LIKE '%{$search}%' OR subscription_option LIKE '%{$search}%'";
                } else {
                    $sql = "SELECT * FROM {$wpdb->prefix}pnfpb_ic_subscribed_deviceids_web";
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
        public static function delete_devicetoken($id)
        {
            global $wpdb;

            $wpdb->delete(
                "{$wpdb->prefix}pnfpb_ic_subscribed_deviceids_web",
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

            $sql = "SELECT COUNT(*) FROM {$wpdb->prefix}pnfpb_ic_subscribed_deviceids_web";

            return $wpdb->get_var($sql);
        }

        /** Text displayed when no device token data is available */
        public function no_items()
        {
            esc_html_e(
                "No registered device tokens avaliable.",
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
                case "device_id":
                case "userid":
                case "subscription_option":
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
         * Method for name column
         *
         * @param array $item an array of DB data
         *
         * @return string
         */
        function column_name($item)
        {
            $delete_nonce = wp_create_nonce("pnfpb_delete_devicetoken");

            $title = "<strong>" . $item["device_id"] . "</strong>";

            $actions = [
                "delete" => sprintf(
                    '<a href="?page=%s&action=%s&devicetoken=%s&_wpnonce=%s">Delete</a>',
                    esc_attr($_REQUEST["page"]),
                    "delete",
                    absint($item["id"]),
                    $delete_nonce
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
                "device_id" => __(
                    "Device token",
                    "push-notification-for-post-and-buddypress"
                ),
                "userid" => __(
                    "Userid",
                    "push-notification-for-post-and-buddypress"
                ),
                "subscription_option" => __(
                    "Shortcode Subscription",
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
                "device_id" => ["device_id", true],
                "userid" => ["userid", true],
                "subscription_option" => ["subscription_option", true],
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
            $delete_nonce = wp_create_nonce("pnfpb_delete_devicetoken");

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
			if (isset($_REQUEST["_wpnonce"]) && !wp_verify_nonce(sanitize_text_field(wp_unslash($_REQUEST["_wpnonce"])), "pnfpb_icfcm_device_tokens_list")) {
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

				if (isset($_REQUEST["s"])) {
					$this->items = self::get_devicetokens(
						$per_page,
						$current_page,
						sanitize_text_field(wp_unslash($_REQUEST["s"]))
					);
					$total_items_search = self::get_devicetokens(
						0,
						$current_page,
						sanitize_text_field(wp_unslash($_REQUEST["s"]))
					);
					$this->set_pagination_args([
						"total_items" => count($total_items_search), //WE have to calculate the total number of items
						"per_page" => $per_page, //WE have to determine how many items to show on a page
					]);
				} else {
					$this->items = self::get_devicetokens(
						$per_page,
						$current_page,
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
                mb_strpos($url, "?page=pnfpb_icfm_device_tokens_list") !==
                    false &&
                isset($_REQUEST["s"])
            ) {
                $search_nonce = wp_create_nonce(
                    "pnfpb_search_device_tokens_list_pushnotification"
                );
                $url = add_query_arg("s", urlencode($_REQUEST["s"]), $url);
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

                if (!wp_verify_nonce($nonce, "pnfpb_delete_devicetoken")) {
                    die("wnonce failure");
                } else {
                    $devicetokenid = sanitize_text_field(
                        wp_unslash($_GET["devicetoken"])
                    );

                    $devicetokenid = esc_html($devicetokenid);

                    self::delete_devicetoken(absint($devicetokenid));
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

                // loop over the array of record IDs and delete them
                foreach ($delete_ids as $id) {
                    self::delete_devicetoken($id);
                }
            }
        }
    }
} else {
    exit();
}
?>
